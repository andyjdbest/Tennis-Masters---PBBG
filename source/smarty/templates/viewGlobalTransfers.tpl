{include file="validuserHeader.tpl"}

<h1>Recent Global Transfers</h1>			

				
{if $sol_data[0][0] ne ""}
<table >
<thead><tr><th>Player</th><th>New Academy</th><th>Price</th><th>Date</th></tr>
</thead>
<tbody>
{section name=id loop=$sol_data}
  <tr>
  <td><a href='viewPlayer.php?playerid={$sol_data[id].idplayer}'>{$sol_data[id].name}</a></td>
  <td><a href='viewAcademy.php?academy={$sol_data[id].id_team}'>{$sol_data[id].team_name}</a></td>
  <td>{$sol_data[id].bid}</td>
  <td>{$sol_data[id].date}</td>
  </tr>
{/section}
</tbody>			
</table>
{else}
Not much transfer activity happening
{/if}


<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />				
{include file="validuserFooter.tpl"}

{literal}
<script type="text/javascript"> 
$(document).ready(function()     
{         
$("#manager").tablesorter();     
}); 
</script>
{/literal}
</html>