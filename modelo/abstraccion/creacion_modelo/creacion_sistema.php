<?php
include("../../../inc/config.sistema.php");
include("../../config.modelo.php");
include("creacion_modelo.php");
$tablas = new tables;

?>
<form>
	<select name="tablas">
		<option value="0">seleccione...</option>
		<?php echo $tablas->ver_tablas(); ?>
	</select><br>
	<input type="checkbox" name="controlador" checked="checked"/> Controlador<br>
	<input type="checkbox" name="modelo" checked="checked"/>	Modelo<br>
	Vistas<br>
	<input type="checkbox" name="formulario" checked="checked"/>		formulario<br>
	
   <!-- <input type="checkbox" name="insertar" checked="checked"/>	Insertar<br>
	<input type="checkbox" name="actualizar" checked="checked"/>		Actualizar<br>
	<input type="checkbox" name="eliminar" checked="checked"/>		Eliminar<br>
     -->
	<input type="checkbox" name="listar" checked="checked"/>		Listar<br>
	
	<input type="submit">
</form>

<?php

if ($_REQUEST["tablas"]) {

	$campos = $tablas->ver_campos($_REQUEST["tablas"]);
	
	if ($_REQUEST["modelo"]){
	$clasf=$tablas->crear_clases($_REQUEST["tablas"], $campos);	}
	
	if ($_REQUEST["controlador"]){
	$controlador=$tablas->crear_controlador($_REQUEST["tablas"], $campos);	}
						//crear_vista($tabla, $campos, $tipo)
	if ($_REQUEST["formulario"]){
	$vista_buscar=$tablas->crear_vista($_REQUEST["tablas"], $campos,"formulario");	}
	/*
	if ($_REQUEST["insertar"]){
	$vista_insert=$tablas->crear_vista($_REQUEST["tablas"], $campos,"insertar"); }
	
	if ($_REQUEST["actualizar"]){
	$vista_actualizar=$tablas->crear_vista($_REQUEST["tablas"], $campos,"actualizar");}

	if ($_REQUEST["eliminar"]){
	$vista_eliminar=$tablas->crear_vista($_REQUEST["tablas"], $campos,"eliminar");}
	*/
	if ($_REQUEST["listar"]){
	$vista_listar=$tablas->crear_vista($_REQUEST["tablas"], $campos,"listar");}

/*	
	echo "<pre>";
	print_r($vista_listar);
	echo "</pre>";
	exit;
*/
	if ($_REQUEST["modelo"]){
	$tablas->crear_archivo_class($clasf, $_REQUEST["tablas"]);}
	
	if ($_REQUEST["controlador"]){
	$tablas->crear_archivo_controlador($controlador,$_REQUEST["tablas"]);}
	
		   //crear_archivo_vista($contenido,$tabla,$tipo)
   	if ($_REQUEST["formulario"]){
	$tablas->crear_archivo_vista($vista_buscar["vista"],$_REQUEST["tablas"],"formulario",$vista_buscar["codigo"]);}
/*
	if ($_REQUEST["insertar"]){
	$tablas->crear_archivo_vista($vista_insert["vista"],$_REQUEST["tablas"],"insertar",$vista_insert["codigo"]);}
	
	if ($_REQUEST["actualizar"]){
	$tablas->crear_archivo_vista($vista_actualizar["vista"],$_REQUEST["tablas"],"actualizar",$vista_actualizar["codigo"]);}

	if ($_REQUEST["eliminar"]){	
	$tablas->crear_archivo_vista($vista_eliminar["vista"],$_REQUEST["tablas"],"eliminar",$vista_eliminar["codigo"]);}
*/
	if ($_REQUEST["listar"]){
	$tablas->crear_archivo_vista($vista_listar["vista"],$_REQUEST["tablas"],"listar",$vista_listar["codigo"]);}



	//$tablas->crear_archivo_menu($_REQUEST["tablas"]);

	echo "<pre>";
	print_r($campos);
	echo "</pre>";

	echo "<br><br><br>";


	echo "<pre>";
	$nuevo = htmlspecialchars($clasf, ENT_QUOTES);
	print_r($nuevo);
	echo "</pre>";

	echo "<br><br><br>";

	echo "<pre>";
	$nuevo = htmlspecialchars($controlador, ENT_QUOTES);
	print_r($nuevo);
	echo "</pre>";


	echo "<pre>";
	$nuevo = htmlspecialchars($vista_insert["vista"], ENT_QUOTES);
	print_r($nuevo);
	echo "</pre>";


	echo "<pre>";
	$nuevo = htmlspecialchars($vista_actualizar["vista"], ENT_QUOTES);
	print_r($nuevo);
	echo "</pre>";


	echo "<pre>";
	$nuevo = htmlspecialchars($vista_eliminar["vista"], ENT_QUOTES);
	print_r($nuevo);
	echo "</pre>";

	echo "<pre>";
	$nuevo = htmlspecialchars($vista_listar[1], ENT_QUOTES);
	print_r($nuevo);
	echo "</pre>";
	echo "<pre>";

	$nuevo = htmlspecialchars($vista_listar[0], ENT_QUOTES);
	print_r($nuevo);
	echo "</pre>";
}
?>