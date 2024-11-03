<?php
require_once("model/conexion.php");
require_once('public/lib/dompdf/vendor/autoload.php'); //archivo para cargar las funciones de la 
		//libreria DOMPDF
		// lo siguiente es hacer rerencia al espacio de trabajo
use Dompdf\Dompdf; 
use Dompdf\Options; 
class Rentrada extends Conexion{
    
    private $clEntrada;
    private $FechaEntrada;
    private $Fechainicio;
    private $Fechafinal;
    private $codCategoria;

    // SETTERS

    
       public function setClEntrada($clEntrada) { 
        $this->clEntrada = $clEntrada; }

        public function getClEntrada() {
             return $this->clEntrada; } 
             
        public function setFechaEntrada($FechaEntrada) { 
            $this->FechaEntrada = $FechaEntrada; }
            
        public function getFechaEntrada() { 
                return $this->FechaEntrada; }  
                
        public function setFechainicio($Fechainicio) { 
                    $this->Fechainicio = $Fechainicio; } 
                    
        public function getFechainicio() { 
            return $this->Fechainicio; }  

        public function setFechafinal($Fechafinal) { 
            $this->Fechafinal = $Fechafinal; 
        } 
            
        public function getFechafinal() { 
                return $this->Fechafinal;
            } 


    // CONSULTAR

    public function consultar(){
        $co = $this->conecta();
        $co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $r = array();
        try {
            $resultado = $co->query("SELECT * FROM notaentrada  INNER JOIN proveedor on notaentrada.clProveedor= proveedor.clProveedor INNER JOIN empleado on notaentrada.clEmpleado=empleado.clEmpleado");

            if ($resultado) {
                $respuesta = '';
                foreach ($resultado as $r) {
                    $respuesta .= "<tr>";
                    $respuesta .= "<td>" . $r['clEntrada'] . "</td>";
                    $respuesta .= "<td>" . $r['fechaEntrada'] . "</td>";
                    $respuesta .= "<td>" . $r['numFactura'] . "</td>";
                    $respuesta .= "<td>" . $r['nombreProveedor'] . "</td>";
                    $respuesta .= "<td>" . $r['nombreEmpleado'] . "</td>";
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
   public function filtrar(){
        $co = $this->conecta();
        $co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $r = array();
        try {
            $resultado = $co->query("SELECT * FROM notaentrada  INNER JOIN proveedor on notaentrada.clProveedor= proveedor.clProveedor INNER JOIN empleado on notaentrada.clEmpleado=empleado.clEmpleado 
            WHERE notaentrada.fechaEntrada BETWEEN '$this->Fechainicio' AND '$this->Fechafinal'");

            if ($resultado) {
                $respuesta = '';
                foreach ($resultado as $r) {
                    $respuesta .= "<tr>";
                    $respuesta .= "<td>" . $r['clEntrada'] . "</td>";
                    $respuesta .= "<td>" . $r['fechaEntrada'] . "</td>";
                    $respuesta .= "<td>" . $r['numFactura'] . "</td>";
                    $respuesta .= "<td>" . $r['nombreProveedor'] . "</td>";
                    $respuesta .= "<td>" . $r['nombreEmpleado'] . "</td>";
                    $respuesta .= "</tr>";
                }

                $r['resultado'] = 'filtrar';
                $r['mensaje'] =  $respuesta;
            } else {
                $r['resultado'] = 'filtrar';
                $r['mensaje'] =  'No hay en estas  fechass';
            }
        } catch (Exception $e) {
            $r['resultado'] = 'error';
            $r['mensaje'] =  $e->getMessage();
        }
        return $r;
    }
    public function generarPDF(){
        $co = $this->conecta();
        $co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        try{  
            $resultado = $co->prepare("SELECT * FROM notaentrada  INNER JOIN proveedor on notaentrada.clProveedor= proveedor.clProveedor 
            INNER JOIN empleado on notaentrada.clEmpleado=empleado.clEmpleado
            WHERE (notaentrada.fechaEntrada >= :fechasinicio and notaentrada.fechaEntrada <= :fechafin)");

            $resultado->bindParam(':fechasinicio', $this->Fechainicio);
            $resultado->bindParam(':fechafin', $this->Fechafinal);
            $resultado->execute();
            $fila = $resultado->fetchAll(PDO::FETCH_ASSOC);
            
            
            $html = "<html><head>";
            $html .= "<style>
            body { font-family: Arial, sans-serif; background-color: #fff; color: #333; margin: 0; padding: 0; }
            .container { width: 90%; max-width: 1000px; margin: 20px auto; border: 1px solid #ddd; background-color: #fff; padding: 20px; }
            .header { text-align: center; margin-bottom: 20px; }
            h1 { font-size: 24px; color: #555; margin: 0; }
            table { width: 100%; border-collapse: collapse; margin-top: 20px; }
            th, td { padding: 12px; text-align: center; font-size: 14px; color: #555; } /* Cambiado a text-align: center */
            th { background-color: #007bff; color: #fff; border-bottom: 2px solid #0056b3; }
            tr:nth-child(even) { background-color: #f2f2f2; }
            tr:hover { background-color: #e0f7fa; }
              </style>";
            $html .= "</head><body>";
            $html .= "<div class='container'>";
            $html .= "<div class='header'><h1>Reporte de Notas de Entrada</h1></div>";
            $html .= "<table>";
            $html .= "<thead style='border: 1px solid #ddd; text-align: center;'>";
            $html .= "<tr>";
            $html .= "<th text-align: center;'>Número de entrada</th>";
            $html .= "<th text-align: center;'>Fecha</th>";
            $html .= "<th text-align: center;'>Factura</th>";
            $html .= "<th text-align: center;'>Proveedor</th>";
            $html .= "<th text-align: center;'>Empleado</th>";

            $html .= "</tr>";
            $html .= "</thead>";
            $html .= "<tbody>";

            if ($fila) {
                foreach ($fila as $f) {
                    $html .= "<tr>";
                    $html .= "<td style='border: 1px solid #ddd; text-align: center;'>" . htmlspecialchars($f['clEntrada']). "</td>";
                    $html .= "<td style='border: 1px solid #ddd; text-align: center;'>" . htmlspecialchars($f['fechaEntrada']) . "</td>";
                    $html .= "<td style='border: 1px solid #ddd; text-align: center;'>" . htmlspecialchars($f['numFactura']) . "</td>";
                    $html .= "<td style='border: 1px solid #ddd; text-align: center;'>" . htmlspecialchars($f['nombreProveedor']) . "</td>";
                    $html .= "<td style='border: 1px solid #ddd; text-align: center;'>" . htmlspecialchars($f['nombreEmpleado']) . "</td>";
                    $html .= "</tr>";
                    $html = $html . "</tr>";
                }
            } else {
                $html .= "<tr><td colspan='3'>No hay datos disponibles</td></tr>";
            }

            $html .= "</tbody>";
            $html .= "</table>";
            $html .= "</div>";
            $html .= "</body></html>";

            file_put_contents('debug.html', $html);

            $options = new Options();
            $options->set('isRemoteEnabled', true);

            $pdf = new DOMPDF($options);
    
            // Configuración del PDF
            $pdf->set_paper("A4", "portrait");
            $pdf->load_html(mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8'));
    
            // Renderizar el PDF
            $pdf->render();
    
            // Enviar el PDF al navegador
            $pdf->stream('ReporteMovimientosdeentrada.pdf', array("Attachment" => true));
    
           
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
