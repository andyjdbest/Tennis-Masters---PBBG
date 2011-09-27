<?php

require_once 'common.php';
require_once 'DBconfig.php';
require_once 'checkTransfers.php';

session_start();
if (@$_SESSION['authenticated'] == 'true' & @$_SESSION['assigned'] == 1 || (@$_SESSION['admin'] === 'true')) {
		
	if ($_GET['academy']){
		$playerdata = array();
		$coachid = array();
		$coachname = array();
		$coachdata = array();
		$traindata = array();
		$trainskill = array();
		$own = 0;
		if (ctype_digit($_GET['academy']) == false) {
			$error = "Invalid input";
		}
		else {
			$academy = $_GET['academy'];
			$userid = $_SESSION['userid'];
			
			check_tranfer($academy);
			$w= date("l", mktime());
			if ($w === 'Thursday') {
				$next_update = date('Y-m-d H:i:s', strtotime('second Thursday' . '2 hours'));
			}
			else {
				$next_update = date('Y-m-d H:i:s', strtotime('this Thursday' . '2 hours'));
			}
			//check if the user owns the academy
			$query = "SELECT id_user FROM academy WHERE id_team = '$academy'";
			$r = mysql_query($query);	
			$row = mysql_fetch_row($r);
			if ($userid == $row[0] || @$_SESSION['admin'] === 'true') {
				$own = 1;
				//fetch required player summary details 
				//$query = "SELECT CONCAT(firstname, ' ', lastname ) AS playername, idplayer, age, fitness 
				//			FROM players WHERE id_team = '$academy'";
				$query = "SELECT CONCAT(p.firstname,' ',p.lastname) AS playername,p.idplayer, p.age, p.fitness,
					p.handed, FLOOR( s.serve ) AS serve, FLOOR( s.volley ) AS volley, FLOOR( s.forehand ) AS forehand, 
					FLOOR( s.backhand ) AS backhand, FLOOR( s.speed ) AS speed, FLOOR( s.consistency ) AS consistency, 
					FLOOR( s.stamina ) AS stamina, FLOOR( s.power ) AS power, ( s.rating ) AS srating
						FROM players AS p
						JOIN player_stats AS s ON p.idplayer = s.idplayer
						JOIN academy AS a ON a.id_team = p.id_team
						WHERE a.id_team = '$academy'";
				$r = mysql_query($query);
	
				while ($ob = mysql_fetch_array($r)) {
		   				$playerdata[] = $ob;
    			}
				
				$num = count($playerdata);

				$c = mysql_query("SELECT c.name_coach, c.id_coach, l.name_coachlevel FROM coach AS c 
					JOIN coach_level AS l ON c.id_level = l.id_coachlevel WHERE c.id_team = '$academy'");
				while ($ar = mysql_fetch_array($c)) {
					$coachID[] = $ar[1];
					$coachName[] = $ar[0];
					$coachData[] = $ar;
				}
				array_unshift($coachID, 0);
				array_unshift($coachName, "-----");
				
				//echo $num;
                $skillsdata = array(Rest,Serve,Forehand,Backhand,Volley,Stamina,Consistency, Power, Speed);
				//fetch the training details - joining with training_stats table to ensure that the selected training is shown in the drop down menu
				//$r = mysql_query("SELECT id_player,id_coach FROM training_data WHERE id_team = '$academy' GROUP BY id_player ORDER BY week DESC");
				$r = mysql_query("SELECT CONCAT(p.firstname, ' ', p.lastname) AS pname, p.idplayer, p.fitness, c.name_coach, t.id_coach, t.skill FROM training_data AS t 
					JOIN coach AS c ON t.id_coach = c.id_coach 
					JOIN players AS p ON t.id_player = p.idplayer
					WHERE t.id_team = '$academy' ORDER BY t.week DESC LIMIT $num");
				while ($ar = mysql_fetch_array($r)) {
					$currdata[] = $ar;
				}
				if (isset($currdata)) {
					$curr = 1;
					//eliminate the duplicate rows as the prev query will fetch extra rows
					$copy = $currdata; // create copy to delete dups from 
					$usedPID = array(); // used emails 
					foreach ($currdata as $current) {
 
						if ( in_array( $current[1], $usedPID ) ) { 
							unset($copy); 
						} 
						else { 
							$usedPID[] = $current[1];
							$data[] = $current; 
						} 
	
 	
					}

					//check if the set coach is no longer with the academy
					//check the skill index
					foreach($data as $d) {
						if(!array_search($d[3],$coachID)){
							$d[3] = -1;
						} 
						$index = array_search($d[5],$skillsdata);
						$selectedSkill[] = $index;	
					}

					//now $data contains the list of old players set with training
					//we need to add the new players from the players list
					foreach ($playerdata as $player){
						if(!in_array($player[1],$usedPID)){
							//echo "$player[1] \t";
							$data[] = array(pname => $player[0], idplayer => $player[1],'0','0', fitness => $player[3]);
						} 
					}		

				}	
				else {
					$curr = 0;
					//print_r($coachID);
					//echo 'test';
					
					foreach ($playerdata as $player){
						//echo "$player[1] \t";
						$data[] = array(pname => $player[0], idplayer => $player[1],'0','0', fitness => $player[3]);
					}
				}
		}
		else { //user is not owner of academy so limited info
				$error = 'Cannot view another user\'s training details';
    		}
		} // end else for valid academy
	
		$day =  floor((mktime() - $season_start)/86400);
		
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
		//$smarty->assign('message',$message);
		//$smarty->assign('userid',$userid);
		$smarty->assign('currdata',$data);
		$smarty->assign('curr',$curr);
		$smarty->assign('playerdata',$playerdata);
		$smarty->assign('coachData',$coachData);
		$smarty->assign('coachID',$coachID);
		$smarty->assign('coachName',$coachName);
		$smarty->assign('skillsdata',$skillsdata);
		$smarty->assign('skillid',array(0,1,2,3,4,5,6,7,8));
		$smarty->assign('selectedSkill',$selectedSkill);
		$smarty->assign('next_date', $next_update);
	    $smarty->assign('own',$own);
    	$smarty->display('viewTraining.tpl');
	}
}
else {
	header("Location:index.php");
}
?>