<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
 
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en"> 
<head> 
 
<title>Tennis Masters - Online Persistent Browser Based Game</title>

<link href="style.css" rel="stylesheet" type="text/css" />

</head>
<body>
 
<div id="header">
	<div class="wrapper">
		<div id="logo">
			<a href="."><img src="assets/images/logov2.jpg" alt="Tennis Masters" /></a>
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
						
						<li class="time"><div class="jclock"></div></li>
						<li></li>
						<li><strong>Day {$day} </strong> of Season {$season}</li>
						
						{if $smarty.server.SCRIPT_NAME == "/beta_new/viewAcademy.php" ||
							$smarty.server.SCRIPT_NAME == "/beta_new/viewFixtures.php"}
						<li><a href="viewAcademy.php?academy={$id_team}">Academy</a></li>
						<li><a href="viewFixtures.php?academy={$id_team}">Fixture</a></li>
						{/if}
					</ul>
				</div>
				
				
				
			</div>
			<div id="right">
<div class="block-middle"> <div align="right">{if $member eq 1}{$credits} credits <img src="assets/images/gold1.png" />{/if}<a href='membership.php'>Membership</a></div>
					
					{include file="validuserTopCSSMenu.tpl"}
<br />
</div>				