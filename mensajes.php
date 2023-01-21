<?php include("template/cabecera.php"); ?>

<?php
   
    
    include("./administrador/config/bd.php");
   
    $sentenciaSQL=$conexion->prepare("SELECT * FROM mensajes");
    $sentenciaSQL->execute();
    $listaMensajes=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

?>

<div class="col-md-12">
        <h3 class="display-5 text-info text-center"><strong>Mensajes enviados por Visitantes </strong></h3>
        <table class="table table-bordered table-success ">
            <thead>
                <tr>
                    <th>Codigo</th>
                    <th>Correo</th>
                    <th>Nombre</th>
                    <th>Telefono</th>
                    <th>Asunto</th>
                    <th>Mensaje</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($listaMensajes as $mensajes) { ?>
                <tr>
                    <td><?php echo $mensajes['codm']; ?></td>
                    <td><?php echo $mensajes['correo']; ?></td>
                    <td><?php echo $mensajes['names']; ?></td>
                    <td><?php echo $mensajes['phone']; ?></td>
                    <td><?php echo $mensajes['asunto']; ?></td>
                    <td><?php echo $mensajes['contenido']; ?></td>
                </tr>
                <?php } ?>
              
            </tbody>
        </table>

    </div>

<?php include("template/pie.php"); ?>