<?php

require_once 'common.php';
require_once 'DBconfig.php';
require_once 'checkTransfers.php';

session_start();
if (@$_SESSION['authenticated'] == 'true' & @$_SESSION['assigned'] == 1) {
	
	$error = '';
	$message = '';
	if ($_POST['setTraining']){
		
		$skill = array(Rest,Serve,Forehand,Backhand,Volley,Stamina,Consistency, Power, Speed);
		$playerdata = $_POST['player'];
		$coachdata = $_POST['coach'];
		$skilldata = $_POST['skill'];
		
		//print_r($coachdata);
		$team_id = $_SESSION['id_team'];
		check_tranfer($team_id);
		//fetch all coaches belonging to user
		$s = mysql_query("SELECT id_coach FROM coach WHERE id_team = '$team_id'");
		
		while ($r = mysql_fetch_row($s)) {
			$team_coach[] = $r[0];
		}
		//print_r($team_coach);
		
		$s = mysql_query("SELECT idplayer FROM players WHERE id_team = '$team_id'");
		while ($r = mysql_fetch_row($s)) {
			$team_player[] = $r[0];
		}	
		
		$i = 0;
		//$assigned_coach = array();
		foreach($playerdata as $p) {
			
			$s = $skilldata[$i];
		
			if ($s > 0 && $s < 9) //check if skill is in the skill array and is not Rest = 0 
			{		
				$trainSkill = $skill[$s];
				if (in_array($p, $team_player)) //check if player id is an academy player
				{	
					$coach = $coachdata[$i];
					
					if (in_array($coach,$team_coach) || $coach == 0) //check if coach id is an academy coach
					{ 
						$count = array_count_values($coachdata);	
						if ($count[$coach] == 1) // coach is not assigned for the week.
						{
							//print 'Valid player-coach combination';
							$ok = 1;
														
			//				print_r($assigned_coach);
						}
         	//			print_r($assigned_coach);
						else {
							$error = 'Coach already assigned.';
						//print $error;
						}
					}
					else {
						$error = 'Invalid coach error';
						//print $error;
					}
				}
				else {
					$error = 'Invalid player error';
					print $error;
				}
			}
			
			
			
			$i = $i + 1;
		}
		
		
		if ($ok == 1 && $error == '')
		{	
			$i = 0;
			//$assigned_coach = array();
			foreach($playerdata as $p) {
			
				$s = $skilldata[$i];
				$trainSkill = $skill[$s];
				$insert = "INSERT INTO training_data (id_team,id_player,id_coach,skill,week) 
					VALUES ('$_SESSION[id_team]','$p','$coachdata[$i]','$trainSkill',NOW()) 
					ON DUPLICATE KEY UPDATE id_coach ='$coachdata[$i]', skill='$trainSkill', week=NOW()";
				if (!mysqli_query($conn,$insert)) {
				//print 'Error while adding training details.' . mysql_error();
				$error = 'Error while adding training details.' . mysql_error();
				}
				
				$i = $i + 1;
			}
		}

		
		if ( $error == ''){
			$message = 'Added Training';
		}
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
	
	$smarty->assign('errorSet',$error);
	$smarty->assign('messageSet',$message);
	$smarty->display('setTraining.tpl');
}
else {
	header("Location:index.php");
}
?>