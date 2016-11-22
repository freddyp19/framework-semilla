<?php include("header.php");?>
<div id="system-message-container"> </div>

		<div id="content-box">
			<div id="content-pad">
				<div id="stepbar">
					<?php include("menu.php");?>
				</div>
				
<div id="right">
	<div id="rightpad">
		<div id="step">
		
			<div class="far-right">
				<div class="button1-right">
				<div class="prev"><a href="licencia.php" rel="prev" title="Previo">Previo</a></div>
				</div>
				<div class="button1-left"><div class="next"><a rel="next" title="Siguiente" id="btn_siguiente">Siguiente</a></div></div>
			</div>
			<h2>Configuración Aplicacion</h2>
		</div>
<script type="text/javascript">
	$(document).ready(function(){
		$("#btn_siguiente").click(function(){
			$("#adminForm").submit();

		});
	});
	</script>
<form action="crear_config_sist.php" method="post" id="adminForm" class="form-validate">
	<div id="installer">
		<div class="m">
			<h3>Configuración Aplicacion</h3>
		<!--
			<iframe src="gpl.htm" class="license" marginwidth="25" scrolling="auto"></iframe>
		-->
		<div class="install-text">
					Configuración Aplicacion
			</div>
			<div class="install-body">
				<div class="m">
					<h4 class="title-smenu" title="Configuracion de la Aplicacion">
						Configuracion de la Aplicacion
					</h4>
					<div class="section-smenu">
						<table class="content2 db-table">
							<tr>
								<td></td>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<td colspan="2">
									Servidor
									<br />
									<input type="text" name="servidor" id="servidor" value="http://localhost">
								</td>
								<td>
									<em>
									recuerde colocar http://nombre_ser_servidor
									</em>
								</td>
							</tr>
							<tr>
								<td colspan="2">
									Carpeta Raiz del sistema
									<br />
									<?php 
									
									$sistema=str_replace("/instalar/config_sist.php","",$_SERVER['PHP_SELF']); 
									$sistema=str_replace("/","",$sistema); 
									
									?>
								<input type="text" name="sistema" id="sistema" value="<?php echo $sistema; ?>" readonly="true">
								</td>
								<td>
									<em>
									recuerde no colocar espacios
									</em>
								</td>
							</tr>
							<tr>
								<td colspan="2">
									nombre del sistema
									<br />
									<input type="text" name="nombresistema" id="nombresistema" value="nombresistema">
								</td>
								<td>
									<em>
									este nombre sera utilizado como titulo de la aplicacion
									</em>
								</td>
							</tr>
							<tr>
								<td colspan="2">
									Layout por defecto para toda la aplicacion
									<br />
									<select id="defaul_layouts" name="defaul_layouts" class="inputbox">

									<?php

									echo $directorio = "../vista/layouts/";
									
									$abroDir = opendir($directorio);
									
									while ($contenido = readdir($abroDir))
									{
									if (is_dir($directorio.$contenido) && ($contenido!=".") && ($contenido!="..") )										{
									?>
									<option value="<?php echo $contenido ?>"><?php echo $contenido ?></option>
									<?php
										}
									}
									closedir($abroDir); 
									?>						
									
									</select>
								</td>
								<td>
									<em>
									es recomendable dejar esta seccion con el valor de defecto si no cuenta con otro layout
									</em>
								</td>
							</tr>		
						</table>
					</div>
				</div>
			</div>
			<div class="clr"></div>
		</div>
		</div>
	</div>

</form>
<?php include("pie.php"); ?>