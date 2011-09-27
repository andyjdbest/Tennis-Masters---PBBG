<?xml version="1.0" encoding="utf-8"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">




<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
 <title>Login</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="includes/js/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="includes/js/jquery.jclock.js"></script>
<script type="text/javascript" src="includes/js/clock.js"></script>
               <script type='text/javascript'>
		document.getElementById('username').focus();
		</script>

</head>
<body>
<div id="wrapper">
<div id="header"></div>
<div id="container">
<div id="left">
<div class="jclock">Time</div>	
{if $error ne ""}
			<span style='color:red'>Error: {$error}</span>
                        
		{/if}
		
		<form method='post' action='login.php'>
			<label name="user">Username:</label> <input type='text' name='username' id='username' /><br />
			<label name="pass">Password:</label> <input type='password' name='password' /><br />
			<input type='submit' value='Login!' />
		</form>
<ul id="nav">
<li><a href="register.php" title="Register">Register</a></li>
</ul>

</div>
<div id="center">Placeholder

</div>
	


<div id="right">Test Right</div>
<div class="clearer"></div>

                
</div>
<div id="footer">website copyrights here</div>
</div>
	

</body>

</html>