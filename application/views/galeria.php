<section id="portfolio">
<div id="galeria" class="container">
	<div class="center">
        <h2>Articulos</h2>
    </div>
            <ul class="portfolio-filter text-center">
                <li><a class="btn btn-default active" href="#" data-filter="*">Productos</a></li>
                <li><a class="btn btn-default" href="#" data-filter=".ar">Arte</a></li>
                <li><a class="btn btn-default" href="#" data-filter=".arqui">Arquitectura</a></li>
                <li><a class="btn btn-default" href="#" data-filter=".ill">Ilustraccion</a></li>
                <li><a class="btn btn-default" href="#" data-filter=".dis">Diseño</a></li>
                <li><a class="btn btn-default" href="#" data-filter=".bas">Basico</a></li>
            </ul><!--/#portfolio-filter-->
  <?php
     for($i=0;$i<count($articulos);$i++){
           ?>
		<div class="col-xs-12 col-sm-4 col-md-3">
		<div class="thumbnail">
		 <img class ="img-responsive" src="<?php echo 'images/'.$articulos[$i]['imagen']?>">
			      <div class="caption">
			        <h3><?php echo $articulos[$i]['Nombre']  ?></h3>
			        <p id="descripcion"><?php echo $articulos[$i]['Descripción']  ?></p>
			        <?php
                       $pre = $articulos[$i]['Precio'];
                       $pre = number_format($pre,2,'.',',');
                       $idArt =$articulos[$i]['idArticulo']; 
			        ?>
			        <p id="precio"><?php echo '$'.$pre ?></p>

			        <!-- <p class="der"><a href="<?php //echo 'index.php/welcome/agregarCarrito/'.$idArt; ?>" class="btn btn-primary" role="button">Comprar</a></p> -->

			        <p class="der"><a class="btn btn-primary" role="button" onClick="agregarArticulo(<?php echo $idArt; ?>);" >Comprar</a></p>
			      </div>
			    </div>
			  </div>
			<!-- /div -->
         <?php
     }  
  ?>
</div>