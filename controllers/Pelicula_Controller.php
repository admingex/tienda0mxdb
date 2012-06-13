<?php
require_once('../core/util_constantes.php');
require_once('../modelo/pelicula_model.php');

class Pelicula_Controller {
	protected $accion;
	protected $data = array();
	
	public static $MODULO = 'peliculas/';
	public static $EQUIVALENCIAS = array(
			VIEW_CREATE=> 'Agregar pel&iacute;cula', 			VIEW_READ=>			'Buscar pel&iacute;cula', 
			VIEW_UPDATE=> 'Modificar pel&iacute;cula',		VIEW_DELETE=> 	'Borrar pel&iacute;cula', 
			VIEW_LIST_ALL=>	'Lista de pel&iacute;culas', 	VIEW_DETAIL=>		'Detalle de la pel&iacute;cula'
		);
		
	function __construct() {
		//determinar la petición que se atendera
		$this->accion = VIEW_LIST_ALL;		//por default es listar 
		$this->data = array('modulo' => self::$MODULO, 'vista' => VIEW_LIST_ALL);
		
		//posibles acciones o vistas
		$peticiones = array(
					CREATE, READ, UPDATE, DELETE, LIST_ALL, DETAIL, 
					VIEW_CREATE, VIEW_READ, VIEW_UPDATE,
					VIEW_DELETE, VIEW_LIST_ALL, VIEW_DETAIL);
		
		$uri = $_SERVER['REQUEST_URI'];

		//comparación (vistas od. acciones)
		foreach ($peticiones as $peticion) {
			$uri_peticion = self::$MODULO.$peticion.'/';
			//echo $uri_peticion. ' -- ';
			if( strpos($uri, $uri_peticion) == true ) {
				$this->accion = $peticion;
			}
		}
		
	}
	
	public function atiende() {	
		$datos_request = $this->recoge_datos();
		//atencion de la acción
		switch($this->accion) {
			case CREATE:	//create
				$this->add_pelicula($datos_request);
				break;
			case READ:		//read
				$this->buscar_pelicula($datos_request);
				break;
			case DETAIL:
				$this->get_pelicula($datos_request);
				break;
			case VIEW_LIST_ALL://listar
				$this->list_all();
				break;
			default:		//cargar vista (agregar, listar, buscar)
				$this->vista_default($this->accion);
		}	
	}
	
	public function add_pelicula($datos_request) {
		$this->data['submodulo'] = VIEW_CREATE;
		$this->data['subtitulo'] = self::$EQUIVALENCIAS[VIEW_CREATE];	//'Agregar';
		
		$pelicula = new Pelicula();
		$pelicula->create($datos_request);
		
		$this->data['mensaje'] = $pelicula->mensaje_db;
		$this->cargar_vista(VIEW_CREATE, $this->data);
	}
	
	public function get_pelicula($id) {
		$this->data['submodulo'] = VIEW_DETAIL;
		$this->data['subtitulo'] = self::$EQUIVALENCIAS[VIEW_DETAIL];	//'Detalle';
		
		$pelicula = new Pelicula;
		$pelicula->read($id);	//taerá la información en el objeto
		
		$this->data['pelicula'] = $pelicula;
		$this->data['mensaje'] = $pelicula->mensaje_db;
		$this->cargar_vista(VIEW_DETAIL, $this->data);
	}
	
	public function buscar_pelicula($datos_request) {
		$this->data['submodulo'] = VIEW_LIST_ALL;
		$this->data['subtitulo'] = self::$EQUIVALENCIAS[VIEW_LIST_ALL];	///'Buscar';
		
		$pelicula = new Pelicula();
		$this->data['peliculas'] = $pelicula->read_buscar($datos_request);
		
		$this->data['mensaje'] = $pelicula->mensaje_db;
		$this->cargar_vista(VIEW_LIST_ALL, $this->data);
	}
	
