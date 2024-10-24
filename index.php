<?php

$pagina = 'login';  //pagina por defecto

if (!empty($_GET['pagina'])) {
    $pagina = $_GET['pagina'];
}


$name = "";
if (is_file("model/verifica.php")) {
    require_once("model/verifica.php");
    $v = new verifica();
    if ($pagina == 'fin') {
        $v->destruyesesion();
    } else {
        $name = $v->leesesion();
    }
}


if (is_file('controller/' . $pagina . ".php")) {
    require_once  "controller/" . $pagina . ".php";   //si la pagina existe, cargamos el archivo correspondiente
}
else if (is_file('controller/auxiliar/' . $pagina . ".php")) {
    require_once  "controller/auxiliar/" . $pagina . ".php";   //si la pagina existe, cargamos el archivo correspondiente
} else {                                          //sino, mostramos un error de que no se encuentra la pagina solicitada
    echo 'PÁGINA EN CONSTRUCCIÓN';
}
