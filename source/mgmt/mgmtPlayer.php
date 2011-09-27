<?php

 #include the common file
 require_once "common.php";
        
 #include the DBConfig file
 include ("../DBconfig.php");
 
 

function playergen($team='', $minrating=1, $maxrating=15, $minage=16, $maxage=36) {

            $usafirstname = array( 'David', 'Alex', 'Christian', 'Bryan', 'Lucas', 'Hunter', 'Gregory', 'Nigel', 'Frank', 'Logan', 'Liam', 'Jake', 'Richardson', 'Aaron', 'Kenny', 'David', 'Dominic', 'Blake', 'Luke', 'Sonny');
            $usalastname = array( 'Bailey', 'Ward', 'Beard', 'Butler', 'Cooper', 'Greybill', 'Blackstone', 'Scott', 'Ross', 'Patterson', 'James', 'Evans', 'Lee', 'Sordo', 'Donovan', 'Jackson', 'Varley', 'Bolam', 'Sturridge', 'Ruff');
            $engfirstname = array( 'John', 'James', 'Jermaine', 'Peter', 'John', 'Harry', 'Harris', 'Terry' , 'Matthew', 'Nathan', 'Fred', 'Glen', 'Steven', 'Frank', 'Wayne', 'Michael', 'Brian', 'Alexander', 'Robert', 'Andrew', 'Elliott', 'Lewis', 'David', 'Rio', 'Alistair', 'Anton', 'Simon', 'Neil', 'Trevor', 'Hadley', 'Cavell');
            $englastname = array( 'Jones', 'Reid', 'Cox', 'Muggeridge', 'Allen', 'Innes', 'Johnson', 'Christopher', 'North', 'Hamilton', 'Brown', 'Burns', 'Connelly', 'Davidson', 'White', 'Robertson', 'Simpson', 'Andrews', 'Silk', 'Reade', 'Walsh', 'Lewis', 'Smith', 'Wiggins', 'Hoy', 'Murray', 'Adlington', 'Davies', 'Davis', 
           			 'Aspin', 'Storton');
           $ausfirstname = array('Aaron', 'Adam', 'Adrian', 'Aiden', 'Alexander', 'Angus', 'Anthony', 'Archer', 'Arland', 'Ashton', 'Austin', 'Baden', 'Bailey', 'Barney', 'Bayleigh', 'Baylen', 'Ben', 'Benjamin', 'Billy', 'Blair', 'Blake', 
           			'Brayden', 'Brendan', 'Brett', 'Brock', 'Brodie', 'Brooklyn', 'Bryley', 'Bryson', 'Cael', 'Cain', 'Caleb', 'Cameron', 'Campbell', 'Carter', 'Cayden', 'Chad', 'Charles', 'Charlie', 'Christian', 'Christopher', 'Coby', 'Cody', 'Cohen', 'Coleman', 'Connor', 'Cooper', 'Corbin', 'Corey', 'Daimon',  'Dale',
           			'Damian', 'Damon', 'Daniel', 'Dante', 'Dayne', 'Dean', 'Declan', 'Dylan', 'Eamon', 'Eden', 'Edward', 'Elliott', 'Ethan', 'Evan', 'Fabian', 'Fergus', 'Finlay', 'Finn', 'Fletcher', 'Flynn', 'Frazer', 'Frederik', 'Gabriel', 'Gareth', 'George', 'Grant', 'Gus', 'Harley', 'Harold', 'Harrison', 'Harry', 'Harvey',
				'Hayden', 'Heath', 'Henry', 'Hudson', 'Hugh', 'Hugo', 'Hunter', 'Jack', 'Jackson', 'Jacob', 'Jake', 'Jackson', 'James', 'Jared', 'Jarvis', 'Jonah', 'Jonas', 'Jonathan', 'Jordan', 'Joseph', 'Joshua', 'Josiah', 'Judah', 'Jude', 'Julian', 'Kade', 'Kaden', 'Kalan', 'Kaleb', 'Kane');
           $auslastname = array('Triggs', 'Tripp', 'Troedel', 'Trompf', 'Trott', 'Troy', 'Truman', 'Tryon', 'Tubb', 'Tuck', 'Tucker', 'Tuckson', 'Tudor', 'Waugh', 'Turnbull', 'Turner', 'Tweddle', 'Tyrrel', 'Rowell', 'Rowland', 'Rowley', 'Royston', 'Rudd', 'Ruse', 'Russell', 'Rutledge', 'Ryder', 'Rydge', 'Salisbury',
				'Salmon', 'Sampson', 'Samuel', 'Samuels', 'Sands', 'Savage', 'Sawers', 'Sawyer', 'Muriel', 'Murnin', 'Murphy', 'Murray', 'Napier', 'Narelle', 'Nash', 'Nathan', 'Naylor', 'Dyer', 'Dyring', 'Eade', 'Eades', 'Emanuel', 'Embley', 'Embry', 'Emmett', 'Ennor', 'Enright',
           			'Whelan', 'Wheller', 'Whiddon', 'Whinham', 'White', 'Whitehead', 'Whitelaw', 'Whitfeld', 'Whitham', 'Wicken', 'Wicks', 'Wieck', 'Wiedermann', 'Wienholt', 'Wiggins', 'Wight', 'Wilcox', 'Wild', 'Wilkins', 'Williams', 'Willis', 'Willmore', 'Willmott', 'Willson', 'Wilmot', 'Windsor', 'Winston', 'Winter', 'Wise',
				'Woodbury', 'Woodcock', 'Woods', 'Woolner', 'Woolnough', 'Woore', 'Wootten', 'Worgan', 'Wormald', 'Worrall', 'Worsnop', 'Wortman', 'Wray', 'Wreford', 'Wren', 'Wrench', 'Wright', 'Wrigley', 'Wrixon', 'Wunderly', 'Wurth', 'Wyatt', 'Wylde', 'Wymark', 'Wyndham', 'Wynn', 'Wynter', 'Yabsley', 'Yagan');	 
	   $frafirstname = array('Alexandre', 'Anton', 'Arnaud', 'Arthur', 'Aurelien', 'Benjamin', 'Benoit', 'Charles', 'Cedric', 'Christophe', 'Damien', 'David', 'Denis', 'Dominique', 'Emmanuel', 'Fabien', 'Frederic', 'Gabriel', 'Gregory', 'Guillaume', 'Jacques', 'Jean', 'Jerome', 'Jonathan', 'Julien', 'Laurent', 'Leon', 'Louis',
	   			 'Mathieu', 'Mickael', 'Nicolas', 'Olivier', 'Pierre', 'Romain', 'Sebastien', 'Stephane', 'Sylvain', 'Thomas', 'Vincent');
	  $fralastname = array('Andre','Arnaud','Aubert','Barbier','Benoit','Berger','Bernard','Bertrand','Blanc','Blanchard','Bonnet','Bourgeois','Boyer','Brun','Caron','Carpentier','Chevalier','Clement','Colin','David','Denis','Dubois','Dufour','Dumas','Dumont','Dupont','Dupuy','Durand','Duval',
				'Fabre','Faure','Fontaine','Fournier','Francois','Gaillard','Garnier','Gautier','Gerard','Giraud','Guerin','Guillaume','Guillot','Henry','Hubert','Jean','Joly','Lacroix','Lambert','Laurent','Leclerc','Lecomte','Lefebvre','Legrand','Lemaire','Lemoine','Leroux',
				'Leroy','Lopez','Lucas','Marchand','Martin','Masson','Mathieu','Mercier','Meunier','Meyer','Michel','Moreau','Morel','Morin','Muller','Nicolas','Noel','Olivier','Payet','Perrin','Petit','Philippe','Picard','Pierre','Renard','Renaud','Rey','Riviere',
				'Robin','Roche','Roger','Rolland','Rousseau','Roussel','Roux','Roy','Schmitt','Simon','Thomas','Vidal','Vincent'); 	  
            $hand = array('Right', 'Left');

            $playerfirstname = '';
            $playerlastname = '';

            $temp = array();
            if ($team == '')
            {
                $query = "SELECT countryshort FROM countries WHERE 1 ORDER BY RAND LIMIT 1";
                $result = mysqli_query($conn, $query);
                $row = mysqli_fetch_row($result);
                $team = $row[0];
            }
			
			$playererror = 1;
         	while ($playererror == 1) {   
			//choose the names based on the country
            switch ($team) {
                case 'USA':
                        $playerfirstname = $usafirstname[array_rand($usafirstname)];
                        $playerlastname = $usalastname[array_rand($usalastname)];
                        break;
                case 'ENG':
                        $playerfirstname = $engfirstname[array_rand($engfirstname)];
                        $playerlastname = $englastname[array_rand($englastname)];
                        break;
                case 'AUS':
                        $playerfirstname = $ausfirstname[array_rand($ausfirstname)];
                        $playerlastname = $auslastname[array_rand($auslastname)];
                        break;
                case 'FRA':
                        $playerfirstname = $frafirstname[array_rand($frafirstname)];
                        $playerlastname = $fralastname[array_rand($fralastname)];
                        break;                                        
		default:
                        $playerfirstname = $usafirstname[array_rand($usafirstname)];
                        $playerlastname = $usalastname[array_rand($usalastname)];
			break;
                }
                $temp[0] = $playerfirstname;
                $temp[1] = $playerlastname;
				
				//check if the name does not exist
                 $query = "SELECT idplayer FROM players WHERE firstname = '$playerfirstname' AND lastname = '$playerlastname'";
                 $r = mysql_query($query);
                 list($count) = mysql_fetch_row($r);
                 if ($count >= 1) {
                       $playererror = 1;
                 }
				 else {
				 		$playererror = 0;
				 }
			}

                //select random age
                $temp[2] = random_number('INTEGER',$minage,$maxage);

                //choose the hand
                $temp[3] = $hand[array_rand($hand)];

                //assign stats
                for ($j=4; $j<12; $j++)
                {
                        $temp[$j] = number_format(random_number('FLOAT',$minrating, $maxrating),2);
                        //$temp[$j] = $playerstat[$j];
                }
            return $temp;
 } 
