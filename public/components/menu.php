<nav class="navbar bg-primary fixed-top">
    <div class="container-fluid">
        <a href="?pagina=principal" class="navbar-brand text-white">Sistema de Inventario - MERCANTIL A&K 2008, C.A</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Menú</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                    <?php
                    if (!empty($_SESSION['rol'])) {
                    ?>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="?pagina=principal"><img width="20PX" src="public/icons/svg/house.svg" alt=""> Inicio</a>
                        </li>
                        <?php
                        if ($_SESSION['rol'] == 'admin') {
                        ?>
                            <li class="nav-item">
                                <a class="nav-link" href="?pagina=usuario"><img width="20PX" src="public/icons/svg/person-add.svg" alt=""> Gestionar Usuario</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="?pagina=producto"><img width="20PX" src="public/icons/svg/bag.svg" alt=""> Gestionar Producto</a>
                            </li>
                        <?php
                        }
                        ?>
                        <li>
                            <a class="nav-link" href="?pagina=entrada"><img width="20PX" src="public/icons/svg/house-down.svg" alt=""> Gestionar Notas de Entrada</a>
                        </li>
                        <li>
                            <a class="nav-link" href="?pagina=salida"><img width="20PX" src="public/icons/svg/menu-button-fill.svg" alt=""> Gestionar Notas de Salida</a>
                        </li>
                        <li>
                            <a class="nav-link" href="?pagina=existencia"><img width="20PX" src="public/icons/svg/inboxes.svg" alt=""> Listar Existencias</a>
                        </li>
                        <?php
                        if ($_SESSION['rol'] == 'admin') {
                        ?>
                            <li class="nav-item">
                                <a class="nav-link" href="?pagina=proveedor"><img width="20PX" src="public/icons/svg/truck.svg" alt=""> Gestionar Proveedor</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="?pagina=empleado"><img width="20PX" src="public/icons/svg/person-standing.svg" alt=""> Gestionar Empleado</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="complementosDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <img width="20PX" src="public/icons/svg/wrench-adjustable-circle.svg" alt=""> Gestionar Complementos
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="complementosDropdown">
                                    <li><a class="dropdown-item" href="?pagina=categoria"><img width="20px" src="public/icons/img/categorization.png" alt=""> Gestionar Categoría</a></li>
                                    <li><a class="dropdown-item" href="?pagina=cargo"><img width="20px" src="public/icons/svg/employee.svg" alt=""> Gestionar Cargo</a></li>
                                </ul>
                            </li>
                        <?php
                        }
                        ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="reportesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <img width="20PX" src="public/icons/svg/journal-text.svg" alt=""> Gestionar Reportes
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="reportesDropdown">
                                <li><a class="dropdown-item" href="?pagina=Rproducto"><img width="20PX" src="public/icons/svg/journal-plus.svg" alt=""> Reporte de Productos</a></li>
                                <li><a class="dropdown-item" href="?pagina=rentrada"><img width="20PX" src="public/icons/svg/journal-plus.svg" alt=""> Reporte de Notas de Entrada</a></li>
                                <li><a class="dropdown-item" href="?pagina=rsalida"><img width="20PX" src="public/icons/svg/journal-plus.svg" alt=""> Reporte de Notas de Salida</a></li>
                                <li><a class="dropdown-item" href="?pagina=rexistencia"><img width="20PX" src="public/icons/svg/journal-plus.svg" alt=""> Reportes de Existencias</a></li>
                                <li><a class="dropdown-item" href="?pagina=rproveedor"><img width="20PX" src="public/icons/svg/journal-plus.svg" alt=""> Reportes de Proveedores</a></li>
                                <li><a class="dropdown-item" href="?pagina=Rempleado"><img width="20PX" src="public/icons/svg/journal-plus.svg" alt=""> Reportes de Empleados</a></li>
                            </ul>
                        </li>
                    <?php
                    }
                    ?>
                    <li class="nav-item">
                        <a class="nav-link" href="?pagina=fin"><img width="20PX" src="public/icons/svg/box-arrow-right.svg" alt=""> Salir</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>




<!-- ============================================================== -->
<!-- End of sidebar -->
<!-- ============================================================== -->