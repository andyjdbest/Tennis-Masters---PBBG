<?php /* Smarty version 2.6.26, created on 2010-09-21 07:34:55
         compiled from validuserHeader.tpl */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
 
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en"> 
<head> 
 
<title>Tennis Masters - Online Persistent Browser Based Game</title>

<link href="style.css" rel="stylesheet" type="text/css" />

</head>
<body>
 
<div id="header">
	<div class="wrapper">
		<div id="logo">
			<a href="."><img src="assets/images/logov2.jpg" alt="Tennis Masters" /></a>
		</div>
		<div id="manage">
			
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
						
						<li class="time"><div class="jclock"></div></li>
						<li></li>
						<li><strong>Day <?php echo $this->_tpl_vars['day']; ?>
 </strong> of Season <?php echo $this->_tpl_vars['season']; ?>
</li>
					</ul>
				</div>
				
				
				
			</div>
			<div id="right">
<div class="block-middle"> <div align="right"><?php if ($this->_tpl_vars['member'] == 1): ?><?php echo $this->_tpl_vars['credits']; ?>
 credits <img src="assets/images/gold1.png" /><?php endif; ?><a href='membership.php'>Membership</a></div>
					
					<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "validuserTopCSSMenu.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<br />
</div>				