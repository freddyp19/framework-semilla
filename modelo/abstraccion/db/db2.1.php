<?php
/*
include_once  MODELO."main".DS."main.inc.php";
include_once  MODELO."abstraccion".DS."adodb5".DS."adodb.inc.php";
*/
//error_reporting(E_ALL);
ini_set("display_errors","0");
define('ADODB_ERROR_LOG_TYPE',3);
$log=str_replace("modelo".DS,"",MODELO);
define('ADODB_ERROR_LOG_DEST',$log.DS.'log'.DS.'adodb-errors.log.txt');

include_once  MODELO."main".DS."main.inc.php";

include_once  MODELO."abstraccion".DS."adodb5".DS."adodb-errorhandler.inc.php";
#include_once MODELO."abstraccion".DS."adodb5".DS."adodb-exceptions.inc.php"; 
include_once  MODELO."abstraccion".DS."adodb5".DS."adodb.inc.php";


class db {

	private static $instance = NULL;
	private static $propiedad = array();

	protected $conector = null;
	public $motor;
	//public $encriptado;

	public function __construct() { 
		$main = main::getInstance();
		$this->conector = &ADONewConnection($main->motor);
		$this->conector->debug = false;
		$this->conector->Connect($main->host, $main->usuario, $main->password, $main->database);
		$this->motor=$main->motor;
		//$this->encriptado=$main->encriptado;
		if($this->motor=="mysql"){
		$this->conector->Execute("SET NAMES 'utf8'");
		$this->conector->Execute("SET CHARACTER SET utf8");
		$this->conector->Execute("SET CHARACTER_SET_CONNECTION=utf8");
		$this->conector->Execute("SET SQL_MODE = ''");
		}
		
		//echo "<br> me estoy conectando a la bae de datos<br>";
	}
	
	#obtener una instancia
	public static function getInstance() {
		if (!self::$instance) {
			self::$instance = new db();
		}
			return self::$instance;
	}
	
	
	public function __destruct() {
		if ($this->conector) {
		$this->conector->close();
		unset($this->conector);
		}
	}
	
	public function __set($nombre, $valor) {
		$this->conector->$nombre = $valor;
	}
	
	public function __get($nombre) {
		if (isset($this->conector->$nombre)) {
			return $this->conector->$nombre;
		 }
		 //else { echo "esta propiedad no existe"; }
	}
	
	public function __call($metodo, $args) {
            	if (method_exists($this->conector, $metodo)) {
                  	if ($args) {
                  		 $method = array(&$this->conector, $metodo);
                 		 $a = call_user_func_array($method, $args);
                 	} else {
                  		$a = $this->conector->$metodo();
                  	}
            		return $a;
            	} else {
            		echo "no existe la funcion $metodo en el motor $this->motor";
            		return false;
            	}	
	}

}
?>
