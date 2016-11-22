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
					<div class="prev"><a href="framework_semilla.php" rel="prev" title="Previo">Previo</a></div>
				</div>
					<div class="button1-left">
					<div class="next">
					<a href="tablas_observer.php" rel="next" title="Siguiente">Siguiente</a>
					</div>
					</div>
			</div>
			<h2>Bienvenida</h2>
		</div>
<script>
$(document).ready(function(){
	$("#btn_procesar").click(function(){
	
		alert("para procesar"); 
		$.post("../modelo/abstraccion/creacion_modelo/tablas_detalles.php", {tabla_madre:$("#tabla_madre").val(),tabla_hija:$("#tabla_hija").val()}, function(data){
		
		//console.log(data)
		alert(data.mensaje);
		
		}, "json");
		return false;
	});
});
</script>

<form action="index.php" method="post" id="adminForm" class="form-validate">
	<div id="installer">
		<div class="m">
			<h3>Bienvenida</h3>
			<div class="install-text">
			Tomate un tiempo y lee gracias	
			</div>
			<div class="install-body">
				<div class="m">
					<fieldset>
						<?php
					include("../modelo/config.modelo.php");
					include("../modelo/abstraccion/creacion_modelo/creacion_modelo.php");
					$bd_tablas = new tables;
					$todas_tablas=$bd_tablas->todas_tablas();
					?>
						<table class="content2 db-table" cellpadding="10">
							<tr>
								<td>Tabla padre</td>
								<td bgcolor="#3333FF">
									<select id="tabla_madre">
									<?php foreach($todas_tablas as $index => $tabla) {
									
										if (substr_count($tabla,"."))
											{
											$schema_tabla=explode(".", $tabla);
											$tabla2=$schema_tabla[1];
											}
											else
											{
											$tabla2=$tabla;
											}
									
									?>
									<option value="<?php echo $tabla;?>"><?php echo $tabla2;?></option>
									<?php } ?>
									</select>
								</td>
							</tr>
							<tr>
								<td>Tabla hija (Detalle)</td>
								<td bgcolor="#3333FF">
									<select id="tabla_hija">
									<?php foreach($todas_tablas as $index => $tabla) {
										if (substr_count($tabla,"."))
											{
											$schema_tabla=explode(".", $tabla);
											$tabla2=$schema_tabla[1];
											}
											else
											{
											$tabla2=$tabla;
											}
										
									?>
									<option value="<?php echo $tabla;?>"><?php echo $tabla2;?></option>
									<?php } ?>
									</select>
								</td>
							</tr>
							<tr>
								<td colspan="2" align="center"> 
									<button id="btn_procesar">Procesar</button>
								</td>
							</tr>
						</table>
					</fieldset>
				</div>
				<div class="clr"></div>
			</div>
			<div class="clr"></div>
		</div>
	</div>
</form>
<?php include("pie.php"); ?>