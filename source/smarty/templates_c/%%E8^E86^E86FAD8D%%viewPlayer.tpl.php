<?php /* Smarty version 2.6.26, created on 2010-09-20 11:24:51
         compiled from viewPlayer.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "validuserHeader.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php if ($this->_tpl_vars['transfer_message'] != ""): ?>
	<div class="error"><?php echo $this->_tpl_vars['transfer_message']; ?>
</div>
<?php endif; ?>

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
	<td class="nam"><span style="font-size:12px;"><strong><?php echo $this->_tpl_vars['playerdata']['playername']; ?>
</strong></span></td> 
    <td><div align="center"><?php echo $this->_tpl_vars['playerdata']['wrank']; ?>
</div></td> 
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
  </tr> 
 
</table>  
 
<?php if ($this->_tpl_vars['own'] == 1): ?>
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

<span style="font-size:16px;"><strong>Statistics</strong></span> <br />
<span class="gp">Played: <?php echo $this->_tpl_vars['played']; ?>
 Won: <?php echo $this->_tpl_vars['wins']; ?>
</span><br />
<p>Grass: <span><?php echo $this->_tpl_vars['courtV'][0]; ?>
</span>&nbsp;&nbsp; Clay: <span><?php echo $this->_tpl_vars['courtV'][1]; ?>
</span>&nbsp;&nbsp; Hardcourt: <span><?php echo $this->_tpl_vars['courtV'][2]; ?>
</span>&nbsp;&nbsp; Synthetic: <span><?php echo $this->_tpl_vars['courtV'][3]; ?>
</span></p>



<form method='post' action='movePlayer.php'>
	<span style="font-size:16px;"><strong>Transfer</strong></span> <br />
	<input type="hidden" name="playerId" value=<?php echo $this->_tpl_vars['playerdata']['idplayer']; ?>
>
<table>
<tr><td class="sell">Make <?php echo $this->_tpl_vars['playerdata']['playername']; ?>
 a free agent?<br />
<input type='submit' value='Yes' name="sell" />
</td></tr>
</form>		
</table>
<?php endif; ?>


<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />	
<br />
 
				
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "validuserFooter.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

</html>