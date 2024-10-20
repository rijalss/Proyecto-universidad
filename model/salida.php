<?php

require_once('conexion.php');

class Salida extends Conexion{

	function registrar($idproducto, $cantidad, $precio, $idempleado)
	{
		$co = $this->conecta();
		$co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$r = array('mensaje' => '');

		$exist = $co->query("SELECT clExistencia, cantidadExistencia, nombreProducto FROM existencia INNER JOIN producto ON existencia.clExistencia = producto.clProducto");
		$existencias = [];

		while ($row = $exist->fetch(PDO::FETCH_ASSOC)) {
			$existencias[$row['clExistencia']] = [
				'cantidad' => $row['cantidadExistencia'],
				'nombre' => $row['nombreProducto']
			];
		}

		$errores = [];
		$alertas = [];

		//validar que todos los productos tengan suficientes existencias
		for ($i = 0; $i < count($idproducto); $i++) {
			$idProd = $idproducto[$i];
			$cantidadActual = isset($existencias[$idProd]['cantidad']) ? $existencias[$idProd]['cantidad'] : 0;
			$nombreProd = isset($existencias[$idProd]['nombre']) ? $existencias[$idProd]['nombre'] : "Desconocido";
			$Total = $cantidadActual - $cantidad[$i];

			// Verificación de cantidad
			if ($Total < 0) {
				$errores[] = "Error: No se puede restar más de las existencias disponibles para el producto '$nombreProd'.<br/>";
			}

			// Alertas
			if ($Total == 0) {
				$alertas[] = "Alerta: La existencia del producto '$nombreProd' ha quedado en cero.<br/>";
			} elseif ($Total <= 10) {
				$alertas[] = "Alerta: La existencia del producto '$nombreProd' es igual o menor a 10.<br/>";
			}
		}

		if (!empty($errores)) {
			$r['resultado'] = 'error';
			$r['mensaje'] .= implode("\n", $errores); 

			if (!empty($alertas)) {
				$r['mensaje'] .= "\n" . implode("\n", $alertas); 
			}

			return $r;
		}

		try {
			$fecha = date('Y-m-d');
			$sql = "INSERT INTO notasalida (fechaSalida, clEmpleado) VALUES ('$fecha', '$idempleado')";
			$guarda = $co->query($sql);
			$lid = $co->lastInsertId();

			for ($i = 0; $i < count($idproducto); $i++) {
				$idProd = $idproducto[$i];
				$cantidadActual = isset($existencias[$idProd]['cantidad']) ? $existencias[$idProd]['cantidad'] : 0;
				$Total = $cantidadActual - $cantidad[$i];

				$sql = "INSERT INTO administrarsalida (precioSalida, cantidadSalida, clSalida, clExistencia) 
                    VALUES ('{$precio[$i]}', '{$cantidad[$i]}', '$lid', '$idproducto[$i]')";
				$co->query($sql);

				$co->query("UPDATE existencia SET cantidadExistencia = $Total WHERE clExistencia = $idProd");
			}

			if (!empty($alertas)) {
				$r['mensaje'] .= implode("\n", $alertas); 
			}

			$r['resultado'] = 'registrar';
			$r['mensaje'] .= "Operación completada correctamente."; 
		} catch (Exception $e) {
			$r['resultado'] = 'error';
			$r['mensaje'] = $e->getMessage();
		}

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
			
			$resultado = $co->query("SELECT * FROM producto p JOIN existencia e on p.clProducto = e.clProducto ");
			
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
						$respuesta = $respuesta."<td>";
							$respuesta = $respuesta.$r['cantidadExistencia'];
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
	
	/*public function existe($clProducto,$cantidad){
        $co = $this->conecta();
        $co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $r = array();
        try {

			$tamano = count($clProducto);
        	$exist = $co->query("SELECT clExistencia, cantidadExistencia FROM existencia");
			$existencias = [];
			while ($row = $exist->fetch(PDO::FETCH_ASSOC)) {
				$existencias[$row['clExistencia']] = $row['cantidadExistencia'];
			}

			$alertas = [];

			for($i=0; $i<$tamano; $i++){
				$idProd = $clProducto[$i];
				$cantidadActual = isset($existencias[$idProd]) ? $existencias[$idProd] : 0;
				$Total = $cantidadActual - $cantidad[$i];

				if ($Total < 0) {
			
				$r['resultado'] = 'encontro';
				$r['mensaje'] = "Error: No se puede restar más de las existencias disponibles para el producto ID $idProd.";
				continue;
				}
				/*
				if ($Total == 0) {
				$alertas[] = "Alerta: La existencia del producto ID $idProd ha quedado en cero.";
			
				}

				if ($Total <= 10   ) {
					$alertas[] = "Alerta: La existencia del producto ID $idProd es igual o menor a 10.";				
				}*/

           /* if ($fila) {
                $r['resultado'] = 'existe';
                $r['mensaje'] = 'El código de producto ya existe!';
            } 
		}} catch (Exception $e) {
            $r['resultado'] = 'error';
            $r['mensaje'] =  $e->getMessage();
        }
        return $r;
    }
*/

	
	
	
}
?>