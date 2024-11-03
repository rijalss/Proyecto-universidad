<?php
require_once('public/lib/dompdf/vendor/autoload.php');

use Dompdf\Dompdf;
use Dompdf\Options;

require_once("model/conexion.php");
class Rsalida extends Conexion{
    private $clSalida;
    private $fechaSalida;
    private $fechaInicio;
    private $fechaFinal;


    public function set_clSalida($clSalida) {

        $this->clSalida = $clSalida; 
    }
 
   public function set_fechaSalida($fechaSalida){
       
        $this->fechaSalida = $fechaSalida;
    }
    public function set_fechaInicio($fechaInicio)
    {
        $this->fechaInicio = $fechaInicio;
    }
    public function set_fechaFinal($fechaFinal){
        $this->fechaFinal = $fechaFinal;
    }

    public function get_ClSalida(){
        return $this->clSalida;
    }  

    public function get_fechaSalida(){
        return $this->fechaSalida;
    }

    public function get_fechaInicio(){
        return $this->fechaInicio;
    }

    public function get_fechaFinal(){
        return $this->fechaFinal;
    }

    public function GenerarPDF(){
        $co = $this->conecta();
        $co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        try {
            $resultado = $co->prepare("SELECT * FROM notasalida INNER JOIN empleado on notasalida.clEmpleado=empleado.clEmpleado
            WHERE (notasalida.fechaSalida >= :fechasinicio and notasalida.fechaSalida <= :fechafin)");

            $resultado->bindParam(':fechasinicio', $this->fechaInicio);
            $resultado->bindParam(':fechafin', $this->fechaFinal);
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
            $html .= "<div class='header'><h1>Reporte de Notas de Salida</h1></div>";
            $html .= "<table>";
            $html .= "<thead style='border: 1px solid #ddd; text-align: center;'>";
            $html .= "<tr>";
            $html .= "<th text-align: center;'>Número de Salida</th>";
            $html .= "<th text-align: center;'>Fecha</th>";
            $html .= "<th text-align: center;'>Empleado</th>";

            $html .= "</tr></thead><tbody>";

            if ($fila) {
                foreach ($fila as $f) {
                    $html .= "<tr>";
                    $html .= "<td style='border: 1px solid #ddd; text-align: center;'>" . htmlspecialchars($f['clSalida']) . "</td>";
                    $html .= "<td style='border: 1px solid #ddd; text-align: center;'>" . htmlspecialchars($f['fechaSalida']) . "</td>";
                    $html .= "<td style='border: 1px solid #ddd; text-align: center;'>" . htmlspecialchars($f['nombreEmpleado']) . "</td>";
                    $html .= "</tr>";
                }
            }
            $html .= "</tbody></table>";
            $html .= "</div></body></html>";

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

    public function Filtrar(){
        $co = $this->conecta();
        $co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $r = array();
        try {
            $resultado = $co->query("SELECT * FROM notasalida INNER JOIN empleado on notasalida.clEmpleado=empleado.clEmpleado 
            WHERE notasalida.fechaSalida BETWEEN '$this->fechaInicio' AND '$this->fechaFinal'");

            if ($resultado) {
                $respuesta = '';
                foreach ($resultado as $r) {
                    $respuesta .= "<tr>";
                    $respuesta .= "<td>" . $r['clSalida'] . "</td>";
                    $respuesta .= "<td>" . $r['fechaSalida'] . "</td>";
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

    public function Consultar(){
        $co = $this->conecta();
        $co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $r = array();
        try {
            $resultado = $co->query("SELECT * FROM notasalida INNER JOIN empleado on notasalida.clEmpleado=empleado.clEmpleado");

            if ($resultado) {
                $respuesta = '';
                foreach ($resultado as $r) {
                    $respuesta .= "<tr>";
                    $respuesta .= "<td>" . $r['clSalida'] . "</td>";
                    $respuesta .= "<td>" . $r['fechaSalida'] . "</td>";
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
}



?>