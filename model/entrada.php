<?php
require_once('conexion.php');

class Entrada extends Conexion{
    private $clEntrada;
    private $fechaEntrada;
    private $factura;
    private $clProveedor;
    private $clEmpleado;
    private $clProducto;
    private $clArea;
    private $cantidadEntrada;
    private $precioEntrada;
    // falta los campos de existencia
   
    
    public function setClEntrada($clEntrada)
    {
        $this->clEntrada = $clEntrada;
    }
    
    public function getClEntrada()
    {
        return $this->clEntrada;
    }
    
    public function setFechaEntrada($fechaEntrada)
    {
        $this->fechaEntrada = $fechaEntrada;
    }
    
    public function getFechaEntrada()
    {
        return $this->fechaEntrada;
    }
    
    public function setFactura($factura)
    {
        $this->factura = $factura;
    }
    
    public function getFactura()
    {
        return $this->factura;
    }
    
    public function setClProveedor($clProveedor)
    {
        $this->clProveedor = $clProveedor;
    }
    
    public function getClProveedor()
    {
        return $this->clProveedor;
    }
    
    public function setClEmpleado($clEmpleado)
    {
        $this->clEmpleado = $clEmpleado;
    }
    
    public function getClEmpleado()
    {
        return $this->clEmpleado;
    }
    
    public function setClProducto($clProducto)
    {
        $this->clProducto = $clProducto;
    }
    
    public function getClProducto()
    {
        return $this->clProducto;
    }
    
    public function setClArea($clArea)
    {
        $this->clArea = $clArea;
    }
    
    public function getClArea()
    {
        return $this->clArea;
    }
    
    public function setCantidadEntrada($cantidadEntrada)
    {
        $this->cantidadEntrada = $cantidadEntrada;
    }
    
    public function getCantidadEntrada()
    {
        return $this->cantidadEntrada;
    }
    
    public function setPrecioEntrada($precioEntrada)
    {
        $this->precioEntrada = $precioEntrada;
    }
    
    public function getPrecioEntrada()
    {
        return $this->precioEntrada;
    }
    //////////////////////////SET//////////////////////////
    function incluir()
    {
        $r = array();

        if (!$this->existe($this->factura)) {
            //1 Se llama a la funcion conecta 
            $co=new Entrada;
            $co = $this->conecta();
            $co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //2 Se ejecuta el sql
            try {
                $co->query("INSERT INTO notaentrada(
                    fechaEntrada,
                    numFactura,
                    clProveedor,
                    clEmpleado
                    ) VALUES (
                    '$this->fechaEntrada',
                    '$this->factura',
                    '$this->clProveedor',
                    '$this->clEmpleado'
                    
                )");
                $r['resultado'] = 'incluir';
                $r['mensaje'] = 'Registro Incluido!<br/> Se registró la nota de entrada correctamente';
            } catch (Exception $e) {
                $r['resultado'] = 'error';
                $r['mensaje'] = $e->getMessage();
            }
        } else {
            $r['resultado'] = 'incluir';
            $r['mensaje'] = 'ERROR! <br/> EL NÚMERO DE FACTURA colocado ya existe!';
        }
        return $r;
    }

    function consultar()
    {
        $co = $this->conecta();
        $co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $r = array();
        try {
           
            $resultado = $co->query("SELECT ne.fechaEntrada, ne.numFactura, p.nombreProveedor, e.nombreEmpleado
                                    FROM notaentrada AS ne
                                    JOIN proveedor AS p ON ne.clProveedor = p.clProveedor
                                    JOIN empleado AS e ON ne.clEmpleado = e.clEmpleado;");
 
            if ($resultado) {

                $respuesta = '';
                foreach ($resultado as $r) {
                    $respuesta = $respuesta . "<tr>";
                    $respuesta = $respuesta . "<td>";
                    $respuesta = $respuesta . $r['nombreProveedor'];
                    $respuesta = $respuesta . "</td>";
                    $respuesta = $respuesta . "<td>";
                    $respuesta = $respuesta . $r['numFactura'];
                    $respuesta = $respuesta . "</td>";
                    $respuesta = $respuesta . "<td>";
                    $respuesta = $respuesta . $r['fechaEntrada'];
                    $respuesta = $respuesta . "</td>";
                    $respuesta = $respuesta . "<td>";
                    $respuesta = $respuesta . $r['nombreEmpleado'];
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

    function existe($factura) {
        $co = $this->conecta();
        $co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        try {

            $resultado = $co->query("SELECT * FROM notaentrada WHERE numFactura='$factura'");
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

    function modificar()
    {
        $co = $this->conecta();
        $co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $r = array();
       if ($this->existe($this->factura)) {
            
            try {
                $co->query("UPDATE notaentrada 
                SET 
                fechaEntrada='$this->fechaEntrada',
                clProveedor = '$this->clProveedor',
                clEmpleado = '$this->clEmpleado'
                WHERE numFactura = '$this->factura'
                ");
                $r['resultado'] = 'modificar';
                $r['mensaje'] =  'Registro Modificado!<br/> Se modificó la nota de entrada correctamente';
            } catch (Exception $e) {
                $r['resultado'] = 'error';
                $r['mensaje'] =  $e->getMessage();
            }
        } else {
            $r['resultado'] = 'modificar';
            $r['mensaje'] =  'ERROR! <br/> EL NÚMERO DE FACTURA colocado ya existe!';
        }
        return $r;
    }

    function eliminar()
    {
        $co = $this->conecta();
        $co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $r = array();
        if ($this->existe($this->factura)) {
            try {
                $co->query("DELETE FROM notaentrada 
						WHERE numFactura = '$this->factura'
						");
                $r['resultado'] = 'eliminar';
                $r['mensaje'] =  'Registro Eliminado! <br/> Se eliminó la nota de entrada correctamente';
            } catch (Exception $e) {
                $r['resultado'] = 'error';
                $r['mensaje'] =  $e->getMessage();
            }
        } else {
            $r['resultado'] = 'eliminar';
            $r['mensaje'] =  'ERROR! <br/> EL NÚMERO DE FACTURA colocada NO existe!!';
        }
        return $r;
    }

    public function obtenerproducto()
    {
        $co = $this->conecta();
        $co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $p = $co->prepare("SELECT clProducto,nombreProducto FROM producto ");
        $p->execute();
        $r = $p->fetchAll(PDO::FETCH_ASSOC);
        return $r;
    }

    public function obtenerproveedor()
    {
        $co = $this->conecta();
        $co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $p = $co->prepare("SELECT clProveedor,nombreProveedor FROM proveedor ");
        $p->execute();
        $r = $p->fetchAll(PDO::FETCH_ASSOC);
        return $r;
    }

    public function obtenerempleado()
    {
        $co = $this->conecta();
        $co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $p = $co->prepare("SELECT clEmpleado,nombreEmpleado FROM empleado ");
        $p->execute();
        $r = $p->fetchAll(PDO::FETCH_ASSOC);
        return $r;
    }


}