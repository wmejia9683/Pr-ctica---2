<?php include("../template/cabecera.php");?>
<?php
    $txtID=(isset($_POST['txtID']))?$_POST['txtID']:"";
    $txtNombre=(isset($_POST['txtNombre']))?$_POST['txtNombre']:"";
    $txtDescripcion=(isset($_POST['txtDescripcion']))?$_POST['txtDescripcion']:"";
    $txtFoto=(isset($_FILES['txtFoto']['name']))?$_FILES['txtFoto']['name']:"";
    $accion=(isset($_POST['accion']))?$_POST['accion']:"";
    
    include("../config/bd.php");
   
    switch ($accion) {
        case 'Agregar':
            $sentenciaSQL=$conexion->prepare("INSERT INTO productos (nombre,descripcion,foto) VALUES (:nombre,:descripcion,:foto);");
            $sentenciaSQL->bindParam(':nombre',$txtNombre);
            $sentenciaSQL->bindParam(':descripcion',$txtDescripcion);

            $fecha= new DateTime();
            $nombreArchivo=($txtFoto!="")?$fecha->getTimestamp()."_".$_FILES["txtFoto"]["name"]:"imagen.jpg";
            $tmpFoto=$_FILES["txtFoto"]["tmp_name"];

            if($tmpFoto!=""){
                move_uploaded_file($tmpFoto,"../../img/".$nombreArchivo);
            }            

            $sentenciaSQL->bindParam(':foto',$nombreArchivo);
            $sentenciaSQL->execute();

            header("Location:productos.php");
            break;

        case 'Modificar':
            $sentenciaSQL=$conexion->prepare("UPDATE productos SET nombre=:nombre, descripcion=:descripcion WHERE codigo=:codigo");
            $sentenciaSQL->bindParam(':codigo',$txtID);
            $sentenciaSQL->bindParam(':nombre',$txtNombre);
            $sentenciaSQL->bindParam(':descripcion',$txtDescripcion);
            $sentenciaSQL->execute();

            if ($txtFoto!="") {

                $fecha= new DateTime();
                $nombreArchivo=($txtFoto!="")?$fecha->getTimestamp()."_".$_FILES["txtFoto"]["name"]:"imagen.jpg";
                $tmpFoto=$_FILES["txtFoto"]["tmp_name"];
                move_uploaded_file($tmpFoto,"../../img/".$nombreArchivo);

                $sentenciaSQL=$conexion->prepare("SELECT foto FROM productos WHERE codigo=:codigo");
                $sentenciaSQL->bindParam(':codigo',$txtID);
                $sentenciaSQL->execute();
                $producto=$sentenciaSQL->fetch(PDO::FETCH_LAZY);

                if ( isset($producto["foto"]) &&($producto["foto"]!="imagen.jpg") ){
                    if (file_exists("../../img/".$producto["foto"])) {
                        unlink("../../img/".$producto["foto"]);
                    } 
                }

                $sentenciaSQL=$conexion->prepare("UPDATE productos SET foto=:foto WHERE codigo=:codigo");
                $sentenciaSQL->bindParam(':codigo',$txtID);
                $sentenciaSQL->bindParam(':foto',$nombreArchivo);
                $sentenciaSQL->execute();
            }
            header("Location:productos.php");
            break;

        case 'Cancelar':
            header("Location:productos.php");
            break;

        case 'Seleccionar':
            $sentenciaSQL=$conexion->prepare("SELECT * FROM productos WHERE codigo=:codigo");
            $sentenciaSQL->bindParam(':codigo',$txtID);
            $sentenciaSQL->execute();
            $producto=$sentenciaSQL->fetch(PDO::FETCH_LAZY);
            
            $txtNombre=$producto['nombre'];
            $txtDescripcion=$producto['descripcion'];
            $txtFoto=$producto['foto'];
            
            break;

        case 'Borrar':
            $sentenciaSQL=$conexion->prepare("SELECT foto FROM productos WHERE codigo=:codigo");
            $sentenciaSQL->bindParam(':codigo',$txtID);
            $sentenciaSQL->execute();
            $producto=$sentenciaSQL->fetch(PDO::FETCH_LAZY);

            if (isset($producto["foto"]) &&($producto["foto"]!="imagen.jpg")) {
                if (file_exists("../../img/".$producto["foto"])) {
                    unlink("../../img/".$producto["foto"]);
                } 
            }
            $sentenciaSQL=$conexion->prepare("DELETE FROM productos WHERE codigo=:codigo");
            $sentenciaSQL->bindParam(':codigo',$txtID);
            $sentenciaSQL->execute();
            header("Location:productos.php");        
            break;
    }

    $sentenciaSQL=$conexion->prepare("SELECT * FROM productos");
    $sentenciaSQL->execute();
    $listaProductos=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

?>

    <div class="col-md-4">
        
        <div class="card border-success">
            <div class="card-header">
                Datos del producto
            </div>
                               
            <div class="card-body">

                <form method="POST" enctype="multipart/form-data">
    
                    <div class = "form-group">
                        <label for="txtID">Codigo:</label>
                        <input type="text" required readonly class="form-control" value="<?php echo $txtID; ?>" name="txtID" id="txtID" placeholder="Codigo">
                    </div>

                    <div class="form-group">
                        <label for="txtNombre">Nombre:</label>
                        <input type="text" required class="form-control" value="<?php echo $txtNombre ?>" name="txtNombre" id="txtNombre" placeholder="Nombre del Producto">
                    </div>

                    <div class="form-group">
                        <label for="txtDescripcion">Descripcion:</label>
                        <input type="text" required class="form-control" value="<?php echo $txtDescripcion; ?>" name="txtDescripcion" id="txtDescripcion" placeholder="Descripcion del Producto">
                    </div>

                    <div class="form-group">
                        <label for="txtNombre">Foto:</label>
                        <br/>                        
                        <?php if ($txtFoto!="") { ?>
                            <img class="img-thumbnail rounded" src="../../img/<?php echo $txtFoto;?>" width="50" alt="">
                        <?php } ?>

                        <input type="file" class="form-control" " name="txtFoto" id="txtFoto" placeholder="Foto del Producto">
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
                    <th>Descripcion</th>
                    <th>Foto</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($listaProductos as $producto) { ?>
                <tr>
                    <td><?php echo $producto['codigo']; ?></td>
                    <td><?php echo $producto['nombre']; ?></td>
                    <td><?php echo $producto['descripcion']; ?></td>
                    <td>
                        <img  class="img-thumbnail rounded" src="../../img/<?php echo $producto['foto']; ?>" width="50" alt="">
                        
                    </td>

                    <td>
                        <form method="post">
                            <input type="hidden" name="txtID" id="txtID" value="<?php echo $producto['codigo']; ?>">
                            <input type="submit" name="accion" value="Seleccionar" class="btn btn-primary btn-sm"/>
                            <input type="submit" name="accion" value="Borrar" class="btn-danger btn-sm"/>

                        </form>
                    </td>
                </tr>
                <?php } ?>
              
            </tbody>
        </table>

    </div>

<?php include("../template/pie.php"); ?>