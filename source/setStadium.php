<?php

require_once 'common.php';
require_once 'DBconfig.php';
require_once 'checkTransfers.php';

session_start();
if (@$_SESSION['authenticated'] == 'true' & @$_SESSION['assigned'] == 1) {
	
	$error = '';
	$message = '';
	if ($_POST){
		//print_r($_POST);
		$courtNo = $_POST['courtNo'];
		$court = $_POST['court'];
		
		if ($_POST[changeCourt] === " Change Court 1 "){
			$number = $courtNo[0];
			$court = $court[0];
			
		}
		else if ($_POST[changeCourt] === " Change Court 2 "){
			$number = $courtNo[1];
			$court = $court[1];
			
		}
		
		//echo "Number - $number, Court - $court ";
		$team_id = $_SESSION['id_team'];
		check_tranfer($team_id);
		
		if (($number > 0) && ($number < 3)) {
			if ($court > 0 && $court < 5){
				//$dateTime = date('Y-m-d H:i:s');
				$update = "UPDATE stadium SET court_change = '$court', date_change = NOW() WHERE id_team = '$team_id' AND stad_no = '$number'";
				//echo $update;
				if (!(mysql_query($update))){
				 $error = "Error while updating stadium " . mysql_error();
				}
				else {
					$week = floor((mktime() - $season_start)/604800);
					$insert = "INSERT INTO finance (id_team,week,type,id_finance,amount) VALUES ('$team_id','$week','0','12','5000')";
					if (!(mysql_query($insert))) {
              					$error = 'Cannot insert finance information';
    					}

				}

			}
			else {
				$error = 'Wrong Court Type Requested';
			}
		}		
		else {
			$error = 'Wrong Court Number' . "$number";
			//print_r($courtNo[1]);
		}
		
		if ( $error == ''){
			$message = 'Requested Court Change';
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
	
	$smarty->assign('errorSet',$error);
	$smarty->assign('messageSet',$message);
	$smarty->display('setStadium.tpl');
}
else {
	header("Location:index.php");
}
?>