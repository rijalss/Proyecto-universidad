<?php

require_once('conexion.php');


class Almacen extends Conexion{

    private $codAlmacen;
    private $nombreAlmacen;
    private $direccionAlmacen;
       

    //SETTERS

    public function set_codAlmacen($codAlmacen)
    {
        $this->codAlmacen = $codAlmacen;
    }

    public function set_nombreAlmacen($nombreAlmacen)
    {
        $this->nombreAlmacen = $nombreAlmacen;
    }

    function set_direccionAlmacen($direccionAlmacen)
    {
        $this->direccionAlmacen = $direccionAlmacen;
    }

    // function set_clArea($clArea)
    // {
    //     $this->clArea = $clArea;
    // }

    // function set_nombreArea($nombreArea)
    // {
    //     $this->nombreArea = $nombreArea;
    // }

    // GETTERS

    function get_codAlmacen()
    {
        return $this->codAlmacen;
    }

    function get_nombreAlmacen()
    {
        return $this->nombreAlmacen;
    }

    function get_direccionAlmacen()
    {
        return $this->direccionAlmacen;
    }

    // function get_clArea()
    // {
    //     return $this->clArea;
    // }

    // function get_nombreArea()
    // {
    //     return $this->nombreArea;
    // }

    function incluir(){
        $r = array();

        if (!$this->existe($this->codAlmacen)) {
            //1 Se llama a la funcion conecta 
            $co = $this->conecta();
            $co->setAttribute(PDO::ATTR_ERRMODE,
                PDO::ERRMODE_EXCEPTION
            );
            //2 Se ejecuta el sql
            try {
                $co->query("INSERT INTO almacen(
                    codAlmacen,
                    nombreAlmacen,
                    direccionAlmacen
                    ) VALUES (
                    '$this->codAlmacen',
                    '$this->nombreAlmacen',
                    '$this->direccionAlmacen'
                    )");
                $r['resultado'] = 'incluir';
                $r['mensaje'] = 'Registro Incluido!<br/> Se incluyó el Almacén correctamente';
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
        if ($this->existe($this->codAlmacen)) {
            try {
                $co->query("UPDATE almacen 
                SET nombreAlmacen = '$this->nombreAlmacen',
                direccionAlmacen = '$this->direccionAlmacen'
                WHERE codAlmacen = '$this->codAlmacen'
                ");
                $r['resultado'] = 'modificar';
                $r['mensaje'] =  'Registro Modificado!<br/> Se modificó el Almacén correctamente';
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
        if ($this->existe($this->codAlmacen)) {
            try {
                $p = $co->prepare("DELETE from almacen 
					    WHERE
						codAlmacen = :codAlmacen
						");
                $p->bindParam(':codAlmacen', $this->codAlmacen);


                $p->execute();
                $r['resultado'] = 'eliminar';
                $r['mensaje'] =  'Registro Eliminado! <br/> Se eliminó el Almacén correctamente';
            } catch (Exception $e) {
                $r['resultado'] = 'error';
                $r['mensaje'] =  $e->getMessage();
            }
        } else {
            $r['resultado'] = 'eliminar';
            $r['mensaje'] =  'No existe el codigo del Almácen';
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
                    $respuesta = $respuesta . "<tr>";
                    $respuesta = $respuesta . "<td>";
                    $respuesta = $respuesta . $r['codAlmacen'];
                    $respuesta = $respuesta . "</td>";
                    $respuesta = $respuesta . "<td>";
                    $respuesta = $respuesta . $r['nombreAlmacen'];
                    $respuesta = $respuesta . "</td>";
                    $respuesta = $respuesta . "<td>";
                    $respuesta = $respuesta . $r['direccionAlmacen'];
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


    private function existe($codAlmacen)
    {
        $co = $this->conecta();
        $co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        try {

            $resultado = $co->query("SELECT * FROM almacen WHERE codAlmacen='$codAlmacen'");


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


    public function obtenerAlmacen(){
        $co = $this->conecta();
        $co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $p = $co->prepare("SELECT * FROM almacen");
        $p->execute();
        $r = $p->fetchAll(PDO::FETCH_ASSOC);
        return $r;
    }

    //     if (!$this->existeArea($this->nombreArea)) {
    //         //1 Se llama a la funcion conecta 
    //         $co = $this->conecta();
    //         $co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //         //2 Se ejecuta el sql
    //         $r = array();
    //         try {

    //             $p = $co->prepare("INSERT INTO area(
	// 					nombreArea,
    //                     clAlmacen
	// 					)
	// 					VALUES(
	// 					:nombreArea,
    //                     :clAlmacen
	// 					)");
    //             $p->bindParam(':nombreArea', $this->nombreArea);
    //             $p->bindParam(':clAlmacen', $this->clAlmacen); 

    //             $p->execute();

    //             $r['resultado'] = 'incluirArea';
    //             $r['mensaje'] =  'Registro Inluido';
    //         } catch (Exception $e) {
    //             $r['resultado'] = 'error';
    //             $r['mensaje'] =  $e->getMessage();
    //         }
    //     } else {
    //         $r['resultado'] = 'incluirArea';
    //         $r['mensaje'] =  'El area ya existe';
    //     }

    //     return $r;
    // }

    // function eliminarArea()
    // {
    //     $co = $this->conecta();
    //     $co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //     $r = array();
    //     if ($this->existeArea($this->nombreArea)) {
    //         try {
    //             $p = $co->prepare("DELETE FROM area 
	// 				    WHERE
	// 					nombreArea = :nombreArea
	// 					");
    //             $p->bindParam(':nombreArea', $this->nombreArea);


    //             $p->execute();
    //             $r['resultado'] = 'eliminarArea';
    //             $r['mensaje'] =  'Area Eliminada';
    //         } catch (Exception $e) {
    //             $r['resultado'] = 'error';
    //             $r['mensaje'] =  $e->getMessage();
    //         }
    //     } else {
    //         $r['resultado'] = 'eliminarArea';
    //         $r['mensaje'] =  'El area no existe';
    //     }
    //     return $r;
    // }

    // private function existeArea($nombreArea)
    // {
    //     $co = $this->conecta();
    //     $co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //     try {

    //         $resultado = $co->query("SELECT * FROM area WHERE nombreArea='$nombreArea'");


    //         $fila = $resultado->fetchAll(PDO::FETCH_BOTH);
    //         if ($fila) {

    //             return true;
    //         } else {

    //             return false;;
    //         }
    //     } catch (Exception $e) {
    //         return false;
    //     }
    // }

}