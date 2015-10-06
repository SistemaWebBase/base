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

				$sql = "select * from usuarios where id=" . $id;
				$result = $conexao->query($sql);
			
				// Abrir resultado
				$rows = pg_fetch_all($result);
			
				if ($rows == null) {
					return;
				}
			
				$id = $rows[0]['id'];
				$nome = $rows[0]['nome'];
				$login = $rows[0]['login'];
				$senha = $rows[0]['senha'];
				$senha = $rows[0]['confirmacao_senha'];
				$modelo = $rows[0]['modelo'];
				$empresa = $rows[0]['empresa'];
				$nivel = $rows[0]['nivel'];
				$externo = $rows[0]['externo'];
				$mobile = $rows[0]['mobile'];
				$telefone = $rows[0]['telefone'];
				$ramal = $rows[0]['ramal'];
				$bloqueado = $rows[0]['bloqueado'];
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
								Cadastro de Usuários
							</div>
							<div class="panel-body">
								<form role="form">
									<div class="form-group col-md-6">
										<label for="nome">Nome do Usuário: <span class="label label-danger">Obrigatório</span></label>
										<input type="text" class="form-control" id="nome" name="nome" autocomplete="off" maxlength="60" value="<?= $nome ?>" autofocus>
									</div>
									<div class="form-group col-md-6">
										<label for="login">Login: <span class="label label-danger">Obrigatório</span></label>
										<input type="text" class="form-control" id="login" name="login" autocomplete="off" maxlength="60" value="<?= $login ?>">
									</div>
									<div class="form-group col-md-6">
										<label for="senha">Senha: <span class="label label-danger">Obrigatório</span></label>
										<input type="password" class="form-control" id="senha" name="senha" autocomplete="off" maxlength="20" value="<?= $senha ?>">
									</div>
									<div class="form-group col-md-6">
										<label for="confirmacao_senha">Confirme a Senha: <span class="label label-danger">Obrigatório</span></label>
										<input type="password" class="form-control" id="confirmacao_senha" name="confirmacao_senha" autocomplete="off" maxlength="20" value="<?= $confirmacao_senha ?>">
									</div>
									<div class="form-group col-md-6">
										<label for="modelo">Modelo: </label>
										<input type="number" inputmode="numeric" pattern="[0-9]*" class="form-control" id="modelo" name="modelo" autocomplete="off" min="0" max="999999" value="<?= $modelo ?>">
									</div>
									<div class="form-group col-md-6">
										<label for="empresa">Empresa: <span class="label label-danger">Obrigatório</span></label>
										<input type="text" class="form-control" id="empresa" name="empresa" autocomplete="off" maxlength="60" value="<?= $empresa ?>">
									</div>
									<div class="form-group col-md-6">
										<label for="telefone">Telefone: <span class="label label-danger">Obrigatório</span></label>
										<input type="text" inputmode="numeric" pattern="\([0-9]{2}\)[\s][0-9]{4}-[0-9]{4,5}" class="form-control telefone" id="telefone" name="telefone" autocomplete="off" min="0" max="999999" value="<?= $telefone ?>">
									</div>
									<div class="form-group col-md-6">
										<label for="ramal">Ramal: <span class="label label-danger">Obrigatório</span></label>
										<input type="number" inputmode="numeric" pattern="[0-9]{3}" class="form-control" id="ramal" name="ramal" autocomplete="off" min="0" max="999999" value="<?= $ramal ?>">
									</div>
									<div class="form-group col-md-3">
										<label for="nivel">Nível: </label>
										<select class="form-control" id="nivel" name="nivel" >
										<?php
											$nivels = array('01', '02', '03', '04', '05');
									
											foreach($nivels as $u) {
												if ($u == $nivel) {
													echo '<option value="' . $u . '" selected>' . $u . '</option>';
												} else {
													echo '<option value="' . $u . '">' . $u . '</option>';
												}
											}
										?>
										</select>
									</div>
									<div class="form-group col-md-3">
										<label for="externo">Externo: </label>
										<select class="form-control" id="externo" name="externo" >
										<?php
											$externos = array('NAO', 'SIM');
									
											foreach($externos as $u) {
												if ($u == $nivel) {
													echo '<option value="' . $u . '" selected>' . $u . '</option>';
												} else {
													echo '<option value="' . $u . '">' . $u . '</option>';
												}
											}
										?>
										</select>
									</div>
									<div class="form-group col-md-3">
										<label for="mobile">Mobile: </label>
										<select class="form-control" id="mobile" name="mobile" >
										<?php
											$mobiles = array('NAO', 'SIM');
									
											foreach($mobiles as $u) {
												if ($u == $nivel) {
													echo '<option value="' . $u . '" selected>' . $u . '</option>';
												} else {
													echo '<option value="' . $u . '">' . $u . '</option>';
												}
											}
										?>
										</select>
									</div>
									<div class="form-group col-md-3">
										<label for="bloqueado">Bloqueado: </label>
										<select class="form-control" id="bloqueado" name="bloqueado" >
										<?php
											$bloqueados = array('NAO', 'SIM');
									
											foreach($bloqueados as $u) {
												if ($u == $nivel) {
													echo '<option value="' . $u . '" selected>' . $u . '</option>';
												} else {
													echo '<option value="' . $u . '">' . $u . '</option>';
												}
											}
										?>
										</select>
									</div>
									<div class="form-group col-md-12">
										<label for="observacoes">Observações: </label>
										<input type="text" class="form-control" id="observacoes" name="observacoes" autocomplete="off" maxlength="60" value="<?= $observacoes ?>">
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
								<button class="btn btn-success mob-btn-block" onclick="submit('#nome');">
									<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
									 Salvar
								</button>
								<a href="<?= $_SERVER['HTTP_REFERER'] ?>">
									<button class="btn btn-warning mob-btn-block">
										<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
										 Cancelar
									</button>
								</a>
								<button class="btn btn-danger mob-btn-block" style="<?php if ($_action == "inclusao") { echo "display: none"; } ?>" data-toggle="modal" data-target="#modal" onclick="dialogYesNo('esubmit()', null, 'Excluir Usuário', 'Deseja excluir este usuário ?', 'trash');">
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
