<?php

if (!is_file("model/reportes/" . $pagina . ".php")) {
    echo "Falta definir la clase " . $pagina;
    exit;
}
require_once("model/reportes/" . $pagina . ".php");


if (is_file("views/reportes/" . $pagina . ".php")) {

    $o = new rproveedor();

    if (isset($_POST['generar'])) {
        $o = new rproveedor();
        $o->set_nombreProveedor($_POST['nombreProveedor']);
        $o->set_rifProveedor($_POST['rifProveedor']);
        $o->generarPDF();
    }
    

    require_once("views/reportes/" . $pagina . ".php");
} else {
    echo "pagina en construccion";
}
