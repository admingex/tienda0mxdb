<?php 
	header('Content-Type: text/html; charset=utf-8');
	
	function no_cache() {
		header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
		header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
		header('Pragma: no-cache');
		header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
	}
	
	