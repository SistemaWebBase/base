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
		<link rel="stylesheet" type="text/css" href="/assets/css/cadmunicipios.css" />
		<script type="text/javascript" src="/assets/js/jquery.js"></script>
		<script type="text/javascript" src="/assets/bootstrap/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="/assets/js/principal.js"></script>
		<script type="text/javascript" src="/assets/js/cadmunicipios.js"></script>
		<title>SistemaWeb | Thiago Pereira</title> 
	</head>
	<body>
		<!-- MENU -->
		<nav class="navbar navbar-default" role="navigation">
			<div class="container">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
					<button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#bs-navbar">
						<span class="sr-only">Toogle Navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="/">Thiago Sistemas</a>
				</div>
				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse" id="bs-navbar">
					<!-- MENU -->
					<ul class="nav navbar-nav">
						<!-- MENU 'Início' -->
						<li><a href="/">Início</a></li>
						<!-- MENU 'Clientes' -->
						<li class="dropdown">
							<a class="dropdown-toggle" href="#" data-toggle="dropdown">Clientes<b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li><a href="#">Cadastro de Clientes/Fornecedores</a></li>
								<li><a href="#">Títulos à Receber</a></li>
							</ul>
						</li>
						<!-- MENU 'Fornecedores' -->
						<li class="dropdown">
							<a class="dropdown-toggle" href="#" data-toggle="dropdown">Fornecedores<b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li><a href="#">Títulos à Pagar</a></li>
								<li><a href="#">Cadastro de Financiamentos</a></li>
							</ul>
						</li>
						<!-- MENU 'Estoque' -->
						<li class="dropdown">
							<a class="dropdown-toggle" href="#" data-toggle="dropdown">Estoque<b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li><a href="#">Cadastro de Estoque</a></li>
							</ul>
						</li>
						<!-- MENU 'Vendas' -->
						<li class="dropdown">
							<a class="dropdown-toggle" href="#" data-toggle="dropdown">Vendas<b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li><a href="#">Orçamentos</a></li>
								<li><a href="#">Pedidos</a></li>
								<li role="separator" class="divider"></li>
								<li class="dropdown-header">Notas Fiscais</li>
								<li><a href="#">Nota Fiscal de Eletrônica</a></li>
								<li><a href="#">Nota Fiscal de Serviço Eletrônica</a></li>
								<li><a href="#">Nota Fiscal de Consumidor Eletrônica</a></li>
							</ul>
						</li>
						<!-- MENU 'Configurações' -->
						<li class="dropdown active">
							<a class="dropdown-toggle" href="#" data-toggle="dropdown">Configurações<b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li class="dropdown-header">Cadastros</li>
								<li><a href="#">Usuários</a></li>
								<li><a href="#">Gerentes</a></li>
								<li><a href="#">Vendedores</a></li>
								<li role="separator" class="divider"></li>
								<li class="dropdown-header">Tabelas do Sistema</li>
								<li class="active"><a href="mod/conf/muni/conmunicipios.php">Municípios</a></li>
								<li><a href="#">NCM (Nomenclatura Comum do MERCOSUL)</a></li>
								<li><a href="#">Tributação</a></li>
							</ul>
						</li>
					</ul>
					<!-- PESQUISA -->
					<form class="navbar-form navbar-right" role="search">
						<div class="form-group">
							<input class="form-control" type="text" placeholder="Pesquisar">
						</div>
						<button class="btn btn-default" type="submit">Pesquisar</button>
					</form>
				</div>
			</div>
		</nav>
		<!-- CONTEUDO -->
		<div class="wrapper" role="main">
			<div class="container">
				<div class="row">
					<!-- SIDEBAR -->
					<div id="sidebar" class="col-md-3">
						
					</div>
					<!-- AREA DE CONTEUDO -->
					<div id="conteudo" class="col-xs-12 col-md-9">
						<!-- FORMULARIO -->
						<div class="panel panel-primary">
							<div class="panel-heading">
								Cadastro de Município
							</div>
							<div class="panel-body">
								<form role="form">
									<div class="form-group col-md-6">
										<label for="municipio">Nome do Município:</label>
										<input type="text" class="form-control" id="municipio" name="municipio" maxlength="60">
									</div>
									<div class="form-group col-md-3">
										<label for="uf">UF:</label>
										<select class="form-control" id="uf" name="uf">
										<?php
											$ufs = array('AC', 'AL', 'AM', 'AP', 'BA', 'CE', 'DF', 'ES', 'GO', 'MA', 'MS', 'MT', 'PA', 'PB', 'PE', 'PI', 'PR', 'RJ', 'RN', 'RO', 'RS', 'SC', 'SE', 'SP', 'TO');
									
											foreach($ufs as $u) {
												echo '<option value="' . $u . '">' . $u . '</option>';
											}
										?>
										</select>
									</div>
									<div class="form-group col-md-3">
										<label for="ibge">IBGE:</label>
										<input type="number" inputmode="numeric" pattern="[0-9]*" class="form-control" id="ibge" name="ibge" value="0" min="0" max="999999">
									</div>
									<input type="hidden" name="_action" value="inclusao">
								</form>
							</div>
						</div>
						<!-- PAINEL DE AVISO -->
						<div class="aviso">
						</div>
						<!-- PAINEL DE BOTOES -->
						<div class="btn-control-bar">
							<div class="panel-heading">
								<button class="btn btn-success mob-btn-block" onclick="submit();">
									<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
									 Salvar
								</button>
								<button class="btn btn-warning mob-btn-block">
									<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
									 Cancelar
								</button>
								<button class="btn btn-danger mob-btn-block <?php if (empty($tipo) || $tipo == "inclusao") { echo "disabled"; } 	?>">
									<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
									 Excluir
								</button>
							</div>
						</div>
					</div>
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
