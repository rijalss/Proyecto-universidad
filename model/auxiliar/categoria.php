<?php
require_once("model/conexion.php");
class Categoria extends Conexion{
    private $clCategoria;
    private $nombreCategoria;
    private $codCategoria;

    // SETTERS

    function setcodCategoria($valor)
    {
        $this->codCategoria = $valor;
    }

    function setclCategoria($valor)
    {
        $this->clCategoria = $valor;
    }

    function setnombreCategoria($valor)
    {
        $this->nombreCategoria = $valor;
    }

    // GETTERS

    function getclCategoria()
    {
        return $this->clCategoria;
    }

    function getnombreCategoria()
    {
        return $this->nombreCategoria;
    }

    function getcodCategoria()
    {
        return $this->codCategoria;
    }


    // INCLUIR

    public function incluir(){
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

    public function consultar(){
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
                    $respuesta = $respuesta . "<td style='max-width: 140px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;'>";
                    $respuesta = $respuesta . "<div class='d-flex flex-column align-items-center'>";
                    $respuesta = $respuesta . "<button type='button' class='btn btn-warning btn-sm mb-2' style='width: 100px;' onclick='pone(this,0)'>Modificar</button>";
                    $respuesta = $respuesta . "<button type='button' class='btn btn-danger btn-sm' style='width: 100px;' onclick='pone(this,1)'>Eliminar</button>";
                    $respuesta = $respuesta . "</div>";
                    $respuesta = $respuesta . "</td>";
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

    public function eliminar(){
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
                $r['mensaje'] =  'No se puede eliminar este registro. <br/> Está asociado a otro registro existente.';
            }
        } else {
            $r['resultado'] = 'eliminar';
            $r['mensaje'] =  'ERROR! <br/> El nombre colocado NO existe!';
        }
        return $r;
    }

    // MODIFICAR
    public function modificar(){
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

    public function existe($codCategoria){
        $co = $this->conecta();
        $co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $r = array();
        try {
        
            $stmt = $co->prepare("SELECT * FROM categoria WHERE codCategoria=:codCategoria");
            $stmt->execute(['codCategoria' => $codCategoria]);
            $fila = $stmt->fetchAll(PDO::FETCH_BOTH);
            if ($fila) {
                $r['resultado'] = 'existe';
                $r['mensaje'] = 'El codigo de la categoría ya existe!';
            } 
        } catch (Exception $e) {
            $r['resultado'] = 'error';
            $r['mensaje'] =  $e->getMessage();
        }
        return $r;
    }


    public function obtenerCategorias(){
        $co = $this->conecta();
        $co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $p = $co->prepare("SELECT * FROM categoria");
        $p->execute();
        $r = $p->fetchAll(PDO::FETCH_ASSOC);
        return $r;
    }

}
