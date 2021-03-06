<?php 
//el modelo del login	
require_once('./models/login_registro_model.php');
require_once('./models/administrador_usuario_model.php');
	
class Administrador_Usuario {
	
	var $reg_errores = array();
	
	public static $FORMA_PAGO = array(
		1 =>	"Prosa", 
		2 =>	"American Express", 
		3 =>	"Deposito Bancario",
		4 =>	"Otro"
	);
	
	const CODIGO_MEXICO = "MX";		//constante para verificar el código del país en el efecto del JS.
		
	function __construct()
    {
        $this->login_registro_model = new Login_Registro_Model();	
		$this->administrador_usuario_model = new Administrador_Usuario_Model();					

		
		// incluye el modelo de las direcciones de facturacion		
		//$this->load->model('direccion_facturacion_model', 'direccion_facturacion_model', true);				
		//$this->load->model('direccion_envio_model', 'direccion_envio_model', true);
		//$this->load->model('forma_pago_model', 'forma_pago_model', true);
		//$this->load->model('login_registro_model', 'login_registro_model', true);
		//$this->load->model('reporte_model', 'reporte_model', true);
		
		//$this->api = new Api();
    }
	
	### consulta si el mail ya esta registrado
	public function consulta_mail($mail){		
		$res=$this->login_registro_model->verifica_registro_email($mail);		
		$value['mail']=count($res);
		
		echo json_encode($value);			
	}
	
	
	
	### obtener los datos del cliente por id
	public function cliente_id($id_cliente = ""){			
		$cliente = $this->login_registro_model->obtener_cliente_id($id_cliente);
		return $cliente;		
						
	}
	
	###actualizar la informacion del cliente, los datos se reciben mediante POST 
	public function actualizar_cliente($id_cliente = ""){
							 
			// se valida que la informacion sea correcta			
			$cliente_info =	$this->valida_datos_update();
			$cliente_info['id_clienteIn'] = $id_cliente;
				
			// si existe algun error se vuelve a solicitar la onformacion	
			if(!empty($this->login_errores)){				
					$data['error'] = 1;					
					$data['errores'] = $this->login_errores;					
			// si no hay errores se procede con la actualizacion						
			} else{						
				if($this->login_registro_model->actualizar_cliente($cliente_info)){
					$data['error'] = 0;							
				} else{
					$data['error'] = 1;
				}				
			}				
		
		// se regresa la informacion en json si ocurrio algun error se regresa 1 en caso contrario se regresa 0		
		echo json_encode($data);
				
	}
		
	// se obtiene un listado JSON con las Razones Sociales que tenga guardadas el cliente
	public function listar_razon_social($id_cliente = ""){
				
		$data['rs'] = $this->administrador_usuario_model->listar_razon_social($id_cliente);						
		echo json_encode($data);
	}
	
	// se obtiene un listado JSON con las Direcciones de Facturacion que tenga guardadas el cliente
	public function listar_direccion_facturacion($id_cliente = ""){
				
		$data['direccion_facturacion']=$this->administrador_usuario_model->listar_direcciones($id_cliente);							
		echo json_encode($data);
	}
	
	// se obtiene un listado JSON con las Direcciones de Envio que tenga guardadas el cliente
	public function listar_direccion_envio($id_cliente = ""){
					
		$data['direccion_envio'] = $this->administrador_usuario_model->listar_direcciones_envio($id_cliente);							
		echo json_encode($data);
	}
	
	// se obtiene un listado JSON con las Razones Sociales que tenga guardadas el cliente
	public function listar_tarjetas($id_cliente = ""){
		
		$data['tarjetas'] = $this->administrador_usuario_model->listar_tarjetas($id_cliente);							
		echo json_encode($data);
	}
	
	// funcion para eliminar una razon social por id, el label id es para comprobar que se elimino correctamente en el AJAX
	public function eliminar_rs($id_rs = ''){		
		if($this->administrador_usuario_model->eliminar_rs($id_rs)){
			echo "<label id='eliminar_correcto'>1</label>";	
		}				
	}
	
	// funcion para eliminar una direccion por id, el label id es para comprobar que se elimino correctamente en el AJAX
	public function eliminar_direccion($id_dir, $id_cliente){				
		if($this->administrador_usuario_model->eliminar_direccion($id_cliente, $id_dir)){
			echo "<label id='eliminar_direccion'>1</label>";	
		}				
	}
	
	// Funcion en la cual se edita la informacion del usuario.
	public function editar_rs($consecutivo = 0){
																	
		if ($consecutivo) {			
			// obtenemos la informacion de la razon social a editar							
			$datos_direccion = $this->administrador_usuario_model->obtener_rs($consecutivo);
																
			// si se enviaron los datos del formulario  seguimos con el proceso en caso contrario solo desplegamos la informacion del ciente q se va a a actualizar																					
			if($_POST){							
					
				$form_values = array();	//alojará los datos previos a la inserción	
				$form_values = $this->get_datos_rs(); // se obtienen los datos validados o los errores por mostrar					
				
				// si no  hay errores en la informacion continuamos en caso contrario se muestran los errores en la vista		
				if (empty($this->reg_errores)) {										
					
					//asignamos el id de razon social		
					$form_values['direccion']['id_razonSocialIn'] = $consecutivo;	
					//guardamos los datos de direccion																							
					$direccion = $form_values['direccion'];
					
											
					// se actualiza la informacion						
					if($this->administrador_usuario_model->actualizar_rs($consecutivo, $direccion)){
						if($_POST['chk_default'] == 1 || $consecutivo == 0) {
							$this->administrador_usuario_model->establecer_predeterminado_rs($_POST['id_cliente'], $consecutivo);						
						}						
						echo "<label id='update_correcto'>1</label>";
					}	
					else{
						
						include('./views/cuenta_usuario/editar_rs.php');		
					}
											
				}
				// caso contraio se muestran los errores en la vista 
				else{												
					$reg_errores = $this->reg_errores;							
					include('./views/cuenta_usuario/editar_rs.php');								
				}	
																
			}	// caso contrario solo se muestra la informacion por actualizar
			
			else{				
				include('./views/cuenta_usuario/editar_rs.php');				
			}								
		}		 
								
	}
	
	public function editar_direccion_facturacion($id_dir, $id_cliente){
			
		if(is_numeric($id_dir) && is_numeric($id_cliente)){
			//obtenemos los datos de la direccion
			$datos_direccion = $this->administrador_usuario_model->obtener_direccion($id_cliente, $id_dir);									
			
			// obtenemos la lista de paise de think
			$lista_paises = $this->administrador_usuario_model->listar_paises_think();			
																							
			if($_POST){									
				
				$form_values = array();	//alojará los datos previos a la inserción	
				$form_values = $this->get_datos_direccion();
				
				if (empty($this->reg_errores)) {					
					
					$form_values['direccion']['id_ConsecutivoSi'] = $id_dir;
					$direccion = $form_values['direccion'];
					
					
																																							
					if($this->administrador_usuario_model->actualizar_direccion($id_cliente,$id_dir, $direccion)){
						
						if ($_POST['chk_default'] == 1) {
							$this->administrador_usuario_model->establecer_predeterminado_dir($id_cliente, $id_dir);								
						}
						 
						echo "<label id='update_correcto'>1</label>";
					}					 	
																																		
				}
				else{								
					$reg_errores= $this->reg_errores;				
					include('./views/cuenta_usuario/editar_direccion_facturacion.php');
				}	
				 
																					
			}	
			else{
		 		include('./views/cuenta_usuario/editar_direccion_facturacion.php');					
			}	
		}			 												 	
	}
	
