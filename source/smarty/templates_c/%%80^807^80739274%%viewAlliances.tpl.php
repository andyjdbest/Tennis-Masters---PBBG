<?php /* Smarty version 2.6.26, created on 2010-09-25 09:24:22
         compiled from viewAlliances.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'paginate_prev', 'viewAlliances.tpl', 25, false),array('function', 'paginate_middle', 'viewAlliances.tpl', 25, false),array('function', 'paginate_next', 'viewAlliances.tpl', 25, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "validuserHeader.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<h1>Alliances</h1>			

     Alliances <?php echo $this->_tpl_vars['paginate']['first']; ?>
-<?php echo $this->_tpl_vars['paginate']['last']; ?>
 out of <?php echo $this->_tpl_vars['paginate']['total']; ?>
 displayed.				
<table width="100%" border="1" cellpadding="1" cellspacing="0" id="alliances">
  <thead><tr>	  
    <th width="30%"><center>Name</center></th> 
    <th width="20%"><center>Points</center</th>
   <th width="20%"><center>Members</center</th>  
  </tr></thead>  
<?php unset($this->_sections['id']);
$this->_sections['id']['name'] = 'id';
$this->_sections['id']['loop'] = is_array($_loop=$this->_tpl_vars['results']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
   <td class="nam"><center><a href="viewAlliance.php?alliance=<?php echo $this->_tpl_vars['results'][$this->_sections['id']['index']]['id_alliance']; ?>
"><?php echo $this->_tpl_vars['results'][$this->_sections['id']['index']]['name']; ?>
</a></center></td> 
   <td><center><?php echo $this->_tpl_vars['results'][$this->_sections['id']['index']]['points']; ?>
</a></center></td>
  <td><center><?php echo $this->_tpl_vars['results'][$this->_sections['id']['index']]['members']; ?>
</a></center></td>   
  </tr> 
<?php endfor; endif; ?>

</table>  		
<br />
		
    <?php echo smarty_function_paginate_prev(array(), $this);?>
  <?php echo smarty_function_paginate_middle(array(), $this);?>
  <?php echo smarty_function_paginate_next(array(), $this);?>

<br />
<br /> 
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
$("#alliances").tablesorter();     
}); 
</script>
'; ?>

</html>