<?php

require_once 'common.php';
require_once 'DBconfig.php';

session_start();
if (@$_SESSION['authenticated'] == 'true' & @$_SESSION['assigned'] == 1) {
	
	if ($_POST['bid']) {
		if (ctype_digit($_POST['bid_value']) == true) {
			if (ctype_digit($_POST['playerId']) == true) {
				
				$player = $_POST['playerId'];
				$bid = $_POST['bid_value'];
				$team = $_SESSION['id_team'];
				$type = $_POST['type'];
				//$team = 55;
				//check the fa bids table to see that the team has no previous bids
				$r = mysql_query("SELECT id_player FROM fa_bids WHERE id_team = '$team' AND won = 0 AND id_player <> '$player' LIMIT 1");
				$row = mysql_fetch_row($r);
				
				//team made a previous bid for another player
				if (isset($row[0])) {
						header("Location:viewFreeAgent.php?playerid=$player&message=BidFailed1");
				}
				else {
					//todo - add check for bid below min value	
					if ($bid < 200000)	{
						$r = mysql_query("SELECT MAX(bid) FROM fa_bids WHERE id_player = '$player' AND isPrivate = 0");
						$row = mysql_fetch_row($r);
						if (isset($row[0])) {
							$next_bid = $row[0] + 1000;
						}
						if ($bid > $next_bid){
							if ($type == 'private') {
								$insert = "INSERT INTO fa_bids (id_player,id_team,bid,isPrivate,date) 
									VALUES ('$player','$team','$bid','1',NOW())";
								//echo $insert;
								
								
								if (!(mysql_query($insert))) {
											$error = mysql_error();
											echo $error;
											header("Location:viewFreeAgent.php?playerid=$player&message=BidFailed");
								}
								$week = floor((mktime() - $season_start)/604800);
								$insert = "INSERT INTO finance (id_team,week,type,id_finance,amount) VALUES 
										($team,$week,'0','3','25000')";
								if (!(mysql_query($insert))) {
										$error = mysql_error();
										//echo $error;
										header("Location:viewFreeAgent.php?playerid=$player&message=BidFailed");
								}
								else {
									header("Location:viewFreeAgent.php?playerid=$player&message=BidSucess");
								}
								
							}
							else {
								$insert = "INSERT INTO fa_bids (id_player,id_team,bid,date) 
									VALUES ('$player','$team','$bid',NOW())";
								//echo $insert;
								if (!(mysql_query($insert))) {
											$error = mysql_error();
											//echo $error;
											header("Location:viewFreeAgent.php?playerid=$player&message=BidFailed");
								}
								else {
									header("Location:viewFreeAgent.php?playerid=$player&message=BidSucess");
								}
							}
						}
						else {
							header("Location:viewFreeAgent.php?playerid=$player&message=BidFailed");
						}
					}
				}
				
				
				
			}
			else {	
				header("Location:viewFreeAgent.php?playerid=$player&message=BidFailed");
			}
		}
	}		
}
else {
	header("Location:index.php");
}

?>