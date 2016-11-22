<?php include("../inc/config.sistema.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html slick-uniqueid="3" xmlns="http://www.w3.org/1999/xhtml" xml:lang="es-es" dir="ltr" lang="es-es"><head>
		  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <meta name="generator" content="Joomla! - Open Source Content Management">
  <title>Instalador Web Framework Semilla</title>
  <link href="http://localhost/Joomla/installation/favicon.ico" rel="shortcut icon" type="image/vnd.microsoft.icon">
<!--  <link rel="stylesheet" href="instalar_files/system.css" type="text/css"> -->
  <link rel="stylesheet" href="css/template.css" type="text/css"> 
  <script src="../js/jquery/jquery-1.4.2.min.js" type="text/javascript"></script>
  <script src="../js/jquery.ajaxq/jquery.ajaxq-0.0.1.js" type="text/javascript"></script>
  
  <!--<script src="instalar_files/mootools-core.js" type="text/javascript"></script>
  <script src="instalar_files/core.js" type="text/javascript"></script>
  <script src="instalar_files/mootools-more.js" type="text/javascript"></script>
  <script src="instalar_files/validate.js" type="text/javascript"></script>
  <script src="instalar_files/installation.js" type="text/javascript"></script>
  <script type="text/javascript">
function keepAlive() {	var myAjax = new Request({method: "get", url: "index.php"}).send();} window.addEvent("domready", function(){ keepAlive.periodical(30000); });
window.addEvent('domready', function() {
			$$('.hasTip').each(function(el) {
				var title = el.get('title');
				if (title) {
					var parts = title.split('::', 2);
					el.store('tip:title', parts[0]);
					el.store('tip:text', parts[1]);
				}
			});
			var JTooltips = new Tips($$('.hasTip'), { maxTitleChars: 50, fixed: false});
		});
  </script>
 -->

		<!--[if IE 7]>
			<link href="template/css/ie7.css" rel="stylesheet" type="text/css" />
		<![endif]-->
	<script type="text/javascript">
	$(document).ready(function(){
	
		$("#btn_siguiente").click(function(){
			
			alert("por enviar");
			
			$('form').each(function(enviados){
			
			dataString = $(this).serialize();
			var completado="#tr_"+$(this).attr('id');
			//var enviados=0;
		//alert(dataString);
			//return false;
			
			$.ajaxq("enviar_formulario",{
				url: "../modelo/abstraccion/creacion_modelo/framework_semilla.php",
				async:true,
				data:dataString,
				/*beforeSend: function(objeto){
					$('#bar2').progressbar('value', ((index+1) / characters) *100);
					$('#count2').text(index+1);
					
					if (( ( (index+1) / characters) *100)==100)
						{
							$("#dialog3barra").dialog("close");
							window.location="listar.php";
							//$("#btn_listar").click();
						}
				},*/
				complete: function(objeto, exito){
					//alert("Me acabo de completar")
					//if(exito=="success"){
					
					//alert(completado);
					$(completado).hide();
					
					
					
					if ((enviados+1)==document.forms.length)
						{
						
							window.location="fin.html";
							//$("#btn_listar").click();
						}
						
					/*
								$('#bar2').progressbar('value', ((index+1) / characters) *100);
								$('#count2').text(index+1);
								
								if (( ( (index+1) / characters) *100)==100)
									{
										$("#dialog3barra").dialog("close");
										window.location="listar.php";
										//$("#btn_listar").click();
									}
					*/
					//}
				},
				contentType: "application/x-www-form-urlencoded",
				dataType: "json",
				error: function(objeto, quepaso, otroobj){
				//$("#tr_"+$(this).attr('id')).hide();
					//alert("Estas viendo esto por que falle");
					//alert("Paso lo siguiente: "+quepaso);
				},
				global: true,
				ifModified: false,
				processData:true,
				success: function(datos){
					//alert(datos);
				},
				//timeout: 10000,
				type: "POST"
				
			}); //qajax
			
			}); //formularios
			
		}); //boton
		
	});
	</script>
		
	</head>
	<body>
		<div id="header">
			<span class="logo">
			<a href="http://www.freddyp19.com/" target="_blank">
				<img src="imagenes/logo.jpg" alt="framework semilla venezolano" width="178" height="75">
			</a>
			</span>
			<h1>Semilla Instalaci&oacute;n</h1>
		</div>
		
<div id="system-message-container">
</div>
		<div id="content-box">
			<div id="content-pad">
				<div id="stepbar">
					<h2>Pasos</h2>
					<div class="step" id="language">1 : Bienvenida</div>
					<div class="step" id="license">2 : Licencia</div>
					<div class="step" id="preinstall">3 : Configuración Aplicacion</div>
					<div class="step" id="database">4 : Base de datos</div>
					<div class="step" id="site">5 : Framework Semilla</div>
					<div class="step active" id="complete">6 : Menu</div>
					<div class="step" id="complete">7 : Finalizar</div>								
					<div class="box">
					</div>
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
		<div class="button1-right">
		<div class="prev"><a href="framework_semilla.php" rel="prev" title="Previo">Previo</a></div>
		</div>
		<div class="button1-left"><div class="next"><a href="fin.html" rel="next" title="Siguiente" id="btn_siguiente">Siguiente</a></div></div>
	</div>
	<h2>Menu</h2>
</div>
<!-- form action="crear_config_sist.php" method="post" id="adminForm" class="form-validate" -->
	<div id="installer">
		<div class="m">
			<h3>Menu</h3>
		<!--
			<iframe src="gpl.htm" class="license" marginwidth="25" scrolling="auto"></iframe>
		-->
		<div class="install-text">
					Menu
			</div>
			<div class="install-body">
				<div class="m">
					<h4 class="title-smenu" title="Configuracion de la Aplicacion">
						Menu
					</h4>
					<div class="section-smenu">
								
					<?php
					include("../modelo/config.modelo.php");
					include("../modelo/abstraccion/creacion_modelo/creacion_modelo.php");
					$bd_tablas = new tables;
					$todas_tablas=$bd_tablas->todas_tablas();
					?>
						<table class="content2 db-table">
							<tr>
								<td bgcolor="#3333FF">Nombre</td>
								<td bgcolor="#3366FF">Buscar</td>
								<td bgcolor="#3399FF">Insertar</td>
								<td bgcolor="#33CCFF">Listar</td>
							</tr>
							<?php 
							foreach($todas_tablas as $index => $tabla) {
							if (substr_count($tabla,"."))
								{
									$schema_tabla=explode(".", $tabla);
									$tabla=$schema_tabla[0]."/".$schema_tabla[1];
								}
							?>

							<tr id="tr_<?php echo $tabla;?>">
							
								<td bgcolor="#33FFFF"><?php echo $tabla;?>
								<input type="hidden" name="tablas" value="<?php echo $tabla;?>"  />
								</td>
								<td bgcolor="#33CCFF">
								<a href="../vista/<?php echo $tabla;?>/formulario.php?accion=buscar" target="_blank">
								<img src="imagenes/btn_buscar.png" />
								</a>
								</td>
								<td bgcolor="#3399FF">
								<a href="../vista/<?php echo $tabla;?>/formulario.php?accion=insertar" target="_blank">
								<img src="imagenes/btn_insertar.png" />
								</a>
								</td>
								<td bgcolor="#3366FF">
								<a href="../vista/<?php echo $tabla;?>/listar.php" target="_blank">
								<img src="imagenes/btn_listar.png" />
								</a>
								</td>
							
							</tr>
							
							<?php } ?>
							
						</table>
					</div>
				</div>
			</div>
			<div class="clr"></div>
		</div>
		</div>
	</div>

<!-- /form -->

					</div><div style="display: none;" id="spinner-habslgk8" class="spinner"><div class="spinner-content"><div class="spinner-img"></div></div></div>
				</div>
				<div class="clr"></div>
			</div>
		</div>
		<div id="copyright">
		
			<a href="http://www.freddyp19.com/">framework semilla!®</a> es software libre distribuido bajo la licencia GNU/GPL.<p></p>
			
			</div>
	

</body></html>