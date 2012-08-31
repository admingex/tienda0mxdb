<?php /* Smarty version 2.6.20, created on 2012-08-30 16:37:02
         compiled from login.html.tpl */ ?>
<!DOCTYPE html>
<html lang="es-mx">
<head>
    <meta charset="utf-8" />
	<title><?php echo $this->_tpl_vars['tituloPagina']; ?>
</title>
	<link href='css/style.css' rel='stylesheet' type="text/css" />
	<link href='css/admin.css' rel='stylesheet' type="text/css" />
	<link href='css/tablednd.css' rel='stylesheet' type="text/css" />
	<link href='css/jquery-ui-1.8.23.custom.css' rel='stylesheet' type="text/css" />
    <script type="text/javascript" src="js/jquery-1.7.1.js"></script>
    <script type="text/javascript" src="js/jquery.tablednd.0.7.min.js"></script>
	
	<!--<script type="text/javascript" src="js/jquery-1.8.0.mini.js"></script>-->
	
	<script type="text/javascript" src="js/jquery-ui-1.8.23.custom.min.js"></script>
  	<script type='text/javascript' src='js/checks.js'></script>
	<script type='text/javascript' src='js/funciones.js'></script>
	<script type='text/javascript' src='js/validaciones.js'></script>
	<script type='text/javascript' src='js/dialog.js'></script>
	

</head>
<body>
	
	﻿ <div id="header-container">
        <header>
            <img src="images/logo_expansion.gif" alt="logo gex" width="52" height="52"/>            
        </header>        
    </div>
    
    <div id="main"><!--div main-->
        <section id="descripcion-proceso">
		<div class="titulo-proceso-img">&nbsp;
		</div>			

<div class="titulo-proceso">
			<?php echo $this->_tpl_vars['lugarMenu']; ?>

		</div>
		<br>
		<!--<p class="label_izq"></p>-->
		</section>
		<div id="pleca-punteada"></div>
		<section class="contenedor">	
		<div class="contenedor-gris">
	
<form name="login">
	<table align="center">
		
		<tr>
			<td class="label">
				Usuario:
			</td>
			<td><input type="text" name="email" id="email" value="" class="text"  /></td>
		</tr>
		<tr>
			<td class="label">
				Contraseña:
			</td>
			<td><input type="password" name="pass" id="pass" class="text"/></td>
		</tr>
		
	</table>
	<center><input type="submit" name="login" id="login" value="Iniciar session " /></center>
	
</form>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.html.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</body>
</html>