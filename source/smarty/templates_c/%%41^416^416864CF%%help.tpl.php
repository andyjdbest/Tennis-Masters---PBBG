<?php /* Smarty version 2.6.26, created on 2010-09-20 21:14:26
         compiled from help.tpl */ ?>
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
						<li class="users"><span><?php echo $this->_tpl_vars['users']; ?>
 </span> online user(s)</li>
						<li class="time"><div class="jclock"></div></li>
					</ul>
				</div>
				<div class="yellow">
					<strong>Day <?php echo $this->_tpl_vars['day']; ?>
 </strong> of Season <?php echo $this->_tpl_vars['season']; ?>

				</div>
				<div class="block-bottom"></div>
				
			</div>
			<div id="right">
				<?php if ($this->_tpl_vars['loggedin'] == 1): ?>		
						<div align="right"><?php if ($this->_tpl_vars['member'] == 1): ?><?php echo $this->_tpl_vars['credits']; ?>
 credits <img src="assets/images/gold1.png" /><?php endif; ?><a href='.'>Membership</a></div>
						<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "validuserTopCSSMenu.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
				<?php else: ?>
                                               <p class="big"><a href=''>Register</a> or <a href='index.php'>Login</a></p>   
<?php endif; ?>
                                  
				<p>
				
				
				<ol id="toc">
	<li><a href="#intro">Introduction</a></li><!-- these comments between li's solve a problem in IE that prevents spaces appearing between list items that appear on different lines in the source
	--><li><a href="#academies">Academies</a></li><!-- these comments between li's solve a problem in IE that prevents spaces appearing between list items that appear on different lines in the source
	--><li><a href="#matches">Matches</a></li><!-- these comments between li's solve a problem in IE that prevents spaces appearing between list items that appear on different lines in the source
	--><li><a href="#tactics">Tactics</a></li><!-- these comments between li's solve a problem in IE that prevents spaces appearing between list items that appear on different lines in the source
	--><li><a href="#staff">Staff</a></li><!-- these comments between li's solve a problem in IE that prevents spaces appearing between list items that appear on different lines in the source
	--><li><a href="#finance">Finance</a></li>
</ol>
				
				
				<div class="tab" id="intro">
				<h3>Introduction</h3>
