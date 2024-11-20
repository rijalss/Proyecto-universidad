<?php
require_once('public/lib/dompdf/vendor/autoload.php');

use Dompdf\Dompdf;
//use Dompdf\Options;

require_once("model/conexion.php");
class Rsalida extends Conexion{
    private $clSalida;
    private $fechaSalida;
    private $fechainicio;
    private $fechafinal;            
    private $clEmpleado;
    private $ubi;

    public function set_clSalida($clSalida) {

        $this->clSalida = $clSalida; 
    }
 
   public function set_fechaSalida($fechaSalida){
       
        $this->fechaSalida = $fechaSalida;
    }
    public function set_fechainicio($fechainicio)
    {
        $this->fechainicio = $fechainicio;
    }
    public function set_fechafinal($fechafinal){
        $this->fechafinal = $fechafinal;
    }
    public function set_ubi($ubi){
        $this->ubi = $ubi;
    }

    public function get_ClSalida(){
        return $this->clSalida;
    }  

    public function get_fechaSalida(){
        return $this->fechaSalida;
    }

    public function get_fechainicio(){
        return $this->fechainicio;
    }

    public function get_fechafinal(){
        return $this->fechafinal;
    }

    public function set_clEmpleado($clEmpleado) {

        $this->clEmpleado = $clEmpleado; 
    }
 
    public function get_clEmpleado(){
        return $this->clEmpleado;
    }

