{include file="validuserHeader.tpl"}

<H1>Search </h1>

<form action="searchTM.php" method="post">
	<table width="100%">
    <tr><td width="15%"><center><b>Age</b></center></td>
	<td>min</td><td>{html_options name=min_age options=$age selected=$smarty.post.min_age}</td>
	<td>max</td><td>{html_options name=max_age options=$age selected=$smarty.post.max_age}</td></tr>  
    <tr><td width="15%"><center><b>SRV</b></center></td> 
	<td>min</td><td>{html_options name=min_srv options=$stat selected=$smarty.post.min_srv}</td>
	<td>max</td><td>{html_options name=max_srv options=$stat selected=14}</td></tr>
    <tr><td width="15%"><center><b>VLY</b></center></td>
	<td>min</td><td>{html_options name=min_vly options=$stat selected=$smarty.post.min_vly}</td>
	<td>max</td><td>{html_options name=max_vly options=$stat selected=14}</td></tr>
    <tr><td width="15%"><center><b>FHD</b></center></td>
	<td>min</td><td>{html_options name=min_fhd options=$stat selected=$smarty.post.min_fhd}</td>
	<td>max</td><td>{html_options name=max_fhd options=$stat selected=14}</td></tr>
    <tr><td width="15%"><center><b>BHD</b></center></td>
	<td>min</td><td>{html_options name=min_bhd options=$stat selected=$smarty.post.min_bhd}</td>
	<td>max</td><td>{html_options name=max_bhd options=$stat selected=14}</td></tr>
    <tr><td width="15%"><center><b>CON</b></center></td>
	<td>min</td><td>{html_options name=min_con options=$stat selected=$smarty.post.min_con}</td>
	<td>max</td><td>{html_options name=max_con options=$stat selected=14}</td></tr>
    <tr><td width="15%"><center><b>STM</b></center></td>
	<td>min</td><td>{html_options name=min_stm options=$stat selected=$smarty.post.min_stm}</td>
	<td>max</td><td>{html_options name=max_stm options=$stat selected=14}</td></tr>
    <tr><td width="15%"><center><b>PWR</b></center></td>
	<td>min</td><td>{html_options name=min_pwr options=$stat selected=$smarty.post.min_pwr}</td>
	<td>max</td><td>{html_options name=max_pwr options=$stat selected=14}</td></tr>
    <tr><td width="15%"><center><b>SPD</b></center></td>
	<td>min</td><td>{html_options name=min_spd options=$stat selected=$smarty.post.min_spd}</td>
	<td>max</td><td>{html_options name=max_spd options=$stat selected=14}</td></tr>
   	<tr><td><input type="submit" name="search" value="Continue" /></td></tr>
	</table>
</form>			
	
<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
{include file="validuserFooter.tpl"}

</html>