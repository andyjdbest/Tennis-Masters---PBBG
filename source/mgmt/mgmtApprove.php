<?php

/*
Status Flags = 0 - Applied to create / join / name
	       1 - Applied to delete / withdraw / cancel
	       2 - Active / Done
	       3 - Deleted / Removed
*/

 #include the common file
 require_once 'common.php';

      
session_start();
if (@$_SESSION['authenticated'] == 'true' && @$_SESSION['admin'] == 'true'){
             include ("../DBconfig.php");
		
	     $teamCredits = 40;
	     $playerCredits = 30;
	     $courtCredits = 20; 
             $result = array();
             $message = ''; $error = '';
             
             function updateCreditHistory($userid,$note,$amount,$newValue='')
             {            
                $update = "UPDATE users SET credits = credits - $amount WHERE userid = $userid";
                if (!(mysql_query($update))) {
   			$error = mysql_error();
			echo $error;
        	}
        	
        	$insert = "INSERT INTO credit_history (userid,amount,note,newValue,date_time) VALUES ('$userid','$amount','$note','$newValue',NOW())";
        	//echo $insert;
        	if (!(mysql_query($insert))) {
   			$error = mysql_error();
			echo $error;
        	}
             }

            
		
	     // managing alliances
             if($_GET['type'] == 1){
             	//approve
             	if ($_GET['r'] == 1){
             		if (ctype_digit($_GET['id']) == false) {
				$error = "Invalid input";
			}
			else {
				$id = $_GET['id'];
				$query = "SELECT a.id_alliance,a.name,a.leader_id,u.username,u.credits,u.userid,u.memberTill FROM alliance AS a 
                			JOIN users AS u ON a.leader_id = u.userid 
                			WHERE a.status = 0 AND id_alliance = $id LIMIT 1";
                		$r = mysql_query($query);
               			$result = mysql_fetch_row($r);
               			if (isset($result[0])) {
               				//check for needed credits
               				if ($result[4] >= $teamCredits && strtotime($result[6]) > strtotime('now')){
               					//update alliance to created
               					$update = "UPDATE alliance SET members = 1, status = 2, created_date = NOW()
               							WHERE id_alliance = $id";
               					if (!(mysql_query($update))) {
             						$error = mysql_error();
			 				echo $error;
        					}
        					else {
               					//insert leader id into alliance
               					$insert = "INSERT INTO alliance_members (id_user,id_alliance,join_date,status) 
               							VALUES ({$result[2]},{$result[0]},NOW(),'2')";
               					if (!(mysql_query($insert))) {
             						$error = mysql_error();
			 				echo $error;
        					}
        					else {
        					//send a mail to the leader
        						$note = "Your alliance $result[1] has been created and $teamCredits have been deducted from your credits.";
        						$insert = "INSERT INTO messages (id_sender, id_receiver, date, subject, body)
        							VALUES ('1',{$result[2]},NOW(),'Alliance Creation', '$note')";
        						if (!(mysql_query($insert))) {
             							$error = mysql_error();
			 					echo $error;
        						}
        						//add to credits history
        						updateCreditHistory($result[2],'Creation of Alliance',$teamCredits,$result[1]);
        						//redirect to page
        						header("Location:mgmtAlliances.php?message=2");	
        					}		
               					
               					}
               					
               				}
               				
               			}
				
			}	
			
             	}
             	//decline
		else if ($_GET['r'] == 0){
			if (ctype_digit($_GET['id']) == false) {
				$error = "Invalid input";
			}
			else {
				$id = $_GET['id'];
				$query = mysql_query("SELECT leader_id,name FROM alliance WHERE id_alliance = '$id' LIMIT 1");
				$row = mysql_fetch_row($query);
				
				if (isset($row[0])){
					$note = "Your alliance {$row[1]} was not approved. No credits were deducted";
        				$insert = "INSERT INTO messages (id_sender, id_receiver, date, subject, body)
        						VALUES ('1',{$row[0]},NOW(),'Alliance Creation', '$note')";
        				if (!(mysql_query($insert))) {
             					$error = mysql_error();
			 			echo $error;
        				}
        				$update = "UPDATE alliance SET status = 3 WHERE id_alliance = $id";
        				if (!(mysql_query($update))) {
             					$error = mysql_error();
			 			echo $error;
        				}
        				header("Location:mgmtAlliances.php?message=1");
				}
			}
			
		}
             	
             	
             }
             
             //managing player renames
             if($_GET['type'] == 2){
             	//approve
             	if ($_GET['r'] == 1){
             		if (ctype_digit($_GET['id']) == false) {
				$error = "Invalid input";
			}
			else {
				$id = $_GET['id'];
				$query = "SELECT n.id_entity,n.new_value,u.username,u.credits,u.userid,u.memberTill 
					FROM name_changes AS n 
                			JOIN users AS u ON n.id_user = u.userid 
                			WHERE n.status = 0 AND id_nameChange = $id LIMIT 1";
                		$r = mysql_query($query);
               			$result = mysql_fetch_row($r);
               			//print_r($result);
               			if (isset($result[0])) {
               				//check for needed credits
               				if ($result[3] >= $playerCredits && strtotime($result[5]) > strtotime('now')){
               					
               					//split the new value to 2 firstname & last name
               					$names = explode(" ", $result[1]);
               					$firstname = $names[0];
               					$lastname = $names[1];	
               					
               					//insert new name
               					$update = "UPDATE players SET firstname = '$firstname', lastname = '$lastname' WHERE
               							idplayer = {$result[0]}";
               					//echo "$update";
               					if (!(mysql_query($update))) {
             						$error = mysql_error();
			 				echo "UPDATE - $error";
        					}
        					else {
	               					$update = "UPDATE name_changes SET status = 1, date_completed = NOW()
	               							WHERE id_nameChange = $id";
	               					if (!(mysql_query($update))) {
	             						$error = mysql_error();
				 				echo $error;
	        					}
	        					//add to credits history
        						updateCreditHistory($result[4],'Renaming of Player',$playerCredits,$result[1]);
        						//redirect to page
        						header("Location:mgmtAlliances.php?message=4");	
	        				}
					}
				}
	      		}
	      	}
	      	//decline
		else if ($_GET['r'] == 0){
			if (ctype_digit($_GET['id']) == false) {
				$error = "Invalid input";
			}
			else {
				$id = $_GET['id'];
				$query = mysql_query("SELECT id_user,old_value FROM name_changes WHERE id_nameChange = '$id' LIMIT 1");
				
				$row = mysql_fetch_row($query);
				
				if (isset($row[0])){
					$note = "Your player name {$row[1]} was not approved. No credits were deducted";
        				$insert = "INSERT INTO messages (id_sender, id_receiver, date, subject, body)
        						VALUES ('1',{$row[0]},NOW(),'Player Rename', '$note')";
        				if (!(mysql_query($insert))) {
             					$error = mysql_error();
			 			echo $error;
        				}
        				$delete = "DELETE FROM name_changes WHERE id_nameChange = $id";
        				if (!(mysql_query($delete))) {
             					$error = mysql_error();
			 			echo $error;
        				}
        				header("Location:mgmtAlliances.php?message=3");
				}
			}
			
		}
	      	
	      }
             
             //managing stadium renames
             if($_GET['type'] == 3){
             	//approve
             	if ($_GET['r'] == 1){
             		if (ctype_digit($_GET['id']) == false) {
				$error = "Invalid input";
			}
			else {
				$id = $_GET['id'];
				$query = "SELECT n.id_entity,n.new_value,u.username,u.credits,u.userid,u.memberTill 
					FROM name_changes AS n 
                			JOIN users AS u ON n.id_user = u.userid 
                			WHERE n.status = 0 AND id_nameChange = $id LIMIT 1";
                		$r = mysql_query($query);
               			$result = mysql_fetch_row($r);
               			//print_r($result);
               			if (isset($result[0])) {
               				//check for needed credits
               				if ($result[3] >= $courtCredits && strtotime($result[5]) > strtotime('now')){
               					
               					$new_name = $result[1];
               					
               					//insert new name
               					$update = "UPDATE stadium SET name = '$new_name' WHERE
               							id = {$result[0]}";
               					//echo "$update";
               					if (!(mysql_query($update))) {
             						$error = mysql_error();
			 				echo "UPDATE - $error";
        					}
        					else {
	               					$update = "UPDATE name_changes SET status = 1, date_completed = NOW()
	               							WHERE id_nameChange = $id";
	               					if (!(mysql_query($update))) {
	             						$error = mysql_error();
				 				echo $error;
	        					}
	        					//add to credits history
        						updateCreditHistory($result[4],'Renaming of Court',$courtCredits,$result[1]);
        						//redirect to page
        						header("Location:mgmtAlliances.php?message=6");	
	        				}
					}
				}
	      		}
	      	}
	      	//decline
		else if ($_GET['r'] == 0){
			if (ctype_digit($_GET['id']) == false) {
				$error = "Invalid input";
			}
			else {
				$id = $_GET['id'];
				$query = mysql_query("SELECT id_user,old_value FROM name_changes WHERE id_nameChange = '$id' LIMIT 1");
				
				$row = mysql_fetch_row($query);
				
				if (isset($row[0])){
					$note = "Your court name {$row[1]} was not approved. No credits were deducted";
        				$insert = "INSERT INTO messages (id_sender, id_receiver, date, subject, body)
        						VALUES ('1',{$row[0]},NOW(),'Court Rename', '$note')";
        				if (!(mysql_query($insert))) {
             					$error = mysql_error();
			 			echo $error;
        				}
        				$delete = "DELETE FROM name_changes WHERE id_nameChange = $id";
        				if (!(mysql_query($delete))) {
             					$error = mysql_error();
			 			echo $error;
        				}
        				header("Location:mgmtAlliances.php?message=5");
				}
			}
			
		}
	      	
	      }

             $smarty->assign('message', $message);
             $smarty->assign('error', $error);
             $smarty->assign('newData',$result);
          //   $smarty->display('mgmtAlliances.tpl');
         }


?>