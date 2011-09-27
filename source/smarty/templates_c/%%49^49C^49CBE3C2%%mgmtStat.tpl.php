<?php /* Smarty version 2.6.26, created on 2010-04-16 18:12:01
         compiled from mgmtStat.tpl */ ?>
<?php echo '<?xml'; ?>
 version="1.0" encoding="utf-8"<?php echo '?>'; ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
 <title>Stats & Fixtures</title>
<link href="style.css" rel="stylesheet" type="text/css" />
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

<H4>Stat Values</H4>
<table border="1">
<tr>
  <th>ValueNum</th>
  <th>ValueName</th>
</tr>
<?php unset($this->_sections['id']);
$this->_sections['id']['name'] = 'id';
$this->_sections['id']['loop'] = is_array($_loop=$this->_tpl_vars['resultValue']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
  <td><?php echo $this->_tpl_vars['resultValue'][$this->_sections['id']['index']]->valuenum; ?>
</td>
  <td><?php echo $this->_tpl_vars['resultValue'][$this->_sections['id']['index']]->valuetext; ?>
</td>
</tr>
<?php endfor; endif; ?>
</table>

<H4></H4>
<form method='post' action='mgmtStat.php'>
<fieldset>
<legend>Add New Stat Value</legend>
<label name="VauleNum">ValueNum:</label> <input type='text' name='valuenum' id='valuenum'  /><br />
<label name="ValueText">ValueText:</label> <input type='text' name='valuetext' id='valuetext'  /><br />
<input type='submit' value='Add Value' name='AddValue' />
</fieldset>
<br />
<?php if ($this->_tpl_vars['errorValue'] != ""): ?>
			<span style='color:red'>Error: <?php echo $this->_tpl_vars['errorValue']; ?>
</span>
<?php endif; ?>
<?php if ($this->_tpl_vars['messageValue'] != ""): ?>
			<span style='color:green'><?php echo $this->_tpl_vars['messageValue']; ?>
</span>
<?php endif; ?>
</form>


<H4>Fixtures</H4>
<table border="1">
<tr>
  <th>Fixture ID</th>
  <th>Fixture Name</th>
</tr>
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
<tr>
  <td><?php echo $this->_tpl_vars['fixturedata'][$this->_sections['id']['index']]->id_fixture; ?>
</td>
  <td><?php echo $this->_tpl_vars['fixturedata'][$this->_sections['id']['index']]->name_fixture; ?>
</td>
</tr>
<?php endfor; endif; ?>
</table>
<br />

<form method='post' action='mgmtStat.php'>
<fieldset>
<legend>Add New Fixture</legend>
<label name="fixId">Fixture ID:</label> <input type='text' name='fixID' id='fixID'  /><br />
<label name="fixName">Fixture Name:</label> <input type='text' name='fixName' id='fixName'  /><br />
<input type='submit' value='Add Fixture' name='AddFixture' />
</fieldset>
<br />
<?php if ($this->_tpl_vars['errorFixture'] != ""): ?>
			<span style='color:red'>Error: <?php echo $this->_tpl_vars['errorFixture']; ?>
</span>
<?php endif; ?>
<?php if ($this->_tpl_vars['messageFixture'] != ""): ?>
			<span style='color:green'><?php echo $this->_tpl_vars['messageFixture']; ?>
</span>
<?php endif; ?>
</form>

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