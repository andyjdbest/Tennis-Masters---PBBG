<?php

require_once 'common.php';
require_once 'DBconfig.php';
require_once 'checkTransfers.php';
	
session_start();	
if (@$_SESSION['authenticated'] == 'true' & @$_SESSION['assigned'] == 1) {
	
if ($_POST['keep']) {
		if (ctype_digit($_POST['id']) === false){
			$error = 'Error moving player';
		}
		else {
			$id = $_POST['id'];
			
			$today = strtotime(date('Y-m-d H:i:s'));
			$query = mysql_query("SELECT * FROM player_trials WHERE id_trial = '$id' LIMIT 1");
			$row = mysql_fetch_array($query);
			
			$pull_date = strtotime($row['pull_date']);
			$diff = ($today - $pull_date)/86400;
			//echo "today = $today, pull = $pull_date, diff = $diff <br/>";
			if ($diff < 1 && $row['moved'] == 0) {
				//insert player into players table, insert stats into player_stats, add player to academy..& update wages of the academy
				//also changed moved to 1 in player_trials
				$insert = "INSERT INTO players(firstname,lastname,nationality,handed,age,countryid,id_team,wage) 
						VALUES('{$row['firstname']}','{$row['lastname']}','{$row['nationality']}','{$row['handed']}','{$row['age']}','{$row['id_country']}','{$row['id_team']}', '{$row['wage']}')";
                if (!(mysqli_query($conn, $insert))) {
                    $error = 'Error moving player to academy 1';
					echo mysqli_error($conn);
                } 
                else {
                    //fetch the last playerid and then insert the stats in the player_stats table
                    $query = "SELECT idplayer FROM players ORDER BY idplayer DESC LIMIT 1";
                    $result = mysqli_query($conn,$query);
                    $playerid = mysqli_fetch_row($result);
					
					$insert = "INSERT INTO player_stats(idplayer,serve,forehand,backhand,volley,stamina,consistency,power,speed,rating) 
					VALUES ('{$playerid[0]}','{$row['serve']}','{$row['forehand']}','{$row['backhand']}','{$row['volley']}',
						'{$row['stamina']}','{$row['consistency']}','{$row['power']}','{$row['speed']}','{$row['rating']}')";
                    if (!(mysqli_query($conn, $insert))) {
                        $error = 'Error moving player to academy 2';
						echo mysqli_error($conn);
                    }
					else {
						$insert = "INSERT INTO academy_player (id_team,id_player,date) 
								VALUES ('{$row['id_team']}','{$playerid[0]}',NOW())";
						if (!(mysql_query($insert))) {
             				$error = 'Error moving player to academy 3';
			 				//echo $error;
							echo mysql_error($conn);
		 				}
						else {
							$update = "UPDATE player_trials SET moved = 1 WHERE $id_trial = '$id'";
							mysql_query($update);
						}
					}
				}
			}
			else { $error = 'Cannot move player 4'; }

			
		}
		
		if ($error == '') {
			$message = 'Player has been moved to academy';
			header("Location:playerTrials.php?message=$message");
		}
	}
	if ($_POST['fire']) {
		$message = 'Player has not been accepted to the academy';
		header("Location:playerTrials.php?message=$message");
	}
					
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