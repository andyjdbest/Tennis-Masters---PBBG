<?php

        #include the common file
        include ("common.php");

        include ("../DBconfig.php");
     
         session_start();
         if (@$_SESSION['authenticated'] == 'true' && @$_SESSION['admin'] == 'true')
         {

               
                $resultValue = array(); 
				$fixturedata = array();               
                $messageValue = '';           
                $errorValue = '';

                function updateValue()
                {
                     $query = sprintf("SELECT * FROM statvalues");
                     $r = mysql_query($query);
                     global $resultValue;
                     while ($ob = mysql_fetch_object($r)) {
                            $resultValue[] = $ob;
                     }

                }
				
				function updateFixture()
				{
					$query = sprintf("SELECT * FROM fixture_type");
                     $r = mysql_query($query);
                     global $fixturedata;
                     while ($ob = mysql_fetch_object($r)) {
                            $fixturedata[] = $ob;
                     }
				}
                
                updateValue();
				updateFixture();
               
             
             if($_POST['AddValue']) {
                    $valuenum = $_POST['valuenum'];
                    $valuetext = $_POST['valuetext'];

                    
                    if ((ctype_alnum($valuenum) === false) || (ctype_alnum($valuetext) === false))
                    {
                        $errorValue = 'Check the inputs.';
                    }

                    else
                    {
                        $insert = "INSERT INTO statvalues(valuenum,valuetext) VALUES ($valuenum,'$valuetext')";
                        if(!(mysqli_query($conn, $insert))) {
                                $errorValue = mysqli_error($conn);
                        }
                        else {
                            $messageValue = 'New Value Added';
                            updateValue();
                        }
                    }
             }

            if($_POST['AddFixture']) {
                    $id = $_POST['fixID'];
                    $name = $_POST['fixName'];

                    
                    if ((ctype_digit($id) === false) || (ctype_alnum($name) === false))
                    {
                        $errorFixture = 'Check the inputs.';
                    }

                    else
                    {
                        $insert = "INSERT INTO fixture_type(id_fixture,name_fixture) VALUES ('$id','$name')";
                        if(!(mysqli_query($conn, $insert))) {
                                $errorFixture = mysqli_error($conn);
                        }
                        else {
                            $messageFixture = 'New Fixture Added';
                            updateFixture();
                        }   
                    }
             }

			// global $messageStat;
             
             $smarty->assign('messageValue', $messageValue);
             $smarty->assign('errorValue', $errorValue);
			 $smarty->assign('messageFixture', $messageFixture);
             $smarty->assign('errorFixture', $errorFixture);
             $smarty->assign('resultValue',$resultValue);
			 $smarty->assign('fixturedata',$fixturedata);
             $smarty->display('mgmtStat.tpl');
         }


?>