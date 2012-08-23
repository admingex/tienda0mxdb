<link type="text/css" href="<?php echo TIENDA;?>css/orbit-1.2.3.css" rel="stylesheet" />
<div id="contenedor-promo-especial">
<?php
//iterar sobre las promociones destacadadas y sólo scar una
foreach ($pd as $p_destacada) {
	
//	echo "img" . $p_destacada->url_imagen;
?>
	<div id="featured">
    <?php	    			
      	echo "<a href='" . TIENDA . "/promocion/" . $p_destacada->id_promocion ."'>
      		      <img src='".TIENDA."p_images/".$p_destacada->url_imagen."' width='529px' height='246px' />
      		  </a>";			      		
	?>
	</div>

<?php
}
?>
</div>