<?php
if (!is_file("model/auxiliar/" . $pagina . ".php")) {
    echo "Falta definir la clase " . $pagina;
    exit;
}
require_once("model/auxiliar/" . $pagina . ".php");
if (is_file("views/auxiliar/" . $pagina . ".php")) {

    if (!empty($_POST)) {

        $u = new Usuario();
        
        $accion = $_POST['accion'];

        if ($accion == 'consultar') {
            echo  json_encode($u->consultar());
        } elseif ($accion == 'eliminar') {
            $u->set_username($_POST['username']);
            echo  json_encode($u->eliminar());
        } else {
            $u->set_username($_POST['username']);
            $u->set_password($_POST['password']);
            $u->set_id($_POST['id']);
            $u->set_rol($_POST['rol']);

            if ($accion == 'incluir') {
                echo  json_encode($u->incluir());
            } elseif ($accion == 'modificar') {
                echo  json_encode($u->modificar());
            }
        }
        exit;
    }
    
    require_once("views/auxiliar/" . $pagina . ".php");
} else {
    echo "pagina en construccion";
}