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

set_time_limit(900);

$country = $_GET['country'];
switch ($country) {
	case 1:
		$leagues = array(1,2);
		//$leagues = array(1,2);
		break;
	case 2:
		$leagues = array(3,4);
		break;
	case 3:
		$leagues = array(5,6);
		break;
	case 4:
		$leagues = array(7,8);
		break;		
}

//update pr
foreach($leagues as $league) {
$query = mysql_query("SELECT pf, pa,id_team FROM league_table WHERE season = '$season' AND id_league=$league");
while ($row = mysql_fetch_row($query)) {
	$pr[] = $row;
}

foreach($pr as $p) {
	/*
	if ($p[1] == 0) {
		$update = "UPDATE league_table SET pr = $p[0] WHERE id_team = {$p[2]}";
	}
	
	else {
	*/
		$update = "UPDATE league_table SET pr = $p[0]-$p[1] WHERE id_team = {$p[2]}";
//	}
	if (!(mysql_query($update))) {
       	$error = 'Cannot update league table ' . mysql_error();
     	}
	//echo "$update <br />";
}
}

foreach($leagues as $league) {
	$teams = array();

	$query = mysql_query("SELECT points, pr, pf, pa, id_team FROM league_table WHERE season = '$season' AND id_league = $league");
	while ($row = mysql_fetch_row($query)) {
		$teams[] = $row;
	}
	//print_r($teams);
	//echo "<br />";
	rsort($teams);
	print_r($teams);
	$rank = 1;
	foreach($teams as $team) {
		$update = "UPDATE league_table SET rank = $rank WHERE id_team = $team[4]";
		//echo "$update <br />";
		if (!(mysql_query($update))) {
              	$error = 'Cannot update league table ' . mysql_error();
         	}
		$rank += 1;
	}
	
	//echo "<br />";	
} 


$end = microtime_float();

// Print results.
echo 'Script Execution Time: ' . round($end - $start, 3) . ' seconds';   


?>