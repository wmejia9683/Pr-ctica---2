<?php
  session_start();
  if ($_POST) {
    if (($_POST['usuario']=="wiled")&&($_POST['contrasenia']=="arcane")){
      $_SESSION['usuario']="ok";
      $_SESSION['nombreUsuario']="wiled";
      header('Location:inicio.php');
    }else {
      $mensaje="Error: El Usuario o Contrasenia son incorrectos";
    }
  }

?>
<!doctype html>
<html lang="en">
  <head>
    <title>Title</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>
    <div class="header_top">
            <div class="logotipo">
                <img width="300" src="../img/imagenes/glamour eventostulcan.png" alt="Logotipo">
            </div>
    </div>    

    <div class="container">
        <div class="row">
          <div class="col-md-4">
            
          </div>
            <div class="col-md-4 text-light">
              <br>
                <div class="card bg-info">
                    <div class="card-header text-dark"><strong>
                        Login</strong>
                    </div>
                    <div class="card-body">
                      <?php if (isset($mensaje)) {?>
                        <div class="alert alert-danger" role="alert">
                          <?php echo $mensaje;?>
                        </div>
                      <?php } ?>
                        <form method="POST">
                          <div class = "form-group">
                            <label>Usuario:</label>                          
                            <input type="text" class="form-control" name="usuario" placeholder="Usuario">
                          </div>

                          <div class="form-group">
                            <label>Contrasena:</label>
                            <input type="password" class="form-control" name="contrasenia" placeholder="Contrasenia">
                          </div>
          
                          <button type="submit" class="btn btn-dark">Entrar</button>

                        </form>
                        
                        
                    </div>
                </div>
            </div>
            
        </div>
    </div>
    <br>
    <footer id="footer">
        <div class="row">
          <div class="col-lg-11 text-danger">
            <ul class="list-unstyled">
              <li class="float-end"><a href="../index.php">Regresar a Pagina Principal</a></li>
              <li><a href="https://www.facebook.com/GlamourEventosTulcan">Facebook</a></li>
            </ul>
            <p class="text-center">
            Oficinas en Tulcán
            <br>Mail: pattyta_beautiful@hotmail.com  |  Movil + Whatsapp: +593 991436053.
            <br>Copyright © 2022 Wilmer Mejía.</p>
          </div>
        </div>
      </footer>

  </body>
</html>