<?php
// Variaveis
define('DB_SERVER', 'localhost');
define('DB_NAME', 'sistemaweb');
define('DB_USER', 'postgres');
define('DB_PASSWORD', '554860Ti');

@session_start();

class Conexao {
     var $conn;
	 
	 public function __construct() {
	 		$this->conn = pg_connect("host=" . DB_SERVER . " user=" . DB_USER . " password=" . DB_PASSWORD . " dbname=" . DB_NAME);
			pg_query($this->conn, "SET sistemaweb.usuario='" . $_SESSION['id'] . "'");
			pg_query($this->conn, "SET sistemaweb.pagina='" . $_SERVER['HTTP_REFERER'] . "'");
	 }
	 
	 public function getConnection() {
	 		return $this->conn;
	 }

	 public function query($query) {
			$result = pg_query($this->conn, $query);
			
			// GRAVAR LOG SE HOUVER ERRO
			if ($result == FALSE) {
				require_once 'logs.php';
				gravarLog(pg_last_error($this->conn) . "\nQUERY: \"" . $query . "\"", "ERROR");
			}
			
			return $result;
	 }
	 	 
}
?>
