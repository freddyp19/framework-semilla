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
				<div class="prev"><a href="config_sist.php" rel="prev" title="Previo">Previo</a></div>
				</div>
				<div class="button1-left"><div class="next"><a rel="next" title="Siguiente" id="btn_siguiente">Siguiente</a></div></div>
			</div>
			<h2>Configuración de Base de Datos</h2>
		</div>
	<script type="text/javascript">
	$(document).ready(function(){
		$("#btn_siguiente").click(function(){
			$("#adminForm").submit();

		});
	});
	</script>
<form action="crear_config_bd.php" method="post" id="adminForm" class="form-validate">
	<div id="installer">
		<div class="m">
			<h3>Configuración de Base de Datos</h3>
		<!--
			<iframe src="gpl.htm" class="license" marginwidth="25" scrolling="auto"></iframe>
		-->
		<div class="install-text">
					Configuración de Base de Datos
			</div>
			<div class="install-body">
				<div class="m">
					<h4 class="title-smenu" title="Configuracion de la Aplicacion">
						Configuración de Base de Datos
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
									Tipo Base de Datos
									<br />
									<select id="motor" name="motor" class="inputbox">
										<option value="postgres">PostgreSQL</option>
										<option value="mysql" selected="selected">MySQL</option>
									</select>
								</td>
								<td>
									<em>
									seleccione el motor de base de datos
									</em>
								</td>
							</tr>
							<tr>
								<td colspan="2">
									Nombre del Host
									<br />
									<input name="host" id="host" value="localhost" class="inputbox required" type="text">
								</td>
								<td>
									<em>
									Esto es por lo general "localhost"
									</em>
								</td>
							</tr>
							<tr>
								<td colspan="2">
									Usuario
									<br />
									<input name="usuario" id="usuario" class="inputbox required" type="text" value="root">
								</td>
								<td>
									<em>
									O algo como "root" o un nombre de usuario dado por el host
									</em>
								</td>
							</tr>
							<tr>
								<td colspan="2">
									Contraseña
									<br />
									<input name="password" id="password" value="" class="inputbox" type="text">
								</td>
								<td>
									<em>
									Es para conectarte a la base de datos
									</em>
								</td>
							</tr>
							<tr>
								<td colspan="2">
									Nombre de la base de datos
									<br />
									<input name="database" id="database" class="inputbox required" type="text">
								</td>
								<td>
									<em>
									el nombre de la base de datos
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