	// Funcio para editar direccion envio
	public function editar_dir_envio($consecutivo, $id_cliente){		
		
		//recuperar la información de la dirección
		$direccion = $this->administrador_usuario_model->detalle_direccion($consecutivo, $id_cliente);				
									
		//catálogo de países de think
		$lista_paises_think = $this->administrador_usuario_model->listar_paises_think();
					
		//muestra lo de sepomex
		//catálogo de estados
		$lista_estados_sepomex = $this-> consulta_estados();	
				
		//ciudades				
		$lista_ciudades_sepomex = $this->consulta_ciudades($direccion[0]['estado']);				
				
		//colonias		
		$lista_colonias_sepomex = $this->consulta_colonias($direccion[0]['estado'], $direccion[0]['ciudad']);
		/*
		echo "<pre>";
			print_r($lista_colonias_sepomex);
		echo "</pre>";		 	
		*/
		//Se intentará actualizar la información
		if ($_POST) {
								
			//array para la nueva información
			$nueva_info = array();
			//trae datos del formulario para actualizar
			$nueva_info = $this->get_datos_direccion_envio();
			
			if (empty($this->reg_errores)) {	//si no hubo errores
				
				
				$nueva_info['direccion']['id_consecutivoSi'] = $consecutivo;
			
				if (isset($nueva_info['predeterminar'])) {
					$this->administrador_usuario_model->quitar_predeterminado($id_cliente);
				} else {	//si no es predeterminado se quda sólo como "activa"habilitado"
					$nueva_info['direccion']['id_estatusSi'] = 1;
				}
				
				
				//actualizar la información en BD
				if($this->administrador_usuario_model->actualizar_direccion_env($consecutivo, $id_cliente, $nueva_info['direccion'])){
						echo "<label id='update_correcto'>1</label>";
				}
				 
																		 												
			} else {	//ERRORES FORMULARIO
							
				$reg_errores = $this->reg_errores;
				include('./views/cuenta_usuario/editar_direccion_envio.php');
			}	//ERRORES FORMULARIO
			 
		} else {	//If POST					
			include('./views/cuenta_usuario/editar_direccion_envio.php');
		}		
		
	}
	
	## obtener las compras que ha realizado el cliente
	public function compras_cliente($id_cliente){
				
		//$data['id_cliente'] = $id_cliente; 			 
		## obtener las compras pagadas del cliente
		$compras_cliente = $this->administrador_usuario_model->obtener_compras_cliente($id_cliente);
		/*
		echo "<pre>";
			print_r($compras_cliente);
		echo "</pre>";
		*/		
		if(count($compras_cliente)>0){
			$data['compras'] = array();
				
			$todas_compras = $compras_cliente;
				
			foreach($todas_compras as $ind => $compra){
							 	 
				$id_compra = $compra['id_compraIn'];				
				$data['compras'][$ind]['compra'] = $compra;
				
				//se obtiene el medio y la fecha de pago
				$forma_pago = $this->administrador_usuario_model->obtener_medio_pago($id_compra, $id_cliente);
				
				if(count($forma_pago)>0){
					$data['compras'][$ind]['medio_pago'] = self::$FORMA_PAGO[($forma_pago[0]['id_tipoPagoSi'])];	
					$data['compras'][$ind]['fecha_compra'] = 	$forma_pago[0]['fecha_registroTs'];
				}
				
				else{
					$data['compras'][$ind]['medio_pago'] = "no existe";
					$data['compras'][$ind]['fecha_pago'] = "no existe";					
				}
				
				//se obtiene el codigo de autorizacion de la transaccion
				$ca = $this->administrador_usuario_model->obtener_codigo_autorizacion($id_compra, $id_cliente);		
				
				if(count($ca) > 0){
					//obtenemos la ultima respuesta del banco ultimo
					$ca_last = end($ca);											
					$data['compras'][$ind]['respuesta_banco'] = $ca_last['respuesta_bancoVc'];
				}			
				else{
					$data['compras'][$ind]['respuesta_banco'] = "no hay respuesta";
				}
				 
				
				//se obtiene el id de promocion de la compra
				$id_promo = $this->administrador_usuario_model->obtener_promo_compra($id_compra, $id_cliente);
				
				// se obtiene el detalle de la promocion
				$promocion = $this->administrador_usuario_model->obtener_detalle_promo($id_promo);					
				if(count($promocion)>0){
					$data['compras'][$ind]['promocion'] = end($promocion);
				}
				 
				//se obtiene el total de articulos en la promocion y el total que se pago por ellos 				
				$articulos = $this->administrador_usuario_model->obtener_articulos($id_promo);							 
				$monto = 0;				
				
				// Se obtienen los articulos de cada promocion y el total pagado por ellos 							
				foreach( $articulos as $i => $articulo){
					
					if($articulo['issue_id']){												
						$issue = end($this->administrador_usuario_model->obtener_issue($articulo['issue_id']));						
						$articulos[$i]['tipo_productoVc']= $issue['descripcionVc'];
					}
					else{
						$articulos[$i]['tipo_productoVc'] = $articulo['tipo_productoVc'];
					}
					
					$monto+= $articulo['tarifaDc'];
				}
				
				$data['compras'][$ind]['articulos'] = $articulos;				
				$data['compras'][$ind]['monto'] = $monto;	
			 	
			 	$compras = $data['compras'];	 											
			}
			
		}
		else{
			$compras = NULL;
		}
		
		include('./views/cuenta_usuario/reporte_compras_usuario.php');
		
	}	
	
