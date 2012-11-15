
<div style=" margin-top: -230px; margin-left: 710px">
<?php
//iterar sobre las promociones destacadadas y sólo scar una
	foreach ($pd as $p_destacada) {
	//	echo "img" . $p_destacada->url_imagen;
      	echo "<a href='" . TIENDA . "promocion/" . $p_destacada->id_promocion ."'>
      		      <img src='".TIENDA."p_images/".$p_destacada->url_imagen."' width='275px' height='230px' />
      		  </a>";			      			
	}
?>
</div>