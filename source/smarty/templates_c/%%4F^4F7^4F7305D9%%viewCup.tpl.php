<?php /* Smarty version 2.6.26, created on 2010-07-27 09:57:35
         compiled from viewCup.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "validuserHeader.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php echo $this->_tpl_vars['cupName']; ?>

<?php if ($this->_tpl_vars['onGoing'] == 1): ?>
<table width="100%" border="1" cellpadding="1" cellspacing="0" id="fixtures"> 
<thead>
<tr>
<td width="20%">Round 1</td>
<td width="20%">Round 2</td>
<td width="20%">Round 3</td>
<td width="20%">QF</td>
<td width="20%">SF</td>
<td width="20%">Finals</td>
</thead>
<tr>
 <td><b><?php echo $this->_tpl_vars['round1'][0]['round_date']; ?>
</b></td>
 <td><b><?php echo $this->_tpl_vars['round2'][0]['round_date']; ?>
</b></td>
 <td><b><?php echo $this->_tpl_vars['round3'][0]['round_date']; ?>
</b></td>
 <td><b><?php echo $this->_tpl_vars['round4'][0]['round_date']; ?>
</b></td>
 <td><b><?php echo $this->_tpl_vars['round5'][0]['round_date']; ?>
</b></td>
 <td><b><?php echo $this->_tpl_vars['round6'][0]['round_date']; ?>
</b></td>
</tr>
<tr>
 <td><a href="viewMatchSummary.php?matchID=<?php echo $this->_tpl_vars['round1'][0][2]; ?>
"><?php echo $this->_tpl_vars['round1'][0]['p1Name']; ?>
 <br /> <?php echo $this->_tpl_vars['round1'][0]['p2Name']; ?>
</a></td>
 <td></td>
 <td></td>
 <td></td>
 <td></td>
 <td></td>
</tr>
<tr>
 <td><a href="viewMatchSummary.php?matchID=<?php echo $this->_tpl_vars['round1'][1][2]; ?>
"><?php echo $this->_tpl_vars['round1'][1]['p1Name']; ?>
 <br /> <?php echo $this->_tpl_vars['round1'][1]['p2Name']; ?>
</a></td>
 <td><a href="viewMatchSummary.php?matchID=<?php echo $this->_tpl_vars['round2'][0][2]; ?>
"><?php echo $this->_tpl_vars['round2'][0]['p1Name']; ?>
 <br /> <?php echo $this->_tpl_vars['round2'][0]['p2Name']; ?>
</a></td>
 <td></td>
 <td></td>
 <td></td>
 <td></td>
</tr>
<tr>
 <td><a href="viewMatchSummary.php?matchID=<?php echo $this->_tpl_vars['round1'][2][2]; ?>
"><?php echo $this->_tpl_vars['round1'][2]['p1Name']; ?>
 <br /> <?php echo $this->_tpl_vars['round1'][2]['p2Name']; ?>
</a></td>
 <td></td>
<td><a href="viewMatchSummary.php?matchID=<?php echo $this->_tpl_vars['round3'][0][2]; ?>
"><?php echo $this->_tpl_vars['round3'][0]['p1Name']; ?>
 <br /> <?php echo $this->_tpl_vars['round3'][0]['p2Name']; ?>
</a></td>
 <td></td>
 <td></td>
 <td></td>
</tr>
<tr>
 <td><a href="viewMatchSummary.php?matchID=<?php echo $this->_tpl_vars['round1'][3][2]; ?>
"><?php echo $this->_tpl_vars['round1'][3]['p1Name']; ?>
 <br /> <?php echo $this->_tpl_vars['round1'][3]['p2Name']; ?>
</a></td>
 <td><a href="viewMatchSummary.php?matchID=<?php echo $this->_tpl_vars['round2'][1][2]; ?>
"><?php echo $this->_tpl_vars['round2'][1]['p1Name']; ?>
 <br /> <?php echo $this->_tpl_vars['round2'][1]['p2Name']; ?>
</a></td>
 <td></td>
 <td></td>
 <td></td>
 <td></td>
</tr>
<tr>
 <td><a href="viewMatchSummary.php?matchID=<?php echo $this->_tpl_vars['round1'][4][2]; ?>
"><?php echo $this->_tpl_vars['round1'][4]['p1Name']; ?>
 <br /> <?php echo $this->_tpl_vars['round1'][4]['p2Name']; ?>
</a></td>
 <td></td>
 <td></td>
 <td></td>
 <td></td>
 <td></td>
</tr>
<tr>
 <td><a href="viewMatchSummary.php?matchID=<?php echo $this->_tpl_vars['round1'][5][2]; ?>
"><?php echo $this->_tpl_vars['round1'][5]['p1Name']; ?>
 <br /> <?php echo $this->_tpl_vars['round1'][5]['p2Name']; ?>
</a></td>
 <td><a href="viewMatchSummary.php?matchID=<?php echo $this->_tpl_vars['round2'][2][2]; ?>
"><?php echo $this->_tpl_vars['round2'][2]['p1Name']; ?>
 <br /> <?php echo $this->_tpl_vars['round2'][2]['p2Name']; ?>
</a></td>
<td><a href="viewMatchSummary.php?matchID=<?php echo $this->_tpl_vars['round3'][1][2]; ?>
"><?php echo $this->_tpl_vars['round3'][1]['p1Name']; ?>
 <br /> <?php echo $this->_tpl_vars['round3'][1]['p2Name']; ?>
</a></td>
 <td></td>
 <td></td>
 <td></td>
</tr>
<tr>
 <td><a href="viewMatchSummary.php?matchID=<?php echo $this->_tpl_vars['round1'][6][2]; ?>
"><?php echo $this->_tpl_vars['round1'][6]['p1Name']; ?>
 <br /> <?php echo $this->_tpl_vars['round1'][6]['p2Name']; ?>
</a></td>
 <td></td>
 <td></td>
<td><a href="viewMatchSummary.php?matchID=<?php echo $this->_tpl_vars['round4'][0][2]; ?>
"><?php echo $this->_tpl_vars['round4'][0]['p1Name']; ?>
 <br /> <?php echo $this->_tpl_vars['round4'][0]['p2Name']; ?>
</a></td>
 <td></td>
 <td></td>
</tr>
<tr>
 <td><a href="viewMatchSummary.php?matchID=<?php echo $this->_tpl_vars['round1'][7][2]; ?>
"><?php echo $this->_tpl_vars['round1'][7]['p1Name']; ?>
 <br /> <?php echo $this->_tpl_vars['round1'][7]['p2Name']; ?>
</a></td>
 <td><a href="viewMatchSummary.php?matchID=<?php echo $this->_tpl_vars['round2'][3][2]; ?>
"><?php echo $this->_tpl_vars['round2'][3]['p1Name']; ?>
 <br /> <?php echo $this->_tpl_vars['round2'][3]['p2Name']; ?>
</a></td>
 <td></td>
 <td></td>
<td><a href="viewMatchSummary.php?matchID=<?php echo $this->_tpl_vars['round5'][0][2]; ?>
"><?php echo $this->_tpl_vars['round5'][0]['p1Name']; ?>
 <br /> <?php echo $this->_tpl_vars['round5'][0]['p2Name']; ?>
</a></td>
 <td></td>
</tr>
<tr>
 <td><a href="viewMatchSummary.php?matchID=<?php echo $this->_tpl_vars['round1'][8][2]; ?>
"><?php echo $this->_tpl_vars['round1'][8]['p1Name']; ?>
 <br /> <?php echo $this->_tpl_vars['round1'][8]['p2Name']; ?>
</a></td>
 <td></td>
<td><a href="viewMatchSummary.php?matchID=<?php echo $this->_tpl_vars['round3'][2][2]; ?>
"><?php echo $this->_tpl_vars['round3'][2]['p1Name']; ?>
 <br /> <?php echo $this->_tpl_vars['round3'][2]['p2Name']; ?>
</a></td>
<td><a href="viewMatchSummary.php?matchID=<?php echo $this->_tpl_vars['round4'][1][2]; ?>
"><?php echo $this->_tpl_vars['round4'][1]['p1Name']; ?>
 <br /> <?php echo $this->_tpl_vars['round4'][1]['p2Name']; ?>
</a></td>
 <td></td>
<td><a href="viewMatchSummary.php?matchID=<?php echo $this->_tpl_vars['round6'][0][2]; ?>
"><?php echo $this->_tpl_vars['round6'][0]['p1Name']; ?>
 <br /> <?php echo $this->_tpl_vars['round6'][0]['p2Name']; ?>
</a></td>
</tr>
<tr>
 <td><a href="viewMatchSummary.php?matchID=<?php echo $this->_tpl_vars['round1'][9][2]; ?>
"><?php echo $this->_tpl_vars['round1'][9]['p1Name']; ?>
 <br /> <?php echo $this->_tpl_vars['round1'][9]['p2Name']; ?>
</a></td>
 <td><a href="viewMatchSummary.php?matchID=<?php echo $this->_tpl_vars['round2'][4][2]; ?>
"><?php echo $this->_tpl_vars['round2'][4]['p1Name']; ?>
 <br /> <?php echo $this->_tpl_vars['round2'][4]['p2Name']; ?>
</a></td>
 <td></td>
 <td></td>
<td><a href="viewMatchSummary.php?matchID=<?php echo $this->_tpl_vars['round5'][1][2]; ?>
"><?php echo $this->_tpl_vars['round5'][1]['p1Name']; ?>
 <br /> <?php echo $this->_tpl_vars['round5'][1]['p2Name']; ?>
</a></td>
 <td></td>
</tr>
<tr>
 <td><a href="viewMatchSummary.php?matchID=<?php echo $this->_tpl_vars['round1'][10][2]; ?>
"><?php echo $this->_tpl_vars['round1'][10]['p1Name']; ?>
 <br /> <?php echo $this->_tpl_vars['round1'][10]['p2Name']; ?>
</a></td>
 <td></td>
 <td></td>
 <td></td>
 <td></td>
 <td></td>
</tr>
<tr>
 <td><a href="viewMatchSummary.php?matchID=<?php echo $this->_tpl_vars['round1'][11][2]; ?>
"><?php echo $this->_tpl_vars['round1'][11]['p1Name']; ?>
 <br /> <?php echo $this->_tpl_vars['round1'][11]['p2Name']; ?>
</a></td>
 <td><a href="viewMatchSummary.php?matchID=<?php echo $this->_tpl_vars['round2'][5][2]; ?>
"><?php echo $this->_tpl_vars['round2'][5]['p1Name']; ?>
 <br /> <?php echo $this->_tpl_vars['round2'][5]['p2Name']; ?>
</a></td>
<td><a href="viewMatchSummary.php?matchID=<?php echo $this->_tpl_vars['round3'][3][2]; ?>
"><?php echo $this->_tpl_vars['round3'][3]['p1Name']; ?>
 <br /> <?php echo $this->_tpl_vars['round3'][3]['p2Name']; ?>
</a></td>
<td><a href="viewMatchSummary.php?matchID=<?php echo $this->_tpl_vars['round4'][2][2]; ?>
"><?php echo $this->_tpl_vars['round4'][2]['p1Name']; ?>
 <br /> <?php echo $this->_tpl_vars['round4'][2]['p2Name']; ?>
</a></td>
 <td></td>
 <td></td>
</tr>
<tr>
 <td><a href="viewMatchSummary.php?matchID=<?php echo $this->_tpl_vars['round1'][12][2]; ?>
"><?php echo $this->_tpl_vars['round1'][12]['p1Name']; ?>
 <br /> <?php echo $this->_tpl_vars['round1'][12]['p2Name']; ?>
</a></td>
 <td></td>
 <td></td>
 <td></td>
 <td></td>
 <td></td>
</tr>
<tr>
 <td><a href="viewMatchSummary.php?matchID=<?php echo $this->_tpl_vars['round1'][13][2]; ?>
"><?php echo $this->_tpl_vars['round1'][13]['p1Name']; ?>
 <br /> <?php echo $this->_tpl_vars['round1'][13]['p2Name']; ?>
</a></td>
 <td><a href="viewMatchSummary.php?matchID=<?php echo $this->_tpl_vars['round2'][6][2]; ?>
"><?php echo $this->_tpl_vars['round2'][6]['p1Name']; ?>
 <br /> <?php echo $this->_tpl_vars['round2'][6]['p2Name']; ?>
</a></td>
 <td></td>
 <td></td>
 <td></td>
 <td></td>
</tr>
<tr>
 <td><a href="viewMatchSummary.php?matchID=<?php echo $this->_tpl_vars['round1'][14][2]; ?>
"><?php echo $this->_tpl_vars['round1'][14]['p1Name']; ?>
 <br /> <?php echo $this->_tpl_vars['round1'][14]['p2Name']; ?>
</a></td>
 <td></td>
<td><a href="viewMatchSummary.php?matchID=<?php echo $this->_tpl_vars['round3'][4][2]; ?>
"><?php echo $this->_tpl_vars['round3'][4]['p1Name']; ?>
 <br /> <?php echo $this->_tpl_vars['round3'][4]['p2Name']; ?>
</a></td>
<td><a href="viewMatchSummary.php?matchID=<?php echo $this->_tpl_vars['round4'][3][2]; ?>
"><?php echo $this->_tpl_vars['round4'][3]['p1Name']; ?>
 <br /> <?php echo $this->_tpl_vars['round4'][3]['p2Name']; ?>
</a></td>
 <td></td>
 <td></td>
</tr>
<tr>
 <td><a href="viewMatchSummary.php?matchID=<?php echo $this->_tpl_vars['round1'][15][2]; ?>
"><?php echo $this->_tpl_vars['round1'][15]['p1Name']; ?>
 <br /> <?php echo $this->_tpl_vars['round1'][15]['p2Name']; ?>
</a></td>
 <td><a href="viewMatchSummary.php?matchID=<?php echo $this->_tpl_vars['round2'][7][2]; ?>
"><?php echo $this->_tpl_vars['round2'][7]['p1Name']; ?>
 <br /> <?php echo $this->_tpl_vars['round2'][7]['p2Name']; ?>
</a></td>
 <td></td>
 <td></td>
 <td></td>
 <td></td>
</tr>
<tr>
 <td><a href="viewMatchSummary.php?matchID=<?php echo $this->_tpl_vars['round1'][16][2]; ?>
"><?php echo $this->_tpl_vars['round1'][16]['p1Name']; ?>
 <br /> <?php echo $this->_tpl_vars['round1'][16]['p2Name']; ?>
</a></td>
 <td></td>
 <td></td>
 <td></td>
 <td></td>
 <td></td>
</tr>
<tr>
 <td><a href="viewMatchSummary.php?matchID=<?php echo $this->_tpl_vars['round1'][17][2]; ?>
"><?php echo $this->_tpl_vars['round1'][17]['p1Name']; ?>
 <br /> <?php echo $this->_tpl_vars['round1'][17]['p2Name']; ?>
</a></td>
 <td><a href="viewMatchSummary.php?matchID=<?php echo $this->_tpl_vars['round2'][8][2]; ?>
"><?php echo $this->_tpl_vars['round2'][8]['p1Name']; ?>
 <br /> <?php echo $this->_tpl_vars['round2'][8]['p2Name']; ?>
</a></td>
<td><a href="viewMatchSummary.php?matchID=<?php echo $this->_tpl_vars['round3'][5][2]; ?>
"><?php echo $this->_tpl_vars['round3'][5]['p1Name']; ?>
 <br /> <?php echo $this->_tpl_vars['round3'][5]['p2Name']; ?>
</a></td>
 <td></td>
 <td></td>
 <td></td>
</tr>
<tr>
 <td><a href="viewMatchSummary.php?matchID=<?php echo $this->_tpl_vars['round1'][18][2]; ?>
"><?php echo $this->_tpl_vars['round1'][18]['p1Name']; ?>
 <br /> <?php echo $this->_tpl_vars['round1'][18]['p2Name']; ?>
</a></td>
 <td></td>
 <td></td>
 <td></td>
 <td></td>
 <td></td>
</tr>
<tr>
 <td><a href="viewMatchSummary.php?matchID=<?php echo $this->_tpl_vars['round1'][19][2]; ?>
"><?php echo $this->_tpl_vars['round1'][19]['p1Name']; ?>
 <br /> <?php echo $this->_tpl_vars['round1'][19]['p2Name']; ?>
</a></td>
 <td><a href="viewMatchSummary.php?matchID=<?php echo $this->_tpl_vars['round2'][9][2]; ?>
"><?php echo $this->_tpl_vars['round2'][9]['p1Name']; ?>
 <br /> <?php echo $this->_tpl_vars['round2'][9]['p2Name']; ?>
</a></td>
 <td></td>
 <td></td>
 <td></td>
 <td></td>
</tr>
<tr>
 <td><a href="viewMatchSummary.php?matchID=<?php echo $this->_tpl_vars['round1'][20][2]; ?>
"><?php echo $this->_tpl_vars['round1'][20]['p1Name']; ?>
 <br /> <?php echo $this->_tpl_vars['round1'][20]['p2Name']; ?>
</a></td>
 <td></td>
<td><a href="viewMatchSummary.php?matchID=<?php echo $this->_tpl_vars['round3'][6][2]; ?>
"><?php echo $this->_tpl_vars['round3'][6]['p1Name']; ?>
 <br /> <?php echo $this->_tpl_vars['round3'][6]['p2Name']; ?>
</a></td>
 <td></td>
 <td></td>
 <td></td>
</tr>
<tr>
 <td><a href="viewMatchSummary.php?matchID=<?php echo $this->_tpl_vars['round1'][21][2]; ?>
"><?php echo $this->_tpl_vars['round1'][21]['p1Name']; ?>
 <br /> <?php echo $this->_tpl_vars['round1'][21]['p2Name']; ?>
</a></td>
 <td><a href="viewMatchSummary.php?matchID=<?php echo $this->_tpl_vars['round2'][10][2]; ?>
"><?php echo $this->_tpl_vars['round2'][10]['p1Name']; ?>
 <br /> <?php echo $this->_tpl_vars['round2'][10]['p2Name']; ?>
</a></td>
 <td></td>
 <td></td>
 <td></td>
 <td></td>
</tr>
<tr>
 <td><a href="viewMatchSummary.php?matchID=<?php echo $this->_tpl_vars['round1'][22][2]; ?>
"><?php echo $this->_tpl_vars['round1'][22]['p1Name']; ?>
 <br /> <?php echo $this->_tpl_vars['round1'][22]['p2Name']; ?>
</a></td>
 <td></td>
 <td></td>
 <td></td>
 <td></td>
 <td></td>
</tr>
<tr>
 <td><a href="viewMatchSummary.php?matchID=<?php echo $this->_tpl_vars['round1'][23][2]; ?>
"><?php echo $this->_tpl_vars['round1'][23]['p1Name']; ?>
 <br /> <?php echo $this->_tpl_vars['round1'][23]['p2Name']; ?>
</a></td>
 <td><a href="viewMatchSummary.php?matchID=<?php echo $this->_tpl_vars['round2'][11][2]; ?>
"><?php echo $this->_tpl_vars['round2'][11]['p1Name']; ?>
 <br /> <?php echo $this->_tpl_vars['round2'][11]['p2Name']; ?>
</a></td>
<td><a href="viewMatchSummary.php?matchID=<?php echo $this->_tpl_vars['round3'][7][2]; ?>
"><?php echo $this->_tpl_vars['round3'][7]['p1Name']; ?>
 <br /> <?php echo $this->_tpl_vars['round3'][7]['p2Name']; ?>
</a></td>
 <td></td>
 <td></td>
 <td></td>
</tr>
<tr>
 <td><a href="viewMatchSummary.php?matchID=<?php echo $this->_tpl_vars['round1'][24][2]; ?>
"><?php echo $this->_tpl_vars['round1'][24]['p1Name']; ?>
 <br /> <?php echo $this->_tpl_vars['round1'][24]['p2Name']; ?>
</a></td>
 <td></td>
 <td></td>
 <td></td>
 <td></td>
 <td></td>
</tr>
<tr>
 <td><a href="viewMatchSummary.php?matchID=<?php echo $this->_tpl_vars['round1'][25][2]; ?>
"><?php echo $this->_tpl_vars['round1'][25]['p1Name']; ?>
 <br /> <?php echo $this->_tpl_vars['round1'][25]['p2Name']; ?>
</a></td>
 <td><a href="viewMatchSummary.php?matchID=<?php echo $this->_tpl_vars['round2'][12][2]; ?>
"><?php echo $this->_tpl_vars['round2'][12]['p1Name']; ?>
 <br /> <?php echo $this->_tpl_vars['round2'][12]['p2Name']; ?>
</a></td>
 <td></td>
 <td></td>
 <td></td>
 <td></td>
</tr>
<tr>
 <td><a href="viewMatchSummary.php?matchID=<?php echo $this->_tpl_vars['round1'][26][2]; ?>
"><?php echo $this->_tpl_vars['round1'][26]['p1Name']; ?>
 <br /> <?php echo $this->_tpl_vars['round1'][26]['p2Name']; ?>
</a></td>
 <td></td>
<td><a href="viewMatchSummary.php?matchID=<?php echo $this->_tpl_vars['round3'][8][2]; ?>
"><?php echo $this->_tpl_vars['round3'][8]['p1Name']; ?>
 <br /> <?php echo $this->_tpl_vars['round3'][8]['p2Name']; ?>
</a></td>
 <td></td>
 <td></td>
 <td></td>
</tr>
<tr>
 <td><a href="viewMatchSummary.php?matchID=<?php echo $this->_tpl_vars['round1'][27][2]; ?>
"><?php echo $this->_tpl_vars['round1'][27]['p1Name']; ?>
 <br /> <?php echo $this->_tpl_vars['round1'][27]['p2Name']; ?>
</a></td>
 <td><a href="viewMatchSummary.php?matchID=<?php echo $this->_tpl_vars['round2'][13][2]; ?>
"><?php echo $this->_tpl_vars['round2'][13]['p1Name']; ?>
 <br /> <?php echo $this->_tpl_vars['round2'][13]['p2Name']; ?>
</a></td>
 <td></td>
 <td></td>
 <td></td>
 <td></td>
</tr>
<tr>
 <td><a href="viewMatchSummary.php?matchID=<?php echo $this->_tpl_vars['round1'][28][2]; ?>
"><?php echo $this->_tpl_vars['round1'][28]['p1Name']; ?>
 <br /> <?php echo $this->_tpl_vars['round1'][28]['p2Name']; ?>
</a></td>
 <td></td>
<td></td>
 <td></td>
 <td></td>
 <td></td>
</tr>
<tr>
 <td><a href="viewMatchSummary.php?matchID=<?php echo $this->_tpl_vars['round1'][29][2]; ?>
"><?php echo $this->_tpl_vars['round1'][29]['p1Name']; ?>
 <br /> <?php echo $this->_tpl_vars['round1'][29]['p2Name']; ?>
</a></td>
 <td><a href="viewMatchSummary.php?matchID=<?php echo $this->_tpl_vars['round2'][14][2]; ?>
"><?php echo $this->_tpl_vars['round2'][14]['p1Name']; ?>
 <br /> <?php echo $this->_tpl_vars['round2'][14]['p2Name']; ?>
</a></td>
 <td></td>
 <td></td>
 <td></td>
 <td></td>
</tr>
<tr>
 <td><a href="viewMatchSummary.php?matchID=<?php echo $this->_tpl_vars['round1'][30][2]; ?>
"><?php echo $this->_tpl_vars['round1'][30]['p1Name']; ?>
 <br /> <?php echo $this->_tpl_vars['round1'][30]['p2Name']; ?>
</a></td>
 <td></td>
 <td></td>
 <td></td>
 <td></td>
 <td></td>
</tr>
<tr>
 <td><a href="viewMatchSummary.php?matchID=<?php echo $this->_tpl_vars['round1'][31][2]; ?>
"><?php echo $this->_tpl_vars['round1'][31]['p1Name']; ?>
 <br /> <?php echo $this->_tpl_vars['round1'][31]['p2Name']; ?>
</a></td>
 <td><a href="viewMatchSummary.php?matchID=<?php echo $this->_tpl_vars['round2'][15][2]; ?>
"><?php echo $this->_tpl_vars['round2'][15]['p1Name']; ?>
 <br /> <?php echo $this->_tpl_vars['round2'][15]['p2Name']; ?>
</a></td>
 <td></td>
 <td></td>
 <td></td>
 <td></td>
</tr>
</table>

<?php else: ?>
<span>Past Winners</span>


<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
<?php endif; ?>
			
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "validuserFooter.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</html>