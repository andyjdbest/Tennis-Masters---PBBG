<?php
		
#include the common file
require_once 'common.php';
        
#include the DBConfig file
require_once 'DBconfig.php';
 
require_once 'checkTransfers.php';

        session_start();
         if (@$_SESSION['authenticated'] == 'true' && @$_SESSION['assigned'] == 1)
         {
            $finance_data = array('pwage' => '0', 'cwage' => '0', 'ppurchase' => '0', 'cpurchase' => '0',
								  'attend' => '0', 'sponsors' => '0', 'psales' => '0', 'lprize' => '0', 'cprize' => '0',
								  'mcost' => '0', 'mincome' => '0' );
            
			$academy = $_SESSION['id_team'];
			$week = floor((mktime() - $season_start)/604800);
			
			check_tranfer($academy);
			
            $query = "SELECT id_finance, SUM( amount ) FROM `finance` WHERE id_team = '$academy' AND done = 0 GROUP BY id_finance";
            $r = mysql_query($query);
         	
            while ($array = mysql_fetch_array($r)) {
                  $finance[] = $array;
            }
			 
			$query = "SELECT type,SUM(amount) FROM finance WHERE id_team = '$academy' AND done = 0 GROUP BY type";
			$result = mysql_query($query);
			
			while ($array1 = mysql_fetch_array($result)) {
                  $summary[] = $array1;
            }
			 //print_r($finance);
			 if (isset($finance)) { 
			 foreach($finance as $f) {
			 	
				switch ($f[0]) {
					case '1':
						$finance_data['pwage'] = $f[1];
						break;
					case '2':
						$finance_data['cwage'] = $f[1];
						break;
					 case '3':
						$finance_data['ppurchase'] = $f[1];
						break; 
					case '4':
						$finance_data['cpurchase'] = $f[1];
						//print_r($finance_data['cpurchase']);
						break;
					case '7':
						$finance_data['attend'] = $f[1];
						break;
					case '8':
						$finance_data['sponsors'] = $f[1];
						break;
					case '9':
						$finance_data['psales'] = $f[1];
						break;
					case '10':
						$finance_data['lprize'] = $f[1];
						break;
					case '11':
						$finance_data['cprize'] = $f[1];
						break;
					case '12':
						$finance_data['mcost'] = $f[1];
						break;
					case '13':
						$finance_data['mincome'] = $f[1];
						break;
				}
			 }
			 }
			 
			 if (isset($summary)) {
			 foreach($summary as $sum) {
			 	if ($sum[0] == 0) { $summaryCost = $sum[1]; }
			 	elseif ($sum[0] == 1) { $summaryIncome = $sum[1]; }
			 	}
			 }
			 
			 //$prev = $week - 1;
			 $result = mysql_query("SELECT summary FROM finance_summary WHERE id_team = '$academy' ORDER BY id_summary DESC");
			 while ($row = mysql_fetch_array($result)) {
                  $total[] = $row;
            }
			 //$row1 = mysql_fetch_row(mysql_query("SELECT summary FROM finance_summary WHERE id_team = '$academy' AND week = '$prev'"));
			 
			 if (isset($total)) {
				$current = $total[0][0]; 
				$prev = $total[1][0];
			}
			 //if (isset($row1)) {$prev = $row1[0]; }
			 
			 $projected = $current + $summaryIncome - $summaryCost;
			// echo $projected. "<br />";
			 
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
	
                $smarty->assign('financeData',$finance_data);
				$smarty->assign('prize',$finance_data['lprize'] + $finance_data['cprize']);
				$smarty->assign('summaryCost',$summaryCost);
				$smarty->assign('summaryIncome',$summaryIncome);
				$smarty->assign('weekly',$summaryIncome - $summaryCost);
                $smarty->assign('current',$current);
                 $smarty->assign('prev',$prev);
                 $smarty->assign('projected',$projected);
                 
        		$smarty->display('viewFinance.tpl');
           }  
		   else {
	header("Location:index.php");
}
?>