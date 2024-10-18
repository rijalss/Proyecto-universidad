<?php

require_once('conexion.php');

class Empleado extends Conexion
{

    private $cedulaEmpleado;
    private $nombreEmpleado;
    private $apellidoEmpleado;
    private $correoEmpleado;
    private $telefonoEmpleado;
    private $prefijoCedula;
    private $clCargo;
   

    //////////////////////////SET//////////////////////////

    public function set_cedulaEmpleado($valor)
    {
        $this->cedulaEmpleado = $valor;
    }

    public function set_nombreEmpleado($valor)
    {
        $this->nombreEmpleado = $valor;
    }

    public function set_apellidoEmpleado($valor)
    {
        $this->apellidoEmpleado = $valor;
    }

    public function set_correoEmpleado($valor)
    {
        $this->correoEmpleado = $valor;
    }

    public function set_telefonoEmpleado($valor)
    {
        $this->telefonoEmpleado = $valor;
    }

    public function set_clCargo($valor)
    {
        $this->clCargo = $valor;
    }
    function set_prefijoCedula($valor)
    {
        $this->prefijoCedula = $valor;
    }
   

    //////////////////////////GET//////////////////////////

    public function get_cedulaEmpleado()
    {
        return $this->cedulaEmpleado;
    }

    public function get_nombreEmpleado()
    {
        return $this->nombreEmpleado;
    }

    public function get_apellidoEmpleado()
    {
        return $this->apellidoEmpleado;
    }

    public function get_correoEmpleado()
    {
        return $this->correoEmpleado;
    }

    public function get_telefonoEmpleado()
    {
        return $this->telefonoEmpleado;
    }

    function get_prefijoCedula()
    {
        return $this->prefijoCedula;
    }

    public function get_clCargo()
    {
        return $this->clCargo;
    }


    //////////////////////////METODOS//////////////////////////


    function incluir()
    {
        $r = array();

        if (!$this->existe($this->cedulaEmpleado)) {
            //1 Se llama a la funcion conecta 
            $co = $this->conecta();
            $co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //2 Se ejecuta el sql
            try {
                $co->query("INSERT INTO empleado(
                    prefijoCedula,
                    cedulaEmpleado,
                    nombreEmpleado,
                    apellidoEmpleado,
                    telefonoEmpleado,
                    correoEmpleado,
                    clCargo
                    ) VALUES (
                    '$this->prefijoCedula',
                    '$this->cedulaEmpleado',
                    '$this->nombreEmpleado',
                    '$this->apellidoEmpleado',
                    '$this->telefonoEmpleado',
                    '$this->correoEmpleado',
                    '$this->clCargo'
                )");
                $r['resultado'] = 'incluir';
                $r['mensaje'] = 'Registro Incluido!<br/> Se incluyó el empleado correctamente';
            } catch (Exception $e) {
                $r['resultado'] = 'error';
                $r['mensaje'] = $e->getMessage();
            }
        } else {
            $r['resultado'] = 'incluir';
            $r['mensaje'] = 'ERROR! <br/> El EMPLEADO colocado ya existe!';
        }
        return $r;
    }

