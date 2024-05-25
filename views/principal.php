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
    <?php require_once("public/commun/menu.php"); ?>
    <!-- Header -->

    <!-- Title -->
    <br><br><br><br>
    <h1 class="display-4 text-center text-uppercase font-weight-bold">Bienvenido!</h1>
    <br><br>
    <!-- Container de cards -->
    <div class="container">
        <div class="row">
            <div class="col-md-4 mb-3">
                <div class="card shadow w-100 h-100 p-3">
                    <div class="card-body">
                        <h5 class="card-title"><img width="20PX" src="public/icons/truck.svg" alt=""> Proveedores</h5>
                        <p class="card-text">Gestiona tus proveedores con facilidad.</p>
                        <a href="?pagina=proveedor" class="btn btn-primary">Ver proveedores</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card shadow w-100 h-100 p-3">
                    <div class="card-body">
                        <h5 class="card-title"><img width="20PX" src="public/icons/inboxes.svg" alt=""> Existencias </h5>
                        <p class="card-text">Gestiona las existencias de tus productos de forma eficiente.</p>
                        <a href="?pagina=existencia" class="btn btn-primary">Ver Existencias </a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card shadow w-100 h-100 p-3">
                    <div class="card-body">
                        <h5 class="card-title"><img width="20PX" src="public/icons/bag.svg" alt=""> Productos</h5>
                        <p class="card-text">Mantén tus productos bajo control</p>
                        <a href="?pagina=producto" class="btn btn-primary">Ver productos</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card shadow w-100 h-100 p-3">
                    <div class="card-body">
                        <h5 class="card-title"><img width="20PX" src="public/icons/house-down.svg" alt=""> Encargos</h5>
                        <p class="card-text">Controla el abastencimiento de tus productos en tu negocio</p>
                        <a href="?pagina=entrada" class="btn btn-primary">Ver encargos</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card shadow w-100 h-100 p-3">
                    <div class="card-body">
                        <h5 class="card-title"><img width="20PX" src="public/img/cart2.svg" alt=""> Ventas</h5>
                        <p class="card-text">Gestiona las ventas de tus productos con facilidad.</p>
                        <a href="?pagina=salida" class="btn btn-primary">Ver ventas</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card shadow w-100 h-100 p-3">
                    <div class="card-body">
                        <h5 class="card-title"><img width="20PX" src="public/icons/people.svg" alt=""> Clientes</h5>
                        <p class="card-text">Gestiona tus clientes con facilidad.</p>
                        <a href="?pagina=cliente" class="btn btn-primary">Ver clientes</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card shadow w-100 h-100 p-3">
                    <div class="card-body">
                        <h5 class="card-title"><img width="20PX" src="public/icons/person-add.svg" alt=""> Empleados</h5>
                        <p class="card-text">Gestiona tus empleados con facilidad.</p>
                        <a href="?pagina=usuario" class="btn btn-primary">Ver empleados</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card shadow w-100 h-100 p-3">
                    <div class="card-body">
                        <h5 class="card-title"><img width="20PX" src="public/icons/shop-window.svg" alt=""> Almacenes</h5>
                        <p class="card-text">Controla y Gestiona tus almacenes y sus respectivas areas.</p>
                        <a href="?pagina=almacen" class="btn btn-primary">Ver almacenes</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br><br>
    <!-- Footer -->
    <?php require_once("public/commun/footer.php"); ?>
    <!-- Footer -->

    <!-- Scripts -->
    <script src="public/bootstrap/js/sidebar.js"></script>
    <script src="public/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Scripts -->
</body>

</html>