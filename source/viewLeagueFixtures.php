<?php
		
#include the common file
require_once 'common.php';
        
#include the DBConfig file
require_once 'DBconfig.php';
 
        session_start();
         if (@$_SESSION['authenticated'] == 'true' && @$_SESSION['assigned'] == 1)
         {
           
            $fixturedata = array();
            
            if ($_GET['league']) {
			if (ctype_digit($_GET['league'])) {
                            $league = $_GET['league'];
							$curr_season = $season;
                            $query = "SELECT nameleague FROM league WHERE idleague = '$league'";
                            $r = mysql_query($query);
                            //global $leaguedata;
                            $nameleague = mysql_fetch_row($r);
            
                            $query = "SELECT f.id_fixture,t1.team_name AS t1name, t1.id_team AS t1id, t2.team_name AS t2name, t2.id_team AS t2id,f.round,f.round_date, c.name,f.id_winner FROM fixtures AS f JOIN academy AS t1 ON f.id_team1 = t1.id_team JOIN academy AS t2 ON f.id_team2 = t2.id_team JOIN courttype AS c ON f.id_stadium = c.idcourttype WHERE f.id_league = '$league' AND f.season = '$season' ORDER BY f.round";
                            $fix = mysql_query($query);
                            while ($obj = mysql_fetch_array($fix)) {
                                    $fixturedata[] = $obj;
                             }
                            // print_r($fixturedata);
                             //check if fixture is completed by checking id_winner
			 	foreach($fixturedata as $fixture) {
				 if ($fixture[8] > 0) {
					$completedData[] = $fixture;
				 }
				 else {
					$upcomingData[] = $fixture;
				 }
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
				$smarty->assign('uname',$_SESSION['username']);
				$smarty->assign('userid',$_SESSION['userid']);
				$smarty->assign('new_mail',$_SESSION['new_mail']);
				$smarty->assign('cManager',$_SESSION['countryM']);
				$smarty->assign('member',$_SESSION['member']);
				$smarty->assign('credits',$_SESSION['credits']);
	
                $smarty->assign('leaguename',$nameleague);
                $smarty->assign('fixturedata',$fixturedata);
                 $smarty->assign('completedData',$completedData);
                  $smarty->assign('upcomingData',$upcomingData);
        		$smarty->display('viewLeagueFixtures.tpl');
           }  
		   else {
	header("Location:index.php");
}
?>