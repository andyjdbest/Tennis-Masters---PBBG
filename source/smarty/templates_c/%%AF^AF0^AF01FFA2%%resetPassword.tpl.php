<?php /* Smarty version 2.6.26, created on 2010-07-13 10:30:56
         compiled from resetPassword.tpl */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en"> 
<head> 
<title>Tennis Masters - Online Tennis Management Game</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="style.css" rel="stylesheet" type="text/css" />

</head>

<body>
	
	
<div id="header">
	<div class="wrapper">
		<div id="logo">
			<a href="/"><img src="assets/images/logov2.jpg" alt="Tennis Masters" /></a>
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
					</ul>
				</div>
				<div class="yellow">
					Season <?php echo $this->_tpl_vars['season']; ?>

				</div>
				<?php if ($this->_tpl_vars['loggedin'] == 1): ?>
				<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "validuserMenu.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
				<?php else: ?>
				
				<?php endif; ?>
				<div class="block-bottom"></div>
				
			</div>
			<div id="right">
				<?php if ($this->_tpl_vars['loggedin'] == 1): ?>		
						<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "validuserTopCSSMenu.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
				<?php else: ?>
                                               <p class="big"><a href=''>Register</a> or <a href='index.php'>Login</a></p>   
				<?php endif; ?>
                                  
				<p>
				
				<?php if ($this->_tpl_vars['change'] == 0): ?>
				<form method="post" action="resetPassword.php">
				Enter new password: <input type='password' name='password'>
				<input type='submit' value='Submit'> <br />
				<?php echo $this->_tpl_vars['message']; ?>

				<?php else: ?>
							
				<?php echo $this->_tpl_vars['message']; ?>
 Click <a href="index.php">here</a> to login.
				<?php endif; ?>
				</form>
				
				

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "validuserFooter.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

</html>