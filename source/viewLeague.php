<?php
		
#include the common file
require_once 'common.php';
        
#include the DBConfig file
require_once 'DBconfig.php';
 
        session_start();
         if (@$_SESSION['authenticated'] == 'true' && @$_SESSION['assigned'] == 1)
         {
            $leaguedata = array();
            
            if ($_GET['league']) {
			if (ctype_digit($_GET['league'])) {
                            $league = $_GET['league'];
							$curr_season = $season;
                            $query = "SELECT d.nameleague,a.id_team,a.team_name,l.played,l.won,l.lost,l.points,l.rank,ROUND(l.pr,2) AS pr FROM `league_table` AS l JOIN academy AS a ON l.id_team = a.id_team JOIN league AS d ON d.idleague = l.id_league WHERE l.id_league = '$league' AND l.season =  '$curr_season' ORDER BY l.rank ASC,l.pr DESC";
                            $r = mysql_query($query);
                            //global $leaguedata;
                            while ($obj = mysql_fetch_object($r)) {
                                    $leaguedata[] = $obj;
                                    //$counter = $counter + 1;
                                    }
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
	
                $smarty->assign('leaguedata',$leaguedata);
                //$smarty->assign('fixturedata',$fixturedata);
        		$smarty->display('viewLeague.tpl');
           }  
		   else {
	header("Location:index.php");
}
?>