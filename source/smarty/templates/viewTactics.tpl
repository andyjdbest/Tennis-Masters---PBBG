{include file="validuserHeader.tpl"}

{if $errorM eq ''}
{if $single == 0}
{if $noChange == 0}
<form action="setTactics.php" method="post">
<div align="left">Choose the court: <select name="court">
	{html_options values=$courtType output=$courtName selected=$selectC} 
</select></div>
<input type="submit" value="Change" name="setCourt" class="set"> 
</form>
<br />
{/if}
<b>Fixture:</b> <a href="viewAcademy.php?academy={$matchDetails.id_team1}"> {$matchDetails.t1Name} </a> v/s
<a href="viewAcademy.php?academy={$matchDetails.id_team2}"> {$matchDetails.t2Name} </a> <br />
<b>Court:</b>   {$matchDetails.stad} ({$matchDetails.name}) <br /> 
<b>Date:</b>     {$matchDetails.round_date} <br /> 
<h1>Set Tactics</h1>
<form action="setTactics.php" method="post">	
<table width="100%" border="1" cellpadding="1" cellspacing="0" id="tactics"> 
  <tr class="tableHeader t"> 
  <th width="10%"><center>Match</center></th>
  <th width="30%"><center>Player</center></th>
  <th width="20%"><center>Tactic</center></th>
  <th width="20%"><center>Aggression</center></th>
  	</tr>
</thead>
<tr>
	<td><div align="center">1</div></td>
  <td><div align="center"><select name="player[ ]">
	{html_options values=$player_id output=$player_name selected=$selection[2][0]} 
</select></div>
</td>
  <td><div align="center"><select name="tactic[ ]">
	{html_options values=$tactic_id output=$tactic_name selected=$selection[2][1]} 
</select></div></td>
  <td><div align="center"><select name="agg[ ]">
	{html_options values=$agg_id output=$agg_name selected=$selection[2][2]} 
</select></div></td> 
</tr>
<tr>
	<td><div align="center">2</div></td>
  <td><div align="center"><select name="player[ ]">
	{html_options values=$player_id output=$player_name selected=$selection[1][0]} 
</select></div>
</td>
  <td><div align="center"><select name="tactic[ ]">
	{html_options values=$tactic_id output=$tactic_name selected=$selection[1][1]} 
</select></div></td>
  <td><div align="center"><select name="agg[ ]">
	{html_options values=$agg_id output=$agg_name selected=$selection[1][2]} 
</select></div></td> 
</tr>
<tr>
	<td><div align="center">3</div></td>
  <td><div align="center"><select name="player[ ]">
	{html_options values=$player_id output=$player_name selected=$selection[0][0]} 
</select></div>
</td>
  <td><div align="center"><select name="tactic[ ]">
	{html_options values=$tactic_id output=$tactic_name selected=$selection[0][1]} 
</select></div></td>
  <td><div align="center"><select name="agg[ ]">
	{html_options values=$agg_id output=$agg_name selected=$selection[0][2]} 
</select></div></td> 
</tr>
</table>
<input type="checkbox" name="setDefault" value="1">Save as Default</input>
<input type="submit" value="Set Tactics" name="setTactic" class="set"> 
</form>

<form action="viewTactics.php" method="post">
<input type="submit" value="Default" name="default" class="set">
</form>
* Note: The court type might change, if the host academy decides to change it for the fixture.
<br /><br />					
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
{section name=id loop=$playerData}
  <tr> 
    <td class="nam"><a href="viewPlayer.php?playerid={$playerData[id].idplayer}">{$playerData[id].playername}</a></td>
    <td><div align="center">{$playerData[id].serve}</div></td> 
    <td><div align="center">{$playerData[id].volley}</div></td> 
    <td><div align="center">{$playerData[id].forehand}</div></td> 
    <td><div align="center">{$playerData[id].backhand}</div></td> 
    <td><div align="center">{$playerData[id].consistency}</div></td> 
    <td><div align="center">{$playerData[id].stamina}</div></td> 
    <td><div align="center">{$playerData[id].power}</div></td> 
    <td><div align="center">{$playerData[id].speed}</div></td> 
    <td><div align="center">{$playerData[id].fitness}</div></td> 
    <td><div align="center">{$playerData[id].srating}</div></td>
  </tr> 
{/section}
</tbody>
</table>

{elseif $single == 1}
<h1>Set Tactics</h1>
<form action="setTactics.php" method="post">	
<table width="100%" border="1" cellpadding="1" cellspacing="0" id="tactics"> 
  <tr class="tableHeader t"> 
  <th width="30%"><center>Player</center></th>
  <th width="20%"><center>Tactic</center></th>
  <th width="20%"><center>Aggression</center></th>
  </tr>
</thead>
<tr>
  <td><div align="center"><input type="hidden" value="{$player_id}" name="player" />
  <a href="viewPlayer.php?playerid={$player_id}">{$player_name}</a></td> 
</div>
</td>
  <td><div align="center"><select name="tactic">
	{html_options values=$tactic_id output=$tactic_name selected=$selection[0][1]} 
</select></div></td>
  <td><div align="center"><select name="agg">
	{html_options values=$agg_id output=$agg_name selected=$selection[0][2]} 
</select></div></td> 
</tr>
</table>
<input type="submit" value="Set Tactics" name="setKTactic" class="set"> 
</form>
{/if}
{else}
{$errorM}
{/if}
			

<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />

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