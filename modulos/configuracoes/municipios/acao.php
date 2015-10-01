<?php
   require_once '../../../util/conexao.php';
   require_once '../../../util/util.php';

   $municipio = tratarTexto($_POST['municipio']);
   $id = $_POST['id'];
   $uf = tratarTexto($_POST['uf']);
   $ibge = tratarTexto($_POST['ibge']);
   $_action = $_POST['_action'];
   
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
   
   if (empty($_action)) {
	   http_response_code(400);
	   echo "Falha nos parâmetros da solicitação.";
         return;
   }
   
   // Abrir conexao
   $conexao = new Conexao();
   
   // Testar acao
   $sql = "";
   
   if ($_action == "inclusao") {
         $sql = "insert into municipios (municipio, uf, ibge) values ('" . $municipio . "', '" . $uf . "', " . $ibge . ');';
   }
   
   if ($_action == "alteracao") {
         $sql = "update municipios set municipio='" . $municipio . "',uf='" . $uf . "',ibge=" . $ibge . " where id=" . $id;
   }
   
   if ($_action == "exclusao") {
         $sql = "delete from municipios where id=" . $id;
   }
   
   if (empty($sql)) {
         http_response_code(400);
	   echo "Falha nos parâmetros da solicitação. Tente novamente mais tarde ou contate o suporte.";
         return;
   }
   
   $flag = 0;
   $result = @pg_query($sql) or $flag = 1;
   
   if ($flag == 1) {
         http_response_code(400);
         echo "Falha ao incluir registro. Tente novamente mais tarde ou contate o suporte.";
         return;
   }
   
   $msg = "";
   if ($_action == "inclusao") {
         $msg = "incluído";
   }
   if ($_action == "alteracao") {
         $msg = "alterado";
   }
   if ($_action == "exclusao") {
         $msg = "excluído";
   }
   
   echo "Registro " . $msg . " com sucesso.";
   
?>
