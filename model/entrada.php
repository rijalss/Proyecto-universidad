<?php
require_once('model/conexion.php');

class Entrada extends Conexion{

	public function registrar($idproducto, $idproveedor, $cantidad, $precio, $numfactura, $idempleado) {
		$r = array();

		if (!$this->buscar($numfactura)) {
			$co = $this->conecta();
			$co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			try {
				$fecha = date('Y-m-d H:i:s');
	
				
				$sql = "INSERT INTO notaentrada (fechaEntrada, numFactura, clProveedor, clEmpleado) 
							VALUES (:fecha, :numFactura, :idProveedor, :idEmpleado)";
				$entrada = $co->prepare($sql);
				$entrada->bindParam(':fecha', $fecha);
				$entrada->bindParam(':numFactura', $numfactura);
				$entrada->bindParam(':idProveedor', $idproveedor);
				$entrada->bindParam(':idEmpleado', $idempleado);
				$entrada->execute();
				$lid = $co->lastInsertId();
	
				$tamano = count($idproducto);
	
				
	
				for ($i = 0; $i < $tamano; $i++) {
					$sql = "INSERT INTO administrarentrada (precioEntrada, cantidadEntrada, clEntrada, clExistencia) 
									VALUES (:precioEntrada, :cantidadEntrada, :idEntrada, :idExistencia)";
					$entrada = $co->prepare($sql);

					$entrada->bindParam(':precioEntrada', $precio[$i]);
					$entrada->bindParam(':cantidadEntrada', $cantidad[$i]);
					$entrada->bindParam(':idEntrada', $lid);
					$entrada->bindParam(':idExistencia', $idproducto[$i]);
					$entrada->execute();


					$sql = "UPDATE producto SET ultimoPrecio = :precioUnidad WHERE clProducto = :idProducto";
					$entrada = $co->prepare($sql);

					$precioUnidad = $precio[$i] / $cantidad[$i];
					// actualizar el ultimo precio
					$entrada->bindParam(':precioUnidad', $precioUnidad);
					$entrada->bindParam(':idProducto', $idproducto[$i]);
					$entrada->execute();
				}
	
				// Obtener las cantidades de existencia actuales
				$sql = "SELECT clExistencia, cantidadExistencia FROM existencia";
				$entrada = $co->prepare($sql);
				$entrada->execute();
				$existencias = $entrada->fetchAll(PDO::FETCH_KEY_PAIR);
	
				// Preparar la consulta de actualización de existencia
				
				for ($i = 0; $i < $tamano; $i++) {
					$sql = "UPDATE existencia SET cantidadExistencia = :total WHERE clExistencia = :idExistencia";
					$entrada = $co->prepare($sql);
	
					$idProd = $idproducto[$i];
					$cantidadActual = isset($existencias[$idProd]) ? $existencias[$idProd] : 0;
					$total = $cantidadActual + $cantidad[$i];
	
					// Ejecutar la consulta de actualización de existencia
					$entrada->bindParam(':total', $total);
					$entrada->bindParam(':idExistencia', $idProd);
					$entrada->execute();
				}
	
				$r['resultado'] = 'registrar';
				$r['mensaje'] = 'Registro Incluido!<br/> Se registró la nota de entrada correctamente';
	
			} catch (Exception $e) {
				$r['resultado'] = 'error';
				$r['mensaje'] = $e->getMessage();
			}
		} else {
			$r['resultado'] = 'registrar';
			$r['mensaje'] = 'ERROR! <br/> El numero de factura ya existe!';
		}
		return $r;
	}
	
  
	
	public function obtenerproveedor(){
        $co = $this->conecta();
        $co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $p = $co->prepare("SELECT clProveedor,nombreProveedor FROM proveedor ");
        $p->execute();
        $r = $p->fetchAll(PDO::FETCH_ASSOC);
        return $r;
    }

    public function obtenerempleado(){
        $co = $this->conecta();
        $co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $p = $co->prepare("SELECT clEmpleado,nombreEmpleado FROM empleado ");
        $p->execute();
        $r = $p->fetchAll(PDO::FETCH_ASSOC);
        return $r;
    }
	
	
	function listadoproductos(){
		$co = $this->conecta();
		$co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$r = array();
		try{
			
			$resultado = $co->query("Select * from producto");
			
			if($resultado){
				
				$respuesta = '';
				foreach($resultado as $r){
					$respuesta = $respuesta."<tr style='cursor:pointer' onclick='colocaproducto(this);'>";
						$respuesta = $respuesta."<td style='display:none'>";
							$respuesta = $respuesta.$r['clProducto'];
						$respuesta = $respuesta."</td>";
						$respuesta = $respuesta."<td>";
							$respuesta = $respuesta.$r['codProducto'];
						$respuesta = $respuesta."</td>";
						$respuesta = $respuesta."<td>";
							$respuesta = $respuesta.$r['nombreProducto'];
						$respuesta = $respuesta."</td>";
						
					$respuesta = $respuesta."</tr>";
				}
				
			    
			}
			$r['resultado'] = 'listadoproductos';
			$r['mensaje'] =  $respuesta;
			
		}catch(Exception $e){
			$r['resultado'] = 'error';
		    $r['mensaje'] =  $e->getMessage();
		}
		
		return $r;
		
	}
	
	function buscar($numfactura){
        $co = $this->conecta();
        $co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $r = array();
        try {

            $factura = $co->prepare("SELECT * FROM notaentrada WHERE numFactura = :numFactura");
            $factura->execute(['numFactura' => $numfactura]);
            $fila = $factura->fetchAll(PDO::FETCH_BOTH);
            
            if ($fila) {

                $r['resultado'] = 'encontro';
                $r['mensaje'] = 'El numero de factura ya existe!';

            }
           
        } catch (Exception $e) {
            $r['resultado'] = 'error';
            $r['mensaje'] =  $e->getMessage();
        }
        return $r;
    }


	

	
}


?>