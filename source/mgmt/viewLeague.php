<?php
		
#include the common file
include ("common.php");
        
#include the DBConfig file
include ("../DBconfig.php");
 
        session_start();
         if (@$_SESSION['authenticated'] == 'true' && @$_SESSION['admin'] == 'true')
         {
            $leaguedata = array();
            $fixturedata = array();
            
            if ($_GET['league']) {
			if (ctype_digit($_GET['league'])) {
                            $league = $_GET['league'];
							$curr_season = $season;
                            $query = "SELECT d.nameleague,a.id_team,a.team_name,l.played,l.won,l.lost,l.points FROM `league_table` AS l JOIN academy AS a ON l.id_team = a.id_team JOIN league AS d ON d.idleague = l.id_league WHERE l.id_league = '$league' AND l.season =  '$curr_season' ORDER BY l.points DESC";
                            $r = mysql_query($query);
                            //global $leaguedata;
                            while ($obj = mysql_fetch_object($r)) {
                                    $leaguedata[] = $obj;
                                    //$counter = $counter + 1;
                                    }

                            $query = "SELECT t1.team_name AS t1name, t1.id_team AS t1id, t2.team_name AS t2name, t2.id_team AS t2id,f.round, c.name FROM fixtures AS f JOIN academy AS t1 ON f.id_team1 = t1.id_team JOIN academy AS t2 ON f.id_team2 = t2.id_team JOIN courttype AS c ON f.id_stadium = c.idcourttype WHERE f.id_league = '$league' ORDER BY f.round";
                            $fix = mysql_query($query);
                            while ($obj = mysql_fetch_object($fix)) {
                                    $fixturedata[] = $obj;
                                    }

                             }
                   }
                
			
                $smarty->assign('leaguedata',$leaguedata);
                $smarty->assign('fixturedata',$fixturedata);
        	$smarty->display('mviewLeague.tpl');
           }  
?>