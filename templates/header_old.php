<!DOCTYPE html>
<html lang="es-mx">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    
    <meta http-equiv='Cache-Control' content='no-cache'/>
    <meta http-equiv='Pragma' content='no-cache'/>
    <meta http-equiv='Expires' content='Sat, 26 Jul 1997 05:00:00 GMT' />
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    
    
    <!--meta name="description" content=""/>
    <meta name="author" content=""/>
    <meta name="viewport" content="width=device-width,initial-scale=1"/-->
    
    <link rel="stylesheet" href="<?php echo TIENDA;?>css/style.css" />
    <link type="text/css" href="<?php echo TIENDA;?>css/blitzer/jquery-ui-1.8.18.custom.css" rel="stylesheet" />
    <link type="text/css" href="<?php echo TIENDA;?>css/validacion.css" rel="stylesheet" /> 
    
    
    <script type="text/javascript" src="<?php echo TIENDA;?>js/jquery-1.7.1.min.js"></script>
    <script type="text/javascript" src="<?php echo TIENDA;?>js/jquery-ui-1.8.18.custom.min.js"></script>

    <link rel="stylesheet" href="<?php echo TIENDA;?>css/orbit-1.2.3.css" />

    <!--link rel="stylesheet" href="css/banner_categories.css" /-->
    <link rel="stylesheet" href="<?php echo TIENDA;?>css/demo-style.css" />         
    <script type="text/javascript" src="<?php echo TIENDA;?>js/jquery.orbit-1.2.3.min.js"></script>
    
    <script type="text/javascript" src="<?php echo TIENDA;?>js/home.js"></script>
 
        
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
    <div id="header-container">
        <header>
            <img src="<?php echo TIENDA;?>images/logo_expansion.gif" alt="logo gex" width="52" height="52"/>            
        </header>        
    </div>
    
    <div id="main"><!--div main-->
        <section id="encabezado_tienda">
            <header id="header_tienda">
                <div class="header_section">
                    <div style="float:left;"><img src="<?php echo TIENDA;?>images/logo_expansion2.gif" alt="logo gex" width="150" height="52"/></div>
                    <div style="float:left;"><h1 class="titulo_logo">GEX-Store</h1></div>
                    <div class="necesita-ayuda img-ayuda" style="float: right;">&nbsp;</div>
                </div>
                <div class="blank_section">&nbsp;</div>
                <section class="header_section">
                    <div style="float:left; padding-left: 100px">
                        <form name="searh_form" method="get" action="">
                            <label for="search">Buscar en:</label>
                            <select id="filtro_busqueda">
                                <option value="all">Todos los productos</option>
                            </select>
                            <input type="text" id="s" name="s"/>
                            <input type="submit" value="Ir"/>
                        </form>
                    </div>
                    <div style="float:left;">
                    	<a href="<?php echo site_url('carrito.php');?>">Carrito</a>
                    	<?php                    	
                    		if(isset($_SESSION['logged_in'])){
								if($_SESSION['logged_in']==1){
                    				echo "<a href=".site_url('promociones-especiales').">Mi cuenta</a>";
									echo "&nbsp;<a href=".site_url('logout').">Cerrar Sesion</a>";                    								
                    			}
                    		}
							else{
								echo "<a href=".site_url('login/').">Iniciar sesión</a>";								
							}
                    	?>                        
                                                
                    </div>
                </section>
            </header>
        </section>
        
        <section id="contenido">    <!--contenido-->
            <!--Categorías -->
            
            <?php include('components/banner_categorias.php'); ?>
            <div class="contenidos">    <!--contenidos-->
                <div class="blank_section">&nbsp;</div>
                <!--Publicaciones-->
                <?php include('components/menu_vertical.php');?>
                
                <div class="contenido_promos">  <!--contenido promos-->
