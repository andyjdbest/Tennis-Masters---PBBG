{include file="validuserHeader.tpl"}				
{include file="validuserMailMenu.tpl"}

{if $type eq "Read"}
<form method='post' action='message.php'>
	{$message} {$error} 
<fieldset>
<legend>Read Message</legend>
<br />
<table width="100%" border="1" cellpadding="1" cellspacing="0">
	
	<tr>
  <td><div align="left">From:</div></td>
  <td>{$read[4]}</td>
  </tr>
  <tr>
  <td><div align="left">Subject:</div></td>
  <td>{$read[1]}</td>
  </tr>
  <tr>
  <td><div align="left">Message:</div></td>
  <td>{$read[2]}</td>
</tr>
<input type="hidden" name="message_id" value="{$read[0]}">
</table>
<input type='submit' value='Reply' name="reply" /> 
<input type='submit' value='Delete' name="delete" />
</fieldset>
</form>

{elseif $type eq "memberCompose"}
<form method='post' action='message.php'>
	{$message} {$error} 
<fieldset>
<legend>Compose Message</legend>
<br />
<table width="100%" border="1" cellpadding="1" cellspacing="0" id="countryTable">
	<tr>
  <td><div align="left">To:</div></td>
  <td><input type="text" name="id_receiver" value="{$rec_uname}" readonly="true" disabled="true"></td>
  </tr>
  <tr>
  <td><div align="left">Subject:</div></td><td><input type="text" name="subject"></td>
  </tr>
  <tr>
  <td><div align="left">Message:</div></td><td><textarea rows="10" cols="30" name="message"></textarea></td>
</tr>
</table>
<input type="hidden" name="receiver" value="{$id_receiver}">
<input type='submit' value='Send' name="compose" /> <br />
</fieldset>
</form>

{elseif $type eq "Reply"}
<form method='post' action='message.php'>
	{$message} {$error} 
<fieldset>
<legend>Reply</legend>
<br />

<table width="100%" border="1" cellpadding="1" cellspacing="0" id="countryTable">
	<tr>
  <td><div align="left">To:</div></td>
  <td>{$reply[1]}</td>
  </tr>
  <tr>
  <td><div align="left">Subject:</div></td><td>{$subject}</td>
  </tr>
  <tr>
  <td><div align="left">Message:</div></td><td><textarea rows="10" cols="30" name="message">{$reply[3]}</textarea></td>
</tr>
</table>
<input type="hidden" name="receiver" value="{$reply[0]}">
<input type="hidden" name="subject" value="{$subject}">
<input type='submit' value='Send' name="reply_compose" /> <br />
</fieldset>
</form>


{else}
<form method='post' action='message.php'>
	{$message} {$error} 
<fieldset>
<legend>Compose Message</legend>
<br />
<table width="100%" border="1" cellpadding="1" cellspacing="0" id="countryTable">
	<tr>
  <td><div align="left">To:</div></td>
  <td><input type="text" name="name_receiver"></td>
  </tr>
  <tr>
  <td><div align="left">Subject:</div></td><td><input type="text" name="subject"></td>
  </tr>
  <tr>
  <td><div align="left">Message:</div></td><td><textarea rows="10" cols="30" name="message"></textarea></td>
</tr>
</table>
<input type='submit' value='Send' name="new_compose" /> <br />
</fieldset>
</form>
{/if}
<br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
{include file="validuserFooter.tpl"}

</html>