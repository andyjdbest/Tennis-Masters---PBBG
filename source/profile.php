<?php

require_once 'common.php';
require_once 'DBconfig.php';

session_start();
if (@$_SESSION['authenticated'] == 'true' & @$_SESSION['assigned'] == 1) {
	$userid = $_SESSION['userid'];	
	$team = $_SESSION['id_team'];
	
	$teamName = ''; $message = ''; $stadMessage = ' ';
	$countRow = array(); 
	$row1 = array(); 
			
function updateView(){
	global $userid, $team, $teamName, $season, $message, $countRow, $row1;
	$query = mysql_query("SELECT team_name FROM academy WHERE id_user = '$userid' LIMIT 1");
	$teamName = mysql_fetch_row($query);
	
	$query = mysql_query("SELECT count($season) FROM academy_change WHERE id_user = '$userid' AND id_team = '$team' AND season = '$season' LIMIT 1");
	//echo "SELECT count($season) FROM academy_change WHERE id_user = '$userid' AND id_team = '$team' AND season = '$season' LIMIT 1";	
	$countRow = mysql_fetch_row($query);
	//print_r($count);
	if ($countRow[0] > 0) { $message = 'Academy name cannot be changed till next season.'; }

	$query = mysql_query("SELECT id,name,name_change,stad_no FROM stadium WHERE id_team = '$team' LIMIT 2");
	while ($row = mysql_fetch_array($query)){
		$row1[] = $row;	
	}	
	
}			

if ($_POST['name'])
{
	$regex = "/^[a-zA-Z0-9_ ]{1,}$/";

	if (preg_match($regex, $_POST['teamName'])) {
	    
	
	$teamName = mysql_real_escape_string($_POST['teamName']);
	//echo $teamName;
	$query = "SELECT COUNT(id_team) FROM academy WHERE UPPER(team_name) = UPPER('$teamName')";
	$result = mysqli_query($conn, $query);
	list($count) = mysqli_fetch_row($result);
	if($count >= 1) {          
		$message = 'The academy name you entered has already been taken. Please try a different one.';
	}
	else {
	$query = "UPDATE academy SET team_name = '$teamName' WHERE id_user = $userid";
	if (!mysql_query($query)) {
		 $message = 'Error in changing academy name';
		 echo mysql_error();
	}
	else { 
	$query = "INSERT INTO academy_change (id_team, id_user, date_change, season) VALUES ('$team','$userid', NOW(), '$season')";
	if (!mysql_query($query)) {
		 $message = 'Error in changing academy name';
		 echo mysql_error();
	}
	$message = 'Academy name changed successfully'; 
	}
	}
	$query = mysql_query("SELECT team_name FROM academy WHERE id_user = '$userid' LIMIT 1");
	$teamName = mysql_fetch_row($query);
	}
	else {
		$message = "Academy name can contain only alphanumeric characters and space";
	}
	
}
else {
	
}
	//call fetch teamName & stadiumName
	updateView();
		
	$day =  floor((mktime() - $season_start)/86400);
	
	$q = "SELECT COUNT(id) FROM `messages` WHERE id_receiver = {$_SESSION['userid']} AND `read` = 0 AND del_receiver = 0";
	$r = mysql_query($q);
	$rf = mysql_fetch_row($r);
	$_SESSION['new_mail'] = $rf[0];
	
	$smarty->assign('season',$season);
	$smarty->assign('day',$day);
	$smarty->assign('idteam',$_SESSION['id_team']);
    $smarty->assign('idleague',$_SESSION['id_league']);
	$smarty->assign('uname',$_SESSION['username']);
	$smarty->assign('userid',$_SESSION['userid']);
	$smarty->assign('new_mail',$_SESSION['new_mail']);
	$smarty->assign('cManager',$_SESSION['countryM']);
	$smarty->assign('member',$_SESSION['member']);
	$smarty->assign('credits',$_SESSION['credits']);
	
    	$smarty->assign('team',$teamName[0]);
    	$smarty->assign('count',$countRow[0]);
	$smarty->assign('message',$message);
	$smarty->assign('stadMessage',$stadMessage);
	$smarty->assign('stad',$row1);
    $smarty->display('profile.tpl');
}
else {
	header("Location:index.php");
}

?>