<?php
   require_once BASE_DIR . '/util/conexao.php';
   require_once BASE_DIR . '/util/permissao.php';
   require_once BASE_DIR . '/util/util.php';
   require_once BASE_DIR . '/util/sessao.php';
   require_once BASE_DIR . "/util/mail/mail.php";

   // validar sessao
   validarSessao();
   
   // testar permissao
   $nperm = "";
   switch($_POST['_action']) {
         case "inclusao": $nperm = "ENVIAR E-MAIL";break;
   }
   
   $perm = testarPermissao($nperm);
   
   if ($perm != 'S') {
         http_response_code(401);
         echo "Sem permissão: " . $nperm . ". Solicite ao administrador a liberação.";
         return;
   }
   
   // acao   
   $id = tratarNumero($_POST['id']);
   $destinatario = tratarTextoMinusculo($_POST['destinatario']);
   $assunto = tratarTextoSimples($_POST['assunto']);
   $corpo = tratarTextoSimples($_POST['corpo']);
     
   // validar campos
   if (empty($destinatario)) {
      http_response_code(400);
	echo "Informe o(s) destinatário(s).";
	return;  
   }
   
   if (empty($assunto)) {
       http_response_code(400);
       echo "Informe o assunto do e-mail.";
       return;
   }
         
   if (empty($corpo)) {
       http_response_code(400);
       echo "Informe o corpo do e-mail.";
       return;
   }

   //Enviar E-Mail
   // Instanciando a Classe  
   $mail = new Mail();
   
   // Abrir nova conexão
   $conexao = new Conexao();
   
   $test=0;
   
   // Pegar dados de forma hierarquica - Parametro EMAIL_PADRAO
   // Primeiro  - verifica se existe email especifico do usuario para a empresa atual
   $sql = "";
   $sql = "select * from parametros_sistema where usuario=" . $_SESSION['id'] . " and empresa=" . $_SESSION['empresa'] . " and chave='EMAIL_PADRAO'";
   $result = $conexao->query($sql);
			
   // Abrir resultado
   $rows = pg_fetch_all($result);
   
   if ($rows != null) {
   	$test=1;
   }
   
   if ($test == 0){
      // Segundo  - verifica se existe email especifico do usuario, utilizado idependentemente da empresa.
      $sql = "";
      $sql = "select * from parametros_sistema where usuario=" . $_SESSION['id'] . " and empresa=99 and chave='EMAIL_PADRAO'";
      $result = $conexao->query($sql);
      
      http_response_code(400);
      echo $id;
			
      //Abrir resultado
      $rows = pg_fetch_all($result);
   
      if ($rows != null) {
   	  $test=1;
      }
   }
   
   if ($test == 0){
      // Terceiro  - verifica se existe email padrão para a empresa atual.
      $sql = "";
      $sql = "select * from parametros_sistema where usuario='PADRAO' and empresa=" . $_SESSION['empresa'] . " and chave='EMAIL_PADRAO'";
      $result = $conexao->query($sql);
			
      //Abrir resultado
      $rows = pg_fetch_all($result);
   
      if ($rows != null) {
   	  $test=1;
      }
   }
   
   if ($test == 0){
      // Quarto  - verifica se existe email padrão idependente de usuario ou empresa.
      $sql = "";
      $sql = "select * from parametros_sistema where usuario='PADRAO' and empresa=99 and chave='EMAIL_PADRAO'";
      $result = $conexao->query($sql);
			
      //Abrir resultado
      $rows = pg_fetch_all($result);
   
      if ($rows != null) {
   	  $test=1;
      }
   }
   
   //Se chegou aqui com valor 0 significa que esse parametro não esta cadastrado.
   if ($test == 0){
      http_response_code(400);
      echo "Parâmetro: EMAIL_PADRAO não cadastrado.";
      return;
   }
   
   $valor = $rows[0]['valor'];
   
   //Separa campos
   $valores = explode(",", $valor);
                           
   //Usuário e senha do emitente
   $mail->setUsuario(trim($valores[0]),trim($valores[1]));
   
   //Destinatarios
   $destinatarios = explode(",", $destinatario);
   $cont = 0;
   
   //Verifica e-mail(s) informado(s) e os valida
   foreach ( $destinatarios as $dest ) {
      $cont++;
      if(!validaEmail(trim($dest))){
          http_response_code(400);
          echo $cont . "° e-mail inválido!!!";
          return;  
      }
   }
   
   //Adiciona destinatario(s)
   foreach ( $destinatarios as $dest ) {
      $mail->addDestinatario(trim($dest));
   }

   //Assunto
   $mail->setAssunto($assunto);
   
   //Corpo
   $mail->setcorpo($corpo);
   
   //Enviar
   $mail->enviar();

   echo "E-Mail enviado com sucesso.";
   
?>
