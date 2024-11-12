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
	<title>Reportes Producto</title>
	<!-- Enlace al favicon personalizado -->
	<link rel="icon" href="public/img/favicon.ico">


	<link rel="stylesheet" href="public/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="public/bootstrap/css/style.css">
</head>
<br><br><br>
<body>
	<!--Llamada a archivo modal.php, dentro de el hay una sección modal-->
	<?php require_once("public/components/menu.php"); ?>

    <div class="container" style="width: 70%;">
	<section class="d-flex flex-column align-items-center py-5">
    <h2 class="text-primary text-center mb-4">Reportes Producto</h2>
    <div class="container card shadow mb-4 ">
    <div class="container p-4">
        <form method="post" action="" id="f" target="_blank">
            <input type="text" name="accion" id="accion" style="display:none" />

            <div class="row mb-3">
                <div class="col">
                    <label for="codProducto" class="form-label">Código</label>
                    <input class="form-control" type="text" id="codProducto" name="codProducto" />
                    <span id="scodProducto" class="form-text"></span>
                </div>

                <div class="col">
                    <label for="nombreProducto" class="form-label">Nombre</label>
                    <input class="form-control" type="text" id="nombreProducto" name="nombreProducto" />
                    <span id="snombreProducto" class="form-text"></span>
                </div>

                <div class="col">
                    <label for="categoria" class="form-label">Categoría</label>
                    <select class="form-select" name="categoria" id="categoria">
                        <option value='disabled' disabled selected>Seleccione una categoría</option>
                        <?php
                        foreach ($categorias as $categoria) {
                            echo "<option value='" . $categoria['clCategoria'] . "'>" . $categoria['nombreCategoria'] . "</option>";
                        }
                        ?>
                    </select>
                    <span id="scategoria" class="form-text text-danger"></span>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col">
                    <hr />
                </div>
            </div>

            <div class="row">
                <div class="col text-center">
                    <button type="submit" class="btn btn-primary" id="generar" name="generar">Crear Reporte PDF</button>
                </div>
            </div>
            </div>
        </form>
    </div>
</section>
</div>




	<!-- seccion del modal productos -->
	</div>

	<!--fin de seccion modal-->

	<?php require_once("public/components/footer.php"); ?>
	<?php require_once("public/components/extra.php");

	?>

	<script src="public/bootstrap/js/bootstrap.bundle.min.js"></script>


</body>

</html>