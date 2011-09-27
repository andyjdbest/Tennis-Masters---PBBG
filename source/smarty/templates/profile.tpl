{include file="validuserHeader.tpl"}

<h1>Profile</h1>
<h3>Academy Name</h3>			
<form method="post" action="profile.php">
	Academy name: <b>{$team}</b> <br /><br />
	{if $count < 1}
	Enter new academy name: <input type='text' name='teamName'>
	<input type='submit' value='Submit' name='team'> <br />
	{/if}
	{$message}
</form>		
<br />
<h3>Court Name</h3>
If you have not changed your court names, you may choose to do that here. <br />
Members are allowed to change their court names as many times as they wish from the Membership menu.
	
<form method="post" action="profile.php">
	<table>
	<thead><tr><th>Court #</th><th>Name</th><th>Change</th></tr></thead>	
	{section loop=$stad name=id}
	<tr><td>{$stad[id].stad_no}</td><td>{$stad[id].name}</td>
	<td>{if $stad[id].name_change eq 1}Done{else}
	<input type='text' name="court[{$stad[id].stad_no}]"> <input type='submit' value='Submit' name="{$stad[id].stad_no}">{/if}	
	</td>
	</tr>		
	{/section}	
	</table>
	{$messageStad}	

	
</form>
	<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />

				
	
 
				
{include file="validuserFooter.tpl"}

</html>