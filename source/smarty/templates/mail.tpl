{include file="validuserHeader.tpl"}				
{include file="validuserMailMenu.tpl"}

{if $type eq "inbox"}
{if $message ne ""}
{$message}
{/if}
<br />
<table width="100%" border="1" cellpadding="1" cellspacing="0" id="inbox">
<thead>
	<tr class="tableHeader">
  <div align="center"><td>From</div></td><td></td><td>Subject</td><td>Date</td></div>
  </tr>
</thead>
  
  {section name=id loop=$mailData}
  <tr>
  <td><div align="left">{$mailData[id].username}</div></td>
  {if $mailData[id].read eq 0}
  <td><div align="left"><img src="assets/images/icon_email.gif"></div></td>
  {else}
  <td></td>
  {/if} 
  <td><div align="left"><a href="message.php?message={$mailData[id].mid}">{$mailData[id].subject}</div></td> 
  <td><div align="left">{$mailData[id].date}</div></td>
  </tr>
  {/section}
</table>
{/if}

{if $type eq "outbox"}
<br />
<table width="100%" border="1" cellpadding="1" cellspacing="0" id="inbox">
<thead>
	<tr class="tableHeader">
  <div align="center"><td>To</div></td><td>Subject</td><td>Date</td></div>
  </tr>
</thead>
  
  {section name=id loop=$mailData}
  <tr>
  <td><div align="left">{$mailData[id].username}</div></td> 
  <td><div align="left"><a href="message.php?message={$mailData[id].mid}">{$mailData[id].subject}</div></td> 
  <td><div align="left">{$mailData[id].date}</div></td>
  </tr>
  {/section}
</table>
{/if}
<br /><br /><br /><br /><br /><br /><br /><br /><br /><br />

{include file="validuserFooter.tpl"}
</html>