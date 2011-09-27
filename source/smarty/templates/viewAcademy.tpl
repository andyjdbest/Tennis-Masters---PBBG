{include file="validuserHeader.tpl"}

{if $manager_id ne ''}
<a href="challenge.php?academy={$id_team}"><img src="assets/images/action_go.gif" alt="Challenge"></a>
<span>Academy <a href="viewAcademy.php?academy={$id_team}"><b>{$team_name}</b></a> in <a href="viewLeague.php?league={$id_league}"><b>{$league_name}</b></a> League
managed by <a href="viewManagerInfo.php?user={$user}">{$manager_name}</a> </span>
{else}
<a href="challenge.php?academy={$id_team}"><img src="assets/images/action_go.gif" alt="Challenge"></a>
<span>Academy <a href="viewAcademy.php?academy={$id_team}"><b>{$team_name}</b></a> in <a href="viewLeague.php?league={$id_league}"><b>{$league_name}</b></a> League
- Unmanaged </span>
{/if}
<br />
{if $allID > 0}
<b>Alliance Member:</b> <a href='viewAlliance.php?alliance={$allID}'>{$alliance}</a><br />
{/if}
<b>Form > Last 5 Games:</b> {$form}
<br />
<b>Fans:</b> {$fans}{if $fan_move eq 1}<img src="assets/images/smiley.png" alt="Happy">
{else if $fan_move eq -1}<img src="assets/images/smiley_sad.png" alt="Sad">{/if}
<br />
<br />
<h1>Academy Players</h1>			
				
	<table width="100%" border="1" cellpadding="1" cellspacing="0" id="players">
		{if $own eq 1} 
<thead>
  <tr class="tableHeader"> 
    <td width="30%">Name</td> 
    <td width="10%"><center>Rank</center></th>
    <td width="15%"><center>Age</center></td> 
    <td width="15%"><center>Hand</center></td> 
    <td width="15%"><center>SRV</center></td> 
    <td width="15%"><center>VLY</center></td> 
    <td width="15%"><center>FHD</center></td> 
    <td width="15%"><center>BHD</center></td> 
    <td width="15%"><center>CON</center></td> 
    <td width="15%"><center>STM</center></td> 
    <td width="15%"><center>PWR</center></td> 
    <td width="15%"><center>SPD</center></td> 
    <td width="15%"><center>FIT</center></td> 
    <td width="15%"><center>Rating</center></td> 
    <td width="15%"><center>Wage</center></td>
  </tr> 
  </thead>
{section name=id loop=$playerdata}
  <tr> 
    
    
    <td class="nam"><a href="viewPlayer.php?playerid={$playerdata[id].idplayer}">{$playerdata[id].playername}</a></td> 
    <td><div align="center">{$playerdata[id].wrank}</div></td> 
    <td><div align="center">{$playerdata[id].age}</div></td> 
    <td><div align="center">{$playerdata[id].handed}</div></td> 
    <td><div align="center">{$playerdata[id].serve}</div></td> 
    <td><div align="center">{$playerdata[id].volley}</div></td> 
    <td><div align="center">{$playerdata[id].forehand}</div></td> 
    <td><div align="center">{$playerdata[id].backhand}</div></td> 
    <td><div align="center">{$playerdata[id].consistency}</div></td> 
    <td><div align="center">{$playerdata[id].stamina}</div></td> 
    <td><div align="center">{$playerdata[id].power}</div></td> 
    <td><div align="center">{$playerdata[id].speed}</div></td> 
    <td><div align="center">{$playerdata[id].fitness}</div></td> 
    <td><div align="center">{$playerdata[id].srating}</div></td>
	<td><div align="center">{$playerdata[id].wage}</div></td>  
  </tr> 
{/section}

{else} 
<thead>
  <tr class="tableHeader"> 
    <td width="40%">Name</td> 
    <td width="15%"><center>Age</center></td> 
    <td width="15%"><center>Hand</center></td> 
    <td width="15%"><center>Fitness</center></td> 
    <td width="15%"><center>Rating</center></td> 
	
  </tr> 
</thead>
  {section name=id loop=$playerdata}
  <tr> 
    
    <td class="nam"><a href="viewPlayer.php?playerid={$playerdata[id].idplayer}">{$playerdata[id].playername}</a></td> 
    <td><div align="center">{$playerdata[id].age}</div></td> 
    <td><div align="center">{$playerdata[id].handed}</div></td> 
    <td><div align="center">{$playerdata[id].fitness}</div></td> 
    <td><div align="center">{$playerdata[id].srating}</div></td>
	  
  </tr> 
{/section}
{/if}
</table>  				

 <h1>Academy Stats</h1>
 <ol id="toc">
	<li><a href="#season">Season</a></li><!-- these comments between li's solve a problem in IE that prevents spaces appearing between list items that appear on different lines in the source
	--><li><a href="#all">All-Time</a></li>
</ol>

<div class="tab" id="season">
<table width="100%" >
<thead><th colspan='2'>Grass</th><th colspan='2'>Clay</th><th colspan='2'>Hard</th><th colspan='2'>Synthetic</th></thead>
<tr class="tableHeader" align="center"><td>P </td><td>W </td><td>P </td><td>W </td><td>P </td><td>W </td><td>P </td><td>W </td></tr>
<tr align="center">
<td>{$seasonStats[1][0]} </td><td>{$seasonStats[1][1]} </td><td>{$seasonStats[2][0]} </td><td>{$seasonStats[2][1]} </td>
<td>{$seasonStats[3][0]} </td><td>{$seasonStats[3][1]} </td><td>{$seasonStats[4][0]} </td><td>{$seasonStats[4][1]} </td>
</tr>
</table>
</div>
<div class="tab" id="all">
<table width="100%" >
<thead><th colspan='2'>Grass</th><th colspan='2'>Clay</th><th colspan='2'>Hard</th><th colspan='2'>Synthetic</th></thead>
<tr class="tableHeader" align="center"><td>P </td><td>W </td><td>P </td><td>W </td><td>P </td><td>W </td><td>P </td><td>W </td></tr>
<tr align="center">
<td>{$alltimeStats[1][0]} </td><td>{$alltimeStats[1][1]} </td><td>{$alltimeStats[2][0]} </td><td>{$alltimeStats[2][1]} </td>
<td>{$alltimeStats[3][0]} </td><td>{$alltimeStats[3][1]} </td><td>{$alltimeStats[4][0]} </td><td>{$alltimeStats[4][1]} </td>
</tr>
</table>
</div>
<br />	
<br /><br /><br />			
{include file="validuserFooter.tpl"}

{literal}
<script type="text/javascript"> 
$(document).ready(function()     
{         
$("#players").tablesorter();
}); 
</script>
<script src="activatables.js" type="text/javascript"></script>
<script type="text/javascript">
activatables('page', ['season', 'all']);
</script>

{/literal}
</html>