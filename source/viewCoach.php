<?php

require_once 'common.php';
require_once 'DBconfig.php';
require_once 'checkTransfers.php';

session_start();
if (@$_SESSION['authenticated'] == 'true' & @$_SESSION['assigned'] == 1) {
	if ($_GET['coachID']){
		$coachdata = array();
		$own = 0;
		if (ctype_digit($_GET['coachID']) == false) {
			$error = "Invalid input";
		}
		else {
			$academy = $_SESSION['id_team'];
			$coach = $_GET['coachID'];
			
			check_tranfer($academy);
			//check if the coach belongs to the academy
			$query = "SELECT id_team FROM coach WHERE id_coach = '$coach' LIMIT 1";
			$r = mysql_query($query);	
			$row = mysql_fetch_row($r);
			if ($academy == $row[0]) {
				$own = 1;
				
				//fetch coach details
				$query = "SELECT c.id_coach, c.name_coach, c.age, l.name_coachlevel,c.id_level,DATE(c.date_upgrade) AS date_upgrade FROM coach AS c JOIN coach_level AS l ON c.id_level = l.id_coachlevel WHERE c.id_coach = '$coach'";
				$r = mysql_query($query);
	
				while ($ar = mysql_fetch_array($r)) {	
						$coachdata[] = $ar;
				}
				//print_r($coachdata);
				if ($coachdata[0][4] < 5) {
					//print_r($coachdata);
					$level = $coachdata[0][4] + 1;
					//print_r($coachdata);
					$select = mysql_query("SELECT price FROM coach_level WHERE id_coachlevel = $level");
					$costRow = mysql_fetch_row($select);
					$cost = $costRow[0];
					$upgrade = 1;
				}
			}
			else { //coach does not belong to academy hence no info
				$error = 'Cannot view another user\'s coach';
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
		$smarty->assign('coachdata',$coachdata);
		$smarty->assign('cost',$cost);
		$smarty->assign('upgrade',$upgrade);
		$smarty->assign('own',$own);
    	$smarty->display('viewCoach.tpl');
	}
}
else {
	header("Location:index.php");
}
?>