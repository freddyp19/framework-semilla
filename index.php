<?php
session_start();
session_unset();
session_destroy();
require_once('inc/config.sistema.php');

require_once("modelo/config.modelo.php"); # configuracion del modelo
$main = main::getInstance();

if($main->motor=="postgres"){
	$redireccion = $servidor . "/".$sistema."/vista/schema_usuarios/tbl_usuarios/";
}
else
{
	$redireccion = $servidor . "/".$sistema."/vista/tbl_usuarios/";
}

#echo $redireccion; exit;
header("Location: " . $redireccion, true);
?>
