<?php include("template/cabecera.php"); ?>

<?php
    // //seccion de prueba conexion a base de datos para almacenar los mensajes de contactos
    // $host="localhost";
    // $bd="_actividad_docente";
    // $usuario="root";
    // $contrasenia="";

    // try {
    //     $conexion=new PDO("mysql:host=$host;dbname=$bd",$usuario,$contrasenia);
    //     if ($conexion) {echo "conectado al sistema";
    //       # code...
    //     }
    // } catch (Exception $ex) {
    //     echo $ex->getMessage();
    // }

    $txtIDM=(isset($_POST['txtIDM']))?$_POST['txtIDM']:"";
    $txtCorreo=(isset($_POST['txtCorreo']))?$_POST['txtCorreo']:"";
    $txtName=(isset($_POST['txtName']))?$_POST['txtName']:"";
    $txtPhone=(isset($_POST['txtPhone']))?$_POST['txtPhone']:"";
    $txtTitle=(isset($_POST['txtTitle']))?$_POST['txtTitle']:"";
    $txtArea=(isset($_POST['txtArea']))?$_POST['txtArea']:"";
    $Action=(isset($_POST['Action']))?$_POST['Action']:"";
    
    include("./administrador/config/bd.php");
   
    switch ($Action) {
        case 'Enviar':
           
            $sentenciaSQL=$conexion->prepare("INSERT INTO mensajes (correo, names, phone, asunto, contenido) VALUES (:correo,:names,:phone,:asunto,:contenido);");
            $sentenciaSQL->bindParam(':correo',$txtCorreo);
            $sentenciaSQL->bindParam(':names',$txtName);
            $sentenciaSQL->bindParam(':phone',$txtPhone);
            $sentenciaSQL->bindParam(':asunto',$txtTitle);
            $sentenciaSQL->bindParam(':contenido',$txtArea);
            $sentenciaSQL->execute();
            header("Location:Contactos.php");
            break;
    }

    $sentenciaSQL=$conexion->prepare("SELECT * FROM mensajes");
    $sentenciaSQL->execute();
    $listaMensajes=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

?>
<legend class="display-6 text-info text-center">Queremos saber que opinas</legend>
<form method="POST" enctype="multipart/form-data" class="col-md-5">
  <fieldset>
    
       
    <div class="form-group ">
      <label for="txtCorreo">Direccion Email:</label> 
      <input type="email" required class="form-control" value="<?php echo $txtCorreo; ?>" name="txtCorreo" id="txtCorreo" aria-describedby="emailHelp" placeholder="Ingrese email">
    </div>
    
    <div class="form-group">
    <fieldset>
        <label class="form-label mt-4" for="txtName">Nombre y Apellido</label>
        <input class="form-control" required value="<?php echo $txtName; ?>" name="txtName" id="txtName" type="text" placeholder="Nombre " >
    </fieldset>
    </div>
    
    <div class="form-group">
    <fieldset>
        <label class="form-label mt-4" for="txtPhone">Telefono</label>
        <input class="form-control" required value="<?php echo $txtPhone; ?>" name="txtPhone" id="txtPhone" type="text" placeholder="Telefono" >
    </fieldset>
    </div>
    
    <div class="form-group">
    <fieldset>
        <label class="form-label mt-4" for="txtTitle">Asunto</label>
        <input class="form-control" required value="<?php echo $txtTitle; ?>" name="txtTitle" id="txtTitle" type="text" placeholder="Asunto" >
    </fieldset>
    </div>
    
    <div class="form-group">
      <label for="exampleTextarea" class="form-label mt-4">Mensaje</label>
      <textarea class="form-control" required value="<?php echo $txtArea; ?>" name="txtArea" id="txtArea" rows="3" placeholder="Dejanos tu mensaje, comentario o recomendacion "></textarea>
    </div>
    <br>
    <button type="submit" name="Action" value="Enviar" class="btn btn-success">Enviar</button>
  </fieldset>
</form>  
 
   <?php include("template/pie.php"); ?>