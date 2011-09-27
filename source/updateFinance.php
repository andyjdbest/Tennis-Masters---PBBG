<?php
#include the common file
require_once 'common.php';
        
#include the DBConfig file
require_once 'DBconfig.php';
// Function to calculate script execution time.
function microtime_float ()
{
    list ($msec, $sec) = explode(' ', microtime());
    $microtime = (float)$msec + (float)$sec;
    return $microtime;
}
// Get starting time.
$start = microtime_float(); 


$finance = array();
$week = floor((mktime() - $season_start)/604800);
echo "WEEK $week <br />";
//if ($week >= 0) $week = $week - 1;
$result = mysql_query("SELECT id_team,SUM(amount) FROM finance WHERE done = 0 AND type = '1' GROUP BY id_team");
while ($row = mysql_fetch_row($result)) {
	$finance_income[] = $row;
}

$result = mysql_query("SELECT id_team,SUM(amount) FROM finance WHERE done = 0 AND type = '0' GROUP BY id_team");

while ($row = mysql_fetch_row($result)) {
	$finance_cost[] = $row;
}


if (isset($finance_cost)) {
	foreach($finance_cost as $f) {
		$team = $f[0];
		//print $team . "<br />";
		$income = array_search_r($team, $finance_income);
		
		$week_amount = $income - $f[1];
		//print $team . " " . $week_amount . "<br />";
		//echo "Week $week Team $f[0] - INCOME = $income COST = $f[1]  WEEKLY = $week_amount <br />";
		$prev_week = $week - 1;
		$res = mysql_query("SELECT summary FROM finance_summary WHERE id_team = $team ORDER BY id_summary DESC LIMIT 1");
		$row = mysql_fetch_row($res);
		
		if (isset($row)) {
			$prev_bal = $row[0];
		}
		else { $prev_bal = 0; }
		
		$summary = $prev_bal + $week_amount;
		//echo "Prev Balance - $prev_bal : Summary - $summary <BR /> <BR />";
		$insert = "INSERT INTO finance_summary (id_team,summary) VALUES ($team,$summary)";
		//echo "$insert <br/>";
		if (!(mysqli_query($conn, $insert))) {
             		$error = mysqli_error($conn);
			 echo $error;
       		 }
		
	}
}
//update the finance table to indicate that they have been considered for the finance update
$update = "UPDATE finance SET done = 1 WHERE done = 0";
		//echo "$update <br/>";
		if (!(mysqli_query($conn, $update))) {
             		$error = mysqli_error($conn);
			 echo $error;
       		 }
		

