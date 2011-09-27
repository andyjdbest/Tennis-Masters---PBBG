<?php /* Smarty version 2.6.26, created on 2010-09-29 20:15:15
         compiled from viewFixtureTactics.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_options', 'viewFixtureTactics.tpl', 81, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "validuserHeader.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php if ($this->_tpl_vars['single'] == 0): ?>
<b>Fixture:</b> <a href="viewAcademy.php?academy=<?php echo $this->_tpl_vars['matchDetails']['id_team1']; ?>
"> <?php echo $this->_tpl_vars['matchDetails']['t1Name']; ?>
 </a> v/s
<a href="viewAcademy.php?academy=<?php echo $this->_tpl_vars['matchDetails']['id_team2']; ?>
"> <?php echo $this->_tpl_vars['matchDetails']['t2Name']; ?>
 </a> <br />
<b>Court:</b>   <?php echo $this->_tpl_vars['matchDetails']['stad']; ?>
 (<?php echo $this->_tpl_vars['matchDetails']['name']; ?>
) <br /> 
<b>Date:</b>     <?php echo $this->_tpl_vars['matchDetails']['round_date']; ?>
 <br /> 

<?php if ($this->_tpl_vars['own'] == 1): ?>
<h1>Fixture Tactics</h1>
<table width="100%" border="1" cellpadding="1" cellspacing="0" id="tactics"> 
  <thead>
  <tr> 
  <th width="10%"><center>Match</center></th>
  <th width="30%"><center>Player</center></th>
  <th width="20%"><center>Tactic</center></th>
  <th width="20%"><center>Aggression</center></th>
  	</tr>
</thead>
<tr>
	<td><div align="center">1</div></td>
  <td><div align="center"><?php echo $this->_tpl_vars['selection'][2][0]; ?>
 
	</div>
</td>
  <td><div align="center">
	<?php echo $this->_tpl_vars['selection'][2][1]; ?>
 
</div></td>
  <td><div align="center">
	<?php echo $this->_tpl_vars['selection'][2][2]; ?>
 
</div></td> 
</tr>
<tr>
	<td><div align="center">2</div></td>
  <td><div align="center">
	<?php echo $this->_tpl_vars['selection'][1][0]; ?>
 
</div>
</td>
  <td><div align="center">
	<?php echo $this->_tpl_vars['selection'][1][1]; ?>
 
</div></td>
  <td><div align="center">
	<?php echo $this->_tpl_vars['selection'][1][2]; ?>
 
</div></td> 
</tr>
<tr>
	<td><div align="center">3</div></td>
  <td><div align="center">
	<?php echo $this->_tpl_vars['selection'][0][0]; ?>
 
</div>
</td>
  <td><div align="center">
	<?php echo $this->_tpl_vars['selection'][0][1]; ?>
 
</div></td>
  <td><div align="center">
	<?php echo $this->_tpl_vars['selection'][0][2]; ?>
 
</div></td> 
</tr>
</table>

<br /><br /><?php else: ?><div id="error">
<?php echo $this->_tpl_vars['error']; ?>

</div>
<?php endif; ?>
		
<?php elseif ($this->_tpl_vars['single'] == 1): ?>
<h1>Set Tactics</h1>
<form action="setTactics.php" method="post">	
<table width="100%" border="1" cellpadding="1" cellspacing="0" id="tactics"> 
  <tr class="tableHeader t"> 
  <th width="30%"><center>Player</center></th>
  <th width="20%"><center>Tactic</center></th>
  <th width="20%"><center>Aggression</center></th>
  </tr>
</thead>
<tr>
  <td><div align="center"><input type="hidden" value="<?php echo $this->_tpl_vars['player_id']; ?>
" name="player" />
  <a href="viewPlayer.php?playerid=<?php echo $this->_tpl_vars['player_id']; ?>
"><?php echo $this->_tpl_vars['player_name']; ?>
</a></td> 
</div>
</td>
  <td><div align="center"><select name="tactic">
	<?php echo smarty_function_html_options(array('values' => $this->_tpl_vars['tactic_id'],'output' => $this->_tpl_vars['tactic_name'],'selected' => $this->_tpl_vars['selection'][0][1]), $this);?>
 
</select></div></td>
  <td><div align="center"><select name="agg">
	<?php echo smarty_function_html_options(array('values' => $this->_tpl_vars['agg_id'],'output' => $this->_tpl_vars['agg_name'],'selected' => $this->_tpl_vars['selection'][0][2]), $this);?>
 
</select></div></td> 
</tr>
</table>
<input type="submit" value="Set Tactics" name="setKTactic" class="set"> 
</form>
<?php endif; ?>

<br /><br /><br /><br /><br /><br /><br /><br /><br /><br />			


<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "validuserFooter.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php echo '
<script type="text/javascript"> 
$(document).ready(function()     
{         
$("#players").tablesorter();     
}); 
</script>
'; ?>

</html>