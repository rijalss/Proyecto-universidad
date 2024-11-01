<?php
require_once("model/conexion.php");
require_once('library/dompdf/vendor/autoload.php'); //archivo para cargar las funciones de la 
		//libreria DOMPDF
		// lo siguiente es hacer rerencia al espacio de trabajo
use Dompdf\Dompdf; 
class rentrada extends Conexion{
    

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

    

}
