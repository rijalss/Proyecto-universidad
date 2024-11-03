<?php

if (!is_file("model/reportes/" . $pagina . ".php")) {
    echo "Falta definir la clase " . $pagina;
    exit;
}
require_once("model/reportes/" . $pagina . ".php");
if (is_file("views/reportes/" . $pagina . ".php")) {

    if (!empty($_POST)) {
        
        $Ob2 = new Rsalida();

        $accion = $_POST['accion'];

        if ($accion == 'consultar') {
            echo  json_encode($Ob2->Consultar());
        }
        if ($accion == 'filtrar') {
            $inicio = date("y-m-d", strtotime($_POST['fecha_inicio']));
            $fin = date("y-m-d", strtotime($_POST['fecha_fin']));
            $Ob2->set_FechaInicio($inicio);
            $Ob2->set_FechaFinal($fin);

            echo  json_encode($Ob2->Filtrar());
        }


        if (isset($_POST['generar'])) {
            $Ob3 = new Rsalida();
            $inicio = date("y-m-d", strtotime($_POST['fecha_inicio']));
            $fin = date("y-m-d", strtotime($_POST['fecha_fin']));
            $Ob3->set_FechaInicio($inicio);
            $Ob3->set_FechaFinal($fin);
            // Generamos el PDF
            $Ob3->GenerarPDF();
        }
        exit;
    }   
    require_once("views/reportes/" . $pagina . ".php");
} else {
    echo "pagina en construccion";
}
?>
