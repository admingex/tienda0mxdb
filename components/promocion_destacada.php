<link type="text/css" href="<?php echo TIENDA;?>css/orbit-1.2.3.css" rel="stylesheet" />
<div id="contenedor-promo-especial">
<?php
//iterar sobre las promociones destacadadas y sólo scar una
foreach ($pd->promocion_especial_destacada as $j) {
?>
	<div id="featured">
    <?php
	    echo "
			<form name='comprar_promocion_destacada' action='".API::API_URL. $j->id_sitioSi."/".$j->id_canalSi."/".$j->id_promocionIn."/pago' method='post'>
			  	<div class='promo-left'>
			      	<input type='hidden' name='guidx' value='".API::GUIDX."'/>
			      	<input type='hidden' name='guidz' value='".API::guid()."'/>
			      	<a href=''><img src='".TIENDA.$j->url_imagenVc."'/></a>
			      	<div class='descripcion'>".$j->descripcionVc."</div>
			      	<div class='descripcion'>".$j->tarifaDc."</div>
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