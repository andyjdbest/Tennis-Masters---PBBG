<?php
/*
 * check for maximum allowed coaches per academy
 * obtain base wage for poor level coach from db
 */
require_once 'common.php';
require_once 'DBconfig.php';
require_once 'checkTransfers.php';

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

session_start();
if (@$_SESSION['authenticated'] == 'true' & @$_SESSION['assigned'] == 1) {
	if ($_POST['buy']){
		
		if (ctype_digit($_POST['numCoaches']) == false) {
			$error = "Invalid input";
		}
		else {
			$academy = $_SESSION['id_team'];
			$num_coaches = $_POST['numCoaches'];
			
			check_tranfer($academy);
			
			if ($num_coaches <= 0 || $num_coaches > 15) {
				$error = "Invalid number of coaches";			
			}	
			else {
				$r = mysql_query("SELECT id_country FROM academy WHERE id_team = $academy LIMIT 1");
				$row = mysql_fetch_row($r);
				
				$country = $row[0];
				assign_coach($num_coaches, $country, $academy, 1);
				
				$purchase = $num_coaches * 3000;
				//add finance
				$week = floor((mktime() - $season_start)/604800);
				$insert = "INSERT INTO finance (id_team,week,type,id_finance,amount) VALUES ('$academy','$week','0','4','$purchase')";
				if (!(mysql_query($insert))) {
              				$error = 'Cannot update Coach Finance information';
    				}
				
			}
		}
		if ($error == '') { $message = "Coach Purchase Successful"; }
	}
	
	elseif ($_POST['fire']){
		
		if (ctype_digit($_POST['coachID']) == false) {
			$error = "Invalid input";
		}
		else {
			$academy = $_SESSION['id_team'];
			$coach = $_POST['coachID'];
			
			//check if the coach belongs to the academy
			$query = "SELECT id_team FROM coach WHERE id_coach = '$coach' LIMIT 1";
			$r = mysql_query($query);	
			$row = mysql_fetch_row($r);
			if ($academy == $row[0]) {
				$update = "UPDATE coach SET id_team = '0' WHERE id_coach = '$coach'";
				
				if (!(mysql_query($update))) {
              				$error = 'Could not fire coach';
    				}
    				$update1 = "UPDATE training_data SET id_player = 0 WHERE id_coach = '$coach'";
					if (!(mysql_query($update1))) {
             					$error = mysql_error();
			 			//echo $error;
        				}
    				
			}
			else { $error = "Cannot fire another user\'s coach"; }
		}
		if ($error == '') { $message = "Coach Successfully Fired"; }
	}
	
	elseif ($_POST['upgrade']){
		
		if (ctype_digit($_POST['coachID']) == false) {
			$error = "Invalid input";
		}
		else {
			$academy = $_SESSION['id_team'];
			$coach = $_POST['coachID'];
			
			//check if the coach belongs to the academy
			$query = "SELECT id_team,id_level,DATEDIFF(NOW( ), date_upgrade) FROM coach WHERE id_coach = '$coach' LIMIT 1";
			$r = mysql_query($query);	
			$row = mysql_fetch_row($r);
			//print_r($row);
			if ($academy == $row[0]) {
				if ($row[1] < 5) {
					if (!isset($row[2]) || $row[2] >= 7) {
						$level = $row[1] + 1;
						$update = "UPDATE coach SET id_level = '$level', date_upgrade = NOW() WHERE id_coach = '$coach'";
						if (!(mysql_query($update))) {
	              					echo mysql_error();
	              					$error = 'Could not upgrade coach';
	    					}
						//add the finance detail
						$week = floor((mktime() - $season_start)/604800);
						$insert = "INSERT INTO finance (id_team,week,type,id_finance,amount) VALUES ('$academy','$week','0','4',(SELECT price FROM coach_level WHERE id_coachlevel = '$level'))";
						if (!(mysql_query($insert))) {
	              					$error = 'Cannot update Coach Finance information';
	    					}
    					}
    					else { $error = 'You have to wait for a week from the last upgrade'; }
				}
			}
			else { $error = "Cannot upgrade another user\'s coach"; }
		}
		if ($error == '') { $message = "Coach Successfully Upgraded"; }
	}
	
		$day =  floor((mktime() - $season_start)/86400);
		$q = "SELECT COUNT(id) FROM `messages` WHERE id_receiver = {$_SESSION['userid']} AND `read` = 0 AND del_receiver = 0";
		$r = mysql_query($q);
		$rf = mysql_fetch_row($r);
		$_SESSION['new_mail'] = $rf[0];

		$smarty->assign('season',$season);
		$smarty->assign('day',$day);
		$smarty->assign('idteam',$_SESSION['id_team']);
    	$smarty->assign('idleague',$_SESSION['id_league']);
		$smarty->assign('userid',$_SESSION['userid']);
		$smarty->assign('uname',$_SESSION['username']);
		$smarty->assign('new_mail',$_SESSION['new_mail']);
		$smarty->assign('cManager',$_SESSION['countryM']);
		$smarty->assign('member',$_SESSION['member']);
		$smarty->assign('credits',$_SESSION['credits']);
	
    	$smarty->assign('error',$error);
		$smarty->assign('message',$message);
		//$smarty->assign('userid',$userid);
    	$smarty->display('manageCoach.tpl');
	
}
else {
	header("Location:index.php");
}
?>