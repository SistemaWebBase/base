<?php
        // validar sessao
        require_once '../../../util/sessao.php';

        validarSessao();
		
		// Testar permissao
		require_once '../../../util/permissao.php';
		$perm_incluir = testarPermissao('INCLUIR CADASTRO DE PRODUTOS');
		$perm_alterar = testarPermissao('ALTERAR CADASTRO DE PRODUTOS');
		$perm_excluir = testarPermissao('EXCLUIR CADASTRO DE PRODUTOS');

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
	<body>
		<?php
			require_once '../../../util/conexao.php';
			
			$_action = "inclusao"; // por padrao, entrar no modo de inclusao
			
			// Se passar id, abrir registro
			$id = $_GET['id'];
			if (!empty($id)) {
				// Abrir nova conexão
				$conexao = new Conexao();

				$sql = "select * from produtos where id=" . $id;
				$result = $conexao->query($sql);
			
				// Abrir resultado
				$rows = pg_fetch_all($result);
			
				if ($rows == null) {
					return;
				}
			
				$id = $rows[0]['id'];
				$nome = $rows[0]['nome'];
				$codigo_referencia = $rows[0]['codigo_referencia'];
				$codigo_fabrica = $rows[0]['codigo_fabrica'];
				$codigo_serie = $rows[0]['codigo_serie'];
				$codigo_barras = $rows[0]['codigo_barras'];
				$linha = $rows[0]['linha'];
				$grupo = $rows[0]['grupo'];
				$subgrupo = $rows[0]['subgrupo'];
				$ncm = $rows[0]['ncm'];
				$unidade_medida = $rows[0]['unidade_medida'];
				$marca = $rows[0]['marca'];
				$situacao = $rows[0]['situacao'];
				$qtd_embalagem = $rows[0]['qtd_embalagem'];
				$preco_custo = $rows[0]['preco_custo'];
				$preco_venda = $rows[0]['preco_venda'];
				$observacoes = $rows[0]['observacoes'];
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
								Cadastro de Produtos
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
									<div class="row">
										<!-- NOME -->
									    <div class="form-group col-md-6">
										    <label for="nome">Nome do Produto: <span class="label label-danger">Obrigatório</span></label>
										    <input type="text" class="form-control" id="nome" name="nome" autocomplete="off" maxlength="60" value="<?= $nome ?>" autofocus <?php permissao(); ?> required>
									    </div>
										<!-- CODIGO REFERENCIA -->
									    <div class="form-group col-md-6">
										    <label for="codigo_referencia">Código de Referencia: </label>
										    <input type="text" class="form-control" id="codigo_referencia" name="codigo_referencia" autocomplete="off" maxlength="60" value="<?= $codigo_referencia ?>" <?php permissao(); ?> >
									    </div>
										<!-- CODIGO FABRICA -->
									    <div class="form-group col-md-6">
										    <label for="codigo_fabrica">Código da Fábrica: </label>
										    <input type="text" class="form-control" id="codigo_fabrica" name="codigo_fabrica" autocomplete="off" maxlength="60" value="<?= $codigo_fabrica ?>" <?php permissao(); ?> >
									    </div>
										<!-- CODIGO SERIE -->
									    <div class="form-group col-md-6">
										    <label for="codigo_serie">Código de Série: </label>
										    <input type="text" class="form-control" id="codigo_serie" name="codigo_serie" autocomplete="off" maxlength="60" value="<?= $codigo_serie ?>" <?php permissao(); ?> >
									    </div>
										<!-- CODIGO BARRAS -->
									    <div class="form-group col-md-6">
										    <label for="codigo_barras">Código de Barras: </label>
										    <input type="text" class="form-control" id="codigo_barras" name="codigo_barras" autocomplete="off" maxlength="60" value="<?= $codigo_barras ?>" <?php permissao(); ?> >
									    </div>
										<!-- LINHA -->
									    <div class="form-group col-md-6">
										    <label for="linha">Linha: <span class="label label-danger">Obrigatório</span></label>
										    <input type="text" inputmode="numeric" pattern="[0-9]*" class="form-control" id="linha" name="linha" autocomplete="off" value="<?= $linha ?>" <?php permissao(); ?> required>
									    </div>
										<!-- GRUPO -->
									    <div class="form-group col-md-6">
										    <label for="grupo">Grupo: <span class="label label-danger">Obrigatório</span></label>
										    <input type="text" inputmode="numeric" pattern="[0-9]*" class="form-control" id="grupo" name="grupo" autocomplete="off" value="<?= $grupo ?>" <?php permissao(); ?> required>
									    </div>
										<!-- SUBGRUPO -->
									    <div class="form-group col-md-6">
										    <label for="subgrupo">Subgrupo: <span class="label label-danger">Obrigatório</span></label>
										    <input type="text" inputmode="numeric" pattern="[0-9]*" class="form-control" id="subgrupo" name="subgrupo" autocomplete="off" value="<?= $subgrupo ?>" <?php permissao(); ?> required>
									    </div>
										<!-- MARCA -->
									    <div class="form-group col-md-6">
										    <label for="marca">Marca: <span class="label label-danger">Obrigatório</span></label>
										    <input type="text" inputmode="numeric" pattern="[0-9]*" class="form-control" id="marca" name="marca" autocomplete="off" value="<?= $marca ?>" <?php permissao(); ?> required>
									    </div>
										<!-- UNIDADE DE MEDIDA -->
									    <div class="form-group col-md-6">
										    <label for="unidade_medida">Unidade de Medida: <span class="label label-danger">Obrigatório</span></label>
										    <input type="text" inputmode="numeric" pattern="[0-9]*" class="form-control" id="unidade_medida" name="unidade_medida" autocomplete="off" value="<?= $unidade_medida ?>" <?php permissao(); ?> required>
									    </div>
										<!-- NCM -->
									    <div class="form-group col-md-6">
										    <label for="ncm">NCM: </label>
										    <input type="text" inputmode="numeric" pattern="[0-9]*" class="form-control" id="ncm" name="ncm" autocomplete="off" value="<?= $ncm ?>" <?php permissao(); ?>>
									    </div>
										<!-- SITUACAO -->
							    		<div class="form-group col-md-3">
								    		<label for="situacao">Situação: </label>
									    	<select class="form-control" id="situacao" name="situacao" <?php permissao(); ?>>
										    <?php
											    $situacao_a = array('A', 'I');
											
										    	foreach($situacao_a as $s) {
											    	if ($s == $situacao) {
												    	echo '<option value="' . $s . '" selected>' . (($s == "A") ? "ATIVO" : "INATIVO") . '</option>'; 
											    	} else {
												    	echo '<option value="' . $s . '">' . (($s == "I") ? "INATIVO" : "ATIVO") . '</option>';
												    }
											    }
									    	?>
										    </select>
								    	</div>
										<!-- QUANTIDADE POR EMBALAGEM -->
									    <div class="form-group col-md-6">
										    <label for="qtd_embalagem">QTD por Embalagem: </label>
										    <input type="text" inputmode="numeric" pattern="[0-9]*" class="form-control" id="qtd_embalagem" name="qtd_embalagem" autocomplete="off" value="<?= $ncm ?>" <?php permissao(); ?>>
									    </div>
										<!-- PRECO DE CUSTO -->
									    <div class="form-group col-md-6">
										    <label for="preco_custo">Preço de Custo: </label>
										    <input type="text" inputmode="numeric" pattern="[0-9]*" class="form-control" id="preco_custo" name="preco_custo" autocomplete="off" value="<?= $preco_custo ?>" <?php permissao(); ?>>
									    </div>
										<!-- PRECO DE VENDA -->
									    <div class="form-group col-md-6">
										    <label for="preco_venda">Preço de Venda: </label>
										    <input type="text" inputmode="numeric" pattern="[0-9]*" class="form-control" id="preco_venda" name="preco_venda" autocomplete="off" value="<?= $preco_venda ?>" <?php permissao(); ?>>
									    </div>
										<!-- OBSERVACOES -->
							    		<div class="form-group col-md-12">
								    		<label for="observacoes">Observações: </label>
									    	<textarea rows="4" cols="50" type="text" class="form-control" id="observacoes" name="observacoes" autocomplete="off" maxlength="500" <?php permissao(); ?>><?= $observacoes ?></textarea>
								    	</div>
										
									</div>
									<input type="hidden" name="id" value="<?= $id ?>">
									<input type="hidden" name="_action" value="<?= $_action ?>">
								</form>
							</div>
						</div>
						<!-- PAINEL DE AVISO -->
						<div class="aviso">
							<?php
								if ($_action == 'inclusao' && $perm_incluir != 'S') {
									echo "<script>avisoAtencao('Sem permissão: INCLUIR CADASTRO DE PRODUTOS. Solicite ao administrador a liberação.');</script>";
								}
								
								if ($_action == 'alteracao' && $perm_alterar != 'S') {
									echo "<script>avisoAtencao('Sem permissão: ALTERAR CADASTRO DE PRODUTOS. Solicite ao administrador a liberação.');</script>";
								}
							?>
						</div>
						<!-- PAINEL DE BOTOES -->
						<div class="btn-control-bar">
							<div class="panel-heading">
								<button class="btn btn-success mob-btn-block <?php permissao(); ?>" onclick="submit('#nome');" <?php permissao(); ?>>
									<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
									 Salvar
								</button>
								<a href="<?= $_SERVER['HTTP_REFERER'] ?>">
									<button class="btn btn-warning mob-btn-block">
										<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
										 Cancelar
									</button>
								</a>
								<button class="btn btn-danger mob-btn-block" style="<?php if ($_action == "inclusao") { echo "display: none"; } ?>" data-toggle="modal" data-target="#modal" onclick="dialogYesNo('esubmit()', null, 'Excluir Módulo', 'Deseja excluir este módulo ?', 'trash');" <?php if ($perm_excluir != 'S') { echo "disabled"; } ?>>
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
