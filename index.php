<?php include("template/cabecera.php"); ?>
<!-- Universidad Tecnica de Manabi
		Carrera de Tecnologia de la Informacion
			Desarrollo de Aplicaciones WEB
				Wilmer Mejia Jimenez
					6to semestre
						Ing. Erick Zherdmant, Mg.-->
	
<?php
      
    include("./administrador/config/bd.php");

    $sentenciaSQL=$conexion->prepare("SELECT * FROM organizacion");
    $sentenciaSQL->execute();
    $listaOrganizacion=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
?>
            
            <div class="jumbotron text-center">
                <?php foreach($listaOrganizacion as $organizacion) { ?>
                    <h1 class="display-3 text-info"><strong> <?php echo $organizacion['nombreo']; ?></strong></h1>
                    <h3><strong> Organizacion y Planeacion de Eventos </strong></h3>
                    <hr class="my-2">
                    <img width="1200" src="./img/<?php echo $organizacion['fotoo']; ?>" class="img-thumbnail rounded mx-auto d-block" alt=""/>
                    <!-- ./img/imagenes/letrero.jpg -->
                    <br/>
                    <h4><?php echo $organizacion['descripciono']; ?></h4>
                    <!-- <h4> Glamour eventos Tulcan es una empresa cultural conformada por un grupo de expertos en diferentes ramas en la organizacion de eventos, con los cuales garantizamos la calidad en los servicios 
                        que la empresa ofrece a nuestros clientes.</h4>
                    <br/>
                    
                    <hr>
                    <h4>Nuestra empresa ofrece un sinnumero de alternativas para organicacion de su evento la cual puede ir desde el alquiler del local para exposicion de tus productos con modelos, como 
                    celebraciones empresariales o familiares, decoraciones, animaciones, alquiler de moviliarios y todo lo referente a la planeacion de su evento.</h4> -->
                    <br>
                    <hr>
                    <p><em>Mas informacion</em></p>
                    <p class="lead">
                        <a class="btn btn-primary btn-lg" href="productos.php" role="button">Revisa nuestros productos</a>
                    </p>
                <?php }?>
            </div>

<?php include("template/pie.php"); ?>



        