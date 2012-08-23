<link type="text/css" href="<?php echo TIENDA;?>css/orbit-1.2.3.css" rel="stylesheet" />
<div id="contenedor-promo-especial">
<?php
//iterar sobre las promociones destacadadas y sólo scar una
foreach ($pd->promo_destacada as $promo_destacada) {
?>
	<div id="featured">
    <?php
	    echo "
			<form name='comprar_promocion_destacada' action='".API::API_URL. $promo_destacada->id_sitio."/".$promo_destacada->id_canal."/".$promo_destacada->id_promocion."/pago' method='post'>
			  	<div class='promo-left'>
			      	<input type='hidden' name='guidx' value='".API::GUIDX."'/>
			      	<input type='hidden' name='guidz' value='".API::guid()."'/>
			      	<a href=''><img src='".TIENDA."p_images/".$promo_destacada->url_imagen."'/></a>
			      	
			      	<div class='descripcion'>
			          	<input type='submit' name='comprar_ahora' value=''/>
			      	</div>
	    		</div>
	      	</form>";
      	echo "<img src='".TIENDA.$j->url_imagenVc."' onclick='document.comprar_promocion_destacada.submit();'/>";	      		
	?>
	</div>

<?php
}
?>
</div>