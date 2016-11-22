<!DOCTYPE html>
<html lang="es">
<head>
<!-- HEADER -->
  <meta charset="utf-8">
  <title>Framework Semilla con Bootstrap 3</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">

	<!--link rel="stylesheet/less" href="less/bootstrap.less" type="text/css" /-->
	<!--link rel="stylesheet/less" href="less/responsive.less" type="text/css" /-->
	<!--script src="js/less-1.3.3.min.js"></script-->
	<!--append ‘#!watch’ to the browser URL, then refresh the page. -->
	

	<link rel="stylesheet" href="/<?php echo $sistema; ?>/vista/layouts/bootstrap/css/bootstrap.min.css" type="text/css">
	<link rel="stylesheet" href="/<?php echo $sistema; ?>/vista/layouts/bootstrap/css/style.css" type="text/css">

  <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
  <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
  <![endif]-->

  <!-- Fav and touch icons -->
  <link rel="apple-touch-icon-precomposed" sizes="144x144" href="/<?php echo $sistema; ?>/vista/layouts/bootstrap/img/apple-touch-icon-144-precomposed.png">
  <link rel="apple-touch-icon-precomposed" sizes="114x114" href="/<?php echo $sistema; ?>/vista/layouts/bootstrap/img/apple-touch-icon-114-precomposed.png">
  <link rel="apple-touch-icon-precomposed" sizes="72x72" href="/<?php echo $sistema; ?>/vista/layouts/bootstrap/img/apple-touch-icon-72-precomposed.png">
  <link rel="apple-touch-icon-precomposed" href="/<?php echo $sistema; ?>/vista/layouts/bootstrap/img/apple-touch-icon-57-precomposed.png">
  <link rel="shortcut icon" href="img/favicon.png">

	<!-- 
  		<link rel="stylesheet" href="/<?php echo $sistema; ?>/vista/layouts/bootstrap/css/menu.css" type="text/css">
  	-->
  
	<?php include(RUTA_SISTEMA."/inc/head_sistema.php"); ?>
  <script type="text/javascript" src="/<?php echo $sistema; ?>/vista/layouts/bootstrap/js/scripts.js"></script>
  
	<script type="text/javascript" src="/<?php echo $sistema; ?>/vista/layouts/bootstrap/js/bootstrap.min.js"></script>
	
	

</head>

<body>
<div class="container">
	<div class="row clearfix">
		<div class="col-md-12 column">

<!-- Inicio Menu de Navegacion -->

<nav class="navbar navbar-default" role="navigation">

	<?php include("menu.php"); ?>
	
</nav>

<div id="div_respuesta" align="center" class="m"></div><br>
	<div id="panel">
	<a href="formulario.php?accion=insertar" class="boton">Insertar</a>
	<a href="formulario.php?accion=buscar" class="boton">Buscar</a>
	<a href="listar.php" class="boton">Listar</a>
	</div>
<br><br>

<!-- Fin Menu de Navegacion -->
<!-- FIN HEADER -->
<div class="row">
<!-- <div class="col-md-2"></div> -->
<div class="col-md-12">