<?php

require_once 'common.php';
require_once 'DBconfig.php';
session_start();
if($_POST) {


$username = $_POST['username'];
$password = $_POST['password'];
if (!(ctype_alnum($username))) {
        $error = "You have entered invalid input.";
      }
else {
        $username = stripHTML($username);
        $password = stripHTML($password);

		$query = sprintf("SELECT COUNT(userid),userid,isValidated,isAdmin,isAssigned,isMember,credits FROM users WHERE UPPER(username) = UPPER('%s') AND password = '%s'",
			mysqli_real_escape_string($conn, $username),
			mysqli_real_escape_string($conn, md5($password)));

	$result = mysqli_query($conn, $query);
	$row = mysqli_fetch_row($result);
	if($row[0] > 0) {
        
       	$_SESSION['authenticated'] = 'true';
		$_SESSION['userid'] = $row[1];
        $_SESSION['username'] = $username;
		$_SESSION['member'] = $row[5];
		$_SESSION['credits'] = $row[6];
        $user = $row[1];

                /*
		$query = sprintf("UPDATE users SET last_login = NOW() WHERE UPPER(username) = UPPER('%s') AND password = '%s'",
			mysqli_real_escape_string($conn, $username),
			mysqli_real_escape_string($conn, md5($password)));
		mysqli_query($conn, $query);
                 */
	     $isAdmin = $row[3];
         $isValid = $row[2];
         $isAssigned = $row[4];
		 $_SESSION['assigned'] = $isAssigned;
		if($isAdmin == 1) {
			$_SESSION['admin'] = 'true';
			header('Location:./mgmt/index.php');
		}
                elseif ($isValid == 0) {
                    $error = 'Kindly verify your email address before you can proceed.';
                }
                else {
			$ip = $_SERVER["REMOTE_ADDR"];
                        
                        $query = "INSERT INTO logins(iduser,time,ip_address) VALUES ('$user',NOW(),inet_aton('$ip'))";
                        if (!mysql_query($query)) {
                            $error = 'Logging error';
                        }
                        else if ($isAssigned == 1) {
                                //check unread mail....
				$q = "SELECT COUNT(id) FROM `messages` WHERE id_receiver = '$user' AND `read` = 0 AND del_receiver = 0";
				$r = mysql_query($q);
				$row = mysql_fetch_row($r);
				$_SESSION['new_mail'] = $row[0];
				
				//check if user is manager of a country to show country menu
				$q = mysql_query("SELECT id_country FROM country_team WHERE manager = '$user'");
				$row = mysql_fetch_row($q);
				$_SESSION['countryM'] = $row[0];
				//echo $_SESSION['country'];
				//print_r($row);
				header('Location:index.php');
                            }
                        else {
                                header('Location:selectCountry.php');
                        }
		}
	} else {
		$error = 'Check the username and/or password.';
       }
}
}

		$q = "SELECT (`iduser`),`time`,NOW(),PERIOD_DIFF(NOW(),time)  FROM `logins` WHERE PERIOD_DIFF(NOW(),time) < 1800 GROUP BY iduser"; 
		$a = mysql_query($q);
		$users = mysql_affected_rows();
		
		$day =  floor((mktime() - $season_start)/86400);
		
        $smarty->assign('users', $users);
		$smarty->assign('season',$season);
		$smarty->assign('day',$day);
$smarty->assign('error',$error);
$smarty->display('index.tpl');
?>