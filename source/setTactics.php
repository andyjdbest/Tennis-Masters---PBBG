<?php

require_once 'common.php';
require_once 'DBconfig.php';
require_once 'checkTransfers.php';

session_start();
if (@$_SESSION['authenticated'] == 'true' & @$_SESSION['assigned'] == 1) {
	
	$error = '';
	$message = '';
	if ($_POST['setTactic']){
		$playerdata = $_POST['player'];
		$tacticdata = $_POST['tactic'];
		$aggdata = $_POST['agg'];
        $setDefault = $_POST['setDefault']; 

		//print_r($skilldata);
		$team_id = $_SESSION['id_team'];
		$fixtureid = $_SESSION['fixtureid'];
		check_tranfer($team_id);
		
		//fetch all players belonging to user
		$s = mysql_query("SELECT idplayer FROM players WHERE id_team = '$team_id'");
		while ($r = mysql_fetch_row($s)) {
			$team_player[] = $r[0];
		}
		
		//fetch number of aggression tactics
		$a = mysql_query("SELECT count(id) FROM tacticagg");
		$r = mysql_fetch_row($a);
		$max_agg = $r[0];
		
		
		$t = mysql_query("SELECT COUNT(idtactictype) FROM `tactictype`");
		$r = mysql_fetch_row($t);
		$max_tactic = $r[0];
	
		
		$i =0;
		foreach($playerdata as $p) {
			if ($i < 3)
			{
				if (in_array($p, $team_player)) //check if player id is an academy player
				{
					$count = array_count_values($playerdata);	
					if ($count[$p] == 1) // player is not assigned for the match.
					{
						if ($tacticdata[$i] > 0 && $tacticdata[$i] <= $max_tactic) //tactic is valid
						{
							if ($aggdata[$i] > 0 && $aggdata[$i] <= $max_agg) //valid agg set
							{
								$ok = 1;
							} 
							else {$error = 'Invalid aggression set.';}
						}
						else {$error = 'Invalid tactic set.'; }
					}
					else {$error = 'Player can play only 1 match per round.'; }
				}
				else {
					$error = 'Player does not belong to academy' . $p; 
				}
				$i = $i + 1;
			}
		}
		//echo $setDefault;
		if ($setDefault == 1) {					
			$update = "UPDATE match_order SET defaultT = 0 WHERE id_team = $team_id";
			if (!mysqli_query($conn,$update)) {
				$error = 'Error while adding tactics.' . mysqli_error($conn);
			}
		}
		$i = 0;
		if (($ok == 1) && ($error == '')) {
			foreach($playerdata as $p) {
				if ($i < 3)
				{
if ($setDefault == 1) {					
$insert = "INSERT INTO match_order (id_fixture,id_team,number,id_player,id_tactic,id_agg,defaultT) VALUES ($fixtureid, $team_id, $i+1,$p,'{$tacticdata[$i]}','{$aggdata[$i]}',1)
											ON DUPLICATE KEY UPDATE id_player =$p, id_tactic='{$tacticdata[$i]}', id_agg='{$aggdata[$i]}', defaultT = 1";
}
else {
$insert = "INSERT INTO match_order (id_fixture,id_team,number,id_player,id_tactic,id_agg,defaultT) VALUES ($fixtureid, $team_id, $i+1,$p,'$tacticdata[$i]','$aggdata[$i]',0)
											ON DUPLICATE KEY UPDATE id_player =$p, id_tactic='$tacticdata[$i]', id_agg='$aggdata[$i]', defaultT = 0";
}

					if (!mysqli_query($conn,$insert)) {
						//print 'Error while adding tactics details.' . mysql_error();
						$error = 'Error while adding tactics.' . mysqli_error($conn);
					}
					
					$i = $i + 1;
				}
			}

		}
        	
	
		if ( $error == ''){
			$message = 'Match Tactics Set';
		}
	}
	
	elseif ($_POST['setKTactic']){
		$player = $_POST['player'];
		$tacticdata = $_POST['tactic'];
		$aggdata = $_POST['agg'];
        //$setDefault = $_POST['setDefault']; 

		$team_id = $_SESSION['id_team'];
		$matchid = $_SESSION['matchid'];
		check_tranfer($team_id);
		
		//check if player belongs to academy
		$s = mysql_query("SELECT id_team FROM players WHERE idplayer = '$player' LIMIT 1");
		$r = mysql_fetch_row($s);
		
		if ($team_id == $r[0]) {
			//academy owns player
			//fetch number of aggression tactics
			$a = mysql_query("SELECT count(id) FROM tacticagg");
			$r = mysql_fetch_row($a);
			$max_agg = $r[0];
		
			$t = mysql_query("SELECT COUNT(idtactictype) FROM `tactictype`");
			$r = mysql_fetch_row($t);
			$max_tactic = $r[0];
			
			if ($tacticdata > 0 && $tacticdata <= $max_tactic) //tactic is valid
			{
				if ($aggdata > 0 && $aggdata <= $max_agg) //valid agg set
				{
					$insert = "INSERT INTO kmatch_order (id_match,id_team,id_player,id_tactic,id_agg) VALUES ($matchid, $team_id,$player,'$tacticdata','$aggdata')
											ON DUPLICATE KEY UPDATE id_tactic='$tacticdata', id_agg='$aggdata'";
					if (!mysqli_query($conn,$insert)) {
						//print 'Error while adding tactics details.' . mysql_error();
						$error = 'Error while adding tactics.' . mysqli_error($conn);
					}
				} 
				else {$error = 'Invalid aggression set.';}
			}
			else {$error = 'Invalid tactic set.'; }
			
		}
		else { $error = 'Player does not belong to academy'; }
		
		if ( $error == ''){
			$message = 'Match Tactics Set';
		}
	}
	
	//set the court for the fixture
	elseif ($_POST['setCourt']){
		$court = $_POST['court'];
		
		$team_id = $_SESSION['id_team'];
		$fixtureid = $_SESSION['fixtureid'];
		check_tranfer($team_id);
		
		if ($court > 0 && $court < 3) {
			$query = mysql_query("SELECT round_date,id_team1,fixture_type FROM fixtures WHERE id_fixture = $fixtureid LIMIT 1");
			$row = mysql_fetch_row($query);
			
			//change is permitted only 2 days before game
			$diff = floor((strtotime($row[0]) - mktime())/86400);
			if ($diff >= 2 && $row[1] == $team_id && $row[2] == 1) {
				$update = "UPDATE fixtures SET stad_no = $court, 
						id_stadium = (SELECT court_type FROM stadium WHERE id_team = $team_id AND stad_no = $court) 
						WHERE id_fixture = $fixtureid";
				//echo $update;
				if (!(mysql_query($update))) {
					$error = 'Error updating the fixtures';
				}
				
			}
			else {$error = 'Deadline for choosing your court has passed';}
		}
		else { $error = 'Invalid stadium specified';}
		
		if ( $error == ''){
			$message = 'Court changed successfully';
		}
	}
	
	$q = "SELECT COUNT(id) FROM `messages` WHERE id_receiver = {$_SESSION['userid']} AND `read` = 0 AND del_receiver = 0";
	$r = mysql_query($q);
	$rf = mysql_fetch_row($r);
	$_SESSION['new_mail'] = $rf[0];
	
	$day =  floor((mktime() - $season_start)/86400);
		
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
	$smarty->display('setTactics.tpl');
}
else {
	header("Location:index.php");
}
?>