<?php
# Importar modelo de abstracción de base de datos 
require_once('./core/db_abstract_model.php');
require_once('./models/json_model.php');

class Json_Creator {

    ############################### PROPIEDADES ################################
    private $categorias;
	private $publicaciones;
    private $promocion;
	private $modelo;
	private $promos_carrusel;
	private $promos_home;
				//modelo a utilizar
	#### Rutas de los archivos
	private $archivo_carrusel_home 	= "./json/carrusel_home.json";
	private $archivo_promos_home	= "./json/promociones_home.json";
	private $archivo_categorias 	= "./json/categorias/categorias.json";
	private $archivo_publicaciones 	= "./json/publicaciones/publicaciones.json";
	private $archido_id_sitio		= "./json/id_tsitio_tienda.json";
	
	private $base_publicacion_por_categoria	= "./json/categorias/publicaciones_categoria_";
	private $base_promos_por_publicacion	= "./json/publicaciones/promos_publicacion_";
	private $base_detalle_promo				= "./json/promociones_publicacion/detalle_promo_";
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
	 * Genera los archivos con las publicaciones por categoría
	 * Devuelve el arreglo con las publicaciones por categoría
	 */
    public function generar_json_categoria_publicaciones() {
    	$publicaciones_por_categoria = array();
		
    	if (isset($this->categorias)) {
	    	$jc = json_decode($this->categorias);
			
			foreach ($jc->categorias as $categoria) {
				$id = $categoria->id_categoriaSi;
				
				$ppc = $this->modelo->get_publicaciones_por_categoria($id);
								
				$publicaciones_por_categoria[$id] = json_encode(array('publicaciones' => $ppc));
				$filename = $this->base_publicacion_por_categoria.$id.".json";
				
				self::Write_To_Json_File($filename, $publicaciones_por_categoria[$id]);
				/*echo "<pre>";
				print_r(json_decode($publicaciones_por_categoria[$id]));
				echo "</pre>";*/
			}
			
    	} else if (file_exists($this->archivo_categorias)) {	//Si ya está en el archivo, lo toma de ahí
    		
    		$jc = json_decode(file_get_contents("./json/categorias/categorias.json"));
			
			foreach ($jc->categorias as $categoria) {
				$id = $categoria->id_categoriaSi;
				
				$ppc = $this->modelo->get_publicaciones_por_categoria($id);
				$publicaciones_por_categoria[$id] = json_encode(array('publicaciones' => $ppc));
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
	 * Generar los archivos con las promociones disponibles por publicación
	 * Devuelve el arreglo con las promociones por publicacion
	 * Cat->publicacion->detalle
	 */
    public function generar_json_publicacion_promos() {
    	$promos_por_publicacion = array();
		
    	if (!isset($this->publicaciones)) {		//Ya se crearon las publicaciones
	    	$jp = json_decode($this->publicaciones);
			//echo "desde la propiedad";
			foreach ($jp->publicaciones as $publicacion) {
				$id = $publicacion->id_publicacionSi;
				//recuperar las promociones
				$ppp = $this->modelo->get_promos_por_publicacion($id);
				//para cada publicación se registran las promociones
				$promos_por_publicacion[$id] = json_encode(array('promociones' => $ppp));
				
				//ruta: ./json/promos_publicacion_[id].json
				$filename = $this->base_promos_por_publicacion.$id.".json";
				
				//registrar las promos por publicación
				self::Write_To_Json_File($filename, $promos_por_publicacion[$id]);
				
				//obtener el detalle de las promociones
				foreach ($ppp as $promocion) {
					$id_promocion = $promocion['id_promocion'];
					
					$file_detalle = $this->base_detalle_promo.$id_promocion.".json";
					
					//recuperar el detalle
					$detalle_promo = $this->modelo->get_detalle_promocion($id_promocion);
					
					//echo "'".$file_detalle."'<br/>";
					self::Write_To_Json_File($file_detalle, json_encode($detalle_promo));
				}
				//self::Write_To_Json_File($file_detalle, json_encode(array('detalle_promo' => $detalle_promo)));
				//echo realpath($_SERVER["DOCUMENT_ROOT"])."<br/>";
				/*
				echo "<pre>";
				print_r(json_decode($publicaciones_por_categoria[$id]));
				echo "</pre>";
				*/
			}
    	} else if (file_exists($this->archivo_publicaciones)) {	//Si ya está en el archivo, lo toma de ahí
    		//echo "desde el archivo";
    		//$jp = json_decode(file_get_contents("./json/publicaciones/publicaciones.json"));
    		$jp = json_decode(file_get_contents($this->archivo_publicaciones));
			
			foreach ($jp->publicaciones as $publicacion) {
				$id = $publicacion->id_publicacionSi;
				
				$ppp = $this->modelo->get_promos_por_publicacion($id);
				//para cada publicación
				$promos_por_publicacion[$id] = json_encode(array('promociones' => $ppp));
				
				$filename = $this->base_promos_por_publicacion.$id.".json";
				
				//registrar las promos por publicación
				self::Write_To_Json_File($filename, $promos_por_publicacion[$id]);
				
				//obtener el detalle de las promociones
				foreach ($ppp as $promocion) {
					$id_promocion = $promocion['id_promocion'];
					
					$file_detalle = $this->base_detalle_promo.$id_promocion.".json";
					
					//recuperar el detalle
					$detalle_promo = $this->modelo->get_detalle_promocion($id_promocion);
					
					//echo "'".$file_detalle."'<br/>";
					self::Write_To_Json_File($file_detalle, json_encode($detalle_promo));
				}
			}
    	}

		return $promos_por_publicacion;
    }
	
	/**
	 * Generar los archivos con las promociones disponibles para el "Carrusel"(canal 20)
	 * Devuelve el arreglo con las promociones para el carrusel
	 * home->carrusel
	 */
	public function generar_json_carrusel_promos() {
		$this->promos_carrusel = json_encode(array("promos_carrusel" => $this->modelo->get_promos_carrusel()));
		//escribir las promociones en un archivo json
		self::Write_To_Json_File($this->archivo_carrusel_home, $this->promos_carrusel);
		/*echo "<pre>";
		echo json_encode($this->promos_carrusel);
		echo "</pre>";*/
		return $this->promos_carrusel;
	}
	
	/**
	 * Generar los archivos con las promociones disponibles para el canal "Home"
	 * Devuelve el arreglo con las promociones por publicacion
	 * Cat->publicacion->detalle
	 */
    public function generar_json_home_promos() {
    	$this->promos_home = json_encode(array("promos_home" => $this->modelo->get_promos_home()));
		
		self::Write_To_Json_File($this->archivo_promos_home, $this->promos_home);
		/*echo "<pre>";
		echo json_encode($this->promos_home);
		echo "</pre>";*/
		
		#### TO DO: generar detalle de promociones
		
		return $this->promos_home;
    }	

	/**
	 * Obteger las categorías y guardarlas en un archivo Json
	 * Regresa objeto json encoded
	 */
	public function get_categorias() {
		$this->categorias = json_encode(array("categorias" => $this->modelo->get_categorias()));
		//escribirlas a archivo
		self::Write_To_Json_File($this->archivo_categorias, $this->categorias);
		
		return $this->categorias;
	}
	
	/**
	 * Obteger las publicaciones y guardarlas en un archivo Json
	 * Regresa objeto json encoded
	 */
	public function get_publicaciones() {
		$this->publicaciones = json_encode(array("publicaciones" => $this->modelo->get_publicaciones()));
		//escribirlas a archivo
		self::Write_To_Json_File($this->archivo_publicaciones, $this->publicaciones);
		
		return $this->publicaciones;
	}
	
	############### END Generación de archivos de Categorías ###################
	
	
	####################### Escritura a archivo
	/**
	 * Escribe el contenido a un aechivo de tipo .json en el formato establecido
	 * $file_name es el nombre del archivo,
	 * $str = "" lo que se va a escribir en el archivo
	 */
	public static function Write_To_Json_File($file_name, $str = "") {
		$mensaje = '';
		//echo $_SERVER['DOCUMENT_ROOT']."<br/>";
		//echo TIENDA;
		 
		//$file_name = realpath($file_name);
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
    ######################### Funciones Auxiliares ##################################
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
	
}
