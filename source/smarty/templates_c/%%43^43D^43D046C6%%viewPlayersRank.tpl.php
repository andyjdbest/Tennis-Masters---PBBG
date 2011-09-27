<?php /* Smarty version 2.6.26, created on 2010-07-27 10:48:56
         compiled from viewPlayersRank.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'paginate_prev', 'viewPlayersRank.tpl', 29, false),array('function', 'paginate_middle', 'viewPlayersRank.tpl', 29, false),array('function', 'paginate_next', 'viewPlayersRank.tpl', 29, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "validuserHeader.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<h1>Players by Ranking</h1>			

     Players <?php echo $this->_tpl_vars['paginate']['first']; ?>
-<?php echo $this->_tpl_vars['paginate']['last']; ?>
 out of <?php echo $this->_tpl_vars['paginate']['total']; ?>
 displayed.				
<table width="100%" border="1" cellpadding="1" cellspacing="0" id="players">

  <tr class="tableHeader"> 
    <td width="5%"><center>Rank</center</td> 
    <td width="30%"><center>Player</center></td> 
    
    <td width="30%"><center>Academy</center</td> 
  </tr> 
  
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
   <td><?php echo $this->_tpl_vars['results'][$this->_sections['id']['index']]['rank']; ?>
</td>  
   <td class="nam"><center><a href="viewPlayer.php?playerid=<?php echo $this->_tpl_vars['results'][$this->_sections['id']['index']]['idplayer']; ?>
"><?php echo $this->_tpl_vars['results'][$this->_sections['id']['index']]['playername']; ?>
</a></center></td> 
      
      <td><center><a href="viewAcademy.php?academy=<?php echo $this->_tpl_vars['results'][$this->_sections['id']['index']]['id_team']; ?>
"><?php echo $this->_tpl_vars['results'][$this->_sections['id']['index']]['academy_name']; ?>
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
$("#players").tablesorter();     
}); 
</script>
'; ?>

</html>