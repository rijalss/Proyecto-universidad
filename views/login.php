<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Iniciar Sesión</title>
  <link rel="stylesheet" href="public/bootstrap/css/bootstrap.min.css">
</head>

<body>
  <div class="container my-5 py-5">
    <div class="card border-dark shadow-lg">
      <div class="row g-0">
        <div class="col-12 col-md-6">
          <img class="img-fluid rounded-start w-100 h-100 object-fit-cover" loading="lazy" src="public/img/img-1.jpg" alt="BootstrapBrain Logo">
        </div>

        <div class="col-12 col-md-6">
          <div class="card-body p-3 p-md-4 p-xl-5">

            <div class="row">
              <div class="col-12">
                <div class="mb-5">
                  <h3>Inciar Sesión</h3>
                </div>
              </div>
            </div>

            <form method="post">
              <div class="row gy-3 gy-md-4 overflow-hidden">

                <div class="col-12">
                  <label for="email" class="form-label">Correo <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" name="email" id="email" placeholder="name@example.com" required>
                </div>

                <div class="col-12">
                  <label for="password" class="form-label">Contraseña <span class="text-danger">*</span></label>
                  <input type="password" class="form-control" name="password" id="password" value="" required>
                </div>

                <div class="col-12">
                  <div class="d-grid">
                    <button class="btn bsb-btn-xl btn-primary" type="submit">Inicia ahora</button>
                  </div>
                </div>

              </div>
            </form>


          </div>
        </div>
      </div>
    </div>
  </div>









  <script src="public/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>