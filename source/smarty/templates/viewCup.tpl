{include file="validuserHeader.tpl"}

{$cupName}
{if $onGoing == 1}
<table width="100%" border="1" cellpadding="1" cellspacing="0" id="fixtures"> 
<thead>
<tr>
<td width="20%">Round 1</td>
<td width="20%">Round 2</td>
<td width="20%">Round 3</td>
<td width="20%">QF</td>
<td width="20%">SF</td>
<td width="20%">Finals</td>
</thead>
<tr>
 <td><b>{$round1[0].round_date}</b></td>
 <td><b>{$round2[0].round_date}</b></td>
 <td><b>{$round3[0].round_date}</b></td>
 <td><b>{$round4[0].round_date}</b></td>
 <td><b>{$round5[0].round_date}</b></td>
 <td><b>{$round6[0].round_date}</b></td>
</tr>
<tr>
 <td><a href="viewMatchSummary.php?matchID={$round1[0][2]}">{$round1[0].p1Name} <br /> {$round1[0].p2Name}</a></td>
 <td></td>
 <td></td>
 <td></td>
 <td></td>
 <td></td>
</tr>
<tr>
 <td><a href="viewMatchSummary.php?matchID={$round1[1][2]}">{$round1[1].p1Name} <br /> {$round1[1].p2Name}</a></td>
 <td><a href="viewMatchSummary.php?matchID={$round2[0][2]}">{$round2[0].p1Name} <br /> {$round2[0].p2Name}</a></td>
 <td></td>
 <td></td>
 <td></td>
 <td></td>
</tr>
<tr>
 <td><a href="viewMatchSummary.php?matchID={$round1[2][2]}">{$round1[2].p1Name} <br /> {$round1[2].p2Name}</a></td>
 <td></td>
<td><a href="viewMatchSummary.php?matchID={$round3[0][2]}">{$round3[0].p1Name} <br /> {$round3[0].p2Name}</a></td>
 <td></td>
 <td></td>
 <td></td>
</tr>
<tr>
 <td><a href="viewMatchSummary.php?matchID={$round1[3][2]}">{$round1[3].p1Name} <br /> {$round1[3].p2Name}</a></td>
 <td><a href="viewMatchSummary.php?matchID={$round2[1][2]}">{$round2[1].p1Name} <br /> {$round2[1].p2Name}</a></td>
 <td></td>
 <td></td>
 <td></td>
 <td></td>
</tr>
<tr>
 <td><a href="viewMatchSummary.php?matchID={$round1[4][2]}">{$round1[4].p1Name} <br /> {$round1[4].p2Name}</a></td>
 <td></td>
 <td></td>
 <td></td>
 <td></td>
 <td></td>
</tr>
<tr>
 <td><a href="viewMatchSummary.php?matchID={$round1[5][2]}">{$round1[5].p1Name} <br /> {$round1[5].p2Name}</a></td>
 <td><a href="viewMatchSummary.php?matchID={$round2[2][2]}">{$round2[2].p1Name} <br /> {$round2[2].p2Name}</a></td>
<td><a href="viewMatchSummary.php?matchID={$round3[1][2]}">{$round3[1].p1Name} <br /> {$round3[1].p2Name}</a></td>
 <td></td>
 <td></td>
 <td></td>
</tr>
<tr>
 <td><a href="viewMatchSummary.php?matchID={$round1[6][2]}">{$round1[6].p1Name} <br /> {$round1[6].p2Name}</a></td>
 <td></td>
 <td></td>
<td><a href="viewMatchSummary.php?matchID={$round4[0][2]}">{$round4[0].p1Name} <br /> {$round4[0].p2Name}</a></td>
 <td></td>
 <td></td>
</tr>
<tr>
 <td><a href="viewMatchSummary.php?matchID={$round1[7][2]}">{$round1[7].p1Name} <br /> {$round1[7].p2Name}</a></td>
 <td><a href="viewMatchSummary.php?matchID={$round2[3][2]}">{$round2[3].p1Name} <br /> {$round2[3].p2Name}</a></td>
 <td></td>
 <td></td>
<td><a href="viewMatchSummary.php?matchID={$round5[0][2]}">{$round5[0].p1Name} <br /> {$round5[0].p2Name}</a></td>
 <td></td>
</tr>
<tr>
 <td><a href="viewMatchSummary.php?matchID={$round1[8][2]}">{$round1[8].p1Name} <br /> {$round1[8].p2Name}</a></td>
 <td></td>
<td><a href="viewMatchSummary.php?matchID={$round3[2][2]}">{$round3[2].p1Name} <br /> {$round3[2].p2Name}</a></td>
<td><a href="viewMatchSummary.php?matchID={$round4[1][2]}">{$round4[1].p1Name} <br /> {$round4[1].p2Name}</a></td>
 <td></td>
