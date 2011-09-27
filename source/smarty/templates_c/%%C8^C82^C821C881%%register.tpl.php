<?php /* Smarty version 2.6.26, created on 2010-04-16 15:47:23
         compiled from register.tpl */ ?>
<?php echo '<?xml'; ?>
 version="1.0" encoding="utf-8"<?php echo '?>'; ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
 <title>Register</title>
<link href="style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="wrapper">
<div id="header"></div>
<div id="container">
<div id="left">
<ul id="nav">
<li><a href="login.php" title="Login">Login</a></li>
</ul>

</div>
<div id="center">
                
		<?php if ($this->_tpl_vars['message'] != ""): ?>
			<span style='color:black'><?php echo $this->_tpl_vars['message']; ?>
</span>
		<?php endif; ?>
                <?php if ($this->_tpl_vars['error'] != ""): ?>
			<span style='color:red'>Error: <?php echo $this->_tpl_vars['error']; ?>
</span>
		    
		<form method='post' action='register.php'>
                    <fieldset>
                        <legend>Registration</legend>
			<label name='name'>Username:</label><input type='text' name='username' id='username' value='<?php echo $_POST['username']; ?>
' /><br />
			<label name='pwd'>Password:</label><input type='password' name='password' /><br />
			<label name='cpwd'>Confirm Password:</label><input type='password' name='confirm' /><br />
			<input type='submit' value='Register!' />
                     </fieldset>   
		</form>
                <?php endif; ?>

</div>
<div id="right">Test Right</div>
<div class="clearer"></div>                
</div>
<div id="footer">website copyrights here</div>
</div>
</div>

<script type='text/javascript'>
		document.getElementById('username').focus();
		</script>



</body>s
</html>