{include file="validuserHeader.tpl"}

<h1>Finances</h1>
				
Balance at end of Last Week: <strong>  &nbsp;{$current}</strong>  <BR />

<table>
	<tr><th colspan="2">Income</th><th colspan="2">Cost</th></tr>
	<tr>
		<td>Attendance:</td><td>{$financeData.attend}</td>
		<td>Player Wages:</td><td>{$financeData.pwage}</td>
	</tr>
	<tr>
		<td>Sponsorship:</td><td>{$financeData.sponsors}</td>
		<td>Coach Wages:</td><td>{$financeData.cwage}</td>
	</tr>
	<tr>
		<td>Player Sales:</td><td>{$financeData.psales}</td>
		<td>Player Purchases:</td><td>{$financeData.ppurchase}</td>
	</tr>
	<tr>
		<td>PrizeMoney:</td><td>{$prize}</td>
		<td>Coach Purchases:</td><td>{$financeData.cpurchase}</td>
	</tr>
	<tr>
		<td>Misc Income:</td><td>{$financeData.mincome}</td>
		<td>Misc Cost:</td><td>{$financeData.mcost}</td>
	</tr>
	<tr>
		<td></td><td></td>
		<td></td><td></td>
	</tr>
	<tr>
		<td>Total Income:</td><td>{$summaryIncome}</td>
		<td>Total Cost:</td><td>{$summaryCost}</td>
	</tr>
	<tr>
		<td>Projected Weekly Profit/Loss:</td><td></td><td></td><td>{$weekly}</td>
	</tr>
	<tr>
		<td>Projected Money at End of Week:</td><td></td><td></td><td> <strong>{$projected} </strong></td>
	</tr>
</table> 
<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
				
{include file="validuserFooter.tpl"}

</html>