<?php
// - Market table status = 
// 1-> player is sold, 
// 0 -> not sold, 
// 2 -> deadline passed, flagged for deletion.

require_once 'common.php';
require_once 'DBconfig.php';

function check_tranfer($academy_id)
{
	$week = floor((mktime() - $season_start)/604800);
	session_start();
	if (@$_SESSION['authenticated'] == 'true' & @$_SESSION['assigned'] == 1) {
		
		//check if academy has players transfer listed
		$query = "SELECT m.id_player,m.set_price, m.bid, m.bid_team, m.time, m.curr_team, CONCAT(p.firstname, ' ', p.lastname )
					FROM `market` AS m JOIN players AS p ON p.idplayer = m.id_player 
					WHERE (m.curr_team = $academy_id OR m.bid_team = $academy_id) AND status = 0";
		$r = mysql_query($query);
		while ($ar = mysql_fetch_array($r)) {	
				$market[] = $ar;
		}
		//$curr = date("Y-m-d : H:i:s", time());
		
		if (isset($market)) {
			foreach($market as $m) {
				$curr = time();
				$bid_time = strtotime($m[4]);
				
				//if the bid time has elapsed - check the highest bid
				if ($curr >= $bid_time) {
					//check the new team and old team assignment
					$newTeam = $m[3];
					$oldTeam = $m[5];
					
					/*
					// if bidding team is current team, do nothing
					if ($m[3] == $academy_id)
					{ return; }
					*/
					
					if ($newTeam > 0) {
					//add player to new academy... 
					//add finance details for new academy
					//update player
						$s = mysql_query("SELECT id_country,id_user FROM academy WHERE id_team = $newTeam LIMIT 1");
						$c = mysql_fetch_row($s);
						$cID = $c[0];
						
						$insert = "INSERT INTO academy_player (id_team,id_player,date) 
								VALUES ($newTeam,{$m[0]},NOW())";
						if (!(mysql_query($insert))) {
		             				$error = mysql_error();
			 				echo $error;
		 				}
						else {
							$insert = "INSERT INTO finance (id_team,week,type,id_finance,amount) VALUES 
										($newTeam,$week,'0','3',{$m[2]})";
							if (!(mysql_query($insert))) {
	             						$error = mysql_error();
				 				echo $error;
        						}
							$insert = "INSERT INTO finance (id_team,week,type,id_finance,amount) VALUES 
										($oldTeam,$week,'1','9',{$m[2]})";
							if (!(mysql_query($insert))) {
             							$error = mysql_error($conn);
			 					echo $error;
        							}
							else {
								//print_r($m);
								$update = "UPDATE players SET id_team = $newTeam, countryid = $cID WHERE idplayer = {$m[0]}";
								if (!(mysql_query($update))) {
             								$error = mysql_error();
			 						echo $error;
        						}
							}
							$update = "DELETE FROM training_data WHERE id_player = {$m[0]}";
							if (!(mysql_query($update))) {
             							$error = mysql_error();
			 					echo $error;
        						}
						}
						
						//update player's status in the market and send message to player
						$update = "UPDATE market SET status = 1 WHERE id_player = {$m[0]}";
						if (!(mysql_query($update))) {
             						$error = mysql_error();
			 				echo $error;
        					}
						
						$note = "You have purchased player <a href=viewPlayer.php?playerid={$m[0]}>{$m[6]}</a>";
						$insert = "INSERT INTO messages 
								(id_sender,id_receiver,date,subject,body) 
								VALUES ('1', (SELECT id_user FROM academy WHERE id_team = $newTeam) , NOW(),'TransferNotification','$note')";
						mysql_query($insert);
						//send message to prev owner
						$note = "Your player <a href=viewPlayer.php?playerid={$m[0]}>{$m[6]}</a> sold for {$m[2]}";
						$insert = "INSERT INTO messages 
								(id_sender,id_receiver,date,subject,body) 
								VALUES ('1', (SELECT id_user FROM academy WHERE id_team = $oldTeam) , NOW(),'TransferNotification','$note')";
						mysql_query($insert);
						//$market = array();
					}
					else {
						//send message to academy owner
						$note = "Your player <a href=viewPlayer.php?playerid={$m[0]}>{$m[6]}</a> failed to sell";
						$insert = "INSERT INTO messages 
							(id_sender,id_receiver,date,subject,body) 
							VALUES ('1', (SELECT id_user FROM academy WHERE id_team = $oldTeam), NOW(),'TransferNotification','$note')";
						mysql_query($insert);
						//print_r($m);
						
						//delete player from market
						$update = "UPDATE market SET status = 2 WHERE id_player = {$m[0]}";
						if (!(mysql_query($update))) {
             						$error = mysql_error();
			 				echo $error;
        					}
					}
				}	
			}	
		}
	}
}
?>