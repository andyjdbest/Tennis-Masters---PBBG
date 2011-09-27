<?php
        #include the common file
        require_once 'common.php';
        
        require_once("../DBconfig.php");

	function updateuserid()
	{
		$query="SELECT userid FROM users WHERE 1";
		$result = mysql_query($query);
		
		//global $useriddata;
		while ($row = mysql_fetch_row($result))
		{
			$temp[] = $row[0];
		}
                 return $temp;
	}
	
	function showDormantUsers() {
		$query = "SELECT DISTINCT userid,username FROM users WHERE isAdmin = 0 AND isAssigned = 1 AND isMember = 0 AND userid NOT IN (SELECT iduser FROM logins WHERE DATEDIFF(CURDATE(), time) < 30)";
		$result = mysql_query($query);
		global $dormantData;
		while ($row = mysql_fetch_object($result)) {
			$dormantData[] = $row;
		}
	}
	
	function showUnvalidUsers() {
		$query = "SELECT DISTINCT u.userid,u.username FROM users AS u JOIN validation AS v ON u.userid = v.id WHERE u.isAdmin = 0 AND u.isValidated = 0 AND DATEDIFF(CURDATE(), v.timestamp) > 30";
		$result = mysql_query($query);
		global $unvalidData;
		while ($row = mysql_fetch_object($result)) {
			$unvalidData[] = $row;
		}
	}
	
        session_start();
         if (@$_SESSION['authenticated'] == 'true' && @$_SESSION['admin'] == 'true')
         {
			$dormantData = array();
			$unvalidData = array();
           	$useriddata = updateuserid();
		    
			showDormantUsers();
			showUnvalidUsers();	
           if ($_POST['search'])
           {
               if (ctype_alnum($_POST['userid']) === false)
                   {
                       $error = 'Check the input';
                   }
               else {
                    $id = $_POST['userid'];
                    //$message = $id;
                    $query = "SELECT * FROM users WHERE userid='$id' LIMIT 1";
                    $result = mysql_query($query);
                    $user = mysql_fetch_array($result);
               }
           }
		   
		   if ($_POST['update']) {
		   		//need to check email seperately...
		   		if (ctype_alnum($_POST['userid']) === false  || ctype_alnum($_POST['username']) === false  || ctype_alnum($_POST['isValidated']) === false || ctype_alnum($_POST['isAdmin']) === false || ctype_alnum($_POST['isAssigned']) === false
					|| ctype_alnum($_POST['firstname']) === false || ctype_alnum($_POST['lastname']) === false)
                   {
                       $error = 'Check the input';
                   }
				else if (validEmail($_POST['email']) === false) {
					$error = 'Check the email';
				} 
				else {
				   		$id = $_POST['userid'];
						$username = $_POST['username'];
						$email = $_POST['email'];
						$isValidated = $_POST['isValidated'];
						$isAdmin = $_POST['isAdmin'];
						$isAssigned = $_POST['isAssigned'];
						$firstname = $_POST['firstname'];
						$lastname = $_POST['lastname'];
						
						$update = "UPDATE users SET username = '$username', email = '$email', firstname= '$firstname', lastname = '$lastname', 
									isValidated = '$isValidated', isAdmin = '$isAdmin', isAssigned = '$isAssigned' WHERE userid = '$id'";
						if (!(mysqli_query($conn, $update))) {
                                     $error = 'Cannot update user id ' . mysqli_error($conn);
                        }
				   }
				   if ($error == '') 
				   	$message = 'Details Changed';
			
		   }
		   
		   if ($_POST['deleteDormant']) {
		   		$query = "SELECT userid FROM users WHERE isAdmin =0 AND isAssigned =1 AND isMember = 0 AND userid NOT IN (SELECT iduser FROM logins WHERE DATEDIFF( CURDATE( ) , time ) <30)";
				$result = mysql_query($query);
					
				while ($row = mysql_fetch_row($result)) {
						$dormantIds[] = $row[0];
				}
				//check 
				foreach ($dormantIds as $id  ) {
					//obtain the correct academy id
					$select = "SELECT id_team FROM academy WHERE id_user = '$id'";
					$query = mysqli_query($conn,$select);
					$row = mysqli_fetch_row($conn,$query);
					$academy = $row[0];
					
					//UPDATE academy
					$query = "UPDATE academy SET id_user = NULL,rank_world = NULL, 
						  rank_country = NULL, fans = 2, fan_move = 0, negative = 0 WHERE id_user = '$id'";
					if (!(mysqli_query($conn, $query))) {
                                    		 $errorDormant .= ' Cannot update user id ' . $id . mysqli_error($conn);
                     			}
                     			//UPDATE Users isAssigned field
					$update = "UPDATE users SET isAssigned = 0 WHERE userid = '$id'";
					if (!(mysqli_query($conn, $update))) {
                                     		$errorDormant .= ' Cannot update user id ' . $id . mysqli_error($conn);
                     			}
                     			
                     			//DELETE coaches
                     			$delete = "DELETE FROM coaches WHERE id_team = '$academy'";
                     			if (!(mysqli_query($conn, $delete))) {
                                     		$errorDormant .= ' Cannot delete coaches user id ' . $id . mysqli_error($conn);
                     			}
                     			
                     			//DELETE training
                     			$delete = "DELETE FROM training_data WHERE id_team = '$academy'";
                     			if (!(mysqli_query($conn, $delete))) {
                                     		$errorDormant .= ' Cannot delete training user id ' . $id . mysqli_error($conn);
                     			}
                     			
                     			/*//DELETE training_report
                     			$delete = "DELETE FROM training_report WHERE id_team = '$academy'";
                     			if (!(mysqli_query($conn, $delete))) {
                                     		$errorDormant .= ' Cannot delete training report user id ' . $id . mysqli_error($conn);
                     			}
                     			*/
                     			
                     			//DELETE finance
                     			$delete = "DELETE FROM finance WHERE id_team = '$academy'";
                     			if (!(mysqli_query($conn, $delete))) {
                                     		$errorDormant .= ' Cannot delete finance user id ' . $id . mysqli_error($conn);
                     			}
                     			
                     			//DELETE finance_summary
                     			$delete = "DELETE FROM finance_summary WHERE id_team = '$academy'";
                     			if (!(mysqli_query($conn, $delete))) {
                                     		$errorDormant .= ' Cannot delete finance summary user id ' . $id . mysqli_error($conn);
                     			}
                     			
                     			//DELETE match_order
                     			$delete = "DELETE FROM match_order WHERE id_team = '$academy'";
                     			if (!(mysqli_query($conn, $delete))) {
                                     		$errorDormant .= ' Cannot delete match_order user id ' . $id . mysqli_error($conn);
                     			}
                     			
                     			//DELete messages
					$delete = "DELETE FROM messages WHERE id_receiver = '$id'";
                     			if (!(mysqli_query($conn, $delete))) {
                                     		$errorDormant .= ' Cannot delete messages user id ' . $id . mysqli_error($conn);
                     			}
                     			
                     			//DELete bids if any
					$delete = "DELETE FROM fa_bids WHERE id_team = '$academy'";
                     			if (!(mysqli_query($conn, $delete))) {
                                     		$errorDormant .= ' Cannot delete bids user id ' . $id . mysqli_error($conn);
                     			}
                     			
                     			//SET Player fitness to 50
                     			$update = "UPDATE players SET fitness = 50 WHERE id_team = '$academy'";
                     			if (!(mysqli_query($conn, $update))) {
                                     		$errorDormant .= ' Cannot update fitness user id ' . $id . mysqli_error($conn);
                     			}
                     			
                     			//Update alliance
                     			$select = mysql_query("SELECT id_alliance FROM alliance_members WHERE id_user = '$id' AND  status = '2'");
                     			$row = mysql_fetch_row($select);
                     			
                     			if (isset($row[0])){
                     				$update = "UPDATE alliance_members SET status = 3, left_date = NOW()
                     				 WHERE id_user = '$id' AND status = '1' OR status = '2'";
                     				if (!(mysqli_query($conn, $update))) {
                                     			$errorDormant .= ' Cannot update alliance user id ' . $id . mysqli_error($conn);
                     				}
                     				$all = $row[0];
                     				$update = "UPDATE alliance SET members = members - 1  WHERE id_alliance = '$all'";
                				if (!(mysqli_query($conn, $update))) {
                                     			$errorDormant .= ' Cannot update alliance user id ' . $id . mysqli_error($conn);
                     				}
	
                     			}

					 
				}
				showDormantUsers();
		   }
		   
		   if ($_POST['deleteUnvalid']) {
		 		$query = "SELECT DISTINCT u.userid FROM users AS u JOIN validation AS v ON u.userid = v.id WHERE u.isAdmin = 0 AND u.isValidated = 0 AND DATEDIFF(CURDATE(), v.timestamp) > 30";
				$result = mysql_query($query);
				
				while ($row = mysql_fetch_object($result)) {
						$unvalidIds[] = $row[0];
				}
				
				foreach ($unvalidIds as $id  ) {
					$delete = "DELETE FROM users WHERE userid = '$id'";
					if (!(mysqli_query($conn, $delete))) {
                                    		$errorUnvalid = 'Cannot delete user id ' . $id . mysqli_error($conn);
                     			}
                     			$delete = "DELETE FROM validation WHERE userid = '$id'";
                     			if (!(mysqli_query($conn, $delete))) {
                                    		$errorUnvalid .= ' Cannot delete user id from validation ' . $id . mysqli_error($conn);
                     			}
                     			
					 
				}
				showUnvalidUsers();
					  		
		   }

           $smarty->assign('error',$error);
           $smarty->assign('message',$message);
           $smarty->assign('id',$id);
           $smarty->assign('sUserId',$useriddata);
           $smarty->assign('user',$user);
		   $smarty->assign('dormantData',$dormantData);
		   $smarty->assign('errorDormant',$errorDormant);
		   $smarty->assign('unvalidData',$unvalidData);
		   $smarty->assign('errorUnvalid',$errorUnvalid);
           $smarty->display('mgmtUser.tpl');
         }
?>