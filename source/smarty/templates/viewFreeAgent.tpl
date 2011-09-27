{include file="validuserHeader.tpl"}

{if $transfer_message ne ""}
	<div class="error">{$transfer_message}</div>
{/if}

<h1>Free Agent Information</h1>
				
 
	<table width="100%" border="1" cellpadding="1" cellspacing="0" id="player"> 
  <thead> 
  <tr>
   <th width="35%">Name</th> 
   <th width="10%">Country</th> 
    <th width="10%"><center>Age</center></th> 
    <th width="10%"><center>Hand</center></th> 
    <th width="10%"><center>Fitness</center></th> 
    <th width="10%"><center>Rating</center></th>
	<th width="15%"><center>Wage</center></th>  
	<th width="15%"><center>Min Bid</center></th>  	
  </tr> 
  </thead>
  <tr>   
	<td class="nam"><span style="font-size:12px;"><strong>{$playerdata.playername}</strong></span></td> 
     <td><div align="center">{$playerdata.nationality}</div></td> 
    <td><div align="center">{$playerdata.age}</div></td> 
    <td><div align="center">{$playerdata.handed}</div></td> 
    <td><div align="center">{$playerdata.fitness}</div></td> 
    <td><div align="center">{$playerdata.srating}</div></td> 
   <td><div align="center">{$playerdata.wage}</div></td> 
   <td><div align="center">{$playerdata.set_price}</div></td> 
  </tr> 
</table>  
 
    <br />
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

<br />
<span style="font-size:16px;"><strong>Statistics</strong></span> <br />
<span class="gp">Played: {$played} Won: {$wins}</span><br />
<p>Grass: <span>{$courtV[0]}</span>&nbsp;&nbsp; Clay: <span>{$courtV[1]}</span>&nbsp;&nbsp; Hardcourt: <span>{$courtV[2]}</span>&nbsp;&nbsp; Synthetic: <span>{$courtV[3]}</span></p>

<br />

<form method='post' action='bidPlayer.php'>
	<span style="font-size:16px;"><strong>Transfer</strong></span> <br />
	<input type="hidden" name="playerId" value={$playerdata.idplayer}>
<fieldset>
<legend>Bid on Player</legend>
<table border='0'>
<tr><td class="sell">Bid on player?<br /></td></tr>
<tr><td><input type='text' name='bid_value' value={$playerdata.set_price} /></td>
<td><input type="radio" name="type" value="public" CHECKED /> Public</td>
<td><input type="radio" name="type" value="private" /> Private</td>
</tr><tr><td colspan ='3'>While a public bid is visible to all, a private bid will not be seen by any other. A private bid will cost you 25,000. 
		<br /> Your bid must be at least 1000 more than the previous public bid.</td></tr>
<tr><td colspan ='3'>
<input type='submit' value='Bid' name="bid" />
</td></tr>
</form>		
</table>
</fieldset>

<br />
{if $publicBidData[0][0] > 0}
<h1>Public Bids</h1>
<table width="100%" border="1" cellpadding="1" cellspacing="0" id="bids"> 
  <thead> 
  <tr>
   <th width="40%">Academy Name</th> 
   <th width="20%">Bid Value</th> 
  </tr> 
  </thead>
  {section name=id loop=$publicBidData}
  <tr>   
	<td class="nam"><a href="viewAcademy.php?academy={$publicBidData[id].id_team}">{$publicBidData[id].team_name}</a></td> 
    <td><div align="center">{$publicBidData[id].bid}</div></td> 
  </tr> 
  {/section}
</table>  
{/if}
<br />
{if $privateBid ne 'a'}
<h1>Private Bids</h1>
{$privateBid} <br />
{/if}
{if $ownBid ne ''}
<h1>Your Bid</h1>
{$ownBid}
{/if}
<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />	
<br />
 
				
{include file="validuserFooter.tpl"}

</html>