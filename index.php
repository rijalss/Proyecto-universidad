<?php

$pagina = 'principal';

if(!empty ($_GET['pagina'])){
    $pagina = $_GET['pagina']; 
}

if(is_file('controlador/'.$pagina.".php")){
    require_once  "controlador/".$pagina.".php";   //si la pagina existe, cargamos el archivo correspondiente
}else {                                          //sino, mostramos un error de que no se encuentra la pagina solicitada
    echo 'PÁGINA EN CONSTRUCCIÓN';
}