<?php /* Smarty version 2.6.26, created on 2010-07-25 05:00:27
         compiled from index.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'index.tpl', 19, false),)), $this); ?>
<?php if ($this->_tpl_vars['loggedin'] == 1): ?>
						<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "validuserHeader.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
						<?php if ($this->_tpl_vars['fire_message'] != ''): ?>
	<div class='error'><?php echo $this->_tpl_vars['fire_message']; ?>
</div>	
<?php endif; ?>

<h1>Latest News</h1>
<table width="60%" border="1" cellpadding="1" cellspacing="0" id="academy"> 
<thead>
	<tr>

 <th width="20%">Date</th>
   <th width="60%">News</th>  	
</tr>
</thead>

<?php unset($this->_sections['id']);
$this->_sections['id']['name'] = 'id';
$this->_sections['id']['loop'] = is_array($_loop=$this->_tpl_vars['news']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['id']['show'] = true;
$this->_sections['id']['max'] = $this->_sections['id']['loop'];
$this->_sections['id']['step'] = 1;
$this->_sections['id']['start'] = $this->_sections['id']['step'] > 0 ? 0 : $this->_sections['id']['loop']-1;
if ($this->_sections['id']['show']) {
    $this->_sections['id']['total'] = $this->_sections['id']['loop'];
    if ($this->_sections['id']['total'] == 0)
        $this->_sections['id']['show'] = false;
} else
    $this->_sections['id']['total'] = 0;
if ($this->_sections['id']['show']):

            for ($this->_sections['id']['index'] = $this->_sections['id']['start'], $this->_sections['id']['iteration'] = 1;
                 $this->_sections['id']['iteration'] <= $this->_sections['id']['total'];
                 $this->_sections['id']['index'] += $this->_sections['id']['step'], $this->_sections['id']['iteration']++):
$this->_sections['id']['rownum'] = $this->_sections['id']['iteration'];
$this->_sections['id']['index_prev'] = $this->_sections['id']['index'] - $this->_sections['id']['step'];
$this->_sections['id']['index_next'] = $this->_sections['id']['index'] + $this->_sections['id']['step'];
$this->_sections['id']['first']      = ($this->_sections['id']['iteration'] == 1);
$this->_sections['id']['last']       = ($this->_sections['id']['iteration'] == $this->_sections['id']['total']);
?>
<tr>
  <td><div align="center"><?php echo ((is_array($_tmp=$this->_tpl_vars['news'][$this->_sections['id']['index']]['NewsDate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y-%m-%d") : smarty_modifier_date_format($_tmp, "%Y-%m-%d")); ?>
</div></td>
  <td><div align="center"><?php echo $this->_tpl_vars['news'][$this->_sections['id']['index']]['NewsText']; ?>
</div></td>
</tr>
<?php endfor; endif; ?>
</table>
<br />


<span>Academy <a href="viewAcademy.php?academy=<?php echo $this->_tpl_vars['idteam']; ?>
"><b><?php echo $this->_tpl_vars['team_name']; ?>
</b></a> in <a href="viewLeague.php?league=<?php echo $this->_tpl_vars['idleague']; ?>
"><b><?php echo $this->_tpl_vars['league_name']; ?>
</b></a> League</span>
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
<?php unset($this->_sections['id']);
$this->_sections['id']['name'] = 'id';
$this->_sections['id']['loop'] = is_array($_loop=$this->_tpl_vars['fixturedata']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['id']['show'] = true;
$this->_sections['id']['max'] = $this->_sections['id']['loop'];
$this->_sections['id']['step'] = 1;
$this->_sections['id']['start'] = $this->_sections['id']['step'] > 0 ? 0 : $this->_sections['id']['loop']-1;
if ($this->_sections['id']['show']) {
    $this->_sections['id']['total'] = $this->_sections['id']['loop'];
    if ($this->_sections['id']['total'] == 0)
        $this->_sections['id']['show'] = false;
} else
    $this->_sections['id']['total'] = 0;
if ($this->_sections['id']['show']):

            for ($this->_sections['id']['index'] = $this->_sections['id']['start'], $this->_sections['id']['iteration'] = 1;
                 $this->_sections['id']['iteration'] <= $this->_sections['id']['total'];
                 $this->_sections['id']['index'] += $this->_sections['id']['step'], $this->_sections['id']['iteration']++):
$this->_sections['id']['rownum'] = $this->_sections['id']['iteration'];
$this->_sections['id']['index_prev'] = $this->_sections['id']['index'] - $this->_sections['id']['step'];
$this->_sections['id']['index_next'] = $this->_sections['id']['index'] + $this->_sections['id']['step'];
$this->_sections['id']['first']      = ($this->_sections['id']['iteration'] == 1);
$this->_sections['id']['last']       = ($this->_sections['id']['iteration'] == $this->_sections['id']['total']);
?>
<tr>
 <td class="nam"><?php echo $this->_tpl_vars['fixturedata'][$this->_sections['id']['index']]['name_fixture']; ?>
</td>
  <td><div align="center"><?php echo $this->_tpl_vars['fixturedata'][$this->_sections['id']['index']]['round_date']; ?>
</div></td>
  <td><div align="center"><a href="fixtures.php?fixtureid=<?php echo $this->_tpl_vars['fixturedata'][$this->_sections['id']['index']]['id_fixture']; ?>
"><?php echo $this->_tpl_vars['fixturedata'][$this->_sections['id']['index']]['fixture']; ?>
</a>
  <?php if ($this->_tpl_vars['ts'][$this->_sections['id']['index']] == 1): ?><b>*</b><?php endif; ?></div></td>
  <td><div align="center"><?php echo $this->_tpl_vars['fixturedata'][$this->_sections['id']['index']]['court']; ?>
</div></td>
  <td><div align="center"><a href="viewTactics.php?fixtureid=<?php echo $this->_tpl_vars['fixturedata'][$this->_sections['id']['index']]['id_fixture']; ?>
" class="set">Set Tactics</a></div></td>
</tr>
<?php endfor; endif; ?>
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
<?php unset($this->_sections['id']);
$this->_sections['id']['name'] = 'id';
$this->_sections['id']['loop'] = is_array($_loop=$this->_tpl_vars['pfixturedata']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['id']['show'] = true;
$this->_sections['id']['max'] = $this->_sections['id']['loop'];
$this->_sections['id']['step'] = 1;
$this->_sections['id']['start'] = $this->_sections['id']['step'] > 0 ? 0 : $this->_sections['id']['loop']-1;
if ($this->_sections['id']['show']) {
    $this->_sections['id']['total'] = $this->_sections['id']['loop'];
    if ($this->_sections['id']['total'] == 0)
        $this->_sections['id']['show'] = false;
} else
    $this->_sections['id']['total'] = 0;
if ($this->_sections['id']['show']):

            for ($this->_sections['id']['index'] = $this->_sections['id']['start'], $this->_sections['id']['iteration'] = 1;
                 $this->_sections['id']['iteration'] <= $this->_sections['id']['total'];
                 $this->_sections['id']['index'] += $this->_sections['id']['step'], $this->_sections['id']['iteration']++):
$this->_sections['id']['rownum'] = $this->_sections['id']['iteration'];
$this->_sections['id']['index_prev'] = $this->_sections['id']['index'] - $this->_sections['id']['step'];
$this->_sections['id']['index_next'] = $this->_sections['id']['index'] + $this->_sections['id']['step'];
$this->_sections['id']['first']      = ($this->_sections['id']['iteration'] == 1);
$this->_sections['id']['last']       = ($this->_sections['id']['iteration'] == $this->_sections['id']['total']);
?>
<tr>
 <td class="nam"><?php echo $this->_tpl_vars['pfixturedata'][$this->_sections['id']['index']]['name_fixture']; ?>
</td>
  <td><div align="center"><?php echo $this->_tpl_vars['pfixturedata'][$this->_sections['id']['index']]['round_date']; ?>
</div></td>
  <td><div align="center"><a href="viewMatchSummary.php?matchID=<?php echo $this->_tpl_vars['pfixturedata'][$this->_sections['id']['index']]['id_match']; ?>
"><?php echo $this->_tpl_vars['pfixturedata'][$this->_sections['id']['index']]['game']; ?>
</a>
  <?php if ($this->_tpl_vars['pfixturedata'][$this->_sections['id']['index']]['playerName1'] != ''): ?>
  <td><div align="center"><?php echo $this->_tpl_vars['pfixturedata'][$this->_sections['id']['index']]['playerName1']; ?>
</div></td>
  <?php endif; ?>
  <?php if ($this->_tpl_vars['pfixturedata'][$this->_sections['id']['index']]['playerName2'] != ''): ?>
  <td><div align="center"><?php echo $this->_tpl_vars['pfixturedata'][$this->_sections['id']['index']]['playerName2']; ?>
</div></td>
  <?php endif; ?>
  <td><div align="center"><?php echo $this->_tpl_vars['pfixturedata'][$this->_sections['id']['index']]['court']; ?>
</div></td>
  <?php if ($this->_tpl_vars['pfixturedata'][$this->_sections['id']['index']]['playerName1'] != ''): ?>
  <td><div align="center"><a href="viewTactics.php?matchid=<?php echo $this->_tpl_vars['pfixturedata'][$this->_sections['id']['index']]['id_match']; ?>
&playerid=<?php echo $this->_tpl_vars['pfixturedata'][$this->_sections['id']['index']]['playerID1']; ?>
" class="set">Set Tactics</a></div></td>
  <?php endif; ?>
  <?php if ($this->_tpl_vars['pfixturedata'][$this->_sections['id']['index']]['playerName2'] != ''): ?>
  <td><div align="center"><a href="viewTactics.php?matchid=<?php echo $this->_tpl_vars['pfixturedata'][$this->_sections['id']['index']]['id_match']; ?>
&playerid=<?php echo $this->_tpl_vars['pfixturedata'][$this->_sections['id']['index']]['playerID2']; ?>
" class="set">Set Tactics</a></div></td>
  <?php endif; ?>
</tr>
<?php endfor; endif; ?>
</table>
</div>
<br /><br />

<?php else: ?> 
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
				<?php if ($this->_tpl_vars['loggedin'] == 1): ?>
				<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "validuserMenu.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
				<?php else: ?>
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
				<?php endif; ?>
				<div class="block-bottom"></div>
				
			</div>
			<div id="right">



				<div class="welcome e">
					<form method='post' action='login.php'>
					Login <input class="login" type="input" name='username' /> <span>Password</span> <input class="login" type="password" name='password' /> <input type='submit' value='Login!' class="sign-up" style="padding-left:14px;" />
					<br /><error><?php echo $this->_tpl_vars['error']; ?>
</error>
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
	<?php endif; ?>

	
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "validuserFooter.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php echo '
<script src="activatables.js" type="text/javascript"></script>
<script type="text/javascript">
activatables(\'page\', [\'academyFixture\', \'playerFixture\']);
</script>
<script type="text/javascript"> 
$(document).ready(function()     
{         
$("#academy").tablesorter();     
}); 
</script>
'; ?>


</html>