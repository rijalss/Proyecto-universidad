<?php

if (!is_file("model/auxiliar/" . $pagina . ".php")) {
    echo "Falta definir la clase " . $pagina;
    exit;
}
require_once("model/auxiliar/" . $pagina . ".php");
if (is_file("views/auxiliar/" . $pagina . ".php")) {

    if (!empty($_POST)) {

        $obj1 = new Categoria();
        
        $accion = $_POST['accion'];

        if ($accion == 'consultar') {
            echo  json_encode($obj1->consultar());
        } elseif ($accion == 'eliminar') {
            $obj1->setcodCategoria($_POST['codCategoria']);
            echo  json_encode($obj1->eliminar());
        } else {
            $obj1->setcodCategoria($_POST['codCategoria']);
            $obj1->setnombreCategoria($_POST['nombreCategoria']);
            if ($accion == 'incluir') {
                echo  json_encode($obj1->incluir());
            } elseif ($accion == 'modificar') {
                echo  json_encode($obj1->modificar());
            }
        }
        exit;
    }
    
   
    require_once("views/auxiliar/" . $pagina . ".php");
} else {
    echo "pagina en construccion";
}
