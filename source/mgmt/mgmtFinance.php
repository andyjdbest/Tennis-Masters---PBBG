<?php

 #include the common file
 require_once "common.php";
        
 #include the DBConfig file
 include ("../DBconfig.php");
 
function calculateWage() {
	
	//get the Wage data
	$result = mysql_query("SELECT * FROM wage_base;");
	while ($row = mysql_fetch_row($result)) {
		$wage[] = $row; 
	}
	//print_r($wage);
	//print($wage[1][0]);
	
	//fetch all active players
	$result = mysql_query("SELECT p.idplayer,p.age,s.serve,s.forehand,s.backhand,s.volley,s.power,s.consistency,s.speed,s.stamina FROM `academy_player` AS a JOIN players AS p ON a.id_player = p.idplayer JOIN player_stats AS s ON s.idplayer = p.idplayer JOIN user_academy AS ua ON ua.id_academy = a.id_team JOIN academy AS c ON c.id_team = a.id_team WHERE c.id_user IS NOT NULL");
	while ($row = mysql_fetch_row($result)) {
		$player[] = $row;
	}
	//print_r($player);
	
	//process player info
	if (isset($player)){
	foreach($player as $p) {
		$age = $p[1];
		$id = $p[0];
		//echo "Player age is {$p[1]} " . "<BR />";
		$p_wage = (int)($p[2] + $p[3] + $p[4] + $p[5]) * $wage[$age-17][1] + ($p[6] + $p[7] + $p[8] + $p[9]) * $wage[$age-17][2];
		
		//echo "Player age is $p_wage " . "<BR />";
		$update = "UPDATE players SET wage = $p_wage WHERE idplayer = $id";
		if (!(mysql_query($update))) {
              $error = 'Cannot update wages ' . mysqli_error($conn);
         }
	}
	}
}


session_start();
if (@$_SESSION['authenticated'] == 'true' && @$_SESSION['admin'] == 'true')
{
	//if ($_POST){
		calculateWage();
	//}
   
           
				 
$smarty->assign('error',$error);
$smarty->assign('message',$message);
//$smarty->display('mgmtFinance.tpl');
}
?>