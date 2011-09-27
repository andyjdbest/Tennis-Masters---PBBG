<?php /* Smarty version 2.6.26, created on 2010-04-20 09:01:51
         compiled from viewTraining1.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_options', 'viewTraining1.tpl', 29, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "validuserHeader.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
				

<h1>Set Training</h1>
				
	<form action="setTraining.php" method="post">				
	<table width="100%" border="1" cellpadding="1" cellspacing="0" id="training"> 
  <tr class="tableHeader t"> 
    <td width="20%">Player</td> 
    <td width="15%"><center>Fitness</center></td> 
    <td width="20%"><center>Previous Coach</center></td> 
    <td width="20%"><center>Previous Training</center></td>
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
    <td><div align="center"><?php echo $this->_tpl_vars['playerdata'][$this->_sections['id']['index']]['fitness']; ?>
</div></td> 
    <td><div align="center"><?php echo $this->_tpl_vars['trainprev'][$this->_sections['id']['index']]['name_coach']; ?>
</div></td> 
    <td><div align="center"><?php echo $this->_tpl_vars['trainprev'][$this->_sections['id']['index']]['skill']; ?>
</div></td> 
	<td><div align="center"><?php echo $this->_tpl_vars['currdata'][$this->_sections['id']['index']]['name_coach']; ?>
</div></td> 
    <td><div align="center"><?php echo $this->_tpl_vars['currdata'][$this->_sections['id']['index']]['skill']; ?>
</div></td> 
    <td><div align="center"><select name="coach[ ]">
	<?php echo smarty_function_html_options(array('values' => $this->_tpl_vars['currdata'][$this->_sections['id']['index']]['id_coach'],'output' => $this->_tpl_vars['currdata'][$this->_sections['id']['index']]['name_coach'],'selected' => $this->_tpl_vars['currdata'][$this->_sections['id']['index']]['id_coach']), $this);?>
 
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
    <td><div align="center"><?php echo $this->_tpl_vars['trainprev'][$this->_sections['id']['index']]['name_coach']; ?>
</div></td> 
    <td><div align="center"><?php echo $this->_tpl_vars['trainprev'][$this->_sections['id']['index']]['skill']; ?>
</div></td> 
	<td><div align="center"><?php echo $this->_tpl_vars['currdata'][$this->_sections['id']['index']]['name_coach']; ?>
</div></td> 
    <td><div align="center"><?php echo $this->_tpl_vars['currdata'][$this->_sections['id']['index']]['skill']; ?>
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

 


<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "validuserFooter.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

</html>