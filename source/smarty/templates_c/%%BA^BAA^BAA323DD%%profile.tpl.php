<?php /* Smarty version 2.6.26, created on 2010-09-29 18:00:32
         compiled from profile.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "validuserHeader.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<h1>Profile</h1>
<h3>Academy Name</h3>			
<form method="post" action="profile.php">
	Academy name: <b><?php echo $this->_tpl_vars['team']; ?>
</b> <br /><br />
	<?php if ($this->_tpl_vars['count'] < 1): ?>
	Enter new academy name: <input type='text' name='teamName'>
	<input type='submit' value='Submit' name='team'> <br />
	<?php endif; ?>
	<?php echo $this->_tpl_vars['message']; ?>

</form>		

<h3>Court Name</h3>			
<form method="post" action="profile.php">
	<table>
	<thead><tr><th>Court #</th><th>Name</th><th>Change</th></tr></thead>	
	<?php unset($this->_sections['id']);
$this->_sections['id']['loop'] = is_array($_loop=$this->_tpl_vars['stad']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['id']['name'] = 'id';
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
	<tr><td><?php echo $this->_tpl_vars['stad'][$this->_sections['id']['index']]['stad_no']; ?>
</td><td><?php echo $this->_tpl_vars['stad'][$this->_sections['id']['index']]['name']; ?>
</td>
	<td><?php if ($this->_tpl_vars['stad'][$this->_sections['id']['index']]['name_change'] == 1): ?>Done<?php else: ?>
	<input type='text' name="court[<?php echo $this->_tpl_vars['stad'][$this->_sections['id']['index']]['stad_no']; ?>
]"> <input type='submit' value='Submit' name="<?php echo $this->_tpl_vars['stad'][$this->_sections['id']['index']]['stad_no']; ?>
"><?php endif; ?>	
	</td>
	</tr>		
	<?php endfor; endif; ?>	
	</table>

	
</form>
	<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />

				
	
 
				
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "validuserFooter.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

</html>