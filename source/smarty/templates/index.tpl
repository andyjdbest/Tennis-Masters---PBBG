{if $loggedin eq 1}
						{include file="validuserHeader.tpl"}
						{if $fire_message ne ''}
	<div class='error'>{$fire_message}</div>	
{/if}

<h1>Latest News</h1>
<table width="60%" border="1" cellpadding="1" cellspacing="0" id="academy"> 
<thead>
	<tr>

 <th width="20%">Date</th>
   <th width="60%">News</th>  	
</tr>
</thead>

{section name=id loop=$news}
<tr>
  <td><div align="center">{$news[id].NewsDate|date_format:"%Y-%m-%d"}</div></td>
  <td><div align="center">{$news[id].NewsText}</div></td>
</tr>
{/section}
</table>
<br />


<span>Academy <a href="viewAcademy.php?academy={$idteam}"><b>{$team_name}</b></a> in <a href="viewLeague.php?league={$idleague}"><b>{$league_name}</b></a> League</span>
{*
<h1>Academy Players</h1>
<table width="100%" border="1" cellpadding="1" cellspacing="0" id="academy"> 
<thead>
	<tr class="tableHeader">

 <th width="30%">Name</th>
   <th width="10%">Rank</th>
  <th width="15%"><center>Age</center></th>
  <th width="15%"><center>Playing Hand</center></th>
  <th width="15%"><center>Fitness</center></th>
  <th width="15%"><center>Rating</center></th>
  	</tr>
</thead>

{section name=id loop=$playerdata}
<tr>
  {if $playerdata[id].id_player > 0}
    <td class="nam"><a href="viewPlayer.php?playerid={$playerdata[id].idplayer}"><SPAN STYLE="color: green;">{$playerdata[id].playername}</span></a></td> 
	{else}
	<td class="nam"><a href="viewPlayer.php?playerid={$playerdata[id].idplayer}">{$playerdata[id].playername}</a></td> 
	{/if}
    <td><div align="center">{$playerdata[id].rank}</div></td>
  <td><div align="center">{$playerdata[id].age}</div></td>
  <td><div align="center">{$playerdata[id].handed}</div></td>
  <td><div align="center">{$playerdata[id].fitness}</div></td>
  <td><div align="center">{$playerdata[id].srating}</div></td>
</tr>
{/section}
</table>
*}
<br /><br />

<h1>Fixture Information</h1>

<ol id="toc">
	<li><a href="#playerFixture">Players</a></li><!-- these comments between li's solve a problem in IE that prevents spaces appearing between list items that appear on different lines in the source
	--><li><a href="#academyFixture">Academy</a></li>
</ol>

<div class="tab" id="academyFixture">
<h1>Academy Fixtures</h1>
<table width="100%" border="1" cellpadding="1" cellspacing="0" id="fixtures"> 
<tr class="tableHeader t">
  <th width="15%">Type</th>
  <th width="15%">Date</th>
  <th width="40%">Fixture</th>
  <th width="15%">Court</th>
  <th width="15%">Set Tactics</th>
</tr>
{section name=id loop=$fixturedata}
<tr>
 <td class="nam">{$fixturedata[id].name_fixture}</td>
  <td><div align="center">{$fixturedata[id].round_date}</div></td>
  <td><div align="center"><a href="fixtures.php?fixtureid={$fixturedata[id].id_fixture}">{$fixturedata[id].fixture}</a>
  {if $ts[id] eq 1}<b>*</b>{/if}</div></td>
  <td><div align="center">{$fixturedata[id].court}</div></td>
  <td><div align="center"><a href="viewTactics.php?fixtureid={$fixturedata[id].id_fixture}" class="set">Set Tactics</a></div></td>
</tr>
{/section}
</table>
</div>

<div class="tab" id="playerFixture">
<h1>Player Fixtures</h1>
<table width="100%" border="1" cellpadding="1" cellspacing="0" id="pfixtures"> 
<tr class="tableHeader t">
  <th width="10%">Type</th>
  <th width="15%">Date</th>
  <th width="40%">Fixture</th>
  <th width="20%">Player</th>
  <th width="10%">Court</th>
  <th width="15%">Set Tactics</th>
