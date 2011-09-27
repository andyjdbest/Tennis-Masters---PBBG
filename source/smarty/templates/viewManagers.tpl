{include file="validuserHeader.tpl"}

<h1>Recently Online Managers</h1>			

 {* display pagination header *}
    Players {$paginate.first}-{$paginate.last} out of {$paginate.total} displayed.				
<table width="100%" border="1" cellpadding="1" cellspacing="0" id="manager">

  <tr class="tableHeader"> 
    <td width="30%"><center>Manager</center></td> 
    
    <td width="30%"><center>Academy</center</td> 
  </tr> 
  
{section name=id loop=$results}
  <tr> 
   <td class="nam"><center><a href="viewManagerInfo.php?user={$results[id].userid}">{$results[id].name}</a></center></td> 
      
      <td><center><a href="viewAcademy.php?academy={$results[id].id_team}">{$results[id].team_name}</a></center></td>  
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
$("#manager").tablesorter();     
}); 
</script>
{/literal}
</html>