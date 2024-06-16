<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido</title>
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link rel="stylesheet" href="public/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="public/bootstrap/css/style.css">
</head>

<body>
    <!-- Header -->
    <?php require_once("public/components/menu.php"); ?>
    <!-- Header -->

    <!-- Title -->
    <br><br><br><br>
    <h1 class="display-4 text-center text-uppercase font-weight-bold">Gestionar <br> Complementos!</h1>
    <?php
    /*
        session_start();
        $nombreEmpleado = $_SESSION['nombreEmpleado'];
        echo "<h2 class=\"display-4 text-center text-uppercase font-weight-bold\">$nombreEmpleado!</h2>";
        */
    ?>
    <br><br>
    <!-- Container de cards -->
    <div class="container">
        <div class="row">
            <div class="col-md-4 mb-3">
                <div class="card shadow w-100 h-100 p-3">
                    <div class="card-body">
                        <h5 class="card-title"><img width="20PX" src="public/icons/img/categorization.png" alt=""> Categorias</h5>
                        <p class="card-text">Gestiona las categorias que tendran tus productos</p>
                        <a href="?pagina=categoria" class="btn btn-primary">Gestionar Categorias</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-3">
                <div class="card shadow w-100 h-100 p-3">
                    <div class="card-body">
                        <h5 class="card-title"><img width="20PX" src="public/icons/svg/employee.svg" alt="">Cargos</h5>
                        <p class="card-text">Gestiona los cargos que tendras para tus empleados.</p>
                        <a href="?pagina=cargo" class="btn btn-primary">Gestionar Cargos</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-3">
                <div class="card shadow w-100 h-100 p-3">
                    <div class="card-body">
                        <h5 class="card-title"><img width="20PX" src="public/icons/svg/area.svg" alt="">Areas</h5>
                        <p class="card-text">Gestiona tus areas dentro de tus almacenes.</p>
                        <a href="?pagina=area" class="btn btn-primary">Gestionar Areas</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br><br>
    <!-- Footer -->
    <?php require_once("public/components/footer.php"); ?>
    <!-- Footer -->

    <!-- Scripts -->
    <script src="public/bootstrap/js/sidebar.js"></script>
    <script src="public/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Scripts -->
</body>

</html>