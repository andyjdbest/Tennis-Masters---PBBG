<?php /* Smarty version 2.6.26, created on 2010-10-03 08:17:26
         compiled from viewAlliance.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "validuserHeader.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php echo $this->_tpl_vars['message']; ?>

<table width="100%" id="alliance">
<tr>
 <td colspan ='2' height="22" align="left" valign="middle" style="background-color:#E6EDF5")><?php echo $this->_tpl_vars['name']; ?>
</td>
</tr>
 <tr>
  <td colspan = '2'><b>Description:</b></td>
  </tr>
  <tr><td colspan = '2'><?php echo $this->_tpl_vars['description']; ?>
</td>
 </tr>
</table>
<br />
<table width="100%" id="members">
<thead><tr><th>User</th><th>Points</th></tr></thead> 	 
 <?php unset($this->_sections['id']);
$this->_sections['id']['name'] = 'id';
$this->_sections['id']['loop'] = is_array($_loop=$this->_tpl_vars['members']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
   <td><a href='viewManagerInfo.php?user=<?php echo $this->_tpl_vars['members'][$this->_sections['id']['index']]['id_user']; ?>
'><?php echo $this->_tpl_vars['members'][$this->_sections['id']['index']]['username']; ?>
</td><td><?php echo $this->_tpl_vars['members'][$this->_sections['id']['index']]['points']; ?>
</td>	 
  </tr>
 <?php endfor; endif; ?> 
</table>  

<br />
<?php if ($this->_tpl_vars['leader'] != 1): ?>
<form action='allianceApplicant.php' method='post'>
<input type='hidden' name='id' value=<?php echo $this->_tpl_vars['Aid']; ?>
>
<h3>Application</h3> 
<?php if ($this->_tpl_vars['existing'] == 1): ?>
You may choose to withdraw yourself from this alliance. <br />
<input type='submit' value='Withdraw' name='withdraw' />
<?php else: ?>
If you apply to join the alliance, a message will be sent to the leader who will have to approve your application.<br />
<input type='submit' value='Apply' name='apply' />
<?php endif; ?>
</form>				
<?php endif; ?>
<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
 
				
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "validuserFooter.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

</html>