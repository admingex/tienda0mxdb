<div class="menuv">
	<ul>
		<li>
			<p>
			    <strong>Publicaciones</strong>
			</p>
			
			
			<ul>		
			<?php
			
			/*$json = '{"publicaciones":[
					{"id_publicacionSi":"1", "descripcionVc":"IDC", "url":"#"},
					{"id_publicacionSi":"1", "descripcionVc":"Expansion", "url":"#"}
				]
			
			}';
			*/
			$json = file_get_contents("json/publicaciones.json");
			
			$publicaciones = json_decode($json);
			
			foreach($publicaciones->publicaciones as $publicacion) {
				echo "<li><a href='".$publicacion->url."'>".$publicacion->descripcionVc."</a></li>";
			}
			
				
			?>
			</ul>
		</li>
	</ul>
</div>