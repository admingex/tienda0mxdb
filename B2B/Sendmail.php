<?php
	session_start();
    require('./templates/header.php');
	//$ip="http://10.177.78.54/subir_tienda/publicacion/detalle/";	
	$ip="";
	//$revista=$_SESSION['lugarTienda'];
	$revista="";
	//session_unset(); 
	//session_destroy();
?>
		<div class="titulo-proceso">
			Estimado cliente:
		</div>
		<br>
		<p class="label_izq"></p>
		</section>
		<div id="pleca-punteada"></div>
		<section class="contenedor">	
	
			<p class="label_izq">Estimado cliente su solicitud esta siendo procesada, en breve lo contactaremos.</p>
			<!--<p class="label_izq">Su solicitud ha sido procesada con éxito.</p>-->
			<p class="label_izq">Muchas gracias por solicitar productos a través de Kiosco.</p>
			<span style="padding-left:10px; "><a href="<?php echo $ip; echo $revista; ?>" class="">Regresar</a></span>
<?php
    require('templates/footer.php');
?>