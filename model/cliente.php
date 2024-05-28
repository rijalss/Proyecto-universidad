<?php
//llamda al archivo que contiene la clase
//datos, en ella posteriormente se colcora el codigo
//para enlazar a su base de datos
require_once('model/conexion.php');

//declaracion de la clase usuarios que hereda de la clase datos
//la herencia se declara con la palabra extends y no es mas 
//que decirle a esta clase que puede usar los mismos metodos
//que estan en la clase de dodne hereda (La padre) como sir fueran de el

class cliente extends Conexion{
	//el primer paso dentro de la clase
	//sera declarar los atributos (variables) que describen la clase
	//para nostros no es mas que colcoar los inputs (controles) de
	//la vista como variables aca
	//cada atributo debe ser privado, es decir, ser visible solo dentro de la
	//misma clase, la forma de colcoarlo privado es usando la palabra private
	
	private $cedula; //recuerden que en php, las variables no tienen tipo predefinido
	private $apellido;
	private $nombre;
    private $telefono;
	
	//Ok ya tenemos los atributos, pero como son privados no podemos acceder a ellos desde fueran
	//por lo que debemos colcoar metodos (funciones) que me permitan leer (get) y colocar (set)
	//valores en ello, esto es  muy mal llamado geters y seters por si alguien se los pregunta
	
	function set_cedula($valor){
		$this->cedula = $valor; //fijencen como se accede a los elementos dentro de una clase
		//this que singnifica esto es decir esta clase luego -> simbolo que indica que apunte
		//a un elemento de this, es decir esta clase
		//luego el nombre del elemento sin el $
	}
	//lo mismo que se hizo para cedula se hace para usuario y clave
	
	function set_apellido($valor){
		$this->apellido = $valor;
	}
	
	function set_nombre($valor){
		$this->nombre = $valor;
	}
	
	function set_telefono($valor){
		$this->telefono = $valor;
	}

	
	//ahora la misma cosa pero para leer, es decir get
	
	function get_cedula(){
		return $this->cedula;
	}
	
	function get_apellido(){
		return $this->apellido;
	}
	
	function get_nombre(){
		return $this->nombre;
	}
	