	public function list_all() {
		$this->data['submodulo'] = VIEW_LIST_ALL;
		$this->data['subtitulo'] = self::$EQUIVALENCIAS[VIEW_LIST_ALL];
		
		$pelicula = new Pelicula();
		$this->data['peliculas'] = $pelicula->list_items($this->paginar());
		
		$this->cargar_vista(VIEW_LIST_ALL, $this->data);	
	}
	
	public function vista_default($vista) {
		$this->data['submodulo'] = $vista;
		$this->data['subtitulo'] = self::$EQUIVALENCIAS[$vista];
		$this->data['vista'] = $vista;
		$this->cargar_vista($vista, $this->data);	
	}
	
	public function cargar_vista($vista, $data=array()) {
		require_once('../vista/peliculas/view.php');
	}
	
	public function recoge_datos() {
		$datos = array();
		if($_POST) {
				if(array_key_exists('titulo', $_POST)) { 
						$datos['tituloVc'] = $_POST['titulo']; 
				}
				if(array_key_exists('genero', $_POST)) { 
						$datos['generoVc'] = $_POST['genero'];
				}
				if(array_key_exists('anio', $_POST)) { 
						$datos['anioSi'] = $_POST['anio']; 
				}
				if(array_key_exists('clasificacion', $_POST)) { 
						$datos['clasificacionVc'] = $_POST['clasificacion']; 
				}
				if(array_key_exists('director', $_POST)) { 
						$datos['directorVc'] = $_POST['director']; 
				}
				if(array_key_exists('existencia', $_POST)) { 
						$datos['existenciaIn'] = $_POST['existencia']; 
				}
				if(array_key_exists('codigoRenta', $_POST)) { 
						$datos['codigoRentaCh'] = $_POST['codigoRenta']; 
				}
				if(array_key_exists('disponible', $_POST)) { 
						$datos['disponibleSi'] = $_POST['disponible']; 
				}
		} else if($_GET) {
				if(array_key_exists('id', $_GET)) { 
						$datos['id_peliculaIn'] = $_GET['id']; 
				}
				if(array_key_exists('titulo', $_GET)) {
						$datos['tituloVc'] = $_GET['titulo'];
				}
				if(array_key_exists('genero', $_GET)) { 
						$datos['generoVc'] = $_GET['genero'];
				}
				if(array_key_exists('anio', $_GET)) { 
						$datos['anioSi'] = $_GET['anio']; 
				}
				if(array_key_exists('clasificacion', $_GET)) { 
						$datos['clasificacionVc'] = $_GET['clasificacion']; 
				}
				if(array_key_exists('director', $_GET)) {
						$datos['directorVc'] = $_GET['director'];
				}
				if(array_key_exists('existencia', $_GET)) { 	//no 
						$datos['existenciaIn'] = $_GET['existencia']; 
				}
				if(array_key_exists('codigoRenta', $_GET)) { 
						$datos['codigoRentaCh'] = $_GET['codigoRenta']; 
				}
				if(array_key_exists('disponible', $_GET)) { 
						$datos['disponibleSi'] = $_GET['disponible']; 
				}
		}		
		return $datos;
	}		
	
	public function paginar() {
	//checar si hay alguna seleccionada**
	
		if(isset($_GET['pagina'])) {
			$pagina = $_GET['pagina'];
		} else {	//Si no, es la primera
			$pagina = 1;
		}
		
		//Objeto del modelo para las consultas
		$p = new Pelicula;
		
		$total_pelis = count($p->list_items());
		
		$ultima_pagina = ceil($total_pelis / PAGE_SIZE) ;		
		$this->data['ultima_pagina'] = $ultima_pagina;	//para verlo en la plantilla
		
		$pagina = (int)$pagina;
		if($pagina > $ultima_pagina){
				$pagina = $ultima_pagina;
		}
		if($pagina < 1){
				$pagina = 1;
		}
		$this->data['pagina'] = $pagina;	//para verlo en la plantilla
		
		//esta parte se pasará como argumento a la consulta.
		$parametro_lista = ' LIMIT '. ($pagina - 1) * PAGE_SIZE . ', ' .PAGE_SIZE;
		
		return $parametro_lista;
	}
} 
?>