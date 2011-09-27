<?php /* Smarty version 2.6.26, created on 2010-01-27 22:13:19
         compiled from buyCoach.tpl */ ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "validuserHeader.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php if ($this->_tpl_vars['error'] != ""): ?>
 <div class="error">Error: <?php echo $this->_tpl_vars['error']; ?>
</div> <br />
<?php else: ?>
 <div class="sell"><?php echo $this->_tpl_vars['message']; ?>
</div> 
<?php endif; ?>	
			

 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "validuserFooter.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
 
</html>