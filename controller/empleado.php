<?php

if (!is_file("model/" . $pagina . ".php")) {
    echo "Falta definir la clase " . $pagina;
    exit;
}
require_once("model/" . $pagina . ".php");
if (is_file("views/" . $pagina . ".php")) {

    $o = new Empleado();
    $c = new Empleado();
    $cargos = $c->obtenerCargos();

    if (!empty($_POST)) {
        $accion = isset($_POST['accion']) ? $_POST['accion'] : null;
        $accionCargo = isset($_POST['accionCargo']) ? $_POST['accionCargo'] : null;

        if ($accion == 'consultar') {
            echo  json_encode($o->consultar());
        } elseif ($accion == 'consultatr') {
            $o->set_cedulaEmpleado(isset($_POST['cedulaEmpleado']) ? $_POST['cedulaEmpleado'] : null);
            echo  json_encode($o->consultatr());
        } elseif ($accion == 'eliminar') {
            $o->set_cedulaEmpleado(isset($_POST['cedulaEmpleado']) ? $_POST['cedulaEmpleado'] : null);
            echo  json_encode($o->eliminar());
        } elseif ($accionCargo == 'eliminarCargo') {
            if (isset($_POST['descCargo']) && $_POST['descCargo'] != null) {
                $o->set_descCargo($_POST['descCargo']);
                echo  json_encode($o->eliminarCargo());
            } else {
                echo json_encode(array("status" => "error", "message" => "descCargo no puede ser null"));
            }
        } else {
           
            $o->set_cedulaEmpleado(isset($_POST['cedulaEmpleado']) ? $_POST['cedulaEmpleado'] : null);
            $o->set_nombreEmpleado(isset($_POST['nombreEmpleado']) ? $_POST['nombreEmpleado'] : null);
            $o->set_apellidoEmpleado(isset($_POST['apellidoEmpleado']) ? $_POST['apellidoEmpleado'] : null);
            $o->set_correoEmpleado(isset($_POST['correoEmpleado']) ? $_POST['correoEmpleado'] : null);
            $o->set_telefonoEmpleado(isset($_POST['telefonoEmpleado']) ? $_POST['telefonoEmpleado'] : null);
            $o->set_contrasena(isset($_POST['contrasena']) ? $_POST['contrasena'] : null);
            $o->set_clCargo(isset($_POST['clCargo']) ? $_POST['clCargo'] : null);

            if ($accion == 'incluir') {
                echo  json_encode($o->incluir());
            } elseif ($accion == 'modificar') {
                echo  json_encode($o->modificar());
            } elseif ($accionCargo == 'incluirCargo') {
                if (isset($_POST['descCargo']) && $_POST['descCargo'] != null) {
                    $o->set_descCargo($_POST['descCargo']);
                    echo  json_encode($o->incluirCargo());
                } else {
                    echo json_encode(array("status" => "error", "message" => "descCargo no puede ser null"));
                }
            }
        }
        exit;
    }

    require_once("views/" . $pagina . ".php");
} else {
    echo "pagina en construccion";
}
?>
