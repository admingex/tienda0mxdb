<?php
# Importar modelo de abstracción de base de datos 
require_once('./core/db_abstract_model.php');


class Login_Registro_Model extends DBAbstractModel {

    ############################### PROPIEDADES ################################
    private $email;
	private $password;	
    private $id_clienteIn;

	############################ CONSTRUCTOR Y DESTRUCTOR #######################
    # Método constructor
    function __construct() {
		$this->db_name = 'cms0mxdb';
    }

    # Método destructor del objeto
    function __destruct() {
        unset($this);
    }
			
	//Metodos de acceso
	public function get_id_clienteIn() { return $this->id_clienteIn; }
		
    ################################# MÉTODOS ##################################
    
    ################## LOGIN ################
    /**
	 * Verificar que el email esté o no registrado.
	 * Regresa un array con la información.
	 * Si no encuentra el correo regresa un array vacío: isset($e) === TRUE
	 */
    public function verifica_registro_email($email='') {
		$this->query = "SELECT id_clienteIn, email, COALESCE(LastLockoutDate,'0000-00-00 00:00:00') AS LastLockoutDate 
						FROM CMS_IntCliente
						WHERE email = '" . $email. "' LIMIT 1";

		//regresa un array
		$this->get_results_from_query();
		
		//Si encontró resultado lo devuelve, si no, regresa un array vacío
		if (count($this->rows) > 0) {
			return $this->rows[0];
		} else {
			return $this->rows;
		}
	}
    
	/**
	 * Desbloquea la cuenta del usuario para que intente loggearse
	 */
	function desbloquear_cuenta($id_cliente) {								
		$this->query = "UPDATE  CMS_IntCliente SET FailedPasswordAttemptCount = NULL, LastLockoutDate = NULL  WHERE id_clienteIn = '" . $id_cliente . "'";
		//regresa TRUE ó FALSE dependiendo de si se ejecutó correctamente o no 
		$res = $this->execute_single_query();
		
		return $res;				
	}
    
    /**
	 * Número de intentos que el usuario ha utilizado para intentar iniciar sesión
	 */
	function obtiene_numero_intentos($id_cliente) {
		$this->query = "SELECT COALESCE(FailedPasswordAttemptCount, 0) AS FailedPasswordAttemptCount FROM CMS_IntCliente WHERE id_clienteIn = " . $id_cliente;
		
		print_r($this->get_results_from_query($this->query));
		
		$intentos = 0;
		
		if (!empty($this->rows)) {	//count($this->rows > 0)
			$intentos = $this->rows[0]['FailedPasswordAttemptCount'];
		}
		
		/*
		echo "cte:  $id_cliente<br/>". $this->rows[0]['FailedPasswordAttemptCount'];
		echo "<pre>";
		print_r($this->rows);
		echo "</pre>$this->query<br/>";
		*/
		//exit;
		return $intentos;
	}
	
	/**
	 * Verifcar el cliente en el sistema
	 * Regresa si encuentra al cliente:
	 * id_clienteIn as id_cliente, salutation as nombre, email, password
	 */
	function verifica_cliente($email = '', $password = '')
	{
		$m5_pass = md5($email.'|'.$password);		//encriptación definida en el registro de usuarios
		$this->query = " 
				SELECT id_clienteIn as id_cliente, salutation as nombre, email, password
				FROM CMS_IntCliente
				WHERE email = '" . $email . "' AND password = '" . $m5_pass . "'
				LIMIT 1
				";
		
				
		$this->get_results_from_query();
		
		if (count($this->rows) == 1) {
			//echo "<pre>";
			return $this->rows[0];	//regresa el registro si es que lo encontró
			//echo "</pre>";
		} else {	//si no encontró nada regresa un array vacío
			//echo "está vacio " . empty($this->rows);		
			return $this->rows;
		}
	}
	
	/**
	 * Regresa la Suma de los intentos fallidos de inicio de sesión
	 * Ok
	 */
	function suma_intento_fallido($id_cliente, $num_intentos, $t){						
		$numin = $num_intentos + 1;		
		
		$this->query = "UPDATE CMS_IntCliente SET FailedPasswordAttemptCount = " . $numin .", LastLockoutDate = '" . $t . "' WHERE id_clienteIn = " . $id_cliente;
		
		$res = $this->execute_single_query($this->query);
		//TRUE / FALSE
		return $res;				
	}

