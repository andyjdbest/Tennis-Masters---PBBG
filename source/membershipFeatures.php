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
if (@$_SESSION['authenticated'] == 'true' & @$_SESSION['assigned'] == 1) {
	
	if (@$_SESSION['member'] == 1){
		$userid = $_SESSION['userid'];
		$academy = $_SESSION['id_team'];
		
		$teamExists = 0;
		$ownAlliance = array();
		$otherAllianceMessage = '';
		//check if member has created an alliance or is part of another alliance
		$r = mysql_query("SELECT id_user FROM alliance_members WHERE id_user = $userid AND status = 2 LIMIT 1");
		$row = mysql_fetch_row($r);
		
		//user is part of an alliance
		if (isset($row[0])){
			$teamExists = 1;
			$r = mysql_query("SELECT id_alliance,name,members,points,created_date FROM alliance 
				WHERE leader_id = $userid AND status = 2 LIMIT 1");
			$row = mysql_fetch_row($r);
			if (isset($row[0])){
				$ownAlliance = $row;
			}
			else { $otherAllianceMessage = 'You are part of an existing alliance. You need to withdraw from that, before you can create your own alliance.';
			}
			
		}
		$playerid = array(); $playername = array(); $playerdata = array();
		//fetch player names for a rename
		$p = mysql_query("SELECT idplayer, CONCAT(firstname, ' ', lastname ) AS playername
					FROM players WHERE id_team = '$academy'");
		while ($row = mysql_fetch_array($p)) {
   				$playerid[] = $row[0];
				$playername[] = $row[1];
				$playerdata[] = $row;
		 }
		//fetch court names for a rename 
		$q = mysql_query("SELECT id, name FROM stadium WHERE id_team = '$academy'");
		while ($row = mysql_fetch_array($q)) {
				$courtdata[] = $row;
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
	
	$smarty->assign('teamExists',$teamExists);
	$smarty->assign('ownAlliance',$ownAlliance);
	$smarty->assign('otherAllianceMessage',$otherAllianceMessage);
	$smarty->assign('player_id',$playerid);
	$smarty->assign('player_name',$playername);
	$smarty->assign('playerdata',$playerdata);
	$smarty->assign('courtdata',$courtdata);	
    	$smarty->display('membershipFeatures.tpl');
	
}
else {
	header("Location:index.php");
}
?>