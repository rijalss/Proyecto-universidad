<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
    <link rel="stylesheet" href="public/bootstrap/css/bootstrap.min.css">
</head>

<body>

    <div class="container" style="margin-top: 80px;">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card">
                    <div class="card-header">
                        <h4 class="text-center">Registro</h4>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST">
                            <div class="mb-3">
                                <label for="nombre" class="form-label">Nombre</label>
                                <input type="text" name="nombre" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="correo" class="form-label">Correo</label>
                                <input type="email" name="correo" class="form-control" required>
                            </div>
                            <div class="mb-4">
                                <label for="password" class="form-label">Contraseña</label>
                                <input type="password" name="password" class="form-control" required>
                            </div>
                            <div class="mb-3 text-center">
                                <button type="submit" class="btn btn-primary w-100">Registrar</button>
                            </div>
                            <input type="hidden" name="accion" value="registrar">
                            <div class="mb-3 text-center">
									<a href="?pagina=principal" class="btn btn-secondary">REGRESAR</a>
								</div>
                            
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <script src="public/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>