{include file="validuserHeader.tpl"}
			
{if $member eq 1}				

<h1>Membership Features</h1>
	You may choose to use the following additional features that are available to you for being a member.
	
	<form action="requestsMember.php" method="post">				
	
	{if $teamExists eq 1 || $ownAlliance[0] > 0}
	{if $otherAllianceMessage eq ''}
	<h3>Your Created Alliance</h3>
	<table width="100%" border="1" cellpadding="1" cellspacing="0" >
	<thead><tr><th>Name</th><th>Members</th><th>Points</th><th>Created Date</th></tr></thead>
	<tr><td>{$ownAlliance[1]}</td><td>{$ownAlliance[2]}</td><td>{$ownAlliance[3]}</td><td>{$ownAlliance[4]}</td></tr>
	</table>
	{else}
	<h3>Alliances</h3>
	{$otherAllianceMessage}
	{/if}
	{else}
	<h3>Create a new Alliance</h3>
	Creating a new alliance will cost you 40 credits.
	Each academy that is part of your alliance will earn you points based on their league results. 
	At the end of the season, each point earned will be converted to 5,000 of Tennis Masters money that will be split between each team member. 
	Each alliance can have a maximum of 8 academies in it, including yours.<br />
	
	Choose an alliance name: <input type='text' name='allianceName' length='50' /> <br />
	<textarea name='description' length='250' cols=40 rows=6/>A description not more than 250 characters</textarea>	<br />
	<input type='submit' name='createAlliance' value='Apply' />  

	{/if}
	<br />
	<h3>Rename Players</h3>			
	You can choose to rename your players. Each player rename will cost you 30 credits. <br /> 
	The credits will be deducted once the player name has been approved. <br />
	<form action="requestsMember.php" method="post">			
	<table width="100%" border="1" cellpadding="1" cellspacing="0">
 		
<thead><tr><th>Name</th><th><center>New First Name</center></th><th><center>New Last Name</center></th></thead></tr> 
{section name=id loop=$playerdata}
  <tr> 
    <td class="nam"><a href="viewPlayer.php?playerid={$playerdata[id].idplayer}">{$playerdata[id].playername}</a></td> 
    <td><div align="center"><input type='text' name='firstName[{$playerdata[id].idplayer}]' /></div></td>
    <td><div align="center"><input type='text' name='lastName[{$playerdata[id].idplayer}]' /></div></td> 
  </tr> 
{/section}
</table>
<input type='submit' name='changeNames' value='Change' />
 <br />
	<h3>Rename Courts</h3>			
	You can choose to rename your courts. Each court rename will cost you 20 credits. <br /> 
	The credits will be deducted once the court name has been approved. <br />
	<form action="requestsMember.php" method="post">			
	<table width="100%" border="1" cellpadding="1" cellspacing="0">
 		
<thead><tr><th width="50%"><center>Name</center></th><th><center>New Name</center></th></thead></tr> 
{section name=id1 loop=$courtdata}
  <tr> 
    <td class="nam"><center>{$courtdata[id1].name}</center></a></td> 
    <td><div align="center"><input type='text' name='cName[{$courtdata[id1].id}]' /></div></td>
  </tr> 
{/section}
</table>
<input type='submit' name='changeCNames' value='Change' />

{else}
You are not a member yet. To know how to become a member refer to our <a href='membership.php'>Membership</a> page.
{/if}


<br />
<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
 


{include file="validuserFooter.tpl"}

</html>