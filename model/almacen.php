<?php

require_once('conexion.php');


class Almacen extends Conexion
{

    private $clAlmacen;
    private $nombreAlmacen;
    private $direccionAlmacen;
    private $clArea;
    private $nombreArea;
       

    //SETTERS

    public function set_clAlmacen($clAlmacen)
    {
        $this->clAlmacen = $clAlmacen;
    }

    public function set_nombreAlmacen($nombreAlmacen)
    {
        $this->nombreAlmacen = $nombreAlmacen;
    }

    function set_direccionAlmacen($direccionAlmacen)
    {
        $this->direccionAlmacen = $direccionAlmacen;
    }

    function set_clArea($clArea)
    {
        $this->clArea = $clArea;
    }

    function set_nombreArea($nombreArea)
    {
        $this->nombreArea = $nombreArea;
    }

    // GETTERS

    function get_clAlmacen()
    {
        return $this->clAlmacen;
    }

    function get_nombreAlmacen()
    {
        return $this->nombreAlmacen;
    }

    function get_direccionAlmacen()
    {
        return $this->direccionAlmacen;
    }

    function get_clArea()
    {
        return $this->clArea;
    }

    function get_nombreArea()
    {
        return $this->nombreArea;
    }

    function incluir()
    {

        if (!$this->existe($this->nombreAlmacen)) {
            //1 Se llama a la funcion conecta 
            $co = $this->conecta();
            $co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //2 Se ejecuta el sql
            $r = array();
            try {

                $p = $co->prepare("INSERT INTO almacen(
						nombreAlmacen,
						direccionAlmacen
						)
						VALUES(
                        :nombreAlmacen,
						:direccionAlmacen
						)");
                $p->bindParam(':nombreAlmacen', $this->nombreAlmacen);
                $p->bindParam(':direccionAlmacen', $this->direccionAlmacen);
               

                $p->execute();

                $r['resultado'] = 'incluir';
                $r['mensaje'] =  'Registro Inluido';
            } catch (Exception $e) {
                $r['resultado'] = 'error';
                $r['mensaje'] =  $e->getMessage();
            }
        } else {
            $r['resultado'] = 'incluir';
            $r['mensaje'] =  'Ya existe el producto';
        }

        return $r;
    }

    function modificar()
    {
        $co = $this->conecta();
        $co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $r = array();

        if ($this->existe($this->nombreAlmacen)) {
            try {
                $p = $co->prepare("UPDATE almacen
                                SET nombreAlmacen = :nombreAlmacen,
                                direccionAlmacen = :direccionAlmacen,
                                WHERE almacen.nombreAlmacen = :nombreAlmacen");

                $p->bindParam(':nombreAlmacen', $this->nombreAlmacen);
                $p->bindParam(':direccionAlmacen', $this->direccionAlmacen);
               
                $p->execute();

                $r['resultado'] = 'modificar';
                $r['mensaje'] = 'Registro Modificado';
            } catch (Exception $e) {
                $r['resultado'] = 'error';
                $r['mensaje'] = $e->getMessage();
            }
        } else {
            $r['resultado'] = 'modificar';
            $r['mensaje'] = 'No existe el almacen';
        }

        return $r;
    }


    function eliminar()
    {
        $co = $this->conecta();
        $co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $r = array();
        if ($this->existe($this->nombreAlmacen)) {
            try {
                $p = $co->prepare("DELETE FROM almacen 
					    WHERE
						nombreAlmacen = :nombreAlmacen");

                $p->bindParam(':nombreAlmacen', $this->nombreAlmacen);

                $p->execute();
                $r['resultado'] = 'eliminar';
                $r['mensaje'] =  'Registro Eliminado';
            } catch (Exception $e) {
                $r['resultado'] = 'error';
                $r['mensaje'] =  $e->getMessage();
            }
        } else {
            $r['resultado'] = 'eliminar';
            $r['mensaje'] =  'No existe el codigo del producto';
        }
        return $r;
    }


    function consultar()
    {
        $co = $this->conecta();
        $co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $r = array();
        try {

            $resultado = $co->query("SELECT * FROM almacen");

            if ($resultado) {

                $respuesta = '';
                foreach ($resultado as $r) {
                    $respuesta = $respuesta . "<tr style='cursor:pointer' onclick='coloca(this);'>";
                    $respuesta = $respuesta . "<td>";
                    $respuesta = $respuesta . $r['nombreAlmacen'];
                    $respuesta = $respuesta . "</td>";
                    $respuesta = $respuesta . "<td>";
                    $respuesta = $respuesta . $r['direccionAlmacen'];
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


    private function existe($nombreAlmacen)
    {
        $co = $this->conecta();
        $co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        try {

            $resultado = $co->query("SELECT * FROM almacen WHERE nombreAlmacen='$nombreAlmacen'");


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

            $stmt = $co->prepare("SELECT * FROM almacen WHERE nombreAlmacen = :nombreAlmacen");
            $stmt->execute(['nombreAlmacen' => $this->nombreAlmacen]);
            $fila = $stmt->fetchAll(PDO::FETCH_BOTH);
            if ($fila) {

                $r['resultado'] = 'encontro';
                $r['mensaje'] = $fila;
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

    // CATEGORIAS

    public function obtenerAlmacen()
    {
        $co = $this->conecta();
        $co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $p = $co->prepare("SELECT * FROM almacen");
        $p->execute();
        $r = $p->fetchAll(PDO::FETCH_ASSOC);
        return $r;
    }

    function incluirArea()
    {

        if (!$this->existeArea($this->nombreArea)) {
            //1 Se llama a la funcion conecta 
            $co = $this->conecta();
            $co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //2 Se ejecuta el sql
            $r = array();
            try {

                $p = $co->prepare("INSERT INTO area(
						nombreArea,
                        clAlmacen
						)
						VALUES(
						:nombreArea,
                        :clAlmacen
						)");
                $p->bindParam(':nombreArea', $this->nombreArea);
                $p->bindParam(':clAlmacen', $this->clAlmacen); 

                $p->execute();

                $r['resultado'] = 'incluirArea';
                $r['mensaje'] =  'Registro Inluido';
            } catch (Exception $e) {
                $r['resultado'] = 'error';
                $r['mensaje'] =  $e->getMessage();
            }
        } else {
            $r['resultado'] = 'incluirArea';
            $r['mensaje'] =  'El area ya existe';
        }

        return $r;
    }

    function eliminarArea()
    {
        $co = $this->conecta();
        $co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $r = array();
        if ($this->existeArea($this->nombreArea)) {
            try {
                $p = $co->prepare("DELETE FROM area 
					    WHERE
						nombreArea = :nombreArea
						");
                $p->bindParam(':nombreArea', $this->nombreArea);


                $p->execute();
                $r['resultado'] = 'eliminarArea';
                $r['mensaje'] =  'Area Eliminada';
            } catch (Exception $e) {
                $r['resultado'] = 'error';
                $r['mensaje'] =  $e->getMessage();
            }
        } else {
            $r['resultado'] = 'eliminarArea';
            $r['mensaje'] =  'El area no existe';
        }
        return $r;
    }

    private function existeArea($nombreArea)
    {
        $co = $this->conecta();
        $co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        try {

            $resultado = $co->query("SELECT * FROM area WHERE nombreArea='$nombreArea'");


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