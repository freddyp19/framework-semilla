<html>
<head>
<meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="UTF-8" /> 
<meta charset="utf-8" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<?php include(RUTA_SISTEMA."/inc/head_sistema.php"); ?>
<!-- <link href="/<?php echo $sistema; ?>/vista/layouts/<?php echo $defaul_layouts; ?>/css/estilos.css" rel="stylesheet" type="text/css" /> -->
<!--
<link href="/<?php echo $sistema; ?>/vista/layouts/<?php echo $defaul_layouts; ?>/css/menu.css" rel="stylesheet" type="text/css" />
-->

<link href="/<?php echo $sistema; ?>/vista/layouts/<?php echo $defaul_layouts; ?>/css/sitioweb.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/<?php echo $sistema; ?>/vista/layouts/<?php echo $defaul_layouts; ?>/js/ddaccordion.js">

/***********************************************
* Accordion Content script- (c) Dynamic Drive DHTML code library (www.dynamicdrive.com)
* Visit http://www.dynamicDrive.com for hundreds of DHTML scripts
* This notice must stay intact for legal use
***********************************************/

</script>

<script type="text/javascript">

ddaccordion.init({
				headerclass: "headerbar", //Shared CSS class name of headers group
				contentclass: "submenu", //Shared CSS class name of contents group
				revealtype: "mouseover", //Reveal content when user clicks or onmouseover the header? Valid value: "click", "clickgo", or "mouseover"
				mouseoverdelay: 200, //if revealtype="mouseover", set delay in milliseconds before header expands onMouseover
				collapseprev: true, //Collapse previous content (so only one open at any time)? true/false
				defaultexpanded: [0], //index of content(s) open by default [index1, index2, etc] [] denotes no content
				onemustopen: true, //Specify whether at least one header should be open always (so never all headers closed)
				animatedefault: false, //Should contents open by default be animated into view?
				persiststate: true, //persist state of opened contents within browser session?
				toggleclass: ["", "selected"], //Two CSS classes to be applied to the header when it's collapsed and expanded, respectively ["class1", "class2"]
				togglehtml: ["", "", ""], //Additional HTML added to the header when it's collapsed and expanded, respectively  ["position", "html1", "html2"] (see docs)
				animatespeed: "normal", //speed of animation: integer in milliseconds (ie: 200), or keywords "fast", "normal", or "slow"
				oninit:function(headers, expandedindices){ //custom code to run when headers have initalized
				//do nothing
				},
				onopenclose:function(header, index, state, isuseractivated){ //custom code to run whenever a header is opened or closed
				//do nothing
				}
			})

</script>

