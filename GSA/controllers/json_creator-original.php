<?php
# Importar modelo de abstracción de base de datos 
require_once('./core/db_abstract_model.php');
require_once('./models/json_model.php');

class Json_Creator {
	############################### IP FIJA ###################################
	private $ip='http://10.177.78.54/subir_tienda';

    ############################### PROPIEDADES ################################
    private $categorias;
	private $publicaciones;
	private $promos_carrusel;
	private $formatos;
	private $promos_home;
	private $promos_especiales;
	private $promos_destacadas_por_cartegoria;
	
	#### Rutas de los archivos
	private $archido_id_sitio		= "./json/id_sitio_tienda.json";
	private $archivo_categorias 	= "./json/categorias/categorias.json";
	private $archivo_publicaciones 	= "./json/publicaciones/publicaciones.json";
	private $archivo_formatos 		= "./json/formatos.json";
	private $archivo_carrusel_home 	= "./json/carrusel_home.json";
	private $archivo_promos_home	= "./json/promociones_home.json";
	private $archivo_promos_especiales	= "./json/promociones_especiales.json";
	### bases
	private $base_publicacion_por_categoria	= "./json/categorias/publicaciones_categoria_";
	private $base_promos_por_publicacion	= "./json/publicaciones/promos_publicacion_";
	private $base_formatos_por_publicacion	= "./json/publicaciones/formatos_publicacion";
	private $base_detalle_promo				= "./json/detalle_promociones/detalle_promo_";
	private $base_promocion_destacada_por_cartegoria	= "./json/promociones_destacadas/promo_destacada_categoria_";
	private $base_promocion_destacada_por_publicacion	= "./json/promociones_destacadas/promo_destacada_publicacion_";
	
	//modelo a utilizar
	private $modelo;	//modelo de datos
	
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
		//escribir al archivo
		//Json_Creator::Write_To_Json_File($this->archido_id_sitio, $json_text);
		self::Write_To_Json_File($this->archido_id_sitio, $json_text);
		
		//echo "<br/>file id tienda: " . file_get_contents($this->archido_id_sitio);
		
