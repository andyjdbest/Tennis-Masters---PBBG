<?php

ini_set ("display_errors", "1");
error_reporting(E_ALL);

require_once 'common.php';
require_once 'DBconfig.php';

// Function to calculate script execution time.
function microtime_float () {
    list ($msec, $sec) = explode(' ', microtime());
    $microtime = (float)$msec + (float)$sec;
    return $microtime;
}
// Get starting time.
$start = microtime_float(); 


set_time_limit(600);
//Before we call Match_Engine function, need to get tactics.
$tactics = array();
$query = "SELECT * FROM tacticbonus";
$result = mysql_query($query);
while ($row = mysql_fetch_row($result)) {
       $tactics[] = $row;
}

$winners = array();
$losers = array();

$week = floor((mktime() - $season_start)/604800);

// ******************************************
//
$today = date('Y-m-d H:i:s', strtotime('today' . '8 hours'));
//$today = "2010-05-23 08:00:00";
$fixtures = array();
//$select = mysql_query("SELECT id_fixture,id_team1,id_team2,id_stadium,league_pos FROM fixtures JOIN league AS l ON l.idleague=fixtures.id_league WHERE round_date < '$today' AND fixture_type = 1 AND id_league =$league");
$select = mysql_query("SELECT f.id_fixture,m.id_player1,m.id_player2,m.id_court, t1.id_team, t2.id_team, f.round, f.fixture_type, m.id_match FROM fixtures AS f JOIN matches AS m ON f.id_fixture=m.id_fixture JOIN players as t1 ON t1.idplayer = m.id_player1 JOIN players as t2 ON t2.idplayer = m.id_player2 WHERE f.round_date = '$today' AND f.fixture_type > 3");
while ($row = mysql_fetch_row($select)) {
	$fixtures[] = $row;
}

