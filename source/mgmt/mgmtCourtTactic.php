<?php
      
        #include the common file
        require_once "common.php";
        
        #include the DBConfig file
        include ("../DBconfig.php");
 
        function updateCourt()
        {
            $query = "SELECT * FROM courttype;";
            $r = mysql_query($query);
            global $courtdata;
                
            while ($ob = mysql_fetch_object($r)) {
                   $courtdata[] = $ob;
					//$courts[] = $ob;			
            } 
				
            global $courts;
	    $r = mysql_query($query);
	    while ($row = mysql_fetch_row($r)) {
                    $courts[] = $row[1];
                    //$courts[] = $ob;
                }			
        }
		
	function updateTactic()
        {
            $query = "SELECT * FROM tactictype;";
            $r = mysql_query($query);
                global $tacticdata;
                
                while ($ob = mysql_fetch_object($r)) {
                    $tacticdata[] = $ob;			
                } 

                $r = mysql_query($query);
		global $tactics;
		while ($row = mysql_fetch_row($r)) {
                    $tactics[] = $row[1];			
                }			
        }

        function updateBonus()
        {
            $query = "SELECT t.tacticname,c.name,b.stats,b.bonus FROM tacticbonus as b JOIN tactictype as t ON t.idtactictype = b.idtactictype JOIN courttype as c ON c.idcourttype = b.idcourttype";
            $r = mysql_query($query);
            global $bonusdata;

            while ($ob = mysql_fetch_object($r)) {
                    $bonusdata[] = $ob;
                }
        }

        session_start();
         if (@$_SESSION['authenticated'] == 'true' && @$_SESSION['admin'] == 'true')
         {
            //$messageCourt = '';
            //$errorCourt = '';
            $courts = array();
            $courtdata = array();
		
            $tacticdata = array();
            $tactics = array();

            $bonusdata = array();
            $stats = array('Serve','Forehand','Backhand','Volley','Consistency','Power','Speed','Stamina');

            updateCourt();
            updateTactic();
            updateBonus();

           if ($_POST['CourtCreate']) {
               if (ctype_alnum($_POST['court']) === false) 
                    {
                        $errorCourt = 'Check the inputs.';
                    }
                else {                     
			$court = $_POST['court'];
											 
			//check if the court exists
                        $query = "SELECT idcourttype FROM courttype WHERE name = '$court'";
                        $r = mysqli_query($conn,$query);
                        list($count) = mysqli_fetch_row($r);
                        if ($count >= 1) {
                                    $errorCourt = 'Court Type already exists' .$court;
                        }

                        else {
                               $insert = "INSERT INTO courttype(name) VALUES('$court')";                            
                                if (!(mysqli_query($conn, $insert))) {
                                    $errorCourt = mysqli_error($conn);
                                } 
                                if ($errorCourt == '') {
                                    $messageCourt = 'New Court added';
                                    //updateplayer();
                                }
                        } 
                     } 
              }
			  
            elseif ($_POST['TacticCreate']) {
               if ((ctype_alnum($_POST['name']) === false) || ctype_alnum($_POST['shortname']) === false)
                    {
                        $errorTactic = 'Check the inputs.';
                    }
                else {                     
                        $name = $_POST['name'];
			$shortname = $_POST['shortname'];
											 
			//check if the tactic exists
                        $query = "SELECT idtactictype FROM tactictype WHERE tacticname = '$name' || tacticshortname = '$shortname'";
                        $r = mysqli_query($conn,$query);
                        list($count) = mysqli_fetch_row($r);
                        if ($count >= 1) {
                                    $errorTactic = 'Tactic type already exists' .$name .' ' .$shortname;
                        }

                        else {
                               $insert = "INSERT INTO tactictype(tacticname,tacticshortname) VALUES('$name','$shortname')";                            
                                if (!(mysqli_query($conn, $insert))) {
                                    $errorTactic = mysqli_error($conn);
                                } 
                                if ($errorTactic == '') {
                                    $messageTactic = 'New Tactic added';
                                    //updateplayer();
                                }
                        } 
                     } 
              }
	//INSERT INTO tacticbonus(`idtactictype`,`idcourttype`,`stats`,`bonus`) VALUES ((SELECT idtactictype FROM tactictype WHERE tacticshortname="SV"),(SELECT idcourttype FROM courttype WHERE name="GRASS"), "Serve", 2);
        elseif ($_POST['BonusCreate']) {
               
               if ((ctype_alnum($_POST['tacticname']) === false) || (ctype_alnum($_POST['courtname']) === false) ||
                   ctype_alnum($_POST['statname']) === false )

                    {
                        $errorBonus = 'Check the inputs.';
                    }
                else {

                    $tacticnum = $_POST['tacticname'] + 1;
                    $courtnum = $_POST['courtname'] + 1;
                    $statnum = $_POST['statname'];
                    $stat = $stats[$statnum];
                    $bonusvalue = $_POST['bonusNum'];
                    
                    $insert = "INSERT INTO tacticbonus(idtactictype,idcourttype,stats,bonus) VALUES ('$tacticnum','$courtnum', '$stat', '$bonusvalue')";
                    if (!(mysqli_query($conn, $insert))) {
                                 $errorBonus = mysqli_error($conn);
                    }
                    if ($errorBonus == '') {
                               $messageBonus = 'New Tactic Bonus added';
                    }
               
              }
        }
				 
			$smarty->assign('errorCourt',$errorCourt);
        		$smarty->assign('messageCourt',$messageCourt);
        		$smarty->assign('courtdata',$courtdata);
			$smarty->assign('courts',$courts);
			
			$smarty->assign('errorTactic',$errorTactic);
        		$smarty->assign('messageTactic',$messageTactic);
        		$smarty->assign('tacticdata',$tacticdata);
			$smarty->assign('tactics',$tactics);

                        $smarty->assign('errorBonus',$errorBonus);
        		$smarty->assign('messageBonus',$messageBonus);
        		$smarty->assign('bonusdata',$bonusdata);
			//$smarty->assign('bonus',$bonus);
				
			$smarty->assign('stats',$stats);
        		$smarty->display('mgmtCourtTactic.tpl');
           }  
?>