
<div style="margin-left:10px; float: left; ">
<?php
//iterar sobre las promociones destacadadas y sólo scar una
	foreach ($pd as $p_destacada) {
	//	echo "img" . $p_destacada->url_imagen;
      	echo "<a href='" . TIENDA . "promocion/" . $p_destacada->id_promocion ."'>
      		      <img src='".TIENDA."p_images/".$p_destacada->url_imagen."' width='270px' height='230px' />
      		  </a>";			      			
	}
?>
</div>