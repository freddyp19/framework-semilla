<?php include_once("config.sistema.php"); ?>
<?php require_once("controlador_fontal.php"); ?>
<?php 
function FechaFormateada($FechaStamp){									//Funcion que devuelve una cadena con la fecha que se le manda como parámetro en formato largo.
		$ano = date('Y',$FechaStamp);
		$mes = date('n',$FechaStamp);
		$dia = date('d',$FechaStamp);
		$diaSemana = date('w',$FechaStamp);								//Obtengo el numero del día de la semana

		$diasSemanaN= array("Domingo","Lunes","Martes","Mi&eacute;rcoles","Jueves","Viernes","S&aacute;bado");
		$mesesN=array(1=>"Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
		return $diasSemanaN[$diaSemana].", $dia de ". $mesesN[$mes] ." de $ano";
	}
?>

<script type="text/javascript" src="/<?php echo $sistema; ?>/js/script_general.js"></script>

<script type="text/javascript" src="/<?php echo $sistema; ?>/js/jquery/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="/<?php echo $sistema; ?>/js/jquery.validate/jquery.validate.js"></script>
<script type="text/javascript" src="/<?php echo $sistema; ?>/js/marketo/jquery.maskedinput.js"></script>
<script type="text/javascript" src="/<?php echo $sistema; ?>/js/alphanumeric/jquery.alphanumeric.js"></script>

<script type="text/javascript" src="/<?php echo $sistema; ?>/js/jPaginate/jPaginate.js"></script>

<!--<style type="text/css" title="currentStyle">
			@import "/<?php echo $sistema; ?>/js/data-tables/media/css/demo_page.css";
			@import "/<?php echo $sistema; ?>/js/data-tables/media/css/demo_table.css";
</style>
-->

<!------------------listar----->
<!--
<link rel="stylesheet" type="text/css" href="/<?php echo $sistema; ?>/js/data-tables/media/css/demo_table_jui.css"/>

<link rel="stylesheet" type="text/css" href="/<?php echo $sistema; ?>/js/jquery-ui-1.10.1/css/blitzer/jquery-ui-1.10.1.custom.css"/>

<link rel="stylesheet" type="text/css" href="/<?php echo $sistema; ?>/js/data-tables/extras/ColVis/media/css/ColVis.css"/>    
 
<link rel="stylesheet" type="text/css" href="/<?php echo $sistema; ?>/js/data-tables/extras/TableTools/media/css/TableTools.css"/>

<script type="text/javascript" src="/<?php echo $sistema; ?>/js/data-tables/media/js/jquery.dataTables.js"></script>

<script type="text/javascript" src="/<?php echo $sistema; ?>/js/data-tables/extras/ColVis/media/js/ColVis.js"></script>

<script type="text/javascript" src="/<?php echo $sistema; ?>/js/data-tables/extras/TableTools/media/js/ZeroClipboard.js"></script>

<script type="text/javascript" src="/<?php echo $sistema; ?>/js/data-tables/extras/TableTools/media/js/TableTools.js"></script>

<script type="text/javascript" src="/<?php echo $sistema; ?>/js/data-tables/extras/FixedHeader/js/FixedHeader.js"></script> 
-->
<!--------------------------------------------------------------------------->

<!--<link rel="stylesheet" type="text/css" href="/<?php echo $sistema; ?>/js/DataTables-1.10.2/media/css/jquery.dataTables.css"/>

<link rel="stylesheet" type="text/css" href="/<?php echo $sistema; ?>/js/DataTables-1.10.2/media/css/jquery.dataTables_themeroller.css"/>
-->

<link rel="stylesheet" type="text/css" href="/<?php echo $sistema; ?>/js/jquery-ui-1.10.1/css/blitzer/jquery-ui-1.10.1.custom.css"/>

<link rel="stylesheet" type="text/css" href=
	"/<?php echo $sistema; ?>/js/DataTables-1.10.2/extensions/Plugins/integration/jqueryui/dataTables.jqueryui.css">

<link rel="stylesheet" type="text/css" href="/<?php echo $sistema; ?>/js/DataTables-1.10.2/extensions/TableTools/css/dataTables.tableTools.css"/>

<script type="text/javascript" language="javascript" src="/<?php echo $sistema; ?>/js/DataTables-1.10.2/media/js/jquery.dataTables.js"></script>

<script type="text/javascript" language="javascript" src="/<?php echo $sistema; ?>/js/DataTables-1.10.2/extensions/TableTools/js/dataTables.tableTools.js"></script>

<script type="text/javascript" language="javascript" src=
	"/<?php echo $sistema; ?>/js/DataTables-1.10.2/extensions/Plugins/integration/jqueryui/dataTables.jqueryui.js"></script>

<!--
<link rel="stylesheet" href="css/craftyslide.css" />

<script src="/<?php echo $sistema; ?>/js/craftedpixelz-Craftyslide-4cd0adb/js/craftyslide.min.js"></script>
      
    -->


<script type="text/javascript" src="/<?php echo $sistema; ?>/js/validaciones/configuracion.js"></script>




	<script type="text/javascript" src="/<?php echo $sistema; ?>/js/jquery-powertip-master/src/core.js"></script>
	<script type="text/javascript" src="/<?php echo $sistema; ?>/js/jquery-powertip-master/src/csscoordinates.js"></script>
	<script type="text/javascript" src="/<?php echo $sistema; ?>/js/jquery-powertip-master/src/displaycontroller.js"></script>
	<script type="text/javascript" src="/<?php echo $sistema; ?>/js/jquery-powertip-master/src/placementcalculator.js"></script>
	<script type="text/javascript" src="/<?php echo $sistema; ?>/js/jquery-powertip-master/src/tooltipcontroller.js"></script>
	<script type="text/javascript" src="/<?php echo $sistema; ?>/js/jquery-powertip-master/src/utility.js"></script>
	<link rel="stylesheet" type="text/css" href="/<?php echo $sistema; ?>/js/jquery-powertip-master/css/jquery.powertip.css" />




<!--<link rel="stylesheet" href="../../js/jquery-ui-1.10.1/development-bundle/themes/base/jquery-ui.css" /> -->
<link rel="stylesheet" href="/<?php echo $sistema; ?>/js/jquery-ui-1.10.1/development-bundle/themes/base/jquery.ui.all.css" />

<!--<link rel="stylesheet" href="../../js/jquery-ui-1.10.1/development-bundle/themes/blitzer/jquery-ui.css" /> -->
<link rel="stylesheet" href="/<?php echo $sistema; ?>/js/jquery-ui-1.10.1/development-bundle/themes/blitzer/jquery.ui.dialog.css" />
<link rel="stylesheet" href="/<?php echo $sistema; ?>/js/jquery-ui-1.10.1/css/blitzer/jquery-ui-1.10.1.custom.min.css" />

<script src="/<?php echo $sistema; ?>/js/jquery-ui-1.10.1/js/jquery-ui-1.10.1.custom.min.js"></script>
<script src="/<?php echo $sistema; ?>/js/jquery-ui-1.10.1/development-bundle/ui/i18n/jquery.ui.datepicker-es.js"></script>
<script src="/<?php echo $sistema; ?>/js/jquery-ui-1.10.1/development-bundle/ui/jquery.ui.dialog.js"></script>

<!--<link rel="stylesheet" href="../../js/jquery-ui-1.10.1/css/blitzer/jquery-ui-1.10.1.custom.min.css" /> -->


<script type="text/javascript" src="/<?php echo $sistema; ?>/js/blockUI/bloqui.js"></script>
<link rel="stylesheet" href="/<?php echo $sistema; ?>/js/blockUI/cargando.css" />
<script src="/<?php echo $sistema; ?>/js/jquery/jquery-migrate-1.0.0.js"></script>

