{include file="validuserHeader.tpl"}
				

<h1>Set Training</h1>
	Next Training Update: <strong>{$next_date}</strong>		
	<form action="setTraining.php" method="post">				
	<table width="100%" border="1" cellpadding="1" cellspacing="0" id="training"> 
  <tr class="tableHeader t"> 
    <td width="20%">Player</td> 
    <td width="15%"><center>Fitness</center></td> 
	<td width="20%"><center>Current Coach</center></td> 
    <td width="20%"><center>Current Training</center></td>  
    <td width="40%"><center>Set Coach</center></td> 
    <td width="40%"><center>Set Training</center></td> 
  </tr> 
 
{if $curr == 1} 
{section name=id loop=$currdata}
  <tr class="nam"> 
    <td><input type="hidden" value="{$currdata[id].idplayer}" name="player[ ]" /><a href="viewPlayer.php?playerid={$currdata[id].idplayer}">{$currdata[id].pname}</a></td> 
    <td><div align="center">{$currdata[id].fitness}</div></td> 
    	<td><div align="center">{$currdata[id].name_coach}</div></td> 
    <td><div align="center">{$currdata[id].skill}</div></td> 
    <td><div align="center"><select name="coach[ ]">
	{html_options values=$coachID output=$coachName selected=$currdata[id].id_coach} 
</select></div></td> 
    <td><div align="center"><select name="skill[ ]">
  	{html_options values=$skillid output=$skillsdata selected=$selectedSkill[id]}
  </select></div></td> 
  </tr> 
{/section}
</table>
{else}
{section name=id loop=$playerdata}
  <tr class="nam"> 
    <td><input type="hidden" value="{$playerdata[id].idplayer}" name="player[ ]" /><a href="viewPlayer.php?playerid={$playerdata[id].idplayer}">{$playerdata[id].playername}</a></td> 
    <td><div align="center">{$playerdata[id].fitness}</div></td> 
	<td><div align="center">{$playerdata[id].name_coach}</div></td> 
    <td><div align="center">{$playerdata[id].skill}</div></td> 
    <td><div align="center"><select name="coach[ ]">
	{html_options values=$coachID output=$coachName} 
</select></div></td> 
    <td><div align="center"><select name="skill[ ]">
  	{html_options values=$skillid output=$skillsdata}
  </select></div></td> 
  </tr> 
{/section}
</table>


{/if}
<input type="submit" value="Set Trainings" name="setTraining">
</form>
<br />

<br />					
<table width="100%" border="1" cellpadding="1" cellspacing="0" id="players">
		
<thead>
  <tr class="tableHeader"> 
    <th width="35%">Name</td> 
    <th width="10%"><center>SRV</center></th> 
    <th width="10%"><center>VLY</center></th> 
    <th width="10%"><center>FHD</center></th> 
    <th width="10%"><center>BHD</center></th> 
    <th width="10%"><center>CON</center></th> 
    <th width="10%"><center>STM</center></th> 
    <th width="10%"><center>PWR</center></th> 
    <th width="10%"><center>SPD</center></th> 
    <th width="10%"><center>FIT</center></th> 
    <th width="10%"><center>Rating</center></th> 
  </tr> 
  </thead>
<tbody>
{section name=id loop=$playerdata}
  <tr> 
    <td class="nam"><a href="viewPlayer.php?playerid={$playerdata[id].idplayer}">{$playerdata[id].playername}</a></td>
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
  </tr> 
{/section}
</tbody>
</table>

<br />
<table width="100%" border="1" cellpadding="1" cellspacing="0" id="coach">
		
<thead>
  <tr class="tableHeader"> 
    <th width="35%">Name</td> 
    <th width="20%"><center>Level</center></th> 
  </tr> 
  </thead>
<tbody>
{section name=id loop=$coachData}
  <tr> 
    <td class="nam"><a href="viewCoach.php?coachid={$coachData[id].id_coach}">{$coachData[id].name_coach}</a></td>
    <td><div align="center">{$coachData[id].name_coachlevel}</div></td> 
  </tr> 
{/section}
</tbody>
</table>
 <br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />


{include file="validuserFooter.tpl"}

{literal}
<script type="text/javascript"> 
$(document).ready(function()     
{         
$("#players").tablesorter();     
}); 
</script>
{/literal}

</html>