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
                // ... (código para guardar datos del producto en la base de datos)
            
                // Manejo de la subida de archivos
                if (isset($_FILES['imagenarchivooo']) && $_FILES['imagenarchivooo']['error'] == UPLOAD_ERR_OK) {
                    $target_dir = 'public/img/img-producto/';
                    $target_file = $target_dir . $_POST['codProducto'] . '.png';
            
                    // Validación adicional del tipo de archivo (si es necesario)
                    $allowed_types = ['image/png', 'image/jpeg'];
                    if (in_array($_FILES['imagenarchivooo']['type'], $allowed_types)) {
                        if (move_uploaded_file($_FILES['imagenarchivooo']['tmp_name'], $target_file)) {
                            // Archivo subido correctamente
                        } else {
                            echo json_encode(['success' => false, 'message' => 'Error al mover el archivo']);
                        }
                    } else {
                        echo json_encode(['success' => false, 'message' => 'Tipo de archivo no permitido']);
                    }
                }
            
                // Incluir el producto y enviar respuesta JSON
                echo json_encode($p->incluir());
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
























