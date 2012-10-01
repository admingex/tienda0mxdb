<?php
# Importar modelo de abstracción de base de datos 
require_once('./core/db_abstract_model.php');


class Json_Model extends DBAbstractModel {

    ############################### PROPIEDADES ################################
    private $categoria;
	private $publicacion;
    private $promocion;

	static $sitio;
	############################ CONSTRUCTOR Y DESTRUCTOR #######################
    # Método constructor
    function __construct() {
		$this->db_name = 'cms0mxdb';
		//$this->db_name = 'cms_ecommerce';
    }

    # Método destructor del objeto
    function __destruct() {
        unset($this);
    }
			
	//Metodos de acceso
	public function get_id_clienteIn() { return $this->id_clienteIn; }
		
    ##################################### MÉTODOS ######################################
    /**
	 * Obtiene el id del sitio de la tienda que es el que originalmente se utilizará para todas las peticiones
	 */
    public function get_sitio_tienda() {
    	$this->query = "SELECT id_sitioSi as sitio FROM CMS_CatSitio WHERE urlVc like '%tienda%'";
		$this->get_results_from_query();
		
		$id = (!empty($this->rows)) ? (int)$this->rows[0]['sitio'] : "No existe el sitio solicitado";  
		/*
		echo "id_tienda:";
		echo "<pre>";
		print_r($this->rows);
		echo "</pre>";
		echo "empty?" . empty($this->rows) ."<br/>";
		echo "count?" . count($this->rows);
		exit;
		*/
		return $id;
    }
    
	/**
	 * Devuelve el listado de las categorías existentes.
	 */
	public function get_categorias() {
		$this->query = "CALL SP_Obtener_Categorias()";
		
		$this->get_results_from_query();
		
		$categorias = $this->rows;
		/*
		echo "<pre>";
		echo json_encode($categorias);
		echo "</pre>";
		 * */
		return $categorias;
	}
	
	/**
	 * Devuelve el listado de las publicaciones que existen.
	 */
	public function get_publicaciones() {
		$this->query = "CALL SP_Obtener_Publicaciones()";
		
		$this->get_results_from_query();
		
		$publicaciones = $this->rows;
		/*
		echo "<pre>";
		echo json_encode($publicaciones);
		echo "</pre>";
		 * */
		return $publicaciones;
	}
	
	/**
	 * Devurlce el catálogo de formatos existentes para las publicaciones ue tienen productos en
	 * difeentes presentaciones.
	 */
	public function get_catalogo_formatos() {
		$this->query = "CALL SP_Catalogo_Formatos()";
		$this->get_results_from_query();
		
		$catalogo_formatos = $this->rows;
		
		return $catalogo_formatos;
	}
	/**
	 * Regresa las promociones para el carrusel del home
	 */
	public function get_promos_carrusel() {
		$this->query = "CALL SP_Obtener_Promociones_Carrusel()";
		
		$this->get_results_from_query();
		
		$promos_carrusel = $this->rows;
		
		/*echo "<pre>";
		echo json_encode($promos_carrusel);
		echo "</pre>";*/
		
		return $promos_carrusel;
	}
	
	/**
	 * Regresa las promociones para la página de home
	 */
	public function get_promos_home() {
		$this->query = "CALL SP_Obtener_Promociones_Home()";
		
		$this->get_results_from_query();
		
		$promos_home = $this->rows;
		
		/*echo "<pre>";
		echo json_encode($promos_carrusel);
		echo "</pre>";*/
		
		return $promos_home;
	}
	
	/**
	 * Regresa las promociones para la página de home
	 */
	public function get_promos_especiales() {
		$this->query = "CALL SP_Obtener_Promociones_Especiales()";
		
		$this->get_results_from_query();
		
		$promos_especiales = $this->rows;
		
		/*echo "<pre>";
		echo json_encode($promos_especiales);
		echo "</pre>";*/
		
		return $promos_especiales;
	}
	
	/**
	 * Devuelve la información de las publicaciones asociadas con una categoría.
	 */
	public function get_publicaciones_por_categoria($id_categoria) {
		$this->query = "CALL SP_Publicaciones_Por_Categoria(".$id_categoria.")";
		
		$this->get_results_from_query();
		
		$publicaciones = $this->rows;
		
		return $publicaciones;
	}
	
	/**
	 * Devuelve las promociones vigentes que pertenecen a una publicación.
	 */
	public function get_promos_por_publicacion($id_publicacion) {
		$this->query = "CALL SP_Promociones_Por_Publicacion(".$id_publicacion.")";
		
		$this->get_results_from_query();
		
		$promociones = $this->rows;
		
		return $promociones;		
	}
	
	/**
	 * Devuelve el detalle de una promoción
	 */
	public function get_detalle_promocion($id_promocion) {
		$this->query = "CALL SP_Obtener_Detalle_Promocion(".$id_promocion.")";
		
		$this->get_results_from_query();
		
		$detalle_promocion = $this->rows;
		
		return $detalle_promocion;		
	}
	
	/**
	 * Devuelve las secciones asociadas a una promoción
	 */
	public function get_secciones($oc_id, $issue_id = 0) {
		$this->query = "CALL SP_Secciones_Por_Promocion(" . $oc_id . "," . $issue_id . ")";
		
		$this->get_results_from_query();
		
		$secciones = $this->rows;
		
		return $secciones;
	}
	
	/**
	 * Devuelve los formatos para el buscador
	 */
	public function get_buscador() {
		$this->query = "CALL SP_Secciones_Buscador()";
		
		$this->get_results_from_query();
		
		$buscador = $this->rows;
		
		return $buscador;
	}
	
	/**
	 * Devuelve la promoción destacada para una categoría
	 */
	public function get_promocion_destacada_por_categoria($id_categoria = 0) {
		$this->query = "CALL SP_Obtener_Promocion_Destacada_Por_Categoria(".$id_categoria.")";
		
		$this->get_results_from_query();
		
		$promocion_destacada = $this->rows;
		
		return $promocion_destacada;
	}

	/**
	 * Devuelve la promoción destacada para una publicación
	 */
	public function get_promocion_destacada_por_publicacion($id_publicacion = 0) {
		$this->query = "CALL SP_Obtener_Promocion_Destacada_Por_Publicacion(".$id_publicacion.")";
		
		$this->get_results_from_query();
		
		$promocion_destacada = $this->rows;
		
		return $promocion_destacada;
	}
	
	/**
	 * Devuelve las promociones padre
	 */
	public function get_promociones_padre() {
		$this->query = "CALL SP_Obtener_Promociones_Padre()";
		
		$this->get_results_from_query();
		
		$promociones = $this->rows;
		/*
		echo "<pre>";
		echo json_encode($promociones);
		echo "</pre>";
		*/		
		return $promociones;
	}
	
	public function get_promociones_hijas($id_promocion_padre) {
		$this->query = "CALL SP_Obtener_Promociones_Hijas(".$id_promocion_padre.")";
		
		$this->get_results_from_query();
		
		$promociones_hijas = $this->rows;
		/*
		echo "<pre>";
		echo json_encode($promociones);
		echo "</pre>";
		*/		
		return $promociones_hijas;
	}
	
	public function get_detalle_promocion_hija($id_promocion) {
		
		$this->query = "CALL SP_Obtener_Detalle_Promocion_Hija(".$id_promocion.")";
		
		$this->get_results_from_query();
		
		$detalle_promocion = $this->rows;
		
		return $detalle_promocion;		
	}
}
