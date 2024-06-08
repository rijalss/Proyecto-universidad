<?php

require_once('model/categoria.php');


class producto extends Categoria
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

        if (!$this->existe($this->codProducto)) {
            //1 Se llama a la funcion conecta 
            $co = $this->conecta();
            $co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //2 Se ejecuta el sql
            $r = array();
            try {

                $p = $co->prepare("Insert into producto(
						codProducto,
						nombreProducto,
						precio,
						descProducto,
                        codCategoria
						)
						Values(
						:codProducto,
						:nombreProducto,
						:precio,
						:descProducto,
                        :codCategoria
						)");
                $p->bindParam(':codProducto', $this->codProducto);
                $p->bindParam(':nombreProducto', $this->nombreProducto);
                $p->bindParam(':precio', $this->precio);
                $p->bindParam(':descProducto', $this->descProducto);
                $p->bindParam(':codCategoria', $this->codCategoria);

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
                $p = $co->prepare("Update producto set 
        nombreProducto = :nombreProducto,
        precio = :precio,
        descProducto = :descProducto,
        codCategoria = :codCategoria
        where producto.codProducto = :codProducto
      ");
                $p->bindParam(':codProducto', $this->codProducto);
                $p->bindParam(':nombreProducto', $this->nombreProducto);
                $p->bindParam(':precio', $this->precio);
                $p->bindParam(':descProducto', $this->descProducto);
                $p->bindParam(':codCategoria', $this->codCategoria);


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
                $p = $co->prepare("delete from producto 
					    where
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

            $resultado = $co->query("SELECT p.codProducto, p.nombreProducto, p.precio, p.descProducto, p.codCategoria, c.nombreCategoria
            FROM producto p
            JOIN categoria c ON p.codCategoria = c.codCategoria");

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

            $resultado = $co->query("Select * from producto where codProducto='$codProducto'");


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

            $stmt = $co->prepare("SELECT p.codProducto, p.nombreProducto, p.precio, p.descProducto, p.codCategoria, c.nombreCategoria
                                FROM producto p
                                JOIN categoria c ON p.codCategoria = c.codCategoria
                                WHERE p.codProducto = :codProducto");
            $stmt->execute(['codProducto' => $this->codProducto]);
            $fila = $stmt->fetchAll(PDO::FETCH_BOTH);
            if ($fila) {

                $r['resultado'] = 'encontro';
                $r['mensaje'] = $fila[0];
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
    function incluirCategoria()
    {

        if (!$this->existeCategoria($this->nombreCategoria)) {
            //1 Se llama a la funcion conecta 
            $co = $this->conecta();
            $co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //2 Se ejecuta el sql
            $r = array();
            try {

                $p = $co->prepare("Insert into categoria(
                        nombreCategoria
						)
						Values(
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
                $p = $co->prepare("delete from categoria 
					    where
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

            $resultado = $co->query("Select * from categoria where nombreCategoria='$nombreCategoria'");


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
