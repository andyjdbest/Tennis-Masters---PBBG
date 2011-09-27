<?php

require_once 'common.php';
require_once 'DBconfig.php';

session_start();
if (@$_SESSION['authenticated'] == 'true' & @$_SESSION['assigned'] == 1) {
	
	if ($_GET['message']) {
		$message = stripHTML($_GET['message']);
	}
	else {
		$team = $_SESSION['id_team'];
		$trial_date = date('Y-m-d H:i:s', strtotime('previous Tuesday' . '2 hours'));
		$trial_day = strtotime($trial_date);
		//fetch prev pull date from the trial table
		$query = mysql_query("SELECT pull_date FROM player_trials WHERE id_team = '$team' ORDER BY id_trial DESC LIMIT 1");
		$row = mysql_fetch_row($query);
	
		$can_pull = 0;
		if (isset($row[0])) {	
			$pull_date = strtotime($row[0]);
			$week = floor((mktime() - $trial_start)/604800) + 1 ;
			$this_date = date('Y-m-d H:i:s', strtotime($week . ' Tuesday 2 hours', $trial_start));
			$this_day = strtotime($this_date);
			if ($pull_date < $this_day) {
				$can_pull = 1;
			}
			else {
				$week += 1;
				$next_date = date('Y-m-d H:i:s', strtotime($week . ' Tuesday 2 hours', $trial_start));
				$error ="Your next player trial can be scheduled after $next_date <br />";	
			}
		}
		else { $can_pull = 1; }
		//echo $can_pull;
	}
	//for time
	$day =  floor((mktime() - $season_start)/86400);
			
	$smarty->assign('season',$season);
	$smarty->assign('day',$day);
	
	$smarty->assign('idteam',$_SESSION['id_team']);
    $smarty->assign('idleague',$_SESSION['id_league']);
	$smarty->assign('uname',$_SESSION['username']);
	$smarty->assign('userid',$_SESSION['userid']);
	$smarty->assign('new_mail',$_SESSION['new_mail']);
    $smarty->assign('cManager',$_SESSION['country']);
	$smarty->assign('cManager',$_SESSION['countryM']);
	
	$smarty->assign('countries',array('USA','ENG', 'FRA', 'AUS'));	
	$smarty->assign('message',$message);
	$smarty->assign('can_call',$can_pull);
	$smarty->assign('next',$error);
    $smarty->display('playerTrials.tpl');

}

else {
	header("Location:index.php");
}

?>N