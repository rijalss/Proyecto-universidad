<?php

if (!is_file("model/auxiliar/" . $pagina . ".php")) {
    echo "Falta definir la clase " . $pagina;
    exit;
}
require_once("model/auxiliar/" . $pagina . ".php");
if (is_file("views/auxiliar/" . $pagina . ".php")) {

    //llenar

    require_once("views/auxiliar/" . $pagina . ".php");
} else {
    echo "pagina en construccion";
}
