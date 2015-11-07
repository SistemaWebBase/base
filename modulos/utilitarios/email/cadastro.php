<?php
        // validar sessao
        require_once '../../../util/sessao.php';

        validarSessao();
		
		// Testar permissao
		require_once '../../../util/permissao.php';
		$perm_incluir = testarPermissao('ENVIAR E-MAIL');
		
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
	<body <?= (! empty($_GET['id'])) ? 'onload="consultarMunicipio();"' : "" ?> <?php if (! empty($_GET['link'])) { echo "onload=\"restaurarCadastro('" . $_GET['link'] . "', '#municipio'); consultarMunicipio(); \""; } ?>>
		<?php
			require_once '../../../util/conexao.php';
			
			$_action = "inclusao"; // por padrao, entrar no modo de inclusao
			
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
								Enviar E-Mail
							</div>
							<!-- REGRAS DE PERMISSAO -->
							<?php
								function permissao() {
									global $_action, $perm_incluir, $perm_alterar;
									
									if ($_action == "inclusao" && $perm_incluir != "S") {
										echo "readonly";
										return;
									}
								}
							?>
							<div class="panel-body">
								<form role="form">
									<!-- BARRA DE BOTOES -->
									<div class="btn-control-bar">
										<div class="panel-heading">
											<button class="btn btn-default mob-btn-block" onclick="redirecionar('anexos.php?id=<?= urlencode($_GET['id']) ?>', 0)">
												<span class="glyphicon glyphicon-file" aria-hidden="true"></span>
									 			Anexos
											</button>
										</div>
									</div>
									<div class="row">
										<!-- DESTINATARIO -->
										<div class="col-md-10">
											<div class="form-group">
												<label for="destinatario">Destinatários: <span class="label label-danger">Obrigatório</span></label>
												<input type="text" class="form-control no-uppercase" id="destinatario" name="destinatario" autocomplete="off" maxlength="60" value="<?= $destinatario ?>" autofocus <?php permissao(); ?> required>
												<h6>Se houver mais de um destinatário, os separe por vírgula.</h6>
											</div>				
										</div>
										<!-- CC -->
										<div class="col-md-1">
											<div class="form-group">
												<button class="btn btn-default mob-btn-block" onclick="redirecionar('anexos.php?id=<?= urlencode($_GET['id']) ?>', 0)">
													<span class="glyphicon glyphicon-file" aria-hidden="true"></span>
										 			CC
												</button>
											</div>
										</div>
										<div class="col-md-1">
											<div class="form-group">
												<button class="btn btn-default mob-btn-block" onclick="redirecionar('anexos.php?id=<?= urlencode($_GET['id']) ?>', 0)">
													<span class="glyphicon glyphicon-file" aria-hidden="true"></span>
										 			CCO
												</button>
											</div>
										</div>
									</div>
									<div class="row">
										<!-- ASSUNTO -->
										<div class="form-group col-md-12">
											<label for="assunto">Assunto: <span class="label label-danger">Obrigatório</span></label>
											<input type="text" class="form-control no-uppercase" id="assunto" name="assunto" autocomplete="off" maxlength="60" value="<?= $assunto ?>" <?php permissao(); ?> required>
										</div>
									</div>	
									<div class="row">
										<!-- CORPO -->
										<div class="form-group col-md-12">
											<label for="corpo">Corpo: <span class="label label-danger">Obrigatório</span></label>
											<textarea rows="20" cols="50" type="text" class="form-control" id="corpo" name="corpo" autocomplete="off" maxlength="500" value="<?= $corpo ?>" <?php permissao(); ?> required></textarea>
										</div>
									</div>
									<input type="hidden" id="id" name="id" value="<?= time() ?>">
									<input type="hidden" id="_action" name="_action" value="<?= $_action ?>">
								</form>
							</div>
						</div>
						<!-- PAINEL DE AVISO -->
						<div class="aviso">
							<?php
								if ($_action == 'inclusao' && $perm_incluir != 'S') {
									echo "<script>avisoAtencao('Sem permissão: INCLUIR CONTATO NA AGENDA. Solicite ao administrador a liberação.');</script>";
								}
							?>
						</div>
						<!-- PAINEL DE BOTOES -->
						<div class="btn-control-bar">
							<div class="panel-heading">
								<button class="btn btn-success mob-btn-block <?php permissao(); ?>" onclick="submit('#razaosocial');" <?php permissao(); ?>>
									<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
									 Enviar
								</button>
								<a href="<?= $_SERVER['HTTP_REFERER'] ?>">
									<button class="btn btn-warning mob-btn-block">
										<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
										 Cancelar
									</button>
								</a>
								<button class="btn btn-danger mob-btn-block" style="<?php if ($_action == "inclusao") { echo "display: none"; } ?>" data-toggle="modal" data-target="#modal" onclick="dialogYesNo('esubmit()', null, 'Excluir Contato', 'Deseja excluir este contato ?', 'trash');" <?php if ($perm_excluir != 'S') { echo "disabled"; } ?>>
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
