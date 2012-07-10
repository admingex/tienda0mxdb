<?php
# Importar modelo de abstracción de base de datos 
require_once('./core/db_abstract_model.php');


class Login_Registro_Model extends DBAbstractModel {

    ############################### PROPIEDADES ################################
    private $email;
	private $password;
	
    private $id_clienteIn;
    private $nombreVc;
    private $telefonoVc;
	private $direccionVc;
	private $emailVc;
    private $cpCh;
	private $fechaRegistroDt;

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
    public function get_nombreVc() { return $this->nombreVc; }
	public function get_telefonoVc() { return $this->telefonoVc; }
	public function get_direccionVc() { return $this->direccionVc; }
	public function get_emailVc() { return $this->emailVc; }
    public function get_cpCh() { return $this->cpCh; }
	public function get_fechaRegistroDt() { return $this->fechaRegistroDt; }
		
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
		
		//echo count($this->rows)." qey: ". $this->query." correo ".$email;
		/*
		echo "<pre>";
		print_r($this->rows);
		echo "</pre>";
		 */
		//exit();
		
		
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
		
		$this->query = "UPDATE  CMS_IntCliente SET FailedPasswordAttemptCount = " . $numin .", LastLockoutDate = '" . $t . "' WHERE id_clienteIn = " . $id_cliente;
		
