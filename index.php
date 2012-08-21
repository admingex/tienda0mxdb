<?php	 
	include('./core/util_helper.php');

	//requiredincludes
    require('./config/settings.php');
	require('./controllers/paginacion.php');
	
	
	$menues = TRUE; 
    //menús
    require('./templates/header.php');
    
    
    //contenido
    include('./components/slider_home.php');
    include('./components/promociones_home.php');
    
    //footer
    require('./templates/footer.php');
	
?>

