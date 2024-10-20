<?php
  
if (!is_file("model/salida.php")) {
    echo "Falta definir la clase " . $pagina;
    exit;
}
require_once("model/" . $pagina . ".php");
if (is_file("views/" . $pagina . ".php")) {
  
  if(!empty($_POST)){
  
$obj1 = new Salida(); 
$accion = $_POST['accion'];

if($accion=='listadoproductos'){
$respuesta = $obj1->listadoproductos();
echo json_encode($respuesta);
}
elseif($accion=='registrar'){

    $respuesta = $obj1->registrar($_POST['idp'],$_POST['cant'],$_POST['precio'],$_POST['empleado']);
echo json_encode($respuesta);
    } 


exit; 
  }
  
  $obj2 = new Salida();
    
  $empleados = $obj2->obtenerempleado();
  require_once("views/" . $pagina . ".php");
  }
  else{
  echo "pagina en construccion";
  }
?>