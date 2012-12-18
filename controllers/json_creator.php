<?php
# Importar modelo de abstracción de base de datos 
require_once('./core/db_abstract_model.php');
require_once('./models/json_model.php');

class Json_Creator {
	
	###############################  RUTA FIJA  ################################
	//var $ruta="/var/www/html/subir_tienda";

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
	/*Administrador - Home*/
	private $archivo_carrusel_home 	= "./json/carrusel_home.json";
	private $archivo_home_promociones_destacadas 	= "./json/home_promociones_destacadas.json";
	private $archivo_promos_home	= "./json/promociones_home.json";
	private $archivo_promos_especiales	= "./json/promociones_especiales.json";
	private $archivo_promos_padre	= "./json/promociones_padre/promos_padre.json";
	private $archivo_buscador		= "./json/criterios_busqueda.json";	
	### bases
	private $base_publicacion_por_categoria	= "./json/categorias/publicaciones_categoria_";
	private $base_promos_por_publicacion	= "./json/publicaciones/promos_publicacion_";
	private $base_formatos_por_publicacion	= "./json/publicaciones/formatos_publicacion";
	private $base_detalle_promo				= "./json/detalle_promociones/detalle_promo_";
	private $base_promocion_destacada_por_cartegoria	= "./json/promociones_destacadas/promo_destacada_categoria_";
	private $base_promocion_destacada_por_publicacion	= "./json/promociones_destacadas/promo_destacada_publicacion_";
	private $base_secciones_oc 		= "./json/secciones/seccion_oc_";
	private $base_promociones_padre = "./json/promociones_padre/promo_padre_";
	### Busquedas
	private $archivo_busqueda_formatos	="./json/busqueda/b_";
	private $archivo_busqueda_promocion	="./json/busqueda/codigo_promocion_";
	private $archivo_busqueda_promocion_especial	="./json/busqueda/promocion_especial_";
	private $archivo_busqueda_all	="./json/busqueda/all_promociones.json";
	###	Promos canales 
	//private $archivo_busqueda_all	="./json/promos_canal.json";
	
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
		$jc = NULL;		//json categorías
		
		//si ya se tienen las categorías en la variable miembro
    	if (isset($this->categorias)) {
	    	$jc = json_decode($this->categorias);
		} else if (file_exists($this->archivo_categorias)) {	//Si ya está en el archivo, lo toma de ahí
    		$jc = json_decode(file_get_contents("./json/categorias/categorias.json"));
		} else {	//generar la petición de las categorías
			//recuperar las categorías a través del método apropiado
			$temp = $this->get_categorias();
			$jc = json_decode($temp);
		}
		
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
		/*
		echo "<pre>File";
		echo print_r($publicaciones_por_categoria);
		echo "</pre>";
		exit;*/
	
