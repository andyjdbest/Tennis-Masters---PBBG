<?php /* Smarty version 2.6.26, created on 2010-09-29 20:12:12
         compiled from fixtures.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "validuserHeader.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<h1>Fixture Detail</h1>
<a href="viewAcademy.php?academy=<?php echo $this->_tpl_vars['fixtureData'][0][3]; ?>
"><?php echo $this->_tpl_vars['fixtureData'][0][4]; ?>
</a> <b><?php echo $this->_tpl_vars['fixtureScore'][0]; ?>
 </b> - <b> <?php echo $this->_tpl_vars['fixtureScore'][1]; ?>
 </b> <a href="viewAcademy.php?academy=<?php echo $this->_tpl_vars['fixtureData'][0][5]; ?>
"><?php echo $this->_tpl_vars['fixtureData'][0][6]; ?>
</a><br />
<?php echo $this->_tpl_vars['fixtureData'][0][2]; ?>
 match played on <?php echo $this->_tpl_vars['fixtureData'][0][1]; ?>
 on a <?php echo $this->_tpl_vars['fixtureData'][0][7]; ?>
 court at <?php echo $this->_tpl_vars['fixtureData'][0][9]; ?>

<br /><br />

<?php if ($this->_tpl_vars['matchData'][0][0] > 0): ?>
<h3>Individual Matches</h3>
<table width="60%" border="1" cellpadding="1" cellspacing="0" id="matches"> 
<?php unset($this->_sections['id']);
$this->_sections['id']['name'] = 'id';
$this->_sections['id']['loop'] = is_array($_loop=$this->_tpl_vars['matchData']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
 <td class="nam"><a href="viewPlayer.php?playerid=<?php echo $this->_tpl_vars['matchData'][$this->_sections['id']['index']]['id_player1']; ?>
"><?php echo $this->_tpl_vars['matchData'][$this->_sections['id']['index']]['p1_name']; ?>
</a></td>
  <td><div align="left"><a href="viewMatchSummary.php?matchID=<?php echo $this->_tpl_vars['matchData'][$this->_sections['id']['index']]['id_match']; ?>
">v/s</a></div></td>
  <td class="nam"><div align="right"><a href="viewPlayer.php?playerid=<?php echo $this->_tpl_vars['matchData'][$this->_sections['id']['index']]['id_player2']; ?>
"><?php echo $this->_tpl_vars['matchData'][$this->_sections['id']['index']]['p2_name']; ?>
</a></div></td>
  <td><a href="viewMatchCommentary.php?matchID=<?php echo $this->_tpl_vars['matchData'][$this->_sections['id']['index']]['id_match']; ?>
"><DIV ALIGN="center" STYLE="color:blue">Play-by-Play</div></a></td> 
</tr>
<?php endfor; endif; ?>
</table>
<br />

<a href="viewFixtureTactics.php?fixtureid=<?php echo $this->_tpl_vars['fixtureData'][0][0]; ?>
">View Fixture Tactics</a><br />
 Click on the v/s for score-card and match statistics<br />
 Click on Play-by-Play for match commentary<br />
<?php endif; ?>		
<br /><br /><br /><br /><br /><br /><br /><br />	
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "validuserFooter.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

</html>