<?php
require_once('modelo/categoria.php');

$categoria = new Categoria("");
$categorias = $categoria->obtenerCategorias();

require_once('vista/producto.php');