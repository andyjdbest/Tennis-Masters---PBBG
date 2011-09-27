<?php /* Smarty version 2.6.26, created on 2010-07-27 09:57:27
         compiled from setTactics.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "validuserHeader.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
 
<?php if ($this->_tpl_vars['messageSet'] != ""): ?>
	<span><?php echo $this->_tpl_vars['messageSet']; ?>
</span> <br />
<?php endif; ?>
<?php if ($this->_tpl_vars['errorSet'] != ""): ?>
	<div id="error"><?php echo $this->_tpl_vars['errorSet']; ?>
</div> <br />
<?php endif; ?>

<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "validuserFooter.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php echo '
<script type="text/javascript"> 
$(document).ready(function()     
{         
$("#tactics").tablesorter();     
}); 
</script>
'; ?>

</html>