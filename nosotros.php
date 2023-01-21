<?php include("template/cabecera.php"); ?>

<?php
    
    include("./administrador/config/bd.php");

    $sentenciaSQL=$conexion->prepare("SELECT * FROM organizacion");
    $sentenciaSQL->execute();
    $listaOrganizacion=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
?>
            
            <div class="jumbotron">
                <h1 class="display-3 text-info" ><strong>Nosotros</strong></h1>
                <p class="lead">Aqui vien lo referente a nostros</p>
                <hr class="my-2">
            </div>
            <?php foreach($listaOrganizacion as $organizacion) { ?>
            <div class="row">
            <div class="bs-component col-lg-8 text-bg-info">
                <h1> Quienes Somos? </h1>
            <!-- <img src="./imagenes/glamour.jpg" alt="Imagen1"> -->
                <!-- <hr color="red"> -->
                <p align="justify"><em>Somos una empresa dedicada a la comercialización integral de eventos con soluciones creativas dirigidas a empresas 
                    para la organización de eventos en el Carchi. También nos enfocamos en celebraciones y por otro lado desarrollamos grandes eventos
                     comerciales dirigidos a un cliente final de una manera experiencial y sostenible.
                    Nos diferenciamos en el mercado como una marca que se posiciona en el diseño eventos especiales con conceptos originales, haciendo
                     uso de la imagen sensorial para generar grandes emociones , que quedarán grabadas en el corazón de los asistentes.
                    Por otra parte, nos preocupamos por el impacto medioambiental que la actividad humana tiene sobre los ecosistemas y es por ello que
                     trabajamos para realizar un «evento sostenible» creando unos beneficios ambientales, económicos y sociales para nuestros clientes 
                     en la organización de eventos.
                     Todos nuestros eventos cubren las necesidades de máxima tranquilidad, despreocupación y confianza en un excelente servicio de cumplir
                      con las expectativas del cliente, vendiendo experiencias y generando sensaciones.

</em></em></p>
                
                <hr class="my-2">
                <img width="400" src="./img/imagenes/glamour eventostulcan.png" class="img-thumbnail rounded mx-auto d-block" alt=""/>
                <br/>

            </div>
            <div class="col-lg-4 text-bg-info">
                <div>
                    <h2><strong>Mision</strong></h2>
                    <hr color="gainsboro">
                    <p align="justify"><?php echo $organizacion['mision']; ?></p>
                </div>
            <!-- </div>  
            <div class="col-lg-4"> -->
                <div>
                    <h2><strong>Vision</strong></h2>
                        <hr color="gainsboro">
                        <p align="justify"><?php echo $organizacion['vision']; ?></p>
                </div>
            <!-- </div>  
            <div class="col-lg-4"> -->
                <h2><strong>Valores</strong></h2>
                <hr color="gainsboro">
                <p align="justify"><?php echo $organizacion['valores']; ?> </p>
            </div>
            </div>
            <?php } ?>


<?php include("template/pie.php"); ?>
