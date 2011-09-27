{include file="validuserHeader.tpl"}

{if $own eq 1}
<h1>Coach Details</h1>
							
	<table width="100%" border="1" cellpadding="1" cellspacing="0" id="coach"> 
	<thead>
  <tr class="tableHeader t"> 
    <th width="20%">Coach</td> 
    <th width="15%"><center>Age</center></td> 
    <th width="20%"><center>Level</center></td> 
  </tr> 
  </thead>
  
{section name=id loop=$coachdata}
  <tr> 
    <td class="nam"><div align="center"><a href="viewCoach.php?coachID={$coachdata[id].id_coach}">{$coachdata[id].name_coach}</a></div></td> 
    <td><div align="center">{$coachdata[id].age}</div></td> 
    <td><div align="center">{$coachdata[id].name_coachlevel}</div></td> 
  </tr> 
{/section}
</table>
<br />
<form action="manageCoach.php" method="post" accept-charset="utf-8">
	<p>Enter Number of new Coaches: <input type="text" name="numCoaches" /> <p><input type="submit" name="buy" value="Buy New" /></p>
</form>
<label class="sell">Cost of each Coach = 3000</label> <br />
<label class="sell">Each new coach opens a new training slot</label>
{else}
<br />
 <div class="error">Error: {$error}</div> <br />
 
{/if}	
<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />			

 {include file="validuserFooter.tpl"}
 {literal}
<script type="text/javascript"> 
$(document).ready(function()     
{         
$("#coach").tablesorter();     
}); 
</script>
{/literal}
</html>