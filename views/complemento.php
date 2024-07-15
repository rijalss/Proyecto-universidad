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
    
    <section class="d-flex flex-column align-items-center" style="margin-top: 110px;">
    <h1 class="display-4 text-center text-uppercase font-weight-bold">Gestionar <br> Complementos!</h1>
    <?php
    /*
        session_start();
        $nombreEmpleado = $_SESSION['nombreEmpleado'];
        echo "<h2 class=\"display-4 text-center text-uppercase font-weight-bold\">$nombreEmpleado!</h2>";
        */
    ?>
    
    <!-- Container de cards -->
     </section>
     
    <div class="container">
        <div class="row">
            <div class="col-md-4 mb-3">
                <div class="card shadow w-100 h-100 p-3">
                    <div class="card-body">
                        <h5 class="card-title"><img width="20PX" src="public/icons/img/categorization.png" alt=""> Categorías</h5>
                        <p class="card-text">Gestiona las categorías que tendran tus productos</p>
                        <a href="?pagina=categoria" class="btn btn-primary">Gestionar Categoría</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-3">
                <div class="card shadow w-100 h-100 p-3">
                    <div class="card-body">
                        <h5 class="card-title"><img width="20PX" src="public/icons/svg/employee.svg" alt="">Cargos</h5>
                        <p class="card-text">Gestiona los cargos que tendras para tus empleados.</p>
                        <a href="?pagina=cargo" class="btn btn-primary">Gestionar Cargo</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-3">
                <div class="card shadow w-100 h-100 p-3">
                    <div class="card-body">
                        <h5 class="card-title"><img width="20PX" src="public/icons/svg/area.svg" alt="">Áreas</h5>
                        <p class="card-text">Gestiona las áreas disponibles.</p>
                        <a href="?pagina=area" class="btn btn-primary">Gestionar Área</a>
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
 
    <script src="public/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Scripts -->
</body>

</html>
