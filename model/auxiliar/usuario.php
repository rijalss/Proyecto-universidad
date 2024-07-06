<?php

require_once('model/conexion.php');

class Usuario extends Conexion
{
    private $username;
    private $password;
    private $id;
    //////////////////////////SET//////////////////////////

    function set_username($valor)
    {
        $this->username = $valor;
    }

    function set_password($valor)
    {
        $this->password = $valor;
    }

    function set_id($valor)
    {
        $this->id = $valor;
    }

    //////////////////////////GET//////////////////////////

    function get_username()
    {
        return $this->username;
    }

    function get_password()
    {
        return $this->password;
    }

    function get_id()
    {
        return $this->id;
    }

    //////////////////////////METODOS//////////////////////////

    function incluir()
    {
        $r = array();

        if (!$this->existe($this->username)) {
            //1 Se llama a la funcion conecta 
            $co = $this->conecta();
            $co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //2 Se ejecuta el sql
            try {
                $co->query("INSERT INTO usuario(
                    username,
                    password
                    ) VALUES (
                    '$this->username',
                    '$this->password'
                    )");
                $r['resultado'] = 'incluir';
                $r['mensaje'] = 'Registro Incluido!<br/> Se registró el usuario correctamente';
            } catch (Exception $e) {
                $r['resultado'] = 'error';
                $r['mensaje'] = $e->getMessage();
            }
        } else {
            $r['resultado'] = 'incluir';
            $r['mensaje'] = 'ERROR! <br/> El USUARIO colocado ya existe!';
        }
        return $r;
    }

    function modificar()
    {
        $co = $this->conecta();
        $co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $r = array();
        if ($this->existeid($this->id)) {
            try {
                $co->query("UPDATE usuario 
                SET username = '$this->username', password = '$this->password'
                WHERE id = '$this->id'
            ");
                $r['resultado'] = 'modificar';
                $r['mensaje'] =  'Registro Modificado!<br/> Se modificó el usuario correctamente';
            } catch (Exception $e) {
                $r['resultado'] = 'error';
                $r['mensaje'] =  $e->getMessage();
            }
        } else {
            $r['resultado'] = 'modificar';
            $r['mensaje'] =  'ERROR! <br/> El USUARIO colocado NO existe!';
        }
        return $r;
    }



    function eliminar()
    {
        $co = $this->conecta();
        $co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $r = array();
        if ($this->existe($this->username)) {
            try {
                $p = $co->prepare("DELETE from usuario 
					    WHERE
						username = :username
						");
                $p->bindParam(':username', $this->username);


                $p->execute();
                $r['resultado'] = 'eliminar';
                $r['mensaje'] =  'Registro Eliminado! <br/> Se eliminó el usuario correctamente';
            } catch (Exception $e) {
                $r['resultado'] = 'error';
                $r['mensaje'] =  $e->getMessage();
            }
        } else {
            $r['resultado'] = 'eliminar';
            $r['mensaje'] =  'No existe el USUARIO';
        }
        return $r;
    }


    function consultar()
    {
        $co = $this->conecta();
        $co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $r = array();
        try {

            $resultado = $co->query("SELECT *  FROM usuario");

            if ($resultado) {

                $respuesta = '';
                foreach ($resultado as $r) {
                    $respuesta = $respuesta . "<tr>";
                    $respuesta = $respuesta . "<td>";
                    $respuesta = $respuesta . $r['id'];
                    $respuesta = $respuesta . "</td>";
                    $respuesta = $respuesta . "<td>";
                    $respuesta = $respuesta . $r['username'];
                    $respuesta = $respuesta . "</td>";
                    $respuesta = $respuesta . "<td>";
                    $respuesta = $respuesta . $r['password'];
                    $respuesta = $respuesta . "</td>";
                    $respuesta = $respuesta . "<td style='max-width: 140px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;'>";
                    $respuesta = $respuesta . "<button type='button'
                    class='btn btn-warning small-width d-inline-block mr-1' 
                    onclick='pone(this,0)'
                    style='margin-right: 5px;'
                    >Modificar</button>";
                    $respuesta = $respuesta . "<button type='button'
                    class='btn btn-danger small-width d-inline-block' 
                    onclick='pone(this,1)'
                    >Eliminar</button>";
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


    private function existe($username)
    {
        $co = $this->conecta();
        $co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        try {

            $resultado = $co->query("SELECT * FROM usuario WHERE username='$username'");


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

    private function existeid($id)
    {
        $co = $this->conecta();
        $co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        try {

            $resultado = $co->query("SELECT * FROM usuario WHERE id='$id'");


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
}
