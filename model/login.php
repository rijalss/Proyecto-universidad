<?php
require_once('conexion.php');

 class Login extends Conexion
 {
     public function __construct()
     {
         parent::__construct();
     }

     //funcion para loguear al empleado
     //recibe el usuario y la contraseña del empleado y verifica si existe en la base de datos

     public function Login($username, $password)
     {
         $query = "SELECT * FROM usuario WHERE username = :username AND password = :password";
         $stmt = $this->conecta()->prepare($query);
         $stmt->bindParam(':username', $username, PDO::PARAM_STR);
         $stmt->bindParam(':password', $password, PDO::PARAM_STR);
         $stmt->execute();

        // si la consulta devuelve un registro, el empleado existe y se loguea

         if ($stmt->rowCount() == 1) {
             return $stmt->fetch(PDO::FETCH_ASSOC);
         } else {
             return false;
         }
     }
}
