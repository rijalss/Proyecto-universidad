<!DOCTYPE html>
<html lang="en">
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
        <?php require_once("public/commun/menu.php");?>
    <!-- Header -->

    <!-- Title -->
    <br><br><br><br>
    <h1 class="display-4 text-center text-uppercase font-weight-bold">Bienvenido!</h1>
    <br><br>
    <!-- Container de cards -->
    <div class="container d-flex justify-content-center">
    <div class="row">
        <div class="col-sm-6 mb-3 mb-sm-0">
            <div class="card shadow w-100 h-100 p-3">
            <div class="card-body">
                <h5 class="card-title">Proveedores</h5>
                <p class="card-text ">Gestiona tus proveedores con facilidad.</p>
                <a href="#" class="btn btn-primary">Go somewhere</a>
            </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="card shadow w-100 h-100 p-3">
            <div class="card-body">
                <h5 class="card-title">Almacen</h5>
                <p class="card-text"> Gestiona tus almacenes de manera eficiente.</p>
                <a href="#" class="btn btn-primary">Go somewhere</a>
            </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="card shadow w-100 h-100 p-3">
            <div class="card-body">
                <h5 class="card-title">Productos</h5>
                <p class="card-text">Mantén tu inventario bajo control</p>
                <a href="#" class="btn btn-primary">Go somewhere</a>
            </div>
            </div>
        </div>
        <div class="col-sm-6 mb-3 mb-sm-0">
            <div class="card shadow w-100 h-100 p-3">
            <div class="card-body">
                <h5 class="card-title">Usuarios</h5>
                <p class="card-text">Controla el acceso a tu sistema</p>
                <a href="#" class="btn btn-primary">Go somewhere</a>
            </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="card shadow w-100 h-100 p-3">
            <div class="card-body">
                <h5 class="card-title">Ventas</h5>
                <p class="card-text">Gestiona tus ventas con facilidad.</p>
                <a href="#" class="btn btn-primary">Go somewhere</a>
            </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="card shadow w-100 h-100 p-3">
            <div class="card-body">
                <h5 class="card-title">Clientes</h5>
                <p class="card-text">Gestiona tus clientes con facilidad.</p>
                <a href="#" class="btn btn-primary">Go somewhere</a>
            </div>
            </div>
        </div>
        <div class="col-sm-6 mb-3 mb-sm-0">
            <div class="card shadow w-100 h-100 p-3">
            <div class="card-body">
                <h5 class="card-title">Cotizaciones</h5>
                <p class="card-text">Gestiona tus cotizaciones con facilidad.</p>
                <a href="#" class="btn btn-primary">Go somewhere</a>
            </div>
            </div>
        </div>
    </div>
</div>
<br><br>
    <!-- Footer -->
    <?php require_once("public/commun/footer.php");?>
    <!-- Footer -->

    <!-- Scripts -->
        <script src="public/bootstrap/js/sidebar.js"></script>
        <script src="public/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Scripts -->
</body>
</html>