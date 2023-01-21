<?php include("template/cabecera.php"); ?>

<?php
    
    include("administrador/config/bd.php");

    $sentenciaSQL=$conexion->prepare("SELECT * FROM productos");
    $sentenciaSQL->execute();
    $listaProductos=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

?>

<?php foreach($listaProductos as $producto) { ?>

    <div class="col-md-3">
        <div class="card">
            <img class="card-img-top" src="./img/<?php echo $producto['foto']; ?>" alt="">
            <div class="card-body">
                <h4 class="card-title text-center"><?php echo $producto['nombre']; ?></h4> 
                <p align="center"><?php echo $producto['descripcion']; ?> </p> 
                <!-- <a name="" id="" class="btn btn-primary" href="#" role="button">Ver mas</a>*/-->
            </div>
        </div>
        <br>
    </div>

<?php }?>

    
    


    

<?php include("template/pie.php"); ?>