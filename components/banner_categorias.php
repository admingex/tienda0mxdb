<nav class="banner_categorias">
	<ul>		
		<?php
		$json = file_get_contents("json/baner_categorias.json");
		$categorias = json_decode($json);
		foreach ($categorias->categorias as $categoria) {
			echo "<li><a href='".site_url('categoria/').$categoria->id_categoria."'>".$categoria->descripcionVc."</a></li>";
		}
		?>
	</ul>	
</nav>
