<?php

require_once 'common.php';
require_once 'DBconfig.php';
require_once 'checkTransfers.php';
session_start();
if (@$_SESSION['authenticated'] == 'true' & @$_SESSION['assigned'] == 1) {
	
if ($_GET['matchID'])
{
	$id = $_GET['matchID'];
	
	if (ctype_digit($id) === FALSE)
	{
		$error = 'Invalid input';
	}	
	else {		
			$userid = $_SESSION['userid'];	
			$team = $_SESSION['id_team'];
			
			check_tranfer($team);
			
			$query = mysql_query("SELECT m.id_match, CONCAT(p1.firstname, ' ', p1.lastname) AS p1_name,m.id_player1,		
								CONCAT(p2.firstname, ' ', p2.lastname) AS p2_name,m.id_player2,m.score,m.id_winner,c.name,
								a1.team_name AS a1_name, a1.id_team AS a1_id, a2.team_name AS a2_name, a2.id_team AS a2_id, 
								f.id_fixture,f.round_date, ft.name_fixture, f.fixture_type
								FROM matches AS m 
								JOIN players AS p1 ON p1.idplayer = m.id_player1 
								JOIN players AS p2 ON p2.idplayer = m.id_player2 
								JOIN fixtures AS f on f.id_fixture = m.id_fixture
								JOIN fixture_type AS ft ON ft.id_fixture = f.fixture_type		
								JOIN academy AS a1 ON a1.id_team = p1.id_team 
								JOIN academy AS a2 ON a2.id_team = p2.id_team
								JOIN courttype AS c ON c.idcourttype = m.id_court
								WHERE m.id_match = '$id' LIMIT 1");
			$matchData = mysql_fetch_array($query);
			//print_r($matchData);
			//split the score
			if (isset($matchData[0])) {
				$score = explode("#", $matchData[5]);
				//score contains the split of the set score. we need to split now on "-" to get individual score
				for($i=0;$i<3;$i++){
					if (isset($score[$i])) {
						$temp = explode("-",$score[$i]);
						$playerScore[0][$i] = $temp[0];
						$playerScore[1][$i] = $temp[1];
					}
				}
			}
			
			$query1 = mysql_query("SELECT firstServe,aces,doubleFaults,errors,winners FROM match_stats WHERE
						match_id = $matchData[0] AND (player_id = $matchData[2] OR player_id = $matchData[4])");
			while ($row = mysql_fetch_array($query1)){
				$statsData[] = $row;
			}
				
			//for time
			$day =  floor((mktime() - $season_start)/86400);
					
			$smarty->assign('season',$season);
			$smarty->assign('day',$day);
			
			$q = "SELECT COUNT(id) FROM `messages` WHERE id_receiver = {$_SESSION['userid']} AND `read` = 0 AND del_receiver = 0";
			$r = mysql_query($q);
			$rf = mysql_fetch_row($r);
			$_SESSION['new_mail'] = $rf[0];
		}
	$smarty->assign('idteam',$_SESSION['id_team']);
    $smarty->assign('idleague',$_SESSION['id_league']);
	$smarty->assign('uname',$_SESSION['username']);
	$smarty->assign('userid',$_SESSION['userid']);
	$smarty->assign('new_mail',$_SESSION['new_mail']);
    $smarty->assign('cManager',$_SESSION['countryM']);
	$smarty->assign('member',$_SESSION['member']);
	$smarty->assign('credits',$_SESSION['credits']);
	
	$smarty->assign('matchData',$matchData);
	$smarty->assign('statsData',$statsData);
	$smarty->assign('playerScore',$playerScore);	
    $smarty->display('viewMatchSummary.tpl');
}
}

else {
	header("Location:index.php");
}

?>