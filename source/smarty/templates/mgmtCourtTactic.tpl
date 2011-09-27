<?xml version="1.0" encoding="utf-8"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
 <title>Welcome</title>
<link href="style.css" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="../includes/js/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="http://tablesorter.com/jquery.tablesorter.min.js"></script>
{literal}
<script type="text/javascript"> 
$(document).ready(function()     
{         
$("#courtTable").tablesorter(); 
$("#tacticTable").tablesorter();  
$("#bonusTable").tablesorter();   
} 
); 
</script>
{/literal}
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
<p>Click on the link again to view the updated data. DO NOT PRESS REFRESH</p>
<H4>Courts</H4>

<form method='post' action='mgmtCourtTactic.php'>
<fieldset>
<legend>Add New Court</legend>
<label name="court">Court Type:</label> <input type='text' name='court' id='court'  /><br />
<input type='submit' value='Court Create' name='CourtCreate' /> <br />
{if $errorCourt ne ""}
			<span style='color:red'>Error: {$errorCourt}</span>
{/if}
{if $messageCourt ne ""}
			<span style='color:green'>{$messageCourt}</span>
{/if}
</fieldset>
</form>

<table border="1" id="courtTable">
</legend>
<thead>
<tr>
  <th>CourtID</th>
  <th>Court</th>
</tr>
</thead>
{section name=id loop=$courtdata}
<tr>
  <td>{$courtdata[id]->idcourttype}</td>
  <td>{$courtdata[id]->name}</td>
</tr>
{/section}
</table>


<H4>Tactics</H4>
<form method='post' action='mgmtCourtTactic.php'>
<fieldset>
<legend>Add New Tactic</legend>
<label name="tacticname">Tactic Name:</label> <input type='text' name='name' id='name'  /><br />
<label name="tacticshortname">Short Name:</label> <input type='text' name='shortname' id='shortname'  /><br />
<input type='submit' value='Tactic Create' name='TacticCreate' /> <br />
{if $errorTactic ne ""}
			<span style='color:red'>Error: {$errorTactic}</span>
{/if}
{if $messageTactic ne ""}
			<span style='color:green'>{$messageTactic}</span>
{/if}
</fieldset>
</form>

<table border="1" id="tacticTable">
<thead>
<tr>
  <th>TacticID</th>
  <th>Name</th>
  <th>Short</th>
</tr>
</thead>
{section name=id loop=$tacticdata}
<tr>
  <td>{$tacticdata[id]->idtactictype}</td>
  <td>{$tacticdata[id]->tacticname}</td>
  <td>{$tacticdata[id]->tacticshortname}</td>
</tr>
{/section}
</table>

<H4>Bonus</H4>
<form method='post' action='mgmtCourtTactic.php'>
<fieldset>
<legend>Add New Bonus</legend>
<label name="tacticname">Tactic Name:</label>
{html_options name=tacticname options=$tactics selected=$smarty.post.tacticname}
<br />
<label name="courtname">Court Name:</label> 
{html_options name=courtname options=$courts selected=$smarty.post.courtname}
<br />
<label name="stat">Stat Name:</label> 
{html_options name=statname options=$stats selected=$smarty.post.statname}  
<br />
<label name="bonus">Amount of Bonus:</label> <input type='text' name='bonusNum' id='bonusNum'  /><br />
<input type='submit' value='Bonus Create' name='BonusCreate' /> <br />
{if $errorBonus ne ""}
			<span style='color:red'>Error: {$errorBonus}</span>
{/if}
{if $messageBonus ne ""}
			<span style='color:green'>{$messageBonus}</span>
{/if}
</fieldset>
</form>

<table border="1" id="bonusTable">
<thead>
<tr>
  <th>Tactic</th>
  <th>Court</th>
  <th>Stat</th>
  <th>Bonus</th>
</tr>
</thead>
{section name=id loop=$bonusdata}
<tr>
  <td>{$bonusdata[id]->tacticname}</td>
  <td>{$bonusdata[id]->name}</td>
  <td>{$bonusdata[id]->stats}</td>
  <td>{$bonusdata[id]->bonus}</td>
</tr>
{/section} 
</table>
 
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