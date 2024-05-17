<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ventas</title>
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link rel="stylesheet" href="public/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="public/bootstrap/css/style.css">
</head>

<body>
    <!-- Header -->
    <?php require_once("public/commun/menu.php"); ?>
    <!-- Header -->
    <br>
    <br>
    <br>
    <br>

    <div class="container-center m-5">
        <div class="container-fluid">

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="container text-center h2 text-primary">Registro de ventas</h6>
                    <br>
                    <form method="post" action="" id="">
                        <div class="container">
                            <div class="row">
                                <!-- -->
                                <div class="col">
                                    <label for="nombreProducto">Producto</label>
                                    <select class="form-control" name="nombreProducto" id="nombreProducto">
                                        <option value="" disabled selected>Seleccione un producto</option>
                                        <option value="1">Lapiz</option>
                                        <option value="2">Globos</option>
                                        <option value="3">Carrito</option>
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="cantidadVenta">Cantidad del producto</label>
                                    <input class="form-control" type="number" id="cantidadVenta" name="cantidadVenta" />
                                </div>
                                <div class="col">
                                    <label for="precioVenta">Precio de venta</label>
                                    <input class="form-control" type="number" id="precioVenta" name="precioVenta" />
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <br>
                                    <hr />
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <label for="nombreCliente">Cliente</label>
                                    <select class="form-control" name="nombreCliente" id="nombreCliente">
                                        <option value="" disabled selected>Seleccione un cliente</option>
                                        <option value="1">Juan</option>
                                        <option value="2">Pedro</option>
                                        <option value="3">Maria</option>
                                    </select>
                                </div>

                                <div class="col">
                                    <label for="tipoPago">Tipo de pago</label>
                                    <select class="form-control" name="tipoPago" id="tipoPago">
                                        <option value="" disabled selected>Seleccione un tipo de pago</option>
                                        <option value="1">Efectivo</option>
                                        <option value="2">Pago Mobil</option>
                                        <option value="3">Transferencia</option>
                                    </select>
                                    <br>

                                    <div id="bancoContainer"></div>
                                </div>
                            </div>

                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    const tipoPagoSelect = document.getElementById('tipoPago');
                                    const bancoContainer = document.getElementById('bancoContainer');

                                    tipoPagoSelect.addEventListener('change', function() {
                                        const selectedValue = tipoPagoSelect.value;
                                        bancoContainer.innerHTML = '';

                                        if (selectedValue === '2' || selectedValue === '3') {
                                            const label = document.createElement('label');
                                            label.setAttribute('for', 'banco');

                                            const bancoSelect = document.createElement('select');
                                            bancoSelect.setAttribute('id', 'banco');
                                            bancoSelect.setAttribute('name', 'banco');

                                            const bancos = [
                                                'Banco de Venezuela',
                                                'Banco del Tesoro',
                                                'Banesco',
                                                'Bancaribe',
                                                'Banco Exterior',
                                                'Banco Mercantil',
                                                'Banco Provincial',
                                                'BOD',
                                                'BNC',
                                                'Banco Sofitasa'
                                            ];

                                            bancos.forEach(function(banco) {
                                                const option = document.createElement('option');
                                                option.setAttribute('value', banco);
                                                option.textContent = banco;
                                                bancoSelect.appendChild(option);
                                            });

                                            bancoContainer.appendChild(label);
                                            bancoContainer.appendChild(bancoSelect);
                                        }
                                    });
                                });
                            </script>

                            <div class="row">
                                <div class="col">

                                    <hr />
                                </div>
                            </div>
                            <!-- Botonera para cumplir acciones -->
                            <div class="row container text-center">
                                <div class="col  mb-4">
                                    <button type="button" class="btn btn-primary " id="incluir" name="incluir">INCLUIR</button>
                                </div>
                                <div class="col mb-4">
                                    <button type="button" class="btn btn-success" id="consultar" data-toggle="modal" data-target="#modal1" name="consultar">CONSULTAR</button>
                                </div>
                                <div class="col mb-4">
                                    <button type="button" class="btn btn-warning" id="modificar" name="modificar">MODIFICAR</button>
                                </div>
                                <div class="col mb-4">
                                    <button type="button" class="btn btn-danger" id="eliminar" name="eliminar">ELIMINAR</button>
                                </div>
                                <div class="col mb-4">
                                    <a href="." class="btn btn-secondary">REGRESAR</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- Footer -->
    <?php require_once("public/commun/footer.php"); ?>
    <!-- Footer -->
    </div> <!-- fin de container -->

    <!-- Scripts -->
    <script src="public/bootstrap/js/sidebar.js"></script>
    <script src="public/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Scripts -->
</body>

</html>