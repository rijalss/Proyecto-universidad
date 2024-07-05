<?php
require_once("model/conexion.php");
class Cargo extends Conexion
{
    private $clCargo;
    
    private $nombreCargo;
    private $codCargo;

    // SETTERS

    function set_clCargo($valor)
    {
        $this->clCargo = $valor;
    }

    function set_nombreCargo($valor)
    {
        $this->nombreCargo = $valor;
    }
    function set_codCargo($valor)
    {
        $this->codCargo = $valor;
    }


    // GETTERS

    function get_clCargo()
    {
        return $this->clCargo;
    }

    function get_nombreCargo()
    {
        return $this->nombreCargo;
    }
    function get_codCargo()
    {
        return $this->codCargo;
    }
 
    // INCLUIR
    function incluir()
    {
        $r = array();

        if (!$this->existe($this->codCargo)) {
            //1 Se llama a la funcion conecta 
            $co = $this->conecta();
            $co->setAttribute(PDO::ATTR_ERRMODE,
                PDO::ERRMODE_EXCEPTION
            );
            //2 Se ejecuta el sql
            try {
                $co->query("INSERT INTO cargo(
                   codCargo,
                    nombreCargo
                    ) VALUES (
                    '$this->codCargo',
                    '$this->nombreCargo'
                    )");
                $r['resultado'] = 'incluir';
                $r['mensaje'] = 'Registro Incluido!<br/> Se registró el cargo correctamente';
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
            $resultado = $co->query("SELECT * FROM cargo");

            if ($resultado) {
                $respuesta = '';
                foreach ($resultado as $r) {
                    $respuesta .= "<tr>";
                    $respuesta .= "<td>" . $r['codCargo'] . "</td>";
                    $respuesta .= "<td>" . $r['nombreCargo'] . "</td>";
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
        if ($this->existe($this->codCargo)) {
            try {
                $co->query("DELETE FROM cargo WHERE codCargo = '$this->codCargo'");
                $r['resultado'] = 'eliminar';
                $r['mensaje'] =  'Registro Eliminado! <br/> Se eliminó el cargo correctamente';
            } catch (Exception $e) {
                $r['resultado'] = 'error';
                $r['mensaje'] =  $e->getMessage();
            }
        } else {
            $r['resultado'] = 'eliminar';
            $r['mensaje'] =  'ERROR! <br/> El cargo colocado NO existe!';
        }
        return $r;
    }

    // MODIFICAR

   
    function modificar()
    {
        $co = $this->conecta();
        $co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $r = array();
        if ($this->existe($this->codCargo)) {
            try {
                $co->query("UPDATE cargo 
                SET nombreCargo = '$this->nombreCargo'
                WHERE codCargo = '$this->codCargo'
                ");
                $r['resultado'] = 'modificar';
                $r['mensaje'] =  'Registro Modificado!<br/> Se modificó el cargo correctamente';
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

    private function existe($identificador)
    {
        $co = $this->conecta();
        $co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        try {
            $resultado = $co->query("SELECT * FROM cargo WHERE codCargo='$identificador' OR nombreCargo='$identificador'");
            $fila = $resultado->fetchAll(PDO::FETCH_BOTH);
            return $fila ? true : false;
        } catch (Exception $e) {
            return false;
        }
    }

    public function obtenercargos()
    {
        $co = $this->conecta();
        $co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $p = $co->prepare("SELECT * FROM cargo");
        $p->execute();
        $r = $p->fetchAll(PDO::FETCH_ASSOC);
        return $r;
    }

}
