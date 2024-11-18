<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="public/img/favicon.ico" >

  <title>Iniciar Sesión</title>
  <link rel="stylesheet" href="public/bootstrap/css/bootstrap.min.css">
</head>

<div id="mensajes" style="display:none" 
data-mensaje="<?php echo !empty($mensaje) ? $mensaje : ''; ?>">
</div>

<body>
  <div class="container my-5 py-5">
    <div class="card border-dark shadow-lg">
      <div class="row g-0">
        <div class="col-md-6">
          <img class="img-fluid rounded-start w-100 h-100 object-fit-cover" loading="lazy" src="public/img/img-1.jpg" alt="BootstrapBrain Logo">
        </div>

        <div class="col-md-6">
          <div class="card-body p-3 p-md-4 p-xl-5">

            <div class="row">
              <div class="col-md-12">
                <div class="mb-5">
                  <h3>Iniciar Sesión</h3>
                </div>
              </div>
            </div>

            <form method="post" id="f" action="">
              <input type="text" name="accion" id="accion" style="display:none" />
              <div class="row gy-3 gy-md-4 overflow-hidden">

                <div class="col-md-12">
                  <label for="username" class="form-label">Usuario <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" name="username" id="username" required>
                  <span id="susername"></span>
                </div>

                <div class="col-md-12">
                  <label for="password" class="form-label">Contraseña <span class="text-danger">*</span></label>
                  <input type="password" class="form-control" name="password" id="password" autocomplete="current-password" required>
                  <span id="spassword"></span>
                </div>

                <div class="col-md-12">
                  <div class="d-grid">
                    <button class="btn bsb-btn-xl btn-primary" id="acceder" name="acceder">Acceder</button>
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
  <?php require_once("public/components/footer.php"); ?>
  <?php require_once("public/components/extra.php"); ?>
  <!-- Footer -->

  <script src="public/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script type="text/javascript" src="public/js/login.js"></script>
</body>

</html>