<?php

require_once 'common.php';
require_once 'DBconfig.php';

session_start();
$userid = $_SESSION['id'];	
$done = 0;
if ($_POST['password'])
{
	$pwd = $_POST['password'];
	$query = sprintf("UPDATE users SET password = '%s' WHERE userid = '%s';",
				mysqli_real_escape_string($conn, md5($pwd)),
                                mysqli_real_escape_string($conn, $userid));
        if (!(mysqli_query($conn, $query))) {
                    	 $message = 'Error while updating password';
        }
	else { 
		$message = 'Password changed successfully.'; 
		$done = 1;
	}
}
	
	$smarty->assign('season',$season);
	$smarty->assign('day',$day);
	$smarty->assign('message',$message);
	$smarty->assign('change',$done);
    	$smarty->display('resetPassword.tpl');


?>