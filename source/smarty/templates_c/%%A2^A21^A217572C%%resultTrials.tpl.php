<?php /* Smarty version 2.6.26, created on 2010-08-04 09:11:38
         compiled from resultTrials.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "validuserHeader.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php if ($this->_tpl_vars['error'] == ''): ?>
<br />
The following player is available for selection.<br />
<span style='color:green'><?php echo $this->_tpl_vars['playerData']['firstname']; ?>
 <?php echo $this->_tpl_vars['playerData']['lastname']; ?>
 </span> <b><?php echo $this->_tpl_vars['playerData']['age']; ?>
</b> years from <b><?php echo $this->_tpl_vars['playerData']['nationality']; ?>
</b> playing <b><?php echo $this->_tpl_vars['playerData']['handed']; ?>
</b> handed. <br />
If you decide to keep him, hit the "Keep" button, else the player will be let go. <br />
<br />
<form method='post' action='keepPlayer.php'>
<table cellspacing='3'>
<thead><tr>
<td>SRV</td>
<td>VLY</td>
<td>FHD</td>
<td>BHD</td>
<td>CON</td>
<td>STM</td>
<td>PWR</td>
<td>SPD</td>
<td>Rating</td>
</tr></thead>
<tbody>
<td><?php echo $this->_tpl_vars['playerData']['serve']; ?>
</td>
<td><?php echo $this->_tpl_vars['playerData']['volley']; ?>
</td>
<td><?php echo $this->_tpl_vars['playerData']['forehand']; ?>
</td>
<td><?php echo $this->_tpl_vars['playerData']['backhand']; ?>
</td>
<td><?php echo $this->_tpl_vars['playerData']['consistency']; ?>
</td>
<td><?php echo $this->_tpl_vars['playerData']['stamina']; ?>
</td>
<td><?php echo $this->_tpl_vars['playerData']['power']; ?>
</td>
<td><?php echo $this->_tpl_vars['playerData']['speed']; ?>
</td>
<td><?php echo $this->_tpl_vars['playerData']['rating']; ?>
</td>
</tbody>
</table>
<input type='submit' name='keep' value='Keep' />
<input type='hidden' name='id' value=<?php echo $this->_tpl_vars['playerData']['id_trial']; ?>
 /> <br />  
<input type='submit' name='fire' value='Let Go' />
</form>
<?php else: ?>
<span style='color:red'>Error: <?php echo $this->_tpl_vars['error']; ?>
</span>
<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
<?php endif; ?>
			

 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "validuserFooter.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
 
</html>