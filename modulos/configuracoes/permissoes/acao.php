<?php

   require_once '../../../util/conexao.php';
   require_once '../../../util/permissao.php';   
   require_once '../../../util/util.php';
   require_once '../../../util/sessao.php';
   
   // validar sessao
   validarSessao();
   
   // testar permissao
   $nperm = "";
   switch($_POST['_action']) {
         case "inclusao": $nperm = "INCLUIR CADASTRO DE PERMISSOES";break;
         case "alteracao": $nperm = "ALTERAR CADASTRO DE PERMISSOES";break;
         case "exclusao": $nperm = "EXCLUIR CADASTRO DE PERMISSOES";break;
   }
   
   $perm = testarPermissao($nperm);
   
   if ($perm != 'S') {
         http_response_code(401);
         echo "Sem permissão: " . $nperm . ". Solicite ao administrador a liberação.";
         return;
   }
   
   // acao         
   $id = $_POST['id'];
   $descricao = tratarTexto($_POST['descricao']);
   $nivel = $_POST['nivel'];
   $observacao = tratarTexto($_POST['observacao']);
   $_action = $_POST['_action'];
   
   if ($_action != "exclusao") {
         // validar campos
         if (empty($descricao)) {
	         http_response_code(400);
        	   echo "Informe a descrição da permissão.";
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
         $sql = "insert into permissoes (descricao, nivel, observacao) values ('" . $descricao . "', " . $nivel . ", '" . $observacao. "');";
         $msg1 = "incluir";
         $msg2 = "inclusão";
   }
   
   if ($_action == "alteracao") {
         $sql = "update permissoes set descricao='" . $descricao . "',nivel=" . $nivel . ",observacao='" . $observacao . "' where id=" . $id;
         $msg1 = "alterar";
         $msg2 = "alterado";
   }
   
   if ($_action == "exclusao") {
         $sql = "delete from permissoes where id=" . $id;       
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
         echo "Falha ao " . $msg1 . " registro. Tente novamente mais tarde ou contate o suporte." . $sql;
         return;
   }

   echo "Registro " . $msg2 . " com sucesso.";
   
?>
