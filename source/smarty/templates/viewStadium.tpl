{include file="validuserHeader.tpl"}
				

<h1>Stadiums</h1>
	You can choose to change your courts here. <br />
	Remember that court changes take at least <strong>4 days</strong> 
	and costs your academy <strong>5,000</strong>
	
	<form action="setStadium.php" method="post">				
	<table width="100%" border="1" cellpadding="1" cellspacing="0" id="stadium"> 
	<thead>
  <tr > 
    <th width="35%">Court</th> 
    <th width="15%"><center>Type</center></th> 
    <th width="20%"><center>Date Requested</center></th> 
    <th width="20%"><center>New Court Type</center></th>  
    <th width = "20%"></th>
  </tr> 
  </thead>
 
{section name=id loop=$stadData}
  <tr class="nam"> 
    <td><input type="hidden" value="{$stadData[id].number}" name="courtNo[]" />{$stadData[id].stad}</td> 
    <td><div align="center">{$stadData[id].name1}</div></td> 
    	<td><div align="center">{$stadData[id].date_change|date_format:"%Y-%m-%d"}</div></td> 
        <td><div align="center"><select name="court[]">
	{html_options values=$courtType output=$courtName selected=$stadData[id].court_change} 
</select></div></td>
<td><center><input type="submit" value=" Change Court {$smarty.section.id.index_next} " name="changeCourt"></center></td> 
  </tr> 
{/section}
</table>
<br />
</form>
<br />
<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
 


{include file="validuserFooter.tpl"}

</html>