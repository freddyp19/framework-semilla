<?php
header('Content-type: text/html; charset=utf-8');
$servidor = "http://localhost";  		//servidor del sistema
//$servidor = 'http://localhost';  		//servidor del sistema
$sistema = "framework_semilla";			// nombre del directorio raiz del sistema
$nombresistema = "nombresistema";	// nombre del sistema

$_SESSION["controlador_frontal"]=false;
$defaul_layouts= "menu_superior";

define('DS', DIRECTORY_SEPARATOR);
define('RUTA_SISTEMA', str_replace('inc'.DS,'',dirname(__FILE__).DS));
?>