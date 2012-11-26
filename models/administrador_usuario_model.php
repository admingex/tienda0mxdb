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
	
	function obtener_rs($id_rs) {
		$this->query = "SELECT * FROM CMS_IntRazonSocial WHERE id_razonSocialIn =".$id_rs;
		
		$this->get_results_from_query();		
		return $this->rows;  		
	}
	
	function actualizar_rs($id_rs, $datos){
		$this->query = "UPDATE CMS_IntRazonSocial SET tax_id_number='".$datos['tax_id_number']."', company='".$datos['company']."', email ='".$datos['email']."' WHERE id_razonSocialIn=".$id_rs;		
		$res = $this->execute_single_query();
		return $res;	
	}
	
	function establecer_predeterminado_rs($id_cliente, $id_rs){
		$this->query = "UPDATE CMS_IntRazonSocial SET id_estatusSi=1 WHERE id_clienteIn=".$id_cliente." AND id_estatusSi!=2";
		$this->execute_single_query();
		
		$this->query = "UPDATE CMS_IntRazonSocial SET id_estatusSi=3 WHERE id_clienteIn=".$id_cliente." AND id_razonSocialIn=".$id_rs;
		$this->execute_single_query();						
	}
			
	function obtener_direccion($id_cliente, $id_consecutivo) {
		$this->query = "SELECT id_consecutivoSi, address_type, id_clienteIn, company, 
			tax_id_number as rfc,
			address1 as calle, 
			address2 as num_ext, 
			address3 as colonia, 
			address4 as num_int,
			zip as cp, 
			state as estado, 
			city as ciudad, 
			codigo_paisVC as pais,	
			id_estatusSi as estatus,		
			email from CMS_IntDireccion WHERE id_consecutivoSi=".$id_consecutivo." AND id_clienteIn=".$id_cliente;
			
		$this->get_results_from_query();		
		return $this->rows;	
	}		
	
	function listar_paises_think() {		
		$this->query = "SELECT country_code2 as id_pais, country_name as pais FROM CMS_CatPaisThink ";					
		$this->get_results_from_query();		
		return $this->rows;
	}		
	
	function actualizar_direccion($id_cliente, $id_dir, $direccion){		
		$this->query = "UPDATE CMS_IntDireccion SET address1='".$direccion['address1']."', 
		 												 address2='".$direccion['address2']."', 
		 												 address3='".$direccion['address3']."', 
		 												 address4='".$direccion['address4']."', 
		 												 zip='".$direccion['zip']."',
		 												 codigo_paisVc='".$direccion['codigo_paisVc']."', 
		 												 state='".$direccion['state']."',
		 												 city='".$direccion['city']."',
		 												 phone='".$direccion['phone']."',
		 												 referenciaVc='".$direccion['referenciaVc']."',
		 												 id_estatusSi='".$direccion['id_estatusSi']."'
		 												 WHERE id_consecutivoSi=".$id_dir." AND id_clienteIn=".$id_cliente;	
		$res = $this->execute_single_query();
		return $res;												 		
	}
	
	
	function establecer_predeterminado_dir($id_cliente, $id_dir){
		$this->query = "UPDATE CMS_IntDireccion SET id_estatusSi=1 WHERE id_clienteIn=".$id_cliente." AND id_estatusSi!=2 AND address_type=1";
		$this->execute_single_query();
		
		$this->query = "UPDATE CMS_IntDireccion SET id_estatusSi=3 WHERE id_clienteIn=".$id_cliente." AND id_consecutivoSi=".$id_dir;
		$this->execute_single_query();						
	}
	
	/**
	 * Devuelve el detalle de la dirección de envio
	 */
	function detalle_direccion($id_consecutivoSi, $id_cliente)
	{
		$this->query = "SELECT id_consecutivoSi, address_type, id_clienteIn, company, 
			tax_id_number as rfc,
			address1 as calle, 
			address2 as num_ext, 
			address3 as colonia, 
			address4 as num_int,
			zip as cp, 
			state as estado, 
			city as ciudad, 
			codigo_paisVC as pais,	
			id_estatusSi as estatus,
			phone as telefono,
			referenciaVc as referencia,		
			email from CMS_IntDireccion WHERE id_consecutivoSi=".$id_consecutivoSi." AND id_clienteIn=".$id_cliente;
			
		$this->get_results_from_query();		
		return $this->rows;	
				
	}
	
	function listar_estados_sepomex() {
		$this->query = "SELECT EDO as clave_estado, ESTADO as estado FROM CMS_CatEstado ORDER BY estado ASC";
		$this->get_results_from_query();		
		return $this->rows;		
	}
	
	function listar_ciudades_sepomex($cve_estado) {
		
		$this->query = "SELECT CVE_CIUDAD as clave_ciudad, CIUDAD as ciudad 
								FROM CMS_CatCiudad JOIN CMS_CatEstado 
								ON CMS_CatEstado.cve_estado = CMS_CatCiudad.cve_estado 
								WHERE CMS_CatEstado.EDO='".$cve_estado."' 
								ORDER BY ciudad ASC";				
		$this->get_results_from_query();		
		return $this->rows;
	}
	
	function listar_colonias_sepomex($cve_estado, $cve_ciudad) {
			$this->query = "SELECT CMS_CatEstado.EDO as estado, CMS_CatCiudad.CIUDAD as ciudad, CMS_CatCodigoPostal.COLONIA AS colonia, CMS_CatCodigoPostal.ZIP as codigo_postal FROM CMS_CatCodigoPostal 
								JOIN CMS_CatCiudad ON CMS_CatCiudad.cve_ciudad = CMS_CatCodigoPostal.cve_ciudad
								JOIN CMS_CatEstado ON CMS_CatEstado.cve_estado = CMS_CatCodigoPostal.cve_estado 
								WHERE CMS_CatEstado.EDO='".$cve_estado."' AND CMS_CatCiudad.CIUDAD='".$cve_ciudad."'
								ORDER BY colonia ASC";
			$this->get_results_from_query();		
			return $this->rows;						
	}
	
	function quitar_predeterminado($id_cliente) {
		$this->query = "UPDATE CMS_IntDireccion SET id_estatusSi=1 WHERE id_clienteIn=".$id_cliente." AND id_estatusSi=3 AND address_type='0'";
		$res = $this->execute_single_query();
		return $res;
	}
	
	function actualizar_direccion_env($consecutivo, $id_cliente, $nueva_info)
	{
			
		$this->query = "UPDATE CMS_IntDireccion SET address1='".$nueva_info['address1']."', 
		 												 address2='".$nueva_info['address2']."', 
		 												 address3='".$nueva_info['address3']."', 
		 												 address4='".$nueva_info['address4']."', 
		 												 zip='".$nueva_info['zip']."',
		 												 codigo_paisVc='".$nueva_info['codigo_paisVc']."', 
		 												 state='".$nueva_info['state']."',
		 												 city='".$nueva_info['city']."',
		 												 phone='".$nueva_info['phone']."',
		 												 referenciaVc='".$nueva_info['referenciaVc']."',
		 												 id_estatusSi='".$nueva_info['id_estatusSi']."'
		 												 WHERE id_consecutivoSi=".$consecutivo." AND id_clienteIn=".$id_cliente;
		
		$res = $this->execute_single_query();
		return $res;												 
		
	}
	
	function obtener_compras_cliente($id_cliente){
			
		$this->query = "SELECT * FROM CMS_IntCompra 
		        WHERE id_clienteIn=".$id_cliente;
		$this->get_results_from_query();		
		return $this->rows;				
	}
	
	function obtener_medio_pago($id_compra, $id_cliente){
				
		$this->query = "SELECT * FROM CMS_RelCompraPago 
		        	WHERE id_clienteIn=".$id_cliente." AND id_compraIn=".$id_compra;					
		$this->get_results_from_query();		
		return $this->rows;	
	}
	
	function obtener_codigo_autorizacion($id_compra, $id_cliente){
				
		$this->query = "SELECT * FROM CMS_RelCompraPagoDetalleTC 
		        WHERE id_clienteIn=".$id_cliente." AND id_compraIn=".$id_compra."  ORDER BY fecha_registroTs DESC";
		$this->get_results_from_query();		
		return $this->rows;		
	}
	
	function obtener_promo_compra($id_compra, $id_cliente){
				
		$this->query = "SELECT * FROM CMS_RelCompraArticulo 
		        WHERE id_clienteIn=".$id_cliente." AND id_compraIn=".$id_compra;
		$this->get_results_from_query();
		
		if(count($this->rows)>0){			
			$id_promo = $this->rows[0]['id_promocionIn'];						
		}			
		else{
			$id_promo = 0; 
		}
		return $id_promo;		 		 		
	}
	
	function obtener_detalle_promo($id_promo){
		$this->query = "SELECT * FROM CMS_IntPromocion 
		        WHERE id_promocionIn=".$id_promo;
		$this->get_results_from_query();        		
		return $this->rows;	
	}
	
	function obtener_articulos($id_promocion){
	
		$this->query = "SELECT * FROM CMS_IntArticulo 
		        WHERE id_promocionIn=".$id_promocion;
				
		$this->get_results_from_query();        		
		return $this->rows;	
	}
	
	function obtener_issue($issue_id){
		$this->query = "SELECT * FROM CMS_IntIssue WHERE issue_id = ".$issue_id;
		$this->get_results_from_query();        		
		return $this->rows;
	}
	
	function obtener_tc($id_cliente, $id_tc){
		$this->query = "SELECT * FROM CMS_IntTC 
		        WHERE id_clienteIn=".$id_cliente." AND id_TCSi=".$id_tc;
		$this->get_results_from_query();        		
		return $this->rows;		
	}
	
	function obtener_rel_envio($id_compra, $id_cliente){		
		$this->query = "SELECT * FROM CMS_RelCompraDireccion 
		        WHERE id_clienteIn=".$id_cliente." AND id_compraIn=".$id_compra." AND address_type=0";
		$this->get_results_from_query();        		
		return $this->rows;	
	}
		
	function obtener_rel_facturacion($id_compra, $id_cliente){		
		$this->query = "SELECT * FROM CMS_RelCompraDireccion 
		        WHERE id_clienteIn=".$id_cliente." AND id_compraIn=".$id_compra." AND address_type=1";
		$this->get_results_from_query();        		
		return $this->rows;	
	}	
	
	function eliminar_tarjeta($id_cliente, $consecutivo){
		$this->query = "UPDATE CMS_IntTC SET id_estatusSi = 2 WHERE id_TCSi =".$consecutivo." AND id_clienteIn=".$id_cliente;	
		$res = $this->execute_single_query();
		return $res;		
	}	
	
	function detalle_tarjeta($id_tc, $id_cliente){
		$this->query = "SELECT * FROM CMS_IntTC WHERE id_TCSi =".$id_tc." AND id_clienteIn = ".$id_cliente;
		$this->get_results_from_query();        		
		return $this->rows;
	}	
	
	function quitar_predeterminado_tc($id_cliente){
		$this->query = "UPDATE CMS_IntTC SET id_estatusSi = 1 WHERE id_clienteIn=".$id_cliente." AND id_estatusSi = 3";
		$res = $this->execute_single_query();		
		return $res;
	}	
	
	function actualiza_tarjeta($consecutivo, $id_cliente, $nueva_info){
	
		$this->query="UPDATE CMS_IntTC SET 	nombre_titularVc = '".$nueva_info['nombre_titularVc']."', 
											apellidoP_titularVc = '".$nueva_info['apellidoP_titularVc']."', 
											apellidoM_titularVc = '".$nueva_info['apellidoM_titularVc']."',
											mes_expiracionVc = ".$nueva_info['mes_expiracionVc'].",
											anio_expiracionVc = ".$nueva_info['anio_expiracionVc'].",
											id_clienteIn = ".$nueva_info['id_clienteIn'].",  
											id_TCSi = ".$nueva_info['id_TCSi'].",
											terminacion_tarjetaVc = ".$nueva_info['terminacion_tarjetaVc'].",
											descripcionVc = '".$nueva_info['descripcionVc']."',
											id_tipo_tarjetaSi = ".$nueva_info['id_tipo_tarjetaSi'].",
											id_estatusSi = ".$nueva_info['id_estatusSi']." WHERE id_TCSi=".$consecutivo." AND id_clienteIn=".$id_cliente;
		$res = $this->execute_single_query();		
		return $res;
	}
}
