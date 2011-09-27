<?php /* Smarty version 2.6.26, created on 2010-09-29 07:01:38
         compiled from viewTransferredPlayers.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "validuserHeader.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>


<ol id="toc">
	<li><a href="#purchased">Purchased</a></li><!-- these comments between li's solve a problem in IE that prevents spaces appearing between list items that appear on different lines in the source
	--><li><a href="#free">Let-Go</a></li>
</ol>

<div class="tab" id="purchased">
<h1>Purchased Players</h1>

<?php if ($this->_tpl_vars['pur_data'][0][0] != ""): ?>
<table >
<thead><tr><th>Player</th><th>Price</th><th>Date</th></tr>
</thead>
<tbody>
<?php unset($this->_sections['id']);
$this->_sections['id']['name'] = 'id';
$this->_sections['id']['loop'] = is_array($_loop=$this->_tpl_vars['pur_data']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
  <td><a href='viewPlayer.php?playerid=<?php echo $this->_tpl_vars['pur_data'][$this->_sections['id']['index']]['idplayer']; ?>
'><?php echo $this->_tpl_vars['pur_data'][$this->_sections['id']['index']]['name']; ?>
</a></td>
  <td><?php echo $this->_tpl_vars['pur_data'][$this->_sections['id']['index']]['value']; ?>
</td>
  <td><?php echo $this->_tpl_vars['pur_data'][$this->_sections['id']['index']]['date']; ?>
</td>
  </tr>
<?php endfor; endif; ?>
</tbody>			
</table>
<?php else: ?>
You have not purchased any players this season. Hmm.....
<?php endif; ?>
</div>


<div class="tab" id="free">
<h1>Players Let Go</h1>

<?php if ($this->_tpl_vars['sol_data'][0][0] != ""): ?>
<table >
<thead><tr><th>Player</th><th>Price</th><th>Date</th></tr>
</thead>
<tbody>
<?php unset($this->_sections['id']);
$this->_sections['id']['name'] = 'id';
$this->_sections['id']['loop'] = is_array($_loop=$this->_tpl_vars['sol_data']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
  <td><a href='viewPlayer.php?playerid=<?php echo $this->_tpl_vars['sol_data'][$this->_sections['id']['index']]['idplayer']; ?>
'><?php echo $this->_tpl_vars['sol_data'][$this->_sections['id']['index']]['name']; ?>
</a></td>
  <td><?php echo $this->_tpl_vars['sol_data'][$this->_sections['id']['index']]['set_price']; ?>
</td>
  <td><?php echo $this->_tpl_vars['sol_data'][$this->_sections['id']['index']]['date_free']; ?>
</td>
  </tr>
<?php endfor; endif; ?>
</tbody>			
</table>
<?php else: ?>
You have not sold any players this season. Hmm.....
<?php endif; ?>
</div>
 
 <br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />	
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "validuserFooter.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php echo '
<script src="activatables.js" type="text/javascript"></script>
<script type="text/javascript">
activatables(\'page\', [\'purchased\', \'free\']);
</script>
'; ?>

</html>