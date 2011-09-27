<?php

      #include the common file
      require_once 'common.php';

       session_start();
         if (@$_SESSION['authenticated'] == 'true' && @$_SESSION['admin'] == 'true')
         {
            
			
			$smarty->assign('error',$error);
            $smarty->display('mgmtindex.tpl');
         }

?>