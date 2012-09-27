<?php
	/*atiende las peticiones en el nivel de categorías*/
	include('./core/util_helper.php');

	//required includes
    require('./config/settings.php');
			
    //header (y/o menús)
    $menues = TRUE;
	
	//incluir archivos js
	$scripts = array();		
	
	//información para la vista
	$title = "Cuenta de Usuario";
	$subtitle = "Administrar cuenta de usuario";
	
	$data = array();
	$data["scripts"] = $scripts;
	$data["title"] = $title;
	$data["subtitle"] = $subtitle;
	
	
	
	cargar_vista('cuenta_usuario', $data);
	exit;

?>
