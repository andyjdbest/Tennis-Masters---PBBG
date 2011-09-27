<?php

$path = '../../../php/Smarty';
set_include_path(get_include_path() . PATH_SEPARATOR . $path);

#include the common file
require_once 'common.php';
// our database settings
require_once 'DBconfig.php';		

if($_POST) {
	$username = $_POST['username'];
    $password = $_POST['password'];
	$confirm = $_POST['confirm'];
    $email = $_POST['email'];
	$mgrfirstname = $_POST['managerfirstname'];
    $mgrlastname = $_POST['managerlastname'];

    if($password != $confirm) {
		$error = 'Passwords do not match!';
	//	exit();
	} 
	elseif (ctype_alnum($username) === false || ctype_alnum($mgrfirstname) === false || ctype_alnum($mgrlastname) === false) {

		$error = "Names can only contain A-Z 0-9.";
		//exit();
	}
    // check an email address is possibly valid
    elseif (validEmail($email) === false) {
                $error = "Valid email address is needed";
    }

	else {
                $username = stripHTML($username);
                $password = stripHTML($password);
                //$cpassword = stripHTML($cpwd);
                $email = stripHTML($email);
                $mgrfirstname = stripHTML($mgrfirstname);
                $mgrlastname = stripHTML($mgrlastname);
                
                $query = sprintf("SELECT COUNT(userid) FROM users WHERE UPPER(username) = UPPER('%s')",
							mysqli_real_escape_string($conn, $username));
							$result = mysqli_query($conn, $query);
				list($count) = mysqli_fetch_row($result);
				if($count >= 1) {          
                	//if (mysqli_num_rows($result)) {
						$error = 'The username you entered has already been taken. Please try a different one.';
				}
                else {
                    $query = sprintf("SELECT COUNT(userid) FROM users WHERE UPPER(email) = UPPER('%s')",
								mysqli_real_escape_string($conn, $email));
								$result = mysqli_query($conn, $query);
					list($count) = mysqli_fetch_row($result);
					if($count >= 1) {
                	//if (mysqli_num_rows($result)) {
						$error = 'The email is already registered with us.';
					}
                	else {
						$query = sprintf("SELECT COUNT(userid) FROM users WHERE UPPER(firstname) = UPPER('%s') AND UPPER(lastname) = UPPER('%s')",
									mysqli_real_escape_string($conn, $firstname),
                        			mysqli_real_escape_string($conn, $lastname));
                        $result = mysqli_query($conn, $query);
                        list($count) = mysqli_fetch_row($result);
                        if($count >= 1) {
                        //if (mysqli_num_rows($result)) {
                            $error = 'The first name & last name combination has been taken. Please try a different one.';
                        }
                        else {       
                                $query = sprintf("INSERT INTO users(username,password,email,firstname,lastname) VALUES ('%s','%s','%s','%s','%s');",
												mysqli_real_escape_string($conn, $username),
												mysqli_real_escape_string($conn, md5($password)),
                                				mysqli_real_escape_string($conn, $email),
												mysqli_real_escape_string($conn, $mgrfirstname),
												mysqli_real_escape_string($conn, $mgrlastname));
                                if (!(mysqli_query($conn, $query))) {
                                    $error = mysqli_error($conn);
                                }
                                else {
                                    $query = "SELECT userid FROM users ORDER BY userid DESC LIMIT 1";
									$r = mysqli_query($conn,$query);
									$row = mysqli_fetch_row($r);
									$userid = $row[0];
									
									//create the verification part...
                                    $param = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                                    $activationKey = '';
                                    for ($i = 0; $i < 20; $i ++) {
                                                $activationKey .= substr($param, ((int) mt_rand(0, strlen($param)) - 1), 1);
                                     }
                             
                                    //$activationKey =  mt_rand() . mt_rand() . mt_rand() . mt_rand() . mt_rand();
                                    $insert = "INSERT INTO validation(id,actkey,timestamp) VALUES ('$userid','$activationKey',NOW())";
                                    if (!(mysqli_query($conn, $insert))) {
                                                        $error = mysqli_error($conn);
                                        }
                                    else {
                                        //send the email:
                                        $to = $email;
                                        $subject = " Tennis Masters Registration";
                                        $message = "Welcome to our website!\r\rYou, or someone using your email address, has completed registration at Tennis PBBG. You can complete registration by clicking the following link:\rhttp://beta.tennismasters.org/closedregister.php?activationKey=$activationKey\r\rIf this is an error, ignore this email and you will be removed from our mailing list.\r\rRegards,\r Tennis PBBG Team";
                                        $headers = 'From: andy@tennismasters.org' . "\r\n" .
                                        'Reply-To: andy@tennismasters.org' . "\r\n" .
                                        'X-Mailer: PHP/' . phpversion();

                                        mail($to, $subject, $message, $headers);
                                        $message = 'You now need to validate your email address with us. An email has been sent to your email address to complete the registration.'; 
                                    }

                                }
                 }
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
        $error = 'Invalid key. You need to register again.';
    }
    else { 
        $row = mysqli_fetch_row($result);
        $userid = $row[0];
        $update = "UPDATE users SET isValidated = '1' WHERE userid = '$userid'";
        $resultU = mysqli_query($conn,$update);
        if (!$resultU) {
            $error = 'Error in updating the user information' .$userid;
        }
        else { 
            $query = "DELETE FROM validation WHERE id = '$userid'";
            //$resultD = mysqli_query($conn,$query);
            if (!mysqli_query($conn,$query)) {
                $error = 'Error deleting validation key';
            }
            else {
                $message = "Successfully validated. Welcome to the Game. Click the link to the left and login with your credentials.";
            }
        }

    }


}
$smarty->assign('error',$error);
$smarty->assign('message',$message);
$smarty->display('closedregister.tpl');

?>