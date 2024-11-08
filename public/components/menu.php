<nav class="navbar bg-primary fixed-top">
    <div class="container-fluid">
        <a href="?pagina=principal" class="navbar-brand text-white">Sistema de Inventario - MERCANTIL A&K 2008, C.A</a>
        <button class="navbar-toggler " type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
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
                    //verificamos que exista la variable nivel
                    //que es la que contiene el valor de la sesion
                    if (!empty($_SESSION['rol'])) {
                    ?>
                        <?php
                        if ($_SESSION['rol'] == 'admin') {
                        ?>
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="?pagina=principal">Inicio</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="?pagina=usuario">Gestionar Usuario</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="?pagina=producto">Gestionar Producto</a>
                            </li>
                        <?php
                        }
                        ?>
                        <li>
                            <a class="nav-link" href="?pagina=entrada">Gestionar Notas de Entrada</a>
                        </li>
                        <li>
                            <a class="nav-link" href="?pagina=salida">Gestionar Notas de salida</a>
                        </li>
                        <?php
                        if ($_SESSION['rol'] == 'admin') {
                        ?>
                            <li class="nav-item">
                                <a class="nav-link" href="?pagina=proveedor">Gestionar Proveedor</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="?pagina=empleado">Gestionar Empleado</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="complementosDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Gestionar Complementos
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="complementosDropdown">
                                    <li><a class="dropdown-item" href="?pagina=categoria">Gestionar Categoría</a></li>
                                    <li><a class="dropdown-item" href="?pagina=cargo">Gestionar Cargo</a></li>
                                </ul>
                            </li>
                        <?php
                        }
                        ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="reportesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Gestionar Reportes
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="reportesDropdown">
                                <li><a class="dropdown-item" href="?pagina=Rproducto">Reporte de Productos</a></li>
                                <li><a class="dropdown-item" href="?pagina=rentrada">Reporte de Notas de Entrada</a></li>
                                <li><a class="dropdown-item" href="?pagina=rsalida">Reporte de Notas de Salida</a></li>
                                <li><a class="dropdown-item" href="?pagina=rproveedor">Reportes de Proveedores</a></li>
                                <li><a class="dropdown-item" href="?pagina=Rempleado">Reportes de Empleados</a></li>
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