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
					Season {$season}
				</div>
				{if $loggedin eq 1}
				{include file="validuserMenu.tpl"}
				{else}
				
				{/if}
				<div class="block-bottom"></div>
				
			</div>
			<div id="right">
				{if $loggedin eq 1}		
						{include file="validuserTopCSSMenu.tpl"}
				{else}
                                               <p class="big"><a href=''>Register</a> or <a href='index.php'>Login</a></p>   
				{/if}
                                  
				<p>
				
				{if $change eq 0}
				<form method="post" action="resetPassword.php">
				Enter new password: <input type='password' name='password'>
				<input type='submit' value='Submit'> <br />
				{$message}
				{else}
							
				{$message} Click <a href="index.php">here</a> to login.
				{/if}
				</form>
				
				

{include file="validuserFooter.tpl"}

</html>