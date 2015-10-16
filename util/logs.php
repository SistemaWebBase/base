<?php
	require_once 'conf.php';
	
	function gravarLog($msg, $level) {
		// Testar nivel de log
		$levels = getConfig("log_levels");
		$ls = explode(",", $levels);
		$flag = FALSE;
		foreach ($ls as $l) {
			if ($level == trim($l)) {
				$flag = TRUE;
				break;
			}
		}
		
		if (! $flag) {
			return;
		}
		
		// Nome da pasta
		$dir = __DIR__ . "/../logs/" . date("Y/m/d");
		if (file_exists($dir) == FALSE) {
			mkdir($dir, 0777, true);
		}

		// Abrir arquivo e gravar
		$arq = fopen($dir . "/log.txt", "a");
		
		fwrite($arq, "Data/Hora....: " . date("d/m/Y H:i:s") . "\n");
		fwrite($arq, utf8_decode("Nível do Erro: " . $level . "\n"));
		fwrite($arq, "IP Remoto....: " . $_SERVER['REMOTE_ADDR'] . "\n");
		fwrite($arq, utf8_decode("Página.......: " . $_SERVER['REQUEST_URI'] . "\n"));
		fwrite($arq, utf8_decode("Descrição....:\n\n"));
		fwrite($arq, $msg . "\n");
		fwrite($arq, "=========================================================================================\n");

		// Fechar arquivo
		fclose($arq);
		
	}
	
	// Mostrar log
	function mostrarLog() {
		// Nome da pasta
		$dir = __DIR__ . "/../logs/" . date("Y/m/d");
		if (file_exists($dir) == FALSE) {
			mkdir($dir, 0777, true);
		}

		// Abrir arquivo e gravar
		$arq = fopen($dir . "/log.txt", "r");
		
		$log = "";
		$count = 0;
		while (! feof($arq)) {
			$linha = fgets($arq, 4096);
			$log .= $linha;
			if ($linha == "=========================================================================================\n") {
				$count++;
			}
		}
		
		// fechar arquivo
		fclose($arq);
		
		// retornar texto
		return utf8_encode($log) . "\nForam encontrados " . $count . " erros.\n";
	}
	
	function contarErrosLog() {
		// Nome da pasta
		$dir = __DIR__ . "/../logs/" . date("Y/m/d");
		if (file_exists($dir) == FALSE) {
			mkdir($dir, 0777, true);
		}

		// Abrir arquivo e gravar
		$arq = fopen($dir . "/log.txt", "r");
		
		$count = 0;
		while (! feof($arq)) {
			$linha = fgets($arq, 4096);
			if ($linha == "=========================================================================================\n") {
				$count++;
			}
		}
		
		// fechar arquivo
		fclose($arq);
		
		// retornar texto
		return $count;
	}
	
	// handler
	function handlerLog($errno, $errstr, $errfile, $errline) {
		$level = "";
		switch ($errno) {
			case E_ERROR: $level = "E_ERROR";break;
			case E_WARNING: $level = "E_WARNING";break;
			case E_PARSE: $level = "E_PARSE";break;
			case E_NOTICE: $level = "E_NOTICE";break;
			case E_CORE_ERROR: $level = "E_CORE_ERROR";break;
			case E_CORE_WARNING: $level = "E_CORE_WARNING";break;
			case E_COMPILE_ERROR: $level = "E_COMPILE_ERROR";break;
			case E_COMPILE_WARNING: $level = "E_COMPILE_WARNING";break;
			case E_USER_ERROR: $level = "E_USER_ERROR";break;
			case E_USER_WARNING: $level = "E_USER_WARNING";break;
			case E_USER_NOTICE: $level = "E_USER_NOTICE";break;
			case E_STRICT: $level = "E_STRICT";break;
			case E_RECOVERABLE_ERROR: $level = "E_RECOVERABLE_ERROR";break;
			default: "UNKNOWN";break;
		}
		
		gravarLog($level . " : " . $errstr, $level);
	}
	
	function handlerLogInit() {
		set_error_handler("handlerLog");
	}

?>
