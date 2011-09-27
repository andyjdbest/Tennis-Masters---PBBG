<?xml version="1.0" encoding="utf-8"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
 <title>Welcome</title>
<link href="style.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="wrapper">
<div id="header">{include file="mgmtheader.tpl"}
</div>
<div id="container">
<div id="left">
<ul id="nav">
</ul>
</div>
<div id="center">
<H4>Users</H4>
<form method='post' action='mgmtUser.php'>
<fieldset>
<legend>Add / Modify New User(s)</legend>
<label name="searchUserID">Select Existing User ID:</label> 
<select name='userid'>
{html_options values=$sUserId output=$sUserId selected=$smarty.post.userid} 
</select>
<input type='submit' value='Search' name='search' />
<br />
<br />
<label name="username">UserName:</label> <input type='text' name='username' id='username' value={$user.username} /><br />
<label name="email">Email:</label> <input type='text' name='email' id='email'  value={$user.email} /><br />
<label name="firstname">Firstname:</label> <input type='text' name='firstname' id='firstname'  value={$user.firstname} /><br />
<label name="lastname">Lastname:</label> <input type='text' name='lastname' id='lastname'  value={$user.lastname} /><br />
<label name="isValidated">isValidated:</label> <input type='text' name='isValidated' id='isValidated'  value={$user.isValidated} /><br />
<label name="isAdmin">isAdmin:</label> <input type='text' name='isAdmin' id='isAdmin'  value={$user.isAdmin} /><br />
<label name="isAssigned">isAssigned:</label> <input type='text' name='isAssigned' id='isAssigned'  value={$user.isAssigned} /><br />
<input type='submit' value='Create' name='create' /> 
<input type='submit' value='Update' name='update' /> <br />
{if $error ne ""}
			<span style='color:red'>Error: {$error}</span>
{/if}
{if $message ne ""}
			<span style='color:green'>{$message}</span>
{/if}
</fieldset>
</form>
<br />


<H4>Dormant Users</H4>
<form method='post' action='mgmtUser.php'>
<fieldset>
<legend>View & Delete Dormant User(s)</legend>
<table border="1" id="dormant">
<thead>
<tr>
  <th>User ID</th>
  <th>User Name</th>
</tr>
</thead>
{section name=id loop=$dormantData}
<tr>
  <td>{$dormantData[id]->userid}</td>
  <td>{$dormantData[id]->username}</td>
</tr>
{/section}
<input type='submit' value='Delete' name='deleteDormant' />
</table>

{if $errorDormant ne ""}
			<span style='color:red'>Error: {$errorDormant}</span>
{/if}

</fieldset>
</form>

<H4>Users Unvalidated</H4>
<form method='post' action='mgmtUser.php'>
<fieldset>
<legend>View & Delete Unvalidated User(s)</legend>
<table border="1" id="unvalid">
<thead>
<tr>
  <th>User ID</th>
  <th>User Name</th>
</tr>
</thead>
{section name=id loop=$unvalidData}
<tr>
  <td>{$unvalidData[id]->userid}</td>
  <td>{$unvalidData[id]->username}</td>
</tr>
{/section}
<input type='submit' value='Delete' name='deleteUnvalid' />
</table>

{if $errorUnvalid ne ""}
			<span style='color:red'>Error: {$errorUnvalid}</span>
{/if}

</fieldset>
</form>

 
</div>
<div id="right">Test Right</div>
<div class="clearer"></div>                
</div>
<div id="footer">{include file="mgmtfooter.tpl"}
</div>
</div>
</div>

</body>
</html>