<?php

require_once 'common.php';
require_once 'DBconfig.php';

session_start();
if (@$_SESSION['authenticated'] == 'true' & @$_SESSION['assigned'] == 1) {
	
	if ($_POST['apply']) {
		if (ctype_digit($_POST['id']) == true) {
				
				$id = $_POST['id'];
				$user_id = $_SESSION['userid'];
				//echo $id;
				//check if user has already applied to the alliance
				$r = mysql_query("SELECT id_user FROM alliance_members WHERE id_alliance = $id AND id_user = $user_id AND status = 0 LIMIT 1");
				$row = mysql_fetch_row($r);
				
				//previous application
				if (isset($row[0])) {
						header("Location:viewAlliance.php?alliance=$id&message=Pending");
				}
				else {	
					//check is user belongs to an alliance
					$r = mysql_query("SELECT id_user FROM alliance_members WHERE 
					id_user = $user_id AND status = 2 LIMIT 1");
					$row = mysql_fetch_row($r);
					
					//previous application
					if (isset($row[0])) {
							header("Location:viewAlliance.php?alliance=$id&message=Fail");
					}
					else {	
						$insert = "INSERT INTO alliance_members (id_user,id_alliance,status,join_date) 
										VALUES ('$user_id','$id','0',NOW())";
					
						if (!(mysql_query($insert))) {
							$error = mysql_error();
							echo $error;	
							header("Location:viewAlliance.php?alliance=$id&message=Fail");
						}
						else {
							$r = mysql_query("SELECT u.username, a.id_team, l.leader_id
									FROM alliance_members AS m
									JOIN users AS u ON u.userid = m.id_user
									JOIN academy AS a ON a.id_user = u.userid
									JOIN alliance AS l ON m.id_alliance = l.id_alliance
									WHERE m.id_alliance = $id AND m.id_user = $user_id");
							
							$row = mysql_fetch_row($r);
							//echo 'Row ' . $row[0];	
							$username = $row[0]; 
							$team_id = $row[1];
							$leader = $row[2];		
								
							$note = "You have received an application from <a href=viewManagerInfo.php?academy=$team_id>$username</a> to join your team.
							<br /> You may choose to <a href=allianceApplicant.php?type=accept&id=$id&user=$user_id>accept</a> or 
							<a href=allianceApplicant.php?type=decline&id=$id&user=$user_id>decline</a>.";
							//$note = htmlentities($note);	
							//$note = mysql_real_escape_string($note);	
							//echo $note;		
						
							$insert = "INSERT INTO messages 
								(id_sender,id_receiver,date,subject,body) 
								VALUES ('$user_id', '$leader', NOW(),'Alliance Application','$note')";
							if (!(mysql_query($insert))) {
	             						$error = mysql_error();
								echo $error;
							}
							header("Location:viewAlliance.php?alliance=$id&message=Success");					
						}
					}	
				}			
			}
		else {	
				header("Location:viewAlliance.php?alliance=$id&message=Fail");
		}
	}

	else if ($_GET['type']){
		if (ctype_digit($_GET['id']) == true && ctype_digit($_GET['user']) == true) {
				$user = $_GET['user'];
				$id = $_GET['id'];
				
				if ($_GET['type'] == 'accept' || $_GET['type'] == 'decline'){
					if ($_GET['type'] == 'accept')	{
						$status = 2;
						$note = "Your application to join alliance <a href=viewAlliance.php?alliance=$id>$id</a> has been accepted.";
						//update alliance
						$update = "UPDATE alliance SET members = members + 1 WHERE id_alliance = $id";
						mysql_query($update);
					}
					else	{
						$status = 3;
						$note = "Your application to join alliance <a href=viewAlliance.php?alliance=$id>$id</a> has been declined.";
					} 
					//check if user has not joined any other alliance in the meanwhile:
					$r = mysql_query("SELECT id_user FROM alliance_members WHERE 
					id_user = $user AND status = 2 LIMIT 1");
					$row = mysql_fetch_row($r);
					
					//previous application
					if (isset($row[0])) {
						$update = "UPDATE alliance_members SET status = 3 WHERE id_alliance = $id AND id_user = $user AND status = 0";
						mysql_query($update);
						header("Location:viewAlliance.php?alliance=$id&message=Duplicate");
					}
					else {	
						//update the alliance_members table
						$update = "UPDATE alliance_members SET status = $status WHERE id_alliance = $id AND id_user = $user AND status = 0";
						mysql_query($update);		
						//send a note
						$insert = "INSERT INTO messages 
								(id_sender,id_receiver,date,subject,body) 
								VALUES ('1', '$user', NOW(),'Alliance Response','$note')";
						if (!(mysql_query($insert))) {
	             						$error = mysql_error();
								echo $error;
						}
						header("Location:viewAlliance.php?alliance=$id");
					}								
				}				
		}		
	}
	
	//withdraw
	else if ($_POST['withdraw']){
		if (ctype_digit($_POST['id']) == true) {
			$id = $_POST['id'];
			$user_id = $_SESSION['userid'];
			$update = "UPDATE alliance_members SET left_date = NOW(), status = '3' 
					WHERE id_user = '$user_id' AND id_alliance = '$id' AND status = 2";
			if (!(mysql_query($update))) {
				$error = mysql_error();
				//echo $error;	
				header("Location:viewAlliance.php?alliance=$id&message=WFail");
			}
			else {
				//update member count
				$update = "UPDATE alliance SET members = members - 1 WHERE id_alliance = $id";
				if (!(mysql_query($update))) {
					$error = mysql_error();
					//echo $error;	
					//header("Location:viewAlliance.php?alliance=$id&message=WFail");
				}
				else {
					$r = mysql_query("SELECT u.username, a.id_team, l.leader_id
								FROM alliance_members AS m
								JOIN users AS u ON u.userid = m.id_user
								JOIN academy AS a ON a.id_user = u.userid
								JOIN alliance AS l ON m.id_alliance = l.id_alliance
								WHERE m.id_alliance = $id AND m.id_user = $user_id");
					$row = mysql_fetch_row($r);
					$team_id = $row[1]; $username = $row[0];
					
					$note = "Your alliance member <a href=viewManagerInfo.php?academy=$team_id>$username</a> has withdrawn from the alliance.";
					
					$insert = "INSERT INTO messages 
						(id_sender,id_receiver,date,subject,body) 
						VALUES ('$user_id', '$leader', NOW(),'Alliance Application','$note')";
					if (!(mysql_query($insert))) {
             					$error = mysql_error();
						//echo $error;
					}
					else {
						header("Location:viewAlliance.php?alliance=$id&message=WSuccess");
					}
				}
				
			}
			
		}
	}					
}
else {
	header("Location:index.php");
}

?>