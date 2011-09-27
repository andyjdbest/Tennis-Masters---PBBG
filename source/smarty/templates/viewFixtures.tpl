{include file="validuserHeader.tpl"}

<ol id="toc">
	<li><a href="#aComplete">Academy Complete</a></li><!-- these comments between li's solve a problem in IE that prevents spaces appearing between list items that appear on different lines in the source
	--><li><a href="#aUpcoming">Academy Pending</a></li><!-- these comments between li's solve a problem in IE that prevents spaces appearing between list items that appear on different lines in the source
	--><li><a href="#pComplete">Player Complete</a></li><!-- these comments between li's solve a problem in IE that prevents spaces appearing between list items that appear on different lines in the source
	--><li><a href="#pUpcoming">Player Pending</a></li>
</ol>

<div class="tab" id="aComplete">
<h1>Completed Fixtures</h1>
<table width="100%" border="1" cellpadding="1" cellspacing="0" id="fixtures"> 
<tr class="tableHeader t">
  <th width="15%">Type</th>
  <th width="15%">Date</th>
  <th width="40%">Fixture</th>
  <th width="15%">Court</th>
</tr>
{section name=id loop=$completed}
<tr>
 <td class="nam">{$completed[id].name_fixture}</td>
  <td><div align="center">{$completed[id].round_date}</div></td>
  <td><div align="center"><a href="fixtures.php?fixtureid={$completed[id].id_fixture}">{$completed[id].fixture}</a></div></td>
  <td><div align="center">{$completed[id].court}</div></td>
</tr>
{/section}
</table>
</div>

<div class="tab" id="aUpcoming">
<h1>Upcoming Fixtures</h1>
<table width="100%" border="1" cellpadding="1" cellspacing="0" id="upcoming"> 
<tr class="tableHeader t">
  <th width="15%">Type</th>
  <th width="15%">Date</th>
  <th width="40%">Fixture</th>
  <th width="15%">Court</th>
  <th width="15%">Set Tactics</th>
</tr>
{section name=id loop=$upcoming}
<tr>
 <td class="nam">{$upcoming[id].name_fixture}</td>
  <td><div align="center">{$upcoming[id].round_date}</div></td>
  <td><div align="center"><a href="fixtures.php?fixtureid={$upcoming[id].id_fixture}">{$upcoming[id].fixture}  </a>
  {if $ts[id] eq 1}<b>*</b>{/if}
</div></td>
  <td><div align="center">{$upcoming[id].court}</div></td>
  <td><div align="center"><a href="viewTactics.php?fixtureid={$upcoming[id].id_fixture}" class="set">Set Tactics</a></div></td>
</tr>
{/section}
</table>
</div> 

<div class="tab" id="pComplete">
<table width="100%" border="1" cellpadding="1" cellspacing="0" id="fixtures"> 
<tr class="tableHeader t">
  <th width="15%">Type</th>
  <th width="15%">Date</th>
  <th width="40%">Fixture</th>
  <th width="15%">Round</th>
</tr>
{section name=id loop=$cPlayers}
<tr>
 <td class="nam">{$cPlayers[id].name_fixture}</td>
  <td><div align="center">{$cPlayers[id].round_date}</div></td>
  <td><div align="center"><a href="viewMatchSummary.php?matchID={$cPlayers[id].id_match}">{$cPlayers[id].game}</a></div></td>
  <td><div align="center">{$cPlayers[id].round + 1}</div></td>
</tr>
{/section}
</table>
</div>

<div class="tab" id="pUpcoming">
<table width="100%" border="1" cellpadding="1" cellspacing="0" id="pfixtures"> 
<tr class="tableHeader t">
  <th width="10%">Type</th>
  <th width="15%">Date</th>
  <th width="40%">Fixture</th>
  <th width="20%">Player</th>
  <th width="10%">Court</th>
  <th width="15%">Set Tactics</th>
</tr>
{section name=id loop=$uPlayers}
<tr>
 <td class="nam">{$uPlayers[id].name_fixture}</td>
  <td><div align="center">{$uPlayers[id].round_date}</div></td>
  <td><div align="center"><a href="viewMatchSummary.php?matchID={$uPlayers[id].id_match}">{$uPlayers[id].game}</a>
  {if $uPlayers[id].playerName1 ne ''}
  <td><div align="center">{$uPlayers[id].playerName1}</div></td>
  {/if}
  {if $uPlayers[id].playerName2 ne ''}
  <td><div align="center">{$uPlayers[id].playerName2}</div></td>
  {/if}
  <td><div align="center">{$uPlayers[id].court}</div></td>
  {if $uPlayers[id].playerName1 ne ''}
  <td><div align="center"><a href="viewTactics.php?matchid={$uPlayers[id].id_match}&playerid={$uPlayers[id].playerID1}" class="set">Set Tactics</a></div></td>
  {/if}
  {if $uPlayers[id].playerName2 ne ''}
  <td><div align="center"><a href="viewTactics.php?matchid={$uPlayers[id].id_match}&playerid={$uPlayers[id].playerID2}" class="set">Set Tactics</a></div></td>
  {/if}
</tr>
{/section}
</table>
</div>
<br /><br /><br /><br /><br /><br /><br />				
{include file="validuserFooter.tpl"}
{literal}
<script src="activatables.js" type="text/javascript"></script>
<script type="text/javascript">
activatables('page', ['aUpcoming', 'aComplete', 'pUpcoming', 'pComplete']);
</script>
{/literal}
</html>