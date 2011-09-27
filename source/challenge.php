<?php

require_once 'common.php';
require_once 'DBconfig.php';
require_once 'checkTransfers.php';


function timeStamps($ar) {
  $stamps = array();
  foreach ($ar as $timeString) {
    $stamps[strtotime($timeString)] = $timeString;
  }
  return $stamps;
}

function sortTime(&$ar) {
  $timeStampAr = timeStamps($ar);
  ksort($timeStampAr); // since the keys are integers, timestamps ksort would do the right thing
  $ar = array_values($timeStampAr);
  return $ar; //dont really need this but just in case someone prefers to use
                  //it differently or needs a copy
}

session_start();
if (@$_SESSION['authenticated'] == 'true' & @$_SESSION['assigned'] == 1) {
	
	if ($_GET['academy']){
		$own = 0;
		if (ctype_digit($_GET['academy']) == false) {
			$error = "Invalid input";
		}
		else {
			$academyC = $_GET['academy'];
			$userid = $_SESSION['userid'];
			$academyO = $_SESSION['id_team'];
			check_tranfer($academyO);
			//check if the user owns the academy
			$query = "SELECT id_user,team_name,id_team FROM academy WHERE id_team = '$academyC'";
			$r = mysql_query($query);	
			$row = mysql_fetch_row($r);
			//print_r($row);
			if ($userid != $row[0]) {
				$own = 0;
				$friendlyDates = array();
				$today = date('Y-m-d H:i:s', strtotime('this Sunday' . '14 hours'));
				$friendlyDates[] = $today;
				$today = date('Y-m-d H:i:s', strtotime('this Monday' . '14 hours'));
				$friendlyDates[] = $today;
				$today = date('Y-m-d H:i:s', strtotime('this Tuesday' . '14 hours'));
				$friendlyDates[] = $today;
				$today = date('Y-m-d H:i:s', strtotime('this Wednesday' . '14 hours'));
				$friendlyDates[] = $today;
				$today = date('Y-m-d H:i:s', strtotime('this Thursday' . '14 hours'));
				$friendlyDates[] = $today;
				$today = date('Y-m-d H:i:s', strtotime('this Friday' . '14 hours'));
				$friendlyDates[] = $today;
				$today = date('Y-m-d H:i:s', strtotime('this Saturday' . '14 hours'));
				$friendlyDates[] = $today;
				//check if both academies have friendlies arranged
				//remove those dates from the friendly date array
				$query = mysql_query("SELECT round_date FROM fixtures WHERE 
					fixture_type = 2 AND (id_team1 = '$academyC' OR id_team2 = '$academyC' OR id_team1 = '$academyO' OR id_team2 = '$academyO')");
				while ($m = mysql_fetch_row($query)) {
		   			$dateRemove[] = $m[0];
				}
				if (isset($dateRemove)) {
					$friendlyDates = array_diff($friendlyDates,$dateRemove); 
				}
				
				$today = date('Y-m-d H:i:s'); //echo $today;
				
				foreach ($friendlyDates as $key => $value){
					if ($friendlyDates[$key] < $today){
						unset($friendlyDates[$key]);
					}
				}
				$friendlyDates = array_values($friendlyDates);
				$friendlyDates = sortTime($friendlyDates);
				
				//print_r($friendlyDates);
				$s = mysql_query("SELECT name FROM courttype WHERE 1");
				//$s;
				while ($ob = mysql_fetch_row($s)) {
		   			$court[] = $ob[0];
				}	
			} 
		}
	}
	
	//handle challenge issued
	if ($_POST){
		if ((ctype_digit($_POST['academyC']) == false) && (ctype_digit($_POST['date']) == false) 
		&& (ctype_digit($_POST['courtname']) == false)){
			$error = "Invalid input";
		}
		else {
			$court = array();
			
			$academyC = $_POST['academyC'];
			$userid = $_SESSION['userid'];
			$academyO = $_SESSION['id_team'];
			$date = $_POST['date'];
			$courtname = $_POST['courtname'] + 1;
			
			$query = "SELECT id_user FROM academy WHERE id_team = '$academyC'";
			$r = mysql_query($query);	
			$row = mysql_fetch_row($r);
			if ($userid != $row[0]) {
				$query = mysql_query("SELECT id_fixture FROM fixtures WHERE round_date = '$date' AND
							(id_team1 = '$academyC' OR id_team2 = '$academyC') ");
				$m = mysql_fetch_row($query);
		
				if (isset($m[0])) {
					$message = 'Academy has challenge fixed for the day.';
				}
				else {
					$insert = "INSERT INTO challenges (id_team1,id_team2,date,id_stadium,status) VALUES
							('$academyO', '$academyC', '$date', '$courtname', '1')";
					if (!(mysql_query($insert))) {
             				$error = mysql_error();
			 		//echo $error;
        			}
					else { 
						$message = 'Challenged issued.';
						$id_challenge = mysql_insert_id();
						$note = "You have been challenged for a friendly by <a href=viewAcademy.php?academy=$academyO>$academyO</a> 
								 View the details at: <a href=viewChallenges.php>here</a>.";
						$insert = "INSERT INTO messages 
									(id_sender,id_receiver,date,subject,body) 
									VALUES ('1', (SELECT id_user FROM academy WHERE id_team = $academyC) , NOW(),'Challenge Notification','$note')";
						if (!(mysql_query($insert))) {
             				$error = mysql_error();
							//echo $error;
						}
					}
				}
				 
				
			}
			
			
				
		}
		
		
		
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
    
	$smarty->assign('own',$own);
	$smarty->assign('team_name',$row[1]);
	$smarty->assign('id_team',$row[2]);
	$smarty->assign('court',$court);
	$smarty->assign('date',$friendlyDates);
	$smarty->assign('message',$message);
    $smarty->display('challenge.tpl');
}

else {
	header("Location:index.php");
}

?>