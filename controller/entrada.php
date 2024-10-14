<?php  
if (!is_file("model/" . $pagina . ".php")) {
    echo "Falta definir la clase " . $pagina;
    exit;
}
require_once("model/" . $pagina . ".php");
if (is_file("views/" . $pagina . ".php")) {
	  
	if(!empty($_POST)){
		  
		$obj1 = new Entrada(); 	
		$accion = $_POST['accion'];
		
		if($accion=='listadoproductos'){
			$respuesta = $obj1->listadoproductos();
			echo json_encode($respuesta);
		}
		elseif($accion=='registrar'){
			
		    $respuesta = $obj1->registrar($_POST['idp'],$_POST['proveedor'],$_POST['cant'],$_POST['precio'],$_POST['numfactura'],$_POST['empleado']);
			echo json_encode($respuesta);
	    }elseif ($accion == 'buscar') {
            $respuesta =$obj1->buscar(isset($_POST['numfactura']) ? $_POST['numfactura'] : null);
            echo  json_encode($respuesta);
        }
		exit; 
	  }
	  $obj2 = new Entrada();
    
	  $proveedores = $obj2->obtenerproveedor();
	  $empleados = $obj2->obtenerempleado();
	  require_once("views/" . $pagina . ".php");
  }
  else{
	  echo "pagina en construccion";
  }
?>
