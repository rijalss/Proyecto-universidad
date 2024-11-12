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
                unset($_FILES['imagenarchivo']);
            echo json_encode($p->consultar());
        } elseif ($accion == 'eliminar') {
            $p->set_cedulaEmpleado($_POST['cedulaEmpleado']);
            $resultado = $p->eliminar();
            if ($resultado) {
                // Eliminar la imagen asociada al empleado
                $imagen_path = 'public/img/img-empleado/' . $_POST['cedulaEmpleado'] . '.png';
                if (file_exists($imagen_path)) {
                    unlink($imagen_path);
                }
            }
            echo json_encode($resultado);
        } elseif ($accion == 'existe') {
            $resultado = $p->existe($_POST['cedulaEmpleado']);
            echo json_encode($resultado);
        } else {
            $p->set_prefijoCedula($_POST['prefijoCedula']);
            $p->set_cedulaEmpleado($_POST['cedulaEmpleado']);
            $p->set_nombreEmpleado($_POST['nombreEmpleado']);
            $p->set_apellidoEmpleado($_POST['apellidoEmpleado']);
            $p->set_correoEmpleado($_POST['correoEmpleado']);
            $p->set_telefonoEmpleado($_POST['telefonoEmpleado']);
            $p->set_clCargo($_POST['cargo']);
            if ($accion == 'incluir') {// Verificar si se ha subido una imagen
                 // Limpiar la variable $_FILES['imagenarchivo'] después de usarla
                 
                if (isset($_FILES['imagenarchivo']) && $_FILES['imagenarchivo']['tmp_name'] != '') {  
                    if (($_FILES['imagenarchivo']['size'] / 1024) < 1024) { // Verificar que sea menor a 1 MB
                        // Mover la imagen al directorio deseado
                        move_uploaded_file(
                            $_FILES['imagenarchivo']['tmp_name'], 
                            'public/img/img-empleado/' . $_POST['cedulaEmpleado'] . '.png'
                        );
                    }
                   
                }
                unset($_FILES['imagenarchivo']);
                echo json_encode($p->incluir());
                
            } elseif ($accion == 'modificar') {
                if (isset($_FILES['imagenarchivo'])) {  
                    if (($_FILES['imagenarchivo']['size'] / 1024) < 1024) {
                        move_uploaded_file($_FILES['imagenarchivo']['tmp_name'], 
                        'public/img/img-empleado/' . $_POST['cedulaEmpleado'] . '.png');
                    } 
                }
                unset($_FILES['imagenarchivo']);
                echo json_encode($p->modificar());
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
