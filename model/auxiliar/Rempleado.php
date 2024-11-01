<?php
require_once('library/dompdf/vendor/autoload.php');
use Dompdf\Dompdf; 
use Dompdf\Options; 
require_once("model/conexion.php");
class Rempleado extends Conexion{

	
	private $cedulaEmpleado; 
	private $nombreEmpleado;
    private $apellidoEmpleado;

    private $clCargo;

	function set_cedulaEmpleado($valor){
		$this->cedulaEmpleado = $valor; 
	}
    function set_nombreEmpleado($valor){
		$this->nombreEmpleado = $valor; 
	}
    function set_apellidoEmpleado($valor){
		$this->apellidoEmpleado = $valor; 
	}
     function get_clCargo()
    {
        return $this->clCargo;
    }

     function set_clCargo($valor)
    {
        $this->clCargo = $valor;
    }
	
    
    
	function generarPDF() {
        // Conexión y consulta SQL
        $co = $this->conecta();
        $co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
        try {
            // Modificamos la consulta para incluir un JOIN con la tabla 'cargo'
            $resultado = $co->prepare("SELECT e.*, c.nombreCargo 
                                        FROM empleado e 
                                        JOIN cargo c ON e.clCargo = c.clCargo 
                                        WHERE e.cedulaEmpleado LIKE :cedulaEmpleado 
                                        AND e.nombreEmpleado LIKE :nombreEmpleado 
                                        AND e.apellidoEmpleado LIKE :apellidoEmpleado 
                                        AND e.clCargo LIKE :clCargo");
            
            $resultado->bindValue(':cedulaEmpleado', '%' . $this->cedulaEmpleado . '%');
            $resultado->bindValue(':nombreEmpleado', '%' . $this->nombreEmpleado . '%');
            $resultado->bindValue(':apellidoEmpleado', '%' . $this->apellidoEmpleado . '%');
            $resultado->bindValue(':clCargo', '%' . $this->clCargo . '%');
    
            $resultado->execute();
            $fila = $resultado->fetchAll(PDO::FETCH_ASSOC);
    
            // Construcción del HTML básico
            $html = "<html><head></head><body>";
            $html .= "<div style='width:100%; border: solid 1px #000;'>";
            $html .= "<table style='width:100%; border-collapse: collapse;'>";
            $html .= "<thead><tr style='background-color: #f2f2f2;'>";
            $html .= "<th style='border: 1px solid #ddd; text-align: center;'>Cedula</th>";
            $html .= "<th style='border: 1px solid #ddd; text-align: center;'>Nombre</th>";
            $html .= "<th style='border: 1px solid #ddd; text-align: center;'>Apellido</th>";
            $html .= "<th style='border: 1px solid #ddd; text-align: center;'>Correo</th>";
            $html .= "<th style='border: 1px solid #ddd; text-align: center;'>Telefono</th>";
            $html .= "<th style='border: 1px solid #ddd; text-align: center;'>Cargo</th>";
            $html .= "<th style='border: 1px solid #ddd; text-align: center;'>Foto</th>";
            $html .= "</tr></thead><tbody>";
    
            if ($fila) {
                foreach ($fila as $f) {
                    $html .= "<tr>";
                    $html .= "<td style='border: 1px solid #ddd; text-align: center;'>" . $f['prefijoCedula'] . '-' . $f['cedulaEmpleado'] . "</td>";
                    $html .= "<td style='border: 1px solid #ddd; text-align: center;'>" . $f['nombreEmpleado'] . "</td>";
                    $html .= "<td style='border: 1px solid #ddd; text-align: center;'>" . $f['apellidoEmpleado'] . "</td>";
                    $html .= "<td style='border: 1px solid #ddd; text-align: center;'>" . $f['correoEmpleado'] . "</td>";
                    $html .= "<td style='border: 1px solid #ddd; text-align: center;'>" . $f['telefonoEmpleado'] . "</td>";
                    // Cambiar clCargo por el nombre del cargo
                    $html .= "<td style='border: 1px solid #ddd; text-align: center;'>" . $f['nombreCargo'] . "</td>";
    
                    // Construcción de la imagen de perfil en base64
                    $imagenURL = "public/img/" . $f['prefijoCedula'] . '-' . $f['cedulaEmpleado'] . ".png";
    
                    // Comprobar si la imagen existe y convertirla a base64
                    if (is_file($imagenURL)) {
                        $imagenData = file_get_contents($imagenURL);
                        if ($imagenData !== false) {
                            $imagenURL64 = "data:image/png;base64," . base64_encode($imagenData);
                            $html .= "<td style='border: 1px solid #ddd; text-align: center;'>".
                                      "<img style='width:90px; height:50px;' src='$imagenURL64' alt=''/></td>";
                        } else {
                            // Error al leer el archivo de imagen
                            $html .= "<td style='border: 1px solid #ddd; text-align: center;'><span>Error: No se pudo leer la imagen</span></td>";
                        }
                    } else {
                        // Imagen por defecto si no se encuentra la imagen personalizada
                        $imagenPorDefecto = "public/img/perfil.jpg";
                        $imagenData = file_get_contents($imagenPorDefecto);
                        if ($imagenData !== false) {
                            $imagenURL64 = "data:image/png;base64," . base64_encode($imagenData);
                            $html .= "<td style='border: 1px solid #ddd; text-align: center;'>".
                                      "<img style='width:90px; height:50px;' src='$imagenURL64' alt='Imagen por defecto'/></td>";
                        } else {
                            $html .= "<td style='border: 1px solid #ddd; text-align: center;'><span>Error: Imagen por defecto no encontrada</span></td>";
                        }
                    }
    
                    $html .= "</tr>";
                }
            }
    
            $html .= "</tbody></table>";
            $html .= "</div></body></html>";
    
            // Guardar HTML para verificación
            file_put_contents('debug.html', $html);
    
            // Configuración de DOMPDF
            $options = new Options();
            $options->set('isRemoteEnabled', true);
            $pdf = new DOMPDF($options);
    
            // Configuración del PDF
            $pdf->set_paper("A4", "portrait");
            $pdf->load_html(mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8'));
    
            // Renderizar el PDF
            $pdf->render();
    
            // Enviar el PDF al navegador
            $pdf->stream('ReporteEmpleado.pdf', array("Attachment" => false));
    
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
    
    
	
	
  function obtenercargos()
    {
        $co = $this->conecta();
        $co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $p = $co->prepare("SELECT * FROM cargo");
        $p->execute();
        $r = $p->fetchAll(PDO::FETCH_ASSOC);
        return $r;
    }
	
	
	
	
}
?>