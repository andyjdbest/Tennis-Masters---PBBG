<?php /* Smarty version 2.6.26, created on 2010-07-27 09:59:11
         compiled from viewManagerInfo.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "validuserHeader.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<table width="100%" id="manager">
<tr>
  <td><a href="message.php?to=<?php echo $this->_tpl_vars['id_manager']; ?>
"><img src="assets/images/icon_email.gif"></a></td>
  <td><b>Username:</b></td><td><?php echo $this->_tpl_vars['manager_name']; ?>
</td>
</tr>
    <tr>
  <td></td><td><b>Country:</b></td><td><?php echo $this->_tpl_vars['country']; ?>
</td>
  </tr>
  <tr>
  <td></td><td><b>Academy:</b></td><td><a href="viewAcademy.php?academy=<?php echo $this->_tpl_vars['academy_id']; ?>
"><?php echo $this->_tpl_vars['academy']; ?>
</a></td>
  </tr>		
  <tr>
  <td></td><td><b>Date:</b></td><td><?php echo $this->_tpl_vars['date']; ?>
</td>
  </tr>	
</table>  				
<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
 
				
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "validuserFooter.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

</html>