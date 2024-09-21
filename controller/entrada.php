<?php
if (!is_file("model/" . $pagina . ".php")) {
    echo "Falta definir la clase " . $pagina;
    exit;
}
require_once("model/" . $pagina . ".php");
if (is_file("views/" . $pagina . ".php")) {

    if (!empty($_POST)) {
       // print_r($_POST);
    
        $obj1 = new Entrada();
        $accion = $_POST['accion'];

        if ($accion == 'consultar') {
            echo  json_encode($obj1->consultar());
        } elseif ($accion == 'eliminar') {
            $obj1->setFactura($_POST['numFactura']);
            echo  json_encode($obj1->eliminar());
        } else {
            $obj1->setClProveedor($_POST['proveedor']);
            $obj1->setFactura($_POST['numFactura']);
            $obj1->setFechaEntrada($_POST['fechaEntrada']);
            $obj1->setClEmpleado($_POST['empleado']);
      
            $obj1->addproductos($_POST['producto']);
         
            $obj1->addcantidad($_POST['cantidad']);
            $obj1->addprecio($_POST['precio']);


            if ($accion == 'incluir') {
               
                echo  json_encode($obj1->incluir());
               
            } elseif ($accion == 'modificar') {
                echo  json_encode($obj1->modificar());
            }
        }
        exit;
    }
    $obj2 = new Entrada();
    
    $proveedores = $obj2->obtenerproveedor();
    $empleados = $obj2->obtenerempleado();
    $productoss = $obj2->obtenerproducto();

    $productos_json = json_encode($productoss);
    
    require_once("views/" . $pagina . ".php");
} else {
    echo "pagina en construccion";
}
