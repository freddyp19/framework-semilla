<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html slick-uniqueid="3" xmlns="http://www.w3.org/1999/xhtml" xml:lang="es-es" dir="ltr" lang="es-es">
<head>
<?php include(RUTA_SISTEMA."/inc/head_sistema.php"); ?>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <meta name="generator" content="Joomla! - Open Source Content Management">
  <title>Framework Semilla</title>

  <link rel="stylesheet" href="/<?php echo $sistema; ?>/vista/layouts/<?php echo $defaul_layouts; ?>/css/template.css" type="text/css"> 
  <link rel="stylesheet" href="/<?php echo $sistema; ?>/vista/layouts/<?php echo $defaul_layouts; ?>/css/base_framework_semilla.css" type="text/css"> 
  <link rel="stylesheet" href="/<?php echo $sistema; ?>/vista/layouts/<?php echo $defaul_layouts; ?>/css/menu.css" type="text/css"> 

<!--[if IE 7]>
		<link href="template/css/ie7.css" rel="stylesheet" type="text/css" />
<![endif]-->

<!--
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
-->	
	<script type="text/javascript" src="/<?php echo $sistema; ?>/vista/layouts/<?php echo $defaul_layouts; ?>/js/ddaccordion.js">

/***********************************************
* Accordion Content script- (c) Dynamic Drive DHTML code library (www.dynamicdrive.com)
* Visit http://www.dynamicDrive.com for hundreds of DHTML scripts
* This notice must stay intact for legal use
***********************************************/

</script>


<script type="text/javascript">


ddaccordion.init({
	headerclass: "expandable", //Shared CSS class name of headers group that are expandable
	contentclass: "categoryitems", //Shared CSS class name of contents group
	revealtype: "click", //Reveal content when user clicks or onmouseover the header? Valid value: "click", "clickgo", or "mouseover"
	mouseoverdelay: 200, //if revealtype="mouseover", set delay in milliseconds before header expands onMouseover
	collapseprev: true, //Collapse previous content (so only one open at any time)? true/false 
	defaultexpanded: [0], //index of content(s) open by default [index1, index2, etc]. [] denotes no content
	onemustopen: false, //Specify whether at least one header should be open always (so never all headers closed)
	animatedefault: false, //Should contents open by default be animated into view?
	persiststate: true, //persist state of opened contents within browser session?
	toggleclass: ["", "openheader"], //Two CSS classes to be applied to the header when it's collapsed and expanded, respectively ["class1", "class2"]
	togglehtml: ["prefix", "", ""], //Additional HTML added to the header when it's collapsed and expanded, respectively  ["position", "html1", "html2"] (see docs)
	animatespeed: "fast", //speed of animation: integer in milliseconds (ie: 200), or keywords "fast", "normal", or "slow"
	oninit:function(headers, expandedindices){ //custom code to run when headers have initalized
		//do nothing
	},
	onopenclose:function(header, index, state, isuseractivated){ //custom code to run whenever a header is opened or closed
		//do nothing
	}
})


</script>
</head>
<body>
		<div id="header">
		<?php include("encabezado.php"); ?>
		</div>
		<div class="clr">&nbsp;<br /></div>
		<div id="nombre_sistema">
		<?php echo $nombresistema; ?>
		</div>
		
<div id="system-message-container">
</div>
		<div id="content-box">
			<div id="content-pad">
				<div id="stepbar">
					<h2>Menu</h2>
					<?php include("menu.php"); ?>
					<!--
					<div class="step" id="language">1 : Bienvenida</div>
					<div class="step active" id="license">2 : Licencia</div>
					<div class="step" id="preinstall">3 : Configuración Aplicacion</div>
					<div class="step" id="database">4 : Base de datos</div>
					<div class="step" id="site">5 : Framework Semilla</div>
					<div class="step" id="complete">6 : Menu</div>
					<div class="step" id="complete">7 : Finalizar</div>	
					 -->						
					<div class="box"><!-- solo muestra el box --></div>
				</div>
				<div id="warning">
					<noscript>
						<div id="javascript-warning">
							¡Atención! JavaScript debe estar habilitado para la correcta instalación !						</div>
					</noscript>
				</div>
				<div id="right">
					<div id="rightpad">
						<div id="step">
	<div class="far-right">
	
		<!-- botobes
		<div class="button1-right">
		<div class="prev"><a href="instalar.html" rel="prev" title="Previo">Previo</a></div>
		</div>
		<div class="button1-left"><div class="next"><a href="config_sist.php" rel="next" title="Siguiente">Siguiente</a></div></div> 
		-->
	</div>
	<h2><?php include("rutausuario.php");?></h2>
</div>
<!--
	<div id="menu_superior" class="m">
		Menu_Superior
	</div>
	<br />
-->

<div id="div_respuesta" align="center" class="m"></div><br>
	<div id="installer" class="cuerpo">
		<div class="m">
		
		<div id="panel">
		<a href="formulario.php?accion=insertar" class="boton">Insertar</a>
		<a href="formulario.php?accion=buscar" class="boton">Buscar</a>
		<a href="listar.php" class="boton">Listar</a>
		</div>
		<br><br>
			<!-- fin del header -->		