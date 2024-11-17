<?php

if (!is_file("model/reportes/" . $pagina . ".php")) {
    echo "Falta definir la clase " . $pagina;
    exit;
}
require_once("model/reportes/" . $pagina . ".php");

    if (isset($_POST['Generar'])) {
        $e = new Rexistencia();
       
        if (!empty($_POST['ubi'])) {
            $ubi= $_POST['ubi'];
            switch ($ubi) {
                case 1:
                    $e->generarPDFalmacen();
                    break;
                case 2:
                    $e->generarPDFmostrador();
                    break;
                }
        }
 
  
        $e->generarPDF();
       
    }



if (is_file("views/reportes/" . $pagina . ".php")) {


    require_once("views/reportes/" . $pagina . ".php");
} else {
    echo "pagina en construccion";
}