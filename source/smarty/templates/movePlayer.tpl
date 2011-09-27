{include file="validuserHeader.tpl"}
 
{if $error ne ""}
	<div id="error">{$error}</div> <br />
{elseif $message ne ""}
	<span>{$message}</span> <br />
	{if $type eq "fire"}
	<form method="post" action="movePlayer.php">
		<input type="submit" value="Fire" name="confirmFire">
	</form>
	{elseif $type eq "sell"}
	<form method="post" action="movePlayer.php">
		<input type="submit" value="Yes" name="confirmSell">
	</form>
	
	<br /><br /><br /><br /><br /><br /><br /><br /><br />
	{/if}
		
{/if}


{include file="validuserFooter.tpl"}

</html>