	function get_telefono(){
		return $this->telefono;
	}

	
	//Lo siguiente que demos hacer es crear los metodos para incluir, consultar y eliminar
	function incluir(){
		//Ok ya tenemos la base de datos y la funcion conecta dentro de la clase
		//datos, ahora debemos ejecutar las operaciones para realizar las consultas 
		
		//Lo primero que debemos hacer es consultar por el campo clave
		//en este caso la cedula, para ello se creo la funcion existe
		//que retorna true en caso de exitir el registro
		
		if(!$this->existe($this->cedula)){
			//si estamos aca es porque la cedula no existe es decir se puede incluir
			//los pasos a seguir son
			//1 Se llama a la funcion conecta 
			$co = $this->conecta();
			$co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			//2 Se ejecuta el sql
			$r = array();
			try {
				
					$p = $co->prepare("Insert into cliente(
						cedulaCliente,
						apellidoCliente,
						nombreCliente,
						telefonoCliente
						)
						Values(
						:cedulaCliente,
						:apellidoCliente,
						:nombreCliente,
						:telefonoCliente
						)");
					$p->bindParam(':cedulaCliente',$this->cedula);		
					$p->bindParam(':apellidoCliente',$this->apellido);
					$p->bindParam(':nombreCliente',$this->nombre);	
					$p->bindParam(':telefonoCliente',$this->telefono);
					
					
					$p->execute();
					
						$r['resultado'] = 'incluir';
			            $r['mensaje'] =  'Registro Inluido';
			} catch(Exception $e) {
				$r['resultado'] = 'error';
			    $r['mensaje'] =  $e->getMessage();
			}
		}
		else{
			$r['resultado'] = 'incluir';
			$r['mensaje'] =  'Ya existe la cedula';
		}
		
		//Listo eso es todo y es igual para el resto de las operaciones
		//incluir, modificar y eliminar
		//solo cambia para buscar 
		return $r;
		
	}
	function modificar(){
		$co = $this->conecta();
		$co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$r = array();
		if($this->existe($this->cedula)){
			try {
		
				$p = $co->prepare("Update cliente set 
						apellidoCliente = :apellidoCliente,
						nombreCliente = :nombreCliente,
						telefonoCliente = :telefonoCliente
						where
						cedulaCliente = :cedulaCliente");
					$p->bindParam(':cedulaCliente',$this->cedula);		
					$p->bindParam(':apellidoCliente',$this->apellido);
					$p->bindParam(':nombreCliente',$this->nombre);	
					$p->bindParam(':telefonoCliente',$this->telefono);
					
					
					$p->execute();
					
						$r['resultado'] = 'modificar';
			            $r['mensaje'] =  'Registro Modificado';
			} catch(Exception $e) {
				$r['resultado'] = 'error';
			    $r['mensaje'] =  $e->getMessage();
			}
		}
		else{
			$r['resultado'] = 'modificar';
			    $r['mensaje'] =  'No existe la cedula';
		}
		return $r;
	}
	
	function eliminar(){
		$co = $this->conecta();
		$co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$r = array();
		if($this->existe($this->cedula)){
			try {
					$p = $co->prepare("delete from cliente
					    where
						cedulaCliente = :cedulaCliente
						");
					$p->bindParam(':cedulaCliente',$this->cedula);		
					
					
					$p->execute();
					$r['resultado'] = 'eliminar';
			        $r['mensaje'] =  'Registro Eliminado';
			} catch(Exception $e) {
				$r['resultado'] = 'error';
			    $r['mensaje'] =  $e->getMessage();
			}
		}
		else{
			$r['resultado'] = $this->cedula;
			$r['mensaje'] =  'No existe la cedula';
		}
		return $r;
	}
	
	
	
	function consultar(){

		$co = $this->conecta();
		$co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$r = array();
		try{
			
			$resultado = $co->query("Select * from cliente");
			
			if($resultado){
				
				$respuesta = '';
				foreach($resultado as $r){
					$respuesta = $respuesta."<tr style='cursor:pointer' onclick='coloca(this);'>";
						$respuesta = $respuesta."<td>";
							$respuesta = $respuesta.$r['cedulaCliente'];
						$respuesta = $respuesta."</td>";
						$respuesta = $respuesta."<td>";
							$respuesta = $respuesta.$r['nombreCliente'];
						$respuesta = $respuesta."</td>";
						$respuesta = $respuesta."<td>";
							$respuesta = $respuesta.$r['apellidoCliente'];
						$respuesta = $respuesta."</td>";
						$respuesta = $respuesta."<td>";
							$respuesta = $respuesta.$r['telefonoCliente'];
						$respuesta = $respuesta."</td>";
					$respuesta = $respuesta."</tr>";
				}
				$r['resultado'] = 'consultar';
				$r['mensaje'] =  $respuesta;
			    
			}
			else{
				$r['resultado'] = 'consultar';
				$r['mensaje'] =  '';
			}
			
		}catch(Exception $e){
			$r['resultado'] = 'error';
			$r['mensaje'] =  $e->getMessage();
		}
		return $r;
	}
	
	
	private function existe($cedula){
		$co = $this->conecta();
		$co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		try{
			
			$resultado = $co->query("Select * from cliente where cedulaCliente='$cedula'");
			
			
			$fila = $resultado->fetchAll(PDO::FETCH_BOTH);
			if($fila){

				return true;
			    
			}
			else{
				
				return false;;
			}
			
		}catch(Exception $e){
			return false;
		}
	}
	
	function consultatr(){
		$co = $this->conecta();
		$co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$r = array();
		try{
			
			$resultado = $co->query("Select * from cliente where cedulaCliente='$this->cedula'");
			$fila = $resultado->fetchAll(PDO::FETCH_BOTH);
			if($fila){
			    
				$r['resultado'] = 'encontro';
			    $r['mensaje'] =  $fila;
				
			    
			}
			else{
				
				$r['resultado'] = 'no en contro';
				$r['mensaje'] =  '';
				
			}
			
		}catch(Exception $e){
			$r['resultado'] = 'error';
			$r['mensaje'] =  $e->getMessage();
		}
		return $r;
		
	}
	


	
	
	
}
