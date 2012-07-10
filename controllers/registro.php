<?php	/** Controlador del login en la tienda */

class Registro_Controller {
		
	####### Propiedades
	private $cliente_info;		//información enviada para el registro
	private $registro_errores;	//mensajes de error
	private $modelo;					//modelo a utilizar
	
	#### Registro de cliente nuevo
	
	public function __construct() {
		$this->modelo = new Login_Registro_Model();
		$this->cliente_info = array();
		$this->registro_errores = array();
	}
	
	/**
	 * Recupera la información del formulario y contiene la lógica de registro.
	 * Se asume que siempre viene de una petición post
	 */
	public function registrar() {
		
		//recupera y valida info de los campos
		$this->cliente_info = $this->get_datos_registro();
		
		echo "<pre>";
		print_r($this->cliente_info);
		print_r($this->registro_errores);
		echo "<pre>";
		
		
		if (empty($this->registro_errores)) {
			//si está registrado regresa un arreglo de tres elementos con la información, si no, viene vacío
			$email_registrado = $this->modelo->verifica_registro_email($this->cliente_info['email']);
			
			echo "email?: " . $email_registrado;
			echo "<pre>";
			print_r($email_registrado);
			echo "<pre>".count($email_registrado);
			//exit;
			//email no está registrado
			if (count($email_registrado) == 0) {
		##### TO DO Esto debe quedar en el sp
				$this->cliente_info['id_clienteIn'] = $this->modelo->next_cliente_id();	//id del cliente
				exit;	
				$res = $this->modelo->registrar_cliente($this->cliente_info);
				/*$m5_pass = md5($this->cliente_info['email'].'|'.$this->cliente_info['password']);		//encriptaciónn definida en el registro de usuarios
				$this->cliente_info['password'] = $m5_pass;
				//$qry="INSERT INTO CMS_IntCliente (id_clienteIn, salutation, fname, lname, email, password) VALUES (".$this->cliente_info['id_clienteIn'].", 'giso', 'est', 'ale', 'ddd@ddd.com', '0520d2ac03685b061076ffeaaa2557a2')";
				//$res = mysql_query($qry);
    			$res= $this->db->insert('CMS_IntCliente', $this->cliente_info);		//true si se inserta
    			echo "resultado del query:".$res;        			
				*/
				//if($this->modelo->registrar_cliente($this->cliente_info)) {							//registro exitoso
				if($res){	
					$this->crear_sesion($this->cliente_info['id_clienteIn'], $this->cliente_info['salutation'], $this->cliente_info['email']);	//crear sesion,
					//se va a revisar el inicio de sesión
					//$url = $this->config->item('base_url').'/index.php/forma_pago/'; 
					//header("Location: $url");						
					redirect('login', 'location', 302);
					$_POST = array();	
					exit();					
				} else {
					$this->registro_errores['user_reg'] = "No se pudo realizar el registro en el sistema";
					$_POST = array();
					$this->cargar_vista('', 'registro', $data);
				}
				
			} else {
				//$url = site_url('registro');
				//header("Location: $url", TRUE, 302);
				$this->registro_errores['user_reg'] = "Solicitaste registrarte como cliente nuevo, pero ya existe una cuenta con el correo ".$this->cliente_info['email'];
				$data['login_errores'] = $this->registro_errores;
				//$this->cargar_vista('', 'registro', $data);
			}
		} else { // IF hubo errores
			$data['login_errores'] = $this->registro_errores;
			//cargar_vista('login', $data);
			//exit;
		}
			echo "<pre>";
			print_r($this->registro_errores);
			echo "<pre>";
	}
	#### END Registro de cliente nuevo
	
############## MÉTODOS ##############################
	
	/**
	 * Recuperación de los datos para el inicio de sesión
	 * Ok
	 */
	private function get_datos_registro()
	{
		$datos = array();
		
		if (array_key_exists('txt_nombre', $_POST)) {
			if (preg_match('/^[A-Z \'.-áéíóúÁÉÍÓÚÑñ]{2,30}$/i', $_POST['txt_nombre'])) { 
				$datos['salutation'] = $_POST['txt_nombre'];
			} else {
				$this->registro_errores['txt_nombre'] = "<span class='error'>Por favor ingresa tu nombre</span>";
			}
		}
		if (array_key_exists('txt_apellidoPaterno', $_POST)) {
			if (preg_match('/^[A-Z \'.-áéíóúÁÉÍÓÚÑñ]{2,30}$/i', $_POST['txt_apellidoPaterno'])) { 
				$datos['fname'] = $_POST['txt_apellidoPaterno'];
			} else {
				$this->registro_errores['txt_apellidoPaterno'] = "<span class='error'>Por favor ingresa tu apellido paterno</span>";
			}
		}		
		if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {			
			$datos['email'] = htmlspecialchars(trim($_POST['email']));
		} else {			
			$this->registro_errores['email'] = "<span class='error2'>Por favor ingresa un correo electrónico <br />válido. Ejemplo: nombre@dominio.mx</span>";
		}
		if (isset($_POST['email']) && isset($_POST['password'])) {
			if ($_POST['email']!="") {
				$pass_info = $this->valida_password($_POST['email'], $_POST['password']);	
			}
			//Contraseña válida en el primer campo			
			if (preg_match ('/^(\w*(?=\w*\d)(?=\w*[a-z])(?=\w*[A-Z])\w*){6,20}$/', $_POST['password']) ) {
				if ($_POST['password'] == $_POST['password_2']) {
					$datos['password'] = htmlspecialchars(trim($_POST['password']));
				} else {
					$this->registro_errores['password_2'] = "<span class='error2'>Las contraseñas ingresadas no son idénticas. Por favor intenta de nuevo.</span>";
				}
			} else {
				$this->registro_errores['password'] = "<span class='error2'>Por favor ingresa una contrase&ntilde;a v&aacute;lida</span>";
			}
		} else {
			$this->registro_errores['password'] = "<span class='error'>Información incompleta</span>";
		}		
		
		return $datos;
	}

