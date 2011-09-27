<?php

require_once 'common.php';
require_once 'DBconfig.php';


function checkTacticSet($tacticData,$fixID,$academyID){
	//print_r($tacticData);
	if (isset($tacticData[0][0])){
	foreach($tacticData as $ts) {	
		//echo "$ts[0] = $academyID, $fixID = $ts[1]";
		if ($fixID == $ts[0] && $ts[1] == $academyID) {
			return 1;
		}
	}
	}
	return 0;
}

session_start();
if (@$_SESSION['authenticated'] == 'true' & @$_SESSION['assigned'] == 1) {
	
if ($_GET['academy'])
{
	$academy = $_GET['academy'];
	
	if (ctype_digit($academy) === FALSE)
	{
		$error = 'Invalid inputs';
	}	
	else {		
			$upcomingData = array();
			$completedData = array();
			
			$userid = $_SESSION['userid'];	
			$team = $_SESSION['id_team'];
			
			
			//fetch the fixtures data
			$query = "SELECT f.id_fixture, f.round_date, ft.name_fixture, CONCAT( t1.team_name, ' v ', t2.team_name ) AS fixture , 
					c.name AS court, f.id_winner
					FROM `fixtures` AS f
					JOIN fixture_type AS ft ON ft.id_fixture = f.fixture_type
					JOIN academy AS t1 ON t1.id_team = f.id_team1
					JOIN academy AS t2 ON t2.id_team = f.id_team2
					JOIN courttype AS c ON f.id_stadium = c.idcourttype
					WHERE (f.id_team1 = '$academy' OR f.id_team2 = '$academy') AND f.fixture_type < 3 AND f.season = '$season'
					GROUP BY f.id_fixture ORDER BY f.round_date";
			$r = mysql_query($query);
			
			while ($ob = mysql_fetch_array($r)) {
				   $fixturedata[] = $ob;
			}
			
			//check if fixture is completed by checking id_winner
			if (isset($fixturedata[0][0])){
			foreach($fixturedata as $fixture) {
				if ($fixture[5] > 0) {
					$completedData[] = $fixture;
				}
				else {
					$upcomingData[] = $fixture;
				}
			}
			}
			
			$query = "SELECT m.id_fixture, m.id_team FROM match_order AS m JOIN fixtures AS f ON f.id_fixture = m.id_fixture 
					WHERE (f.id_team1 = '$academy' OR f.id_team2 = '$academy') AND f.fixture_type < 3 AND f.season = '$season'
					ORDER BY f.round_date";
			$r = mysql_query($query);
			
			while ($row = mysql_fetch_array($r)) {
				$tacticdata[] = $row;
			}
			
			
			foreach($upcomingData as $up) {
				if (checkTacticSet($tacticdata,$up[0],$academy) == 1) {
					$tacticSet[] = 1;
				}
				else {
					$tacticSet[] = 0;
				}				
			}
			
			
			//print_r($tacticSet);
			
			//fetch required players ids:
			$query = "SELECT idplayer FROM players WHERE id_team = $team";
			$r = mysql_query($query);
	
			while ($ob = mysql_fetch_array($r)) {
				$playerids[] = $ob[0];
			}

			//for player fixtures:
			$query = mysql_query("SELECT f.round_date, ft.name_fixture, m.id_match, 
					CONCAT( p1.firstname, ' ', p1.lastname, ' v ', p2.firstname, ' ', p2.lastname ) AS game, c.name AS court, m.id_player1, m.id_player2,
					CONCAT( p1.firstname, ' ', p1.lastname) AS p1Name, CONCAT( p2.firstname, ' ', p2.lastname) AS p2name, m.id_winner, f.round
								FROM `matches` AS m
								JOIN fixtures AS f ON f.id_fixture = m.id_fixture
								JOIN fixture_type AS ft ON ft.id_fixture = f.fixture_type
								JOIN players AS p1 ON p1.idplayer = m.id_player1
								JOIN players AS p2 ON p2.idplayer = m.id_player2
								JOIN courttype AS c ON m.id_court = c.idcourttype
								WHERE (p1.id_team ='$academy' OR p2.id_team ='$academy') AND f.fixture_type > 3 AND f.season = '$season'");
			
			while ($arr = mysql_fetch_array($query)) {
				$tfixturedata[] = $arr;
			}
			
			if (isset($tfixturedata[0][0])){
				//$pfixturedata = $tfixturedata;
				//$index = 0;
				foreach($tfixturedata as $pf){
					//completed player fixtures
					if ($pf['id_winner'] > 0){
						$cPlayers[] = $pf;
					}
					else {
						$upPlayers[]= $pf;	
					}
					
				}
			}
			
			//process upcoming player fixtures... 
			if (isset($upPlayers[0][0])){
				$pfixturedata = $upPlayers;
				$index = 0;
				foreach($upPlayers as $pf){
					//if both players in the match belong to the academy
					if (in_array($pf['id_player1'],$playerids) && in_array($pf['id_player2'],$playerids)){
							
					$pfixturedata[$index]['playerID1'] = $pf['id_player1'];
					$pfixturedata[$index]['playerName1'] = $pf[7];
					$temp = $pf;
					$temp['playerID2'] = $pf['id_player2'];
					$temp['playerName2'] = $pf['p2name'];
					$pfixturedata[] = $temp;
					}
					elseif (in_array($pf['id_player1'],$playerids)) {
						$pfixturedata[$index]['playerID1'] = $pf['id_player1'];
						$pfixturedata[$index]['playerName1'] = $pf[7];
					}
					elseif (in_array($pf['id_player2'],$playerids)) {
						$pfixturedata[$index]['playerID2'] = $pf['id_player2'];
						$pfixturedata[$index]['playerName2'] = $pf['p2name'];
					}
					//print_r($pfixturedata);
					$index += 1; 
				}
			}
			//print_r($pfixturedata);
			
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
	
	$smarty->assign('upcoming',$upcomingData);
	$smarty->assign('completed',$completedData);
	$smarty->assign('cPlayers',$cPlayers);
	$smarty->assign('uPlayers',$pfixturedata);
	$smarty->assign('ts',$tacticSet);	
	$smarty->assign('id_team',stripHTML($academy));
    	$smarty->display('viewFixtures.tpl');
}
}
else {
	header("Location:index.php");
}
?>