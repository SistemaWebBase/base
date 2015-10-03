<?php
   require_once '../../../util/conexao.php';
   require_once '../../../util/util.php';

   $razaosocial = tratarTexto($_POST['razaosocial']);
   $id = $_POST['id'];
   $endereco = tratarTexto($_POST['endereco']);
   $bairro = tratarTexto($_POST['bairro']);
   $cep = tratarTexto($_POST['cep']);
   $municipio = tratarTexto($_POST['municipio']);
   $telefone = tratarTexto($_POST['telefone']);
   $contato = tratarTexto($_POST['contato']);
   $observacoes = tratarTexto($_POST['observacoes']);
   $_action = $_POST['_action'];
   
   // validar campos
   if (empty($razaosocial)) {
	   http_response_code(400);
	   echo "Informe o nome do contato.";
	   return;  
   }
   
   if (empty($endereco)) {
	   http_response_code(400);
	   echo "Informe o endereço do contato.";
	   return;
   }
   
   if (empty($bairro)) {
	   http_response_code(400);
	   echo "Informe o bairro do contato.";
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
         $sql = "insert into agenda (razaosocial, endereco, bairro, cep, municipio, telefone, contato, observacoes) values ('" . $razaosocial . "', '" . $endereco . "', " . $bairro . "', '" . $cep . "', '" . $municipio . "', '" . $telefone . "', '" . $contato . "', '" . $observacoes .');';
         $msg1 = "incluir";
         $msg2 = "inclusão";
   }
   
   if ($_action == "alteracao") {
         $sql = "update agenda set razaosocial='" . $razaosocial . "',endereco='" . $endereco . "',bairro=" . $bairro . "',cep=" . $cep . "',municipio=" . $municipio . "',telefone=" . $telefone . "',contato=" . $contato . "',observacoes=" . $obsercacoes . " where id=" . $id;
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
