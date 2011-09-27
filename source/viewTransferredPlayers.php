<?php

require_once 'common.php';
require_once 'DBconfig.php';
require_once 'checkTransfers.php';
//include("./includes/libs/SmartyPaginate.class.php");
//include( '../Smarty-libs/SmartyPaginate.class.php' );

session_start();
if (@$_SESSION['authenticated'] == 'true' && @$_SESSION['assigned'] == 1) {
		
	//$cID = 1;
        $academy = $_SESSION['id_team'];
	//players purchased	
     	$_query = "SELECT CONCAT(p.firstname, ' ',p.lastname) AS name, p.idplayer, a.value, a.date 
     	 		FROM players AS p JOIN academy_player AS a ON a.id_player = p.idplayer 
     	 		WHERE a.id_team = $academy AND a.transfer_type = 1 ORDER BY a.date";
      	$_result = mysql_query($_query);
        while ($_row = mysql_fetch_array($_result)) {
            // collect each record into $_data
            $pur_data[] = $_row;
        }
  	
  	//print_r($pur_data);
  	
  	//players let go	
     	$_query = "SELECT CONCAT(p.firstname, ' ',p.lastname) AS name,p.idplayer, f.set_price, f.date_free 
     	 		FROM fa_players AS f JOIN players AS p ON f.id_player = p.idplayer
     	 		WHERE f.id_team = $academy ORDER BY f.date_free";
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
	
	$smarty->assign('pur_data', $pur_data);
	$smarty->assign('sol_data', $sol_data);

        $smarty->display('viewTransferredPlayers.tpl');
}
else {
	header("Location:index.php");
}

?>