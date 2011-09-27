<?php

require_once 'common.php';
require_once 'DBconfig.php';

session_start();
if (@$_SESSION['authenticated'] == 'true' & @$_SESSION['assigned'] == 1) {
	
	if ($_GET['user']){
	$manager_data = array();	
	if (ctype_digit($_GET['user']) == false) {
		$error = "Invalid input";
	}
	else {
	$id = $_GET['user'];
	$userid = $_SESSION['userid'];
	
    	//fetch the manager details
	$query = "SELECT u.username, 
				DATE(a.date_join) AS date, t.id_team, t.team_name, t.id_country,c.countryshort, u.userid 
				FROM `users` AS u 
				JOIN user_academy AS a ON u.userid = a.id_user 
				JOIN academy AS t on a.id_academy = t.id_team 
				JOIN countries AS c ON c.idcountry = t.id_country 
				WHERE u.userid = '$id' ORDER BY a.date_join DESC LIMIT 1";
	$r = mysql_query($query);
	$row = mysql_fetch_row($r);
	
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
	
    //$smarty->assign('managerInfo',$manager_data);
	$smarty->assign('manager_name',$row[0]);
	$smarty->assign('date',$row[1]);
	$smarty->assign('academy_id',$row[2]);
	$smarty->assign('academy',$row[3]);
	$smarty->assign('country',$row[5]);
	$smarty->assign('id_manager',$row[6]);
	
	$smarty->display('viewManagerInfo.tpl');
}
}
else {
	header("Location:index.php");
}
?>