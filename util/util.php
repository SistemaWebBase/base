<?php

function tratarTexto($texto) {
	return strtoupper(str_replace("'", "", trim($texto)));
}

?>
