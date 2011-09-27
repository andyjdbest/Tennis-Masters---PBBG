<?php /* Smarty version 2.6.26, created on 2010-07-28 10:38:06
         compiled from message.tpl */ ?>
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

<?php if ($this->_tpl_vars['type'] == 'Read'): ?>
<form method='post' action='message.php'>
	<?php echo $this->_tpl_vars['message']; ?>
 <?php echo $this->_tpl_vars['error']; ?>
 
<fieldset>
<legend>Read Message</legend>
<br />
<table width="100%" border="1" cellpadding="1" cellspacing="0">
	
	<tr>
  <td><div align="left">From:</div></td>
  <td><?php echo $this->_tpl_vars['read'][4]; ?>
</td>
  </tr>
  <tr>
  <td><div align="left">Subject:</div></td>
  <td><?php echo $this->_tpl_vars['read'][1]; ?>
</td>
  </tr>
  <tr>
  <td><div align="left">Message:</div></td>
  <td><?php echo $this->_tpl_vars['read'][2]; ?>
</td>
</tr>
<input type="hidden" name="message_id" value="<?php echo $this->_tpl_vars['read'][0]; ?>
">
</table>
<input type='submit' value='Reply' name="reply" /> 
<input type='submit' value='Delete' name="delete" />
</fieldset>
</form>

<?php elseif ($this->_tpl_vars['type'] == 'memberCompose'): ?>
<form method='post' action='message.php'>
	<?php echo $this->_tpl_vars['message']; ?>
 <?php echo $this->_tpl_vars['error']; ?>
 
<fieldset>
<legend>Compose Message</legend>
<br />
<table width="100%" border="1" cellpadding="1" cellspacing="0" id="countryTable">
	<tr>
  <td><div align="left">To:</div></td>
  <td><input type="text" name="id_receiver" value="<?php echo $this->_tpl_vars['rec_uname']; ?>
" readonly="true" disabled="true"></td>
  </tr>
  <tr>
  <td><div align="left">Subject:</div></td><td><input type="text" name="subject"></td>
  </tr>
  <tr>
  <td><div align="left">Message:</div></td><td><textarea rows="10" cols="30" name="message"></textarea></td>
</tr>
</table>
<input type="hidden" name="receiver" value="<?php echo $this->_tpl_vars['id_receiver']; ?>
">
<input type='submit' value='Send' name="compose" /> <br />
</fieldset>
</form>

<?php elseif ($this->_tpl_vars['type'] == 'Reply'): ?>
<form method='post' action='message.php'>
	<?php echo $this->_tpl_vars['message']; ?>
 <?php echo $this->_tpl_vars['error']; ?>
 
<fieldset>
<legend>Reply</legend>
<br />

<table width="100%" border="1" cellpadding="1" cellspacing="0" id="countryTable">
	<tr>
  <td><div align="left">To:</div></td>
  <td><?php echo $this->_tpl_vars['reply'][1]; ?>
</td>
  </tr>
  <tr>
  <td><div align="left">Subject:</div></td><td><?php echo $this->_tpl_vars['subject']; ?>
</td>
  </tr>
  <tr>
  <td><div align="left">Message:</div></td><td><textarea rows="10" cols="30" name="message"><?php echo $this->_tpl_vars['reply'][3]; ?>
</textarea></td>
</tr>
</table>
<input type="hidden" name="receiver" value="<?php echo $this->_tpl_vars['reply'][0]; ?>
">
<input type="hidden" name="subject" value="<?php echo $this->_tpl_vars['subject']; ?>
">
<input type='submit' value='Send' name="reply_compose" /> <br />
</fieldset>
</form>


<?php else: ?>
<form method='post' action='message.php'>
	<?php echo $this->_tpl_vars['message']; ?>
 <?php echo $this->_tpl_vars['error']; ?>
 
<fieldset>
<legend>Compose Message</legend>
<br />
<table width="100%" border="1" cellpadding="1" cellspacing="0" id="countryTable">
	<tr>
  <td><div align="left">To:</div></td>
  <td><input type="text" name="name_receiver"></td>
  </tr>
  <tr>
  <td><div align="left">Subject:</div></td><td><input type="text" name="subject"></td>
  </tr>
  <tr>
  <td><div align="left">Message:</div></td><td><textarea rows="10" cols="30" name="message"></textarea></td>
</tr>
</table>
<input type='submit' value='Send' name="new_compose" /> <br />
</fieldset>
</form>
<?php endif; ?>
<br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "validuserFooter.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

</html>