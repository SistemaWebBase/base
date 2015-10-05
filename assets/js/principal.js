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
	
}

/**********/
$(document).ready(function () {
	adicionarMascaras();
});
