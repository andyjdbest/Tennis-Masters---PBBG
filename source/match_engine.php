<?php

// TO DISPLAY ALL ERRORS - MAINLY FOR DEBUGGING
ini_set ("display_errors", "1");
error_reporting(E_ALL);

//INCLUDE REQUIRED FILES
require_once 'common.php';
require_once 'DBconfig.php';
require_once 'commentaryDB.php';

// FUNCTION TO CALCULATE SCRIPT EXECUTION TIME - FOR TESTING
function microtime_float () {
    list ($msec, $sec) = explode(' ', microtime());
    $microtime = (float)$msec + (float)$sec;
    return $microtime;
}
// GET STARTING TIME
$start = microtime_float(); 


// SET TIME LIMIT SO SCRIPT DOES NOT TIME OUT
set_time_limit(600);

// INITIALIZE GLOBAL COMMENTARY ARRAY
$commentary = array();
$c = 0;

// FETCH TACTIC BONUS
$tactics = array();
$query = "SELECT * FROM tacticbonus";
$result = mysql_query($query);
while ($row = mysql_fetch_row($result)) {
       $tactics[] = $row;
}

// FETCH ATTENDANCE DETAILS
$attend = array();
$query = "SELECT attendance FROM finance_leaguepos";
$result = mysql_query($query);
while ($row = mysql_fetch_row($result)) {
       $attend[] = $row;
}
// GET THE WEEK NUMBER - TO ADD IN FINANCE TABLE
$week = floor((mktime() - $season_start)/604800);

$country = 1;
// GET THE VARIABLES FROM URL
$league = $_GET['league'];
$country = $_GET['country'];

// GET THE TIME OF THE MATCH BASED ON THE COUNTRY
switch ($country) {
	case 1:
		$today = date('Y-m-d H:i:s', strtotime('today' . '8 hours'));
		break;
	case 2:
		$today = date('Y-m-d H:i:s', strtotime('today' . '10 hours'));
		break;
}
$today = "2010-05-21 08:00:00";

// FETCH FIXTURES FOR THE DAY TO BE SIMMED
$fixtures = array();
$select = mysql_query("SELECT id_fixture,id_team1,id_team2,id_stadium,league_pos FROM fixtures JOIN league AS l ON l.idleague=fixtures.id_league WHERE round_date = '$today' AND fixture_type = 1 AND id_league =$league LIMIT 1");
while ($row = mysql_fetch_row($select)) {
	$fixtures[] = $row;
}

$index = 0;
print_r($fixtures);

