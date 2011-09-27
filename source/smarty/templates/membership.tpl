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
				<div class="block-bottom"></div>
				
			</div>
			<div id="right">
				{if $loggedin eq 1}		
						<div align="right">{if $member eq 1}{$credits} credits <img src="assets/images/gold1.png" />{/if}<a href='.'>Membership</a></div>
						{include file="validuserTopCSSMenu.tpl"}
				{else}
                                               <p class="big"><a href=''>Register</a> or <a href='index.php'>Login</a></p>   
{/if}
                                  
				<h3>Membership</h3>
Tennis Masters is available to be played for Free. However, developing and running the game costs money that is being paid by the team behind Tennis Masters.
If you appreciate the efforts that are put in by the team and would like to support the growth of the game, you are encouraged to become a member. <br />
The money that you contribute will be used to support the game by paying for the server costs as well used to support further development of this game. <br />
<br />
In an effort to show our gratitude for those who contribute, we will provide members with certain additional features to enjoy Tennis Masters even better.
The current features available to members include: <br />
<ol>
<li><b>Personalization of your Academy players</b> - Members can rename their players. Fancy naming a player after yourself?</li>
<li><b>Personalization of your Stadiums</b> - Members can choose to rename their stadiums.</li>
<li><b>Alliances</b> - A member can create his own alliance. Other users can choose to join the alliance for free. An alliance will earn points based on the league matches won by its members. Rewards will be available to the academies at the EOS.</li>
<li><b>Training Reports</b> - Members can view the training reports of their players beyond a month.</li>
<li><b>More features to come</b>...</li>
</ol>
<br />
{if $loggedin eq 1}
<h3>Membership Options</h3>
<table><thead><tr><th>Option</th><th>Cost</th><th>Credits</th><th>Payment</th></tr></thead>
<tr><td>3 month Membership</td><td>$10</td><td>80 Credits</td><td><form action="https://www.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="VK5MQ9EGCJ83W">
<input type="hidden" name="custom" value="{$userid}">
<input type="image" src="https://www.paypal.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
</form>
</td></tr>
</table>
{/if}

<!--
<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="PQ9TLU4T2MZNU">
<input type="image" src="https://www.paypal.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
</form>


-->

<br /><br />				
				
				
				
				




	

{include file="validuserFooter.tpl"}

</html>