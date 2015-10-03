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
								Agenda Telefónica
							</div>
							<div class="panel-body">
								<!-- PESQUISA -->
								<form action="consulta.php" method="GET">
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
								<!-- TABELA DE REGISTRO -->
								<table class="table table-hover table-striped tabela-registro" id="tabela">
									<thead>
										<tr>
											<th>Nome</th>
											<th>Telefone</th>
											<th>Cidade</th>
										</tr>
									</thead>
									<tbody>
									<?php
										require_once '../../../util/conexao.php';
										require_once '../../../util/util.php';
										
										// Maximo de resultados por pagina
										$limite = 10;
										
										// Limite de paginas
										$limite_paginas = 14;
										$limite_paginas_xs = 6;
										
										// Abrir conexao
										$conexao = new Conexao();
										
										// Ler POST
										$pesquisa = tratarTexto($_GET['pesquisa']);
										
										// Se for passado referencia de alguma pagina, seta-lo como pesquisa
										if (! empty(tratarTexto($_GET['_ref']))) {
											$pesquisa = $_GET['_ref'];
										}
										
										// Ler GET
										$pagina = $_GET['pagina'];
										if (empty($pagina)) {
											$pagina = "1";
										}
										
										$sql = "";
									
										if (empty($pesquisa)) {
											$sql = "select * from agenda order by razaosocial limit " . $limite . " offset " . (($pagina-1)*$limite);
										} else {
											$sql = "select * from agenda where agenda like '" . $pesquisa . "%' order by razaosocial limit " . $limite . " offset " . (($pagina-1)*$limite);
										}
										
										$result = $conexao->query($sql);
											
										// Listar resultados
										$rows = pg_fetch_all($result);
										if ($rows != null) {
											foreach ($rows as $row) {
												echo "<tr onclick=\"abrirCadastro('" . $row[id] . "');\">";
												echo "<td>" . $row['razaosocial'] . "</td>";
												echo "<td>" . $row['telefone'] . "</td>";
												echo "<td>" . $row['cidade'] . "</td>";
												echo "</tr>";
											}
										}	
									
										// Paginaçao
										if (empty($pesquisa)) {
											$sql = "select count(*) as num from agenda";
										} else {
											$sql = "select count(*) as num from agenda where razaosocial like '" . $pesquisa . "%';";
										}
										
										$num = pg_fetch_all($conexao->query($sql))[0]['num'];
										$pag = ceil($num/$limite);
									?>
									</tbody>
								</table>
							</div>
						</div>
						<!-- PAGINACAO PARA SMARTPHONE -->
						<nav class="hidden-sm hidden-md hidden-lg paginacao">
							<ul class="pagination">
							<?php
								// botao para a primeira pagina
								if (empty($pesquisa)) {
									echo '<li><a href="?pagina=1#tabela">&laquo;</a></li>';
								} else {
									echo '<li><a href="?pesquisa=' . $pesquisa . '&pagina=1#tabela">&laquo;</a></li>';
								}
							
								// gerar paginacao
								if ($pagina <= $pag) {
									// gerar links anteriores
									$link = 0;
									for ($i = $pagina-(($limite_paginas_xs/2)-1); $i < $pagina;$i++) {
										if ($i > 0) {
											if (empty($pesquisa)) {
												echo '<li><a href="?pagina=' . $i . '#tabela">' . $i . '</a></li>';
											} else {
												echo '<li><a href="?pesquisa=' . $pesquisa . '&pagina=' . $i . '#tabela">' . $i . '</a></li>';
											}
											$link++;
										}
									
									}
								
									// pagina atual
									echo '<li class="active"><span>' . $pagina . '</span></li>';
									$link++;
							
									// gerar restante
									for ($i = 1; $i <= $limite_paginas_xs-$link && $i < $pag; $i++) {										
										if ($i+$pagina <= $pag) {
											if (empty($pesquisa)) {
												echo '<li><a href="?pagina=' . ($i+$pagina) . '#tabela">' . ($i+$pagina) . '</a></li>';
											} else {
												echo '<li><a href="?pesquisa=' . $pesquisa . '&pagina=' . ($i+$pagina) . '#tabela">' . ($i+$pagina) . '</a></li>';
											}
										}
									}
								}
								
								// botao para a ultima pagina
								if (empty($pesquisa)) {
									echo '<li><a href="?pagina=' . $pag . '#tabela">&raquo;</a></li>';
								} else {
									echo '<li><a href="?pesquisa=' . $pesquisa . '&pagina=' . $pag . '#tabela">&raquo;</a></li>';
								}
							?>
							</ul>
						</nav>
						<!-- PAGINACAO PARA DESKTOP -->
						<nav class="hidden-xs paginacao">
							<ul class="pagination">
							<?php
								// botao para a primeira pagina
								if (empty($pesquisa)) {
									echo '<li><a href="?pagina=1#tabela">&laquo;</a></li>';
								} else {
									echo '<li><a href="?pesquisa=' . $pesquisa . '&pagina=1#tabela">&laquo;</a></li>';
								}
							
								if ($pagina <= $pag) {
									// gerar links anteriores
									$link = 0;
									for ($i = $pagina-(($limite_paginas/2)-1); $i < $pagina;$i++) {
										if ($i > 0) {
											if (empty($pesquisa)) {
												echo '<li><a href="?pagina=' . $i . '#tabela">' . $i . '</a></li>';
											} else {
												echo '<li><a href="?pesquisa=' . $pesquisa . '&pagina=' . $i . '#tabela">' . $i . '</a></li>';
											}
											$link++;
										}
									
									}
								
									// pagina atual
									echo '<li class="active"><span>' . $pagina . '</span></li>';
									$link++;
							
									// gerar restante
									for ($i = 1; $i <= $limite_paginas-$link && $i < $pag; $i++) {										
										if ($i+$pagina <= $pag) {
											if (empty($pesquisa)) {
												echo '<li><a href="?pagina=' . ($i+$pagina) . '#tabela">' . ($i+$pagina) . '</a></li>';
											} else {
												echo '<li><a href="?pesquisa=' . $pesquisa . '&pagina=' . ($i+$pagina) . '#tabela">' . ($i+$pagina) . '</a></li>';
											}
										}
									
									}
								}
								
								// botao para a ultima pagina
								if (empty($pesquisa)) {
									echo '<li><a href="?pagina=' . $pag . '#tabela">&raquo;</a></li>';
								} else {
									echo '<li><a href="?pesquisa=' . $pesquisa . '&pagina=' . $pag . '#tabela">&raquo;</a></li>';
								}
							?>
							</ul>
						</nav>
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