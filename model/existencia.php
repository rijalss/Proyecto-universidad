<?php

require_once('conexion.php');

class Existencia extends Conexion
{

    //////////////////////////METODOS//////////////////////////
 
    function consultar()
    {
        $co = $this->conecta();
        $co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $r = array();
        try {

            $resultado = $co->query("SELECT 
            producto.nombreProducto,
            existencia.cantidadExistencia,
            categoria.nombreCategoria,
            notaentrada.fechaEntrada,
            notasalida.fechaSalida,
            proveedor.nombreProveedor
            FROM 
            inventario.existencia
            INNER JOIN inventario.producto ON existencia.clProducto = producto.clProducto
            INNER JOIN inventario.categoria ON producto.clCategoria = categoria.clCategoria
            INNER JOIN inventario.notaentrada ON existencia.clExistencia = notaentrada.clEntrada
            INNER JOIN inventario.notasalida ON existencia.clExistencia = notasalida.clSalida
            INNER JOIN inventario.proveedor ON notaentrada.clProveedor = proveedor.clProveedor;
             ");

            if ($resultado) {

                $respuesta = '';
                foreach ($resultado as $r) {
                    $respuesta = $respuesta . "<tr>";                   
                    $respuesta = $respuesta . "<td>";
                    $respuesta = $respuesta . $r['nombreProducto'];
                    $respuesta = $respuesta . "</td>";
                    $respuesta = $respuesta . "<td>";
                    $respuesta = $respuesta . $r['cantidadExistencia'];
                    $respuesta = $respuesta . "</td>";
                    $respuesta = $respuesta . "<td>";
                    $respuesta = $respuesta . $r['nombreCategoria'];
                    $respuesta = $respuesta . "</td>";
                    $respuesta = $respuesta . "<td>";
                    $respuesta = $respuesta . $r['fechaEntrada'];
                    $respuesta = $respuesta . "</td>";
                    $respuesta = $respuesta . "<td>";
                    $respuesta = $respuesta . $r['fechaSalida'];
                    $respuesta = $respuesta . "</td>";
                    $respuesta = $respuesta . "<td>";
                    $respuesta = $respuesta . $r['nombreProveedor'];
                    $respuesta = $respuesta . "</td>";
                    $respuesta = $respuesta . "</tr>";
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