	/**
	 * Validación de la contraseña para el registro
	 */
	private function valida_password($correo, $pass) {		
		$cadlogin = explode('@',$correo);
		
		if (strlen($pass) < 8) {		
			$this->registro_errores['password'] = "<span class='error'>Debe contener por lo menos 8 caracteres</span>";
		}
		else {
			if (preg_match('/[^a-zA-Z0-9]/', $pass)) {
				$this->registro_errores['password'] = "<span class='error'>Sólo debe incluir letras y números</span>";			
			}
			else {
				if ($cadlogin[0] == $pass) {
					$this->registro_errores['password'] = "<span class='error2'>La contraseña no debe contener una parte del correo electrónico ingresado</span>";							
				}					
				else {
					if (!$this->contiene_mayuscula($pass)) {
						$this->registro_errores['password'] = "<span class='error2'>Debe contener por lo menos una mayúscula</span>";					
					}	
					else {
						if (!$this->contiene_minuscula($pass)) {
							$this->registro_errores['password'] = "<span class='error'>Debe contener por lo menos una minúscula</span>";						
						}
						else {
							if (!$this->contiene_numero($pass)) {
								$this->registro_errores['password'] = "<span class='error'>Debe contener por lo menos un número</span>";							
							}
							else {
								if (!$this->contiene_consecutivos($pass)) {
									$this->registro_errores['password'] = "<span class='error2'>No se debe incluir el mismo caracter más de 2 veces</span>";								
								}
								else {
									$datos['password'] = htmlspecialchars(trim($pass));
								}
							}
						}
					}
				}
			}
		}
	}
	
	/**
	 * Revisa si la cadena contiene una letra mayúscula
	 */
	private function contiene_mayuscula($cad) {
		$may = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		for ($i = 0; $i < strlen($cad); $i++) {
			if (strstr($may, $cad[$i])) {
				return TRUE;		
			}
		}	
		return FALSE;
	}
	
	/**
	 * Revisa si la cadena contiene una letra minúscula
	 */
	private function contiene_minuscula($cad) {
		$min = 'abcdefghijklmnopqrstuvwxyz';
		for ($i = 0; $i < strlen($cad); $i++) {
			if (strstr($min, $cad[$i])) {
				return TRUE;		
			}
		}	
		return FALSE;
	}

	/**
	 * Revisa si la cadena contiene un número
	 */
	private function contiene_numero($cad) {
		$num = '0123456789';
		for ($i = 0; $i < strlen($cad); $i++) {
			if (strstr($num, $cad[$i])) {
				return TRUE;		
			}
		}	
		return FALSE;
	}
	
	/**
	 * Revisa si la cadena contiene dos caracteres consecutivos
	 */
	private function contiene_consecutivos($cad) {
		for ($i = 2; $i < strlen($cad); $i++) {		
			$term0 = $cad[($i-2)];
			$term1 = $cad[($i-1)];
			$term2 = $cad[$i];									
			if(($term0 == $term1) && ($term1 == $term2)) {
				return FALSE;
			}		     		            			  		
	   	}   	
	   	return TRUE;
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
	public function obtener_destino($id_cliente) 
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
	 * Verifica la sesión del cliente, si no es válida, lo saca a la tienda
	 * por default el destino está vacío.
	 * 
	 */
	public function redirect_cliente_invalido($revisar = 'id_cliente', $destino = '', $protocolo = 'http://') {
		if (!$this->session->userdata($revisar)) {
			//$url = $protocolo . BASE_URL . $destination; // Define the URL.
			$url = site_url($destino); // Define the URL.
			header("Location: $url");
			
			exit(); // Quit the script.
		}
	}
	
############## END MÉTODOS ##############################
}

// Fin del controlador del login en la tienda login.php