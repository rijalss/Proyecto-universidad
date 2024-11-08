<?php


if (!is_file("model/" . $pagina . ".php")) {
    echo "Falta definir la clase " . $pagina;
    exit;
}
require_once("model/" . $pagina . ".php");

if (is_file("views/" . $pagina . ".php")) {

    if (!empty($_POST)) {

        $p = new Producto ();
        $accion = $_POST['accion'];

        if ($accion == 'consultar') {
            echo  json_encode($p->consultar());
        } elseif ($accion == 'eliminar') {
            $p->set_codProducto($_POST['codProducto']);
            echo  json_encode($p->eliminar());
        }elseif($accion == 'existe') {
            $resultado = $p->existe($_POST['codProducto']);
            echo json_encode($resultado);
        }
         else {
            $p->set_codProducto($_POST['codProducto']);
            $p->set_nombreProducto($_POST['nombreProducto']);
            $p->set_ultimoPrecio($_POST['ultimoPrecio']);
            $p->set_descProducto($_POST['descProducto']);
            $p->set_clCategoria($_POST['categoria']);
        
            if ($accion == 'incluir') {
          
                
                if (isset($_FILES['imagenarchivooo'])) {
                    if ($_FILES['imagenarchivooo']['error'] == UPLOAD_ERR_OK) {
                        if (($_FILES['imagenarchivooo']['size'] / 1024) < 1024) {
                            move_uploaded_file($_FILES['imagenarchivooo']['tmp_name'], 'public/img/img-producto/' . $_POST['codProducto'] . '.png');
                        }
                    } else {
                        echo "Error al subir el archivo: " . $_FILES['imagenarchivooo']['error'];
                    }
                } else {
                    echo "No se ha enviado ningún archivo o el campo está vacío.";
                }
                
            
                echo  json_encode($p->incluir());
            } elseif ($accion == 'modificar') {
            
					     
                if (isset($_FILES['imagenarchivooo']) && $_FILES['imagenarchivooo']['size'] > 0) {
                    if (($_FILES['imagenarchivooo']['size'] / 1024) < 1024) {
                        move_uploaded_file($_FILES['imagenarchivooo']['tmp_name'], 'public/img/img-producto/' . $_POST['codProducto'] . '.png');
                    }
                } else {
                    // Manejo del caso en que no se haya subido un archivo
                    echo "No se ha subido una imagen o hay un problema con el archivo.";
                }
                
               
                echo  json_encode($p->modificar());
            }
        }  
        
      
          
        exit;
    }

    require_once("model/auxiliar/categoria.php");
    $c = new Categoria();
    $categorias = $c->obtenerCategorias();

    require_once("views/" . $pagina . ".php");
} else {
    echo "pagina en construccion";
}




























// if (!is_file("model/" . $pagina . ".php")) {
//     echo "Falta definir la clase " . $pagina;
//     exit;
// }
// require_once("model/" . $pagina . ".php");
// require_once("model/auxiliar/categoria.php");
// if (is_file("views/" . $pagina . ".php")) {

//     if (!empty($_POST)) {

//         $p = new Producto();

//         $accion = $_POST['accion'];

//         switch ($accion) {
//             case 'consultar':
//                 echo json_encode($p->consultar());
//                 break;
//             case 'eliminar':
//                 $p->set_codProducto($_POST['codProducto']);
//                 echo json_encode($p->eliminar());
//                 break;
//             case 'incluir':
//                 if(isset($_FILES['imagenarchivo'])){	
					     
//                     if (($_FILES['imagenarchivo']['size'] / 1024) < 1024) {
                        
//                           move_uploaded_file($_FILES['imagenarchivo']['tmp_name'], 
//                           'public/img/producto/'.$_POST['codProducto'].'.png');
                          
//                     } 
//                 }
                
//                 $p->set_codProducto($_POST['codProducto']);
//                 $p->set_nombreProducto($_POST['nombreProducto']);
//                 $p->set_ultimoPrecio($_POST['ultimoPrecio']);
//                 $p->set_descProducto($_POST['descProducto']);
//                 $p->set_clCategoria($_POST['categoria']);


//                 echo  json_encode($p->incluir());
//                 break;
//             case 'modificar':
//                 $p->set_codProducto($_POST['codProducto']);
//                 $p->set_nombreProducto($_POST['nombreProducto']);
//                 $p->set_ultimoPrecio($_POST['ultimoPrecio']);
//                 $p->set_descProducto($_POST['descProducto']);
//                 $p->set_clCategoria($_POST['categoria']);
//                 echo  json_encode($p->modificar());
//                 if(isset($_FILES['imagenarchivo'])){	
					     
//                     if (($_FILES['imagenarchivo']['size'] / 1024) < 1024) {
                        
//                           move_uploaded_file($_FILES['imagenarchivo']['tmp_name'], 
//                           'public/img/producto/'.$_POST['codProducto'].'.png');
                          
//                     } 
//                 }

//                 break;
//             case 'existe': 
//             $respuesta =$p->existe(isset($_POST['codProducto']) ? $_POST['codProducto'] : null);
//             echo  json_encode($respuesta);
//             break;
//             default:
//                 echo "Acción no válida";
//                 break;
//         }
//         exit;
//     }

//     // Obtener categorías para la vista
//     $c = new Categoria();
//     $categorias = $c->obtenerCategorias();

//     require_once("views/" . $pagina . ".php");
// } else {
//     echo "pagina en construccion";
// }
