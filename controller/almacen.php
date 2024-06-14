<?php

if (!is_file("model/" . $pagina . ".php")) {
    echo "Falta definir la clase " . $pagina;
    exit;
}
require_once("model/" . $pagina . ".php");
if (is_file("views/" . $pagina . ".php")) {

    $o = new Almacen();
    $a = new Almacen();
    $almacenes = $a->obtenerAlmacen();

    if (!empty($_POST)) {
        $accion = isset($_POST['accion']) ? $_POST['accion'] : null;
        $accionArea = isset($_POST['accionArea']) ? $_POST['accionArea'] : null;

        if ($accion == 'consultar') {
            echo  json_encode($o->consultar());
        } elseif ($accion == 'consultatr') {
            $o->set_nombreAlmacen(isset($_POST['nombreAlmacen']) ? $_POST['nombreAlmacen'] : null);
            echo  json_encode($o->consultatr());
        } elseif ($accion == 'eliminar') {
            $o->set_nombreAlmacen(isset($_POST['nombreAlmacen']) ? $_POST['nombreAlmacen'] : null);
            echo  json_encode($o->eliminar());
        } elseif ($accionArea == 'eliminarArea') {
            if (isset($_POST['nombreArea']) && $_POST['nombreArea'] != null) {
                $o->set_nombreArea($_POST['nombreArea']);
                echo  json_encode($o->eliminarArea());
            } else {
                echo json_encode(array("status" => "error", "message" => "nombreArea no puede ser null"));
            }
        } else {
            $o->set_nombreAlmacen(isset($_POST['nombreAlmacen']) ? $_POST['nombreAlmacen'] : null);
            $o->set_direccionAlmacen(isset($_POST['direccionAlmacen']) ? $_POST['direccionAlmacen'] : null);
            
            if ($accion == 'incluir') {
                echo  json_encode($o->incluir());
            } elseif ($accion == 'modificar') {
                echo  json_encode($o->modificar());
            } elseif ($accionArea == 'incluirArea') {
                if (isset($_POST['nombreArea']) && $_POST['nombreArea'] != null) {
                    $o->set_nombreArea($_POST['nombreArea']);
                    echo  json_encode($o->incluirArea());
                } else {
                    echo json_encode(array("status" => "error", "message" => "nombreArea no puede ser null"));
                }
            }
        }
        exit;
    }

    require_once("views/" . $pagina . ".php");
} else {
    echo "pagina en construccion";
}

