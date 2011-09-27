{include file="validuserHeader.tpl"}

<h1>Fixture Detail</h1>
<a href="viewAcademy.php?academy={$fixtureData[0][3]}">{$fixtureData[0][4]}</a> <b>{$fixtureScore[0]} </b> - <b> {$fixtureScore[1]} </b> <a href="viewAcademy.php?academy={$fixtureData[0][5]}">{$fixtureData[0][6]}</a><br />
{$fixtureData[0][2]} match played on {$fixtureData[0][1]} on a {$fixtureData[0][7]} court at {$fixtureData[0][9]}
<br /><br />

{if $matchData[0][0] > 0}
<h3>Individual Matches</h3>
<table width="60%" border="1" cellpadding="1" cellspacing="0" id="matches"> 
{section name=id loop=$matchData}
<tr>
 <td class="nam"><a href="viewPlayer.php?playerid={$matchData[id].id_player1}">{$matchData[id].p1_name}</a></td>
  <td><div align="left"><a href="viewMatchSummary.php?matchID={$matchData[id].id_match}">v/s</a></div></td>
  <td class="nam"><div align="right"><a href="viewPlayer.php?playerid={$matchData[id].id_player2}">{$matchData[id].p2_name}</a></div></td>
  <td><a href="viewMatchCommentary.php?matchID={$matchData[id].id_match}"><DIV ALIGN="center" STYLE="color:blue">Play-by-Play</div></a></td> 
</tr>
{/section}
</table>
<br />

<a href="viewFixtureTactics.php?fixtureid={$fixtureData[0][0]}">View Fixture Tactics</a><br />
 Click on the v/s for score-card and match statistics<br />
 Click on Play-by-Play for match commentary<br />
{/if}		
<br /><br /><br /><br /><br /><br /><br /><br />	
{include file="validuserFooter.tpl"}

</html>