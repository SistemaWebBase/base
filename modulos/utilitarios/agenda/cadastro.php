<?php
        // validar sessao
        require_once '../../../util/sessao.php';

        validarSessao();

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
		<link rel="stylesheet" type="text/css" href="assets/css/cadastro.css" />
		<script type="text/javascript" src="/assets/js/jquery.js"></script>
		<script type="text/javascript" src="/assets/js/jquery.mask.min.js"></script>
		<script type="text/javascript" src="/assets/bootstrap/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="/assets/js/principal.js"></script>
		<script type="text/javascript" src="assets/js/cadastro.js"></script>
		<title>SistemaWeb | Thiago Pereira</title> 
	</head>
	<body>
		<?php
			require_once '../../../util/conexao.php';
			
			$_action = "inclusao"; // por padrao, entrar no modo de inclusao
			
			// Se passar id, abrir registro
			$id = $_GET['id'];
			if (!empty($id)) {
				// Abrir nova conexão
				$conexao = new Conexao();

				$sql = "select * from agenda where id=" . $id;
				$result = $conexao->query($sql);
			
				// Abrir resultado
				$rows = pg_fetch_all($result);
			
				if ($rows == null) {
					return;
				}
			
				$id = $rows[0]['id'];
				$razaosocial = $rows[0]['razaosocial'];
				$endereco = $rows[0]['endereco'];
				$bairro = $rows[0]['bairro'];
				$cep = $rows[0]['cep'];
				$municipio = $rows[0]['municipio'];
				$cidade = $rows[0]['cidade'];
				$telefone = $rows[0]['telefone'];
				$celular = $rows[0]['celular'];
				$email = $rows[0]['email'];
				$observacoes = $rows[0]['observacoes'];
				$_action = "alteracao";
			}
			
		?>
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
						<!-- FORMULARIO -->
						<div class="panel panel-primary">
							<div class="panel-heading">
								Agenda Telefónica
							</div>
							<div class="panel-body">
								<form role="form">
									<div class="form-group col-md-6">
										<label for="razaosocial">Nome: <span class="label label-danger">Obrigatório</span></label>
										<input type="text" class="form-control" id="razaosocial" name="razaosocial" autocomplete="off" maxlength="60" value="<?= $razaosocial ?>" autofocus>
									</div>
									<div class="form-group col-md-6">
										<label for="endereco">Endereço: </label>
										<input type="text" class="form-control" id="endereco" name="endereco" autocomplete="off" maxlength="60" value="<?= $endereco ?>">
									</div>
									<div class="form-group col-md-4">
										<label for="bairro">Bairro: </label>
										<input type="text" class="form-control" id="bairro" name="bairro" autocomplete="off" maxlength="60" value="<?= $bairro ?>" >
									</div>
									<div class="form-group col-md-4">
										<label for="cep">CEP: </label>
<<<<<<< HEAD
										<input type="text" class="form-control" id="cep" name="cep" autocomplete="off" maxlength="60" value="<?= $cep ?>" >
=======
										<input type="text" inputmode="numeric" pattern="[0-9]{5}-[0-9]{3}" class="form-control cep" id="cep" name="cep" autocomplete="off" min="0" max="999999" value="<?= $cep ?>" >
>>>>>>> master
									</div>
									<div class="form-group col-md-4">
										<label for="municipio">Município: </label>
										<input type="text" class="form-control" id="municipio" name="municipio" autocomplete="off" maxlength="60" value="<?= $municipio ?>" >
									</div>
									<div class="form-group col-md-4">
										<label for="telefone">Telefone: <span class="label label-danger">Obrigatório</span></label>
										<input type="text" inputmode="numeric" pattern="\([0-9]{2}\)[\s][0-9]{4}-[0-9]{4,5}" class="form-control telefone" id="telefone" name="telefone" autocomplete="off" min="0" max="999999" value="<?= $telefone ?>">
									</div>
									<div class="form-group col-md-4">
										<label for="celular">Celular: </label>
										<input type="text" inputmode="numeric" pattern="\([0-9]{2}\)[\s][0-9]{4}-[0-9]{4,5}" class="form-control telefone" id="celular" name="celular" autocomplete="off" min="0" max="999999" value="<?= $celular ?>">
									</div>
								    <div class="form-group col-md-6">
										<label for="email">E-mail: </label>
										<input type="email" class="form-control" id="email" name="email" autocomplete="off" maxlength="60" value="<?= $email ?>" >
									</div>
									<div class="form-group col-md-6">
										<label for="observacoes">Observações: </label>
										<input type="text" class="form-control" id="observacoes" name="observacoes" autocomplete="off" maxlength="60" value="<?= $observacoes ?>" >
									</div>
									<input type="hidden" name="id" value="<?= $id ?>">
									<input type="hidden" name="_action" value="<?= $_action ?>">
								</form>
							</div>
						</div>
						<!-- PAINEL DE AVISO -->
						<div class="aviso">
						</div>
						<!-- PAINEL DE BOTOES -->
						<div class="btn-control-bar">
							<div class="panel-heading">
								<button class="btn btn-success mob-btn-block" onclick="submit('#razaosocial');">
									<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
									 Salvar
								</button>
								<a href="<?= $_SERVER['HTTP_REFERER'] ?>">
									<button class="btn btn-warning mob-btn-block">
										<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
										 Cancelar
									</button>
								</a>
								<button class="btn btn-danger mob-btn-block" style="<?php if ($_action == "inclusao") { echo "display: none"; } ?>" data-toggle="modal" data-target="#modal" onclick="dialogYesNo('esubmit()', null, 'Excluir Contato', 'Deseja excluir este contato ?', 'trash');">
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
