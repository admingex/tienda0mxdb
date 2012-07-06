<?php
	//algunas configuraciones de php, headers...
	require_once('./config/settings.php');
	 
	//algunas constantes y funciones genéricas
	include('./core/util_helper.php');
	
	//el modelo del login	
	require_once('./models/login_registro_model.php');
		
	$title = 'Iniciar Sesi&oacute;n'; 				// Capitalize the first letter
	$subtitle = 'Iniciar Sesi&oacute;n Segura'; 	// Capitalize the first letter
	
	$login_errores = array();
	$data = array();
	
	//Sólo para login de usuario nuevo
	const NUEVO = "nuevo";
	
	####### Para la carga de la página
	$scripts = array();
	
	//incluir archivos js
		
	$scripts [] = TIENDA."js/login.js";
	$scripts [] = TIENDA."js/registro.js";
	
	$data["scripts"] = $scripts;
	$data["title"] = $title;
	$data["subtitle"] = $subtitle;
	
	####### END carga de la página
	
	if ($_POST) {	
		//echo "Hola Usuario<br/>";
		//inicio de la sesión
		session_start();
		
		//para pruebas
		$_SESSION = array();
		
		//no caché
		no_cache();
		
		//si es usuario nuevo, se debe registrar, cuando no hay JS
		if (array_key_exists('tipo_inicio', $_POST) && $_POST['tipo_inicio'] == NUEVO) {
			$url = site_url('registro');
			echo "Registro Usuario NUEVO";
##### TO DO
			//header("Location: $url");	
			exit();
		} else {
			//Instanciar al modelo
			$modelo = new Login_Registro_Model();
			
			//recupera y valida info de los campos
			$login_info = array();
			$login_info = get_datos_login();
			
			$data['mensaje'] = "";
			
			//echo "intentos: ". $n = $modelo->obtiene_numero_intentos(8);
			//exit;
			
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
						if (tiempo_desbloqueo($fecha_lock)) {
							$modelo->desbloquear_cuenta($id_cliente);
							//hora actual
							$t = date('Y/m/d h:i:s', time());
							
							$modelo->guarda_actividad_historico($id_cliente, '', $TIPO_ACTIVIDAD['DESBLOQUEO'], $t);							
						}
					}
					//Obtener la cuenta de los intentos realizados
					$num_intentos = $modelo->obtiene_numero_intentos($id_cliente);	
					
					if ($num_intentos < 3) {
						//si el cliente existe, lo regresa en un arreglo: id_clienteIn as id_cliente, salutation as nombre, email, password
						$cliente = $modelo->verifica_cliente($email, $password);							
						
						if (count($cliente) > 0) {	//si no es un arreglo vacío: SI !empty($resultado)
							
				########TO TO: //Resguardar la información de la promoción
							
							//destruir la sesión de PHP y mandar la información en la sesión de CI con un nuevo ID
							cambiar_session();
							
							//encryptar login y pass y guardarlo en session											
							//$cliente = $resultado->row();
							$dl = encrypt($cliente['email']."|".$password, API_KEY);
							
							//session PHP
							$_SESSION['datos_login'] = $dl;
							
							//se crea la sessión con la información del cliente
							crear_sesion($cliente['id_cliente'], $cliente['nombre'], $email);	//crear sesion
							
							//por defaulr no se considera la dirección de facturación
							$_SESSION ['requiere_factura'] = 'no';
							
							//detecta a donde va el ususario a partir de la promoción que se tiene en sesión
							$destino = obtener_destino($cliente['id_cliente']);
							
							//colocar en sesión el destino
							$_SESSION['destino'] = $destino;
							
							//Flujo
							//redirect($destino);
							$url = site_url($destino);
			###### TO DO:	//header("Location: $url", TRUE, 302);
							echo "Sesión iniciada!";
							echo "Sesión:<pre>";
							print_r($_SESSION); 
							echo "<pre>";
							exit;
							
						} else {	//No está correcta la información para iniciar sesión
							echo "Intento fallido de login: $num_intentos";
							$login_errores['user_login'] = "Hubo un error con la combinación ingresada de correo y contraseña.<br />Por favor intenta de nuevo.";
																									
							$t = date('Y/m/d h:i:s', time());
							//Registra el intento y el password con el que se intentó iniciar sesión
							$modelo->guarda_actividad_historico($id_cliente, $password, $TIPO_ACTIVIDAD['ACCESO_INCORRECTO'], $t);
														
							//TRUE / FALSE :
							$modelo->suma_intento_fallido($id_cliente, $num_intentos, $t);
						
							//se carga la vista de nuevo
							$data['login_errores'] = $login_errores;
							cargar_vista('login', $data);
						}
					}  else {	// IF número de intentos < 3
					
						if ($num_intentos == 3) {
							$t = date('Y/m/d h:i:s', time());
							
							//Registra el intento y el bloqueo
							$modelo->guarda_actividad_historico($id_cliente, '', $TIPO_ACTIVIDAD['BLOQUEO'], $t);
							//TRUE / FALSE :
							$modelo->suma_intento_fallido($id_cliente, $num_intentos, $t);	
						}
						
						$login_errores['user_login'] = "Ha excedido el número máximo de intentos permitidos para iniciar sesión.<br />
						                                      Su cuenta permanecerá bloqueada por 30 minutos";
						
					}
											
				} else { 	// IF existe el correo enviado						
					$login_errores['user_login'] = "Esta dirección de correo no está registrada.<br />Por favor intenta de nuevo o regístrate en el sitio";																																					
					//$data['mensaje'] = "Correo o contrase&ntilde;a incorrectos";
				}
			} else { // IF hubo errores
				$data['login_errores'] = $login_errores;
				cargar_vista('login', $data);
				exit;
			}	
		}	// ELSE-If es cliente registrado 
		//exit;
	} else {	//If hay $_POST
	
		//cargar vista
		cargar_vista('login', $data);
		exit;
	}
	
	######################## LOGIN ################################
	/**
	 * Recuperación de los datos para el inicio de sesión
	 * Ok
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
	 * Ok 
	 */
	function tiempo_desbloqueo($fecha_lock)
	{
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
	
	/**
	 * Regenera el id de la sesión y lo re-asigna
	 * Ok
	 */
	function cambiar_session()
	{
		//regenerar el id de la sesión y asignarlo
		session_regenerate_id();
		
		$new_id = session_id();
		
		//sólo se manejará la de PHP
		$_SESSION['session_id'] = $new_id;
		
		//CI
		//$this->session->set_userdata('session_id', $new_id);
		
		
		//echo "Después:<pre>";
		//print_r($this->session->all_userdata());
		//print_r($_SESSION); 
		//echo "<pre>";
		
		//exit();				
	 }
	
	/**
	 * Crea la sesión del cliente
	 */
	function crear_sesion($id_cliente, $nombre, $email)
	{
		//se crea la nueva
		$array_session = array(
			'logged_in' => TRUE,
			'username' 	=> $nombre,
			'id_cliente'=> $id_cliente,
			'email' 	=> $email
		);
		
		//creación de la sesión
		//$this->session->set_userdata($array_session);
		foreach ($array_session as $key => $value) {
			$_SESSION[$key] = $value;
		}
		/*
		echo "Sesión:<pre>";
		print_r($_SESSION); 
		echo "<pre>";
		exit;
		*/
	}
	
	/**
	 * Regresa el destino del flujo a partir del diaparador inicial en el interior de la tienda,
	 * hará falta ajustar en la plataforma de pagos para contemplar mentener el contexto al momento 
	 * de iniciar sesión. 
	 * 
	 * TO DO
	 */
	function obtener_destino($id_cliente) 
	{
		//En la invocación del login se cargará la información necesaria.
		//Por el momento pasará a una página temporal
		
		return 'categorias';
	}
	
	
	/**
	 * Verifica que exista el correo en la BD, se usa para la validación de AJAX
	 * 
	 * TO DO: verificar como se invocará...
	 */
	function consulta_mail() {
		//$value['mail']=$_GET['mail'];
		if (array_key_exists('mail', $_GET)) {
			//instanciar al modelo
			$modelo = new Login_Registro_Model();
			
			$res = $modelo->verifica_registro_email($_GET['mail']);
			
			$value['mail'] = count($res);
			
			echo json_encode($value);
			
		} else {
			echo json_encode(0);	//no hay parámetro AJAX de entrada
		}
		
	}

// Fin del controlador del login en la tienda login.php


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
			
			//echo "intentos: ". $n = $modelo->obtiene_numero_intentos(8);
			
			//echo "verifica cliente:<br/>";
			//$y = $modelo->verifica_cliente('helladyo_@hotmail.comg', 'Kali2012');
			/*echo "Cte<pre>";
			print_r($y);
			echo "</pre>";
			*/
			//cambiar_session();
			//echo "encrypt: " . $a = encrypt('helladyo_@hotmail.com|Kali2012', API_KEY);
			//echo "<br/>";
			//echo "decrypt: " . decrypt($a, API_KEY);
			//echo "<br/>";
			//$_SESSION['datos_login'] = $a;							
			//crear_sesion(8, "Kali", "helladyo_@hotmail.com");
			
			//$modelo->suma_intento_fallido(8, $n, $t);
			//exit;