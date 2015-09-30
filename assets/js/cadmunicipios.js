function submit() {
	var query = $("form").serialize();
	
	// fazer post
	$.post("domunicipios.php", query, function (data) {
		avisoSucesso(data);
	}).fail(postError);
} 
