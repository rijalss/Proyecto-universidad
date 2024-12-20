<?php

require_once('conexion.php');

class Producto extends Conexion
{
    private $codProducto;
    private $nombreProducto;
    private $ultimoPrecio;
    private $descProducto;
    private $clCategoria;

    // SETTER
    function set_codProducto($valor)
    {
        $this->codProducto = $valor;
    }

    function set_nombreProducto($valor)
    {
        $this->nombreProducto = $valor;
    }

    function set_ultimoPrecio($valor)
    {
        $this->ultimoPrecio = $valor;
    }

    function set_descProducto($valor)
    {
        $this->descProducto = $valor;
    }

    function set_clCategoria($valor)
    {
        $this->clCategoria = $valor;
    }

    // GETTERS
    function get_codProducto()
    {
        return $this->codProducto;
    }

    function get_clCategoria()
    {
        return $this->clCategoria;
    }

    function get_nombreProducto()
    {
        return $this->nombreProducto;
    }

    function get_ultimoPrecio()
    {
        return $this->ultimoPrecio;
    }

    function get_descProducto()
    {
        return $this->descProducto;
    }

    // METÓDOS

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
                    ultimoPrecio,
                    descProducto,
                    clCategoria
                    ) VALUES (
                    '$this->codProducto',
                    '$this->nombreProducto',
                    '$this->ultimoPrecio',
                    '$this->descProducto',
                    '$this->clCategoria'
                    )");
                $lid = $co->lastInsertId();

                $co->query("INSERT INTO existencia (cantidadExistencia, clProducto) VALUES (0,'$lid')");



                $r['resultado'] = 'incluir';
                $r['mensaje'] = 'Registro Incluido!<br/> Se registró el producto correctamente';
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
        if ($this->existe($this->codProducto)) {
            try {
                $co->query("UPDATE producto 
                SET nombreProducto = '$this->nombreProducto',
                descProducto = '$this->descProducto',
                ultimoPrecio = '$this->ultimoPrecio',
                clCategoria = '$this->clCategoria' 
                WHERE codProducto = '$this->codProducto'");
                $r['resultado'] = 'modificar';
                $r['mensaje'] =  'Registro Modificado!<br/> Se modificó el producto correctamente';
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
        if ($this->existe($this->codProducto)) {
            try {
                $p = $co->prepare("DELETE from producto WHERE codProducto = :codProducto");
                $p->bindParam(':codProducto', $this->codProducto);


                $p->execute();
                $r['resultado'] = 'eliminar';
                $r['mensaje'] =  'Registro Eliminado! <br/> Se eliminó el producto correctamente';
            } catch (Exception $e) {
                $r['resultado'] = 'error';
                $r['mensaje'] =  'No se puede eliminar este registro. <br/> Está asociado a otro registro existente.';
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

            $resultado = $co->query("SELECT p.codProducto, p.nombreProducto, p.ultimoPrecio, p.descProducto, c.nombreCategoria
                FROM producto p
                JOIN categoria c ON p.clCategoria = c.clCategoria");

            if ($resultado) {

                $respuesta = '';
                foreach ($resultado as $r) {
                    $respuesta = $respuesta . "<tr>";

                    // Construir la URL de la imagen del producto
                    $imagenURL = "public/img/img-producto/" . htmlspecialchars($r['codProducto']) . ".png";

                    // Comprobar si la imagen existe
                    if (file_exists($imagenURL)) {
                        // Añadir timestamp a la URL de la imagen para evitar caché
                        $timestamp = filemtime($imagenURL); // Obtener la última modificación del archivo
                        $respuesta .= "<td><img src='$imagenURL?$timestamp' alt='Imagen del producto' style='width: 50px; height: auto;'></td>";
                    } else {
                        $respuesta .= "<td><img src='public/img/img-producto/producto.jpg' alt='Imagen por defecto' style='width: 50px; height: auto;'></td>";
                    }

                    // Continuar con el resto de los datos del producto
                    $respuesta = $respuesta . "<td>";
                    $respuesta = $respuesta . $r['codProducto'];
                    $respuesta = $respuesta . "</td>";
                    $respuesta = $respuesta . "<td>";
                    $respuesta = $respuesta . $r['nombreProducto'];
                    $respuesta = $respuesta . "</td>";
                    $respuesta = $respuesta . "<td>";
                    $respuesta = $respuesta . $r['ultimoPrecio'];
                    $respuesta = $respuesta . "</td>";
                    $respuesta = $respuesta . "<td>";
                    $respuesta = $respuesta . $r['nombreCategoria'];
                    $respuesta = $respuesta . "</td>";
                    $respuesta = $respuesta . "<td>";
                    $respuesta = $respuesta . $r['descProducto'];
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



    public function existe($codProducto)
    {
        $co = $this->conecta();
        $co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $r = array();
        try {

            $stmt = $co->prepare("SELECT * FROM producto WHERE codProducto=:codProducto");
            $stmt->execute(['codProducto' => $codProducto]);
            $fila = $stmt->fetchAll(PDO::FETCH_BOTH);
            if ($fila) {
                $r['resultado'] = 'existe';
                $r['mensaje'] = 'El código de producto ya existe!';
            }
        } catch (Exception $e) {
            $r['resultado'] = 'error';
            $r['mensaje'] =  $e->getMessage();
        }
        return $r;
    }
}
