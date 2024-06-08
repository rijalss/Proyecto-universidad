<?php
require_once("controller/categoria.php");

if (!is_file("model/" . $pagina . ".php")) {
    echo "Falta definir la clase " . $pagina;
    exit;
}
require_once("model/" . $pagina . ".php");
if (is_file("views/" . $pagina . ".php")) {

    $o = new Producto();

    if (!empty($_POST)) {

        $accion = isset($_POST['accion']) ? $_POST['accion'] : null;

        if ($accion == 'consultar') {
            echo  json_encode($o->consultar());
        } elseif ($accion == 'consultatr') {
            $o->set_codProducto($_POST['codProducto']);
            echo  json_encode($o->consultatr());
        } elseif ($accion == 'eliminar') {
            $o->set_codProducto($_POST['codProducto']);
            echo  json_encode($o->eliminar());
        } else {
            $o->set_codProducto($_POST['codProducto']);
            $o->set_nombreProducto($_POST['nombreProducto']);
            $o->set_descProducto($_POST['descProducto']);
            $o->set_precio($_POST['precio']);
            $o->set_codCategoria($_POST['categoria']);
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
