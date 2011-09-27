<?php /* Smarty version 2.6.26, created on 2010-08-18 09:50:50
         compiled from viewTraining.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_options', 'viewTraining.tpl', 25, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "validuserHeader.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
				

<h1>Set Training</h1>
	Next Training Update: <strong><?php echo $this->_tpl_vars['next_date']; ?>
</strong>		
	<form action="setTraining.php" method="post">				
	<table width="100%" border="1" cellpadding="1" cellspacing="0" id="training"> 
  <tr class="tableHeader t"> 
    <td width="20%">Player</td> 
    <td width="15%"><center>Fitness</center></td> 
	<td width="20%"><center>Current Coach</center></td> 
    <td width="20%"><center>Current Training</center></td>  
    <td width="40%"><center>Set Coach</center></td> 
    <td width="40%"><center>Set Training</center></td> 
  </tr> 
 
<?php if ($this->_tpl_vars['curr'] == 1): ?> 
<?php unset($this->_sections['id']);
$this->_sections['id']['name'] = 'id';
$this->_sections['id']['loop'] = is_array($_loop=$this->_tpl_vars['currdata']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
  <tr class="nam"> 
    <td><input type="hidden" value="<?php echo $this->_tpl_vars['currdata'][$this->_sections['id']['index']]['idplayer']; ?>
" name="player[ ]" /><a href="viewPlayer.php?playerid=<?php echo $this->_tpl_vars['currdata'][$this->_sections['id']['index']]['idplayer']; ?>
"><?php echo $this->_tpl_vars['currdata'][$this->_sections['id']['index']]['pname']; ?>
</a></td> 
    <td><div align="center"><?php echo $this->_tpl_vars['currdata'][$this->_sections['id']['index']]['fitness']; ?>
</div></td> 
    	<td><div align="center"><?php echo $this->_tpl_vars['currdata'][$this->_sections['id']['index']]['name_coach']; ?>
</div></td> 
    <td><div align="center"><?php echo $this->_tpl_vars['currdata'][$this->_sections['id']['index']]['skill']; ?>
</div></td> 
    <td><div align="center"><select name="coach[ ]">
	<?php echo smarty_function_html_options(array('values' => $this->_tpl_vars['coachID'],'output' => $this->_tpl_vars['coachName'],'selected' => $this->_tpl_vars['currdata'][$this->_sections['id']['index']]['id_coach']), $this);?>
 
</select></div></td> 
    <td><div align="center"><select name="skill[ ]">
  	<?php echo smarty_function_html_options(array('values' => $this->_tpl_vars['skillid'],'output' => $this->_tpl_vars['skillsdata'],'selected' => $this->_tpl_vars['selectedSkill'][$this->_sections['id']['index']]), $this);?>

  </select></div></td> 
  </tr> 
<?php endfor; endif; ?>
</table>
<?php else: ?>
<?php unset($this->_sections['id']);
$this->_sections['id']['name'] = 'id';
$this->_sections['id']['loop'] = is_array($_loop=$this->_tpl_vars['playerdata']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
  <tr class="nam"> 
    <td><input type="hidden" value="<?php echo $this->_tpl_vars['playerdata'][$this->_sections['id']['index']]['idplayer']; ?>
" name="player[ ]" /><a href="viewPlayer.php?playerid=<?php echo $this->_tpl_vars['playerdata'][$this->_sections['id']['index']]['idplayer']; ?>
"><?php echo $this->_tpl_vars['playerdata'][$this->_sections['id']['index']]['playername']; ?>
</a></td> 
    <td><div align="center"><?php echo $this->_tpl_vars['playerdata'][$this->_sections['id']['index']]['fitness']; ?>
</div></td> 
	<td><div align="center"><?php echo $this->_tpl_vars['playerdata'][$this->_sections['id']['index']]['name_coach']; ?>
</div></td> 
    <td><div align="center"><?php echo $this->_tpl_vars['playerdata'][$this->_sections['id']['index']]['skill']; ?>
</div></td> 
    <td><div align="center"><select name="coach[ ]">
	<?php echo smarty_function_html_options(array('values' => $this->_tpl_vars['coachID'],'output' => $this->_tpl_vars['coachName']), $this);?>
 
</select></div></td> 
    <td><div align="center"><select name="skill[ ]">
  	<?php echo smarty_function_html_options(array('values' => $this->_tpl_vars['skillid'],'output' => $this->_tpl_vars['skillsdata']), $this);?>

  </select></div></td> 
  </tr> 
<?php endfor; endif; ?>
</table>


<?php endif; ?>
<input type="submit" value="Set Trainings" name="setTraining">
</form>
<br />

<br />					
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
$this->_sections['id']['loop'] = is_array($_loop=$this->_tpl_vars['playerdata']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
    <td class="nam"><a href="viewPlayer.php?playerid=<?php echo $this->_tpl_vars['playerdata'][$this->_sections['id']['index']]['idplayer']; ?>
"><?php echo $this->_tpl_vars['playerdata'][$this->_sections['id']['index']]['playername']; ?>
</a></td>
    <td><div align="center"><?php echo $this->_tpl_vars['playerdata'][$this->_sections['id']['index']]['serve']; ?>
</div></td> 
    <td><div align="center"><?php echo $this->_tpl_vars['playerdata'][$this->_sections['id']['index']]['volley']; ?>
</div></td> 
    <td><div align="center"><?php echo $this->_tpl_vars['playerdata'][$this->_sections['id']['index']]['forehand']; ?>
</div></td> 
    <td><div align="center"><?php echo $this->_tpl_vars['playerdata'][$this->_sections['id']['index']]['backhand']; ?>
</div></td> 
    <td><div align="center"><?php echo $this->_tpl_vars['playerdata'][$this->_sections['id']['index']]['consistency']; ?>
</div></td> 
    <td><div align="center"><?php echo $this->_tpl_vars['playerdata'][$this->_sections['id']['index']]['stamina']; ?>
</div></td> 
    <td><div align="center"><?php echo $this->_tpl_vars['playerdata'][$this->_sections['id']['index']]['power']; ?>
</div></td> 
    <td><div align="center"><?php echo $this->_tpl_vars['playerdata'][$this->_sections['id']['index']]['speed']; ?>
</div></td> 
    <td><div align="center"><?php echo $this->_tpl_vars['playerdata'][$this->_sections['id']['index']]['fitness']; ?>
</div></td> 
    <td><div align="center"><?php echo $this->_tpl_vars['playerdata'][$this->_sections['id']['index']]['srating']; ?>
</div></td>
  </tr> 
<?php endfor; endif; ?>
</tbody>
</table>

<br />
<table width="100%" border="1" cellpadding="1" cellspacing="0" id="coach">
		
<thead>
  <tr class="tableHeader"> 
    <th width="35%">Name</td> 
    <th width="20%"><center>Level</center></th> 
  </tr> 
  </thead>
<tbody>
<?php unset($this->_sections['id']);
$this->_sections['id']['name'] = 'id';
$this->_sections['id']['loop'] = is_array($_loop=$this->_tpl_vars['coachData']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
    <td class="nam"><a href="viewCoach.php?coachid=<?php echo $this->_tpl_vars['coachData'][$this->_sections['id']['index']]['id_coach']; ?>
"><?php echo $this->_tpl_vars['coachData'][$this->_sections['id']['index']]['name_coach']; ?>
</a></td>
    <td><div align="center"><?php echo $this->_tpl_vars['coachData'][$this->_sections['id']['index']]['name_coachlevel']; ?>
</div></td> 
  </tr> 
<?php endfor; endif; ?>
</tbody>
</table>
 <br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />


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