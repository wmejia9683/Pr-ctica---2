<?php include("../template/cabecera.php");?>
<?php
    $txtIDO=(isset($_POST['txtIDO']))?$_POST['txtIDO']:"";
    $txtNombreO=(isset($_POST['txtNombreO']))?$_POST['txtNombreO']:"";
    $txtFotoO=(isset($_FILES['txtFotoO']['name']))?$_FILES['txtFotoO']['name']:"";
    $txtDescripcionO=(isset($_POST['txtDescripcionO']))?$_POST['txtDescripcionO']:"";
    $txtMision=(isset($_POST['txtMision']))?$_POST['txtMision']:"";
    $txtVision=(isset($_POST['txtVision']))?$_POST['txtVision']:"";
    $txtValores=(isset($_POST['txtValores']))?$_POST['txtValores']:"";
    $accion=(isset($_POST['accion']))?$_POST['accion']:"";
    
    include("../../administrador/config/bd.php");
   
    switch ($accion) {
        case 'Agregar':
            $sentenciaSQL=$conexion->prepare("INSERT INTO organizacion (nombreo,fotoo,descripciono,mision,vision,valores) VALUES (:nombreo,:fotoo,:descripciono,:mision,:vision,:valores);");
            $sentenciaSQL->bindParam(':nombreo',$txtNombreO);
            
            $fecha= new DateTime();
            $nombreArchivo=($txtFotoO!="")?$fecha->getTimestamp()."_".$_FILES["txtFotoO"]["name"]:"imagen.jpg";
            $tmpFotoO=$_FILES["txtFotoO"]["tmp_name"];

            if($tmpFotoO!=""){
                move_uploaded_file($tmpFotoO,"../../img/".$nombreArchivo);
            }            

            $sentenciaSQL->bindParam(':fotoo',$nombreArchivo);
            $sentenciaSQL->bindParam(':descripciono',$txtDescripcionO);
            $sentenciaSQL->bindParam(':mision',$txtMision);
            $sentenciaSQL->bindParam(':vision',$txtVision);
            $sentenciaSQL->bindParam(':valores',$txtValores);
            $sentenciaSQL->execute();
            
            header("Location:organizacion.php");
            break;

        case 'Modificar':
            $sentenciaSQL=$conexion->prepare("UPDATE organizacion SET nombreo=:nombreo, descripciono=:descripciono, mision=:mision, vision=:vision, valores=:valores WHERE codigoo=:codigoo");
            $sentenciaSQL->bindParam(':codigoo',$txtIDO);
            $sentenciaSQL->bindParam(':nombreo',$txtNombreO);
            $sentenciaSQL->bindParam(':descripciono',$txtDescripcionO);
            $sentenciaSQL->bindParam(':mision',$txtMision);
            $sentenciaSQL->bindParam(':vision',$txtVision);
            $sentenciaSQL->bindParam(':valores',$txtValores);
            $sentenciaSQL->execute();

            if ($txtFotoO!="") {

                $fecha= new DateTime();
                $nombreArchivo=($txtFotoO!="")?$fecha->getTimestamp()."_".$_FILES["txtFotoO"]["name"]:"imagen.jpg";
                $tmpFotoO=$_FILES["txtFotoO"]["tmp_name"];
                move_uploaded_file($tmpFotoO,"../../img/".$nombreArchivo);

                $sentenciaSQL=$conexion->prepare("SELECT fotoo FROM organizacion WHERE codigoo=:codigoo");
                $sentenciaSQL->bindParam(':codigoo',$txtIDO);
                $sentenciaSQL->execute();
                $organizacion=$sentenciaSQL->fetch(PDO::FETCH_LAZY);

                if ( isset($organizacion["fotoo"]) &&($organizacion["fotoo"]!="imagen.jpg") ){
                    if (file_exists("../../img/".$organizacion["fotoo"])) {
                        unlink("../../img/".$organizacion["fotoo"]);
                    } 
                }

                $sentenciaSQL=$conexion->prepare("UPDATE organizacion SET fotoo=:fotoo WHERE codigoo=:codigoo");
                $sentenciaSQL->bindParam(':codigoo',$txtIDO);
                $sentenciaSQL->bindParam(':fotoo',$nombreArchivo);
                $sentenciaSQL->execute();
            }
            header("Location:organizacion.php");
            break;

        case 'Cancelar':
            header("Location:organizacion.php");
            break;

        case 'Seleccionar':
            $sentenciaSQL=$conexion->prepare("SELECT * FROM organizacion WHERE codigoo=:codigoo");
            $sentenciaSQL->bindParam(':codigoo',$txtIDO);
            $sentenciaSQL->execute();
            $organizacion=$sentenciaSQL->fetch(PDO::FETCH_LAZY);
            
            $txtNombreO=$organizacion['nombreo'];
            $txtFotoO=$organizacion['fotoo'];
            $txtDescripcionO=$organizacion['descripciono'];
            $txtMision=$organizacion['mision'];
            $txtVision=$organizacion['vision'];
            $txtValores=$organizacion['valores'];
            
            break;

        // case 'Borrar':
        //     $sentenciaSQL=$conexion->prepare("SELECT fotoo FROM organizacion WHERE codigoo=:codigoo");
        //     $sentenciaSQL->bindParam(':codigoo',$txtIDO);
        //     $sentenciaSQL->execute();
        //     $organizacion=$sentenciaSQL->fetch(PDO::FETCH_LAZY);

        //     if (isset($organizacion["fotoo"]) &&($organizacion["fotoo"]!="imagen.jpg")) {
        //         if (file_exists("../../img/".$organizacion["fotoo"])) {
        //             unlink("../../img/".$organizacion["fotoo"]);
        //         } 
        //     }
        //     $sentenciaSQL=$conexion->prepare("DELETE FROM organizacion WHERE codigoo=:codigoo");
        //     $sentenciaSQL->bindParam(':codigoo',$txtIDO);
        //     $sentenciaSQL->execute();
        //     header("Location:productos.php");        
        //     break;
    }

    $sentenciaSQL=$conexion->prepare("SELECT * FROM organizacion");
    $sentenciaSQL->execute();
    $listaorganizacion=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

