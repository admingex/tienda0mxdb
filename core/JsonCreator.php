<?php
class JsonCreator {
	#para la conexión
	private static $db_host = 'localhost';
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
	abstract protected function read();			//select 1 elemento
	abstract protected function create();		//insert
	abstract protected function update();		//update
	abstract protected function delete();		//delete
	abstract protected function list_items(); //listado de elementos
    
	# Conectar a la base de datos
	private function crear_conexion() {
		$this->conn = new mysqli(self::$db_host, self::$db_user, self::$db_pass, $this->db_name);
	}
	
	# Desconectar la base de datos
	private function cerrar_conexion() {
		$this->conn->close();
	}

	# Ejecutar un query simple del tipo INSERT, DELETE, UPDATE
	protected function execute_single_query() {
		if($_POST) {
			$this->crear_conexion();
			$this->conn->query($this->query);
			$this->cerrar_conexion();
		} else {
			$this->mensaje_db = 'Método no permitido';
		}
	}

	# Traer resultados de una consulta en un Array, SELECT
	protected function write_file() {
		$this->crear_conexion();
		$result = $this->conn->query($this->query);
		while ($row = $result->fetch_assoc())
			$this->rows[] = $row;
		$result->close();
		$this->cerrar_conexion();
		//array_pop($this->rows);	//trae uno de más por el while
		//return $this->rows;
	}
}
?>
