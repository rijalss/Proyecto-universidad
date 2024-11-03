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
        if (!empty($_POST['Categoria'])) {
            $c->set_clCategoria($_POST['Categoria']);
    
        } 
            // Generamos el PDF
            $p->generarPDF();   
    }
    require_once("model/auxiliar/categoria.php");
    $c = new Categoria();
    $categorias = $c->obtenerCategorias();
    

    require_once("views/reportes/" . $pagina . ".php");
} else {
    echo "pagina en construcción";
}
