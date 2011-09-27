<?php

require_once 'common.php';
require_once 'DBconfig.php';
require_once 'checkTransfers.php';

/* nicetime function returns dates in future as "x days from now", dates in the past as "y days ago"
function nicetime($date)
{
    if(empty($date)) {
        return "No date provided";
    }
   
    $periods         = array("second", "minute", "hour", "day", "week", "month", "year", "decade");
    $lengths         = array("60","60","24","7","4.35","12","10");
   
    $now             = time();
    $unix_date         = strtotime($date);
   
       // check validity of date
    if(empty($unix_date)) {   
        return "Bad date";
    }

    // is it future date or past date
    if($now > $unix_date) {   
        $difference     = $now - $unix_date;
        $tense         = "ago";
       
    } else {
        $difference     = $unix_date - $now;
        $tense         = "from now";
    }
   
    for($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++) {
        $difference /= $lengths[$j];
    }
   
    $difference = round($difference);
   
    if($difference != 1) {
        $periods[$j].= "s";
    }
   
    return "$difference $periods[$j] {$tense}";
}
*/


function playerGet($nation='', $minrating=1, $maxrating=15, $minage=16, $maxage=36) {
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
    if ($nation == ''){
        $query = "SELECT countryshort FROM countries WHERE 1 ORDER BY RAND LIMIT 1";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_row($result);
        $team = $row[0];
    }
	
	$playererror = 1;
    while ($playererror == 1) {   
		//choose the names based on the country
        switch ($nation) {
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
    for ($j=4; $j<12; $j++) {
        $temp[$j] = number_format(random_number('FLOAT',$minrating, $maxrating),2);
        //$temp[$j] = $playerstat[$j];
    }
    return $temp;
} 

	
session_start();	
if (@$_SESSION['authenticated'] == 'true' & @$_SESSION['assigned'] == 1) {
	
if (ctype_digit($_POST['country']) == false) {
	$error = 'Country not defined in Tennis Masters';
}
else {
	$error = '';
	$country = $_POST['country'] + 1;
	$userid = $_SESSION['userid'];	
	$team = $_SESSION['id_team'];
			
	check_tranfer($team);
	$nationality = '';
	//get the nationality based on the country selected
	$query = mysql_query("SELECT countryshort FROM countries WHERE idcountry = '$country' LIMIT 1");
	$row = mysql_fetch_row($query);
	
	if (isset($row[0])){
		$nationality = $row[0];
	}
	else {
		$error = 'Country not defined in Tennis Masters';
	}
	//echo $nationality;
	//check if academy has had player trials in the week 
	$trial_day = date('Y-m-d H:i:s', strtotime('previous Tuesday' . '2 hours'));
	$trial_day = strtotime($trial_day);
	//fetch prev pull date from the trial table
	$query = mysql_query("SELECT pull_date FROM player_trials WHERE id_team = '$team' ORDER BY id_trial DESC LIMIT 1");
	$row = mysql_fetch_row($query);
	
	$can_pull = 0;
	if (isset($row[0])) {	
		$pull_date = strtotime($row[0]);
		$week = floor((mktime() - $trial_start)/604800) + 1 ;
		$this_date = date('Y-m-d H:i:s', strtotime($week . ' Tuesday 2 hours', $trial_start));
		$this_day = strtotime($this_date);
		if ($pull_date < $this_day) {
			$can_pull = 1;
		}
		else {
			$week += 1;
			$next_date = date('Y-m-d H:i:s', strtotime($week . ' Tuesday 2 hours', $trial_start));
			$error ="Your next player trial can be scheduled after $next_date <br />";	
		}

	}
	// no previous record of academy trial
	else { $can_pull = 1; }
	
	if ( $can_pull == 1) {
	
		$min_stat = 1;
		$max_stat = 3;
		$min_age = 17;
		$max_age = 21;
		$player = playerGet($nationality, $min_stat, $max_stat, $min_age, $max_age);
		
		//print_r($player);
		
		$query = mysql_query("SELECT id_country FROM academy WHERE id_team = '$team'");
		$countryidrow = mysql_fetch_row($query);
        	$idcountry = $countryidrow[0];
		
		$rating = $player[4] + $player[5] + $player[6] + $player[7] + $player[8] + $player[9] + $player[10] + $player[11];
		$insert = "INSERT INTO player_trials (id_team,pull_date,firstname,lastname,age,nationality,handed,id_country,
					serve,forehand,backhand,volley,stamina,consistency,power,speed,rating) VALUES
					('$team',NOW(),'{$player[0]}','{$player[1]}','{$player[2]}','$nationality','{$player[3]}','$idcountry',
					 '{$player[4]}','{$player[5]}','{$player[6]}','{$player[7]}','{$player[8]}','{$player[9]}','{$player[10]}','{$player[11]}', '$rating')";
		if (!(mysqli_query($conn, $insert))) {
				//$error = mysqli_error($conn);
				//echo $error;
				$error = 'Could not find a player for trials';
        	}
		else {
			$query = mysql_query("SELECT firstname, lastname,age, handed, nationality, id_trial,
						FLOOR( serve ) AS serve, FLOOR( volley ) AS volley, FLOOR( forehand ) AS forehand, FLOOR( backhand ) AS backhand, 
						FLOOR( speed ) AS speed, FLOOR( consistency ) AS consistency, FLOOR( stamina ) AS stamina, FLOOR( power ) AS power, rating
						FROM player_trials WHERE id_team = '$team' ORDER BY id_trial DESC LIMIT 1");
			$playerData = mysql_fetch_array($query);
		}
		
		
	}
	} // end else 
					
	//for time
	$day =  floor((mktime() - $season_start)/86400);
			
	$smarty->assign('season',$season);
	$smarty->assign('day',$day);
	
	$q = "SELECT COUNT(id) FROM `messages` WHERE id_receiver = {$_SESSION['userid']} AND `read` = 0 AND del_receiver = 0";
	$r = mysql_query($q);
	$rf = mysql_fetch_row($r);
	$_SESSION['new_mail'] = $rf[0];
	
	$smarty->assign('idteam',$_SESSION['id_team']);
    $smarty->assign('idleague',$_SESSION['id_league']);
	$smarty->assign('uname',$_SESSION['username']);
	$smarty->assign('userid',$_SESSION['userid']);
	$smarty->assign('new_mail',$_SESSION['new_mail']);
	$smarty->assign('cManager',$_SESSION['countryM']);
    
	$smarty->assign('playerData',$playerData);
	$smarty->assign('error',$error);
	$smarty->assign('message',$message);
    $smarty->display('resultTrials.tpl');
}


else {
	header("Location:index.php");
}

?>