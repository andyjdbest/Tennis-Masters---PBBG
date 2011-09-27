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
						<!--<li class="users"><span>{$users} </span> online user(s)</li>-->
						<li class="time"><div class="jclock"></div></li>
					</ul>
				</div>
				
				<!--
				<div class="yellow">
					<span>Today is</span> <strong>Day {$day} </strong> of Season {$season}</span>
				</div>
				
				<div class="block-top"></div>-->
				<br />
				
				
			</div>
			<div id="right">
				

	{if $message eq ''}
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
{section name=id loop=$countrydata}
<tr>
  <td><div align="left">{$countrydata[id].countryname}</div></td>
  <td><div align="center">{$countrydata[id].free}</div></td>
  <td><div align="center">{$countrydata[id].time}</div></td>
  <td><div align="center"><input type="radio" name="country" value="{$smarty.section.id.index}" /></div></td>
</tr>
{/section}
</table>
<input type='submit' value='Select' /> <br />
{if $error ne ""}
			<span style='color:red'>Error: {$error}</span>
{/if}
{else}
  <span style='color:blue'>{$message} <a href="index.php">Click here to continue.</a></span>
 {/if}
</fieldset>
</form>

{include file="validuserFooter.tpl"}

</html>