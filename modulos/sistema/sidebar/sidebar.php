<?php
	echo '
		<div class="collapse navbar-collapse">
			<ul class="nav navbar sidebar">
				<li><a href="#"><b>Página Inicial</b></a></li>
				<li><a href="#">Mensagens<span class="badge" style="float: right">5</span></a></li>
				<li><a href="#">Gráficos</a></li>
				<li><a href="#">Configurações</a></li>
				<li class="sidebar-dropdown" id="dropdown"><a href="#" onclick="abrirSubmenu(\'#dropdown\');">Dropdown<span class="glyphicon glyphicon-chevron-down" style="float: right"></span></a>
					<ul class="nav navbar">
						<li><a href="#">Teste 1</a></li>
						<li><a href="#">Teste 2</a></li>
						<li><a href="#">Teste 3</a></li>
					</ul>
				</li>
				<li class="sidebar-dropdown" id="dropdown2"><a href="#" onclick="abrirSubmenu(\'#dropdown2\');">Dropdown 2<span class="glyphicon glyphicon-chevron-down" style="float: right"></span></a>
					<ul class="nav navbar">
						<li><a href="#">Teste 1</a></li>
						<li><a href="#">Teste 2</a></li>
						<li><a href="#">Teste 3</a></li>
					</ul>
				</li>
				<li><a href="#">Sistema</a></li>
				<li><a href="#">Ajuda</a></li>
			</ul>
		</div>
	';
?>
