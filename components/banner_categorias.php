<nav class="banner_categorias">
	<ul>		
		<?php
		$json = file_get_contents("./json/categorias/categorias.json");
		$categorias = json_decode($json);
		echo "<li><a href='".site_url('home')."'>Inicio</a></li>";
		foreach ($categorias->categorias as $categoria) {
			echo "<li><a href='".site_url('categoria/').$categoria->id_categoriaSi."'>".$categoria->nombreVc."</a></li>";
		}
		?>
	</ul>	
</nav>