</tr>
{section name=id loop=$pfixturedata}
<tr>
 <td class="nam">{$pfixturedata[id].name_fixture}</td>
  <td><div align="center">{$pfixturedata[id].round_date}</div></td>
  <td><div align="center"><a href="viewMatchSummary.php?matchID={$pfixturedata[id].id_match}">{$pfixturedata[id].game}</a>
  {if $pfixturedata[id].playerName1 ne ''}
  <td><div align="center">{$pfixturedata[id].playerName1}</div></td>
  {/if}
  {if $pfixturedata[id].playerName2 ne ''}
  <td><div align="center">{$pfixturedata[id].playerName2}</div></td>
  {/if}
  <td><div align="center">{$pfixturedata[id].court}</div></td>
  {if $pfixturedata[id].playerName1 ne ''}
  <td><div align="center"><a href="viewTactics.php?matchid={$pfixturedata[id].id_match}&playerid={$pfixturedata[id].playerID1}" class="set">Set Tactics</a></div></td>
  {/if}
  {if $pfixturedata[id].playerName2 ne ''}
  <td><div align="center"><a href="viewTactics.php?matchid={$pfixturedata[id].id_match}&playerid={$pfixturedata[id].playerID2}" class="set">Set Tactics</a></div></td>
  {/if}
</tr>
{/section}
</table>
</div>
<br /><br />

{else} 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en"> 
<head> 
<title>Tennis Masters - Online Tennis Management Game</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="style.css" rel="stylesheet" type="text/css" />

</head>

<body>
	
	
<div id="header">
	<div class="wrapper">
		<div id="logo">
			<a href="/"><img src="assets/images/logov2.jpg" alt="Tennis Masters" /></a>
		</div>
		<div id="manage">
			<h2>Online Tennis Management Game</h2>
			<h2><span>Manage your own tennis academy!</span></h2>
		</div>
	</div>
</div>


<div id="main">
	<div class="wrapper">
		<div id="content">
			<div id="main">
			<div id="left">
				<div class="info">
					<ul>
						<li class="users"><span>{$users} </span> online user(s)</li>
						<li class="time"><div class="jclock"></div></li>
					</ul>
				</div>
				<div class="yellow">
					<strong>Day {$day} </strong> of Season {$season}
				</div>
				{if $loggedin eq 1}
				{include file="validuserMenu.tpl"}
				{else}
				<!--<div class="block-top"></div>-->
				<div class="block-middle">
					<h1>Top 10</h1>
					<ol>
						<li>User</li>
						<li>Danstrog</li>
						<li>Megan3</li>
						<li>Swade</li>
						<li>Foxx</li>
						<li>User</li>
						<li>Tyler</li>
						<li>Renau</li>
						<li>Other</li>
						<li>Ronnie</li>
					</ul>
				</div>
				{/if}
				<div class="block-bottom"></div>
				
			</div>
			<div id="right">



				<div class="welcome e">
					<form method='post' action='login.php'>
					Login <input class="login" type="input" name='username' /> <span>Password</span> <input class="login" type="password" name='password' /> <input type='submit' value='Login!' class="sign-up" style="padding-left:14px;" />
					<br /><error>{$error}</error>
					<br /><a href="forgotpassword.php" >Forgot Password?</a>
					</form>
				</div>
				
				
				
<p class="big">Tennis Masters is about managing your own academy of tennis players and making them stars.</p>
<br ><p class="big"> We are currently in beta testing. Follow us on our <a href="http://dt-games.net/gamesetmatch">development forum</a></p>
<p class="big" style="margin-bottom:40px;"><a href="help.php">Take a tour</a> or visit our <a href="help.php">HELP</a> section before you start. <br /> <a href="/" class="sign-up">Sign Up!</a></p>


<h1>Think you can do better?</h1>
<p class="gray">Join a game that puts you in charge of your own tennis academy. You manage the career of tennis players and attempt to create the future stars. Train your players, determine how they play against opponents while you compete against the best managers from around the world. <br />
If you are looking for activity throughout the week, we have it. Check out our <a href="viewCalendar.php">Weekly Calendar</a> </p>

<div class="si">
<p>So what are you waiting for? <a href="." class="sign-up">Sign up</a> and start playing!</p>

</div>
	{/if}

	
{include file="validuserFooter.tpl"}
{literal}
<script src="activatables.js" type="text/javascript"></script>
<script type="text/javascript">
activatables('page', ['academyFixture', 'playerFixture']);
</script>
<script type="text/javascript"> 
$(document).ready(function()     
{         
$("#academy").tablesorter();     
}); 
</script>
{/literal}

</html>