<td><a href="viewMatchSummary.php?matchID={$round6[0][2]}">{$round6[0].p1Name} <br /> {$round6[0].p2Name}</a></td>
</tr>
<tr>
 <td><a href="viewMatchSummary.php?matchID={$round1[9][2]}">{$round1[9].p1Name} <br /> {$round1[9].p2Name}</a></td>
 <td><a href="viewMatchSummary.php?matchID={$round2[4][2]}">{$round2[4].p1Name} <br /> {$round2[4].p2Name}</a></td>
 <td></td>
 <td></td>
<td><a href="viewMatchSummary.php?matchID={$round5[1][2]}">{$round5[1].p1Name} <br /> {$round5[1].p2Name}</a></td>
 <td></td>
</tr>
<tr>
 <td><a href="viewMatchSummary.php?matchID={$round1[10][2]}">{$round1[10].p1Name} <br /> {$round1[10].p2Name}</a></td>
 <td></td>
 <td></td>
 <td></td>
 <td></td>
 <td></td>
</tr>
<tr>
 <td><a href="viewMatchSummary.php?matchID={$round1[11][2]}">{$round1[11].p1Name} <br /> {$round1[11].p2Name}</a></td>
 <td><a href="viewMatchSummary.php?matchID={$round2[5][2]}">{$round2[5].p1Name} <br /> {$round2[5].p2Name}</a></td>
<td><a href="viewMatchSummary.php?matchID={$round3[3][2]}">{$round3[3].p1Name} <br /> {$round3[3].p2Name}</a></td>
<td><a href="viewMatchSummary.php?matchID={$round4[2][2]}">{$round4[2].p1Name} <br /> {$round4[2].p2Name}</a></td>
 <td></td>
 <td></td>
</tr>
<tr>
 <td><a href="viewMatchSummary.php?matchID={$round1[12][2]}">{$round1[12].p1Name} <br /> {$round1[12].p2Name}</a></td>
 <td></td>
 <td></td>
 <td></td>
 <td></td>
 <td></td>
</tr>
<tr>
 <td><a href="viewMatchSummary.php?matchID={$round1[13][2]}">{$round1[13].p1Name} <br /> {$round1[13].p2Name}</a></td>
 <td><a href="viewMatchSummary.php?matchID={$round2[6][2]}">{$round2[6].p1Name} <br /> {$round2[6].p2Name}</a></td>
 <td></td>
 <td></td>
 <td></td>
 <td></td>
</tr>
<tr>
 <td><a href="viewMatchSummary.php?matchID={$round1[14][2]}">{$round1[14].p1Name} <br /> {$round1[14].p2Name}</a></td>
 <td></td>
<td><a href="viewMatchSummary.php?matchID={$round3[4][2]}">{$round3[4].p1Name} <br /> {$round3[4].p2Name}</a></td>
<td><a href="viewMatchSummary.php?matchID={$round4[3][2]}">{$round4[3].p1Name} <br /> {$round4[3].p2Name}</a></td>
 <td></td>
 <td></td>
</tr>
<tr>
 <td><a href="viewMatchSummary.php?matchID={$round1[15][2]}">{$round1[15].p1Name} <br /> {$round1[15].p2Name}</a></td>
 <td><a href="viewMatchSummary.php?matchID={$round2[7][2]}">{$round2[7].p1Name} <br /> {$round2[7].p2Name}</a></td>
 <td></td>
 <td></td>
 <td></td>
 <td></td>
</tr>
<tr>
 <td><a href="viewMatchSummary.php?matchID={$round1[16][2]}">{$round1[16].p1Name} <br /> {$round1[16].p2Name}</a></td>
 <td></td>
 <td></td>
 <td></td>
 <td></td>
 <td></td>
</tr>
<tr>
 <td><a href="viewMatchSummary.php?matchID={$round1[17][2]}">{$round1[17].p1Name} <br /> {$round1[17].p2Name}</a></td>
 <td><a href="viewMatchSummary.php?matchID={$round2[8][2]}">{$round2[8].p1Name} <br /> {$round2[8].p2Name}</a></td>
<td><a href="viewMatchSummary.php?matchID={$round3[5][2]}">{$round3[5].p1Name} <br /> {$round3[5].p2Name}</a></td>
 <td></td>
 <td></td>
 <td></td>
</tr>
<tr>
 <td><a href="viewMatchSummary.php?matchID={$round1[18][2]}">{$round1[18].p1Name} <br /> {$round1[18].p2Name}</a></td>
 <td></td>
 <td></td>
 <td></td>
 <td></td>
 <td></td>
</tr>
<tr>
 <td><a href="viewMatchSummary.php?matchID={$round1[19][2]}">{$round1[19].p1Name} <br /> {$round1[19].p2Name}</a></td>
 <td><a href="viewMatchSummary.php?matchID={$round2[9][2]}">{$round2[9].p1Name} <br /> {$round2[9].p2Name}</a></td>
 <td></td>
 <td></td>
 <td></td>
 <td></td>
