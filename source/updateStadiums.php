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

$select = mysql_query("SELECT id,name, stad_no, court_change, id_team FROM stadium WHERE DATEDIFF(CURRENT_DATE, date_change) >= 4");
while ($row = mysql_fetch_array($select)){
	$stadiums[] = $row;
}
if (isset($stadiums[0][0])) {
	print_r($stadiums);
	foreach($stadiums as $stadium){
		//update the stadium table
		$update = "UPDATE stadium SET court_type = court_change, date_change = NULL, court_change = 0 WHERE id = $stadium[0]";
		if (!(mysql_query($update))) {
			$error = 'Cannot update stadiums ' . mysql_error();
			echo $error;
		}
		//update the fixtures table
		$update = "UPDATE fixtures SET id_stadium = {$stadium[2]} WHERE id_team1 = {$stadium[3]} AND stad_no = {$stadium[1]} AND fixture_type = 1 
					AND DATEDIFF(round_date,CURRENT_DATE) >= 0";
		if (!(mysql_query($update))) {
			$error = 'Cannot update fixtures ' . mysql_error();
			echo $error;
		}
	}
}
else echo 'Nothing to update';


$end = microtime_float();

// Print results.
echo 'Script Execution Time: ' . round($end - $start, 3) . ' seconds';   


?>