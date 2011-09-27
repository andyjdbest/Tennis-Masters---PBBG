<?xml version="1.0" encoding="utf-8"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
 <title>Stats & Fixtures</title>
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

<H4>Stat Values</H4>
<table border="1">
<tr>
  <th>ValueNum</th>
  <th>ValueName</th>
</tr>
{section name=id loop=$resultValue}
<tr>
  <td>{$resultValue[id]->valuenum}</td>
  <td>{$resultValue[id]->valuetext}</td>
</tr>
{/section}
</table>

<H4></H4>
<form method='post' action='mgmtStat.php'>
<fieldset>
<legend>Add New Stat Value</legend>
<label name="VauleNum">ValueNum:</label> <input type='text' name='valuenum' id='valuenum'  /><br />
<label name="ValueText">ValueText:</label> <input type='text' name='valuetext' id='valuetext'  /><br />
<input type='submit' value='Add Value' name='AddValue' />
</fieldset>
<br />
{if $errorValue ne ""}
			<span style='color:red'>Error: {$errorValue}</span>
{/if}
{if $messageValue ne ""}
			<span style='color:green'>{$messageValue}</span>
{/if}
</form>


<H4>Fixtures</H4>
<table border="1">
<tr>
  <th>Fixture ID</th>
  <th>Fixture Name</th>
</tr>
{section name=id loop=$fixturedata}
<tr>
  <td>{$fixturedata[id]->id_fixture}</td>
  <td>{$fixturedata[id]->name_fixture}</td>
</tr>
{/section}
</table>
<br />

<form method='post' action='mgmtStat.php'>
<fieldset>
<legend>Add New Fixture</legend>
<label name="fixId">Fixture ID:</label> <input type='text' name='fixID' id='fixID'  /><br />
<label name="fixName">Fixture Name:</label> <input type='text' name='fixName' id='fixName'  /><br />
<input type='submit' value='Add Fixture' name='AddFixture' />
</fieldset>
<br />
{if $errorFixture ne ""}
			<span style='color:red'>Error: {$errorFixture}</span>
{/if}
{if $messageFixture ne ""}
			<span style='color:green'>{$messageFixture}</span>
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