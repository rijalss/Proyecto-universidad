<nav class="navbar bg-primary fixed-top">
    <div class="container-fluid">
    <a class="navbar-brand text-white">Sistema de Inventario</a>
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
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="?pagina=principal">Inicio</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="?pagina=usuario">Usuario</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="?pagina=proveedor">Proveedor</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="?pagina=producto">Producto</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="?pagina=entrada">Entrada</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Dropdown
                </a>
                <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">Action</a></li>
                <li><a class="dropdown-item" href="#">Another action</a></li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="#">Something else here</a></li>
                </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="?pagina=login"><img width="20PX" src="public/img/box-arrow-left.svg" alt="">  Salir</a>
            </li>
            </ul>
        </div>
        </div>
    </div>
    
</nav>
        <!-- ============================================================== -->
        <!-- End of sidebar -->
        <!-- ============================================================== -->