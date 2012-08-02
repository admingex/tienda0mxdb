<?php	/** Controlador del login en la tienda */

class Registro_Controller {
		
	####### Propiedades
	private $login_info;		//información enviada para el registro
	private $login_errores;		//mensajes de error
	private $data;				//información que pasará a la vista
	private $modelo;			//modelo a utilizar
	
	#### Registro de cliente nuevo
	
	/**
	 * Constructor
	 */
	
	public function __construct() {
		$this->modelo = new Login_Registro_Model();
		$this->login_info = array();
		$this->login_errores = array();
		$this->data = array();
	}
	
	############# Métodos de Acceso ####################
	/**
	 * Regresa el arreglo con información para mostrar la vista
	 */
	public function get_data() {
		return $this->data;
	}
	
	/**
	 * Asigna un elemento del arreglo destinado a pasar información a la vista
	 */
	public function set_data($clave, $valor) {
		$this->data[$clave] = $valor;
	}
	############# END Métodos de Acceso ####################
	
	/**
	 * Manejo de las peticiones por POST del inicio de sesión en la tienda
	 */
	public function login() {
		if (array_key_exists('tipo_inicio', $_POST) && $_POST['tipo_inicio'] == NUEVO) {
			//si es cliente nuevo
			$url = site_url('registro');
			header("Location: $url");	
			exit;
		} else {	//es cliente registrado
			
			//recupera y valida info de los campos
			$this->login_info = $this->get_datos_login();
			
			if (empty($this->login_errores)) {
				//verificar que el usuario esté registrado
				$email 		= $this->login_info['email'];
				$password 	= $this->login_info['password'];
				
				$mail_cte	= $this->modelo->verifica_registro_email($email);
																						
				if (count($mail_cte) != 0) {
					$fecha_lock = $mail_cte['LastLockoutDate'];
					$id_cliente = $mail_cte['id_clienteIn'];
					
					if ($fecha_lock != '0000-00-00 00:00:00' && $fecha_lock != NULL) {
						//Checa si puede intentar iniciar sesión
						if ($this->tiempo_desbloqueo($fecha_lock)) {
							$this->modelo->desbloquear_cuenta($id_cliente);
							//hora actual
							$t = date('Y/m/d h:i:s', time());
							
							$this->modelo->guarda_actividad_historico($id_cliente, '', ENUMS::$TIPO_ACTIVIDAD['DESBLOQUEO'], $t);							
						}
					}
					//Obtener la cuenta de los intentos realizados
					$num_intentos = $this->modelo->obtiene_numero_intentos($id_cliente);
					
					if ($num_intentos < 3) {
						//si el cliente existe, lo regresa en un arreglo: id_clienteIn as id_cliente, salutation as nombre, email, password
						$cliente = $this->modelo->verifica_cliente($email, $password);							
						
						if (count($cliente) > 0) {	//si no es un arreglo vacío: SI !empty($resultado)
							
				########TO TO: //Resguardar la información de la promoción
							
							//destruir la sesión de PHP y mandar la información en la sesión de CI con un nuevo ID
							$this->cambiar_session();
							
							//encryptar login y pass y guardarlo en session											
							//$cliente = $resultado->row();
							$dl = API::encrypt($cliente['email']."|".$password."|", API::API_KEY);
							//session PHP
							$_SESSION['datos_login'] = $dl;
							
							//se crea la sessión con la información del cliente
							$this->crear_sesion($cliente['id_cliente'], $cliente['nombre'], $email);	//crear sesion
							
							//por defaulr no se considera la dirección de facturación
							$_SESSION ['requiere_factura'] = 'no';
							
							//detecta a donde va el ususario a partir de la promoción que se tiene en sesión
							$destino = $this->obtener_destino($cliente['id_cliente']);
							
							//colocar en sesión el destino
							$_SESSION['destino'] = $destino;
							
							//Flujo
							//redirect($destino);
							$url = site_url($destino); // Define the URL.
			###### TO DO:	//header("Location: $url", TRUE, 302);
							//echo "¡Sesión iniciada!".$url;
							//print_r($_SESSION);
							//exit;													
							header("Location: $url");							
							
						} else {	//No está correcta la información para iniciar sesión
							//echo "Error en el login<br/>";
							$this->login_errores['user_login'] = "Hubo un error con la combinación ingresada de correo y contraseña. Por favor intenta de nuevo.";
																									
							$t = date('Y/m/d h:i:s', time());
							//Registra el intento y el password con el que se intentó iniciar sesión
							$this->modelo->guarda_actividad_historico($id_cliente, $password, ENUMS::$TIPO_ACTIVIDAD['ACCESO_INCORRECTO'], $t);
														
							//TRUE / FALSE :
							$this->modelo->suma_intento_fallido($id_cliente, $num_intentos, $t);
						
							//se carga la vista de nuevo
							$this->data['login_errores'] = $this->login_errores;
							//cargar_vista('login', $data);

						}
					} else {	// IF número de intentos < 3
					
						if ($num_intentos == 3) {
							$t = date('Y/m/d h:i:s', time());
							
							//Registra el intento y el bloqueo
							$this->modelo->guarda_actividad_historico($id_cliente, '', ENUMS::$TIPO_ACTIVIDAD['BLOQUEO'], $t);
							//TRUE / FALSE :
							$this->modelo->suma_intento_fallido($id_cliente, $num_intentos, $t);	
						}
						
						$this->login_errores['user_login'] = "Ha excedido el número máximo de intentos permitidos para iniciar sesión. Su cuenta permanecerá bloqueada por 30 minutos";
						$this->data['login_errores'] = $this->login_errores;
						//cargar_vista('login', $data);
						//exit;
					}
											
				} else { 	// IF existe el correo enviado						
					$this->login_errores['user_login'] = "Esta dirección de correo no está registrada. Por favor intenta de nuevo o regístrate en el sitio.";
					$this->data['login_errores'] = $this->login_errores;
					//cargar_vista('login', $data);
				}
			} else { // IF hubo errores
				$this->data['login_errores'] = $this->login_errores;
				//cargar_vista('login', $data);
			}	
		}// ELSE-If es cliente registrado			
	}
	
