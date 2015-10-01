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
					<a class="navbar-brand" href="/">Sistema Web</a>
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
						<li class="dropdown">
							<a class="dropdown-toggle" href="#" data-toggle="dropdown">Configurações<b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li class="dropdown-header">Cadastros</li>
								<li><a href="#">Usuários</a></li>
								<li><a href="#">Gerentes</a></li>
								<li><a href="#">Vendedores</a></li>
								<li role="separator" class="divider"></li>
								<li class="dropdown-header">Tabelas do Sistema</li>
								<li><a href="/modulos/configuracoes/municipios/consulta.php">Municípios</a></li>
								<li><a href="#">NCM (Nomenclatura Comum do MERCOSUL)</a></li>
								<li><a href="#">Tributação</a></li>
							</ul>
						</li>
					</ul>
					<!-- PESQUISA -->
					<form class="navbar-form navbar-right" role="search">
						<div class="form-group">
							<input class="form-control" type="text">
						</div>
						<button class="btn btn-default" type="submit">Pesquisar</button>
					</form>
				</div>
			</div>
		</nav>
		