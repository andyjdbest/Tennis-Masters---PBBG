<?php
//to display the transfer market search feature
require_once 'common.php';
require_once 'DBconfig.php';

session_start();
if (@$_SESSION['authenticated'] == 'true' & @$_SESSION['assigned'] == 1) {
			
		$age = array(17,18,19,20,21,22,23,24,25,26,27,28,29,30);
		$stat = range(1,15);
		$day =  floor((mktime() - $season_start)/86400);
		
		$smarty->assign('season',$season);
		$smarty->assign('day',$day);
		$smarty->assign('idteam',$_SESSION['id_team']);
    	$smarty->assign('idleague',$_SESSION['id_league']);
		$smarty->assign('userid',$_SESSION['userid']);
		$smarty->assign('uname',$_SESSION['username']);
		$smarty->assign('new_mail',$_SESSION['new_mail']);
		$smarty->assign('cManager',$_SESSION['country']);
		$smarty->assign('member',$_SESSION['member']);
		$smarty->assign('credits',$_SESSION['credits']);
	
    	$smarty->assign('age',$age);
		$smarty->assign('stat',$stat);
    	$smarty->display('viewTransferMarket.tpl');
	
}
else {
	header("Location:index.php");
}

?>