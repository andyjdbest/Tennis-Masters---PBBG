<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en"> 
<head> 
<title>Tennis Masters - Online Tennis Management Game</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<style type="text/css">
{literal}
/*Credits: Dynamic Drive CSS Library */
/*URL: http://www.dynamicdrive.com/style/ */

.cssform p{
width: 300px;
clear: left;
margin: 0;
padding: 5px 0 8px 0;
padding-left: 1px; 
border-top: 2px dashed gray;
height: 1%;
}

.cssform fieldset {
    font: 0.8em "Helvetica Neue", helvetica, arial, sans-serif;
    color: #666;
    background-color: #efefef;
    padding: 2px;
    border: solid 1px #d3d3d3;
    width: 350px;
    }
	
.cssform legend {
    color: #666;
    font-weight: bold;
    font-variant: small-caps;
    background-color: #d3d3d3;
    padding: 2px 6px;
    margin-bottom: 8px;
    }
	
.cssform label{
font-weight: bold;
float: left;
margin-left: -1px; 
width: 150px; 
}

.cssform input{ 
width: 180px;
padding-left: 10px;
}

{/literal}
</style>

<link href="style.css" rel="stylesheet" type="text/css" />

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
			<a href="index.php">HomePage</a>
			</div>
			</div>

		<div id="right">			
		{if $error ne ""}
			<span style='color:red'>Error: {$error}</span>
		{/if}
                {if $message ne ""}
			<span style='color:green'>{$message}</span>
                {else}
                <form method='post' action='forgotpassword.php' class="cssform">
                    <fieldset>
                        <legend>Forgot Password</legend>
			
                        <label name='email'>Email:</label> <input type='text' name='email' /><br />
                      
			<input type='submit' value='Submit!' name='forgot' />
                     </fieldset>
		</form>
                {/if}
			</div>
		</div>
	</div>
</div>


<div id="footer-top"></div>
<div id="footer">
	<div class="wrapper">
		<div class="designedby">
			<a href="http://danstrog.com"><img src="assets/images/danstrog.jpg" alt="Designed by Danstrog" /></a>
		</div>
		<p>2010 &copy; Tennis Masters. All rights reserved.</p>
	</div>
</div>

</div>

</body>
<script type="text/javascript" src="includes/js/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="includes/js/jquery.jclock.js"></script>
<script type="text/javascript" src="includes/js/clock.js"></script>
<script type="text/javascript" src="includes/js/css_browser_selector.js"></script>
</html>