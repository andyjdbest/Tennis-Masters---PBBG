<?php /* Smarty version 2.6.26, created on 2010-10-03 08:08:44
         compiled from viewAcademy.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "validuserHeader.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php if ($this->_tpl_vars['manager_id'] != ''): ?>
<a href="challenge.php?academy=<?php echo $this->_tpl_vars['id_team']; ?>
"><img src="assets/images/action_go.gif" alt="Challenge"></a>
<span>Academy <a href="viewAcademy.php?academy=<?php echo $this->_tpl_vars['id_team']; ?>
"><b><?php echo $this->_tpl_vars['team_name']; ?>
</b></a> in <a href="viewLeague.php?league=<?php echo $this->_tpl_vars['id_league']; ?>
"><b><?php echo $this->_tpl_vars['league_name']; ?>
</b></a> League
managed by <a href="viewManagerInfo.php?user=<?php echo $this->_tpl_vars['user']; ?>
"><?php echo $this->_tpl_vars['manager_name']; ?>
</a> </span>
<?php else: ?>
<a href="challenge.php?academy=<?php echo $this->_tpl_vars['id_team']; ?>
"><img src="assets/images/action_go.gif" alt="Challenge"></a>
<span>Academy <a href="viewAcademy.php?academy=<?php echo $this->_tpl_vars['id_team']; ?>
"><b><?php echo $this->_tpl_vars['team_name']; ?>
</b></a> in <a href="viewLeague.php?league=<?php echo $this->_tpl_vars['id_league']; ?>
"><b><?php echo $this->_tpl_vars['league_name']; ?>
</b></a> League
- Unmanaged </span>
<?php endif; ?>
<br />
<?php if ($this->_tpl_vars['allID'] > 0): ?>
<b>Alliance Member:</b> <a href='viewAlliance.php?alliance=<?php echo $this->_tpl_vars['allID']; ?>
'><?php echo $this->_tpl_vars['alliance']; ?>
</a><br />
<?php endif; ?>
<b>Form > Last 5 Games:</b> <?php echo $this->_tpl_vars['form']; ?>

<br />
<b>Fans:</b> <?php echo $this->_tpl_vars['fans']; ?>
<?php if ($this->_tpl_vars['fan_move'] == 1): ?><img src="assets/images/smiley.png" alt="Happy">
<?php else: ?><img src="assets/images/smiley_sad.png" alt="Sad"><?php endif; ?>
<br />
<br />
<h1>Academy Players</h1>			
				
	<table width="100%" border="1" cellpadding="1" cellspacing="0" id="players">
		<?php if ($this->_tpl_vars['own'] == 1): ?> 
<thead>
  <tr class="tableHeader"> 
    <td width="30%">Name</td> 
    <td width="10%"><center>Rank</center></th>
    <td width="15%"><center>Age</center></td> 
    <td width="15%"><center>Hand</center></td> 
    <td width="15%"><center>SRV</center></td> 
    <td width="15%"><center>VLY</center></td> 
    <td width="15%"><center>FHD</center></td> 
    <td width="15%"><center>BHD</center></td> 
    <td width="15%"><center>CON</center></td> 
    <td width="15%"><center>STM</center></td> 
    <td width="15%"><center>PWR</center></td> 
    <td width="15%"><center>SPD</center></td> 
    <td width="15%"><center>FIT</center></td> 
    <td width="15%"><center>Rating</center></td> 
    <td width="15%"><center>Wage</center></td>
  </tr> 
  </thead>
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
    <td><div align="center"><?php echo $this->_tpl_vars['playerdata'][$this->_sections['id']['index']]['wrank']; ?>
</div></td> 
    <td><div align="center"><?php echo $this->_tpl_vars['playerdata'][$this->_sections['id']['index']]['age']; ?>
</div></td> 
    <td><div align="center"><?php echo $this->_tpl_vars['playerdata'][$this->_sections['id']['index']]['handed']; ?>
</div></td> 
    <td><div align="center"><?php echo $this->_tpl_vars['playerdata'][$this->_sections['id']['index']]['serve']; ?>
</div></td> 
    <td><div align="center"><?php echo $this->_tpl_vars['playerdata'][$this->_sections['id']['index']]['volley']; ?>
</div></td> 
    <td><div align="center"><?php echo $this->_tpl_vars['playerdata'][$this->_sections['id']['index']]['forehand']; ?>
</div></td> 
    <td><div align="center"><?php echo $this->_tpl_vars['playerdata'][$this->_sections['id']['index']]['backhand']; ?>
</div></td> 
    <td><div align="center"><?php echo $this->_tpl_vars['playerdata'][$this->_sections['id']['index']]['consistency']; ?>
</div></td> 
    <td><div align="center"><?php echo $this->_tpl_vars['playerdata'][$this->_sections['id']['index']]['stamina']; ?>
</div></td> 
    <td><div align="center"><?php echo $this->_tpl_vars['playerdata'][$this->_sections['id']['index']]['power']; ?>
</div></td> 
    <td><div align="center"><?php echo $this->_tpl_vars['playerdata'][$this->_sections['id']['index']]['speed']; ?>
</div></td> 
    <td><div align="center"><?php echo $this->_tpl_vars['playerdata'][$this->_sections['id']['index']]['fitness']; ?>
</div></td> 
    <td><div align="center"><?php echo $this->_tpl_vars['playerdata'][$this->_sections['id']['index']]['srating']; ?>
</div></td>
	<td><div align="center"><?php echo $this->_tpl_vars['playerdata'][$this->_sections['id']['index']]['wage']; ?>
</div></td>  
  </tr> 
<?php endfor; endif; ?>

<?php else: ?> 
<thead>
  <tr class="tableHeader"> 
    <td width="40%">Name</td> 
    <td width="15%"><center>Age</center></td> 
    <td width="15%"><center>Hand</center></td> 
    <td width="15%"><center>Fitness</center></td> 
    <td width="15%"><center>Rating</center></td> 
	
  </tr> 
</thead>
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
    <td><div align="center"><?php echo $this->_tpl_vars['playerdata'][$this->_sections['id']['index']]['age']; ?>
</div></td> 
    <td><div align="center"><?php echo $this->_tpl_vars['playerdata'][$this->_sections['id']['index']]['handed']; ?>
</div></td> 
    <td><div align="center"><?php echo $this->_tpl_vars['playerdata'][$this->_sections['id']['index']]['fitness']; ?>
</div></td> 
    <td><div align="center"><?php echo $this->_tpl_vars['playerdata'][$this->_sections['id']['index']]['srating']; ?>
</div></td>
	  
  </tr> 
<?php endfor; endif; ?>
<?php endif; ?>
</table>  				

 <h1>Academy Stats</h1>
 <ol id="toc">
	<li><a href="#season">Season</a></li><!-- these comments between li's solve a problem in IE that prevents spaces appearing between list items that appear on different lines in the source
	--><li><a href="#all">All-Time</a></li>
</ol>

<div class="tab" id="season">
<table width="100%" >
<thead><th colspan='2'>Grass</th><th colspan='2'>Clay</th><th colspan='2'>Hard</th><th colspan='2'>Synthetic</th></thead>
<tr class="tableHeader" align="center"><td>P </td><td>W </td><td>P </td><td>W </td><td>P </td><td>W </td><td>P </td><td>W </td></tr>
<tr align="center">
<td><?php echo $this->_tpl_vars['seasonStats'][1][0]; ?>
 </td><td><?php echo $this->_tpl_vars['seasonStats'][1][1]; ?>
 </td><td><?php echo $this->_tpl_vars['seasonStats'][2][0]; ?>
 </td><td><?php echo $this->_tpl_vars['seasonStats'][2][1]; ?>
 </td>
<td><?php echo $this->_tpl_vars['seasonStats'][3][0]; ?>
 </td><td><?php echo $this->_tpl_vars['seasonStats'][3][1]; ?>
 </td><td><?php echo $this->_tpl_vars['seasonStats'][4][0]; ?>
 </td><td><?php echo $this->_tpl_vars['seasonStats'][4][1]; ?>
 </td>
</tr>
</table>
</div>
<div class="tab" id="all">
<table width="100%" >
<thead><th colspan='2'>Grass</th><th colspan='2'>Clay</th><th colspan='2'>Hard</th><th colspan='2'>Synthetic</th></thead>
<tr class="tableHeader" align="center"><td>P </td><td>W </td><td>P </td><td>W </td><td>P </td><td>W </td><td>P </td><td>W </td></tr>
<tr align="center">
<td><?php echo $this->_tpl_vars['alltimeStats'][1][0]; ?>
 </td><td><?php echo $this->_tpl_vars['alltimeStats'][1][1]; ?>
 </td><td><?php echo $this->_tpl_vars['alltimeStats'][2][0]; ?>
 </td><td><?php echo $this->_tpl_vars['alltimeStats'][2][1]; ?>
 </td>
<td><?php echo $this->_tpl_vars['alltimeStats'][3][0]; ?>
 </td><td><?php echo $this->_tpl_vars['alltimeStats'][3][1]; ?>
 </td><td><?php echo $this->_tpl_vars['alltimeStats'][4][0]; ?>
 </td><td><?php echo $this->_tpl_vars['alltimeStats'][4][1]; ?>
 </td>
</tr>
</table>
</div>
<br />	
<br /><br /><br />			
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "validuserFooter.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php echo '
<script type="text/javascript"> 
$(document).ready(function()     
{         
$("#players").tablesorter();
}); 
</script>
<script src="activatables.js" type="text/javascript"></script>
<script type="text/javascript">
activatables(\'page\', [\'season\', \'all\']);
</script>

'; ?>

</html>