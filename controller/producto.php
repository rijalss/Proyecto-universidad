<?php

if (!is_file("model/" . $pagina . ".php")) {
    echo "Falta definir la clase " . $pagina;
    exit;
}
require_once("model/" . $pagina . ".php");
if (is_file("views/" . $pagina . ".php")) {

    $o = new Producto();
    $c = new producto();
    $categorias = $c->obtenerCategorias();

    if (!empty($_POST)) {
        $accion = isset($_POST['accion']) ? $_POST['accion'] : null;
        $accionCategoria = isset($_POST['accionCategoria']) ? $_POST['accionCategoria'] : null;

        if ($accion == 'consultar') {
            echo  json_encode($o->consultar());
        } elseif ($accion == 'consultatr') {
            $o->set_codProducto(isset($_POST['codProducto']) ? $_POST['codProducto'] : null);
            echo  json_encode($o->consultatr());
        } elseif ($accion == 'eliminar') {
            $o->set_codProducto(isset($_POST['codProducto']) ? $_POST['codProducto'] : null);
            echo  json_encode($o->eliminar());
        } elseif ($accionCategoria == 'eliminarCategoria') {
            if (isset($_POST['nombreCategoria']) && $_POST['nombreCategoria'] != null) {
                $o->set_nombreCategoria($_POST['nombreCategoria']);
                echo  json_encode($o->eliminarCategoria());
            } else {
                echo json_encode(array("status" => "error", "message" => "nombreCategoria no puede ser null"));
            }
        } else {
            $o->set_codProducto(isset($_POST['codProducto']) ? $_POST['codProducto'] : null);
            $o->set_nombreProducto(isset($_POST['nombreProducto']) ? $_POST['nombreProducto'] : null);
            $o->set_descProducto(isset($_POST['descProducto']) ? $_POST['descProducto'] : null);
            $o->set_precio(isset($_POST['precio']) ? $_POST['precio'] : null);
            $o->set_clCategoria(isset($_POST['categoria']) ? $_POST['categoria'] : null);

            if ($accion == 'incluir') {
                echo  json_encode($o->incluir());
            } elseif ($accion == 'modificar') {
                echo  json_encode($o->modificar());
            } elseif ($accionCategoria == 'incluirCategoria') {
                if (isset($_POST['nombreCategoria']) && $_POST['nombreCategoria'] != null) {
                    $o->set_nombreCategoria($_POST['nombreCategoria']);
                    echo  json_encode($o->incluirCategoria());
                } else {
                    echo json_encode(array("status" => "error", "message" => "nombreCategoria no puede ser null"));
                }
            }
        }
        exit;
    }

    require_once("views/" . $pagina . ".php");
} else {
    echo "pagina en construccion";
}
