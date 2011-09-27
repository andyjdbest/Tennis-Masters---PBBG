<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en"> 
<head> 
<title>Tennis Masters - Online Tennis Management Game</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel='stylesheet' type='text/css' href='style.css' />
{literal}
<STYLE type="text/css">
  /* 
	Cusco Sky table styles
	written by Braulio Soncco http://www.buayacorp.com
*/

table, th, td {
	border: 1px solid #D4E0EE;
	border-collapse: collapse;
	font-family: "Trebuchet MS", Arial, sans-serif;
	color: #555;
}

caption {
	font-size: 150%;
	font-weight: bold;
	margin: 5px;
}

td, th {
	padding: 4px;
}

thead th {
	text-align: center;
	background: #E6EDF5;
	color: #4F76A3;
	font-size: 100% !important;
}

tbody th {
	font-weight: bold;
}

tbody tr { background: #FCFDFE; }

tbody tr.odd { background: #F7F9FC; }


{/literal}
 </STYLE>
</head>

<body>
	
	
<div id="header">
	<div class="wrapper">
		<div id="logo">
			<a href="/"><img src="assets/images/logov2.jpg" alt="Tennis Masters" /></a>
		</div>
		<div id="manage">
			<h2>Online Tennis Management Game</h2>
			<h2><span>Manage your own tennis academy!</span></h2>
		</div>
	</div>
</div>


<div id="main">
	<div class="wrapper">
		<div id="content">
			<div id="main">
			<div id="left">
				<div class="info">
					<ul>
						<li class="users"><span>{$users} </span> online user(s)</li>
						<li class="time"><div class="jclock"></div></li>
					</ul>
				</div>
				<div class="yellow">
					<strong>Day {$day} </strong> of Season {$season}
				</div>
								
			</div>
			<div id="right">
				{if $loggedin eq 1}		
						{include file="validuserTopCSSMenu.tpl"}
				{else}
                                               <p class="big"><a href=''>Register</a> or <a href='index.php'>Login</a></p>   
				{/if}
                                  
				<p>
				
				<div>
				<table>
				<caption>Weekly Calendar</caption>
				<thead>
	<tr><th scope="col">Sunday</th><th scope="col">Monday</th><th scope="col">Tuesday</th>
	<th scope="col">Wednesday</th><th scope="col">Thursday</th><th scope="col">Friday</th><th scope="col">Saturday</th></tr></THEAD>
	<tbody>
	<tr><td>KO Cup</td><td>League</td><td></td><td>KO Cup</td><td></td><td>League</td><td>KO Cup</td></tr>		
	<tr><td>Finance Update</td><td></td><td>Player Trial /<br />Fitness Update</td><td></td><td>Training Update /<br />Fitness Update</td><td></td><td><br />Fitness Update</td></tr>
	</tbody>				
				</TABLE> <br />
				
				<table width="100%">
				<caption>Country Specific</caption>
				<thead>
	<tr><th scope="col">Event</th><th scope="col">USA</th><th scope="col">ENG</th><th scope="col">FRA</th><th scope="col">AUS</th>
	</tr></THEAD>
	<tbody>
	<tr><td>League Matches</td><td align="center">20:00:00</td><td align="center">11:00:00</td><td align="center">09:00:00</td><td align="center">04:00:00</td></tr>
	<tr><td>KO Matches</td><td colspan="4" align="center">08:00:00</td></tr>
	<tr><td>Challenges</td><td colspan="4" align="center">14:00:00</td></tr>		
	<tr><td>Finance Update</td><td colspan="4" align="center">04:00:00</td></tr>
	<tr><td>Player Trial</td><td colspan="4" align="center">02:00:00</td></tr>
	<tr><td>Training Update</td><td colspan="4" align="center">03:00:00</td></tr>
	<tr><td>Fitness Update</td><td colspan="4" align="center">00:15:00</td></tr>
	</tbody>				
				</TABLE> <br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
				
				</div></p>
				
		

{include file="validuserFooter.tpl"}



</html>