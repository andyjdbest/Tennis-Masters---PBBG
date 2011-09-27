<?php /* Smarty version 2.6.26, created on 2010-08-05 05:39:01
         compiled from viewFinance.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "validuserHeader.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<h1>Finances</h1>
				
Balance at end of Last Week: <strong>  &nbsp;<?php echo $this->_tpl_vars['current']; ?>
</strong>  <BR />

<table>
	<tr><th colspan="2">Income</th><th colspan="2">Cost</th></tr>
	<tr>
		<td>Attendance:</td><td><?php echo $this->_tpl_vars['financeData']['attend']; ?>
</td>
		<td>Player Wages:</td><td><?php echo $this->_tpl_vars['financeData']['pwage']; ?>
</td>
	</tr>
	<tr>
		<td>Sponsorship:</td><td><?php echo $this->_tpl_vars['financeData']['sponsors']; ?>
</td>
		<td>Coach Wages:</td><td><?php echo $this->_tpl_vars['financeData']['cwage']; ?>
</td>
	</tr>
	<tr>
		<td>Player Sales:</td><td><?php echo $this->_tpl_vars['financeData']['psales']; ?>
</td>
		<td>Player Purchases:</td><td><?php echo $this->_tpl_vars['financeData']['ppurchase']; ?>
</td>
	</tr>
	<tr>
		<td>PrizeMoney:</td><td><?php echo $this->_tpl_vars['prize']; ?>
</td>
		<td>Coach Purchases:</td><td><?php echo $this->_tpl_vars['financeData']['cpurchase']; ?>
</td>
	</tr>
	<tr>
		<td>Misc Income:</td><td><?php echo $this->_tpl_vars['financeData']['mincome']; ?>
</td>
		<td>Misc Cost:</td><td><?php echo $this->_tpl_vars['financeData']['mcost']; ?>
</td>
	</tr>
	<tr>
		<td></td><td></td>
		<td></td><td></td>
	</tr>
	<tr>
		<td>Total Income:</td><td><?php echo $this->_tpl_vars['summaryIncome']; ?>
</td>
		<td>Total Cost:</td><td><?php echo $this->_tpl_vars['summaryCost']; ?>
</td>
	</tr>
	<tr>
		<td>Projected Weekly Profit/Loss:</td><td></td><td></td><td><?php echo $this->_tpl_vars['weekly']; ?>
</td>
	</tr>
	<tr>
		<td>Projected Money at End of Week:</td><td></td><td></td><td> <strong><?php echo $this->_tpl_vars['projected']; ?>
 </strong></td>
	</tr>
</table> 
<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
				
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "validuserFooter.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

</html>