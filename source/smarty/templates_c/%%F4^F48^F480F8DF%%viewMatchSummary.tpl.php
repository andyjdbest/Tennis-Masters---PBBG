<?php /* Smarty version 2.6.26, created on 2010-06-20 15:06:46
         compiled from viewMatchSummary.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "validuserHeader.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<h1>Match Detail</h1>
<?php if ($this->_tpl_vars['matchData']['fixture_type'] < 3): ?>
<a href="viewAcademy.php?academy=<?php echo $this->_tpl_vars['matchData']['a1_id']; ?>
"><?php echo $this->_tpl_vars['matchData']['a1_name']; ?>
</a> 
<a href="fixtures.php?fixtureid=<?php echo $this->_tpl_vars['matchData']['id_fixture']; ?>
">versus</a> <a href="viewAcademy.php?academy=<?php echo $this->_tpl_vars['matchData']['a2_id']; ?>
"><?php echo $this->_tpl_vars['matchData']['a2_name']; ?>
</a><br />
<?php endif; ?>
<?php echo $this->_tpl_vars['matchData']['name_fixture']; ?>
 match played on <?php echo $this->_tpl_vars['matchData']['round_date']; ?>
 on a <?php echo $this->_tpl_vars['matchData']['name']; ?>
 court
<br /><br />

<table cellspacing='20' class="Score">
<thead>
<tr class="tableHeader">
<th class="Corner">Score</th>
<th colspan=5>1</th>
<th colspan=5>2</th>
<th colspan=5>3</th>
</tr>
</thead>

<tbody>
<tr>
<th><a href="viewPlayer.php?playerid=<?php echo $this->_tpl_vars['matchData']['id_player1']; ?>
"><?php echo $this->_tpl_vars['matchData']['p1_name']; ?>
</a>
<?php if ($this->_tpl_vars['matchData']['id_player1'] == $this->_tpl_vars['matchData']['id_winner']): ?><img src="assets/images/winner.gif" /><?php endif; ?>
</th>

<th colspan=5><?php echo $this->_tpl_vars['playerScore'][0][0]; ?>
</td>
<th colspan=5><?php echo $this->_tpl_vars['playerScore'][0][1]; ?>
</td>
<th colspan=5><?php echo $this->_tpl_vars['playerScore'][0][2]; ?>
</td>
</tr>

<tr>
<th><a href="viewPlayer.php?playerid=<?php echo $this->_tpl_vars['matchData']['id_player2']; ?>
"><?php echo $this->_tpl_vars['matchData']['p2_name']; ?>
</a>
<?php if ($this->_tpl_vars['matchData']['id_player2'] == $this->_tpl_vars['matchData']['id_winner']): ?><img src="assets/images/winner.gif" /><?php endif; ?></th>
<th colspan=5><?php echo $this->_tpl_vars['playerScore'][1][0]; ?>
</td>
<th colspan=5><?php echo $this->_tpl_vars['playerScore'][1][1]; ?>
</td>
<th colspan=5><?php echo $this->_tpl_vars['playerScore'][1][2]; ?>
</td>
</tr>

</tbody>

</table>
<br/>


<table cellspacing='20' class="Score">
<thead>
<tr class="tableHeader">
<th class="Corner">Stats</th>
<th ><?php echo $this->_tpl_vars['matchData']['p1_name']; ?>
</th>
<th ><?php echo $this->_tpl_vars['matchData']['p2_name']; ?>
</th>
</tr>
</thead>

<tbody>
<tr>
<th><b>1st Serve %</b></th>
<td><div align="center"><?php echo $this->_tpl_vars['statsData'][0][0]; ?>
</div></td>
<td><div align="center"><?php echo $this->_tpl_vars['statsData'][1][0]; ?>
</div></td>
</tr>
<tr>
<th><b>Aces</b></th>
<td><div align="center"><?php echo $this->_tpl_vars['statsData'][0][1]; ?>
</div></td>
<td><div align="center"><?php echo $this->_tpl_vars['statsData'][1][1]; ?>
</div></td>
</tr>
<tr>
<th><b>Double Faults</b></th>
<td><div align="center"><?php echo $this->_tpl_vars['statsData'][0][2]; ?>
</div></td>
<td><div align="center"><?php echo $this->_tpl_vars['statsData'][1][2]; ?>
</div></td>
</tr>
<tr>
<th><b>Unforced Errors</b></th>
<td><div align="center"><?php echo $this->_tpl_vars['statsData'][0][3]; ?>
</div></td>
<td><div align="center"><?php echo $this->_tpl_vars['statsData'][1][3]; ?>
</div></td>
</tr>
<tr>
<th><b>Winners</b></th>
<td><div align="center"></div></td>
<td><div align="center"></div></td>
</tr>

</tbody>

</table>
<br/><br>

				
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "validuserFooter.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

</html>