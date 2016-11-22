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
				<div class="prev">
					<a href="tablas_detalles.php" rel="prev" title="Previo">Previo</a></div>
				</div>
				<div class="button1-left">
				<div class="next">
					<a href="sistema_operativo.php" rel="next" title="Siguiente" id="btn_siguiente">Siguiente</a></div>
				</div>
			</div>
			<h2>Bienvenida</h2>
		</div>
<script type="text/javascript">
	$(document).ready(function(){
		$("#btn_siguiente").click(function(){
			$("#adminForm").submit();

		});
	});
	</script>
<form action="fin.html" method="post" id="adminForm" class="form-validate">
	<div id="installer">
		<div class="m">
			<h3>Menu</h3>
			<div class="install-text">
			Selecciona la accion para que interactues con el sistema
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

					</fieldset>
				</div>
				<div class="clr"></div>
			</div>
			<div class="clr"></div>
		</div>
	</div>
</form>
<?php include("pie.php"); ?>