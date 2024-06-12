<?php
require_once('model/conexion.php');

class Empleado extends Conexion
{
    private $cedulaEmpleado;
    private $nombreEmpleado;
    private $apellidoEmpleado;
    private $correoEmpleado;
    private $telefonoEmpleado;
    private $contrasena;
    private $clCargo;
    private $descCargo;

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

    public function set_contrasena($valor)
    {
        $this->contrasena = $valor;
    }

    public function set_clCargo($valor)
    {
        $this->clCargo = $valor;
    }

    public function set_descCargo($valor)
    {
        $this->descCargo = $valor;
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

    public function get_contrasena()
    {
        return $this->contrasena;
    }

    public function get_clCargo()
    {
        return $this->clCargo;
    }

    public function get_descCargo()
    {
        return $this->descCargo;
    }

    //////////////////////////METODOS//////////////////////////

    public function incluir()
    {
        if (!$this->existe($this->cedulaEmpleado)) {
            $co = $this->conecta();
            $co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $r = array();
            try {
                $p = $co->prepare("INSERT INTO empleado (
                    cedulaEmpleado,
                    nombreEmpleado,
                    apellidoEmpleado,
                    correoEmpleado,
                    telefonoEmpleado,
                    contrasena,
                    clCargo
                ) VALUES (
                    :cedulaEmpleado,
                    :nombreEmpleado,
                    :apellidoEmpleado,
                    :correoEmpleado,
                    :telefonoEmpleado,
                    :contrasena,
                    :clCargo
                )");
                $p->bindParam(':cedulaEmpleado', $this->cedulaEmpleado);
                $p->bindParam(':nombreEmpleado', $this->nombreEmpleado);
                $p->bindParam(':apellidoEmpleado', $this->apellidoEmpleado);
                $p->bindParam(':correoEmpleado', $this->correoEmpleado);
                $p->bindParam(':telefonoEmpleado', $this->telefonoEmpleado);
                $p->bindParam(':contrasena', $this->contrasena);
                $p->bindParam(':clCargo', $this->clCargo);

                $p->execute();

                $r['resultado'] = 'incluir';
                $r['mensaje'] = 'Registro Incluido';
            } catch (Exception $e) {
                $r['resultado'] = 'error';
                $r['mensaje'] = $e->getMessage();
            }
        } else {
            $r['resultado'] = 'incluir';
            $r['mensaje'] = 'Ya existe el empleado';
        }

        return $r;
    }

    public function modificar()
    {
        $co = $this->conecta();
        $co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $r = array();

        if ($this->existe($this->cedulaEmpleado)) {
            try {
                $p = $co->prepare("UPDATE empleado SET 
                    nombreEmpleado = :nombreEmpleado,
                    apellidoEmpleado = :apellidoEmpleado,
                    correoEmpleado = :correoEmpleado,
                    telefonoEmpleado = :telefonoEmpleado,
                    contrasena = :contrasena,
                    clCargo = :clCargo
                    WHERE cedulaEmpleado = :cedulaEmpleado
                ");
                $p->bindParam(':cedulaEmpleado', $this->cedulaEmpleado);
                $p->bindParam(':nombreEmpleado', $this->nombreEmpleado);
                $p->bindParam(':apellidoEmpleado', $this->apellidoEmpleado);
                $p->bindParam(':correoEmpleado', $this->correoEmpleado);
                $p->bindParam(':telefonoEmpleado', $this->telefonoEmpleado);
                $p->bindParam(':contrasena', $this->contrasena);
                $p->bindParam(':clCargo', $this->clCargo);

                $p->execute();

                $r['resultado'] = 'modificar';
                $r['mensaje'] = 'Registro Modificado';
            } catch (Exception $e) {
                $r['resultado'] = 'error';
                $r['mensaje'] = $e->getMessage();
            }
        } else {
            $r['resultado'] = 'modificar';
            $r['mensaje'] = 'No existe la cédula del empleado';
        }

        return $r;
    }

    public function eliminar()
    {
        $co = $this->conecta();
        $co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $r = array();
        if ($this->existe($this->cedulaEmpleado)) {
            try {
                $p = $co->prepare("DELETE FROM empleado 
                    WHERE cedulaEmpleado = :cedulaEmpleado
                ");
                $p->bindParam(':cedulaEmpleado', $this->cedulaEmpleado);

                $p->execute();
                $r['resultado'] = 'eliminar';
                $r['mensaje'] = 'Registro Eliminado';
            } catch (Exception $e) {
                $r['resultado'] = 'error';
                $r['mensaje'] = $e->getMessage();
            }
        } else {
            $r['resultado'] = 'eliminar';
            $r['mensaje'] = 'No existe la cédula del empleado';
        }
        return $r;
    }

    public function consultar()
    {
        $co = $this->conecta();
        $co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $r = array();
        try {
            $resultado = $co->query("SELECT e.cedulaEmpleado, e.nombreEmpleado, e.apellidoEmpleado, e.correoEmpleado, e.telefonoEmpleado, e.contrasena, c.descCargo
                FROM Empleado e
                JOIN Cargo c ON e.clCargo = c.clCargo");

            if ($resultado) {
                $respuesta = '';
                foreach ($resultado as $row) {
                    $respuesta .= "<tr style='cursor:pointer' onclick='coloca(this);'>";
                    $respuesta .= "<td>" . $row['cedulaEmpleado'] . "</td>";
                    $respuesta .= "<td>" . $row['nombreEmpleado'] . "</td>";
                    $respuesta .= "<td>" . $row['apellidoEmpleado'] . "</td>";
                    $respuesta .= "<td>" . $row['telefonoEmpleado'] . "</td>";
                    $respuesta .= "<td>" . $row['correoEmpleado'] . "</td>";
                    $respuesta .= "<td>" . $row['descCargo'] . "</td>";
                    $respuesta .= "</tr>";
                }
                $r['resultado'] = 'consultar';
                $r['mensaje'] = $respuesta;
            } else {
                $r['resultado'] = 'consultar';
                $r['mensaje'] = '';
            }
        } catch (Exception $e) {
            $r['resultado'] = 'error';
            $r['mensaje'] = $e->getMessage();
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
                return false;
            }
        } catch (Exception $e) {
            return false;
        }
    }

    public function consultatr()
    {
        $co = $this->conecta();
        $co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $r = array();
        try {
            $stmt = $co->prepare("SELECT e.*, c.descCargo 
                FROM Empleado e
                INNER JOIN Cargo c ON e.clCargo = c.clCargo 
                WHERE e.cedulaEmpleado = :cedulaEmpleado");
            $stmt->execute(['cedulaEmpleado' => $this->cedulaEmpleado]);
            $fila = $stmt->fetchAll(PDO::FETCH_BOTH);
            if ($fila) {
                $r['resultado'] = 'encontro';
                $r['mensaje'] = $fila;
            } else {
                $r['resultado'] = 'noencontro';
                $r['mensaje'] = '';
            }
        } catch (Exception $e) {
            $r['resultado'] = 'error';
            $r['mensaje'] = $e->getMessage();
        }
        return $r;
    }

    // CARGOS

    public function obtenerCargos()
    {
        $co = $this->conecta();
        $co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $p = $co->prepare("SELECT * FROM Cargo");
        $p->execute();
        $r = $p->fetchAll(PDO::FETCH_ASSOC);
        return $r;
    }

    public function incluirCargo()
    {
        if (!$this->existeCargo($this->descCargo)) {
            $co = $this->conecta();
            $co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $r = array();
            try {
                $p = $co->prepare("INSERT INTO Cargo (descCargo) VALUES (:descCargo)");
                $p->bindParam(':descCargo', $this->descCargo);
                $p->execute();

                $r['resultado'] = 'incluirCargo';
                $r['mensaje'] = 'Cargo Incluido';
            } catch (Exception $e) {
                $r['resultado'] = 'error';
                $r['mensaje'] = $e->getMessage();
            }
        } else {
            $r['resultado'] = 'incluirCargo';
            $r['mensaje'] = 'Ya existe el cargo';
        }

        return $r;
    }

    public function eliminarCargo()
    {
        $co = $this->conecta();
        $co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $r = array();
        if ($this->existeCargo($this->descCargo)) {
            try {
                $p = $co->prepare("DELETE FROM Cargo WHERE descCargo = :descCargo");
                $p->bindParam(':descCargo', $this->descCargo);
                $p->execute();
                $r['resultado'] = 'eliminarCargo';
                $r['mensaje'] = 'Cargo Eliminado';
            } catch (Exception $e) {
                $r['resultado'] = 'error';
                $r['mensaje'] = $e->getMessage();
            }
        } else {
            $r['resultado'] = 'eliminarCargo';
            $r['mensaje'] = 'No existe el cargo';
        }
        return $r;
    }

    private function existeCargo($descCargo)
    {
        $co = $this->conecta();
        $co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        try {
            $resultado = $co->query("SELECT * FROM Cargo WHERE descCargo='$descCargo'");
            $fila = $resultado->fetchAll(PDO::FETCH_BOTH);
            if ($fila) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            return false;
        }
    }
}
