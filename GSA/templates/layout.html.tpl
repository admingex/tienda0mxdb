<!DOCTYPE html>
<html lang="es-mx">
<head>
    <meta charset="utf-8" />
	<title>{$tituloPagina}</title>
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
{include file="header.html.tpl"}
{include file=$contenido}
{include file="footer.html.tpl"}
</body>
</html>