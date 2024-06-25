<?php

if (!is_file("model/" . $pagina . ".php")) {
    echo "Falta definir la clase " . $pagina;
    exit;
}
require_once("model/" . $pagina . ".php");
require_once("model/auxiliar/categoria.php");
if (is_file("views/" . $pagina . ".php")) {

    if (!empty($_POST)) {

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $correo = $_POST['email']; 
            $contrasena = $_POST['password']; 

            // Valida que correo y contraseña sea igual a admin
            if ($correo == "admin" && $contrasena == "admin") {
                //$_SESSION['loggedin'] = true; 
                header("Location: ?pagina=principal"); 
                exit;
            } else {
                // Si no coinciden, muestra un mensaje de error 
                echo "<script>lert('Correo o contraseña incorrectos'); window.location.href='index.php';</script>";
                exit;
            }
        }
    }
    require_once("views/" . $pagina . ".php");
} else {
    echo "pagina en construccion";
}




// if (!is_file("model/" . $pagina . ".php")) {
//     echo "Falta definir la clase " . $pagina;
//     exit;
// }
// require_once("model/" . $pagina . ".php");
// if (is_file("views/" . $pagina . ".php")) {

//     $e = new Empleado();

//     // si el metodo es POST, se ejecuta el metodo Login de la clase Empleado 
//     // y se verifica si el empleado existe en la base de datos 

//     if ($_SERVER["REQUEST_METHOD"] == "POST") {
//         $correo = $_POST['email'];
//         $contrasena = $_POST['password'];
//         // se verifica si el empleado existe en la base de datos e inicia sesión
//         if ($e->Login($correo, $contrasena)) {
//             session_start();
//             $_SESSION['loggedin'] = true;
//             //$_SESSION['nombreEmpleado'] = $loginResult['nombreEmpleado'];
//             // si existe, se redirecciona a la pagina principal
//             header("Location: ?pagina=principal");
//         } else {
//             // si no existe, se muestra un mensaje de error
//             echo "<script>alert('Correo o contraseña incorrectos'); window.location.href='index.php';</script>";
//         }
//     }

//     require_once("views/" . $pagina . ".php");
// } else {
//     echo "pagina en construccion";
// }
