<?php /* Smarty version 2.6.26, created on 2010-08-04 11:43:35
         compiled from viewLeague.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "validuserHeader.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php unset($this->_sections['id']);
$this->_sections['id']['name'] = 'id';
$this->_sections['id']['loop'] = is_array($_loop=$this->_tpl_vars['leaguedata']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
<?php if ($this->_tpl_vars['tmp'] != $this->_tpl_vars['leaguedata'][$this->_sections['id']['index']]->nameleague): ?>
<h1><?php echo $this->_tpl_vars['leaguedata'][$this->_sections['id']['index']]->nameleague; ?>
 League Table</h1>
<?php $this->assign('tmp', $this->_tpl_vars['leaguedata'][$this->_sections['id']['index']]->nameleague); ?>
<?php endif; ?>
<?php endfor; endif; ?>
				
	<table width="100%" border="1" cellpadding="1" cellspacing="0" id="league">
		 
  <tr class="tableHeader"> 
    <td width="10%"><center>Rank</center></td> 
    <td width="40%"><center>Academy</center></td> 
    <td width="10%"><center>Played</center></td> 
    <td width="10%"><center>Won</center></td> 
    <td width="10%"><center>Lost</center></td> 
    <td width="10%"><center>Points</center></td> 
    <td width="10%"><center>Diff</center></td> 
  </tr> 
  
<?php unset($this->_sections['id']);
$this->_sections['id']['name'] = 'id';
$this->_sections['id']['loop'] = is_array($_loop=$this->_tpl_vars['leaguedata']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
	<?php echo '<tr><td><div align="center">'; ?><?php echo $this->_tpl_vars['leaguedata'][$this->_sections['id']['index']]->rank; ?><?php echo '</div></td><td><div align="left"><a href=\'viewAcademy.php?academy='; ?><?php echo $this->_tpl_vars['leaguedata'][$this->_sections['id']['index']]->id_team; ?><?php echo '\'>'; ?><?php echo $this->_tpl_vars['leaguedata'][$this->_sections['id']['index']]->team_name; ?><?php echo '</div></td><td><div align="center">'; ?><?php echo $this->_tpl_vars['leaguedata'][$this->_sections['id']['index']]->played; ?><?php echo '</div></td><td><div align="center">'; ?><?php echo $this->_tpl_vars['leaguedata'][$this->_sections['id']['index']]->won; ?><?php echo '</div></td><td><div align="center">'; ?><?php echo $this->_tpl_vars['leaguedata'][$this->_sections['id']['index']]->lost; ?><?php echo '</div></td><td><div align="center">'; ?><?php echo $this->_tpl_vars['leaguedata'][$this->_sections['id']['index']]->points; ?><?php echo '</div></td><td><div align="center">'; ?><?php echo $this->_tpl_vars['leaguedata'][$this->_sections['id']['index']]->pr; ?><?php echo '</div></td></tr>'; ?>
 
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
$("#league").tablesorter();     
}); 
</script>
'; ?>

</html>