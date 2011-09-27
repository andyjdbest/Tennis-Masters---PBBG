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
						<li class="users"><span>{$users} </span> online user(s)</li>
						<li class="time"><div class="jclock"></div></li>
					</ul>
				</div>
				<div class="yellow">
					<strong>Day {$day} </strong> of Season {$season}
				</div>
				<div class="block-bottom"></div>
				
			</div>
			<div id="right">
				{if $loggedin eq 1}		
						<div align="right">{if $member eq 1}{$credits} credits <img src="assets/images/gold1.png" />{/if}<a href='.'>Membership</a></div>
						{include file="validuserTopCSSMenu.tpl"}
				{else}
                                               <p class="big"><a href=''>Register</a> or <a href='index.php'>Login</a></p>   
{/if}
                                  
				<h3>Membership</h3>
Thank you for your payment. Your transaction has been completed, and a receipt for your purchase has been emailed to you. You may log into your account at www.paypal.com to view details of this transaction.
<br /> We will add your credits as soon as we receive confirmation of your payment.


<br /><br />				
				
				
				
				




	

{include file="validuserFooter.tpl"}

</html>