?>

    <div class="col-md-4">
        
        <div class="card border-success">
            <div class="card-header">
                Datos de la Organizacion
            </div>
                               
            <div class="card-body">

                <form method="POST" enctype="multipart/form-data">
    
                    <div class = "form-group">
                        <label for="txtIDO">Codigo:</label>
                        <input type="text" required readonly class="form-control" value="<?php echo $txtIDO; ?>" name="txtIDO" id="txtIDO" placeholder="Codigo de la organizacion">
                    </div>

                    <div class="form-group">
                        <label for="txtNombreO">Nombre:</label>
                        <input type="text" required class="form-control" value="<?php echo $txtNombreO ?>" name="txtNombreO" id="txtNombreO" placeholder="Nombre de la Organizacion">
                    </div>

                    <div class="form-group">
                        <label for="txtFotoO">Foto:</label>
                        <br/>                        
                        <?php if ($txtFotoO!="") { ?>
                            <img class="img-thumbnail rounded" src="../../img/<?php echo $txtFotoO;?>" width="50" alt="">
                        <?php } ?>

                        <input type="file" class="form-control" " name="txtFotoO" id="txtFotoO" placeholder="Foto de la Organizacion">
                    </div>

                    <div class="form-group">
                        <label for="txtDescripcionO">Descripcion:</label>
                        <input type="text" required class="form-control" value="<?php echo $txtDescripcionO; ?>" name="txtDescripcionO" id="txtDescripcionO" placeholder="Descripcion de la Organizacion">
                    </div>

                    <div class="form-group">
                        <label for="txtMision">Mision:</label>
                        <input type="text" required class="form-control" value="<?php echo $txtMision; ?>" name="txtMision" id="txtMision" placeholder="Mision de la Organizacion">
                    </div>

                    <div class="form-group">
                        <label for="txtVision">Vision:</label>
                        <input type="text" required class="form-control" value="<?php echo $txtVision; ?>" name="txtVision" id="txtVision" placeholder="Vision de la Organizacion">
                    </div>

                    <div class="form-group">
                        <label for="txtValores">Valores:</label>
                        <input type="text" required class="form-control" value="<?php echo $txtValores; ?>" name="txtValores" id="txtValores" placeholder="Valores de la Organizacion">
                    </div>

                    <div class="btn-group" role="group" aria-label="">
                        <button type="submit" name="accion" <?php echo ($accion=="Seleccionar")?"disabled":""; ?> value="Agregar" class="btn btn-success">Agregar</button>
                        <button type="submit" name="accion" <?php echo ($accion!="Seleccionar")?"disabled":""; ?> value="Modificar" class="btn btn-warning">Modificar</button>
                        <button type="submit" name="accion" <?php echo ($accion!="Seleccionar")?"disabled":""; ?> value="Cancelar" class="btn btn-info">Cancelar</button>
                    </div>
                </form>
                   
            </div>
               
        </div>

    </div>    
        
        

    <div class="col-md-8">
        
        <table class="table table-bordered table-success">
            <thead>
                <tr>
                    <th>Codigo</th>
                    <th>Nombre</th>
                    <th>Foto</th>
                    <th>Descripcion</th>
                    <th>Mision</th>
                    <th>Vision</th>
                    <th>Valores</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($listaorganizacion as $organizacion) { ?>
                <tr>
                    <td><?php echo $organizacion['codigoo']; ?></td>
                    <td><?php echo $organizacion['nombreo']; ?></td>
                    <td>
                        <img  class="img-thumbnail rounded" src="../../img/<?php echo $organizacion['fotoo']; ?>" width="50" alt="">
                        
                    </td>
                    <td><?php echo $organizacion['descripciono']; ?></td>
                    <td><?php echo $organizacion['mision']; ?></td>
                    <td><?php echo $organizacion['vision']; ?></td>
                    <td><?php echo $organizacion['valores']; ?></td>

                    <td>
                        <form method="post">
                            <input type="hidden" name="txtIDO" id="txtID" value="<?php echo $organizacion['codigoo']; ?>">
                            <input type="submit" name="accion" value="Seleccionar" class="btn btn-primary btn-sm"/>
                            <!-- <input type="submit" name="accion" value="Borrar" class="btn-danger btn-sm"/> -->

                        </form>
                    </td>
                </tr>
                <?php } ?>
              
            </tbody>
        </table>

    </div>

<?php include("../template/pie.php"); ?>