<?php

 #include the common file
 require_once 'common.php';

      
session_start();
if (@$_SESSION['authenticated'] == 'true' && @$_SESSION['admin'] == 'true')
         {
             include ("../DBconfig.php");

             $result = array();
             function updateCountry()
             {
                //display list of countries,number of players & number of managers
                //in each country
                //$query = "SELECT countries.countryshort, countries.countryname, COUNT( managers.idmanagers ) AS num_managers FROM countries LEFT JOIN managers ON countries.idcountry = managers.idcountry GROUP BY countries.idcountry";
                $query = "SELECT c.countryshort,c.countryname,COUNT(a.team_name) AS free FROM academy AS a LEFT JOIN countries AS c ON c.idcountry = a.id_country WHERE id_user IS NULL GROUP BY c.countryname DESC";
                $r = mysql_query($query);
                global $result;
                while ($ob = mysql_fetch_object($r)) {
                    $result[] = $ob;
                }
             }

             updateCountry();

             if($_POST['create']) {
                    $countryname = $_POST['countryname'];
                    $countryshort = $_POST['shortname'];                   
                    
                    
                    
                        $insert = sprintf("INSERT INTO countries(countryname, countryshort) VALUES ('%s','%s')", mysqli_real_escape_string($conn, $countryname), mysqli_real_escape_string($conn,$countryshort));
                        if(!(mysqli_query($conn, $insert))) {
                            $error = mysqli_error($conn);
                        }
                        else {
                            $message = 'Country added';
                            updateCountry();
                        }
                    

             }
             
             if ($_POST['genFix']){
             	
             	$dateTime = $_POST['dateTime'];
             	$query = "SELECT idcourttype FROM courttype WHERE 1";
				$r = mysql_query($query);
				while ($row = mysql_fetch_row($r)) {         			 	
					$courts[] = $row[0];
				}
             	
             	$countries = array();
             	$select = mysql_query("SELECT id_cteam FROM country_team ORDER BY rank DESC");
             	while ($row = mysql_fetch_row($select)){
             		$countries[] = $row[0];
             	}
             	
             	//$countries = array(1,2,3,4,5,6,7,8);
             	$teams = sizeof($countries); 
				$totalRounds = 1;
				$matchesPerRound = $teams / 2;
             	
             	for ($match = 0; $match < $matchesPerRound; $match++) {
					$home = ($match) % ($teams - 1);
					$away = ($teams - 1 - $match) % ($teams - 1);
					if ($match == 0) {
						$away = $teams - 1;
					}
					$rounds[$match] = $countries[$home] . " v " . $countries[$away];
                }
                
                foreach ($rounds as $r){
	                $components = split(' v ', $r);
					$country1 = $components[0];
					$country2 = $components[1];
					$court = array_rand($courts) + 1;
			
					$insert = "INSERT INTO fixtures (season,fixture_type, round_date, id_team1, id_team2, id_stadium) VALUES ('$season','3', '$dateTime', '$country1', '$country2', '$court')";
					/*
					//echo "<br /> $insert";
					if (!mysql_query($insert)) {
					//	global $errorFixtures;
						$error = 'Error while inserting data into match tables' . mysql_error() ;
					}
					*/
                 }
                
             	
             	
		
             	
             }

             $smarty->assign('message', $message);
             $smarty->assign('error', $error);
             $smarty->assign('result',$result);
             $smarty->display('mgmtCountry.tpl');
         }


?>