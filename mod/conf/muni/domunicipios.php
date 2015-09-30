<?php
   require_once '../../../util/conexao.php';

   $municipio = str_replace("'", "", trim($_POST['municipio']));
   $uf = str_replace("'", "", trim($_POST['uf']));
   $ibge = str_replace("'", "", trim($_POST['ibge']));
   $action = $_POST['_action'];
   
   // validar campos
   if (empty($municipio)) {
	   http_response_code(400);
	   echo "Informe o nome do município.";
	   return;  
   }
   
   if (empty($ibge)) {
	   http_response_code(400);
	   echo "Informe o código IBGE.";
	   return;
   }
   
   if (empty($action)) {
	   http_response_code(400);
	   echo "Falha nos parâmetros da solicitação.";
         return;
   }
   
   // Abrir conexao
   $conexao = new Conexao();
   
   // Testar acao
   $sql = "";
   
   if ($action == "inclusao") {
         $sql = "insert into municipios (municipio, uf, ibge) values ('" . $municipio . "', '" . $uf . "', " . $ibge . ');';
   }
   
   if (empty($sql)) {
         http_response_header(400);
	   echo "Falha nos parâmetros da solicitação.";
   }
   
   $flag = 0;
   $result = @pg_query($sql) or $flag = 1;
   
   if ($flag == 1) {
         http_response_code(400);
         echo "Falha ao incluir registro. Tente novamente mais tarde ou contate o suporte.";
         return;
   }
   
   echo "Registro incluído com sucesso.";
   
?>
