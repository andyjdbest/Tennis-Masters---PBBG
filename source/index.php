<?php
/* todo: add query for top 10 players.
 */
	require_once 'common.php';
	require_once 'DBconfig.php';
	require_once 'checkTransfers.php';
	
	function checkTacticSet($tacticData,$fixID,$academyID){
	//print_r($tacticData);
		foreach($tacticData as $ts) {	
			//echo "$ts[0] = $academyID, $fixID = $ts[1]";
			if ($fixID == $ts[0] && $ts[1] == $academyID) {
				return 1;
			}
		}
		return 0;
	}
	

    session_start();
	if (@$_SESSION['authenticated'] == 'true' & @$_SESSION['assigned'] == 1) {
	
	if ($_GET['message']) {
		if (ctype_alnum($_GET['message']) == false) {
			$error = "Error in processing";
		}
		else {
			if ($_GET['message'] == 'Failed') {
				$fire_message = 'Error in firing player';
			}
			elseif ($_GET['message'] == 'Success') {
				$fire_message = 'Player fired';
			}
		}
	}

	$playerdata = array();
	
	$userid = $_SESSION['userid'];
	
	$query = mysql_query("SELECT NewsText, NewsDate FROM news ORDER BY id DESC LIMIT 5");
	while ($row = mysql_fetch_array($query)) {
		$news[] = $row; 
	}
	/*			
	//fetch required player summary details 
	$query = "SELECT CONCAT(u.firstname, ' ', u.lastname) AS name, CONCAT(p.firstname, ' ',p.lastname) AS playername, 
			p.idplayer, p.age, p.handed, p.fitness, FLOOR(s.rating) AS srating, p.rank FROM players AS p 
			JOIN player_stats AS s ON p.idplayer = s.idplayer 
			JOIN academy AS a ON p.id_team = a.id_team 
			JOIN users AS u ON u.userid = a.id_user 
			LEFT JOIN market AS m ON m.id_player = p.idplayer
			WHERE a.id_user = '$userid'";
	$r = mysql_query($query);
	
	while ($ob = mysql_fetch_array($r)) {
		   $playerdata[] = $ob;
		   $playerids[] =$ob[2];
    	}
    	
    	//to show rank = 0 as rank = NR
	for ( $row = 0; $row < count($playerdata); $row++ ){
	 while ( list( $key, $value ) = each( $playerdata[ $row ] ) ) {
	 	if ($key === 'rank' && $value == 0){
 	 		$playerdata[ $row ][ $key ] = 'NR';	
 	 	}	
	 }
	}
     */   
	$query = "SELECT a.id_team, l.id_league,a.team_name,n.nameleague FROM academy AS a JOIN league_table AS l ON a.id_team = l.id_team JOIN league AS n ON n.idleague = l.id_league WHERE a.id_user = '$userid' AND l.season = '$season'";
	$r = mysql_query($query);	
	$row = mysql_fetch_row($r);
	
	$_SESSION['id_team'] = $row[0];
	$_SESSION['id_league'] = $row[1];
	$_SESSION['name_team'] = $row[2];
	$_SESSION['name_league'] = $row[3];
	
	$team = $_SESSION['id_team'];
	
	check_tranfer($team);
	//fetch the fixtures data
	$query = "SELECT f.id_fixture, f.round_date, ft.name_fixture, CONCAT( t1.team_name, ' v ', t2.team_name ) AS fixture , c.name AS court
			FROM `fixtures` AS f
			JOIN fixture_type AS ft ON ft.id_fixture = f.fixture_type
			JOIN academy AS t1 ON t1.id_team = f.id_team1
			JOIN academy AS t2 ON t2.id_team = f.id_team2
			JOIN courttype AS c ON f.id_stadium = c.idcourttype
			WHERE (f.id_team1 = '$team' OR f.id_team2 = '$team') AND f.fixture_type < 3
			AND f.id_winner IS NULL GROUP BY f.id_fixture ORDER BY f.round_date LIMIT 5 ";
	$r = mysql_query($query);
	
	while ($ob = mysql_fetch_array($r)) {
		   $fixturedata[] = $ob;
    	}
    	
    	$query = "SELECT f.id_fixture, m.id_team FROM match_order AS m JOIN fixtures AS f ON m.id_fixture = f.id_fixture
    			WHERE (f.id_team1 = '$team' OR f.id_team2 = '$team') AND f.fixture_type < 3
			AND f.id_winner IS NULL GROUP BY f.id_fixture ORDER BY f.round_date LIMIT 5";
	$r = mysql_query($query);
	while ($ob = mysql_fetch_array($r)) {
		   $tacticdata[] = $ob;
    	}
	
	if(isset($tacticdata)){
	foreach($fixturedata as $fixture) {
		if (checkTacticSet($tacticdata,$fixture[0],$team) == 1) {
			$tacticSet[] = 1;
		}
		else {
			$tacticSet[] = 0;
		}				
	}
	}
	
	//for player fixtures:
	$query = mysql_query("SELECT f.round_date, ft.name_fixture, m.id_match, 
			CONCAT( p1.firstname, ' ', p1.lastname, ' v ', p2.firstname, ' ', p2.lastname ) AS game, c.name AS court, m.id_player1, m.id_player2,
			CONCAT( p1.firstname, ' ', p1.lastname) AS p1Name, CONCAT( p2.firstname, ' ', p2.lastname) AS p2name
						FROM `matches` AS m
						JOIN fixtures AS f ON f.id_fixture = m.id_fixture
						JOIN fixture_type AS ft ON ft.id_fixture = f.fixture_type
						JOIN players AS p1 ON p1.idplayer = m.id_player1
						JOIN players AS p2 ON p2.idplayer = m.id_player2
						JOIN courttype AS c ON m.id_court = c.idcourttype
						WHERE f.fixture_type > 3 AND m.id_winner < 1 AND (p1.id_team ='$team' OR p2.id_team ='$team')");
	
	while ($arr = mysql_fetch_array($query)) {
		$tfixturedata[] = $arr;
    	}
	
	if (isset($tfixturedata[0][0])){
	$pfixturedata = $tfixturedata;
	$index = 0;
	foreach($tfixturedata as $pf){
		//if both players in the match belong to the academy
		if (in_array($pf['id_player1'],$playerids) && in_array($pf['id_player2'],$playerids)){
			
			$pfixturedata[$index]['playerID1'] = $pf['id_player1'];
			$pfixturedata[$index]['playerName1'] = $pf[7];
			$temp = $pf;
			$temp['playerID2'] = $pf['id_player2'];
			$temp['playerName2'] = $pf['p2name'];
			$pfixturedata[] = $temp;
		}
		elseif (in_array($pf['id_player1'],$playerids)) {
			$pfixturedata[$index]['playerID1'] = $pf['id_player1'];
			$pfixturedata[$index]['playerName1'] = $pf[7];
		}
		elseif (in_array($pf['id_player2'],$playerids)) {
			$pfixturedata[$index]['playerID2'] = $pf['id_player2'];
			$pfixturedata[$index]['playerName2'] = $pf['p2name'];
		}
		//print_r($pf);
		$index += 1;
	}
	}
	
	//print_r($pfixturedata);
	/*
	$q = "SELECT COUNT(id) FROM `messages` WHERE id_receiver = '$user' AND `read` = 0 AND del_receiver = 0";
	$r = mysql_query($q);
	$row = mysql_fetch_row($r);
	$_SESSION['new_mail'] = $row[0];
    	*/
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
	$smarty->assign('member',$_SESSION['member']);
	$smarty->assign('credits',$_SESSION['credits']);
	
    //$smarty->assign('error',$error);
	//$smarty->assign('message',$message);
	//$smarty->assign('userid',$userid);
	//$smarty->assign('name',$name);
	//$smarty->assign('id_team',$_SESSION['id_team']);
	$smarty->assign('loggedin',1);
	$smarty->assign('team_name',$_SESSION['name_team']);
	
	$smarty->assign('league_name',$_SESSION['name_league']);
	//$smarty->assign('playerdata',$playerdata);
	$smarty->assign('fixturedata',$fixturedata);
	$smarty->assign('pfixturedata',$pfixturedata);
	$smarty->assign('ts',$tacticSet);
	$smarty->assign('fire_message',$fire_message);
	$smarty->assign('news', $news);
	
    $smarty->display('index.tpl');
}
else {		
		$a = mysqli_query($conn,"SELECT (`iduser`),`time`,NOW(),TIMEDIFF(NOW(),time) FROM `logins` WHERE TIMEDIFF(NOW(),time) < '00:10:00' GROUP BY iduser");
		$user = mysqli_fetch_row($a);
		$users = $user[0];
		if ($users == 0) $users = 1;
		$day =  floor((mktime() - $season_start)/86400);
		
		if (isset($_SESSION['userid'])) {
			$loggedin = 1;
		}
		
        $smarty->assign('users', $users);
		$smarty->assign('season',$season);
		$smarty->assign('day',$day);
		$smarty->assign('loggedin',$loggedin);
		$smarty->assign('uname',$_SESSION['username']);
		$smarty->assign('idteam',$_SESSION['id_team']);
    	$smarty->assign('idleague',$_SESSION['id_league']);
		$smarty->assign('userid',$_SESSION['userid']);
		$smarty->assign('cManager',$_SESSION['country']);
        $smarty->display('index.tpl');
}
 
?>