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
					<div class="button1-left">
					<div class="next">
					<a href="#" rel="next" title="Siguiente" id="btn_siguiente">Siguiente</a>
					</div>
					</div>
			</div>
			<h2>Bienvenida</h2>
		</div>


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
				url: "crear_vincular_schema_usuarios.php",
				async:true,
				data:dataString,
				complete: function(objeto, exito){
					//alert("Me acabo de completar")
					//if(exito=="success"){
					
					//alert(completado);
					$(completado).hide();	
					
					if ((enviados+1)==document.forms.length)
						{
						
							window.location="framework_semilla.php";
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
						<table class="content2 db-table">
							<tr>
								<td bgcolor="#3333FF">Nombre</td>
								<td bgcolor="#33FFFF">Vincular</td>
							</tr>
							<?php 
							$no_buscar = array("schema_usuarios","schema_auditoria");
							
							foreach($todas_tablas as $index => $tabla) {
							
							if (substr_count($tabla,"."))
								{
									$schema_tabla=explode(".", $tabla);
									if(!(in_array($schema_tabla[0], $no_buscar)))
									{
											$tabla2=$schema_tabla[1];
									}
									else
									{
										continue;
									}
								}
								else
								{
								$tabla2=$tabla;
								}
							
							?>

							<tr id="tr_<?php echo $tabla2;?>">
							<form name="<?php echo $tabla2;?>" id="<?php echo $tabla2;?>">
								<td bgcolor="#33FFFF"><?php echo $tabla;?>
								<input type="hidden" name="tablas" value="<?php echo $tabla;?>"  />
								</td>
								<td bgcolor="#3333FF"><input type="checkbox" name="vincular" /></td>
							</form>
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