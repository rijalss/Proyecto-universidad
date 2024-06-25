<?php

require_once('model/conexion.php');

class Area extends Conexion
{
    private $codArea;
    private $nombreArea;
    private $clAlmacen;
    //////////////////////////SET//////////////////////////

    function set_codArea($valor)
    {
        $this->codArea = $valor;
    }

    function set_nombreArea($valor)
    {
        $this->nombreArea = $valor;
    }

    function set_clAlmacen($valor)
    {
        $this->clAlmacen = $valor;
    }

    //////////////////////////GET//////////////////////////

    function get_codArea()
    {
        return $this->codArea;
    }

    function get_nombreArea()
    {
        return $this->nombreArea;
    }

    function get_clAlmacen()
    {
        return $this->clAlmacen;
    }


    //////////////////////////METODOS//////////////////////////

    function incluir()
    {
        $r = array();

        if (!$this->existe($this->codArea)) {
            //1 Se llama a la funcion conecta 
            $co = $this->conecta();
            $co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //2 Se ejecuta el sql
            try {
                $co->query("INSERT INTO area(
                    codArea,
                    nombreArea,
                    clAlmacen
                    ) VALUES (
                    '$this->codArea',
                    '$this->nombreArea',
                    '$this->clAlmacen'
                    )");
                $r['resultado'] = 'incluir';
                $r['mensaje'] = 'Registro Incluido!<br/> Se incluyó el Área correctamente';
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
        $co = $this->conecta();
        $co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $r = array();
        if ($this->existe($this->codArea)) {
            try {
                $co->query("UPDATE area 
                SET nombreArea = '$this->nombreArea',
                clAlmacen = '$this->clAlmacen'
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
        $co = $this->conecta();
        $co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $r = array();
        if ($this->existe($this->codArea)) {
            try {
                $p = $co->prepare("DELETE from area 
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


    function consultar()
    {
        $co = $this->conecta();
        $co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $r = array();
        try {

            $resultado = $co->query("SELECT a.codArea, a.nombreArea, al.nombreAlmacen
                FROM area a
                JOIN almacen al ON a.clAlmacen =al.clAlmacen");

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
                    $respuesta = $respuesta . "<td>";
                    $respuesta = $respuesta . $r['nombreAlmacen'];
                    $respuesta = $respuesta . "</td>";
                    $respuesta = $respuesta . "<td style='max-width: 140px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;'>";
                    $respuesta = $respuesta . "<button type='button'
                    class='btn btn-warning small-width d-inline-block mr-1' 
                    onclick='pone(this,0)'
                    style='margin-right: 5px;'
                    >Modificar</button>";
                    $respuesta = $respuesta . "<button type='button'
                    class='btn btn-danger small-width d-inline-block' 
                    onclick='pone(this,1)'
                    >Eliminar</button>";
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


    private function existe($codArea)
    {
        $co = $this->conecta();
        $co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        try {

            $resultado = $co->query("SELECT * FROM area WHERE codArea='$codArea'");


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

        /*public function obtenerCategoria(){
        $co = $this->conecta();
        $co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        try {
            $p = $co->prepare("SELECT * FROM categoria");
            $p->execute();
            $r = $p->fetchAll(PDO::FETCH_ASSOC);
            return $r;
        } catch (Exception $e) {
            return []; 
        }
    }*/
}