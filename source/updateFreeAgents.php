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
$players = array();


//fetch winning bids
$query = mysql_query("SELECT id_player, id_team, bid FROM fa_bids f1 WHERE won =0 
		AND bid = (SELECT MAX( f2.bid ) FROM fa_bids f2 WHERE f1.id_player = f2.id_player )");
while ($row = mysql_fetch_row($query)) {
	$players[] = $row;
}

if (isset($players[0][0])){
	$week = floor((mktime() - $season_start)/604800);
	foreach($players as $player) {
		
		//Deduct Finance From players
		$insert = "INSERT INTO finance (id_team,week,type,id_finance,amount) VALUES 
				({$player[1]},$week,'0','3',{$player[2]})";
		if (!(mysql_query($insert))) {
	        	$error = 'Cannot insert finance ' . mysql_error();
	        	echo $error;
	       	}
	       	//move player to new academy
	       	$insert = "INSERT INTO academy_player (id_team,id_player,date,transfer_type,value) 
				VALUES ({$player[1]},{$player[0]},NOW(),'1',{$player[2]})";	
		echo "$insert <br />";
		if (!(mysql_query($insert))) {
			$error = 'Cannot move player to new academy ' . mysql_error();
			echo $error;			
		}
	       	//fetch the new academy's country..
	       	$s = mysql_query("SELECT id_country,id_user FROM academy WHERE id_team = {$player[1]} LIMIT 1");
		$c = mysql_fetch_row($s);
		$cID = $c[0];
	       	//update players academy
	       	$update = "UPDATE players SET id_team = {$player[1]}, countryid = $cID 
	       			WHERE idplayer = {$player[0]}";
		if (!(mysql_query($update))) {
             		$error = 'Cannot update player table ' . mysql_error();
			echo $error;
        	}
        	
        	//update bid to won
        	$update = "UPDATE fa_bids SET won = '1' WHERE id_player = '{$player[0]}' AND id_team = '{$player[1]}' AND bid = '{$player[2]}'";
        	if (!(mysql_query($update))) {
             		$error = 'Cannot update bid table ' . mysql_error();
			echo $error;
        	}
        	        		
        	//update fa_players to won
        	$update = "UPDATE fa_players SET won = 1 WHERE id_player = {$player[0]}";
        	if (!(mysql_query($update))) {
             		$error = 'Cannot update player in fa_players ' . mysql_error();
			echo $error;
        	}
        	//todo - MAIL others
	}
	//delete all other bids
	$delete = "DELETE FROM fa_bids WHERE won = 0";
	if (!(mysql_query($delete))) {
        	$error = 'Cannot delete bids ' . mysql_error();
		echo $error;
        }
}
	
$newsText = "Free Agents Transfers took place.";
$insert = "INSERT INTO news (NewsText,NewsDate) VALUES ('$newsText', NOW())";
if (!(mysql_query($insert))) {
    $error = 'Cannot insert news ' . mysql_error();
    echo $error;
}



$end = microtime_float();

// Print results.
echo 'Script Execution Time: ' . round($end - $start, 3) . ' seconds';   


?>