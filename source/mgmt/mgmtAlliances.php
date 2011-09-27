<?php

/*
Status Flags = 0 - Applied to create / join / name
	       1 - Applied to delete / withdraw / cancel
	       2 - Active / Done
	       3 - Deleted / Removed
*/
 #include the common file
 require_once 'common.php';

      
session_start();
if (@$_SESSION['authenticated'] == 'true' && @$_SESSION['admin'] == 'true'){
             include ("../DBconfig.php");

             $result = array();
             $resultP = array();
             $resultC = array(); 
             $message = ''; $error = '';
             
             function fetchNewAlliance()
             {            
                $query = "SELECT a.id_alliance,a.name,a.leader_id,u.username,u.credits,u.memberTill FROM alliance AS a 
                	JOIN users AS u ON a.leader_id = u.userid 
                	WHERE a.status = 0 ORDER BY created_date";
                $r = mysql_query($query);
                global $result;
                while ($ob = mysql_fetch_object($r)) {
                    $result[] = $ob;
                }
             }
             
             function fetchPlayers()
             {            
                $query = "SELECT n.id_nameChange,n.old_value,n.new_value,n.id_user,u.username,u.credits,u.memberTill FROM name_changes AS n 
                	JOIN users AS u ON n.id_user = u.userid 
                	WHERE n.status = 0 AND n.type = 1 ORDER BY date_requested";
                $r = mysql_query($query);
                global $resultP;
                while ($ob = mysql_fetch_object($r)) {
                    $resultP[] = $ob;
                }
             }
            
             function fetchCourts()
             {            
                $query = "SELECT n.id_nameChange,n.old_value,n.new_value,n.id_user,u.username,u.credits,u.memberTill FROM name_changes AS n 
                	JOIN users AS u ON n.id_user = u.userid 
                	WHERE n.status = 0 AND n.type = 2 ORDER BY date_requested";
                $r = mysql_query($query);
                global $resultC;
                while ($ob = mysql_fetch_object($r)) {
                    $resultC[] = $ob;
                }
             }	  

             fetchNewAlliance();
             
             fetchPlayers();
             
             fetchCourts(); 

             if($_GET['message']){
             //	echo "message = $message";
             	switch ($_GET['message']){
             		case 1:
             			global $message;
             			$message = 'Alliance has not been created. A message has been sent to the user';
             			break;
             		case 2:
             			global $message;
             			$message = 'Alliance has been created';
             			break;
             		case 3:
             			global $message;
             			$message = 'Player has not been renamed. A message has been sent to the user';
             			break;
             		case 4:
             			global $message;
             			$message = 'Player has been renamed';
             			break;
             		case 5:
             			global $message;
             			$message = 'Court has not been renamed. A message has been sent to the user';
             			break;
             		case 6:
             			global $message;
             			$message = 'Court has been renamed';
             			break;	
             				
             	}
             }
             

             $smarty->assign('message', $message);
             $smarty->assign('error', $error);
             $smarty->assign('newData',$result);
             $smarty->assign('newPData',$resultP);
             $smarty->assign('newCData',$resultC); 
             $smarty->display('mgmtAlliances.tpl');
         }


?>