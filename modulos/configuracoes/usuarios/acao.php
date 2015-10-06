<?php
   require_once '../../../util/conexao.php';
   require_once '../../../util/util.php';
   require_once '../../../util/sessao.php';

   // validar sessao
   validarSessao();
   
   $id = $_POST['id'];
   $login = tratarTexto($_POST['login']);
   $senha = $_POST['senha'];
   $confirmacao_senha = $_POST['confirmacao_senha'];
   $nome = tratarTexto($_POST['nome']);
   $modelo = $_POST['modelo'];
   $empresa = $_POST['empresa'];
   $nivel = $_POST['nivel'];
   $externo = $_POST['externo'];
   $mobile = $_POST['mobile'];
   $telefone = tratarNumero($_POST['telefone']);
   $ramal = $_POST['ramal'];
   $bloqueado = $_POST['bloqueado'];
   $foto = $_POST['foto'];
   $observacoes = tratarTexto($_POST['observacoes']);
   $_action = $_POST['_action'];
   
    if ($_action != "exclusao") {
          // validar campos
          if (empty($nome)) {
	          http_response_code(400);
	          echo "Informe o nome do usuário.";
	          return;
          }
   
          if (empty($login)) {
	          http_response_code(400);
	          echo "Informe o login.";
	          return;  
          }
   
         if (empty($senha)) {
	         http_response_code(400);
	         echo "Informe a senha.";
	         return;
         }
   
         if ($senha != $senha_confirmacao) {
	         http_response_code(400);
	         echo "Senhas não conferem.";
	         return;
         }
     
         if (empty($empresa)) {
	         http_response_code(400);
	         echo "Informe a empresa.";
	         return;
         }    
   
         if (empty($telefone)) {
	         http_response_code(400);
	         echo "Informe o telefone.";
	         return;
         }    
   
         if (empty($ramal)) {
	         http_response_code(400);
	         echo "Informe o ramal.";
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
         $sql = "insert into usuarios (login, senha, nome, modelo, empresa, nivel, externo, mobile, telefone, ramal, bloqueado, foto, observacoes) values ('" . $login . "', '" . $senha . "', '" . $nome . "', " . $modelo . ", " . $empresa . ", " . $nivel . ", '" . $externo . "', '" . $mobile . "', '" . $telefone . "', '" . $ramal . "', '" . $bloqueado . "', '" . $foto . "', '" . $observacoes . "');";
         $msg1 = "incluir";
         $msg2 = "inclusão";
   }
   
   if ($_action == "alteracao") {
         $sql = "update usuarios set login='" . $login . "',senha='" . $senha . "',nome='" . $nome . "',modelo=" . $modelo . ",empresa=" . $empresa . ",nivel=" . $nivel . ",externo='" . $externo . "',mobile='" . $mobile . "',telefone='" . $telefone . "',ramal='" . $ramal . "',bloqueado='" . $bloqueado . "',foto='" . $foto . "',observacoes='" . $observacoes ."' where id=" . $id;
         $msg1 = "alterar";
         $msg2 = "alterado";
   }
   
   if ($_action == "exclusao") {
         $sql = "delete from usuarios where id=" . $id;
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