		/*
		 *$json = file_get_contents("./json/categorias/categorias.json");
		$categorias = json_decode($json);		
		*/	
		return $publicaciones_por_categoria;
    }
    /*************************************************************************************/
    public function generar_json_buscador_all($palabra) {
    	//ruta del archivo del detalle
				
		//recuperar el detalle
		$detalle_busqueda_f = $this->modelo->get_busqueda_all($palabra);
		
		$this->promos_bus = json_encode(array("promociones" => $detalle_busqueda_f));
		
		//echo "'".$file_detalle."'<br/>";
		self::Write_To_Json_File($this->archivo_busqueda_all, $this->promos_bus);    	
    }
    
    public function generar_json_buscador_formatos($formato,$palabra) {
    	//ruta del archivo del detalle
		$file_busqueda = $this->archivo_busqueda_formatos.$formato.".json";
		
		//recuperar el detalle
		$detalle_busqueda_f = $this->modelo->get_busqueda_formatos($formato,$palabra);
		
		$this->promos_bus = json_encode(array("promociones" => $detalle_busqueda_f));
		
		//echo "'".$file_detalle."'<br/>";
		self::Write_To_Json_File($file_busqueda, $this->promos_bus);    	
    }
    
    public function generar_json_buscador_promocion($palabra) {
    	//ruta del archivo del detalle
		$file_busqueda = $this->archivo_busqueda_promocion.$palabra.".json";
		
		//recuperar el detalle
		$detalle_busqueda_f = $this->modelo->get_busqueda_promocion($palabra);
		
		$this->promos_bus = json_encode($detalle_busqueda_f);
		
		//echo "'".$file_detalle."'<br/>";
		self::Write_To_Json_File($file_busqueda, $this->promos_bus);    	
    }
	
 	public function generar_json_buscador_promociones_especiales($palabra) {
    	//ruta del archivo del detalle
		$file_busqueda = $this->archivo_busqueda_promocion_especial.$palabra.".json";
		
		//recuperar el detalle
		$detalle_busqueda_f = $this->modelo->get_busqueda_promocion_especial($palabra);
		
		$this->promos_bus = json_encode($detalle_busqueda_f);
		
		//echo "'".$file_detalle."'<br/>";
		self::Write_To_Json_File($file_busqueda, $this->promos_bus);    	
    }
    
    /*************************************************************************************/
	
	/**
	 * Generar los archivos con las promociones disponibles por publicación
	 * Devuelve el arreglo con las promociones por publicacion
	 * Cat->publicacion->detalle
	 */
    public function generar_json_publicacion_promos() {
    	$promos_por_publicacion = array();
    	$jp = NULL;	//json promociones
    	
    	if (isset($this->publicaciones)) {		//Ya se crearon las publicaciones
    		//echo "desde la propiedad";
	    	$jp = json_decode($this->publicaciones);
		} else if (file_exists($this->archivo_publicaciones)) {	//Si ya está en el archivo, lo toma de ahí
    		//echo "desde el archivo";
    		//$jp = json_decode(file_get_contents("./json/publicaciones/publicaciones.json"));
    		$jp = json_decode(file_get_contents($this->archivo_publicaciones));
		} else {	// si no existe el archivo, hacer la consulta de las publicaciones
			//echo "haciendo la petición de publicaciones";
			$temp = $this->get_publicaciones();		//json_encode(array("categorias" => $this->modelo->get_publicaciones()));
			$jp = json_decode($temp);
		}
		
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
			$this->generar_json_promos_detalle($ppp);
			
			### formatos
			//para saber qué formatos mostrar para la publicación
			$formatos = array();
			//considerar los formatos por publicación par el posible filtro
			foreach ($ppp as $promocion) {
				$id_formato	= $promocion['id_formato'];
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
	 * Generar los archivos con las promociones disponibles para el "aliza
	 * Devuelve el arreglo con las promociones para el carrusel
	 * home->carrusel
	 */
	public function generar_json_alianza() {
		//recuperar las promociones de la base de datos
		$pc = $this->modelo->get_promos_alianza();
		
		//$this->promos_carrusel = json_encode(array("promos_carrusel" => $pc));
		//escribir las promociones en un archivo json
		//self::Write_To_Json_File($this->archivo_carrusel_home, $this->promos_carrusel);
		
		//echo "     Detalle de Promociones para el carrusel..................</br><br/>";
		$this->generar_json_promos_detalle($pc);
		
		/*echo "<pre>";
		echo json_encode($this->promos_carrusel);
		echo "</pre>";*/
		//return $this->promos_carrusel;
	}
	
	
	
	/**
	 * Generar los archivos con las promociones disponibles para el "Home promocion destacada"(canal 29)
	 * Devuelve el arreglo con las promociones para homo promocion destacada
	 * 
	 */
	public function generar_json_home_promo_destacada() {
		//recuperar las promociones de la base de datos
		$pc = $this->modelo->get_promos_home_destacada();
		
		$this->promos_homo_desta = json_encode(array("homo_promos_destacada" => $pc));
		//escribir las promociones en un archivo json
		self::Write_To_Json_File($this->archivo_home_promociones_destacadas, $this->promos_homo_desta);
		
		//echo "     Detalle de Promociones para el carrusel..................</br><br/>";
		$this->generar_json_promos_detalle($pc);
		
		/*echo "<pre>";
		echo json_encode($this->promos_carrusel);
		echo "</pre>";*/
		return $this->promos_homo_desta;
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
		if (!empty($this->categorias)) {
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
		
		//Ya se crearon las publicaciones
		//if (isset($this->publicaciones)) {		
		if (!empty($this->publicaciones)) {
			//recuperar las publicaciones de la propiedad de la clase
	    	$pubs = json_decode($this->publicaciones);
		
		} else {	//generar la petición de las publicaciones
			//recuperar las publicaciones a través del método apropiado
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
			/*
			echo "<pre>";
			print_r($detalle_promo);
			echo "</pre>";
			*/
			
			if($detalle_promo){				
			
				//generar jsons para las secciones de las promociones
				$oc_id = $detalle_promo[0]['oc_id'];
				$issue_id = $detalle_promo[0]['issue_id'];
				$this->generar_json_secciones($id_promocion, $oc_id, $issue_id);
			
				//echo "'".$file_detalle."'<br/>";
				self::Write_To_Json_File($file_detalle, json_encode($detalle_promo));
			}
					
		}
	 }
	################## END Recuperación y Generación del de talle de las promociones ##############
	
	################## Recuperación y generación de jsons de las Secciones de una promoción ############## 
	/**
	 * Obtener las secciones relacionadas a las suscripciones, pdfs y seminarios 
	 */
	public function generar_json_secciones($id_promocion, $oc_id = 0, $issue_id = 0) {
		//ruta del archivo del detalle
		$file_seccion = $this->base_secciones_oc.$id_promocion.".json";
		
		//recuperar el detalle
		$detalle_seccion = $this->modelo->get_secciones($oc_id, $issue_id);
		
		//echo "'".$file_detalle."'<br/>";
		self::Write_To_Json_File($file_seccion, json_encode($detalle_seccion));
	 }
	################## END Recuperación y Generación Las Secciones ##############
	
	################## Recuperación y genera el json para llenar el buscador  ############## 
	/**
	 * Obtener las secciones relacionadas a las suscripciones, pdfs y seminarios 
	 */
	public function generar_json_buscador() {
		 
		$buss2[0]['valor_criterio']="all";
		$buss2[0]['nombre_criterio']="Todos los productos";		 
		$buss2[1]['valor_criterio']="promociones_especiales";
		$buss2[1]['nombre_criterio']="Promociones especiales";
		$x=2;
		//recuperar el detalle de los formatos
		$buss = $this->modelo->get_buscador();
		$i=0;
		foreach($buss as $valor){
			 $buss2[$x]['valor_criterio']=$buss[$i]['valor_criterio'];
			 $buss2[$x]['nombre_criterio']=$buss[$i]['nombre_criterio'];
			 $i++;
			 $x++;
		}
		/*
		$buss2[$x]['valor_criterio']="palabras_clave";
		$buss2[$x]['nombre_criterio']="Palabras clave";
		$x++;
		*/
		$buss2[$x]['valor_criterio']="codigo_promocion";
		$buss2[$x]['nombre_criterio']="Codigo de promoción";
		$this->detalle_buscador = json_encode(array("criterios" => $buss2));
		
		//$this->detalle_buscador = json_encode(array("valor_criterio" => "ALL", "nombre_criterio" => "todos"));
			
		self::Write_To_Json_File($this->archivo_buscador, $this->detalle_buscador);
		
		return $this->detalle_buscador;
		
	 }	
	################## END Recuperación y Generación Buscador ##############
	
	
	################## Recuperación y generación de jsons de las promociones padre ############## 
	/**
	 * Obtener el detalle de las promociones padre y generar los correspondientes archivos json
	 */
	public function generar_json_promos_padre() {		
		//ruta del archivo del detalle
		
		$file_seccion = $this->archivo_promos_padre;
		
		//recuperar el detalle
		$detalle_seccion = $this->modelo->get_promociones_padre();
		
		//echo "'".$file_detalle."'<br/>";
		self::Write_To_Json_File($file_seccion, json_encode($detalle_seccion));
	 }
	################## END Recuperación y generación de jsons de las promociones padre ##############
	
	################## Recuperación y generación de jsons de las promociones hija ############## 
	/**
	 * Obtener el detalle de las promociones hijas para cada una de las promociones padre y generar los correspondientes archivos json
	 */
	public function generar_json_promos_hijas() {				
		
		$promos_padre = $this->modelo->get_promociones_padre();
				
		foreach($promos_padre as $promo){
			// ruta del archivo
			$file_seccion = $this->base_promociones_padre.$promo['id_promocionIn'].".json";
			
			//recuperar el detalle
			$detalle_seccion = $this->modelo->get_promociones_hijas($promo['id_promocionIn']);
						
			//echo "'".$file_detalle."'<br/>";
			self::Write_To_Json_File($file_seccion, json_encode($detalle_seccion));	
					
		}
		 
	 }
	################## END Recuperación y generación de jsons de las promociones hijas ##############
	
	################## Recuperación y generación de jsons de las promociones hija ############## 
	/**
	 * Obtener el detalle de las promociones hijas y generar los correspondientes archivos json
	 */
	public function generar_json_detalle_promos_hijas() {			
		//ruta del archivo del detalle
		
		$promos_padre = $this->modelo->get_promociones_padre();
		
		foreach($promos_padre as $promo){
			$promos_hijas = $this->modelo->get_promociones_hijas($promo['id_promocionIn']);	
			
			foreach ($promos_hijas as $promocion) {
				$id_promocion = $promocion['id_promocion'];
			
				//ruta del archivo del detalle
				$file_detalle = $this->base_detalle_promo.$id_promocion.".json";
				
				//recuperar el detalle
				$detalle_promo = $this->modelo->get_detalle_promocion_hija($id_promocion);
				/*
				echo "<pre>";
				print_r($detalle_promo);
				echo "</pre>";
				*/
				
				if($detalle_promo){				
			
					//generar jsons para las secciones de las promociones
					$oc_id = $detalle_promo[0]['oc_id'];
					$issue_id = $detalle_promo[0]['issue_id'];
					$this->generar_json_secciones($id_promocion, $oc_id, $issue_id);
				
					//echo "'".$file_detalle."'<br/>";
					self::Write_To_Json_File($file_detalle, json_encode($detalle_promo));
				}
				 
					
			}
					
							
		}		
		 
	 }
	################## END Recuperación y generación de jsons de las promociones hijas ##############
	
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
