<!DOCTYPE html>
<html lang="es-mx">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
            
    <!--[if IE]><script src="https://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->	
    <link rel="stylesheet" href="<?php echo TIENDA;?>css/style.css" />
    <link rel="stylesheet" href="<?php echo TIENDA;?>css/viewlet-breadcrumbs.css" />
       
    <link type="text/css" href="<?php echo TIENDA;?>css/blitzer/jquery-ui-1.8.18.custom.css" rel="stylesheet" />             
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
	<div id='dialog-modal'></div>
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
                        <form name="searh_form" method="get" action="" class="form_search">
                            <label for="search">Buscar en:</label>
                            <select id="filtro_busqueda">
                                <option value="all">Todos los productos</option>
                            </select>
                            <input type="text" id="s" name="s"/>
                            <input type="submit" value="Ir"/>
                        </form>
                    </div>
                    <div class="blank_section">&nbsp;</div>
                    <div>
                    	<?php                    	
                    		if(isset($_SESSION['logged_in'])){
								if($_SESSION['logged_in']==1){
                    				echo "<a class='mi_cuenta' href='".site_url('promociones-especiales')."'>Mi cuenta</a>";
									echo "<a class='logout' href='".site_url('logout/')."'>Cerrar Sesion</a>";                    								
                    			}
                    		}
							else{
								echo "<a class='login' href=".site_url('login/').">Iniciar sesión</a>";								
							}
                    	?>
                    
                    	
                    	<a class="carrito" href="<?php echo site_url('carrito.php');?>">Carrito</a>
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
