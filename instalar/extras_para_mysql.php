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
				<div class="prev"><a href="config_bd.php" rel="prev" title="Previo">Previo</a></div>
				</div>
				<div class="button1-left"><div class="next"><a rel="next" title="Siguiente" id="btn_siguiente">Siguiente</a></div></div>
			</div>
			<h2>Extras para MySQL (Opcional)</h2>
		</div>
	<script type="text/javascript">
	
		$(document).ready(function(){
			$("#btn_siguiente").click(function(){
				$("#adminForm").submit();
			});
			
			$("#instalar_extension_auditoria").click(function(){
				$("#instalar_extension_usuarios").attr("checked","checked");			
			});	
		});
		
	</script>
<form action="crear_extras_para_mysql.php" method="post" id="adminForm" class="form-validate">
	<div id="installer">
		<div class="m">
			<h3>Extras para MySQL (Opcional)</h3>
		<!--
			<iframe src="gpl.htm" class="license" marginwidth="25" scrolling="auto"></iframe>
		-->
		<div class="install-text">
					Extras para MySQL (Opcional)
			</div>
			<div class="install-body">
				<div class="m">
					<h4 class="title-smenu" title="Configuracion de la Aplicacion">
						Extras para MySQL (Opcional)
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
								<input name="instalar_extension_usuarios" id="instalar_extension_usuarios" type="checkbox" value="si" />
								</td>
								<td>
									<em>
									Instalar la Extension de Schemas de Usuarios
									</em>
								</td>
							</tr>
							<tr>
								<td colspan="2">
									Tipo Base de Datos
								</td>
								<td>
									<em>
									PostgreSQL, para esto es posible crear un schema usuarios, que contendra las siguientes tablas: tbl_usuarios, tbl_perfiles, tbl_regiones, tbl_modulo, tbl_sub_modulo
									</em>
								</td>
							</tr>
								<!-- 					
							<tr>
								<td colspan="2">
									Caracteristicas de las Tablas
									<br />
								</td>
								<td>
									<em>
									create
									</em>
								</td>
							</tr>		
							-->
						</table>
					</div>
					<!--<div class="section-smenu">
						<table class="content2 db-table">
							<tr>
								<td></td>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<td colspan="2">
								<input name="instalar_extension_auditoria" id="instalar_extension_auditoria" type="checkbox" value="si" />
								</td>
								<td>
									<em>
									Instalar la Extension de Auditoria
									</em>
								</td>
							</tr>
							<tr>
								<td colspan="2">
									Tipo Base de Datos
								</td>
								<td>
									<em>
									PostgreSQL, para esto es posible crear un schema auditoria, que contendra las siguientes tablas:
									</em>
								</td>
							</tr>
													
							<tr>
								<td colspan="2">
									Caracteristicas de las Tablas
									<br />
								</td>
								<td>
									<em>
									create
									</em>
								</td>
							</tr>		
						</table>
					</div> -->
				</div>
			</div>
			<div class="clr"></div>
		</div>
		</div>
	</div>

</form>
<?php include("pie.php"); ?>