	/**
	 * Verifica que exista el correo en la BD, se usa para la validación de AJAX
	 * 
	 * TO DO: verificar como se invocará...
	 */
	public function consulta_mail() {
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
	 * Recupera la información enviada por medio del POST
	 */
	private function get_datos_login()
	{
		//$this->login_errores = array();
		$datos = array();
		
		if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
			$datos['email'] = htmlspecialchars(trim($_POST['email']));
			//echo "mail: ".$_POST['email']."<br/>";
		} else {
			$this->login_errores['email'] = '<div class="error2">Por favor ingresa una dirección de correo válida. Ejemplo: nombre@dominio.mx </div>';
		}
		
		if (array_key_exists('tipo_inicio', $_POST) && $_POST['tipo_inicio'] == 'registrado') {
			if (!empty($_POST['password'])) {
				$datos['password'] = htmlspecialchars(trim($_POST['password']));
			} else {
				$this->login_errores['password'] = '<div class="error2">Por favor escribe tu contraseña o selecciona iniciar sesión como cliente nuevo.</div>';
			}					
		} else {
			$this->login_errores['user_login'] = 'Selecciona alguna modalidad';
		}
		
		//$datos['login_errores'] = $login_errores;	
		return $datos;
	}
	
	/**
	 * Toma la fecha, la pasa a UNIX, le suma 30 minutos y verifica con la hora actual
	 * Ok 
	 */
	private function tiempo_desbloqueo($fecha_lock)
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
	private function cambiar_session()
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
	private function crear_sesion($id_cliente, $nombre, $email)
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
	private function obtener_destino($id_cliente) 
	{
		//En la invocación del login se cargará la información necesaria.
		//Por el momento pasará a una página temporal
		return 'promociones-especiales.php';		
	}
	
	/**
	 * Verifica la sesión del cliente, si no es válida, lo saca a la tienda
	 * por default el destino está vacío.
	 * 
	 */
	private function redirect_cliente_invalido($revisar = 'id_cliente', $destino = '', $protocolo = 'http://') {
		if (!$_SESSION[$revisar]) {
			//$url = $protocolo . BASE_URL . $destination; // Define the URL.
			$url = site_url($destino); // Define the URL.
			header("Location: $url");
			
			exit(); // Quit the script.
		}
	}
	
	/**
	 * Si ya se cargó la sesión del cliente después de un registro o una recuperación de contraseña
	 */
	private function verificar_inicio_sesion($id_cliente) {
		if ($_SESSION['id_cliente'] == $id_cliente) {
				
			//por defaulr no se considera la dirección d facturación
			$_SESSION['requiere_factura'] = 'no';
			
##### TO DO //detecta a dónde va el usuario a partir de la promoción que se tiene en sesión
			$destino = $this->obtener_destino($cliente->id_cliente);						
			
			//colocar en sessión el destino
			$_SESSION['destino'] = $destino;
			
			//Flujo
			header("Location: $url", TRUE, 302);
			//redirect($destino, 'location', 303);
		}
	}
	
}

// Fin de la clase del controlador del login en la tienda login.php
