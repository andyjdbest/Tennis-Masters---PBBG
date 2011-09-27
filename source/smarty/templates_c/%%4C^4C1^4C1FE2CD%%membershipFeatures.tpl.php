<?php /* Smarty version 2.6.26, created on 2010-10-02 13:31:53
         compiled from membershipFeatures.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "validuserHeader.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			
<?php if ($this->_tpl_vars['member'] == 1): ?>				

<h1>Membership Features</h1>
	You may choose to use the following additional features that are available to you for being a member.
	
	<form action="requestsMember.php" method="post">				
	
	<?php if ($this->_tpl_vars['teamExists'] == 1 || $this->_tpl_vars['ownAlliance'][0] > 0): ?>
	<?php if ($this->_tpl_vars['otherAllianceMessage'] == ''): ?>
	<h3>Your Created Alliance</h3>
	<table width="100%" border="1" cellpadding="1" cellspacing="0" >
	<thead><tr><th>Name</th><th>Members</th><th>Points</th><th>Created Date</th></tr></thead>
	<tr><td><?php echo $this->_tpl_vars['ownAlliance'][1]; ?>
</td><td><?php echo $this->_tpl_vars['ownAlliance'][2]; ?>
</td><td><?php echo $this->_tpl_vars['ownAlliance'][3]; ?>
</td><td><?php echo $this->_tpl_vars['ownAlliance'][4]; ?>
</td></tr>
	</table>
	<?php else: ?>
	<h3>Alliances</h3>
	<?php echo $this->_tpl_vars['otherAllianceMessage']; ?>

	<?php endif; ?>
	<?php else: ?>
	<h3>Create a new Alliance</h3>
	Creating a new alliance will cost you 40 credits.
	Each academy that is part of your alliance will earn you points based on their league results. 
	At the end of the season, each point earned will be converted to 5,000 of Tennis Masters money that will be split between each team member. 
	Each alliance can have a maximum of 8 academies in it, including yours.<br />
	
	Choose an alliance name: <input type='text' name='allianceName' length='50' /> <br />
	<textarea name='description' length='250' cols=40 rows=6/>A description not more than 250 characters</textarea>	<br />
	<input type='submit' name='createAlliance' value='Apply' />  

	<?php endif; ?>
	<br />
	<h3>Rename Players</h3>			
	You can choose to rename your players. Each player rename will cost you 30 credits. <br /> 
	The credits will be deducted once the player name has been approved. <br />
	<form action="requestsMember.php" method="post">			
	<table width="100%" border="1" cellpadding="1" cellspacing="0">
 		
<thead><tr><th>Name</th><th><center>New First Name</center></th><th><center>New Last Name</center></th></thead></tr> 
<?php unset($this->_sections['id']);
$this->_sections['id']['name'] = 'id';
$this->_sections['id']['loop'] = is_array($_loop=$this->_tpl_vars['playerdata']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['id']['show'] = true;
$this->_sections['id']['max'] = $this->_sections['id']['loop'];
$this->_sections['id']['step'] = 1;
$this->_sections['id']['start'] = $this->_sections['id']['step'] > 0 ? 0 : $this->_sections['id']['loop']-1;
if ($this->_sections['id']['show']) {
    $this->_sections['id']['total'] = $this->_sections['id']['loop'];
    if ($this->_sections['id']['total'] == 0)
        $this->_sections['id']['show'] = false;
} else
    $this->_sections['id']['total'] = 0;
if ($this->_sections['id']['show']):

            for ($this->_sections['id']['index'] = $this->_sections['id']['start'], $this->_sections['id']['iteration'] = 1;
                 $this->_sections['id']['iteration'] <= $this->_sections['id']['total'];
                 $this->_sections['id']['index'] += $this->_sections['id']['step'], $this->_sections['id']['iteration']++):
$this->_sections['id']['rownum'] = $this->_sections['id']['iteration'];
$this->_sections['id']['index_prev'] = $this->_sections['id']['index'] - $this->_sections['id']['step'];
$this->_sections['id']['index_next'] = $this->_sections['id']['index'] + $this->_sections['id']['step'];
$this->_sections['id']['first']      = ($this->_sections['id']['iteration'] == 1);
$this->_sections['id']['last']       = ($this->_sections['id']['iteration'] == $this->_sections['id']['total']);
?>
  <tr> 
    <td class="nam"><a href="viewPlayer.php?playerid=<?php echo $this->_tpl_vars['playerdata'][$this->_sections['id']['index']]['idplayer']; ?>
"><?php echo $this->_tpl_vars['playerdata'][$this->_sections['id']['index']]['playername']; ?>
</a></td> 
    <td><div align="center"><input type='text' name='firstName[<?php echo $this->_tpl_vars['playerdata'][$this->_sections['id']['index']]['idplayer']; ?>
]' /></div></td>
    <td><div align="center"><input type='text' name='lastName[<?php echo $this->_tpl_vars['playerdata'][$this->_sections['id']['index']]['idplayer']; ?>
]' /></div></td> 
  </tr> 
<?php endfor; endif; ?>
</table>
<input type='submit' name='changeNames' value='Change' />
 <br />
	<h3>Rename Courts</h3>			
	You can choose to rename your courts. Each court rename will cost you 20 credits. <br /> 
	The credits will be deducted once the court name has been approved. <br />
	<form action="requestsMember.php" method="post">			
	<table width="100%" border="1" cellpadding="1" cellspacing="0">
 		
<thead><tr><th width="50%"><center>Name</center></th><th><center>New Name</center></th></thead></tr> 
<?php unset($this->_sections['id1']);
$this->_sections['id1']['name'] = 'id1';
$this->_sections['id1']['loop'] = is_array($_loop=$this->_tpl_vars['courtdata']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['id1']['show'] = true;
$this->_sections['id1']['max'] = $this->_sections['id1']['loop'];
$this->_sections['id1']['step'] = 1;
$this->_sections['id1']['start'] = $this->_sections['id1']['step'] > 0 ? 0 : $this->_sections['id1']['loop']-1;
if ($this->_sections['id1']['show']) {
    $this->_sections['id1']['total'] = $this->_sections['id1']['loop'];
    if ($this->_sections['id1']['total'] == 0)
        $this->_sections['id1']['show'] = false;
} else
    $this->_sections['id1']['total'] = 0;
if ($this->_sections['id1']['show']):

            for ($this->_sections['id1']['index'] = $this->_sections['id1']['start'], $this->_sections['id1']['iteration'] = 1;
                 $this->_sections['id1']['iteration'] <= $this->_sections['id1']['total'];
                 $this->_sections['id1']['index'] += $this->_sections['id1']['step'], $this->_sections['id1']['iteration']++):
$this->_sections['id1']['rownum'] = $this->_sections['id1']['iteration'];
$this->_sections['id1']['index_prev'] = $this->_sections['id1']['index'] - $this->_sections['id1']['step'];
$this->_sections['id1']['index_next'] = $this->_sections['id1']['index'] + $this->_sections['id1']['step'];
$this->_sections['id1']['first']      = ($this->_sections['id1']['iteration'] == 1);
$this->_sections['id1']['last']       = ($this->_sections['id1']['iteration'] == $this->_sections['id1']['total']);
?>
  <tr> 
    <td class="nam"><center><?php echo $this->_tpl_vars['courtdata'][$this->_sections['id1']['index']]['name']; ?>
</center></a></td> 
    <td><div align="center"><input type='text' name='cName[<?php echo $this->_tpl_vars['courtdata'][$this->_sections['id1']['index']]['id']; ?>
]' /></div></td>
  </tr> 
<?php endfor; endif; ?>
</table>
<input type='submit' name='changeCNames' value='Change' />

<?php else: ?>
You are not a member yet. To know how to become a member refer to our <a href='membership.php'>Membership</a> page.
<?php endif; ?>


<br />
<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
 


<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "validuserFooter.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

</html>