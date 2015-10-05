<?php

   require_once '../../../util/conexao.php';
   require_once '../../../util/util.php';
   require_once '../../../util/sessao.php';

   // validar sessao
   validarSessao();
        
   $id = $_POST['id'];
   $nome = tratarTexto($_POST['nome']);
   $pasta = tratarTexto($_POST['pasta']);
   $indice = tratarTexto($_POST['indice']);
   $nivel = tratarTexto($_POST['nivel']);
   $_action = $_POST['_action'];
   
   // validar campos
   if (empty($nome)) {
	   http_response_code(400);
	   echo "Informe o nome do módulo.";
	   return;  
   }
   
   if (empty($pasta)) {
	   http_response_code(400);
	   echo "Informe o nome do pasta.";
	   return;  
   }
   
   if (empty($indice)) {
	   http_response_code(400);
	   echo "Informe o nome do índice.";
	   return;  
   }
   
   if (empty($nivel)) {
	   http_response_code(400);
	   echo "Informe o nome do nível.";
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
         $sql = "insert into modulos (nome, pasta, indice,nivel) values ('" . $nome . "', '" . $pasta . "', '" . $indice . "', " . $nivel . ');';
         $msg1 = "incluir";
         $msg2 = "inclusão";
   }
   
   if ($_action == "alteracao") {
         $sql = "update modulos set nome='" . $nome . "',pasta='" . $pasta . "',indice='" . $indice . "',nivel=" . $nivel . " where id=" . $id;
         $msg1 = "alterar";
         $msg2 = "alterado";
   }
   
   if ($_action == "exclusao") {
         $sql = "delete from modulos where id=" . $id;
         $msg1 = "excluir";
         $msg2 = "excluído";
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
         echo "Falha ao " . $msg1 . " registro. Tente novamente mais tarde ou contate o suporte.";
         return;
   }

   echo "Registro " . $msg2 . " com sucesso.";
   
?>
