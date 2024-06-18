<?php

require_once('conexion.php');


class Producto extends Conexion
{
    private $codProducto;
    private $nombreProducto;
    private $precio;
    private $descProducto;

    //////////////////////////SET//////////////////////////
    function set_codProducto($valor)
    {
        $this->codProducto = $valor;
    }

    function set_nombreProducto($valor)
    {
        $this->nombreProducto = $valor;
    }

    function set_precio($valor)
    {
        $this->precio = $valor;
    }

    function set_descProducto($valor)
    {
        $this->descProducto = $valor;
    }

    //////////////////////////GET//////////////////////////

    function get_codProducto()
    {
        return $this->codProducto;
    }

    function get_nombreProducto()
    {
        return $this->nombreProducto;
    }

    function get_precio()
    {
        return $this->precio;
    }

    function get_descProducto()
    {
        return $this->descProducto;
    }


    //////////////////////////METODOS//////////////////////////

    function incluir()
    {
        $r = array();

        if (!$this->existe($this->codProducto)) {
            //1 Se llama a la funcion conecta 
            $co = $this->conecta();
            $co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //2 Se ejecuta el sql
            try {
                $co->query("INSERT INTO producto(
                    codProducto,
                    nombreProducto,
                    precio,
                    descProducto
                    ) VALUES (
                    '$this->codProducto',
                    '$this->nombreProducto',
                    '$this->precio',
                    '$this->descProducto'
                    )");
                $r['resultado'] = 'incluir';
                $r['mensaje'] = 'Registro Incluido!<br/> Se incluyó el producto correctamente';
            } catch (Exception $e) {
                $r['resultado'] = 'error';
                $r['mensaje'] = $e->getMessage();
            }
        } else {
            $r['resultado'] = 'incluir';
            $r['mensaje'] = 'ERROR! <br/> El código colocado ya existe!';
        }
        return $r;
    }

    function modificar()
    {
        $co = $this->conecta();
        $co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $r = array();

        if ($this->existe($this->codProducto)) {
            try {
                $p = $co->prepare("UPDATE producto SET 
                nombreProducto = :nombreProducto,
                precio = :precio,
                descProducto = :descProducto
                WHERE producto.codProducto = :codProducto
                ");

                $p->bindParam(':codProducto', $this->codProducto);
                $p->bindParam(':nombreProducto', $this->nombreProducto);
                $p->bindParam(':precio', $this->precio);
                $p->bindParam(':descProducto', $this->descProducto);
                $p->execute();

                $r['resultado'] = 'modificar';
                $r['mensaje'] = 'Registro Modificado!<br/> Se modificó el producto correctamente';
            } catch (Exception $e) {
                $r['resultado'] = 'error';
                $r['mensaje'] = $e->getMessage();
            }
        } else {
            $r['resultado'] = 'modificar';
            $r['mensaje'] = 'No existe el codigo del producto';
        }

        return $r;
    }


    function eliminar()
    {
        $co = $this->conecta();
        $co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $r = array();
        if ($this->existe($this->codProducto)) {
            try {
                $p = $co->prepare("DELETE from producto 
					    WHERE
						codProducto = :codProducto
						");
                $p->bindParam(':codProducto', $this->codProducto);


                $p->execute();
                $r['resultado'] = 'eliminar';
                $r['mensaje'] =  'Registro Eliminado! <br/> Se eliminó el producto correctamente';
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

            $resultado = $co->query("SELECT * FROM producto");

            if ($resultado) {

                $respuesta = '';
                foreach ($resultado as $r) {
                    $respuesta = $respuesta . "<tr>";
                    $respuesta = $respuesta . "<td>";
                    $respuesta = $respuesta . $r['codProducto'];
                    $respuesta = $respuesta . "</td>";
                    $respuesta = $respuesta . "<td>";
                    $respuesta = $respuesta . $r['nombreProducto'];
                    $respuesta = $respuesta . "</td>";
                    $respuesta = $respuesta . "<td>";
                    $respuesta = $respuesta . $r['precio'];
                    $respuesta = $respuesta . "</td>";
                    $respuesta = $respuesta . "<td>";
                    $respuesta = $respuesta . $r['descProducto'];
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


    private function existe($codProducto)
    {
        $co = $this->conecta();
        $co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        try {

            $resultado = $co->query("SELECT * FROM producto WHERE codProducto='$codProducto'");


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

    // function consultatr()
    // {
    //     $co = $this->conecta();
    //     $co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //     $r = array();
    //     try {

    //         $stmt = $co->prepare("SELECT producto.*, categoria.nombreCategoria 
    //                             FROM producto 
    //                             INNER JOIN categoria 
    //                             ON producto.clCategoria = categoria.clCategoria 
    //                             WHERE producto.codProducto = :codProducto");
    //         $stmt->execute(['codProducto' => $this->codProducto]);
    //         $fila = $stmt->fetchAll(PDO::FETCH_BOTH);
    //         if ($fila) {

    //             $r['resultado'] = 'encontro';
    //             $r['mensaje'] = $fila;
    //         } else {

    //             $r['resultado'] = 'noencontro';
    //             $r['mensaje'] =  '';
    //         }
    //     } catch (Exception $e) {
    //         $r['resultado'] = 'error';
    //         $r['mensaje'] =  $e->getMessage();
    //     }
    //     return $r;
    // }

    // CATEGORIAS

    function obtenerCategorias()
    {
        $co = $this->conecta();
        $co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $p = $co->prepare("SELECT * FROM categoria");
        $p->execute();
        $r = $p->fetchAll(PDO::FETCH_ASSOC);
        return $r;
    }
}
