<?php
		/* League Management Page
		 * - 1. Add 1 to player ages, remove all unwanted players
		 * - 2. Allocate Prize Money to Academies
		 * - 3. Promote / Demote 
		 * - 4. Generate new fixtures - to be done in mgmtLeague Page
		 */


#include the common file
require_once ("common.php");
        

#include the DBConfig file
include ("../DBconfig.php");
 
        

	

        session_start();
         if (@$_SESSION['authenticated'] == 'true' && @$_SESSION['admin'] == 'true')
         {
            //Default selected country

		$week = floor((mktime() - $season_start)/604800);
		
		// AGE ALL PLAYERS THAT BELONG TO A TEAM
		$update = "UPDATE players SET age = age + 1 WHERE id_team > 0";
		if (!mysqli_query($conn,$update)) {
			$error = 'Error while updating player age';
			echo "$error";
		}
		else {
			echo "All Players aged <br />";
			//DELETE PLAYERS WITH NO TEAMS
			$delete = "DELETE FROM players WHERE id_team = 0";
			if (!mysqli_query($conn,$delete)) {
				$error = 'Error while deleting players';
				echo "$error";
			}
			else 
			echo "All players with no teams deleted <br />";
		}
		
		// PRIZE MONEY
		$teams = array();
		$query = mysql_query("SELECT t.id_league, t.id_team, t.rank, f.sponsor, f.league
				FROM league_table AS t
				JOIN league AS l ON t.id_league = l.idleague
				JOIN finance_leaguepos AS f ON l.league_pos = f.league");
		while ($row = mysql_fetch_row($query)){
			$teams[] = $row;
		}
		$errorP = 0;
		// Winning prize = sponsor * (10 - league#) + (12 - rank) * 1000; 10 = balance number, 12 = number of teams in league
		foreach ($teams as $team){
			$prize = $team[3] * (10 - $team[4]) + (12 - $team[2]) * 1000;
			//echo "$team[1] - $prize $team[0] $team[2] <BR />"
			$insert = "INSERT INTO finance (id_team,week,type,id_finance,amount) VALUES 
										({$team[1]},$week,1,10,$prize)";
			if (!(mysql_query($insert))) {
				echo mysql_error(); 
				$errorP = 1;
        		}
		}
		if ($errorP = 0) echo "Prize Money Alloted <br />";
		
		
		
		//League Promotions / Demotions
		// testing promotion
$leagues = array();
$query = mysql_query("SELECT idleague, idcountry FROM league ORDER BY idleague");
while ($row = mysql_fetch_row($query)){
	$leagues[] = $row;
}
//print_r($leagues);

$i = 0;
$country = 1;
$countryLeagues = array();
foreach($leagues as $league){
	if ($league[1] == $country){
		$countryLeagues[$i][] = $league[0];
	}
	else {
		$country = $league[1];
		$i = $i +1 ;
		$countryLeagues[$i][] = $league[0];
	}
}
//print_r($countryLeagues);
$new = array();
foreach($countryLeagues as $cl){
	//print_r($cl);	
	$lbn = array(); //array that stores team, rank & league per country
	$last = end($cl);
	$first = reset($cl);
	//print $last; print $first;
	$query = mysql_query("SELECT `id_team`, `rank`, `id_league` FROM `league_table` 
		WHERE season = '$season' AND id_league >= '$first' AND id_league <= '$last' ORDER BY id_league DESC,rank ASC");
	while ($row = mysql_fetch_row($query)){
		$lbn[] = $row;
	}
	//print_r($lbn);
	$new = array();
	$counter = $last;
	while ($counter >= $first){
		$old = array();
		
		$ns = $season + 1;
		if ($counter == $last){
			// create a new array with details of required league
			foreach($lbn as $l){
				if ($l[2] == $counter){
					$old[] = $l;
				} 
			}

			//$old contains the list of leagues as in the previous season
			foreach($old as $ol){
				//promote
				if ($ol[1] < 3){
					$new[$counter-1][] = $ol;
					echo "Team $ol[0] Promoted to League $counter-1 <br />";
					$nl = $counter - 1;
					$insert = "INSERT INTO league_table (id_league,id_team,season) VALUES ($nl,{$ol[0]},$ns)";
					if (!(mysql_query($insert))){
						echo mysql_error();
					}	
				}
				else {
					//$new[$counter][] = $ol;
					$nl = $counter;
					$insert = "INSERT INTO league_table (id_league,id_team,season) VALUES ($nl,{$ol[0]},$ns)";
					if (!(mysql_query($insert))){
						echo mysql_error();
					}

				}
			}
			
			
		}
		else if ($counter == $first) {
			// create a new array with details of required league
			foreach($lbn as $l){
				if ($l[2] == $counter){
					$old[] = $l;
				} 
			}
			
			$prev = count($old)-2;
			//$old contains the list of leagues as in the previous season
			foreach($old as $ol){
				//demote 2
				if ($ol[1] > $prev){
					$new[$counter+1][] = $ol;
					echo "Team $ol[0] Demoted to League $counter+1 <br />";
					$nl = $counter + 1;
					$insert = "INSERT INTO league_table (id_league,id_team,season) VALUES ($nl,{$ol[0]},$ns)";
					if (!(mysql_query($insert))){
						echo mysql_error();
					}
				}
				else {
					//$new[$counter][] = $ol;
					$nl = $counter;
					$insert = "INSERT INTO league_table (id_league,id_team,season) VALUES ($nl,{$ol[0]},$ns)";
					if (!(mysql_query($insert))){
						echo mysql_error();
					}
				}
			}
		}
		else {
			// create a new array with details of required league
			foreach($lbn as $l){
				if ($l[2] == $counter){
					$old[] = $l;
				} 
			}
			
			$prev = count($old)-2;
			//$old contains the list of leagues as in the previous season
			foreach($old as $ol){
				//promote 2
				if ($ol[1] < 3){
					//$new[$counter-1][] = $ol;
					//echo "Team $ol[0] Promoted to League $counter-1 <br />";
					$nl = $counter - 1;
					$insert = "INSERT INTO league_table (id_league,id_team,season) VALUES ($nl,{$ol[0]},$ns)";
					if (!(mysql_query($insert))){
						echo mysql_error();
					}	

				}
				//demote 2
				else if ($ol[1] > $prev){
					// $new[$counter+1][] = $ol;
					// echo "Team $ol[0] Demoted to League $counter+1 <br />";
					$nl = $counter + 1;
					$insert = "INSERT INTO league_table (id_league,id_team,season) VALUES ($nl,{$ol[0]},$ns)";
					if (!(mysql_query($insert))){
						echo mysql_error();
					}	

				}
				else {
					//$new[$counter][] = $ol;
					$nl = $counter;
					$insert = "INSERT INTO league_table (id_league,id_team,season) VALUES ($nl,{$ol[0]},$ns)";
					if (!(mysql_query($insert))){
						echo mysql_error();
					}
				}

			}
		}
				
		$counter--;
	}
	
}
				
       
	

          
				 
       	
       
      }  
?>