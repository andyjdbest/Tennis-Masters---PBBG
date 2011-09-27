<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
 <title>Welcome</title>
<link href="../style.css" rel="stylesheet" type="text/css" />

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
		
{section name=id loop=$leaguedata}
{if $tmp ne $leaguedata[id]->nameleague}
	<H4>{$leaguedata[id]->nameleague} League Table</H4>
{assign var=tmp value=$leaguedata[id]->nameleague}
{/if}
{/section}

<table border="1" id="league">
<thead>
<tr>
  <th>Position</th>
  <th>Academy</th>
  <th>Played</th>
  <th>Won</th>
  <th>Lost</th>
  <th>Points</th>
</tr>
</thead>
{section name=id loop=$leaguedata}
{strip}
<tr>
  <td>{$smarty.section.id.index_next}</td>	
  <td><a href='viewAcademy.php?academy={$leaguedata[id]->id_team}'>{$leaguedata[id]->team_name}</a></td>
  <td>{$leaguedata[id]->played}</td>
  <td>{$leaguedata[id]->won}</td>
  <td>{$leaguedata[id]->lost}</td>
  <td>{$leaguedata[id]->points}</td> 
</tr>
{/strip}
{/section}
</table>

<br /> <br />
<h4>Fixtures</h4>
{assign var=tmp value=''}
{section name=id loop=$fixturedata}
{if $tmp ne $fixturedata[id]->round}
  <B>{$fixturedata[id]->round}.</B> <BR />
{assign var=tmp value=$fixturedata[id]->round}
{/if}
  <a href='viewAcademy.php?academy={$fixturedata[id]->t1id}'>{$fixturedata[id]->t1name}</a> v <a href='viewAcademy.php?academy={$fixturedata[id]->t2id}'>{$fixturedata[id]->t2name}</a> @ {$fixturedata[id]->name} <br />
{/section}

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