<?php

require_once 'common.php';
require_once 'DBconfig.php';
//include("./includes/libs/SmartyPaginate.class.php");
include( '../Smarty-libs/SmartyPaginate.class.php' );

session_start();
if (@$_SESSION['authenticated'] == 'true' && @$_SESSION['assigned'] == 1) {
		
	//$cID = 1;
        SmartyPaginate::connect();
        SmartyPaginate::setLimit(30); 
		
     	 $_query = sprintf("SELECT CONCAT(u.firstname, ' ',u.lastname) AS name, a.team_name, a.id_team, MAX(l.time) as time, u.userid
     	 		FROM users AS u JOIN academy AS a ON a.id_user = u.userid 
     	 		LEFT JOIN logins AS l ON l.iduser = u.userid GROUP BY l.iduser ORDER BY time DESC LIMIT %d,%d",
            SmartyPaginate::getCurrentIndex(), SmartyPaginate::getLimit());
       //  echo $_query;
      	  $_result = mysql_query($_query);

        while ($_row = mysql_fetch_array($_result, MYSQL_ASSOC)) {
            // collect each record into $_data
            $_data[] = $_row;
        }
  	
  	 $_res = mysql_query("SELECT COUNT(u.userid) FROM users AS u JOIN academy AS a ON a.id_user = u.userid");
       	 
       	
	
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
        $smarty->display('viewManagers.tpl');
}
else {
	header("Location:index.php");
}

?>