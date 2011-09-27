<?xml version="1.0" encoding="utf-8"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
 <title>Welcome</title>
<link href="style.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="wrapper">
<div id="header">{include file="mgmtheader.tpl"}
</div>
<div id="container">
<div id="left">
<ul id="nav">
</ul>
</div>
<div id="center">
<H4>Countries & Managers</H4>
<table border="1">
<tr>
  <th>Country_Ab</th>
  <th>Country_Name</th>
  <th>Free Slots</th>
</tr>
{section name=id loop=$result}
<tr>
  <td>{$result[id]->countryshort}</td>
  <td>{$result[id]->countryname}</td>
  <td>{$result[id]->free}</td>
</tr>
{/section}
</table>
<H4></H4>
<form method='post' action='mgmtCountry.php'>
<fieldset>
<legend>Create New Country</legend>
<label name="short">ShortName:</label> <input type='text' name='shortname' id='shortname'  /><br />
<label name="fullname">FullName:</label> <input type='text' name='countryname' id='countryname'  /><br />

<input type='submit' value='Create' name = 'create'/> <br />
</fieldset>
{if $error ne ""}
			<span style='color:red'>Error: {$error}</span>
{/if}
{if $message ne ""}
			<span style='color:green'>{$message}</span>
{/if}
</form>
<BR />
<form method='post' action='mgmtCountry.php'>
<fieldset>
<legend>Create Nations Cup Fixtures</legend>
<label name="date">Date Time:</label> <input type='text' name='dateTime' id='dateTime'  /><br />
<input type='submit' value='Generate' name = 'genFix'/> <br />
</fieldset>
{if $error ne ""}
			<span style='color:red'>Error: {$error}</span>
{/if}
{if $message ne ""}
			<span style='color:green'>{$message}</span>
{/if}
</form>

		
</div>
<div id="right">Test Right</div>
<div class="clearer"></div>                
</div>
<div id="footer">{include file="mgmtfooter.tpl"}
</div>
</div>
</div>

</body>
</html>