print_r($fixtures);
if (isset($fixtures)) {
		foreach($fixtures as $fixture) {
			
			//obtain the match orders of the home player
			$select = mysql_query("SELECT id_player,id_tactic,id_agg 
								FROM kmatch_order WHERE id_match = '$fixture[8]' AND id_player = '$fixture[1]' LIMIT 1");
			$teamHome = mysql_fetch_row($select);
			//echo "<BR /> Team HOME </BR>";
			//print_r($teamHome);

			//obtain the match orders of the away player
			$select = mysql_query("SELECT id_player,id_tactic,id_agg 
								FROM kmatch_order WHERE id_match = '$fixture[8]' AND id_player = '$fixture[2]' LIMIT 1");
			$teamAway = mysql_fetch_row($select);
			
			//echo "<BR /> Team Away</BR>";
			//print_r($teamAway);
			
			//if match orders not set, get default tactics
			if (!(isset($teamHome[0]))){
				$teamHome = array($fixture[1], 0, 1);
			}

			if (!(isset($teamAway[0]))){
				$teamAway = array($fixture[2], 0, 1);
			}	
			
			echo "<BR /> Player HOME </BR>";
			print_r($teamHome);

			echo "<BR /> Player AWAY </BR>";
			print_r($teamAway);
			//echo "<br /> $fixture[0],$teamHome[$index][0],$teamHome[$index][1],$teamHome[$index][2],$teamAway[$index][0],$teamAway[$index][1],$teamAway[$index][2],$fixture[3]";	
			
						
			//Run the ME code
			$result1 = Match_Engine($fixture[8],$teamHome[0],$teamHome[1],$teamHome[2],$teamAway[0],$teamAway[1],$teamAway[2],$fixture[3]);
			
			//winners - winning players, losers - losing teams to add finance
			$base = 1000;
			$money = $base * ($fixture[6] + 1);
			if ($result1 == 1) {
				$winners[] = $teamHome[0];
				//$losers[] = $fixture[5];
				$insert = "INSERT INTO finance (id_team,week,type,id_finance,amount) VALUES 
										({$fixture[5]},$week,1,11,$money)";
				if (!(mysql_query($insert))) {
					echo mysql_error(); 
				}
			}
			else if ($result1 == 0) {
				$winners[] = $teamAway[0];
				//$losers[] = $fixture[4];
				$insert = "INSERT INTO finance (id_team,week,type,id_finance,amount) VALUES 
										({$fixture[4]},$week,1,11,$money)";
				if (!(mysql_query($insert))) {
					echo mysql_error(); 
				}
			}
			
		}
		
		//update the fixture table & generate new fixtures
		$update = "UPDATE fixtures SET id_winner = 0, SCORE = 0 WHERE id_fixture = '{$fixtures[0][0]}'";
		if (!(mysql_query($update))) {
					echo mysql_error(); 
		}
		
		if (count($winners) > 1) {
			//find day of the week - TODO - find next game date, based on current day of week...
			
			$w = date("l", mktime());
			echo "$w";
			if ($w === 'Sunday' || $w === 'Wednesday') {
				$days = date('Y-m-d', strtotime('+3 days'));
				$dayTime = date('Y-m-d H:i:s', strtotime($days . '8 hours'));
			}
			else if ($w === 'Saturday') {
				$days = date('Y-m-d', strtotime('+1 day'));
				$dayTime = date('Y-m-d H:i:s', strtotime($days . '8 hours'));
			}
			
			$round = $fixtures[0][6] + 1;
			$fixture_type = $fixtures[0][7];
			$id_stadium = $fixtures[0][3];
			$insert = "INSERT INTO fixtures 
						(season,fixture_type, round_date, id_team1, id_team2, id_stadium, round) 
						VALUES ('$season','$fixture_type', '$dayTime', '0', '0', '$id_stadium', '$round')";	
			if (!mysql_query($insert)) {
						//	global $errorFixtures;
				$error = 'Error while inserting data into fixtures' . mysql_error() ;
			}
			$id_fixture = mysql_insert_id();
							
			$max = sizeof($winners); 
			$totalRounds = 1;
			$matchesPerRound = $max / 2;
					
			for ($match = 0; $match < $matchesPerRound; $match++) {
				$home = ($match) % ($max - 1);
				$away = ($max - 1 - $match) % ($max - 1);
				if ($match == 0) {
					$away = $max - 1;
				}
				$rounds[$match] = $winners[$home] . " v " . $winners[$away];
			}
					
			foreach ($rounds as $r){
				$components = explode(' v ', $r);
				$player1 = $components[0];
				$player2 = $components[1];
				
				$insert = "INSERT INTO matches (id_fixture, id_player1, id_player2, id_court) VALUES ('$id_fixture', '$player1', '$player2', '{$fixtures[0][3]}')";
						//echo "<BR />$insert";
				if (!(mysql_query($insert))) {
						//	global $errorFixtures;
					$error = 'Error while inserting data into match tables' . mysql_error() ;
				}			
			}
		}
		//the final round hence add prize money to winning team....
		else {
			$select = mysql_query("SELECT id_team FROM players WHERE idplayer = {$winners[0]}");
			$row = mysql_fetch_row($select);
			$insert = "INSERT INTO finance (id_team,week,type,id_finance,amount) VALUES 
										({$row[0]},$week,1,11,$money)";
			if (!(mysql_query($insert))) {
					echo mysql_error(); 
			}
		}
		
	}
	
$newsText = "Knockout fixtures played.";
$insert = "INSERT INTO news (NewsText,NewsDate) VALUES ('$newsText', NOW())";
if (!(mysql_query($insert))) {
    $error = 'Cannot insert news ' . mysql_error();
    echo $error;
}

	$end = microtime_float();

	// Print results.
	echo 'Script Execution Time: ' . round($end - $start, 3) . ' seconds';   

	flush();
	
function Match_Engine($matchID, $homePlayerID, $homePlayerTactic, $homePlayerAgg, $awayPlayerID, $awayPlayerTactic, $awayPlayerAgg, $courtType)
{

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

$homePlayerServeSkill = ($homePlayerServe + $homePlayerPower) + ($homePlayerConsistency*1.2) + ($homePlayerSpeed*0.75) / 4;
$homePlayerReceiveSkill = ($homePlayerForehand + $homePlayerBackhand) + ($homePlayerPower * 0.75) + ($homePlayerConsistency*1.2) + ($homePlayerSpeed*0.75) / 5;
$homePlayerRallySkill = ($homePlayerForehand + $homePlayerBackhand + $homePlayerVolley) + ($homePlayerPower *0.75) + ($homePlayerConsistency*1.2) + ($homePlayerSpeed) / 6;

$homePlayerSkills = array();
$homePlayerSkills[0] = $homePlayerName;
$homePlayerSkills[1] = ($homePlayerServe + $homePlayerPower) + ($homePlayerConsistency*1.2) + ($homePlayerSpeed*0.75) / 4;
$homePlayerSkills[2] = ($homePlayerForehand + $homePlayerBackhand) + ($homePlayerPower * 0.75) + ($homePlayerConsistency*1.2) + ($homePlayerSpeed*0.75) / 5;
$homePlayerSkills[3] = ($homePlayerForehand + $homePlayerBackhand + $homePlayerVolley) + ($homePlayerPower *0.75) + ($homePlayerConsistency*1.2) + ($homePlayerSpeed) / 6;
$homePlayerSkills[4] = 0; //games won
$homePlayerSkills[5] = 0; //sets won
$homePlayerSkills[6] = $homePlayerdata[4] + $homePlayerdata[11]; //Match Day Energy = Fitness + Stamina
$homePlayerSkills[7] = $homePlayerdata[1]; //player id
//$homePlayerSkills[8] = 0.0; //first serve
//$homePlayerSkills[9] = 0; //ace
//$homePlayerSkills[10] = 0; //double fault
$homePlayerSkills[8] = array(0,0,0,0); //serves, faults, double faults, aces

$server = & $homePlayerSkills;

/*
$awayPlayerServeSkill = ($awayPlayerServe + $awayPlayerPower) + ($awayPlayerConsistency*1.2) + ($awayPlayerSpeed*0.75) / 4;
$awayPlayerReceiveSkill = ($awayPlayerForehand + $awayPlayerBackhand) + ($awayPlayerPower * 0.75) + ($awayPlayerConsistency*1.2) + ($awayPlayerSpeed*0.75) / 5;
$awayPlayerRallySkill = ($awayPlayerForehand + $awayPlayerBackhand + $awayPlayerVolley) + ($awayPlayerPower *0.75) + ($awayPlayerConsistency*1.2) + ($awayPlayerSpeed) / 6;
*/

$awayPlayerSkills = array();
$awayPlayerSkills[0] = $awayPlayerName;
$awayPlayerSkills[1] = ($awayPlayerServe + $awayPlayerPower) + ($awayPlayerConsistency*1.2) + ($awayPlayerSpeed*0.75) / 4;
$awayPlayerSkills[2] = ($awayPlayerForehand + $awayPlayerBackhand) + ($awayPlayerPower * 0.75) + ($awayPlayerConsistency*1.2) + ($awayPlayerSpeed*0.75) / 5;
$awayPlayerSkills[3] = ($awayPlayerForehand + $awayPlayerBackhand + $awayPlayerVolley) + ($awayPlayerPower *0.75) + ($awayPlayerConsistency*1.2) + ($awayPlayerSpeed) / 6;
$awayPlayerSkills[4] = 0; //games won
$awayPlayerSkills[5] = 0; //sets won
$awayPlayerSkills[6] = $awayPlayerdata[4] + $awayPlayerdata[11]; //Match Day Energy = Fitness + Stamina
$awayPlayerSkills[7] = $awayPlayerdata[1]; //player id
//$awayPlayerSkills[8] = 0.0; //first serve
//$awayPlayerSkills[9] = 0; //ace
//$awayPlayerSkills[10] = 0; //double fault
$awayPlayerSkills[8] = array(0,0,0,0); //serves, faults, double faults, aces

$receiver = & $awayPlayerSkills;


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
			$tieBreak = 1;
			$firstService = 0;
			$serverPoints = 0; $receiverPoints = 0;
			while ($tieBreak == 1) {
				//echo 'TieBreak' . "<br />";
				if ($firstService == 0) {
					$point = getResult($server[1], $receiver[1], $server[3], $receiver[3], &$server[8], &$receiver[8]);
					if ($point === 'server') $serverPoints += 1;
					else $receiverPoints += 1;
					$firstService = 1;
				}
				else 
				{
					//change servers
					$temp = $server;
					$server = $receiver;
					$receiver = $temp;
					//Serve twice
					$point = getResult($server[1], $receiver[1], $server[3], $receiver[3], &$server[8], &$receiver[8]);
					if ($point === 'server') $serverPoints += 1;
					else $receiverPoints += 1;
					$point = getResult($server[1], $receiver[1], $server[3], $receiver[3], &$server[8], &$receiver[8]);
					if ($point === 'server') $serverPoints += 1;
					else $receiverPoints += 1;
					
					//check for winner
					if ($serverPoints >= 7 && ($receiverPoints < 5 || $serverPoints - $receiverPoints >= 2)) {
						$server[4] += 1;
						$server[5] += 1;
						$setWon = 1;	
						$tieBreak = 2;
						//echo "$server[0] = $server[4] $serverPoints vs $receiverPoints $receiver[0] = $receiver[4] <br />";
						if ($homePlayerName === $server[0])
						$setResult .= "$server[4]-$receiver[4]#";
						else
						$setResult .= "$receiver[4]-$server[4]#";
					}
					else if ($receiverPoints >= 7 && ($serverPoints < 5 || $receiverPoints - $serverPoints >= 2)) {
						$receiver[4] += 1;
						$receiver[5] += 1;
						$setWon = 1;	
						$tieBreak = 2;
						//echo "$server[0] = $server[4] $serverPoints vs $receiverPoints $receiver[0] = $receiver[4] <br />";
						if ($homePlayerName === $server[0])
						$setResult .= "$server[4]-$receiver[4]#";
						else
						$setResult .= "$receiver[4]-$server[4]#";
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
				//echo "$server[0] = $server[4] $serverPoints vs $receiverPoints $receiver[0] = $receiver[4] <br />";
				if ($homePlayerName === $server[0])
				$setResult .= "$server[4]-$receiver[4]#";
				else
				$setResult .= "$receiver[4]-$server[4]#";
				break;
			}
			else if (($receiver[4] == 6 && $server[4] < 5) || ($receiver[4] == 7 && $server[4] < 6)) {
				$receiver[5] += 1;
				$setWon = 1;
				//echo "$server[0] = $server[4] $serverPoints vs $receiverPoints $receiver[0] = $receiver[4] <br />";
				if ($homePlayerName === $server[0])
				$setResult .= "$server[4]-$receiver[4]#";
				else
				$setResult .= "$receiver[4]-$server[4]#";
				break;
			}
			else {
				while ($pointWon == 0) {
					//check for deuce
					if ($serverPoints == 4 && $receiverPoints == 4){
						//echo 'deuce' . "<br />";
						$pointWon = 1;
						break;
					}
					else {
						if ($serverPoints == 4 && $receiverPoints < 4) {
							$pointWon = 1;
							$server[4] += 1;
						}
						else if ($receiverPoints == 4 && $serverPoints < 4) {
							$pointWon = 1;
							$receiver[4] += 1;
						}
						//normal point to be played
						else {
							//echo "$server[1], $receiver[1], $server[3], $receiver[3] <br />";
							$point = getResult($server[1], $receiver[1], $server[3], $receiver[3], &$server[8], &$receiver[8]);
							if ($point === 'server') $serverPoints += 1;
							else $receiverPoints += 1;
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
	//update fitness
	$homePlayerSkills[6] = $homePlayerSkills[6] - $homePlayerEnergyLoss;
      	$awayPlayerSkills[6] = $awayPlayerSkills[6] - $awayPlayerEnergyLoss;

	} //end setWon loop

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
} //end matchWon loop

	
	//update player's fitness...
	$update = "UPDATE players SET fitness = {$homePlayerSkills[6]} WHERE idplayer = {$homePlayerSkills[7]}";
	if (!(mysql_query($update))) {
		echo mysql_error();
	}
	$update1 = "UPDATE players SET fitness = {$awayPlayerSkills[6]} WHERE idplayer = {$awayPlayerSkills[7]}";
	if (!(mysql_query($update1))) {
		echo mysql_error();
	}
	
	//Calculate the first serve percentage
$homePlayerSkills[8][4] = 100 * ($homePlayerSkills[8][0] - $homePlayerSkills[8][1] - $homePlayerSkills[8][2]) / $homePlayerSkills[8][0];
$awayPlayerSkills[8][4] = 100 * ($awayPlayerSkills[8][0] - $awayPlayerSkills[8][1] - $awayPlayerSkills[8][2]) / $awayPlayerSkills[8][0];
$homePlayerSkills[8][4] = number_format($homePlayerSkills[8][4],2);
$awayPlayerSkills[8][4] = number_format($awayPlayerSkills[8][4],2);

	if ($server[5] == 2 && $server[0] === $homePlayerName) {
		//echo "$matchID,$homePlayerID,$awayPlayerID,$courtType,$homePlayerID,$setResult <BR/>";
		$update = "UPDATE matches SET id_winner = $homePlayerID, score = '$setResult' WHERE id_match = $matchID";
		echo "$update <BR />";
		if (!(mysql_query($update))) {
             	//failure
			echo mysql_error();
        	}

        	$insert1 = "INSERT INTO match_stats (match_id,player_id,firstServe,aces,doubleFaults) VALUES 
        			('$matchID','$homePlayerID',{$homePlayerSkills[8][4]},{$homePlayerSkills[8][3]},{$homePlayerSkills[8][2]})";
        	if (!mysql_query($insert1)) {
	             //failure
			echo mysql_error();
        	}
        	$insert2 = "INSERT INTO match_stats (match_id,player_id,firstServe,aces,doubleFaults) VALUES 
        			('$matchID','$awayPlayerID',{$awayPlayerSkills[8][4]},{$awayPlayerSkills[8][3]},{$awayPlayerSkills[8][2]})";
        	if (!mysql_query($insert2)) {
	             //failure
			echo mysql_error();
        	}
		return 1;
	}
	else if ($server[5] == 2 && $server[0] === $awayPlayerName) {
		$update = "UPDATE matches SET id_winner = $awayPlayerID, score = '$setResult' WHERE id_match = $matchID";
		echo "$update <BR />";
		if (!(mysql_query($update))) {
             //failure
			echo mysql_error();
        	}
        	$insert1 = "INSERT INTO match_stats (match_id,player_id,firstServe,aces,doubleFaults) VALUES 
        			('$matchID','$homePlayerID',{$homePlayerSkills[8][4]},{$homePlayerSkills[8][3]},{$homePlayerSkills[8][2]})";
        	if (!mysql_query($insert1)) {
	             //failure
			echo mysql_error();
        	}
        	$insert2 = "INSERT INTO match_stats (match_id,player_id,firstServe,aces,doubleFaults) VALUES 
        			('$matchID','$awayPlayerID',{$awayPlayerSkills[8][4]},{$awayPlayerSkills[8][3]},{$awayPlayerSkills[8][2]})";
        	if (!mysql_query($insert2)) {
	             //failure
			echo mysql_error();
        	}
		return 0;
	}
	else if ($receiver[5] == 2 && $receiver[0] === $awayPlayerName) {
		$update = "UPDATE matches SET id_winner = $awayPlayerID, score = '$setResult' WHERE id_match = $matchID";
		echo "$update <BR />";
		if (!(mysql_query($update))) {
             //failure
			echo mysql_error();
        	}
        	$insert1 = "INSERT INTO match_stats (match_id,player_id,firstServe,aces,doubleFaults) VALUES 
        			('$matchID','$homePlayerID',{$homePlayerSkills[8][4]},{$homePlayerSkills[8][3]},{$homePlayerSkills[8][2]})";
        	if (!mysql_query($insert1)) {
	             //failure
			echo mysql_error();
        	}
        	$insert2 = "INSERT INTO match_stats (match_id,player_id,firstServe,aces,doubleFaults) VALUES 
        			('$matchID','$awayPlayerID',{$awayPlayerSkills[8][4]},{$awayPlayerSkills[8][3]},{$awayPlayerSkills[8][2]})";
        	if (!mysql_query($insert2)) {
	             //failure
			echo mysql_error();
        	}
		return 0;
	}
	if ($receiver[5] == 2 && $receiver[0] === $homePlayerName) {
		//echo "$matchID,$homePlayerID,$awayPlayerID,$courtType,$homePlayerID,$setResult <BR/>";
		$update = "UPDATE matches SET id_winner = $homePlayerID, score = '$setResult' WHERE id_match = $matchID";
		echo "$update <BR />";
		if (!(mysql_query($update))) {
             //failure
			echo mysql_error();
        	}
        	$insert1 = "INSERT INTO match_stats (match_id,player_id,firstServe,aces,doubleFaults) VALUES 
        			('$matchID','$homePlayerID',{$homePlayerSkills[8][4]},{$homePlayerSkills[8][3]},{$homePlayerSkills[8][2]})";
        	if (!mysql_query($insert1)) {
	             //failure
			echo mysql_error();
        	}
        	$insert2 = "INSERT INTO match_stats (match_id,player_id,firstServe,aces,doubleFaults) VALUES 
        			('$matchID','$awayPlayerID',{$awayPlayerSkills[8][4]},{$awayPlayerSkills[8][3]},{$awayPlayerSkills[8][2]})";
        	if (!mysql_query($insert2)) {
	             //failure
			echo mysql_error();
        	}
		return 1;
	}
	

} // end Function Match_Engine

function getResult($serveskill, $receiveskill, $serverrally, $receiverrally, $serverStats, $receiverStats)
{
    // Use this function - random_number($type='INTEGER', $min=0, $max=10)
    //echo "<BR /> $serveskill, $receiveskill";
    $winner = 0;
    $fault = 1;
    //Check for ace (8%)
    $aceCheck = random_number('FLOAT', 0, abs($receiveskill - $serveskill));
    //echo "<BR /> $serveskill, $receiveskill, $aceCheck";
    if ($aceCheck > (abs($receiveskill - $serveskill) * 0.6))
    {
        $winner = 'server';
        //getCommentary('ace');
	echo 'Ace' ."<BR />";
	$serverStats[0] += 1;
	$serverStats[3] += 1;
	return $winner;
    } // End if $aceCheck
    
    //Check for fault (40%)
    $checkServe = random_number('INTEGER', 0, $serveskill);
	//echo 'checkServe ' . $checkServe . "<BR />";
    $serverStats[0] += 1; // increment serve counter
    if ($checkServe > ($serveskill * 0.6)) {// Based on 60% chance of 1st serve in
    	echo 'Fault' . "<BR />";
    	$serverStats[1] += 1; // increment Fault counter
        $checkServe = random_number('INTEGER', 0, $serveskill);
	//echo 'checkServe ' . $checkServe . "<BR />";
	$serverStats[0] += 1; // increment serve counter	
    	if ($checkServe > ($serveskill * 0.6)) {
		$winner = 'receiver';
	        //getCommentary('doubleFault');
		echo 'doubleFault' ."<BR />";
		$serverStats[2] += 1;
		$fault = 0;
		//echo $winner . "<BR />";
		return $winner;
	}
	$aceCheck = random_number('FLOAT', 0, abs($receiveskill - $serveskill));
    	if ($aceCheck > (abs($receiveskill - $serveskill) * 0.08))
   	 {
       	 	$winner = 'server';
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
	$winner = 'server';
        if ($rallyCheck < ($serverrally * 0.25))
        {
        //getCommentary("server win");
	echo 'Server Win' ."<BR />";
        } else if ($rallyCheck < ($serverrally * 0.7))
        {
           //getCommentary("winner");
           echo 'Winner Server' ."<BR />";
        }
	return $winner;
    } 
	else //reciever wins point
    {
        $winner = 'receiver';
        if ($rallyCheck < ($receiverrally * 0.3))
        {
            //getCommentary("receiver win")
	    echo 'Receiver Win' ."<BR />";
        } else if ($rallyCheck < ($receiverrally * 0.75))
        {
            //getCommentary("winner"); 
	    echo 'Winner Receiver' ."<BR />";
        } else
        {
            //getCommentary("error");
	    echo 'Error R' ."<BR />";
        }
        return $winner;
    } // End else
    
    	echo " MESS <br />";
	return $winner;
    

} // End function

?>