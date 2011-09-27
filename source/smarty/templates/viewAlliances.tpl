{include file="validuserHeader.tpl"}

<h1>Alliances</h1>			

 {* display pagination header *}
    Alliances {$paginate.first}-{$paginate.last} out of {$paginate.total} displayed.				
<table width="100%" border="1" cellpadding="1" cellspacing="0" id="alliances">
  <thead><tr>	  
    <th width="30%"><center>Name</center></th> 
    <th width="20%"><center>Points</center</th>
   <th width="20%"><center>Members</center</th>  
  </tr></thead>  
{section name=id loop=$results}
  <tr> 
   <td class="nam"><center><a href="viewAlliance.php?alliance={$results[id].id_alliance}">{$results[id].name}</a></center></td> 
   <td><center>{$results[id].points}</a></center></td>
  <td><center>{$results[id].members}</a></center></td>   
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
$("#alliances").tablesorter();     
}); 
</script>
{/literal}
</html>