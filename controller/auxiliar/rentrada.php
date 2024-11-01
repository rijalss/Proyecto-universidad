<?php

require_once("model/auxiliar/" . $pagina . ".php");


if (is_file("views/auxiliar/" . $pagina . ".php")) {



    if (!empty($_POST)) {

      
        
    }
    

    require_once("views/auxiliar/" . $pagina . ".php");
} else {
    echo "pagina en construccion";
}