//add the weekly finance details
//sponsorship
$rs = mysql_query("SELECT a.id_team, f.sponsor FROM academy AS a
					JOIN league_table AS t ON a.id_team = t.id_team
					JOIN league AS l ON l.idleague = t.id_league
					JOIN finance_leaguepos AS f ON l.league_pos = f.league
					WHERE a.id_user IS NOT NULL");
while ($row = mysql_fetch_array($rs)) {
 	$sponsor_data[] = $row;
}	

if (isset($sponsor_data)) {
 	foreach($sponsor_data as $s) {
 		$insert = "INSERT INTO finance (id_team,week,type,id_finance,amount) VALUES 
										({$s[0]},$week,1,8,{$s[1]})";
		//echo "$insert <br/>";
		if (!(mysqli_query($conn, $insert))) {
             $error = mysqli_error($conn);
			 echo $error;
        }
				
 	}
}

//player wages - just check the sum as player wages are to be updated after training
$result_p = mysql_query("SELECT a.id_team, SUM( p.wage ) FROM academy AS a 
					JOIN players AS p ON a.id_team = p.id_team 
					WHERE a.id_user IS NOT NULL GROUP BY a.id_team");
while ($row = mysql_fetch_row($result_p)) {
	$player_data[] = $row;
}

if (isset($player_data)) {
 	foreach($player_data as $p) {
 		$insert1 = "INSERT INTO finance (id_team,week,type,id_finance,amount) VALUES 
										({$p[0]},$week,0,1,{$p[1]})";
		//echo "$insert1 <br />";		
		if (!(mysqli_query($conn, $insert1))) {
             $error = mysqli_error($conn);
			 echo $error;
        }
				
 	}
}


//coach wages
$result = mysql_query("SELECT a.id_team, SUM( m.wage ) FROM academy AS a
					JOIN coach AS c ON c.id_team = a.id_team
					JOIN coach_level AS m ON m.id_coachlevel = c.id_level
					GROUP BY a.id_team");
while ($row = mysql_fetch_array($result)) {
 	$coach_data[] = $row;
}	
 
 if (isset($coach_data)) {
 	foreach($coach_data as $c) {
 		$insert2 = "INSERT INTO finance (id_team,week,type,id_finance,amount) VALUES 
										({$c[0]},$week,0,2,{$c[1]})";
		//echo "$insert2 <br />";
		
		if (!(mysqli_query($conn, $insert2))) {
             $error = mysqli_error($conn);
			 echo $error;
        }
		
			
 	}
}


//check for negative balance
$result = mysql_query("SELECT f.id_team, u.userid, a.negative, f.summary 
	FROM finance_summary AS f 
	JOIN academy AS a ON f.id_team = a.id_team 
	JOIN users AS u ON a.id_user = u.userid 
	WHERE f.summary < 0");
while ($row = mysql_fetch_array($result)) {
 	$negative_data[] = $row;
}	

if (isset($negative_data)) {
	foreach ($negative_data as $n) {
		if ($n[2] < 3){
			//send a warning message
			$num = $n[2] + 1;
			$warn = 'first';
			switch ($num) {
				case 1:
					$warn = 'first';
					break;
				case 2:
					$warn = 'second';
					break;
				case 3:
					$warn = 'final';
					break;	
			}
		
			$note = "Your current balance of {$n[3]} is below the acceptable limit. \\n
			This is your $warn warning of 3";
			$insert = "INSERT INTO messages 
			(id_sender,id_receiver,date,subject,body) 
			VALUES ('1', {$n[1]} , NOW(),'FINANCE WARNING','$note')";
			mysql_query($insert);	
	
			//update counter 
			$update = "UPDATE academy SET negative = $num WHERE id_team = {$n[0]}";
			if (!(mysql_query($update))) {
				$error = mysql_error();
 				echo $error;
        		}
		}
		else {
			//fire the team
			$id = $n[1]; $academy = $n[0];
			
			//UPDATE academy
					$query = "UPDATE academy SET id_user = NULL,rank_world = NULL, 
						  rank_country = NULL, fans = 2, fan_move = 0, negative = 0 WHERE id_user = '$id'";
					if (!(mysqli_query($conn, $query))) {
                                    		 $errorDormant .= ' Cannot update user id ' . $id . mysqli_error($conn);
                     			}
                     			//UPDATE Users isAssigned field
					$update = "UPDATE users SET isAssigned = 0 WHERE userid = '$id'";
					if (!(mysqli_query($conn, $update))) {
                                     		$errorDormant .= ' Cannot update user id ' . $id . mysqli_error($conn);
                     			}
                     			
                     			//DELETE coaches
                     			$delete = "DELETE FROM coaches WHERE id_team = '$academy'";
                     			if (!(mysqli_query($conn, $delete))) {
                                     		$errorDormant .= ' Cannot delete coaches user id ' . $id . mysqli_error($conn);
                     			}
                     			
                     			//DELETE training
                     			$delete = "DELETE FROM training_data WHERE id_team = '$academy'";
                     			if (!(mysqli_query($conn, $delete))) {
                                     		$errorDormant .= ' Cannot delete training user id ' . $id . mysqli_error($conn);
                     			}
                     			
                     			/*//DELETE training_report
                     			$delete = "DELETE FROM training_report WHERE id_team = '$academy'";
                     			if (!(mysqli_query($conn, $delete))) {
                                     		$errorDormant .= ' Cannot delete training report user id ' . $id . mysqli_error($conn);
                     			}
                     			*/
                     			
                     			//DELETE finance
                     			$delete = "DELETE FROM finance WHERE id_team = '$academy'";
                     			if (!(mysqli_query($conn, $delete))) {
                                     		$errorDormant .= ' Cannot delete finance user id ' . $id . mysqli_error($conn);
                     			}
                     			
                     			//DELETE finance_summary
                     			$delete = "DELETE FROM finance_summary WHERE id_team = '$academy'";
                     			if (!(mysqli_query($conn, $delete))) {
                                     		$errorDormant .= ' Cannot delete finance summary user id ' . $id . mysqli_error($conn);
                     			}
                     			
                     			//DELETE match_order
                     			$delete = "DELETE FROM match_order WHERE id_team = '$academy'";
                     			if (!(mysqli_query($conn, $delete))) {
                                     		$errorDormant .= ' Cannot delete match_order user id ' . $id . mysqli_error($conn);
                     			}
                     			
                     			//DELete messages
					$delete = "DELETE FROM messages WHERE id_receiver = '$id'";
                     			if (!(mysqli_query($conn, $delete))) {
                                     		$errorDormant .= ' Cannot delete messages user id ' . $id . mysqli_error($conn);
                     			}
                     			
                     			//DELete bids if any
					$delete = "DELETE FROM fa_bids WHERE id_team = '$academy'";
                     			if (!(mysqli_query($conn, $delete))) {
                                     		$errorDormant .= ' Cannot delete bids user id ' . $id . mysqli_error($conn);
                     			}
                     			
                     			//SET Player fitness to 50
                     			$update = "UPDATE players SET fitness = 50 WHERE id_team = '$academy'";
                     			if (!(mysqli_query($conn, $update))) {
                                     		$errorDormant .= ' Cannot update fitness user id ' . $id . mysqli_error($conn);
                     			}
                     			
                     			//Update alliance
                     			$select = mysql_query("SELECT id_alliance FROM alliance_members WHERE id_user = '$id' AND  status = '2'");
                     			$row = mysql_fetch_row($select);
                     			
                     			if (isset($row[0])){
                     				$update = "UPDATE alliance_members SET status = 3, left_date = NOW()
                     				 WHERE id_user = '$id' AND status = '1' OR status = '2'";
                     				if (!(mysqli_query($conn, $update))) {
                                     			$errorDormant .= ' Cannot update alliance user id ' . $id . mysqli_error($conn);
                     				}
                     				$all = $row[0];
                     				$update = "UPDATE alliance SET members = members - 1  WHERE id_alliance = '$all'";
                				if (!(mysqli_query($conn, $update))) {
                                     			$errorDormant .= ' Cannot update alliance user id ' . $id . mysqli_error($conn);
                     				}
	
                     			}
			
		}
		
	}
}



					

$newsText = "Finance updated.";
$insert = "INSERT INTO news (NewsText,NewsDate) VALUES ('$newsText', NOW())";
if (!(mysql_query($insert))) {
    $error = 'Cannot insert news ' . mysql_error();
    echo $error;
}

$end = microtime_float();

// Print results.
echo 'Script Execution Time: ' . round($end - $start, 3) . ' seconds';   

function array_search_r($needle, $haystack){ 
	foreach($haystack as $value){ 
            //if(is_array($value)) 
            //    $match=array_search_r($needle, $value); 
            if($value[0]==$needle) 
                $match=1; 
            if($match) 
                return $value[1]; 
    } 
    return 0; 
} 




?>