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
    <!-- <nav class="navbar bg-primary fixed-top">
  <div class="container-fluid">
    <a href="#" class="navbar-brand text-white">Sistema de Inventario - MERCANTIL A&K 2008, C.A</a>
    <div class="d-flex justify-content-end">
      <a class="nav-link" href="?pagina=login"><img width="20PX" src="public/icons/svg/box-arrow-right.svg" alt="Salir"></a>
    </div>
  </div>
</nav> -->
    <!-- Header -->
    <?php require_once("public/components/menu.php"); ?>
    <!-- Header -->

    <!-- Title -->
    <section class="d-flex flex-column align-items-center" style="margin-top: 110px;">
    <h1 class="display-4 text-center text-uppercase font-weight-bold">Bienvenido!</h1>
    <?php
    /*
        session_start();
        $nombreEmpleado = $_SESSION['nombreEmpleado'];
        echo "<h2 class=\"display-4 text-center text-uppercase font-weight-bold\">$nombreEmpleado!</h2>";
        */
    ?>
    </section>
   
    <!-- Container de cards -->
    <div class="container">
        <div class="row">
        <div class="col-md-4 mb-3">
                <div class="card shadow w-100 h-100 p-3">
                    <div class="card-body">
                        <h5 class="card-title"><img width="20PX" src="public/icons/svg/person-add.svg" alt=""> Usuarios</h5>
                        <p class="card-text">Gestiona los usuarios que cuentan con acceso a tu sistema.</p>
                        <a href="?pagina=usuario" class="btn btn-primary">Gestionar Usuario</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card shadow w-100 h-100 p-3">
                    <div class="card-body">
                        <h5 class="card-title"><img width="20PX" src="public/icons/svg/bag.svg" alt=""> Productos</h5>
                        <p class="card-text">Mantén la gestión tus productos bajo control.</p>
                        <a href="?pagina=producto" class="btn btn-primary">Gestionar Producto</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card shadow w-100 h-100 p-3">
                    <div class="card-body">
                        <h5 class="card-title"><img width="20PX" src="public/icons/svg/house-down.svg" alt=""> Notas de Entrada</h5>
                        <p class="card-text">Gestiona el abastencimiento de tus productos en tu negocio.</p>
                        <a href="?pagina=entrada" class="btn btn-primary">Gestionar Notas de Entrada</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-3">
                <div class="card shadow w-100 h-100 p-3">
                    <div class="card-body">
                        <h5 class="card-title"><img width="20PX" src="public/icons/svg/menu-button-fill.svg" alt=""> Notas de Salida</h5>
                        <p class="card-text">Gestiona los despacho al mostrador de tus productos con facilidad.</p>
                        <a href="?pagina=salida" class="btn btn-primary">Gestionar Notas de Salida</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-3">
                <div class="card shadow w-100 h-100 p-3">
                    <div class="card-body">
                        <h5 class="card-title"><img width="20PX" src="public/icons/svg/inboxes.svg" alt=""> Existencias</h5>
                        <p class="card-text">Observa las existencias de tus productos, para un manejo eficiente de estos.</p>
                        <a href="?pagina=existencia" class="btn btn-primary">Listar Existencias</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-3">
                <div class="card shadow w-100 h-100 p-3">
                    <div class="card-body">
                        <h5 class="card-title"><img width="20PX" src="public/icons/svg/truck.svg" alt=""> Proveedores</h5>
                        <p class="card-text">Gestiona tus proveedores con facilidad.</p>
                        <a href="?pagina=proveedor" class="btn btn-primary">Gestionar Proveedor</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-3">
                <div class="card shadow w-100 h-100 p-3">
                    <div class="card-body">
                        <h5 class="card-title"><img width="20PX" src="public/icons/svg/person-standing.svg" alt=""> Empleados</h5>
                        <p class="card-text">Gestiona tus empleados con facilidad.</p>
                        <a href="?pagina=empleado" class="btn btn-primary">Gestionar Empleado</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card shadow w-100 h-100 p-3">
                    <div class="card-body">
                        <h5 class="card-title"><img width="20PX" src="public/icons/svg/wrench-adjustable-circle.svg" alt=""> Complementos</h5>
                        <p class="card-text">Gestiona los datos que complementan a tu sistema.</p>
                        <a href="?pagina=complemento" class="btn btn-primary">Gestionar Complementos</a>
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