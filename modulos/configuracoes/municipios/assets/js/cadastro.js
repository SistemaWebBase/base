function submit() {
	var query = $("form").serialize();
	
	avisoInfo("Aguarde por favor...");
	
	// fazer post
	$.post("acao.php", query, function (data) {
		avisoSucesso(data);
		
		// redirecionar para pagina anterior
		redirecionar("consulta.php", 1000);
	}).fail(postError);
} 
