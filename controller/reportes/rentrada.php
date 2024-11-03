<?php

require_once("model/reportes/" . $pagina . ".php");


if (is_file("views/reportes/" . $pagina . ".php")) {



    if (!empty($_POST)) {

        $obj1 = new Rentrada();
    
            $accion = $_POST['accion'];

        if ($accion == 'consultar') {
            echo  json_encode($obj1->consultar());
        } if ($accion == 'filtrar') {
            $inicio=date("y-m-d", strtotime( $_POST['finicio']));
            $fin= date("y-m-d", strtotime( $_POST['ffin']));
            $obj1->setFechainicio($inicio);
            $obj1->setFechafinal($fin);

            echo  json_encode($obj1->filtrar());
        } 

        
    if (isset($_POST['Generar'])) {
        $obj2 = new Rentrada();
        $inicio=date("y-m-d", strtotime( $_POST['finicio']));
        $fin= date("y-m-d", strtotime( $_POST['ffin']));
        $obj2->setFechainicio($inicio);
        $obj2->setFechafinal($fin);
            // Generamos el PDF
            $obj2->generarPDF();
       
    }
        exit;
        
    }
    

    require_once("views/reportes/" . $pagina . ".php");
} else {
    echo "pagina en construccion";
}
