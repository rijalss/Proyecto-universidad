<?php
require_once("model/conexion.php");
class Categoria extends Conexion
{
    private $clCategoria;
    private $nombreCategoria;
    private $codCategoria;

    // SETTERS

    function set_codCategoria($valor)
    {
        $this->codCategoria = $valor;
    }

    function set_clCategoria($valor)
    {
        $this->clCategoria = $valor;
    }

    function set_nombreCategoria($valor)
    {
        $this->nombreCategoria = $valor;
    }

    // GETTERS

    function get_clCategoria()
    {
        return $this->clCategoria;
    }

    function get_nombreCategoria()
    {
        return $this->nombreCategoria;
    }

    function get_codCategoria()
    {
        return $this->codCategoria;
    }


    // INCLUIR

    function incluir()
    {
        $r = array();

        if (!$this->existe($this->codCategoria)) {
            //1 Se llama a la funcion conecta 
            $co = $this->conecta();
            $co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //2 Se ejecuta el sql
            try {
                $co->query("INSERT INTO categoria(
                    codCategoria,
                    nombreCategoria
                    ) VALUES (
                    '$this->codCategoria',
                    '$this->nombreCategoria'
                    )");
                $r['resultado'] = 'incluir';
                $r['mensaje'] = 'Registro Incluido!<br/> Se registró la categoría correctamente';
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

    // CONSULTAR

    function consultar()
    {
        $co = $this->conecta();
        $co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $r = array();
        try {
            $resultado = $co->query("SELECT * FROM categoria");

            if ($resultado) {
                $respuesta = '';
                foreach ($resultado as $r) {
                    $respuesta .= "<tr>";
                    $respuesta .= "<td>" . $r['codCategoria'] . "</td>";
                    $respuesta .= "<td>" . $r['nombreCategoria'] . "</td>";
                    $respuesta .= "<td style='max-width: 10px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;'>";
                    $respuesta .= "<button type='button' class='btn btn-warning small-width d-inline-block mr-1' onclick='pone(this,0)' style='margin-right: 5px'>Modificar</button>";
                    $respuesta .= "<button type='button' class='btn btn-danger small-width d-inline-block'  onclick='pone(this,1)'>Eliminar</button>";
                    $respuesta .= "</td>";
                    $respuesta .= "</tr>";
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

    // ELIMINAR

    function eliminar()
    {
        $co = $this->conecta();
        $co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $r = array();
        if ($this->existe($this->codCategoria)) {
            try {
                $co->query("DELETE FROM categoria WHERE codCategoria = '$this->codCategoria'");
                $r['resultado'] = 'eliminar';
                $r['mensaje'] =  'Registro Eliminado! <br/> Se eliminó la categoría correctamente';
            } catch (Exception $e) {
                $r['resultado'] = 'error';
                $r['mensaje'] =  $e->getMessage();
            }
        } else {
            $r['resultado'] = 'eliminar';
            $r['mensaje'] =  'ERROR! <br/> El nombre colocado NO existe!';
        }
        return $r;
    }

    // MODIFICAR

    function modificar()
    {
        $co = $this->conecta();
        $co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $r = array();
        if ($this->existe($this->codCategoria)) {
            try {
                $co->query("UPDATE categoria 
                SET nombreCategoria = '$this->nombreCategoria'
                WHERE codCategoria = '$this->codCategoria'
                ");
                $r['resultado'] = 'modificar';
                $r['mensaje'] =  'Registro Modificado!<br/> Se modificó la categoría correctamente';
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

    // FUNCIÓN "EXISTE"

    private function existe($codCategoria)
    {
        $co = $this->conecta();
        $co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        try {

            $resultado = $co->query("SELECT * FROM categoria WHERE codCategoria='$codCategoria'");


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


    public function obtenerCategorias()
    {
        $co = $this->conecta();
        $co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $p = $co->prepare("SELECT * FROM categoria");
        $p->execute();
        $r = $p->fetchAll(PDO::FETCH_ASSOC);
        return $r;
    }

}
