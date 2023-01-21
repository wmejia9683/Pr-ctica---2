<?php include("../template/cabecera.php");?>
<?php
    $txtIDP=(isset($_POST['txtIDP']))?$_POST['txtIDP']:"";
    $txtNombreH=(isset($_POST['txtNombreH']))?$_POST['txtNombreH']:"";
    $txtApellido=(isset($_POST['txtApellido']))?$_POST['txtApellido']:"";
    $txtDireccion=(isset($_POST['txtDireccion']))?$_POST['txtDireccion']:"";
    $txtTelefono=(isset($_POST['txtTelefono']))?$_POST['txtTelefono']:"";
    $txtMail=(isset($_POST['txtMail']))?$_POST['txtMail']:"";
    $txtRol=(isset($_POST['txtRol']))?$_POST['txtRol']:"";
    $Accion11=(isset($_POST['accion1']))?$_POST['accion1']:"";
    
    include("../config/bd.php");
   
    switch ($Accion11) {
        case 'Agregar1':

            $sentenciaSQL=$conexion->prepare("INSERT INTO personal (nombreh,apellido,direccion,telefono,mail,rol) VALUES (:nombreh,:apellido,:direccion,:telefono,:mail,:rol);");
            $sentenciaSQL->bindParam(':nombreh',$txtNombreH);
            $sentenciaSQL->bindParam(':apellido',$txtApellido);
            $sentenciaSQL->bindParam(':direccion',$txtDireccion);
            $sentenciaSQL->bindParam(':telefono',$txtTelefono);
            $sentenciaSQL->bindParam(':mail',$txtMail);
            $sentenciaSQL->bindParam(':rol',$txtRol);
            $sentenciaSQL->execute();
            header("Location:personal.php");
            break;

        case 'Modificar1':
            $sentenciaSQL=$conexion->prepare("UPDATE personal SET nombreh=:nombreh, apellido=:apellido, direccion=:direccion, telefono=:telefono, mail=:mail, rol=:rol WHERE cod=:cod");
            $sentenciaSQL->bindParam(':cod',$txtIDP);
            $sentenciaSQL->bindParam(':nombreh',$txtNombreH);
            $sentenciaSQL->bindParam(':apellido',$txtApellido);
            $sentenciaSQL->bindParam(':direccion',$txtDireccion);
            $sentenciaSQL->bindParam(':telefono',$txtTelefono);
            $sentenciaSQL->bindParam(':mail',$txtMail);
            $sentenciaSQL->bindParam(':rol',$txtRol);
            $sentenciaSQL->execute();

            header("Location:personal.php");
            break;

        case 'Cancelar1':
            header("Location:personal.php");
            break;

        case 'Seleccionar1':
            $sentenciaSQL=$conexion->prepare("SELECT * FROM personal WHERE cod=:cod");
            $sentenciaSQL->bindParam(':cod',$txtIDP);
            $sentenciaSQL->execute();
            $personal=$sentenciaSQL->fetch(PDO::FETCH_LAZY);
            
            $txtNombreH=$personal['nombreh'];
            $txtApellido=$personal['apellido'];
            $txtDireccion=$personal['direccion'];
            $txtTelefono=$personal['telefono'];
            $txtMail=$personal['mail'];
            $txtRol=$personal['rol'];

            break;

        case 'Borrar1':
            $sentenciaSQL=$conexion->prepare("DELETE FROM personal WHERE cod=:cod");
            $sentenciaSQL->bindParam(':cod',$txtIDP);
            $sentenciaSQL->execute();
            header("Location:personal.php");        
            break;
    }

    $sentenciaSQL=$conexion->prepare("SELECT * FROM personal");
    $sentenciaSQL->execute();
    $listaPersonal=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

?>

    <div class="col-md-4">
        
        <div class="card border-success">
            <div class="card-header">
                Datos Personales
            </div>
                               
            <div class="card-body">

                <form method="POST" enctype="multipart/form-data">
    
                    <div class = "form-group">
                        <label for="txtIDP">Codigo:</label>
                        <input type="text" required readonly class="form-control" value="<?php echo $txtIDP; ?>" name="txtIDP" id="txtIDP" placeholder="Codigo Personal">
                    </div>

                    <div class="form-group">
                        <label for="txtNombre">NombreH:</label>
                        <input type="text" required class="form-control" value="<?php echo $txtNombreH ?>" name="txtNombreH" id="txtNombreH" placeholder="Nombre de la Persona">
                    </div>

                    <div class="form-group">
                        <label for="txtApellido">Apellido:</label>
                        <input type="text" required class="form-control" value="<?php echo $txtApellido ?>" name="txtApellido" id="txtApellido" placeholder="Apellido de la Persona">
                    </div>

                    <div class="form-group">
                        <label for="txtDireccion">Direccion:</label>
                        <input type="text" required class="form-control" value="<?php echo $txtDireccion; ?>" name="txtDireccion" id="txtDireccion" placeholder="Direccion Personal">
                    </div>
                    
                    <div class="form-group">
                        <label for="txtTelefono">Telefono:</label>
                        <input type="text" required class="form-control" value="<?php echo $txtTelefono ?>" name="txtTelefono" id="txtTelefono" placeholder="Telefono Personal">
                    </div>

                    <div class="form-group">
                        <label for="txtMail">Mail:</label>
                        <input type="text" required class="form-control" value="<?php echo $txtMail ?>" name="txtMail" id="txtMail" placeholder="Mail Personal">
                    </div>

                    <div class="form-group">
                        <label for="txtRol">Rol:</label>
                        <input type="text" required class="form-control" value="<?php echo $txtRol ?>" name="txtRol" id="txtRol" placeholder="Rol de la Persona">
                    </div>

                    <div class="btn-group" role="group" aria-label="">
                        <button type="submit" name="accion1" <?php echo ($Accion11=="Seleccionar1")?"disabled":""; ?> value="Agregar1" class="btn btn-success">Agregar</button>
                        <button type="submit" name="accion1" <?php echo ($Accion11!="Seleccionar1")?"disabled":""; ?> value="Modificar1" class="btn btn-warning">Modificar</button>
                        <button type="submit" name="accion1" <?php echo ($Accion11!="Seleccionar1")?"disabled":""; ?> value="Cancelar1" class="btn btn-info">Cancelar</button>
                    </div>
                </form>
                   
            </div>
               
        </div>

    </div>    
        
        

    <div class="col-md-3">
        
        <table class="table table-bordered table-success ">
            <thead>
                <tr>
                    <th>Codigo</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Direccion</th>
                    <th>Telefono</th>
                    <th>Mail</th>
                    <th>Rol</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($listaPersonal as $personal) { ?>
                <tr>
                    <td><?php echo $personal['cod']; ?></td>
                    <td><?php echo $personal['nombreh']; ?></td>
                    <td><?php echo $personal['apellido']; ?></td>
                    <td><?php echo $personal['direccion']; ?></td>
                    <td><?php echo $personal['telefono']; ?></td>
                    <td><?php echo $personal['mail']; ?></td>
                    <td><?php echo $personal['rol']; ?></td>
                    <td>
                        <form method="post">
                            <input type="hidden" name="txtIDP" id="txtIDP" value="<?php echo $personal['cod']; ?>">
                            <input type="submit" name="accion1" value="Seleccionar1" class="btn btn-primary btn-sm"/>
                            <input type="submit" name="accion1" value="Borrar1" class="btn-danger btn-sm"/>

                        </form>
                    </td>
                </tr>
                <?php } ?>
              
            </tbody>
        </table>

    </div>

<?php include("../template/pie.php"); ?>
