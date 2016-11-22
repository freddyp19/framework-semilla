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
				<div class="button1-left">
					<div class="next"><a rel="next" title="Siguiente" id="btn_siguiente">Siguiente</a></div>
				</div>
			</div>
			<h2>Configuración Aplicacion</h2>
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
						
							window.location="crear_zip.php";
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
			Selecciona las Tablas a Programar	
			</div>
			<div class="install-body">
				<div class="m">
					<fieldset>
<script language="javascript">
$(document).ready(function(){
	$(".activas_desactivar").click(function(){

		$("#ch_m_"+this.value).attr('checked',this.checked);
		$("#ch_c_"+this.value).attr('checked',this.checked);
		$("#ch_f_"+this.value).attr('checked',this.checked);
		$("#ch_l_"+this.value).attr('checked',this.checked);

	});

    $("#cb_tabla").click(function(){

		$("input[type='checkbox']").attr('checked',this.checked);

	});




        
        $("#cb_modelo").click(function(){
          $(".c_modelo").attr('checked',this.checked);   
        });
        
        $("#cb_vista").click(function(){
          $(".c_vista").attr('checked',this.checked);   
        });
        
        $("#cb_controlador").click(function(){
          $(".c_controlador").attr('checked',this.checked);   
        });
        
        $("#cb_listar").click(function(){
          $(".c_listar").attr('checked',this.checked);   
        });
});
</script>							
					<?php
					include("../modelo/config.modelo.php");
					include("../modelo/abstraccion/creacion_modelo/creacion_modelo.php");
					$bd_tablas = new tables;
					$todas_tablas=$bd_tablas->todas_tablas();
					?>
						<table class="content2 db-table">
							<tr>
								<td bgcolor="#3333FF"><input type="checkbox" id="cb_tabla" checked="checked"/>Nombre</td>
								<td bgcolor="#3366FF"><input type="checkbox" id="cb_modelo" checked="checked"/>Modelo (Class)</td>
								<td bgcolor="#3399FF"><input type="checkbox" id="cb_vista" checked="checked"/>Vista (Formulario)</td>
								<td bgcolor="#33CCFF"><input type="checkbox" id="cb_controlador" checked="checked"/>Controlador (Logica negocio)</td>
								<td bgcolor="#33FFFF"><input type="checkbox" id="cb_listar" checked="checked"/>Listar (Ver datos)</td>
							</tr>
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

							<tr id="tr_<?php echo $tabla2;?>">
							<form name="<?php echo $tabla2;?>" id="<?php echo $tabla2;?>">
							
								<td bgcolor="#33FFFF"><input type="checkbox" checked="checked" class="activas_desactivar" value="<?php echo $tabla2;?>"/> &nbsp;&nbsp; <?php echo $tabla;?>
								<input type="hidden" name="tablas" value="<?php echo $tabla;?>"  />
								</td>
								<td bgcolor="#33CCFF"><input type="checkbox" id="ch_m_<?php echo $tabla2;?>" name="modelo" class="c_modelo" checked="checked"/></td>
                                                                <td bgcolor="#3366FF"><input type="checkbox" id="ch_f_<?php echo $tabla2;?>" name="formulario" class="c_vista" checked="checked"/></td>
                                                                <td bgcolor="#3399FF"><input type="checkbox" id="ch_c_<?php echo $tabla2;?>" name="controlador" class="c_controlador" checked="checked"/></td>
								<td bgcolor="#3333FF"><input type="checkbox" id="ch_l_<?php echo $tabla2;?>" name="listar" class="c_listar" checked="checked"/></td>
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