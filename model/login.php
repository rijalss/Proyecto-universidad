<?php
require_once('conexion.php');

class Empleado extends Conexion
{
    public function __construct()
    {
        parent::__construct();
    }

    //funcion para loguear al empleado
    //recibe el correo y la contraseña del empleado y verifica si existe en la base de datos

    public function Login($correo, $contrasena)
    {
        $query = "SELECT * FROM empleado WHERE correoEmpleado = :correo AND contrasena = :contrasena";
        $stmt = $this->conecta()->prepare($query);
        $stmt->bindParam(':correo', $correo, PDO::PARAM_STR);
        $stmt->bindParam(':contrasena', $contrasena, PDO::PARAM_STR);
        $stmt->execute();

        //si la consulta devuelve un registro, el empleado existe y se loguea

        if ($stmt->rowCount() == 1) {
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            return false;
        }
    }
}
