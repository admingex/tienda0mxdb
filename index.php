<?php
    require('./config/settings.php');
    //menús
    require('./templates/header.php');
    
    
    //contenido
    include('componentes/slider.php');
    include('componentes/promociones.php');
    
    //footer
    require('./templates/footer.php');
?>

