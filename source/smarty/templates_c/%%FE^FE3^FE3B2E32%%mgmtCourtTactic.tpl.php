<?php /* Smarty version 2.6.26, created on 2010-07-10 11:07:11
         compiled from mgmtCourtTactic.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_options', 'mgmtCourtTactic.tpl', 110, false),)), $this); ?>
<?php echo '<?xml'; ?>
 version="1.0" encoding="utf-8"<?php echo '?>'; ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
 <title>Welcome</title>
<link href="style.css" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="../includes/js/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="http://tablesorter.com/jquery.tablesorter.min.js"></script>
<?php echo '
<script type="text/javascript"> 
$(document).ready(function()     
{         
$("#courtTable").tablesorter(); 
$("#tacticTable").tablesorter();  
$("#bonusTable").tablesorter();   
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
<p>Click on the link again to view the updated data. DO NOT PRESS REFRESH</p>
<H4>Courts</H4>

<form method='post' action='mgmtCourtTactic.php'>
<fieldset>
<legend>Add New Court</legend>
<label name="court">Court Type:</label> <input type='text' name='court' id='court'  /><br />
<input type='submit' value='Court Create' name='CourtCreate' /> <br />
<?php if ($this->_tpl_vars['errorCourt'] != ""): ?>
			<span style='color:red'>Error: <?php echo $this->_tpl_vars['errorCourt']; ?>
</span>
<?php endif; ?>
<?php if ($this->_tpl_vars['messageCourt'] != ""): ?>
			<span style='color:green'><?php echo $this->_tpl_vars['messageCourt']; ?>
</span>
<?php endif; ?>
</fieldset>
</form>

<table border="1" id="courtTable">
</legend>
<thead>
<tr>
  <th>CourtID</th>
  <th>Court</th>
</tr>
</thead>
<?php unset($this->_sections['id']);
$this->_sections['id']['name'] = 'id';
$this->_sections['id']['loop'] = is_array($_loop=$this->_tpl_vars['courtdata']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
  <td><?php echo $this->_tpl_vars['courtdata'][$this->_sections['id']['index']]->idcourttype; ?>
</td>
  <td><?php echo $this->_tpl_vars['courtdata'][$this->_sections['id']['index']]->name; ?>
</td>
</tr>
<?php endfor; endif; ?>
</table>


<H4>Tactics</H4>
<form method='post' action='mgmtCourtTactic.php'>
<fieldset>
<legend>Add New Tactic</legend>
<label name="tacticname">Tactic Name:</label> <input type='text' name='name' id='name'  /><br />
<label name="tacticshortname">Short Name:</label> <input type='text' name='shortname' id='shortname'  /><br />
<input type='submit' value='Tactic Create' name='TacticCreate' /> <br />
<?php if ($this->_tpl_vars['errorTactic'] != ""): ?>
			<span style='color:red'>Error: <?php echo $this->_tpl_vars['errorTactic']; ?>
</span>
<?php endif; ?>
<?php if ($this->_tpl_vars['messageTactic'] != ""): ?>
			<span style='color:green'><?php echo $this->_tpl_vars['messageTactic']; ?>
</span>
<?php endif; ?>
</fieldset>
</form>

<table border="1" id="tacticTable">
<thead>
<tr>
  <th>TacticID</th>
  <th>Name</th>
  <th>Short</th>
</tr>
</thead>
<?php unset($this->_sections['id']);
$this->_sections['id']['name'] = 'id';
$this->_sections['id']['loop'] = is_array($_loop=$this->_tpl_vars['tacticdata']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
  <td><?php echo $this->_tpl_vars['tacticdata'][$this->_sections['id']['index']]->idtactictype; ?>
</td>
  <td><?php echo $this->_tpl_vars['tacticdata'][$this->_sections['id']['index']]->tacticname; ?>
</td>
  <td><?php echo $this->_tpl_vars['tacticdata'][$this->_sections['id']['index']]->tacticshortname; ?>
</td>
</tr>
<?php endfor; endif; ?>
</table>

<H4>Bonus</H4>
<form method='post' action='mgmtCourtTactic.php'>
<fieldset>
<legend>Add New Bonus</legend>
<label name="tacticname">Tactic Name:</label>
<?php echo smarty_function_html_options(array('name' => 'tacticname','options' => $this->_tpl_vars['tactics'],'selected' => $_POST['tacticname']), $this);?>

<br />
<label name="courtname">Court Name:</label> 
<?php echo smarty_function_html_options(array('name' => 'courtname','options' => $this->_tpl_vars['courts'],'selected' => $_POST['courtname']), $this);?>

<br />
<label name="stat">Stat Name:</label> 
<?php echo smarty_function_html_options(array('name' => 'statname','options' => $this->_tpl_vars['stats'],'selected' => $_POST['statname']), $this);?>
  
<br />
<label name="bonus">Amount of Bonus:</label> <input type='text' name='bonusNum' id='bonusNum'  /><br />
<input type='submit' value='Bonus Create' name='BonusCreate' /> <br />
<?php if ($this->_tpl_vars['errorBonus'] != ""): ?>
			<span style='color:red'>Error: <?php echo $this->_tpl_vars['errorBonus']; ?>
</span>
<?php endif; ?>
<?php if ($this->_tpl_vars['messageBonus'] != ""): ?>
			<span style='color:green'><?php echo $this->_tpl_vars['messageBonus']; ?>
</span>
<?php endif; ?>
</fieldset>
</form>

<table border="1" id="bonusTable">
<thead>
<tr>
  <th>Tactic</th>
  <th>Court</th>
  <th>Stat</th>
  <th>Bonus</th>
</tr>
</thead>
<?php unset($this->_sections['id']);
$this->_sections['id']['name'] = 'id';
$this->_sections['id']['loop'] = is_array($_loop=$this->_tpl_vars['bonusdata']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
  <td><?php echo $this->_tpl_vars['bonusdata'][$this->_sections['id']['index']]->tacticname; ?>
</td>
  <td><?php echo $this->_tpl_vars['bonusdata'][$this->_sections['id']['index']]->name; ?>
</td>
  <td><?php echo $this->_tpl_vars['bonusdata'][$this->_sections['id']['index']]->stats; ?>
</td>
  <td><?php echo $this->_tpl_vars['bonusdata'][$this->_sections['id']['index']]->bonus; ?>
</td>
</tr>
<?php endfor; endif; ?> 
</table>
 
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