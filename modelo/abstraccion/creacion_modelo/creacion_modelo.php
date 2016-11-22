<?php
class tables {

protected $base_datos;
public $identificador_tabla="tbl_";
public $campos_relacionados="FK_";
public $plantilla="plantilla.php";

	public function __construct()
	{
	$this->base_datos = db::getInstance();
	}

	public function __call($metodo, $args) {
            	if ($args) {
              		 $method = array(&$this->base_datos, $metodo);
               		 $a = call_user_func_array($method, $args);
               	} else {
               		$a = $this->base_datos->$metodo();
               	}
          	return $a;
	}

	private function ver_variabre($var)
	{
		echo "<pre>";
		print_r($var);
		echo "</pre>";
	}

	public function ver_tablas() {
	$tablas=$this->MetaTables('TABLES');
	foreach($tablas as $index => $valor)
			$RETORNAR.="\n\t<option value=\"".$valor."\">".$valor."</option>\n";
	return $RETORNAR;
	}
	
	public function todas_tablas($tabla="") {
	$tablas=$this->MetaTables('TABLES',true);
	$RETORNAR=array();
	
		foreach($tablas as $index => $valor)
		{
			if($tabla==""){
				$RETORNAR[$valor]=$valor;
			}
			elseif (substr_count($valor,".")){
				$schema_tabla=explode(".", $valor);
					if ($schema_tabla[1]==$tabla){
						$tabla2=$schema_tabla[1];
						$RETORNAR[]=$valor;
						break;
					}
			}
			elseif($valor==$tabla)
			{
				$RETORNAR[]=$valor;
			}
			
		}
	return $RETORNAR;
	}

public function comprobar_si_tiene_vista($tabla)
{
$encontro=array_search("v_".$tabla,$this->MetaTables('VIEWS'));
return $encontro;
}


