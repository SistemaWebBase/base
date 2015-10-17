<?php
	// Nome do diretorio base
	define ('BASE_DIR', __DIR__ . "/..");

	// Importar
	require_once 'conf.php';
	require_once 'logs.php';
	
	// Setar Timezone
	date_default_timezone_set(getConfig("timezone"));

	// Handler de erros	
	handlerLogInit();
	
	// Setar variaveis de ambiente
	ini_set('upload_tmp_dir', getConfig('upload_tmp_dir'));
	ini_set('upload_max_filesize', getConfig('upload_max_filesize'));
	ini_set('max_file_uploads', getConfig('max_file_uploads'));
?>
