<?php

require_once("model/reportes/" . $pagina . ".php");


if (is_file("views/reportes/" . $pagina . ".php")) {


    $obj1 = new Rentrada();
    if (!empty($_POST)) {

       
        $accion = $_POST['accion'];

        if ($accion == 'consultar') {
            echo  json_encode($obj1->consultar());
        } 
        
        
        if ($accion == 'filtrar') {
            
            $inicio=date("y-m-d", strtotime( $_POST['finicio']));
            $fin= date("y-m-d", strtotime( $_POST['ffin']));

            $obj1->setFechainicio($fin);
            $obj1->setFechafinal($inicio);

            echo  json_encode($obj1->filtrar());
        } 

        
    if (isset($_POST['Generar'])) {
        $obj2 = new Rentrada();
        
            // Generamos el PDF
            
            if (!empty($_POST['empleado'])) {
                $obj2->setclEmpleado($_POST['empleado']);
        
            } 
            if (!empty($_POST['numfactura'])) {
               
                $obj2->setnumFactura($_POST['numfactura']);
        
            } 
            if (!empty($_POST['proveedor'])) {
                $obj2->setclProveedor($_POST['proveedor']);
        
            } 
            if (!empty($_POST['finicio'])) {
               
               // $inicio=date("y-m-d", strtotime( $_POST['finicio']));
                $obj2->setFechainicio($_POST['finicio']);
               
        
            } 
            if (!empty($_POST['ffin'])) {
               
              //  $fin= date("y-m-d", strtotime( $_POST['ffin']));
                $obj2->setFechafinal($_POST['ffin']);

        
            } 
           
            $obj2->generarPDF();
       
    }
        exit;
        
    }
    
    $proveedores = $obj1->obtenerproveedor();
    $empleados = $obj1->obtenerempleado();
    require_once("views/reportes/" . $pagina . ".php");
} else {
    echo "pagina en construccion";
}
