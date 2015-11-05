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
         case "inclusao": $nperm = "ENVIAR E-MAIL";break;
   }
   
   $perm = testarPermissao($nperm);
   
   if ($perm != 'S') {
         http_response_code(401);
         echo "Sem permissão: " . $nperm . ". Solicite ao administrador a liberação.";
         return;
   }
   
   // acao   
   $destinatario = tratarTextoSimples($_POST['destinatario']);
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
   $mail->setUsuario("raphael_amorim@outlook.com, ");  
   
   //Destinatarios
   $mail->addDestinatario($destinatario);
   
   //Assunto
   $mail->setAssunto($assunto);
   
   //Corpo
   $mail->setcorpo($corpo);
   
   //Enviar
   $mail->enviar();

   echo "E-Mail enviado com sucesso.";
   
?>
