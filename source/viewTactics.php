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
			$query = "SELECT f.id_winner,f.id_team1,f.id_team2,f.round_date,f.stad_no,f.fixture_type, a1.team_name AS t1Name, a2.team_name as t2Name, c.name, s.name AS stad 
				FROM fixtures AS f JOIN academy AS a1 ON a1.id_team = f.id_team1 
				JOIN academy AS a2 ON a2.id_team = f.id_team2 
				JOIN courttype AS c ON f.id_stadium = c.idcourttype 
				JOIN stadium AS s ON f.id_stadium = s.id
				WHERE id_fixture = '$fixture' LIMIT 1";
			
			$r = mysql_query($query);	
			$row = mysql_fetch_array($r);
			//match complete - no need to set order
			//$temp = strtotime($row[3]) - mktime();
			//echo $temp;
			if ((strtotime($row[3]) - mktime())  < 900 ) {
				$errorM = 'Too late to set tactics as match simulation is in progress';
			}
			if ($row[0] != NULL) {
				$errorM = 'Match Complete';
			}
			//the fixture belongs to the user
			elseif ($row[1] == $academy || $row[2] == $academy ){ 
				//fetch player names, fetch tactics and aggression
				$p = mysql_query("SELECT p.idplayer, CONCAT(p.firstname, ' ', p.lastname ) AS playername, 
					p.handed, p.fitness, FLOOR( s.serve ) AS serve, FLOOR( s.volley ) AS volley, FLOOR( s.forehand ) AS forehand, 
					FLOOR( s.backhand ) AS backhand, FLOOR( s.speed ) AS speed, FLOOR( s.consistency ) AS consistency, 
					FLOOR( s.stamina ) AS stamina, FLOOR( s.power ) AS power, ( s.rating ) AS srating
						FROM players AS p
						JOIN player_stats AS s ON p.idplayer = s.idplayer
						JOIN academy AS a ON a.id_team = p.id_team
						WHERE a.id_team = '$academy'");
				while ($ob = mysql_fetch_array($p)) {
		   				$playerid[] = $ob[0];
						$playername[] = $ob[1];
						$playerdata[] = $ob;
   				 }
				 array_unshift($playerid, 0);
				 array_unshift($playername, "-----");
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
					FROM match_order WHERE id_fixture = '$fixture' AND id_team = '$academy' 
					ORDER BY id_matchorder DESC LIMIT 3");
				while ($ob = mysql_fetch_array($s)) {
		   				$selection[] = $ob;
				}
				//check if players still in team
				if (isset($selection[0][0])){
					foreach($selection as $s) {
						if (!in_array($s[0],$playerid)) {
							$s[0] = 0;
						}
					}
				}
				else {
					//clear the selection array
					$selection = array();
					//fetch the default tactics if any
					$s = mysql_query("SELECT id_player,id_tactic,id_agg 
					FROM match_order WHERE id_team = '$academy' AND defaultT = '1'
					ORDER BY id_matchorder DESC LIMIT 3");
					while ($ob = mysql_fetch_array($s)) {
		   				$selection[] = $ob;
					}
					//check if players still in team
					if (isset($selection[0][0])){
						foreach($selection as $s) {
							if (!in_array($s[0],$playerid)) {
								$s[0] = 0;
							}
						}
					}
					
				}
				
    		}
			$today = mktime();
			$match_date = strtotime($row[3]);
			$diff = floor(($match_date - $today)/86400);
			if ($diff >= 2 && $row[1] == $academy && $row[5] == 1) {
				$query = mysql_query("SELECT s.stad_no,c.name ,s.name FROM `stadium` AS s JOIN courttype AS c ON c.idcourttype = s.court_type WHERE s.id_team = $academy ORDER BY s.stad_no ASC");
				while($ar = mysql_fetch_array($query)) {
					$courtType[] = $ar[0];
					$courtName[] = "$ar[2] -> $ar[1]";
				}
				$selectC = $row[4];
				$noChange = 0;
			}
			else { $noChange = 1;}
		} // end else for valid fixture
	}
	
	if ($_POST['default']){
		
		$fixture = $_GET['fixtureid'];
		$userid = $_SESSION['userid'];
		$academy = $_SESSION['id_team'];
			
		//check_tranfer($academy);	
		$fixture = $_SESSION['fixtureid'];
		//check if the user's academy is in the fixture
		$query = "SELECT f.id_winner,f.id_team1,f.id_team2,f.round_date,f.stad_no,f.fixture_type, a1.team_name AS t1Name, a2.team_name as t2Name, c.name 
				FROM fixtures AS f JOIN academy AS a1 ON a1.id_team = f.id_team1 
				JOIN academy AS a2 ON a2.id_team = f.id_team2 
				JOIN courttype AS c ON f.id_stadium = c.idcourttype WHERE id_fixture = '$fixture' LIMIT 1";
		$r = mysql_query($query);	
		$row = mysql_fetch_array($r);
		//match complete - no need to set order
		if ($row[0] != 0) {
			$error = 'Match Complete';
		}
		//the fixture belongs to the user
		elseif ($row[1] == $academy || $row[2] == $academy ){ 
			//fetch player names, fetch tactics and aggression
			$p = mysql_query("SELECT p.idplayer,CONCAT(p.firstname,' ',p.lastname) AS playername,
					p.handed, p.fitness, FLOOR( s.serve ) AS serve, FLOOR( s.volley ) AS volley, FLOOR( s.forehand ) AS forehand, 
					FLOOR( s.backhand ) AS backhand, FLOOR( s.speed ) AS speed, FLOOR( s.consistency ) AS consistency, 
					FLOOR( s.stamina ) AS stamina, FLOOR( s.power ) AS power, ( s.rating ) AS srating
						FROM players AS p
						JOIN player_stats AS s ON p.idplayer = s.idplayer
						JOIN academy AS a ON a.id_team = p.id_team
						WHERE a.id_team = '$academy'");
			while ($ob = mysql_fetch_array($p)) {
		   		$playerid[] = $ob[0];
				$playername[] = $ob[1];
				$playerdata[] = $ob;
   			 }
   			 //print_r($playerdata);
   			 
			 array_unshift($playerid, 0);
			 array_unshift($playername, "-----");
			 
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
				FROM match_order WHERE defaultT = 1 AND id_team = '$academy' 
				ORDER BY id_matchorder DESC LIMIT 3");
			
			while ($ob = mysql_fetch_array($s)) {
		   				$selection[] = $ob;
			}
				
			//check if players still in team
			if (isset($selection[0][0])){
				foreach($selection as $s) {
					if (!in_array($s[0],$playerid)) {
						$s[0] = 0;
					}
				}
			}
			
			$today = mktime();
			$match_date = strtotime($row[3]);
			$diff = floor(($match_date - $today)/86400);
			if ($diff >= 2 && $row[1] == $academy && $row[5] == 1) {
				$query = mysql_query("SELECT s.stad_no,c.name  FROM `stadium` AS s JOIN courttype AS c ON c.idcourttype = s.court_type WHERE s.id_team = $academy ORDER BY s.stad_no ASC");
				while($ar = mysql_fetch_array($query)) {
					$courtType[] = $ar[0];
					$courtName[] = "$ar[0] -> $ar[1]";
				}
				$selectC = $row[4];
				$noChange = 0;
			}
			else { $noChange = 1;}
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
	
    		$smarty->assign('player_id',$playerid);
		$smarty->assign('player_name',$playername);
		$smarty->assign('playerData',$playerdata);
		$smarty->assign('tactic_id',$tacticid);
		$smarty->assign('tactic_name',$tacticname);
		$smarty->assign('agg_id',$aggid);
		$smarty->assign('agg_name',$aggname);
		$smarty->assign('selection',$selection);
		$smarty->assign('single',$single);
		$smarty->assign('courtType',$courtType);
		$smarty->assign('courtName',$courtName);
		$smarty->assign('selectC',$selectC);
		$smarty->assign('noChange',$noChange);
		$smarty->assign('errorM',$errorM);
		$smarty->assign('matchDetails',$row);
    	$smarty->display('viewTactics.tpl');
	
}
else {
	header("Location:index.php");
}
?>