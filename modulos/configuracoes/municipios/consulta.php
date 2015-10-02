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
		<link rel="stylesheet" type="text/css" href="assets/css/consulta.css" />
		<script type="text/javascript" src="/assets/js/jquery.js"></script>
		<script type="text/javascript" src="/assets/bootstrap/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="/assets/js/principal.js"></script>
		<script type="text/javascript" src="assets/js/consulta.js"></script>
		<title>SistemaWeb | Thiago Pereira</title> 
	</head>
	<body>
		<!-- MENU -->
		<?php
		    require_once '../../../util/arquivo.php';
			
			import("../../sistema/menu/menu.php");
		?>
		<!-- CONTEUDO -->
		<div class="wrapper" role="main">
			<div class="container">
				<div class="row">
					<!-- SIDEBAR -->
					<div id="sidebar" class="col-md-3">
						
					</div>
					<!-- AREA DE CONTEUDO -->
					<div id="conteudo" class="col-xs-12 col-md-9">
						<!-- PAINEL -->
						<div class="panel panel-primary">
							<div class="panel-heading">
								Consulta de Municípios
							</div>
							<div class="panel-body">
								<!--<div class="table-responsive">-->
									<form action="consulta.php" method="POST">
										<div class="form">
											<div class="row">
												<div class="col-sm-5 col-md-4">
													<input class="form-control" type="text" placeholder="Pesquisar" name="pesquisa">
												</div>
												<div class="col-sm-2 col-md-1">
													<button id="btn-pesquisar" class="form-control btn btn-info"><span class="glyphicon glyphicon-search"></span></button>
												</div>
											</div>
										</div>
									</form>
									<table class="table table-hover table-striped tabela-registro">
										<thead>
											<tr>
												<th>Nome do Município</th>
												<th>UF</th>
												<th>IBGE</th>
											</tr>
										</thead>
										<tbody>
											<form method="POST">
											<?php
												require_once '../../../util/conexao.php';
												require_once '../../../util/util.php';
												
												// Abrir conexao
												$conexao = new Conexao();
												
												// Ler POST
												$pesquisa = tratarTexto($_POST['pesquisa']);
												
												// Ler GET
												$offset = $_GET['offset'];
												if (empty($offset)) {
													$offset = "0";
												}
												
												$sql = "";
												
												if (empty($pesquisa)) {
													$sql = "select * from municipios order by municipio limit 10 offset " . $offset;
												} else {
													$sql = "select * from municipios where municipio like '" . $pesquisa . "%' order by municipio limit 10 offset " . $offset;
												}
												
												$result = $conexao->query($sql);
												
												// Listar resultados
												$rows = pg_fetch_all($result);
												if ($rows != null) {
													foreach ($rows as $row) {
														echo "<tr onclick=\"abrirCadastro('" . $row[id] . "');\">";
														echo "<td>" . $row['municipio'] . "</td>";
														echo "<td>" . $row['uf'] . "</td>";
														echo "<td>" . $row['ibge'] . "</td>";
														echo "</tr>";
													}
												}												
											?>
											</form>
										</tbody>
									</table>
								<!--</div>-->
							</div>
						</div>
						<!-- PAINEL DE AVISO -->
						<div class="aviso">
						</div>
						<!-- PAINEL DE BOTOES -->
						<div class="btn-control-bar">
							<div class="panel-heading">
								<a href="cadastro.php">
									<button class="btn btn-success mob-btn-block">
										<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
										 Novo
									</button>
								</a>
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