	public function ver_campos($tabla) {

		$campos=$this->MetaColumnNames($tabla);
		//$this->ver_variabre($campos); exit;
		return $campos;
	}

public function crear_clases($tabla, $campos) {

	if ($PrimaryKey=$this->MetaPrimaryKeys($tabla))
	{
			$where.="\$this->where=\"";
			foreach($PrimaryKey as $key => $valor)
			{
			if ($key < (count($PrimaryKey)-1))
			{$where.=" $valor = \".\$this->bd->qstr(\$this->propiedades[\"$valor\"]).\" and ";}
			else {$where.=" $valor = \".\$this->bd->qstr(\$this->propiedades[\"$valor\"]);";}
			}
	}
	else
	{
		foreach($campos as $key => $valor)
		{
		$where="\$this->where=\" $valor = \".\$this->bd->qstr(\$this->propiedades[\"$valor\"]);";
		$PrimaryKey[0]=$valor;
		break;
		}
	}

	$class.="<?php session_start();
	";
	/*
	$class.="

require_once(\"class_general.php\");
require_once(\"main/main.inc.php\");";
	*/
	if($this->base_datos->motor=="mysql")
	{
	$tabla2=$tabla;
	}
	else
	{
	$schema_tabla=explode(".", $tabla);
	$tabla2=$schema_tabla[1];
	}
	
	$package=str_replace("/modelo/abstraccion/creacion_modelo/creacion_sistema.php","",$_SERVER['PHP_SELF']);
        $package=str_replace("/modelo/abstraccion/creacion_modelo/framework_semilla.php","",$_SERVER['PHP_SELF']);
	$package=str_replace("/","",$package);
      
	//echo $package; exit;
	
$class.="
/**
 * Clase {$tabla2} extendida de class general <br>
 * con un metodo __construct que solicita los valores de los campos de la tabla de base de datos
 * NOTE: requiere PHP version 5 o la ultima
 * @package {$package}
 * @author framework semilla
 * @author programador: 
 * @copyright 2014 
 * @version estable
 * @license http://www.gnu.org/copyleft/lesser.html GNU Lesser General Public License
 *
 * @method Objet __construct()
 * @method void __set(\$nombre, \$valor)
 * @method string __get(\$nombre)
 * @version 1.0
 */
 
class {$tabla2} extends general {
/**
* Objeto de Conexión y Gestión de la Base de Datos implementando Abstracción con la librería ADOdb
* @var Objetc
* @access public
*/
	public \$bd;
/**
* Variable que indica en la construcción del SQL los campos necesarios, por defecto (*) todos
* @var string
* @access public
*/
	public \$campos=\"*\";
/**
* Variable que condiciona en la construcción del SQL, por defecto iguala la clave primaria al valor de la variable de construcción del Objeto.
* @var string
* @access public
*/
	public \$where;
	private \$ObjetSQL;
	private \$tabla;
	private \$propiedades = array();

/**
* función que se ejecuta al momento de instanciar o crear el Objeto
 * que la misma tiene el nombre de los campos de la base de datos, todos por defecto en NULL
 * esto con la finalidad de crear objetos vacíos
 * \$main toma la instancia con el Patrón Singleton de las variables de conexión de base de datos <br>
 * \$MotorSQL toma el motor de trabajo (PostgreSQL o MySQL) <br>
 * \$this->ObjetSQL contiene todas las instrucciones SQL necesarias para todos las clases <br>
 * \$this->bd toma una instancia con el Patrón Singleton <br>
 * \$this->propiedades tiene un índice que es la relación de los campos de la base de datos, mediante el Patron ORM <br>
 * \$this->where por defecto iguala la PK de la tabla al valor de la variable correspondiente a la PK de la clase <br>
 * \$this->tabla es el nombre de la tabla con su schema <br>
 * 
* @access public
*/
	";

	$class.="public function __construct(";
	$index=1;
	foreach($campos as $key => $valor)
	{
	if ($index < (count($campos))) {$class.="\$".$valor."=NULL,";}
	else {$class.="\$".$valor."=NULL";}
	$index++;
	}
	$class.=") {

		\$main = main::getInstance();
		\$MotorSQL = \$main->motor.\"_sql\";
		include_once(MODELO.\"abstraccion\".DS.\"db\".DS.\"{\$main->motor}-sql.lang.php\");
		\$this->ObjetSQL = new \$MotorSQL();";

	$class.="
		//\$this->bd = new db();
		  \$this->bd = db::getInstance();

	";
	foreach($campos as $key => $valor)
	{
	$class.="	\$this->propiedades[\"$valor\"]=\$$valor;
	";
	}
	/*
	$class.="
		\$this->propiedades[\"usuario\"]=\$_SESSION['usuario'];
		\$this->propiedades[\"computadora\"]=gethostbyaddr(\$_SERVER['REMOTE_ADDR']);
		\$this->propiedades[\"fecha_hora_sis\"]=date(\$this->ObjetSQL->formato_fecha);
		".$where."
		\$this->tabla=\"$tabla\";
		}";
	*/
	if($this->base_datos->motor=="mysql")
	{
	$class.="	".$where."
		\$this->tabla=\"$tabla\";
		}";
	}
	else
	{
	/*
	$class.="	".$where."
		\$this->tabla=\$this->schema.\".$tabla\";
		}";
	*/
	$class.="	".$where."
		\$this->tabla=\"$tabla\";
		}";
	}
	
$class.="
/**
* Función de métodos mágicos de PHP (php magic methods) <br>
 * con la finalidad de asignarles valores a los índice / valor existentes en \$this->propiedades<br>
 * por el contrario si no existe crea un nuevo índice en \$this->propiedades y le asigna un valor <br>
 * esto con la finalidad de tener un Objeto mas dinámico. <br>
 * Parámetros: \$nombre, \$valor <br>
 * 
* @param \$nombre índice existentes en \$this->propiedades
* @param \$valor valor existentes en \$this->propiedades
* @property string \$this->propiedades[\$nombre];
* @access public
*/
	public function __set(\$nombre, \$valor) {
		\$this->propiedades[\$nombre] = \$valor;
	}
	
/**
* Función de métodos mágicos de PHP (php magic methods) <br>
 * Parámetros: \$nombre <br>
 * Retorna: el valor del índice de la variable \$this->propiedades <br>
 * si no existe retorna NULL o vacío <br>
 * 
* @param \$nombre índice de la variable \$this->propiedades
* @return string valor del índice de la variable \$this->propiedades
* @property string \$this->propiedades[\$nombre];
* @access public
*/

	public function __get(\$nombre) {
		return \$this->propiedades[\$nombre];
	}

    public function __call(\$metodo, \$args) {
       	if (\$args) {
       		 \$method = array(&\$this->bd, \$metodo);
       		 \$a = call_user_func_array(\$method, \$args);
       	} else {
       		\$a = \$this->bd->\$metodo();
       	}
    	return \$a;
	}";

if($this->base_datos->motor=="mysql") {
$class.="
/**
* Función para insertar en la base de datos <br>
 * Parámetros: la variable \$this->propiedades <br>
 * Retorna: integer según la clave primaria si la inserción es correcta <br>
 * en caso contrario un String de Error <br>
 * 
* @return integer según la clave primaria si la inserción es correcta en caso contrario un String de Error
* @param string \$this->propiedades del Objeto Creado según los campos de la tabla
*/

	public function insertar(){
		try {
			\$record=\$this->AutoExecute(\$this->tabla,\$this->propiedades,'INSERT');
			\$retorno=\$this->Insert_ID();
		} catch (exception \$e) {
			\$retorno=\$this->ErrorMsg();
		}
	return \$retorno;
	}";
}
else{ 
/*
$class.="
	public function insertar(){
		try {
		#array_shift(\$this->propiedades);
			\$retorno=\$this->".$PrimaryKey[0]."=\$this->GenID(\$this->schema.'.{$tabla}_".$PrimaryKey[0]."_seq');
			\$record=\$this->AutoExecute(\$this->tabla,\$this->propiedades,'INSERT');

			
		} catch (exception \$e) {
			\$retorno=\$this->ErrorMsg();
		}
	return \$retorno;
	}";
*/

$class.="
/**
* Función para insertar en la base de datos <br>
 * Parámetros: la variable \$this->propiedades <br>
 * Retorna: integer según la clave primaria si la inserción es correcta <br>
 * en caso contrario un String de Error <br>
 * 
* @return integer según la clave primaria si la inserción es correcta en caso contrario un String de Error
* @param string \$this->propiedades del Objeto Creado según los campos de la tabla
*/

	public function insertar(){
		try {
		#array_shift(\$this->propiedades);
			\$retorno=\$this->".$PrimaryKey[0]."=\$this->GenID('{$tabla}_".$PrimaryKey[0]."_seq');
			\$record=\$this->AutoExecute(\$this->tabla,\$this->propiedades,'INSERT');

			
		} catch (exception \$e) {
			\$retorno=\$this->ErrorMsg();
		}
	return \$retorno;
	}";
}
$class.="

/**
* Función para actualizar en la base de datos <br>
 * Parámetros: la variable \$this->propiedades y \$this->wher <br>
 * Retorna: integer de la clave primaria si la actualización es correcta <br>
 * en caso contrario un String de Error <br>
 * 
* @return integer de la clave primaria si la actualizaron es correcta en caso contrario un String de Error
* @param string \$this->propiedades del Objeto Creado según los campos de la tabla
*/
	public function actualizar(){
		try {
			\$record=\$this->AutoExecute(\$this->tabla,\$this->propiedades,'UPDATE',\$this->where);
			if (\$record){
				\$retorno=\$this->$PrimaryKey[0];
			}
			else{
				\$retorno=false;
			}
		} catch (exception \$e) {
			\$retorno=\$this->ErrorMsg();
		}
	return \$retorno;
	}
";

$class.="
/**
* Función para eliminar en la base de datos <br>
 * Parámetros: la variable \$this->where <br>
 * Retorna: integer (1) si la eliminación es correcta <br>
 * en caso contrario un String de Error <br>
 * 
* @return integer(1) si la eliminación es correcta, en caso contrario un String de Error
* @param string \$this->where del Objeto Creado según los campos de la tabla
*/
	public function eliminar(){
	
		\$ObjetSQL=&\$this->ObjetSQL;
		
		\$sql.=sprintf(\$ObjetSQL->delete,\$this->tabla);
		
		\$sql.=sprintf(\$ObjetSQL->where,\$this->where);

		try {	
			\$record=\$this->Execute(\$sql);
			if (\$record){
				\$retorno=1;
			}
			else{
				\$retorno=false;
			}
		} catch (exception \$e) {
			\$retorno=\$this->ErrorMsg();
		}	
	return \$retorno;
	}
        
        public function actualizar_campo(\$set){
	
		\$ObjetSQL=&\$this->ObjetSQL;
		
		\$sql.=sprintf(\$ObjetSQL->update,\$this->tabla,\$set);
		
		\$sql.=sprintf(\$ObjetSQL->where,\$this->where);

		try {	
			\$record=\$this->Execute(\$sql);
			if (\$record){
				\$retorno=1;
			}
			else{
				\$retorno=false;
			}
		} catch (exception \$e) {
			\$retorno=\$this->ErrorMsg();
		}	
            return \$retorno;
	}
";
//modificado en la nueva version 1.0
/*
$class.="
	public function eliminar(){
	
		\$ObjetSQL=&\$this->ObjetSQL;
		
		\$sql=\$ObjetSQL->SqlEliminar_{$tabla};

		\$sql.=sprintf(\$ObjetSQL->SqlListarUn{$tabla},\$this->where);

		\$record=\$this->Execute(\$sql);
		if (\$record){
			\$retorno=true;
		}
		else{
			\$retorno=false;
		}
	return \$retorno;
	}
";
*/

//modificado en la nueva 1.0
//$encontro=$this->comprobar_si_tiene_vista($tabla);

//echo $encontro;
//$this->ver_variabre($key);
/*

if ($encontro)
{
$archvo_sql="
public \$SqlListar$tabla=\"select * from v_{$tabla}\";

public \$SqlListarUn$tabla=\" where %s \";

public \$SqlEliminar_{$tabla}=\"delete from {$tabla}\";

public \$SqlListarLimit_{$tabla}=\" limit %s, %s\";
";
}
else
{
$archvo_sql="
public \$SqlListar$tabla=\"select * from $tabla\";

public \$SqlListarUn$tabla=\" where %s \";

public \$SqlEliminar_{$tabla}=\"delete from {$tabla}\";

public \$SqlListarLimit_{$tabla}=\" limit %s, %s\";
";
}
*/
//$this->crear_archivo_sql($archvo_sql);
//fue modificado en la version 1.0


$class.="
/**
* Función para consultar en la base de datos <br>
 * Parámetros: \$campos con la finalidad de que utilice la \$this->where <br>
 * Parámetros: \$this->where del Objeto Creado según los campos de la tabla
 * Retorna: los registros de la consulta si es correcta <br>
 * en caso contrario un String de Error <br>
 * 
* @return Array con los datos de la consulta, en caso contrario un String de Error
* @param boolean \$campos con la finalidad de que utilice la \$this->where
* @param string \$this->where del Objeto Creado según los campos de la tabla
*/

	public function listar(\$campos=false){

		\$ObjetSQL=&\$this->ObjetSQL;

		\$this->tabla_l=\$this->tabla;";
		

$relaciones=$this->MetaForeignKeys($tabla2);

//echo "<pre>"; print_r($relaciones); exit;

	if ($relaciones) 
	{
	foreach($relaciones as $key => $valor)
	{
	
		if($this->base_datos->motor=="mysql")
		{
		
			$id_union=explode("=",$valor[0]);
			$id_union=$id_union[0];
		
		//$class.="\$this->tabla_l.=\" join tbl_ \"";
			$class.="\n\t\t\$this->tabla_l.=\" join ".$key." using(".$id_union.")\";";
			
		//$Objetos.="\trequire_once(\"../../modelo/class_{$key}.php\"); # clase del modelo";
		}
		else
		{
			$retorno=$this->todas_tablas($key);
			#$this->ver_variabre($retorno); exit;
			$retorno=$retorno[0];
			$schema_tabla=explode(".", $retorno);
			$schema=$schema_tabla[0];
			$tabla22=$schema_tabla[1];
			
			/*
			$schema_tabla=explode(".", $tabla);
			$schema=$schema_tabla[0];
			$tabla2=$schema_tabla[1];
			*/
			
			$id_union=explode("=",$valor[0]);
			$id_union=$id_union[0];
	
	$class.="\n\t\t\$this->tabla_l.=\" join ".$schema.".".$key." using(".$id_union.")\";";
			//$Objetos.="\trequire_once(\"../../../modelo/$schema/class_{$key}.php\"); # clase del modelo";
		}	
	}
	}

	
$class.="\n\t\t\$sql.=sprintf(\$ObjetSQL->select,\$this->campos,\$this->tabla_l);

		if (\$campos){
			\$sql.=sprintf(\$ObjetSQL->where,\$this->where);
		}
		\$sql.=\$this->v_limit;
		//echo \$sql; exit;
		\$record = \$this->Execute(\$sql);

		if (\$record){
			\$retorno=\$record->GetRows();
		}
		else{
			\$retorno=false;
		}

		return \$retorno;
	}

";

$class.='

/**
* Función para determinar el total de los registros de la tabla <br>
 * Parámetros: la variable \$this->where <br>
 * Retorna: integer, total_registros si la ejecución es correcta <br>
 * en caso contrario un String de Error <br>
 * <b>Descripción:</b><br>
 * $ObjetSQL=&$this->ObjetSQL; hace un enlace a la variable <br>
 * $this->campos_t=" count(*) as total_registros "; crea un índice en la variable $this->propiedades, llamado campos_t y le asigna el valor [count(*) as total_registros] <br>
 * $sql=sprintf($ObjetSQL->select,$this->campos_t,$this->tabla);  a la variable $sql le escribe en un formato pasándole los valores $ObjetSQL->select,$this->campos_t,$this->tabla <br>
 * if($this->where) si tiene valor la variable <br>
 * $sql.=sprintf($ObjetSQL->where,$this->where);  a la variable $sql le escribe en un formato pasándole los valores $this->where <br>
 * 
 * 
* @return integer, total_registros si la ejecución es correcta, en caso contrario un String de Error
* @param string \$this->where del Objeto Creado según los campos de la tabla
*/

	public function total_registros(){
	
		$ObjetSQL=&$this->ObjetSQL;
		
		$this->campos_t=" count(*) as total_registros ";
		
		$sql=sprintf($ObjetSQL->select,$this->campos_t,$this->tabla);
		
		if($this->where){
		$sql.=sprintf($ObjetSQL->where,$this->where);
		}
		
		//$sql="select count(*) as total_registros from ".$this->tabla." where ".$this->where; 					
		//sprintf($ObjetSQL->delete,$this->tabla);
		
		//$sql.=sprintf($ObjetSQL->where,$this->where);

		try {	
			$record = $this->Execute($sql);

			if ($record){
				$retorno=$record->GetRows();
				$retorno=$retorno[0]["total_registros"];
				
			}
			else{
				$retorno=false;
			}
		} catch (exception $e) {
			$retorno=$this->ErrorMsg();
		}	
	return $retorno;
	}
	';

$class.="

/**
* Función para paginar las consultas de los registros de la tabla <br>
 * Parámetros: integer $inicio donde se define el inicio de la paginación <br>
 * Parámetros: integer $fin donde se define el fin de la paginación <br>
 * Retorna: Retorna: array, de la consulta de la función \$this->listar, si la ejecución es correcta <br>
 * en caso contrario un String de Error <br>
 * 
 * 
* @return array de la función \$this->listar
* @param integer \$inicio donde se define el inicio de la paginación
* @param integer \$fin donde se define el fin de la paginación 
*/	

	public function limit(\$inicio,\$fin){

		\$ObjetSQL=&\$this->ObjetSQL;
		
		if (\$_SESSION[\"where\"]!=\"\") {\$sql=true;} else {\$sql=false;}

		\$this->v_limit=sprintf(\$ObjetSQL->limit,\$inicio,\$fin);
		
		//echo \$sql; exit;
		
		\$retorno = \$this->listar(\$sql);

		return \$retorno;
	}";

$class.="

/**
* Función para hacer una búsqueda en la consulta de los registros de la tabla
 * 
 * 
* @return array, de la consulta de la funcion \$this->listar, si la ejecución es correcta,  en caso contrario un String de Error
* @param booleam $campos para evaluar en conjunto para crear la búsqueda
* @param session \$_SESSION[\"where\"] si ya esta creado no la crea nuevamente
*/  

    public function buscar(\$campos=true){

		if ((\$campos) && (\$_SESSION[\"where\"]==\"\")) {
			\$no_buscar = array(\"id_usuario\",\"usuario\",\"computadora\",\"fecha_hora_sis\");
			foreach (\$this->propiedades as \$key => \$valor)
			{
				if((\$valor) && !(in_array(\$key, \$no_buscar)))
				{
				
					if (substr_count(\$key,\"id_\"))
					{
					\$where.=\"\$key in (\$valor) AND \";
					}
					else
					{
					\$where.=\"\$key LIKE'%\$valor%' AND \";
					}
					
				}
			}
			\$where.=\"false\";
			\$where=str_replace(\" AND false\",\"\",\$where);
			\$this->where=\$where;
			\$_SESSION[\"where\"]=\$this->where;
		}
		else
		{
			\$this->where=\$_SESSION[\"where\"];
		}

		//echo \$this->where; exit;

		\$retorno = \$this->listar(true);
		return \$retorno;
	}";
	
$Matacampos=$this->MetaColumns($tabla);
$meta=0;

foreach($Matacampos as $index => $valor)
{
	if($meta==1)
	$valor_mostras=$index;
	$meta+=1;
}

$valor_mostras=strtolower($valor_mostras);

$class.="
/**
* Función que retorna las <option> de los registros de la tabla
 * 
 * 
* @return string html para se interpretado en las etiquetas <select>
* @param integer $ver para determinar si el valor es igual al pk de la tabla para colocarlo como selected<br>
*/
	public function ver_opciones(\$ver=NULL,\$where=false)
	{

		\$campos=\$this->listar(\$where);

		if (\$campos) {

			foreach(\$campos as \$index => \$valor)
			{

				if (\$valor[\"$PrimaryKey[0]\"]==\$ver)
				{
				\$option.=\"<option value='\".\$valor[\"$PrimaryKey[0]\"].\"' selected>\".\$valor[\"".$valor_mostras."\"].\"</option>\";
				}
				else
				{
				\$option.=\"<option value='\".\$valor[\"$PrimaryKey[0]\"].\"' >\".\$valor[\"".$valor_mostras."\"].\"</option>\";
				}
			}
		}
		else {\$option = false;}

		return \$option;

	}

";

$class.="
/**
* Función que retorna las <checkbox> de los registros de la tabla
 * 
* @return string, html en etiquetas checkbox 
* @param integer \$buscado para determinar si el valor es igual al pk de la tabla para colocarlo como checked
*/
	//public function ver_checkbox_$tabla2(\$buscado)
	public function ver_checkbox(\$buscado,\$where=false)
	{

		\$campos=\$this->listar(\$where);

		if (\$campos) {

			foreach(\$campos as \$index => \$valor)
			{
				if (in_array(\$valor[\"$PrimaryKey[0]\"], \$buscado))
				{
				\$option.=\"<input type='checkbox' value='\".\$valor[\"$PrimaryKey[0]\"].\"' checked='checked' />\".\$valor[\"".$valor_mostras."\"].\"<br />\";
				}
				else
				{
				\$option.=\"<input type='checkbox' value='\".\$valor[\"$PrimaryKey[0]\"].\"' />\".\$valor[\"".$valor_mostras."\"].\"<br />\";
				}
			}
		}
		else {\$option = false;}

		return \$option;

	}

";


$class.="

/**
* Función para retornar el valor del campo de la tabla <br>
*
 * <b>Descripción:</b> lo primero que se tiene que tener en cuenta de esta función es que el objeto creado <br>
 * necesita la variable \$this->where para ser utilizado en la función \$this->listar(true), que obliga a utilizarlo <br>
 * 
* @return  string \$campo, el valor del campo en su primera posición del array
* @param string \$campo para determinar cual es el campo de la tabla
*/

	public function valor_campo(\$campo)
	{
		\$campos=\$this->listar(true);
		return \$campos[0][\$campo];
	}
";


$class.="

} //fin de la clase {$tabla2}";

$class.="\n?>";
	return $class;
}

public function crear_controlador($tabla, $campos) {
	
	if($this->base_datos->motor=="mysql")
	{
		$tabla2=$tabla;
	}
	else
	{
		$schema_tabla=explode(".", $tabla);
		$schema=$schema_tabla[0];
		$tabla2=$schema_tabla[1];
	}
	

	
	if($this->base_datos->motor=="mysql")
	{
	$controlador.="<?php
	session_start();
	require_once(\"../inc/config.sistema.php\"); # configuracion del sistema
	require_once(\"../modelo/config.modelo.php\"); # configuracion del modelo
	require_once(\"../modelo/class_$tabla2.php\"); # clase del modelo
	";
	}
	else
	{
	$controlador.="<?php
	session_start();
	require_once(\"../../inc/config.sistema.php\"); # configuracion del sistema
	require_once(\"../../modelo/config.modelo.php\"); # configuracion del modelo
	require_once(\"../../modelo/$schema/class_$tabla2.php\"); # clase del modelo
	
	";
	}
	


$controlador.="\$Obj_$tabla2 = new $tabla2(";

	$index=1;
	foreach($campos as $key => $valor)
	{
	if ($index < (count($campos))) {$controlador.="\$_REQUEST[\"".$valor."\"],";}
	else {$controlador.="\$_REQUEST[\"".$valor."\"]";}
	$index++;
	}
	$controlador.=");";

		$controlador.="
		
	switch (\$_REQUEST[\"accion\"])
	{
		case \"buscar\":
			\$_SESSION[\"where\"]=\"\";	
			if (\$Obj_{$tabla2}->buscar())
			{
				\$retorna[\"mensaje\"]=\"se agrego el registro a la Base de Datos\"; 
				\$retorna[\"datos\"]=\"\";
				\$retorna[\"estado\"]=\"encontrado\"; 
			}
			else
			{ 
			
				\$retorna[\"mensaje\"]=\"NO se encuentra registro\";
				\$retorna[\"datos\"]=\"\";
				\$retorna[\"estado\"]=\"no_encontrado\";
			}
			echo json_encode(\$retorna);
		break;
		
		case \"insertar\":";
		$Matacampos=$this->MetaColumns($tabla);
		if ($PrimaryKey=$this->MetaPrimaryKeys($tabla))
		{
		//print_r($PrimaryKey); exit;
			foreach($PrimaryKey as $key => $valor)
				{
				$valor=strtoupper($valor);
					if (($Matacampos[$valor]->auto_increment) || ($this->MetaType($Matacampos[$valor])=="R")) {	
					$valor=strtolower($valor);
					//echo "$valor".$Matacampos[$valor]->auto_increment; 
					$datos="\$_REQUEST[\"".$valor."\"]";
					$combo["index"]=$valor;
					$combo["text"]=str_replace("id_","",$valor);
					#echo "<pre>"; print_r($combo); exit;
					//echo "clave de las tablas: ".$pkey; exit;
					}//fin del si
				}
		}

		
$controlador.="
			{$datos}=\$Obj_{$tabla2}->insertar();
			if (is_numeric({$datos}))
			{  
			\$retorna[\"mensaje\"]=\"se agrego el registro a la Base de Datos\"; 
			\$retorna[\"datos\"]=\"\";
			\$retorna[\"estado\"]=\"insertado\";
			\$retorna[\"{$PrimaryKey[0]}\"]={$datos};
			}
			else
			{ 
			\$retorna[\"mensaje\"]={$datos};//\"NO se agrego el registro a la Base de Datos\";
			\$retorna[\"datos\"]=\"\";
			\$retorna[\"estado\"]=\"false\";
			}
			echo json_encode(\$retorna);

		break;
		
		case \"actualizar\":
			{$datos}=\$Obj_{$tabla2}->actualizar();
			if (is_numeric({$datos}))
			{  
				\$retorna[\"mensaje\"]=\"se actualizo...\"; 
				\$retorna[\"datos\"]=\"\";
				\$retorna[\"estado\"]=\"actualizado\";
			}
			else
			{ 
				\$retorna[\"mensaje\"]=\"NO se actualizo \".{$datos};//\"NO se agrego el registro a la Base de Datos\";
				\$retorna[\"datos\"]=\"\";
				\$retorna[\"estado\"]=\"false\";
			}
			echo json_encode(\$retorna); 
		break;
		
		case \"eliminar\":
		\$Obj_{$tabla2}->where=\" {$valor} in (\".{$datos}.\")\";
		{$datos}=\$Obj_{$tabla2}->eliminar();
			if (is_numeric({$datos}))
			{  
				\$retorna[\"mensaje\"]=\"se elimino...\"; 
				\$retorna[\"datos\"]=\"\";
				\$retorna[\"estado\"]=\"eliminado\";
			}
			else
			{ 
				\$retorna[\"mensaje\"]=\"No se elimino...\".{$datos};
				\$retorna[\"datos\"]=\"\";
				\$retorna[\"estado\"]=\"false\";
			}
			echo json_encode(\$retorna); 
		break;
		
		case \"combo\":
			
			\$_SESSION[\"where\"]=\"\";	
			\$combo=\$Obj_{$tabla2}->listar();
			\$options=array();
			
			\$options[0][\"value\"]=\"\";
			\$options[0][\"text\"]=\"Seleccione...\";
			
				
			foreach(\$combo as \$index => \$valor)
			{
				\$options[\$index+1][\"value\"]=\$valor[\"".$combo["index"]."\"];
				\$options[\$index+1][\"text\"] =\$valor[\"".$combo["text"]."\"];
			}
			
			\$retorna=\$options;
			echo json_encode(\$retorna);
			 
		break;
		
		case \"combo_dependiente\":
			
			\$_SESSION[\"where\"]=\"\";	
			
			\$Obj_{$tabla2}->where=\$_REQUEST[\"where\"];
			
			\$combo=\$Obj_{$tabla2}->listar(true);
			\$options=array();
			
			\$options[0][\"value\"]=\"\";
			\$options[0][\"text\"]=\"Seleccione...\";
			
				
			foreach(\$combo as \$index => \$valor)
			{
				\$options[\$index+1][\"value\"]=\$valor[\"".$combo["index"]."\"];
				\$options[\$index+1][\"text\"] =\$valor[\"".$combo["text"]."\"];
			}
			
			\$retorna=\$options;
			echo json_encode(\$retorna);
			 
		break;
	}	
	
	?>
	";
	#echo "<pre>"; print_r($controlador); exit; 
return $controlador;
}




public function crear_objectos_relacionados($tabla)
{
	if($this->base_datos->motor=="mysql")
	{
	$tabla2=$tabla;
	}
	else
	{
	$schema_tabla=explode(".", $tabla);
	$schema=$schema_tabla[0];
	$tabla2=$schema_tabla[1];
	}
	
$objetos_combos=array();
$objetos_combos_nombre=array();
$i=0;
	$relaciones=$this->MetaForeignKeys($tabla2);
#	$this->ver_variabre($relaciones); exit;
	if ($relaciones) {
	foreach($relaciones as $key => $valor)
	{
	
		if($this->base_datos->motor=="mysql")
		{
			$Objetos.="\trequire_once(\"../../modelo/class_{$key}.php\"); # clase del modelo";
		}
		else
		{
			#se tiene que averiguar a que schema orresponde la tabla
			#estoy_aqui# 
			$retorno=$this->todas_tablas($key);
			#$this->ver_variabre($retorno); exit;
			$retorno=$retorno[0];
			$schema_tabla=explode(".", $retorno);
			$schema=$schema_tabla[0];
			$tabla2=$schema_tabla[1];
			$Objetos.="\trequire_once(\"../../../modelo/$schema/class_{$key}.php\"); # clase del modelo";
		}
	
	
	$Objetos.="
	\t\$Obj_{$key} = new {$key};";
	$objetos_combos_nombre[$i]=$key;
	$nvalor=explode("=",$valor[0]);
	$objetos_combos[$i]=$nvalor[0];
	$i++;
	}
	}
		foreach($objetos_combos as $index => $valor)
		{
		$objetos_combos[$valor]=$index;
		}
	$retorno=array();
	$retorno[0]=$Objetos;
	$retorno[1]=$objetos_combos;
	$retorno[2]=$objetos_combos_nombre;
	//$this->ver_variabre($retorno); exit;
	return $retorno;
	
}

public function validar_objetos($tabla, $validadciones)
{
	if($this->base_datos->motor=="mysql")
	{
	$tabla2=$tabla;
	}
	else
	{
	$schema_tabla=explode(".", $tabla);
	$schema=$schema_tabla[0];
	$tabla2=$schema_tabla[1];
	}
$objeto_validar="
\$(document).ready(function(){

/*CODIGO_PROCESAR*/
	
		if ($(\"#accion\").val()!=\"buscar\") {	
		var RULES = {";
		
		

		foreach($validadciones as $index => $valor)
		{
				foreach($valor as $v_index => $v_valor)
				{
					$objeto_validar.="
					{$v_valor}:{
						required: true	
					},";
				}
		}
					
$objeto_validar.="};
	}
	else
	{
		var RULES = {};
	}

	\$(\"#frm_formulario\").validate({
		rules: RULES,";
	
$objeto_validar.="
		 submitHandler: function(form) {
		 
		 if (($(\"#accion\").val()==\"eliminar\") && (!(confirm(\"confirme que quiere eliminar el registro?\")))){
				return false;
				}
		 
				bloqueo();
			  	dataString = $(form).serialize();
				";
				
	if($this->base_datos->motor=="mysql")
	{
	$tabla2=$tabla;
	$objeto_validar.="$.post(\"../../controlador/{$tabla2}.php\", dataString, procesar, \"json\");";
	}
	else
	{
	$schema_tabla=explode(".", $tabla);
	$schema=$schema_tabla[0];
	$tabla2=$schema_tabla[1];
	$objeto_validar.="$.post(\"../../../controlador/{$schema}/{$tabla2}.php\", dataString, procesar, \"json\");";
	}


$objeto_validar.="	
			return false;   
		 }
		 });
		 
	//\$(\"#telefono\").mask(\"(9999) 999-9999\");
	//\$(\"#fecha_expedicion\").mask(\"9999-99-99\");
	";

	foreach($validadciones["TD"] as $v_index => $v_valor)
	{
		$objeto_validar.="\$(\"#$v_valor\").datepicker({dateFormat: 'yy-mm-dd'});\n";
	}
	
$objeto_validar.="//\$(\"#valido_hasta\").mask(\"9999-99-99\");		 

/*CODIGO_DETALLE*/
fun_continuar_detalle({});

});

function fun_continuar_detalle(data){
		/*CODIGO_OBSERVER*/
}

";

	if($this->base_datos->motor=="mysql")
	{
	$tabla2=$tabla;
	$fsalida="../../../js/validaciones/{$tabla2}.js";
	}
	else
	{
	$schema_tabla=explode(".", $tabla);
	$schema=$schema_tabla[0];
	$tabla2=$schema_tabla[1];
	@mkdir("../../../js/validaciones/$schema");
	$fsalida="../../../js/validaciones/{$schema}/{$tabla2}.js";
	}

$this->crear_archivo($fsalida,$objeto_validar);

$this->ver_variabre($objeto_validar);
//exit;
return $objeto_validar;

}

public function crear_vista($tabla, $campos, $tipo) {
	
	if($this->base_datos->motor=="mysql")
	{
	$tabla2=$tabla;
	}
	else
	{
	$schema_tabla=explode(".", $tabla);
	$tabla2=$schema_tabla[1];
	}

$relaciones=$this->crear_objectos_relacionados($tabla);

	if ($tipo!="listar")
	{
	$Matacampos=$this->MetaColumns($tabla);
	
	//print_r($this->MetaPrimaryKeys($tabla));
	//echo "<pre>";
	//print_r($Matacampos);
	
		if ($PrimaryKey=$this->MetaPrimaryKeys($tabla))
		{
		//print_r($PrimaryKey);
			foreach($PrimaryKey as $key => $valor)
				{
				$valor=strtoupper($valor);
					if (($Matacampos[$valor]->auto_increment) || ($this->MetaType($Matacampos[$valor])=="R")) {	
					$valor=strtolower($valor);
					//print_r($Matacampos[$valor]);	
					//echo "$valor".$Matacampos[$valor]->auto_increment; 
					$keys.="<input name=\"$valor\" type=\"hidden\" value=\"<?php echo \$_REQUEST[\"$valor\"]?>\" />\n";
					$pkey=$valor;
					//echo "clave de las tablas: ".$pkey; exit;
					}//fin del si
				}
		}
		else
		{
			foreach($campos as $key => $valor)
			{
			/*$keys="<input name=\"$valor\" type=\"hidden\" value=\"<?php echo \$_REQUEST[\"$valor\"]?>\" />\n";*/
			$PrimaryKey[0]=$valor;
			$pkey=$valor;
			break;
			}
		}
		
		
	if ($tipo=="formulario") {
	
		if($this->base_datos->motor=="mysql")
		{
			$codigo=" 	include(\"../../inc/config.sistema.php\");
						require_once(\"../../modelo/config.modelo.php\"); # configuracion del modelo
						{$relaciones[0]}

					\$_SESSION[\"where\"]=\"\";
			";
		}
		else
		{
			$schema_tabla=explode(".", $tabla);
			$schema=$schema_tabla[0];
			$tabla2=$schema_tabla[1];
			$codigo="
					include(\"../../../inc/config.sistema.php\");
					require_once(\"../../../modelo/config.modelo.php\"); # configuracion del modelo
					{$relaciones[0]}

				\$_SESSION[\"where\"]=\"\";
			";
		}

	/*
		$codigo="
			require_once(\"../../modelo/config.modelo.php\"); # configuracion del modelo
			{$relaciones[0]}

		\$_SESSION[\"where\"]=\"\";
		";
	*/

	}

/*	if($tipo=="buscar"){
		$vista.="
		<div id=\"div_respuesta\" align=\"center\"></div><br>
		<form id=\"frm_{$tipo}\" name=\"frm_{$tipo}\" method=\"post\" action=\"../../controlador/$tabla.php\">
		";
	} else {	*/
	if($this->base_datos->motor=="mysql")
		{
					$vista.="
		<script type=\"text/javascript\" src=\"/<?php echo \$sistema; ?>/js/validaciones/{$tabla2}.js\"></script>";

		}
		else
		{
			$schema_tabla=explode(".", $tabla);
			$schema=$schema_tabla[0];
			$tabla2=$schema_tabla[1];

		$vista.="
		<script type=\"text/javascript\" src=\"/<?php echo \$sistema; ?>/js/validaciones/{$schema}/{$tabla2}.js\"></script>";
		}


		$vista.="

		<form id=\"frm_{$tipo}\" name=\"frm_{$tipo}\" class=\"form-horizontal\" role=\"form\" method=\"post\"> <!--  method=\"post\" action=\"javascript:void(null);\" onSubmit=\"return validar_{$tabla}(this);\" -->
		";
//	}
		$vista.="
		<input name=\"accion\" id=\"accion\" type=\"hidden\" value=\"<?php echo \$_REQUEST[\"accion\"]?>\" />
		<input name=\"quien\" id=\"quien\" type=\"hidden\" value=\"<?php echo \$_REQUEST[\"quien\"]?>\" />\n";

		$vista.="\t".$keys;
		$tabla_titulo=str_replace($this->identificador_tabla,"",$tabla2);
		$tabla_titulo=str_replace("_"," ",$tabla_titulo);
		$tabla_titulo=ucwords($tabla_titulo);
		$tipo=ucwords($tipo);

		$vista.="<fieldset>
		<!-- Nombre del Formulario -->
		<legend>
			<?php echo strtoupper(str_replace(\"_\",\" \",\$_REQUEST[\"accion\"])); ?> - {$tabla_titulo}
		</legend>";
		  $validaciones=array();
		  $i=0;
		foreach($campos as $key => $valor)
		{
		$i++;
	#		if ($key < $index) {$vista.="\$_REQUEST[\"".$valor."\"],";}			else {$vista.="\$_REQUEST[\"".$valor."\"]";}

/* ojo *-/
echo "<pre>";
print_r($Matacampos[$key]);
echo "/<pre>";
exit;
/-* ojo */
		if (($valor!=$pkey) && ($Matacampos[$key]->auto_increment!="1"))  {
		
			$valorT=str_replace("id_","",$valor);
			$valorT=str_replace($this->campos_relacionados,"",$valor);
			$valorT=str_replace("_"," ",$valorT);
			$valorT=str_replace("id "," ",$valorT);
			
		//$this->ver_variabre($relaciones[2][$relaciones[1][$valor]]);
		//$this->ver_variabre($Matacampos[$key]); exit;
		
		if (substr_count($valor,$this->campos_relacionados) or (array_key_exists($valor,$relaciones[1])))  {	
			$valorT2=str_replace("id_","",$valor);
			//$valorT2=str_replace("id_","",$valorT2);
			$valorT2=str_replace("id ","",$valorT2);
			$valorT2=str_replace("_"," ",$valorT2);
			$valorT2 = ucwords(strtolower($valorT2));
			/*
			$vista.="<tr>
				\t<td class=\"tituloCelda\">$valorT2</td>
				\t<td>";
			*/
			$vista.="
			<div class=\"form-group\">
				 <label for=\"$valor\" class=\"col-sm-3 control-label\">
					$valorT2
				 </label>";	
				
			$valorT2=strtolower($valorT2);
			if ($Matacampos[$key]->not_null) {$not_null="*";} else {$not_null="";}
			
			if($valorT2=="usuario"){
				$vista.="<div class=\"col-sm-9\">
		<?php echo \$_SESSION[\"session_usuario\"][\"usuario\"] ?>
						<input type=\"hidden\" name=\"usuario\" id=\"usuario\" value=\"<?php echo \$_SESSION[\"session_usuario\"][\"usuario\"]?>\" />
					\t</div>
                \t</div>";
			
			}
			else
			{	
				$vista.="
				<div class=\"col-sm-9\">
					
					\t<select name=\"{$valor}\" id=\"{$valor}\" class=\"form-control\" title=\"Seleccionar $valorT2\">
					\t\t<option value=\"\">Seleccione...</option>
					\t\t<?php echo \$Obj_".$relaciones[2][$relaciones[1][$valor]]."->ver_opciones(\$_REQUEST[\"{$valor}\"]);?>
					\t</select>{$not_null}
					
				</div>
			</div>";
			}
				if ($Matacampos[$key]->not_null) {$seleccion[$i]=$valor;}
				
				
			}
			else if (($Matacampos[$key]->type=="text") or ($Matacampos[$key]->type=="tinytext"))
			{
			if ($Matacampos[$key]->not_null) {$not_null="*";} else {$not_null="";}
			$valorT = ucwords(strtolower($valorT));
						
			$vista.="
			<div class=\"form-group\">
				 <label for=\"$valor\" class=\"col-sm-3 control-label\">
					$valorT
				 </label>
				<div class=\"col-sm-9\">
					
					<textarea class=\"form-control\" name=\"$valor\" id=\"$valor\" cols=\"50\" rows=\"7\" title=\"Insertar $valorT\"><?php echo \$_REQUEST[\"$valor\"]; ?></textarea>{$not_null}
					
				</div>
			</div>";	
							
				if ($Matacampos[$key]->not_null) {$textarea[$i]=$valor;}
			}
			elseif (($Matacampos[$key]->type=="timestamp") OR ($Matacampos[$key]->type=="date") OR ($Matacampos[$key]->type=="datetime"))
			{
			if ($Matacampos[$key]->not_null) {$not_null="*";} else {$not_null="";}	
			$valorT = ucwords(strtolower($valorT));	
			$vista.="
			<div class=\"form-group\">
				 <label for=\"$valor\" class=\"col-sm-3 control-label\">
					$valorT
				 </label>
				<div class=\"col-sm-9\">
					
					<input name=\"$valor\" id=\"$valor\" type=\"text\" class=\"form-control\" maxlength=\"10\" size=\"12\" value=\"<?php echo \$_REQUEST[\"$valor\"]; ?>\" title=\"Insertar $valorT\" placeholder=\"$valorT\" />{$not_null}
				</div>
			</div>";	
			if ($Matacampos[$key]->not_null) {$TextoDate[$i]=$valor;}
			}
			else
			{
			if ($Matacampos[$key]->not_null) {$not_null="*";} else {$not_null="";}			
				if($Matacampos[$key]->max_length<0) {$Matacampos[$key]->max_length="11";}
			$valorT = ucwords(strtolower($valorT));
			$vista.="
			<div class=\"form-group\">
				 <label for=\"$valor\" class=\"col-sm-3 control-label\">
					$valorT
				 </label>
				<div class=\"col-sm-9\">
					
					<input name=\"$valor\" id=\"$valor\" type=\"text\" class=\"form-control\" maxlength=\"".$Matacampos[$key]->max_length."\" size=\"12\" value=\"<?php echo \$_REQUEST[\"$valor\"]; ?>\" title=\"Insertar $valorT\" placeholder=\"$valorT\" />{$not_null}
				</div>
			</div>";
				if ($Matacampos[$key]->not_null) {$Texto[$i]=$valor;}
			}
			

			}//FIN DE LA CONSULTA DE CLAVE PRIMARIA
			
						
			}
			
			$validaciones["S"]=$seleccion;
			$validaciones["TA"]=$textarea;
			$validaciones["TD"]=$TextoDate;
			$validaciones["T"]=$Texto;
			
			
		$this->validar_objetos($tabla, $validaciones);
		//exit;

		$vista.='
		<div class="form-group">
			<div class="col-sm-offset-3 col-sm-9 boton-grupo">
				 <button type="submit" class="btn btn-success">
					<?php echo strtoupper(str_replace("_"," ",$_REQUEST["accion"])); ?>
				 </button>

				 <button type="reset" class="btn btn-danger">
					Cancelar
				 </button>
			</div>
		</div>
		
		
		</fieldset>
	</form>
	<br />
	<div id="div_listar"></div>
	<div id="cargando"></div>
	';
	}
	else
	{
		$vista = $this->crear_vista_listar($tabla,$campos);
		$codigo=$vista[1];
		$vista=$vista[0];
	}
	
	
	return array("codigo"=>$codigo,"vista"=>$vista);
}


public function crear_vista_listar($tabla,$campos) {

if ($this->comprobar_si_tiene_vista($tabla)) 
{
$campos=$this->ver_campos("vis_".$tabla);
}

	if($this->base_datos->motor=="mysql")
		{
			$codigo="
			require_once(\"../../inc/config.sistema.php\"); # configuracion del modelo
			require_once(\"../../modelo/config.modelo.php\"); # configuracion del modelo
			require_once(\"../../modelo/class_$tabla.php\"); # clase del modelo
		
			\$Obj_$tabla = new $tabla(";
			$tabla2=$tabla;
		}
		else
		{
			$schema_tabla=explode(".", $tabla);
			$schema=$schema_tabla[0];
			$tabla2=$schema_tabla[1];
			$codigo="
			require_once(\"../../../inc/config.sistema.php\"); # configuracion del modelo
			require_once(\"../../../modelo/config.modelo.php\"); # configuracion del modelo
			require_once(\"../../../modelo/$schema/class_$tabla2.php\"); # clase del modelo
		
			\$Obj_$tabla2 = new $tabla2(";	

		}

	
	$index=1;
	foreach($campos as $key => $valor)
	{
	if ($index < (count($campos))) {$codigo.="\$_REQUEST[\"".$valor."\"],";}
	else {$codigo.="\$_REQUEST[\"".$valor."\"]";}
	$index++;
	}

	$codigo.=");";


	$codigo.="
		if (\$_REQUEST[\"accion\"]==\"buscar\") {
			if (\$resultados=\$Obj_{$tabla2}->buscar())
			{  }
			else
			{ \$Obj_{$tabla2}->enviar_formulario(\"formulario.php?accion=buscar\",\$_REQUEST); }

		} else
		{
			\$_SESSION[\"where\"]=\$Obj_{$tabla2}->where=\"\";
			\$resultados=\$Obj_{$tabla2}->total_registros();
		}
	";

/*	$vista.="
	
		<div id=\"panel\">
		<a href=\"formulario.php?accion=insertar\" class=\"boton\">Insertar</a>
		<a href=\"formulario.php?accion=buscar\" class=\"boton\">Buscar</a>
		<!--<a onClick=\"eliminar()\" href=\"#\" class=\"boton\">Eliminar</a> -->
		<a href=\"listar.php\" class=\"boton\">Listar</a>
		<br><br>
		</div>";
*/
$vista.="
		<?php 
		
		if (!(\$_REQUEST[\"inicio\"])) { 
			\$_REQUEST[\"inicio\"]=0;
			\$_REQUEST[\"fin\"]=50;
		}
		
		if(is_array(\$resultados)){
			\$cantidad=count(\$resultados); //exit;
		}
		else{
			\$cantidad=\$resultados; //exit;
		}
		
		//\$cantidad=count(\$resultados);
		
		\$resultados=\$Obj_{$tabla2}->limit(\$_REQUEST[\"inicio\"],\$_REQUEST[\"fin\"]);
		
		\$_REQUEST[\"indice\"]=(\$_REQUEST[\"inicio\"]/50)+1;
		\$_REQUEST[\"inicio\"]=0;
		\$_REQUEST[\"fin\"]=50;
	   
		?>
		
		<center>
			<?php echo \"pagina \".\$_REQUEST[\"indice\"].\" de \"; ?> 
			<a href=\"listar.php?accion=<?php echo \$_REQUEST[\"accion\"]; ?>&inicio=0&fin=50\">1&nbsp;</a>
			<?php for(\$i=1;\$i<(\$cantidad/50);\$i++) { ?> 
			<a href=\"listar.php?accion=<?php echo \$_REQUEST[\"accion\"]; ?>&inicio=<?php echo \$_REQUEST[\"inicio\"]+=50;?>&fin=<?php echo \$_REQUEST[\"fin\"]=50; ?>\"><?php echo (\$i+1).\"&nbsp;\"; ?></a>
			<?php  } ?>
	
		</center>
		 <br>
<script src=\"../../../js/validaciones/listar.js\"></script>

<!--<div align=\"right\"><span class=\"boton imprimir\">Imprimir</span></div><br />
-->
<div id=\"panel_exportar\"></div>
		<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" class=\"display\" id=\"tb_listar\" width=\"90%\">\n";
		$vista.="<thead>\n";
	  $vista.="<tr class=\"tituloCelda\">\n";
	  
	  $index_c=0;
		foreach($campos as $key => $valor){
		//if (!(substr_count($valor,"id_")))  {
			$valor2=str_replace("id_","",$valor);
			if($index_c==0){
				$index_c=1;
				$valor_sin_id=$valor;		
			}
			else
			{
				$valor_sin_id=str_replace("id_","",$valor);
			}
			// "<pre>"; print_r($valor_sin_id); 
			$valor2=str_replace("_"," ",$valor2);
			
			$vista.="\t<th>$valor2</th>\n";
			$vista2.="\t<td><?php echo \$valor[\"$valor_sin_id\"]; ?></td>\n";
		//}
		}
		//exit;
	  $vista.="\t<th>ACCION</th>\n";

	$vista.="</tr>\n";
	$vista.="</thead>\n";	
	$vista.="
	<?php \$i=0; foreach (\$resultados as \$key => \$valor) { ?>
	<tr class=\"Contenido\" <?php echo \$Obj_{$tabla2}->color_fondo(); ?>>
	  $vista2
		<td>
			<?php 
			switch(\$_REQUEST[\"quien\"])
			{
			case \"actualizar\":
			\$valor[\"accion\"]=\"actualizar\";
			\$Obj_{$tabla2}->enviar_formulario(\"formulario.php\",\$valor,\$boton=\"\",false,\"formulario_actualizar_\".\$i);
			break;
			
			case \"eliminar\":
			\$valor[\"accion\"]=\"eliminar\";
			\$Obj_{$tabla2}->enviar_formulario(\"formulario.php\",\$valor,\$boton=\"\",false,\"formulario_eliminar_\".\$i);
			break;
			
			default:
			\$valor[\"accion\"]=\"actualizar\";
			\$Obj_{$tabla2}->enviar_formulario(\"formulario.php\",\$valor,\$boton=\"\",false,\"formulario_actualizar_\".\$i);
			\$valor[\"accion\"]=\"eliminar\";
			\$Obj_{$tabla2}->enviar_formulario(\"formulario.php\",\$valor,\$boton=\"\",false,\"formulario_eliminar_\".\$i);
			}
			?>

	
<div class=\"grupo-btn\">
	<button class=\"btn btn-primary\" onClick=\"frm_envir(<?php echo \"formulario_actualizar_\".\$i; ?>)\">
		Actualizar
	</button>
	
	<button class=\"btn btn-danger\" onClick=\"frm_envir(<?php echo \"formulario_eliminar_\".\$i; ?>)\">
		Eliminar
	</button>
</div>
	
	
		</td>
	 
	</tr>\n
	<?php \$i++; } ?>";
	
	$vista.="</table>";

return $vista2 = array($vista,$codigo);
}


	public function crear_archivo_class($contenido,$tabla)
	{
	
		if($this->base_datos->motor=="mysql")
		{
			$tabla2=$tabla;
			$fsalida="../../class_$tabla.php";
		}
		else
		{
			$schema_tabla=explode(".", $tabla);
			$schema=$schema_tabla[0];
			$tabla2=$schema_tabla[1];
			@mkdir("../../$schema", 0777);
			$fsalida="../../$schema/class_$tabla2.php";
		}
		$this->crear_archivo($fsalida,$contenido);
	}

	public function crear_archivo_controlador($contenido,$tabla)
	{
		if($this->base_datos->motor=="mysql")
		{
			$tabla2=$tabla;
			$fsalida="../../../controlador/$tabla.php";
		}
		else
		{
			$total = explode(".", $tabla);
			$schema=$total[0];
			$tabla=$total[1];
			@mkdir("../../../controlador/$schema", 0777);
			$fsalida="../../../controlador/$schema/$tabla.php";
		}
		$this->crear_archivo($fsalida,$contenido);
	}

	public function crear_archivo_vista($contenido,$tabla,$tipo,$codigo="#*CODIGO*#")
	{
		if($this->base_datos->motor=="mysql")
		{
			$tabla2=$tabla;
			
			@mkdir("../../../vista/{$tabla}", 0777);
			$fsalida="../../../vista/{$tabla}/{$tipo}.php"; //{$tabla}_
			
		}
		else
		{
			$total = explode(".", $tabla);
			$schema=$total[0];
			$tabla=$total[1];
			@mkdir("../../../vista/$schema", 0777);
			@mkdir("../../../vista/$schema/{$tabla}", 0777);
			$fsalida="../../../vista/$schema/{$tabla}/{$tipo}.php"; //{$tabla}_
		}

		$nombre_archivo = "../../../vista/plantilla/$this->plantilla";
		$gestor = fopen($nombre_archivo, "r");
		$plantilla = fread($gestor, filesize($nombre_archivo));
		fclose($gestor);
		$plantilla=str_replace("#*VISTA*#",$contenido,$plantilla);
		$plantilla=str_replace("#*CODIGO*#",$codigo,$plantilla);
		#echo $plantilla; exit;
		$this->crear_archivo($fsalida,$plantilla);
	}

	public function crear_archivo_menu($tabla)
	{

		//$contenido=$this->agregar_menu($tabla);

		$nombre_archivo = "../../../js/opcionesMenu.js.php";
		/*
		$gestor = fopen($nombre_archivo, "r");
		$plantilla = fread($gestor, filesize($nombre_archivo));
		fclose($gestor);
		$plantilla=str_replace("#*VISTA*#",$contenido,$plantilla);
		#echo $plantilla; exit;
		$this->crear_archivo($fsalida,$plantilla);
		*/

		 if (!$descriptor = fopen($nombre_archivo,"r"))
		 {
		  echo 'Error el archivo no puede abrirse'; }
		else
		 {
			while (!feof($descriptor)) {
				$buffer = fgets($descriptor, 4096);
				if (substr_count($buffer,"//menu=")) {
					$buffer=chop(trim($buffer));

					$numero=substr($buffer, -2);
					$numero++;
					$buffer="//menu=0$numero\n";
				}
				$buffer2.=$buffer;
			}
		    fclose($descriptor);
		   // echo "numero: ".$numero; exit;
		 }
		$nuevo_menu=$this->agregar_menu($tabla,(int)$numero);
		
		$buscalo = strrpos($buffer2,"new Array(\"$tabla\",\"\",\"\",5,16,150);");
///		echo "lo buscado".$buscalo."<br>".$buffer2."<br><br><br><br><br>".$nuevo_menu; exit;
		if ($buscalo==0){
		$buffer2=str_replace("//#*Menu*#//",$nuevo_menu,$buffer2);
		$buffer2.="\n//#*Menu*#//";

		$buffer2=str_replace("var NoOffFirstLineMenus=".($numero-1).";			// Number of first level items","var NoOffFirstLineMenus=".$numero.";			// Number of first level items",
		$buffer2);

		//echo $numero; exit;
		$this->crear_archivo($nombre_archivo,$buffer2);
		}

	}
	
	public function crear_archivo_sql($codigo)
	{
		//$contenido=$this->agregar_menu($tabla);
		$nombre_archivo = "../db/{$this->base_datos->motor}-sql.lang.php";
		$crear=false;
		if (!(file_exists($nombre_archivo)))
		{
			$nombre_archivo = "../db/sql-sql.lang.php";
			$crear=true;
		}
			if (!$descriptor = fopen($nombre_archivo,"r"))
			 { echo 'Error el archivo no puede abrirse'; }
			else
			 { 
				//$gestor = &$descriptor;//fopen($nombre_archivo, "r");
				$archivo_sql = fread($descriptor, filesize($nombre_archivo));
				fclose($descriptor);
				$buscalo = strrpos($archivo_sql,$codigo);
				/*
				echo "Buscras".$buscalo."<br>";
				echo $codigo."<br>";
				exit;
				*/
				if ($buscalo==0)
				{
				$archivo_sql=str_replace("#*CODIGO*#",$codigo."\n\n#*CODIGO*#",$archivo_sql);
				}
				if ($crear) 
				{
				$archivo_sql=str_replace
				("sql_sql",$this->base_datos->motor."_sql",$archivo_sql);
				$nombre_archivo = "../db/{$this->base_datos->motor}-sql.lang.php";
				}
				
				//echo $archivo_sql; 
				$this->crear_archivo($nombre_archivo,$archivo_sql);
			   // echo "numero: ".$numero; exit;
			 }
		
	}

	public function crear_archivo($fsalida,$contenido)
	{			
//	echo "$contenido"; 	echo "<br>"; exit;
		
		if (file_exists($fsalida)){
			#echo "intento de copiar: ".$fsalida.date("Y-m-d H:i:s");
			rename($fsalida,$fsalida." old ".date("d-m-Y H-i-s"));
		}
				
		if (!$punt = fopen($fsalida,"w"))
		   { echo 'Error el archivo no puede abrirse'; }
		else
		{ 
			rewind($punt);
			if (fwrite($punt, $contenido) === FALSE) {
				echo "No se puede escribir al archivo ($archivo)"; }
			fclose($punt);
		}
	}

} #fin de las clase tables


?>
