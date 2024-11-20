<?php
// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['name'])) {
    header('Location: .');
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complementos</title>
    <link rel="icon" href="public/img/favicon.ico">
    <link rel="stylesheet" href="public/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="public/bootstrap/css/style.css">
</head>

<style>
    .card-body {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }
</style>

<body class="d-flex flex-column min-vh-100">
    <!-- Header -->
    <?php require_once("public/components/menu.php"); ?>
    <!-- Header -->

    <main class="flex-grow-1 container my-5">
        <section class="d-flex flex-column align-items-center mb-4">
            <br><br><br>
            <h1 class="display-4 text-center text-uppercase text-primary font-weight-bold">Gestionar Complementos</h1>
        </section>

        <!-- Container de cards -->
        <div class="row">
            <div class="col-md-6 mb-3">
                <div class="card shadow w-100 h-100 p-3">
                    <div class="card-body">
                        <h5 class="card-title"><img width="20px" src="public/icons/img/categorization.png" alt=""> Categorías</h5>
                        <p class="card-text">Gestiona las categorías que tendrán tus productos</p>
                        <a href="?pagina=categoria" class="btn btn-primary">Gestionar Categoría</a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 mb-3">
                <div class="card shadow w-100 h-100 p-3">
                    <div class="card-body">
                        <h5 class="card-title"><img width="20px" src="public/icons/svg/employee.svg" alt=""> Cargos</h5>
                        <p class="card-text">Gestiona los cargos que tendrás para tus empleados.</p>
                        <a href="?pagina=cargo" class="btn btn-primary">Gestionar Cargo</a>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-3 mt-auto">
        <?php require_once("public/components/footer.php"); ?>
    </footer>
    <!-- Footer -->

    <!-- Scripts -->
    <script src="public/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>