Tennis Masters is a Persistently Browser Based Game (PBBG) that puts you in charge of an academy of young tennis stars. Your academy competes in a league with other academies in order to determine the top academy. Your players will also compete in Slams for which they will have to qualify. Your aim is to take the academy and the players to ultimate glory.
<br />
You control the coaches, the training habits of the players and the match orders. You can even fire your players as well as buy new ones from the Transfer Market.
<br /><br />
</div>
<div class="tab" id="academies">
<h3>Academy</h3>
Once you register and login, you will be assigned an academy in a country of your choice. The academy will consist of 5 players and 5 coaches that are assigned to you.
Your academy will compete in a league with other 11 academies.<br />
If you are not happy with the academy name, it can be changed by visiting your profile page. Name changes are permitted only once in a season.
<br />
<h3>Players</h3>
Players form the crux of your academy and you will most of your time managing them. Players have the following information that you need to keep an eye on:<br />
Name - Hmm, very obvious.<br />
Age - Players can join an academy at the age of 17 and will retire at the age of 30.<br />
Nationality - Country that the player belongs to. Normally this is the same country where your academy is in.<br />
Hand -<br />
Serve (SRV) - Serving Skills<br />
Volley (VLY) - Ability to volley<br />
Forehand (FHD) - Ability to hit forehand shots<br />
Backhand (BHD) - Ability to hit backhand shots<br />
Consistency (CON) - Ability to play long rallies and hit the right spots<br />
Power (PWR) - Ability to hit powerful shots including return of serves and aces<br />
Stamina (STM) - Determines how long the player can play before getting tired<br />
Speed (SPD) - The higher this skill is the faster your player can cover the court in long rallies<br />
<br />
<b>Training</b><br />
Players skills can be trained every week during the season. One player can be trained only on 1 skill per week. To train a player a coach is needed. The speed of training improvements depend on the type of coach assigned and the age of the player.
<br /><br />
<b>Home Stadiums</b><br />
Your academy has 2 courts numbered 1 & 2. Courts can be changed from the Stadiums Menu, but each change takes 4 days and costs 5,000 
<br />A specific court can be chosen for a home league fixture 2 days prior to the fixture. If a court is not specified in time, then court no. 1 will be chosen.
</div>
<div class="tab" id="matches">
<h3>Matches</h3>
Tennis Masters currently supports only men/'s singles matches. Matches are simmed at a particular time on a given day and can be viewed in the form of a live running commentary. Each match is a best of 3 sets with the first player to win 2 sets winning the match.
<br />
<h3>League</h3>
Each country has 4 leagues with each league having 12 academies. Each academy faces the other twice in a season.<br />
For one round of a league match, the manager has to choose 3 of his players and their tactics. They will compete in a match with 3 players from the opposing academy. Each match won earns the academy 1 point.<br />
The League table is also updated with the Points Ratio (Points Lost/Points Won), which would be used to determine the spots in the league table.<br />
<br />
<h3>Knock-out Cups</h3>
Two knock-out cups will be played out in one season. The number of players in the cups will be 64.  There will be 2 qualifying rounds played in one week for challengers. 6 rounds of the cups will be simmed in 2 weeks time with 3 games in a week.
In the knock-out cups, players are selected based on their global rankings. Tennis Masters has the following Cups that will be played on the following courts:<br />
Wonders Cup = Played on Grass<br />
Awesome Cup = Played on HardCourt<br />
Ultimate Cup = Played on Rubber<br />
Famous Cup = Played on Clay<br />
<br />
<h3>Nations Cup</h3>
Coming Soon<br />
<br />
<h3>Challenges</h3>
Challenges are friendlies that can be arranged with other academies. Challenges are simmed at a particular time. To issue a challenge, click the green arrow near an academy.<br />
<br />
</div>
<div class="tab" id="tactics">
<h3>Tactics</h3>
The following tactics can be set for each match:<br />
<b>Style of Play</b><br />
Serve and Volley<br />
Aggressive Baseline<br />
Defensive Baseline<br />
All Court<br />
<br />
<b>Aggression</b><br />
Charged Up<br />
Relaxed<br />
Normal<br />
<br /><br />
</div>
<div class="tab" id="staff">
<h3>Coaches</h3>
Coaches are needed to train your players. The first time you register, your academy will have 5 coaches assigned to it. Every week, you can assign your players to be trained by a particular coach. Each coach can train only one player in one skill per week. Each coach that your academy has opens up a slot for training.  
Coaches retire at the age of 40.<br />
<b>Coach Level</b><br />
Coaches have different training capabilities, starting from Poor. Each new coach that is bought, will have Poor training capability. Their training ability can be upgraded at any time.
The cost of purchase and the wages of single coach are shown below:
<br />
1 Poor  3000 500 <br />
2 Decent 10000 1400 <br />
3 Respectable 14000 1800 <br />
4 Solid  20000 2200 <br />
5 Superb 26000 2600 <br />
Coaches can be upgraded once in a period of 7 days. <br />
</div>

<div class="tab" id="finance">
<h3>Finance</h3>
Running the academy incurs some cost, which should ideally be balanced with the income that the academy earns.
<br />
Every week, the cost and intakes are accounted for and the weekly balanced is stored. The costs and income are as follows:
<br />
<b>Costs</b>
<br />
Player Wages - Wages need to be paid to the players at the end of each week. These wages are based on the skills of the player and their age.
<br />
Coach Wages -   Wages also need to be paid to the coaches at the end of each week. These wages are based on the capability level of the coach and are independent of their age.
<br />
Player Purchases - The fee for the players purchased from the Transfer market.
<br />
Coach Purchases -   Amount of money spent on buying and upgrading coaches.
<br /><br />
<b>Income</b><br />
Attendance - Attendance fees are earned for every home game that the academy plays. Attendance for league games is calculated based on the league and the position of the academies playing the fixture.<br />
League - 1 has an attendance base of 10000 <br />
League - 2 has an attendance base of 8000 <br />
The attendance will vary based on the positions of the academy in that league and a random variable.
<br />
Sponsors   - Money given to the academy by the sponsors. This is dependent on the league that the academy is in.
<br />
Player Sales - Money received by selling any players in the Transfer market.
<br />
Prize Money -   Money received by competing in a league and your players competing in a knock-out cup.
<br />
Misc Income -  Money coming from miscelleneaous sources including joining bonus.
<br /><br />
<i>Negative Balance</i><br />
Academies are advised not to go into debt. If an academy goes into debt, it has 3 weeks to recover from it, either by selling its players or firing coaches to reduce the wages bill. If an academy cannot recover from its debt after the grace period of 3 weeks, it will be closed.
				</p>
</div>		

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "validuserFooter.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php echo '
<script src="activatables.js" type="text/javascript"></script>
<script type="text/javascript">
activatables(\'page\', [\'intro\', \'academies\', \'matches\', \'tactics\', \'staff\', \'finance\']);
</script>
'; ?>

</html>