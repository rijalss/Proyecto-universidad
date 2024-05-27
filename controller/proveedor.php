<?php

if (!is_file("model/" . $pagina . ".php")) {
    echo "Falta definir la clase " . $pagina;
    exit;
}
require_once("model/" . $pagina . ".php");
if (is_file("views/" . $pagina . ".php")) {

    $o = new Proveedor();

    if (!empty($_POST)) {

        $accion = $_POST['accion'];

        if ($accion == 'consultar') {
            echo  json_encode($o->consultar());
        } elseif ($accion == 'consultatr') {
            $o->set_Rifproveedor($_POST['Rifproveedor']);
            echo  json_encode($o->consultatr());
        } elseif ($accion == 'eliminar') {
            $o->set_Rifproveedor($_POST['Rifproveedor']);
            echo  json_encode($o->eliminar());
        } else {
            $o->set_Rifproveedor($_POST['Rifproveedor']);
            $o->set_nombreProveedor($_POST['nombreProveedor']);
            $o->set_telefonoProveedor($_POST['telefonoProveedor']);
            $o->set_correoProveedor($_POST['correoProveedor']);
            $o->set_direccionProveedor($_POST['direccionProveedor']);
            if ($accion == 'incluir') {
                echo  json_encode($o->incluir());
            } elseif ($accion == 'modificar') {
                echo  json_encode($o->modificar());
            }
        }
        exit;
    }


    require_once("views/" . $pagina . ".php");
} else {
    echo "pagina en construccion";
}
