<?php
	// destruir sessoes anteriores
	if (isset($_SESSION)) {
		session_destroy();
	}
	
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=Edge"/>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="format-detection" content="telephone=no">
		<link rel="shortcut icon" type="image/png" href="/assets/imagens/favicon.png"/>
		<link rel="apple-touch-icon" type="image/png" href="/assets/imagens/favicon.png"/>
		<link rel="stylesheet" type="text/css" href="/assets/bootstrap/css/bootstrap.min.css"/>
		<link rel="stylesheet" type="text/css" href="/assets/css/principal.css" />
		<link rel="stylesheet" type="text/css" href="/assets/css/login.css" />
		<script type="text/javascript" src="/assets/js/jquery.js"></script>
		<script type="text/javascript" src="/assets/bootstrap/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="/assets/js/principal.js"></script>
		<script type="text/javascript" src="/assets/js/login.js"></script>
		<title>SistemaWeb | Thiago Pereira</title> 
	</head>
	<body>
		<!-- CONTEUDO -->
		<div class="wrapper" role="main">
			<div class="container">
				<!-- LOGO -->
				<div class="row">
					<div class="col-md-4"></div>
					<div class="col-md-4">
						<img class="media-object" src="assets/imagens/logo.png"></img>
					</div>
					<div class="col-md-4"></div>
				</div>
				<div class="row">
					<!-- AREA DE CONTEUDO -->
					<div class="col-md-4"></div>
					<div id="conteudo" class="col-md-4">
						<div class="panel panel-primary" id="painel-login">
							<!-- CABECALHO -->
							<div class="panel-heading">
								<span class="glyphicon glyphicon-lock"></span>
								Login - SistemaWeb
							</div>
							<!-- CORPO -->
							<div class="panel-body">
								<form action="login.php" method="POST" role="form">
									<div class="form-group">
										<div class="input-group">
											<span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
											<input class="form-control" type="text" maxlength="20" name="login" autocomplete="off" placeholder="USUÁRIO" autofocus>
										</div>
									</div>
									<div class="form-group">
										<div class="input-group">
											<span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
											<input class="form-control" type="password" maxlength="20" name="senha" autocomplete="off" placeholder="SENHA">
										</div>
									</div>
									<!-- PAINEL DE AVISO -->
									<div class="aviso">
									</div>
									<!-- BOTAO DE LOGAR -->
									<div class="form-group">
										<button class="btn btn-success mob-btn-block" style="width: 100%">
											<span class="glyphicon glyphicon-share-alt"></span>
											Entrar
										</button>
									</div>
									<input type="hidden" name="_action" value="login">
								</form>
							</div>
						</div>
					</div>
					<div class="col-md-4"></div>
				</div>
			</div>
		</div>
		<!-- RODAPE -->
		<footer>
			<div class="container">
				<div class="row">
					
				</div>
			</div>
		</footer>
	</body>
</html>
<?php
	if ($_POST['_action'] != "login") {
		return;
	}

	/* fazer login */
	require_once 'util/conexao.php';
	require_once 'util/util.php';
	require_once 'util/sessao.php';
	
	$login = tratarTexto($_POST['login']);
	$senha = tratarTexto($_POST['senha']);
	
	function logar($login, $senha) {
		
		if (empty($login)) {
			return "Informe o login";
		}
		
		if (empty($senha)) {
			return "Informe a senha";
		}
		
		// validar login
		$conexao = new Conexao();
		
		$sql = "select * from usuarios where login='" . $login . "' and senha='" . sha1($senha) . "';";
		$result = $conexao->query($sql);

		if (! pg_num_rows($result) > 0) {
			return "Login ou Senha incorretos.";
		}
		
		// IP do cliente e User-Agent
		$ip = $_SERVER['REMOTE_ADDR'];
		$useragent = $_SERVER['HTTP_USER_AGENT'];
		
		// Gravar id do usuario e data/hora
		$id = pg_fetch_all($result)[0]['id'];
		$_SESSION['id'] = $id;
		
		// Gerar checksum
		$checksum = sha1("SISTEMAWEB?user=" . $id . "&timestamp=" . time() . "/PHP");
		$_SESSION['checksum'] = $checksum; 
				
		// Criar sessao
		$sql = "insert into sessoes (usuario, useragent, ip, checksum) values (" . $id . ", '" . $useragent . "', '" . $ip . "', '" . $checksum . "');";
		
		$flag = 0;
		$result = $conexao->query($sql) or $flag = 1;
		
		// Validar sessao
		if ($flag == 1 || validarSessao() == 1) {
			return "Falha ao criar sessão. Tente novamente mais tarde ou contate o suporte.";
		}

		return "OK";		
		
	}
	
	// logar
	$msg = logar($login, $senha);
	
	if ($msg != "OK") {
		echo "<script>avisoErro('" . $msg . "');</script>";
	} else {
		// redirecionar para o index
		echo "<script>redirecionar('/', 0);</script>";
	}
	
?>
