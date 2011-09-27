<?php /* Smarty version 2.6.26, created on 2010-09-21 10:36:28
         compiled from mgmtPlayer.tpl */ ?>
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
$("#player").tablesorter();     
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
<H4>Players</H4>
<H4></H4>
<form method='post' action='mgmtPlayer.php'>
<fieldset>
<legend>Add New Player(s)</legend>
<label name="country">CountryAbbrev:</label> <input type='text' name='country' id='shortname'  /><br />
<label name="number">NumberofPlayers:</label> <input type='text' name='number' id='number'  /><br />
<label name="amin">Age MIN (17):</label> <input type='text' name='min_age' id='min_age'  /><br />
<label name="amax">Age MAX (30):</label> <input type='text' name='max_age' id='max_age'  /><br />
<label name="smin">Stats MIN (1):</label> <input type='text' name='min_stat' id='min_stat'  /><br />
<label name="smax">Stats MAX (15):</label> <input type='text' name='max_stat' id='max_stat'  /><br />
<label name="youth">Senior - 0 / Youth - 1:</label> <input type='text' name='youth' id='youth'  /><br />
<label name="free">FreeAgent - 1 / Normal - 0:</label> <input type='text' name='free' id='free' value ='0' /><br />
<input type='submit' value='Create' /> <br />  
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

<H4>Players</H4>
<table border="1" id="player"> 
<thead>
<tr>
  <th>PID</th>
  <th>FirstName</th>
  <th>LastName</th>
  <th>Country</th>
  <th>Youth</th>
  <th>Serve</th>
  <th>Forehand</th>
  <th>Backhand</th>
  <th>Volley</th>
  <th>Cons</th>
  <th>Power</th>
  <th>Speed</th>
  <th>Stamina</th>
</tr>
</thead>
<p>Listing all Players takes too long, hence will not be shown.</p>
<?php unset($this->_sections['id']);
$this->_sections['id']['name'] = 'id';
$this->_sections['id']['loop'] = is_array($_loop=$this->_tpl_vars['playerdata']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
  <td><?php echo $this->_tpl_vars['playerdata'][$this->_sections['id']['index']]->idplayer; ?>
</td>
  <td><?php echo $this->_tpl_vars['playerdata'][$this->_sections['id']['index']]->firstname; ?>
</td>
  <td><?php echo $this->_tpl_vars['playerdata'][$this->_sections['id']['index']]->lastname; ?>
</td>
  <td><?php echo $this->_tpl_vars['playerdata'][$this->_sections['id']['index']]->countryshort; ?>
</td>
  <td><?php echo $this->_tpl_vars['playerdata'][$this->_sections['id']['index']]->youth; ?>
</td>
  <td><?php echo $this->_tpl_vars['playerdata'][$this->_sections['id']['index']]->serve; ?>
</td>
  <td><?php echo $this->_tpl_vars['playerdata'][$this->_sections['id']['index']]->forehand; ?>
</td>
  <td><?php echo $this->_tpl_vars['playerdata'][$this->_sections['id']['index']]->backhand; ?>
</td>
  <td><?php echo $this->_tpl_vars['playerdata'][$this->_sections['id']['index']]->volley; ?>
</td>
  <td><?php echo $this->_tpl_vars['playerdata'][$this->_sections['id']['index']]->consistency; ?>
</td>
  <td><?php echo $this->_tpl_vars['playerdata'][$this->_sections['id']['index']]->power; ?>
</td>
  <td><?php echo $this->_tpl_vars['playerdata'][$this->_sections['id']['index']]->speed; ?>
</td>
  <td><?php echo $this->_tpl_vars['playerdata'][$this->_sections['id']['index']]->stamina; ?>
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