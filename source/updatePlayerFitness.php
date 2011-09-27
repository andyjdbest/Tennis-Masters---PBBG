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


//fetch players
$query = mysql_query("SELECT p.idplayer,p.age,p.fitness,s.stamina FROM players AS p 
	JOIN player_stats AS s on p.idplayer = s.idplayer WHERE p.id_team > 0 AND p.fitness < 100");
while ($row = mysql_fetch_row($query)) {
	$players[] = $row;
}

foreach($players as $player) {
//	17-19yo 2 x Stamina, 20-24 1.5 x Stamina and 25-28 1 x Stamina and 29-30 0.75 x Stamina
	if ($player[1] <=19){
		$update = $player[2] + ($player[3] * 5);
	}
	else if ($player[1] <= 24) {
		$update = $player[2] + ($player[3] * 4);
	}
	else if ($player[1] <= 28) {
		$update = $player[2] + ($player[3] * 3);
	}
	else if ($player[1] <= 30) {
		$update = $player[2] + ($player[3] * 2);
	}
	
	if ($update >= 100) $update = 100;
	else if ($update < 30) $update = 30;
	 
	$update1 = "UPDATE players SET fitness = $update WHERE idplayer = {$player[0]}";
	echo "IDPlayer: $player[0]  OldFitness: {$player[2]} NewFitness: $update Stamina: $player[3] <br />";
	
	if (!(mysql_query($update1))) {
        	$error = 'Cannot update player fitness ' . mysql_error();
       	}      	
}

//Unmanaged players
$query = mysql_query("SELECT p.idplayer,p.fitness,FROM players AS p 
	WHERE p.id_team IS NULL AND p.fitness < 100");
while ($row = mysql_fetch_row($query)) {
	$players[] = $row;
}

foreach($players as $player) {
	 
	$update1 = "UPDATE players SET fitness = '50' WHERE idplayer = {$player[0]}";
	echo "IDPlayer: $player[0]  OldFitness: {$player[2]} NewFitness: '50' <br />";
	
	if (!(mysql_query($update1))) {
        	$error = 'Cannot update player fitness ' . mysql_error();
       	}      	
}



$newsText = "Player fitness added.";
$insert = "INSERT INTO news (NewsText,NewsDate) VALUES ('$newsText', NOW())";
if (!(mysql_query($insert))) {
    $error = 'Cannot insert news ' . mysql_error();
    echo $error;
}



$end = microtime_float();

// Print results.
echo 'Script Execution Time: ' . round($end - $start, 3) . ' seconds';   


?>