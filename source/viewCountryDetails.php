<?php

require_once 'common.php';
require_once 'DBconfig.php';
require_once 'checkTransfers.php';

session_start();
if (@$_SESSION['authenticated'] == 'true' && @$_SESSION['assigned'] == 1) {
		
	$cID = 1;
	if ($_GET['country']){
		if (ctype_digit($_POST['country']) == false) {
			$error = "Invalid input";
		}
		else {
			$cID = $_POST['country'];
		}
	}
	if ($_POST['countryID']){
		if (ctype_digit($_POST['countryID']) == false) {
			$error = "Invalid input";
		}
		else {
			$cID = $_POST['countryID'];
		}
	}
	$query = mysql_query("SELECT idleague,nameleague FROM league WHERE idcountry = $cID ORDER BY league_pos ASC");
	while ($row = mysql_fetch_array($query)) {
		$leaguedata[] = $row;
	}
	//print_r($leaguedata);
	
	$query = mysql_query("SELECT idcountry,countryname FROM countries");
	while ($row = mysql_fetch_array($query)) {
		$countryID[] = $row[0];
		$countryName[] = $row[1];
	}
	
	
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
	
    	$smarty->assign('leagueData',$leaguedata);
		$smarty->assign('cID',$cID);
		$smarty->assign('countryID',$countryID);
		$smarty->assign('countryName',$countryName);
	    $smarty->display('viewCountryDetails.tpl');
}
else {
	header("Location:index.php");
}
?>