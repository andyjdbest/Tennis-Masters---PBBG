<?php

require_once 'common.php';
require_once 'DBconfig.php';

session_start();
if (@$_SESSION['authenticated'] == 'true' & @$_SESSION['assigned'] == 1) {
	
	$single = 0;	
	
	if ($_GET['fixtureid']){
		
		$own = 0;
		if (ctype_digit($_GET['fixtureid']) == false) {
			$error = "Invalid input";
		}
		else {
			$fixture = $_GET['fixtureid'];
			$userid = $_SESSION['userid'];
			$academy = $_SESSION['id_team'];
				
			$_SESSION['fixtureid'] = $fixture;
			//check if the user's academy is in the fixture
			//$query = "SELECT id_winner,id_team1,id_team2,round_date,stad_no,fixture_type FROM fixtures WHERE id_fixture = '$fixture' LIMIT 1";
			$query = "SELECT f.id_winner,f.id_team1,f.id_team2,f.round_date,f.stad_no,f.fixture_type, a1.team_name AS t1Name, a2.team_name as t2Name, c.name,s.name AS stad 
				FROM fixtures AS f JOIN academy AS a1 ON a1.id_team = f.id_team1 
				JOIN academy AS a2 ON a2.id_team = f.id_team2 
				JOIN courttype AS c ON f.id_stadium = c.idcourttype 
				JOIN stadium AS s ON f.id_stadium = s.id
				WHERE id_fixture = '$fixture' LIMIT 1";
			
			$r = mysql_query($query);	
			$row = mysql_fetch_array($r);
			//match complete - show tactics set
			if ($row[0] != NULL) {
				if ($row[1] == $academy || $row[2] == $academy || $_SESSION['admin'] == 1){ 
					$own = 1;
					$s = mysql_query("SELECT CONCAT(p.firstname, ' ',p.lastname) as name, t.tacticname, a.name
					FROM match_order AS m JOIN players AS p ON p.idplayer = m.id_player
					JOIN tactictype AS t ON t.idtactictype = m.id_tactic
					JOIN tacticagg AS a ON a.id = m.id_agg
					WHERE m.id_fixture = '$fixture' AND m.id_team = '$academy' 
					ORDER BY id_matchorder DESC LIMIT 3");
					while ($ob = mysql_fetch_array($s)) {
		   				$selection[] = $ob;
					}	
				}
				else { $error = 'Cannot view another academy\'s orders'; }
				
			}
			else { $error = 'Fixture not yet played'; }
			
		}
	}
	
	//viewing & setting tactics for Matches - knockout cups
	elseif ($_GET['matchid']){
		$single = 1;
		$own = 0;
		if (ctype_digit($_GET['matchid']) == false && ctype_digit($_GET['playerid']) == false) {
			$error = "Invalid input";
		}
		else {
			$match = $_GET['matchid'];
			$player = $_GET['playerid'];
			$userid = $_SESSION['userid'];
			$academy = $_SESSION['id_team'];
			
			check_tranfer($academy);	
			$_SESSION['matchid'] = $match;
			//check if the user's player is in the fixture
			$query = "SELECT idplayer,CONCAT(firstname, ' ', lastname) AS name, id_team FROM players WHERE idplayer = '$player' LIMIT 1";
			$r = mysql_query($query);	
			$row = mysql_fetch_row($r);
			
			//the match features an academy's player
			if ($row[2] == $academy){ 
				//store player id & name
				$playerid = $row[0];
				$playername = $row[1];
   				
				$t = mysql_query("SELECT idtactictype,tacticname FROM tactictype");
				 while ($ob = mysql_fetch_array($t)) {
		   				$tacticid[] = $ob[0];
						$tacticname[] = $ob[1];
   				}
				 
				$a = mysql_query("SELECT id,name FROM tacticagg");
				while ($ob = mysql_fetch_array($a)) {
		   				$aggid[] = $ob[0];
						$aggname[] = $ob[1];
   				}
				 
				array_unshift($tacticid, 0);
				array_unshift($tacticname, "-----");
				array_unshift($aggid, 0);
				array_unshift($aggname, "-----");	
				
				$s = mysql_query("SELECT id_player,id_tactic,id_agg 
					FROM kmatch_order WHERE id_match = '$match' AND id_player = '$player'");
				while ($ob = mysql_fetch_array($s)) {
		   				$selection[] = $ob;
				}
				
				//print_r($selection);
								
    		}
		} // end else for valid fixture
	}
	//print_r($row);
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
	
		$smarty->assign('own',$own);
		$smarty->assign('single',$single);	
		$smarty->assign('error',$error);
		$smarty->assign('matchDetails',$row);	
		$smarty->assign('selection',$selection);
		$smarty->display('viewFixtureTactics.tpl');
	
}
else {
	header("Location:index.php");
}
?>