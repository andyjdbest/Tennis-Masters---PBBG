<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
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
$("#allC").tablesorter();     
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
<form method="post" action="mgmtAlliances.php">
<fieldset>
<legend>Alliances to be Created</legend>
<br />
<span color=red>{$error} </span> <br />
<span color=red>{$message} </span> <br />
<table border="1" id="allC">
<thead>
<tr>
  <th>AllianceName</th>
  <th>UserName</th>
  <th>Balance Credits</th>
  <th>Member Till</th>
  <th>Approve</th>
  <th>Decline</th>
</tr>
</thead>
{section name=id loop=$newData}
<tr>
  <td>{$newData[id]->name}</td>
  <td>{$newData[id]->username}</td>
  <td>{$newData[id]->credits}</td>
  <td>{$newData[id]->memberTill}</td>
  <td><a href="mgmtApprove.php?type=1&r=1&id={$newData[id]->id_alliance}">Approve</a></td>
  <td><a href="mgmtApprove.php?type=1&r=0&id={$newData[id]->id_alliance}">Decline</a></td>
</tr>
{/section}
</table>
</fieldset>
</form>
<br />
<form method="post" action="mgmtAlliances.php">
<fieldset>
<legend>Players for Renames</legend>
<br />
<span color=red>{$error} </span> <br />
<span color=red>{$message} </span> <br />
<table border="1" id="players">
<thead>
<tr>
  <th>Old_Name</th>
  <th>Player_Name</th>
  <th>UserName</th>
  <th>Balance Credits</th>
  <th>Member Till</th>
  <th>Approve</th>
  <th>Decline</th>
</tr>
</thead>
{section name=id loop=$newPData}
<tr>
  <td>{$newPData[id]->old_value}</td>	
  <td>{$newPData[id]->new_value}</td>
  <td>{$newPData[id]->username}</td>
  <td>{$newPData[id]->credits}</td>
  <td>{$newPData[id]->memberTill}</td>
  <td><a href="mgmtApprove.php?type=2&r=1&id={$newPData[id]->id_nameChange}">Approve</a></td>
  <td><a href="mgmtApprove.php?type=2&r=0&id={$newPData[id]->id_nameChange}">Decline</a></td>
</tr>
{/section}
</table>
</fieldset>
</form>

<br />
<form method="post" action="mgmtAlliances.php">
<fieldset>
<legend>Courts for Renames</legend>
<br />
<span color=red>{$error} </span> <br />
<span color=red>{$message} </span> <br />
<table border="1" id="courts">
<thead>
<tr>
  <th>Old_Name</th>
  <th>New_Name</th>
  <th>UserName</th>
  <th>Balance Credits</th>
  <th>Member Till</th>
  <th>Approve</th>
  <th>Decline</th>
</tr>
</thead>
{section name=id loop=$newCData}
<tr>
  <td>{$newCData[id]->old_value}</td>	
  <td>{$newCData[id]->new_value}</td>
  <td>{$newCData[id]->username}</td>
  <td>{$newCData[id]->credits}</td>
  <td>{$newCData[id]->memberTill}</td>
  <td><a href="mgmtApprove.php?type=3&r=1&id={$newCData[id]->id_nameChange}">Approve</a></td>
  <td><a href="mgmtApprove.php?type=3&r=0&id={$newCData[id]->id_nameChange}">Decline</a></td>
</tr>
{/section}
</table>
</fieldset>
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