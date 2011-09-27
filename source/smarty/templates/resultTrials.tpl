{include file="validuserHeader.tpl"}
{if $error eq ''}
<br />
The following player is available for selection.<br />
<span style='color:green'>{$playerData.firstname} {$playerData.lastname} </span> <b>{$playerData.age}</b> years from <b>{$playerData.nationality}</b> playing <b>{$playerData.handed}</b> handed. <br />
If you decide to keep him, hit the "Keep" button, else the player will be let go. <br />
<br />
<form method='post' action='keepPlayer.php'>
<table cellspacing='3'>
<thead><tr>
<td>SRV</td>
<td>VLY</td>
<td>FHD</td>
<td>BHD</td>
<td>CON</td>
<td>STM</td>
<td>PWR</td>
<td>SPD</td>
<td>Rating</td>
</tr></thead>
<tbody>
<td>{$playerData.serve}</td>
<td>{$playerData.volley}</td>
<td>{$playerData.forehand}</td>
<td>{$playerData.backhand}</td>
<td>{$playerData.consistency}</td>
<td>{$playerData.stamina}</td>
<td>{$playerData.power}</td>
<td>{$playerData.speed}</td>
<td>{$playerData.rating}</td>
</tbody>
</table>
<input type='submit' name='keep' value='Keep' />
<input type='hidden' name='id' value={$playerData.id_trial} /> <br />  
<input type='submit' name='fire' value='Let Go' />
</form>
{else}
<span style='color:red'>Error: {$error}</span>
<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
{/if}
			

 {include file="validuserFooter.tpl"}
 
</html>