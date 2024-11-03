<?php
require_once('public/lib/dompdf/vendor/autoload.php');

use Dompdf\Dompdf;
use Dompdf\Options;

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
        // Conexión y consulta SQL
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

            // Construcción del HTML básico
            $html = "<html><head></head><body>";
            $html .= "<div style='width:100%; border: solid 1px #ddd;'>";
            $html .= "<table style='width:100%; border-collapse: collapse;'>";
            $html .= "<thead><tr style='background-color: #007bff; color: #fff; border: 2px solid #0056b3;'>";
            $html .= "<th style='border: 0px solid #ddd; text-align: center;'>Código</th>";
            $html .= "<th style='border: 0px solid #ddd; text-align: center;'>Nombre</th>";
            $html .= "<th style='border: 0px solid #ddd; text-align: center;'>Descripción</th>";
            $html .= "<th style='border: 0px solid #ddd; text-align: center;'>Categoria</th>";
            $html .= "<th style='border: 0px solid #ddd; text-align: center;'>Foto</th>";
            $html .= "</tr></thead><tbody>";

            if ($fila) {
                foreach ($fila as $f) {
                    $html .= "<tr>";
                    $html .= "<td style='border: 1px solid #ddd; text-align: center;'>" . $f['codProducto'] . "</td>";
                    $html .= "<td style='border: 1px solid #ddd; text-align: center;'>" . $f['nombreProducto'] . "</td>";
                    $html .= "<td style='border: 1px solid #ddd; text-align: center;'>" . $f['descProducto'] . "</td>";
                    $html .= "<td style='border: 1px solid #ddd; text-align: center;'>" . $f['nombreCategoria'] . "</td>";


                    // Construcción de la imagen de perfil en base64
                    $imagenURL = "public/producto/" . $f['codProducto'] . ".png";

                    // Comprobar si la imagen existe y convertirla a base64
                    if (is_file($imagenURL)) {
                        $imagenData = file_get_contents($imagenURL);
                        if ($imagenData !== false) {
                            $imagenURL64 = "data:image/png;base64," . base64_encode($imagenData);
                            $html .= "<td style='border: 1px solid #ddd; text-align: center;'>" .
                                "<img style='width:90px; height:50px;' src='$imagenURL64' alt=''/></td>";
                        } else {
                            // Error al leer el archivo de imagen
                            $html .= "<td style='border: 1px solid #ddd; text-align: center;'><span>Error: No se pudo leer la imagen</span></td>";
                        }
                    } else {
                        // Imagen por defecto si no se encuentra la imagen personalizada
                        $imagenPorDefecto = "public/producto/producto.jpg";
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
            $pdf->stream('ReporteProducto.pdf', array("Attachment" => false));
        } catch (Exception $e) {
            return $e->getMessage();
        }
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
