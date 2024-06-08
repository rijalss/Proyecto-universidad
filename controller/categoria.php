<?php

require_once("model/producto.php");

$o = new Producto();
$categoria = new Categoria("");
$categorias = $categoria->obtenerCategorias();

if (!empty($_POST)) {
    $accionCategoria = isset($_POST['accionCategoria']) ? $_POST['accionCategoria'] : null;

    if ($accionCategoria == 'eliminarCategoria') {
        $o->set_nombreCategoria(isset($_POST['nombreCategoria']) ? $_POST['nombreCategoria'] : null);
        echo  json_encode($o->eliminarCategoria());
    } else {
        $o->set_nombreCategoria(isset($_POST['nombreCategoria']) ? $_POST['nombreCategoria'] : null);
        if ($accionCategoria == 'incluirCategoria') {
            echo  json_encode($o->incluirCategoria());
        }
    }
    exit;
}
