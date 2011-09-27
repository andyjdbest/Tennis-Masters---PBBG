<?php /* Smarty version 2.6.26, created on 2010-10-03 10:15:50
         compiled from movePlayer.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "validuserHeader.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
 
<?php if ($this->_tpl_vars['error'] != ""): ?>
	<div id="error"><?php echo $this->_tpl_vars['error']; ?>
</div> <br />
<?php elseif ($this->_tpl_vars['message'] != ""): ?>
	<span><?php echo $this->_tpl_vars['message']; ?>
</span> <br />
	<?php if ($this->_tpl_vars['type'] == 'fire'): ?>
	<form method="post" action="movePlayer.php">
		<input type="submit" value="Fire" name="confirmFire">
	</form>
	<?php elseif ($this->_tpl_vars['type'] == 'sell'): ?>
	<form method="post" action="movePlayer.php">
		<input type="submit" value="Yes" name="confirmSell">
	</form>
	
	<br /><br /><br /><br /><br /><br /><br /><br /><br />
	<?php endif; ?>
		
<?php endif; ?>


<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "validuserFooter.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

</html>