	## obtener el detalle de cada una de las compras que tiene el cliente
	public function detalle_compra($id_compra = "", $id_cliente = ""){
		
		$data['compra']['id_compra'] = $id_compra; 
		$data['compra']['direccion_amex'] = NULL;
		$data['compra']['codigo_autorizacion'] = NULL;
		
		//se obtiene el medio y la fecha de pago
		$forma_pago = end($this->administrador_usuario_model->obtener_medio_pago($id_compra, $id_cliente));
		
		if( count($forma_pago) > 0){
		 	
			//si el pago es con prosa se obtiene el detalle de la tarjeta
			if(($forma_pago['id_tipoPagoSi'] == 1) || ($forma_pago['id_tipoPagoSi'] == 2)){				
							
				$tc = end($this->administrador_usuario_model->obtener_tc($id_cliente, $forma_pago['id_tipoPagoSi']));												
				$data['compra']['medio_pago'] = $tc['descripcionVc']." terminación ".$tc['terminacion_tarjetaVc'];				
				
				//se obtiene el codigo de autorizacion si es que existe
				$ca = end($this->administrador_usuario_model->obtener_codigo_autorizacion($id_compra, $id_cliente));				
				
				if(count($ca) > 0 ){									
					if($ca['codigo_autorizacionVc'] > 0){
						$data['compra']['codigo_autorizacion'] = "<span class='info-blanco'>codigo de autorización:</span> ".$ca['codigo_autorizacionVc'];
					}
					else{
						$data['compra']['codigo_autorizacion'] = "<span class='info-blanco'>codigo de autorización:</span> ".$ca['codigo_autorizacionVc'] ."<br />". $ca['respuesta_bancoVc'];
					}
				}	
				else{
					$data['compra']['codigo_autorizacion'] = "<span class='info-blanco'>(No se realizo el cobro)</span>";	
				}				 				 					
			}
			else{				
				$data['compra']['medio_pago'] = self::$FORMA_PAGO[($forma_pago['id_tipoPagoSi'])];					
			}
			
			//si el pago es con amex se obtiene el detalle de la tarjeta y la direccion de amex
			if($forma_pago['id_tipoPagoSi'] == 2){				
				$data['compra']['direccion_amex'] = "direccion ammex s";	
			}
									
			$data['compra']['fecha_compra'] = 	$forma_pago['fecha_registroTs'];		 	 				
		}
		else{
			$data['compra']['medio_pago'] = NULL;
			$data['compra']['fecha_pago'] = NULL;				
		}

		
		//se obtiene la direccion de envio si es que existe			
		$rel_envio = $this->administrador_usuario_model->obtener_rel_envio($id_compra, $id_cliente);
		if(count($rel_envio) > 0){
			$rel_envio = end($rel_envio);
			$dir_envio = $this->administrador_usuario_model->obtener_direccion($id_cliente, $rel_envio['id_consecutivoSi']);			 
			if(count($dir_envio) > 0){
				$dir_envio= end($dir_envio);
				$data['compra']['dir_envio'] = 	$dir_envio['calle']." ".
												$dir_envio['num_ext']." ".
												$dir_envio['num_int']."<br />".
												$dir_envio['cp']."<br />".
												$dir_envio['colonia']."<br />".
												$dir_envio['ciudad']."<br />".
												$dir_envio['estado'];	
			}	
			else{
				$data['compra']['dir_envio']= "No requiere";
			}
			
		}
		else{
			$data['compra']['dir_envio']= "No requiere";
		}
		
		
		
		//se obtiene la direccion de facturacion y Razon Social
		$facturacion = $this->administrador_usuario_model->obtener_rel_facturacion($id_compra, $id_cliente);		
		
		if(count($facturacion) > 0){
			$facturacion = end($facturacion);								
			$consecutivo = $facturacion['id_consecutivoSi'];
			$id_rs = $facturacion['id_razonSocialIn'];
			
			$dir_facturacion = end($this->administrador_usuario_model->obtener_direccion($id_cliente, $consecutivo));
							
			$data['compra']['dir_facturacion']  =  	$dir_facturacion['calle']." ".
													$dir_facturacion['num_ext']." ".
													$dir_facturacion['num_int']."<br />".
													$dir_facturacion['cp']."<br />".
													$dir_facturacion['colonia']."<br />".
													$dir_facturacion['ciudad']."<br />".
													$dir_facturacion['estado'];
			
			$rs = end($this->administrador_usuario_model->obtener_rs($id_rs));
			$data['compra']['razon_social'] = $rs['company']."<br />".$rs['tax_id_number'];																
		}						
		else{
			$data['compra']['dir_facturacion'] = NULL;
			$data['compra']['razon_social'] = NULL;
		}
		
		
		//se obtiene el id de promocion de la compra
		$id_promo = $this->administrador_usuario_model->obtener_promo_compra($id_compra, $id_cliente);
		
		// se obtiene el detalle de la promocion
		$promocion = $this->administrador_usuario_model->obtener_detalle_promo($id_promo);	
		if(count($promocion) >0){
			$data['compra']['promocion'] = end($promocion);
		}
					
		
		//se obtiene el total de articulos en la promocion y el total que se pago por ellos 
		$articulos = $this->administrador_usuario_model->obtener_articulos($id_promo);								 
		$monto = 0;		
		
		// Se obtienen los articulos de cada promocion y el total pagado por ellos 							
		foreach( $articulos as $i => $articulo){
			if($articulo['issue_id']){												
				$issue = end($this->administrador_usuario_model->obtener_issue($articulo['issue_id']));						
				$articulos[$i]['tipo_productoVc']= $issue['descripcionVc'];
			}
			else{
				$articulos[$i]['tipo_productoVc'] = $articulo['tipo_productoVc'];
			}											
			$monto+= $articulo['tarifaDc'];
		}
		$data['compra']['articulos'] = $articulos;
		$data['compra']['monto'] = $monto;
																	
		$compra = $data['compra'];
		include('./views/cuenta_usuario/detalle_compra.php');
	}
	
	
	//Funcion para eliminar una tarjeta
	public function eliminar_tc($id_tc, $id_cliente){
		####TO DO CCTC												
		//if ($this->eliminar_tarjeta_interfase_CCTC($id_cliente, $id_tc)) {					
			if($this->administrador_usuario_model->eliminar_tarjeta($id_cliente, $id_tc)){
				echo "<label id='eliminar_tarjeta'>1</label>";
			}
		//}	
	}
		
