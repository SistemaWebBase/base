<?php
        // validar sessao
        require_once '../../../util/sessao.php';

        validarSessao();
		
		// Testar permissao
		require_once '../../../util/permissao.php';
		$perm_incluir = testarPermissao('INCLUIR CADASTRO DE ENVIO DE MENSAGENS');
		$perm_alterar = testarPermissao('ALTERAR CADASTRO DE ENVIO DE MENSAGENS');
		$perm_excluir = testarPermissao('EXCLUIR CADASTRO DE ENVIO DE MENSAGENS');
		
		// Testar assinatura da URL
		require_once '../../../util/util.php';
		testarAssinaturaURL();

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
			$nome_mensagem = $_GET['nome_mensagem'];
			$usuario = $_GET['usuario'];
			if (!empty($nome_mensagem) && !empty($usuario)) {
				// Abrir nova conexão
				$conexao = new Conexao();

				$sql = "select * from envio_mensagens where nome_mensagem='" . $nome_mensagem . "' and usuario=" . $usuario;
				$result = $conexao->query($sql);
			
				// Abrir resultado
				$rows = pg_fetch_all($result);
			
				if ($rows == null) {
					return;
				}

				$usuario = $rows[0]['usuario'];
				$nome_mensagem = $rows[0]['nome_mensagem'];	
				$descricao = $rows[0]['descricao'];
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
										echo "readonly";
										return;
									}
									if ($_action == "alteracao" && $perm_alterar != "S") {
										echo "readonly";
										return;
									}
								}
							?>
							<div class="panel-body">
								<form role="form">
									<div class="form-group col-md-6">
										<label for="usuario">Usuário: <span class="label label-danger">Obrigatório</span></label>
										<input type="text" inputmode="numeric" class="form-control" id="usuario"  name="usuario" data-mask="000" autocomplete="off" min="0" max="999999" value="<?= $usuario ?>" <?php permissao(); ?> <?php if ($_action == "alteracao"){ echo "readonly";}  ?> required>
									</div>
									<div class="form-group col-md-6">
										<label for="nome_mensagem">Nome da Mensagem: <span class="label label-danger">Obrigatório</span></label>
									    <input type="text" class="form-control" id="nome_mensagem" name="nome_mensagem" autocomplete="off" value="<?= $nome_mensagem ?>" <?php permissao(); ?> <?php if ($_action == "alteracao"){ echo "readonly";} ?> required>
									</div>
									<div class="form-group col-md-6">
										<label for="descricao">Descrição: <span class="label label-danger">Obrigatório</span></label>
										<input type="text" class="form-control" id="descricao" name="descricao" autocomplete="off" maxlength="60" value="<?= $descricao ?>" <?php permissao(); ?> required>
									</div>
									<div class="form-group col-md-6">
										<label for="valor">Valor: <span class="label label-danger">Obrigatório</span></label>
										<input type="text" class="form-control" id="valor" name="valor" autocomplete="off" maxlength="60" value="<?= $valor ?>" <?php permissao(); ?> required>
									</div>
									<input type="hidden" name="_action" value="<?= $_action ?>">
								</form>
							</div>
						</div>
						<!-- PAINEL DE AVISO -->
						<div class="aviso">
							<?php
								if ($_action == 'inclusao' && $perm_incluir != 'S') {
									echo "<script>avisoAtencao('Sem permissão: INCLUIR CADASTRO DE ENVIO DE MENSAGENS. Solicite ao administrador a liberação.');</script>";
								}
								
								if ($_action == 'alteracao' && $perm_alterar != 'S') {
									echo "<script>avisoAtencao('Sem permissão: ALTERAR CADASTRO DE ENVIO DE MENSAGENS. Solicite ao administrador a liberação.');</script>";
								}
							?>
						</div>
						<!-- PAINEL DE BOTOES -->
						<div class="btn-control-bar">
							<div class="panel-heading">
								<button class="btn btn-success mob-btn-block <?php permissao(); ?>" onclick="submit('#usuario');" <?php permissao(); ?>>
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
