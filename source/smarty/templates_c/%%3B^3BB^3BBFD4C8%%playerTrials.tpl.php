<?php /* Smarty version 2.6.26, created on 2010-07-27 09:35:54
         compiled from playerTrials.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_options', 'playerTrials.tpl', 13, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "validuserHeader.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<br />
<?php if ($this->_tpl_vars['message'] != ""): ?>
			<span style='color:green'><?php echo $this->_tpl_vars['message']; ?>
</span>
			<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
<?php elseif ($this->_tpl_vars['can_call'] == '1'): ?>
Player Trials can be held once a week starting from Tuesday.  <br />
You can decide on the country from which you want your player. <br />
You can pick 1 player per week. <br />
<form method='post' action='getPlayer.php'>
<fieldset>
<legend>Request for Player Trials</legend>
<label name="country">Country:</label> <?php echo smarty_function_html_options(array('name' => 'country','options' => $this->_tpl_vars['countries'],'selected' => $_POST['country']), $this);?>

<br />
<input type='submit' value='Call' /> <br />  
<?php else: ?>
	<span style='color:red'><?php echo $this->_tpl_vars['next']; ?>
</span>
	<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
<?php endif; ?>


</fieldset>
</form>
			

 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "validuserFooter.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
 
</html>