<?php

require_once 'common.php';
require_once 'DBconfig.php';

session_start();
if (@$_SESSION['authenticated'] == 'true' & @$_SESSION['assigned'] == 1) {
	$type = '';
	
	if ($_GET['to']){
		if (ctype_digit($_GET['to']) == false) {
			$error = "Invalid user";
		}
		else {
			$receiver_id = $_GET['to'];
			$sender_id = $_SESSION['userid'];
			$type = 'memberCompose';
			//fetch the receiver manager details
			$query = "SELECT username 
				FROM `users` WHERE userid = '$receiver_id' LIMIT 1";
			$r = mysql_query($query);
			$row = mysql_fetch_row($r);
	
		}
	}
	
	if ($_GET['message']){
		if (ctype_digit($_GET['message']) == false) {
			$error = "Invalid message";
		}
		else {
			$message_id = $_GET['message'];
			$receiver_id = $_SESSION['userid'];
			$type = 'Read';
			//fetch the message
			$query = "SELECT m.id AS mid, m.subject, m.body, m.id_sender, u.username, m.read 
				FROM `messages` AS m JOIN users AS u ON u.userid = m.id_sender 
				WHERE m.id = '$message_id' AND del_sender = 0 AND del_receiver = 0 LIMIT 1";
			$r = mysql_query($query);
			$in_message = mysql_fetch_row($r);
			$in_message[2] = preg_replace('@(https?://([-\w\.]+)+(:\d+)?(/([\w/_\.]*(\?\S+)?)?)?)@', '<a href="$1">$1</a>', $in_message[2]);
			
			$update = "UPDATE messages SET `read` = 1 WHERE id = '$message_id'";
			if (!mysqli_query($conn,$update)) {
                //print 'Error processing message.' . mysqli_error($conn);
				$error = 'Error processing message';
             }
			if ($_SESSION['new_mail'] > 0 && $in_message[5] == 0)
				$_SESSION['new_mail'] = $_SESSION['new_mail'] - 1; 
			
		}
	}
	
	if ($_POST['compose']) {
		if (ctype_digit($_POST['receiver']) == false) {
			$error = "invalid user";
		}
		else {
			$receiver_id = $_POST['receiver'];
			$sender_id = $_SESSION['userid'];
			$subject = mysql_real_escape_string($_POST['subject']);
			$message = mysql_real_escape_string($_POST['message']);
			if ($receiver_id != $sender_id) {
				$subject = stripHTML($subject);
				$message = stripHTML($message);
				$insert = "INSERT INTO messages (id_sender,id_receiver,date,subject,body) 
					VALUES ('$sender_id', '$receiver_id', NOW(),'$subject','$message')";
			
				if (!mysqli_query($conn,$insert)) {
		                	print 'Error while sending message.' . mysqli_error($conn);
					$error = 'Error sending message';
					header("location:mail.php?type=inbox&message=$error");	
             			}
				else {
					$message = "Message sent succcessfully";
					header("location:mail.php?type=inbox&message=$message");	
				}
			}
		}	
	}
	
	if ($_POST['new_compose']) {
		if (ctype_alnum($_POST['name_receiver']) == false) {
			$error = "Invalid user";
		}
		else {
			$receiver_name = mysql_real_escape_string($_POST['name_receiver']);
			$sender_id = $_SESSION['userid'];
			$subject = mysql_real_escape_string($_POST['subject']);
			$message = mysql_real_escape_string($_POST['message']);
			
			$query = mysql_query("SELECT userid FROM users WHERE username = '$receiver_name'");
			$row = mysql_fetch_array($query);
			if ($row[0]>0)
			{
				$receiver_id = $row[0];
				if ($receiver_id != $sender_id) {
					$subject = stripHTML($subject);
					$message = stripHTML($message);
					$insert = "INSERT INTO messages (id_sender,id_receiver,date,subject,body) VALUES 
						('$sender_id', '$receiver_id', NOW(),'$subject','$message')";
			
					if (!mysqli_query($conn,$insert)) {
        	        			print 'Error while sending message.' . mysqli_error($conn);
						$error = 'Error sending message';
						header("location:mail.php?type=inbox&message=$error");	
             				}
					else {
						$message = "Message sent succcessfully";
						header("location:mail.php?type=inbox&message=$message");	
					}
				}
			}
			else {
				$error = 'Invalid user';
			}
		}	
	}
	
	if ($_POST['reply_compose']) {
		if (ctype_digit($_POST['receiver']) == false) {
			$error = "Invalid user";
		}
		else {
			$receiver_id = $_POST['receiver'];
			$sender_id = $_SESSION['userid'];
			$subject = mysql_real_escape_string($_POST['subject']);
			$message = mysql_real_escape_string($_POST['message']);
			
			$subject = stripHTML($subject);
			$message = stripHTML($message);
			$insert = "INSERT INTO messages (id_sender,id_receiver,date,subject,body) VALUES ('$sender_id', '$receiver_id', NOW(),'$subject','$message')";
			
			if (!mysqli_query($conn,$insert)) {
               // print 'Error while sending message.' . mysqli_error($conn);
				$error = 'Error sending message';
				header("location:mail.php?type=inbox&message=$error");	
             }
			else {
				$message = "Message sent succcessfully";
				header("location:mail.php?type=inbox&message=$message");	
			}
		}	
	}
	
	if ($_POST['delete']) {
		if (ctype_digit($_POST['message_id']) == false) {
			$error = "Invalid message";
		}
		else {
			$message_id = $_POST['message_id'];
			
			$update = "UPDATE messages SET del_receiver = 1 WHERE id = '$message_id'";
			
			if (!mysqli_query($conn,$update)) {
               // print 'Error while deleting message.' . mysqli_error($conn);
				$error = 'Error deleted message';
				header("location:mail.php?type=inbox&message=$error");	
             }
			else {
				$message = "Message deleted";
				header("location:mail.php?type=inbox&message=$message");	
			}
		}	
	}
	
	if ($_POST['reply']) {
		if (ctype_digit($_POST['message_id']) == false) {
			$error = "Invalid message";
		}
		else {
			$message_id = $_POST['message_id'];
			$type = "Reply";
			
			$query = "SELECT m.id_sender,u.username,m.subject,m.body,m.id 
					FROM messages AS m JOIN users AS u ON m.id_sender = u.userid
					WHERE m.id = '$message_id' AND m.del_receiver = 0 LIMIT 1";
			$r = mysql_query($query);
			$reply = mysql_fetch_row($r);
			$reply[3] = preg_replace('@(https?://([-\w\.]+)+(:\d+)?(/([\w/_\.]*(\?\S+)?)?)?)@', '<a href="$1">$1</a>', $reply[3]);
			
			$subject = "Re:- " . $reply[2];
			$reply[3] = ">  "  . $reply[3] . " <";
			//print_r($reply[2]);
		}
		
	}
	
	$day =  floor((mktime() - $season_start)/86400);
	
	$q = "SELECT COUNT(id) FROM `messages` WHERE id_receiver = {$_SESSION['userid']} AND `read` = 0 AND del_receiver = 0";
	$r = mysql_query($q);
	$rf = mysql_fetch_row($r);
	$_SESSION['new_mail'] = $rf[0];
		
	$smarty->assign('season',$season);
	$smarty->assign('day',$day);
	$smarty->assign('idteam',$_SESSION['id_team']);
    $smarty->assign('idleague',$_SESSION['id_league']);
	$smarty->assign('userid',$_SESSION['userid']);
	$smarty->assign('uname',$_SESSION['username']);
    $smarty->assign('new_mail',$_SESSION['new_mail']);
	$smarty->assign('cManager',$_SESSION['countryM']);
	$smarty->assign('member',$_SESSION['member']);
	$smarty->assign('credits',$_SESSION['credits']);
	
	$smarty->assign('read', $in_message);
	$smarty->assign('reply',$reply);
	$smarty->assign('subject',$subject);
	$smarty->assign('type', $type);
	$smarty->assign('id_receiver',$receiver_id);
	$smarty->assign('rec_uname',$row[0]);
	$smarty->assign('error',$error);
	$smarty->assign('message',$message);
	$smarty->display('message.tpl');

}

else {
	header("Location:index.php");
}
?>