<?php
	require_once 'conf.php';
	require_once 'logs.php';
	
	// Setar Timezone
	date_default_timezone_set(getConfig("timezone"));

	// Handler de erros	
	handlerLogInit();
?>
