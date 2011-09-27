<?php

require_once 'common.php';
require_once 'DBconfig.php';

session_start();
if (@$_SESSION['authenticated'] == 'true' & @$_SESSION['assigned'] == 1) {
	if ($_GET['academy']){
		$stadData = array();
		$own = 0;
		if (ctype_digit($_GET['academy']) == false) {
			$error = "Invalid input";
		}
		else {
			$academy = $_GET['academy'];
			$userid = $_SESSION['userid'];
			
			
			//check if the user owns the academy
			$query = "SELECT id_user FROM academy WHERE id_team = '$academy'";
			$r = mysql_query($query);	
			$row = mysql_fetch_row($r);
			if ($userid == $row[0]) {
				$own = 1;
				
				//fetch stadium details
				$query = "SELECT s.stad_no AS number, s.name AS stad, c1.name AS name1, s.date_change, c2.name AS name2,s.court_change 
					FROM stadium AS s JOIN courttype AS c1 ON s.court_type = c1.idcourttype 
					LEFT JOIN courttype AS c2 ON s.court_change = c2.idcourttype WHERE s.id_team = '$academy' ORDER BY number ASC";
				$r = mysql_query($query);
	
				while ($ar = mysql_fetch_array($r)) {	
						$stadData[] = $ar;
				}
				
				$query = mysql_query("SELECT idcourttype, name FROM courttype");
				while ($row = mysql_fetch_array($query)){
					$courtType[] = $row[0];
					$courtName[] = $row[1];
					
				}
				array_unshift($courtType, 0);
				array_unshift($courtName, "-----");

				
			}
			else { //user is not owner of academy so limited info
				$error = 'Cannot view another user\'s stadiums';
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
	$smarty->assign('courtType',$courtType);
	$smarty->assign('courtName',$courtName);
	$smarty->assign('stadData',$stadData);
	$smarty->assign('own',$own);
    	$smarty->display('viewStadium.tpl');
	}
}
else {
	header("Location:index.php");
}
?>