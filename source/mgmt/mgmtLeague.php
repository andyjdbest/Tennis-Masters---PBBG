<?php
		/* League Management Page
		 * - 1. View the different leagues setup per Country 
		 * - 2. Add academies to league (For initial setup and new country)
		 * - 3. View the academies assigned to each league
		 */


#include the common file
include ("common.php");
        

#include the DBConfig file
include ("../DBconfig.php");
 
        
function showCountry($id) {
    $id = mysql_real_escape_string($id);
		
	$query = "SELECT idleague, nameleague, league_pos FROM league WHERE idcountry = $id";
    $r = mysql_query($query);
    global $leaguedata;
    while ($ob = mysql_fetch_object($r)) {
                   $leaguedata[] = $ob;
     } 
}
		
function updateCountry() {
    $query = "SELECT * FROM countries";
    $r = mysql_query($query);
	global $countries;
	while ($row = mysql_fetch_row($r)) {
                    $countries[] = $row[2];			
    }			
}

function generateFixtures($country, $time)
{
    $countryid = $country;
    $courts = array();
    //$numperleague =  $numplayerspercountry / $numleague;

    $query = "SELECT idcourttype FROM courttype WHERE 1";
    $r = mysql_query($query);
    while ($row = mysql_fetch_row($r)) {         			 	
		$courts[] = $row[0];
    }
					
    //check if league setup is proper
    $query = "SELECT DISTINCT p.id_league FROM league_table AS p JOIN league AS l ON l.idleague = p.id_league WHERE l.idcountry = '$countryid'";
    $r = mysql_query($query);
    while ($row = mysql_fetch_row($r)) {         			 	
	$league_ids[] = $row[0];
        //$counter = $counter + 1;
    } 
            		
    //$league_ids = array_unique($league_ids);
					
    foreach($league_ids as $id)	{
	$academy_ids = array();
	$query = "SELECT id_team FROM league_table WHERE id_league = '$id'";
 	$r = mysql_query($query);
 	while ($row = mysql_fetch_row($r)) {         			 	
		$academy_ids[] = $row[0];
 	}
					 
    $teams = sizeof($academy_ids);
	$totalRounds = $teams - 1;
	$matchesPerRound = $teams / 2;
	$rounds = array();
					 
	for ($i = 0; $i < $totalRounds; $i++) {
            $rounds[$i] = array();
    }
					
	for ($round = 0; $round < $totalRounds; $round++) {
       		 for ($match = 0; $match < $matchesPerRound; $match++) {
        		$home = ($round + $match) % ($teams - 1);
        		$away = ($teams - 1 - $match + $round) % ($teams - 1);
        		// Last team stays in the same place while the others
        		// rotate around it.
        		if ($match == 0) {
        			$away = $teams - 1;
        		}
        		$rounds[$round][$match] = $academy_ids[$home] 
        		. " v " . $academy_ids[$away];
                  }
        }
					
	// Interleave so that home and away games are fairly evenly dispersed.
    	$interleaved = array();
    	for ($i = 0; $i < $totalRounds; $i++) {
        	$interleaved[$i] = array();
    	}
    
    	$evn = 0;
    	$odd = ($teams / 2);
    	for ($i = 0; $i < sizeof($rounds); $i++) {
        	if ($i % 2 == 0) {
                	$interleaved[$i] = $rounds[$evn++];
        	} else {
            		$interleaved[$i] = $rounds[$odd++];
        	}
        }

    	$rounds = $interleaved;

    	// Last team can't be away for every game so flip them
    	// to home on odd rounds.
    	for ($round = 0; $round < sizeof($rounds); $round++) {
        	if ($round % 2 == 1) {
        		$rounds[$round][0] = flip($rounds[$round][0]);
        	}
    	}
	
	// Add the fixtures to the table
		global $season, $season_start;	
		$num = 0;
    	for ($i = 0; $i < sizeof($rounds); $i++) {	
		//print "<p>Round " . ($i + 1) . "</p>\n";
        	$round_num = $i+1;
			if ($round_num % 2 ) {
				$round_date = date('Y-m-d : H:i:s', strtotime('+' ."$num" . "weeks Monday" . $time . ' hours', $season_start));
			}
			else {
				$round_date = date('Y-m-d : H:i:s', strtotime('+' ."$num" . "weeks Friday" . $time . ' hours', $season_start));
				$num += 1;
			}
			foreach ($rounds[$i] as $r) {				
			$components = explode(' v ', $r);
			$player1 = $components[0];
			$player2 = $components[1];
			$court = array_rand($courts) + 1;
			
			$insert = "INSERT INTO fixtures 
				(season,fixture_type, id_league, round, round_date, id_team1, id_team2, id_stadium) 
				VALUES 
				('$season','1', '$id', '$round_num', '$round_date', '$player1', '$player2', '$court')";
			if (!mysql_query($insert)) {
				global $errorFixtures;
				$errorFixtures = 'Error while inserting data into match tables' . mysql_error() ;
			}
        	}
			
        }
    				
    	$round_counter = sizeof($rounds) + 1;
    	for ($i = sizeof($rounds) - 1; $i >= 0; $i--) {
	//	print "<p>Round " . $round_counter . "</p>\n";
			if ($round_counter % 2) {
				$round_date = date('Y-m-d : H:i:s', strtotime('+' ."$num" . "weeks Monday" . $time . ' hours', $season_start));
			}
			else {
				$round_date = date('Y-m-d : H:i:s', strtotime('+' ."$num" . "weeks Friday" . $time . ' hours', $season_start));
				$num += 1;
			}
        	foreach ($rounds[$i] as $r) {	
			$components = explode(' v ', $r);
			$court = array_rand($courts) + 1;
			
			$insert = "INSERT INTO fixtures 
					(season,fixture_type, id_league, round, round_date, id_team1, id_team2, id_stadium) 
					VALUES 
					('$season','1', '$id', '$round_counter', '$round_date', $components[1],$components[0],$court)";
			if (!mysql_query($insert)) {
				global $errorFixtures;
				$errorFixtures = 'Error while inserting data into reverse match tables' . mysql_error();
             }
			
        	}
                $round_counter += 1;
    	}				 
} //end the league ids loop
		
if ($errorFixtures == ''){
	global $messageFixtures;
	$messageFixtures = 'Generated Fixtures Successfully ';
}
		
}

