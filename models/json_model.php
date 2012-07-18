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
		$this->db_name = 'cms_ecommerce';
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
	 * Devuelve listado de categosías
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
	 * Devuelve la información para la página de categorías
	 */
	public function get_publicaciones_por_categoria($id_categoria) {
		$this->query = "CALL SP_Publicaciones_Por_Categoria(".$id_categoria.")";
		
		$this->get_results_from_query();
		
		$publicaciones = $this->rows;
		
		return $publicaciones;
	}
}
