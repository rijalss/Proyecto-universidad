<?php

if (!is_file("model/auxiliar/" . $pagina . ".php")) {
    echo "Falta definir la clase " . $pagina;
    exit;
}


require_once("model/auxiliar/" . $pagina . ".php");
require_once("model/almacen.php");

if (is_file("views/auxiliar/" . $pagina . ".php")) {

    //llenar
    if (!empty($_POST)) {

        $p = new Area();
        


        $accion = $_POST['accion'];

        if ($accion == 'consultar') {
            echo  json_encode($p->consultar());
        } elseif ($accion == 'eliminar') {
            $p->set_codArea($_POST['codArea']);
            echo  json_encode($p->eliminar());
        } else {
            $p->set_codArea($_POST['codArea']);
            $p->set_nombreArea($_POST['nombreArea']);
            $p->set_clAlmacen($_POST['clAlmacen']);
           // $p->set_clCategoria($_POST['categoria']);

            if ($accion == 'incluir') {
                echo  json_encode($p->incluir());
            } elseif ($accion == 'modificar') {
                echo  json_encode($p->modificar());
            }
        }
        exit;
    }
    
    // Obtener categorías para la vista
    $al= new Almacen();
    $almacenes = $al->obtenerAlmacen();



    require_once("views/auxiliar/" . $pagina . ".php");
} else {
    echo "pagina en construccion";
}
