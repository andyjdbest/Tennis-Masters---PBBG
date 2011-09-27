<?php

require_once 'common.php';
require_once 'DBconfig.php';

session_start();
if (@$_SESSION['authenticated'] == 'true' & @$_SESSION['assigned'] == 1) {
	
	if ($_GET['message']) {
		if ($_GET['message'] == 'Failed') {
			$transfer_message = 'Error in making the player a free agent';
		}
		elseif ($_GET['message'] == 'Success') {
			$transfer_message = 'Player is now a free agent';
		}
		elseif ($_GET['message'] == 'BidFailed') {
			$transfer_message = 'Check your bid price';
		}
	}
	
	if ($_GET['playerid']){
	$playerdata = array();
	$own = 0;
	if (ctype_digit($_GET['playerid']) == false) {
		$error = "Invalid input";
	}
	else {
	$player = $_GET['playerid'];
	$userid = $_SESSION['userid'];
	
	$week = floor((mktime() - $season_start)/604800);
	
	//check if player is a free_agent
	$query = "SELECT id_team FROM players WHERE idplayer = '$player' LIMIT 1";
	$s = mysql_query($query);	
	$row = mysql_fetch_row($s);
	if (isset($row[0])){
		if ($row[0] == 0) {
			//player is a free_agent
			header("Location:viewFreeAgent.php?playerid=$player");
		}
	}
	
	//check if the user owns the academy that the player is in
	$query = "SELECT a.id_user FROM user_academy AS a 
			JOIN players AS p ON p.id_team = a.id_academy 
			WHERE p.idplayer = '$player' LIMIT 1";
	$r = mysql_query($query);	
	$row = mysql_fetch_row($r);
	
	if ($userid == $row[0]) {	
		$own = 1; 
	//fetch required player summary details 
	$query = "SELECT CONCAT(p.firstname, ' ', p.lastname) AS playername, p.idplayer, p.age, p.handed, p.fitness, p.wage, p.nationality,
		FLOOR( s.serve ) AS serve, FLOOR( s.volley ) AS volley, FLOOR( s.forehand ) AS forehand, FLOOR( s.backhand ) AS backhand, 
		FLOOR( s.speed ) AS speed, FLOOR( s.consistency ) AS consistency, FLOOR( s.stamina ) AS stamina, FLOOR( s.power ) AS power, 
		s.rating AS srating,p.idplayer,p.wrank
			FROM players AS p
			JOIN player_stats AS s ON p.idplayer = s.idplayer
			WHERE p.idplayer = '$player' LIMIT 1";
	$r = mysql_query($query);
	
	while ($ob = mysql_fetch_assoc($r)) {
		   $playerdata = $ob;
    	}
    	
    	//to show rank = 0 as rank = NR
	while ( list( $key, $value ) = each( $playerdata) ) {
	 	if ($key === 'wrank' && $value == 0){
 	 		$playerdata[ $key ] = 'NR';	
 	 	}	
	 }
	
    	
    	//fetch victories etc.
    	$query = mysql_query("SELECT m.id_match,m.id_winner,m.id_court FROM matches AS m 
    		JOIN fixtures AS f ON m.id_fixture = f.id_fixture 
    		WHERE (m.id_player1 = '$player' OR m.id_player2 = '$player') AND f.fixture_type = 1");
	while ($row = mysql_fetch_row($query)) {
		   $resultsData[] = $row;
    	}
    	$played = 0; $wins = 0; $court = array(0,0,0,0);
	if (isset($resultsData[0][0])) {
		
		foreach($resultsData as $result) {
			switch($result[2]) {
			case 1:
			  if ($result[1] == $player) { 
	                             $wins += 1;
	                            $court[0] += 1;
                           }
                          break;
			case 2:
			 if ($result[1] == $player) { 
	                            $wins += 1;
	                            $court[1] += 1;
                          }
                          break;
			case 3:
			 if ($result[1] == $player) { 
	                        $wins += 1;
	                        $court[2] += 1;
                          }
                         break;
			case 4:
			   if ($result[1] == $player) { 
	                      $wins += 1;
	                      $court[3] += 1;
                            }
                        break;
		       }
		}
		$played = count($resultsData);
		//echo $played;
        }
	//print_r($court); 
	//echo "<br /> $wins";
	

    	
    	
	}
	else { //user is not owner of academy so limited info
		//check if player is freeagent
		$query = "SELECT id_team FROM players WHERE idplayer = '$player'";
		$r = mysql_query($query);
		$row = mysql_fetch_row($r);
		
		if ($row[0] == 0) {
			header("Location:viewFreeAgent.php?playerid=$player");
		}
		else {
			$query = "SELECT CONCAT(p.firstname, ' ',p.lastname) AS playername, p.nationality,
				p.idplayer, p.age, p.handed, p.fitness, FLOOR(s.rating) AS srating,p.idplayer,p.wage FROM players AS p 
				JOIN player_stats AS s ON p.idplayer = s.idplayer  
				WHERE p.idplayer = '$player' LIMIT 1";
			$r = mysql_query($query);
		
			while ($ob = mysql_fetch_assoc($r)) {
			   $playerdata = $ob;
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
	$smarty->assign('userid',$_SESSION['userid']);
	$smarty->assign('uname',$_SESSION['username']);
	$smarty->assign('new_mail',$_SESSION['new_mail']);
	$smarty->assign('cManager',$_SESSION['countryM']);
	$smarty->assign('member',$_SESSION['member']);
	$smarty->assign('credits',$_SESSION['credits']);
	
    //$smarty->assign('error',$error);
	//$smarty->assign('message',$message);
	$smarty->assign('transfer_message',$transfer_message);
	$smarty->assign('playerdata',$playerdata);
	$smarty->assign('own',$own);
	$smarty->assign('start_price',$market[0]);
	$smarty->assign('curr_price',$market[1]);
	$smarty->assign('curr_teamID',$market[2]);
	$smarty->assign('curr_teamName',$market[3]);
	$smarty->assign('deadline',$market[4]);
	$smarty->assign('next_bid',$next_bid);
	$smarty->assign('played',$played);
	$smarty->assign('wins',$wins);
	$smarty->assign('courtV',$court);
    $smarty->display('viewPlayer.tpl');
}
}
else {
	header("Location:index.php");
}
?>