		$res = $this->execute_single_query($this->query);
		//TRUE / FALSE
		return $res;				
	}
	######################### PASSWORD #######################
	/**
	 * Registrar la actividad en la base
	 * Ok
	 */
	function guarda_actividad_historico($id_cliente, $clave, $actividad, $time) {
		$this->query = "INSERT INTO CMS_IntHistoricoCliente (id_clienteIn, claveVc, id_tipoActividadSi, timestampTs) VALUES (" . $id_cliente .", '".
						$clave . "', ". $actividad . ", '". $time . "')";

		//$mysqli->affected_rows
		//echo "save $this->query";
		return $this->execute_single_query();		
	}
	
	
	################## REGISTRO Y CONTRASEÑA ################
	/**
	 * Registra la información de un cliente en la BD
	 */
	function registrar_cliente($cliente = array())
    {
    	//password encriptado
    	$m5_pass = md5($cliente['email'].'|'.$cliente['password']);		//encriptaciónn definida en el registro de usuarios
    	//echo "Cliente<pre>";
		//print_r($cliente);
		//echo "<pre>".$m5_pass;
		
		
		//llamada al SP_Registrar_Cliente(nombre, ap_P, ap_M, email, pass)
		$this->query = "CALL SP_Registrar_Cliente('" . $cliente['salutation'] . "', '" . $cliente['fname'] ."', '" .
						$cliente['lname'] . "', '" . $cliente['email'] . "', '". $m5_pass . "')";
		
		//echo "<br/>query: " . $this->query;
		
        return $this->execute_single_query();		//true si se inserta
    }
	
	/**
	 * Esta función ya no se ocupa, se llama al SP que se enecarga de obtener un id y  registrara la información
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
	
    #recupera las publicaciones para colocarlas en el archivo JSON
    public function get_publicaciones() {
    	$this->query = "
            SELECT id_clienteIn, nombreVc, telefonoVc, direccionVc, 
											emailVc, cpCh, fechaRegistroDt
            FROM   cliente 
            WHERE  emailVc = '$email'
        ";
		
        $this->get_results_from_query();
    }
    
    # Traer datos de un cliente
    public function read($datos_cliente=array()) {
        if(array_key_exists('emailVc', $datos_cliente) &&
					($email = $datos_cliente['emailVc']) != '') {
            $this->query = "
                SELECT id_clienteIn, nombreVc, telefonoVc, direccionVc, 
												emailVc, cpCh, fechaRegistroDt
                FROM   cliente 
                WHERE  emailVc = '$email'
            ";
            $this->get_results_from_query();
        }
				
        if(count($this->rows) == 1) {
            foreach ($this->rows[0] as $propiedad=>$valor) {
                $this->$propiedad = $valor;
            }	
            $this->mensaje_db = 'Cliente encontrado';
        } else {
            $this->mensaje_db = 'No hubo coincidencias';
        }
    }
		
	public function read_buscar($datos_cliente=array(), $limit='') {
        if(array_key_exists('nombreVc', $datos_cliente) || 
					array_key_exists('emailVc', $datos_cliente) ||
					array_key_exists('cpCh', $datos_cliente) ) {
            $this->query = "
                SELECT id_clienteIn, nombreVc, telefonoVc, direccionVc, 
											cpCh, emailVc, fechaRegistroDt
                FROM   cliente 
                WHERE  
								nombreVc = '".$datos_cliente['nombreVc']."' OR 
								emailVc = '".$datos_cliente['emailVc']."' OR 
								cpCh = '".$datos_cliente['cpCh']."'
            ";
						if(!empty($limit))
							$this->query .= "$limit";
            $this->get_results_from_query();
        }
        if(count($this->rows) >= 1) {
						$clientes = array();
            foreach ($this->rows as $cliente) {
                $clientes[] = $cliente;
            }
            $this->mensaje_db = 'Cliente(s) encontrado(s):';
						return $clientes;
        } else {
            $this->mensaje_db = 'No hubo coincidencias';
        }
    }

    # Crear un nuevo cliente
    public function create($datos_cliente=array()) {
        if(array_key_exists('nombreVc', $datos_cliente) && !empty($datos_cliente['nombreVc']) &&
						array_key_exists('telefonoVc', $datos_cliente) && !empty($datos_cliente['telefonoVc']) &&
						array_key_exists('direccionVc', $datos_cliente) && !empty($datos_cliente['direccionVc']) &&
						array_key_exists('emailVc', $datos_cliente) && !empty($datos_cliente['emailVc']) &&
						array_key_exists('cpCh', $datos_cliente) && !empty($datos_cliente['cpCh'])) {
            $this->read(array('emailVc'=>$datos_cliente['emailVc']));
            if($datos_cliente['nombreVc'] != $this->nombreVc &&
								$datos_cliente['emailVc'] != $this->emailVc) {
                foreach ($datos_cliente as $campo=>$valor) {
                    $$campo = $valor;
                }
                $this->query = "
									INSERT INTO cliente 
										(id_clienteIn, nombreVc, telefonoVc, direccionVc,  
										cpCh, fechaRegistroDt, emailVc)
									VALUES
										(null,'$nombreVc', '$telefonoVc', '$direccionVc', 
										'$cpCh', NOW(), '$emailVc')
                ";
                $this->execute_single_query();
                $this->mensaje_db = 'Cliente agregado exitosamente';
            } else {
                $this->mensaje_db = 'La cliente ya existe';
            }
        } else {
            $this->mensaje_db = 'No se ha agregado el cliente';
        }
    }

    # Modificar un cliente
    public function update($datos_cliente=array()) {
        foreach ($datos_cliente as $campo=>$valor) {
            $$campo = $valor;
        }
				
        $this->query = "
					UPDATE cliente
					SET nombreVc = '$nombreVc',
							telefonoVc '$telefonoVc', 
							direccionVc = '$direccionVc', 
							cpCh = '$cpCh',
							fechaRegistroDt = '$fechaRegistroDt', 
							emailVc = '$emailVc'
					WHERE  id_clienteIn = '$id_clienteIn'
        ";
        $this->execute_single_query();
        $this->mensaje_db = 'Cliente modificado';
    }

    # Eliminar un cliente
    public function delete($id='') {
        $this->query = "
                DELETE FROM  cliente
                WHERE       id = '$id'
        ";
        $this->execute_single_query();
        $this->mensaje_db = 'Cliente eliminado';
    }

	#lista todos los clientes o varios
	public function list_items($limit='') {
		$this->query = "
				SELECT id_clienteIn, nombreVc, telefonoVc, direccionVc, cpCh,
								fechaRegistroDt, emailVc
				FROM   cliente 
		";
		if(!empty($limit))
			$this->query .= "limit $limit";

		$this->get_results_from_query();
		
		if(count($this->rows) >= 1) {
			$clientes = array();
			foreach ($this->rows as $cliente) {
					$clientes[] = $cliente;
			}
			$this->mensaje_db = 'Lista de clientes';			
			return $clientes;
		} else {
			$this->mensaje_db = 'Lista vacía';
		}
	}
}

