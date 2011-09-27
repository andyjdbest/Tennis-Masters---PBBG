<?php

require_once 'common.php';
require_once 'DBconfig.php';
//require_once 'coach.php';

function assign_coach($num,$country,$team,$level_id) {

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
	
	for ($i=0;$i<$num;$i++) {
		switch ($country) {
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
         $name = $playerfirstname . ' ' . $playerlastname;
		 
		 $age = random_number('INTEGER',30,35);
		 
		 $insert = "INSERT INTO coach (name_coach,age,id_level,id_team,date_assign) VALUES ('$name','$age','$level_id','$team',NOW())";
		 if (!mysql_query($insert)) {
				  return -1;
         }
	}
	
	return 0;
}

function addFinance($team,$week) {
	
	//get the Wage data
	$result = mysql_query("SELECT * FROM wage_base;");
	while ($row = mysql_fetch_row($result)) {
		$wage[] = $row; 
	}
	
	//fetch all active players
	$result = mysql_query("SELECT p.idplayer,p.age,s.serve,s.forehand,s.backhand,s.volley,s.power,s.consistency,s.speed,s.stamina FROM `academy_player` AS a JOIN players AS p ON a.id_player = p.idplayer JOIN player_stats AS s ON s.idplayer = p.idplayer JOIN user_academy AS ua ON ua.id_academy = a.id_team WHERE a.id_team = '$team'");
	while ($row = mysql_fetch_array($result)) {
		$player[] = $row;
	}
	
	$total_wage = 0;
	//process player info
	foreach($player as $p) {
		$age = $p[1];
		$id = $p[0];
	
		$p_wage = (int)(($p[2] + $p[3] + $p[4] + $p[5]) * $wage[$age-17][1] + ($p[6] + $p[7] + $p[8] + $p[9]) * $wage[$age-17][2]);
		
		$total_wage = $total_wage + $p_wage;
	
		$update = "UPDATE players SET wage = $p_wage WHERE idplayer = $id";
		if (!(mysql_query($update))) {
              $error = 'Cannot update wages ' . mysql_error();
         }
	}
	
	//add to the finance table the total wage of the academy
	$insert = "INSERT INTO finance (id_team,week,type,id_finance,amount) VALUES ('$team','$week','0','1','$total_wage')";
	if (!(mysql_query($insert))) {
              $error = 'Cannot update Player Finance information ' . mysqli_error($conn);
    }
	
	//process coach wages
	$coach_wage_query = mysql_query("SELECT id_coachlevel, wage FROM coach_level");
	while ($row = mysql_fetch_row($coach_wage_query)) {
		$coach_wage[] = $row; 
	}
	
	$coach_query = mysql_query("SELECT c.id_coach, c.id_level FROM coach AS c WHERE c.id_team = '$team'");
	while ($row = mysql_fetch_row($coach_query)) {
		$coach[] = $row;
	}
	
	$wage = 0;
	foreach($coach as $c) {
		$level = $c[1];
		
		$wage = $wage + $coach_wage[$level-1][1];
	}
	
	//add to the finance table the total coach wages
	$insert = "INSERT INTO finance (id_team,week,type,id_finance,amount) VALUES ('$team','$week','0','2','$wage')";
	if (!(mysql_query($insert))) {
              $error = 'Cannot update Coach Finance information ' . mysqli_error($conn);
    }
	
	//add joining bonus
	$bonus = 100000;
	$insert = "INSERT INTO finance (id_team,week,type,id_finance,amount) VALUES ('$team','$week','1','13','$bonus')";
	if (!(mysql_query($insert))) {
              $error = 'Cannot update joining bonus ' . mysqli_error($conn);
    }
	//add sponsorship money
	$sponsor_query = mysql_query("SELECT f.sponsor FROM league_table AS l 
					JOIN league AS m ON l.id_league = m.idleague 
					JOIN finance_leaguepos AS f ON m.league_pos = f.league 
					WHERE l.id_team = '$team'");
	$row = mysql_fetch_row($sponsor_query);
	$sponsor = $row[0];
	
	$insert = "INSERT INTO finance (id_team,week,type,id_finance,amount) VALUES ('$team','$week','1','8','$sponsor')";
	if (!(mysql_query($insert))) {
              $error = 'Cannot update joining bonus ' . mysqli_error($conn);
    }
}

session_start();
if (@$_SESSION['authenticated'] == 'true' & @$_SESSION['assigned'] == 0) {
	
	if($_POST) {
	    if (!(ctype_alnum($_POST['country']))) {
            $error = "You have entered invalid input.";
        }
        else {
				$country = $_POST['country'] + 1;
				$userid = $_SESSION['userid'];
				//select a random academy from the country...
				$query = "SELECT id_team FROM `academy` WHERE id_user IS NULL AND id_country = '$country' ORDER BY RAND() LIMIT 1";
				$r = mysqli_query($conn,$query);
				$team_row = mysqli_fetch_row($r);
				$team_id = $team_row[0];
				
				//insert into the user_academy table - for maintaining history
				$insert = "INSERT INTO user_academy (id_user, date_join, id_academy) VALUES ('$userid',NOW(),'$team_id')";
				if (!mysqli_query($conn,$insert)) {
                            $error = 'Error during assigning an academy to you.';
                }
				
				//update the academy table - for current information
				$update = "UPDATE academy SET id_user='$userid' WHERE id_team='$team_id'";
				if (!mysqli_query($conn,$update)) {
                            $error = 'Error while adding your details to the team section.';
                }
				
				//update the assigned field for the user
				$update = "UPDATE users SET isAssigned=1 WHERE userid='$userid'";
				if (!mysqli_query($conn,$update)) {
                            $error = 'Error while modifying your details.';
                }
				
				//fetch countryshortname to fetch coach name
				$query = "SELECT countryshort FROM `countries` WHERE idcountry = '$country'";
				$r = mysqli_query($conn,$query);
				$country_row = mysqli_fetch_row($r);
				$country_name = $country_row[0];
				
				//fetch level of coach based on level_name passed
		 		$query = 'SELECT id_coachlevel FROM coach_level WHERE name_coachlevel LIKE "Poor"';
		 		$r = mysql_query($query);
		 		$level_row = mysql_fetch_row($r);
		 		$level_id = $level_row[0];
				
				//assign 5 Poor Level Coaches to the academy
				$coach_assign = assign_coach(5,$country_name,$team_id,$level_id);
				if ($coach_assign == -1)
				{
					$error = 'Error while adding coaches' . mysql_error();
				}
				
				$week = floor((mktime() - $season_start)/604800);
				//calculate wages for assigned players & coaches
				addFinance($team_id, $week);
				
				
				if ($error == '') {
					$message = 'Welcome to the game. Your team is waiting for you.';
					@$_SESSION['assigned'] = 1;
					//@$_SESSION['userid'] = $userid;
				}
        }
    }
	else {
		$countrydata = array();
    	$query = "SELECT c.countryname,COUNT(a.team_name) AS free,c.time FROM academy AS a LEFT JOIN countries AS c ON c.idcountry = a.id_country WHERE id_user IS NULL GROUP BY c.idcountry";
		//SELECT c.countryname, (12 - COUNT(a.id_user)) AS free FROM countries AS c LEFT JOIN academy AS a ON a.id_country = c.idcountry GROUP BY c.countryname DESC
		$result = mysql_query($query);
		while ($obj = mysql_fetch_array($result)) {
                    $countrydata[] = $obj;
		}
	}
	
    
    $smarty->assign('error',$error);
	$smarty->assign('message',$message);
	$smarty->assign('userid',$userid);
	$smarty->assign('countrydata',$countrydata);
    $smarty->display('selectCountry.tpl');
}

?>