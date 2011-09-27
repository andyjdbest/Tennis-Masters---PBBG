<?php /* Smarty version 2.6.26, created on 2010-09-30 20:28:50
         compiled from viewStadium.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'viewStadium.tpl', 25, false),array('function', 'html_options', 'viewStadium.tpl', 27, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "validuserHeader.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
				

<h1>Stadiums</h1>
	You can choose to change your courts here. <br />
	Remember that court changes take at least <strong>4 days</strong> 
	and costs your academy <strong>5,000</strong>
	
	<form action="setStadium.php" method="post">				
	<table width="100%" border="1" cellpadding="1" cellspacing="0" id="stadium"> 
	<thead>
  <tr > 
    <th width="35%">Court</th> 
    <th width="15%"><center>Type</center></th> 
    <th width="20%"><center>Date Requested</center></th> 
    <th width="20%"><center>New Court Type</center></th>  
    <th width = "20%"></th>
  </tr> 
  </thead>
 
<?php unset($this->_sections['id']);
$this->_sections['id']['name'] = 'id';
$this->_sections['id']['loop'] = is_array($_loop=$this->_tpl_vars['stadData']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
  <tr class="nam"> 
    <td><input type="hidden" value="<?php echo $this->_tpl_vars['stadData'][$this->_sections['id']['index']]['number']; ?>
" name="courtNo[]" /><?php echo $this->_tpl_vars['stadData'][$this->_sections['id']['index']]['stad']; ?>
</td> 
    <td><div align="center"><?php echo $this->_tpl_vars['stadData'][$this->_sections['id']['index']]['name1']; ?>
</div></td> 
    	<td><div align="center"><?php echo ((is_array($_tmp=$this->_tpl_vars['stadData'][$this->_sections['id']['index']]['date_change'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y-%m-%d") : smarty_modifier_date_format($_tmp, "%Y-%m-%d")); ?>
</div></td> 
        <td><div align="center"><select name="court[]">
	<?php echo smarty_function_html_options(array('values' => $this->_tpl_vars['courtType'],'output' => $this->_tpl_vars['courtName'],'selected' => $this->_tpl_vars['stadData'][$this->_sections['id']['index']]['court_change']), $this);?>
 
</select></div></td>
<td><center><input type="submit" value=" Change Court <?php echo $this->_sections['id']['index_next']; ?>
 " name="changeCourt"></center></td> 
  </tr> 
<?php endfor; endif; ?>
</table>
<br />
</form>
<br />
<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
 


<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "validuserFooter.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

</html>