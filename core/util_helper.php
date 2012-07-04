<?php
#root 
const 	TIENDA =	'/tienda/';	//http://tienda.grupoexpansion.mx


# acciones


# vistas


# resultados por página
const PAGE_SIZE = 5;

function site_url($url = '') {
	echo TIENDA.$url;
}
?>