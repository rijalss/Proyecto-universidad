<?php

if (!is_file("model/" . $pagina . ".php")) {
    echo "Falta definir la clase " . $pagina;
    exit;
}
require_once("model/" . $pagina . ".php");
require_once("model/auxiliar/categoria.php");
if (is_file("views/" . $pagina . ".php")) {

    if (!empty($_POST)) {

        $p = new Producto();

        $accion = $_POST['accion'];

        switch ($accion) {
            case 'consultar':
                echo json_encode($p->consultar());
                break;
            case 'eliminar':
                $p->set_codProducto($_POST['codProducto']);
                echo json_encode($p->eliminar());
                break;
            case 'incluir':
            case 'modificar':
                $p->set_codProducto($_POST['codProducto']);
                $p->set_nombreProducto($_POST['nombreProducto']);
                $p->set_ultimoPrecio($_POST['ultimoPrecio']);
                $p->set_descProducto($_POST['descProducto']);
                $p->set_clCategoria($_POST['categoria']);


                
                if ($accion == 'incluir') {
                    $mensaje=$p->incluir();
                   
                    if($mensaje['resultado'] == 'incluir'){
                        if(isset($_FILES['imagenarchivo'])){	
                            if (($_FILES['imagenarchivo']['size'] / 1024) < 1024) {
                            move_uploaded_file($_FILES['imagenarchivo']['tmp_name'], 
                            'public/img/productos/'.$_POST['codProducto'].'.png');
                            } 
                        }
                    }
                    echo json_encode($mensaje);

                   
                } elseif ($accion == 'modificar') {
                    $mensaje=$p->modificar();

                    if($mensaje['resultado'] == 'modificar'){
				   
                        if(isset($_FILES['imagenarchivo'])){	
                           
                            if (($_FILES['imagenarchivo']['size'] / 1024) < 1024) {
                                
                                move_uploaded_file($_FILES['imagenarchivo']['tmp_name'], 
                                'public/img/productos/'.$_POST['codProducto'].'.png');
                                  
                            } 
                        }
                    }
                   echo json_encode($mensaje);
                }
                break;
            case 'existe': 
            $respuesta =$p->existe(isset($_POST['codProducto']) ? $_POST['codProducto'] : null);
            echo  json_encode($respuesta);
            break;
            default:
                echo "Acción no válida";
                break;
        }
        exit;
    }

    // Obtener categorías para la vista
    $c = new Categoria();
    $categorias = $c->obtenerCategorias();

    require_once("views/" . $pagina . ".php");
} else {
    echo "pagina en construccion";
}