</tr>
<tr>
 <td><a href="viewMatchSummary.php?matchID={$round1[20][2]}">{$round1[20].p1Name} <br /> {$round1[20].p2Name}</a></td>
 <td></td>
<td><a href="viewMatchSummary.php?matchID={$round3[6][2]}">{$round3[6].p1Name} <br /> {$round3[6].p2Name}</a></td>
 <td></td>
 <td></td>
 <td></td>
</tr>
<tr>
 <td><a href="viewMatchSummary.php?matchID={$round1[21][2]}">{$round1[21].p1Name} <br /> {$round1[21].p2Name}</a></td>
 <td><a href="viewMatchSummary.php?matchID={$round2[10][2]}">{$round2[10].p1Name} <br /> {$round2[10].p2Name}</a></td>
 <td></td>
 <td></td>
 <td></td>
 <td></td>
</tr>
<tr>
 <td><a href="viewMatchSummary.php?matchID={$round1[22][2]}">{$round1[22].p1Name} <br /> {$round1[22].p2Name}</a></td>
 <td></td>
 <td></td>
 <td></td>
 <td></td>
 <td></td>
</tr>
<tr>
 <td><a href="viewMatchSummary.php?matchID={$round1[23][2]}">{$round1[23].p1Name} <br /> {$round1[23].p2Name}</a></td>
 <td><a href="viewMatchSummary.php?matchID={$round2[11][2]}">{$round2[11].p1Name} <br /> {$round2[11].p2Name}</a></td>
<td><a href="viewMatchSummary.php?matchID={$round3[7][2]}">{$round3[7].p1Name} <br /> {$round3[7].p2Name}</a></td>
 <td></td>
 <td></td>
 <td></td>
</tr>
<tr>
 <td><a href="viewMatchSummary.php?matchID={$round1[24][2]}">{$round1[24].p1Name} <br /> {$round1[24].p2Name}</a></td>
 <td></td>
 <td></td>
 <td></td>
 <td></td>
 <td></td>
</tr>
<tr>
 <td><a href="viewMatchSummary.php?matchID={$round1[25][2]}">{$round1[25].p1Name} <br /> {$round1[25].p2Name}</a></td>
 <td><a href="viewMatchSummary.php?matchID={$round2[12][2]}">{$round2[12].p1Name} <br /> {$round2[12].p2Name}</a></td>
 <td></td>
 <td></td>
 <td></td>
 <td></td>
</tr>
<tr>
 <td><a href="viewMatchSummary.php?matchID={$round1[26][2]}">{$round1[26].p1Name} <br /> {$round1[26].p2Name}</a></td>
 <td></td>
<td><a href="viewMatchSummary.php?matchID={$round3[8][2]}">{$round3[8].p1Name} <br /> {$round3[8].p2Name}</a></td>
 <td></td>
 <td></td>
 <td></td>
</tr>
<tr>
 <td><a href="viewMatchSummary.php?matchID={$round1[27][2]}">{$round1[27].p1Name} <br /> {$round1[27].p2Name}</a></td>
 <td><a href="viewMatchSummary.php?matchID={$round2[13][2]}">{$round2[13].p1Name} <br /> {$round2[13].p2Name}</a></td>
 <td></td>
 <td></td>
 <td></td>
 <td></td>
</tr>
<tr>
 <td><a href="viewMatchSummary.php?matchID={$round1[28][2]}">{$round1[28].p1Name} <br /> {$round1[28].p2Name}</a></td>
 <td></td>
<td></td>
 <td></td>
 <td></td>
 <td></td>
</tr>
<tr>
 <td><a href="viewMatchSummary.php?matchID={$round1[29][2]}">{$round1[29].p1Name} <br /> {$round1[29].p2Name}</a></td>
 <td><a href="viewMatchSummary.php?matchID={$round2[14][2]}">{$round2[14].p1Name} <br /> {$round2[14].p2Name}</a></td>
 <td></td>
 <td></td>
 <td></td>
 <td></td>
</tr>
<tr>
 <td><a href="viewMatchSummary.php?matchID={$round1[30][2]}">{$round1[30].p1Name} <br /> {$round1[30].p2Name}</a></td>
 <td></td>
 <td></td>
 <td></td>
 <td></td>
 <td></td>
</tr>
<tr>
 <td><a href="viewMatchSummary.php?matchID={$round1[31][2]}">{$round1[31].p1Name} <br /> {$round1[31].p2Name}</a></td>
 <td><a href="viewMatchSummary.php?matchID={$round2[15][2]}">{$round2[15].p1Name} <br /> {$round2[15].p2Name}</a></td>
 <td></td>
 <td></td>
 <td></td>
 <td></td>
</tr>
</table>

{else}
<span>Past Winners</span>


<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
{/if}
			
{include file="validuserFooter.tpl"}
</html>