<?php /* Smarty version 2.6.26, created on 2010-05-07 15:00:19
         compiled from overview.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "validuserHeader.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php if ($this->_tpl_vars['fire_message'] != ''): ?>
	<div class='error'><?php echo $this->_tpl_vars['fire_message']; ?>
</div>	
<?php endif; ?>

<span>Academy <a href="viewAcademy.php?academy=<?php echo $this->_tpl_vars['idteam']; ?>
"><b><?php echo $this->_tpl_vars['team_name']; ?>
</b></a> in <a href="viewLeague.php?league=<?php echo $this->_tpl_vars['idleague']; ?>
"><b><?php echo $this->_tpl_vars['league_name']; ?>
</b></a> League</span>
<h1>Academy Players</h1>
<table width="100%" border="1" cellpadding="1" cellspacing="0" id="academy"> 
<thead>
	<tr class="tableHeader">

 <th width="30%">Name</th>
   <th width="10%">Rank</th>
  <th width="15%"><center>Age</center></th>
  <th width="15%"><center>Playing Hand</center></th>
  <th width="15%"><center>Fitness</center></th>
  <th width="15%"><center>Rating</center></th>
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
  <?php if ($this->_tpl_vars['playerdata'][$this->_sections['id']['index']]['id_player'] > 0): ?>
    <td class="nam"><a href="viewPlayer.php?playerid=<?php echo $this->_tpl_vars['playerdata'][$this->_sections['id']['index']]['idplayer']; ?>
"><SPAN STYLE="color: green;"><?php echo $this->_tpl_vars['playerdata'][$this->_sections['id']['index']]['playername']; ?>
</span></a></td> 
	<?php else: ?>
	<td class="nam"><a href="viewPlayer.php?playerid=<?php echo $this->_tpl_vars['playerdata'][$this->_sections['id']['index']]['idplayer']; ?>
"><?php echo $this->_tpl_vars['playerdata'][$this->_sections['id']['index']]['playername']; ?>
</a></td> 
	<?php endif; ?>
    <td><div align="center"><?php echo $this->_tpl_vars['playerdata'][$this->_sections['id']['index']]['rank']; ?>
</div></td>
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
</table>

<br />
<h1>Fixture Information</h1>
<table width="100%" border="1" cellpadding="1" cellspacing="0" id="fixtures"> 
<tr class="tableHeader t">
  <th width="15%">Type</th>
  <th width="15%">Date</th>
  <th width="40%">Fixture</th>
  <th width="15%">Court</th>
  <th width="15%">Set Tactics</th>
</tr>
<?php unset($this->_sections['id']);
$this->_sections['id']['name'] = 'id';
$this->_sections['id']['loop'] = is_array($_loop=$this->_tpl_vars['fixturedata']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
 <td class="nam"><?php echo $this->_tpl_vars['fixturedata'][$this->_sections['id']['index']]['name_fixture']; ?>
</td>
  <td><div align="center"><?php echo $this->_tpl_vars['fixturedata'][$this->_sections['id']['index']]['round_date']; ?>
</div></td>
  <td><div align="center"><a href="fixtures.php?fixtureid=<?php echo $this->_tpl_vars['fixturedata'][$this->_sections['id']['index']]['id_fixture']; ?>
"><?php echo $this->_tpl_vars['fixturedata'][$this->_sections['id']['index']]['fixture']; ?>
</a>
  <?php if ($this->_tpl_vars['ts'][$this->_sections['id']['index']] == 1): ?><b>*</b><?php endif; ?></div></td>
  <td><div align="center"><?php echo $this->_tpl_vars['fixturedata'][$this->_sections['id']['index']]['court']; ?>
</div></td>
  <td><div align="center"><a href="viewTactics.php?fixtureid=<?php echo $this->_tpl_vars['fixturedata'][$this->_sections['id']['index']]['id_fixture']; ?>
" class="set">Set Tactics</a></div></td>
</tr>
<?php endfor; endif; ?>
</table>

 
				
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "validuserFooter.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php echo '
<script type="text/javascript"> 
$(document).ready(function()     
{         
$("#academy").tablesorter();     
}); 
</script>
'; ?>

</html>