    function modificar()
    {
        $co = $this->conecta();
        $co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $r = array();
        if ($this->existe($this->cedulaEmpleado)) {
            try {
                $co->query("UPDATE empleado 
                SET nombreEmpleado = '$this->nombreEmpleado',
                telefonoEmpleado = '$this->telefonoEmpleado',
                correoEmpleado = '$this->correoEmpleado',
                clCargo = '$this->clCargo',
                apellidoEmpleado = '$this->apellidoEmpleado',
                prefijoCedula = '$this->prefijoCedula'
                WHERE cedulaEmpleado = '$this->cedulaEmpleado'
                ");
                $r['resultado'] = 'modificar';
                $r['mensaje'] =  'Registro Modificado!<br/> Se modificó el empleado correctamente';
            } catch (Exception $e) {
                $r['resultado'] = 'error';
                $r['mensaje'] =  $e->getMessage();
            }
        } else {
            $r['resultado'] = 'modificar';
            $r['mensaje'] =  'ERROR! <br/> El EMPLEADO colocado NO existe!';
        }
        return $r;
    }

    function eliminar()
    {
        $co = $this->conecta();
        $co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $r = array();
        if ($this->existe($this->cedulaEmpleado)) {
            try {
                $co->query("DELETE FROM empleado 
						WHERE cedulaEmpleado = '$this->cedulaEmpleado'
						");
                $r['resultado'] = 'eliminar';
                $r['mensaje'] =  'Registro Eliminado! <br/> Se eliminó el empleado correctamente';
            } catch (Exception $e) {
                $r['resultado'] = 'error';
                $r['mensaje'] =  $e->getMessage();
            }
        } else {
            $r['resultado'] = 'eliminar';
            $r['mensaje'] =  'ERROR! <br/> El EMPLEADO colocado NO existe!';
        }
        return $r;
    }


    function consultar()
    {
        $co = $this->conecta();
        $co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $r = array();
        try {

            $resultado = $co->query("SELECT e.prefijoCedula, e.cedulaEmpleado, e.nombreEmpleado, e.apellidoEmpleado, e.telefonoEmpleado, e.correoEmpleado, c.nombreCargo
                                    FROM empleado e
                                    JOIN cargo c ON e.clCargo = c.clCargo");
            if ($resultado) {

                $respuesta = '';
                foreach ($resultado as $r) {
                    $respuesta = $respuesta . "<tr>";
                       // Construir la URL de la imagen de perfil
                       $imagenURL = "public/img/" . htmlspecialchars($r['prefijoCedula'] . '-' . $r['cedulaEmpleado']) . ".png"; // Asegúrate que la imagen siga este patrón
                    
                       // Comprobar si la imagen existe
                       if (file_exists($imagenURL)) {
                           $respuesta .= "<td><img src='$imagenURL' alt='Imagen de perfil' style='width: 50px; height: auto;'></td>";
                       } else {
                           $respuesta .= "<td><img src='public/img/perfil.jpg' alt='Imagen por defecto' style='width: 50px; height: auto;'></td>";
                       }
                    $respuesta = $respuesta . "<td>";
                    $respuesta = $respuesta . $r['prefijoCedula'] . '-' . $r['cedulaEmpleado'];
                    $respuesta = $respuesta . "</td>";
                    $respuesta = $respuesta . "<td>";
                    $respuesta = $respuesta . $r['nombreEmpleado'];
                    $respuesta = $respuesta . "</td>";
                    $respuesta = $respuesta . "<td>";
                    $respuesta = $respuesta . $r['apellidoEmpleado'];
                    $respuesta = $respuesta . "</td>";
                    $respuesta = $respuesta . "<td>";
                    $respuesta = $respuesta . $r['telefonoEmpleado'];
                    $respuesta = $respuesta . "</td>";
                    $respuesta = $respuesta . "<td>";
                    $respuesta = $respuesta . $r['correoEmpleado'];
                    $respuesta = $respuesta . "</td>";
                    $respuesta = $respuesta . "<td>";
                    $respuesta = $respuesta . $r['nombreCargo'];
                    $respuesta = $respuesta . "</td>";
                    $respuesta .= "<td style='max-width: 140px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;'>";
                    $respuesta .= "<button type='button' class='btn btn-warning small-width d-block mb-1' onclick='pone(this,0)'>Modificar</button>";
                    $respuesta .= "<button type='button' class='btn btn-danger small-width d-block' onclick='pone(this,1)'>Eliminar</button>";
                    $respuesta .= "</td>";
                    
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


    private function existe($cedulaEmpleado)
    {
        $co = $this->conecta();
        $co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        try {

            $resultado = $co->query("SELECT * FROM empleado WHERE cedulaEmpleado='$cedulaEmpleado'");


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