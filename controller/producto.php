<?php

if (!is_file("model/" . $pagina . ".php")) {
    echo "Falta definir la clase " . $pagina;
    exit;
}
require_once("model/" . $pagina . ".php");
require_once("model/auxiliar/categoria.php");
if (is_file("views/" . $pagina . ".php")) {

    if (!empty($_POST)) {

        $p = new Producto();

        $accion = $_POST['accion'];

        switch ($accion) {
            case 'consultar':
                echo json_encode($p->consultar());
                break;
            case 'eliminar':
                $p->set_codProducto($_POST['codProducto']);
                echo json_encode($p->eliminar());
                break;
            case 'incluir':
            case 'modificar':
                $p->set_codProducto($_POST['codProducto']);
                $p->set_nombreProducto($_POST['nombreProducto']);
                $p->set_ultimoPrecio($_POST['ultimoPrecio']);
                $p->set_descProducto($_POST['descProducto']);
                $p->set_clCategoria($_POST['categoria']);

                if ($accion == 'incluir') {
                    echo json_encode($p->incluir());
                } elseif ($accion == 'modificar') {
                    echo json_encode($p->modificar());
                }
                break;
            default:
                echo "Acción no válida";
                break;
        }
        exit;
    }

    // Obtener categorías para la vista
    $c = new Categoria();
    $categorias = $c->obtenerCategorias();

    require_once("views/" . $pagina . ".php");
} else {
    echo "pagina en construccion";
}
