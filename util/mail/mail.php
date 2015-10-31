<?php

class Mail {
	
	 // Host
	 var $host;
	 
	 public function setHost($host) {
		 $this->host = $host;
	 }
	 
	 // Usuario e Senha
	 var $usuario, $senha;
	 
	 public function setUsuario($usuario, $senha) {
		 $this->usuario = $usuario;
		 $this->senha = $senha;
	 }
	 
	 // Nome do usuario
	 var $nome_usuario;
	 
	 public function setNomeUsuario($nome_usuario) {
		 $this->nome_usuario = $nome_usuario;
	 }
	 
	 // Destinatarios
	 var $destinatarios = array();
	 
	 public function addDestinatario($email) {
		 array_push($this->destinatarios, array($email, NULL));
	 }
	 
	 public function addDestinatarioNome($email, $nome) {
		 array_push($this->destinatarios, array($email, $nome));
	 }
	 
	 // Copia (CC)
	 var $cc = array();
	 
	 public function addCC($email) {
		 array_push($this->cc, array($email, NULL));
	 }
	 
	 public function addCCNome($email, $nome) {
		 array_push($this->cc, array($email, $nome));
	 }
	 
	 // Copia Oculta (BCC)
	 var $bcc = array();
	 
	 public function addBCC($email) {
		 array_push($this->bcc, array($email, NULL));
	 }
	 
	 public function addBCCNome	($email, $nome) {
		 array_push($this->bcc, array($email, $nome));
	 }
	 
	 // Subject (Assunto)
	 var $assunto;
	 
	 public function setAssunto($assunto) {
		 $this->assunto = $assunto;
	 }
	 
	 // Body (Corpo)
	 var $corpo;
	 
	 public function setCorpo($corpo) {
		 $this->corpo = $corpo;
	 }
	 
	 // Alt Body (Corpo Alternativo)
	 var $altcorpo;
	 
	 public function setAltCorpo($altcorpo) {
		 $this->altcorpo = $altcorpo;
	 }
	 
	 // Anexos
	 var $anexos = array();
	 
	 public function addAnexo($file, $nome) {
		 push_array($this->anexos, array($file, $nome));
	 }
	 
	 // Enviar
	 public function enviar() {
		 // Testar parametros
		 if (! isset($this->host) || empty($this->host)) {
			 throw new Exception("Host não informado.");
		 }
		 
		 if (! isset($this->usuario) || empty($this->usuario)) {
			 throw new Exception("Usuário não informado.");
		 }
		 
		 if (! isset($this->senha) || empty($this->senha)) {
			 throw new Exception("Senha não informado.");
		 }
		 
		 if (! isset($this->destinatarios) || count($this->destinatarios) == 0) {
			 throw new Exception("E-mail sem destinatário.");
		 }
		 
		 // Criar e-mail
		 require_once 'phpmailer/PHPMailerAutoload.php';
		 
		 $mail = new PHPMailer();
		 $mail->setLanguage("br");
		 $mail->IsSMTP();
		 $mail->Host = $this->host;
		 $mail->Port = 587;
		 $mail->SMTPSecure = "tls";
		//  $mail->Mailer =	 "smtp";
		 $mail->SMTPAuth = true;
		 $mail->Username = $this->usuario;
		 $mail->Password = $this->senha;
		 $mail->From = $this->usuario;
		 $mail->FromName = $this->nome_usuario;
		 $mail->SMTPDebug = 4;
		 $mail->Debugoutput = "html";
		 
		 foreach($this->destinatarios as $destinatario) {
			 $mail->AddAddress($destinatario[0], $destinatario[1]);
		 }
		 
		 foreach($this->cc as $c) {
			 $mail->AddCC($c[0], $c[1]);
		 }
		 
		 foreach($this->bcc as $bc) {
			 $mail->AddBCC($bc[0], $bc[1]);
		 }
		 
		 $mail->IsHTML(true);
		 $mail->Subject = $this->assunto;
		 $mail->Body = $this->corpo;
		 $mail->AltBody = $this->altcorpo;
		 
		 foreach($this->anexos as $anexo) {
			 $mail->AddAttachment($anexo[0], $anexo[1]);
		 }
		 
		 // Enviar
		 $enviado = $mail->Send();
		 
		 var_dump($mail);
		 
		 // Limpar destinatarios e os anexos
		 $mail->ClearAllRecipients();
		 $mail->ClearAttachments();

		 if (! $enviado) {
			 throw new Exception("Falha ao enviar e-mail. " . $mail->ErrorInfo);
		 }

	 }
	
}

?>
