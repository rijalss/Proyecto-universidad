<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="public/img/favicon.ico"> 
    <title>Reportes Notas de Salida</title>
    <link rel="stylesheet" href="public/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="public/bootstrap/css/style.css">  

</head>

<body>
    <?php require_once("public/components/menu.php"); ?>

    <section class="d-flex flex-column " style="margin-top: 110px;">

        <div class="container">
            <form method="post" action="" id="form" target=" _blank">
                <input type="text" name="accion" id="accion" style="display:none" />
                <h2 class="text-primary text-center">Reporte Notas de Salida</h2>

                <div class="row">
                    <div class="col">
                        <hr />
                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-md-2 d-flex align-items-end">
                            <button type="submit" class="btn btn-primary mr-2" id="generar" name="generar">Crear Reporte PDF</button>
                        </div>
                        <div class="col-md-3">
                            <label for="empleado">Empleado</label>
                            <select class="form-control" name="empleado" id="empleado">
                                <option value='disabled' disabled selected>Seleccione un Empleado</option>
                                <?php foreach ($empleados as $empleado) {
                                    echo "<option value='" . $empleado['clEmpleado'] . "'>" . $empleado['nombreEmpleado'] . "</option>";
                                } ?>
                            </select>
                        </div>

                    </div>
                    <div class="row mt-4">
                        <div class="col-md-2 d-flex align-items-end">
                            <button type="button" class="btn btn-secondary" id="filtrar" name="filtrar">Filtrar Fechas</button>
                        </div>
                        <div class="col-md-3">
                            <div class="mt-3 form-floating">
                                <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio">
                                <label for="fecha_inicio"><b>Fecha Inicio:</b></label>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mt-3 form-floating">
                                <input type="date" class="form-control" id="fecha_fin" name="fecha_fin">
                                <label for="fecha_fin"><b>Fecha Final:</b></label>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <div class="container card shadow mb-4 ">
                <div class="container text-center">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover" id="tabSalida">
                            <thead class="text-center">
                                <tr>
                                    <th>Fecha de salida</th>
                                    <th>Nombre Empleado</th>
                                    <th>Nombre producto</th>
                                    <th>Cantidad Salida</th>
                                </tr>
                            </thead>
                            <tbody class="text-center" id="Salida">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>

    <?php require_once("public/components/footer.php"); ?>
    <?php require_once("public/components/extra.php"); ?>

    <script src="public/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script type="text/javascript" src="public/js/rsalida.js"></script>
    <!-- Scripts -->
</body>