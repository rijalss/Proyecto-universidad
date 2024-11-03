<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    <title>Reportes</title>
    <link rel="stylesheet"  
        href="public/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="public/bootstrap/css/style.css">  

</head>

<body>
    <?php require_once("public/components/menu.php"); ?>

    <section class="d-flex flex-column " style="margin-top: 110px;">

        <div class="container">
            <form method="post" action="" id="form">
                <input type="text" name="accion" id="accion" style="display:none" />
                <h2 class="text-primary text-center">Resporte Notas de Salida</h2>

                <div class="row">
                    <div class="col">
                        <hr />
                    </div>
                </div>
                <div class="container ">
                    <div class="row ">

                        <div class="col">
                            <label>&nbsp;</label>
                            <div class="text-left">
                                <button typr="submit" class="btn btn-danger" id="generar" name="generar">Generar Reporte</button>
                                <button type="button" class="btn btn-secondary" id="filtrar" name="filtrar">Filtrar</button>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mt-3 form-floating">
                                <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio">
                                <label for="fecha_inicio"><b>Fecha Inicio:</b></label>
                            </div>
                        </div>

                        <div class="col">
                            <div class="mt-3 form-floating">
                                <input type="date" class="form-control" id="fecha_fin" name="fecha_fin">
                                <label for="fecha_fin"><b>Fecha Final:</b></label>
                            </div>
                        </div>
            </form>
        </div>
        <div class="table-responsive card shadow">
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-striped table-hover" id="tabSalida">
                        <thead class="text-center">
                            <tr>
                                <th>Numero de Salida</th>
                                <th>Fecha</th>
                                <th>Empleado</th>
                            </tr>
                        </thead>
                        <tbody class="text-center" id="Salida">

                        </tbody>
                    </table>
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