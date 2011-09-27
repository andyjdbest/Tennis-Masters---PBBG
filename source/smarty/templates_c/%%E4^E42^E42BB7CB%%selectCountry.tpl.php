<?php /* Smarty version 2.6.26, created on 2010-08-11 11:15:50
         compiled from selectCountry.tpl */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
 
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en"> 
<head> 
 
<title>Tennis Masters - Academy</title>
<link href="style.css" rel="stylesheet" type="text/css" />


</head>
<body>
 
<div id="header">
	<div class="wrapper">
		<div id="logo">
			<a href="."><img src="assets/images/logov2.jpg" alt="Tennis Masters" /></a>
		</div>
		<div id="manage">
			<!--<img src="assets/images/manage.jpg" alt="Manage your own tennis academy!" />-->
			<h2>Online Tennis Management Game</h2>
			<h2><span>Manage your own tennis academy!</span></h2>
		</div>
	</div>
</div>
 
<div id="main">
	<div class="wrapper">
		<div id="content">
			<div id="main">
			<div id="left">
				<div class="info">
					<ul>
						<!--<li class="users"><span><?php echo $this->_tpl_vars['users']; ?>
 </span> online user(s)</li>-->
						<li class="time"><div class="jclock"></div></li>
					</ul>
				</div>
				
				<!--
				<div class="yellow">
					<span>Today is</span> <strong>Day <?php echo $this->_tpl_vars['day']; ?>
 </strong> of Season <?php echo $this->_tpl_vars['season']; ?>
</span>
				</div>
				
				<div class="block-top"></div>-->
				<br />
				
				
			</div>
			<div id="right">
				

	<?php if ($this->_tpl_vars['message'] == ''): ?>
<form method='post' action='selectCountry.php'>
<fieldset>
<legend>Select Your Country</legend>
<br />
<table width="100%" border="1" cellpadding="1" cellspacing="0" id="countryTable">
<tr class="tableHeader"> 
    <td width="20%">Country </td>
  <td width="10%">Free Slots</td>
  <td width="15%">Match Sim Time</td>
  <td width="10%">Your Choice</td>
</tr>
<?php unset($this->_sections['id']);
$this->_sections['id']['name'] = 'id';
$this->_sections['id']['loop'] = is_array($_loop=$this->_tpl_vars['countrydata']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
  <td><div align="left"><?php echo $this->_tpl_vars['countrydata'][$this->_sections['id']['index']]['countryname']; ?>
</div></td>
  <td><div align="center"><?php echo $this->_tpl_vars['countrydata'][$this->_sections['id']['index']]['free']; ?>
</div></td>
  <td><div align="center"><?php echo $this->_tpl_vars['countrydata'][$this->_sections['id']['index']]['time']; ?>
</div></td>
  <td><div align="center"><input type="radio" name="country" value="<?php echo $this->_sections['id']['index']; ?>
" /></div></td>
</tr>
<?php endfor; endif; ?>
</table>
<input type='submit' value='Select' /> <br />
<?php if ($this->_tpl_vars['error'] != ""): ?>
			<span style='color:red'>Error: <?php echo $this->_tpl_vars['error']; ?>
</span>
<?php endif; ?>
<?php else: ?>
  <span style='color:blue'><?php echo $this->_tpl_vars['message']; ?>
 <a href="index.php">Click here to continue.</a></span>
 <?php endif; ?>
</fieldset>
</form>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "validuserFooter.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

</html>