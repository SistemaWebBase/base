<?php

   require_once BASE_DIR . '/util/conexao.php';
   require_once BASE_DIR . '/util/permissao.php';
   require_once BASE_DIR . '/util/util.php';
   require_once BASE_DIR . '/util/sessao.php';

   // validar sessao
   validarSessao();
   
   // testar permissao
   $nperm = "";
   switch($_POST['_action']) {
         case "inclusao": $nperm = "INCLUIR CADASTRO DE MODULOS";break;
         case "alteracao": $nperm = "ALTERAR CADASTRO DE MODULOS";break;
         case "exclusao": $nperm = "EXCLUIR CADASTRO DE MODULOS";break;
   }
   
   $perm = testarPermissao($nperm);
   
   if ($perm != 'S') {
         http_response_code(401);
         echo "Sem permissão: " . $nperm . ". Solicite ao administrador a liberação.";
         return;
   }
   
   // acao        
   $id = tratarChave($_POST['id']);
   $nome = tratarTextoSimples($_POST['nome']);
   $pasta = tratarTextoSimples($_POST['pasta']);
   $indice = (int)$_POST['indice'];
   $nivel = (int)$_POST['nivel'];
   $_action = $_POST['_action'];
   
   if ($_action != "exclusao") {

         // validar campos
         if (empty($nome)) {
	         http_response_code(400);
	         echo "Informe o nome do módulo.";
	         return;  
         }
   
         if (empty($pasta)) {
	         http_response_code(400);
	         echo "Informe a pasta do módulo.";
       	   return;  
         }
   
         if (empty($indice)) {
	         http_response_code(400);
	         echo "Informe o índice do módulo.";
	         return;  
         }
      
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
         $sql = "insert into modulos (nome, pasta, indice,nivel) values ('" . $nome . "', '" . $pasta . "', " . $indice . ", " . $nivel . ');';
         $msg1 = "incluir";
         $msg2 = "inclusão";
   }
   
   if ($_action == "alteracao") {
         $sql = "update modulos set nome='" . $nome . "',pasta='" . $pasta . "',indice=" . $indice . ",nivel=" . $nivel . " where id=" . $id;
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
