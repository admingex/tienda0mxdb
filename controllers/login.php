<?php	/** Controlador del login en la tienda */

//mensajes de error
$login_errores = array();

//Es cliente nuevo 
if (array_key_exists('tipo_inicio', $_POST) && $_POST['tipo_inicio'] == NUEVO) {
	$url = site_url('registro');
	header("Location: $url");	
	exit();
} else {	//Es cliente registrado
	//Instanciar al modelo
	$modelo = new Login_Registro_Model();
	
	//recupera y valida info de los campos
	$login_info = array();
	$login_info = get_datos_login();
	
	if (empty($login_info['login_errores'])) {
		//verificar que el usuario esté registrado
		$email 		= $login_info['email'];
		$password 	= $login_info['password'];
		$mail_cte	= $modelo->verifica_registro_email($email);
																				
		if (count($mail_cte) != 0) {
			$fecha_lock = $mail_cte['LastLockoutDate'];
			$id_cliente = $mail_cte['id_clienteIn'];
			
			if ($fecha_lock != '0000-00-00 00:00:00' && $fecha_lock != NULL) {
				//Checa si puede intentar iniciar sesión
				if (tiempo_desbloqueo($fecha_lock)) {
					$modelo->desbloquear_cuenta($id_cliente);
					//hora actual
					$t = date('Y/m/d h:i:s', time());
					
					$modelo->guarda_actividad_historico($id_cliente, '', $TIPO_ACTIVIDAD['DESBLOQUEO'], $t);							
				}
			}
			//Obtener la cuenta de los intentos realizados
			$num_intentos = $modelo->obtiene_numero_intentos("'".$id_cliente."'");	
			
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
					echo "¡Sesión iniciada!";
					
					/*echo "Sesión:<pre>";
					print_r($_SESSION); 
					echo "<pre>";
					 * */
					exit;
					
				} else {	//No está correcta la información para iniciar sesión
					//echo "Error en el login<br/>";
					$login_errores['user_login'] = "Hubo un error con la combinación ingresada de correo y contraseña. Por favor intenta de nuevo.";
																							
					$t = date('Y/m/d h:i:s', time());
					//Registra el intento y el password con el que se intentó iniciar sesión
					$modelo->guarda_actividad_historico($id_cliente, $password, $TIPO_ACTIVIDAD['ACCESO_INCORRECTO'], $t);
												
					//TRUE / FALSE :
					$modelo->suma_intento_fallido($id_cliente, $num_intentos, $t);
				
					//se carga la vista de nuevo
					$data['login_errores'] = $login_errores;
					//cargar_vista('login', $data);
					//exit;
				}
			} else {	// IF número de intentos < 3
			
				if ($num_intentos == 3) {
					$t = date('Y/m/d h:i:s', time());
					
					//Registra el intento y el bloqueo
					$modelo->guarda_actividad_historico($id_cliente, '', $TIPO_ACTIVIDAD['BLOQUEO'], $t);
					//TRUE / FALSE :
					$modelo->suma_intento_fallido($id_cliente, $num_intentos, $t);	
				}
				
				$login_errores['user_login'] = "Ha excedido el número máximo de intentos permitidos para iniciar sesión. Su cuenta permanecerá bloqueada por 30 minutos";
				//se carga la vista de nuevo
				$data['login_errores'] = $login_errores;
				//cargar_vista('login', $data);
				//exit;
			}
									
		} else { 	// IF existe el correo enviado						
			$login_errores['user_login'] = "Esta dirección de correo no está registrada. Por favor intenta de nuevo o regístrate en el sitio.";
			//cargar_vista('login', $data);
			//exit;																																					
			//$data['mensaje'] = "Correo o contrase&ntilde;a incorrectos";
		}
	} else { // IF hubo errores
		$data['login_errores'] = $login_info['login_errores'];
		//cargar_vista('login', $data);
		//exit;
	}	
}	// ELSE-If es cliente registrado

############## CONTROLLER'S FUNCTIONS ##############################

	######################## LOGIN ################################
	/**
	 * Recuperación de los datos para el inicio de sesión
	 * Ok
	 */
	function get_datos_login()
	{
		$login_errores = array();
		$datos = array();
		
		if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
			$datos['email'] = htmlspecialchars(trim($_POST['email']));
			//echo "mail: ".$_POST['email']."<br/>";
		} else {
			$login_errores['email'] = '<div class="error2">Por favor ingresa una dirección de correo válida. Ejemplo: nombre@dominio.mx </div>';
		}
		
		if (array_key_exists('tipo_inicio', $_POST) && $_POST['tipo_inicio'] == 'registrado') {
			if (!empty($_POST['password'])) {
				$datos['password'] = htmlspecialchars(trim($_POST['password']));
			} else {
				$login_errores['password'] = '<div class="error2">Por favor escribe tu contraseña o selecciona iniciar sesión como cliente nuevo.</div>';
			}					
		} else {
			$login_errores['user_login'] = 'Selecciona alguna modalidad';
		}
		
		$datos['login_errores'] = $login_errores;	
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
		
		//hora, minutos, segundos, mes, día, año
		$fecha_lock_unix = mktime($hor, $min, $seg, $mes, $dia, $ano);
		
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
	
	/**
	 * Verifica la sesión del cliente, si no es válida, lo saca a la tienda
	 * por default el destino está vacío.
	 * 
	 */
	function redirect_cliente_invalido($revisar = 'id_cliente', $destino = '', $protocolo = 'http://') {
		if (!$this->session->userdata($revisar)) {
			//$url = $protocolo . BASE_URL . $destination; // Define the URL.
			$url = site_url($destino); // Define the URL.
			header("Location: $url");
			
			exit(); // Quit the script.
		}
	}
	
	/**
	 * Si ya se cargó la sesión del cliente después de un registro o una recuperación de contraseña
	 */
	function verificar_inicio_sesion($id_cliente) {
		if ($_SESSION['id_cliente'] == $id_cliente) {
				
			//por defaulr no se considera la dirección d facturación
			$_SESSION['requiere_factura'] = 'no';
			
##### TO DO //detecta a dónde va el usuario a partir de la promoción que se tiene en sesión
			$destino = $this->obtener_destino($cliente->id_cliente);						
			
			//colocar en sessión el destino
			$_SESSION['destino'] = $destino;
			
			//Flujo
			header("Location: $url", TRUE, 302);
			redirect($destino, 'location', 303);
		}
	}
// Fin del controlador del login en la tienda login.php