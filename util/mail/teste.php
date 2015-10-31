<?php

require_once 'mail.php';

$mail = new Mail();
$mail->setHost("smtp.gmail.com");
$mail->setUsuario("thiago.pereira.ti@gmail.com", "55486126547980");
$mail->addDestinatario("thiago.pereira.ti@gmail.com");
$mail->setAssunto("Teste de e-mail via PHP");
$mail->setCorpo("Olá Mundo !");
$mail->setAltCorpo("Alternativo");
$mail->enviar();

?>
