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
$("#player").tablesorter();     
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
<H4>Players</H4>
<H4></H4>
<form method='post' action='mgmtPlayer.php'>
<fieldset>
<legend>Add New Player(s)</legend>
<label name="country">CountryAbbrev:</label> <input type='text' name='country' id='shortname'  /><br />
<label name="number">NumberofPlayers:</label> <input type='text' name='number' id='number'  /><br />
<label name="amin">Age MIN (17):</label> <input type='text' name='min_age' id='min_age'  /><br />
<label name="amax">Age MAX (30):</label> <input type='text' name='max_age' id='max_age'  /><br />
<label name="smin">Stats MIN (1):</label> <input type='text' name='min_stat' id='min_stat'  /><br />
<label name="smax">Stats MAX (15):</label> <input type='text' name='max_stat' id='max_stat'  /><br />
<label name="youth">Senior - 0 / Youth - 1:</label> <input type='text' name='youth' id='youth'  /><br />
<label name="free">FreeAgent - 1 / Normal - 0:</label> <input type='text' name='free' id='free' value ='0' /><br />
<input type='submit' value='Create' /> <br />  
{if $error ne ""}  
			<span style='color:red'>Error: {$error}</span>
{/if}
{if $message ne ""}
			<span style='color:green'>{$message}</span>
{/if}
</fieldset>
</form>

<H4>Players</H4>
<table border="1" id="player"> 
<thead>
<tr>
  <th>PID</th>
  <th>FirstName</th>
  <th>LastName</th>
  <th>Country</th>
  <th>Youth</th>
  <th>Serve</th>
  <th>Forehand</th>
  <th>Backhand</th>
  <th>Volley</th>
  <th>Cons</th>
  <th>Power</th>
  <th>Speed</th>
  <th>Stamina</th>
</tr>
</thead>
<p>Listing all Players takes too long, hence will not be shown.</p>
{section name=id loop=$playerdata}
<tr>
  <td>{$playerdata[id]->idplayer}</td>
  <td>{$playerdata[id]->firstname}</td>
  <td>{$playerdata[id]->lastname}</td>
  <td>{$playerdata[id]->countryshort}</td>
  <td>{$playerdata[id]->youth}</td>
  <td>{$playerdata[id]->serve}</td>
  <td>{$playerdata[id]->forehand}</td>
  <td>{$playerdata[id]->backhand}</td>
  <td>{$playerdata[id]->volley}</td>
  <td>{$playerdata[id]->consistency}</td>
  <td>{$playerdata[id]->power}</td>
  <td>{$playerdata[id]->speed}</td>
  <td>{$playerdata[id]->stamina}</td>
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