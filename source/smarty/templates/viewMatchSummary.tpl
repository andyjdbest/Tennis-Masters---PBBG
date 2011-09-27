{include file="validuserHeader.tpl"}

<h1>Match Detail</h1>
{if $matchData.fixture_type < 3}
<a href="viewAcademy.php?academy={$matchData.a1_id}">{$matchData.a1_name}</a> 
<a href="fixtures.php?fixtureid={$matchData.id_fixture}">versus</a> <a href="viewAcademy.php?academy={$matchData.a2_id}">{$matchData.a2_name}</a><br />
{/if}
{$matchData.name_fixture} match played on {$matchData.round_date} on a {$matchData.name} court
<br /><br />

<table cellspacing='20' class="Score">
<thead>
<tr class="tableHeader">
<th class="Corner">Score</th>
<th colspan=5>1</th>
<th colspan=5>2</th>
<th colspan=5>3</th>
</tr>
</thead>

<tbody>
<tr>
<th><a href="viewPlayer.php?playerid={$matchData.id_player1}">{$matchData.p1_name}</a>
{if $matchData.id_player1 == $matchData.id_winner}<img src="assets/images/winner.gif" />{/if}
</th>

<th colspan=5>{$playerScore[0][0]}</td>
<th colspan=5>{$playerScore[0][1]}</td>
<th colspan=5>{$playerScore[0][2]}</td>
</tr>

<tr>
<th><a href="viewPlayer.php?playerid={$matchData.id_player2}">{$matchData.p2_name}</a>
{if $matchData.id_player2 == $matchData.id_winner}<img src="assets/images/winner.gif" />{/if}</th>
<th colspan=5>{$playerScore[1][0]}</td>
<th colspan=5>{$playerScore[1][1]}</td>
<th colspan=5>{$playerScore[1][2]}</td>
</tr>

</tbody>

</table>
<br/>


<table cellspacing='20' class="Score">
<thead>
<tr class="tableHeader">
<th class="Corner">Stats</th>
<th >{$matchData.p1_name}</th>
<th >{$matchData.p2_name}</th>
</tr>
</thead>

<tbody>
<tr>
<th><b>1st Serve %</b></th>
<td><div align="center">{$statsData[0][0]}</div></td>
<td><div align="center">{$statsData[1][0]}</div></td>
</tr>
<tr>
<th><b>Aces</b></th>
<td><div align="center">{$statsData[0][1]}</div></td>
<td><div align="center">{$statsData[1][1]}</div></td>
</tr>
<tr>
<th><b>Double Faults</b></th>
<td><div align="center">{$statsData[0][2]}</div></td>
<td><div align="center">{$statsData[1][2]}</div></td>
</tr>
<tr>
<th><b>Unforced Errors</b></th>
<td><div align="center">{$statsData[0][3]}</div></td>
<td><div align="center">{$statsData[1][3]}</div></td>
</tr>
<tr>
<th><b>Winners</b></th>
<td><div align="center"></div></td>
<td><div align="center"></div></td>
</tr>

</tbody>

</table>
<br/><br>

				
{include file="validuserFooter.tpl"}

</html>