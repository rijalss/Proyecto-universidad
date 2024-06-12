<?php

require_once('model/conexion.php');


class Proveedor extends Conexion
{

    private $rifProveedor;
    private $nombreProveedor;
    private $telefonoProveedor;
    private $correoProveedor;
    private $direccionProveedor;

    //////////////////////////SET//////////////////////////

    function set_rifProveedor($valor)
    {
        $this->rifProveedor = $valor;
    }

    function set_nombreProveedor($valor)
    {
        $this->nombreProveedor = $valor;
    }

    function set_telefonoProveedor($valor)
    {
        $this->telefonoProveedor = $valor;
    }

    function set_correoProveedor($valor)
    {
        $this->correoProveedor = $valor;
    }

    function set_direccionProveedor($valor)
    {
        $this->direccionProveedor = $valor;
    }

    //////////////////////////GET//////////////////////////

    function get_rifProveedor()
    {
        return $this->rifProveedor;
    }

    function get_nombreProveedor()
    {
        return $this->nombreProveedor;
    }

    function get_telefonoProveedor()
    {
        return $this->telefonoProveedor;
    }

    function get_correoProveedor()
    {
        return $this->correoProveedor;
    }

    function get_direccionProveedor()
    {
        return $this->direccionProveedor;
    }

    //////////////////////////METODOS//////////////////////////

    function incluir()
    {

        if (!$this->existe($this->rifProveedor)) {
            //1 Se llama a la funcion conecta 
            $co = $this->conecta();
            $co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //2 Se ejecuta el sql
            $r = array();
            try {

                $p = $co->prepare("Insert into proveedor(
						rifProveedor,
						nombreProveedor,
						telefonoProveedor,
						correoProveedor,
						direccionProveedor
						)
						Values(
						:rifProveedor,
						:nombreProveedor,
						:telefonoProveedor,
						:correoProveedor,
						:direccionProveedor
						)");
                $p->bindParam(':rifProveedor', $this->rifProveedor);
                $p->bindParam(':nombreProveedor', $this->nombreProveedor);
                $p->bindParam(':telefonoProveedor', $this->telefonoProveedor);
                $p->bindParam(':correoProveedor', $this->correoProveedor);
                $p->bindParam(':direccionProveedor', $this->direccionProveedor);

                $p->execute();

                $r['resultado'] = 'incluir';
                $r['mensaje'] =  'Registro Inluido';
            } catch (Exception $e) {
                $r['resultado'] = 'error';
                $r['mensaje'] =  $e->getMessage();
            }
        } else {
            $r['resultado'] = 'incluir';
            $r['mensaje'] =  'Ya existe el proveedor';
        }

        return $r;
    }

    function modificar()
    {
        $co = $this->conecta();
        $co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $r = array();
        if ($this->existe($this->rifProveedor)) {
            try {
                /**
				$aux = "Update proveedor set 
						nombreProveedor = $this->nombreProveedor,
						telefonoProveedor = $this->telefonoProveedor,
						correoProveedor = $this->correoProveedor,
						direccionProveedor = $this->direccionProveedor,
						where
						rifProveedor = $this->rifProveedor";
				echo $aux;
				exit;
                 **/
                $p = $co->prepare("Update proveedor set 
						nombreProveedor = :nombreProveedor,
						telefonoProveedor = :telefonoProveedor,
						correoProveedor = :correoProveedor,
						direccionProveedor = :direccionProveedor
						where
						rifProveedor = :rifProveedor
						");
                $p->bindParam(':rifProveedor', $this->rifProveedor);
                $p->bindParam(':nombreProveedor', $this->nombreProveedor);
                $p->bindParam(':telefonoProveedor', $this->telefonoProveedor);
                $p->bindParam(':correoProveedor', $this->correoProveedor);
                $p->bindParam(':direccionProveedor', $this->direccionProveedor);

                $p->execute();

                $r['resultado'] = 'modificar';
                $r['mensaje'] =  'Registro Modificado';
            } catch (Exception $e) {
                $r['resultado'] = 'error';
                $r['mensaje'] =  $e->getMessage();
            }
        } else {
            $r['resultado'] = 'modificar';
            $r['mensaje'] =  'No existe el rif del Proveedor';
        }
        return $r;
    }

    function eliminar()
    {
        $co = $this->conecta();
        $co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $r = array();
        if ($this->existe($this->rifProveedor)) {
            try {
                $p = $co->prepare("DELETE FROM proveedor 
					    WHERE rifProveedor = :rifProveedor
						");
                $p->bindParam(':rifProveedor', $this->rifProveedor);


                $p->execute();
                $r['resultado'] = 'eliminar';
                $r['mensaje'] =  'Registro Eliminado';
            } catch (Exception $e) {
                $r['resultado'] = 'error';
                $r['mensaje'] =  $e->getMessage();
            }
        } else {
            $r['resultado'] = 'eliminar';
            $r['mensaje'] =  'No existe la rifProveedor';
        }
        return $r;
    }


    function consultar()
    {
        $co = $this->conecta();
        $co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $r = array();
        try {

            $resultado = $co->query("SELECT * FROM proveedor");

            if ($resultado) {

                $respuesta = '';
                foreach ($resultado as $r) {
                    $respuesta = $respuesta . "<tr style='cursor:pointer' onclick='coloca(this);'>";
                    $respuesta = $respuesta . "<td>";
                    $respuesta = $respuesta . $r['rifProveedor'];
                    $respuesta = $respuesta . "</td>";
                    $respuesta = $respuesta . "<td>";
                    $respuesta = $respuesta . $r['nombreProveedor'];
                    $respuesta = $respuesta . "</td>";
                    $respuesta = $respuesta . "<td>";
                    $respuesta = $respuesta . $r['telefonoProveedor'];
                    $respuesta = $respuesta . "</td>";
                    $respuesta = $respuesta . "<td>";
                    $respuesta = $respuesta . $r['correoProveedor'];
                    $respuesta = $respuesta . "</td>";
                    $respuesta = $respuesta . "<td>";
                    $respuesta = $respuesta . $r['direccionProveedor'];
                    $respuesta = $respuesta . "</td>";
                    $respuesta = $respuesta . "</tr>";
                }
                $r['resultado'] = 'consultar';
                $r['mensaje'] =  $respuesta;
            } else {
                $r['resultado'] = 'consultar';
                $r['mensaje'] =  '';
            }
        } catch (Exception $e) {
            $r['resultado'] = 'error';
            $r['mensaje'] =  $e->getMessage();
        }
        return $r;
    }


    private function existe($rifProveedor)
    {
        $co = $this->conecta();
        $co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        try {

            $resultado = $co->query("SELECT * FROM proveedor WHERE rifProveedor='$rifProveedor'");


            $fila = $resultado->fetchAll(PDO::FETCH_BOTH);
            if ($fila) {

                return true;
            } else {

                return false;;
            }
        } catch (Exception $e) {
            return false;
        }
    }

    function consultatr()
    {
        $co = $this->conecta();
        $co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $r = array();
        try {

            $stmt = $co->prepare("SELECT * FROM proveedor WHERE rifProveedor = :rifProveedor");
            $stmt->execute(['rifProveedor' => $this->rifProveedor]);
            $fila = $stmt->fetchAll(PDO::FETCH_BOTH);
            if ($fila) {

                $r['resultado'] = 'encontro';
                $r['mensaje'] =  $fila;
            } else {

                $r['resultado'] = 'noencontro';
                $r['mensaje'] =  '';
            }
        } catch (Exception $e) {
            $r['resultado'] = 'error';
            $r['mensaje'] =  $e->getMessage();
        }
        return $r;
    }
}
