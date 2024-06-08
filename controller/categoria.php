<?php

if (!is_file("model/" . $pagina . ".php")) {
    echo "Falta definir la clase " . $pagina;
    exit;
}
require_once("model/" . $pagina . ".php");
if (is_file("views/" . $pagina . ".php")) {

    $o = new Producto();


    if (!empty($_POST)) {
        $accionCategoria = $_POST['accionCategoria'];

            if ($accionCategoria == 'eliminarCategoria') {
            $o->set_codProducto($_POST['codProducto']);
            echo  json_encode($o->eliminarCategoria());
        } else {
            $o->set_nombreCategoria($_POST['nombreCategoria']);
            if ($accionCategoria == 'incluirCategoria') {
                echo  json_encode($o->incluirCategoria());
            }
        }
        exit;
    }
    require_once("views/" . $pagina . ".php");
} else {
    echo "pagina en construccion";
}