<script>
$(document).ready(function(){

$(".grupoCampos").addClass("grupoCampos");
	$(".grupoCampos").attr("width","93%");
	$(".tituloGrupoCampos").addClass("Titulo-Formulario").attr({bgcolor:"#e8e8e8",align:"center"});
	$(".tituloCelda").addClass("parametrobusqueda").attr({align:"left",height:"30px"});
	$(".text_campos").addClass("tabla_input");
	$(".campotexto").addClass("tabla_input");
	
	
$(".btn_actualizar").addClass("glyphicon glyphicon-log-out").css({height:"100%",width:"50%",float:"left"});
$(".btn_eliminar").addClass("glyphicon glyphicon-remove").css({height:"100%",width:"50%",float:"left"});


	$("#panel > a").each(function(){
		$(this).css({'color': '#FFFFFF'}).addClass("botonRojo");
	});
	
	

	$(".pieGrupoCampos").attr({bgcolor:"#e8e8e8",align:"right"});
	$(".grupoCampos").removeClass("grupoCampos");
	//$(".boton").addClass("botonRojo");
	///$(".btn").addClass("botonRojo");	
	$(".tituloGrupoCampos").removeClass("tituloGrupoCampos");
	$(".tituloCelda").removeClass("tituloCelda");
	$(".text_campos").removeClass("text_campos");
	$(".campotexto").removeClass("text_campos");
	///$(".boton").removeClass("boton");	
});
</script>
</head>
<body>
<!-- <div class="primeraHoja"> -->
			<table width="830" border="0" align="center" cellpadding="0" cellspacing="0">
				<tr>
					<td width="1%">&nbsp;</td>
					<td width="98%">
						<div align="center">
							<table width="100%" border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td colspan="2">
										<?php
											include("encabezado.php");
										?>
									</td>
								</tr>
								<tr>          
									<td height="22" class="plan"><div align="right" class="style4"><span class="nombresistema"><?php echo $nombresistema?></span></div></td>
								</tr>
							</table>
						</div>
					</td>
					<td width="1%">&nbsp;</td>
				</tr>
				<tr>
					<td height="1" class="bleach1"></td>
					<td height="1" class="bleach2">&nbsp;</td>
					<td height="1" class="bleach3"></td>
				</tr>
				<tr>
					<td width="1%" class="bleach4">
						<img src="/<?php echo $sistema; ?>/vista/layouts/<?php echo $defaul_layouts; ?>/imagenes/iconos/sombrapaginaD.png" width="15" height="1">
					</td>
					<td>
						<?php include("rutausuario.php");?>
					</td>
					<td class="bleach7">
						<img src="/<?php echo $sistema; ?>/vista/layouts/<?php echo $defaul_layouts; ?>/imagenes/iconos/sombrapaginaI.png" width="15" height="1">
					</td>
				</tr>
				<tr>
					<td class="bleach8">&nbsp;</td>
					<td>
						<div align="center">
							<table width="830" border="0" cellpadding="0" cellspacing="0">
								<tr>
									<td width="197">
										<img src="/<?php echo $sistema; ?>/vista/layouts/<?php echo $defaul_layouts; ?>/imagenes/iconos/imagen_superior_menu.gif" width="197" height="27">
									</td>
									<td width="1" class="bleach9">
										<img src="/<?php echo $sistema; ?>/vista/layouts/<?php echo $defaul_layouts; ?>/imagenes/iconos/puntogris.gif" width="1" height="1">
									</td>
									<td>
										<table width="100%" border="0" cellspacing="0" cellpadding="0">
											<tr>
												<td width="99%" class="bleach10">&nbsp;</td>
												<td width="1%">
													<div align="right">
														<img src="/<?php echo $sistema; ?>/vista/layouts/<?php echo $defaul_layouts; ?>/imagenes/iconos/esquinader.gif" width="10" height="27">
													</div>
												</td>
											</tr>
										</table>
									</td>
								</tr>
								<tr>
									<td width="197" valign="top" bgcolor="#e8e8e8">
										<table width="100%" border="0" cellspacing="0" cellpadding="0">
											<tr>
												<td bgcolor="#e8e8e8">
													<?php
														include("menu_vista.php");
													?>
												</td>
											</tr>
										</table>
									</td>
									<td width="1" class="bleach11"></td>
									<td valign="top" class="style15" height="470px">
	
	
<link rel="stylesheet" type="text/css" href="/<?php echo $sistema; ?>/vista/layouts/menpet_bootstrap/css/bootstrap.css">	

<script type="text/javascript" src="/<?php echo $sistema; ?>/vista/layouts/menpet_bootstrap/js/bootstrap.min.js">
</script>
<script type="text/javascript" src="/<?php echo $sistema; ?>/vista/layouts/menpet_bootstrap/js/scripts.js"></script>		
	
 	<div id="div_respuesta" align="center"></div>
		
<div id="panel">
	<ul class="nav nav-tabs nav-justified">
  <li role="presentation" id="tab_insertar" ><a href="formulario.php?accion=insertar">Insertar</a></li>
  <li role="presentation" id="tab_buscar" ><a href="formulario.php?accion=buscar">Buscar</a></li>
  <li role="presentation" id="tab_listar"><a href="listar.php">Listado</a></li>
</ul>   
 </div>
 
    <br><br><br>
	<div class="row">
<!--<div class="col-md-2"></div>-->
<div class="col-md-11">