<?php include('template/cabecera.php'); ?>

                <div class="col-md-12">
                    <div class="jumbotron">
                        <h1 class="display-3">Bienvenido <?php echo $nombreUsuario;?></h1>
                        <p class="lead">Has ingresado al modo administrador del sitio WEB</p>
                        <hr class="my-2">
                        <br/>
                        <p>Ahora podras ingresar, modificar y borrar la informacion de la base de datos, !porfavor verifica la acccion antes de realizarla!</p>
                        
                        <p class="lead">
                            <a class="btn btn-primary btn-lg" href="./seccion/productos.php" role="button">Administrar Productos</a>
                        </p>
                    </div>
                </div>
            
<?php include('template/pie.php'); ?>