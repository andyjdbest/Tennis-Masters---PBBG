<?php /* Smarty version 2.6.26, created on 2010-07-27 09:59:49
         compiled from viewChallenges.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "validuserHeader.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php echo $this->_tpl_vars['message']; ?>

<h1>View Accepted Challenges</h1>
<table>							
<?php unset($this->_sections['id']);
$this->_sections['id']['name'] = 'id';
$this->_sections['id']['loop'] = is_array($_loop=$this->_tpl_vars['challengeAData']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
    <td width="20%" class="nam"><div align="center"><a href="fixtures.php?fixtureid=<?php echo $this->_tpl_vars['challengeAData'][$this->_sections['id']['index']]['id_fixture']; ?>
"><?php echo $this->_tpl_vars['challengeAData'][$this->_sections['id']['index']]['fixture']; ?>
</a></div></td> 
    <td width="30%"><div align="center"><?php echo $this->_tpl_vars['challengeAData'][$this->_sections['id']['index']]['round_date']; ?>
</div></td>  
  </tr> 
<?php endfor; endif; ?>
</table>
<br />

<h1>View Pending Challenges</h1>
<table>							
<?php unset($this->_sections['id']);
$this->_sections['id']['name'] = 'id';
$this->_sections['id']['loop'] = is_array($_loop=$this->_tpl_vars['challengeData']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
    <td width="20%" class="nam"><div align="center"><a href="viewAcademy.php?academy=<?php echo $this->_tpl_vars['challengeData'][$this->_sections['id']['index']]['id_team1']; ?>
"><?php echo $this->_tpl_vars['challengeData'][$this->_sections['id']['index']]['team_name']; ?>
</a></div></td> 
    <td width="30%"><div align="center"><?php echo $this->_tpl_vars['challengeData'][$this->_sections['id']['index']]['date']; ?>
</div></td> 
    <td width="20%"><div align="center"><a href="manageChallenge.php?type=accept&challenge=<?php echo $this->_tpl_vars['challengeData'][$this->_sections['id']['index']]['id_challenge']; ?>
">Accept</a></div></td>
	<td width="20%"><div align="center"><a href="manageChallenge.php?type=decline&challenge=<?php echo $this->_tpl_vars['challengeData'][$this->_sections['id']['index']]['id_challenge']; ?>
">Decline</a></div></td> 
  </tr> 
<?php endfor; endif; ?>
</table>
<br />
 
 <h1>View Issued Challenges</h1>
<table>							
<?php unset($this->_sections['id']);
$this->_sections['id']['name'] = 'id';
$this->_sections['id']['loop'] = is_array($_loop=$this->_tpl_vars['challengeIData']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
    <td width="20%" class="nam"><div align="center"><a href="viewAcademy.php?academy=<?php echo $this->_tpl_vars['challengeIData'][$this->_sections['id']['index']]['id_team2']; ?>
"><?php echo $this->_tpl_vars['challengeIData'][$this->_sections['id']['index']]['team_name']; ?>
</a></div></td> 
    <td width="30%"><div align="center"><?php echo $this->_tpl_vars['challengeIData'][$this->_sections['id']['index']]['date']; ?>
</div></td> 
  </tr> 
<?php endfor; endif; ?>
</table>
<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />	
			

 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "validuserFooter.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
 <?php echo '
<script type="text/javascript"> 
$(document).ready(function()     
{         
$("#challenge").tablesorter();     
}); 
</script>
'; ?>

</html>