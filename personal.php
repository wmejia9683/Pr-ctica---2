<?php include("template/cabecera.php"); ?>

<?php
    
    include("administrador/config/bd.php");

    $sentenciaSQL=$conexion->prepare("SELECT * FROM personal");
    $sentenciaSQL->execute();
    $listaPersonal=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

?>

<?php foreach($listaPersonal as $personal) { ?>

    <div class="col-md-3">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title"><?php echo $personal['nombreh']; echo " "; echo $personal['apellido'];?></h4> 
                <p><?php echo $personal['direccion']; ?> </p>
                <p><?php echo $personal['telefono']; ?> </p> 
                <p><?php echo $personal['mail']; ?> </p>
                <p><?php echo $personal['rol']; ?> </p>
                
                <!-- <a name="" id="" class="btn btn-primary" href="#" role="button">Ver mas</a>*/-->
            </div>
        </div>
        <br>
    </div>

<?php }?>

    
    


    

<?php include("template/pie.php"); ?>
