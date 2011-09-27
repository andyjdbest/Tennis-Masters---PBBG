<?php
/*
 * Challenge Status = 1 - Issued, 2 - Accepted, 0 - Declined
*/ 

require_once 'common.php';
require_once 'DBconfig.php';
//require_once 'checkTransfers.php';


session_start();
if (@$_SESSION['authenticated'] == 'true' & @$_SESSION['assigned'] == 1) {

if ($_GET['type'])
{
	$type = $_GET['type'];
	$id = $_GET['challenge']; 
	
	if ((ctype_alpha($type) === FALSE) || (ctype_digit($id) == FALSE))
	{
		$error = 'Invalid inputs';
	}	
	else {		
		$userid = $_SESSION['userid'];
		$academy = $_SESSION['id_team'];
		//check_tranfer($academy);
		
		//select challenge to verify if academy is team2 n status is 1			
		$find = mysql_query("SELECT status,id_team1,date,id_stadium FROM challenges 
					WHERE id_challenge = $id AND id_team2 = $academy");
		$r = mysql_fetch_row($find);
		
		//print_r($r);
		if (isset($r)){
			if ($r[0] == 1) {
				if ($type == "accept") {
					//check if player has not accepted a challenge before
					$c = mysql_query("SELECT date FROM challenges 
							WHERE (id_team2 = $academy OR id_team1 = $academy) AND status = 2");
					while ($row = mysql_fetch_array($c)) {
						$dates[] = $row;
					}
					$existing = 0;
					//echo 'here';
					if (isset($dates)) {	
						foreach($dates as $date) {
							if ($date == $r[2]) {
								$existing = 1;
							} 
						}
					}
					//echo $existing;
					if ($existing == 0)	{
						$u = "UPDATE challenges SET status = 2 WHERE id_challenge = $id AND status = 1";
						if (!(mysql_query($u))) {
             						$error = mysql_error();
							echo $error;
						}
						else { 
							//insert challenge into fixtures
							//print_r($r);
							$date = $r[2];
							$team = $r[1];
							$stadium = $r[3];
							$insert = "INSERT INTO fixtures (fixture_type,round_date,id_team1,id_team2,id_stadium,season)
								VALUES ('2','$date','$team','$academy','$stadium','$season')";
							if (!(mysql_query($insert))) {
								$error = mysql_error();
								echo $error;
							}
							//send message to team 1, that challenge is accepted
							$note = "Challenge $id is accepted"; 
							$insert = "INSERT INTO messages 
								(id_sender,id_receiver,date,subject,body) 
								VALUES ('1', (SELECT id_user FROM academy WHERE id_team = {$r[1]}) ,  NOW(),'Challenge Notification','$note')";
							mysql_query($insert); 
							$message = 'Challenge accepted.';
							
							$u = "UPDATE challenges SET status = 0 WHERE date = '$date' AND status = 1 AND (id_team1 = $academy OR id_team2 = $academy) OR 
								(id_team1 = $team OR id_team2 = $team)";
							if (!(mysql_query($u))) {
             							$error = mysql_error();
								echo $error;
							}
						}
					}
					if ($existing == 1) $type = 'decline';
				}
				if ($type == "decline") {
					$u = "UPDATE challenges SET status = '0' WHERE id_challenge = $id";
					if (!(mysql_query($u))) {
             					$error = mysql_error();
						echo $error;
					}
					else { 
						//send message to team 1 that challenge is declined
						$note = "Challenge $id is declined"; 
						$insert = "INSERT INTO messages 
								(id_sender,id_receiver,date,subject,body) 
								VALUES ('1', (SELECT id_user FROM academy WHERE id_team = {$r[1]}) , NOW(),'Challenge Notification','$note')";
						mysql_query($insert); 
						$message = 'Challenge declined.';
					}
				}
			}
		}
	
	
		
	
	}
	$s = mysql_query("SELECT c.id_challenge,c.id_team1,c.id_team2,c.date,c.id_stadium, a.team_name 
					FROM `challenges` AS c 
					JOIN academy AS a 
					ON c.id_team1 = a.id_team 
					WHERE c.status = 1 AND c.id_team2 = '$academy'");
		while ($ob = mysql_fetch_array($s)) {
			$challenge[] = $ob;
		}
	$day =  floor((mktime() - $season_start)/86400);
	
	$q = "SELECT COUNT(id) FROM `messages` WHERE id_receiver = {$_SESSION['userid']} AND `read` = 0 AND del_receiver = 0";
	$r = mysql_query($q);
	$rf = mysql_fetch_row($r);
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
    
	$smarty->assign('challengeData',$challenge);
	$smarty->assign('message',$message);
    $smarty->display('viewChallenges.tpl');
   }
}
else {
	header("Location:index.php");
}

?>