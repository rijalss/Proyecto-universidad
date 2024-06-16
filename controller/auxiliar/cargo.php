<?php

if (is_file('views/auxiliar/' . $pagina . '.php')) {
    require_once('views/auxiliar/' . $pagina . '.php');  //si la pagina existe se carga su vista correspondiente
} else {
    echo "PAGINA EN CONSTRUCCIÓN";
}
