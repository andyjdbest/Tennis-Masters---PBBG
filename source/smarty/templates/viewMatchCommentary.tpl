{include file="validuserHeader.tpl"}

<h1>Match Commentary</h1>
{*
{if $matchData.fixture_type < 3}
<a href="viewAcademy.php?academy={$matchData.a1_id}">{$matchData.a1_name}</a> 
<a href="fixtures.php?fixtureid={$matchData.id_fixture}">versus</a> <a href="viewAcademy.php?academy={$matchData.a2_id}">{$matchData.a2_name}</a><br />
{/if}
{$matchData.name_fixture} match played on {$matchData.round_date} on a {$matchData.name} court
<br /><br />
*}

<br/>

{$comment}
				
{include file="validuserFooter.tpl"}

</html>