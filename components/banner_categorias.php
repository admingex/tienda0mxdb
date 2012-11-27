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
		<li>
		<?php                    	
			if(isset($_SESSION['logged_in'])){
				if($_SESSION['logged_in']==1){
					echo "<a class='mi_cuenta' href='".site_url('cuenta.php')."'>mi cuenta</a>";
					echo "<a class='logout' href='".site_url('logout/')."'>salir</a>";                    								
				}
			}
			else{
				echo "<a class='login' href=".site_url('login/').">mi cuenta</a>";								
			}
		?>	
		</li>
	</ul>	
</nav>
