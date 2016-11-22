<?php
include("../../../inc/config.sistema.php");
include("../../config.modelo.php");
include("creacion_modelo.php");
$tablas = new tables;
if ($_REQUEST["tablas"]) {

	$campos = $tablas->ver_campos($_REQUEST["tablas"]);
	
	if ($_REQUEST["modelo"]){
	$clasf=$tablas->crear_clases($_REQUEST["tablas"], $campos);	}
	
	if ($_REQUEST["controlador"]){
	$controlador=$tablas->crear_controlador($_REQUEST["tablas"], $campos);	}
						//crear_vista($tabla, $campos, $tipo)
	if ($_REQUEST["formulario"]){
	$vista_buscar=$tablas->crear_vista($_REQUEST["tablas"], $campos,"formulario");	}

	if ($_REQUEST["listar"]){
	$vista_listar=$tablas->crear_vista($_REQUEST["tablas"], $campos,"listar");}


	if ($_REQUEST["modelo"]){
	$tablas->crear_archivo_class($clasf, $_REQUEST["tablas"]);}
	
	if ($_REQUEST["controlador"]){
	$tablas->crear_archivo_controlador($controlador,$_REQUEST["tablas"]);}
	
		   //crear_archivo_vista($contenido,$tabla,$tipo)
   	if ($_REQUEST["formulario"]){
	$tablas->crear_archivo_vista($vista_buscar["vista"],$_REQUEST["tablas"],"formulario",$vista_buscar["codigo"]);
	}
	
	if ($_REQUEST["listar"]){
	$tablas->crear_archivo_vista($vista_listar["vista"],$_REQUEST["tablas"],"listar",$vista_listar["codigo"]);}
	
	$retorna["mensaje"]="Se creo lo solicitado";
	$retorna["estado"]="creado";
	echo json_encode($retorna); 
	
}
?>