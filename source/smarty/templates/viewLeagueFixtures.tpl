{include file="validuserHeader.tpl"}

<h1>{$leaguename[0]} League Fixtures</h1>

<ol id="toc">
	<li><a href="#complete">Complete</a></li><!-- these comments between li's solve a problem in IE that prevents spaces appearing between list items that appear on different lines in the source
	--><li><a href="#upcoming">Pending</a></li>
</ol>

<div class="tab" id="complete">
<h1>Completed Fixtures</h1>
{assign var=tmp value=''}
{section name=id loop=$completedData}
{if $tmp ne $completedData[id].round}
 <BR /> <B>{$completedData[id].round}. {$completedData[id].round_date}.</B> <BR />
{assign var=tmp value=$completedData[id].round}
{/if}
  <a href='fixtures.php?fixtureid={$completedData[id].id_fixture}'>{$completedData[id].t1name} v {$completedData[id].t2name}</a> @ {$completedData[id].name} <br />
{/section}			
</div>

<div class="tab" id="upcoming">
<h1>Pending Fixtures</h1>
{assign var=tmp value=''}
{section name=id loop=$upcomingData}
{if $tmp ne $upcomingData[id].round}
 <BR /> <B>{$upcomingData[id].round}. {$upcomingData[id].round_date}.</B> <BR />
{assign var=tmp value=$upcomingData[id].round}
{/if}
  <a href='fixtures.php?fixtureid={$upcomingData[id].id_fixture}'>{$upcomingData[id].t1name} v {$upcomingData[id].t2name}</a> @ {$upcomingData[id].name} <br />
{/section}			
</div>


 
{include file="validuserFooter.tpl"}
{literal}
<script src="activatables.js" type="text/javascript"></script>
<script type="text/javascript">
activatables('page', ['upcoming', 'complete']);
</script>
{/literal}
</html>