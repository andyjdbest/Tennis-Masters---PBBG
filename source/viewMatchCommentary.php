<?php

require_once 'common.php';
require_once 'DBconfig.php';
require_once 'checkTransfers.php';
require_once 'commentaryDB.php';
session_start();
if (@$_SESSION['authenticated'] == 'true' & @$_SESSION['assigned'] == 1) {
	
if ($_GET['matchID'])
{
	$id = $_GET['matchID'];
	
	if (ctype_digit($id) === FALSE)
	{
		$error = 'Invalid input';
	}	
	else {		
			$userid = $_SESSION['userid'];	
			$team = $_SESSION['id_team'];
			
			check_tranfer($team);
			
			$query = mysql_query("SELECT c.match_id, c.commentary,p1.idplayer AS idP1, p2.idplayer AS idP2, 
								CONCAT(p1.firstname, ' ', p1.lastname) AS nameP1, CONCAT(p2.firstname, ' ', p2.lastname) AS nameP2 
								FROM `match_comment` AS c 
								JOIN matches AS m ON m.id_match = c.match_id 
								JOIN players AS p1 ON p1.idplayer = m.id_player1 
								JOIN players AS p2 ON p2.idplayer = m.id_player2
								WHERE c.match_id = '$id' LIMIT 1");
			$matchData = mysql_fetch_array($query);
			//print_r($matchData);
			//split the score
			if (isset($matchData[1])) {
				//commentary db
				//$comment = str_replace('A',fetchCommentary('A'), $matchData[1]);
				//$comment = str_replace('D',fetchCommentary('D'), $comment);
				//$comment = str_replace('R',fetchCommentary('R'), $comment);
				$pattern = "/[ADERS][_][0-1][_]\d+/";
				$comment = preg_replace_callback($pattern, 'showCommentaryReplace', $matchData[1]);
				
				//Replace player ID for points
				$serv = 'PL' . $matchData[2]; 
				$recr = 'PL' . $matchData[3];
				$comment = str_replace($serv,$matchData[4],$comment);
				$comment = str_replace($recr,$matchData[5],$comment);
				
				//Replace from commentary
				$comment = str_replace('P1',$matchData[4],$comment);
				$comment = str_replace('P2',$matchData[5],$comment);
				
				$comment = str_replace("}}","<BR/><BR/>", $comment);
				$comment = str_replace("}","<BR/>", $comment);
				$comment = str_replace("*"," ", $comment);
				$comment = str_replace("#"," ", $comment);
				$comment = str_replace("]","</div>", $comment);
				$comment = str_replace("Score<BR/>","<div id='score'>", $comment);
				$comment = str_replace("DACE","<div id='ace'>",$comment);
				
				//print_r($comment);					
			}
			
			
				
			//for time
			$day =  floor((mktime() - $season_start)/86400);
					
			$smarty->assign('season',$season);
			$smarty->assign('day',$day);
			
			$q = "SELECT COUNT(id) FROM `messages` WHERE id_receiver = {$_SESSION['userid']} AND `read` = 0 AND del_receiver = 0";
			$r = mysql_query($q);
			$rf = mysql_fetch_row($r);
			$_SESSION['new_mail'] = $rf[0];
		}
	$smarty->assign('idteam',$_SESSION['id_team']);
    $smarty->assign('idleague',$_SESSION['id_league']);
	$smarty->assign('uname',$_SESSION['username']);
	$smarty->assign('userid',$_SESSION['userid']);
	$smarty->assign('new_mail',$_SESSION['new_mail']);
    $smarty->assign('cManager',$_SESSION['countryM']);
	$smarty->assign('member',$_SESSION['member']);
	$smarty->assign('credits',$_SESSION['credits']);
	
	$smarty->assign('matchData',$matchData);
	$smarty->assign('comment',$comment);

    $smarty->display('viewMatchCommentary.tpl');
}
}

else {
	header("Location:index.php");
}

?>