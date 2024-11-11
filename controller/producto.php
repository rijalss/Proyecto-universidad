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
            echo json_encode($p->consultar());
        } elseif ($accion == 'eliminar') {
            $p->set_codProducto($_POST['codProducto']);
            $resultado = $p->eliminar();
            if ($resultado) {
                // Eliminar la imagen asociada al producto
                $imagen_path = 'public/img/img-producto/' . $_POST['codProducto'] . '.png';
                if (file_exists($imagen_path)) {
                    unlink($imagen_path);
                }
            }
            echo json_encode($resultado);
        } elseif ($accion == 'existe') {
            $resultado = $p->existe($_POST['codProducto']);
            echo json_encode($resultado);
        } else {
            $p->set_codProducto($_POST['codProducto']);
            $p->set_nombreProducto($_POST['nombreProducto']);
            $p->set_ultimoPrecio($_POST['ultimoPrecio']);
            $p->set_descProducto($_POST['descProducto']);
            $p->set_clCategoria($_POST['categoria']);
        
            if ($accion == 'incluir') {
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
                // Manejo de la subida de archivos
                if (isset($_FILES['imagenarchivooo']) && $_FILES['imagenarchivooo']['size'] > 0) {
                    if (($_FILES['imagenarchivooo']['size'] / 1024) < 1024) {
                        if (!move_uploaded_file($_FILES['imagenarchivooo']['tmp_name'], 'public/img/img-producto/' . $_POST['codProducto'] . '.png')) {
                            // Error al mover el archivo
                            echo json_encode(['resultado' => 'error', 'mensaje' => 'Error al mover el archivo']);
                            exit;
                        }
                    }
                }
            
                // Si no se subió un archivo o el archivo no pasó las validaciones
                $respuesta = $p->modificar();
                echo json_encode($respuesta);
                exit;
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
