<?php

require_once('model/conexion.php');
class cliente extends Conexion
{

	private $cedula;
	private $apellido;
	private $nombre;
	private $telefono;

	////////////////////////SET//////////////////////////

	function set_cedula($valor)
	{
		$this->cedula = $valor;
	}


	function set_apellido($valor)
	{
		$this->apellido = $valor;
	}

	function set_nombre($valor)
	{
		$this->nombre = $valor;
	}

	function set_telefono($valor)
	{
		$this->telefono = $valor;
	}

	//////////////////////////GET//////////////////////////

	function get_cedula()
	{
		return $this->cedula;
	}

	function get_apellido()
	{
		return $this->apellido;
	}

	function get_nombre()
	{
		return $this->nombre;
	}

	function get_telefono()
	{
		return $this->telefono;
	}


	function incluir()
	{

		if (!$this->existe($this->cedula)) {
			//1 Se llama a la funcion conecta 
			$co = $this->conecta();
			$co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			//2 Se ejecuta el sql
			$r = array();
			try {

				$p = $co->prepare("Insert into cliente(
						cedulaCliente,
						apellidoCliente,
						nombreCliente,
						telefonoCliente
						)
						Values(
						:cedulaCliente,
						:apellidoCliente,
						:nombreCliente,
						:telefonoCliente
						)");
				$p->bindParam(':cedulaCliente', $this->cedula);
				$p->bindParam(':apellidoCliente', $this->apellido);
				$p->bindParam(':nombreCliente', $this->nombre);
				$p->bindParam(':telefonoCliente', $this->telefono);


				$p->execute();

				$r['resultado'] = 'incluir';
				$r['mensaje'] =  'Registro Inluido';
			} catch (Exception $e) {
				$r['resultado'] = 'error';
				$r['mensaje'] =  $e->getMessage();
			}
		} else {
			$r['resultado'] = 'incluir';
			$r['mensaje'] =  'Ya existe la cedula';
		}

		return $r;
	}
	function modificar()
	{
		$co = $this->conecta();
		$co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$r = array();
		if ($this->existe($this->cedula)) {
			try {

				$p = $co->prepare("Update cliente set 
						apellidoCliente = :apellidoCliente,
						nombreCliente = :nombreCliente,
						telefonoCliente = :telefonoCliente
						where
						cedulaCliente = :cedulaCliente");
				$p->bindParam(':cedulaCliente', $this->cedula);
				$p->bindParam(':apellidoCliente', $this->apellido);
				$p->bindParam(':nombreCliente', $this->nombre);
				$p->bindParam(':telefonoCliente', $this->telefono);


				$p->execute();

				$r['resultado'] = 'modificar';
				$r['mensaje'] =  'Registro Modificado';
			} catch (Exception $e) {
				$r['resultado'] = 'error';
				$r['mensaje'] =  $e->getMessage();
			}
		} else {
			$r['resultado'] = 'modificar';
			$r['mensaje'] =  'No existe la cedula';
		}
		return $r;
	}

	function eliminar()
	{
		$co = $this->conecta();
		$co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$r = array();
		if ($this->existe($this->cedula)) {
			try {
				$p = $co->prepare("delete from cliente
					    where
						cedulaCliente = :cedulaCliente
						");
				$p->bindParam(':cedulaCliente', $this->cedula);


				$p->execute();
				$r['resultado'] = 'eliminar';
				$r['mensaje'] =  'Registro Eliminado';
			} catch (Exception $e) {
				$r['resultado'] = 'error';
				$r['mensaje'] =  $e->getMessage();
			}
		} else {
			$r['resultado'] = $this->cedula;
			$r['mensaje'] =  'No existe la cedula';
		}
		return $r;
	}



	function consultar()
	{

		$co = $this->conecta();
		$co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$r = array();
		try {

			$resultado = $co->query("Select * from cliente");

			if ($resultado) {

				$respuesta = '';
				foreach ($resultado as $r) {
					$respuesta = $respuesta . "<tr style='cursor:pointer' onclick='coloca(this);'>";
					$respuesta = $respuesta . "<td>";
					$respuesta = $respuesta . $r['cedulaCliente'];
					$respuesta = $respuesta . "</td>";
					$respuesta = $respuesta . "<td>";
					$respuesta = $respuesta . $r['nombreCliente'];
					$respuesta = $respuesta . "</td>";
					$respuesta = $respuesta . "<td>";
					$respuesta = $respuesta . $r['apellidoCliente'];
					$respuesta = $respuesta . "</td>";
					$respuesta = $respuesta . "<td>";
					$respuesta = $respuesta . $r['telefonoCliente'];
					$respuesta = $respuesta . "</td>";
					$respuesta = $respuesta . "</tr>";
				}
				$r['resultado'] = 'consultar';
				$r['mensaje'] =  $respuesta;
			} else {
				$r['resultado'] = 'consultar';
				$r['mensaje'] =  '';
			}
		} catch (Exception $e) {
			$r['resultado'] = 'error';
			$r['mensaje'] =  $e->getMessage();
		}
		return $r;
	}


	private function existe($cedula)
	{
		$co = $this->conecta();
		$co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		try {

			$resultado = $co->query("Select * from cliente where cedulaCliente='$cedula'");


			$fila = $resultado->fetchAll(PDO::FETCH_BOTH);
			if ($fila) {

				return true;
			} else {

				return false;;
			}
		} catch (Exception $e) {
			return false;
		}
	}

	function consultatr()
	{
		$co = $this->conecta();
		$co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$r = array();
		try {

			$resultado = $co->query("Select * from cliente where cedulaCliente='$this->cedula'");
			$fila = $resultado->fetchAll(PDO::FETCH_BOTH);
			if ($fila) {

				$r['resultado'] = 'encontro';
				$r['mensaje'] =  $fila;
			} else {

				$r['resultado'] = 'no en contro';
				$r['mensaje'] =  '';
			}
		} catch (Exception $e) {
			$r['resultado'] = 'error';
			$r['mensaje'] =  $e->getMessage();
		}
		return $r;
	}
}
