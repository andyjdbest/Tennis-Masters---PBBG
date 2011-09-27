<?php /* Smarty version 2.6.26, created on 2010-07-27 09:58:58
         compiled from viewFixtures.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "validuserHeader.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<ol id="toc">
	<li><a href="#aComplete">Academy Complete</a></li><!-- these comments between li's solve a problem in IE that prevents spaces appearing between list items that appear on different lines in the source
	--><li><a href="#aUpcoming">Academy Pending</a></li><!-- these comments between li's solve a problem in IE that prevents spaces appearing between list items that appear on different lines in the source
	--><li><a href="#pComplete">Player Complete</a></li><!-- these comments between li's solve a problem in IE that prevents spaces appearing between list items that appear on different lines in the source
	--><li><a href="#pUpcoming">Player Pending</a></li>
</ol>

<div class="tab" id="aComplete">
<h1>Completed Fixtures</h1>
<table width="100%" border="1" cellpadding="1" cellspacing="0" id="fixtures"> 
<tr class="tableHeader t">
  <th width="15%">Type</th>
  <th width="15%">Date</th>
  <th width="40%">Fixture</th>
  <th width="15%">Court</th>
</tr>
<?php unset($this->_sections['id']);
$this->_sections['id']['name'] = 'id';
$this->_sections['id']['loop'] = is_array($_loop=$this->_tpl_vars['completed']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
 <td class="nam"><?php echo $this->_tpl_vars['completed'][$this->_sections['id']['index']]['name_fixture']; ?>
</td>
  <td><div align="center"><?php echo $this->_tpl_vars['completed'][$this->_sections['id']['index']]['round_date']; ?>
</div></td>
  <td><div align="center"><a href="fixtures.php?fixtureid=<?php echo $this->_tpl_vars['completed'][$this->_sections['id']['index']]['id_fixture']; ?>
"><?php echo $this->_tpl_vars['completed'][$this->_sections['id']['index']]['fixture']; ?>
</a></div></td>
  <td><div align="center"><?php echo $this->_tpl_vars['completed'][$this->_sections['id']['index']]['court']; ?>
</div></td>
</tr>
<?php endfor; endif; ?>
</table>
</div>

<div class="tab" id="aUpcoming">
<h1>Upcoming Fixtures</h1>
<table width="100%" border="1" cellpadding="1" cellspacing="0" id="upcoming"> 
<tr class="tableHeader t">
  <th width="15%">Type</th>
  <th width="15%">Date</th>
  <th width="40%">Fixture</th>
  <th width="15%">Court</th>
  <th width="15%">Set Tactics</th>
</tr>
<?php unset($this->_sections['id']);
$this->_sections['id']['name'] = 'id';
$this->_sections['id']['loop'] = is_array($_loop=$this->_tpl_vars['upcoming']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
 <td class="nam"><?php echo $this->_tpl_vars['upcoming'][$this->_sections['id']['index']]['name_fixture']; ?>
</td>
  <td><div align="center"><?php echo $this->_tpl_vars['upcoming'][$this->_sections['id']['index']]['round_date']; ?>
</div></td>
  <td><div align="center"><a href="fixtures.php?fixtureid=<?php echo $this->_tpl_vars['upcoming'][$this->_sections['id']['index']]['id_fixture']; ?>
"><?php echo $this->_tpl_vars['upcoming'][$this->_sections['id']['index']]['fixture']; ?>
  </a>
  <?php if ($this->_tpl_vars['ts'][$this->_sections['id']['index']] == 1): ?><b>*</b><?php endif; ?>
</div></td>
  <td><div align="center"><?php echo $this->_tpl_vars['upcoming'][$this->_sections['id']['index']]['court']; ?>
</div></td>
  <td><div align="center"><a href="viewTactics.php?fixtureid=<?php echo $this->_tpl_vars['upcoming'][$this->_sections['id']['index']]['id_fixture']; ?>
" class="set">Set Tactics</a></div></td>
</tr>
<?php endfor; endif; ?>
</table>
</div> 

<div class="tab" id="pComplete">
<table width="100%" border="1" cellpadding="1" cellspacing="0" id="fixtures"> 
<tr class="tableHeader t">
  <th width="15%">Type</th>
  <th width="15%">Date</th>
  <th width="40%">Fixture</th>
  <th width="15%">Round</th>
</tr>
<?php unset($this->_sections['id']);
$this->_sections['id']['name'] = 'id';
$this->_sections['id']['loop'] = is_array($_loop=$this->_tpl_vars['cPlayers']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
 <td class="nam"><?php echo $this->_tpl_vars['cPlayers'][$this->_sections['id']['index']]['name_fixture']; ?>
</td>
  <td><div align="center"><?php echo $this->_tpl_vars['cPlayers'][$this->_sections['id']['index']]['round_date']; ?>
</div></td>
  <td><div align="center"><a href="viewMatchSummary.php?matchID=<?php echo $this->_tpl_vars['cPlayers'][$this->_sections['id']['index']]['id_match']; ?>
"><?php echo $this->_tpl_vars['cPlayers'][$this->_sections['id']['index']]['game']; ?>
</a></div></td>
  <td><div align="center"><?php echo $this->_tpl_vars['cPlayers'][$this->_sections['id']['index']]['round']; ?>
</div></td>
</tr>
<?php endfor; endif; ?>
</table>
</div>

<div class="tab" id="pUpcoming">
<table width="100%" border="1" cellpadding="1" cellspacing="0" id="pfixtures"> 
<tr class="tableHeader t">
  <th width="10%">Type</th>
  <th width="15%">Date</th>
  <th width="40%">Fixture</th>
  <th width="20%">Player</th>
  <th width="10%">Court</th>
  <th width="15%">Set Tactics</th>
</tr>
<?php unset($this->_sections['id']);
$this->_sections['id']['name'] = 'id';
$this->_sections['id']['loop'] = is_array($_loop=$this->_tpl_vars['uPlayers']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
 <td class="nam"><?php echo $this->_tpl_vars['uPlayers'][$this->_sections['id']['index']]['name_fixture']; ?>
</td>
  <td><div align="center"><?php echo $this->_tpl_vars['uPlayers'][$this->_sections['id']['index']]['round_date']; ?>
</div></td>
  <td><div align="center"><a href="viewMatchSummary.php?matchID=<?php echo $this->_tpl_vars['uPlayers'][$this->_sections['id']['index']]['id_match']; ?>
"><?php echo $this->_tpl_vars['uPlayers'][$this->_sections['id']['index']]['game']; ?>
</a>
  <?php if ($this->_tpl_vars['uPlayers'][$this->_sections['id']['index']]['playerName1'] != ''): ?>
  <td><div align="center"><?php echo $this->_tpl_vars['uPlayers'][$this->_sections['id']['index']]['playerName1']; ?>
</div></td>
  <?php endif; ?>
  <?php if ($this->_tpl_vars['uPlayers'][$this->_sections['id']['index']]['playerName2'] != ''): ?>
  <td><div align="center"><?php echo $this->_tpl_vars['uPlayers'][$this->_sections['id']['index']]['playerName2']; ?>
</div></td>
  <?php endif; ?>
  <td><div align="center"><?php echo $this->_tpl_vars['uPlayers'][$this->_sections['id']['index']]['court']; ?>
</div></td>
  <?php if ($this->_tpl_vars['uPlayers'][$this->_sections['id']['index']]['playerName1'] != ''): ?>
  <td><div align="center"><a href="viewTactics.php?matchid=<?php echo $this->_tpl_vars['uPlayers'][$this->_sections['id']['index']]['id_match']; ?>
&playerid=<?php echo $this->_tpl_vars['uPlayers'][$this->_sections['id']['index']]['playerID1']; ?>
" class="set">Set Tactics</a></div></td>
  <?php endif; ?>
  <?php if ($this->_tpl_vars['uPlayers'][$this->_sections['id']['index']]['playerName2'] != ''): ?>
  <td><div align="center"><a href="viewTactics.php?matchid=<?php echo $this->_tpl_vars['uPlayers'][$this->_sections['id']['index']]['id_match']; ?>
&playerid=<?php echo $this->_tpl_vars['uPlayers'][$this->_sections['id']['index']]['playerID2']; ?>
" class="set">Set Tactics</a></div></td>
  <?php endif; ?>
</tr>
<?php endfor; endif; ?>
</table>
</div>
<br /><br /><br /><br /><br /><br /><br />				
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "validuserFooter.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php echo '
<script src="activatables.js" type="text/javascript"></script>
<script type="text/javascript">
activatables(\'page\', [\'aUpcoming\', \'aComplete\', \'pUpcoming\', \'pComplete\']);
</script>
'; ?>

</html>