<?php

//include_once("../abstraccion/config/config.db.inc.php");

class main {
	private static $instance = NULL;
	private static $propiedad = array();
	#constructor de la clase
	private function __construct() {
		include_once(MODELO."abstraccion".DS."config".DS."config.db.inc.php");
		#guardar en propiedad la info de base de datos
		self::$propiedad['motor'] = $motor;
		self::$propiedad['host'] = $host;
		self::$propiedad['usuario'] = $usuario;
		self::$propiedad['password'] = $password;
		self::$propiedad['database'] = $database;
		/*
		self::$propiedad['charset'] = $charset;
		self::$propiedad['port'] = $port;
		self::$propiedad['encriptado'] = $encriptado;
		*/
	}
	
	#evitamos la clonacion de la clase
	private function __clone() {}
	
	#obtener una instancia
	public static function getInstance() {
		if (!self::$instance) {
			self::$instance = new main();
		}
			return self::$instance;
	}
	
	 function __get($valor) {
		if (isset(self::$propiedad[$valor])) {
			return self::$propiedad[$valor];
		} else {
			echo 'no existe la propiedad: '.$valor;
		}
	}
	
	function __set($propiedad, $valor) {
			self::$propiedad[$propiedad] = $valor;
	}
	/*
	public function get_url() {
	#array de parametros
    	$parametros = array();

	#extraigo los directorios base:
	$base = explode('/', URI_BASE);
	#quito el primer elemento (que siempre es vacio):
	array_shift($base);

	#parsing de la URL
	$url = parse_url($_SERVER['REQUEST_URI']);
	$url = explode("/", $url['path']);
	array_shift($url);

		#exploro el array de url
		foreach($url as $param) {
			#si el parametro se encuentra en base:
			if(!in_array($param, $base)) {
			#devuelve todos los parámetros válidos, ya saneados
			$parametros[] = preg_replace("/[^{_}a-zA-Z0-9]/", "", $param);
			}
		}
	return $parametros;
	}	*/
}
?>