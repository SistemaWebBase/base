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
											<input class="form-control" type="text" maxlength="20" name="usuario" placeholder="USUÁRIO">
										</div>
									</div>
									<div class="form-group">
										<div class="input-group">
											<span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
											<input class="form-control" type="password" maxlength="20" name="usuario" placeholder="SENHA">
										</div>
									</div>
									<div class="form-group">
										<button class="btn btn-success mob-btn-block" style="width: 100%">
											<span class="glyphicon glyphicon-share-alt"></span>
											Entrar
										</button>
									</div>
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
