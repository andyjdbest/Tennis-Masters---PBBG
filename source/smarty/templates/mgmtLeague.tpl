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
$("#league").tablesorter();     
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
<form method="post" action="mgmtLeague.php">
<fieldset>
<legend>League Setup per Country</legend>
<br />
{html_options name=countryL options=$countries selected=$smarty.post.countryL}
<input type='submit' value='Check' name='Show' /> <br />
<span color=red>{$error} </span> <br />
<table border="1" id="league">
<thead>
<tr>
  <th>LeagueID</th>
  <th>LeagueName</th>
  <th>League Position</th>
</tr>
</thead>
{section name=id loop=$leaguedata}
<tr>
  <td><a href='viewLeague.php?league={$leaguedata[id]->idleague}'>{$leaguedata[id]->idleague}</a></td>
  <td>{$leaguedata[id]->nameleague}</td>
  <td>{$leaguedata[id]->league_pos}</td>
</tr>
{/section}
</table>
</fieldset>
</form>
<br />
<form method="post" action="mgmtLeague.php">
<fieldset>
<legend>Academy Setup</legend>
<br />
{html_options name=countryAcademy options=$countries selected=$smarty.post.countryAcademy} <br />

Number: <input type='text' name='number' id='number'  /> 

<input type='submit' value='Create Academies' name='CreateAcademy' /> <br />

<span color='red'>{$errorCreateAcademy} </span>
<span color='green''>{$messageCreateAcademy} </span> <br />


{html_options name=countrySM options=$countries selected=$smarty.post.countrySM}

<input type='submit' value='Assign Senior Players to Academy' name='SeniorAcademy' /> <br />

<span color='red'>{$errorSeniorAcademy} </span>
<span color='green''>{$messageSeniorAcademy} </span> <br />
</fieldset>
<br />

<fieldset>
<legend>League Setup</legend>
<br />
{html_options name=countryA options=$countries selected=$smarty.post.countryA}

<input type='submit' value='Assign Academies to Leagues' name='AddAcademy' /> <br />

<span color=red>{$errorLeague} </span> 
<span color=green>{$messageLeague} </span> <br />


{html_options name=countryF options=$countries selected=$smarty.post.countryF} Enter time: <input type='text' name='time' />

<input type='submit' value='Generate Fixtures' name='GenFix' /> <br />

<span color=red>{$errorFixtures} </span> 
<span color=red>{$messageFixtures} </span> <br />
{html_options name=countryP options=$countries selected=$smarty.post.countryP} 

<input type='submit' value='Promote Demote' name='Promo' /> <br />

<span color=red>{$errorPromo} </span> <br />

</fieldset>
<br />
</form>


<form method="post" action="mgmtLeague.php">
<fieldset>
<legend>Knock Out</legend>
<br />
{html_options name=knockOut options=$knockOutOptions selected=$smarty.post.knockOut} <br />

1st Game Date Time: <input type='text' name='kdateTime'   /> 

<input type='submit' value='Generate Fixtures' name='knockout' /> <br />

 
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