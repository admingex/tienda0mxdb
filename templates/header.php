<!DOCTYPE html>
<html lang="es-mx">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
            
    <!--[if IE]><script src="https://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->	
    <link rel="stylesheet" href="<?php echo TIENDA;?>css/style.css" />
    <link rel="stylesheet" href="<?php echo TIENDA;?>css/viewlet-breadcrumbs.css" />
       
    <link type="text/css" href="<?php echo TIENDA;?>css/blitzer/jquery-ui-1.8.18.custom.css" rel="stylesheet" />             
    <link type="text/css" href="<?php echo TIENDA;?>css/demos.css" rel="stylesheet" />
    <script type="text/javascript" src="<?php echo TIENDA;?>js/jquery-1.7.1.min.js"></script>
    <script type="text/javascript" src="<?php echo TIENDA;?>js/jquery-ui-1.8.18.custom.min.js"></script>	    
    <script type="text/javascript" src="<?php echo TIENDA;?>js/jquery.orbit-1.2.3.min.js"></script>
    <script type="text/javascript" src="<?php echo TIENDA;?>js/home.js"></script>
    <script type="text/javascript" src="<?php echo TIENDA;?>js/carrito.js"></script>
 	
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

	
	<div id='dialog-modal' rowspan></div>
	<div id='no-moneda'>Debes seleccionar productos de la misma moneda</div>
    <div id="header-container">
        <header>
            <img src="<?php echo TIENDA;?>images/logo_expansion.gif" alt="logo gex" width="52" height="52"/>            
        </header>        
    </div>
    
    <div id="main"><!--div main-->
        <section id="encabezado_tienda">
            <header id="header_tienda">
                <div class="header_section">                	                    
                    <div><img src="<?php echo TIENDA;?>images/nuevo_logo.png" alt="logo gex"  class='nuevo-logo'/></div>
                    <div class="titulo_logo">Tienda GEx</div>
                    <div class="necesita-ayuda">&nbsp;</div>
                </div>                
                <section class="header_section">
                    <div>
                        <form name="searh_form" method="get" action="<?php echo TIENDA; ?>buscador.php" class="form_search">
                            <label for="search">Buscar en:</label>
                            <select id="filtro_busqueda" name="filtro_busqueda">
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
                                /*foreach($criterios_busqueda as $c) {
									echo "	<option value='" . $c->valor_criterio ."' ". $sel_opcion .">" . $c->nombre_criterio . "</option>\n";									
								}*/
                                ?>
                            </select>
                            <input type="text" id="s" name="s" value="" placeholder="Escriba un código de promoción o palabras clave"/>
                            <input type="submit" value="Ir"/>
                        </form>
                    </div>
                    <div class="blank_section">&nbsp;</div>
                    <div>
                    	<?php                    	
                    		if(isset($_SESSION['logged_in'])){
								if($_SESSION['logged_in']==1){
                    				echo "<a class='mi_cuenta' href='".site_url('cuenta.php')."'>&nbsp;</a>";
									echo "<a class='logout' href='".site_url('logout/')."'>&nbsp;</a>";                    								
                    			}
                    		}
							else{
								echo "<a class='login' href=".site_url('login/').">&nbsp;</a>";								
							}
                    	?>
                    
                    	
                    	<a id='cuenta-carrito' class="carrito" href="<?php echo site_url('carrito.php');?>"><?php if(isset($_SESSION['carrito'])) echo count($_SESSION['carrito']); else echo "0"; ?></a>
                    </div>
                </section>
            </header>
        </section>
        
        <section id="contenido"><!--contenido-->
            <!--Categorías -->
            
            <?php include('components/banner_categorias.php'); ?>
            <div class="contenidos"><!--contenidos tienda-->
                <div class="blank_section">&nbsp;</div>
                <!--Listado de Publicaciones-->
                <?php include('components/menu_vertical.php');?>
                
                <div class="contenido_promos">  <!--Contenido Promociones-->
