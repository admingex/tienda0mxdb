<?php
abstract class DBAbstractModel {
	#para la conexión
	private static $db_host = '10.177.73.120';
	private static $db_user = 'ecommerce_user';
	private static $db_pass = 'ecommerce';
	
	#para las consultas
	protected $db_name = 'mydb';	//el modelo que hereda a la clase la define
	protected $query;
	protected $rows = array();
	
	#sólo conexión
	private $conn;
	
	public $mensaje_db = 'Ok';

	# métodos abstractos para el CRUD de clases que hereden (modelos)
	#abstract protected function read();			//select 1 elemento
	#abstract protected function create();		//insert
	#abstract protected function update();		//update
	#abstract protected function delete();		//delete
	#abstract protected function list_items(); //listado de elementos
        
	# Conectar a la base de datos
	private function crear_conexion() {
		$this->conn = new mysqli(self::$db_host, self::$db_user, self::$db_pass, $this->db_name);
	}
	
	# Cambiar el Charset a UTF-8
	private function set_charset() {
		//regresa bool
		$this->conn->set_charset("utf8");
	}
	
	# Desconectar la base de datos
	private function cerrar_conexion() {
		$this->conn->close();
	}

	# Ejecutar un query simple del tipo INSERT, DELETE, UPDATE
	protected function execute_single_query() {
		//ejecución de un single command
		$this->crear_conexion();
		//cambiar el charset
		$this->set_charset();
		
		//$this->conn->query($this->query);
		if (!$this->conn->query($this->query)) {
			die($this->conn->error . $this->query);
			$this->mensaje_db = $this->conn->error . $this->query;
			return FALSE;
		}
		//return $conn->insert_id;		
		$this->cerrar_conexion();
		return TRUE;
	}

	# Traer resultados de una consulta en un Array, SELECT
	protected function get_results_from_query() {
		//para vaciar posibles resultados previos
		$this->rows = array();
		
		$this->crear_conexion();
		$this->set_charset();
		$result = $this->conn->query($this->query);
		while ($row = $result->fetch_assoc())
			$this->rows[] = $row;
		$result->close();
		$this->cerrar_conexion();
		//array_pop($this->rows);	//trae uno de más por el while
		//return $this->rows;
	}
	
	# Traer resultados de una consulta en un Array Bidimencional, SELECT
	/*EL Metodo  fetch_all solo funciona en las versiones de mysqlinl
	protected function get_results_all() {
		//para vaciar posibles resultados previos
		//$this->rows = array();
		$resulttype =MYSQLI_ASSOC;//Nombre del campo
		//otros tipos  MYSQLI_NUM *es el de defecto solo numero conforme a la psosicion si no se le pasa nada utlizara este 
		// MYSQLI_BOTH  trae los dos tanto el nuemeor como el valor
		
		$this->crear_conexion();
		$this->set_charset();
		
		$result = $this->conn->query($this->query);
		while ($row = $result->fetch_all($resulttype)){
			$this->rows[] = $row;
		}
		$result->close();
		$this->cerrar_conexion();
		//array_pop($this->rows);	//trae uno de más por el while
		//return $this->rows;
	}
	*/
	# Traer resultados de una consulta en un Array, SELECT
	protected function get_results_all() {
		//para vaciar posibles resultados previos
		$this->rows = array();
				
		$this->crear_conexion();
		$this->set_charset();
		
		$result = $this->conn->query($this->query);
		while ($row = $result->fetch_assoc()){
			$this->rows[] = $row;
		}
		$result->close();
		$this->cerrar_conexion();
		//array_pop($this->rows);	//trae uno de más por el while
		//return $this->rows;
	}
}
?>
