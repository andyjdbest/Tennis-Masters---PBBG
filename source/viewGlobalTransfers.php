<?php

require_once 'common.php';
require_once 'DBconfig.php';
require_once 'checkTransfers.php';
//include("./includes/libs/SmartyPaginate.class.php");
include( '../Smarty-libs/SmartyPaginate.class.php' );

session_start();
if (@$_SESSION['authenticated'] == 'true' && @$_SESSION['assigned'] == 1) {
		
  	//players sold	
     	$_query = "SELECT CONCAT(p.firstname, ' ',p.lastname) AS name, a.team_name, a.id_team, p.idplayer, f.bid, f.date 
     	 		FROM fa_bids AS f JOIN academy AS a ON a.id_team = f.id_team 
     	 		LEFT JOIN players AS p ON p.idplayer = f.id_player 
     	 		WHERE f.won = 1 AND f.isPrivate = 0 ORDER BY f.date DESC LIMIT 15";
				
      	$_result = mysql_query($_query);
        while ($_row = mysql_fetch_array($_result)) {
            // collect each record into $_data
            $sol_data[] = $_row;
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
	
	$smarty->assign('sol_data', $sol_data);

        $smarty->display('viewGlobalTransfers.tpl');
}
else {
	header("Location:index.php");
}

?>