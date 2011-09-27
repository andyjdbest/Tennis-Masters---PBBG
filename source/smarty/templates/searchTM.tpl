{include file="validuserHeader.tpl"}

{if $error ne ''}
<div id="error">{$error}</div>
{else}


<h1>Free Agents</h1>			
				
<table width="120%" border="1" cellpadding="1" cellspacing="1" id="players">
	<thead> 
  <tr> 
	<th >Name</th> 
	<th ><center>Set Price</center></th>
	<th ><center>Age</center></th>  
    <th ><center>SRV</center></th> 
    <th ><center>VLY</center></th> 
    <th ><center>FHD</center></th> 
    <th ><center>BHD</center></th> 
    <th ><center>CON</center></th> 
    <th ><center>STM</center></th> 
    <th ><center>PWR</center></th> 
    <th ><center>SPD</center></th> 
    <th ><center>Rating</center></th>
  </tr> 
  </thead>
{section name=id loop=$transfer_data}
  <tr> 
    <td  class="nam"><a href="viewFreeAgent.php?playerid={$transfer_data[id].id_player}">{$transfer_data[id].playername}</a></td> 
    <td><div align="center">{$transfer_data[id].set_price}</div></td>
	<td><div align="center">{$transfer_data[id].age}</div></td>
    <td><div align="center">{$transfer_data[id].serve}</div></td> 
    <td><div align="center">{$transfer_data[id].volley}</div></td> 
    <td><div align="center">{$transfer_data[id].forehand}</div></td> 
    <td><div align="center">{$transfer_data[id].backhand}</div></td> 
    <td><div align="center">{$transfer_data[id].consistency}</div></td> 
    <td><div align="center">{$transfer_data[id].stamina}</div></td> 
    <td><div align="center">{$transfer_data[id].power}</div></td> 
    <td><div align="center">{$transfer_data[id].speed}</div></td>  
    <td><div align="center">{$transfer_data[id].srating}</div></td>
  </tr> 
{/section}



</table>  				
{/if}
 
				
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