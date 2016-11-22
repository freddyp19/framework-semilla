<?php 

$menu = array(
'Perfiles' => array(
	'Perfil' => "/framework_semilla/vista/schema_perfiles/tbl_perfiles/formulario.php?accion=insertar", 
	'Usuarios' => '/framework_semilla/vista/schema_perfiles/tbl_usuarios_perfiles/formulario.php?accion=insertar'),
'Modulo 2' => array(
	'sub modulo' => 'link'),
'Modulo 3' => array(
	'sub modulo' => 'link', 
	'sub modulo 3' => 'link 2', 
	'sub modulo 4' => 'link 3')
);


include("menu_perfil.php");

?>