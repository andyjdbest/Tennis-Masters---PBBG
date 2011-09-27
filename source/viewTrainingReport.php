<?php

require_once 'common.php';
require_once 'DBconfig.php';
require_once 'checkTransfers.php';

session_start();
if (@$_SESSION['authenticated'] == 'true' & @$_SESSION['assigned'] == 1 || (@$_SESSION['admin'] === 'true')) {
		
	if ($_GET['academy']){
		$own = 0;
		if (ctype_digit($_GET['academy']) == false) {
			$error = "Invalid input";
		}
		else {
			$academy = $_GET['academy'];
			$userid = $_SESSION['userid'];
			
			check_tranfer($academy);
			
			//check if the user owns the academy
			$query = "SELECT id_user FROM academy WHERE id_team = '$academy'";
			$r = mysql_query($query);	
			$row = mysql_fetch_row($r);
			if ($userid == $row[0] || @$_SESSION['admin'] === 'true') {
				$own = 1;
				//fetch required player report details 
				if ($_SESSION['member'] == 1){
					$query = "SELECT r.id_player, CONCAT(p.firstname, ' ', p.lastname) AS playername, r.skill, r.update, DATE(r.week) as week 
						FROM training_report AS r JOIN players AS p ON p.idplayer = r.id_player 
						WHERE r.id_team = '$academy'";
				}
				else {
				$query = "SELECT r.id_player, CONCAT(p.firstname, ' ', p.lastname) AS playername, r.skill, r.update, DATE(r.week) as week 
						FROM training_report AS r JOIN players AS p ON p.idplayer = r.id_player 
						WHERE r.id_team = '$academy' AND DATEDIFF(CURDATE(),r.week) < 28";
				}
				$r = mysql_query($query);
	
				while ($ob = mysql_fetch_array($r)) {
		   				$reportData[] = $ob;
    				}
    				if (!isset($reportData)) { $error = 'Your coaches have not noticed a marked improvement in any of your players. What a shame!'; }
			}
			else { //user is not owner of academy so limited info
				$error = 'Cannot view another user\'s training details';
    			}
		} // end else for valid academy
	
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
	
    		$smarty->assign('error',$error);
		
		$smarty->assign('reportData',$reportData);
		$smarty->assign('own',$own);
    		$smarty->display('viewTrainingReport.tpl');
	}
}
else {
	header("Location:index.php");
}
?>