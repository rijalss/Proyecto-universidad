<?php

require_once('conexion.php');

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
        $r = array();
        if (!$this->existe($this->rifProveedor)) {
            //1 Se llama a la funcion conecta 
            $co = $this->conecta();
            $co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //2 Se ejecuta el sql
            try {
                $co->query("INSERT INTO proveedor(
						rifProveedor,
                        nombreProveedor,
                        telefonoProveedor,
                        correoProveedor,
                        direccionProveedor
						)Values(
						'$this->rifProveedor',
						'$this->nombreProveedor',
						'$this->telefonoProveedor',
						'$this->correoProveedor',
						'$this->direccionProveedor'
						)");
                $r['resultado'] = 'incluir';
                $r['mensaje'] =  'Registro Inluido';
            } catch (Exception $e) {
                $r['resultado'] = 'error';
                $r['mensaje'] =  $e->getMessage();
            }
        } else {
            $r['resultado'] = 'incluir';
            $r['mensaje'] =  'Ya existe el Rif';
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
                $co->query("UPDATE proveedor SET 
					    rifProveedor = '$this->rifProveedor',
						nombreProveedor = '$this->nombreProveedor',
						telefonoProveedor = '$this->telefonoProveedor',
						correoProveedor = '$this->correoProveedor',
						direccionProveedor = '$this->direccionProveedor'
						WHERE
						rifProveedor = '$this->rifProveedor'
						");
                $r['resultado'] = 'modificar';
                $r['mensaje'] =  'Registro Modificado';
            } catch (Exception $e) {
                $r['resultado'] = 'error';
                $r['mensaje'] =  $e->getMessage();
            }
        } else {
            $r['resultado'] = 'modificar';
            $r['mensaje'] =  'Rif no registrado';
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
                $co->query("DELETE FROM proveedor 
						WHERE rifProveedor = '$this->rifProveedor'
						");
                $r['resultado'] = 'eliminar';
                $r['mensaje'] =  'Registro Eliminado';
            } catch (Exception $e) {
                $r['resultado'] = 'error';
                $r['mensaje'] =  $e->getMessage();
            }
        } else {
            $r['resultado'] = 'eliminar';
            $r['mensaje'] =  'No existe el Rif';
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
                    $respuesta = $respuesta . "<tr>";
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
                    $respuesta = $respuesta . "<td>";
                    $respuesta = $respuesta . "<div class='btn-group' role='group'>";
                    $respuesta = $respuesta . "<button type='button'
                        class='btn btn-danger small-width' 
                        onclick='pone(this,0)'
                        >Modificar</button>";
                    $respuesta = $respuesta . "<button type='button'
                        class='btn btn-warning small-width' 
                        onclick='pone(this,1)'
                        >Eliminar</button>";
                    $respuesta = $respuesta . "</div>";
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
}
