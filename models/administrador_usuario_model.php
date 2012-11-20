<?php
# Importar modelo de abstracción de base de datos 
require_once('./core/db_abstract_model.php');


class Administrador_usuario_Model extends DBAbstractModel {

    ############################### PROPIEDADES ################################
    private $email;
	private $password;	
    private $id_clienteIn;

	############################ CONSTRUCTOR Y DESTRUCTOR #######################
    # Método constructor
    function __construct() {
		$this->db_name = 'cms0mxdb';
    }

    # Método destructor del objeto
    function __destruct() {
        unset($this);
    }
	
	##obtiene las razones sociales guardadas por el usuario		
	function listar_razon_social($id_cliente){
		$this->query = "SELECT * FROM CMS_IntRazonSocial WHERE id_clienteIn =".$id_cliente." AND id_estatusSi != 2"; 									
		$this->get_results_from_query();		
		return $this->rows;      		
    }		
				
	
}
