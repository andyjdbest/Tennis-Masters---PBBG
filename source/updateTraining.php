<?php
#include the common file
require_once 'common.php';
        
#include the DBConfig file
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


$res = mysql_query("SELECT * FROM training_base");
while ($row = mysql_fetch_assoc($res)) {
	$training_base[] = $row;
}

//print_r($training_base);
$curr = date("Y-m-d : H:i:s", time());

$result = mysql_query("SELECT t.id_player,p.age,t.id_coach,c.id_level,l.bonus, t.skill,t.id_training,t.id_team 
					FROM `training_data` AS t
				 	JOIN players AS p ON p.idplayer = t.id_player 
				 	JOIN coach AS c ON t.id_coach = c.id_coach 
				 	JOIN coach_level AS l ON l.id_coachlevel = c.id_level 
				 	GROUP BY t.id_player ORDER BY week DESC");
while ($row = mysql_fetch_array($result)) {
	$training[] = $row;
}

//$training = array_unique($training);
$players = array();

//get the Wage data
$result = mysql_query("SELECT * FROM wage_base;");
while ($row = mysql_fetch_row($result)) {
	$wage[] = $row; 
}

if (isset($training)) {
	foreach($training as $t) {
		$player = $t[0];

		if (!in_array($player,$players))
		{
			$age = $t[1];
			$bonus = $t[4];
			$skill = strtolower($t[5]);
			$t_id = $t[6];
			$team = $t[7];
			if ($t[1] <= 19) {
			//print_r($training_base[0][$skill]);
				$train_up = $training_base[0][$skill] + $bonus * $training_base[0][$skill];
			//print $train_up;			
			}
			else if ($t[1] <= 22) {
				$train_up = $training_base[1][$skill] + $bonus * $training_base[1][$skill];
			}
			else if ($t[1] <= 25) {
				$train_up = $training_base[2][$skill] + $bonus * $training_base[2][$skill];
			}
			else if ($t[1] <= 30) {
				$train_up = $training_base[3][$skill] + $bonus * $training_base[3][$skill];
			}
		
			if (isset($train_up) && $skill != 'rest') {
				
				$select = mysql_query("SELECT rating," .$skill. " FROM player_stats WHERE idplayer = $player");
				//$select = mysql_query("SELECT * FROM player_stats WHERE idplayer = $player");
				$row = mysql_fetch_assoc($select);
				$up = $row[$skill] + $train_up;
				
				$rating = $row['rating'] + $train_up;
				$update = "UPDATE player_stats SET " .$skill . " =  $up, rating = $rating WHERE idplayer = $player";
				if (!(mysqli_query($conn, $update))) {
             				$error = mysqli_error($conn);
			 		echo $error;
        			}
        			//check if training pops
        			$old = ceil($row[$skill]);
        			echo "$Update Value: $up - Ceiling Value: $old <br />";	
        			if ($up >= ceil($row[$skill])){
        				//popped training, insert into training report
        				echo 'popped';
					$pop = "
					INSERT INTO `training_report` (`id_team` ,`id_player` ,`skill` ,`update` ,`week`) 
					VALUES ('$team',  '$player',  '$skill',  '$old',  '$curr')";
					echo "<br /> $pop <br />" ;
					if (!(mysql_query($pop))) {
						$error = 'Error while adding training report details.' . mysql_error();
                			}        				
        			}
        			
				//temp code - 
				$insert = "INSERT INTO training_temp(id_player,skill,increase) VALUES ($player,'$skill',$train_up)";
				if (!(mysqli_query($conn, $insert))) {
             				$error = mysqli_error($conn);
			 		echo $error;
        			}
        			
				//update the training_data table to show that training has taken place
				$update = "UPDATE training_data SET final = 1 WHERE id_training = $t_id";
				if (!(mysqli_query($conn, $update))) {
             				$error = mysqli_error($conn);
			 		echo $error;
        			}
         			
			}
		
			array_push($players,$player);
		} //end if not in array
	}
}

//change the wage
$select = mysql_query("SELECT s.serve,s.forehand,s.backhand,s.volley,s.power,s.consistency,s.speed,s.stamina,p.idplayer,p.age FROM player_stats AS s JOIN players AS p ON p.idplayer = s.idplayer WHERE p.id_team > 0");
while($row = mysql_fetch_array($select)) {
	$players[] = $row;
}
//print_r($players);

foreach($players as $p){
				//print_r($p);
				$age = $p[9];
				$p_wage = (int)(($p[0] + $p[1] + $p[2] + $p[3]) * $wage[$age-17][1] + ($p[4] + $p[5] + $p[6] + $p[7]) * $wage[$age-17][2]);
				print $p_wage;
				//echo "<br />";
				$update = "UPDATE players SET wage = $p_wage WHERE idplayer = '{$p[8]}'";
				
				if (!(mysqli_query($conn,$update))) {
              				$error = 'Cannot update wages ' . mysqli_error($conn);
         			}
}

$newsText = "Training updates taken place.";
$insert = "INSERT INTO news (NewsText,NewsDate) VALUES ('$newsText', NOW())";
if (!(mysql_query($insert))) {
    $error = 'Cannot insert news ' . mysql_error();
    echo $error;
}

$end = microtime_float();

// Print results.
echo 'Script Execution Time: ' . round($end - $start, 3) . ' seconds';   

?> 