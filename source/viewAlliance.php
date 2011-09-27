<?php

/*
Status Flags = 0 - Applied to create / join / name
	       1 - Applied to delete / withdraw / cancel
	       2 - Active / Done
	       3 - Deleted / Removed
*/

require_once 'common.php';
require_once 'DBconfig.php';

session_start();
if (@$_SESSION['authenticated'] == 'true' & @$_SESSION['assigned'] == 1 || @$_SESSION['admin'] === 'true') {
	
	$userid = $_SESSION['userid'];
	$academy = $_SESSION['id_team'];
	
	if (ctype_digit($_GET['alliance']) == false) {
		$error = "Invalid input";
	}
	else{
		$id = $_GET['alliance'];
		$r = mysql_query("SELECT name,description,leader_id,created_date FROM alliance WHERE id_alliance = $id AND status = 2 LIMIT 1");
					
		$row = mysql_fetch_array($r);
		$name = $row[0]; $description = $row[1];$leader_id = $row[2];
		
		$r = mysql_query("SELECT m.id_user,m.points,a.id_team,u.username FROM `alliance_members` AS m 
			JOIN academy AS a on a.id_user = m.id_user JOIN users AS u on m.id_user = u.userid
			WHERE m.status = 2 AND id_alliance = $id ORDER BY m.join_date ASC ");
					
		while ($ob = mysql_fetch_array($r)) {
			$members[] = $ob;
		}
		
		$existing = 0; $leader = 0;	
		//check if user is the alliance leader
		if ($leader_id == $userid){
			$existing = 1;	
			$leader = 1;	
			//create management menu	
		}
		//check if user is a member	
		else {
			foreach($members as $member){
				if ($member[0] == $userid)
					$existing = 1;			
			}	
					
		}						
	}
	if ($_GET['message']){
			switch($_GET['message']){
				case 'Success':
					$message = "Your application has been sent to the alliance leader.";
					break;
				case 'Fail':
					$message = "Your application has failed";
					break;
				case 'Pending':
					$message = "You have a pending application for this alliance. Wait till the leader responds.";
					break;
				case 'WFail':
					$message = "There was an error while withdrawing you from this alliance. Either try after some time or contact the admins.";
					break;
				case 'WSuccess':
					$message = "You have been successfully removed from this alliance.";
					break;
				case 'Duplicate':
					$message = "The user has joined another alliance.";
					break;										
			}	
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
	
	$smarty->assign('message',$message);	
	$smarty->assign('members',$members);
	$smarty->assign('name',$name);
	$smarty->assign('description',$description);
	$smarty->assign('existing',$existing);	
	$smarty->assign('leader',$leader);	
	$smarty->assign('Aid',$id);			
    $smarty->display('viewAlliance.tpl');
	
}
else {
	header("Location:index.php");
}
?>