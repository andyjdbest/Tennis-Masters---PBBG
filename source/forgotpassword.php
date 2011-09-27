<?php

$path = '../../../php/Smarty';
set_include_path(get_include_path() . PATH_SEPARATOR . $path);

#include the common file
require_once 'common.php';
// our database settings
require_once 'DBconfig.php';		

if($_POST) {
	$email = $_POST['email'];
	
    	
    	// check an email address is possibly valid
   	if (validEmail($email) === false) {
                $error = "Valid email address is needed";
    	}

	else {
                $email = stripHTML($email);
                
                $query = sprintf("SELECT count(userid) FROM users WHERE UPPER(email) = UPPER('%s')",
							mysqli_real_escape_string($conn, $email));
		$result = mysqli_query($conn, $query);
		list($count) = mysqli_fetch_row($result);
		if($count < 1) {          
                	
			$error = 'We do not have records of the email address you provided.';
		}
                else {
                    $query = sprintf("SELECT userid FROM users WHERE UPPER(email) = UPPER('%s')",
						mysqli_real_escape_string($conn, $email));
                    $result = mysqli_query($conn, $query);
                    $row = mysqli_fetch_row($result);
                    
                    //create the verification part...
                    $param = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                    $activationKey = '';
                    for ($i = 0; $i < 20; $i ++) {
                           $activationKey .= substr($param, ((int) mt_rand(0, strlen($param)) - 1), 1);
                    }
                             
                    
                    $insert = "INSERT INTO validation(id,actkey,timestamp) VALUES ('{$row[0]}','$activationKey',NOW())";
                    if (!(mysqli_query($conn, $insert))) {
                                $error = "Error while generating password recovery email.";
                    }
                    else {
                                  //send the email:
                                        $to = $email;
                                        $subject = " Tennis Masters Password Recovery";
                                        $message = "You, or someone using your email address, has requested to recover your password. You can recovery your password by clicking the following link:\rhttp://alpha1.tennismasters.org/forgotpassword.php?activationKey=$activationKey\r\rIf this is an error, ignore this email.\r\rRegards,\r Tennis Masters Team";
                                        $headers = 'From: andy@tennismasters.org' . "\r\n" .
                                        'Reply-To: andy@tennismasters.org' . "\r\n" .
                                        'X-Mailer: PHP/' . phpversion();

                                        mail($to, $subject, $message, $headers);
                                        $message = 'An email has been sent to your email address to recover your password.'; 
                    }

                }
         }
  
}
elseif (isset($_GET['activationKey']))
{
    //verify validation...
    //$error = "Query string";
    $key = $_GET['activationKey'];
    $key = mysqli_real_escape_string($conn,$key); 
    $query = "SELECT id FROM validation WHERE actkey = '$key'";
    $result = mysqli_query($conn,$query);
    if (!$result)
    {
        $error = 'Invalid key. Use the password forgot feature again.';
    }
    else { 
        $row = mysqli_fetch_row($result);
        $userid = $row[0];
        //set the userid in the session and redirect user to resetPassword page
        session_start();
        $_SESSION['id'] = $userid;
        header('Location:resetPassword.php');
    }
    
 }
 
$smarty->assign('error',$error);
$smarty->assign('message',$message);
$smarty->display('forgotpassword.tpl');

?>