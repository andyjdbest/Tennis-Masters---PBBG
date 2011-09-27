<?php /* Smarty version 2.6.26, created on 2010-09-29 20:07:41
         compiled from viewTactics.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_options', 'viewTactics.tpl', 8, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "validuserHeader.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php if ($this->_tpl_vars['errorM'] == ''): ?>
<?php if ($this->_tpl_vars['single'] == 0): ?>
<?php if ($this->_tpl_vars['noChange'] == 0): ?>
<form action="setTactics.php" method="post">
<div align="left">Choose the court: <select name="court">
	<?php echo smarty_function_html_options(array('values' => $this->_tpl_vars['courtType'],'output' => $this->_tpl_vars['courtName'],'selected' => $this->_tpl_vars['selectC']), $this);?>
 
</select></div>
<input type="submit" value="Change" name="setCourt" class="set"> 
</form>
<br />
<?php endif; ?>
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
<h1>Set Tactics</h1>
<form action="setTactics.php" method="post">	
<table width="100%" border="1" cellpadding="1" cellspacing="0" id="tactics"> 
  <tr class="tableHeader t"> 
  <th width="10%"><center>Match</center></th>
  <th width="30%"><center>Player</center></th>
  <th width="20%"><center>Tactic</center></th>
  <th width="20%"><center>Aggression</center></th>
  	</tr>
</thead>
<tr>
	<td><div align="center">1</div></td>
  <td><div align="center"><select name="player[ ]">
	<?php echo smarty_function_html_options(array('values' => $this->_tpl_vars['player_id'],'output' => $this->_tpl_vars['player_name'],'selected' => $this->_tpl_vars['selection'][2][0]), $this);?>
 
</select></div>
</td>
  <td><div align="center"><select name="tactic[ ]">
	<?php echo smarty_function_html_options(array('values' => $this->_tpl_vars['tactic_id'],'output' => $this->_tpl_vars['tactic_name'],'selected' => $this->_tpl_vars['selection'][2][1]), $this);?>
 
</select></div></td>
  <td><div align="center"><select name="agg[ ]">
	<?php echo smarty_function_html_options(array('values' => $this->_tpl_vars['agg_id'],'output' => $this->_tpl_vars['agg_name'],'selected' => $this->_tpl_vars['selection'][2][2]), $this);?>
 
</select></div></td> 
</tr>
<tr>
	<td><div align="center">2</div></td>
  <td><div align="center"><select name="player[ ]">
	<?php echo smarty_function_html_options(array('values' => $this->_tpl_vars['player_id'],'output' => $this->_tpl_vars['player_name'],'selected' => $this->_tpl_vars['selection'][1][0]), $this);?>
 
</select></div>
</td>
  <td><div align="center"><select name="tactic[ ]">
	<?php echo smarty_function_html_options(array('values' => $this->_tpl_vars['tactic_id'],'output' => $this->_tpl_vars['tactic_name'],'selected' => $this->_tpl_vars['selection'][1][1]), $this);?>
 
</select></div></td>
  <td><div align="center"><select name="agg[ ]">
	<?php echo smarty_function_html_options(array('values' => $this->_tpl_vars['agg_id'],'output' => $this->_tpl_vars['agg_name'],'selected' => $this->_tpl_vars['selection'][1][2]), $this);?>
 
</select></div></td> 
</tr>
<tr>
	<td><div align="center">3</div></td>
  <td><div align="center"><select name="player[ ]">
	<?php echo smarty_function_html_options(array('values' => $this->_tpl_vars['player_id'],'output' => $this->_tpl_vars['player_name'],'selected' => $this->_tpl_vars['selection'][0][0]), $this);?>
 
</select></div>
</td>
  <td><div align="center"><select name="tactic[ ]">
	<?php echo smarty_function_html_options(array('values' => $this->_tpl_vars['tactic_id'],'output' => $this->_tpl_vars['tactic_name'],'selected' => $this->_tpl_vars['selection'][0][1]), $this);?>
 
</select></div></td>
  <td><div align="center"><select name="agg[ ]">
	<?php echo smarty_function_html_options(array('values' => $this->_tpl_vars['agg_id'],'output' => $this->_tpl_vars['agg_name'],'selected' => $this->_tpl_vars['selection'][0][2]), $this);?>
 
</select></div></td> 
</tr>
</table>
<input type="checkbox" name="setDefault" value="1">Save as Default</input>
<input type="submit" value="Set Tactics" name="setTactic" class="set"> 
</form>

<form action="viewTactics.php" method="post">
<input type="submit" value="Default" name="default" class="set">
</form>
* Note: The court type might change, if the host academy decides to change it for the fixture.
<br /><br />					
<table width="100%" border="1" cellpadding="1" cellspacing="0" id="players">
		
<thead>
  <tr class="tableHeader"> 
    <th width="35%">Name</td> 
    <th width="10%"><center>SRV</center></th> 
    <th width="10%"><center>VLY</center></th> 
    <th width="10%"><center>FHD</center></th> 
    <th width="10%"><center>BHD</center></th> 
    <th width="10%"><center>CON</center></th> 
    <th width="10%"><center>STM</center></th> 
    <th width="10%"><center>PWR</center></th> 
    <th width="10%"><center>SPD</center></th> 
    <th width="10%"><center>FIT</center></th> 
    <th width="10%"><center>Rating</center></th> 
  </tr> 
  </thead>
<tbody>
<?php unset($this->_sections['id']);
$this->_sections['id']['name'] = 'id';
$this->_sections['id']['loop'] = is_array($_loop=$this->_tpl_vars['playerData']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
    <td class="nam"><a href="viewPlayer.php?playerid=<?php echo $this->_tpl_vars['playerData'][$this->_sections['id']['index']]['idplayer']; ?>
"><?php echo $this->_tpl_vars['playerData'][$this->_sections['id']['index']]['playername']; ?>
</a></td>
    <td><div align="center"><?php echo $this->_tpl_vars['playerData'][$this->_sections['id']['index']]['serve']; ?>
</div></td> 
    <td><div align="center"><?php echo $this->_tpl_vars['playerData'][$this->_sections['id']['index']]['volley']; ?>
</div></td> 
    <td><div align="center"><?php echo $this->_tpl_vars['playerData'][$this->_sections['id']['index']]['forehand']; ?>
</div></td> 
    <td><div align="center"><?php echo $this->_tpl_vars['playerData'][$this->_sections['id']['index']]['backhand']; ?>
</div></td> 
    <td><div align="center"><?php echo $this->_tpl_vars['playerData'][$this->_sections['id']['index']]['consistency']; ?>
</div></td> 
    <td><div align="center"><?php echo $this->_tpl_vars['playerData'][$this->_sections['id']['index']]['stamina']; ?>
</div></td> 
    <td><div align="center"><?php echo $this->_tpl_vars['playerData'][$this->_sections['id']['index']]['power']; ?>
</div></td> 
    <td><div align="center"><?php echo $this->_tpl_vars['playerData'][$this->_sections['id']['index']]['speed']; ?>
</div></td> 
    <td><div align="center"><?php echo $this->_tpl_vars['playerData'][$this->_sections['id']['index']]['fitness']; ?>
</div></td> 
    <td><div align="center"><?php echo $this->_tpl_vars['playerData'][$this->_sections['id']['index']]['srating']; ?>
</div></td>
  </tr> 
<?php endfor; endif; ?>
</tbody>
</table>

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
<?php else: ?>
<?php echo $this->_tpl_vars['errorM']; ?>

<?php endif; ?>
			

<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />

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