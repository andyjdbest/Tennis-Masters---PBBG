<?php

require_once 'common.php';
require_once 'DBconfig.php';

session_start();
if (@$_SESSION['authenticated'] == 'true' & @$_SESSION['assigned'] == 1) {
	
	if ($_GET['message']) {
		if ($_GET['message'] == 'Failed') {
			$transfer_message = '';
		}
		elseif ($_GET['message'] == 'Success') {
			$transfer_message = 'Your player is now a free agent';
		}
		elseif ($_GET['message'] == 'BidFailed') {
			$transfer_message = 'An error has occured in your bid';
		}
		elseif ($_GET['message'] == 'BidFailed1') {
			$transfer_message = 'You have an existing bid during the current bidding period';
		}
		elseif ($_GET['message'] == 'BidSucess') {
			$transfer_message = 'Your bid has been placed';
		}
	}
	
	if ($_GET['playerid']){
	$playerdata = array();
	$publicBidData = array();
	$privateBid = 'a';
	$ownBid = '';
	//$own = 0;
	if (ctype_digit($_GET['playerid']) == false) {
		$error = "Invalid input";
	}
	else {
	$player = $_GET['playerid'];
	$team = $_SESSION['id_team'];
	
	$week = floor((mktime() - $season_start)/604800);
	
	//fetch required player summary details 
	$query = "SELECT CONCAT(p.firstname, ' ', p.lastname) AS playername, p.idplayer, p.age, p.handed, p.fitness, p.wage, p.nationality,
		FLOOR( s.serve ) AS serve, FLOOR( s.volley ) AS volley, FLOOR( s.forehand ) AS forehand, FLOOR( s.backhand ) AS backhand, 
		FLOOR( s.speed ) AS speed, FLOOR( s.consistency ) AS consistency, FLOOR( s.stamina ) AS stamina, FLOOR( s.power ) AS power, 
		s.rating AS srating,p.idplayer, f.set_price
			FROM players AS p
			JOIN player_stats AS s ON p.idplayer = s.idplayer
			JOIN fa_players AS f on p.idplayer = f.id_player
			WHERE p.idplayer = '$player' AND f.won = 0 LIMIT 1";
	$r = mysql_query($query);
	
	while ($ob = mysql_fetch_array($r)) {
		   $playerdata = $ob;
    }
	//print_r($playerdata);
    $played = 0; $wins = 0; $court = array(0,0,0,0);
	if (isset($playerdata[0])) {
			//echo 'test';
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
		
			//fetch bids
			$query = mysql_query("SELECT f.id_team,a.team_name,f.bid FROM fa_bids AS f 
					JOIN academy AS a ON a.id_team = f.id_team WHERE f.isPrivate = 0 AND f.won = 0 and f.id_player = '$player'");
			while ($row = mysql_fetch_array($query)) {
				   $publicBidData[] = $row;
			}
			//print_r($publicBidData);
			
			$query = mysql_query("SELECT COUNT(id_team) FROM fa_bids
					WHERE isPrivate = 1 AND won = 0 AND id_player = '$player'");
			$row = mysql_fetch_row($query);
			$privateBid = $row[0];
			if ($privateBid == 1)
				$privateBid = "1 Private Bid";
			else 
				$privateBid = "$privateBid Private Bids";
				
			$query = mysql_query("SELECT MAX(bid) FROM fa_bids WHERE id_player='$player' AND id_team='$team' AND won = 0");
			$row = mysql_fetch_row($query);
			
			if (isset($row[0])){
				$ownBid = 'You bid ' . $row[0] . ' for this player';
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
	$smarty->assign('played',$played);
	$smarty->assign('wins',$wins);
	$smarty->assign('courtV',$court);
	$smarty->assign('publicBidData',$publicBidData);
	$smarty->assign('privateBid',$privateBid);
	$smarty->assign('ownBid',$ownBid);
	$smarty->assign('resultsData',$resultsData);
	$smarty->assign('played',$played);
	$smarty->assign('wins',$wins);
	
    $smarty->display('viewFreeAgent.tpl');
}
}
else {
	header("Location:index.php");
}
?>