	############### PASSWORD / CONTRASEÑA #######################
	/**
	 * Registrar la actividad del cliente en la base
	 * Ok
	 */
	function guarda_actividad_historico($id_cliente, $clave, $actividad, $time) {
		$this->query = "INSERT INTO CMS_IntHistoricoCliente (id_clienteIn, claveVc, id_tipoActividadSi, timestampTs) VALUES (" . $id_cliente .", '".
						$clave . "', ". $actividad . ", '". $time . "')";

		#### TO DO : $mysqli->affected_rows

		return $this->execute_single_query();		
	}
	
	/**
	 * Verifica que el correo exista en la BD
	 */
	function revisa_mail($email = '') {
		$this->query = "SELECT * FROM CMS_IntCliente WHERE email = '".$email."' LIMIT 1";
		$this->get_results_from_query();
		
		if (count($this->rows) == 1) {
			return $this->rows[0];		//regresa el registro si es que lo encontró
		} else {	//si no encontró nada regresa un array vacío
			return $this->rows;
		}
	}
	
	/**
	 * Almacena la clave temporal asignada al cliente en la BD
	 */
	function guardar_clave_temporal($id_cliente, $clave) {
		$this->query = "UPDATE CMS_IntCliente SET clave_temporalVc = '" . $clave . "' WHERE id_clienteIn = " . $id_cliente;
		
		return $this->execute_single_query();
	}
	
	/**
	 * Cambia la contraseña del cliente
	 */
	function cambia_password($id_cliente, $email, $password){
		$pass = md5($email.'|'.$password);
		
		$this->query = "UPDATE CMS_IntCliente SET clave_temporalVc = NULL, password = '". $pass . "' WHERE id_clienteIn = " . $id_cliente;
		
		return $this->execute_single_query();
	}
	
	/**
	 * Regresa el cliente de acuerdo a la clave temporal
	 */
	function obtiene_cliente($clave_temporal) {					
		$this->query = "SELECT * FROM CMS_IntCliente WHERE clave_temporalVc = '".$clave_temporal."'";
		$this->get_results_from_query();
		
		if (count($this->rows) == 1) {
			return $this->rows[0];		//regresa el registro si es que lo encontró
		} else {	//si no encontró nada regresa un array vacío
			return $this->rows;
		}
	}
	
	/**
	 * Revisa que no se repita la nueva contraseña
	 */
	function historico_clave($id_cliente, $email, $passw) {
		$this->query = "SELECT * FROM CMS_IntHistoricoCliente WHERE id_clienteIn = ".$id_cliente." && id_tipoActividadSi = 3";
		
		$this->get_results_from_query();
		
				
		if (count($this->rows) > 0 && (count($this->rows) < 8)) {
			$pass = md5($email.'|'.$passw);
			
			foreach ($this->rows as $row) {
				if ($row['claveVc'] == $pass) {
					return 1;
				}
			}
		} else {
			return 0;
		}
	}
	
	################## REGISTRO ################
	/**
	 * Registra la información de un cliente en la BD
	 */
	function registrar_cliente($cliente = array())
    {
    	//password encriptado
    	$m5_pass = md5($cliente['email'].'|'.$cliente['password']);		//encriptaciónn definida en el registro de usuarios
		
		//llamada al SP_Registrar_Cliente(nombre, ap_P, ap_M, email, pass)
		$this->query = "CALL SP_Registrar_Cliente('" . $cliente['salutation'] . "', '" . $cliente['fname'] ."', '" .
						$cliente['lname'] . "', '" . $cliente['email'] . "', '". $m5_pass . "')";
		
        return $this->execute_single_query();		//true si se inserta
    }
	
	/**
	 * Esta función ya no se ocupa, se llama al SP que se enecarga de obtener un id y  registrara la información
	 * NO SE USA
	 */	
	function next_cliente_id()
	{
		$this->quuery = "SELECT MAX(id_clienteIn) as consecutivo 
						FROM  CMS_IntCliente";
		
		$this->get_results_from_query();
		
		if (count($this->rows) == 1) {
			//echo "<pre>";
			return $this->rows[0]['consecutivo'] + 1;	//regresa el registro si es que lo encontró
			//echo "</pre>";
		} else {	//si no encontró nada regresa un array vacío
			//echo "está vacio " . empty($this->rows);		
			return 0;
		}
		
		$row = $res->row();	//regresa un objeto
		
		if(!$row->consecutivo)	{//si regresa null
			return 0;
		} else {
			return $row->consecutivo + 1;	
		}
	}
	
	################### END TIENDA ###########################
	
}
