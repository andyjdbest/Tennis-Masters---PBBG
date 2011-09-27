<?php /* Smarty version 2.6.26, created on 2010-07-27 09:49:55
         compiled from viewCoaches.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "validuserHeader.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php if ($this->_tpl_vars['own'] == 1): ?>
<h1>Coach Details</h1>
							
	<table width="100%" border="1" cellpadding="1" cellspacing="0" id="coach"> 
	<thead>
  <tr class="tableHeader t"> 
    <th width="20%">Coach</td> 
    <th width="15%"><center>Age</center></td> 
    <th width="20%"><center>Level</center></td> 
  </tr> 
  </thead>
  
<?php unset($this->_sections['id']);
$this->_sections['id']['name'] = 'id';
$this->_sections['id']['loop'] = is_array($_loop=$this->_tpl_vars['coachdata']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
    <td class="nam"><div align="center"><a href="viewCoach.php?coachID=<?php echo $this->_tpl_vars['coachdata'][$this->_sections['id']['index']]['id_coach']; ?>
"><?php echo $this->_tpl_vars['coachdata'][$this->_sections['id']['index']]['name_coach']; ?>
</a></div></td> 
    <td><div align="center"><?php echo $this->_tpl_vars['coachdata'][$this->_sections['id']['index']]['age']; ?>
</div></td> 
    <td><div align="center"><?php echo $this->_tpl_vars['coachdata'][$this->_sections['id']['index']]['name_coachlevel']; ?>
</div></td> 
  </tr> 
<?php endfor; endif; ?>
</table>
<br />
<form action="manageCoach.php" method="post" accept-charset="utf-8">
	<p>Enter Number of new Coaches: <input type="text" name="numCoaches" /> <p><input type="submit" name="buy" value="Buy New" /></p>
</form>
<label class="sell">Cost of each Coach = 3000</label> <br />
<label class="sell">Each new coach opens a new training slot</label>
<?php else: ?>
<br />
 <div class="error">Error: <?php echo $this->_tpl_vars['error']; ?>
</div> <br />
 
<?php endif; ?>	
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
$("#coach").tablesorter();     
}); 
</script>
'; ?>

</html>