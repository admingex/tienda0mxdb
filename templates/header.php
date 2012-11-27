<!DOCTYPE html>
<html lang="es-mx">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
            
    <!--[if IE]><script src="https://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->	
    <link rel="stylesheet" href="<?php echo TIENDA;?>css/style.css" />
    <link rel="stylesheet" href="<?php echo TIENDA;?>css/viewlet-breadcrumbs.css" />       
    <link type="text/css" href="<?php echo TIENDA;?>css/blitzer/jquery-ui-1.8.18.custom.css" rel="stylesheet" />
    <link type="text/css" href="<?php echo TIENDA;?>css/ui.selectmenu.css" rel="stylesheet" />                 
    <script type="text/javascript" src="<?php echo TIENDA;?>js/jquery-1.7.1.min.js"></script>
    <script type="text/javascript" src="<?php echo TIENDA;?>js/jquery-ui-1.8.18.custom.min.js"></script>	    
    <script type="text/javascript" src="<?php echo TIENDA;?>js/jquery.orbit-1.2.3.min.js"></script>
    <script type="text/javascript" src="<?php echo TIENDA;?>js/home.js"></script>
    <script type="text/javascript" src="<?php echo TIENDA;?>js/carrito.js"></script>
    <script type="text/javascript" src="<?php echo TIENDA;?>js/ui.selectmenu.js"></script>
 	
	<!--[if IE]>
	    <style type="text/css">
	        .timer { display: none !important; }
	        div.caption { background:transparent; filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000,endColorstr=#99000000);zoom: 1; }
	    </style>
	<![endif]-->    
    
    <?php 
    	if (isset($scripts)) {
    		foreach ($scripts as $script) {
				$script = "<script type='text/javascript' src='". $script. "'></script>";  
    			echo $script."\n";
			}
		}
    ?>  
    
    <title><?php if (isset($title)) echo $title; else echo "Portal"; ?> - Tienda GEX</title>
       
</head>
<body>
<div id="portal-wrapper">
<div id="container">
	
	<div id='dialog-modal' rowspan></div>
	<div id='no-moneda'>Debes seleccionar productos de la misma moneda</div>
    <div id="header-container">
        <header>            
            <h1><a href="<?php echo TIENDA;?>">Kiosco</a></h1>
        </header>  
        <div id='header_tienda'>
        	<a href="https://pagos.grupoexpansion.mx/pagina/mostrar/contacto" target="new">
			    <div id='cont'></div>		
			</a>		
			<a href="<?php echo site_url('carrito.php');?>">
			    <div id='carrito'><?php if(isset($_SESSION['carrito'])) echo count($_SESSION['carrito']); else echo 0;?></div>		
			</a>				
		</div>  
        <section class="header_section"> 
        	<div id="filtro_busqueda_header">       	     	           
	            <form name="searh_form" method="get" action="<?php echo TIENDA; ?>buscador.php" class="form_search">
	            	<input type="text" id="s" name="s" value="" placeholder="Escriba un código de promoción o palabras clave"/>
	                <input type="submit" value="Ir"/>                
	                <select id="filtro_busqueda" name="fb">                	
	                    <?php
						//Sacar la información de la categoría
						$path_criterios_busqueda = "./json/criterios_busqueda.json";
						
						if (file_exists($path_criterios_busqueda)) {
							
							$json = file_get_contents($path_criterios_busqueda);
							$buss = json_decode($json);
							
							foreach ($buss->criterios as $c) {
								echo "<option value='" . $c->valor_criterio ."'>" . $c->nombre_criterio . "</option>\n";
							}
						}                    
	                    ?>
	                </select>
	                
	            </form>  
            </div>                                        
        </section>                                   
    </div>
    <!--Categorías -->           
    <?php include('components/banner_categorias.php'); ?>
    
    <div id="main"><!--div main-->    	
        <section id="contenido"><!--contenido-->

            <div class="contenidos"><!--contenidos tienda-->
                <div class="blank_section">&nbsp;</div>
                <!--Listado de Publicaciones-->
                <?php include('components/menu_vertical.php');?>
                
                <div class="contenido_promos">  <!--Contenido Promociones-->
