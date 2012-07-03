<?php
//require_once('../core/util_constantes.php');
//require_once('../modelo/publicacion_model.php');

class Front_Controller {
	protected $accion;
	protected $data = array();

	public static $MODULO = 'publicaciones/';	
	public static $EQUIVALENCIAS = array(
			VIEW_CREATE=> 'Agregar publicación', 			VIEW_READ=>			'Buscar publicación', 
			VIEW_UPDATE=> 'Modificar publicación',		VIEW_DELETE=> 	'Borrar publicación', 
			VIEW_LIST_ALL=>	'Lista de publicaciones', 	VIEW_DETAIL=>		'Detalle de publicación'
		);
	
	function __construct() {
		//determinar la acción que se atenderá
		$this->accion = VIEW_LIST_ALL;		//por default es listar 
		$this->data = array('modulo' => self::$MODULO, 'vista' => VIEW_LIST_ALL);
		
		//posibles acciones o vistas**
		$peticiones = array(
					CREATE, READ, UPDATE, DELETE, LIST_ALL, DETAIL, 
					VIEW_CREATE, VIEW_READ, VIEW_UPDATE,
					VIEW_DELETE, VIEW_LIST_ALL, VIEW_DETAIL);
		
		$uri = $_SERVER['REQUEST_URI'];	//**

		//comparaci�n (vistas od. acciones)
		foreach ($peticiones as $peticion) {
			$uri_peticion = self::$MODULO.$peticion.'/';
			if (strpos($uri, $uri_peticion) == true ) {
				$this->accion = $peticion;
			}
		}	
	}
	
	public function atiende() {	
		$datos_request = $this->recoge_datos();
		//atencion de la acci�n

		switch($this->accion) {
			case CREATE:	//create
				$this->add_publicacion($datos_request);
				break;
			case READ:		//read				
				$this->buscar_publicacion($datos_request);
				break;
			case DETAIL:
				$this->get_publicacion($datos_request);
				break;
			case VIEW_LIST_ALL://listar
				$this->list_all();
				break;
			default:		//cargar vista (agregar, listar, buscar)
				$this->vista_default($this->accion);
		}	
	}
	
	public function add_publicacion($datos_request) {
		$this->data['submodulo'] = VIEW_CREATE;
		$this->data['subtitulo'] = self::$EQUIVALENCIAS[VIEW_CREATE];	//'Agregar';
		//instanciar al modelo
		$publicacion = new publicacion();
		$publicacion->create($datos_request);
		
		$this->data['mensaje'] = $publicacion->mensaje_db;
		$this->cargar_vista(VIEW_CREATE, $this->data);
	}
	
	public function get_publicacion($id) {
		$this->data['submodulo'] = VIEW_DETAIL;
		$this->data['subtitulo'] = self::$EQUIVALENCIAS[VIEW_DETAIL];	//'Detalle';
		
		$publicacion = new publicacion;
		$publicacion->read($id);	//taer� la informaci�n en el objeto
		$this->data['publicacion'] = $publicacion;

		$this->data['mensaje'] = $publicacion->mensaje_db;
		$this->cargar_vista(VIEW_DETAIL, $this->data);
	}
	
	public function buscar_publicacion($datos_request) {
		$this->data['submodulo'] = VIEW_LIST_ALL;
		$this->data['subtitulo'] = self::$EQUIVALENCIAS[VIEW_LIST_ALL];	///'Buscar';
		
		$publicacion = new publicacion();
		$this->data['publicacions'] = $publicacion->read_buscar($datos_request);
		$this->data['mensaje'] = $publicacion->mensaje_db;
		$this->cargar_vista(VIEW_LIST_ALL, $this->data);
	}
	
	public function list_all() {
		$this->data['submodulo'] = VIEW_LIST_ALL;
		$this->data['subtitulo'] = self::$EQUIVALENCIAS[VIEW_LIST_ALL];
		
		$publicacion = new publicacion();
		$this->data['publicaciones'] = $publicacion->list_items($this->paginar());
		
		$this->cargar_vista(VIEW_LIST_ALL, $this->data);	
	}
	
	public function vista_default($vista) {
		$this->data['submodulo'] = $vista;
		$this->data['subtitulo'] = self::$EQUIVALENCIAS[$vista];
		$this->data['vista'] = $vista;
		$this->cargar_vista($vista, $this->data);	
	}
	
	public function cargar_vista($vista, $data=array()) {
		require_once('../vista/publicaciones/view.php');
	}
	
	public function recoge_datos() {
		$datos = array();
		if($_POST) {
				if(array_key_exists('nombre', $_POST)) { 
						$datos['nombreVc'] = $_POST['nombre']; 
				}
				if(array_key_exists('telefono', $_POST)) { 
						$datos['telefonoVc'] = $_POST['telefono'];
				}
				if(array_key_exists('direccion', $_POST)) { 
						$datos['direccionVc'] = $_POST['direccion']; 
				}
				if(array_key_exists('email', $_POST)) { 
						$datos['emailVc'] = $_POST['email']; 
				}
				if(array_key_exists('cp', $_POST)) { 
						$datos['cpCh'] = $_POST['cp']; 
				}
		} else if($_GET) {
				if(array_key_exists('id', $_GET)) { 
						$datos['id_publicacionIn'] = $_GET['id']; 
				}
				if(array_key_exists('nombre', $_GET)) {
						$datos['nombreVc'] = $_GET['nombre'];
				}
				if(array_key_exists('telefono', $_GET)) { 
						$datos['telefonoVc'] = $_GET['telefono'];
				}
				if(array_key_exists('direccion', $_GET)) { 
						$datos['direccionVc'] = $_GET['direccion']; 
				}
				if(array_key_exists('email', $_GET)) { 
						$datos['emailVc'] = $_GET['email']; 
				}
				if(array_key_exists('cp', $_GET)) {
						$datos['cpCh'] = $_GET['cp'];
				}
		}
		//print_r($datos); 
		return $datos;
	}		
		
	public function paginar() {
	//checar si hay alguna seleccionada**
	
		if (isset($_GET['pagina'])) {
			$pagina = $_GET['pagina'];
		} else {	//Si no, es la primera
			$pagina = 1;
		}
		
		//Objeto del modelo para las consultas
		$p = new publicacion;
		
		$total_publicaciones = count($p->list_items());
		
		$ultima_pagina = ceil($total_publicaciones / PAGE_SIZE) ;		
		$this->data['ultima_pagina'] = $ultima_pagina;	//para verlo en la plantilla
		
		$pagina = (int)$pagina;
		if ($pagina > $ultima_pagina){
				$pagina = $ultima_pagina;
		}
		if ($pagina < 1){
				$pagina = 1;
		}
		$this->data['pagina'] = $pagina;	//para verlo en la plantilla
		
		//esta parte se pasar� como argumento a la consulta.
		$parametro_lista = ' LIMIT '. ($pagina - 1) * PAGE_SIZE . ', ' .PAGE_SIZE;
		
		return $parametro_lista;
	}
} 
