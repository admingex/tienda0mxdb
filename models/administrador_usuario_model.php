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
	
	function listar_direcciones($id_cliente){		
		
		$this->query="SELECT id_consecutivoSi, address_type, id_clienteIn, company, 
			tax_id_number as rfc,
			address1 as calle, 
			address2 as num_ext, 
			address3 as colonia, 
			address4 as num_int,
			zip as cp, 
			state as estado, 
			city as ciudad, 
			phone as telefono, 
			codigo_paisVc as pais,
			id_estatusSi,
			email FROM CMS_IntDireccion WHERE id_clienteIn=".$id_cliente." AND id_estatusSi != 2 AND address_type=1";
							        	
		$this->get_results_from_query();		
		return $this->rows;       

    }
	
	function listar_direcciones_envio($id_cliente){		
		
		$this->query="SELECT id_consecutivoSi, address_type, id_clienteIn, company, 
			tax_id_number as rfc,
			address1 as calle, 
			address2 as num_ext, 
			address3 as colonia, 
			address4 as num_int,
			zip as cp, 
			state as estado, 
			city as ciudad, 
			phone as telefono, 
			codigo_paisVc as pais,
			id_estatusSi,
			email FROM CMS_IntDireccion WHERE id_clienteIn=".$id_cliente." AND id_estatusSi != 2 AND address_type=0";
							        	
		$this->get_results_from_query();		
		return $this->rows;       

    }
    
    function listar_tarjetas($id_cliente)
    {
    		
    	$this->query="SELECT id_TCSi, id_clienteIn, nombre_titularVc, apellidoP_titularVc, 
			apellidoM_titularVc, mes_expiracionVc, anio_expiracionVc, descripcionVc, 
			terminacion_tarjetaVc, id_tipo_tarjetaSi, id_estatusSi FROM CMS_IntTC WHERE id_clienteIn=".$id_cliente." AND id_estatusSi != 2";			
        
       	$this->get_results_from_query();		
		return $this->rows;
    }
	
	function eliminar_rs($id_rs){
		$this->query= "UPDATE CMS_IntRazonSocial SET id_estatusSi = 2 WHERE id_razonSocialIn =".$id_rs;
		$res = $this->execute_single_query();
		return $res;		
		
	}	
	
	function eliminar_direccion($id_cliente, $id_consecutivo){		
		
		$this->query= "UPDATE CMS_IntDireccion SET id_estatusSi = 2 WHERE id_consecutivoSi =".$id_consecutivo." AND id_clienteIn =".$id_cliente;
		$res = $this->execute_single_query();
		return $res;			
	}
	
				
	
}
