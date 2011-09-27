{include file="validuserHeader.tpl"}
				
{if $messageSet ne ""}
	<span>{$messageSet}</span> <br />
{/if}
{if $errorSet ne ""}
	<div id="error">{$errorSet}</div> <br />
{/if}
<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />			

 
{include file="validuserFooter.tpl"}

</html>