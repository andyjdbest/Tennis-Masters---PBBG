<?php /* Smarty version 2.6.26, created on 2010-07-10 11:07:23
         compiled from mgmtUser.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_options', 'mgmtUser.tpl', 30, false),)), $this); ?>
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
<H4>Users</H4>
<form method='post' action='mgmtUser.php'>
<fieldset>
<legend>Add / Modify New User(s)</legend>
<label name="searchUserID">Select Existing User ID:</label> 
<select name='userid'>
<?php echo smarty_function_html_options(array('values' => $this->_tpl_vars['sUserId'],'output' => $this->_tpl_vars['sUserId'],'selected' => $_POST['userid']), $this);?>
 
</select>
<input type='submit' value='Search' name='search' />
<br />
<br />
<label name="username">UserName:</label> <input type='text' name='username' id='username' value=<?php echo $this->_tpl_vars['user']['username']; ?>
 /><br />
<label name="email">Email:</label> <input type='text' name='email' id='email'  value=<?php echo $this->_tpl_vars['user']['email']; ?>
 /><br />
<label name="firstname">Firstname:</label> <input type='text' name='firstname' id='firstname'  value=<?php echo $this->_tpl_vars['user']['firstname']; ?>
 /><br />
<label name="lastname">Lastname:</label> <input type='text' name='lastname' id='lastname'  value=<?php echo $this->_tpl_vars['user']['lastname']; ?>
 /><br />
<label name="isValidated">isValidated:</label> <input type='text' name='isValidated' id='isValidated'  value=<?php echo $this->_tpl_vars['user']['isValidated']; ?>
 /><br />
<label name="isAdmin">isAdmin:</label> <input type='text' name='isAdmin' id='isAdmin'  value=<?php echo $this->_tpl_vars['user']['isAdmin']; ?>
 /><br />
<label name="isAssigned">isAssigned:</label> <input type='text' name='isAssigned' id='isAssigned'  value=<?php echo $this->_tpl_vars['user']['isAssigned']; ?>
 /><br />
<input type='submit' value='Create' name='create' /> 
<input type='submit' value='Update' name='update' /> <br />
<?php if ($this->_tpl_vars['error'] != ""): ?>
			<span style='color:red'>Error: <?php echo $this->_tpl_vars['error']; ?>
</span>
<?php endif; ?>
<?php if ($this->_tpl_vars['message'] != ""): ?>
			<span style='color:green'><?php echo $this->_tpl_vars['message']; ?>
</span>
<?php endif; ?>
</fieldset>
</form>
<br />


<H4>Dormant Users</H4>
<form method='post' action='mgmtUser.php'>
<fieldset>
<legend>View & Delete Dormant User(s)</legend>
<table border="1" id="dormant">
<thead>
<tr>
  <th>User ID</th>
  <th>User Name</th>
</tr>
</thead>
<?php unset($this->_sections['id']);
$this->_sections['id']['name'] = 'id';
$this->_sections['id']['loop'] = is_array($_loop=$this->_tpl_vars['dormantData']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
  <td><?php echo $this->_tpl_vars['dormantData'][$this->_sections['id']['index']]->userid; ?>
</td>
  <td><?php echo $this->_tpl_vars['dormantData'][$this->_sections['id']['index']]->username; ?>
</td>
</tr>
<?php endfor; endif; ?>
<input type='submit' value='Delete' name='deleteDormant' />
</table>

<?php if ($this->_tpl_vars['errorDormant'] != ""): ?>
			<span style='color:red'>Error: <?php echo $this->_tpl_vars['errorDormant']; ?>
</span>
<?php endif; ?>

</fieldset>
</form>

<H4>Users Unvalidated</H4>
<form method='post' action='mgmtUser.php'>
<fieldset>
<legend>View & Delete Unvalidated User(s)</legend>
<table border="1" id="unvalid">
<thead>
<tr>
  <th>User ID</th>
  <th>User Name</th>
</tr>
</thead>
<?php unset($this->_sections['id']);
$this->_sections['id']['name'] = 'id';
$this->_sections['id']['loop'] = is_array($_loop=$this->_tpl_vars['unvalidData']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
  <td><?php echo $this->_tpl_vars['unvalidData'][$this->_sections['id']['index']]->userid; ?>
</td>
  <td><?php echo $this->_tpl_vars['unvalidData'][$this->_sections['id']['index']]->username; ?>
</td>
</tr>
<?php endfor; endif; ?>
<input type='submit' value='Delete' name='deleteUnvalid' />
</table>

<?php if ($this->_tpl_vars['errorUnvalid'] != ""): ?>
			<span style='color:red'>Error: <?php echo $this->_tpl_vars['errorUnvalid']; ?>
</span>
<?php endif; ?>

</fieldset>
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