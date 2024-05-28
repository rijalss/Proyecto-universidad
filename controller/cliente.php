<?php
  
//llamada al archivo que contiene la clase
//usuarios, en ella estara el codigo que me //permitirá
//guardar, consultar y modificar dentro de mi base //de datos


//lo primero que se debe hacer es verificar al //igual que en la vista que exista el archivo
if (!is_file("model/".$pagina.".php")){
	//alli pregunte que si no es archivo se niega //con !
	//si no existe envio mensaje y me salgo
	echo "Falta definir la clase ".$pagina;
	exit;
}  
require_once("model/".$pagina.".php");  
  if(is_file("views/".$pagina.".php")){
	  
	  //bien si estamos aca es porque existe la //vista y la clase
	  //por lo que lo primero que debemos hace es //realizar una instancia de la clase
	  //instanciar es crear una variable local, //que contiene los metodos de la clase
	  //para poderlos usar
	  
	  
	  $o = new cliente(); //ahora nuestro objeto //se llama $o y es una copia en memoria de la
	  //clase personasht
	  
	  if(!empty($_POST)){
		  
		  //como ya sabemos si estamos aca es //porque se recibio alguna informacion
		  //de la vista, por lo que lo primero que //debemos hacer ahora que tenemos una 
		  //clase es guardar esos valores en ella //con los metodos set
		  $accion = $_POST['accion'];
		  
		  if($accion=='consultar'){
			 echo  json_encode($o->consultar());  
		  }
		  elseif($accion=='consultatr'){
			 $o->set_cedula($_POST['cedulaCliente']); 
			 echo  json_encode($o->consultatr());  
		  }
		  elseif($accion=='eliminar'){
			 $o->set_cedula($_POST['cedulaCliente']);
			 echo  json_encode($o->eliminar());
		  }
		  else{		  
			  $o->set_cedula($_POST['cedulaCliente']);
			  $o->set_apellido($_POST['apellidoCliente']);
			  $o->set_nombre($_POST['nombreCliente']);
			  $o->set_telefono($_POST['telefonoCliente']);
			 
			  if($accion=='incluir'){
				echo  json_encode($o->incluir());
			  }
			  else if($accion=='modificar'){
				
				echo  json_encode($o->modificar());
			  }
		  }
		  exit;
	  }
	  
	  
	  require_once("views/".$pagina.".php"); 
  }
  else{
	  echo "pagina en construccion";
  }
?>
