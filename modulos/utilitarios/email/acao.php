<?php
   require_once '../../../util/conexao.php';
   require_once '../../../util/permissao.php';
   require_once '../../../util/util.php';
   require_once '../../../util/sessao.php';
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
   $mail->setUsuario("raphael_amorim@outlook.com", "g49lWj+8xpoUQKQYOqIhlPyxGGcBj9IyicHdIxjncxaWPfFAKO9F/a05ppBNPbn9TMOkwg1dK9LC1yIBS9UKiZWImck/PlCLv8Twr7DlgBWPWW5ADzSp9BbU6Qn6Eg1Z47mVEo3G1BetIMgdrRIxvhZa7msgshuZY83rj4KaSWKW0i+JYlyWzSADqBpLlH4MeApI2dizedY1/NjPLbqOkl7Lh9nd5Uvp2clHWM5FTgn+T2aann1RsNKvcnhfOa8n4h4ZYppdTzuEPy7X9yuUgIW5soP8Yu5ThMZaZVDwSR/EiZx3ovMAFmSUQF1HS3wlabDiMK5Wwijela1LJsEhhQ==");
   
   //Destinatarios
   $destinatarios = explode(",", $destinatario);
   forech ( $destinatarios as $dest ) {
      echo $dest; 
      $mail->addDestinatario($dest);
   }
   echo "teste";
   //Assunto
   $mail->setAssunto($assunto);
   
   //Corpo
   $mail->setcorpo($corpo);
   
   //Enviar
   $mail->enviar();

   echo "E-Mail enviado com sucesso.";
   
?>
