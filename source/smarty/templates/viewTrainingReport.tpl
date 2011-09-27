{include file="validuserHeader.tpl"}

{if $error ne ''}
<div id="error">{$error}</div>
{else}


<h1>Training Report</h1>			
				
<table width="100%" border="1" cellpadding="0" cellspacing="1" id="training">
	<thead> 
  <tr> 
	<th width="20%">Name</th> 
    <th width="30%"><center>Skills</center></th>  
    <th width="15%"><center>Date</center></th> 

  </tr> 
  </thead>
{section name=id loop=$reportData}
  <tr> 
    <td  class="nam"><a href="viewPlayer.php?playerid={$reportData[id].id_player}">{$reportData[id].playername}</a></td> 
    <td><div align="left">increased in <b>{$reportData[id].skill}</b> to <b>{$reportData[id].update}</b></div></td>  
    <td><div align="center">{$reportData[id].week}</div></td>
  </tr> 
{/section}


{/if}
</table>  				
<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
 
				
{include file="validuserFooter.tpl"}

{literal}
<script type="text/javascript"> 
$(document).ready(function()     
{         
$("#training").tablesorter();     
}); 
</script>
{/literal}
</html>