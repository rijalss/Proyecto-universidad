<?php

if (!is_file("model/auxiliar/" . $pagina . ".php")) {
    echo "Falta definir la clase " . $pagina;
    exit;
}
require_once("model/auxiliar/" . $pagina . ".php");


if (is_file("views/auxiliar/" . $pagina . ".php")) {

    $c = new Categoria();

    if (!empty($_POST)) {
        $accion = isset($_POST['accion']) ? $_POST['accion'] : null;

        if ($accion == 'consultar') {
            echo json_encode($c->consultar());
        } elseif ($accion == 'eliminar') {
            if (isset($_POST['nombreCategoria']) && $_POST['nombreCategoria'] != null) {
                $c->set_nombreCategoria($_POST['nombreCategoria']);
                echo json_encode($c->eliminar());
            } else {
                echo json_encode(array("status" => "error", "message" => "nombreCategoria no puede ser null"));
            }
        } elseif ($accion == 'incluir') {
            if (isset($_POST['nombreCategoria']) && $_POST['nombreCategoria'] != null) {
                $c->set_nombreCategoria($_POST['nombreCategoria']);
                echo json_encode($c->incluir());
            } else {
                echo json_encode(array("status" => "error", "message" => "nombreCategoria no puede ser null"));
            }
        } elseif ($accion == 'modificar') {
            if (isset($_POST['clCategoria']) && isset($_POST['nombreCategoria']) && $_POST['nombreCategoria'] != null) {
                $c->set_clCategoria($_POST['clCategoria']);
                $c->set_nombreCategoria($_POST['nombreCategoria']);
                echo json_encode($c->modificar());
            } else {
                echo json_encode(array("status" => "error", "message" => "clCategoria y nombreCategoria no pueden ser null"));
            }
        } else {
            echo json_encode(array("status" => "error", "message" => "Acción no válida"));
        }
        exit;
    }

    require_once("views/auxiliar/" . $pagina . ".php");
} else {
    echo "pagina en construccion";
}
