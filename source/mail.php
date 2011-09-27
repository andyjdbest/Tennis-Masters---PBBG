<?php

require_once 'common.php';
require_once 'DBconfig.php';

session_start();
if (@$_SESSION['authenticated'] == 'true' & @$_SESSION['assigned'] == 1) {
	//mailData
	if ($_GET['type'] == "inbox"){
		$receiver_id = $_SESSION['userid'];
		$type = 'inbox';
    		$message = $_GET['message'];
		//fetch the receiver's emails
		$query = "SELECT m.id AS mid,DATE(m.date) AS date,m.subject,m.id_sender, u.username,m.read 
				FROM `messages` AS m LEFT JOIN users AS u ON u.userid = m.id_sender 
				WHERE m.id_receiver = '$receiver_id' AND m.del_receiver = '0' ORDER BY m.date DESC LIMIT 30";
		$r = mysql_query($query);
		while ($row = mysql_fetch_array($r)) {
				$mailData[] = $row;
		}
	}
	
	if ($_GET['type'] == "outbox"){
		$sender_id = $_SESSION['userid'];
		$type = 'outbox';
    
		//fetch the receiver's emails
		$query = "SELECT m.id AS mid,DATE(m.date) AS date,m.subject,m.id_sender, u.username 
				FROM `messages` AS m JOIN users AS u ON u.userid = m.id_receiver 
				WHERE m.id_sender = '$sender_id' AND m.del_sender = '0' ORDER BY m.date DESC LIMIT 30";
		$r = mysql_query($query);
		while ($row = mysql_fetch_array($r)) {
				$mailData[] = $row;
		}
	}
	
	$q = "SELECT COUNT(id) FROM `messages` WHERE id_receiver = {$_SESSION['userid']} AND `read` = 0 AND del_receiver = 0";
	$r = mysql_query($q);
	$rf = mysql_fetch_row($r);
	$_SESSION['new_mail'] = $rf[0];
	
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
	
	$smarty->assign('type',$type);
        $smarty->assign('message',$message);		
	$smarty->assign('mailData',$mailData);
	$smarty->display('mail.tpl');
//}
}
else {
	header("Location:index.php");
}

?>