<?php session_start();
include("../../inc/config.sistema.php");

/*
Código necesario para la ejecución
*/

#*CODIGO*#
?>
<?php	include(RUTA_SISTEMA."/vista/layouts/{$defaul_layouts}/header.php"); ?>
<script type="text/javascript" src="/<?php echo $sistema; ?>/js/validaciones/index/index.js"></script>
		<!--inicio viata de plantilla -->
		
		Bienvenido al sistema...
		
		<!--fin viata de plantilla -->
<?php include(RUTA_SISTEMA."/vista/layouts/{$defaul_layouts}/footer.php"); ?>