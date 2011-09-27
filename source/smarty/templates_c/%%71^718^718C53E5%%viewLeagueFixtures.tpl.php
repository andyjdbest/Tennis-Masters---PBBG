<?php /* Smarty version 2.6.26, created on 2010-05-31 08:50:58
         compiled from viewLeagueFixtures.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "validuserHeader.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<h1><?php echo $this->_tpl_vars['leaguename'][0]; ?>
 League Fixtures</h1>

<ol id="toc">
	<li><a href="#complete">Complete</a></li><!-- these comments between li's solve a problem in IE that prevents spaces appearing between list items that appear on different lines in the source
	--><li><a href="#upcoming">Pending</a></li>
</ol>

<div class="tab" id="complete">
<h1>Completed Fixtures</h1>
<?php $this->assign('tmp', ''); ?>
<?php unset($this->_sections['id']);
$this->_sections['id']['name'] = 'id';
$this->_sections['id']['loop'] = is_array($_loop=$this->_tpl_vars['completedData']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
<?php if ($this->_tpl_vars['tmp'] != $this->_tpl_vars['completedData'][$this->_sections['id']['index']]['round']): ?>
 <BR /> <B><?php echo $this->_tpl_vars['completedData'][$this->_sections['id']['index']]['round']; ?>
. <?php echo $this->_tpl_vars['completedData'][$this->_sections['id']['index']]['round_date']; ?>
.</B> <BR />
<?php $this->assign('tmp', $this->_tpl_vars['completedData'][$this->_sections['id']['index']]['round']); ?>
<?php endif; ?>
  <a href='fixtures.php?fixtureid=<?php echo $this->_tpl_vars['completedData'][$this->_sections['id']['index']]['id_fixture']; ?>
'><?php echo $this->_tpl_vars['completedData'][$this->_sections['id']['index']]['t1name']; ?>
 v <?php echo $this->_tpl_vars['completedData'][$this->_sections['id']['index']]['t2name']; ?>
</a> @ <?php echo $this->_tpl_vars['completedData'][$this->_sections['id']['index']]['name']; ?>
 <br />
<?php endfor; endif; ?>			
</div>

<div class="tab" id="upcoming">
<h1>Pending Fixtures</h1>
<?php $this->assign('tmp', ''); ?>
<?php unset($this->_sections['id']);
$this->_sections['id']['name'] = 'id';
$this->_sections['id']['loop'] = is_array($_loop=$this->_tpl_vars['upcomingData']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
<?php if ($this->_tpl_vars['tmp'] != $this->_tpl_vars['upcomingData'][$this->_sections['id']['index']]['round']): ?>
 <BR /> <B><?php echo $this->_tpl_vars['upcomingData'][$this->_sections['id']['index']]['round']; ?>
. <?php echo $this->_tpl_vars['upcomingData'][$this->_sections['id']['index']]['round_date']; ?>
.</B> <BR />
<?php $this->assign('tmp', $this->_tpl_vars['upcomingData'][$this->_sections['id']['index']]['round']); ?>
<?php endif; ?>
  <a href='fixtures.php?fixtureid=<?php echo $this->_tpl_vars['upcomingData'][$this->_sections['id']['index']]['id_fixture']; ?>
'><?php echo $this->_tpl_vars['upcomingData'][$this->_sections['id']['index']]['t1name']; ?>
 v <?php echo $this->_tpl_vars['upcomingData'][$this->_sections['id']['index']]['t2name']; ?>
</a> @ <?php echo $this->_tpl_vars['upcomingData'][$this->_sections['id']['index']]['name']; ?>
 <br />
<?php endfor; endif; ?>			
</div>


 
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "validuserFooter.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php echo '
<script src="activatables.js" type="text/javascript"></script>
<script type="text/javascript">
activatables(\'page\', [\'upcoming\', \'complete\']);
</script>
'; ?>

</html>