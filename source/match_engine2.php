<?php
// Match Engine PHP v 1.0 - 
// Initial - Shaun Nawrocki
// Modified - Andy Dbest


ini_set ("display_errors", "1");
error_reporting(E_ALL);

#include the common file
require_once 'common.php';
require_once 'DBconfig.php';
require_once 'commentaryDB.php';


set_time_limit(900);
// INITIALIZE GLOBAL COMMENTARY ARRAY
$commentary = array();
$c = 0;

//Before we call Match_Engine function, need to get tactics.
$tactics = array();
$query = "SELECT * FROM tacticbonus";
$result = mysql_query($query);
while ($row = mysql_fetch_row($result)) {
       $tactics[] = $row;
}

// ******************************************
// 
$today = date('Y-m-d H:i:s', strtotime('today' . '14 hours'));
//echo $today;
//$today = "2010-08-01 14:00:00";
$fixtures = array();
$select = mysql_query("SELECT id_fixture,id_team1,id_team2,id_stadium FROM fixtures WHERE round_date = '$today' AND fixture_type = 2");
while ($row = mysql_fetch_row($select)) {
	$fixtures[] = $row;
}
$index = 0;
//print_r($fixtures);
if (isset($fixtures)) {
		foreach($fixtures as $fixture) {
			//$teamHome = array();
			//$teamAway = array();
			$defaultAway = 0; $defaultHome = 0;
			//obtain the match orders of the home academy
			$select = mysql_query("SELECT id_player,id_tactic,id_agg 
								FROM match_order WHERE id_fixture = '$fixture[0]' AND id_team = '$fixture[1]' 
								ORDER BY id_matchorder LIMIT 3");
			while ($row = mysql_fetch_row($select)) {
				   $teamHome[] = $row;
			}
			print_r($teamHome); echo "<br />";
			//obtain the match orders of the away academy
			$select = mysql_query("SELECT id_player,id_tactic,id_agg 
								FROM match_order WHERE id_fixture = '$fixture[0]' AND id_team = '$fixture[2]' 
								ORDER BY id_matchorder LIMIT 3");
			while ($row = mysql_fetch_row($select)) {
				   $teamAway[] = $row;
			}
			
			//if match orders are not set - set default orders
			if (!isset($teamHome[$index][0])) {
				$select = mysql_query("SELECT id_player,id_tactic,id_agg 
							FROM match_order WHERE id_team = '$fixture[1]' AND defaultT = '1'
							ORDER BY id_matchorder LIMIT 3");
				while ($row = mysql_fetch_row($select)){
					$teamHome[] = $row;
				}
				if (!isset($teamHome[$index][0])){
					$select = mysql_query("SELECT idplayer,0,1 
									FROM players WHERE id_team = '$fixture[1]' LIMIT 3");
					while ($row = mysql_fetch_row($select)) {
					   $teamHome[] = $row;
					}
					$defaultHome = 1;
				}
				 
			}
			
			if (!isset($teamAway[$index][0])) {
				$select = mysql_query("SELECT id_player,id_tactic,id_agg 
							FROM match_order WHERE id_team = '$fixture[2]' AND defaultT = '1'
							ORDER BY id_matchorder LIMIT 3");
				while ($row = mysql_fetch_row($select)){
					$teamAway[] = $row;
				}
				
				if (!isset($teamAway[$index][0])){
					$select = mysql_query("SELECT idplayer,0,1 
								FROM players WHERE id_team = '$fixture[2]' LIMIT 3");
					while ($row = mysql_fetch_row($select)) {
						$teamAway[] = $row;
					}
					$defaultAway = 1;
				}
				 
                		
			}
                        
            		//check if players are still in academy
			$select = mysql_query("SELECT idplayer FROM players WHERE id_team = '$fixture[1]'");
			while ($row = mysql_fetch_row($select)) {
				   $home[] = $row;
			}
            		$select = mysql_query("SELECT idplayer FROM players WHERE id_team = '$fixture[2]'");
			while ($row = mysql_fetch_row($select)) {
				   $away[] = $row;
			}

	$in = 0;
	if ($defaultHome != 1) {
		for ($i=0;$i <3;$i++){
			$playerID = $teamHome[$index+$i][0];
			foreach($home as $th){
				$in = 0;
				if ($th[0] == $playerID) {
					$in = 1;
					break;
				}
			}
			if ($in != 1) {
			//player not in the team anymore
			  $query = mysql_query("SELECT idplayer,'0','1' FROM players WHERE id_team = '$fixture[1]' AND idplayer NOT IN 
								(SELECT id_player FROM match_order WHERE id_fixture = '$fixture[0]' AND id_team = '$fixture[1]') LIMIT 1");
			  $row = mysql_fetch_row($query);
			  $teamHome[$index+$i][0] = $row[0];
			}
		}
	}
	

	$in = 0;
        if ($defaultAway != 1) {
		for ($i=0;$i <3;$i++){
			$playerID = $teamAway[$index+$i][0];
			foreach($away as $ta){
				$in = 0;
				if ($ta[0] == $playerID) {
					$in = 1;
					break;
				}
			}
			
			if ($in != 1) {
			//player not in the team anymore
			  $query = mysql_query("SELECT idplayer,'0','1' FROM players WHERE id_team = '$fixture[2]' AND idplayer NOT IN 
								(SELECT id_player FROM match_order WHERE id_fixture = '$fixture[0]' AND id_team = '$fixture[2]') LIMIT 1");
			  $row = mysql_fetch_row($query);
			  $teamAway[$index+$i][0] = $row[0];
			}
		}	
	} 	//print_r($teamAway);
			//Run the ME code thrice.
			$result1 = Match_Engine($fixture[0],$teamHome[$index][0],$teamHome[$index][1],$teamHome[$index][2],$teamAway[$index][0],$teamAway[$index][1],$teamAway[$index][2],$fixture[3]);
			$result2 = Match_Engine($fixture[0],$teamHome[$index+1][0],$teamHome[$index+1][1],$teamHome[$index+1][2],$teamAway[$index+1][0],$teamAway[$index+1][1],$teamAway[$index+1][2],$fixture[3]);
			$result3 = Match_Engine($fixture[0],$teamHome[$index+2][0],$teamHome[$index+2][1],$teamHome[$index+2][2],$teamAway[$index+2][0],$teamAway[$index+2][1],$teamAway[$index+2][2],$fixture[3]);
				
			$next = $index + 1; $third = $index + 2;
			$insert = "INSERT INTO match_order (id_fixture,id_team,number,id_player,id_tactic,id_agg) 
					VALUES ({$fixture[0]}, {$fixture[1]}, 1, {$teamHome[$index][0]},{$teamHome[$index][1]},{$teamHome[$index][2]})
					ON DUPLICATE KEY UPDATE id_player = {$teamHome[$index][0]}, id_tactic={$teamHome[$index][1]}, id_agg={$teamHome[$index][2]}";
			if (!mysql_query($insert))
			 echo "1. mysql_error() ";
			$insert = "INSERT INTO match_order (id_fixture,id_team,number,id_player,id_tactic,id_agg) 
					VALUES ({$fixture[0]}, {$fixture[1]}, 2, {$teamHome[$next][0]},{$teamHome[$next][1]},{$teamHome[$next][2]})
					ON DUPLICATE KEY UPDATE id_player = {$teamHome[$next][0]}, id_tactic={$teamHome[$next][1]}, id_agg={$teamHome[$next][2]}";
			if (!mysql_query($insert))
			 echo "2. mysql_error()";
			$insert = "INSERT INTO match_order (id_fixture,id_team,number,id_player,id_tactic,id_agg) 
					VALUES ({$fixture[0]}, {$fixture[1]}, 3, {$teamHome[$third][0]},{$teamHome[$third][1]},{$teamHome[$third][2]})
					ON DUPLICATE KEY UPDATE id_player = {$teamHome[$third][0]}, id_tactic={$teamHome[$third][1]}, id_agg={$teamHome[$third][2]}";
			if (!mysql_query($insert))
			 echo "3. mysql_error()";
			$insert = "INSERT INTO match_order (id_fixture,id_team,number,id_player,id_tactic,id_agg) 
					VALUES ({$fixture[0]}, {$fixture[2]}, 1, {$teamAway[$index][0]},{$teamAway[$index][1]},{$teamAway[$index][2]})
					ON DUPLICATE KEY UPDATE id_player = {$teamAway[$index][0]}, id_tactic={$teamAway[$index][1]}, id_agg={$teamAway[$index][2]}";
			if (!mysql_query($insert))
			 echo "4. mysql_error()";
			$insert = "INSERT INTO match_order (id_fixture,id_team,number,id_player,id_tactic,id_agg) 
					VALUES ({$fixture[0]}, {$fixture[2]}, 2, {$teamAway[$next][0]},{$teamAway[$next][1]},{$teamAway[$next][2]})
					ON DUPLICATE KEY UPDATE id_player = {$teamAway[$next][0]}, id_tactic={$teamAway[$next][1]}, id_agg={$teamAway[$next][2]}";
			if (!mysql_query($insert))
			 echo "5. mysql_error()";
			$insert = "INSERT INTO match_order (id_fixture,id_team,number,id_player,id_tactic,id_agg) 
					VALUES ({$fixture[0]}, {$fixture[2]}, 3, {$teamAway[$third][0]},{$teamAway[$third][1]},{$teamAway[$third][2]})
					ON DUPLICATE KEY UPDATE id_player = {$teamAway[$third][0]}, id_tactic={$teamAway[$third][1]}, id_agg={$teamAway[$third][2]}";
			if (!mysql_query($insert))
			 echo "6." . mysql_error();
			
			$homeScore = 0; $awayScore = 0;
			if ($result1 == 1) $homeScore += 1; else $awayScore += 1;
			if ($result2 == 1) $homeScore += 1; else $awayScore += 1;
			if ($result3 == 1) $homeScore += 1; else $awayScore += 1;

			$scoreText = '';
			$scoreText .= "$homeScore-$awayScore#";

			if ($homeScore > $awayScore) {
				//update the fixtures table with the result
				$update = "UPDATE fixtures SET id_winner = '$fixture[1]', score = '$scoreText' WHERE id_fixture = '$fixture[0]'";
				if (!mysql_query($update)) {
				//failure
					echo mysql_error();
				}
			}
			else if ($awayScore > $homeScore) {
				//update the fixtures table with the result
				$update = "UPDATE fixtures SET id_winner = '$fixture[2]', score = '$scoreText' WHERE id_fixture = '$fixture[0]'";
				if (!mysql_query($update)) {
				//failure
					echo mysql_error();
				}
			}


			$index = $index + 3;
		}
	}
	flush();
	
$newsText = "Challenge fixtures played.";
$insert = "INSERT INTO news (NewsText,NewsDate) VALUES ('$newsText', NOW())";
if (!(mysql_query($insert))) {
    $error = 'Cannot insert news ' . mysql_error();
    echo $error;
}

	
function Match_Engine($matchID, $homePlayerID, $homePlayerTactic, $homePlayerAgg, $awayPlayerID, $awayPlayerTactic, $awayPlayerAgg, $courtType)
{

//USE GLOBAL COMMENTARY ARRAY
global $commentary;
global $c;

//Two tables are created for the player, one is called player and the other is player_stats. 
//Player contains most of the details of the players,
//Player_stats table contains the skills of the player.
$r = mysql_query("SELECT CONCAT( p.firstname, ' ', p.lastname ) AS playername, p.idplayer, p.age, p.handed, p.fitness, FLOOR( s.serve ) AS serve, FLOOR( s.volley ) AS volley, FLOOR( s.forehand ) AS forehand, FLOOR( s.backhand ) AS backhand, FLOOR( s.speed ) AS speed, FLOOR( s.consistency ) AS consistency, FLOOR( s.stamina ) AS stamina, FLOOR( s.power ) AS power, FLOOR( s.rating ) AS srating
			FROM players AS p
			JOIN player_stats AS s ON p.idplayer = s.idplayer
			WHERE p.idplayer = '$homePlayerID' LIMIT 1");
$homePlayerdata = mysql_fetch_row($r);

$homePlayerName = $homePlayerdata[0];
$homePlayerID = $homePlayerdata[1];
$homePlayerFitness = $homePlayerdata[4];
$homePlayerServe = $homePlayerdata[5];
$homePlayerVolley = $homePlayerdata[6];
$homePlayerForehand = $homePlayerdata[7];
$homePlayerBackhand = $homePlayerdata[8];
$homePlayerSpeed = $homePlayerdata[9];
$homePlayerConsistency = $homePlayerdata[10];
$homePlayerStamina = $homePlayerdata[11];
$homePlayerPower = $homePlayerdata[12];


// Andy's idea        .9*(skills) + .1*(shop_effect)

// Connect to Player DB with away player id
$r2 = mysql_query("SELECT CONCAT( p.firstname, ' ', p.lastname ) AS playername, p.idplayer, p.age, p.handed, p.fitness, FLOOR( s.serve ) AS serve, FLOOR( s.volley ) AS volley, FLOOR( s.forehand ) AS forehand, FLOOR( s.backhand ) AS backhand, FLOOR( s.speed ) AS speed, FLOOR( s.consistency ) AS consistency, FLOOR( s.stamina ) AS stamina, FLOOR( s.power ) AS power, FLOOR( s.rating ) AS srating
			FROM players AS p
			JOIN player_stats AS s ON p.idplayer = s.idplayer
			WHERE p.idplayer = '$awayPlayerID' LIMIT 1");
$awayPlayerdata = mysql_fetch_row($r2);
$awayPlayerName = $awayPlayerdata[0];
$awayPlayerID = $awayPlayerdata[1];
$awayPlayerFitness = $awayPlayerdata[4];
$awayPlayerServe = $awayPlayerdata[5];
$awayPlayerVolley = $awayPlayerdata[6];
$awayPlayerForehand = $awayPlayerdata[7];
$awayPlayerBackhand = $awayPlayerdata[8];
$awayPlayerSpeed = $awayPlayerdata[9];
$awayPlayerConsistency = $awayPlayerdata[10];
$awayPlayerStamina = $awayPlayerdata[11];
$awayPlayerPower = $awayPlayerdata[12];

//Need to add Home/Away Player tactic bonus then Court bonus.

 //1 ServeVolley SV       2 DefensiveBaseline DB       3 AggresiveBaseline AB       4 AllCourt AC
 //1 Grass       2 Clay       3 Hard       4 Rubber(Indoor)

if($courtType == 1)
{
    if($homePlayerTactic == 1) //Grass & SV
    {
        $homePlayerServe = $homePlayerServe * 1.8;
        $homePlayerVolley = $homePlayerVolley * 1.8;
    }
    else if($homePlayerTactic == 2) //Grass & DB
    {
        $homePlayerSpeed = $homePlayerSpeed * 1.5;
        $homePlayerPower = $homePlayerPower * 1.5;
    }
    else if($homePlayerTactic == 3) //Grass & AB
    {
        $homePlayerForehand = $homePlayerForehand * 1.5;
        $homePlayerBackhand = $homePlayerBackhand * 1.5;
    }
    else if($homePlayerTactic == 4) //Grass & AC
    {
        $homePlayerServe = $homePlayerServe * 1.2;
        $homePlayerVolley = $homePlayerVolley * 1.2;
        $homePlayerForehand = $homePlayerForehand * 1.2;
        $homePlayerBackhand = $homePlayerBackhand * 1.2;
        $homePlayerSpeed = $homePlayerSpeed * 1.2;
    }
    if($awayPlayerTactic == 1) //Grass & SV
    {
        $awayPlayerServe = $awayPlayerServe * 1.8;
        $awayPlayerVolley = $awayPlayerVolley * 1.8;
    }
    else if($awayPlayerTactic == 2) //Grass & DB
    {
        $awayPlayerSpeed = $awayPlayerSpeed * 1.5;
        $awayPlayerPower = $awayPlayerPower * 1.5;
    }
    else if($awayPlayerTactic == 3) //Grass & AB
    {
        $awayPlayerForehand = $awayPlayerForehand * 1.5;
        $awayPlayerBackhand = $awayPlayerBackhand * 1.5;
    }
    else if($awayPlayerTactic == 4) //Grass & SV
    {
        $awayPlayerServe = $awayPlayerServe * 1.2;
        $awayPlayerVolley = $awayPlayerVolley * 1.2;
        $awayPlayerForehand = $awayPlayerForehand * 1.2;
        $awayPlayerBackhand = $awayPlayerBackhand * 1.2;
        $awayPlayerSpeed = $awayPlayerSpeed * 1.2;
    }
}
else if($courtType == 2)
{
    if($homePlayerTactic == 1) //Clay & SV
    {
        $homePlayerServe = $homePlayerServe * 1.2;
        $homePlayerVolley = $homePlayerVolley * 1.2;
    }
    else if($homePlayerTactic == 2) //Clay & DB
    {
        $homePlayerSpeed = $homePlayerSpeed * 1.8;
        $homePlayerPower = $homePlayerPower * 1.6;
    }
    else if($homePlayerTactic == 3) //Clay & AB
    {
        $homePlayerForehand = $homePlayerForehand * 1.9;
        $homePlayerBackhand = $homePlayerBackhand * 1.9;
    }
    else if($homePlayerTactic == 4) //Clay & AC
    {
        $homePlayerServe = $homePlayerServe * 1.1;
        $homePlayerVolley = $homePlayerVolley * 1.1;
        $homePlayerForehand = $homePlayerForehand * 1.1;
        $homePlayerBackhand = $homePlayerBackhand * 1.1;
        $homePlayerSpeed = $homePlayerSpeed * 1.1;
    }
    if($awayPlayerTactic == 1) //Clay & SV
    {
        $awayPlayerServe = $awayPlayerServe * 1.2;
        $awayPlayerVolley = $awayPlayerVolley * 1.2;
    }
    else if($awayPlayerTactic == 2) //Clay & DB
    {
        $awayPlayerSpeed = $awayPlayerSpeed * 1.8;
        $awayPlayerPower = $awayPlayerPower * 1.6;
    }
    else if($awayPlayerTactic == 3) //Clay & AB
    {
        $awayPlayerForehand = $awayPlayerForehand * 1.9;
        $awayPlayerBackhand = $awayPlayerBackhand * 1.9;
    }
    else if($awayPlayerTactic == 4) //Clay & SV
    {
        $awayPlayerServe = $awayPlayerServe * 1.1;
        $awayPlayerVolley = $awayPlayerVolley * 1.1;
        $awayPlayerForehand = $awayPlayerForehand * 1.1;
        $awayPlayerBackhand = $awayPlayerBackhand * 1.1;
        $awayPlayerSpeed = $awayPlayerSpeed * 1.1;
    }
}
else if($courtType == 3)
{
    if($homePlayerTactic == 1) //Hard & SV
    {
        $homePlayerServe = $homePlayerServe * 1.5;
        $homePlayerVolley = $homePlayerVolley * 1.5;
    }
    else if($homePlayerTactic == 2) //Hard & DB
    {
        $homePlayerSpeed = $homePlayerSpeed * 1.6;
        $homePlayerPower = $homePlayerPower * 1.8;
    }
    else if($homePlayerTactic == 3) //Hard & AB
    {
        $homePlayerForehand = $homePlayerForehand * 1.6;
        $homePlayerBackhand = $homePlayerBackhand * 1.6;
    }
    else if($homePlayerTactic == 4) //Hard & AC
    {
        $homePlayerServe = $homePlayerServe * 1.3;
        $homePlayerVolley = $homePlayerVolley * 1.3;
        $homePlayerForehand = $homePlayerForehand * 1.3;
        $homePlayerBackhand = $homePlayerBackhand * 1.3;
        $homePlayerSpeed = $homePlayerSpeed * 1.3;
    }
    if($awayPlayerTactic == 1) //Hard & SV
    {
        $awayPlayerServe = $awayPlayerServe * 1.5;
        $awayPlayerVolley = $awayPlayerVolley * 1.5;
    }
    else if($awayPlayerTactic == 2) //Hard & DB
    {
        $awayPlayerSpeed = $awayPlayerSpeed * 1.6;
        $awayPlayerPower = $awayPlayerPower * 1.8;
    }
    else if($awayPlayerTactic == 3) //Hard & AB
    {
        $awayPlayerForehand = $awayPlayerForehand * 1.6;
        $awayPlayerBackhand = $awayPlayerBackhand * 1.6;
    }
    else if($awayPlayerTactic == 4) //Hard & SV
    {
        $awayPlayerServe = $awayPlayerServe * 1.3;
        $awayPlayerVolley = $awayPlayerVolley * 1.3;
        $awayPlayerForehand = $awayPlayerForehand * 1.3;
        $awayPlayerBackhand = $awayPlayerBackhand * 1.3;
        $awayPlayerSpeed = $awayPlayerSpeed * 1.3;
    }
}
else if($courtType == 4)
{
    if($homePlayerTactic == 1) //Rubber(Indoor) & SV
    {
        $homePlayerServe = $homePlayerServe * 1.2;
        $homePlayerVolley = $homePlayerVolley * 1.2;
    }
    else if($homePlayerTactic == 2) //Rubber(Indoor) & DB
    {
        $homePlayerSpeed = $homePlayerSpeed * 1.1;
        $homePlayerPower = $homePlayerPower * 1.1;
    }
    else if($homePlayerTactic == 3) //Rubber(Indoor) & AB
    {
        $homePlayerForehand = $homePlayerForehand * 1.3;
        $homePlayerBackhand = $homePlayerBackhand * 1.3;
    }
    else if($homePlayerTactic == 4) //Rubber(Indoor) & AC
    {
        $homePlayerServe = $homePlayerServe * 1.1;
        $homePlayerVolley = $homePlayerVolley * 1.1;
        $homePlayerForehand = $homePlayerForehand * 1.1;
        $homePlayerBackhand = $homePlayerBackhand * 1.1;
        $homePlayerSpeed = $homePlayerSpeed * 1.1;
    }
    if($awayPlayerTactic == 1) //Rubber(Indoor) & SV
    {
        $awayPlayerServe = $awayPlayerServe * 1.2;
        $awayPlayerVolley = $awayPlayerVolley * 1.2;
    }
    else if($awayPlayerTactic == 2) //Rubber(Indoor) & DB
    {
        $awayPlayerSpeed = $awayPlayerSpeed * 1.1;
        $awayPlayerPower = $awayPlayerPower * 1.1;
    }
    else if($awayPlayerTactic == 3) //Rubber(Indoor) & AB
    {
        $awayPlayerForehand = $awayPlayerForehand * 1.3;
        $awayPlayerBackhand = $awayPlayerBackhand * 1.3;
    }
    else if($awayPlayerTactic == 4) //Rubber(Indoor) & SV
    {
        $awayPlayerServe = $awayPlayerServe * 1.1;
        $awayPlayerVolley = $awayPlayerVolley * 1.1;
        $awayPlayerForehand = $awayPlayerForehand * 1.1;
        $awayPlayerBackhand = $awayPlayerBackhand * 1.1;
        $awayPlayerSpeed = $awayPlayerSpeed * 1.1;
    }
}

// SETUP THE MATCH ENERGY LOSS - For FRIENDLIES, only used for bonus and no fitness hits.
$homePlayerEnergyLoss = 1;
$awayPlayerEnergyLoss = 1;

if($homePlayerAgg == 1)
{
    $homePlayerEnergyLoss = 0.75;
}
else if($homePlayerAgg == 2)
{
    $homePlayerEnergyLoss = 1;
}
else if($homePlayerAgg == 3)
{
    $homePlayerEnergyLoss = 1.25;
}

if($awayPlayerAgg == 1)
{
    $awayPlayerEnergyLoss = 0.75;
}
else if($awayPlayerAgg == 2)
{
    $awayPlayerEnergyLoss = 1;
}
else if($awayPlayerAgg == 3)
{
    $awayPlayerEnergyLoss = 1.25;
}

// SETUP THE PLAYER SKILLS TABLE FOR HOME PLAYER
$homePlayerSkills = array();
$homePlayerSkills[0] = $homePlayerName;
$homePlayerSkills[6] = $homePlayerEnergyLoss * ($homePlayerdata[4] + $homePlayerdata[11]); //Match Day Energy = Fitness * Stamina
//Serve Skill = (SRV + PWR + FHD*.75 + CON + SPD*.25) * Energy
$homePlayerSkills[1] = $homePlayerSkills[6] * (($homePlayerServe + $homePlayerPower + $homePlayerConsistency) + ($homePlayerSpeed*0.25) + ($homePlayerForehand*0.5));
$homePlayerSkills[2] = $homePlayerSkills[6] * (($homePlayerForehand + $homePlayerBackhand) + ($homePlayerPower * 0.75) + ($homePlayerConsistency*1.2) + ($homePlayerSpeed*0.75));
$homePlayerSkills[3] = $homePlayerSkills[6] * (($homePlayerForehand + $homePlayerBackhand + $homePlayerVolley) + ($homePlayerPower *0.75) + ($homePlayerConsistency*1.2) + ($homePlayerSpeed));
$homePlayerSkills[4] = 0; //games won
$homePlayerSkills[5] = 0; //sets won
$homePlayerSkills[7] = $homePlayerdata[1]; //player id
$homePlayerSkills[8] = array(0,0,0,0,0); //serves, faults, double faults, aces, unforcedErrors
$server = & $homePlayerSkills;

// SETUP THE PLAYER SKILLS TABLE FOR AWAY PLAYER
$awayPlayerSkills = array();
$awayPlayerSkills[0] = $awayPlayerName;
$awayPlayerSkills[6] = $awayPlayerEnergyLoss * ($awayPlayerdata[4] + $homePlayerdata[11]); //Match Day Energy = Fitness * Stamina
//Serve Skill = (SRV + PWR + FHD*.75 + CON + SPD*.25) * Energy
$awayPlayerSkills[1] = $awayPlayerSkills[6] * (($awayPlayerServe + $awayPlayerPower + $awayPlayerConsistency) + ($awayPlayerSpeed*0.25) + ($awayPlayerForehand*0.5));
$awayPlayerSkills[2] = $awayPlayerSkills[6] * (($awayPlayerForehand + $awayPlayerBackhand) + ($awayPlayerPower * 0.75) + ($awayPlayerConsistency*1.2) + ($awayPlayerSpeed*0.75));
$awayPlayerSkills[3] = $awayPlayerSkills[6] * (($awayPlayerForehand + $awayPlayerBackhand + $awayPlayerVolley) + ($awayPlayerPower *0.75) + ($awayPlayerConsistency*1.2) + ($awayPlayerSpeed));
$awayPlayerSkills[4] = 0; //games won
$awayPlayerSkills[5] = 0; //sets won
$awayPlayerSkills[7] = $awayPlayerdata[1]; //player id
$awayPlayerSkills[8] = array(0,0,0,0,0); //serves, faults, double faults, aces, unforcedErrors
$receiver = & $awayPlayerSkills;

// MATCH PROCESSING
$matchWon = 0;
$setResult = '';
while ($matchWon == 0){
	$setWon = 0;
	$server[4] = 0; $receiver[4] = 0; //reseting - might need to change
	while ($setWon == 0) {
		$pointWon = 0;
		//check for tie-break
		//TODO - Fix tiebreak code
		if ($server[4] == 6 && $receiver[4] == 6) {
			$commentary[$c] = $commentary[$c] . "Tie-Break##";
			$tieBreak = 1;
			$firstService = 0;
			$serverPoints = 0; $receiverPoints = 0;
			while ($tieBreak == 1) {
				//echo 'TieBreak' . "<br />";
				if ($firstService == 0) {
					$serv = 'PL' . $server[7]; $recr = 'PL' . "$receiver[7]";
					$point = getResult($server[1], $receiver[2], $server[3], $receiver[3], &$server[8], &$receiver[8], $server[7],$homePlayerdata[1]);
					if ($point[0] === 'server') $serverPoints += 1;
					else $receiverPoints += 1;
					$firstService = 1;
					$commentary[$c] = $commentary[$c] . $point[1] . "}$serv*$serverPoints-$receiverPoints*$recr}}";
				}
				else 
				{
					//change servers
					$temp = $server;
					$server = $receiver;
					$receiver = $temp;
					//Serve twice
					$serv = 'PL' . $server[7]; $recr = 'PL' . "$receiver[7]";
					$point = getResult($server[1], $receiver[2], $server[3], $receiver[3], &$server[8], &$receiver[8], $server[7],$homePlayerdata[1]);
					if ($point[0] === 'server') $serverPoints += 1;
					else $receiverPoints += 1;
					$commentary[$c] = $commentary[$c] . $point[1] . "}$serv*$serverPoints-$receiverPoints*$recr}}";
					$point = getResult($server[1], $receiver[2], $server[3], $receiver[3], &$server[8], &$receiver[8], $server[7],$homePlayerdata[1]);
					if ($point[0] === 'server') $serverPoints += 1;
					else $receiverPoints += 1;
					$commentary[$c] = $commentary[$c] . $point[1] . "}$serv*$serverPoints-$receiverPoints*$recr}}";
					//check for winner
					if ($serverPoints >= 7 && ($receiverPoints < 5 || $serverPoints - $receiverPoints >= 2)) {
						$server[4] += 1;
						$server[5] += 1;
						$setWon = 1;	
						$tieBreak = 2;
						echo "$server[0] = $server[4] $serverPoints vs $receiverPoints $receiver[0] = $receiver[4] <br />";
						if ($homePlayerName === $server[0])
						$setResult .= "$homePlayerSkills[4]-$awayPlayerSkills[4]#";
						else
						$setResult .= "$awayPlayerSkills[4]-$homePlayerSkills[4]#";
						//$serv = 'PL' . $server[7]; $recr = 'PL' . "$receiver[7]";
						//$commentary[$c] = $commentary[$c] . "Set" . "}$serv*$server[4]-$receiver[4]*$recr}}";
					}
					else if ($receiverPoints >= 7 && ($serverPoints < 5 || $receiverPoints - $serverPoints >= 2)) {
						$receiver[4] += 1;
						$receiver[5] += 1;
						$setWon = 1;	
						$tieBreak = 2;
						echo "$server[0] = $server[4] $serverPoints vs $receiverPoints $receiver[0] = $receiver[4] <br />";
						if ($homePlayerName === $server[0])
						$setResult .= "$homePlayerSkills[4]-$awayPlayerSkills[4]#";
						else
						$setResult .= "$awayPlayerSkills[4]-$homePlayerSkills[4]#";
						//$serv = 'PL' . $server[7]; $recr = 'PL' . "$receiver[7]";
						//$commentary[$c] = $commentary[$c] . "Set" . "}$serv*$server[4]-$receiver[4]*$recr}}";
					}
					
				}
			}
		}
		else {
			$serverPoints = 0; $receiverPoints = 0;
			//check if someone won
			if (($server[4] == 6 && $receiver[4] < 5) || ($server[4] == 7 && $receiver[4] < 6) ) {
				$server[5] += 1;
				$setWon = 1;
				echo "$server[0] = $server[4] $serverPoints vs $receiverPoints $receiver[0] = $receiver[0] <br />";
				if ($homePlayerName === $server[0])
				$setResult .= "$homePlayerSkills[4]-$awayPlayerSkills[4]#";
				else
				$setResult .= "$awayPlayerSkills[4]-$homePlayerSkills[4]#";
				//$serv = 'PL' . $server[7]; $recr = 'PL' . "$receiver[7]";
				//$commentary[$c] = $commentary[$c] . "Set" . "}$serv*$server[4]-$receiver[4]*$recr}}";
				break;
			}
			else if (($receiver[4] == 6 && $server[4] < 5) || ($receiver[4] == 7 && $server[4] < 6)) {
				$receiver[5] += 1;
				$setWon = 1;
				echo "$server[0] = $server[4] $serverPoints vs $receiverPoints $receiver[0] = $receiver[4] <br />";
				if ($homePlayerName === $server[0])
				$setResult .= "$homePlayerSkills[4]-$awayPlayerSkills[4]#";
				else
				$setResult .= "$awayPlayerSkills[4]-$homePlayerSkills[4]#";
				//$serv = 'PL' . $server[7]; $recr = 'PL' . "$receiver[7]";
				//$commentary[$c] = $commentary[$c] . "Set" . "}$serv*$server[4]-$receiver[4]*$recr}}";
				break;
			}
			else {
				while ($pointWon == 0) {
					//check for deuce
					$deuce = 0;
					$serverDeucePoints = 0;
					$receiverDeucePoints = 0;
					if ($serverPoints == 3 && $receiverPoints == 3){
						//echo 'deuce' . "<br />";
						$deuce = 1;
						while ($deuce == 1){
							$serv = 'PL' . $server[7]; $recr = 'PL' . "$receiver[7]";
							$point = getResult($server[1], $receiver[2], $server[3], $receiver[3], &$server[8], &$receiver[8], $server[7],$homePlayerdata[1]);
							if ($point[0] === 'server') {
								if ($serverDeucePoints == 0) {
									if ($receiverDeucePoints == 1) {
										$serverDeucePoints = 0;
										$receiverDeucePoints = 0;
										//$serv = 'PL' . $server[7]; $recr = 'PL' . "$receiver[7]";
										$commentary[$c] = $commentary[$c] . $point[1] . "}$serv*Deuce*$recr}}";
									}
									else {
										$serverDeucePoints = 1;
										$receiverDeucePoints = 0;
										//$serv = 'PL' . $server[7]; $recr = 'PL' . "$receiver[7]";
										$commentary[$c] = $commentary[$c] . $point[1] . "}ADV*$serv}}";
									}
								}
								else {
									$deuce = 0;
									$serverPoints = 4;
									$receiverPoints = 0;
									$pointWon = 1;
									//$serv = 'PL' . $server[7]; $recr = 'PL' . "$receiver[7]";
									$commentary[$c] = $commentary[$c] . $point[1] . "}Game*$serv}}";
								}
								
							}
							else {
								if ($receiverDeucePoints == 0) {
									if ($serverDeucePoints == 1) {
										$receiverDeucePoints = 0;
										$serverDeucePoints = 0;
										//$serv = 'PL' . $server[7]; $recr = 'PL' . "$receiver[7]";
										$commentary[$c] = $commentary[$c] . $point[1] . "}$serv*Deuce*$recr}}";
									}
									else {
										$receiverDeucePoints = 1;
										$serverDeucePoints = 0;
										//$serv = 'PL' . $server[7]; $recr = 'PL' . "$receiver[7]";
										$commentary[$c] = $commentary[$c] . $point[1] . "}ADV*$recr}}";
									}
								}
								else {
									$deuce = 0;
									$serverPoints = 0;
									$receiverPoints = 4;
									$pointWon = 1;
									//$serv = 'PL' . $server[7]; $recr = 'PL' . "$receiver[7]";
									$commentary[$c] = $commentary[$c] . $point[1] . "}Game*$recr}}";
								}
							}
							
						}
						if ($serverPoints == 4) {
							$server[4] += 1;
							$home = 'PL' . $homePlayerdata[1]; $away = 'PL' . $awayPlayerdata[1];
							if ($homePlayerName === $server[0])
							$commentary[$c] = $commentary[$c] . "Score" . "}$home*$setResult" . "$homePlayerSkills[4]-$awayPlayerSkills[4]*$away]}}";
							else
							$commentary[$c] = $commentary[$c] . "Score" . "}$home*$setResult" . "$awayPlayerSkills[4]-$homePlayerSkills[4]*$away]}}";
						}
						else {
							$receiver[4] += 1;
							$home = 'PL' . $homePlayerdata[1]; $away = 'PL' . $awayPlayerdata[1];
							if ($homePlayerName === $server[0])
							$commentary[$c] = $commentary[$c] . "Score" . "}$home*$setResult" . "$homePlayerSkills[4]-$awayPlayerSkills[4]*$away]}}";
							else
							$commentary[$c] = $commentary[$c] . "Score" . "}$home*$setResult" . "$awayPlayerSkills[4]-$homePlayerSkills[4]*$away]}}";
						}
						//break;
					
					}
					else {
						if ($serverPoints == 4 && $receiverPoints < 4) {
							$pointWon = 1;
							$server[4] += 1;
							$home = 'PL' . $homePlayerdata[1]; $away = 'PL' . $awayPlayerdata[1];
							if ($homePlayerName === $server[0])
							$commentary[$c] = $commentary[$c] . "Score" . "}$home*$setResult" . "$homePlayerSkills[4]-$awayPlayerSkills[4]*$away]}}";
							else
							$commentary[$c] = $commentary[$c] . "Score" . "}$home*$setResult" . "$awayPlayerSkills[4]-$homePlayerSkills[4]*$away]}}";
							
						}
						else if ($receiverPoints == 4 && $serverPoints < 4) {
							$pointWon = 1;
							$receiver[4] += 1;
							$home = 'PL' . $homePlayerdata[1]; $away = 'PL' . $awayPlayerdata[1];
							if ($homePlayerName === $server[0])
							$commentary[$c] = $commentary[$c] . "Score" . "}$home*$setResult" . "$homePlayerSkills[4]-$awayPlayerSkills[4]*$away]}}";
							else
							$commentary[$c] = $commentary[$c] . "Score" . "}$home*$setResult" . "$awayPlayerSkills[4]-$homePlayerSkills[4]*$away]}}";
						}
						//normal point to be played
						else {
							//echo "$server[1], $receiver[1], $server[3], $receiver[3] <br />";
							$serv = 'PL' . $server[7]; $recr = 'PL' . "$receiver[7]";
							$point = getResult($server[1], $receiver[2], $server[3], $receiver[3], &$server[8], &$receiver[8], $server[7],$homePlayerdata[1]);
							if ($point[0] === 'server') $serverPoints += 1;
							else $receiverPoints += 1;
							$serGP = gamePoints($serverPoints);
							$recGP = gamePoints($receiverPoints);
							if ($serGP === 'Game')
								$commentary[$c] = $commentary[$c] . $point[1] . "}$serGP*$serv}";
							else if ($recGP === 'Game')
								$commentary[$c] = $commentary[$c] . $point[1] . "}$recGP*$recr}";
							else
								$commentary[$c] = $commentary[$c] . $point[1] . "}$serv*$serGP-$recGP*$recr}}";
							echo "$server[0] = $server[4] $serverPoints vs $receiverPoints $receiver[0] = $receiver[4] <br />";
						} 
					}
					//echo "$server[0] = $server[4] $serverPoints vs $receiverPoints $receiver[0] = $receiver[4] <br />";
					//echo "Server = $server[4] vs Receiver = $receiver[4] <br />";
					
					
					if ($pointWon == 1) {
						$temp = $server;
						$server = $receiver;
						$receiver = $temp;
					}
					//echo "$homePlayerSkills[0] = $homePlayerSkills[4]";
					//echo "    vs $awayPlayerSkills[0] = $awayPlayerSkills[4] <br />";
					
				
				}
			}
		}

	} //end setWon loop


	//check for match Winner
	if ($server[5] == 2 || $receiver[5] == 2) {
		$matchWon = 1;
		//echo $setResult . "<BR />";
	}
	
} //end matchWon loop
$commentary[$c] = $commentary[$c] . "That is the Match}}";

//Calculate the first serve percentage
$homePlayerSkills[8][5] = 100 * ($homePlayerSkills[8][0] - $homePlayerSkills[8][1] - $homePlayerSkills[8][2]) / $homePlayerSkills[8][0];
$awayPlayerSkills[8][5] = 100 * ($awayPlayerSkills[8][0] - $awayPlayerSkills[8][1] - $awayPlayerSkills[8][2]) / $awayPlayerSkills[8][0];
$homePlayerSkills[8][5] = number_format($homePlayerSkills[8][5],2);
$awayPlayerSkills[8][5] = number_format($awayPlayerSkills[8][5],2);

// INSERT DETAILS INTO MATCHES TABLE & MATCH STATS TABLE
$new_match_id = 0;
if ($server[5] == 2 && $server[0] === $homePlayerName) {
	//echo "$matchID,$homePlayerID,$awayPlayerID,$courtType,$homePlayerID,$setResult <BR/>";
	$insert = "INSERT INTO matches (id_fixture,id_player1,id_player2,id_court,id_winner,score) VALUES 
				('$matchID','$homePlayerID','$awayPlayerID','$courtType','$homePlayerID','$setResult')";
	if (!mysql_query($insert)) {
		 //failure
		echo mysql_error();
		}
		$new_match_id = mysql_insert_id();
		$insert1 = "INSERT INTO match_stats (match_id,player_id,firstServe,aces,doubleFaults,errors) VALUES 
				('$new_match_id','$homePlayerID',{$homePlayerSkills[8][5]},{$homePlayerSkills[8][3]},{$homePlayerSkills[8][2]},{$homePlayerSkills[8][4]})";
		if (!mysql_query($insert1)) {
			 //failure
		echo mysql_error();
		}
		$insert2 = "INSERT INTO match_stats (match_id,player_id,firstServe,aces,doubleFaults,errors) VALUES 
				('$new_match_id','$awayPlayerID',{$awayPlayerSkills[8][5]},{$awayPlayerSkills[8][3]},{$awayPlayerSkills[8][2]},{$awayPlayerSkills[8][4]})";
		if (!mysql_query($insert2)) {
			 //failure
		echo mysql_error();
		}
		
		$comIns = "INSERT INTO match_comment (match_id, commentary) VALUES ('$new_match_id','{$commentary[$c]}')";
		if (!mysql_query($comIns)) {
			echo mysql_error();
		}
		//print_r($commentary[$c]); echo "<BR />"; 
		$c += 1;
		return 1;
}
else if ($server[5] == 2 && $server[0] === $awayPlayerName) {
	$insert = "INSERT INTO matches (id_fixture,id_player1,id_player2,id_court,id_winner,score) VALUES 
				('$matchID','$homePlayerID','$awayPlayerID','$courtType','$awayPlayerID','$setResult')";
	if (!mysql_query($insert)) {
		 //failure
		echo mysql_error();
		}
		$new_match_id = mysql_insert_id();
		$insert1 = "INSERT INTO match_stats (match_id,player_id,firstServe,aces,doubleFaults,errors) VALUES 
				('$new_match_id','$homePlayerID',{$homePlayerSkills[8][5]},{$homePlayerSkills[8][3]},{$homePlayerSkills[8][2]},{$homePlayerSkills[8][4]})";
		if (!mysql_query($insert1)) {
			 //failure
		echo mysql_error();
		}
		$insert2 = "INSERT INTO match_stats (match_id,player_id,firstServe,aces,doubleFaults,errors) VALUES 
				('$new_match_id','$awayPlayerID',{$awayPlayerSkills[8][5]},{$awayPlayerSkills[8][3]},{$awayPlayerSkills[8][2]},{$awayPlayerSkills[8][4]})";
		if (!mysql_query($insert2)) {
			 //failure
		echo mysql_error();
		}
		$comIns = "INSERT INTO match_comment (match_id, commentary) VALUES ('$new_match_id','{$commentary[$c]}')";
		if (!mysql_query($comIns)) {
			echo mysql_error();
		}
		//print_r($commentary[$c]); echo "<BR />"; 
		$c += 1;
		
	return 0;
}
else if ($receiver[5] == 2 && $receiver[0] === $awayPlayerName) {
	$insert = "INSERT INTO matches (id_fixture,id_player1,id_player2,id_court,id_winner,score) VALUES 
				('$matchID','$homePlayerID','$awayPlayerID','$courtType','$awayPlayerID','$setResult')";
	if (!mysql_query($insert)) {
		 //failure
		echo mysql_error();
		}
		$new_match_id = mysql_insert_id();
		$insert1 = "INSERT INTO match_stats (match_id,player_id,firstServe,aces,doubleFaults,errors) VALUES 
				('$new_match_id','$homePlayerID',{$homePlayerSkills[8][5]},{$homePlayerSkills[8][3]},{$homePlayerSkills[8][2]},{$homePlayerSkills[8][4]})";
		if (!mysql_query($insert1)) {
			 //failure
		echo mysql_error();
		}
		$insert2 = "INSERT INTO match_stats (match_id,player_id,firstServe,aces,doubleFaults,errors) VALUES 
				('$new_match_id','$awayPlayerID',{$awayPlayerSkills[8][5]},{$awayPlayerSkills[8][3]},{$awayPlayerSkills[8][2]},{$awayPlayerSkills[8][4]})";
		if (!mysql_query($insert2)) {
			 //failure
		echo mysql_error();
		}
		$comIns = "INSERT INTO match_comment (match_id, commentary) VALUES ('$new_match_id','{$commentary[$c]}')";
		if (!mysql_query($comIns)) {
			echo mysql_error();
		}
		//print_r($commentary[$c]); echo "<BR />"; 
		$c += 1;
	return 0;
}
if ($receiver[5] == 2 && $receiver[0] === $homePlayerName) {
	//echo "$matchID,$homePlayerID,$awayPlayerID,$courtType,$homePlayerID,$setResult <BR/>";
		$insert = "INSERT INTO matches (id_fixture,id_player1,id_player2,id_court,id_winner,score) VALUES 
				('$matchID','$homePlayerID','$awayPlayerID','$courtType','$homePlayerID','$setResult')";
		if (!mysql_query($insert)) {
		 //failure
			echo mysql_error();
		}
		$new_match_id = mysql_insert_id();
		$insert1 = "INSERT INTO match_stats (match_id,player_id,firstServe,aces,doubleFaults,errors) VALUES 
				('$new_match_id','$homePlayerID',{$homePlayerSkills[8][5]},{$homePlayerSkills[8][3]},{$homePlayerSkills[8][2]},{$homePlayerSkills[8][4]})";
		if (!mysql_query($insert1)) {
			 //failure
		echo mysql_error();
		}
		$insert2 = "INSERT INTO match_stats (match_id,player_id,firstServe,aces,doubleFaults,errors) VALUES 
				('$new_match_id','$awayPlayerID',{$awayPlayerSkills[8][5]},{$awayPlayerSkills[8][3]},{$awayPlayerSkills[8][2]},{$awayPlayerSkills[8][4]})";
		if (!mysql_query($insert2)) {
			 //failure
		echo mysql_error();
		}
		$comIns = "INSERT INTO match_comment (match_id, commentary) VALUES ('$new_match_id','{$commentary[$c]}')";
		if (!mysql_query($comIns)) {
			echo mysql_error();
		}
		//print_r($commentary[$c]); echo "<BR />"; 
		$c += 1;
		return 1;
	}	

} // end Function Match_Engine

/*  ANDY NEW -> MODIFIED THE FUNCTION
//  CHECK FOR ACE
// 	CHECK FOR FAULT - CHECK FOR ACE & DOUBLE FAULT
// 	CHECK RALLY WINNERS
*/ 	
function getResult($serveskill, $receiveskill, $serverrally, $receiverrally, $serverStats, $receiverStats, $sID, $hID){
    $winner = 0;
    $fault = 1; // not sure if we need this
    // CHECK FOR ACE - USING abs TO GET A VALUE FROM THE RANDOM FUNCTION
	echo "<BR /> SERVERSKILL $serveskill RECEIVERSKILL $receiveskill";
    $value = ($serveskill/$receiveskill)*10;
    $aceCheck = random_number('FLOAT', 0, $value);
    if ($aceCheck  > ($value * .95)) {
    	$comment = getCommentary('ace', $sID, $hID);
    	$comment = "DACE" . $comment . "]";
        $winner = array('server', $comment);
        //getCommentary('ace');
		echo 'Ace' ."<BR />";
		$serverStats[0] += 1;
		$serverStats[3] += 1;
		return $winner;
    } // End if $aceCheck
    
    // CHECK FOR FAULT (40%)
    $checkServe = random_number('INTEGER', 0, $value);
    //echo 'checkServe ' . $checkServe . "<BR />";
    $serverStats[0] += 1; // increment serve counter
    if ($checkServe  > ($value* 0.6)) {// Based on 60% chance of 1st serve in
    	echo 'Fault' . "<BR />";
    	$serverStats[1] += 1; // increment Fault counter
        $checkServe = random_number('INTEGER', 0, $value);
		//echo 'checkServe ' . $checkServe . "<BR />";
		$serverStats[0] += 1; // increment serve counter	
		
    // CHECK FOR DOUBLE FAULT
	if ($checkServe  > ($value * .6)) {
		$comment = getCommentary('doubleFault', $sID, $hID);
		$winner = array('receiver', $comment);
		//getCommentary('doubleFault');
		echo 'doubleFault' ."<BR />";
		$serverStats[2] += 1;
		$fault = 0;
		//echo $winner . "<BR />";
		return $winner;
	}
		
	// CHECK FOR ACE
	$aceCheck = random_number('FLOAT', 0, $value);
    	if ($aceCheck  > $value * .96) {
	    	$comment = getCommentary('ace', $sID, $hID);
	    	$comment = "DACE" . $comment . "]";
       	 	$winner = array('server', $comment);
        	//getCommentary('ace');
			echo 'ace' ."<BR />";
			$serverStats[0] += 1;
			$serverStats[3] += 1;
			return $winner;
	} // End if $aceCheck
	$fault = 1;
    }
    echo "<BR /> SERVER $serverrally RECEIVER $receiverrally";
    //Check for winner (60% server) Server needs a small bonus
    $rally = ($serverrally / $receiverrally) * 10;
    $rallyCheck = random_number('INTEGER', 0, $rally);
	$factor = (100 - $rally - 25) / 100;
    if ($rallyCheck > ($rally * $factor)) //server wins point
    // Not sure about the added % of server most likely to win point
    {
        if ($rallyCheck < ($rally * 0.95)){
			$comment = getCommentary('rallyS', $sID, $hID);
			$winner = array('server', $comment);
			echo 'Server Win' ."<BR />";
        } 
        else {
        	$comment = getCommentary('errorR', $sID, $hID);
			$winner = array('server', $comment);
        	echo 'Error S' ."<BR />";
        	$receiverStats[4] += 1;
        }
		return $winner;
    } 
    else { //reciever wins point
        if ($rallyCheck < ($rally * 0.1)) {
           	$comment = getCommentary('errorS', $sID, $hID);
       		$winner = array('receiver',$comment);
			echo 'Error R' ."<BR />";
			$serverStats[4] += 1;
        } 
		else {
            $comment = getCommentary('rallyR', $sID, $hID);
       		$winner = array('receiver',$comment);
			echo 'Receiver Win' ."<BR />";
        }
        return $winner;
    } // End else
    
    echo " MESS <br />";
    return $winner;
} // End function

//FUNCTION TO RETURN GAME POINTS FOR TENNIS
function gamePoints($i){
	switch ($i){
		case 0:
			return 0;
		case 1:
			return 15;
		case 2:
			return 30;
		case 3:
			return 40;
		case 4:
			return 'Game';
	}
}

?>