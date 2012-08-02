<?php 	
	
	include('./core/util_helper.php');

	//requiredincludes
    require('./config/settings.php');
			
    //header (y/o menús)
    $menues = TRUE;
	
	//incluir archivos js
	$scripts = array();	
	$scripts [] = TIENDA."js/login.js";
	$scripts [] = TIENDA."js/registro.js";
	
	//información para la vista
	$title = "Publicaciones por Catgoría";
	$subtitle = "Publicaciones por Catgoría";
	
	$data = array();
	$data["scripts"] = $scripts;
	$data["title"] = $title;
	$data["subtitle"] = $subtitle;		
	
	if($_GET){	
		if(isset($_GET['id_sitio']) && isset($_GET['id_canal']) && isset($_GET['id_promocion'])){
			$items=1;
			$agregar=TRUE;
			if(isset($_SESSION['carrito'])){
				if(count($_SESSION['carrito'])>0){
					$items=max(array_keys($_SESSION['carrito']))+1;
					foreach($_SESSION['carrito'] as $i=>$j){
						if($j['id_sitio']==$_GET['id_sitio'] && $j['id_canal']==$_GET['id_canal'] && $j['id_promocion']==$_GET['id_promocion']){
							$agregar=FALSE;
							//echo "agragar cantidad al item: ".$i;						
							$_SESSION['carrito'][$i]['cantidad']=$_SESSION['carrito'][$i]['cantidad']+1;
						
							// Guarda el id del ultimo elemento al que se le agrego cantidad
							$_SESSION['ult_elem']=$i;						
						}
					}
				}	
				if(count($_SESSION['carrito']) >= 20){
					$agregar=FALSE;					
				}								
			}						
			if($agregar==TRUE){
				// Guarda el id del ultimo elemento agregado
				$_SESSION['ult_elem']=$items;				
			
				$_SESSION['carrito'][$items]=array( 'id_sitio'=>$_GET['id_sitio'], 
		 									   		'id_canal'=> $_GET['id_canal'],
											   		'id_promocion'=>$_GET['id_promocion'],
													'cantidad'=>1,
													'imagenVc'=>'images/img1.jpg',
													'descripcion'=>'descripcion de la oferta',
													'precio'=>50
													);	
			}																		   
		}
		else{
			$_SESSION['ult_elem']=0;	
		}
	
		## eliminar items del carrito
		if(isset($_GET['eliminar_item'])){	
			unset($_SESSION['carrito'][($_GET['eliminar_item'])]);
		}			
	}

	else{	
		$_SESSION['ult_elem']=0;	
	}
	
	cargar_vista('detalle_carrito', $data);
	exit;
?>
