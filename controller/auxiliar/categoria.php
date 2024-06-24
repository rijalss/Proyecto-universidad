<?php

if (!is_file("model/auxiliar/" . $pagina . ".php")) {
    echo "Falta definir la clase " . $pagina;
    exit;
}
require_once("model/auxiliar/" . $pagina . ".php");
if (is_file("views/auxiliar/" . $pagina . ".php")) {

    if (!empty($_POST)) {

        $p = new Categoria();
        
        $accion = $_POST['accion'];

        if ($accion == 'consultar') {
            echo  json_encode($p->consultar());
        } elseif ($accion == 'eliminar') {
            $p->set_codCategoria($_POST['codCategoria']);
            echo  json_encode($p->eliminar());
        } else {
            $p->set_codCategoria($_POST['codCategoria']);
            $p->set_nombreCategoria($_POST['nombreCategoria']);
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

    require_once("views/auxiliar/" . $pagina . ".php");
} else {
    echo "pagina en construccion";
}
