<?php

function tratarTexto($texto) {
	return strtoupper(str_replace("'", "", trim($texto)));
}

function tratarNumero($texto) {
        return preg_replace("/[^0-9]/", "", trim($texto));
}
        

?>
