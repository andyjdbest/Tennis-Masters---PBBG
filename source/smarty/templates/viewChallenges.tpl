{include file="validuserHeader.tpl"}

{$message}
<h1>View Accepted Challenges</h1>
<table>							
{section name=id loop=$challengeAData}
  <tr> 
    <td width="20%" class="nam"><div align="center"><a href="fixtures.php?fixtureid={$challengeAData[id].id_fixture}">{$challengeAData[id].fixture}</a></div></td> 
    <td width="30%"><div align="center">{$challengeAData[id].round_date}</div></td>  
  </tr> 
{/section}
</table>
<br />

<h1>View Pending Challenges</h1>
<table>							
{section name=id loop=$challengeData}
  <tr> 
    <td width="20%" class="nam"><div align="center"><a href="viewAcademy.php?academy={$challengeData[id].id_team1}">{$challengeData[id].team_name}</a></div></td> 
    <td width="30%"><div align="center">{$challengeData[id].date}</div></td> 
    <td width="20%"><div align="center"><a href="manageChallenge.php?type=accept&challenge={$challengeData[id].id_challenge}">Accept</a></div></td>
	<td width="20%"><div align="center"><a href="manageChallenge.php?type=decline&challenge={$challengeData[id].id_challenge}">Decline</a></div></td> 
  </tr> 
{/section}
</table>
<br />
 
 <h1>View Issued Challenges</h1>
<table>							
{section name=id loop=$challengeIData}
  <tr> 
    <td width="20%" class="nam"><div align="center"><a href="viewAcademy.php?academy={$challengeIData[id].id_team2}">{$challengeIData[id].team_name}</a></div></td> 
    <td width="30%"><div align="center">{$challengeIData[id].date}</div></td> 
  </tr> 
{/section}
</table>
<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />	
			

 {include file="validuserFooter.tpl"}
 {literal}
<script type="text/javascript"> 
$(document).ready(function()     
{         
$("#challenge").tablesorter();     
}); 
</script>
{/literal}
</html>