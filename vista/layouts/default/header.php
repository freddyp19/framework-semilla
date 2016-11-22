<html>
<head>
<?php include(RUTA_SISTEMA."/inc/head_sistema.php"); ?>
<meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="UTF-8" /> 
<meta charset="utf-8" />

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link href="/<?php echo $sistema; ?>/vista/layouts/<?php echo $defaul_layouts; ?>/css/estilo.css" rel="stylesheet" type="text/css" />

<link href="/<?php echo $sistema; ?>/vista/layouts/<?php echo $defaul_layouts; ?>/css/estilo_responsitive.css" rel="stylesheet" type="text/css" />

<link href="/<?php echo $sistema; ?>/vista/layouts/<?php echo $defaul_layouts; ?>/css/estilo_menu.css" rel="stylesheet" type="text/css" />


<script type="text/javascript" src="/<?php echo $sistema; ?>/vista/layouts/<?php echo $defaul_layouts; ?>/js/ddaccordion.js">

/***********************************************
* Accordion Content script- (c) Dynamic Drive DHTML code library (www.dynamicdrive.com)
* Visit http://www.dynamicDrive.com for hundreds of DHTML scripts
* This notice must stay intact for legal use
***********************************************/

</script>
<script type="text/javascript">
ddaccordion.init({
  headerclass: "submenuheader", //Shared CSS class name of headers group
  contentclass: "submenu", //Shared CSS class name of contents group
  revealtype: "click", //Reveal content when user clicks or onmouseover the header? Valid value: "click" or "mouseover
  mouseoverdelay: 200, //if revealtype="mouseover", set delay in milliseconds before header expands onMouseover
  collapseprev: true, //Collapse previous content (so only one open at any time)? true/false 
  defaultexpanded: [], //index of content(s) open by default [index1, index2, etc] [] denotes no content
  onemustopen: false, //Specify whether at least one header should be open always (so never all headers closed)
  animatedefault: false, //Should contents open by default be animated into view?
  persiststate: true, //persist state of opened contents within browser session?
  toggleclass: ["", ""], //Two CSS classes to be applied to the header when it's collapsed and expanded, respectively ["class1", "class2"]
  togglehtml: ["suffix", "<img src='/<?php echo $sistema; ?>/vista/layouts/<?php echo $defaul_layouts; ?>/img/plus.gif' class='statusicon' />", "<img src='/<?php echo $sistema; ?>/vista/layouts/<?php echo $defaul_layouts; ?>/img/minus.gif' class='statusicon' />"], //Additional HTML added to the header when it's collapsed and expanded, respectively  ["position", "html1", "html2"] (see docs)
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
<?php include("encabezado.php"); ?>
<TABLE cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
  <TBODY>
  <TR>
    <TD class=texto colSpan=2>&nbsp;</TD></TR>
  <TR>
    <TD class=texto width="40%">Bienvenido(a):  <?php echo $_SESSION["session_usuario"]["login"]; ?></TD>
    <TD class=texto align=right width="60%">Si no eres <?php echo $_SESSION["session_usuario"]["login"]; ?>, haz clic <A class=enlace  href="/<?php echo $sistema; ?>/">aqui</A></TD></TR>
  <TR>
    <TD colSpan=2>
      <HR color=#BABABA>
    </TD>
  </TR>
   <TR><TD class=texto colSpan=2>&nbsp;</TD>
   </TR>
   <TR>
     <TD class=texto colSpan=2>
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		  <tr>
			<td id="fs_menu" valign="top">
        	<?php include("menu_vista.php"); ?>
      		</td>
			<td id="fs_cuerpo" valign="top">
			
  	<div id="div_respuesta" align="center"></div><br>
		
    <div id="panel">
    <a href="formulario.php?accion=insertar" class="boton">Insertar</a>
    <a href="formulario.php?accion=buscar" class="boton">Buscar</a>
    <a href="listar.php" class="boton">Listar</a>
    </div>
    <br><br>