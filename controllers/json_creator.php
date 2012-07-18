<?php
# Importar modelo de abstracción de base de datos 
require_once('./core/db_abstract_model.php');
require_once('./models/json_model.php');

class Json_Creator {

    ############################### PROPIEDADES ################################
    private $categorias;
	private $publicaciones;
    private $promocion;
	private $modelo;			//modelo a utilizar
	#### Rutas de los archivos
	private $archivo_categorias = "./json/categorias/categorias.json";
	private $archido_id_sitio	= "./json/id_tsitio_tienda.json";
	private $base_publicacion_por_categoria = "./json/categorias/publicaciones_categoria_";
	############################ CONSTRUCTOR Y DESTRUCTOR #######################
    # Método constructor
    function __construct() {
		$this->db_name = 'cms0mxdb';
		$this->modelo = new Json_Model(); 
    }

    # Método destructor del objeto
    function __destruct() {
        unset($this);
    }
	
    ################################# MÉTODOS ##################################
    /**
	 * Regresa el id del sitio de la tienda
	 */
    public function get_id_tienda() {
    	$id_tienda = $this->modelo->get_sitio_tienda();
		$json_text = json_encode(array('id_sitio_tienda' => $id_tienda));
	
		//echo "encode<br/>" . $json_text;
	
		Json_Creator::Write_To_Json_File($this->archido_id_sitio, $json_text);
	
		//echo "<br/>file id tienda: " . file_get_contents($this->archido_id_sitio);
		
    	return $id_tienda; 
    }
    
	################### Generación de archivos de Categorías ###################
	/**
	 * Devuelve el arreglo con las publicaciones por categoría
	 */
    public function generar_json_por_categorias() {
    	$publicaciones_por_categoria = array();
		
    	if (isset($this->categorias)) {
	    	$jc = json_decode($this->categorias);
			
			foreach ($jc->categorias as $categoria) {
				$id = $categoria->id_categoriaSi;
				
				$p = $this->modelo->get_publicaciones_por_categoria($id);
				$publicaciones_por_categoria[$id] = json_encode(array('publicaciones' => $p));
				$filename = $this->base_publicacion_por_categoria.$id.".json";
				
				self::Write_To_Json_File($filename, $publicaciones_por_categoria[$id]);
				/*echo "<pre>";
				print_r(json_decode($publicaciones_por_categoria[$id]));
				echo "</pre>";*/
			}
			/*
			echo "<pre>";
			echo print_r($publicaciones_por_categoria);
			echo "</pre>";
			*/
    	} else if (file_exists($this->archivo_categorias)) {
    		
    		$jc = json_decode(file_get_contents("./json/categorias/categorias.json"));
			
			foreach ($jc->categorias as $categoria) {
				$id = $categoria->id_categoriaSi;
				
				$p = $this->modelo->get_publicaciones_por_categoria($id);
				$publicaciones_por_categoria[$id] = json_encode(array('publicaciones' => $p));
				$filename = $this->base_publicacion_por_categoria.$id.".json";
				
				self::Write_To_Json_File($filename, $publicaciones_por_categoria[$id]);
			}
			
			/*
			echo "<pre>File";
			echo print_r($publicaciones_por_categoria);
			echo "</pre>";
			exit;*/
    	}
    	
		
		/*
		 *$json = file_get_contents("./json/categorias/categorias.json");
		$categorias = json_decode($json);		
		*/
		
		
		return $publicaciones_por_categoria;
    }
	
	/**
	 * Encode to UTF8 format to aply json encode
	 * recibe un array y regresa un array codificado
	 */
	private function encode_utf8($data) {
		echo "<pre>";
		//print_r($data);
		echo "</pre>";
		//exit;
		$rows = array();
		foreach ($data as $publicaciones) {
			$r = array();
			foreach ($publicaciones as $key => $value) {
				$r[$key] = utf8_encode($value);
			}
			$rows[] = $r;
		}
		return $rows;
	}
	
	/**
	 * Encode to UTF8 format to aply json encode
	 * recibe un array y regresa un array codificado
	 */
	private function decode_utf8($data) {
		echo "<pre>";
		//print_r($data);
		echo "</pre>";
		//exit;
		$rows = array();
		foreach ($data as $publicaciones) {
			$r = array();
			foreach ($publicaciones as $key => $value) {
				$r[$key] = utf8_decode($value);
			}
			$rows[] = $r;
		}
		return $rows;
	}
	
	/**
	 * Obteger las categorías y guardarlas en un Json
	 */
	public function get_categorias() {
		$this->categorias = json_encode(array("categorias" => $this->modelo->get_categorias()));
		//escribirlas a archivo
		self::Write_To_Json_File($this->archivo_categorias, $this->categorias);
		
		return $this->categorias;
	}
	
	####################### Escritura a archivo
	/**
	 * Escribe el contenido a un aechivo de tipo .json en el formato establecido
	 */
	public static function Write_To_Json_File($file_name, $str = "") {
		$mensaje = '';
		//el archivo existe y es escribible
		if (!file_exists($file_name) || is_writable($file_name)) {
			if (!$file = fopen($file_name, 'wb')) {
				$mensaje = "No se puede abrir el archivo ($file_name).";
				echo "Error: " . $mensaje;
				exit;
			}
			
			if (fwrite($file, $str) === FALSE) {
				$mensaje = "No se puede escribir en el archivo abierto ($file_name).";
				echo "Error: " . $mensaje;
				exit;
			}
			//echo "Escritura exitosa.";
			
			fclose($file);
		} else {
			$mensaje = "El archivo ($file_name) no tiene permisos de escritura.";
			echo "Error: " . $mensaje;
			exit;
		}
		
	}
	
       
    ############### END Generación de archivos de Categorías ###################
    	
}
