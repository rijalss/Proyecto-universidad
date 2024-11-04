<?php

if (!is_file("model/reportes/" . $pagina . ".php")) {
    echo "Falta definir la clase " . $pagina;
    exit;
}
require_once("model/reportes/" . $pagina . ".php");

if (is_file("views/reportes/" . $pagina . ".php")) {

    if (isset($_POST['generar'])) {
        $p = new Rproducto();
        $p->set_codProducto($_POST['codProducto']);
        $p->set_nombreProducto($_POST['nombreProducto']);
        if (!empty($_POST['categoria'])) {
            $p->set_clCategoria($_POST['categoria']);
    
        } 
            // Generamos el PDF
            $p->generarPDF();   
    }
   
    $c = new Rproducto();
    $categorias = $c->obtenerCategorias();
    

    require_once("views/reportes/" . $pagina . ".php");
} else {
    echo "pagina en construcción";
}
