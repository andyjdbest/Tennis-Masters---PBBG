<?xml version="1.0" encoding="utf-8"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">




<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
 <title>Login</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link type="text/css" href="jquery-ui-1.7.2.custom.css" rel="Stylesheet" />
<script type="text/javascript" src="includes/js/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="includes/js/jquery-ui-1.7.2.custom.min.js"></script>

</head>
<body>
<div id="wrapper">
<div id="header"></div>
<div id="container">
<div id="left">
{if $error ne ""}
			<span style='color:red'>Error: {$error}</span>
                        
		{/if}
		
		<form method='post' action='login.php'>
			<label name="user">Username:</label> <br /><input type='text' name='username' id='username' value='{$smarty.post.username}' /><br />
			<label name="pass">Password:</label> <br /><input type='password' name='password' /><br />
			<input type='submit' value='Login!' />
		</form>
<ul id="nav">
<li><a href="register.php" title="Register">Register</a></li>
</ul>

</div>
<div id="center"><button id="login" class="ui-button ui-state-default ui-corner-all">Login - Demo</button></div>

<div id="right">Test Right</div>
<div class="clearer"></div>

                
</div>
<div id="footer">website copyrights here</div>
</div>

<div id="dialog" title="Login">
	<p id="validateTips">All form fields are required.</p>

	<form>
	<fieldset>
		<label for="name">Username</label> 
		<input type="text" name="name" id="name" class="text ui-widget-content ui-corner-all" /> <br />
		<label for="password">Password</label> 
		<input type="password" name="password" id="password" value="" class="text ui-widget-content ui-corner-all" />
	</fieldset>
	</form>
</div>
                {literal}
                 <script type='text/javascript'>
		document.getElementById('username').focus();
                
                $(function() {
		var name = $("#name"),password = $("#password"),
		allFields = $([]).add(name).add(password),
		tips = $("#validateTips");

		function updateTips(t) {
			tips.text(t).effect("highlight",{},1500);
		}

		function checkLength(o,n,min,max) {
			if ( o.val().length > max || o.val().length < min ) {
				o.addClass('ui-state-error');
				updateTips("Length of " + n + " must be between "+min+" and "+max+".");
				return false;
			} else {
				return true;
			}

		}

		function checkRegexp(o,regexp,n) {

			if ( !( regexp.test( o.val() ) ) ) {
				o.addClass('ui-state-error');
				updateTips(n);
				return false;
			} else {
				return true;
			}

		}

		$("#dialog").dialog({
			bgiframe: true,
			autoOpen: false,
			height: 300,
                        width: 600,
			modal: true,
			buttons: {
				'Login': function() {
					var bValid = true;
					allFields.removeClass('ui-state-error');

					bValid = bValid && checkLength(name,"username",3,16);
					bValid = bValid && checkLength(password,"password",3,25);

					bValid = bValid && checkRegexp(name,/^[a-z]([0-9a-z_])+$/i,"Username may consist of a-z, 0-9, underscores, begin with a letter.");
					bValid = bValid && checkRegexp(password,/^([0-9a-zA-Z])+$/,"Password field only allow : a-z 0-9");

					if (bValid) {
                                                var dataString = 'name='+ name.val() + '&password=' + password.val();
                                                alert (dataString);return false;


						$(this).dialog('close');
					}
				},
				Cancel: function() {
					$(this).dialog('close');
				}
			},
			close: function() {
				allFields.val('').removeClass('ui-state-error');
			}
		});



		$('#login').click(function() {
			$('#dialog').dialog('open');
		})
		.hover(
			function(){
				$(this).addClass("ui-state-hover");
			},
			function(){
				$(this).removeClass("ui-state-hover");
			}
		).mousedown(function(){
			$(this).addClass("ui-state-active");
		})
		.mouseup(function(){
				$(this).removeClass("ui-state-active");
		});

	});

		</script> 
                {/literal}

</body>
</html>