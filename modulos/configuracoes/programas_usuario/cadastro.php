<?php
        // validar sessao
        require_once '../../../util/sessao.php';

        validarSessao();
		
		// Testar permissao
		require_once '../../../util/permissao.php';
		$perm_incluir = testarPermissao('INCLUIR PROGRAMAS DO USUARIO');
		$perm_alterar = testarPermissao('ALTERAR PROGRAMAS DO USUARIO');
		$perm_excluir = testarPermissao('EXCLUIR PROGRAMAS DO USUARIO');

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
		<script type="text/javascript" src="/assets/bootstrap/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="/assets/js/principal.js"></script>
		<script type="text/javascript" src="assets/js/cadastro.js"></script>
		<title>SistemaWeb | Thiago Pereira</title> 
	</head>
	<body <?php if (!empty($_GET['usuario'])) { echo "onload=\"consultarUsuario(); consultarPermissao();\""; } ?>>
		<?php
			require_once '../../../util/conexao.php';
			
			$_action = "inclusao"; // por padrao, entrar no modo de inclusao
			
			// Se passar id, abrir registro
			$usuario = $_GET['usuario'];
			$permissao = $_GET['permissao'];
			if (!empty($usuario) && !empty($permissao)) {
				// Abrir nova conexão
				$conexao = new Conexao();

				$sql = "select * from programas_usuario where usuario=" . $usuario . " and permissao=" . $permissao;
				$result = $conexao->query($sql);
			
				// Abrir resultado
				$rows = pg_fetch_all($result);
			
				if ($rows == null) {
					return;
				}

				$usuario = $rows[0]['usuario'];
				$programa = $rows[0]['programa'];
				$valor = $rows[0]['valor'];
				$_action = "alteracao";
			}
			
		?>
		<!-- MENU -->
		<?php
		    require_once '../../sistema/menu/menu.php';
			require_once '../../sistema/sidebar/sidebar.php';
		?>
		<!-- CONTEUDO -->
		<div class="wrapper" role="main">
			<div class="container">
				<div class="row">
					<!-- SIDEBAR -->
					<div class="col-md-2">						
					</div>
					<!-- AREA DE CONTEUDO -->
					<div id="conteudo" class="col-xs-12 col-md-10">
						<!-- FORMULARIO -->
						<div class="panel panel-primary">
							<div class="panel-heading">
								Cadastro de Permissões do Usuário
							</div>
							<!-- REGRAS DE PERMISSAO -->
							<?php
								function permissao() {
									global $_action, $perm_incluir, $perm_alterar;
									
									if ($_action == "inclusao" && $perm_incluir != "S") {
										echo "disabled";
										return;
									}
									if ($_action == "alteracao" && $perm_alterar != "S") {
										echo "disabled";
										return;
									}
								}
							?>
							<div class="panel-body">
								<form role="form">
									<div class="form-group col-md-6">
										<label for="usuario">Usuário: <span class="label label-danger">Obrigatório</span></label>
									    <input type="text" class="form-control" id="nome_usuario" autocomplete="off" value="<?= $usuario ?>" autofocus <?php permissao(); ?>>
									</div>
									<div class="form-group col-md-6">
										<label for="programa">Permissão: <span class="label label-danger">Obrigatório</span></label>
									    <input type="text" class="form-control" id="nome_programa" autocomplete="off" value="<?= $programa ?>" <?php permissao(); ?>>
									</div>
									<div class="form-group col-md-6">
										<label for="valor">Valor: <span class="label label-danger">Obrigatório</span></label>
										<input type="text" class="form-control" id="valor" name="valor" autocomplete="off" maxlength="60" value="<?= $valor ?>" <?php permissao(); ?> required>
									</div>
									<input type="hidden" id="usuario" name="usuario" value="<?= $usuario ?>">
									<input type="hidden" id="programa" name="programa" value="<?= $programa ?>">
									<input type="hidden" name="_action" value="<?= $_action ?>">
								</form>
							</div>
						</div>
						<!-- PAINEL DE AVISO -->
						<div class="aviso">
							<?php
								if ($_action == 'inclusao' && $perm_incluir != 'S') {
									echo "<script>avisoAtencao('Sem permissão: INCLUIR PROGRAMAS DO USUARIO. Solicite ao administrador a liberação.');</script>";
								}
								
								if ($_action == 'alteracao' && $perm_alterar != 'S') {
									echo "<script>avisoAtencao('Sem permissão: ALTERAR PROGRAMAS DO USUARIO. Solicite ao administrador a liberação.');</script>";
								}
							?>
						</div>
						<!-- PAINEL DE BOTOES -->
						<div class="btn-control-bar">
							<div class="panel-heading">
								<button class="btn btn-success mob-btn-block <?php programa(); ?>" onclick="submit('#usuario');" <?php programa(); ?>>
									<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
									 Salvar
								</button>
								<a href="<?= $_SERVER['HTTP_REFERER'] ?>">
									<button class="btn btn-warning mob-btn-block">
										<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
										 Cancelar
									</button>
								</a>
								<button class="btn btn-danger mob-btn-block" style="<?php if ($_action == "inclusao") { echo "display: none"; } ?>" data-toggle="modal" data-target="#modal" onclick="dialogYesNo('esubmit()', null, 'Excluir Permissão do Usuário', 'Deseja excluir esta Permissão ?', 'trash');" <?php if ($perm_excluir != 'S') { echo "disabled"; } ?>>
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
				<?php
					require_once '../../sistema/rodape/rodape.php';
				?>
			</div>
		</footer>
	</body>
</html>