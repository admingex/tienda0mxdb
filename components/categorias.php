
	<?php
		$id = isset($id_categoria) ? $id_categoria : 0;
		$file_path = "./json/categorias/publicaciones_categoria_".$id.".json";
		
		if (file_exists($file_path)) {
			$json = file_get_contents($file_path);
			$data = json_decode($json);
			
			if (count($data->publicaciones) > 0) {
			
				//foreach ($data->promocion_especial_destacada as $j) {
	?>
		<!--
			<div class="container">
			<div id="images">
			    <?php
			    /*
				echo "
					<form name='comprar_promocion_destacada' action='http://localhost/ecommerce/api/". $j->id_sitioSi."/".$j->id_canalSi."/".$j->id_promocionIn."/pago' method='post'>
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
			      	</form>
				 * 
				 */
		      		//echo "<img src='".TIENDA.$j->url_imagenVc."' onclick='document.comprar_promocion_destacada.submit();'/>";
				?>
			</div>
		</div>-->
			
			<?php
				foreach ($data->publicaciones as $p) {
					echo "
						<div class='promo-left'>
					    	<a href=''><img src='".TIENDA."images/img1.jpg' /></a>
					      	<div class='descripcion'>".$p->nombre_publicacion."</div>
					      	<div class='descripcion'>".substr($p->desc_publicacion, 0, 50)."</div>
					      	<div class='descripcion'>".$p->formatos.strlen($p->desc_publicacion)."</div>
			      		</div>
				      ";
				}
			?>
						
		<?php
			}
			
		}
		?>
		

