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
    <?php require_once("public/commun/menu.php"); ?>
    <!-- Header -->

    <!-- Title -->
    <br><br><br><br>
    <h1 class="display-4 text-center text-uppercase font-weight-bold">Bienvenido!</h1>
    <br><br>
    <!-- Container de cards -->
    <div class="container d-flex justify-content-center">
        <div class="row">
            <div class="col-sm-6 mb-3 mb-sm-0 p-3">
                <div class="card shadow w-100 h-100 p-3">
                    <div class="card-body">
                        <h5 class="card-title"><img width="20PX" src="public/img/truck.svg" alt=""> Proveedores</h5>
                        <p class="card-text ">Gestiona tus proveedores con facilidad.</p>
                        <a href="?pagina=proveedor" class="btn btn-primary">Ver proveedores</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 p-3">
                <div class="card shadow w-100 h-100 p-3">
                    <div class="card-body">
                        <h5 class="card-title"><img width="20PX" src="public/img/shop-window.svg" alt=""> Almacen </h5>
                        <p class="card-text"> Gestiona tus almacenes de manera eficiente.</p>
                        <a href="?pagina=existencia" class="btn btn-primary">Ver almacenes</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 mb-3 mb-sm-0 p-3">
                <div class="card shadow w-100 h-100 p-3">
                    <div class="card-body">
                        <h5 class="card-title"><img width="20PX" src="public/img/bag.svg" alt=""> Productos</h5>
                        <p class="card-text">Mantén tu inventario bajo control</p>
                        <a href="?pagina=producto" class="btn btn-primary">Ver productos</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 mb-3 mb-sm-0 p-3">
                <div class="card shadow w-100 h-100 p-3">
                    <div class="card-body">
                        <h5 class="card-title"><img width="20PX" src="public/img/person.svg" alt=""> Entregas</h5>
                        <p class="card-text">Controla las entregas y entradas de productos en tu negocio</p>
                        <a href="?pagina=usuario" class="btn btn-primary">Ver entregas</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 mb-3 mb-sm-0 p-3">
                <div class="card shadow w-100 h-100 p-3">
                    <div class="col-sm-6 mb-3 mb-sm-0 p-3">
                        <h5 class="card-title"><img width="20PX" src="public/img/cart2.svg" alt="">Ventas</h5>
                        <p class="card-text">Gestiona tus ventas con facilidad.</p>
                        <a href="?pagina=salida" class="btn btn-primary">Ver ventas</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 mb-3 mb-sm-0 p-3">
                <div class="card shadow w-100 h-100 p-3">
                    <div class="card-body">
                        <h5 class="card-title"><img width="20PX" src="public/img/people.svg" alt="">Clientes</h5>
                        <p class="card-text">Gestiona tus clientes con facilidad.</p>
                        <a href="?pagina=cliente" class="btn btn-primary">Ver clientes</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 mb-3 mb-sm-0 p-3">
                <div class="card shadow w-100 h-100 p-3">
                    <div class="card-body">
                        <h5 class="card-title"><img width="20PX" src="public/img/people.svg" alt="">Trabajadores</h5>
                        <p class="card-text">Gestiona tus trabajadores con facilidad.</p>
                        <a href="?pagina=trabajador" class="btn btn-primary">Ver trabajador</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 mb-3 mb-sm-0 p-3">
                <div class="card shadow w-100 h-100 p-3">
                    <div class="card-body">
                        <h5 class="card-title"><img width="20PX" src="public/img/people.svg" alt="">Usuarios</h5>
                        <p class="card-text">Gestiona tus usuarios con facilidad.</p>
                        <a href="?pagina=usuario" class="btn btn-primary">Ver Usuarios</a>
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