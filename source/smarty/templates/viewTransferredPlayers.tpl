{include file="validuserHeader.tpl"}


<ol id="toc">
	<li><a href="#purchased">Purchased</a></li><!-- these comments between li's solve a problem in IE that prevents spaces appearing between list items that appear on different lines in the source
	--><li><a href="#free">Let-Go</a></li>
</ol>

<div class="tab" id="purchased">
<h1>Purchased Players</h1>

{if $pur_data[0][0] ne ""}
<table >
<thead><tr><th>Player</th><th>Price</th><th>Date</th></tr>
</thead>
<tbody>
{section name=id loop=$pur_data}
  <tr>
  <td><a href='viewPlayer.php?playerid={$pur_data[id].idplayer}'>{$pur_data[id].name}</a></td>
  <td>{$pur_data[id].value}</td>
  <td>{$pur_data[id].date}</td>
  </tr>
{/section}
</tbody>			
</table>
{else}
You have not purchased any players this season. Hmm.....
{/if}
</div>


<div class="tab" id="free">
<h1>Players Let Go</h1>

{if $sol_data[0][0] ne ""}
<table >
<thead><tr><th>Player</th><th>Price</th><th>Date</th></tr>
</thead>
<tbody>
{section name=id loop=$sol_data}
  <tr>
  <td><a href='viewPlayer.php?playerid={$sol_data[id].idplayer}'>{$sol_data[id].name}</a></td>
  <td>{$sol_data[id].set_price}</td>
  <td>{$sol_data[id].date_free}</td>
  </tr>
{/section}
</tbody>			
</table>
{else}
You have not sold any players this season. Hmm.....
{/if}
</div>
 
 <br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />	
{include file="validuserFooter.tpl"}
{literal}
<script src="activatables.js" type="text/javascript"></script>
<script type="text/javascript">
activatables('page', ['purchased', 'free']);
</script>
{/literal}
</html>