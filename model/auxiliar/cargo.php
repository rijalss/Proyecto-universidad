<?php
require_once("model/conexion.php");
class Cargo extends Conexion{
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
                $r['mensaje'] =  'No se puede eliminar este registro. <br/> Está asociado a otro registro existente.';
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


    public function existe($codCargo){
        $co = $this->conecta();
        $co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $r = array();
        try {
        
            $stmt = $co->prepare("SELECT * FROM cargo WHERE codCargo=:codCargo");
            $stmt->execute(['codCargo' => $codCargo]);
            $fila = $stmt->fetchAll(PDO::FETCH_BOTH);
            if ($fila) {
                $r['resultado'] = 'existe';
                $r['mensaje'] = 'El codigo del cargo ya existe!';
            } 
        } catch (Exception $e) {
            $r['resultado'] = 'error';
            $r['mensaje'] =  $e->getMessage();
        }
        return $r;
    }
}
