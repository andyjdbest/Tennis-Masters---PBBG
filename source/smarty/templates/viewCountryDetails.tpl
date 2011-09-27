{include file="validuserHeader.tpl"}
				


<h3>World Ranking</h3>			
<a href="viewPlayersRank.php?countryID={0}">World Player Rankings</a> <br />
<h3>Select Country</h3>
<form action="viewCountryDetails.php" method="post">	
<select name="countryID"> 
{html_options values=$countryID output=$countryName selected=$smarty.post.countryID} 
</select> <input type="submit" value="Select" name="country">
</form>
<br />
	<table width="50%" border="1" cellpadding="1" cellspacing="0" id="country"> 
  <tr class="tableHeader t"> 
    <td width="5%">#</td> 
    <td width="15%">League Table</td>
	<td width="25%"><center>League Fixtures</center></td>	
  </tr> 
{section name=id loop=$leagueData}
{strip}
  <tr bgcolor="{cycle values="#CCFFCC,#C3D9FF"}">
    <td><div align="center">{$smarty.section.id.iteration}</div></td> 
    <td><div align="center"><a href="viewLeague.php?league={$leagueData[id].idleague}">{$leagueData[id].nameleague}</a></div></td> 
    <td><div align="center"><a href="viewLeagueFixtures.php?league={$leagueData[id].idleague}">{$leagueData[id].nameleague} Fixtures</a></div></td> 
  </tr>
  {/strip}
{/section}
</table>
<br />
<a href="viewPlayersRank.php?countryID={$cID}">Player Rankings in the Country</a>
<br />
<br />
<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /> 


{include file="validuserFooter.tpl"}

</html>