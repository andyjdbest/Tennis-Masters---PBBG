<?php

require_once 'common.php';
require_once 'DBconfig.php';
require_once 'checkTransfers.php';

session_start();
if (@$_SESSION['authenticated'] == 'true' & @$_SESSION['assigned'] == 1) {
	if ($_GET['academy']){
		$coachdata = array();
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
			if ($userid == $row[0]) {
				$own = 1;
				
				//fetch coach details
				$query = "SELECT c.id_coach, c.name_coach, c.age, l.name_coachlevel FROM coach AS c JOIN coach_level AS l ON c.id_level = l.id_coachlevel WHERE c.id_team = '$academy'";
				$r = mysql_query($query);
	
				while ($ar = mysql_fetch_array($r)) {	
						$coachdata[] = $ar;
				}
				
				
			}
			else { //user is not owner of academy so limited info
				$error = 'Cannot view another user\'s coaches';
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
		//$smarty->assign('message',$message);
		//$smarty->assign('userid',$userid);
		//$smarty->assign('playerdata',$playerdata);
		$smarty->assign('coachdata',$coachdata);
		$smarty->assign('own',$own);
    	$smarty->display('viewCoaches.tpl');
	}
}
else {
	header("Location:index.php");
}
?>