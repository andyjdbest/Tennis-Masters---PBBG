<?php /* Smarty version 2.6.26, created on 2010-07-10 10:15:14
         compiled from mviewLeague.tpl */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
 <title>Welcome</title>
<link href="../style.css" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="../includes/js/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="http://tablesorter.com/jquery.tablesorter.min.js"></script>
<?php echo '
<script type="text/javascript"> 
$(document).ready(function()     
{         
$("#league").tablesorter();     
} 
); 
</script>
'; ?>

</head>

<body>
<div id="wrapper">
<div id="header"><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "mgmtheader.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</div>
<div id="container">
<div id="left">
<ul id="nav">
</ul>
</div>
<div id="center">
		
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
	<H4><?php echo $this->_tpl_vars['leaguedata'][$this->_sections['id']['index']]->nameleague; ?>
 League Table</H4>
<?php $this->assign('tmp', $this->_tpl_vars['leaguedata'][$this->_sections['id']['index']]->nameleague); ?>
<?php endif; ?>
<?php endfor; endif; ?>

<table border="1" id="league">
<thead>
<tr>
  <th>Position</th>
  <th>Academy</th>
  <th>Played</th>
  <th>Won</th>
  <th>Lost</th>
  <th>Points</th>
</tr>
</thead>
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
<?php echo '<tr><td>'; ?><?php echo $this->_sections['id']['index_next']; ?><?php echo '</td><td><a href=\'viewAcademy.php?academy='; ?><?php echo $this->_tpl_vars['leaguedata'][$this->_sections['id']['index']]->id_team; ?><?php echo '\'>'; ?><?php echo $this->_tpl_vars['leaguedata'][$this->_sections['id']['index']]->team_name; ?><?php echo '</a></td><td>'; ?><?php echo $this->_tpl_vars['leaguedata'][$this->_sections['id']['index']]->played; ?><?php echo '</td><td>'; ?><?php echo $this->_tpl_vars['leaguedata'][$this->_sections['id']['index']]->won; ?><?php echo '</td><td>'; ?><?php echo $this->_tpl_vars['leaguedata'][$this->_sections['id']['index']]->lost; ?><?php echo '</td><td>'; ?><?php echo $this->_tpl_vars['leaguedata'][$this->_sections['id']['index']]->points; ?><?php echo '</td></tr>'; ?>

<?php endfor; endif; ?>
</table>

<br /> <br />
<h4>Fixtures</h4>
<?php $this->assign('tmp', ''); ?>
<?php unset($this->_sections['id']);
$this->_sections['id']['name'] = 'id';
$this->_sections['id']['loop'] = is_array($_loop=$this->_tpl_vars['fixturedata']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
<?php if ($this->_tpl_vars['tmp'] != $this->_tpl_vars['fixturedata'][$this->_sections['id']['index']]->round): ?>
  <B><?php echo $this->_tpl_vars['fixturedata'][$this->_sections['id']['index']]->round; ?>
.</B> <BR />
<?php $this->assign('tmp', $this->_tpl_vars['fixturedata'][$this->_sections['id']['index']]->round); ?>
<?php endif; ?>
  <a href='viewAcademy.php?academy=<?php echo $this->_tpl_vars['fixturedata'][$this->_sections['id']['index']]->t1id; ?>
'><?php echo $this->_tpl_vars['fixturedata'][$this->_sections['id']['index']]->t1name; ?>
</a> v <a href='viewAcademy.php?academy=<?php echo $this->_tpl_vars['fixturedata'][$this->_sections['id']['index']]->t2id; ?>
'><?php echo $this->_tpl_vars['fixturedata'][$this->_sections['id']['index']]->t2name; ?>
</a> @ <?php echo $this->_tpl_vars['fixturedata'][$this->_sections['id']['index']]->name; ?>
 <br />
<?php endfor; endif; ?>

</div>
<div id="right">Test Right</div>
<div class="clearer"></div>                
</div>
<div id="footer"><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "mgmtfooter.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</div>
</div>
</div>

</body>
</html>