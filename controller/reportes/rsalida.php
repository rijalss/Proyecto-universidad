<?php

if (!is_file("model/reportes/" . $pagina . ".php")) {
    echo "Falta definir la clase " . $pagina;
    exit;
}
require_once("model/reportes/" . $pagina . ".php");
if (is_file("views/reportes/" . $pagina . ".php")) {


    $Ob2 = new Rsalida();
    if (!empty($_POST)) {
        

        $accion = $_POST['accion'];

        if ($accion == 'consultar') {
            echo  json_encode($Ob2->Consultar());
        }
        if ($accion == 'filtrar') {
            $inicio = date("y-m-d", strtotime($_POST['fecha_inicio']));
            $fin = date("y-m-d", strtotime($_POST['fecha_fin']));
            $Ob2->set_fechainicio($inicio);
            $Ob2->set_fechafinal($fin);

            echo  json_encode($Ob2->filtrar());
        }

 
        if (isset($_POST['generar'])) {
            $Ob3 = new Rsalida();
           /* $inicio = date("y-m-d", strtotime($_POST['fecha_inicio']));
            $fin = date("y-m-d", strtotime($_POST['fecha_fin']));
            $Ob3->set_FechaInicio($inicio);
            $Ob3->set_FechaFinal($fin);*/
        //
            if (!empty($_POST['empleado'])) {
                $Ob3->set_clEmpleado($_POST['empleado']);
        
            }
            if (!empty($_POST['fecha_inicio'])) {      

                // $inicio=date("y-m-d", strtotime( $_POST['finicio']));
                $Ob3->set_fechainicio($_POST['fecha_inicio']);
            }
            if (!empty($_POST['fecha_fin'])) {

                //  $fin= date("y-m-d", strtotime( $_POST['ffin']));
                $Ob3->set_fechafinal($_POST['fecha_fin']);
            } 
           
            // Generamos el PDF
        $Ob3->generarPDF();
        }
        exit;
    }   
    $empleados = $Ob2->obtenerempleado();
    require_once("views/reportes/" . $pagina . ".php");
} else {
    echo "pagina en construccion";
}
?>
