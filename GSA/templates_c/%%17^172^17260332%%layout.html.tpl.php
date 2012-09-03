<?php /* Smarty version 2.6.20, created on 2012-08-23 13:21:02
         compiled from layout.html.tpl */ ?>
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
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.html.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => $this->_tpl_vars['contenido'], 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.html.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</body>
</html>