{include file="validuserHeader.tpl"}

{if $message eq ''}
<span>Academy <a href="viewAcademy.php?academy={$id_team}"><b>{$team_name}</b></a>
</span>

<h1>Issue Challenge</h1>			
<form method="post" action="challenge.php">
	Date: 
	<select name="date">
	{html_options values=$date output=$date selected=$smarty.post.date} <br />
	</select>
	Court: 
	{html_options name=courtname options=$court } <br />
	<input type='submit' value='Challenge'> <br />
	<input type='hidden' name='academyC' value={$id_team}>
</form>
{else}
{$message}
{/if}
	
 <br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
				
{include file="validuserFooter.tpl"}

</html>