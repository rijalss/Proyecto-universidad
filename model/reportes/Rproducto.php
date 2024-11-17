<?php
require_once('public/lib/dompdf/vendor/autoload.php');

use Dompdf\Dompdf;

require_once("model/conexion.php");

class Rproducto extends Conexion
{

    private $codProducto;
    private $nombreProducto;
    private $clCategoria;

    function set_codProducto($valor)
    {
        $this->codProducto = $valor;
    }
    function set_nombreProducto($valor)
    {
        $this->nombreProducto = $valor;
    }
    function get_clCategoria()
    {
        return $this->clCategoria;
    }

    function set_clCategoria($valor)
    {
        $this->clCategoria = $valor;
    }

    function generarPDF()
    {

        $co = $this->conecta();
        $co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        try {
            $resultado = $co->prepare(
                "SELECT p.*, c.nombreCategoria 
                FROM producto p 
                JOIN categoria c ON p.clCategoria = c.clCategoria 
                WHERE p.codProducto LIKE :codProducto 
                AND p.nombreProducto LIKE :nombreProducto 
                AND p.clCategoria LIKE :clCategoria"
            );

            $resultado->bindValue(':codProducto', '%' . $this->codProducto . '%');
            $resultado->bindValue(':nombreProducto', '%' . $this->nombreProducto . '%');
            $resultado->bindValue(':clCategoria', '%' . $this->clCategoria . '%');

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
            $html .= "<h1>Reporte de Productos</h1>";
            $html .= "</div>";
            $html .= "<table>";
            $html .= "<thead>";
            $html .= "<tr>";
            $html .= "<th>Codigo</th>";
            $html .= "<th>Nombre</th>";
            $html .= "<th>Descripcion</th>";
            $html .= "<th>Categoria</th>";
            $html .= "<th>Foto</th>";
            $html .= "</tr>";
            $html .= "</thead>";
            $html .= "<tbody>";


            if ($fila) {
                foreach ($fila as $f) {
                    $html .= "<tr>";
                    $html .= "<td>" . htmlspecialchars($f['codProducto']) . "</td>";
                    $html .= "<td>" . htmlspecialchars($f['nombreProducto']) . "</td>";
                    $html .= "<td>" . htmlspecialchars($f['descProducto']) . "</td>";
                    $html .= "<td>" . htmlspecialchars($f['nombreCategoria']) . "</td>";
                    $imagenURL = "public/img/img-producto/" . $f['codProducto'] . ".png";

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
                        $imagenPorDefecto = "public/img/img-producto/producto.jpg";
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

        // Instanciamos un objeto de la clase DOMPDF.
        $pdf = new DOMPDF();

        // Definimos el tamaño y orientación del papel que queremos.
        $pdf->set_paper("A4", "portrait");

        // Cargamos el contenido HTML.
        $pdf->load_html(utf8_decode($html));

        // Renderizamos el documento PDF.
        $pdf->render();

        // Enviamos el fichero PDF al navegador.
        $pdf->stream('ReporteProductos.pdf', array("Attachment" => false));
    }
    public function obtenerCategorias()
    {
        $co = $this->conecta();
        $co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $p = $co->prepare("SELECT * FROM categoria");
        $p->execute();
        $r = $p->fetchAll(PDO::FETCH_ASSOC);
        return $r;
    }
}
