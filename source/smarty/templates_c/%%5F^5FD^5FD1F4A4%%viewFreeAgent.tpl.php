<?php /* Smarty version 2.6.26, created on 2010-09-22 11:09:16
         compiled from viewFreeAgent.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "validuserHeader.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php if ($this->_tpl_vars['transfer_message'] != ""): ?>
	<div class="error"><?php echo $this->_tpl_vars['transfer_message']; ?>
</div>
<?php endif; ?>

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
	<td class="nam"><span style="font-size:12px;"><strong><?php echo $this->_tpl_vars['playerdata']['playername']; ?>
</strong></span></td> 
     <td><div align="center"><?php echo $this->_tpl_vars['playerdata']['nationality']; ?>
</div></td> 
    <td><div align="center"><?php echo $this->_tpl_vars['playerdata']['age']; ?>
</div></td> 
    <td><div align="center"><?php echo $this->_tpl_vars['playerdata']['handed']; ?>
</div></td> 
    <td><div align="center"><?php echo $this->_tpl_vars['playerdata']['fitness']; ?>
</div></td> 
    <td><div align="center"><?php echo $this->_tpl_vars['playerdata']['srating']; ?>
</div></td> 
   <td><div align="center"><?php echo $this->_tpl_vars['playerdata']['wage']; ?>
</div></td> 
   <td><div align="center"><?php echo $this->_tpl_vars['playerdata']['set_price']; ?>
</div></td> 
  </tr> 
</table>  
 
    <br />
	<span style="font-size:16px;"><strong>Skills</strong></span>
	<table width=50%>
<tr><td>
<table id="primary" align="Right">	
<tr>
  <td>Serve</td><td><?php echo $this->_tpl_vars['playerdata']['serve']; ?>
</td>
</tr>
  <tr>
  <td>Volley</td><td><?php echo $this->_tpl_vars['playerdata']['volley']; ?>
</td>
  </tr>
  <tr>
  <td>Forehand</td><td><?php echo $this->_tpl_vars['playerdata']['forehand']; ?>
</td>
  </tr>
  <tr>
  <td>Backhand</td><td><?php echo $this->_tpl_vars['playerdata']['backhand']; ?>
</td>
  </tr>
</table>
</td>
 <td>
 
<table width=50% id="secondary" align="Right">
	<tr>
  <td>Consistency</td><td><?php echo $this->_tpl_vars['playerdata']['consistency']; ?>
</td>
  </tr>
  <tr>
  <td>Stamina</td><td><?php echo $this->_tpl_vars['playerdata']['stamina']; ?>
</td>
  </tr>
  <tr>
  <td>Power</td><td><?php echo $this->_tpl_vars['playerdata']['power']; ?>
</td>
  </tr>
  <tr>
  <td>Speed</td><td><?php echo $this->_tpl_vars['playerdata']['speed']; ?>
</td>
  <td>
  	</tr>
</table>
</table>

<br />
<span style="font-size:16px;"><strong>Statistics</strong></span> <br />
<span class="gp">Played: <?php echo $this->_tpl_vars['played']; ?>
 Won: <?php echo $this->_tpl_vars['wins']; ?>
</span><br />
<p>Grass: <span><?php echo $this->_tpl_vars['courtV'][0]; ?>
</span>&nbsp;&nbsp; Clay: <span><?php echo $this->_tpl_vars['courtV'][1]; ?>
</span>&nbsp;&nbsp; Hardcourt: <span><?php echo $this->_tpl_vars['courtV'][2]; ?>
</span>&nbsp;&nbsp; Synthetic: <span><?php echo $this->_tpl_vars['courtV'][3]; ?>
</span></p>

<br />

<form method='post' action='bidPlayer.php'>
	<span style="font-size:16px;"><strong>Transfer</strong></span> <br />
	<input type="hidden" name="playerId" value=<?php echo $this->_tpl_vars['playerdata']['idplayer']; ?>
>
<fieldset>
<legend>Bid on Player</legend>
<table border='0'>
<tr><td class="sell">Bid on player?<br /></td></tr>
<tr><td><input type='text' name='bid_value' value=<?php echo $this->_tpl_vars['playerdata']['set_price']; ?>
 /></td>
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
<?php if ($this->_tpl_vars['publicBidData'][0][0] > 0): ?>
<h1>Public Bids</h1>
<table width="100%" border="1" cellpadding="1" cellspacing="0" id="bids"> 
  <thead> 
  <tr>
   <th width="40%">Academy Name</th> 
   <th width="20%">Bid Value</th> 
  </tr> 
  </thead>
  <?php unset($this->_sections['id']);
$this->_sections['id']['name'] = 'id';
$this->_sections['id']['loop'] = is_array($_loop=$this->_tpl_vars['publicBidData']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
	<td class="nam"><a href="viewAcademy.php?academy=<?php echo $this->_tpl_vars['publicBidData'][$this->_sections['id']['index']]['id_team']; ?>
"><?php echo $this->_tpl_vars['publicBidData'][$this->_sections['id']['index']]['team_name']; ?>
</a></td> 
    <td><div align="center"><?php echo $this->_tpl_vars['publicBidData'][$this->_sections['id']['index']]['bid']; ?>
</div></td> 
  </tr> 
  <?php endfor; endif; ?>
</table>  
<?php endif; ?>
<br />
<?php if ($this->_tpl_vars['privateBid'] != 'a'): ?>
<h1>Private Bids</h1>
<?php echo $this->_tpl_vars['privateBid']; ?>
 <br />
<?php endif; ?>
<?php if ($this->_tpl_vars['ownBid'] != ''): ?>
<h1>Your Bid</h1>
<?php echo $this->_tpl_vars['ownBid']; ?>

<?php endif; ?>
<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />	
<br />
 
				
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "validuserFooter.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

</html>