<nav class="banner_categorias">
	<ul>		
		<?php 
		
		/*$json = '{"publicaciones":[
				{"id_publicacionSi":"1", "descripcionVc":"IDC", "url":"#"},
				{"id_publicacionSi":"1", "descripcionVc":"Expansion", "url":"#"}
			]
		
		}';
		*/
		$json = file_get_contents("json/baner_categorias.json");
		
		$categorias = json_decode($json);
		
		foreach($categorias->categorias as $categoria) {
			echo "<li><a href='".$categoria->url."'>".$categoria->descripcionVc."</a></li>";
		}				
		?>
	</ul>	
</nav>
