|<?php
session_start();
	require_once("../inc/config.sistema.php"); # configuracion del sistema
	require_once("../modelo/config.modelo.php"); # configuracion del modelo
	require_once("../modelo/class_reportes.php"); # clase del modelo

$main = main::getInstance();


	$controlador = "../documentacion/schemas/".$main->motor."/controlador.zip";
	$modelo = "../documentacion/schemas/".$main->motor."/modelo.zip";
	$vista = "../documentacion/schemas/".$main->motor."/vista.zip";
	$js = "../documentacion/schemas/".$main->motor."/js.zip";
    $js_config = "../documentacion/schemas/".$main->motor."/js_config.zip";


		$zip = new ZipArchive;
		
		if ($zip->open($modelo) === TRUE) {
			$zip->extractTo('../modelo/');
			$zip->close();
			echo 'extraido correctamente';
		} else {
			echo 'error al extrar';
		}
		

		if ($zip->open($controlador) === TRUE) {
			$zip->extractTo('../controlador/');
			$zip->close();
			echo 'extraido correctamente';
		} else {
			echo 'error al extrar';
		}
		
		if ($zip->open($vista) === TRUE) {
			$zip->extractTo('../vista/');
			$zip->close();
			echo 'extraido correctamente';
		} else {
			echo 'error al extrar';
		}
		
		if ($zip->open($js) === TRUE) {
			$zip->extractTo('../js/validaciones/');
			$zip->close();
			echo 'extraido correctamente';
		} else {
			echo 'error al extrar';
		}

        if ($zip->open($js_config) === TRUE) {
			$zip->extractTo('../js/validaciones/');
			$zip->close();
			echo 'extraido correctamente';
		} else {
			echo 'error al extrar';
		}
		

?>
<script language="javascript">window.location="tablas_detalles.php";</script>