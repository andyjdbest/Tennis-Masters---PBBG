<?php /* Smarty version 2.6.26, created on 2010-07-27 14:25:06
         compiled from mail.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "validuserHeader.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>				
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "validuserMailMenu.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php if ($this->_tpl_vars['type'] == 'inbox'): ?>
<?php if ($this->_tpl_vars['message'] != ""): ?>
<?php echo $this->_tpl_vars['message']; ?>

<?php endif; ?>
<br />
<table width="100%" border="1" cellpadding="1" cellspacing="0" id="inbox">
<thead>
	<tr class="tableHeader">
  <div align="center"><td>From</div></td><td></td><td>Subject</td><td>Date</td></div>
  </tr>
</thead>
  
  <?php unset($this->_sections['id']);
$this->_sections['id']['name'] = 'id';
$this->_sections['id']['loop'] = is_array($_loop=$this->_tpl_vars['mailData']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
  <td><div align="left"><?php echo $this->_tpl_vars['mailData'][$this->_sections['id']['index']]['username']; ?>
</div></td>
  <?php if ($this->_tpl_vars['mailData'][$this->_sections['id']['index']]['read'] == 0): ?>
  <td><div align="left"><img src="assets/images/icon_email.gif"></div></td>
  <?php else: ?>
  <td></td>
  <?php endif; ?> 
  <td><div align="left"><a href="message.php?message=<?php echo $this->_tpl_vars['mailData'][$this->_sections['id']['index']]['mid']; ?>
"><?php echo $this->_tpl_vars['mailData'][$this->_sections['id']['index']]['subject']; ?>
</div></td> 
  <td><div align="left"><?php echo $this->_tpl_vars['mailData'][$this->_sections['id']['index']]['date']; ?>
</div></td>
  </tr>
  <?php endfor; endif; ?>
</table>
<?php endif; ?>

<?php if ($this->_tpl_vars['type'] == 'outbox'): ?>
<br />
<table width="100%" border="1" cellpadding="1" cellspacing="0" id="inbox">
<thead>
	<tr class="tableHeader">
  <div align="center"><td>To</div></td><td>Subject</td><td>Date</td></div>
  </tr>
</thead>
  
  <?php unset($this->_sections['id']);
$this->_sections['id']['name'] = 'id';
$this->_sections['id']['loop'] = is_array($_loop=$this->_tpl_vars['mailData']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
  <td><div align="left"><?php echo $this->_tpl_vars['mailData'][$this->_sections['id']['index']]['username']; ?>
</div></td> 
  <td><div align="left"><a href="message.php?message=<?php echo $this->_tpl_vars['mailData'][$this->_sections['id']['index']]['mid']; ?>
"><?php echo $this->_tpl_vars['mailData'][$this->_sections['id']['index']]['subject']; ?>
</div></td> 
  <td><div align="left"><?php echo $this->_tpl_vars['mailData'][$this->_sections['id']['index']]['date']; ?>
</div></td>
  </tr>
  <?php endfor; endif; ?>
</table>
<?php endif; ?>
<br /><br /><br /><br /><br /><br /><br /><br /><br /><br />

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "validuserFooter.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</html>