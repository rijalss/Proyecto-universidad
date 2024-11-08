<?php
require_once('model/conexion.php');

class Usuario extends Conexion
{
    private $username;
    private $password;
    private $id;
    private $rol;
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

    function set_rol($valor)
    {
        $this->rol = $valor;
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
    function get_rol()
    {
        return $this->rol;
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
                    password,
                    rol
                    ) VALUES (
                    '$this->username',
                    '$this->password',
                    '$this->rol'
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

    function modificar(){
        $co = $this->conecta();
        $co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $r = array();
        if ($this->existeid($this->id)) {
            try {
                $co->query("UPDATE usuario 
                SET username = '$this->username', password = '$this->password', rol = '$this->rol'
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
                    $respuesta = $respuesta . "<tr class='text-center'>"; // Clase para centrar el contenido de las filas
                    $respuesta = $respuesta . "<td style='display:none'>";
                    $respuesta = $respuesta . $r['id'];
                    $respuesta = $respuesta . "</td>";
                    $respuesta = $respuesta . "<td>";
                    $respuesta = $respuesta . $r['username'];
                    $respuesta = $respuesta . "</td>";
                    $respuesta = $respuesta . "<td>";
                    $respuesta = $respuesta . $r['password'];
                    $respuesta = $respuesta . "</td>";
                    $respuesta = $respuesta . "<td>";
                    $respuesta = $respuesta . $r['rol'];
                    $respuesta = $respuesta . "</td>";
                    $respuesta = $respuesta . "<td style='max-width: 140px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;'>";
                    $respuesta = $respuesta . "<div class='d-flex justify-content-center flex-column align-items-center'>"; // Centrar los botones
                    $respuesta = $respuesta . "<button type='button' class='btn btn-warning btn-sm mb-2' style='width: 100px;' onclick='pone(this,0)'>Modificar</button>";
                    $respuesta = $respuesta . "<button type='button' class='btn btn-danger btn-sm' style='width: 100px;' onclick='pone(this,1)'>Eliminar</button>";
                    $respuesta = $respuesta . "</div>";
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