function flip($match) {
    $components = explode(' v ', $match);
    return $components[1] . " v " . $components[0];
}
	
	

        session_start();
         if (@$_SESSION['authenticated'] == 'true' && @$_SESSION['admin'] == 'true')
         {
            //Default selected country
		$countryid = 1;
		$leaguedata = array();
		$countries = array();
		$numleague = 2;
		$numacademiespercountry = 24;
        $numperleague =  $numacademiespercountry / $numleague;
		$players_per_academy = 5;
		$errorFixtures = '';
		$messageFixtures = '';
		$errorCreateAcademy = '';
		$messageCreateAcademy = '';
		$errorSeniorAcademy = '';
		$messageSeniorAcademy = '';
			
        showCountry($countryid);
		updateCountry();

		if ($_POST['Show']) {
			$leaguedata = array();
			showCountry($_POST['countryL']+1);			
		}
			
		//Assign Academies to leagues	
        if ($_POST['AddAcademy']) {
                                
			$country = mysql_real_escape_string($_POST['countryA']);
			$country = $country + 1;
			$counter = 0;						 
			//check if league setup is proper
           	$query = "SELECT idleague FROM league WHERE idcountry = '$country' ORDER BY league_pos DESC";
           	$r = mysqli_query($conn,$query);
           	while ($row = mysqli_fetch_row($r)) {
           	 	$leagueids[] = $row[0];
				$counter = $counter + 1;
           	 }
            if ($counter != $numleague) {
                         $errorLeague = 'Error in League Setup for ' .$country;
 			}
            else {
                    //perform academy assignment to league....fetch all academies for the country
                    $counter = 0;
                    $query = "SELECT a.id_team,SUM(s.rating) as RATING FROM player_stats AS s JOIN academy_player AS a ON s.idplayer = a.id_player JOIN academy AS t ON t.id_team = a.id_team WHERE t.id_country = '$country' GROUP BY t.id_team";
                    $r = mysqli_query($conn,$query);
                    while ($row = mysqli_fetch_row($r)) {
           	 			$academy_ids[] = $row[0];
						$counter = $counter + 1;
           	 		}
                    if ($counter != $numacademiespercountry) {
                                 $errorLeague = 'Do not have required number of academies in ' .$country;
 					}
                     //Now, players are in academy_ids and leagues are in leagueids.
                    //Move through playerids and assign to league
                     for ($i=0;$i<$numleague;$i++) {
			 			$league = $leagueids[$i];
			 			for ($j=0;$j<$numperleague;$j++) {
                            $academy = $academy_ids[$i*$numperleague+$j];
							//check from here - wrt which league table we are using
							$insert = "INSERT IGNORE INTO league_table (id_league,id_team,season) VALUES ('$league','$academy','$season')";
							if (!mysqli_query($conn,$insert)) {
									$errorLeague = 'Error while inserting data into league tables';
							}
							
                            }
                         }
                        }
		
				if ($errorLeague == '')
						$messageLeague = 'Academies assigned for leagues in country with id ' .$country;
				
            }
            
			
			if ($_POST['GenFix']) 
			{
				$country = mysql_real_escape_string($_POST['countryF']);
				$country = $country + 1;
				$time = '8';
				$time = mysql_real_escape_string($_POST['time']);
				//echo $time;
				generateFixtures($country,$time);
			}

            if ($_POST['SeniorAcademy'])
			{
				$counter = 0;
				$country = mysql_real_escape_string($_POST['countrySM']);
				$country = $country + 1;

				//fetch 5 random senior players and assign to 1 academy
                //$query = "SELECT * FROM `players` WHERE countryid = '$country' AND id_team is NULL ORDER BY RAND() LIMIT 1";
				$query = "SELECT id_team FROM academy WHERE id_country = '$country'";
				$r = mysqli_query($conn,$query);
				while ($row = mysqli_fetch_row($r)) {
           	 		$teams[] = $row[0];
					$counter = $counter + 1;
           	 	}
            	if ($counter != $numacademiespercountry) {
                    $errorSeniorAcademy = 'Wrong Number of Academies present in ' .$country;
 				}
				else {
					for($i=0;$i<$numacademiespercountry;$i++) {
						$team_id = $teams[$i];
						for ($j=0;$j<$players_per_academy;$j++) {
							$r = mysql_query("SELECT idplayer FROM players WHERE countryid = '$country' AND id_team is NULL ORDER BY RAND() LIMIT 1");
							$row = mysql_fetch_row($r);
							$id_player = $row[0];
								
							//print_r($row);
							$query = "INSERT INTO academy_player (id_team, id_player, date) VALUES ('$team_id','$id_player', NOW())";
							if (!(mysqli_query($conn,$query))) {
								$errorSeniorAcademy = 'Error adding players to academy';
							}
							$update = "UPDATE players SET id_team = '$team_id' WHERE idplayer = '$id_player'";
							if (!(mysqli_query($conn,$update))) {
								$errorSeniorAcademy = 'Error assigning players to academy';
							}
						}
					}
					if ($errorSeniorAcademy == '') {
						$messageSeniorAcademy = 'Players Assigned to Academy';
					}
				}            
			}
			
			if ($_POST['CreateAcademy'])
			{
				$country = mysql_real_escape_string($_POST['countryAcademy']);
				$country = $country + 1;
				
				if (ctype_digit($_POST['number']) === false) {
                        		$errorCreateAcademy = 'Check the inputs.'; 
                   		 }
				else {
					$number = $_POST['number'];
					$param = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
					
					for ($i=0;$i<$number;$i++) {
						$team = '';
			                        for ($j = 0; $j < 10; $j ++) {
                        				     $team .= substr($param, ((int) mt_rand(0, strlen($param)) - 1), 1);
			                        }
						$query = "INSERT INTO academy (team_name, id_country) VALUES ('$team','$country')";
						if (!(mysqli_query($conn, $query))) {
			                               $errorCreateAcademy = mysqli_error($conn);
			                        }
			                        else {
			                        	$id_team = mysqli_insert_id($conn);
										$stad = 1;
										switch ($country){
											case 1: 
												$stad = 4;
												break;
											case 2:
												$stad = 1;
												break;
											case 3:
												$stad = 2;
												break;
											case 4:
												$stad = 3;
												break;
										}
			                        	$insert = "INSERT INTO stadium (id_team, name, stad_no, court_type) VALUES ('$id_team','Court 1', '1', '$stad')";
			                        	if (!(mysqli_query($conn, $insert))) {
			                              		 $errorCreateAcademy = mysqli_error($conn);
			                       		 }
			                       		 $stad = random_number('INTEGER', 0, 4);
			                       		 $insert1 = "INSERT INTO stadium (id_team, name, stad_no, court_type) VALUES ('$id_team', 'Court 2', '2', '$stad')";
			                        	if (!(mysqli_query($conn, $insert1))) {
			                              		 $errorCreateAcademy = mysqli_error($conn);
			                       		 }
			                        }
					}
				}
				if ($errorCreateAcademy == '')
				{
					$messageCreateAcademy = 'Academies successfully created.';
				}                   
			}
			
			if ($_POST['Promo'])
			{
				$errorPromo = 'Not yet coded';
			}
			
			if ($_POST['stadium']) {
				$teams = array();
				$query = mysql_query("SELECT id_team,id_country FROM academy");
				while ($row = mysql_fetch_array($query)){
					$teams[] = $row;
				}
				
				if (isset($teams[0][0])){
					foreach($teams as $team){
						$id_team = $team[0];
						switch ($team[1]){
							case 1: 
								$stad = 4;
								break;
							case 2:
								$stad = 1;
								break;
							case 3:
								$stad = 2;
								break;
							case 4:
								$stad = 3;
								break;
						}
						
						$insert = "INSERT INTO stadium (id_team, name, stad_no, court_type) VALUES ('$id_team','Court 1', '1', '$stad')";
			                        	if (!(mysqli_query($conn, $insert))) {
			                              		 $errorCreateAcademy = mysqli_error($conn);
			                       		 }
			                       		 $stad = random_number('INTEGER', 0, 4);
			                       		 $insert1 = "INSERT INTO stadium (id_team, name, stad_no, court_type) VALUES ('$id_team', 'Court 2', '2', '$stad')";
			                        	if (!(mysqli_query($conn, $insert1))) {
			                              		 $errorCreateAcademy = mysqli_error($conn);
			                       		 }
					}
				}
			}
			
			$query = mysql_query("SELECT name_fixture FROM fixture_type WHERE id_fixture > 3");
			while ($row = mysql_fetch_array($query)){
				$knockOutOptions[] = $row[0];
			}
			//Knock-out Cups
			if ($_POST['knockout'])
			{
				$cup = mysql_real_escape_string($_POST['knockOut']);
				$cup = $cup + 4;
				$dateTime = $_POST['kdateTime'];
				echo $cup;
				$stadium = $cup - 3;
				
                $insert = "INSERT INTO fixtures 
					(season,fixture_type, round_date, id_team1, id_team2, id_stadium) 
					VALUES ('$season','$cup', '$dateTime', '0', '0', '$stadium')";	
				if (!mysql_query($insert)) {
					//	global $errorFixtures;
					$error = 'Error while inserting data into fixtures' . mysql_error() ;
				}
				$id_fixture = mysql_insert_id();
				
				//$query = "SELECT * FROM `players` WHERE countryid = '$country' AND id_team is NULL ORDER BY RAND() LIMIT 1";
				$query = "SELECT idplayer FROM players WHERE wrank > 0 ORDER BY wrank ASC LIMIT 64";
				$r = mysqli_query($conn,$query);
				while ($row = mysqli_fetch_row($r)) {
           	 		$players[] = $row[0];
           	 	}
            	
				$max = sizeof($players); 
				$totalRounds = 1;
				$matchesPerRound = $max / 2;
				
				for ($match = 0; $match < $matchesPerRound; $match++) {
					$home = ($match) % ($max - 1);
					$away = ($max - 1 - $match) % ($max - 1);
					if ($match == 0) {
						$away = $max - 1;
					}
					$rounds[$match] = $players[$home] . " v " . $players[$away];
                }
                
                foreach ($rounds as $r){
	                $components = explode(' v ', $r);
					$player1 = $components[0];
					$player2 = $components[1];
			
					$insert = "INSERT INTO matches (id_fixture, id_player1, id_player2, id_court) VALUES ('$id_fixture', '$player1', '$player2', '$stadium')";
					//echo "<BR />$insert";
					
					//echo "<br /> $insert";
					if (!(mysql_query($insert))) {
					//	global $errorFixtures;
						$error = 'Error while inserting data into match tables' . mysql_error() ;
					}
					
                 }

				
			}
				 
        $smarty->assign('leaguedata',$leaguedata);
        $smarty->assign('countries',$countries);
		$smarty->assign('knockOutOptions',$knockOutOptions);
        $smarty->assign('errorLeague',$errorLeague);
		$smarty->assign('messageLeague',$messageLeague);
		$smarty->assign('errorFixtures',$errorFixtures);
		$smarty->assign('messageFixtures',$messageFixtures);
		$smarty->assign('errorCreateAcademy',$errorCreateAcademy);
		$smarty->assign('messageCreateAcademy',$messageCreateAcademy);
		$smarty->assign('errorSeniorAcademy',$errorSeniorAcademy);
		$smarty->assign('messageSeniorAcademy',$messageSeniorAcademy);
		$smarty->assign('errorPromo',$errorPromo);
		$smarty->assign('error',$error);		
        $smarty->display('mgmtLeague.tpl');
      }  
?>