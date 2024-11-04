<?php


// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['name'])) {
    // Redirigir al usuario a la página de inicio de sesión
    header('Location: .');
    exit();
}
?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="public/img/favicon.ico">
    <title>Bienvenido</title>
    <link rel="stylesheet" href="public/bootstrap/css/bootstrap.min.css">
</head>

<body>

    <!-- Header -->
    <?php require_once("public/components/menu.php"); ?>
    <!-- Header -->

    <!-- Title -->
    <section class="d-flex flex-column align-items-center" style="margin-top: 110px;">

        <h1 id="nombre_persona" class="text-primary display-4 text-center text-uppercase font-weight-bold"></h1>

        <?php

        if (isset($_SESSION['name'])) {
            echo "<script>document.getElementById('nombre_persona').innerHTML = 'Bienvenid@ " . $_SESSION['name'] . "!';</script>";
        }

        ?>

        <img src="public/img/logo.png" height="110px" width="160px" style="margin: 0; padding: 0;">
        <br>
    </section>
    <?php
    //verificamos que exista la variable nivel
    //que es la que contiene el valor de la sesion
    if (!empty($name)) {
    ?>
        <!-- Container de cards -->

        <div class="container">
            <div class="row">
                <?php
                if ($name == 'admin') {
                ?>
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
                <?php
                }
                ?>

                <div class="col-md-4 mb-3">
                    <div class="card shadow w-100 h-100 p-3">
                        <div class="card-body">
                            <h5 class="card-title"><img width="20PX" src="public/icons/svg/house-down.svg" alt=""> Notas de Entrada</h5>
                            <p class="card-text">Gestiona el abastencimiento de los productos en tu negocio.</p>
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
                <?php
                if ($name == 'admin') {
                ?>
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
                <?php
                }
                ?>
                <div class="col-md-4 mb-3">
                    <div class="card shadow w-100 h-100 p-3">
                        <div class="card-body">
                            <h5 class="card-title"><img width="20PX" src="public/icons/svg/journal-text.svg" alt=""> Reportes</h5>
                            <p class="card-text">Gestiona los reportes de cada modulo del sistema.</p>
                            <a href="?pagina=reportes" class="btn btn-primary">Gestionar Reportes</a>
                        </div>
                    </div>
                </div>
            <?php
        }
            ?>
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