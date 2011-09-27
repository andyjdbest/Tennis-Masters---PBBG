<?php /* Smarty version 2.6.26, created on 2010-05-09 05:54:17
         compiled from viewCalendar1.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "validuserHeader.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>



<table border="0" cellpadding="0" cellspacing="0" width="150">
    <tr>
        <td align="center">
            <a href="<?php echo $this->_tpl_vars['LAST_YEAR_LINK']; ?>
"><<</a>
        </td>
        <td align="center">
            <a href="<?php echo $this->_tpl_vars['PREV_MONTH_LINK']; ?>
"><</a>
        </td>
        <td bgcolor="#ffffff" colspan="3" valign="middle" align="center">
            <font color="#333399" face="arial" size="3">
            <b>
            <?php echo $this->_tpl_vars['MONTHNAME']; ?>

            </b></font>
        </td>
        <td align="center">
            <a href="<?php echo $this->_tpl_vars['NEXT_MONTH_LINK']; ?>
">></a>
        </td>
        <td align="center">
            <a href="<?php echo $this->_tpl_vars['NEXT_YEAR_LINK']; ?>
">>></a>
        </td>
    </tr>
    <tr>

    <?php $_from = $this->_tpl_vars['WEEKDAYS']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['WEEKDAY']):
?>
        <td bgcolor="#FFFFFF" valign="middle" align="center" width="15%">
            <font color="#000000" face="arial" size="1"><b><?php echo $this->_tpl_vars['WEEKDAY']; ?>
</b></font>
        </td>
    <?php endforeach; endif; unset($_from); ?>

    </tr>
    <tr>

    <?php $_from = $this->_tpl_vars['NUMDAYS_ARRAY']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['KEY'] => $this->_tpl_vars['CURR_DAY']):
?>

        <?php if ($this->_tpl_vars['CURR_DAY'] == ""): ?>
            <td bgcolor="#ffffff" width="15%">
                <font color="#ffffff" face="arial" size="1">&nbsp;</font>
            </td>
        <?php elseif ($this->_tpl_vars['CURR_DAY'] == $this->_tpl_vars['TODAY']): ?>
            <td bgcolor="#CC0000" valign="middle" align="center" width="15%">
                <font color="#FFFFFF" face="arial" size="1">
                <?php echo $this->_tpl_vars['CURR_DAY']; ?>

                </font>
            </td>
        <?php else: ?>
            <td bgcolor="#FFFFFF" valign="middle" align="center" width="15%">
                <font color="#000000" face="arial" size="1">
                <?php echo $this->_tpl_vars['CURR_DAY']; ?>

                </font>
            </td>
        <?php endif; ?>

        <?php if (!($this->_tpl_vars['KEY'] % 7)): ?>
            </tr><tr>
        <?php endif; ?>

    <?php endforeach; endif; unset($_from); ?>

    </tr>
    <tr>
        <td colspan="7" align="left">
            <font color="#000000" face="arial" size="1">
                <a href="viewCalendar1.php">today</a>
            </font>
        </td>
    </tr>
</table>
 
				
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "validuserFooter.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

</html>