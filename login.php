<?php	 
	include('./core/util_helper.php');
	
	require_once('./config/settings.php');
	require_once('./models/login_registro_model.php');
	
	$title = 'Iniciar Sesi&oacute;n'; 				// Capitalize the first letter
	$subtitle = 'Iniciar Sesi&oacute;n Segura'; 	// Capitalize the first letter
	
	$login_errores = array();
	$data = array();
	
	//Sólo para login de usuario nuevo
	const NUEVO = "nuevo";
	
	if ($_POST) {
		echo "Hola Usuario<br/>";
		//inicio de la sesión
		session_start();
		
		//no caché
		no_cache();
		
		//si es usuario nuevo, se debe registrar, cuando no hay JS
		if (array_key_exists('tipo_inicio', $_POST) && $_POST['tipo_inicio'] == NUEVO) {
			$url = site_url('registro');
			echo "Registro Usuario NUEVO";
			//header("Location: $url");
			exit();
		} else {
			//Instanciar al modelo
			$modelo = new Login_Registro_Model();
			
			//recupera y valida info de los campos
			$login_info = array();
			$login_info = get_datos_login();
			
			$data['mensaje'] = "";
			
			/*
			$e = $modelo->verifica_registro_email('helladyo_@hotmaila.com');
			echo "<pre>";
			print_r($e);
			echo "</pre>";
			*/
			
			//$hora_unix = mktime(date('h'), date('i'), date('s'), date('m'), date('d'), date('Y'));
			//echo "date: " . date('Y/m/d h:i:s', $hora_unix);
			
			//$t = date('Y/m/d h:i:s', time());
			//echo "t: " . $t ."<br/>";
			//echo "registrar hist: " . $modelo->guarda_actividad_historico(8, 'ffd', $TIPO_ACTIVIDAD['DESBLOQUEO'], $t);
			
			//echo "desbloqueó?" . $modelo->desbloquear_cuenta(8);
			
			//echo "intentos: ". $modelo->obtiene_numero_intentos(8);
			
			//echo "verifica cliente:<br/>";
			//$y = $modelo->verifica_cliente('helladyo_@hotmail.comg', 'Kali2012');
			/*echo "hh<pre>";
			print_r($y);
			echo "</pre>";
			*/
			
			
			exit;
			
			if (empty($login_errores)) {
				//verificar que el usuario esté registrado
				$email 		= $login_info['email'];
				$password 	= $login_info['password'];
				$mail_cte	= $modelo->verifica_registro_email($email);
																						
				if (count($mail_cte) != 0) {
					$fecha_lock = $mail_cte['LastLockoutDate'];
					$id_cliente = $mail_cte['id_clienteIn'];
											
					if ($fecha_lock != '0000-00-00 00:00:00') {
						//Checa si puede intentar iniciar sesión
						if ($this->tiempo_desbloqueo($fecha_lock)) {
							$modelo->desbloquear_cuenta($id_cliente);
							//hora actual
							$t = date('Y/m/d h:i:s', time());
							
							$modelo->guarda_actividad_historico($id_cliente, '', $TIPO_ACTIVIDAD['DESBLOQUEO'], $t);							
						}
					}
					//Obtener la cuenta de los intentos realizados
					$num_intentos = $modelo->obtiene_numero_intentos($id_cliente);	
					
					if ($num_intentos < 3) {
						$resultado = $modelo->verifica_cliente($this->email, $this->password);							
						if (count($resultado) > 0) {	//si no es un arreglo vacío: SI !empty($resultado)
							//Resguardar la información de la promoción
							
		############VAS ACÁ
							//destruir la sesión de PHP y mandar la información en la sesión de CI con un nuevo ID
							$this->cambiar_session();
							
							//encryptar login y pass y guardarlo en session											
							$cliente = $resultado->row();
							$dl = $this->api->encrypt($cliente->email."|".$this->password, $this->api->key);
							$this->session->set_userdata('datos_login',$dl);
							
							//se crea la sessión con la información del cliente
							$this->crear_sesion($cliente->id_cliente, $cliente->nombre, $this->email);	//crear sesion
							
							//por defaulr no se considera la dirección d facturación
							$datars = array('requiere_factura' => 'no');
							$this->session->set_userdata($datars);
							
							//detecta a donde va el ususario a partir de la promoción que se tiene en sesión
							$destino = $this->obtener_destino($cliente->id_cliente);						
							
							//colocar en sessión el destino
							$data_destino = array('destino' => $destino);
							$this->session->set_userdata($data_destino);
							
							//Flujo
							redirect($destino);
						} 
						else {	//No está correcta la información para iniciar sesión
							$login_errores['user_login'] = "Hubo un error con la combinación ingresada de correo y contraseña.<br />Por favor intenta de nuevo.";
																									
							$t = date('Y/m/d h:i:s', time());
							
							////////////Vas aCA								
							$this->password_model->guarda_actividad_historico($id_cliente, $this->password, self::$TIPO_ACTIVIDAD['ACCESO_INCORRECTO'], $t);							
							$this->login_registro_model->suma_intento_fallido($id_cliente, $num_intentos, $t);	
						}
					}
					else{
						if($num_intentos==3){
							$t= mdate('%Y/%m/%d %h:%i:%s',time());	
							$this->password_model->guarda_actividad_historico($id_cliente, '', self::$TIPO_ACTIVIDAD['BLOQUEO'], $t);
							$this->login_registro_model->suma_intento_fallido($id_cliente, $num_intentos, $t);	
						}
						$login_errores['user_login'] = "Ha excedido el número máximo de intentos permitidos para iniciar sesión.<br />
						                                      Su cuenta permanecerá bloqueada por 30 minutos";
						
					}						
				}					
				else {						
					$login_errores['user_login'] = "Esta dirección de correo no está registrada.<br />Por favor intenta de nuevo o regístrate en el sitio";																																					
					//$data['mensaje'] = "Correo o contrase&ntilde;a incorrectos" ;
				}
			}
		}
		
		$data['login_errores'] = $login_errores;
		cargar_vista('login', $data);
		
		exit;
		echo "after exit;";
	} else {
	
		//algunas configuraciones de php, headers...
		
		$scripts = array();
		
		//incluir archivos js
			
		$scripts [] = TIENDA."js/login.js";
		$scripts [] = TIENDA."js/registro.js";
		
		$data["scripts"] = $scripts;
		$data["title"] = $title;
		$data["subtitle"] = $subtitle;
		
		//cargar vista
		cargar_vista('login', $data);
		
		/*
		//header
		require('./templates/header.php');
		
		//contenido
		include('./views/login.php');
		//include('./components/promociones.php');
		
		//footer
		require('./templates/footer.php');
		*/
	}
	
	######################## LOGIN ################################
	/**
	 * Recuperación de los datos para el inicio de sesión
	 */
	
	function get_datos_login($value='')
	{
		$datos = array();
		
		if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
			$datos['email'] = htmlspecialchars(trim($_POST['email']));
			//echo "mail: ".$_POST['email']."<br/>";
		} else {
			$login_errores['email'] = 'Por favor ingresa una dirección de correo válida. Ejemplo: nombre@dominio.mx';
		}
		
		if (array_key_exists('tipo_inicio', $_POST) && $_POST['tipo_inicio'] == 'registrado') {
			if (!empty($_POST['password'])) {
				$datos['password'] = htmlspecialchars(trim($_POST['password']));
			} else {
				$login_errores['password'] = 'Por favor escribe tu contraseña o selecciona iniciar sesión como cliente nuevo.';
			}					
		} else {
			$login_errores['user_login'] = 'Selecciona alguna modalidad';
		}
		
		return $datos;
	}
	
	/**
	 * Toma la fecha, la pasa a UNIX, le suma 30 minutos y verifica con la hora actual 
	 */
	function tiempo_desbloqueo($fecha_lock){
		$seg = substr($fecha_lock,17,2);
		$min = substr($fecha_lock,14,2);
		$hor = substr($fecha_lock,11,2);
		$dia = substr($fecha_lock,8,2);
		$mes = substr($fecha_lock,5,2);
		$ano = substr($fecha_lock,0,4);
		
		//Horas Minutos Segundos mes dia ano
		$fecha_lock_unix = mktime($hor,$min,$seg,$mes,$dia,$ano);
		$hora_unix = mktime(date('h'), date('i'), date('s'), date('m'), date('d'), date('Y'));
		
		// Se suman 30 minutos a la hora y fecha actual		
		$str = strtotime('+30 minutes',$fecha_lock_unix);
												
		if ($str <= $hora_unix) {
			return TRUE;
		}
		else{
			return FALSE;
		}	
	}
	
	function consulta_mail(){
		//$value['mail']=$_GET['mail'];
		$res=$this->login_registro_model->verifica_registro_email($_GET['mail']);
		$value['mail']=$res->num_rows();
		echo json_encode($value);			
	}



