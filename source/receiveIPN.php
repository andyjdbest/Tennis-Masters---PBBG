<?php

// PHP 4.1
require_once 'DBconfig.php';

$my_email = "andyjdbest@gmail.com";
// read the post from PayPal system and add 'cmd'
$req = 'cmd=_notify-validate';

foreach ($_POST as $key => $value) {
$value = urlencode(stripslashes($value));
$req .= "&$key=$value";
}

// post back to PayPal system to validate
$header .= "POST /cgi-bin/webscr HTTP/1.0\r\n";
$header .= "Content-Type: application/x-www-form-urlencoded\r\n";
$header .= "Content-Length: " . strlen($req) . "\r\n\r\n";
$fp = fsockopen ('ssl://www.paypal.com', 443, $errno, $errstr, 30);
//$fp = fsockopen ('www.sandbox.paypal.com', 80, $errno, $errstr, 30); //sandbox

// assign posted variables to local variables
$item_name = $_POST['item_name'];
$item_number = $_POST['item_number'];
$payment_status = $_POST['payment_status'];
//$payment_amount = $_POST['payment_gross'];
$payment_amount = $_POST['mc_gross'];
$payment_currency = $_POST['mc_currency'];
$txn_id = $_POST['txn_id'];
$receiver_email = $_POST['receiver_email'];
$payer_email = $_POST['payer_email'];
$user_id = $_POST['custom']; //custom field that was entered to store the userid of the user making the payment


if (!$fp) {
// HTTP ERROR
} else {
fputs ($fp, $header . $req);
while (!feof($fp)) {
$res = fgets ($fp, 1024);
if (strcmp ($res, "VERIFIED") == 0) {
// check the payment_status is Completed
	if(strcmp($payment_status,"Completed") == 0) {
	// check that txn_id has not been previously processed
	
		// check that receiver_email is your Primary PayPal email
		if(strcmp($receiver_email,$my_email) == 0) {	
			// check that payment_amount/payment_currency are correct
			if($payment_currency == 'USD'){	
				if ($payment_amount == "10.00"){
					$credits = 80;
					//fetch the membership details of the user
					//$query = mysql_query("SELECT credits,memberTime,memberTill 
					//	from users WHERE userid = $user_id");
					$query = mysql_query("SELECT credits,memberTime,memberTill 
						from users WHERE userid = $user_id");		
					$member= mysql_fetch_row($query);
					$original = strtotime($member[1]);
					//was a member before
					if ($original > 0){
						$old = strtotime("$member[2] + 3 months");
						$till = date( 'Y-m-d H:i:s', $old);
						$since = date( 'Y-m-d H:i:s', $original); 
					}
					//new member
					else {
						$since = date( 'Y-m-d H:i:s' );
						$till = date( 'Y-m-d H:i:s', strtotime("+3 months"));
					}
					$credits = $member[0] + $credits;
					$update = "UPDATE users SET credits = '$credits', memberTime = '$since', 
						memberTill = '$till' WHERE userid = $user_id";
					if (!mysql_query($update)){
						$to = $my_email;
						$subject = 'Payment Failure';
						$body = mysql_error();
						$headers = 'From:andy@tennismasters.org' . "\r\n";  
						mail($to, $subject, $body, $headers);	
					}
					// process payment
					$to = $my_email;
					$subject = 'Payment Success';
					$headers = 'From:andy@tennismasters.org' . "\r\n";  
		        	 	foreach ($_POST as $key => $value) { $body .= "\n$key: $value"; }
		        		 $body .= "$payment_amount was added.";
		        		 mail($to, $subject, $body, $headers);
	        		}
	        		else {
	        			$to = $my_email;
						$subject = 'Currency Amount Failure';
						$body = mysql_error();
						$headers = 'From:andy@tennismasters.org' . "\r\n";  
						mail($to, $subject, $body, $headers);	
	        		}
        		 }
        		 else {
        		 	
	        			$to = $my_email;
						$subject = 'Currency Failure';
						$body = mysql_error();
						$headers = 'From:andy@tennismasters.org' . "\r\n";  
						mail($to, $subject, $body, $headers);	
	        		
        		 }
        		}
        		else {
	        			$to = $my_email;
						$subject = 'Email Failure';
						$body = mysql_error();
						$headers = 'From:andy@tennismasters.org' . "\r\n";  
						mail($to, $subject, $body, $headers);	
	        		}
        		
      	}
      	else {
      						$to = $my_email;
						$subject = 'Status Fail';
						$body = 'manual';
						$headers = 'From:andy@tennismasters.org' . "\r\n";  
						mail($to, $subject, $body, $headers);	
	}

}
else if (strcmp ($res, "INVALID") == 0) {
// log for manual investigation
$to = $my_email;
						$subject = 'Manual';
						$body = 'manual';
						$headers = 'From:andy@tennismasters.org' . "\r\n";  
						mail($to, $subject, $body, $headers);	
}
}
fclose ($fp);
}

         
      
    
   

?>