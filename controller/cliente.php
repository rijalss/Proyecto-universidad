<?php

if (!is_file("model/" . $pagina . ".php")) {

	echo "Falta definir la clase " . $pagina;
	exit;
}
require_once("model/" . $pagina . ".php");
if (is_file("views/" . $pagina . ".php")) {

	$o = new cliente();

	if (!empty($_POST)) {

		$accion = $_POST['accion'];

		if ($accion == 'consultar') {
			echo  json_encode($o->consultar());
		} elseif ($accion == 'consultatr') {
			$o->set_cedula($_POST['cedulaCliente']);
			echo  json_encode($o->consultatr());
		} elseif ($accion == 'eliminar') {
			$o->set_cedula($_POST['cedulaCliente']);
			echo  json_encode($o->eliminar());
		} else {
			$o->set_cedula($_POST['cedulaCliente']);
			$o->set_apellido($_POST['apellidoCliente']);
			$o->set_nombre($_POST['nombreCliente']);
			$o->set_telefono($_POST['telefonoCliente']);

			if ($accion == 'incluir') {
				echo  json_encode($o->incluir());
			} else if ($accion == 'modificar') {

				echo  json_encode($o->modificar());
			}
		}
		exit;
	}


	require_once("views/" . $pagina . ".php");
} else {
	echo "pagina en construccion";
}
