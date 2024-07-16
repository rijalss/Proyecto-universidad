<?php

if (!is_file("model/auxiliar/" . $pagina . ".php")) {
    echo "Falta definir la clase " . $pagina;
    exit;
}


require_once("model/auxiliar/" . $pagina . ".php");

if (is_file("views/auxiliar/" . $pagina . ".php")) {

    
    if (!empty($_POST)) {

        $a = new Area();
        
        $accion = $_POST['accion'];

        if ($accion == 'consultar') {
            echo  json_encode($a->consultar());
        } elseif ($accion == 'eliminar') {
            $a->set_codArea($_POST['codArea']);
            echo  json_encode($a->eliminar());
        } else {
            $a->set_codArea($_POST['codArea']);
            $a->set_nombreArea($_POST['nombreArea']);

            if ($accion == 'incluir') {
                echo  json_encode($a->incluir());
            } elseif ($accion == 'modificar') {
                echo  json_encode($a->modificar());
            }
        }
        exit;
    }
    
    
    require_once("views/auxiliar/" . $pagina . ".php");
} else {
    echo "pagina en construccion";
}
