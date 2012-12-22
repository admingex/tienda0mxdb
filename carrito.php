<?php 	
	
	include('./core/util_helper.php');

	//requiredincludes
    require('./config/settings.php');
			
    //header (y/o menús)
    $menues = TRUE;
	
	//incluir archivos js
	$scripts = array();		
	$scripts [] = TIENDA."js/carrito.js";
	
	//información para la vista
	$title = "Publicaciones por Categoría";
	$subtitle = "Publicaciones por Catgoría";
	
	$data = array();
	$data["scripts"] = $scripts;
	$data["title"] = $title;
	$data["subtitle"] = $subtitle;		
	/*
	echo "<pre>";
		print_r($_POST);
		print_r($_POST);
	echo "<pre>";
	*/
	
	
	if (($_POST)) {
		if (isset($_POST['id_sitio']) && isset($_POST['id_canal']) && isset($_POST['id_promocion']) && $_POST) {
			if(is_numeric($_POST['id_sitio']) && is_numeric($_POST['id_canal']) && is_numeric($_POST['id_promocion'])){
				$items = 0;
				$agregar = TRUE;
				if (isset($_SESSION['carrito'])) {
					if (count($_SESSION['carrito']) > 0) {
						$items = max(array_keys($_SESSION['carrito'])) + 1;
						foreach ($_SESSION['carrito'] as $i => $j) {
							if ($j['id_sitio'] == $_POST['id_sitio'] && $j['id_canal'] == $_POST['id_canal'] && $j['id_promocion'] == $_POST['id_promocion']) {
								$agregar = FALSE;							
								/*se quita la parte de agregar cantidad a los artículos*/
								//echo "agragar cantidad al item: ".$i;						
								//$_SESSION['carrito'][$i]['cantidad']=$_SESSION['carrito'][$i]['cantidad']+1;								
								
								$datocar= valida_data_post();
								
								$_SESSION['carrito'][$i] = array( 'id_sitio'=>$_POST['id_sitio'], 
			 									   		'id_canal'=> $_POST['id_canal'],
												   		'id_promocion'=>$_POST['id_promocion'],
														'cantidad'=>$datocar['cantidad'],
														'imagenVc'=>$datocar['imagen'],
														'descripcion'=>$datocar['descripcion'],
														'precio'=>$datocar['precio'],
														'moneda'=>$datocar['moneda'],
														'iva'=>$datocar['iva']
														);
								
								// Guarda el id del ultimo elemento al que se le agrego cantidad
								$_SESSION['ult_elem'] = $i;
							}
							/*VALIDACION PARA LA MISMA MONEDA*/
							if ($j['moneda']!= $_POST['moneda']) {
								$agregar = FALSE;
								$_SESSION['ult_elem'] = $i;
								echo "<script language='javascript' type='text/javascript'>
										//alert('No cupede comprar elementos con diferentes tipo de cambio');
										$('#dialog-modal').dialog( 'close' );
										$('#no-moneda').dialog( 'open' );
									</script>";
							}
						}
					}
					
					if (count($_SESSION['carrito']) >= 20) {
						$agregar = FALSE;
					}
				}
				
				if ($agregar == TRUE) {					
											
					$datocar= valida_data_post();
								
					$_SESSION['carrito'][$items] = array( 'id_sitio'=>$_POST['id_sitio'], 
 									   		'id_canal'=> $_POST['id_canal'],
									   		'id_promocion'=>$_POST['id_promocion'],
											'cantidad'=>$datocar['cantidad'],
											'imagenVc'=>$datocar['imagen'],
											'descripcion'=>$datocar['descripcion'],
											'precio'=>$datocar['precio'],
											'moneda'=>$datocar['moneda'],
											'iva'=>$datocar['iva']
											);					
				}
			}	
			
		} 
		else {
			//$_SESSION['ult_elem'] = NULL;
		}
	
			
		
	} 
	
	function valida_data_post(){
		/*
		echo "<pre>";
			print_r($_POST);
		echo "</pre>";
		*/
		if(array_key_exists('cantidad', $_POST) && is_numeric($_POST['cantidad'])){
			$data['cantidad']=$_POST['cantidad'];
		}
		else{
			$data['cantidad']='';
		}
		
		if(array_key_exists('imagen', $_POST) && preg_match('/^[A-Z0-9.&]{1,30}$/i', $_POST['imagen'])){
			$data['imagen']=$_POST['imagen'];
		}
		else{
			$data['imagen']='';
		}
		
		if(array_key_exists('descripcion', $_POST) && preg_match('/^[A-ZáéíóúÁÉÍÓÚÑñ .-|¿?+]{1,200}$/i', $_POST['descripcion'])){
			$data['descripcion'] = 	htmlspecialchars($_POST['descripcion']);
		}
		else{
			$data['descripcion'] = '';
		}
		
		if( array_key_exists('precio', $_POST) && preg_match('/^[0-9.]{1,10}$/i', $_POST['precio'])){
			$data['precio'] = $_POST['precio'];
		}
		else{
			$data['precio'] = '';
		}
		
		if(array_key_exists('moneda', $_POST) && preg_match('/^[A-Z]{1,5}$/i', $_POST['moneda'])){
			$data['moneda'] = $_POST['moneda'];
		}
		else{
			$data['moneda'] = '';
		}						
		
		if(array_key_exists('iva', $_POST)){
			$data['iva'] = $_POST['iva'];
		}								
		else{
			$data['iva'] = '';
		}	

		return $data;																																																	 		
	}
	
	## eliminar items del carrito
	if (isset($_GET['eliminar_item']) && is_numeric($_GET['eliminar_item'])) {
		unset($_SESSION['carrito'][($_GET['eliminar_item'])]);			
	}
		
	if (array_key_exists('ajax', $_POST)) {
		if($_POST['ajax']==1)
			include('./views/detalle_carrito.php');
	} else {
		cargar_vista('detalle_carrito', $data);
	}
	
	exit;
	
		
?>
