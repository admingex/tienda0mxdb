<?php	 
	include('./core/util_helper.php');

	//requiredincludes
    require('./config/settings.php');
	
	
	$menues = TRUE; 
    //menús
    require('./templates/header.php');
    
    
    //contenido
    include('./components/slider.php');
    include('./components/promociones.php');
    
    //footer
    require('./templates/footer.php');
	
?>

