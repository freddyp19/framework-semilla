<?php 
	require_once(RUTA_SISTEMA."/inc/config.sistema.php"); # configuracion del sistema
	require_once(RUTA_SISTEMA."/modelo/config.modelo.php"); # configuracion del modelo
	$main = main::getInstance();
	if($main->motor=="postgres"){
	require_once(RUTA_SISTEMA."/modelo/schema_usuarios/class_tbl_modulos.php"); # clase del modelo
	require_once(RUTA_SISTEMA."/modelo/schema_usuarios/class_tbl_sub_modulos.php"); # clase del modelo
	}
	else
	{
	require_once(RUTA_SISTEMA."/modelo/class_tbl_modulos.php"); # clase del modelo
	require_once(RUTA_SISTEMA."/modelo/class_tbl_sub_modulos.php"); # clase del modelo
	}
	$_tbl_modulos = new tbl_modulos();
	
	if($main->motor=="postgres"){
		$_tbl_modulos->tabla.=" join schema_usuarios.tbl_modulos_perfiles using(id_modulo)";
	}
	else
	{
		$_tbl_modulos->tabla.=" join tbl_modulos_perfiles using(id_modulo)";
	}
	
	if ($_SESSION["controlador_frontal"]==false){$_SESSION["session_usuario"]['id_perfil']=1;}
	if (($_SESSION["controlador_frontal"]) && ($_SESSION["session_usuario"]['id_perfil']==""))
	{$_SESSION["session_usuario"]['id_perfil']=1;}
	
	
	$_tbl_modulos->where=" id_perfil=".$_SESSION["session_usuario"]['id_perfil'];
	$modulos=$_tbl_modulos->listar(true);
$menu="";
foreach($modulos as $index => $m) { 
	$menu[$m["modulo"]]=array();
	$_sub_modulos = new tbl_sub_modulos();
	$_sub_modulos->where="id_modulo=".$m["id_modulo"];
	$sub_menu=$_sub_modulos->listar(true);
	foreach($sub_menu as $index => $sm) { 
		//$menu[$m["modulo"]][$sm["sub_modulo"]]=array("enlace"=>$sm["enlace"],"sub_modulo"=>$sm["sub_modulo"]);
		$menu[$m["modulo"]][$sm["sub_modulo"]]=$sm["enlace"];
	}
	unset($_sub_modulos);
}
unset($_sub_modulos,$_tbl_modulos);
#echo "<pre>"; print_r($menu);
?>