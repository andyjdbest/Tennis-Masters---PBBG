{include file="validuserHeader.tpl"}
<br />
{if $message ne ""}
			<span style='color:green'>{$message}</span>
			<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
{elseif $can_call eq '1'}
Player Trials can be held once a week starting from Tuesday.  <br />
You can decide on the country from which you want your player. <br />
You can pick 1 player per week. <br />
<form method='post' action='getPlayer.php'>
<fieldset>
<legend>Request for Player Trials</legend>
<label name="country">Country:</label> {html_options name=country options=$countries selected=$smarty.post.country}
<br />
<input type='submit' value='Call' /> <br />  
{else}
	<span style='color:red'>{$next}</span>
	<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
{/if}


</fieldset>
</form>
			

 {include file="validuserFooter.tpl"}
 
</html>