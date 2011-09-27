<?php

//$path = '../../../php/Smarty';
      //  set_include_path(get_include_path() . PATH_SEPARATOR . $path);

        //include the Smarty class
	//include( 'Smarty.class.php' );
	
        //include the Smarty class for local testing
	include( '../../Smarty-libs/Smarty.class.php' );

	$smarty = new Smarty();

        $smarty->template_dir = '../smarty/templates';
        $smarty->compile_dir = '../smarty/templates_c';
        $smarty->cache_dir = '../smarty/cache';
        $smarty->config_dir = '../smarty/configs';

//a few common variables
$season = 1;
$season_start = mktime(03,00,00,10,10,2010); //03:00:00 hours on 25th July 10
$trial_start = mktime(02,00,00,10,12,2010);  //the first tuesday after start
$usafirstname = array( 'David', 'Alex', 'Christian', 'Bryan', 'Lucas', 'Hunter', 'Gregory', 'Nigel', 'Frank', 'Logan', 'Liam', 'Jake', 'Richardson', 'Aaron', 'Kenny', 'David', 'Dominic', 'Blake', 'Luke', 'Sonny');
$usalastname = array( 'Bailey', 'Ward', 'Beard', 'Butler', 'Cooper', 'Greybill', 'Blackstone', 'Scott', 'Ross', 'Patterson', 'James', 'Evans', 'Lee', 'Sordo', 'Donovan', 'Jackson', 'Varley', 'Bolam', 'Sturridge', 'Ruff');
$espfirstname = array( 'Juan', 'Rafael', 'Jullian', 'Pablo', 'Manuel', 'Sergi', 'Sergio', 'Jose', 'Alberto', 'Oscar', 'Alex', 'Fernando', 'Carlos', 'Tomas', 'Ricardo', 'Javier', 'Jordi', 'Galo', 'Roberto', 'Feliciano');
$esplastname = array( 'Nadal', 'Lopez', 'Garcia', 'Garcia-Lopez', 'Alonso', 'Torres', 'Gonzales', 'Costa', 'Sanchez', 'Martinez', 'Benitez', 'Rodriguez', 'Hernandez', 'Vargas', 'Castro', 'Diaz', 'Ramirez', 'Ramos', 'Reyes', 'Romero');


function random_number($type='INTEGER', $min=0, $max=10)
 {
   if ($type == 'INTEGER') {
          return (mt_rand($min, $max));
    }
   else {
          return ($min+lcg_value()*(abs($max-$min)));
        }
   return 0;
}


function stripHTML($sString)
{
    return htmlentities($sString, ENT_QUOTES);
}

/**
Validate an email address.
Provide email address (raw input)
Returns true if the email address has the email 
address format and the domain exists.
*/
function validEmail($email)
{
   $isValid = true;
   $atIndex = strrpos($email, "@");
   if (is_bool($atIndex) && !$atIndex)
   {
      $isValid = false;
   }
   else
   {
      $domain = substr($email, $atIndex+1);
      $local = substr($email, 0, $atIndex);
      $localLen = strlen($local);
      $domainLen = strlen($domain);
      if ($localLen < 1 || $localLen > 64)
      {
         // local part length exceeded
         $isValid = false;
      }
      else if ($domainLen < 1 || $domainLen > 255)
      {
         // domain part length exceeded
         $isValid = false;
      }
      else if ($local[0] == '.' || $local[$localLen-1] == '.')
      {
         // local part starts or ends with '.'
         $isValid = false;
      }
      else if (preg_match('/\\.\\./', $local))
      {
         // local part has two consecutive dots
         $isValid = false;
      }
      else if (!preg_match('/^[A-Za-z0-9\\-\\.]+$/', $domain))
      {
         // character not valid in domain part
         $isValid = false;
      }
      else if (preg_match('/\\.\\./', $domain))
      {
         // domain part has two consecutive dots
         $isValid = false;
      }
      else if
(!preg_match('/^(\\\\.|[A-Za-z0-9!#%&`_=\\/$\'*+?^{}|~.-])+$/',
                 str_replace("\\\\","",$local)))
      {
         // character not valid in local part unless 
         // local part is quoted
         if (!preg_match('/^"(\\\\"|[^"])+"$/',
             str_replace("\\\\","",$local)))
         {
            $isValid = false;
         }
      }
      if ($isValid && !(checkdnsrr($domain,"MX") || checkdnsrr($domain,"A")))
      {
         // domain not found in DNS
         $isValid = false;
      }
   }
   return $isValid;
}


?>