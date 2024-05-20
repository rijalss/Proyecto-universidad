<?php

if (is_file('views/' . $pagina . '.php')) {
    require_once('views/' . $pagina . '.php');  //si la pagina existe se carga su vista correspondiente
} else {
    echo "PAGINA EN CONSTRUCCIÓN";
}