<?php

if (is_file('vista/' . $pagina . '.php')) {
    require_once('vista/' . $pagina . '.php');  //si la pagina existe se carga su vista correspondiente
} else {
    echo "PAGINA EN CONSTRUCCIÓN";
}
