<?php /* Smarty version 2.6.26, created on 2010-09-20 11:23:17
         compiled from searchTM.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "validuserHeader.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php if ($this->_tpl_vars['error'] != ''): ?>
<div id="error"><?php echo $this->_tpl_vars['error']; ?>
</div>
<?php else: ?>


<h1>Free Agents</h1>			
				
<table width="120%" border="1" cellpadding="1" cellspacing="1" id="players">
	<thead> 
  <tr> 
	<th >Name</th> 
	<th ><center>Set Price</center></th>
	<th ><center>Age</center></th>  
    <th ><center>SRV</center></th> 
    <th ><center>VLY</center></th> 
    <th ><center>FHD</center></th> 
    <th ><center>BHD</center></th> 
    <th ><center>CON</center></th> 
    <th ><center>STM</center></th> 
    <th ><center>PWR</center></th> 
    <th ><center>SPD</center></th> 
    <th ><center>Rating</center></th>
  </tr> 
  </thead>
<?php unset($this->_sections['id']);
$this->_sections['id']['name'] = 'id';
$this->_sections['id']['loop'] = is_array($_loop=$this->_tpl_vars['transfer_data']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
    <td  class="nam"><a href="viewFreeAgent.php?playerid=<?php echo $this->_tpl_vars['transfer_data'][$this->_sections['id']['index']]['id_player']; ?>
"><?php echo $this->_tpl_vars['transfer_data'][$this->_sections['id']['index']]['playername']; ?>
</a></td> 
    <td><div align="center"><?php echo $this->_tpl_vars['transfer_data'][$this->_sections['id']['index']]['set_price']; ?>
</div></td>
	<td><div align="center"><?php echo $this->_tpl_vars['transfer_data'][$this->_sections['id']['index']]['age']; ?>
</div></td>
    <td><div align="center"><?php echo $this->_tpl_vars['transfer_data'][$this->_sections['id']['index']]['serve']; ?>
</div></td> 
    <td><div align="center"><?php echo $this->_tpl_vars['transfer_data'][$this->_sections['id']['index']]['volley']; ?>
</div></td> 
    <td><div align="center"><?php echo $this->_tpl_vars['transfer_data'][$this->_sections['id']['index']]['forehand']; ?>
</div></td> 
    <td><div align="center"><?php echo $this->_tpl_vars['transfer_data'][$this->_sections['id']['index']]['backhand']; ?>
</div></td> 
    <td><div align="center"><?php echo $this->_tpl_vars['transfer_data'][$this->_sections['id']['index']]['consistency']; ?>
</div></td> 
    <td><div align="center"><?php echo $this->_tpl_vars['transfer_data'][$this->_sections['id']['index']]['stamina']; ?>
</div></td> 
    <td><div align="center"><?php echo $this->_tpl_vars['transfer_data'][$this->_sections['id']['index']]['power']; ?>
</div></td> 
    <td><div align="center"><?php echo $this->_tpl_vars['transfer_data'][$this->_sections['id']['index']]['speed']; ?>
</div></td>  
    <td><div align="center"><?php echo $this->_tpl_vars['transfer_data'][$this->_sections['id']['index']]['srating']; ?>
</div></td>
  </tr> 
<?php endfor; endif; ?>



</table>  				
<?php endif; ?>
 
				
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