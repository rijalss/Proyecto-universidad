<?php
// require_once("model/auxiliar/categoria.php");

if (!is_file("model/" . $pagina . ".php")) {
    echo "Falta definir la clase " . $pagina;
    exit;
}
require_once("model/" . $pagina . ".php");
if (is_file("views/" . $pagina . ".php")) {

    if (!empty($_POST)) {

        $p = new Producto();
       // $c = new Categoria();
        // $categorias = $c->obtenerCategorias();


        $accion = $_POST['accion'];

        if ($accion == 'consultar') {
            echo  json_encode($p->consultar());
        } elseif ($accion == 'eliminar') {
            $p->set_codProducto($_POST['codProducto']);
            echo  json_encode($p->eliminar());
        } else {
            $p->set_codProducto($_POST['codProducto']);
            $p->set_nombreProducto($_POST['nombreProducto']);
            $p->set_precio($_POST['precio']);
            $p->set_descProducto($_POST['descProducto']);
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
