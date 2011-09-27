<?php

require_once 'common.php';
require_once 'DBconfig.php';
require_once 'checkTransfers.php';
session_start();
if (@$_SESSION['authenticated'] == 'true' & @$_SESSION['assigned'] == 1) {
	
if ($_GET['cup'])
{
	$cup = $_GET['cup'];
	if (ctype_digit($cup) === FALSE)
	{
		$error = 'Invalid inputs';
	}	
	else {		
		$userid = $_SESSION['userid'];	
		$team = $_SESSION['id_team'];
			
		check_tranfer($team);
		//fetch the fixtures data
		$select = mysql_query("SELECT f.round_date, f.round, m.id_match, 
			CONCAT( p1.firstname, ' ', p1.lastname, ' v ', p2.firstname, ' ', p2.lastname ) AS game, c.name AS court, m.id_player1, m.id_player2,
			CONCAT( p1.firstname, ' ', p1.lastname) AS p1Name, CONCAT( p2.firstname, ' ', p2.lastname) AS p2Name
			FROM `matches` AS m
			JOIN fixtures AS f ON f.id_fixture = m.id_fixture
			JOIN fixture_type AS ft ON ft.id_fixture = f.fixture_type
			JOIN players AS p1 ON p1.idplayer = m.id_player1
			JOIN players AS p2 ON p2.idplayer = m.id_player2
			JOIN courttype AS c ON m.id_court = c.idcourttype
			WHERE f.fixture_type = '$cup'");
		while ($row = mysql_fetch_array($select)) {
			$fixtures[] = $row;
		}
		
		if (isset($fixtures[0][0])){
			foreach($fixtures as $fixture){
				if ($fixture['round'] == 0){
					$round1[] = $fixture;
				}
				else if ($fixture['round'] == 1){
					$round2[] = $fixture;
				}
				else if ($fixture['round'] == 2){
					$round3[] = $fixture;
				}
				else if ($fixture['round'] == 3){
					$round4[] = $fixture;
				}
				else if ($fixture['round'] == 4){
					$round5[] = $fixture;
				}
				else if ($fixture['round'] == 5){
					$round6[] = $fixture;
				}
			}
			$onGoing = 1;
		}
		
		//print_r($round1);
		
		
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
	
	$smarty->assign('onGoing', $onGoing);
	$smarty->assign('round1', $round1);
	$smarty->assign('round2', $round2);
	$smarty->assign('round3', $round3);
	$smarty->assign('round4', $round4);
	$smarty->assign('round5', $round5);
	$smarty->assign('round6', $round6);
    $smarty->display('viewCup.tpl');
}
}
else {
	header("Location:index.php");
}
?>