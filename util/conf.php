<?php
	function parseConfig() {
		return parse_ini_file(__DIR__ . "/../conf/sistemaweb.ini");
	}
	
	function getConfig($name) {
		return parseConfig()[$name];
	}
?>
