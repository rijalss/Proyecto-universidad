<?php

if (!is_file("model/auxiliar/" . $pagina . ".php")) {
    echo "Falta definir la clase " . $pagina;
    exit;
}
require_once("model/auxiliar/" . $pagina . ".php");


if (is_file("views/auxiliar/" . $pagina . ".php")) {



    if (!empty($_POST)) {

        $c = new Cargo();
        
        $accion = $_POST['accion'];

        if ($accion == 'consultar') {
            echo  json_encode($c->consultar());
        } elseif ($accion == 'eliminar') {
            $c->set_codCargo($_POST['codCargo']);
            echo  json_encode($c->eliminar());
        }elseif($accion == 'existe') {
         
            echo json_encode($c->existe($_POST['codCargo']));
        } else {
            $c->set_codCargo($_POST['codCargo']);
            $c->set_nombreCargo($_POST['nombreCargo']);
            if ($accion == 'incluir') {
                echo  json_encode($c->incluir());
            } elseif ($accion == 'modificar') {
                echo  json_encode($c->modificar());
            }
        }
        exit;
    }
    

    require_once("views/auxiliar/" . $pagina . ".php");
} else {
    echo "pagina en construccion";
}
