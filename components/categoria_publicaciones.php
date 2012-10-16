<div style='width: 700px; float: left'>			
<?php
	/*Despliega las publicaciones de una categoría*/
	/*
	echo "<pre>";
		print_r($categoria->publicaciones);
	echo "</pre>";
	*/
	
echo "		
			<div class='list_carousel responsive'>
				<ul id='slider'>";
								
				/*	<li><img src='images/cDIN.jpg'     id='1' onmouseover=\"cambia_img(this.id)\" onmouseout=\"cambia_img(this.id)\"></li>*/
				
				
				foreach ($categoria->publicaciones as $p) {
					//url de la publicación
					$url_p = '';
					if($p->formatos > 1) {
						//URL para que se vaya a la lista de promociones y se pueda filtrar por formatos y precios
						$url_p = site_url('categoria/'.$p->id_categoria.'/publicacion/ofertas/') . $p->id_publicacion;
					} else {
						//Si no trae más de un formato, ir al detalle de la promoción: suscripción / producto / PDF
						$url_p = site_url('categoria/'.$p->id_categoria.'/publicacion/detalle/') . $p->id_publicacion;
					}
					
					//revisar que exista la imagen en caso contrario ponemos el cuadro negro				
					if(file_exists("./p_images/".$p->url_imagen)){
						$src = TIENDA ."p_images/".$p->url_imagen;
					}
					else{
						$src = TIENDA ."p_images/css_sprite_PortadaCaja.jpg";
						//$src = TIENDA ."p_images/".$p->url_imagen;
					}
					echo "	<li>					
								<a href='". $url_p . "'>";																	
									echo "<img src='" . $src. "' />";																
					echo "		</a>
							</li>";		
				}				
				
												
echo  " 		</ul>				
				<a id='prev' class='prev' href='#'>&lt;</a>
				<a id='next' class='next' href='#'>&gt;</a>				
			</div>";
?>
</div>