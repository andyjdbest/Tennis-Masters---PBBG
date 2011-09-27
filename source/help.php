<?php

	require_once 'common.php';
	require_once 'DBconfig.php';

        session_start();
		$a = mysqli_query($conn,"SELECT (`iduser`),`time`,NOW(),TIMEDIFF(NOW(),time) FROM `logins` WHERE TIMEDIFF(NOW(),time) < '00:10:00' GROUP BY iduser");
		$users = mysqli_affected_rows($conn);
		
		$day =  floor((mktime() - $season_start)/86400);
		
		if (isset($_SESSION['userid'])) {
			$loggedin = 1;
		}
		
        $smarty->assign('users', $users);
		$smarty->assign('season',$season);
		$smarty->assign('day',$day);
		$smarty->assign('loggedin',$loggedin);
		$smarty->assign('uname',$_SESSION['username']);
		$smarty->assign('idteam',$_SESSION['id_team']);
    	$smarty->assign('idleague',$_SESSION['id_league']);
		$smarty->assign('userid',$_SESSION['userid']);
		$smarty->assign('cManager',$_SESSION['countryM']);
		$smarty->assign('member',$_SESSION['member']);
		$smarty->assign('credits',$_SESSION['credits']);
		
        $smarty->display('help.tpl');
 
?>