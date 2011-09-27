<?php /* Smarty version 2.6.26, created on 2010-07-27 10:18:49
         compiled from viewTrainingReport.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "validuserHeader.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php if ($this->_tpl_vars['error'] != ''): ?>
<div id="error"><?php echo $this->_tpl_vars['error']; ?>
</div>
<?php else: ?>


<h1>Training Report</h1>			
				
<table width="100%" border="1" cellpadding="0" cellspacing="1" id="training">
	<thead> 
  <tr> 
	<th width="20%">Name</th> 
    <th width="30%"><center>Skills</center></th>  
    <th width="15%"><center>Date</center></th> 

  </tr> 
  </thead>
<?php unset($this->_sections['id']);
$this->_sections['id']['name'] = 'id';
$this->_sections['id']['loop'] = is_array($_loop=$this->_tpl_vars['reportData']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
    <td  class="nam"><a href="viewPlayer.php?playerid=<?php echo $this->_tpl_vars['reportData'][$this->_sections['id']['index']]['id_player']; ?>
"><?php echo $this->_tpl_vars['reportData'][$this->_sections['id']['index']]['playername']; ?>
</a></td> 
    <td><div align="left">increased in <b><?php echo $this->_tpl_vars['reportData'][$this->_sections['id']['index']]['skill']; ?>
</b> to <b><?php echo $this->_tpl_vars['reportData'][$this->_sections['id']['index']]['update']; ?>
</b></div></td>  
    <td><div align="center"><?php echo $this->_tpl_vars['reportData'][$this->_sections['id']['index']]['week']; ?>
</div></td>
  </tr> 
<?php endfor; endif; ?>


<?php endif; ?>
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
$("#training").tablesorter();     
}); 
</script>
'; ?>

</html>