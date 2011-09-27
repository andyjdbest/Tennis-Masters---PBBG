{include file="validuserHeader.tpl"}

<h1>Players by Ranking</h1>			

 {* display pagination header *}
    Players {$paginate.first}-{$paginate.last} out of {$paginate.total} displayed.				
<table width="100%" border="1" cellpadding="1" cellspacing="0" id="players">

  <tr class="tableHeader"> 
    <td width="5%"><center>Rank</center</td> 
    <td width="30%"><center>Player</center></td> 
    
    <td width="30%"><center>Academy</center</td> 
  </tr> 
  
{section name=id loop=$results}
  <tr> 
   <td>{$results[id].rank}</td>  
   <td class="nam"><center><a href="viewPlayer.php?playerid={$results[id].idplayer}">{$results[id].playername}</a></center></td> 
      
      <td><center><a href="viewAcademy.php?academy={$results[id].id_team}">{$results[id].academy_name}</a></center></td>  
  </tr> 
{/section}

</table>  		
<br />
		
{* display pagination info *}
    {paginate_prev}  {paginate_middle}  {paginate_next}
<br />
<br /> 
<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />				
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