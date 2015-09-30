/* painel de mensagens */
function avisoSucesso(msg) {
	$(".aviso").empty();
	$(".aviso").append("<div class=\"alert alert-success\" role=\"alert\"><span class=\"glyphicon glyphicon-ok-sign\" aria-hidden=\"true\"></span> "+msg+"</div>");
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
