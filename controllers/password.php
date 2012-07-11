<?php	/** Controlador del login en la tienda */

class Password_Controller {
		
	####### Propiedades
	private $cliente_info;		//información enviada para el registro
	private $password_errores;	//mensajes de error
	private $data;				//información que pasará a la vista
	private $modelo;			//modelo a utilizar
	
	#### Registro de cliente nuevo
	
	public function __construct() {
		$this->modelo = new Login_Registro_Model();
		$this->cliente_info = array();
		$this->password_errores = array();
		$this->data = array();
	}
	
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
	
	/**
	 * Envía la nueva contraseña al cliente
	 */
	 public function enviar() {
	 	/*echo "Enviar<pre>";
		print_r($_GET);
		print_r($_POST);
		echo "<pre>";
		exit;*/
		
		// Se verifica el correo
		if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
			//recupera el cliente							
			$datamail = $this->modelo->revisa_mail($_POST['email']);
			/*
			echo "datamail<pre>";
			print_r($datamail);
			echo "<pre>";
			*/
			//exit;
						
			if (!empty($datamail)) {	//si la dirección está registrada
				$this->data['accion'] = 'enviado';	//siguiente pantalla			
				$this->data['cliente']= $datamail;	//se pasa la información del cliente
				
				$this->data['password_temporal'] = $p = substr(md5(uniqid(rand( ), true)), 5,10);
				
				$this->data['timestamp'] = $t = date('Y/m/d h:i:s', time());
				
				
				
				$this->modelo->guardar_clave_temporal($this->data['cliente']['id_clienteIn'], $p);
				
				$this->modelo->guarda_actividad_historico($this->data['cliente']['id_clienteIn'], $p, ENUMS::$TIPO_ACTIVIDAD['SOLICITUD_PASSWORD'], $t);
				
				$encript = '';
		###################### TO DO:
				/*API::encrypt($_SESSION['id_sitio']."|".
											 $_SESSION['id_canal']."|".
											 $_SESSION['id_promocion']."|".
											 $_SESSION['guidx']."|".
											 $_SESSION['guidy']."|".
											 $_SESSION['guidz']."|", $this->api->key);
				 * */
											 
				$encript = rtrim(strtr(base64_encode($encript), '+/', '-_'), '=');
 

				$headers = "Content-type: text/html; charset=UTF-8\r\n";
                $headers .= "MIME-Version: 1.0\r\n";
			    $headers .= "From: GexWeb<servicioaclientes@expansion.com.mx>\r\n";       
				$mensaje = "<html>
						  <body>
						  	   <div>Hola,
						  	   </div>
						  	   <div>
						  	       En pagos.grupoexpansion.mx, la plataforma de pagos de Grupo Expansión, recibimos una solicitud<br />
						  	       para recuperar la contraseña asociada a este correo. Si tú hiciste esta solicitud, por favor sigue las<br />
						  	       instrucciones que aparecen abajo. Si no solicitaste cambiar tu contraseña, puedes ignorar este correo<br />
						  	       con tranquilidad, pues tu cuenta de cliente está segura.
						  	   </div>
						  	   <br /><br />
						  	   <div>
						  	   	  
						  	   	   	   1. Sigue el link de abajo para cambiar tu contraseña usando nuestro servidor seguro.<br /><br />".
						  	   	   	   //<a href='http://pagos.grupoexpansion.mx/password/verificar/".$p."/".$encript."'>https://pagos.grupoexpansion.mx/password/verificar/".$p."/".$encript."</a><br /><br />
						  	   	   	   "<a href='".TIENDA."password/verificar/".$p."/'>".TIENDA."password/verificar/".$p."/</a><br /><br />".
						  	   	   	   "Si seguir el link no funciona, puedes copiar y pegar el link en la barra de dirección de tu<br />
						  	   	   	   navegador, o reescribirla ahí.<br />
						  	   	   	   2. Ingresa la clave: ".$p."<br />
						  	   	   	   Esta no es una contraseña, pero la necesitarás para crear una nueva contraseña.<br />
						  	   	   	   3. Sigue las instrucciones que aparecen en la pantalla para crear tu nueva contraseña.
						  	   	   
						  	   </div>
						  	   <br /><br />
						  	   <div>
						  	       Si tienes alguna pregunta, por favor envía un correo a nuestra área de Atención a Clientes.<br />
						  	       (<u>servicioaclientes@expansion.com.mx</u>).
						  	   </div>
						  	   <br /><br />
						  	   <div>
						  	   	   Gracias por comprar con Grupo Expansión.
						  	   </div>
						  </body>
						  </html>"; 
														     		      									
				if (mail($this->data['cliente']['email'], "=?UTF-8?B?".base64_encode('Recuperar contraseña')."?=", $mensaje, $headers)){
					//$this->cargar_vista('', 'password', $data);	
				} else {
					$url = site_url('login');
					header("Location: $url", TRUE, 302);
					//redirect('login');	
				}
				
			}		
			else{
				$this->data['mensaje'] = 'No se encuentra en nuestra base de datos';
				//$this->cargar_vista('', 'password', $data);
			}
		} else {				
			$this->data['mensaje'] = '<div class="error2">Por favor ingresa una dirección de correo válida. Ejemplo: nombre@dominio.mx</div>';
			//$this->cargar_vista('', 'password', $data);
		}
	}	

	/**
	 * Verifica que la contraseña temporal enviada sea válida para que se pueda realizar el cambio de contraseña
	 * 
	 * Por POST debe TRAER: 
	 * 		$passtemp = '' 
	 * 		$datos_continuar = ''
	 */	 
	public function verificar() {

		$this->data['title'] = "Escribe la clave para crear una nueva contraseña";
		$this->data['proceso'] = "Escribe la clave para crear una nueva contraseña";
		
		$this->data['mensaje'] = '';
		$this->data['accion'] = 'verificar';		//siguiente pantalla para mostrar con la vista
		
		$this->data['password_temporal'] = $_POST['password_temporal'];
		########## TO DO: 
		//$datos_continuar = $_POST['datos_continuar'];
		$datos_continuar =  '';
		
		if ($datos_continuar != "") {
			$datos_continuar = base64_decode(str_pad(strtr($datos_continuar, '-_', '+/'), strlen($datos_continuar) % 4, '=', STR_PAD_RIGHT));
			$datos_decrypt = API::decrypt($datos_continuar, API::API_KEY);
			$mp = explode('|', $datos_decrypt);
			
			$_SESSION['id_sitio'] = $mp[0];
			$_SESSION['id_canal'] = $mp[1];
			$_SESSION['id_promocion'] = $mp[2];
			$_SESSION['guidx'] = $mp[3];
			$_SESSION['guidy'] = $mp[4];
			$_SESSION['guidz'] = $mp[5];				
		}
		
		if (!empty($_POST['password_temporal'])) {
			$result = $this->modelo->obtiene_cliente($_POST['password_temporal']);
			
			if (empty($result)) {
				$this->password_errores['password_temporal']='<span class="error">Clave temporal no encontrada</span>';
			}			
			else {
				foreach ($result as $key => $value) {
					$_SESSION[$key] = $value;
				}
																												
				$this->data['accion'] = 'cambiar';
			}
		}									
		else {
			$this->password_errores['password_temporal'] = '<span class="error2">Por favor ingresa una clave temporal v&aacute;lida</span>';
		}
		
		if (!empty($this->password_errores)) {
			$this->data['password_errores'] = $this->password_errores;	
		}
	}
	
	/**
	 * Cambia la contraseña del cliente
	 */
	public function cambiar() {
		
		$this->data['title'] = "Escribe una nueva contraseña";
		$this->data['proceso'] = "Escribe una nueva contraseña";
		
		$data['mensaje'] = '';	//NO SE USA	
		
		$data['accion'] = 'cambiar';
		/*
		echo "Cambiar<pre>";
		print_r($_GET);
		print_r($_POST);
		print_r($_SESSION);
		echo "<pre>";
		exit;
		*/
		if (!empty($_POST['password'])) {
			$val_pass = $this->valida_password($_SESSION['email'], $_POST['password']);
									
			if (preg_match ('/^(\w*(?=\w*\d)(?=\w*[a-z])(?=\w*[A-Z])\w*){6,20}$/', $_POST['password']) ) {
				if ($_POST['password'] != $_POST['password_2']) {
					$this->password_errores['password_2'] = 'Tus contrase&ntilde;as no coinciden';									
				} 	
				else {								
					$datos['password'] = htmlspecialchars(trim($_POST['password']));
				}
			}							
		}				
		else {
			$this->password_errores['password'] = 'Ingrese una nueva contraseña';			
		}					 
		
		if (empty($this->password_errores)) {
			$email = $_SESSION['email'];
			$id_clienteIn = $_SESSION['id_clienteIn'];
			$password = $_SESSION['password'];
			$nombre = $_SESSION['salutation'];
						
			if ($this->modelo->historico_clave($id_clienteIn, $email, $_POST['password']) != 1) {	//no se repite
				$this->modelo->cambia_password($id_clienteIn, $email, $_POST['password']);
				
				$t = date('Y/m/d h:i:s', time());
				$this->modelo->guarda_actividad_historico($id_clienteIn, $password, ENUMS::$TIPO_ACTIVIDAD['CAMBIO_PASSWORD'], $t);
				
				//se registra el evento del desbloqueo de la cuenta
				$this->modelo->desbloquear_cuenta($id_clienteIn);
				$this->modelo->guarda_actividad_historico($id_clienteIn, '', ENUMS::$TIPO_ACTIVIDAD['DESBLOQUEO'], $t);
				
				//creación de la sesión
				$array_session = array (
									'logged_in' => TRUE,
									'username' 	=> $nombre,
									'id_cliente'=> $id_clienteIn,
									'email' 	=> $email
								 );
				foreach ($array_session as $key => $value) {
					$_SESSION[$key] = $value;
				}
				//$this->session->set_userdata($array_session);				
				//redirect('forma_pago');
				$url = site_url('login'); 
				header("Location: $url", TRUE, 303);
				//redirect("login", "location", 303);
					
			} else {	//Contraseña repetida
				$this->password_errores['password'] = 'Por favor ingresa una contraseña que no coincida con ninguna de las últimas ocho contraseñas usadas';
				$this->data['password_errores'] = $this->password_errores;
				//$this->cargar_vista('', 'password',$data);
			}	
			
		} else {	//Hubo errores
			$this->data['password_errores'] = $this->password_errores;
			//$this->cargar_vista('', 'password',$data);			
		}
	}
	
	/**
	 * Recupera la información del formulario y contiene la lógica de registro.
	 * Se asume que siempre viene de una petición post
	 */
	public function registrar() {
		//prevenir que no se revise si viene de la página de login
		if (array_key_exists('tipo_inicio', $_POST)) {
			return;
		}
				
		//recupera y valida info de los campos
		$this->cliente_info = $this->get_datos_registro();
		
		//echo "Cliente Info y errores <pre>";
		//print_r($this->cliente_info);
		//print_r($this->password_errores);
		//echo "<pre>";
		
		
		if (empty($this->password_errores)) {
			//si está registrado regresa un arreglo de tres elementos con la información, si no, viene vacío
			$email_registrado = $this->modelo->verifica_registro_email($this->cliente_info['email']);
			
			if (count($email_registrado) == 0) {
				$res = $this->modelo->registrar_cliente($this->cliente_info);
				
				if ($res) {
					//echo "Cliente registrado, creando sesión";
					//exit;
					
					$this->crear_sesion($this->cliente_info['id_clienteIn'], $this->cliente_info['salutation'], $this->cliente_info['email']);	//crear sesion,
					//se va a revisar el inicio de sesión
					$url = ''; 
					header("Location: $url", TRUE, 302);
				} else {
					//echo "Cliente NO registrado";
					//exit;
					
					$this->password_errores['user_reg'] = "No se pudo realizar el registro en el sistema";
					$_POST = array();
					
					//para que se muestre el mensaje en la vista
					$this->data['password_errores'] = $this->password_errores;
				}
				
			} else {
				//Para los casos en que el IE intenta registrar dos veces al cliente.
				//echo "El Cliente YA está registrado: ".$this->cliente_info['email'];
		
				$url = site_url('registro');
				header("Location: $url", TRUE, 302);
				
				//En teoría esto no se interpreta
				$this->password_errores['user_reg'] = "Solicitaste registrarte como cliente nuevo, pero ya existe una cuenta con el correo ".$this->cliente_info['email'];
				$this->data['password_errores'] = $this->password_errores;
			}
		} else { // IF hubo errores
			//echo "Hubo errores en el formulario";
			$this->data['password_errores'] = $this->password_errores;
		}
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
			if (preg_match('/^[A-Z \'.-áéíóúÁÉÍÓÚÑñ]{1,30}$/i', $_POST['txt_nombre'])) { 
				$datos['salutation'] = $_POST['txt_nombre'];
			} else {
				$this->password_errores['txt_nombre'] = "<span class='error'>Por favor ingresa tu nombre</span>";
			}
		}
		
		if (array_key_exists('txt_apellidoPaterno', $_POST)) {
			if (preg_match('/^[A-Z \'.-áéíóúÁÉÍÓÚÑñ]{1,30}$/i', $_POST['txt_apellidoPaterno'])) { 
				$datos['fname'] = $_POST['txt_apellidoPaterno'];
			} else {
				$this->password_errores['txt_apellidoPaterno'] = "<span class='error'>Por favor ingresa tu apellido paterno</span>";
			}
		}
		
		if (array_key_exists('txt_apellidoMaterno', $_POST)) {
			if (preg_match('/^[A-Z \'.-áéíóúÁÉÍÓÚÑñ]{0,30}$/i', $_POST['txt_apellidoMaterno'])) { 
				$datos['lname'] = $_POST['txt_apellidoMaterno'];
			} else {
				$this->password_errores['txt_apellidoMaterno'] = "<span class='error2'>Por favor ingresa tu apellido materno correctamente</span>";
			}
		} else {
			$datos['lname'] = '';
		}
		
		if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {			
			$datos['email'] = htmlspecialchars(trim($_POST['email']));
		} else {			
			$this->password_errores['email'] = "<span class='error2'>Por favor ingresa un correo electrónico <br />válido. Ejemplo: nombre@dominio.mx</span>";
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
					$this->password_errores['password_2'] = "<span class='error2'>Las contraseñas ingresadas no son idénticas. Por favor intenta de nuevo.</span>";
				}
			} else {
				$this->password_errores['password'] = "<span class='error2'>Por favor ingresa una contrase&ntilde;a v&aacute;lida</span>";
			}
		} else {
			$this->password_errores['password'] = "<span class='error'>Información incompleta</span>";
		}		
		
		return $datos;
	}

	/**
	 * Validación de la contraseña para el registro
	 */
	private function valida_password($correo, $pass) {		
		$cadlogin = explode('@',$correo);
		
		if (strlen($pass) < 8) {		
			$this->password_errores['password'] = "<span class='error'>Debe contener por lo menos 8 caracteres</span>";
		}
		else {
			if (preg_match('/[^a-zA-Z0-9]/', $pass)) {
				$this->password_errores['password'] = "<span class='error'>Sólo debe incluir letras y números</span>";			
			}
			else {
				if ($cadlogin[0] == $pass) {
					$this->password_errores['password'] = "<span class='error2'>La contraseña no debe contener una parte del correo electrónico ingresado</span>";							
				}					
				else {
					if (!$this->contiene_mayuscula($pass)) {
						$this->password_errores['password'] = "<span class='error2'>Debe contener por lo menos una mayúscula</span>";					
					}	
					else {
						if (!$this->contiene_minuscula($pass)) {
							$this->password_errores['password'] = "<span class='error'>Debe contener por lo menos una minúscula</span>";						
						}
						else {
							if (!$this->contiene_numero($pass)) {
								$this->password_errores['password'] = "<span class='error'>Debe contener por lo menos un número</span>";							
							}
							else {
								if (!$this->contiene_consecutivos($pass)) {
									$this->password_errores['password'] = "<span class='error2'>No se debe incluir el mismo caracter más de 2 veces</span>";								
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

// Fin del controlador del login en la tienda /controllers/login.php
