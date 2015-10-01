<?php
   // Mostrar menu
   function menu($url) {
	   $arquivo = fopen($url, "r");

       while (! feof($arquivo)) {
           $linha = fgets($arquivo);
           echo $linha;
       }
       
       fclose($arquivo);
   }
   
?>
