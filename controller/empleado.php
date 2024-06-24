<?php

if (!is_file("model/" . $pagina . ".php")) {
    echo "Falta definir la clase " . $pagina;
    exit;
}
require_once("model/" . $pagina . ".php");
if (is_file("views/" . $pagina . ".php")) {

    if (!empty($_POST)) {

        $p = new Empleado ();
        $accion = $_POST['accion'];

        if ($accion == 'consultar') {
            echo  json_encode($p->consultar());
        } elseif ($accion == 'eliminar') {
            $p->set_cedulaEmpleado($_POST['cedulaEmpleado']);
            echo  json_encode($p->eliminar());
        } else {
            $p->set_prefijoCedula($_POST['prefijoCedula']);
            $p->set_cedulaEmpleado($_POST['cedulaEmpleado']);
            $p->set_nombreEmpleado($_POST['nombreEmpleado']);
            $p->set_apellidoEmpleado($_POST['apellidoEmpleado']);
            $p->set_correoEmpleado($_POST['correoEmpleado']);
            $p->set_telefonoEmpleado($_POST['telefonoEmpleado']);
            $p->set_clCargo($_POST['cargo']);
            if ($accion == 'incluir') {
                echo  json_encode($p->incluir());
            } elseif ($accion == 'modificar') {
                echo  json_encode($p->modificar());
            }
        }
        exit;
    }

    //require_once("model/auxiliar/cargo.php");
    $c = new Empleado();
    $cargos = $c->obtenerCargos();

    require_once("views/" . $pagina . ".php");
} else {
    echo "pagina en construccion";
}