    	return $id_tienda; 
    }
    
    /**
	 * Obtiene el catálogo de los formatos para el filtro y 
	 * regresa objeto json encoded
	 */
    public function get_catalogo_formatos() {
    	$this->formatos = json_encode(array('formatos' => $this->modelo->get_catalogo_formatos()));
		
		//escribir al archivo
		self::Write_To_Json_File($this->archivo_formatos, $this->formatos);
		
    	return $this->formatos; 
    }
    
	################### Generación de archivos de Categorías ###################
	/**
	 * Obteger las categorías y guardarlas en un archivo Json
	 * Regresa objeto json encoded
	 */
	public function get_categorias() {
		$this->categorias = json_encode(array("categorias" => $this->modelo->get_categorias()));

		//escribir al archivo
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
    	
    	if (isset($this->publicaciones)) {		//Ya se crearon las publicaciones
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
				/*
				echo "ppp1<pre>";
				print_r($ppp);
				echo "</pre>";
				*/
				
				//obtener el detalle de las promociones
				$this->generar_json_promos_detalle($ppp);
				
				### formatos
				//para saber qué formatos mostrar para la publicación
				$formatos = array();
				//considerar los formatos por publicación par el posible filtro
				foreach ($ppp as $promocion) {					
					$id_formato	=	$promocion['id_formato'];
					$formatos["$id_formato"] = $id_formato;
				}
				
				/*echo "<pre>";
				print_r($formatos);
				echo "</pre>";*/
				//ruta del archivo de formatos por publicacion
				$file_formatos_pp = $this->base_formatos_por_publicacion.$id.".json";
				//echo "'".$file_detalle."'<br/>";
				self::Write_To_Json_File($file_formatos_pp, json_encode(array("formatos_pp" => $formatos)));
				
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
				
				$this->generar_json_promos_detalle($ppp);
				/*
				//obtener el detalle de las promociones
				foreach ($ppp as $promocion) {
					$id_promocion = $promocion['id_promocion'];
					
					$file_detalle = $this->base_detalle_promo.$id_promocion.".json";
					
					//recuperar el detalle
					$detalle_promo = $this->modelo->get_detalle_promocion($id_promocion);
					
					//echo "'".$file_detalle."'<br/>";
					self::Write_To_Json_File($file_detalle, json_encode($detalle_promo));
				}
				*/
				//echo "prueba_generacion_detalles";
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
		//recuperar las promociones de la base de datos
		$pc = $this->modelo->get_promos_carrusel();
		
		$this->promos_carrusel = json_encode(array("promos_carrusel" => $pc));
		//escribir las promociones en un archivo json
		self::Write_To_Json_File($this->archivo_carrusel_home, $this->promos_carrusel);
		
		//echo "     Detalle de Promociones para el carrusel..................</br><br/>";
		$this->generar_json_promos_detalle($pc);
		
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
    	//recuperar las promociones de la base de datos
    	$hp = $this->modelo->get_promos_home();
    	
    	$this->promos_home = json_encode(array("promos_home" => $hp));
		
		//escribir las promociones en un archivo json
		self::Write_To_Json_File($this->archivo_promos_home, $this->promos_home);
		
		//echo "     Detalle de Promociones para el home..................</br><br/>";
		$this->generar_json_promos_detalle($hp);
		
		/*echo "<pre>";
		echo json_encode($this->promos_home);
		echo "</pre>";*/
		
		return $this->promos_home;
    }
	
	/**
	 * Generar los archivos con las "promociones especiales""
	 * Devuelve el arreglo con las promociones destacadas
	 * Home->Promociones Especiales
	 */
    public function generar_json_promos_especiales() {
    	//recuperar las promociones de la base de datos
    	$pe = $this->modelo->get_promos_especiales();
		
    	$this->promos_especiales = json_encode(array("promos_especiales" => $pe));
		
		//escribir las promociones en un archivo json
		self::Write_To_Json_File($this->archivo_promos_especiales, $this->promos_especiales);
		
		//echo "     Detalle de Promociones Especiales..................</br><br/>";
		$this->generar_json_promos_detalle($pe);
		
		/*echo "<pre>";
		echo json_encode($this->promos_especiales);
		echo "</pre>";*/
		
		#### TO DO: generar detalle de promociones
		return $this->promos_especiales;
    }
	
	/**
	 * Generar los archivos con las "promociones dstacadas" de las categorías
	 * Devuelve el arreglo con las promociones y genera los detalles
	 * Categoria->Promoción Destacada
	 */
    public function generar_json_promos_destacadas_por_categorias() {
    	$promos_destacadas_por_categorias = array();
		
		//if (isset($this->publicaciones)) {		//Ya se crearon las publicaciones
		if (empty($this->categorias)) {
			//recuperar las categorías de la propiedad de la clase
	    	$cats = json_decode($this->categorias);
		
		} else {	//generarlas
			$temp = $this->get_categorias();		//json_encode(array("categorias" => $this->modelo->get_categorias()));
			$cats = json_decode($temp);
		}
		/*
		echo "<pre>";
		print_r($cats);
		echo "</pre>";
		exit;*/
		
		//para cada categoría recuperar su promoción destacada si es que tiene
		foreach ($cats->categorias as $cat) {
			$id_c = $cat->id_categoriaSi;
			
			$pdc = $this->modelo->get_promocion_destacada_por_categoria($id_c);
							
			if (!empty($pdc) && count($pdc) == 1) {
				//rutra del archivo
				$path_pdc = $this->base_promocion_destacada_por_cartegoria.$id_c.".json";
				//agregar al array
				$promos_destacadas_por_categorias[$id_c] = json_encode(array("promo_destacada" => $pdc[0]));
				//escribir en el arhivo
				self::Write_To_Json_File($path_pdc, $promos_destacadas_por_categorias[$id_c]);
				
				//echo "Generar Detalle de Promociones Destacada Categoría..................</br><br/>";
				$this->generar_json_promos_detalle($pdc);
			} 
		}
		
		/*
		echo "Promo destacada por categoría<pre>";
		print_r($promos_destacadas_por_categorias);
		echo "</pre>";*/
		
		return $promos_destacadas_por_categorias;
    }
	
	/**
	 * Generar los archivos con las "promociones dstacadas" de las publicaciones
	 * Devuelve el arreglo con las promociones destacadas
	 * Publicación->Promoción Destacada
	 */
    public function generar_json_promos_destacadas_por_publicaciones() {
    	$promos_destacadas_por_publicacion = array();
		
		//if (isset($this->publicaciones)) {		//Ya se crearon las publicaciones
		if (empty($this->publicaciones)) {
			//recuperar las publicaciones de la propiedad de la clase
	    	$pubs = json_decode($this->categorias);
		
		} else {	//generarlas
			$temp = $this->get_publicaciones();
			$pubs = json_decode($temp);
		}	
		
		/*echo "<pre>";
		print_r($pubs);
		echo "</pre>";
		exit;*/
		
		//para cada publicación recuperar su promoción destacada si tiene
		foreach ($pubs->publicaciones as $pub) {
			$id_p = $pub->id_publicacionSi;
			
			$pdp = $this->modelo->get_promocion_destacada_por_publicacion($id_p);
							
			if (!empty($pdp) && count($pdp) == 1) {
				//rutra del archivo
				$path_pdp = $this->base_promocion_destacada_por_publicacion.$id_p.".json";
				//agregar al array
				$promos_destacadas_por_publicacion[$id_p] = json_encode(array("promo_destacada" => $pdp[0]));
				//escribir en el arhivo
				self::Write_To_Json_File($path_pdp, $promos_destacadas_por_publicacion[$id_p]);
				
				//echo "Generar Detalle de Promociones Destacada Categoría..................</br><br/>";
				$this->generar_json_promos_detalle($pdp);
			} 
		}
		
		/*echo "Promo destacada por publicación<pre>";
		print_r($promos_destacadas_por_publicacion);
		echo "</pre>";*/
		
		return $promos_destacadas_por_publicacion;
    }
	
	################## Recuperación y Generación del de talle de las promociones ############## 
	/**
	 * Obtener el detalle de las promociones y generar los correspondientes archivos json
	 */
	 public function generar_json_promos_detalle($promociones) {
	 	/*echo "<pre>";
		print_r($promociones);
		echo "</pre>";*/
		
		foreach ($promociones as $promocion) {
			$id_promocion = $promocion['id_promocion'];
			
			//ruta del archivo del detalle
			$file_detalle = $this->base_detalle_promo.$id_promocion.".json";
			
			//recuperar el detalle
			$detalle_promo = $this->modelo->get_detalle_promocion($id_promocion);
			
			//echo "'".$file_detalle."'<br/>";
			self::Write_To_Json_File($file_detalle, json_encode($detalle_promo));
		}
	 }
	################## END Recuperación y Generación del de talle de las promociones ##############
	
	####################### Escritura a archivo
	/**
	 * Escribe el contenido a un aechivo de tipo .json en el formato establecido
	 * $file_name es el nombre del archivo,
	 * $str = "" lo que se va a escribir en el archivo
	 */
	public static function Write_To_Json_File($file_name, $str = "") {
		$mensaje = '';
		$ruta_server = $_SERVER['DOCUMENT_ROOT']."/tienda";
		  
		//echo $_SERVER['DOCUMENT_ROOT']."<br/>";
		//echo TIENDA;
		 
		//$file_name = realpath($file_name);
		//is_writablle:el archivo existe y es escribible
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
