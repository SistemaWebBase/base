<?php
   require_once '../../../util/conexao.php';
   require_once '../../../util/util.php';
   require_once '../../../util/sessao.php';

   // validar sessao
   validarSessao();
   
   $razaosocial = tratarTexto($_POST['razaosocial']);
   $id = $_POST['id'];
   $endereco = tratarTexto($_POST['endereco']);
   $bairro = tratarTexto($_POST['bairro']);
   $cep = tratarTexto($_POST['cep']);
   $municipio = tratarTexto($_POST['municipio']);
   $telefone = tratarTexto($_POST['telefone']);
   $celular = tratarTexto($_POST['celular']);
   $email = tratarTexto($_POST['email']);
   $observacoes = tratarTexto($_POST['observacoes']);
   $_action = $_POST['_action'];
   
   // validar campos
   if (empty($razaosocial)) {
	   http_response_code(400);
	   echo "Informe o nome do contato.";
	   return;  
   }
   
   if (empty($telefone)) {
	   http_response_code(400);
	   echo "Informe o telefone do contato.";
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
         $sql = "insert into agenda (razaosocial, endereco, bairro, cep, municipio, telefone, celular, email, observacoes) values ('" . $razaosocial . "', '" . $endereco . "', '" . $bairro . "', '" . $cep . "', " . $municipio . ", '" . $telefone . "', '" . $celular . "', '" . $email . "', '" . $observacoes . "');";
         $msg1 = "incluir";
         $msg2 = "inclusão";
                
   }
   
   if ($_action == "alteracao") {
         $sql = "update agenda set razaosocial='" . $razaosocial . "',endereco='" . $endereco . "',bairro='" . $bairro . "',cep='" . $cep . "',municipio=" . $municipio . ",telefone='" . $telefone . "',celular='" . $celular . "',email='" . $email . "',observacoes='" . $observacoes . "' where id=" . $id;
         $msg1 = "alterar";
         $msg2 = "alterado";
         
   }
   
   if ($_action == "exclusao") {
         $sql = "delete from agenda where id=" . $id;
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
