<?php

require_once('model/conexion.php');

class Area extends Conexion
{
    private $codArea;
    private $nombreArea;

    //SETTERS

    function set_codArea($valor)
    {
        $this->codArea = $valor;
    }

    function set_nombreArea($valor)
    {
        $this->nombreArea = $valor;
    }

    //GETTERS

    function get_codArea()
    {
        return $this->codArea;
    }

    function get_nombreArea()
    {
        return $this->nombreArea;
    }



    //METODOS 

    function consultar()
    {
        $conex = $this->conecta();
        $conex->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $r = array();
        try {

            $resultado = $conex->query("SELECT * FROM area");

            if ($resultado) {

                $respuesta = '';
                foreach ($resultado as $r) {
                    $respuesta = $respuesta . "<tr>";
                    $respuesta = $respuesta . "<td>";
                    $respuesta = $respuesta . $r['codArea'];
                    $respuesta = $respuesta . "</td>";
                    $respuesta = $respuesta . "<td>";
                    $respuesta = $respuesta . $r['nombreArea'];
                    $respuesta = $respuesta . "</td>";
                    $respuesta = $respuesta . "<td style='max-width: 140px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;'>";
                    $respuesta = $respuesta . "<div class='d-flex flex-column align-items-center'>";
                    $respuesta = $respuesta . "<button type='button' class='btn btn-warning btn-sm mb-2' style='width: 100px;' onclick='pone(this,0)'>Modificar</button>";
                    $respuesta = $respuesta . "<button type='button' class='btn btn-danger btn-sm' style='width: 100px;' onclick='pone(this,1)'>Eliminar</button>";
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

    function incluir()
    {
        $r = array();

        if (!$this->existe($this->codArea)) {
            
            $conex = $this->conecta();
            $conex->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            try {
                $conex->query("INSERT INTO area(
                    codArea,
                    nombreArea
                    ) VALUES (
                    '$this->codArea',
                    '$this->nombreArea'
                    )");
                $r['resultado'] = 'incluir';
                $r['mensaje'] = 'Registro Incluido!<br/> Se registró el Área correctamente';
            } catch (Exception $e) {
                $r['resultado'] = 'error';
                $r['mensaje'] = $e->getMessage();
            }
        } else {
            $r['resultado'] = 'incluir';
            $r['mensaje'] = 'ERROR! <br/> El CÓDIGO colocado ya existe!';
        }
        return $r;
    }

    function modificar()
    {
        $conex = $this->conecta();
        $conex->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $r = array();
        if ($this->existe($this->codArea)) {
            try {
                $conex->query("UPDATE area 
                SET nombreArea = '$this->nombreArea'
                WHERE codArea = '$this->codArea'
                ");
                $r['resultado'] = 'modificar';
                $r['mensaje'] =  'Registro Modificado!<br/> Se modificó el Área correctamente';
            } catch (Exception $e) {
                $r['resultado'] = 'error';
                $r['mensaje'] =  $e->getMessage();
            }
        } else {
            $r['resultado'] = 'modificar';
            $r['mensaje'] =  'ERROR! <br/> El CÓDIGO colocado NO existe!';
        }
        return $r;
    }


    function eliminar()
    {
        $conex = $this->conecta();
        $conex->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $r = array();
        if ($this->existe($this->codArea)) {
            try {
                $p = $conex->prepare("DELETE from area 
					    WHERE
						codArea = :codArea
						");
                $p->bindParam(':codArea', $this->codArea);
                $p->execute();
                $r['resultado'] = 'eliminar';
                $r['mensaje'] =  'Registro Eliminado! <br/> Se eliminó el Área correctamente';
            } catch (Exception $e) {
                $r['resultado'] = 'error';
                $r['mensaje'] =  $e->getMessage();
            }
        } else {
            $r['resultado'] = 'eliminar';
            $r['mensaje'] =  'No existe el codigo de la área';
        }
        return $r;
    }


   
    private function existe($codArea)
    {
        $conex = $this->conecta();
        $conex->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        try {

            $resultado = $conex->query("SELECT * FROM area WHERE codArea='$codArea'");


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