    function generarPDF(){

        $co = $this->conecta();
        $co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        try {
           
           $fechasinicio = !empty($this->fechainicio) ? $this->fechainicio : null; 
            $fechafin = !empty($this->fechafinal) ? $this->fechafinal : null;
$resultado = $co->prepare(" SELECT empleado.nombreEmpleado, notasalida.fechaSalida, notasalida.ubicacionSalida, administrarsalida.cantidadSalida, producto.nombreProducto
FROM notasalida
 INNER JOIN empleado ON notasalida.clEmpleado = empleado.clEmpleado 
 INNER JOIN administrarsalida ON notasalida.clSalida = administrarsalida.clSalida
 INNER JOIN existencia ON administrarsalida.clExistencia = existencia.clExistencia 
 INNER JOIN producto ON producto.clProducto = existencia.clProducto 
 WHERE empleado.clEmpleado LIKE :clEmpleado
 AND notasalida.ubicacionSalida LIKE :ubicacion
 AND (DATE(notasalida.fechaSalida) BETWEEN :fechainicio AND :fechafinal OR :fechainicio IS NULL OR :fechafinal IS NULL) "

);


            $resultado->bindvalue(':clEmpleado', '%' . $this->clEmpleado . '%' );
            $resultado->bindvalue(':fechainicio', $this->fechainicio );
            $resultado->bindvalue(':fechafinal',  $this->fechafinal );
            $resultado->bindvalue(':ubicacion', '%' . $this->ubi . '%');

            $resultado->execute();
            $fila = $resultado->fetchAll(PDO::FETCH_ASSOC);

            $html = "<html><head>";
            $html .= "<style>
           .header { text-align: center; margin-bottom: 40px; position: relative; } /* Se aumentó el margin-bottom */ 
           .header img { position: absolute; top: -20px; left: -20px; width: 100px; }
            
            body { font-family: Arial, sans-serif; background-color: #fff; color: #333; margin: 0; padding: 0; }
            .container { width: 90%; max-width: 1000px; margin: 20px auto; border: 1px solid #ddd; background-color: #fff; padding: 20px; }
            
            h1 { font-size: 24px; color: #555; margin: 0; }
            table { width: 100%; border-collapse: collapse; margin-top: 20px; }
            th, td { padding: 12px; text-align: center; font-size: 14px; color: #555; } /* Cambiado a text-align: center */
            th { background-color: #007bff; color: #fff; border-bottom: 2px solid #0056b3; }
            tr:nth-child(even) { background-color: #f2f2f2; }
            tr:hover { background-color: #e0f7fa; }
              </style>";
            $html .= "</head><body>"; 
            $urllogo = 'public/img/logo.png'; 
            $type = pathinfo($urllogo, PATHINFO_EXTENSION);
            $data = file_get_contents($urllogo); 
            $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
            
                
            $html .= "<div class='container'>";
            
            $html .= "<div class='header'>";
            $html .="<img src='$base64' >";
            $html .= "<h1>Reporte Notas de Salida</h1>";
            $html .= "</div>";
        
           
            $html .= "<table>";
            $html .= "<thead>";
            $html .= "<tr>";
        
            $html .= "<th>Nombre Empleado</th>";
             $html .= "<th>Nombre Producto</th>";
            $html .= "<th>Fecha de la Salida</th>";
            $html .= "<th>Cantidad de la Salida</th>";
            $html .= "<th>Ubicacion</th>";
            
            
          
            $html .= "</tr>";
            $html .= "</thead>";
            $html .= "<tbody>";


            if ($fila) {
                foreach ($fila as $f) {
                    $html .= "<tr>";
        
                    $html .= "<td>" . htmlspecialchars($f['nombreEmpleado']) . "</td>";
                    $html .= "<td>" . htmlspecialchars($f['nombreProducto']) . "</td>";
                    $html .= "<td>" . htmlspecialchars($f['fechaSalida']) . "</td>";
                    $html .= "<td>" . htmlspecialchars($f['cantidadSalida']) . "</td>";

                    $ubicacion= $f['ubicacionSalida'];
                    if ($ubicacion=="1") {
                        $html .= "<td>Almacen</td>";
                    }else if($ubicacion=="2") {
                        $html .= "<td>Mostrador</td>";
                    }
                   
                   
                    
                    
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
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }



        // echo $html;
        // exit;




        // Instanciamos un objeto de la clase DOMPDF.
        $pdf = new DOMPDF();

        // Definimos el tamaño y orientación del papel que queremos.
        $pdf->set_paper("A4", "portrait");

        // Cargamos el contenido HTML.
        $pdf->load_html(utf8_decode($html));

        // Renderizamos el documento PDF.
        $pdf->render();

        // Enviamos el fichero PDF al navegador.
        $pdf->stream('Reportedesalida.pdf', array("Attachment" => false));
    }


    public function filtrar(){
        $co = $this->conecta();
        $co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $r = array();
        try {
            $resultado = $co->prepare("SELECT empleado.nombreEmpleado, notasalida.fechaSalida, notasalida.ubicacionSalida, administrarsalida.cantidadSalida, producto.nombreProducto FROM notasalida
 INNER JOIN empleado ON notasalida.clEmpleado = empleado.clEmpleado 
 INNER JOIN administrarsalida ON notasalida.clSalida = administrarsalida.clSalida
  INNER JOIN existencia ON administrarsalida.clExistencia = existencia.clExistencia 
  INNER JOIN producto ON producto.clProducto = existencia.clProducto WHERE DATE(notasalida.fechaSalida) BETWEEN :fechainicio AND :fechafinal");

            $resultado->bindvalue(':fechainicio',  $this->fechainicio );
            $resultado->bindvalue(':fechafinal',  $this->fechafinal );
            $resultado->execute();
            $fila = $resultado->fetchAll(PDO::FETCH_ASSOC);

            if ($fila) {
                $respuesta = '';
                foreach ($fila as $r) {
                    $respuesta .= "<tr>";
                   
                    $respuesta .= "<td>" . $r['fechaSalida'] . "</td>";
                    $respuesta .= "<td>" . $r['nombreEmpleado'] . "</td>";
                    $respuesta .= "<td>" . $r['nombreProducto'] . "</td>";
                    $respuesta .= "<td>" . $r['cantidadSalida'] . "</td>";
                    $ubicacion= $r['ubicacionSalida'];
                    if ($ubicacion=="1") {
                        $respuesta .= "<td>Almacen</td>";
                    }else if($ubicacion=="2") {
                        $respuesta .= "<td>Mostrador</td>";
                    }
                    $respuesta .= "</tr>";
                }

                $r['resultado'] = 'filtrar';
                $r['mensaje'] =  $respuesta;
            } else {
                $r['resultado'] = 'filtrar';
                $r['mensaje'] =  'No hay en estas  fechas';
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
            $resultado = $co->query("SELECT empleado.nombreEmpleado, notasalida.fechaSalida, notasalida.ubicacionSalida, administrarsalida.cantidadSalida, producto.nombreProducto FROM notasalida
 INNER JOIN empleado ON notasalida.clEmpleado = empleado.clEmpleado 
 INNER JOIN administrarsalida ON notasalida.clSalida = administrarsalida.clSalida
  INNER JOIN existencia ON administrarsalida.clExistencia = existencia.clExistencia 
  INNER JOIN producto ON producto.clProducto = existencia.clProducto");

            if ($resultado) {
                $respuesta = '';
                foreach ($resultado as $r) {
                    $respuesta .= "<tr>";
               
                    $respuesta .= "<td>" . $r['fechaSalida'] . "</td>";
                    $respuesta .= "<td>" . $r['nombreEmpleado'] . "</td>";
                    $respuesta .= "<td>" . $r['nombreProducto'] . "</td>";
                    $respuesta .= "<td>" . $r['cantidadSalida'] . "</td>";
                    $ubicacion= $r['ubicacionSalida'];
                    if ($ubicacion=="1") {
                        $respuesta .= "<td>Almacen</td>";
                    }else if($ubicacion=="2") {
                        $respuesta .= "<td>Mostrador</td>";
                    }
                   
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

    public function obtenerempleado(){
        $co = $this->conecta();
        $co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $p = $co->prepare("SELECT clEmpleado,nombreEmpleado FROM empleado ");
        $p->execute();
        $r = $p->fetchAll(PDO::FETCH_ASSOC);
        return $r;
    }
}



?>