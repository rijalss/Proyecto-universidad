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
    private $numFactura;
    private $clProveedor;
    private $clEmpleado;

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


        public function setclEmpleado($clEmpleado)  {
        $this->clEmpleado = $clEmpleado;
            }

         public function getclEmpleado()  {
        return $this->clEmpleado;
            }     

         public function setclProveedor($clProveedor){
        $this->clProveedor = $clProveedor;
             }

         public function getclProveedor(){
        return $this->clProveedor;
            }
    public function setnumFactura($numFactura){
        $this->numFactura = $numFactura;
    }

    public function getnumFactura(){
        return $this->numFactura;
    }    


    function generarPDF(){

        $co = $this->conecta();
        $co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        try {
            $fechasinicio = !empty($this->fechainicio) ? $this->Fechainicio : null; 
            $fechafin = !empty($this->fechafinal) ? $this->Fechafinal : null;
$resultado = $co->prepare(" SELECT empleado.nombreEmpleado, proveedor.nombreProveedor, notaentrada.fechaEntrada, notaentrada.numFactura, administrarentrada.cantidadEntrada, producto.nombreProducto
FROM notaentrada 
INNER JOIN empleado ON notaentrada.clEmpleado = empleado.clEmpleado
INNER JOIN proveedor ON notaentrada.clProveedor = proveedor.clProveedor
INNER JOIN administrarentrada ON notaentrada.clEntrada = administrarentrada.clEntrada
INNER JOIN existencia ON administrarentrada.clExistencia = existencia.clExistencia
INNER JOIN producto ON producto.clProducto = existencia.clProducto
WHERE proveedor.clProveedor LIKE :clProveedor
AND empleado.clEmpleado LIKE :clEmpleado 
AND notaentrada.numFactura LIKE :numFactura 
AND (DATE(notaentrada.fechaEntrada) BETWEEN :fechasinicio AND :fechafin OR :fechasinicio IS NULL OR :fechafin IS NULL)

"

);
            $numFactura = $this->numFactura . '%'; 
            $resultado->bindValue(':numFactura', $numFactura);
            $resultado->bindValue(':clProveedor', '%' . $this->clProveedor . '%' );
            $resultado->bindValue(':clEmpleado', '%' . $this->clEmpleado . '%' );
            $resultado->bindValue(':fechasinicio', $this->Fechainicio);
            $resultado->bindValue(':fechafin', $this->Fechafinal);


            $resultado->execute();
            $fila = $resultado->fetchAll(PDO::FETCH_ASSOC);

            $html = "<html><head>";
            $html .="<style>
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
            $html .= "<img src='$base64' >";
            $html .= "<h1>Reporte Notas de Entrada</h1>";
            $html .= "</div>";
            $html .= "<table>";
            $html .= "<thead>";
            $html .= "<tr>";
            $html .= "<th>Factura</th>";
            $html .= "<th>Nombre Empleado</th>";
            $html .= "<th>Nombre Proveedor</th>";
             $html .= "<th>Nombre de Producto</th>";
            $html .= "<th>Fecha de la entrada</th>";
            $html .= "<th>Cantidad de la Entrada</th>";
           
          
            $html .= "</tr>";
            $html .= "</thead>";
            $html .= "<tbody>";


            if ($fila) {
                foreach ($fila as $f) {
                    $html .= "<tr>";
                    $html .= "<td>" . htmlspecialchars($f['numFactura']) . "</td>";
                    $html .= "<td>" . htmlspecialchars($f['nombreEmpleado']) . "</td>";
                    $html .= "<td>" . htmlspecialchars($f['nombreProveedor']) . "</td>";
                    $html .= "<td>" . htmlspecialchars($f['nombreProducto']) . "</td>";
                    $html .= "<td>" . htmlspecialchars($f['fechaEntrada']) . "</td>";
                    $html .= "<td>" . htmlspecialchars($f['cantidadEntrada']) . "</td>";
                    

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
        $pdf->stream('Reportedeentradas.pdf', array("Attachment" => false));
    }

  public function filtrar(){
        $co = $this->conecta();
        $co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $r = array();
        try {
            $resultado = $co->prepare("SELECT empleado.nombreEmpleado, proveedor.nombreProveedor, notaentrada.fechaEntrada, notaentrada.numFactura, administrarentrada.cantidadEntrada, producto.nombreProducto
FROM notaentrada 
INNER JOIN empleado ON notaentrada.clEmpleado = empleado.clEmpleado
INNER JOIN proveedor ON notaentrada.clProveedor = proveedor.clProveedor
INNER JOIN administrarentrada ON notaentrada.clEntrada = administrarentrada.clEntrada
INNER JOIN existencia ON administrarentrada.clExistencia = existencia.clExistencia
INNER JOIN producto ON producto.clProducto = existencia.clProducto WHERE DATE(notaentrada.fechaEntrada) 
BETWEEN :fechasinicio AND :fechafin ");


            $resultado->bindValue(':fechasinicio', $this->Fechainicio);
            $resultado->bindValue(':fechafin', $this->Fechafinal);
            $resultado->execute();
            $fila = $resultado->fetchAll(PDO::FETCH_ASSOC);
            if ($fila) {
                $respuesta = '';
                foreach ($fila as $r) {
                    $respuesta .= "<tr>";
                    $respuesta .= "<td>" . $r['numFactura'] . "</td>";
                    $respuesta .= "<td>" . $r['nombreEmpleado'] . "</td>";
                    $respuesta .= "<td>" . $r['nombreProveedor'] . "</td>";
                    $respuesta .= "<td>" . $r['nombreProducto'] . "</td>";
                    $respuesta .= "<td>" . $r['fechaEntrada'] . "</td>";
                    $respuesta .= "<td>" . $r['cantidadEntrada'] . "</td>";
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

    public function consultar()
    {
        $co = $this->conecta();
        $co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $r = array();
        try {
            $resultado = $co->query("SELECT empleado.nombreEmpleado, proveedor.nombreProveedor, notaentrada.fechaEntrada, notaentrada.clEntrada, notaentrada.numFactura, administrarentrada.cantidadEntrada, producto.nombreProducto
            FROM notaentrada 
            INNER JOIN empleado ON notaentrada.clEmpleado = empleado.clEmpleado
            INNER JOIN proveedor ON notaentrada.clProveedor = proveedor.clProveedor
            INNER JOIN administrarentrada ON notaentrada.clEntrada = administrarentrada.clEntrada
            INNER JOIN existencia ON administrarentrada.clExistencia = existencia.clExistencia
            INNER JOIN producto ON producto.clProducto = existencia.clProducto");

            if ($resultado) {
                $respuesta = '';
                foreach ($resultado as $r) {
                    $respuesta .= "<tr>";
                 
                    $respuesta .= "<td>" . $r['numFactura'] . "</td>";
                    $respuesta .= "<td>" . $r['nombreEmpleado'] . "</td>";
                    $respuesta .= "<td>" . $r['nombreProveedor'] . "</td>";
                    $respuesta .= "<td>" . $r['nombreProducto'] . "</td>";
                    $respuesta .= "<td>" . $r['fechaEntrada'] . "</td>";
                    $respuesta .= "<td>" . $r['cantidadEntrada'] . "</td>";
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
