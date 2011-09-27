<?php /* Smarty version 2.6.26, created on 2010-09-30 20:22:35
         compiled from mgmtAlliances.tpl */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
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
$("#allC").tablesorter();     
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
<form method="post" action="mgmtAlliances.php">
<fieldset>
<legend>Alliances to be Created</legend>
<br />
<span color=red><?php echo $this->_tpl_vars['error']; ?>
 </span> <br />
<span color=red><?php echo $this->_tpl_vars['message']; ?>
 </span> <br />
<table border="1" id="allC">
<thead>
<tr>
  <th>AllianceName</th>
  <th>UserName</th>
  <th>Balance Credits</th>
  <th>Member Till</th>
  <th>Approve</th>
  <th>Decline</th>
</tr>
</thead>
<?php unset($this->_sections['id']);
$this->_sections['id']['name'] = 'id';
$this->_sections['id']['loop'] = is_array($_loop=$this->_tpl_vars['newData']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
  <td><?php echo $this->_tpl_vars['newData'][$this->_sections['id']['index']]->name; ?>
</td>
  <td><?php echo $this->_tpl_vars['newData'][$this->_sections['id']['index']]->username; ?>
</td>
  <td><?php echo $this->_tpl_vars['newData'][$this->_sections['id']['index']]->credits; ?>
</td>
  <td><?php echo $this->_tpl_vars['newData'][$this->_sections['id']['index']]->memberTill; ?>
</td>
  <td><a href="mgmtApprove.php?type=1&r=1&id=<?php echo $this->_tpl_vars['newData'][$this->_sections['id']['index']]->id_alliance; ?>
">Approve</a></td>
  <td><a href="mgmtApprove.php?type=1&r=0&id=<?php echo $this->_tpl_vars['newData'][$this->_sections['id']['index']]->id_alliance; ?>
">Decline</a></td>
</tr>
<?php endfor; endif; ?>
</table>
</fieldset>
</form>
<br />
<form method="post" action="mgmtAlliances.php">
<fieldset>
<legend>Players for Renames</legend>
<br />
<span color=red><?php echo $this->_tpl_vars['error']; ?>
 </span> <br />
<span color=red><?php echo $this->_tpl_vars['message']; ?>
 </span> <br />
<table border="1" id="players">
<thead>
<tr>
  <th>Old_Name</th>
  <th>Player_Name</th>
  <th>UserName</th>
  <th>Balance Credits</th>
  <th>Member Till</th>
  <th>Approve</th>
  <th>Decline</th>
</tr>
</thead>
<?php unset($this->_sections['id']);
$this->_sections['id']['name'] = 'id';
$this->_sections['id']['loop'] = is_array($_loop=$this->_tpl_vars['newPData']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
  <td><?php echo $this->_tpl_vars['newPData'][$this->_sections['id']['index']]->old_value; ?>
</td>	
  <td><?php echo $this->_tpl_vars['newPData'][$this->_sections['id']['index']]->new_value; ?>
</td>
  <td><?php echo $this->_tpl_vars['newPData'][$this->_sections['id']['index']]->username; ?>
</td>
  <td><?php echo $this->_tpl_vars['newPData'][$this->_sections['id']['index']]->credits; ?>
</td>
  <td><?php echo $this->_tpl_vars['newPData'][$this->_sections['id']['index']]->memberTill; ?>
</td>
  <td><a href="mgmtApprove.php?type=2&r=1&id=<?php echo $this->_tpl_vars['newPData'][$this->_sections['id']['index']]->id_nameChange; ?>
">Approve</a></td>
  <td><a href="mgmtApprove.php?type=2&r=0&id=<?php echo $this->_tpl_vars['newPData'][$this->_sections['id']['index']]->id_nameChange; ?>
">Decline</a></td>
</tr>
<?php endfor; endif; ?>
</table>
</fieldset>
</form>

<br />
<form method="post" action="mgmtAlliances.php">
<fieldset>
<legend>Courts for Renames</legend>
<br />
<span color=red><?php echo $this->_tpl_vars['error']; ?>
 </span> <br />
<span color=red><?php echo $this->_tpl_vars['message']; ?>
 </span> <br />
<table border="1" id="courts">
<thead>
<tr>
  <th>Old_Name</th>
  <th>New_Name</th>
  <th>UserName</th>
  <th>Balance Credits</th>
  <th>Member Till</th>
  <th>Approve</th>
  <th>Decline</th>
</tr>
</thead>
<?php unset($this->_sections['id']);
$this->_sections['id']['name'] = 'id';
$this->_sections['id']['loop'] = is_array($_loop=$this->_tpl_vars['newCData']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
  <td><?php echo $this->_tpl_vars['newCData'][$this->_sections['id']['index']]->old_value; ?>
</td>	
  <td><?php echo $this->_tpl_vars['newCData'][$this->_sections['id']['index']]->new_value; ?>
</td>
  <td><?php echo $this->_tpl_vars['newCData'][$this->_sections['id']['index']]->username; ?>
</td>
  <td><?php echo $this->_tpl_vars['newCData'][$this->_sections['id']['index']]->credits; ?>
</td>
  <td><?php echo $this->_tpl_vars['newCData'][$this->_sections['id']['index']]->memberTill; ?>
</td>
  <td><a href="mgmtApprove.php?type=3&r=1&id=<?php echo $this->_tpl_vars['newCData'][$this->_sections['id']['index']]->id_nameChange; ?>
">Approve</a></td>
  <td><a href="mgmtApprove.php?type=3&r=0&id=<?php echo $this->_tpl_vars['newCData'][$this->_sections['id']['index']]->id_nameChange; ?>
">Decline</a></td>
</tr>
<?php endfor; endif; ?>
</table>
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