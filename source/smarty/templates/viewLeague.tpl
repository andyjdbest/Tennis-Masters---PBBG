{include file="validuserHeader.tpl"}

{section name=id loop=$leaguedata}
{if $tmp ne $leaguedata[id]->nameleague}
<h1>{$leaguedata[id]->nameleague} League Table</h1>
{assign var=tmp value=$leaguedata[id]->nameleague}
{/if}
{/section}
				
	<table width="100%" border="1" cellpadding="1" cellspacing="0" id="league">
		 
  <tr class="tableHeader"> 
    <td width="10%"><center>Rank</center></td> 
    <td width="40%"><center>Academy</center></td> 
    <td width="10%"><center>Played</center></td> 
    <td width="10%"><center>Won</center></td> 
    <td width="10%"><center>Lost</center></td> 
    <td width="10%"><center>Points</center></td> 
    <td width="10%"><center>Diff</center></td> 
  </tr> 
  
{section name=id loop=$leaguedata}
	{strip}
  <tr>  
    <td><div align="center">{$leaguedata[id]->rank}</div></td> 
    <td><div align="left"><a href='viewAcademy.php?academy={$leaguedata[id]->id_team}'>{$leaguedata[id]->team_name}</div></td>  
    <td><div align="center">{$leaguedata[id]->played}</div></td> 
    <td><div align="center">{$leaguedata[id]->won}</div></td> 
    <td><div align="center">{$leaguedata[id]->lost}</div></td> 
    <td><div align="center">{$leaguedata[id]->points}</div></td> 
    <td><div align="center">{$leaguedata[id]->pr}</div></td> 
  </tr>
{/strip} 
{/section}
</table>  		

 
				
{include file="validuserFooter.tpl"}

{literal}
<script type="text/javascript"> 
$(document).ready(function()     
{         
$("#league").tablesorter();     
}); 
</script>
{/literal}
</html>