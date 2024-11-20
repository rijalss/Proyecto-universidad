<?php

require_once('conexion.php');

class Login extends Conexion
{


    private $username;
    private $password;

    function set_username($valor)
    {
        $this->username = $valor;
    }

    function set_password($valor)
    {
        $this->password = $valor;
    }


    function get_username()
    {
        return $this->username;
    }

    function get_password()
    {
        return $this->password;
    }


    function existe(){
        $co = $this->conecta();
        $co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $r = array();
        try {

			
            $p = $co->prepare("SELECT rol,username FROM usuario 
			WHERE 
			username=:username
			AND 
			password=:password"); // se cambio el rol por username
            $p->bindParam(':username', $this->username);
            $p->bindParam(':password', $this->password);
            $p->execute();

            $fila = $p->fetchAll(PDO::FETCH_BOTH);
            if ($fila) {

                $r['resultado'] = 'existe';
                $r['mensaje'] = $fila[0]['username']; // Asumiendo que quieres el username
                $r['rol'] = $fila[0]['rol'];
            } else {
                $r['resultado'] = 'noexiste';
                $r['mensaje'] =  "Error en el usuario o contraseña!!!";
            }
        } catch (Exception $e) {
            $r['resultado'] = 'error';
            $r['mensaje'] =  $e->getMessage();
        }
        return $r;
    }
}

