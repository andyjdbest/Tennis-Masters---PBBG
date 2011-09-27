{include file="validuserHeader.tpl"}
{if $fire_message ne ''}
	<div class='error'>{$fire_message}</div>	
{/if}

<span>Academy <a href="viewAcademy.php?academy={$idteam}"><b>{$team_name}</b></a> in <a href="viewLeague.php?league={$idleague}"><b>{$league_name}</b></a> League</span>
<h1>Academy Players</h1>
<table width="100%" border="1" cellpadding="1" cellspacing="0" id="academy"> 
<thead>
	<tr class="tableHeader">

 <th width="30%">Name</th>
   <th width="10%">Rank</th>
  <th width="15%"><center>Age</center></th>
  <th width="15%"><center>Playing Hand</center></th>
  <th width="15%"><center>Fitness</center></th>
  <th width="15%"><center>Rating</center></th>
  	</tr>
</thead>

{section name=id loop=$playerdata}
<tr>
  {if $playerdata[id].id_player > 0}
    <td class="nam"><a href="viewPlayer.php?playerid={$playerdata[id].idplayer}"><SPAN STYLE="color: green;">{$playerdata[id].playername}</span></a></td> 
	{else}
	<td class="nam"><a href="viewPlayer.php?playerid={$playerdata[id].idplayer}">{$playerdata[id].playername}</a></td> 
	{/if}
    <td><div align="center">{$playerdata[id].rank}</div></td>
  <td><div align="center">{$playerdata[id].age}</div></td>
  <td><div align="center">{$playerdata[id].handed}</div></td>
  <td><div align="center">{$playerdata[id].fitness}</div></td>
  <td><div align="center">{$playerdata[id].srating}</div></td>
</tr>
{/section}
</table>

<br />
<h1>Fixture Information</h1>
<table width="100%" border="1" cellpadding="1" cellspacing="0" id="fixtures"> 
<tr class="tableHeader t">
  <th width="15%">Type</th>
  <th width="15%">Date</th>
  <th width="40%">Fixture</th>
  <th width="15%">Court</th>
  <th width="15%">Set Tactics</th>
</tr>
{section name=id loop=$fixturedata}
<tr>
 <td class="nam">{$fixturedata[id].name_fixture}</td>
  <td><div align="center">{$fixturedata[id].round_date}</div></td>
  <td><div align="center"><a href="fixtures.php?fixtureid={$fixturedata[id].id_fixture}">{$fixturedata[id].fixture}</a>
  {if $ts[id] eq 1}<b>*</b>{/if}</div></td>
  <td><div align="center">{$fixturedata[id].court}</div></td>
  <td><div align="center"><a href="viewTactics.php?fixtureid={$fixturedata[id].id_fixture}" class="set">Set Tactics</a></div></td>
</tr>
{/section}
</table>

 
				
{include file="validuserFooter.tpl"}

{literal}
<script type="text/javascript"> 
$(document).ready(function()     
{         
$("#academy").tablesorter();     
}); 
</script>
{/literal}
</html>