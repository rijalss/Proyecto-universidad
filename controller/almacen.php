<?php

if (!is_file("model/" . $pagina . ".php")) {
    echo "Falta definir la clase " . $pagina;
    exit;
}
require_once("model/" . $pagina . ".php");
if (is_file("views/" . $pagina . ".php")) {

    if (!empty($_POST)) {

        $p = new Almacen();
        
        $accion = $_POST['accion'];

        if ($accion == 'consultar') {
            echo  json_encode($p->consultar());
        } elseif ($accion == 'eliminar') {
            $p->set_codAlmacen($_POST['codAlmacen']);
            echo  json_encode($p->eliminar());
        } else {
            $p->set_codAlmacen($_POST['codAlmacen']);
            $p->set_nombreAlmacen($_POST['nombreAlmacen']);
            $p->set_direccionAlmacen($_POST['direccionAlmacen']);
            if ($accion == 'incluir') {
                echo  json_encode($p->incluir());
            } elseif ($accion == 'modificar') {
                echo  json_encode($p->modificar());
            }
        }
        exit;
    }
    
    // Obtener categorías para la vista
//  //   $c = new Producto();
//    // $categorias = $c->obtenerCategoria();

    require_once("views/" . $pagina . ".php");
} else {
    echo "pagina en construccion";
}
