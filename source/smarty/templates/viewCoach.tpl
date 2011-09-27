{include file="validuserHeader.tpl"}

{if $own eq 1}
<h1>Coach Details</h1>
							
	<table width="100%" border="1" cellpadding="1" cellspacing="0" id="coach"> 
	<thead>
    <tr class="tableHeader t"> 
    <th width="20%">Coach</td> 
    <th width="15%"><center>Age</center></td> 
    <th width="20%"><center>Level</center></td> 
    <th width="20%"><center>Last Upgrade</center></td> 
  </tr> 
  </thead>
  
{section name=id loop=$coachdata}
  <tr> 
    <td class="nam"><div align="center"><a href="viewCoach.php?coachID={$coachdata[id].id_coach}">{$coachdata[id].name_coach}</a></div></td> 
    <td><div align="center">{$coachdata[id].age}</div></td> 
    <td><div align="center">{$coachdata[id].name_coachlevel}</div></td> 
    <td><div align="center">{$coachdata[id].date_upgrade}</div></td> 
  </tr>
    {if $upgrade eq 1}
  <tr><td>
  <form action="manageCoach.php" method="post" accept-charset="utf-8">
	<input type="hidden" name="coachID" value={$coachdata[id].id_coach}>
	<p><input type="submit" name="upgrade" value="Upgrade" /> <input type="submit" name="fire" value="   Fire   " /></p>
   </form>
  </td></tr>
  {/if} 
 
{/section}
</table>
    {if $upgrade eq 1}
<label class="sell">Cost of upgrade = {$cost}</label> <br />
{/if}
<br />

{else}
<br />
 <div class="error">Error: {$error}</div> <br />
 
{/if}	
<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />			

 {include file="validuserFooter.tpl"}
 
</html>