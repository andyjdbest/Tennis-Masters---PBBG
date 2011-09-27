<?php

require_once 'common.php';
require_once 'DBconfig.php';

session_start();
if (@$_SESSION['authenticated'] == 'true' & @$_SESSION['assigned'] == 1) {
	
	if ($_POST['fire']){
		
		if (ctype_digit($_POST['playerId']) == false) {
			$error = "Invalid player specified";
		}
		else {
			//$userid = $_SESSION['userid'];
			$user_id = $_SESSION['userid'];
			$player_id = $_POST['playerId'];
			
			$query = "SELECT a.id_user,CONCAT(p.firstname, ' ', p.lastname) 
				FROM user_academy AS a JOIN players AS p ON p.id_team = a.id_academy  
				WHERE p.idplayer = '$player_id' LIMIT 1";
			$r = mysql_query($query);
			$row = mysql_fetch_row($r);
			
			if ($user_id == $row[0]) {
				$type = 'fire';
				$message = "Are you sure you want to fire " . $row[1] . "?";
				$_SESSION['firePlayer'] = $player_id;
			}
			else { $error = "Cannot fire another team's player. How unfortunate.. "; }
		}
	}
	
	elseif ($_POST['sell']){
		if (ctype_digit($_POST['playerId']) == false) {
			$error = 'Invalid player specified';
		}
		else {
			$user_id = $_SESSION['userid'];
			$player_id = $_POST['playerId'];
		
			$query = "SELECT a.id_user,CONCAT(p.firstname, ' ', p.lastname),p.wage 
				FROM user_academy AS a JOIN players AS p ON p.id_team = a.id_academy  
				WHERE p.idplayer = '$player_id' LIMIT 1";
			$r = mysql_query($query);
			$row = mysql_fetch_row($r);
			
			if ($user_id == $row[0]) {
				$type = 'sell';
				$min_bid = $row[2] * 6;
				$message = "Are you sure you want to make " . $row[1] . " a free agent? \n\n You will receive $min_bid as compensation. ";
				$_SESSION['sellPlayer'] = $player_id;
			}
			else { $error = "Cannot work on another team's player. How unfortunate.. "; }
		}
	}
	//manager has confirmed to fire the player
	elseif ($_POST['confirmFire']) {
		//get the academy id & the player id from the session
		$academy_id = $_SESSION['id_team'];
		$player_id = $_SESSION['firePlayer'];
		
		$update = "UPDATE players SET id_team = 0 WHERE idplayer = '$player_id'";
		if (!mysqli_query($conn,$update)) {
                    header('Location:overview.php?message=Failed');
        	}
		else { 
			$delete = "DELETE FROM training_data WHERE id_player = $player_id";
			if (!(mysql_query($delete))) {
             			$error = mysql_error();
				//echo $error;
        		}
			
			header('Location:overview.php?message=Success');
		}
		
	}
	
	//manager has confirmed to sell the player
	elseif ($_POST['confirmSell']) {
		//get the player id from the session
		$player_id = $_SESSION['sellPlayer'];
		$academy_id = $_SESSION['id_team'];
		$week = floor((mktime() - $season_start)/604800);
		
		$query = "SELECT id_team,wage FROM players WHERE idplayer = '$player_id' LIMIT 1";
		$r = mysql_query($query);
		$row = mysql_fetch_row($r);
		$min_bid = $row[1] * 6;
		
		if ($academy_id != $row[0]) {
			header("Location:viewPlayer.php?playerid=$player_id&message=Failed");
		}
		
		/*
		$insert = "INSERT INTO market(id_player,curr_team,set_price,time) 
					VALUES ($player_id,$academy_id, $min_bid, (NOW() + INTERVAL 3 DAY))";
		*/
		$insert = "INSERT INTO fa_players(id_player,id_team,set_price,date_free) 
					VALUES ('$player_id','$academy_id','$min_bid',NOW())";
		if (!mysqli_query($conn,$insert)) {
                   // echo mysqli_error($conn);
                   header("Location:viewPlayer.php?playerid=$player_id&message=Failed");
        }
		else { 
			//add finance.... 
			//remove player from academy's training, orders..
			$insert = "INSERT INTO finance (id_team,week,type,id_finance,amount) VALUES 
							($academy_id,$week,'1','9',$min_bid)";
			if (!(mysql_query($insert))) {
            		$error = mysql_error();
					echo $error;
					header("Location:viewPlayer.php?playerid=$player_id&message=Failed");
        	}
			else {
				$delete = "DELETE FROM training_data WHERE id_player = $player_id";
				if (!(mysql_query($delete))) {
             		$error = mysql_error();
			 		echo $error;
					header("Location:viewPlayer.php?playerid=$player_id&message=Failed");
        		}
				else {
					/*
					$update = "UPDATE players SET id_team = 0,points = 0, rank = 0, wrank = 0, rank_pos = 0, wrank_pos=0 
							WHERE idplayer = $player_id";
					*/
					$update = "UPDATE players SET id_team = 0,fitness = 100 WHERE idplayer = $player_id";
					if (!(mysql_query($update))) {
						$error = mysql_error();
						echo $error;
					}
				}
			}
			
			header("Location:viewPlayer.php?playerid=$player_id&message=Success");
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
	
	//$smarty->assign('managerInfo',$manager_data);
	$smarty->assign('error',$error);
	$smarty->assign('message',$message);
	$smarty->assign('player_id',$player_id);
	$smarty->assign('min_bid',$min_bid);
	$smarty->assign('type',$type);
	$smarty->display('movePlayer.tpl');
	
}
else {
	header("Location:index.php");
}
?>