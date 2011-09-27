<?php
$dbhost = 'localhost';
// - for live
$dbuser = 'USERNAME';
$dbpass = 'PASSWORD';
$dbname = 'DBNAME';


$conn = mysqli_connect($dbhost,$dbuser,$dbpass)
	or die('Error connecting to mysql');
mysqli_select_db($conn,$dbname);

$conn1 = mysql_connect($dbhost,$dbuser,$dbpass) or die ("Error connecting to mysql");
mysql_select_db($dbname);
?>