	// Funcion para actualizar los datops de TC
	public function editar_tc($id_tc = "", $id_tipo = "", $id_cliente = ""){
		//echo "tc: ".$id_tc." tipo: ".$id_tipo." cliente".$id_cliente."<br />";
		//el detalle de la tarjeta en BD antes de actualizar			
		$detalle_tarjeta = array();	
		
		$tarjeta_tc = end($this->administrador_usuario_model->detalle_tarjeta($id_tc, $id_cliente));
			
		//$data['tarjeta_tc'] = $detalle_tarjeta; 
		//$data['id_cliente'] = $id_cliente;
		//$data['id_tc'] = $id_tc;					
			
		if($_POST){
			//echo "tcPOST: ".$id_tc." tipoPOST: ".$id_tipo." clientePOST".$id_cliente."<br />";
			/*
			echo $id_tc."--".$id_tipo."--".$id_cliente;
			echo "<pre>";			
				print_r($_POST);
			echo "</pre>";
			*/
			
			
			//detalle de la nueva info de la tarjeta 					
			$nueva_info = array();
			$nueva_info = $this->get_datos_tarjeta();	//datos generales
														
			//errores
			$data['reg_errores'] = $this->reg_errores;			
			
			if (empty($data['reg_errores'])) {	//si no hubo errores
				
				//preparar la petición al WS, campos comunes
				$nueva_info['tc']['id_clienteIn'] = $id_cliente;
				$nueva_info['tc']['id_TCSi'] = $id_tc;
				$nueva_info['tc']['terminacion_tarjetaVc'] = $tarjeta_tc['terminacion_tarjetaVc'];
				$nueva_info['tc']['descripcionVc'] = $tarjeta_tc['descripcionVc'];
				$nueva_info['tc']['id_tipo_tarjetaSi'] = $tarjeta_tc['id_tipo_tarjetaSi'];
				
				/*
				if ($detalle_tarjeta->id_tipo_tarjetaSi == 1 ) {	//es AMEX y hay información
					//var_dump($detalle_amex);
					
					$nueva_info['amex']['id_clienteIn'] = $id_cliente;
					$nueva_info['amex']['id_TCSi'] = $detalle_tarjeta->id_TCSi;
					$nueva_info['amex']['nombre_titularVc'] = $nueva_info['tc']['nombre_titularVc'];
					$nueva_info['amex']['apellidoP_titularVc'] = $nueva_info['tc']['apellidoP_titularVc'];
					$nueva_info['amex']['apellidoM_titularVc'] = $nueva_info['tc']['apellidoM_titularVc'];
					//var_dump($detalle_amex);	//$detalle_amex trae al menos: consecutivo_cmsSi y id_clienteIn
					
					$nueva_info['amex']['pais'] = isset($detalle_amex->pais) ? $detalle_amex->pais : NULL;
					$nueva_info['amex']['codigo_postal'] = isset($detalle_amex->codigo_postal) ? $detalle_amex->codigo_postal : NULL;
					$nueva_info['amex']['calle'] = isset($detalle_amex->calle) ? $detalle_amex->calle : NULL;
					$nueva_info['amex']['ciudad'] = isset($detalle_amex->ciudad) ? $detalle_amex->ciudad : NULL;
					$nueva_info['amex']['estado'] = isset($detalle_amex->estado) ? $detalle_amex->estado : NULL;
					$nueva_info['amex']['mail'] = isset($detalle_amex->mail) ? $detalle_amex->mail : $this->session->userdata('email');
					$nueva_info['amex']['telefono'] = isset($detalle_amex->telefono) ? $detalle_amex->telefono : NULL;
				} else {
				 */ 
					$nueva_info['amex'] = NULL;
				//}
				/*
				echo "<br />";
				echo "<pre>";
					print_r($nueva_info);
				echo "</pre>";
				 */ 		
				//actualizar en CCTC, si el consecutivo es distinto de 0				
				//if ($this->editar_tarjeta_CCTC($nueva_info['tc'], $nueva_info['amex'])) {
				
				///if ($this->editar_tarjeta_interfase_CCTC($nueva_info['tc'], $nueva_info['amex'])) {
					//actualizar predeterminado
					if (isset($nueva_info['predeterminar'])) {
						$this->administrador_usuario_model->quitar_predeterminado_tc($id_cliente);
					} else {
						$nueva_info['tc']['id_estatusSi'] = 1;
					}
					
					//ahora para registrar cambios localmente, siempre se manda la info de $nueva_info['tc']					
					if($this->administrador_usuario_model->actualiza_tarjeta($id_tc, $id_cliente, $nueva_info['tc'])){
						echo "<label id='actualizar_tarjeta'>1</label>";
					}																			
				///} 				
							
			} else {	//sí hubo errores				
				$reg_errores = $this->reg_errores;
				include('./views/cuenta_usuario/editar_tc.php');  					
			}					
		}
		else{									
				
			/*
			echo "<pre>";			
				print_r($detalle_tarjeta);
			echo "</pre>";
			*/
			  			
			/*
			 * para amex revisar
			if ($detalle_tarjeta->id_tipo_tarjetaSi == 1 ) 
				//$detalle_amex = $this->detalle_tarjeta_CCTC($id_cliente, $consecutivo);
				$detalle_amex = $this->obtener_detalle_interfase_CCTC($id_cliente, $id_tc);
			 */
			include('./views/cuenta_usuario/editar_tc.php');  																		
		}
	}	
	
	
	
	
	
	
	
	
	
	
	
	
	
	// valida que la informacion del cliente se acorrecta
	public function valida_datos_update(){
		$datos = array();
		//revisamos que venga encriptada la informcaion del usuario (mail y password), en caso contraro regresamos el error
		if(!empty($_POST['log_data'])){			
			$login_data = API::decrypt($_POST['log_data'], API::API_KEY);			
			$login_data = explode('|',$login_data);
			$mail_registrado = 	$login_data[0]; 												   	
			$pass_registrado = 	$login_data[1];						
		} else {
			$this->login_errores['email'] = '<div class="error2">Información incompleta.</div>';
			$this->login_errores['password'] = '<div class="error2">Información incompleta.</div>';
		}	
				
		// revisamos que el mail sea valido		
		if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
			// si el mail es igual al registrado no se cambia la contraseña en caso contrario se envia la contraseña actual para que se arme el md5 
			if($mail_registrado == $_POST['email']){
				$datos['email'] = htmlspecialchars(trim($_POST['email']));
			} else{
				$datos['email'] = htmlspecialchars(trim($_POST['email']));
				$datos['password'] = $pass_registrado;
			}
		} else {
			$this->login_errores['email'] = '<div class="error2">Por favor ingresa una dirección de correo válida. Ejemplo: nombre@dominio.mx</div>';		
		}
		
		
		if(array_key_exists('nombre', $_POST)){
			if(preg_match('/^[A-Z \'.-áéíóúÁÉÍÓÚÑñ]{1,30}$/i', $_POST['nombre'])) { 
				$datos['salutation'] = $_POST['nombre'];
			} else{
				$this->login_errores['nombre'] = '<div class="error2">Por favor ingresa tu nombre correctamente</div>';
			}
		} 
		
		if(array_key_exists('apellido_paterno', $_POST)){
			if(preg_match('/^[A-Z \'.-áéíóúÁÉÍÓÚÑñ]{1,30}$/i', $_POST['apellido_paterno'])) { 
				$datos['fname'] = $_POST['apellido_paterno'];
			} else{
				$this->login_errores['apellido_paterno'] = '<div class="error2">Por favor ingresa tu apellido paterno</div>';
			}
		}
		
		if(array_key_exists('apellido_materno', $_POST)){
			if(preg_match('/^[A-Z \'.-áéíóúÁÉÍÓÚÑñ]{1,30}$/i', $_POST['apellido_materno'])) { 
				$datos['lname'] = $_POST['apellido_materno'];
			}
		}
					
		if(!empty($_POST['password_actual'])){
						
			if($pass_registrado == $_POST['password_actual']){
				if(!empty($_POST['nuevo_password'])){
					$datos['password'] = $_POST['nuevo_password'];
				} else{
					$datos['password'] = $_POST['password_actual'];
				}																								
			} else{
				$this->login_errores['password'] = '<div class="error2">Password actual incorrecto</div>';
			}												
		} 	
		else{
			$datos['password']=$pass_registrado;
		}	
											
