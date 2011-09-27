<?php
		
#include the common file
require_once 'common.php';
        
#include the DBConfig file
require_once 'DBconfig.php';
 
        session_start();
         if (@$_SESSION['authenticated'] == 'true' && @$_SESSION['assigned'] == 1)
         {
            $transfer_data = array();
            
            if ($_POST['search']) {
				if (ctype_digit($_POST['min_age']) && ctype_digit($_POST['max_age']) &&
					ctype_digit($_POST['min_srv']) && ctype_digit($_POST['max_srv']) &&	
					ctype_digit($_POST['min_vly']) && ctype_digit($_POST['max_vly']) &&
					ctype_digit($_POST['min_fhd']) && ctype_digit($_POST['max_fhd']) &&
					ctype_digit($_POST['min_bhd']) && ctype_digit($_POST['max_bhd']) &&
					ctype_digit($_POST['min_con']) && ctype_digit($_POST['max_con']) &&
					ctype_digit($_POST['min_stm']) && ctype_digit($_POST['max_stm']) &&
					ctype_digit($_POST['min_pwr']) && ctype_digit($_POST['max_pwr']) &&
					ctype_digit($_POST['min_spd']) && ctype_digit($_POST['max_spd']) ) 
				{
                            $min_age = $_POST['min_age'] + 17; $max_age = $_POST['max_age'] + 17;
							$min_srv = $_POST['min_srv'] + 1;  $max_srv = $_POST['max_srv'] + 1;
							$min_vly = $_POST['min_vly'] + 1;  $max_vly = $_POST['max_vly'] + 1;
							$min_fhd = $_POST['min_fhd'] + 1;  $max_fhd = $_POST['max_fhd'] + 1;
							$min_bhd = $_POST['min_bhd'] + 1;  $max_bhd = $_POST['max_bhd'] + 1;
							$min_con = $_POST['min_con'] + 1;  $max_con = $_POST['max_con'] + 1;
							$min_stm = $_POST['min_stm'] + 1;  $max_stm = $_POST['max_stm'] + 1;
							$min_pwr = $_POST['min_pwr'] + 1;  $max_pwr = $_POST['max_pwr'] + 1;
							$min_spd = $_POST['min_spd'] + 1;  $max_spd = $_POST['max_spd'] + 1;
							

/*
							if ($max_age == 17) $max_age = 30;
							if ($max_srv == 1) $max_srv = 15;
							if ($max_vly == 1) $max_vly = 15;
							if ($max_fhd == 1) $max_fhd = 15;
							if ($max_bhd == 1) $max_bhd = 15;
							if ($max_con == 1) $max_con = 15;
							if ($max_stm == 1) $max_stm = 15;
							if ($max_pwr == 1) $max_pwr = 15;
							if ($max_spd == 1) $max_spd = 15;
*/							
							//print $max_age;
										
                            $query = "SELECT f.id_player, f.set_price, 
									CONCAT(p.firstname, ' ',p.lastname) AS playername,p.age,p.nationality,
									FLOOR( s.serve ) AS serve, FLOOR( s.volley ) AS volley, 
									FLOOR( s.forehand ) AS forehand, FLOOR( s.backhand ) AS backhand, 
									FLOOR( s.speed ) AS speed, FLOOR( s.consistency ) AS consistency, 
									FLOOR( s.stamina ) AS stamina, FLOOR( s.power ) AS power, 
									FLOOR( s.rating ) AS srating FROM fa_players AS f 
									JOIN players AS p ON f.id_player = p.idplayer 
									JOIN player_stats AS s on p.idplayer = s.idplayer 
									WHERE f.won = 0
									AND (s.serve BETWEEN '$min_srv' AND '$max_srv')  AND (s.volley BETWEEN '$min_vly' AND '$max_vly') 
									AND (s.forehand BETWEEN '$min_fhd' AND '$max_fhd') AND (s.backhand BETWEEN '$min_bhd' AND '$max_bhd') 
									AND (s.speed BETWEEN '$min_spd' AND '$max_spd') AND (s.consistency BETWEEN '$min_con' AND '$max_con') 
									AND (s.stamina BETWEEN '$min_stm' AND '$max_stm') AND (s.power BETWEEN '$min_pwr' AND '$max_pwr') 
									AND (p.age BETWEEN '$min_age' AND '$max_age')";
                            $r = mysql_query($query);
                            //global $leaguedata;
                            while ($obj = mysql_fetch_array($r)) {
                                    $transfer_data[] = $obj;
                                    //$counter = $counter + 1;
                            }
							$num_rows = mysql_num_rows($r); 
							
							//print $num_rows;
							//print_r($transfer_data);
							
							if ($num_rows <= 0) {
								$error = 'No players found with the search criteria';
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
	
                $smarty->assign('transfer_data',$transfer_data);
                $smarty->assign('error',$error);
        		$smarty->display('searchTM.tpl');
           }  
		   else {
	header("Location:index.php");
}
?>