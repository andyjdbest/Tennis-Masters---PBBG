<?php

require_once 'common.php';
require_once 'DBconfig.php';


session_start();
if (@$_SESSION['authenticated'] == 'true' & @$_SESSION['assigned'] == 1) {
	

	$userid = $_SESSION['userid'];
	$academy = $_SESSION['id_team'];
	
	
	$r = mysql_query("SELECT c.id_fixture,CONCAT(a.team_name, ' v ', b.team_name) AS fixture,c.round_date 
					FROM `fixtures` AS c 
					JOIN academy AS a 
					ON c.id_team1 = a.id_team JOIN academy AS b 
					ON c.id_team2 = b.id_team 
					WHERE c.fixture_type = 2 AND c.id_winner IS NULL AND (c.id_team2 = '$academy' || c.id_team1 = '$academy') ORDER BY c.round_date ASC ");
					
	while ($ob = mysql_fetch_array($r)) {
		$challengeA[] = $ob;
	}
	//remove challenges that have not responded.
	$today = date('Y-m-d H:i:s');
	$select = mysql_query("SELECT id_challenge,id_team1 FROM challenges WHERE `date` < '$today' AND status = 1");
	while ($row = mysql_fetch_row($select)) {
		$toGo[] = $row;
	}
	
	if (isset($toGo[0][0])) {
		print_r($toGo);
		foreach ($toGo as $tG) {
			$update = mysql_query("UPDATE challenges SET status = '0' WHERE id_challenge = {$tG[0]}");
			if (!(mysql_query($update))) {
 			 $error = mysql_error();
		 	// echo $error;
			}
			else {
				//send message to team 1 that challenge is removed due to no response
				$note = "Challenge {$tG[0]} is removed due to no timely response"; 
				$insert = "INSERT INTO messages 
						(id_sender,id_receiver,date,subject,body) 
					VALUES ('1', (SELECT id_user FROM academy WHERE id_team = {$tG[1]}) , NOW(),'ChallegeNotification','$note')";
				if (!mysql_query($insert))
						echo mysql_error(); 

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
	
	$s = mysql_query("SELECT c.id_challenge,c.id_team1,c.id_team2,c.date,c.id_stadium, a.team_name 
					FROM `challenges` AS c 
					JOIN academy AS a 
					ON c.id_team2 = a.id_team 
					WHERE c.status = 1 AND c.id_team1 = '$academy'");
	while ($ob = mysql_fetch_array($s)) {
		$challengeI[] = $ob;
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
	$smarty->assign('challengeAData',$challengeA);
	$smarty->assign('challengeIData',$challengeI);
    $smarty->display('viewChallenges.tpl');
	
}
else {
	header("Location:index.php");
}
?>