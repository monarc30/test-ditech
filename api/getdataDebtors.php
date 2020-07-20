<?php

	require_once( "../env.php" ) ;	

	require_once( "../controllers/DataController.php" ) ;	

	echo DataController::getDataGeneric( $_REQUEST['param'], $url_api, $_REQUEST['type'] );

?>