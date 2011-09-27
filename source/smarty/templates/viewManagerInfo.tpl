{include file="validuserHeader.tpl"}

<table width="100%" id="manager">
<tr>
  <td><a href="message.php?to={$id_manager}"><img src="assets/images/icon_email.gif"></a></td>
  <td><b>Username:</b></td><td>{$manager_name}</td>
</tr>
    <tr>
  <td></td><td><b>Country:</b></td><td>{$country}</td>
  </tr>
  <tr>
  <td></td><td><b>Academy:</b></td><td><a href="viewAcademy.php?academy={$academy_id}">{$academy}</a></td>
  </tr>		
  <tr>
  <td></td><td><b>Date:</b></td><td>{$date}</td>
  </tr>	
</table>  				
<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
 
				
{include file="validuserFooter.tpl"}

</html>