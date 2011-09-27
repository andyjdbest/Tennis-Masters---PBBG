<?php /* Smarty version 2.6.26, created on 2010-08-04 10:02:41
         compiled from viewCountryDetails.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_options', 'viewCountryDetails.tpl', 10, false),array('function', 'cycle', 'viewCountryDetails.tpl', 22, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "validuserHeader.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
				


<h3>World Ranking</h3>			
<a href="viewPlayersRank.php?countryID=<?php echo 0; ?>
">World Player Rankings</a> <br />
<h3>Select Country</h3>
<form action="viewCountryDetails.php" method="post">	
<select name="countryID"> 
<?php echo smarty_function_html_options(array('values' => $this->_tpl_vars['countryID'],'output' => $this->_tpl_vars['countryName'],'selected' => $_POST['countryID']), $this);?>
 
</select> <input type="submit" value="Select" name="country">
</form>
<br />
	<table width="50%" border="1" cellpadding="1" cellspacing="0" id="country"> 
  <tr class="tableHeader t"> 
    <td width="5%">#</td> 
    <td width="15%">League Table</td>
	<td width="25%"><center>League Fixtures</center></td>	
  </tr> 
<?php unset($this->_sections['id']);
$this->_sections['id']['name'] = 'id';
$this->_sections['id']['loop'] = is_array($_loop=$this->_tpl_vars['leagueData']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
<?php echo '<tr bgcolor="'; ?><?php echo smarty_function_cycle(array('values' => "#CCFFCC,#C3D9FF"), $this);?><?php echo '"><td><div align="center">'; ?><?php echo $this->_sections['id']['iteration']; ?><?php echo '</div></td><td><div align="center"><a href="viewLeague.php?league='; ?><?php echo $this->_tpl_vars['leagueData'][$this->_sections['id']['index']]['idleague']; ?><?php echo '">'; ?><?php echo $this->_tpl_vars['leagueData'][$this->_sections['id']['index']]['nameleague']; ?><?php echo '</a></div></td><td><div align="center"><a href="viewLeagueFixtures.php?league='; ?><?php echo $this->_tpl_vars['leagueData'][$this->_sections['id']['index']]['idleague']; ?><?php echo '">'; ?><?php echo $this->_tpl_vars['leagueData'][$this->_sections['id']['index']]['nameleague']; ?><?php echo ' Fixtures</a></div></td></tr>'; ?>

<?php endfor; endif; ?>
</table>
<br />
<a href="viewPlayersRank.php?countryID=<?php echo $this->_tpl_vars['cID']; ?>
">Player Rankings in the Country</a>
<br />
<br />
<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /> 


<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "validuserFooter.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

</html>