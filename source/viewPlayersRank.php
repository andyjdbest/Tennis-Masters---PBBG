<?php

require_once 'common.php';
require_once 'DBconfig.php';
require_once 'checkTransfers.php';
//include("./includes/libs/SmartyPaginate.class.php");
include( '../Smarty-libs/SmartyPaginate.class.php' );

session_start();
if (@$_SESSION['authenticated'] == 'true' && @$_SESSION['assigned'] == 1) {
		
	//$cID = 1;
	if ($_GET['countryID']){
		if (ctype_digit($_GET['countryID']) == false) {
			$error = "Invalid input";
		}
		else {
			$cID = $_GET['countryID'];
		}
	}

        SmartyPaginate::connect();
        SmartyPaginate::setLimit(20); 
		
	if ($cID > 0) {
        	 $_query = sprintf("SELECT idplayer,rank, CONCAT(firstname, ' ', lastname) as playername, points, academy.id_team, academy.team_name AS academy_name FROM players 
                              LEFT JOIN academy ON players.id_team = academy.id_team WHERE rank > 0 AND countryid = $cID ORDER BY rank ASC LIMIT %d,%d",
            SmartyPaginate::getCurrentIndex(), SmartyPaginate::getLimit());
       //  echo $_query;
      	  $_result = mysql_query($_query);

        while ($_row = mysql_fetch_array($_result, MYSQL_ASSOC)) {
            // collect each record into $_data
            $_data[] = $_row;
        }
  	
  	 $_res = mysql_query("SELECT COUNT(idplayer) FROM players WHERE rank > 0 AND countryid = $cID");
       	 }
       	 else {
       	 	$_query = sprintf("SELECT idplayer,wrank AS rank, CONCAT(firstname, ' ', lastname) as playername, points, academy.id_team, academy.team_name AS academy_name FROM players 
                              LEFT JOIN academy ON players.id_team = academy.id_team WHERE rank > 0 ORDER BY rank ASC LIMIT %d,%d",
           			 SmartyPaginate::getCurrentIndex(), SmartyPaginate::getLimit());
       
      	  	$_result = mysql_query($_query);

        	while ($_row = mysql_fetch_array($_result, MYSQL_ASSOC)) {
           	 // collect each record into $_data
           		 $_data[] = $_row;
       		}
  	
  	 	$_res = mysql_query("SELECT COUNT(idplayer) FROM players WHERE rank > 0");
       	 
       	 }
	
	$row = mysql_fetch_row($_res);
	SmartyPaginate::setTotal($row[0]);
        

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
	
	$smarty->assign('results', $_data);
        SmartyPaginate::assign($smarty);
        $smarty->display('viewPlayersRank.tpl');
}
else {
	header("Location:index.php");
}

?>