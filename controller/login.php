<?php
if (!is_file("model/" . $pagina . ".php")) {
    echo "Falta el modelo";
    exit;
}
require_once("model/" . $pagina . ".php");
if (is_file("views/" . $pagina . ".php")) {
    if (!empty($_POST)) {

        $o = new Login();
        $h= $_POST['accion'];
       // echo  $h;
        if ($_POST['accion'] == 'acceder') {
            $o->set_username($_POST['username']);
            $o->set_password($_POST['password']);
            $m = $o->existe();
            if ($m['resultado'] == 'existe') {
                session_destroy(); 	
                session_start(); 
                $_SESSION['name'] = $m['mensaje'];

                header('Location: ?pagina=principal');
 
                die();
            } else {
                $mensaje = $m['mensaje'];
            }
        }
    }

    require_once("views/" . $pagina . ".php");
} else {
    echo "Falta la vista";
}
