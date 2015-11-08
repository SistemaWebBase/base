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
         case "inclusao": $nperm = "INCLUIR PARAMETROS DO SISTEMA";break;
         case "alteracao": $nperm = "ALTERAR PARAMETROS DO SISTEMA";break;
         case "exclusao": $nperm = "EXCLUIR PARAMETROS DO SISTEMA";break;
   }
   
   $perm = testarPermissao($nperm);
   
   if ($perm != 'S') {
         http_response_code(401);
         echo "Sem permissão: " . $nperm . ". Solicite ao administrador a liberação.";
         return;
   }
   
   // acao        
   $id = tratarChave($_POST['id']);
   $chave = tratarTexto($_POST['chave']);
   $empresa = tratarChave($_POST['empresa']);
   $usuario = tratarChave($_POST['usuario']);
   $valor = tratarTextoSimples($_POST['valor']);
   $observacoes = tratarTexto($_POST['observacoes']);
   $_action = $_POST['_action'];
   
   if ($_action != "exclusao") {

         // validar campos
         if (empty($chave)) {
	         http_response_code(400);
	         echo "Informe a chave do parâmetro.";
	         return;  
         }
   
         if (empty($valor)) {
	         http_response_code(400);
	         echo "Informe o valor do parâmetro.";
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
         $sql = "insert into parametros_sistema (chave, empresa, usuario, valor, observacoes) values ('" . $chave . "', " . $empresa . ", " . $usuario . ", '" . $valor . "', '" . $observacoes . "');";
         $msg1 = "incluir";
         $msg2 = "inclusão";
   }
   
   if ($_action == "alteracao") {
         $sql = "update parametros_sistema set valor='" . $valor . "',observacoes='" . $observacoes . "' where chave='" . $chave . "' and empresa=" . $empresa . " and usuario=" . $usuario;
         $msg1 = "alterar";
         $msg2 = "alterado";
   }
   
   if ($_action == "exclusao") {
         $sql = "delete from parametros_sistema where chave='" . $chave . "' and empresa=" . $empresa . " and usuario=" . $usuario;
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
