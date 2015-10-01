<?php
   // Importar conteudo do arquivo
   function import($url) {
	   $arquivo = fopen($url, "r");

       while (! feof($arquivo)) {
           $linha = fgets($arquivo);
           echo $linha;
       }
       
       fclose($arquivo);
   }
   
?>
