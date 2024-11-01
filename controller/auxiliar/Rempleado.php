<?php

if (!is_file("model/auxiliar/" . $pagina . ".php")) {
    echo "Falta definir la clase " . $pagina;
    exit;
}
require_once("model/auxiliar/" . $pagina . ".php");


if (is_file("views/auxiliar/" . $pagina . ".php")) {




    if (isset($_POST['generar'])) {
        $o = new Rempleado();
        $o->set_cedulaEmpleado($_POST['cedulaEmpleado']);
        $o->set_nombreEmpleado($_POST['nombreEmpleado']);
        $o->set_apellidoEmpleado($_POST['apellidoEmpleado']);
        if (!empty($_POST['cargo'])) {
            $o->set_clCargo($_POST['cargo']);
    
        }
     
            // Generamos el PDF
            $o->generarPDF();
       
    }
    
       
   
    $c = new Rempleado();
    $cargos = $c->obtenerCargos();

    require_once("views/auxiliar/" . $pagina . ".php");
} else {
    echo "pagina en construccion";
}
