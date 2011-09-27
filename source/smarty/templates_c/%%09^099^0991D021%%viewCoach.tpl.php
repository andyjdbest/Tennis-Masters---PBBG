<?php /* Smarty version 2.6.26, created on 2010-08-02 16:09:11
         compiled from viewCoach.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "validuserHeader.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php if ($this->_tpl_vars['own'] == 1): ?>
<h1>Coach Details</h1>
							
	<table width="100%" border="1" cellpadding="1" cellspacing="0" id="coach"> 
	<thead>
    <tr class="tableHeader t"> 
    <th width="20%">Coach</td> 
    <th width="15%"><center>Age</center></td> 
    <th width="20%"><center>Level</center></td> 
    <th width="20%"><center>Last Upgrade</center></td> 
  </tr> 
  </thead>
  
<?php unset($this->_sections['id']);
$this->_sections['id']['name'] = 'id';
$this->_sections['id']['loop'] = is_array($_loop=$this->_tpl_vars['coachdata']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
    <td class="nam"><div align="center"><a href="viewCoach.php?coachID=<?php echo $this->_tpl_vars['coachdata'][$this->_sections['id']['index']]['id_coach']; ?>
"><?php echo $this->_tpl_vars['coachdata'][$this->_sections['id']['index']]['name_coach']; ?>
</a></div></td> 
    <td><div align="center"><?php echo $this->_tpl_vars['coachdata'][$this->_sections['id']['index']]['age']; ?>
</div></td> 
    <td><div align="center"><?php echo $this->_tpl_vars['coachdata'][$this->_sections['id']['index']]['name_coachlevel']; ?>
</div></td> 
    <td><div align="center"><?php echo $this->_tpl_vars['coachdata'][$this->_sections['id']['index']]['date_upgrade']; ?>
</div></td> 
  </tr>
    <?php if ($this->_tpl_vars['upgrade'] == 1): ?>
  <tr><td>
  <form action="manageCoach.php" method="post" accept-charset="utf-8">
	<input type="hidden" name="coachID" value=<?php echo $this->_tpl_vars['coachdata'][$this->_sections['id']['index']]['id_coach']; ?>
>
	<p><input type="submit" name="upgrade" value="Upgrade" /> <input type="submit" name="fire" value="   Fire   " /></p>
   </form>
  </td></tr>
  <?php endif; ?> 
 
<?php endfor; endif; ?>
</table>
    <?php if ($this->_tpl_vars['upgrade'] == 1): ?>
<label class="sell">Cost of upgrade = <?php echo $this->_tpl_vars['cost']; ?>
</label> <br />
<?php endif; ?>
<br />

<?php else: ?>
<br />
 <div class="error">Error: <?php echo $this->_tpl_vars['error']; ?>
</div> <br />
 
<?php endif; ?>	
<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />			

 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "validuserFooter.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
 
</html>