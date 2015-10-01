function submit() {
	var query = $("form").serialize();
	
	avisoInfo("Aguarde por favor...");
	
	// fazer post
	$.post("domunicipios.php", query, function (data) {
		avisoSucesso(data);
		
		// redirecionar para pagina anterior
		$("body").append("<meta http-equiv=\"refresh\" content=\"1;conmunicipios.php\">");
	}).fail(postError);
} 
