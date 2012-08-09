<div class="menuv">
	<ul>
		<li>
			<p>
			    <strong>Publicaciones</strong>
			</p>
			<ul>
			<?php
				//ruta del archivo de las publicaciones
				$path_pubs = "./json/publicaciones/publicaciones.json";
				if (file_exists($path_pubs)) {
					$json = file_get_contents($path_pubs);
					$pubs = json_decode($json);
					
					foreach ($pubs->publicaciones as $p) {
						//url de la publicación
						$url_p = '';
						if($p->formatos > 1) {
							//URL para que se vaya a la lista de promociones y se pueda filtrar por formatos y precios
							$url_p = site_url('publicacion/ofertas/') . $p->id_publicacionSi;
						} else {
							//Si no trae más de un formato, ir al detalle de la promoción/suscripción / producto
							$url_p = site_url('publicacion/detalle/') . $p->id_publicacionSi;
						}
						
						echo "<li><a href='".$url_p."'>".$p->nombreVc."</a></li>";
					}
				} else {
					//Si no existe el archivo con la información ¿¿??
				}
			?>
			</ul>
		</li>
	</ul>
</div>