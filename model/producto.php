<?php

require_once('conexion.php');


class producto extends Conexion
{

    private $codProducto;
    private $nombreProducto;
    private $precio;
    private $descProducto;
    private $clCategoria;
    private $nombreCategoria;

    //////////////////////////SET//////////////////////////

    public function get_nombreCategoria()
    {
        return $this->nombreCategoria;
    }

    public function get_clCategoria()
    {
        return $this->clCategoria;
    }

    public function set_nombreCategoria($nombreCategoria)
    {
        $this->nombreCategoria = $nombreCategoria;
    }

    public function set_clCategoria($clCategoria)
    {
        $this->clCategoria = $clCategoria;
    }

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

        if (!$this->existe($this->codProducto)) {
            //1 Se llama a la funcion conecta 
            $co = $this->conecta();
            $co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //2 Se ejecuta el sql
            $r = array();
            try {

                $p = $co->prepare("INSERT INTO producto(
						codProducto,
						nombreProducto,
						precio,
						descProducto,
                        clCategoria
						)
						VALUES(
						:codProducto,
						:nombreProducto,
						:precio,
						:descProducto,
                        :clCategoria
						)");
                $p->bindParam(':codProducto', $this->codProducto);
                $p->bindParam(':nombreProducto', $this->nombreProducto);
                $p->bindParam(':precio', $this->precio);
                $p->bindParam(':descProducto', $this->descProducto);
                $p->bindParam(':clCategoria', $this->clCategoria);

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

        if ($this->existe($this->codProducto)) {
            try {
                $p = $co->prepare("UPDATE producto SET 
        nombreProducto = :nombreProducto,
        precio = :precio,
        descProducto = :descProducto,
        clCategoria = :clCategoria
        WHERE producto.codProducto = :codProducto
      ");
                $p->bindParam(':codProducto', $this->codProducto);
                $p->bindParam(':nombreProducto', $this->nombreProducto);
                $p->bindParam(':precio', $this->precio);
                $p->bindParam(':descProducto', $this->descProducto);
                $p->bindParam(':clCategoria', $this->clCategoria);


                $p->execute();

                $r['resultado'] = 'modificar';
                $r['mensaje'] = 'Registro Modificado';
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

            $resultado = $co->query("SELECT p.codProducto, p.nombreProducto, p.precio, p.descProducto, p.clCategoria, c.nombreCategoria
            FROM producto p
            JOIN categoria c ON p.clCategoria = c.clCategoria");

            if ($resultado) {

                $respuesta = '';
                foreach ($resultado as $r) {
                    $respuesta = $respuesta . "<tr style='cursor:pointer' onclick='coloca(this);'>";
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
                    $respuesta = $respuesta . "<td>";
                    $respuesta = $respuesta . $r['nombreCategoria'];
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

    function consultatr()
    {
        $co = $this->conecta();
        $co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $r = array();
        try {

            $stmt = $co->prepare("SELECT producto.*, categoria.nombreCategoria 
                                FROM producto 
                                INNER JOIN categoria 
                                ON producto.clCategoria = categoria.clCategoria 
                                WHERE producto.codProducto = :codProducto");
            $stmt->execute(['codProducto' => $this->codProducto]);
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

    public function obtenerCategorias()
    {
        $co = $this->conecta();
        $co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $p = $co->prepare("SELECT * FROM categoria");
        $p->execute();
        $r = $p->fetchAll(PDO::FETCH_ASSOC);
        return $r;
    }

    function incluirCategoria()
    {

        if (!$this->existeCategoria($this->nombreCategoria)) {
            //1 Se llama a la funcion conecta 
            $co = $this->conecta();
            $co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //2 Se ejecuta el sql
            $r = array();
            try {

                $p = $co->prepare("INSERT INTO categoria(
                        nombreCategoria
						)
						VALUES(
                        :nombreCategoria
						)");
                $p->bindParam(':nombreCategoria', $this->nombreCategoria);

                $p->execute();

                $r['resultado'] = 'incluirCategoria';
                $r['mensaje'] =  'Registro Inluido';
            } catch (Exception $e) {
                $r['resultado'] = 'error';
                $r['mensaje'] =  $e->getMessage();
            }
        } else {
            $r['resultado'] = 'incluirCategoria';
            $r['mensaje'] =  'Ya existe la categoria';
        }

        return $r;
    }

    function eliminarCategoria()
    {
        $co = $this->conecta();
        $co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $r = array();
        if ($this->existeCategoria($this->nombreCategoria)) {
            try {
                $p = $co->prepare("DELETE FROM categoria 
					    WHERE
						nombreCategoria = :nombreCategoria
						");
                $p->bindParam(':nombreCategoria', $this->nombreCategoria);


                $p->execute();
                $r['resultado'] = 'eliminarCategoria';
                $r['mensaje'] =  'Categoria Eliminada';
            } catch (Exception $e) {
                $r['resultado'] = 'error';
                $r['mensaje'] =  $e->getMessage();
            }
        } else {
            $r['resultado'] = 'eliminarCategoria';
            $r['mensaje'] =  'No existe la categoria';
        }
        return $r;
    }

    private function existeCategoria($nombreCategoria)
    {
        $co = $this->conecta();
        $co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        try {

            $resultado = $co->query("SELECT * FROM categoria WHERE nombreCategoria='$nombreCategoria'");


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