/*
        function updateplayer()
        {
            $query = "SELECT p.idplayer, p.firstname, p.lastname, c.countryshort, p.youth, s.serve, s.forehand, s.backhand, s.volley,s.consistency,s.power,s.speed,s.stamina FROM players AS p JOIN player_stats AS s ON p.idplayer = s.idplayer JOIN countries AS c ON p.countryid = c.idcountry;";
                //$query = "SELECT countries.countryshort, countries.countryname FROM countries LEFT JOIN managers ON countries.idcountry = managers.idcountry";
                $r = mysql_query($query);
                global $playerdata;
                 
                while ($ob = mysql_fetch_object($r)) {
                    $playerdata[] = $ob;
                } 
        }
*/
        session_start();
         if (@$_SESSION['authenticated'] == 'true' && @$_SESSION['admin'] == 'true')
         {

           $playerdata = array();
//           updateplayer();

           if ($_POST)
           {
               $country = $_POST['country'];
               $num_player = $_POST['number'];
               $min_age = $_POST['min_age'];
               $max_age = $_POST['max_age'];
               $min_stat = $_POST['min_stat'];
               $max_stat = $_POST['max_stat'];
               $youth = $_POST['youth'];
               $fa = $_POST['free'];

               $player = array();

                if ((ctype_alnum($country) === false) || (ctype_alnum($num_player) === false)
                        || (ctype_alnum($min_age) === false) || (ctype_alnum($max_age) === false)
                        || (ctype_alnum($min_stat) === false) || (ctype_alnum($max_stat) === false))
                    {
                        $error = 'Check the inputs.';
                    }
                else {
                     for ($i=0;$i<$num_player;$i++) {

                        $player[$i][] = playergen($country, $min_stat, $max_stat, $min_age, $max_age);
			
                        $playerfirstname = $player[$i][0][0];
                        $playerlastname = $player[$i][0][1];
                        $playerage = $player[$i][0][2];
                        $playerhand = $player[$i][0][3];

                        if ($playerfirstname == '') {
                            $error = 'Name not generated';
                            //exit(0);
                        }
                        else
                        {
                                //fetch the country id
                                $query = "SELECT idcountry FROM countries WHERE countryshort = '$country'";
                                $result = mysqli_query($conn,$query);
                                $countryidrow = mysqli_fetch_row($result);
                                $idcountry = $countryidrow[0];
                                
                                if ($fa == 1){
                                
                                $insert = "INSERT INTO players(firstname,lastname,nationality,handed,age,countryid,youth,id_team) 
                                	VALUES('$playerfirstname','$playerlastname','$country','$playerhand','$playerage','$idcountry','$youth', '0')";
                                }
                                else{
                                $insert = "INSERT INTO players(firstname,lastname,nationality,handed,age,countryid,youth) 
                                	VALUES('$playerfirstname','$playerlastname','$country','$playerhand','$playerage','$idcountry','$youth')";
                                }
                                //$insert = "INSERT INTO players(firstname,lastname,nationality,handed,age) VALUES('$player[$i][0][0]','$player[$i][0][1]','$country','$player[$i][0][2]','$player[$i][0][3]')";
                                if (!(mysqli_query($conn, $insert))) {
                                    $error = mysqli_error($conn);
                                } 
                                else {
                                    //fetch the last playerid and then insert the stats in the player_stats table
                                    $query = "SELECT idplayer FROM players ORDER BY idplayer DESC LIMIT 1";
                                    $result = mysqli_query($conn,$query);
                                    $playerid = mysqli_fetch_row($result);

                                  //  for ($j=0;$j<8;$j++)
                                  //  {
                                        $playerserve = $player[$i][0][4];
                                        $playerforehand = $player[$i][0][5];
                                        $playerbackhand = $player[$i][0][6];
                                        $playervolley = $player[$i][0][7];
                                        $playerstamina = $player[$i][0][8];
                                        $playerconsistency = $player[$i][0][9];
                                        $playerpower = $player[$i][0][10];
                                        $playerspeed = $player[$i][0][11];
                                        $playerrating = $playerserve + $playerforehand + $playerbackhand + $playervolley + $playerstamina + $playerconsistency + $playerpower + $playerspeed;
							
                                        $insert = "INSERT INTO player_stats(idplayer,serve,forehand,backhand,volley,stamina,consistency,power,speed,rating) VALUES ('$playerid[0]','$playerserve','$playerforehand','$playerbackhand','$playervolley','$playerstamina','$playerconsistency','$playerpower','$playerspeed','$playerrating')";
                                        if (!(mysqli_query($conn, $insert))) {
                                                        $error = mysqli_error($conn);
                                        }
                                        if ($fa == 1){
                                        	 $insert = "INSERT INTO fa_players(id_player,id_team,date_free,won) 
                                        	 	VALUES ('$playerid[0]','0',NOW(),'0')";
                                        	 	
                                        	if (!(mysqli_query($conn, $insert))) {
                                                        $error = mysqli_error($conn);
                                        	}
                                        }
                                   //  }
                                  }
                                }
                                if ($error == '') {
                                    $message = 'New Player added';
                                   // updateplayer();
                                }
                            //} //end the else loop if no player name is generated
                     } //end the for main player loop
                     
                     
	                     //get the Wage data
			$result = mysql_query("SELECT * FROM wage_base;");
			while ($row = mysql_fetch_row($result)) {
				$wage[] = $row; 
			}
			
			//change the wage
$select = mysql_query("SELECT s.serve,s.forehand,s.backhand,s.volley,s.power,s.consistency,s.speed,s.stamina,p.idplayer,p.age FROM player_stats AS s JOIN players AS p ON p.idplayer = s.idplayer");
while($row = mysql_fetch_array($select)) {
	$players[] = $row;
}
//print_r($players);

foreach($players as $p){
				//print_r($p);
				$age = $p[9];
				$p_wage = (int)(($p[0] + $p[1] + $p[2] + $p[3]) * $wage[$age-17][1] + ($p[4] + $p[5] + $p[6] + $p[7]) * $wage[$age-17][2]);
				//print $p_wage;
				//echo "<br />";
				$update = "UPDATE players SET wage = $p_wage WHERE idplayer = '{$p[8]}'";
				
				if (!(mysqli_query($conn,$update))) {
              				$error = 'Cannot update wages ' . mysqli_error($conn);
         			}
         			//DOING THIS AS MIN_PRICE FOR FA PLAYERS MUST BE SET
		                if ($fa == 1) {
	         			$update = "UPDATE fa_players SET set_price = $p_wage * 10 WHERE id_player = '{$p[8]}'";
	         			if (!(mysqli_query($conn,$update))) {
	              				$error = 'Cannot set min price ' . mysqli_error($conn);
	         			}
         			}
}
			
                     
                   //}
                 }
           }
				 
		$smarty->assign('error',$error);
        $smarty->assign('message',$message);
        //$smarty->assign('playerdata',$playerdata);
        $smarty->display('mgmtPlayer.tpl');
        }
?>