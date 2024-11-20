<?php
require_once('public/lib/dompdf/vendor/autoload.php');
use Dompdf\Dompdf;
use Dompdf\Options;
require_once("model/conexion.php");

class Rexistencia extends Conexion
{
 
    

    function generarPDF(){

        $co = $this->conecta();
        $co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        try {
            $resultado = $co->prepare("SELECT * FROM producto INNER JOIN existencia on producto.clProducto=existencia.clProducto 
            INNER JOIN categoria ON categoria.clCategoria=producto.clCategoria");

           
            $resultado->execute();
            $fila = $resultado->fetchAll(PDO::FETCH_ASSOC);

            $html = "<html><head>";
            $html .= '<meta charset="UTF-8">';
            $html .= "<style>
           .header { text-align: center; margin-bottom: 40px; position: relative; } 
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
            $html .= "<h1>Reporte de Existencias</h1>";
            $html .= "</div>";
            $html .= "<table>";
            $html .= "<thead>";
            $html .= "<tr>";
            $html .= "<th>Nombre producto</th>";
            $html .= "<th>Categoria</th>";
            $html .= "<th>Cantidad en almacen</th>";
            $html .= "<th>Cantidad en mostrador</th>";
            $html .= "</tr>";
            $html .= "</thead>";
            $html .= "<tbody>";


            if ($fila) {
                foreach ($fila as $f) {
                    $html .= "<tr>";
                    $html .= "<td>" . htmlspecialchars($f['nombreProducto']) . "</td>";
                    $html .= "<td>" . htmlspecialchars($f['nombreCategoria']) . "</td>";
                    $html .= "<td>" . htmlspecialchars($f['cantidadExistencia']) . "</td>";
                    $html .= "<td>" . htmlspecialchars($f['cantidadMostrador']) . "</td>";
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
            $html = mb_convert_encoding($html, 'UTF-8', 'UTF-8');
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $pdf = new DOMPDF();

        // Definimos el tamaño y orientación del papel que queremos.
        $pdf->set_paper("A4", "portrait");

        // Cargamos el contenido HTML.
        $pdf->load_html($html);

        // Renderizamos el documento PDF.
        $pdf->render();

        // Enviamos el fichero PDF al navegador.
        $pdf->stream('Reportedeexistencias.pdf', array("Attachment" => false));
       
    }

    function generarPDFalmacen(){

        $co = $this->conecta();
        $co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        try {
            $resultado = $co->prepare("SELECT * FROM producto INNER JOIN existencia on producto.clProducto=existencia.clProducto 
            INNER JOIN categoria ON categoria.clCategoria=producto.clCategoria Where cantidadExistencia > 0");

            
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
            $html .= "<img src='$base64' >";
            $html .= "<h1>Reporte de Existencias en Almacen</h1>";
            $html .= "</div>";
            $html .= "<table>";
            $html .= "<thead>";
            $html .= "<tr>";
            $html .= "<th>Nombre producto</th>";
            $html .= "<th>Categoria</th>";
            $html .= "<th>Cantidad en almacen</th>";
            $html .= "</tr>";
            $html .= "</thead>";
            $html .= "<tbody>";


            if ($fila) {
                foreach ($fila as $f) {
                    $html .= "<tr>";
                    $html .= "<td>" . htmlspecialchars($f['nombreProducto']) . "</td>";
                    $html .= "<td>" . htmlspecialchars($f['nombreCategoria']) . "</td>";
                    $html .= "<td>" . htmlspecialchars($f['cantidadExistencia']) . "</td>";
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
         /* echo $html;
            exit;*/
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }

                // Instanciamos un objeto de la clase DOMPDF.
        $pdf = new DOMPDF();

        // Definimos el tamaño y orientación del papel que queremos.
        $pdf->set_paper("A4", "portrait");

        // Cargamos el contenido HTML.
        $pdf->load_html(utf8_decode($html));

        // Renderizamos el documento PDF.
        $pdf->render();

        // Enviamos el fichero PDF al navegador.
        $pdf->stream('ReporteExistenciaAlmacen.pdf', array("Attachment" => false));
 }

        function generarPDFmostrador(){

            $co = $this->conecta();
            $co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            try {
                $resultado = $co->prepare("SELECT * FROM producto INNER JOIN existencia on producto.clProducto=existencia.clProducto 
            INNER JOIN categoria ON categoria.clCategoria=producto.clCategoria Where cantidadMostrador > 0");

                
                $resultado->execute();
                $fila = $resultado->fetchAll(PDO::FETCH_ASSOC);

                $html = "<html><head>";
                $html .= "<style>
       .header { text-align: center; margin-bottom: 40px; position: relative; }  
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
                $html .= "<h1>Reporte de Existencias en Mostrador</h1>";
                $html .= "</div>";
                $html .= "<table>";
                $html .= "<thead>";
                $html .= "<tr>";
                $html .= "<th>Nombre producto</th>";
                $html .= "<th>Categoria</th>";
                $html .= "<th>Cantidad en mostrador</th>";
                $html .= "</tr>";
                $html .= "</thead>";
                $html .= "<tbody>";


                if ($fila) {
                    foreach ($fila as $f) {
                        $html .= "<tr>";
                        $html .= "<td>" . htmlspecialchars($f['nombreProducto']) . "</td>";
                        $html .= "<td>" . htmlspecialchars($f['nombreCategoria']) . "</td>";
                        $html .= "<td>" . htmlspecialchars($f['cantidadMostrador']) . "</td>";
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
               /* echo $html;
           exit;*/
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }

                    // Instanciamos un objeto de la clase DOMPDF.
        $pdf = new DOMPDF();

        // Definimos el tamaño y orientación del papel que queremos.
        $pdf->set_paper("A4", "portrait");

        // Cargamos el contenido HTML.
        $pdf->load_html(utf8_decode($html));

        // Renderizamos el documento PDF.
        $pdf->render();

        // Enviamos el fichero PDF al navegador.
        $pdf->stream('ReporteExistenciaMostardor.pdf', array("Attachment" => false));

    }  
}