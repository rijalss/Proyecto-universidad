<?php

if (!is_file("model/" . $pagina . ".php")) {
    echo "Falta definir la clase " . $pagina;
    exit;
}
require_once("model/" . $pagina . ".php");
if (is_file("views/" . $pagina . ".php")) {

    if (!empty($_POST)) {

        $p = new Proveedor();
        $accion = $_POST['accion'];

        if ($accion == 'consultar') {
            echo  json_encode($p->consultar());
        } elseif ($accion == 'eliminar') {
            $p->set_rifProveedor($_POST['rifProveedor']);
            echo  json_encode($p->eliminar());
        } else {
            $p->set_prefijoRif($_POST['prefijoRif']); 
            $p->set_rifProveedor($_POST['rifProveedor']);
            $p->set_nombreProveedor($_POST['nombreProveedor']);
            $p->set_telefonoProveedor($_POST['telefonoProveedor']);
            $p->set_correoProveedor($_POST['correoProveedor']);
            $p->set_direccionProveedor($_POST['direccionProveedor']);
            if ($accion == 'incluir') {
                echo  json_encode($p->incluir());
            } elseif ($accion == 'modificar') {
                echo  json_encode($p->modificar());
            }
        }
        exit;
    }

    require_once("views/" . $pagina . ".php");
} else {
    echo "pagina en construccion";
}
