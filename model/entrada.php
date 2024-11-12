<?php
require_once('conexion.php');

class Entrada extends Conexion{
    
	public function registrar($idproducto,$idproveedor,$cantidad,$precio,$numfactura,$idempleado){
		$r = array();
	
	if (!$this->buscar($numfactura)){
		$co = $this->conecta();
		$co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		try{
			$fecha = date('Y-m-d H:i:s');;


		   $sql="INSERT INTO notaentrada(
			fechaEntrada,
			numFactura,
			clProveedor,
			clEmpleado
			) VALUES (
			'$fecha',
			'$numfactura',
			'$idproveedor',
			'$idempleado'	
		)";
		   $guarda = $co->query($sql);
			$lid = $co->lastInsertId();

			$tamano = count($idproducto);

for($i=0; $i<$tamano; $i++){
    $sql = "INSERT INTO administrarentrada (precioEntrada, cantidadEntrada, clEntrada, clExistencia) 
            VALUES ('$precio[$i]', '$cantidad[$i]', '$lid', '$idproducto[$i]')";
    $co->query($sql);
}



	// Obtener las cantidades de existencia actuales
	$exist = $co->query("SELECT clExistencia, cantidadExistencia FROM existencia");
	$existencias = [];
	while ($row = $exist->fetch(PDO::FETCH_ASSOC)) {
		$existencias[$row['clExistencia']] = $row['cantidadExistencia'];
	}

	for($i=0; $i<$tamano; $i++){
		$idProd = $idproducto[$i];
		$cantidadActual = isset($existencias[$idProd]) ? $existencias[$idProd] : 0;
		$Total = $cantidadActual + $cantidad[$i];

		$co->query("UPDATE existencia SET cantidadExistencia = $Total WHERE clExistencia = $idProd");
	}

	$r['resultado'] = 'registrar';
	$r['mensaje'] = 'Registro Incluido!<br/> Se registró la nota de entrada correctamente';

	} catch(Exception $e) {
		$r['resultado'] = 'error';
		$r['mensaje'] = $e->getMessage();
	}
}else {
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

            $stmt = $co->prepare("SELECT * FROM notaentrada WHERE numFactura = :numFactura");
            $stmt->execute(['numFactura' => $numfactura]);
            $fila = $stmt->fetchAll(PDO::FETCH_BOTH);
            
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