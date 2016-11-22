 <?php

class tables {

protected $base_datos;
public $identificador_tabla="tbl_";
public $campos_relacionados="FK_";
public $plantilla="plantilla_sistema.php";

	private function ver_variabre($var)
	{
		echo "<pre>";
		print_r($var);
		echo "</pre>";
	}

	public function __construct()
	{
	$this->base_datos = new db();
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


	public function ver_tablas() {
	$tablas=$this->MetaTables('TABLES');
	foreach($tablas as $index => $valor)
			$RETORNAR.="\n\t<option value=\"".$valor."\">".$valor."</option>\n";
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
$class.="
class {$tabla} extends general {

	public \$bd;
	public \$where;
	private \$ObjetSQL;
	private \$tabla;
	private \$propiedades = array();

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
		include_once (\"abstraccion/db/{\$main->motor}-sql.lang.php\");
		\$this->ObjetSQL = new \$MotorSQL();";

	$class.="
		\$this->bd = new db();

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
	$class.="	".$where."
		\$this->tabla=\"$tabla\";
		}";

$class.="

	public function __set(\$nombre, \$valor) {
		\$this->propiedades[\$nombre] = \$valor;
	}

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

$class.="
	public function insertar(){
		try {
			\$record=\$this->AutoExecute(\$this->tabla,\$this->propiedades,'INSERT');
			\$retorno=\$this->Insert_ID();
		} catch (exception \$e) {
			\$retorno=\$this->ErrorMsg();
		}
	return \$retorno;
	}";
$class.="
	public function actualizar(){
		try {
			\$record=\$this->AutoExecute(\$this->tabla,\$this->propiedades,'UPDATE',\$this->where);
			if (\$record){
				\$retorno=true;
			}
			else{
				\$retorno=false;
			}
		}catch (exception \$e) {
			\$retorno=\$this->ErrorMsg();
		}
	
	return \$retorno;
	}
";

$class.=
	"
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

$encontro=$this->comprobar_si_tiene_vista($tabla);

//echo $encontro;
//$this->ver_variabre($key);
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

$this->crear_archivo_sql($archvo_sql);

$class.="

	public function listar(\$campos=false){

		\$ObjetSQL=&\$this->ObjetSQL;

		\$sql=\$ObjetSQL->SqlListar$tabla;

		if (\$campos){
			\$sql.=sprintf(\$ObjetSQL->SqlListarUn$tabla,\$this->where);
		}

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

$class.="
	public function limit(\$inicio,\$fin){

		\$ObjetSQL=&\$this->ObjetSQL;

		\$sql=\$ObjetSQL->SqlListar$tabla;
		
		if (\$this->where!=\"\") {
		\$sql.=sprintf(\$ObjetSQL->SqlListarUn$tabla,\$this->where);
		}

		\$sql.=sprintf(\$ObjetSQL->SqlListarLimit_$tabla,\$inicio,\$fin);
		
		//echo \$sql; exit;
		
		\$record = \$this->Execute(\$sql);

		if (\$record){
			\$retorno=\$record->GetRows();
		}
		else{
			\$retorno=false;
		}

		return \$retorno;
	}";

$class.="
    public function buscar(\$campos=true){

		\$ObjetSQL=&\$this->ObjetSQL;

		\$sql=\$ObjetSQL->SqlListar$tabla;

		if (\$campos){
			\$no_buscar = array(\"usuario\",\"computadora\",\"fecha_hora_sis\");
			foreach (\$this->propiedades as \$key => \$valor)
			{
				if((\$valor) && !(in_array(\$key, \$no_buscar)))
				{
				\$where.=\"\$key LIKE'%\$valor%' OR \";
				}
			}
			\$where.=\"false\";
			\$where=str_replace(\" OR false\",\"\",\$where);
			\$sql.=sprintf(\$ObjetSQL->SqlListarUn$tabla,\$where);
		}

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

$class.="

	public function ver_opciones_$tabla(\$ver=NULL)
	{

		\$campos=\$this->listar();

		if (\$campos) {

			foreach(\$campos as \$index => \$valor)
			{

				if (\$valor[\"$PrimaryKey[0]\"]==\$ver)
				{
				\$option.=\"<option value='\".\$valor[\"$PrimaryKey[0]\"].\"' selected>\".\$valor[\"$PrimaryKey[0]\"].\"</option>\";
				}
				else
				{
				\$option.=\"<option value='\".\$valor[\"$PrimaryKey[0]\"].\"' >\".\$valor[\"$PrimaryKey[0]\"].\"</option>\";
				}
			}
		}
		else {\$option = false;}

		return \$option;

	}

";

$class.="

} //fin de la clase {$tabla}";

$class.="\n?>";
	return $class;
}


public function crear_controlador($tabla, $campos) {
$controlador.="<?php
	session_start();
	require_once(\"../inc/config.sistema.php\"); # configuracion del sistema
	require_once(\"../modelo/config.modelo.php\"); # configuracion del modelo
	require_once(\"../modelo/class_$tabla.php\"); # clase del modelo

	\$Obj_$tabla = new $tabla(";

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
			if (\$resultados=\$Obj_{$tabla}->buscar())
			{ \$Obj_{$tabla}->enviar_formulario(\"../{\$vista_sistema}/$tabla/{$tabla}_listar.php\",\$_REQUEST); }
			else
			{ 
			\$Obj_{$tabla}->mensaje(\"NO se encontró registro en la Base de Datos, según los parámetros solicitados\");
			\$Obj_{$tabla}->enviar_formulario(\"../{\$vista_sistema}/$tabla/{$tabla}_buscar.php\",\$_REQUEST); 
			}
		break;
		
		case \"insertar\":
			if (\$Obj_{$tabla}->insertar())
			{  \$Obj_{$tabla}->mensaje(\"se agrego el registro a la Base de Datos\"); }
			else
			{ \$Obj_{$tabla}->mensaje(\"NO se agrego el registro a la Base de Datos\"); }
			 \$Obj_{$tabla}->enviar_formulario(\"../{\$vista_sistema}/$tabla/{$tabla}_insertar.php\",\$_REQUEST);
		break;
		
		case \"actualizar\":
			if (\$Obj_{$tabla}->actualizar())
			{  \$Obj_{$tabla}->mensaje(\"se actualizo el registro a la Base de Datos\"); }
			else
			{ \$Obj_{$tabla}->mensaje(\"NO se actualizo el registro a la Base de Datos\"); }
			 \$Obj_{$tabla}->enviar_formulario(\"../{\$vista_sistema}/$tabla/{$tabla}_actualizar.php\",\$_REQUEST);
		break;
		
		case \"eliminar\":
			if (\$Obj_{$tabla}->eliminar())
			{  \$Obj_{$tabla}->mensaje(\"se Elimino el registro a la Base de Datos\"); }
			else
			{ \$Obj_{$tabla}->mensaje(\"NO se Elimino el registro en la Base de Datos\"); }
			 \$Obj_{$tabla}->enviar_formulario(\"../{\$vista_sistema}/$tabla/{$tabla}_listar.php\",\$_REQUEST);
		break;
	}	
	
	?>
	";
return $controlador;
}

public function crear_objectos_relacionados($tabla)
{
$objetos_combos=array();
$objetos_combos_nombre=array();
$i=0;
	$relaciones=$this->MetaForeignKeys($tabla);
//	$this->ver_variabre($relaciones); exit;
	if ($relaciones) {
	foreach($relaciones as $key => $valor)
	{
	$Objetos.="
	\trequire_once(\"../../modelo/class_{$key}.php\"); # clase del modelo
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

$objeto_validar="
function validar_{$tabla}(frm)
{";

foreach($validadciones as $index => $valor)
{
/*
	$validaciones["S"]=$seleccion;
	$validaciones["TA"]=$textarea;
	$validaciones["TD"]=$TextoDate;
	$validaciones["T"]=$Texto;
*/			
if (($index=="S") && ($valor)) {
		foreach($valor as $v_index => $v_valor)
		{
			$objeto_validar.="	if (frm.{$v_valor}.value==\"0\")
			{
				alert(\"Seleccione {$v_valor} no puede estar en blanco\");
				frm.{$v_valor}.focus();
				return false;
			}
			";
		}
	}
	
if ((($index=="TA") || ($index=="T") ) && ($valor)) {
		foreach($valor as $v_index => $v_valor)
		{
			$objeto_validar.="	if (frm.{$v_valor}.value==\"\")
			{
				alert(\"El {$v_valor} no puede estar en vacio\");
				frm.{$v_valor}.focus();
				return false;
			}
			";
		}
	}
	
if (($index=="TD") && ($valor)) {
		foreach($valor as $v_index => $v_valor)
		{
			$objeto_validar.="	if (frm.{$v_valor}.value==\"____-__-__\")
			{
				alert(\"El {$v_valor} no puede estar en vacio\");
				frm.{$v_valor}.focus();
				return false;
			}
			";
			$objeto_validar.="	if (frm.{$v_valor}.value==\"\")
			{
				alert(\"El {$v_valor} no puede estar en vacio\");
				frm.{$v_valor}.focus();
				return false;
			}
			";
		}
	}
	
}



$objeto_validar.="	if (confirm(\"¿Esta seguro que desea continuar?\"))
	{
		return true;
	}
	else
	{
		return false;		
	}
}
";

$fsalida="../../../js/validaciones/{$tabla}.js";

$this->crear_archivo($fsalida,$objeto_validar);

$this->ver_variabre($objeto_validar);
//exit;
return $objeto_validar;

}

public function crear_vista($tabla, $campos, $tipo) {
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
					if ($Matacampos[$valor]->auto_increment) {	
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
		
		
	if (($tipo=="actualizar") || ($tipo=="eliminar") ) {
		$codigo="
		require_once(\"../../modelo/config.modelo.php\"); # configuracion del modelo
		require_once(\"../../modelo/class_{$tabla}.php\"); # clase del modelo
	
		 {$relaciones[0]}
		
		\$Obj_{$tabla} = new {$tabla};
		
		if (empty(\$_REQUEST[\"{$pkey}\"])) {
		\$Obj_{$tabla}->mensaje(\"Antes de $tipo tiene que buscar el registro\");
		\$Obj_{$tabla}->location(\"{$tabla}_buscar.php?quien=$tipo\");
		}";
	} elseif (($tipo=="insertar")|| ($tipo=="buscar"))  {
		$codigo="
		require_once(\"../../modelo/config.modelo.php\"); # configuracion del modelo
	
		 {$relaciones[0]}";
	
	}

	if($tipo=="buscar"){
		$vista.="
		<form id=\"frm_{$tipo}\" name=\"frm_{$tipo}\" method=\"post\" action=\"../../controlador/$tabla.php\">
		";
	} else {	
		$vista.="
		<script type=\"text/javascript\" src=\"../../js/validaciones/{$tabla}.js\"></script>
		<form id=\"frm_{$tipo}\" name=\"frm_{$tipo}\" method=\"post\" action=\"../../controlador/$tabla.php\" onSubmit=\"return validar_{$tabla}(this)\">
		";
	}	
		$vista.="
		<input name=\"accion\" type=\"hidden\" value=\"$tipo\" />
		<input name=\"quien\" type=\"hidden\" value=\"<?php echo \$_REQUEST[\"quien\"]?>\" />\n";
		
		$vista.="\t".$keys;
		$tabla_titulo=str_replace($this->identificador_tabla,"",$tabla);
		$tabla_titulo=ucwords($tabla_titulo);
		$tipo=ucwords($tipo);
				$vista.="<table width=\"50%\" height=\"87\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"grupoCampos\" align=\"center\">
				  <tr>
					<td colspan=\"2\" class=\"tituloGrupoCampos\"  align=\"center\"> {$tipo} - {$tabla_titulo} </td>
				  </tr>";
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
		
			$valorT=str_replace("ID_","",$valor);
			$valorT=str_replace($this->campos_relacionados,"",$valor);
			$valorT=str_replace("_"," ",$valor);
			
		//$this->ver_variabre($relaciones[2][$relaciones[1][$valor]]);
		//$this->ver_variabre($Matacampos[$key]); exit;
		
		if (substr_count($valor,$this->campos_relacionados) or (array_key_exists($valor,$relaciones[1])))  {	
			$valorT2=str_replace("FK_ID_","",$valor);
			$vista.="<tr>
				\t<td class=\"tituloCelda\" align=\"right\">$valorT2</td>
				\t<td>";
			$valorT2=strtolower($valorT2);
			$vista.="\t<select name=\"{$valor}\" class=\"text_campos\">
				\t\t<option value=\"0\">Seleccione...</option>
				\t\t<?php echo \$Obj_".$relaciones[2][$relaciones[1][$valor]]."->ver_opciones_".$relaciones[2][$relaciones[1][$valor]]."(\$_REQUEST[\"{$valor}\"]);?>
				\t</select>
				\t</td>
			  	</tr>";
				if ($Matacampos[$key]->not_null) {$seleccion[$i]=$valor;}
			}
			else if (($Matacampos[$key]->type=="text")  or ($Matacampos[$key]->type=="tinytext"))
			{
			$vista.="<tr>
				\t<td class=\"tituloCelda\" align=\"right\">$valorT</td>
				\t<td><textarea class=\"text_campos\" name=\"$valor\" id=\"$valor\" cols=\"50\" rows=\"5\" ><?php echo \$_REQUEST[\"$valor\"]; ?></textarea>
				\t</td>
			  	</tr>";			
				if ($Matacampos[$key]->not_null) {$textarea[$i]=$valor;}
			}
			elseif (($Matacampos[$key]->type=="timestamp") OR ($Matacampos[$key]->type=="date") OR ($Matacampos[$key]->type=="datetime"))
			{
			$vista.="<tr>
				\t<td class=\"tituloCelda\" align=\"right\">$valorT</td>
				\t<td><input name=\"$valor\" id=\"$valor\" type=\"text\" class=\"text_campos\" maxlength=\"10\" size=\"12\" value=\"<?php if (\$_REQUEST[\"$valor\"]!=\"\") {echo \$_REQUEST[\"$valor\"];} else {echo \"____-__-__\";} ?>\" />\n
				<img name=\"btn_calendario_{$valor}\" id=\"btn_calendario_{$valor}\" src=\"../../js/calendario/calendar.jpg\" />
				
			<script type=\"text/javascript\">
				Calendar.setup({
					inputField :  \"$valor\",     // id of the input field
					ifFormat   :  \"%Y-%m-%d\",      // format of the input field
					button     :  \"btn_calendario_{$valor}\", // trigger for the calendar (button ID)
					align      :  \"Bl\",           // alignment (defaults to \"Bl\")
					singleClick:   true
				});
			</script>
				
				
				\t</td>
			  	</tr>";
				if ($Matacampos[$key]->not_null) {$TextoDate[$i]=$valor;}
			}
			else
			{
			$vista.="<tr>
				\t<td class=\"tituloCelda\" align=\"right\">$valorT</td>
				\t<td>\t<input name=\"$valor\" id=\"$valor\" type=\"text\" class=\"text_campos\" maxlength=\"".$Matacampos[$key]->max_length."\" value=\"<?php echo \$_REQUEST[\"$valor\"]; ?>\" />\n
				\t</td>
			  	</tr>";
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

		$vista.="
		  <tr>
			<td colspan=\"2\" align=\"right\" height=\"47\">
			<input name=\"\" type=\"submit\" value=\"$tipo\" class=\"boton\" />
			<input name=\"\" type=\"reset\" value=\"Cancelar\" class=\"boton\" />
			</td>
		  </tr>
		</table>
	</form>
	";
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
$campos=$this->ver_campos("v_".$tabla);
}


	$codigo="
	require_once(\"../../modelo/config.modelo.php\"); # configuracion del modelo
	require_once(\"../../modelo/class_$tabla.php\"); # clase del modelo

	\$Obj_$tabla = new $tabla(";

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
			if (\$resultados=\$Obj_{$tabla}->buscar())
			{  }
			else
			{ \$Obj_{$tabla}->enviar_formulario(\"{$tabla}_buscar.php\",\$_REQUEST); }

		} else
		{
			\$resultados=\$Obj_{$tabla}->listar();
		}
	";


$vista.="
<table border=\"1\" align=\"center\" class=\"grupoCampos\" bordercolor=\"#666666\">\n";

  $vista.="<tr class=\"tituloCelda\">\n";

	foreach($campos as $key => $valor){
	if (!(substr_count($valor,"ID_")))  {
		
	$vista.="\t<td>$valor</td>\n";
	$vista2.="\t<td><?php echo \$valor[\"$valor\"]; ?></td>\n";
	}
	}
  $vista.="\t<td>ACCION</td>\n";
$vista.="</tr>";

$vista.="
<?php \$i=0; foreach (\$resultados as \$key => \$valor) { ?>
<tr  class=\"Contenido\">
  $vista2
   	<td>
		<?php 
		switch(\$_REQUEST[\"quien\"])
		{
		case \"actualizar\":
		\$Obj_{$tabla}->enviar_formulario(\"{$tabla}_actualizar.php\",\$valor,\$boton=\"\",false,\"formulario_actualizar_\".\$i);
		break;
		
		case \"eliminar\":
		\$Obj_{$tabla}->enviar_formulario(\"{$tabla}_eliminar.php\",\$valor,\$boton=\"\",false,\"formulario_eliminar_\".\$i);
		break;
		
		default:
		\$Obj_{$tabla}->enviar_formulario(\"{$tabla}_actualizar.php\",\$valor,\$boton=\"\",false,\"formulario_actualizar_\".\$i);
		\$Obj_{$tabla}->enviar_formulario(\"{$tabla}_eliminar.php\",\$valor,\$boton=\"\",false,\"formulario_eliminar_\".\$i);
		}
		?>
		
<img src=\"../../imagenes/guardar.jpg\" width=\"25\" height=\"25\" style=\"cursor:pointer\" onClick=\"frm_envir(<?php echo \"formulario_actualizar_\".\$i; ?>)\" alt=\"Actualizar\"><img src=\"../../imagenes/eliminar.jpg\" width=\"25\" height=\"25\" style=\"cursor:pointer\" onClick=\"frm_envir(<?php echo \"formulario_eliminar_\".\$i; ?>)\" alt=\"Eliminar\">
		
	</td>
 
</tr>\n
<?php \$i++; } ?>";

	$vista.="</table>";

return $vista2 = array($vista,$codigo);
}

public function agregar_menu($tabla,$numero) {
$menu.="
	Menu{$numero}=new Array(\"$tabla\",\"\",\"\",5,16,150);
	Menu{$numero}_1=new Array(\"Buscar\",\"/<?php echo \$sistema; ?>/vista/$tabla/{$tabla}_buscar.php\",\"\",0,16,170);
	Menu{$numero}_2=new Array(\"Insertar\",\"/<?php echo \$sistema; ?>/vista/$tabla/{$tabla}_insertar.php\",\"\",0);
	Menu{$numero}_3=new Array(\"Actualizar\",\"/<?php echo \$sistema; ?>/vista/$tabla/{$tabla}_actualizar.php\",\"\",0);
	Menu{$numero}_4=new Array(\"Eliminar\",\"/<?php echo \$sistema; ?>/vista/$tabla/{$tabla}_eliminar.php\",\"\",0);
	Menu{$numero}_5=new Array(\"Listar\",\"/<?php echo \$sistema; ?>/vista/$tabla/{$tabla}_listar.php\",\"\",0);
";


return $menu;
}



	public function crear_archivo_class($contenido,$tabla)
	{
	$fsalida="../../class_$tabla.php";
		$this->crear_archivo($fsalida,$contenido);
	}

	public function crear_archivo_controlador($contenido,$tabla)
	{
		$fsalida="../../../controlador/$tabla.php";
		$this->crear_archivo($fsalida,$contenido);
	}

	public function crear_archivo_vista($contenido,$tabla,$tipo,$codigo="#*CODIGO*#")
	{

		 @mkdir("../../../vista_sistema/{$tabla}", 0777);
		$fsalida="../../../vista_sistema/{$tabla}/{$tabla}_{$tipo}.php";

		$nombre_archivo = "../../../vista_sistema/plantilla/$this->plantilla";
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