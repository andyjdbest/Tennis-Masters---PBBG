<?php

require_once 'common.php';
require_once 'DBconfig.php';
require_once 'checkTransfers.php';
session_start();
if (@$_SESSION['authenticated'] == 'true' & @$_SESSION['assigned'] == 1) {
	
if ($_GET['fixtureid'])
{
	$id = $_GET['fixtureid'];
	
	if (ctype_digit($id) === FALSE)
	{
		$error = 'Invalid input';
	}	
	else {		
			//$upcomingData = array();
			//$completedData = array();
			
			$userid = $_SESSION['userid'];	
			$team = $_SESSION['id_team'];
			
			check_tranfer($team);
			
			//fetch the fixtures data
			$query = mysql_query("SELECT f.id_fixture, f.round_date, ft.name_fixture, f.id_team1, t1.team_name AS team1, f.id_team2, 
					t2.team_name AS team2, c.name AS court, f.score,s.name AS stad
					FROM `fixtures` AS f
					JOIN fixture_type AS ft ON ft.id_fixture = f.fixture_type
					JOIN academy AS t1 ON t1.id_team = f.id_team1
					JOIN academy AS t2 ON t2.id_team = f.id_team2
					JOIN courttype AS c ON f.id_stadium = c.idcourttype
					JOIN stadium AS s ON f.id_stadium = s.id	
					WHERE f.id_fixture=$id LIMIT 1");
			$fixtureData[] = mysql_fetch_row($query); 
			
			
			$query = mysql_query("SELECT m.id_match, CONCAT(p1.firstname, ' ', p1.lastname) AS p1_name,m.id_player1, 
						CONCAT(p2.firstname, ' ', p2.lastname) AS p2_name,m.id_player2,m.score,m.id_court 
						FROM matches AS m JOIN players AS p1 ON p1.idplayer = m.id_player1 
						JOIN players AS p2 ON p2.idplayer = m.id_player2 
						WHERE m.id_fixture = $id ORDER BY m.id_match LIMIT 3");
			while ($row = mysql_fetch_array($query)) {
					$matchData[] = $row;
			}
					
			//split the score
			$teamScore = explode("-", $fixtureData[0][8]);
			$teamScore[1] = trim($teamScore[1],"#");
			if (isset($matchData)) {
				$i = -1;
				foreach ($matchData as $match) {
					$i += 1;
					//$temp = array();
					$temp[$i] = explode("#",$match[5]);			
						//$matchScore[$i][] = explode("-",$temp[0]);
				}
					//print_r($temp); echo "<BR />";		
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
	
	$smarty->assign('fixtureData',$fixtureData);
	$smarty->assign('matchData',$matchData);
	$smarty->assign('fixtureScore',$teamScore);
	$smarty->assign('matchScore',$temp);	
    $smarty->display('fixtures.tpl');
}
}

else {
	header("Location:index.php");
}

?>