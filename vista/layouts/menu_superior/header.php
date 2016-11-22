<html>
<head>
<?php include(RUTA_SISTEMA."/inc/head_sistema.php"); ?>
<meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="UTF-8" /> 
<meta charset="utf-8" />

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link href="/<?php echo $sistema; ?>/vista/layouts/<?php echo $defaul_layouts; ?>/css/estilo.css" rel="stylesheet" type="text/css" />

<!--
<link href="/<?php echo $sistema; ?>/vista/layouts/<?php echo $defaul_layouts; ?>/css/estilo_responsitive.css" rel="stylesheet" type="text/css" />
-->

<link href="/<?php echo $sistema; ?>/vista/layouts/<?php echo $defaul_layouts; ?>/css/estilo_menu.css" rel="stylesheet" type="text/css" />

<!-- SmartMenus 6 config and script core files -->
<script type="text/javascript" src="/<?php echo $sistema; ?>/vista/layouts/<?php echo $defaul_layouts; ?>/js/SM6_menu/c_config.js"></script>
<script type="text/javascript" src="/<?php echo $sistema; ?>/vista/layouts/<?php echo $defaul_layouts; ?>/js/SM6_menu/c_smartmenus.js"></script>
<!-- SmartMenus 6 config and script core files -->
</head>
<body>
<TABLE id="principal" width="80%" cellSpacing=0 cellPadding=0 align="center" border=0>
  <TBODY valign="top">
  <TR>
    <TD colSpan=2 class=texto>
	<?php include("encabezado.php"); ?>
	</TD>
  </TR>
    
  <TR>
    <TD class=texto colspan="2">
		<?php include("menu_vista.php"); ?>
	</TD>
  </TR>
  <TR>
    <TD colSpan=2>
      <HR color=#BABABA>    
	  </TD>
  </TR>
   <TR>
		<TD class=texto colSpan=2>
		
  	<div id="div_respuesta" align="center"></div><br>
		
    <div id="panel">
    <a href="formulario.php?accion=insertar" class="boton">Insertar</a>
    <a href="formulario.php?accion=buscar" class="boton">Buscar</a>
    <a href="listar.php" class="boton">Listar</a>
    </div>
    <br><br>