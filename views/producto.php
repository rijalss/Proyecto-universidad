
<?php

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['name'])) {
	// Redirigir al usuario a la página de inicio de sesión
	header('Location: .');
	exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">   
    <title>Productos</title>
    <link rel="icon" href="public/img/favicon.ico">
    <link rel="stylesheet" href="public/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="public/bootstrap/css/style.css"> 
</head>



<body>
    <?php require_once("public/components/menu.php"); ?>
    <section class="d-flex flex-column align-items-center">
        <br><br><br><br>
        <h2 class="text-primary text-center">Gestionar Producto</h2>
        <br>
        <div class="container">
            <div class="text-left">
                <button class="btn btn-success" id="incluir">Registrar Producto</button>
            </div>
        </div>
        <div class="container card shadow mb-4 "> <br>
            <div class="container">
            </div>
            <div class="container text-center">
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="tablaproducto">
                        <thead>
                            <tr>
                                <th>Foto</th>
                                <th>Codigo</th>
                                <th>Nombre</th>
                                <th>Último Precio</th>
                                <th>Categoria</th>
                                <th>Descripción</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="resultadoconsulta"></tbody>
                    </table>
                </div>
            </div>
        </div> </section>

    <div class="modal fade" tabindex="-1" role="dialog" id="modalProducto">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Formulario de Producto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">

                    <form method="post" id="f" autocomplete="off">
                        <input autocomplete="off" type="hidden" class="form-control" name="accion" id="accion">
                        <div class="container">
                            <div class="row mb-3">
                                <div class="col-md-6"> 
                                    <label for="codProducto" class="form-label">Código Producto</label>
                                    <input class="form-control" type="text" id="codProducto" name="codProducto" required />
                                    <span id="scodProducto"></span>
                                </div>
                                <div class="col-md-6">
                                    <label for="nombreProducto" class="form-label">Nombre</label>
                                    <input class="form-control" type="text" id="nombreProducto" name="nombreProducto" required />
                                    <span id="snombreProducto"></span>
                                </div>
                            </div> 
                            <div class="row mb-3">
							<div class="col-md-6">
                                    <label for="ultimoPrecio" class="form-label">Último Precio</label>
                                    <div class="d-flex align-items-center">
                                        <input type="number" class="form-control" id="ultimoPrecio" name="ultimoPrecio" min="0">
                                        <div class="form-check ms-2">
                                            <input type="checkbox" class="form-check-input" id="habilitarPromedio" onclick="toggleInput()">
                                            <label for="habilitarPromedio" class="form-check-label">Habilitar Último Precio</label>
                                        </div>
                                    </div>
                                    <span id="sultimoPrecio" ></span>
                                </div>
                                <div class="col-md-6">
                                    <label for="categoria" class="form-label">Categoría</label>
                                    <select class="form-select" name="categoria" id="categoria">   

                                        <option value='disabled'   
                                        disabled selected>Seleccione una categoria</option>
                                        <?php
                                        foreach ($categorias as $categoria) {
                                            echo "<option value='" . $categoria['clCategoria'] . "'>" . $categoria['nombreCategoria'] . "</option>";
                                        }
                                        ?>
                                    </select>
                                    <span id="scategoria" class="error"></span>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="descProducto" class="form-label">Descripción</label>
                                    <textarea class="form-control" id="descProducto" name="descProducto" rows="3" required></textarea>
                                    <span id="sdescProducto"></span>
                                </div>
                                <div class="col-md-6">
                                <br>
                                        <label for="archivo" style="cursor:pointer">
                                            <img src="public/img/img-producto/producto.jpg" id="imagen"
                                                class="img-fluid rounded-circle w-25 mb-3 centered"
                                                style="object-fit:scale-down">
                                            Click aqui para subir foto
                                        </label>
                                        <input id="archivo"
                                            type="file"
                                            style="display:none"
                                            accept=".png,.jpg,.jpeg"
                                            name="imagenarchivooo" />
                                </div>
                            </div>
                            </div>
                        </div>
                        <br>
                        <div class="row mt-3 d-flex justify-content-center align-items-center">
                            <div class="col-md-2">
                                <button type="button" class="btn btn-dark" id="proceso"></button>
                            </div>
                        </div>
                        <br>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php require_once("public/components/footer.php"); ?>
    <?php require_once("public/components/extra.php"); ?>
    <script src="public/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="public/js/producto.js"></script>
    </body>

</html>