if (isset($fixtures)) {
		foreach($fixtures as $fixture) {
			
			// FETCH THE MATCH TACTICS 
			$defaultHome = 0; $defaultAway = 0;
			//obtain the match orders of the home academy
			$select = mysql_query("SELECT id_player,id_tactic,id_agg 
								FROM match_order WHERE id_fixture = '$fixture[0]' AND id_team = '$fixture[1]' 
								ORDER BY id_matchorder DESC LIMIT 3");
			while ($row = mysql_fetch_row($select)) {
				   $teamHome[] = $row;
			}
			//echo "<BR /> Team HOME </BR>";
			//print_r($teamHome);

			//obtain the match orders of the away academy
			$select = mysql_query("SELECT id_player,id_tactic,id_agg 
								FROM match_order WHERE id_fixture = '$fixture[0]' AND id_team = '$fixture[2]' 
								ORDER BY id_matchorder DESC LIMIT 3");
			while ($row = mysql_fetch_row($select)) {
				   $teamAway[] = $row;
			}
			//echo "<BR /> Team Away</BR>";
			//print_r($teamAway);
			
			//if match orders are not set - set default orders
			if (!isset($teamHome[$index][0])) {
				$select = mysql_query("SELECT idplayer,0,1 
								FROM players WHERE id_team = '$fixture[1]' LIMIT 3");
				while ($row = mysql_fetch_row($select)) {
				   $teamHome[] = $row;
				}
                                $defaultHome = 1;
                               // echo 'def away';
			}
			
			if (!isset($teamAway[$index][0])) {
				$select = mysql_query("SELECT idplayer,0,1 
								FROM players WHERE id_team = '$fixture[2]' LIMIT 3");
				while ($row = mysql_fetch_row($select)) {
				   $teamAway[] = $row;
				}
                                $defaultAway = 1;
                               // echo 'def away';
			}
                        
            		// echo "<BR /> Default Team Away </BR>";
			//print_r($teamAway);
			
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
				if ($th[0] == $playerID) {
					$in = 1;
					break;
				}
			}
			if ($in != 1) {
			//player not in the team anymore
			  $query = mysql_query("SELECT idplayer,0,1 FROM players WHERE id_team = '$fixture[1]' AND idplayer NOT IN 
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
				if ($ta[0] == $playerID) {
					$in = 1;
					break;
				}
			}
			if ($in != 1) {
			//player not in the team anymore
			  $query = mysql_query("SELECT idplayer,0,1 FROM players WHERE id_team = '$fixture[2]' AND idplayer NOT IN 
								(SELECT id_player FROM match_order WHERE id_fixture = '$fixture[0]' AND id_team = '$fixture[2]') LIMIT 1");
			  $row = mysql_fetch_row($query);
			  $teamAway[$index+$i][0] = $row[0];
			}
		}	
	} 
			//echo "<BR /> Team HOME </BR>";
			//print_r($teamHome);

			//echo "<BR /> Team AWAY </BR>";
			//print_r($teamAway);
			//echo "<br /> $fixture[0],$teamHome[$index][0],$teamHome[$index][1],$teamHome[$index][2],$teamAway[$index][0],$teamAway[$index][1],$teamAway[$index][2],$fixture[3]";	
							
			//SIMULATE THE THREE MATCHES
			$result1 = Match_Engine($fixture[0],$teamHome[$index][0],$teamHome[$index][1],$teamHome[$index][2],$teamAway[$index][0],$teamAway[$index][1],$teamAway[$index][2],$fixture[3]);
			$result2 = Match_Engine($fixture[0],$teamHome[$index+1][0],$teamHome[$index+1][1],$teamHome[$index+1][2],$teamAway[$index+1][0],$teamAway[$index+1][1],$teamAway[$index+1][2],$fixture[3]);
			$result3 = Match_Engine($fixture[0],$teamHome[$index+2][0],$teamHome[$index+2][1],$teamHome[$index+2][2],$teamAway[$index+2][0],$teamAway[$index+2][1],$teamAway[$index+2][2],$fixture[3]);

			/*
			// PROCESS THE RESULTS
			$homeScore = 0; $awayScore = 0;
			if ($result1 == 1) $homeScore += 1; else $awayScore += 1;
			if ($result2 == 1) $homeScore += 1; else $awayScore += 1;
			if ($result3 == 1) $homeScore += 1; else $awayScore += 1;

			$scoreText = '';
			$scoreText .= "$homeScore-$awayScore#";
			echo "<BR /> Score </BR>";
			print_r($scoreText);
			
			if ($homeScore > $awayScore) {
				//UPDATE FIXTURES TABLE
				$update = "UPDATE fixtures SET id_winner = '$fixture[1]', score = '$scoreText' WHERE id_fixture = '$fixture[0]'";
				if (!mysql_query($update)) {
				//failure
					echo mysql_error();
				}
				// UPDATE LEAGUE TABLE FOR HOME ACADEMY
				$updateHomeLeague = "UPDATE league_table SET played = played + 1, won = won + 1, points = points + 4, pf = pf + $homeScore, pa = pa + $awayScore
							WHERE id_team = '$fixture[1]' AND season = 1";
				if (!mysql_query($updateHomeLeague)) {
				//failure
					echo mysql_error();
				}
				// UPDATE LEAGUE TABLE FOR AWAY ACADEMY
				$updateAwayLeague = "UPDATE league_table SET played = played + 1, lost = lost + 1, pf = pf + $awayScore, pa = pa + $homeScore
							WHERE id_team = '$fixture[2]' AND season = 1";
				if (!mysql_query($updateAwayLeague)) {
				//failure
					echo mysql_error();
				}
			}
			else if ($awayScore > $homeScore) {
				// UPDATE FIXTURES TABLE
				$update = "UPDATE fixtures SET id_winner = '$fixture[2]', score = '$scoreText' WHERE id_fixture = '$fixture[0]'";
				if (!mysql_query($update)) {
				//failure
					echo mysql_error();
				}
				// UPDATE LEAGUE TABLE FOR HOME ACADEMY
				$updateAwayLeague = "UPDATE league_table SET played = played + 1, won = won + 1, points = points + 4, pf = pf + $awayScore, pa = pa + $homeScore
							WHERE id_team = '{$fixture[2]}' AND season = 1";
				if (!(mysql_query($updateAwayLeague))) {
				//failure
					echo mysql_error();
				}
				// UPDATE LEAGUE TABLE FOR AWAY ACADEMY
				$updateHomeLeague = "UPDATE league_table SET played = played + 1, lost = lost + 1, pf = pf + $homeScore, pa = pa + $awayScore
							WHERE id_team = '{$fixture[1]}' AND season = 1";
				if (!mysql_query($updateHomeLeague)) {
				//failure
					echo mysql_error();
				}
			}

			$league = array();
			// ADD ATTENDANCE RECORDS
			$query = mysql_query("SELECT rank FROM league_table WHERE id_team = {$fixture[1]} OR id_team = {$fixture[2]}");
			while ($row = mysql_fetch_row($query)) {
				$league[] = $row;
			}
			
			$base = $attend[$fixture[4]][0];
			if ($league[0][0] == 0) {
				$tkt = $base * mt_rand(1,2);
			}
			else {
				$tkt = ($base + ($base/($league[0][0] + $league[1][0])))  * mt_rand(1,2);
			}

			$insert = "INSERT INTO finance (id_team,week,type,id_finance,amount) VALUES 
										({$fixture[1]},$week,1,7,$tkt)";
			if (!(mysql_query($insert))) {
				echo mysql_error(); 
        		}
			*/
			$index = $index + 3;
		}
	}
	
	// DISPLAY SCRIPT EXECUTION TIME
	$end = microtime_float();
	echo 'Script Execution Time: ' . round($end - $start, 3) . ' seconds';   

	flush();
	
function Match_Engine($matchID, $homePlayerID, $homePlayerTactic, $homePlayerAgg, $awayPlayerID, $awayPlayerTactic, $awayPlayerAgg, $courtType){

//USE GLOBAL COMMENTARY ARRAY
global $commentary;
global $c;

// FETCH HOME PLAYER STATS & DETAILS
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

// FETCH AWAY PLAYER STATS & DETAILS
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
        $homePlayerServe = $homePlayerServe + 1.8;
        $homePlayerVolley = $homePlayerVolley + 1.8;
    }
    else if($homePlayerTactic == 2) //Grass & DB
    {
        $homePlayerSpeed = $homePlayerSpeed + 1.5;
        $homePlayerPower = $homePlayerPower + 1.5;
    }
    else if($homePlayerTactic == 3) //Grass & AB
    {
        $homePlayerForehand = $homePlayerForehand + 1.5;
        $homePlayerBackhand = $homePlayerBackhand + 1.5;
    }
    else if($homePlayerTactic == 4) //Grass & AC
    {
        $homePlayerServe = $homePlayerServe + 1.2;
        $homePlayerVolley = $homePlayerVolley + 1.2;
        $homePlayerForehand = $homePlayerForehand + 1.2;
        $homePlayerBackhand = $homePlayerBackhand + 1.2;
        $homePlayerSpeed = $homePlayerSpeed + 1.2;
    }
    if($awayPlayerTactic == 1) //Grass & SV
    {
        $awayPlayerServe = $awayPlayerServe + 1.8;
        $awayPlayerVolley = $awayPlayerVolley + 1.8;
    }
    else if($awayPlayerTactic == 2) //Grass & DB
    {
        $awayPlayerSpeed = $awayPlayerSpeed + 1.5;
        $awayPlayerPower = $awayPlayerPower + 1.5;
    }
    else if($awayPlayerTactic == 3) //Grass & AB
    {
        $awayPlayerForehand = $awayPlayerForehand + 1.5;
        $awayPlayerBackhand = $awayPlayerBackhand + 1.5;
    }
    else if($awayPlayerTactic == 4) //Grass & SV
    {
        $awayPlayerServe = $awayPlayerServe + 1.2;
        $awayPlayerVolley = $awayPlayerVolley + 1.2;
        $awayPlayerForehand = $awayPlayerForehand + 1.2;
        $awayPlayerBackhand = $awayPlayerBackhand + 1.2;
        $awayPlayerSpeed = $awayPlayerSpeed + 1.2;
    }
}
else if($courtType == 2)
{
    if($homePlayerTactic == 1) //Clay & SV
    {
        $homePlayerServe = $homePlayerServe + 1.2;
        $homePlayerVolley = $homePlayerVolley + 1.2;
    }
    else if($homePlayerTactic == 2) //Clay & DB
    {
        $homePlayerSpeed = $homePlayerSpeed + 1.8;
        $homePlayerPower = $homePlayerPower + 1.6;
    }
    else if($homePlayerTactic == 3) //Clay & AB
    {
        $homePlayerForehand = $homePlayerForehand + 1.9;
        $homePlayerBackhand = $homePlayerBackhand + 1.9;
    }
    else if($homePlayerTactic == 4) //Clay & AC
    {
        $homePlayerServe = $homePlayerServe + 1.1;
        $homePlayerVolley = $homePlayerVolley + 1.1;
        $homePlayerForehand = $homePlayerForehand + 1.1;
        $homePlayerBackhand = $homePlayerBackhand + 1.1;
        $homePlayerSpeed = $homePlayerSpeed + 1.1;
    }
    if($awayPlayerTactic == 1) //Clay & SV
    {
        $awayPlayerServe = $awayPlayerServe + 1.2;
        $awayPlayerVolley = $awayPlayerVolley + 1.2;
    }
    else if($awayPlayerTactic == 2) //Clay & DB
    {
        $awayPlayerSpeed = $awayPlayerSpeed + 1.8;
        $awayPlayerPower = $awayPlayerPower + 1.6;
    }
    else if($awayPlayerTactic == 3) //Clay & AB
    {
        $awayPlayerForehand = $awayPlayerForehand + 1.9;
        $awayPlayerBackhand = $awayPlayerBackhand + 1.9;
    }
    else if($awayPlayerTactic == 4) //Clay & SV
    {
        $awayPlayerServe = $awayPlayerServe + 1.1;
        $awayPlayerVolley = $awayPlayerVolley + 1.1;
        $awayPlayerForehand = $awayPlayerForehand + 1.1;
        $awayPlayerBackhand = $awayPlayerBackhand + 1.1;
        $awayPlayerSpeed = $awayPlayerSpeed + 1.1;
    }
}
else if($courtType == 3)
{
    if($homePlayerTactic == 1) //Hard & SV
    {
        $homePlayerServe = $homePlayerServe + 1.5;
        $homePlayerVolley = $homePlayerVolley + 1.5;
    }
    else if($homePlayerTactic == 2) //Hard & DB
    {
        $homePlayerSpeed = $homePlayerSpeed + 1.6;
        $homePlayerPower = $homePlayerPower + 1.8;
    }
    else if($homePlayerTactic == 3) //Hard & AB
    {
        $homePlayerForehand = $homePlayerForehand + 1.6;
        $homePlayerBackhand = $homePlayerBackhand + 1.6;
    }
    else if($homePlayerTactic == 4) //Hard & AC
    {
        $homePlayerServe = $homePlayerServe + 1.3;
        $homePlayerVolley = $homePlayerVolley + 1.3;
        $homePlayerForehand = $homePlayerForehand + 1.3;
        $homePlayerBackhand = $homePlayerBackhand + 1.3;
        $homePlayerSpeed = $homePlayerSpeed + 1.3;
    }
    if($awayPlayerTactic == 1) //Hard & SV
    {
        $awayPlayerServe = $awayPlayerServe + 1.5;
        $awayPlayerVolley = $awayPlayerVolley + 1.5;
    }
    else if($awayPlayerTactic == 2) //Hard & DB
    {
        $awayPlayerSpeed = $awayPlayerSpeed + 1.6;
        $awayPlayerPower = $awayPlayerPower + 1.8;
    }
    else if($awayPlayerTactic == 3) //Hard & AB
    {
        $awayPlayerForehand = $awayPlayerForehand + 1.6;
        $awayPlayerBackhand = $awayPlayerBackhand + 1.6;
    }
    else if($awayPlayerTactic == 4) //Hard & SV
    {
        $awayPlayerServe = $awayPlayerServe + 1.3;
        $awayPlayerVolley = $awayPlayerVolley + 1.3;
        $awayPlayerForehand = $awayPlayerForehand + 1.3;
        $awayPlayerBackhand = $awayPlayerBackhand + 1.3;
        $awayPlayerSpeed = $awayPlayerSpeed + 1.3;
    }
}
else if($courtType == 4)
{
    if($homePlayerTactic == 1) //Rubber(Indoor) & SV
    {
        $homePlayerServe = $homePlayerServe + 1.2;
        $homePlayerVolley = $homePlayerVolley + 1.2;
    }
    else if($homePlayerTactic == 2) //Rubber(Indoor) & DB
    {
        $homePlayerSpeed = $homePlayerSpeed + 1.1;
        $homePlayerPower = $homePlayerPower + 1.1;
    }
    else if($homePlayerTactic == 3) //Rubber(Indoor) & AB
    {
        $homePlayerForehand = $homePlayerForehand + 1.3;
        $homePlayerBackhand = $homePlayerBackhand + 1.3;
    }
    else if($homePlayerTactic == 4) //Rubber(Indoor) & AC
    {
        $homePlayerServe = $homePlayerServe + 1.1;
        $homePlayerVolley = $homePlayerVolley + 1.1;
        $homePlayerForehand = $homePlayerForehand + 1.1;
        $homePlayerBackhand = $homePlayerBackhand + 1.1;
        $homePlayerSpeed = $homePlayerSpeed + 1.1;
    }
    if($awayPlayerTactic == 1) //Rubber(Indoor) & SV
    {
        $awayPlayerServe = $awayPlayerServe + 1.2;
        $awayPlayerVolley = $awayPlayerVolley + 1.2;
    }
    else if($awayPlayerTactic == 2) //Rubber(Indoor) & DB
    {
        $awayPlayerSpeed = $awayPlayerSpeed + 1.1;
        $awayPlayerPower = $awayPlayerPower + 1.1;
    }
    else if($awayPlayerTactic == 3) //Rubber(Indoor) & AB
    {
        $awayPlayerForehand = $awayPlayerForehand + 1.3;
        $awayPlayerBackhand = $awayPlayerBackhand + 1.3;
    }
    else if($awayPlayerTactic == 4) //Rubber(Indoor) & SV
    {
        $awayPlayerServe = $awayPlayerServe + 1.1;
        $awayPlayerVolley = $awayPlayerVolley + 1.1;
        $awayPlayerForehand = $awayPlayerForehand + 1.1;
        $awayPlayerBackhand = $awayPlayerBackhand + 1.1;
        $awayPlayerSpeed = $awayPlayerSpeed + 1.1;
    }
}
/*
$homePlayerServeSkill = ($homePlayerServe + $homePlayerPower) + ($homePlayerConsistency*1.2) + ($homePlayerSpeed*0.75) / 4;
$homePlayerReceiveSkill = ($homePlayerForehand + $homePlayerBackhand) + ($homePlayerPower * 0.75) + ($homePlayerConsistency*1.2) + ($homePlayerSpeed*0.75) / 5;
$homePlayerRallySkill = ($homePlayerForehand + $homePlayerBackhand + $homePlayerVolley) + ($homePlayerPower *0.75) + ($homePlayerConsistency*1.2) + ($homePlayerSpeed) / 6;
*/

// SETUP THE MATCH ENERGY LOSS
$homePlayerEnergyLoss = 0;
$awayPlayerEnergyLoss = 0;

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
$homePlayerSkills[1] = $homePlayerEnergyLoss * ($homePlayerServe + $homePlayerPower) + ($homePlayerConsistency*1.2) + ($homePlayerSpeed*0.75) / 4;
$homePlayerSkills[2] = $homePlayerEnergyLoss * ($homePlayerForehand + $homePlayerBackhand) + ($homePlayerPower * 0.75) + ($homePlayerConsistency*1.2) + ($homePlayerSpeed*0.75) / 5;
$homePlayerSkills[3] = $homePlayerEnergyLoss * ($homePlayerForehand + $homePlayerBackhand + $homePlayerVolley) + ($homePlayerPower *0.75) + ($homePlayerConsistency*1.2) + ($homePlayerSpeed) / 6;
$homePlayerSkills[4] = 0; //games won
$homePlayerSkills[5] = 0; //sets won
$homePlayerSkills[6] = $homePlayerdata[4] + $homePlayerdata[11]; //Match Day Energy = Fitness + Stamina
$homePlayerSkills[7] = $homePlayerdata[1]; //player id
$homePlayerSkills[8] = array(0,0,0,0,0); //serves, faults, double faults, aces, unforcedErrors
$server = & $homePlayerSkills;

/*
$awayPlayerServeSkill = ($awayPlayerServe + $awayPlayerPower) + ($awayPlayerConsistency*1.2) + ($awayPlayerSpeed*0.75) / 4;
$awayPlayerReceiveSkill = ($awayPlayerForehand + $awayPlayerBackhand) + ($awayPlayerPower * 0.75) + ($awayPlayerConsistency*1.2) + ($awayPlayerSpeed*0.75) / 5;
$awayPlayerRallySkill = ($awayPlayerForehand + $awayPlayerBackhand + $awayPlayerVolley) + ($awayPlayerPower *0.75) + ($awayPlayerConsistency*1.2) + ($awayPlayerSpeed) / 6;
*/
// SETUP THE PLAYER SKILLS TABLE FOR AWAY PLAYER
$awayPlayerSkills = array();
$awayPlayerSkills[0] = $awayPlayerName;
$awayPlayerSkills[1] = $awayPlayerEnergyLoss * ($awayPlayerServe + $awayPlayerPower) + ($awayPlayerConsistency*1.2) + ($awayPlayerSpeed*0.75) / 4;
$awayPlayerSkills[2] = $awayPlayerEnergyLoss * ($awayPlayerForehand + $awayPlayerBackhand) + ($awayPlayerPower * 0.75) + ($awayPlayerConsistency*1.2) + ($awayPlayerSpeed*0.75) / 5;
$awayPlayerSkills[3] = $awayPlayerEnergyLoss * ($awayPlayerForehand + $awayPlayerBackhand + $awayPlayerVolley) + ($awayPlayerPower *0.75) + ($awayPlayerConsistency*1.2) + ($awayPlayerSpeed) / 6;
$awayPlayerSkills[4] = 0; //games won
$awayPlayerSkills[5] = 0; //sets won
$awayPlayerSkills[6] = $awayPlayerdata[4] + $awayPlayerdata[11]; //Match Day Energy = Fitness + Stamina
$awayPlayerSkills[7] = $awayPlayerdata[1]; //player id
$awayPlayerSkills[8] = array(0,0,0,0,0); //serves, faults, double faults, aces, unforcedErrors
$receiver = & $awayPlayerSkills;

//echo "Player FITNESS $homePlayerdata[4], $awayPlayerdata[4] <br />"; 
//echo "Player Energy Prior $homePlayerSkills[6], $awayPlayerSkills[6] <br />";
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
			$commentary[$c] = $commentary[$c] . "Tie-Break}";
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
						$setResult .= "$server[4]-$receiver[4]#";
						else
						$setResult .= "$receiver[4]-$server[4]#";
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
						$setResult .= "$server[4]-$receiver[4]#";
						else
						$setResult .= "$receiver[4]-$server[4]#";
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
				echo "$server[0] = $server[4] $serverPoints vs $receiverPoints $receiver[0] = $receiver[4] <br />";
				if ($homePlayerName === $server[0])
				$setResult .= "$server[4]-$receiver[4]#";
				else
				$setResult .= "$receiver[4]-$server[4]#";
				//$serv = 'PL' . $server[7]; $recr = 'PL' . "$receiver[7]";
				//$commentary[$c] = $commentary[$c] . "Set" . "}$serv*$server[4]-$receiver[4]*$recr}}";
				break;
			}
			else if (($receiver[4] == 6 && $server[4] < 5) || ($receiver[4] == 7 && $server[4] < 6)) {
				$receiver[5] += 1;
				$setWon = 1;
				echo "$server[0] = $server[4] $serverPoints vs $receiverPoints $receiver[0] = $receiver[4] <br />";
				if ($homePlayerName === $server[0])
				$setResult .= "$server[4]-$receiver[4]#";
				else
				$setResult .= "$receiver[4]-$server[4]#";
				//$serv = 'PL' . $server[7]; $recr = 'PL' . "$receiver[7]";
				//$commentary[$c] = $commentary[$c] . "Set" . "}$serv*$server[4]-$receiver[4]*$recr}}";
				break;
			}
			else {
				while ($pointWon == 0) {
					//check for deuce
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
									$serverPoints = 0;
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
									$receiverPoints = 0;
									$pointWon = 1;
									//$serv = 'PL' . $server[7]; $recr = 'PL' . "$receiver[7]";
									$commentary[$c] = $commentary[$c] . $point[1] . "}Game*$recr}}";
								}
							}
							
						}
						break;
					
					}
					else {
						if ($serverPoints == 4 && $receiverPoints < 4) {
							$pointWon = 1;
							$server[4] += 1;
							$home = 'PL' . $homePlayerdata[1]; $away = 'PL' . "$awayPlayerdata[1]";
							$commentary[$c] = $commentary[$c] . "Score" . "}$home*$setResult" . "$homePlayerSkills[4]-$awayPlayerSkills[4]*$away}}";
							
						}
						else if ($receiverPoints == 4 && $serverPoints < 4) {
							$pointWon = 1;
							$receiver[4] += 1;
							$home = 'PL' . $homePlayerdata[1]; $away = 'PL' . "$awayPlayerdata[1]";
							$commentary[$c] = $commentary[$c] . "Score" . "}$home*$setResult" . "$homePlayerSkills[4]-$awayPlayerSkills[4]*$away}}";
						}
						//normal point to be played
						else {
							echo "$server[1], $receiver[1], $server[3], $receiver[3] <br />";
							$serv = 'PL' . $server[7]; $recr = 'PL' . "$receiver[7]";
							$point = getResult($server[1], $receiver[2], $server[3], $receiver[3], &$server[8], &$receiver[8], $server[7],$homePlayerdata[1]);
							if ($point[0] === 'server') $serverPoints += 1;
							else $receiverPoints += 1;
							$serGP = gamePoints($serverPoints);
							$recGP = gamePoints($receiverPoints);
							//$serv = 'PL' . $server[7]; $recr = 'PL' . "$receiver[7]";
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
	//update fitness
	$homePlayerSkills[6] = $homePlayerSkills[6] - ($homePlayerEnergyLoss * ($homePlayerSkills[4] + $awayPlayerSkills[4]));
	$awayPlayerSkills[6] = $awayPlayerSkills[6] - ($awayPlayerEnergyLoss * ($homePlayerSkills[4] + $awayPlayerSkills[4]));
	//echo "Player SET fitness $homePlayerSkills[6], $awayPlayerSkills[6] <br />";
	//check for match Winner
	if ($server[5] == 2 || $receiver[5] == 2) {
		$matchWon = 1;
		//echo $setResult . "<BR />";
	}
	
    //Making sure each player loses at least 5 fitness points from every match.
    if($homePlayerSkills[6] > 95){
        $homePlayerSkills[6] = 95;
    }
    if($awayPlayerSkills[6] > 95){
        $awayPlayerSkills[6] = 95;
    }
	// ANDY NEW - PLAYER'S FITNESS SHOULD NOT BE NEGATIVE
	if($homePlayerSkills[6] <= 0){
        $homePlayerSkills[6] = 0;
    }
    if($awayPlayerSkills[6] <= 0){
        $awayPlayerSkills[6] = 0;
    }
	
} //end matchWon loop
$commentary[$c] = $commentary[$c] . "That is the Match}}";
echo "<br />Player Match fitness $homePlayerSkills[6], $awayPlayerSkills[6] <br />";
echo "Serves, Faults, DF, Aces <br />";
print_r($homePlayerSkills[8]); print_r($awayPlayerSkills[8]); 
/*	
// UPDATE PLAYER'S FITNESS IN THE PLAYER'S TABLES
$update = "UPDATE players SET fitness = {$homePlayerSkills[6]} WHERE idplayer = {$homePlayerSkills[7]}";
if (!mysql_query($update)) {
	echo mysql_error();
}
$update1 = "UPDATE players SET fitness = {$awayPlayerSkills[6]} WHERE idplayer = {$awayPlayerSkills[7]}";
if (!mysql_query($update1)) {
	echo mysql_error();
}
	
// CALCULATE FIRST SERVE PERCENTAGE
$homePlayerSkills[8][5] = 100 * ($homePlayerSkills[8][0] - $homePlayerSkills[8][1] - $homePlayerSkills[8][2]) / $homePlayerSkills[8][0];
$awayPlayerSkills[8][5] = 100 * ($awayPlayerSkills[8][0] - $awayPlayerSkills[8][1] - $awayPlayerSkills[8][2]) / $awayPlayerSkills[8][0];
$homePlayerSkills[8][5] = number_format($homePlayerSkills[8][4],2);
$awayPlayerSkills[8][5] = number_format($awayPlayerSkills[8][4],2);

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
		$insert1 = "INSERT INTO match_stats (match_id,player_id,firstServe,aces,doubleFaults, errors) VALUES 
				('$new_match_id','$homePlayerID',{$homePlayerSkills[8][5]},{$homePlayerSkills[8][3]},{$homePlayerSkills[8][2]},
				{$homePlayerSkills[8][4]})";
		if (!mysql_query($insert1)) {
			 //failure
		echo mysql_error();
		}
		$insert2 = "INSERT INTO match_stats (match_id,player_id,firstServe,aces,doubleFaults, errors) VALUES 
				('$new_match_id','$awayPlayerID',{$awayPlayerSkills[8][5]},{$awayPlayerSkills[8][3]},{$awayPlayerSkills[8][2]},
				{$awayPlayerSkills[8][4]})";
		if (!mysql_query($insert2)) {
			echo mysql_error();
		}
		$comIns = "INSERT INTO match_comment (match_id, commentary) VALUES ('$new_match_id','{$commentary[$c]}')";
		if (!mysql_query($comIns)) {
			echo mysql_error();
		}
		return 1;
	}
	else if ($server[5] == 2 && $server[0] === $awayPlayerName) {
		$insert = "INSERT INTO matches (id_fixture,id_player1,id_player2,id_court,id_winner,score) VALUES 
				('$matchID','$homePlayerID','$awayPlayerID','$courtType','$awayPlayerID','$setResult')";
		if (!mysql_query($insert)) {
			echo mysql_error();
		}
		
		$new_match_id = mysql_insert_id();
		$insert1 = "INSERT INTO match_stats (match_id,player_id,firstServe,aces,doubleFaults, errors) VALUES 
				('$new_match_id','$homePlayerID',{$homePlayerSkills[8][5]},{$homePlayerSkills[8][3]},{$homePlayerSkills[8][2]},
				{$homePlayerSkills[8][4]})";
		if (!mysql_query($insert1)) {
			 //failure
		echo mysql_error();
		}
		$insert2 = "INSERT INTO match_stats (match_id,player_id,firstServe,aces,doubleFaults, errors) VALUES 
				('$new_match_id','$awayPlayerID',{$awayPlayerSkills[8][5]},{$awayPlayerSkills[8][3]},{$awayPlayerSkills[8][2]},
				{$awayPlayerSkills[8][4]})";
		if (!mysql_query($insert2)) {
			echo mysql_error();
		}
		$comIns = "INSERT INTO match_comment (match_id, commentary) VALUES ('$new_match_id','{$commentary[$c]}')";
		if (!mysql_query($comIns)) {
			echo mysql_error();
		}
		return 0;
}
else if ($receiver[5] == 2 && $receiver[0] === $awayPlayerName) {
	$insert = "INSERT INTO matches (id_fixture,id_player1,id_player2,id_court,id_winner,score) VALUES 
				('$matchID','$homePlayerID','$awayPlayerID','$courtType','$awayPlayerID','$setResult')";
	if (!mysql_query($insert)) {
		echo mysql_error();
	}
	
	$new_match_id = mysql_insert_id();
	$insert1 = "INSERT INTO match_stats (match_id,player_id,firstServe,aces,doubleFaults, errors) VALUES 
				('$new_match_id','$homePlayerID',{$homePlayerSkills[8][5]},{$homePlayerSkills[8][3]},{$homePlayerSkills[8][2]},
				{$homePlayerSkills[8][4]})";
	if (!mysql_query($insert1)) {
		echo mysql_error();
	}
	$insert2 = "INSERT INTO match_stats (match_id,player_id,firstServe,aces,doubleFaults, errors) VALUES 
			('$new_match_id','$awayPlayerID',{$awayPlayerSkills[8][5]},{$awayPlayerSkills[8][3]},{$awayPlayerSkills[8][2]},
			{$awayPlayerSkills[8][4]})";
	if (!mysql_query($insert2)) {
		echo mysql_error();
	}
	$comIns = "INSERT INTO match_comment (match_id, commentary) VALUES ('$new_match_id','{$commentary[$c]}')";
		if (!mysql_query($comIns)) {
			echo mysql_error();
		}
	return 0;
}
if ($receiver[5] == 2 && $receiver[0] === $homePlayerName) {
	$insert = "INSERT INTO matches (id_fixture,id_player1,id_player2,id_court,id_winner,score) VALUES 
				('$matchID','$homePlayerID','$awayPlayerID','$courtType','$homePlayerID','$setResult')";
	if (!mysql_query($insert)) {
		 //failure
		echo mysql_error();
		}
		$new_match_id = mysql_insert_id();
		$insert1 = "INSERT INTO match_stats (match_id,player_id,firstServe,aces,doubleFaults, errors) VALUES 
				('$new_match_id','$homePlayerID',{$homePlayerSkills[8][5]},{$homePlayerSkills[8][3]},{$homePlayerSkills[8][2]},
				{$homePlayerSkills[8][4]})";
		if (!mysql_query($insert1)) {
			 //failure
		echo mysql_error();
		}
		$insert2 = "INSERT INTO match_stats (match_id,player_id,firstServe,aces,doubleFaults, errors) VALUES 
				('$new_match_id','$awayPlayerID',{$awayPlayerSkills[8][5]},{$awayPlayerSkills[8][3]},{$awayPlayerSkills[8][2]},
				{$awayPlayerSkills[8][4]})";
		if (!mysql_query($insert2)) {
			echo mysql_error();
		}
		$comIns = "INSERT INTO match_comment (match_id, commentary) VALUES ('$new_match_id','{$commentary[$c]}')";
		if (!mysql_query($comIns)) {
			echo mysql_error();
		}
	return 1;
}
*/


print_r($commentary[$c]); echo "<BR />"; 
$c += 1; return 1;
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
    $aceCheck = random_number('FLOAT', 0, abs($receiveskill - $serveskill));
    if ($aceCheck * 1.04 > (abs($receiveskill - $serveskill))) {
    	$comment = getCommentary('ace', $sID, $hID);
        $winner = array('server', $comment);
        //getCommentary('ace');
	echo 'Ace' ."<BR />";
	$serverStats[0] += 1;
	$serverStats[3] += 1;
	return $winner;
    } // End if $aceCheck
    
    // CHECK FOR FAULT (40%)
    $checkServe = random_number('INTEGER', 0, $serveskill);
    //echo 'checkServe ' . $checkServe . "<BR />";
    $serverStats[0] += 1; // increment serve counter
    if ($checkServe > ($serveskill * 0.6)) {// Based on 60% chance of 1st serve in
    	echo 'Fault' . "<BR />";
    	$serverStats[1] += 1; // increment Fault counter
        $checkServe = random_number('INTEGER', 0, $serveskill);
	//echo 'checkServe ' . $checkServe . "<BR />";
	$serverStats[0] += 1; // increment serve counter	
		
    	// CHECK FOR DOUBLE FAULT
	if ($checkServe > ($serveskill * 0.6)) {
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
	$aceCheck = random_number('FLOAT', 0, abs($receiveskill - $serveskill));
    	if ($aceCheck * 1.01 > (abs($receiveskill - $serveskill))) {
	    	$comment = getCommentary('ace', $sID, $hID);
       	 	$winner = array('server', $comment);
        	//getCommentary('ace');
		echo 'ace' ."<BR />";
		$serverStats[0] += 1;
		$serverStats[3] += 1;
		return $winner;
	} // End if $aceCheck
	$fault = 1;
     }
     
    //Check for winner (60% server) Server needs a small bonus
    $rallyCheck = random_number('INTEGER', 0, $serverrally + $receiverrally);
    //echo 'Rally Check ' . $rallyCheck ."<BR />";
    if ($rallyCheck < ($serverrally * 1.1)) //server wins point
    // Not sure about the added % of server most likely to win point
    {
	//  echo 'Server Rally ' . $serverrally * 1.1 ."<BR />";
        if ($rallyCheck < ($serverrally * 0.25)){
		$comment = getCommentary('rallyS', $sID, $hID);
		$winner = array('server', $comment);
		echo 'Server Win' ."<BR />";
        } 
	else if ($rallyCheck < ($serverrally * 0.7)) {
	    	$comment = getCommentary('rallyS', $sID, $hID);
		$winner = array('server', $comment);
           	echo 'Winner Server' ."<BR />";
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
        if ($rallyCheck < ($receiverrally * 0.3)) {
           	$comment = getCommentary('rallyR', $sID, $hID);
       		$winner = array('receiver',$comment);
		echo 'Receiver Win' ."<BR />";
        } 
	else if ($rallyCheck < ($receiverrally * 0.75)) {
            	$comment = getCommentary('rallyR', $sID, $hID);
       		$winner = array('receiver',$comment);
		echo 'Winner Receiver' ."<BR />";
        } 
	else {
            $comment = getCommentary('errorS', $sID, $hID);
       		$winner = array('receiver',$comment);
		echo 'Error R' ."<BR />";
		$serverStats[4] += 1;
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