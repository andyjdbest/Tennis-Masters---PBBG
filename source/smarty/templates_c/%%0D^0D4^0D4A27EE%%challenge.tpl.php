<?php /* Smarty version 2.6.26, created on 2010-07-29 23:47:51
         compiled from challenge.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_options', 'challenge.tpl', 11, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "validuserHeader.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php if ($this->_tpl_vars['message'] == ''): ?>
<span>Academy <a href="viewAcademy.php?academy=<?php echo $this->_tpl_vars['id_team']; ?>
"><b><?php echo $this->_tpl_vars['team_name']; ?>
</b></a>
</span>

<h1>Issue Challenge</h1>			
<form method="post" action="challenge.php">
	Date: 
	<select name="date">
	<?php echo smarty_function_html_options(array('values' => $this->_tpl_vars['date'],'output' => $this->_tpl_vars['date'],'selected' => $_POST['date']), $this);?>
 <br />
	</select>
	Court: 
	<?php echo smarty_function_html_options(array('name' => 'courtname','options' => $this->_tpl_vars['court']), $this);?>
 <br />
	<input type='submit' value='Challenge'> <br />
	<input type='hidden' name='academyC' value=<?php echo $this->_tpl_vars['id_team']; ?>
>
</form>
<?php else: ?>
<?php echo $this->_tpl_vars['message']; ?>

<?php endif; ?>
	
 <br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
				
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "validuserFooter.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

</html>