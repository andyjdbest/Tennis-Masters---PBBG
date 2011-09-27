{include file="validuserHeader.tpl"}
{$message}
<table width="100%" id="alliance">
<tr>
 <td colspan ='2' height="22" align="left" valign="middle" style="background-color:#E6EDF5")>{$name}</td>
</tr>
 <tr>
  <td colspan = '2'><b>Description:</b></td>
  </tr>
  <tr><td colspan = '2'>{$description}</td>
 </tr>
</table>
<br />
<table width="100%" id="members">
<thead><tr><th>User</th><th>Points</th></tr></thead> 	 
 {section name=id loop=$members} 
  <tr>
   <td><a href='viewManagerInfo.php?user={$members[id].id_user}'>{$members[id].username}</td><td>{$members[id].points}</td>	 
  </tr>
 {/section} 
</table>  

<br />
{if $leader ne 1}
<form action='allianceApplicant.php' method='post'>
<input type='hidden' name='id' value={$Aid}>
<h3>Application</h3> 
{if $existing eq 1}
You may choose to withdraw yourself from this alliance. <br />
<input type='submit' value='Withdraw' name='withdraw' />
{else}
If you apply to join the alliance, a message will be sent to the leader who will have to approve your application.<br />
<input type='submit' value='Apply' name='apply' />
{/if}
</form>				
{/if}
<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
 
				
{include file="validuserFooter.tpl"}

</html>