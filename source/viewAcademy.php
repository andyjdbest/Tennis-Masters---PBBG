<?php

require_once 'common.php';
require_once 'DBconfig.php';
require_once 'checkTransfers.php';

ini_set( "display_errors", 0);

session_start();
if (@$_SESSION['authenticated'] == 'true' & @$_SESSION['assigned'] == 1) {
	
	if ($_GET['academy']){
	$playerdata = array();
	$own = 0;
	if (ctype_digit($_GET['academy']) == false) {
		$error = "Invalid input";
	}
	else {
	$academy = $_GET['academy'];
	$userid = $_SESSION['userid'];
	
	check_tranfer($academy);
	//check if the user owns the academy
	$query = "SELECT id_user FROM academy WHERE id_team = '$academy'";
	$r = mysql_query($query);	
	$row = mysql_fetch_row($r);
	$user = $row[0];
	if ($userid == $row[0]) {
	$own = 1;
	//fetch required player summary details 
	$query = "SELECT DISTINCT CONCAT(p.firstname, ' ', p.lastname ) AS playername, p.idplayer,p.wrank, p.age, p.handed, p.fitness, 
		FLOOR( s.serve ) AS serve, FLOOR( s.volley ) AS volley, FLOOR( s.forehand ) AS forehand, FLOOR( s.backhand ) AS backhand, 
		FLOOR( s.speed ) AS speed, FLOOR( s.consistency ) AS consistency, FLOOR( s.stamina ) AS stamina, FLOOR( s.power ) AS power, 
		( s.rating ) AS srating, p.wage,DATEDIFF(NOW(),t.week) AS week,t.skill,t.update
			FROM players AS p
			JOIN player_stats AS s ON p.idplayer = s.idplayer
			JOIN academy AS a ON a.id_team = p.id_team
            LEFT JOIN training_report AS t ON t.id_player = p.idplayer   
			WHERE a.id_team = '$academy' OR (t.id_team = '$academy' AND DATEDIFF(NOW(),t.week) < 7)";
	$r = mysql_query($query);
	
	while ($ob = mysql_fetch_array($r)) {
		   $playerdata[] = $ob;
    	}
    	//print_r($playerdata);
    	
    	$copy = $playerdata; // create copy to delete dups from
	$usedPlayers = array(); // used players
	$max = count($playerdata) - 1;
	for( $i=$max; $i>=0; $i--) {
		
	    	if ( in_array( $playerdata[$i][1], $usedPlayers ) ) {
	        	unset($copy[$i]);
	    	}
	    	else {
	        	$usedPlayers[] = $playerdata[$i][1];
	    	}

	}
	$playerdata = array_values($copy);
	//print_r($playerdata);
		//get alliance if any
		$query = mysql_query("SELECT a.name,a.id_alliance FROM alliance AS a 
			JOIN alliance_members AS m ON m.id_alliance = a.id_alliance 
			WHERE m.id_user = $userid AND m.status = 2 LIMIT 1");
		$row = mysql_fetch_row($query);
	
		if (isset($row[0])){
			$allName = $row[0];
			$allID = $row[1];	
		}		
	}
	else { //user is not owner of academy so limited info
		$query = "SELECT  CONCAT(p.firstname, ' ',p.lastname) AS playername, 
			p.idplayer, p.age, p.handed, p.fitness, (s.rating) AS srating FROM players AS p 
			JOIN player_stats AS s ON p.idplayer = s.idplayer  
			JOIN academy AS a ON a.id_team = p.id_team 
			WHERE a.id_team = '$academy'";
		$r = mysql_query($query);
	
		while ($ob = mysql_fetch_array($r)) {
		   $playerdata[] = $ob;
    		}
    		
    		$copy = $playerdata; // create copy to delete dups from
	$usedPlayers = array(); // used players
	$max = count($playerdata) - 1;
	for( $i=$max; $i>=0; $i--) {
		
	    	if ( in_array( $playerdata[$i][1], $usedPlayers ) ) {
	        	unset($copy[$i]);
	    	}
	    	else {
	        	$usedPlayers[] = $playerdata[$i][1];
	    	}

	}
	$playerdata = array_values($copy);
		//get alliance if any
		$query = mysql_query("SELECT a.name,a.id_alliance FROM alliance AS a 
				JOIN alliance_members AS m ON m.id_alliance = a.id_alliance 
				WHERE m.id_user = (SELECT id_user FROM academy WHERE id_team = '$academy') AND m.status = 2 LIMIT 1");
		$row = mysql_fetch_row($query);
		
		if (isset($row[0])){
			$allName = $row[0];
			$allID = $row[1];	
		}		
	}
	//print_r($playerdata);
	for ( $row = 0; $row < count($playerdata); $row++ ){
				 	$sk = '';
				 	$week = 0;
		 while ( list( $key, $value ) = each( $playerdata[ $row ] ) ) {
		 	if ($key === 'wrank' && $value == 0){
 		 		$playerdata[ $row ][ $key ] = 'NR';	
 		 	}
 		 	if ($key === 'week' && $value < 6 ) {
 		 		$week = 1;
 		 		//echo $value;
 		 	}
 		 	if ($week == 1){
	 		 	if ($key == 'skill' ) {
	 		 		$sk = $value;
	 		 	}
	 		 	if ($key == 'update' && $value > 0) {
	 		 		//print_r($playerdata[$row]);
	 		 		$num = $value;
	 		 		//echo $num;
	 		 		$playerdata[$row][$sk] = "<span style=color:#0101DF;>$num</span>";
	 		 	}
 		 	}	
		 }
	}
	//print_r($playerdata);
	
        
    //fetch the academy name
	$query = "SELECT u.username, u.userid, a.id_team, a.team_name, t.id_league, l.nameleague,a.fans,a.fan_move FROM academy AS a 
				LEFT JOIN users AS u ON a.id_user = u.userid 
				JOIN league_table AS t ON a.id_team = t.id_team 
				JOIN league AS l ON l.idleague = t.id_league
				WHERE a.id_team = '$academy' AND t.season = '$season' LIMIT 1 ";
	$r = mysql_query($query);
	$row = mysql_fetch_row($r);
	
	$manager_name = $row[0];
	$manager_id = $row[1];
	$team = $row[2];
	$team_name = $row[3];
	$id_league = $row[4];
	$league_name = $row[5];
	$fans = $row[6];
	$move = $row[7];
	if ($fans < 20)
		$fans = 'Unknown';
	else if ($fans < 100)
		$fans = 'Popular';
	else if ($fans < 500)
		$fans = 'Regionally Popular';
	else if ($fans < 900)
		$fans = 'Nationally Popular';
	else if ($fans < 1200)
		$fans = 'Adored';
	else if ($fans < 1900)
		$fans = 'Rocking';
	else if ($fans < 2500)
		$fans = 'Kings';
	else $fans = 'Monarchs';
	}
	
	
	//get academy form
	$query = "SELECT id_winner FROM fixtures WHERE season = '$season' AND round_date < NOW() AND (id_team1 = '$academy' OR id_team2 = '$academy')
				AND id_winner IS NOT NULL AND fixture_type = 1 ORDER BY round_date DESC LIMIT 5";
	$r = mysql_query($query);
	while ($row = mysql_fetch_array($r)){
		$formData[] = $row;
	}
	$formString = '.....';
	if (isset($formData[0][0])){
		$formString = '';
		foreach($formData as $fd){
			if ($fd[0] == $academy)
				$formString = $formString . 'W';
			else 
				$formString = $formString . 'L';
		}
	}
	
	//academy stats
	$query = "SELECT id_winner,id_stadium,season FROM fixtures WHERE (id_team1 = '$academy' OR id_team2 = '$academy') AND fixture_type = 1 AND id_winner IS NOT NULL";
	$r = mysql_query($query);
	while ($row = mysql_fetch_array($r)){
		$statsData[] = $row;
	}
	
	$seasonStats = array();
	$alltimeStats = array();
	if (isset($statsData[0][0])){
		foreach($statsData as $sd){
			if ($sd[2] == $season){
				$seasonStats[$sd[1]][0] += 1; //played a game of that court-type
				if ($sd[0] == $academy) {
					$seasonStats[$sd[1]][1] += 1; //won a game on that court-type
				}
			}
			$alltimeStats[$sd[1]][0] += 1;
			if ($sd[0] == $academy) {
					$alltimeStats[$sd[1]][1] += 1; //won a game on that court-type
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
	
    $smarty->assign('error',$error);
	$smarty->assign('message',$message);
	$smarty->assign('userid',$userid);
	$smarty->assign('user',$user);
	$smarty->assign('manager_name',$manager_name);
	$smarty->assign('manager_id',$manager_id);
	$smarty->assign('id_team',$team);
	$smarty->assign('team_name',$team_name);
	$smarty->assign('id_league',$id_league);
	$smarty->assign('league_name',$league_name);
	$smarty->assign('playerdata',$playerdata);
	$smarty->assign('form',$formString);
	$smarty->assign('fans',$fans);
	$smarty->assign('fan_move',$move);
	$smarty->assign('alltimeStats', $alltimeStats);
	$smarty->assign('seasonStats', $seasonStats);
	$smarty->assign('alliance',$allName);
	$smarty->assign('allID',$allID);
	$smarty->assign('own',$own);
    $smarty->display('viewAcademy.tpl');
}
}
else {
	header("Location:index.php");
}
?>