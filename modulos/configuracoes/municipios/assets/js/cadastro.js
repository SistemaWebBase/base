function submit() {
	var query = $("form").serialize();
	
	avisoInfo("Aguarde por favor...");
	
	// fazer post
	$.post("acao.php", query, function (data) {
		avisoSucesso(data);
		
		// redirecionar para pagina anterior
		$("body").append("<meta http-equiv=\"refresh\" content=\"1;consulta.php\">");
	}).fail(postError);
} 
