/* dialog's */
function dialogYesNo(evtyes, evtno, title, message, icon) {
	$('#modal').remove();
	$('body').append('\
			<div id="modal" class="modal fade" role="dialog">\
				<div class="modal-dialog">\
					<div class="modal-content">\
						<div class="modal-header">\
							<button type="button" class="close" data-dismiss="modal">&times;</button>\
							<h4 class="modal-title"><span class="glyphicon glyphicon-' + icon + '"></span> ' + title + '</h4>\
						</div>\
						<div class="modal-body">\
							<p>' + message + '</p>\
						</div>\
						<div class="modal-footer">\
							<button type="button" class="btn btn-success" data-dismiss="modal" onclick="' + evtyes + '">Sim</button>\
							<button type="button" class="btn btn-danger" data-dismiss="modal" onclick="' + evtno + '">Não</button>\
						</div>\
					</div>\
				</div>\
			</div>\
	');
}

function dialogSemPermissao(permissao) {
	$('#modal').remove();
	$('body').append('\
			<div id="modal" class="modal fade" role="dialog">\
				<div class="modal-dialog">\
					<div class="modal-content">\
						<div class="modal-header">\
							<button type="button" class="close" data-dismiss="modal">&times;</button>\
							<h4 class="modal-title"><span class="glyphicon glyphicon-alert"></span> Sem Permissão</h4>\
						</div>\
						<div class="modal-body">\
							<h4>' + permissao + '</h4>\
							<h6>Solicite liberação ao administrador.</h6>\
						</div>\
						<div class="modal-footer">\
							<button type="button" class="btn btn-success" data-dismiss="modal">OK</button>\
						</div>\
					</div>\
				</div>\
			</div>\
	');
	$('#modal').modal('toggle');
}

/* painel de mensagens */
function avisoSucesso(msg) {
	$(".aviso").empty();
	$(".aviso").append("<div class=\"alert alert-success\" role=\"alert\"><span class=\"glyphicon glyphicon-ok-sign\" aria-hidden=\"true\"></span> "+msg+"</div>");
	$(".aviso").slideDown();
}

function avisoInfo(msg) {
	$(".aviso").empty();
	$(".aviso").append("<div class=\"alert alert-info\" role=\"alert\"><span class=\"glyphicon glyphicon-info-sign\" aria-hidden=\"true\"></span> "+msg+"</div>");
	$(".aviso").slideDown();
}

function avisoAtencao(msg) {
	$(".aviso").empty();
	$(".aviso").append("<div class=\"alert alert-warning\" role=\"alert\"><span class=\"glyphicon glyphicon-warning-sign\" aria-hidden=\"true\"></span> "+msg+"</div>");
	$(".aviso").slideDown();
}

function avisoErro(msg) {
	$(".aviso").empty();
	$(".aviso").append("<div class=\"alert alert-danger\" role=\"alert\"><span class=\"glyphicon glyphicon-exclamation-sign\" aria-hidden=\"true\"></span> "+msg+"</div>");
	$(".aviso").slideDown();
}

/* erro de post */
function postError(xhr, status, error) {
	var errorCode = xhr.status;
	if (errorCode == 400) {
		avisoErro(xhr.responseText);
	} else if (errorCode == 401) {
		avisoAtencao(xhr.responseText);
	} else {		
		avisoErro("Falha na requisição. Tente novamente mais tarde ou contate o suporte. (" + status + " " + xhr.status + ": " + error + ")");
	}
}

/* esubmit - submit para exclusao */
function esubmit() {
	$("input[name=_action]").val("exclusao");
	submit();
}

/* redirecionar */
function redirecionar(url, sleep) {
	setTimeout(function() {
		window.location.href = url;
	}, sleep)
}

/* abrir consulta */
function abrirConsulta(url, link) {
	// Salvar dados atuais do formulario
	var dados = JSON.stringify($('form').serializeArray());
	var chave = "link-data-" + link;
	sessionStorage.setItem(chave, dados);
	
	chave = "link-call-" + link;
	sessionStorage.setItem(chave, location.href);
	
	// Abrir consulta
	redirecionar(url + "?link=" + link, 0);
}

/* selecionar cadastro */
function selecionarCadastro(id, link) {
	sessionStorage.setItem("link-ret-" + link, id);
	redirecionar((sessionStorage.getItem("link-call-" + link)).split("?")[0] + "?link=" + link, 0);
}

/* restaurar cadastro */
function restaurarCadastro(link, alvo) {
	var chave = "link-data-" + link;
	var dados = JSON.parse(sessionStorage.getItem(chave));
	
	dados.forEach(function (element, index, array) {
		$("#" + element['name']).val(element['value']);
	});
	
	var ret = sessionStorage.getItem("link-ret-" + link);
	if (ret != null) {
		$(alvo).val(ret);
	}
	
	// apagar dados
	sessionStorage.removeItem("link-data-" + link);
	sessionStorage.removeItem("link-call-" + link);
	sessionStorage.removeItem("link-ret-" + link);
	
}

/* adicionar mascaras */
function adicionarMascaras() {
	// Telefone
	if (typeof $(".telefone").mask == 'function') {
		$(".telefone").mask("(00) 0000-00009");
	}
	
	// CEP
	if (typeof $(".cep").mask == 'function') {
		$(".cep").mask("00000-000");
	}
	
	//CPF
	if (typeof $(".cpf").mask == 'function') {
		$(".cpf").mask("000.000.000-00");
	}
	
	//CNPJ
	if (typeof $(".cnpj").mask == 'function') {
       $(".cnpj").mask("00.000.000/0000-00");
	}
	
}

/* abrir submenu */
function abrirSubmenu(menu) {
	$(".sidebar-dropdown:not(" + menu + ") ul").slideUp(0);
	$(".sidebar-dropdown:not(" + menu + ")").removeClass("sidebar-dropdown-active");
	$(menu + " ul").slideToggle(100);
	
	if (! $(menu).hasClass("sidebar-dropdown-active")) {
		$(menu).addClass("sidebar-dropdown-active");
	} else {
		$(menu).removeClass("sidebar-dropdown-active");
	}
	
}

/**********/
$(document).ready(function () {
	adicionarMascaras();
});

/*$("#txtNome").blur(function(){
    alert("O input perdeu o foco.");
});*/
