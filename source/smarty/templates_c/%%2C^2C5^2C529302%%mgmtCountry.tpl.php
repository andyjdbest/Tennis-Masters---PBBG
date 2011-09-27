<?php /* Smarty version 2.6.26, created on 2010-05-12 09:17:03
         compiled from mgmtCountry.tpl */ ?>
<?php echo '<?xml'; ?>
 version="1.0" encoding="utf-8"<?php echo '?>'; ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
 <title>Welcome</title>
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
<H4>Countries & Managers</H4>
<table border="1">
<tr>
  <th>Country_Ab</th>
  <th>Country_Name</th>
  <th>Free Slots</th>
</tr>
<?php unset($this->_sections['id']);
$this->_sections['id']['name'] = 'id';
$this->_sections['id']['loop'] = is_array($_loop=$this->_tpl_vars['result']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
  <td><?php echo $this->_tpl_vars['result'][$this->_sections['id']['index']]->countryshort; ?>
</td>
  <td><?php echo $this->_tpl_vars['result'][$this->_sections['id']['index']]->countryname; ?>
</td>
  <td><?php echo $this->_tpl_vars['result'][$this->_sections['id']['index']]->free; ?>
</td>
</tr>
<?php endfor; endif; ?>
</table>
<H4></H4>
<form method='post' action='mgmtCountry.php'>
<fieldset>
<legend>Create New Country</legend>
<label name="short">ShortName:</label> <input type='text' name='shortname' id='shortname'  /><br />
<label name="fullname">FullName:</label> <input type='text' name='countryname' id='countryname'  /><br />

<input type='submit' value='Create' name = 'create'/> <br />
</fieldset>
<?php if ($this->_tpl_vars['error'] != ""): ?>
			<span style='color:red'>Error: <?php echo $this->_tpl_vars['error']; ?>
</span>
<?php endif; ?>
<?php if ($this->_tpl_vars['message'] != ""): ?>
			<span style='color:green'><?php echo $this->_tpl_vars['message']; ?>
</span>
<?php endif; ?>
</form>
<BR />
<form method='post' action='mgmtCountry.php'>
<fieldset>
<legend>Create Nations Cup Fixtures</legend>
<label name="date">Date Time:</label> <input type='text' name='dateTime' id='dateTime'  /><br />
<input type='submit' value='Generate' name = 'genFix'/> <br />
</fieldset>
<?php if ($this->_tpl_vars['error'] != ""): ?>
			<span style='color:red'>Error: <?php echo $this->_tpl_vars['error']; ?>
</span>
<?php endif; ?>
<?php if ($this->_tpl_vars['message'] != ""): ?>
			<span style='color:green'><?php echo $this->_tpl_vars['message']; ?>
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