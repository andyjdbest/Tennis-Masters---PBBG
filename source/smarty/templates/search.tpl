{include file="validuserHeader.tpl"}

<h1>Search </h1>
<table width="100%" border="1" cellpadding="1" cellspacing="0" id="users"> 
{section name=id loop=$resultData}
<tr>
<td><a href="viewAcademy.php?academy={$resultData[id][0]}">{$resultData[id][1]}</a></td> 
<td><a href="viewManagerInfo.php?user={$resultData[id][3]}">{$resultData[id][2]}</a></td>
</tr> 
{/section}
{section name=id loop=$leagueData}
<tr>
<td><a href="viewLeague.php?league={$leagueData[id][0]}">{$leagueData[id][1]}</a></td> 
</tr> 
{/section}
</table>			
<form method="post" action="search.php">
	Enter User Name: <input type='text' name='userName'> <br />
	OR <br />
	Enter League Name: <input type='text' name='leagueName'> <br />
	<input type='submit' value='Submit'> <br />
	{$message}
</form>
<br />
<a href="viewManagers.php">Recently Online Managers</a>
<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
{include file="validuserFooter.tpl"}

</html>