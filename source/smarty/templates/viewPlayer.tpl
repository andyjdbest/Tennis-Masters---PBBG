{include file="validuserHeader.tpl"}

{if $transfer_message ne ""}
	<div class="error">{$transfer_message}</div>
{/if}

<h1>Player Information</h1>
				
 
	<table width="100%" border="1" cellpadding="1" cellspacing="0" id="player"> 
  <tr class="tableHeader t"> 
   <td width="40%">Name</td> 
       <td width="10%">Rank</td>
       <td width="10%">Country</td> 
    <td width="15%"><center>Age</center></td> 
    <td width="15%"><center>Hand</center></td> 
    <td width="15%"><center>Fitness</center></td> 
    <td width="15%"><center>Rating</center></td>
	<td width="15%"><center>Wage</center></td>   
  </tr> 
  
  <tr>   
	<td class="nam"><span style="font-size:12px;"><strong>{$playerdata.playername}</strong></span></td> 
    <td><div align="center">{$playerdata.wrank}</div></td> 
        <td><div align="center">{$playerdata.nationality}</div></td> 
    <td><div align="center">{$playerdata.age}</div></td> 
    <td><div align="center">{$playerdata.handed}</div></td> 
    <td><div align="center">{$playerdata.fitness}</div></td> 
    <td><div align="center">{$playerdata.srating}</div></td> 
   <td><div align="center">{$playerdata.wage}</div></td> 
  </tr> 
 
</table>  
 
{if $own eq 1}
	<span style="font-size:16px;"><strong>Skills</strong></span>
	<table width=50%>
<tr><td>
<table id="primary" align="Right">	
<tr>
  <td>Serve</td><td>{$playerdata.serve}</td>
</tr>
  <tr>
  <td>Volley</td><td>{$playerdata.volley}</td>
  </tr>
  <tr>
  <td>Forehand</td><td>{$playerdata.forehand}</td>
  </tr>
  <tr>
  <td>Backhand</td><td>{$playerdata.backhand}</td>
  </tr>
</table>
</td>
 <td>
 
<table width=50% id="secondary" align="Right">
	<tr>
  <td>Consistency</td><td>{$playerdata.consistency}</td>
  </tr>
  <tr>
  <td>Stamina</td><td>{$playerdata.stamina}</td>
  </tr>
  <tr>
  <td>Power</td><td>{$playerdata.power}</td>
  </tr>
  <tr>
  <td>Speed</td><td>{$playerdata.speed}</td>
  <td>
  	</tr>
</table>
</table>

<span style="font-size:16px;"><strong>Statistics</strong></span> <br />
<span class="gp">Played: {$played} Won: {$wins}</span><br />
<p>Grass: <span>{$courtV[0]}</span>&nbsp;&nbsp; Clay: <span>{$courtV[1]}</span>&nbsp;&nbsp; Hardcourt: <span>{$courtV[2]}</span>&nbsp;&nbsp; Synthetic: <span>{$courtV[3]}</span></p>



<form method='post' action='movePlayer.php'>
	<span style="font-size:16px;"><strong>Transfer</strong></span> <br />
	<input type="hidden" name="playerId" value={$playerdata.idplayer}>
<table>
<tr><td class="sell">Make {$playerdata.playername} a free agent?<br />
<input type='submit' value='Yes' name="sell" />
</td></tr>
</form>		
</table>
{/if}


<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />	
<br />
 
				
{include file="validuserFooter.tpl"}

</html>