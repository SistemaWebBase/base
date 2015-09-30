<?php
// Variaveis
define('DB_SERVER', 'localhost');
define('DB_NAME', 'sistemaweb');
define('DB_USER', 'postgres');
define('DB_PASSWORD', '554860Ti');

class Conexao {
     var $conn;
	 
	 public function __construct() {
	 		$this->conn = pg_connect("host=" . DB_SERVER . " user=" . DB_USER . " password=" . DB_PASSWORD . " dbname=" . DB_NAME);
	 }
	 
	 public function getConnection() {
	 		return $this->conn;
	 }
	 
	 public function query($query) {			
			return pg_query($this->conn, $query);
	 }
	 
}
?>
