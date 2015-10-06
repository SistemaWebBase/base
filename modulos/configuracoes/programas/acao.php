<?php

   require_once '../../../util/conexao.php';
   require_once '../../../util/util.php';
   require_once '../../../util/sessao.php';

   // validar sessao
   validarSessao();
   
   $id = $_POST['id'];
   $nome = tratarTexto($_POST['nome']);
   $modulo = $_POST['modulo'];
   $pasta = tratarTexto($_POST['pasta']);
   $agrupamento = tratarTexto($_POST['agrupamento']);
   $indice = $_POST['indice'];
   $nivel = $_POST['nivel'];
   $_action = $_POST['_action'];
   
   if ($_action != "exclusao") {

         // validar campos
         if (empty($nome)) {
	         http_response_code(400);
	         echo "Informe o nome do programa.";
	         return;  
         }
   
         if (empty($modulo)) {
	         http_response_code(400);
       	   echo "Informe o modulo do programa.";
	         return;  
         }
   
         if (empty($pasta)) {
	         http_response_code(400);
	         echo "Informe a pasta do programa.";
	         return;  
         }
   
         if (empty($agrupamento)) {
	         http_response_code(400);
	         echo "Informe o agrupamento do programa.";
	         return;  
         }
   
         if (empty($indice)) {
	         http_response_code(400);
	         echo "Informe o índice do programa.";
	         return;  
         }
   
         if (empty($nivel)) {
	         http_response_code(400);
	         echo "Informe o nivel do programa.";
	         return;  
         }
   
         if (empty($_action)) {
	         http_response_code(400);
	         echo "Falha nos parâmetros da solicitação.";
               return;
         }
   }
   
   // Abrir conexao
   $conexao = new Conexao();
   
   // Testar acao
   $sql = "";
   
   if ($_action == "inclusao") {
         $sql = "insert into programas (nome, modulo, pasta, agrupamento, indice, nivel) values ('" . $nome . "', " . $modulo . ", '" . $pasta . "', '" . $agrupamento . "', " . $indice . ", " . $nivel . ');';
         $msg1 = "incluir";
         $msg2 = "inclusão";
   }
   
   if ($_action == "alteracao") {
         $sql = "update programas set nome='" . $nome . "',modulo=" . $modulo . ",pasta='" . $pasta . "',agrupamento='" . $agrupamento . "',indice=" . $indice . ",nivel=" . $nivel . " where id=" . $id;
         $msg1 = "alterar";
         $msg2 = "alterado";
   }
   
   if ($_action == "exclusao") {
         $sql = "delete from programas where id=" . $id;
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
