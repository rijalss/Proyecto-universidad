<?php
require_once('public/lib/dompdf/vendor/autoload.php');

use Dompdf\Dompdf;

require_once("model/conexion.php");

class Rempleado extends Conexion
{

    private $cedulaEmpleado;
    private $nombreEmpleado;
    private $apellidoEmpleado;

    private $clCargo;

    function set_cedulaEmpleado($valor)
    {
        $this->cedulaEmpleado = $valor;
    }
    function set_nombreEmpleado($valor)
    {
        $this->nombreEmpleado = $valor;
    }
    function set_apellidoEmpleado($valor)
    {
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

    function generarPDF()
    {

        $co = $this->conecta();
        $co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        try {
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
            $html .= "<div class='header'><h1>Reporte de Empleados</h1></div>";
            $html .= "<table>";
            $html .= "<thead>";
            $html .= "<tr>";
            $html .= "<th>Cedula</th>";
            $html .= "<th>Nombre</th>";
            $html .= "<th>Apellido</th>";
            $html .= "<th>Correo</th>";
            $html .= "<th>Telefono</th>";
         ;
            $html .= "<th>Foto</th>";
            $html .= "</tr>";
            $html .= "</thead>";
            $html .= "<tbody>";


            if ($fila) {
                foreach ($fila as $f) {
                    $html .= "<tr>";
                    $html .= "<td>" . htmlspecialchars($f['prefijoCedula'] . '-' . $f['cedulaEmpleado']) . "</td>";
                    $html .= "<td>" . htmlspecialchars($f['nombreEmpleado']) . "</td>";
                    $html .= "<td>" . htmlspecialchars($f['apellidoEmpleado']) . "</td>";
                    $html .= "<td>" . htmlspecialchars($f['correoEmpleado']) . "</td>";
                    $html .= "<td>" . htmlspecialchars($f['telefonoEmpleado']) . "</td>";
                    
                    $imagenURL = "public/img/img-empleado/" . $f['cedulaEmpleado'] . ".png";


                    if (is_file($imagenURL)) {
                        $imagenData = file_get_contents($imagenURL);
                        if ($imagenData !== false) {
                            $imagenURL64 = "data:image/png;base64," . base64_encode($imagenData);
                            $html .= "<td  text-align: center;'>" .
                            "<img style='width:90px; height:50px;' src='$imagenURL64' alt=''/></td>";
                        } else {
                            // Error al leer el archivo de imagen
                            $html .= "<td style='border: 1px solid #ddd; text-align: center;'><span>Error: No se pudo leer la imagen</span></td>";
                        }
                    } else {
                        // Imagen por defecto si no se encuentra la imagen personalizada
                        $imagenPorDefecto = "public/img/img-empleado/perfil.jpg";
                        $imagenData = file_get_contents($imagenPorDefecto);
                        if ($imagenData !== false) {
                            $imagenURL64 = "data:image/png;base64," . base64_encode($imagenData);
                            $html .= "<td style='border: 1px solid #ddd; text-align: center;'>" .
                            "<img style='width:90px; height:50px;' src='$imagenURL64' alt='Imagen por defecto'/></td>";
                        } else {
                            $html .= "<td style='border: 1px solid #ddd; text-align: center;'><span>Error: Imagen por defecto no encontrada</span></td>";
                        }
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
        $pdf->stream('ReporteEmpleados.pdf', array("Attachment" => false));
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
