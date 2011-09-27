<?php

require_once 'common.php';
require_once 'DBconfig.php';
require_once 'checkTransfers.php';
session_start();
if (@$_SESSION['authenticated'] == 'true' & @$_SESSION['assigned'] == 1) {
	$userid = $_SESSION['userid'];	
	$team = $_SESSION['id_team'];
			
	check_tranfer($team);
if ($_POST['userName'])
{
	$userName = mysql_real_escape_string($_POST['userName']);
	//echo $userName;
		
	$query = mysql_query("SELECT a.id_team,a.team_name,u.username,u.userid FROM academy AS a 
			JOIN users AS u ON u.userid = a.id_user WHERE u.username LIKE '%$userName%'");
	while ($r = mysql_fetch_array($query)) {
		$resultData[] = $r;
	}
	//print_r($resultData);
	if (!isset($resultData)) {$message = 'No result found';}
	
}

else if ($_POST['leagueName'])
{
	$leagueName = mysql_real_escape_string($_POST['leagueName']);
	//echo $userName;
		
	$query = mysql_query("SELECT idleague,nameleague FROM league WHERE nameleague LIKE '%$leagueName%'");
	while ($r = mysql_fetch_array($query)) {
		$leagueData[] = $r;
	}
	//print_r($resultData);
	if (!isset($leagueData)) {$message = 'No result found';}
	
}

	$day =  floor((mktime() - $season_start)/86400);
        $smarty->assign('season',$season);
	$smarty->assign('day',$day);

	$smarty->assign('idteam',$_SESSION['id_team']);
    $smarty->assign('idleague',$_SESSION['id_league']);
	$smarty->assign('uname',$_SESSION['username']);
	$smarty->assign('userid',$_SESSION['userid']);
	//$smarty->assign('new_mail',$_SESSION['new_mail']);
	$smarty->assign('cManager',$_SESSION['countryM']);
	$smarty->assign('member',$_SESSION['member']);
	$smarty->assign('credits',$_SESSION['credits']);    
	
	$smarty->assign('message',$message);
	$smarty->assign('resultData',$resultData);
	$smarty->assign('leagueData',$leagueData);
    $smarty->display('search.tpl');
}
else {
	header("Location:index.php");
}

?>