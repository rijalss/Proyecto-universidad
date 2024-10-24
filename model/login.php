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


    function existe()
    {
        $co = $this->conecta();
        $co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $r = array();
        try {

            $p = $co->prepare("SELECT username FROM usuario 
			WHERE 
			username=:username
			AND 
			password=:password");
            $p->bindParam(':username', $this->username);
            $p->bindParam(':password', $this->password);
            $p->execute();

            $fila = $p->fetchAll(PDO::FETCH_BOTH);
            if ($fila) {

                $r['resultado'] = 'existe';
                $r['mensaje'] =  $fila[0][0];
            } else {
                $r['resultado'] = 'noexiste';
                $r['mensaje'] =  "Error en username y/o password !!!";
            }
        } catch (Exception $e) {
            $r['resultado'] = 'error';
            $r['mensaje'] =  $e->getMessage();
        }
        return $r;
    }
}