		return $datos;				
		
	}
		
	// funcion que revisa que los datos enviados para actualizar la razon social sean correctos
	private function get_datos_rs(){
		$datos = array();		 		
		
		if(!empty($_POST['txt_rfc'])){
			if((strlen($_POST['txt_rfc'])>13)||(strlen($_POST['txt_rfc'])<12)){
				$this->reg_errores['txt_rfc'] = '<span class="error">Por favor ingresa tu RFC</span>';		
			} else{
				if(strlen($_POST['txt_rfc'])==12){
					if (preg_match('/^([a-zA-Z]{3})+([0-9]{6})+([a-zA-Z0-9]{3})$/', $_POST['txt_rfc'])) {
						$datos['direccion']['tax_id_number'] = $_POST['txt_rfc'];
					} else {
						$this->reg_errores['txt_rfc'] = '<span class="error">Por favor ingresa tu RFC</span>';
					}	
				} else if(strlen($_POST['txt_rfc'])==13){					    
					if (preg_match('/^([a-zA-Z]{4})+([0-9]{6})+([a-zA-Z0-9]{3})$/', $_POST['txt_rfc'])) {
						$datos['direccion']['tax_id_number'] = $_POST['txt_rfc'];
					}else {
						$this->reg_errores['txt_rfc'] = '<span class="error">Por favor ingresa tu RFC</span>';
					}
				}
			}
		} else{
			$this->reg_errores['txt_rfc'] = '<span class="error">Por favor ingresa tu RFC</span>';				
		}
		
		if(!empty($_POST['txt_razon_social'])){
			$datos['direccion']['company'] = $_POST['txt_razon_social'];
		} else{
			$this->reg_errores['txt_razon_social'] = '<span class="error2">Por favor ingresa tu nombre o razón social</span>';
		}
		if(!empty($_POST['txt_email'])){
			if (filter_var($_POST['txt_email'], FILTER_VALIDATE_EMAIL)) {			    		
				$datos['direccion']['email'] = $_POST['txt_email'];					
			} else{
				$this->reg_errores['txt_email'] = '<span class="error2">Por favor ingresa un correo electrónico válido. Ejemplo: nombre@dominio.mx</span>';
			}	
			
		} else{
			$this->reg_errores['txt_email'] = '<span class="error2">Por favor ingresa un correo electrónico válido. Ejemplo: nombre@dominio.mx</span>';
		}	
		if ($_POST['chk_default'] == 1) {
			$datos['direccion']['id_estatusSi'] = 3;	//indica que será la razon social predeterminada			
		} else{
			$datos['direccion']['id_estatusSi'] = 1;	//indica que será la razon social
		}		
		
		return $datos;								
	}
	
	//funcion que valida los datos de direccion de facturacion para realizar el update
	private function get_datos_direccion(){
		
		if(!empty($_POST['txt_calle'])){
			$datos['direccion']['address1'] = $_POST['txt_calle'];
		}
		else{
			$this->reg_errores['txt_calle'] = '<span class="error">Por favor ingresa una calle</span>';
		}
		if(!empty($_POST['txt_numero'])){
			$datos['direccion']['address2'] = $_POST['txt_numero'];
		}
		else{
			$this->reg_errores['txt_numero'] = '<span class="error">Por favor ingresa el número exterior</span>';
		}		
		if(!empty($_POST['txt_cp'])){
			if(preg_match('/^[0-9]{5,5}([- ]?[0-9]{4,4})?$/', $_POST['txt_cp'])){
			    $datos['direccion']['zip'] = $_POST['txt_cp'];	
			}			
			else{
			    $this->reg_errores['txt_cp'] = '<span class="error2">Por favor ingresa un código postal de 5 dígitos</span>';	
			}
		}
		else{
			$this->reg_errores['txt_cp'] = '<span class="error2">Por favor ingresa un código postal de 5 dígitos</span>';
		}
		if(!empty($_POST['txt_colonia'])){
			$datos['direccion']['address3'] = $_POST['txt_colonia'];
		}
		else{
			$this->reg_errores['txt_colonia'] = '<span class="error">Por favor ingresa la colonia</span>';
		}
		if(!empty($_POST['txt_ciudad'])){
			$datos['direccion']['city'] = $_POST['txt_ciudad'];
		}
		else{
			$this->reg_errores['txt_ciudad'] = '<span class="error">Por favor ingresa la ciudad</span>';
		}
		if(!empty($_POST['txt_estado'])){
			$datos['direccion']['state'] = $_POST['txt_estado'];
		}
		else{
			$this->reg_errores['txt_estado'] = '<span class="error">Por favor ingresa el estado</span>';
		}													
		
		if(array_key_exists('txt_num_int', $_POST)){
		    $datos['direccion']['address4'] = $_POST['txt_num_int'];	
		}
		
		if(array_key_exists('sel_pais', $_POST)){
			$datos['direccion']['codigo_paisVc'] = $_POST['sel_pais'];
		}			
																
		if ($_POST['chk_default'] == 1) {
			$datos['direccion']['id_estatusSi'] = 3;	//indica que será la direccion de facturacion predeterminada			
		}
		else{
			$datos['direccion']['id_estatusSi'] = 1;	//indica que será la direccion de facturacion predeterminada
		}
									 	
		return $datos;
	}
	
	

	
	
	
	
	private function eliminar_tarjeta_interfase_CCTC($id_cliente = 0, $consecutivo = 0) {
		if (isset($id_cliente, $consecutivo)) {
			// Metemos todos los parametros (Objetos) necesarios a una clase dinámica llamada paramátros //
			$parametros = new stdClass;
			$parametros->id_cliente = $id_cliente;
			$parametros->consecutivo = $consecutivo;
			
			// Hacemos un encode de los objetos para poderlos pasar por POST ...
			$param = json_encode($parametros);
					
			// Inicializamos el CURL / SI no funciona se puede habilitar en el php.ini //
			$c = curl_init();
			// CURL de la URL donde se haran las peticiones //
			curl_setopt($c, CURLOPT_URL, 'http://localhost/interfase_cctc/interfase.php');
			//curl_setopt($c, CURLOPT_URL, 'http://10.43.29.196/interface_cctc/solicitar_post.php');
			// Se enviaran los datos por POST //
			curl_setopt($c, CURLOPT_POST, true);
			// Que nos envie el resultado del JSON //
			curl_setopt($c, CURLOPT_RETURNTRANSFER, TRUE);
			// Enviamos los parametros POST //
			curl_setopt($c, CURLOPT_POSTFIELDS, 'accion=EliminarTarjeta&token=123456&parametros='.$param);
			// Ejecutamos y recibimos el JSON //
			$resultado = curl_exec($c);
			// Cerramos el CURL //
			curl_close($c);
		
			return json_decode($resultado);
		}
	}

	private function obtener_detalle_interfase_CCTC($id_cliente = 0, $consecutivo = 0) {
		if (isset($id_cliente, $consecutivo)) {
			// Metemos todos los parametros (Objetos) necesarios a una clase dinámica llamada paramátros //
			$parametros = new stdClass;
			$parametros->id_cliente = $id_cliente;
			$parametros->consecutivo = $consecutivo;
			
			// Hacemos un encode de los objetos para poderlos pasar por POST ...
			$param = json_encode($parametros);
			
			// Inicializamos el CURL / SI no funciona se puede habilitar en el php.ini //
			$c = curl_init();
			// CURL de la URL donde se haran las peticiones //
			curl_setopt($c, CURLOPT_URL, 'http://localhost/interfase_cctc/interfase.php');
			//curl_setopt($c, CURLOPT_URL, 'http://10.43.29.196/interface_cctc/solicitar_post.php');
			// Se enviaran los datos por POST //
			curl_setopt($c, CURLOPT_POST, true);
			// Que nos envie el resultado del JSON //
			curl_setopt($c, CURLOPT_RETURNTRANSFER, TRUE);
			// Enviamos los parametros POST //
			curl_setopt($c, CURLOPT_POSTFIELDS, 'accion=ObtenerDetalleAmex&token=123456&parametros='.$param);
			// Ejecutamos y recibimos el JSON //
			$resultado = curl_exec($c);
			// Cerramos el CURL //
			curl_close($c);
			/*
			echo "Resultado<pre>";
			print_r(json_decode($resultado));
			echo "</pre>";
			exit;
			*/
			return json_decode($resultado);
		}
	}
	
	private function editar_tarjeta_interfase_CCTC($tc, $amex = null)
	{
		//mapeo de la tc
		$tc_soap = new stdClass;
		$tc_soap->id_clienteIn = $tc['id_clienteIn'];
		$tc_soap->consecutivo_cmsSi = $tc['id_TCSi'];
		$tc_soap->id_tipo_tarjeta = $tc['id_tipo_tarjetaSi'];
		$tc_soap->nombre_titular = $tc['nombre_titularVc'];
		$tc_soap->apellidoP_titular = $tc['apellidoP_titularVc'];
		$tc_soap->apellidoM_titular = $tc['apellidoM_titularVc'];
		$tc_soap->numero = $tc['terminacion_tarjetaVc'];
		$tc_soap->mes_expiracion = $tc['mes_expiracionVc'];
		$tc_soap->anio_expiracion = $tc['anio_expiracionVc'];
		$tc_soap->renovacion_automatica = 1;
		
		//mapeo Amex
		if (isset($amex)) {
			$amex_soap = new stdClass;
			$amex_soap->id_clienteIn = $amex['id_clienteIn'];
			$amex_soap->consecutivo_cmsSi = $amex['id_TCSi'];
			$amex_soap->nombre =$amex['nombre_titularVc'];
			$amex_soap->apellido_paterno = $amex['apellidoP_titularVc'];
			$amex_soap->apellido_materno = $amex['apellidoM_titularVc'];
			$amex_soap->pais = $amex['pais'];
			$amex_soap->codigo_postal = $amex['codigo_postal'];
			$amex_soap->calle = $amex['calle'];
			$amex_soap->ciudad = $amex['ciudad'];
			$amex_soap->estado = $amex['estado'];
			$amex_soap->mail = $amex['mail'];
			$amex_soap->telefono = $amex['telefono'];
			
		} else {
			$amex_soap = null;
		}
		
		########## petición a la Interfase
		// Metemos todos los parametros (Objetos) necesarios a una clase dinámica llamada paramátros //
		$parametros = new stdClass;
		$parametros->tc_soap = $tc_soap;
		$parametros->amex_soap = $amex_soap;
		
		// Hacemos un encode de los objetos para poderlos pasar por POST ...
		$param = json_encode($parametros);
		
		/*
		echo "<pre>";
		print_r($parametros);
		echo "</pre>". "ecoded:" ;
		echo $param."<br/>";
		exit;
		
		$p = json_decode($param);
		$objetos = $this->ArrayToObject($p);
		echo "<pre>";
		print_r($objetos);
		echo "</pre>";
		*/
				
		// Inicializamos el CURL / SI no funciona se puede habilitar en el php.ini //
		$c = curl_init();
		// CURL de la URL donde se haran las peticiones //
		curl_setopt($c, CURLOPT_URL, 'http://localhost/interfase_cctc/interfase.php');
		//curl_setopt($c, CURLOPT_URL, 'http://10.43.29.196/interface_cctc/solicitar_post.php');
		// Se enviaran los datos por POST //
		curl_setopt($c, CURLOPT_POST, true);
		// Que nos envie el resultado del JSON //
		curl_setopt($c, CURLOPT_RETURNTRANSFER, TRUE);
		// Enviamos los parametros POST //
		curl_setopt($c, CURLOPT_POSTFIELDS, 'accion=ActualizarAmex&token=123456&parametros='.$param);
		// Ejecutamos y recibimos el JSON //
		$resultado = curl_exec($c);
		// Cerramos el CURL //
		curl_close($c);
		/*
		echo "Resultado<pre>";
		print_r(json_decode($resultado));
		echo "</pre>";
		exit;
		*/
		return json_decode($resultado);
	}

