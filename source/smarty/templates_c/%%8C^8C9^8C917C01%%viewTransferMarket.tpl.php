<?php /* Smarty version 2.6.26, created on 2010-07-27 10:23:52
         compiled from viewTransferMarket.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_options', 'viewTransferMarket.tpl', 8, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "validuserHeader.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<H1>Search </h1>

<form action="searchTM.php" method="post">
	<table width="100%">
    <tr><td width="15%"><center><b>Age</b></center></td>
	<td>min</td><td><?php echo smarty_function_html_options(array('name' => 'min_age','options' => $this->_tpl_vars['age'],'selected' => $_POST['min_age']), $this);?>
</td>
	<td>max</td><td><?php echo smarty_function_html_options(array('name' => 'max_age','options' => $this->_tpl_vars['age'],'selected' => $_POST['max_age']), $this);?>
</td></tr>  
    <tr><td width="15%"><center><b>SRV</b></center></td> 
	<td>min</td><td><?php echo smarty_function_html_options(array('name' => 'min_srv','options' => $this->_tpl_vars['stat'],'selected' => $_POST['min_srv']), $this);?>
</td>
	<td>max</td><td><?php echo smarty_function_html_options(array('name' => 'max_srv','options' => $this->_tpl_vars['stat'],'selected' => 14), $this);?>
</td></tr>
    <tr><td width="15%"><center><b>VLY</b></center></td>
	<td>min</td><td><?php echo smarty_function_html_options(array('name' => 'min_vly','options' => $this->_tpl_vars['stat'],'selected' => $_POST['min_vly']), $this);?>
</td>
	<td>max</td><td><?php echo smarty_function_html_options(array('name' => 'max_vly','options' => $this->_tpl_vars['stat'],'selected' => 14), $this);?>
</td></tr>
    <tr><td width="15%"><center><b>FHD</b></center></td>
	<td>min</td><td><?php echo smarty_function_html_options(array('name' => 'min_fhd','options' => $this->_tpl_vars['stat'],'selected' => $_POST['min_fhd']), $this);?>
</td>
	<td>max</td><td><?php echo smarty_function_html_options(array('name' => 'max_fhd','options' => $this->_tpl_vars['stat'],'selected' => 14), $this);?>
</td></tr>
    <tr><td width="15%"><center><b>BHD</b></center></td>
	<td>min</td><td><?php echo smarty_function_html_options(array('name' => 'min_bhd','options' => $this->_tpl_vars['stat'],'selected' => $_POST['min_bhd']), $this);?>
</td>
	<td>max</td><td><?php echo smarty_function_html_options(array('name' => 'max_bhd','options' => $this->_tpl_vars['stat'],'selected' => 14), $this);?>
</td></tr>
    <tr><td width="15%"><center><b>CON</b></center></td>
	<td>min</td><td><?php echo smarty_function_html_options(array('name' => 'min_con','options' => $this->_tpl_vars['stat'],'selected' => $_POST['min_con']), $this);?>
</td>
	<td>max</td><td><?php echo smarty_function_html_options(array('name' => 'max_con','options' => $this->_tpl_vars['stat'],'selected' => 14), $this);?>
</td></tr>
    <tr><td width="15%"><center><b>STM</b></center></td>
	<td>min</td><td><?php echo smarty_function_html_options(array('name' => 'min_stm','options' => $this->_tpl_vars['stat'],'selected' => $_POST['min_stm']), $this);?>
</td>
	<td>max</td><td><?php echo smarty_function_html_options(array('name' => 'max_stm','options' => $this->_tpl_vars['stat'],'selected' => 14), $this);?>
</td></tr>
    <tr><td width="15%"><center><b>PWR</b></center></td>
	<td>min</td><td><?php echo smarty_function_html_options(array('name' => 'min_pwr','options' => $this->_tpl_vars['stat'],'selected' => $_POST['min_pwr']), $this);?>
</td>
	<td>max</td><td><?php echo smarty_function_html_options(array('name' => 'max_pwr','options' => $this->_tpl_vars['stat'],'selected' => 14), $this);?>
</td></tr>
    <tr><td width="15%"><center><b>SPD</b></center></td>
	<td>min</td><td><?php echo smarty_function_html_options(array('name' => 'min_spd','options' => $this->_tpl_vars['stat'],'selected' => $_POST['min_spd']), $this);?>
</td>
	<td>max</td><td><?php echo smarty_function_html_options(array('name' => 'max_spd','options' => $this->_tpl_vars['stat'],'selected' => 14), $this);?>
</td></tr>
   	<tr><td><input type="submit" name="search" value="Continue" /></td></tr>
	</table>
</form>			
	
<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "validuserFooter.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

</html>