<?php

if (!is_file("model/" . $pagina . ".php")) {
    echo "Falta definir la clase " . $pagina;
    exit;
 }
require_once("model/" . $pagina . ".php");
if (is_file("views/" . $pagina . ".php")) {

    $e = new Login();

    // si el metodo es POST, se ejecuta el metodo Login de la clase Empleado 
    // y se verifica si el empleado existe en la base de datos 

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['username'];
        $password = $_POST['password'];
             // se verifica si el empleado existe en la base de datos e inicia sesión
       if ($e->Login($username, $password)) {
            session_start();
            $_SESSION['loggedin'] = true;
             //$_SESSION['nombreEmpleado'] = $loginResult['nombreEmpleado'];
             // si existe, se redirecciona a la pagina principal
            header("Location: ?pagina=principal");
        } else {
             // si no existe, se muestra un mensaje de error
            echo "<script>alert('Usuario o contraseña INCORRECTOS!'); window.location.href='index.php';</script>";
        }
    }

    require_once("views/" . $pagina . ".php");
 } else {
     echo "pagina en construccion";
 }