private function get_datos_tarjeta()
	{
		$datos = array();
		$tipo = '';
		//echo "tipo : ". $tipo;
		//no se usa la funcion de escape '$this->db->escape()', por que en la inserción ya se incluye 
		if($_POST) {
			if (array_key_exists('sel_tipo_tarjeta', $_POST)) {
				$datos['tc']['id_tipo_tarjetaSi'] = $_POST['sel_tipo_tarjeta'];
				$tipo = $_POST['sel_tipo_tarjeta'];
			}
			
			if (array_key_exists('txt_numeroTarjeta', $_POST)) {
				if ($this->validar_tarjeta($datos['tc']['id_tipo_tarjetaSi'], trim($_POST['txt_numeroTarjeta']))) { 
					$datos['tc']['terminacion_tarjetaVc'] = trim($_POST['txt_numeroTarjeta']);	//substr($_POST['txt_numeroTarjeta'], strlen($_POST['txt_numeroTarjeta']) - 4);
				} else {
					$this->reg_errores['txt_numeroTarjeta'] = 'Por favor ingrese un numero de tarjeta v&aacute;lido';
				}
			}
			if (array_key_exists('txt_nombre', $_POST)) {
				if(preg_match('/^[A-ZáéíóúÁÉÍÓÚÑñ \'.-]{1,30}$/i', $_POST['txt_nombre'])) { 
					$datos['tc']['nombre_titularVc'] = $_POST['txt_nombre'];
					if ($tipo == 1) {
						$datos['amex']['nombre_titularVc'] = $_POST['txt_nombre'];
					}
				} else {
					$this->reg_errores['txt_nombre'] = 'Ingresa tu nombre correctamente';
				}
			}
			if (array_key_exists('txt_apellidoPaterno', $_POST)) {
				if(preg_match('/^[A-ZáéíóúÁÉÍÓÚÑñ \'.-]{1,30}$/i', $_POST['txt_apellidoPaterno'])) { 
					$datos['tc']['apellidoP_titularVc'] = $_POST['txt_apellidoPaterno'];
					if ($tipo == 1) {
						$datos['amex']['apellidoP_titularVc'] = $_POST['txt_apellidoPaterno'];
					}
				} else {
					$this->reg_errores['txt_apellidoPaterno'] = 'Ingresa tu apellido correctamente';
				}
			}
			if (array_key_exists('txt_apellidoMaterno', $_POST) && !empty($_POST['txt_apellidoMaterno'])) {
				if(preg_match('/^[A-ZáéíóúÁÉÍÓÚÑñ \'.-]{1,30}$/i', $_POST['txt_apellidoMaterno'])) {
					$datos['tc']['apellidoM_titularVc'] = $_POST['txt_apellidoMaterno'];
					if ($tipo == 1) {	//Amex
						$datos['amex']['apellidoM_titularVc'] = $_POST['txt_apellidoMaterno'];
					}
				} else {
					$this->reg_errores['txt_apellidoMaterno'] = 'Ingresa tu apellido correctamente';
				}
			} else {
				$datos['tc']['apellidoM_titularVc'] = "";
					if ($tipo == 1) {
						$datos['amex']['apellidoM_titularVc'] = "";
					}
			}
			/*
			if(array_key_exists('txt_codigoSeguridad', $_POST)) {
				//este código sólo se almaccena para solicitar el pago 
				$datos['codigo_seguridad'] = $_POST['txt_codigoSeguridad']; 
			}
			*/
			if (array_key_exists('sel_mes_expira', $_POST)) {
				$datos['tc']['mes_expiracionVc'] = $_POST['sel_mes_expira']; 
			}
			if (array_key_exists('sel_anio_expira', $_POST)) { 
				$datos['tc']['anio_expiracionVc'] = $_POST['sel_anio_expira'];  
			}
			if (array_key_exists('chk_guardar', $_POST)) {
				$datos['guardar'] = $_POST['chk_guardar'];		//indicador para saber si se guarda o no la tarjeta
				$datos['tc']['id_estatusSi'] = 1;
			}
			if ($_POST['chk_default'] == 1) {
				$datos['tc']['id_estatusSi'] = 3;	//indica que será la tarjeta predeterminada
				$datos['predeterminar'] = true;	
			}
			
			//AMEX
			if (array_key_exists('txt_calle', $_POST)) {
				if(preg_match('/^[A-Z0-9 \'.-áéíóúÁÉÍÓÚÑñ]{2,40}$/i', $_POST['txt_calle'])) {
					$datos['amex']['calle'] = $_POST['txt_calle'];
				} else {
					$this->reg_errores['txt_calle'] = 'Ingresa tu calle y n&uacute;mero correctamente';
				}
			} /*else {
				$datos['amex']['calle'] = '';
			}*/
			if (array_key_exists('txt_cp', $_POST)) {
				//regex usada en js
				if(preg_match('/^([1-9]{2}|[0-9][1-9]|[1-9][0-9])[0-9]{3}$/', $_POST['txt_cp'])) {
					$datos['amex']['codigo_postal'] = $_POST['txt_cp'];
				} else {
					$this->reg_errores['txt_cp'] = 'Ingresa tu c&oacute;digo postal correctamente';
				}
			} /*else {
				$datos['amex']['codigo_postal'] = '';
			}*/
			if (array_key_exists('txt_ciudad', $_POST)) {
				if(preg_match('/^[A-Z0-9 \'.,-áéíóúÁÉÍÓÚÑñ]{2,40}$/i', $_POST['txt_ciudad'])) {
					$datos['amex']['ciudad'] = $_POST['txt_ciudad'];
				} else {
					$this->reg_errores['txt_ciudad'] = 'Ingresa tu ciudad correctamente';
				}
			} /*else {
				$datos['amex']['ciudad'] = '';
			}*/
			if (array_key_exists('txt_estado', $_POST)) {
				if(preg_match('/^[A-Z \'.-áéíóúÁÉÍÓÚÑñ]{2,40}$/i', $_POST['txt_estado'])) {
					$datos['amex']['estado'] = $_POST['txt_estado'];
				} else {
					$this->reg_errores['txt_estado'] = 'Ingresa tu estado correctamente';
				}
			} /*else {
				$datos['amex']['estado'] = '';
			}*/
			if (array_key_exists('txt_pais', $_POST)) {
				if(preg_match('/^[A-Z \'.-áéíóúÁÉÍÓÚÑñ]{2,40}$/i', $_POST['txt_pais'])) {
					$datos['amex']['pais'] = $_POST['txt_pais'];
				} else {
					$this->reg_errores['txt_pais'] = 'Ingresa tu pa&iacute;s correctamente';
				}
			} /*else {
				$datos['amex']['pais'] = '';
			}*/
			if (array_key_exists('sel_pais', $_POST)) {
				if ($_POST['sel_pais'] != "") {
					$datos['amex']['pais'] = $_POST['sel_pais'];
				} else {
					$this->reg_errores['sel_pais'] = 'Selecciona tu pa&iacute;s';
				}
			} /*else {
				$datos['amex']['pais'] = '';
			}*/
			if (array_key_exists('txt_email', $_POST) && trim($_POST['txt_email']) != "") {
				if(filter_var($_POST['txt_email'], FILTER_VALIDATE_EMAIL)) {
					$datos['amex']['mail'] = $_POST['txt_email'];
				} else {
					$this->reg_errores['txt_email'] = 'Ingresa tu email correctamente (opcional)';
				}
			} else {
				$datos['amex']['mail'] = '';
			}
			
			if (array_key_exists('txt_telefono', $_POST)) {
				if(preg_match('/^[0-9 -]{8,20}$/i', $_POST['txt_telefono'])) {
					$datos['amex']['telefono'] = $_POST['txt_telefono'];
				} else {
					$this->reg_errores['txt_telefono'] = 'Ingresa tu tel&eacute;fono correctamente';
				}
			} /*else {
				$datos['amex']['telefono'] = '';
			}*/

			
		} 
		
		//echo 'si no hay errores, $reg_errores esta vacio? '.empty($this->reg_errores).'<br/>';
		return $datos;
	}

	private function consulta_estados()
	{
		$resultado = array();
		$resultado = $this->administrador_usuario_model->listar_estados_sepomex();	
		return $resultado; 
	}
	
	private function consulta_ciudades($estado)
	{		
		$resultado = array();
		$resultado = $this->administrador_usuario_model->listar_ciudades_sepomex($estado);	
		return $resultado;							
	}
	
	private function consulta_colonias($estado, $ciudad)
	{		
		$resultado = array();
		$resultado = $this->administrador_usuario_model->listar_colonias_sepomex($estado, $ciudad);			
		return $resultado;		
		
	}
	
	//obtiene los datos de direccion de envio para hacer el update
	private function get_datos_direccion_envio()
	{
		$datos = array();
		//no se usa la funcion de escape '$this->db->escape()', por que en la inserción ya se incluye 
		if($_POST) {
			if (array_key_exists('txt_calle', $_POST)) {
				if(preg_match('/^[A-Z0-9áéíóúÁÉÍÓÚÑñ \'.-]{1,50}$/i', $_POST['txt_calle'])) {
					$datos['direccion']['address1'] = $_POST['txt_calle'];
				} else {
					$this->reg_errores['txt_calle'] = '<span class="error">Por favor ingresa una calle</span>';
				}
			}
			if (array_key_exists('txt_numero', $_POST)) {
				if(preg_match('/^[A-Z0-9 -]{1,50}$/i', $_POST['txt_numero'])) {
					$datos['direccion']['address2'] = $_POST['txt_numero'];
				} else {
					$this->reg_errores['txt_numero'] = '<span class="error">Por favor ingresa el número exterior</span>';
				}
			}
			if (!empty($_POST['txt_num_int'])) {
				if(preg_match('/^[A-Z0-9 -]{1,50}$/i', $_POST['txt_num_int'])) {
					$datos['direccion']['address4'] = $_POST['txt_num_int'];
				} else {
					$this->reg_errores['txt_numero'] = '<span class="error">Por favor ingresa el número interior</span>';
				}
			} else {
				$datos['direccion']['address4'] = NULL;
			}
			if (array_key_exists('txt_cp', $_POST)) {
				//regex usada en js
				if (preg_match('/^([1-9]{2}|[0-9][1-9]|[1-9][0-9])[0-9]{3}$/', $_POST['txt_cp'])) {
					$datos['direccion']['zip'] = $_POST['txt_cp'];
				} else {
					$this->reg_errores['txt_cp'] = '<span class="error2">Por favor ingresa un código postal de 5 dígitos</span>';
				}
			}
						
			if (!empty($_POST['sel_pais'])) {
			//if(preg_match('/^[A-Z]{2}$/i', $_POST['sel_pais'])) {
				$datos['direccion']['codigo_paisVc'] = $_POST['sel_pais'];
			} else {
				$this->reg_errores['sel_pais'] = '<span class="error">Por favor selecciona el pa&iacute;s</span>';
			}
			
			/*Mexico*/
			if (!empty($_POST['sel_pais']) && $_POST['sel_pais'] == self::CODIGO_MEXICO)
			{
				if (!empty($_POST['sel_estados'])) {
					$datos['direccion']['state'] = $_POST['sel_estados'];
				} else {
					$this->reg_errores['sel_estados'] = '<span class="error">Por favor selecciona el estado</span>';
				}
				if (!empty($_POST['sel_ciudades'])) {
				//if(preg_match('/^[A-Z ()\'.-áéíóúÁÉÍÓÚÑñ]{2, 30}$/i', $_POST['sel_ciudades'])) {
					$datos['direccion']['city'] = $_POST['sel_ciudades'];
				} else {
					$this->reg_errores['sel_ciudades'] = '<span class="error">Por favor selecciona la ciudad</span>';
				}
				if (!empty($_POST['sel_colonias'])) {
				//if(preg_match('/^[A-Z0-9  \'.-áéíóúÁÉÍÓÚÑñ]{2, 30}$/i', $_POST['sel_colonias'])) {
					$datos['direccion']['address3'] = $_POST['sel_colonias'];
				} else {
					$this->reg_errores['sel_colonias'] = '<span class="error">Por favor selecciona la colonia</span>';
				}
			} else {
			/*otros países*/
				if (array_key_exists('txt_colonia', $_POST) && trim($_POST['txt_colonia']) != ""){
					$datos['direccion']['address3'] = $_POST['txt_colonia'];
				}
				else {
					$this->reg_errores['txt_colonia'] = '<span class="error">Por favor ingresa la colonia</span>';
				}
				if (array_key_exists('txt_ciudad', $_POST) && !empty($_POST['txt_ciudad'])) {
					$datos['direccion']['city'] = $_POST['txt_ciudad'];
				}
				else {
					$this->reg_errores['txt_ciudad'] = '<span class="error">Por favor ingresa la ciudad</span>';
				}
				if (array_key_exists('txt_estado', $_POST) && !empty($_POST['txt_estado'])) {
					$datos['direccion']['state'] = $_POST['txt_estado'];
				}
				else {
					$this->reg_errores['txt_estado'] = '<span class="error">Por favor ingresa el estado</span>';
				}	
			}
			
			if (array_key_exists('txt_telefono', $_POST)) {
				if(preg_match('/^[0-9 ()+-]{10,20}$/i', $_POST['txt_telefono'])) {
					$datos['direccion']['phone'] = $_POST['txt_telefono'];
				} else {
					$this->reg_errores['txt_telefono'] = '<span class="error">Por favor ingresa un tel&eacute;fono</span>';
				}
			}
			
			if (array_key_exists('txt_referencia', $_POST)) {
				$datos['direccion']['referenciaVc'] = trim($_POST['txt_referencia']);
			}
				
			if ($_POST['chk_default'] == 1) {
				$datos['direccion']['id_estatusSi'] = 3;	//dirección predeterminada?
				$datos['predeterminar'] = true;				
			} else {
				//siempre se guarda la dirección
				$datos['direccion']['id_estatusSi'] = 1;
			}						
			
		} 
		//var_dump($datos);
		//var_dump($this->reg_errores);
		//exit();
		return $datos;
	}

	
	
	####->-> para documentacion de las siguientes funciones revisar controllers/direccion envio 
	public function es_mexico($codigo_pais="") {
		//$codigo_pais = ['codigo_pais'];
		$r = ($codigo_pais == self::CODIGO_MEXICO) ? TRUE : FALSE;
		$es_mexico = array('result' => $r, 'param' => $codigo_pais);
		
		header('Content-Type: application/json',true);
		echo json_encode($es_mexico);
	}

	public function get_info_sepomex($cp = 0) {		
		if (!$cp)
			$cp = $this->input->post('codigo_postal');	
			$resultado = $this->consulta_sepomex($cp);		
		header('Content-Type: application/json',true);
		echo json_encode($resultado);
	}

	private function consulta_sepomex($codigo_postal){
		$resultado = array();
		
		try{
			$resultado['sepomex'] = $this->direccion_envio_model->obtener_direccion_sepomex($codigo_postal)->result();
			$resultado['success'] = true;
			$resultado['msg'] = "Ok";
			
			return $resultado;
		}
		catch (Exception $e){
			$resultado['exception'] =  $exception;
			$resultado['msg'] = $exception->getMessage();
			$resultado['error'] = true;
			return $resultado;	
		}				
	}
	
	public function get_ciudades($estado = "") {
		$estado = $this->input->post('estado');
		$resultado = array();
		$resultado['ciudades'] = $this->direccion_envio_model->listar_ciudades_sepomex($estado)->result_array();
		header('Content-Type: application/json',true);
		echo json_encode($resultado);		
	}
	
	public function get_colonias($estado = "", $ciudad = "") {
		$estado = $this->input->post('estado');
		$ciudad = $this->input->post('ciudad');

		$resultado = array();
		$resultado['colonias'] = $this->direccion_envio_model->listar_colonias_sepomex($estado, $ciudad)->result_array();
		
		header('Content-Type: application/json',true);
		echo json_encode($resultado);		
	}

	####->->
	
	
}

/* End of file administrador_usuario.php */
/* Location: ./application/controllers/administrador_usuario.php */