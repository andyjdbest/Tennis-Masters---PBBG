{include file="validuserHeader.tpl"}

{if $single == 0}
<b>Fixture:</b> <a href="viewAcademy.php?academy={$matchDetails.id_team1}"> {$matchDetails.t1Name} </a> v/s
<a href="viewAcademy.php?academy={$matchDetails.id_team2}"> {$matchDetails.t2Name} </a> <br />
<b>Court:</b>   {$matchDetails.stad} ({$matchDetails.name}) <br /> 
<b>Date:</b>     {$matchDetails.round_date} <br /> 

{if $own == 1}
<h1>Fixture Tactics</h1>
<table width="100%" border="1" cellpadding="1" cellspacing="0" id="tactics"> 
  <thead>
  <tr> 
  <th width="10%"><center>Match</center></th>
  <th width="30%"><center>Player</center></th>
  <th width="20%"><center>Tactic</center></th>
  <th width="20%"><center>Aggression</center></th>
  	</tr>
</thead>
<tr>
	<td><div align="center">1</div></td>
  <td><div align="center">{$selection[2][0]} 
	</div>
</td>
  <td><div align="center">
	{$selection[2][1]} 
</div></td>
  <td><div align="center">
	{$selection[2][2]} 
</div></td> 
</tr>
<tr>
	<td><div align="center">2</div></td>
  <td><div align="center">
	{$selection[1][0]} 
</div>
</td>
  <td><div align="center">
	{$selection[1][1]} 
</div></td>
  <td><div align="center">
	{$selection[1][2]} 
</div></td> 
</tr>
<tr>
	<td><div align="center">3</div></td>
  <td><div align="center">
	{$selection[0][0]} 
</div>
</td>
  <td><div align="center">
	{$selection[0][1]} 
</div></td>
  <td><div align="center">
	{$selection[0][2]} 
</div></td> 
</tr>
</table>

<br /><br />{else}<div id="error">
{$error}
</div>
{/if}
		
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

<br /><br /><br /><br /><br /><br /><br /><br /><br /><br />			


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