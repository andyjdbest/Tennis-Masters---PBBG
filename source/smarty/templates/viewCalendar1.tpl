{include file="validuserHeader.tpl"}



<table border="0" cellpadding="0" cellspacing="0" width="150">
    <tr>
        <td align="center">
            <a href="{$LAST_YEAR_LINK}"><<</a>
        </td>
        <td align="center">
            <a href="{$PREV_MONTH_LINK}"><</a>
        </td>
        <td bgcolor="#ffffff" colspan="3" valign="middle" align="center">
            <font color="#333399" face="arial" size="3">
            <b>
            {$MONTHNAME}
            </b></font>
        </td>
        <td align="center">
            <a href="{$NEXT_MONTH_LINK}">></a>
        </td>
        <td align="center">
            <a href="{$NEXT_YEAR_LINK}">>></a>
        </td>
    </tr>
    <tr>

    {foreach from=$WEEKDAYS item=WEEKDAY}
        <td bgcolor="#FFFFFF" valign="middle" align="center" width="15%">
            <font color="#000000" face="arial" size="1"><b>{$WEEKDAY}</b></font>
        </td>
    {/foreach}

    </tr>
    <tr>

    {foreach from=$NUMDAYS_ARRAY key=KEY item=CURR_DAY}

        {if $CURR_DAY == ""}
            <td bgcolor="#ffffff" width="15%">
                <font color="#ffffff" face="arial" size="1">&nbsp;</font>
            </td>
        {elseif $CURR_DAY == $TODAY}
            <td bgcolor="#CC0000" valign="middle" align="center" width="15%">
                <font color="#FFFFFF" face="arial" size="1">
                {$CURR_DAY}
                </font>
            </td>
        {else}
            <td bgcolor="#FFFFFF" valign="middle" align="center" width="15%">
                <font color="#000000" face="arial" size="1">
                {$CURR_DAY}
                </font>
            </td>
        {/if}

        {if $KEY is div by 7}
            </tr><tr>
        {/if}

    {/foreach}

    </tr>
    <tr>
        <td colspan="7" align="left">
            <font color="#000000" face="arial" size="1">
                <a href="viewCalendar1.php">today</a>
            </font>
        </td>
    </tr>
</table>
 
				
{include file="validuserFooter.tpl"}

</html>