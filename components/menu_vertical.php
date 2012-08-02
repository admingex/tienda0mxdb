<div class="menuv">
	<ul>
		<li>
			<p>
			    <strong>Publicaciones</strong>
			</p>
			<ul>
			<?php
				$json = file_get_contents("./json/publicaciones/publicaciones.json");
				$publicaciones = json_decode($json);
				
				foreach ($publicaciones->publicaciones as $publicacion) {
					echo "<li><a href='".site_url('publicacion/').$publicacion->id_publicacionSi."'>".$publicacion->nombreVc."</a></li>";
				}
			?>
			</ul>
		</li>
	</ul>
</div>