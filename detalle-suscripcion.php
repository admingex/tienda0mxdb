<?php	 
	include('./core/util_helper.php');

	//requiredincludes
    require('./config/settings.php');
			
    //header (y/o menús)
    $menues = TRUE;
	
	//incluir archivos js
	$scripts = array();	
	$scripts [] = TIENDA."js/login.js";
	$scripts [] = TIENDA."js/registro.js";
	
	//header
    require('./templates/header.php');
    
    //contenido
    //include('./views/login.php');    
    
    //footer
    require('./templates/footer.php');
	
?>

