<?php	 
	require_once('./core/util_helper.php');
	require_once('./controllers/json_creator.php');

	//requiredincludes
    require_once('./config/settings.php');
			
    //header (y/o menús)
    $menues = TRUE;
	
	//incluir archivos js
	$scripts = array();	
	$scripts [] = TIENDA."js/login.js";
	$scripts [] = TIENDA."js/registro.js";
	
	$data["scripts"] = $scripts;
	$data["title"] = "Generación de los JSON files";
	$data["subtitle"] = "Generación de los JSON files";
	
	//header
    require('./templates/header.php');
    
    //contenido
    include('./components/json.php');
    //echo "Categorías aquí";
        
    //footer
    require('./templates/footer.php');
	
?>

