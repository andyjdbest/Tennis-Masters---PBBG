<?php
/*
 * Member requests handled: a) Alliance
 * 
 */
 /*
Status Flags = 0 - Applied to create / join / name
	       1 - Applied to delete / withdraw / cancel
	       2 - Active / Done
	       3 - Deleted / Removed
*/
require_once 'common.php';
require_once 'DBconfig.php';

session_start();
if (@$_SESSION['authenticated'] == 'true' & @$_SESSION['assigned'] == 1 & @$_SESSION['member'] == 1) {
	
	$id_user = $_SESSION['userid'];
	
	if ($_POST['createAlliance']){
		
		$regex = "/^[a-zA-Z0-9_ ]{1,}$/";

		if (preg_match($regex, $_POST['allianceName'])) {
		
			$allName = mysql_real_escape_string($_POST['allianceName']);
			$query = "SELECT COUNT(id_alliance) FROM alliance WHERE UPPER(name) = UPPER('$allName')";
			$result = mysqli_query($conn, $query);
			list($count) = mysqli_fetch_row($result);
			if($count >= 1) {          
				$message = 'The alliance name you entered has already been taken. Please try a different one.';
				//echo $message;
			}
			else {
				$description = stripHTML($_POST['description']);
				if (strlen($description) < 250){
					
					$query = "INSERT INTO alliance (name,leader_id,description,status) VALUES ('$allName','$id_user','$description','0')";
					if (!mysql_query($query)) {
						 $message = 'Error in making your request';
						// echo mysql_error();
					}
					else {
							$message = 'Your request has been submitted for validation.'. "<BR />" . "A member of our team will look at your request and validate your alliance.";		 
							//echo $message;
					}
				}
				else {
					$message = 'Your description has more than 250 characters.';
				}
			}
		}
		else {
			$message = 'Alliance name is not valid. It should not exceed 50 characters and should only include alphanumeric characters, space and underscore.'; 
		}
		
	}

	//player name changes
	if ($_POST['changeNames']){
		$academy = $_SESSION['id_team'];
		$q = mysql_query("SELECT idplayer,CONCAT(firstname, ' ', lastname) AS name FROM players WHERE id_team = $academy");
		while($row = mysql_fetch_row($q)){
			$players[] = $row;	
		}
		//print_r($players);
		$messageName = '';
		$err = 0;
			
		foreach($players as $player){
			$p = $player[0];
			$name = $player[1];			
			$first = $_POST['firstName'][$p];
			$last = $_POST['lastName'][$p];
		//echo $err;	
			if (isset($first) && isset($last)){
				if (ctype_alpha($first) && ctype_alpha($last) &&
				    strlen($first)< 20 && strlen($last) < 20 ){
					$query = "SELECT COUNT(idplayer) FROM players 
						WHERE UPPER(firstname) = UPPER('$first') AND UPPER(lastname) = UPPER('$last')";
					$result = mysqli_query($conn, $query);
					list($count) = mysqli_fetch_row($result);
					if($count >= 1) {          
						$messageName .= "The player name $first $last you entered has already been taken. Please try a different one.";
						global $err; $err = 1;	
					}		
					else {
						
						$newN = $first . " " . $last;	
						$i = "INSERT INTO name_changes(id_user,id_entity,type,old_value,new_value,date_requested)
							VALUES('$id_user','$p','1','$name','$newN',NOW())";
						if (!mysql_query($i)){
							global $err; $err = 1;
							echo mysql_error();		
						}
						else
							$messageName .= "New name for $name has been submitted for validation. <br />";	
					}			
				}
				else {
						
					if (strlen($first)> 0 && strlen($last) > 0){
						$messageName .= "Invalid characters in the name that you requested for $name <br />";
						global $err; $err = 1;
					}		
				}				
			}				
		}
		
		if ($err == 1){
			$messageName .= "Error while requesting name change for player<br/>";	
		}
		else $messageName .= "<br />Your request has been submitted for validation. <BR /> A member of our team will look at your request and validate your player names.";										
			
	}
	
	//stadium name changes
	if ($_POST['changeCNames']){
		$academy = $_SESSION['id_team'];
		$q = mysql_query("SELECT id, name FROM stadium WHERE id_team = $academy");
		while($row = mysql_fetch_row($q)){
			$courts[] = $row;	
		}
		//print_r($players);
		$messageCourt = '';
		$err = 0;
			
		foreach($courts as $court){
			$p = $court[0];
			$name = $court[1];			
			$new_name = $_POST['cName'][$p];
			$regex = "/^[a-zA-Z0-9_ ]{1,}$/";

			if (isset($new_name)){
				if (preg_match($regex,$new_name)  &&
				    strlen($new_name) < 30 ){

					$i = "INSERT INTO name_changes(id_user,id_entity,type,old_value,new_value,date_requested)
						VALUES('$id_user','$p','2','$name','$new_name',NOW())";
					if (!mysql_query($i)){
						global $err; $err = 1;	
						echo mysql_error();		
					}
					else
						$messageCourt .= "New name for $name has been submitted for validation. <br />";			
				}
				else {
					if (strlen($first)> 0 && strlen($last) > 0){
						$messageCourt .= "Invalid characters in the name that you requested for $name <br />";
						global $err; $err = 1;	
					}		
				}				
			}				
		}
		
		if ($err == 1){
			$messageCourt.= "Error while requesting name change for court<br/>";	
		}
		else $messageCourt .= "<br />Your request has been submitted for validation. <BR /> A member of our team will look at your request and validate your court names.";										
			
	}			
	
	
	
	
	
	
		$_SESSION['new_mail'] = $rf[0];

		$smarty->assign('season',$season);
		$smarty->assign('day',$day);
		$smarty->assign('idteam',$_SESSION['id_team']);
    		$smarty->assign('idleague',$_SESSION['id_league']);
		$smarty->assign('userid',$_SESSION['userid']);
		$smarty->assign('uname',$_SESSION['username']);
		$smarty->assign('new_mail',$_SESSION['new_mail']);
		$smarty->assign('cManager',$_SESSION['countryM']);
		$smarty->assign('member',$_SESSION['member']);
		$smarty->assign('credits',$_SESSION['credits']);
	
    		$smarty->assign('error',$error);
		$smarty->assign('message',$message);
		$smarty->assign('messageName',$messageName);
	        $smarty->assign('messageCourt',$messageCourt);			
		//$smarty->assign('userid',$userid);
    		$smarty->display('requestsMember.tpl');
	
}
else {
	header("Location:index.php");
}
?>