<?php

if (!is_file("model/" . $pagina . ".php")) {
    echo "Falta definir la clase " . $pagina;
    exit;
}
require_once("model/" . $pagina . ".php");
if (is_file("views/" . $pagina . ".php")) {

    if (!empty($_POST)) {

        $e = new Empleado ();
        $accion = $_POST['accion'];

        if ($accion == 'consultar') {
            echo  json_encode($e->consultar());
        } elseif ($accion == 'eliminar') {
            $e->set_cedulaEmpleado($_POST['cedulaEmpleado']);
            echo  json_encode($e->eliminar());
        } else {
            $e->set_prefijoCedula($_POST['prefijoCedula']);
            $e->set_cedulaEmpleado($_POST['cedulaEmpleado']);
            $e->set_nombreEmpleado($_POST['nombreEmpleado']);
            $e->set_apellidoEmpleado($_POST['apellidoEmpleado']);
            $e->set_correoEmpleado($_POST['correoEmpleado']);
            $e->set_telefonoEmpleado($_POST['telefonoEmpleado']);
            $e->set_clCargo($_POST['cargo']);
            if ($accion == 'incluir') {
                echo  json_encode($e->incluir());
            } elseif ($accion == 'modificar') {
                echo  json_encode($e->modificar());
            }
        }
        exit;
    }

    $c = new Empleado();
    $cargos = $c->obtenerCargos();

    require_once("views/" . $pagina . ".php");
} else {
    echo "pagina en construccion";
}





