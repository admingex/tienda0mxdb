<?php
# Importar modelo de abstracción de base de datos 
require_once('db_conf.php');


class AccesoDB extends DBAbstractModel {

    ############################### PROPIEDADES ################################

	############################ CONSTRUCTOR Y DESTRUCTOR #######################
    # Método constructor
    function __construct() {
		$this->db_name = 'cms_ecommerce';
    }

    # Método destructor del objeto
    function __destruct() {
        unset($this);
    }
			
	//Metodos de acceso
	
		
    ################################# MÉTODOS ##################################
    
	######## CONSULTA SIMPLE
    public function cSQL($consultaSql) {
		$this->query = $consultaSql;

		//regresa un array
		$this->get_results_from_query();
		
		//echo count($this->rows)." qey: ". $this->query." correo ".$email;
		/*
		echo "<pre>";
		print_r($this->rows);
		echo "</pre>";
		
		exit();
		*/
		
		//Si encontró resultado lo devuelve, si no, regresa un array vacío
		if (count($this->rows) > 0) {
			return $this->rows[0];
		} else {
			return $this->rows;
		}
	}
	
	######## CONSULTA TOTAL 
    public function sSQL($consultaSql) {
		$this->query = $consultaSql;

		//regresa un array
		$this->get_results_all();
		
		//echo count($this->rows)." qey: ". $this->query." correo ".$email;
		/*	
		echo "<pre>";
		print_r($this->rows);
		echo "</pre>";
		
		exit();
	*/
		
		//Si encontró resultado lo devuelve, si no, regresa un array vacío
		if (count($this->rows) > 0) {
			return $this->rows; // si utilizara feach_all seria $this->rows[0]; caso contrario sin indice
		} else {
			return $this->rows;
		}
	}
	
    
	######## ABC
	function abcSQL($id_cliente) {								
		$this->query = "UPDATE  CMS_IntCliente SET FailedPasswordAttemptCount = NULL, LastLockoutDate = NULL  WHERE id_clienteIn = '" . $id_cliente . "'";
		//regresa TRUE ó FALSE dependiendo de si se ejecutó correctamente o no 
		$res = $this->execute_single_query();
		
		return $res;				
	}
    
}

