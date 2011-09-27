<?php /* Smarty version 2.6.26, created on 2010-05-17 11:12:41
         compiled from mgmtLeague.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_options', 'mgmtLeague.tpl', 35, false),)), $this); ?>
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
<form method="post" action="mgmtLeague.php">
<fieldset>
<legend>League Setup per Country</legend>
<br />
<?php echo smarty_function_html_options(array('name' => 'countryL','options' => $this->_tpl_vars['countries'],'selected' => $_POST['countryL']), $this);?>

<input type='submit' value='Check' name='Show' /> <br />
<span color=red><?php echo $this->_tpl_vars['error']; ?>
 </span> <br />
<table border="1" id="league">
<thead>
<tr>
  <th>LeagueID</th>
  <th>LeagueName</th>
  <th>League Position</th>
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
<tr>
  <td><a href='viewLeague.php?league=<?php echo $this->_tpl_vars['leaguedata'][$this->_sections['id']['index']]->idleague; ?>
'><?php echo $this->_tpl_vars['leaguedata'][$this->_sections['id']['index']]->idleague; ?>
</a></td>
  <td><?php echo $this->_tpl_vars['leaguedata'][$this->_sections['id']['index']]->nameleague; ?>
</td>
  <td><?php echo $this->_tpl_vars['leaguedata'][$this->_sections['id']['index']]->league_pos; ?>
</td>
</tr>
<?php endfor; endif; ?>
</table>
</fieldset>
</form>
<br />
<form method="post" action="mgmtLeague.php">
<fieldset>
<legend>Academy Setup</legend>
<br />
<?php echo smarty_function_html_options(array('name' => 'countryAcademy','options' => $this->_tpl_vars['countries'],'selected' => $_POST['countryAcademy']), $this);?>
 <br />

Number: <input type='text' name='number' id='number'  /> 

<input type='submit' value='Create Academies' name='CreateAcademy' /> <br />

<span color='red'><?php echo $this->_tpl_vars['errorCreateAcademy']; ?>
 </span>
<span color='green''><?php echo $this->_tpl_vars['messageCreateAcademy']; ?>
 </span> <br />


<?php echo smarty_function_html_options(array('name' => 'countrySM','options' => $this->_tpl_vars['countries'],'selected' => $_POST['countrySM']), $this);?>


<input type='submit' value='Assign Senior Players to Academy' name='SeniorAcademy' /> <br />

<span color='red'><?php echo $this->_tpl_vars['errorSeniorAcademy']; ?>
 </span>
<span color='green''><?php echo $this->_tpl_vars['messageSeniorAcademy']; ?>
 </span> <br />
</fieldset>
<br />

<fieldset>
<legend>League Setup</legend>
<br />
<?php echo smarty_function_html_options(array('name' => 'countryA','options' => $this->_tpl_vars['countries'],'selected' => $_POST['countryA']), $this);?>


<input type='submit' value='Assign Academies to Leagues' name='AddAcademy' /> <br />

<span color=red><?php echo $this->_tpl_vars['errorLeague']; ?>
 </span> 
<span color=green><?php echo $this->_tpl_vars['messageLeague']; ?>
 </span> <br />


<?php echo smarty_function_html_options(array('name' => 'countryF','options' => $this->_tpl_vars['countries'],'selected' => $_POST['countryF']), $this);?>
 Enter time: <input type='text' name='time' />

<input type='submit' value='Generate Fixtures' name='GenFix' /> <br />

<span color=red><?php echo $this->_tpl_vars['errorFixtures']; ?>
 </span> 
<span color=red><?php echo $this->_tpl_vars['messageFixtures']; ?>
 </span> <br />
<?php echo smarty_function_html_options(array('name' => 'countryP','options' => $this->_tpl_vars['countries'],'selected' => $_POST['countryP']), $this);?>
 

<input type='submit' value='Promote Demote' name='Promo' /> <br />

<span color=red><?php echo $this->_tpl_vars['errorPromo']; ?>
 </span> <br />

</fieldset>
<br />
</form>


<form method="post" action="mgmtLeague.php">
<fieldset>
<legend>Knock Out</legend>
<br />
<?php echo smarty_function_html_options(array('name' => 'knockOut','options' => $this->_tpl_vars['knockOutOptions'],'selected' => $_POST['knockOut']), $this);?>
 <br />

1st Game Date Time: <input type='text' name='kdateTime'   /> 

<input type='submit' value='Generate Fixtures' name='knockout' /> <br />

 
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