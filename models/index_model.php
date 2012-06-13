<?php
# Importar modelo de abstracción de base de datos
require_once('../core/db_abstract_model.php');


class Index extends DBAbstractModel {

    ############################### PROPIEDADES ################################
    private $publicaciones;
	private $categorias;
	
    private $id_clienteIn;
    private $nombreVc;
    private $telefonoVc;
	private $direccionVc;
	private $emailVc;
    private $cpCh;
	private $fechaRegistroDt;
		
	//Metodos de acceso
	public function get_id_clienteIn() { return $this->id_clienteIn; }
    public function get_nombreVc() { return $this->nombreVc; }
	public function get_telefonoVc() { return $this->telefonoVc; }
	public function get_direccionVc() { return $this->direccionVc; }
	public function get_emailVc() { return $this->emailVc; }
    public function get_cpCh() { return $this->cpCh; }
	public function get_fechaRegistroDt() { return $this->fechaRegistroDt; }
		
    ################################# MÉTODOS ##################################
    
    #recupera las publicaciones para colocarlas en el archivo JSON
    public function get_publicaciones() {
    	$this->query = "
            SELECT id_clienteIn, nombreVc, telefonoVc, direccionVc, 
											emailVc, cpCh, fechaRegistroDt
            FROM   cliente 
            WHERE  emailVc = '$email'
        ";
        $this->get_results_from_query();
    }
    
    # Traer datos de un cliente
    public function read($datos_cliente=array()) {
        if(array_key_exists('emailVc', $datos_cliente) &&
					($email = $datos_cliente['emailVc']) != '') {
            $this->query = "
                SELECT id_clienteIn, nombreVc, telefonoVc, direccionVc, 
												emailVc, cpCh, fechaRegistroDt
                FROM   cliente 
                WHERE  emailVc = '$email'
            ";
            $this->get_results_from_query();
        }
				
        if(count($this->rows) == 1) {
            foreach ($this->rows[0] as $propiedad=>$valor) {
                $this->$propiedad = $valor;
            }	
            $this->mensaje_db = 'Cliente encontrado';
        } else {
            $this->mensaje_db = 'No hubo coincidencias';
        }
    }
		
		public function read_buscar($datos_cliente=array(), $limit='') {
        if(array_key_exists('nombreVc', $datos_cliente) || 
					array_key_exists('emailVc', $datos_cliente) ||
					array_key_exists('cpCh', $datos_cliente) ) {
            $this->query = "
                SELECT id_clienteIn, nombreVc, telefonoVc, direccionVc, 
											cpCh, emailVc, fechaRegistroDt
                FROM   cliente 
                WHERE  
								nombreVc = '".$datos_cliente['nombreVc']."' OR 
								emailVc = '".$datos_cliente['emailVc']."' OR 
								cpCh = '".$datos_cliente['cpCh']."'
            ";
						if(!empty($limit))
							$this->query .= "$limit";
            $this->get_results_from_query();
        }
        if(count($this->rows) >= 1) {
						$clientes = array();
            foreach ($this->rows as $cliente) {
                $clientes[] = $cliente;
            }
            $this->mensaje_db = 'Cliente(s) encontrado(s):';
						return $clientes;
        } else {
            $this->mensaje_db = 'No hubo coincidencias';
        }
    }

    # Crear un nuevo cliente
    public function create($datos_cliente=array()) {
        if(array_key_exists('nombreVc', $datos_cliente) && !empty($datos_cliente['nombreVc']) &&
						array_key_exists('telefonoVc', $datos_cliente) && !empty($datos_cliente['telefonoVc']) &&
						array_key_exists('direccionVc', $datos_cliente) && !empty($datos_cliente['direccionVc']) &&
						array_key_exists('emailVc', $datos_cliente) && !empty($datos_cliente['emailVc']) &&
						array_key_exists('cpCh', $datos_cliente) && !empty($datos_cliente['cpCh'])) {
            $this->read(array('emailVc'=>$datos_cliente['emailVc']));
            if($datos_cliente['nombreVc'] != $this->nombreVc &&
								$datos_cliente['emailVc'] != $this->emailVc) {
                foreach ($datos_cliente as $campo=>$valor) {
                    $$campo = $valor;
                }
                $this->query = "
									INSERT INTO cliente 
										(id_clienteIn, nombreVc, telefonoVc, direccionVc,  
										cpCh, fechaRegistroDt, emailVc)
									VALUES
										(null,'$nombreVc', '$telefonoVc', '$direccionVc', 
										'$cpCh', NOW(), '$emailVc')
                ";
                $this->execute_single_query();
                $this->mensaje_db = 'Cliente agregado exitosamente';
            } else {
                $this->mensaje_db = 'La cliente ya existe';
            }
        } else {
            $this->mensaje_db = 'No se ha agregado el cliente';
        }
    }

    # Modificar un cliente
    public function update($datos_cliente=array()) {
        foreach ($datos_cliente as $campo=>$valor) {
            $$campo = $valor;
        }
				
        $this->query = "
					UPDATE cliente
					SET nombreVc = '$nombreVc',
							telefonoVc '$telefonoVc', 
							direccionVc = '$direccionVc', 
							cpCh = '$cpCh',
							fechaRegistroDt = '$fechaRegistroDt', 
							emailVc = '$emailVc'
					WHERE  id_clienteIn = '$id_clienteIn'
        ";
        $this->execute_single_query();
        $this->mensaje_db = 'Cliente modificado';
    }

    # Eliminar un cliente
    public function delete($id='') {
        $this->query = "
                DELETE FROM  cliente
                WHERE       id = '$id'
        ";
        $this->execute_single_query();
        $this->mensaje_db = 'Cliente eliminado';
    }

	#lista todos los clientes o varios
	public function list_items($limit='') {
		$this->query = "
				SELECT id_clienteIn, nombreVc, telefonoVc, direccionVc, cpCh,
								fechaRegistroDt, emailVc
				FROM   cliente 
		";
		if(!empty($limit))
			$this->query .= "limit $limit";

		$this->get_results_from_query();
		
		if(count($this->rows) >= 1) {
			$clientes = array();
			foreach ($this->rows as $cliente) {
					$clientes[] = $cliente;
			}
			$this->mensaje_db = 'Lista de clientes';			
			return $clientes;
		} else {
			$this->mensaje_db = 'Lista vacía';
		}
	}
    # Método constructor
    function __construct() {
			$this->db_name = 'helladyo_videocentro';
    }

    # Método destructor del objeto
    function __destruct() {
        unset($this);
    }
}
?>
