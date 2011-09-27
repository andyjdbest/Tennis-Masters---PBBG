<?php

#include the common file
require_once 'common.php';
require_once 'DBconfig.php';

// Function to calculate script execution time.
function microtime_float ()
{
    list ($msec, $sec) = explode(' ', microtime());
    $microtime = (float)$msec + (float)$sec;
    return $microtime;
}
// Get starting time.
$start = microtime_float(); 

//set_time_limit(600);
// set the countries
$countries = array(1,2,3,4);

foreach ($countries as $country) {
	$ranking = array();
	$players = array();
	//fetch players
	$query = mysql_query("SELECT idplayer,points,rank FROM players WHERE id_team > 0 and countryid = $country");
	while ($row = mysql_fetch_row($query)) {
		$players[] = $row;
		$worldPlayers[] = $row;
	}
//print_r($players);

	foreach($players as $player) {
	
		$matches = array();
		$query = mysql_query("SELECT m.id_winner FROM matches AS m 
			JOIN fixtures AS f ON m.id_fixture = f.id_fixture 
			WHERE f.fixture_type <> 2 AND (id_player1 = {$player[0]} OR id_player2 = {$player[0]})");
//		$query = mysql_query("SELECT id_winner FROM matches WHERE id_player1 = {$player[0]} OR id_player2 = {$player[0]}");
		while ($row = mysql_fetch_row($query)) {
			$matches[] = $row;
		}	
	
		//print_r($matches);
		//echo "<BR />";
	
		$count = 0; $wins = 0;
		if (isset($matches[0][0])){
			foreach ($matches as $match) {
				$count += 1;
				if ($match[0] == $player[0]) {
					$wins += 1;
				}
			}
		}
	
		if ($count > 0){
			$points = (($wins * 10) + (($count - $wins) * (-2))) / $count;
		}
	
		echo "$player[0] P=$count W=$wins Points=$points <BR />";
		$ranking[] = array($wins,$count,$points,$player[0]);
		$worldRanking[] = array($wins,$count,$points,$player[0]);
	}
	
	rsort($ranking);
	//print_r($ranking);
	$r = 0; // rank 
	$pos = 0;
	$pr = 0; // player rank
	$prev = 0; //previous wins
	$prevG = 0; //previous games played
	//$index = 1;
	foreach($ranking as $rank) {
		if ($rank[0] == $prev) {
			if ($rank[1] == $prevG) {
				$pr = $r;
				$pos += 1; //increase the number of players at this position
			}
			else {
				$pr = $r + 1 + $pos;
				$pos = 0; //set pos = 0;	
				$r = $pr;
			}
		}	
		else {
			$pr = $r + 1 + $pos;
			$pos = 0; //set pos = 0;	
			$r = $pr;
		}
		$prev = $rank[0]; //set prev to current
		$prevG = $rank[1];
		echo "$rank[3] Wins=$rank[0] Games = $rank[1] Rank=$pr <br/>";
	//	$index += 1;
		$update = "UPDATE players SET rank = $pr, points = {$rank[2]}, rank_pos = $pos WHERE idplayer = {$rank[3]}";
		//echo "$update <br />";
	
		if (!(mysql_query($update))) {
            	$error = 'Cannot update player rankings ' . mysql_error();
       	}
	
	}
}

//now for the world ranking
rsort($worldRanking);
	//print_r($worldRanking);
$r = 0; // rank 
$pos = 0;
$pr = 0; // player rank
$prev = 0;
$prevG = 0;
//$index = 1;
foreach($worldRanking as $rank) {
	if ($rank[0] == $prev) {
		if ($rank[1] == $prevG) {
			$pr = $r;
			$pos += 1; //increase the number of players at this position
		}
		else {
			$pr = $r + 1 + $pos;
			$pos = 0; //set pos = 0;	
			$r = $pr;
		}
	}	
	else {
		$pr = $r + 1 + $pos;
		$pos = 0; //set pos = 0;	
		$r = $pr;
	}
	$prev = $rank[0]; //set prev to current
	$prevG = $rank[1];
	
	echo "$rank[3] Wins=$rank[0] Games=$rank[1] Rank=$pr <br/>";
	//	$index += 1;
	$update = "UPDATE players SET wrank = $pr, wrank_pos = $pos WHERE idplayer = {$rank[3]}";
		//echo "$update <br />";
	
	if (!(mysql_query($update))) {
            	$error = 'Cannot update player world rankings ' . mysql_error();
				echo $error;
    }
	
}

$newsText = "Player Rankings updated.";
$insert = "INSERT INTO news (NewsText,NewsDate) VALUES ('$newsText', NOW())";
if (!(mysql_query($insert))) {
    $error = 'Cannot insert news ' . mysql_error();
    echo $error;
}

$end = microtime_float();

// Print results.
echo 'Script Execution Time: ' . round($end - $start, 3) . ' seconds';   


?>