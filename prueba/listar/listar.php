<?php session_start();
/*
Código necesario para la ejecución
*/


			require_once("../../../inc/config.sistema.php"); # configuracion del modelo
			require_once("../../../modelo/config.modelo.php"); # configuracion del modelo
			require_once("../../../modelo/schema_sigblys/class_tbl_solicitudes.php"); # clase del modelo
			require_once("../../../modelo/schema_sigblys/class_tbl_trabajadores.php"); # clase del modelo
		
$Obj_tbl_solicitudes = new tbl_solicitudes($_REQUEST["id_solicitud"],$_REQUEST["fecha_solicitud"],$_REQUEST["id_estatu_solicitud"],$_REQUEST["monto_aprobado"],$_REQUEST["id_tipo_solicitud"],$_REQUEST["id_trabajador"],$_REQUEST["descripcion"],$_REQUEST["usuario"]);
			

		if ($_REQUEST["accion"]=="buscar") {
			if ($resultados=$Obj_tbl_solicitudes->buscar())
			{ 
			}
			else
			{ $Obj_tbl_solicitudes->enviar_formulario("formulario.php?accion=buscar",$_REQUEST); }

		} 
		else{
		
			if($_REQUEST["tipo_solicitud"]=="utiles_y_uniformes"){$pendiente=1;}
			if($_REQUEST["tipo_solicitud"]=="ayuda_escolar"){$pendiente=2;}
			if($_REQUEST["tipo_solicitud"]=="guarderia_infantil"){$pendiente=3;}
			if($_REQUEST["tipo_solicitud"]=="bono_nacimiento"){$pendiente=4;}
			if($_REQUEST["tipo_solicitud"]=="bono_matrimonio"){$pendiente=5;}
			if($_REQUEST["tipo_solicitud"]=="juguetes"){$pendiente=6;}
		
$_SESSION["where"]=$Obj_tbl_solicitudes->where="id_estatu_solicitud=1 "."and"." id_tipo_solicitud=".$pendiente;
			$resultados=$Obj_tbl_solicitudes->listar(true);
		}
	
?>
<?php	include(RUTA_SISTEMA."/vista/layouts/{$defaul_layouts}/header.php"); ?>
		<!--inicio viata de plantilla -->
	
	<?php /*?><?php 
		
		if (!($_REQUEST["inicio"])) { 
			$_REQUEST["inicio"]=0;
			$_REQUEST["fin"]=50;
		}
		
		if(is_array($resultados)){
			$cantidad=count($resultados); //exit;
		}
		else{
			$cantidad=$resultados; //exit;
		}
		
		////$cantidad=count($resultados);
		
		$resultados=$Obj_tbl_solicitudes->limit($_REQUEST["inicio"],$_REQUEST["fin"]);
		
		$_REQUEST["indice"]=($_REQUEST["inicio"]/50)+1;
		$_REQUEST["inicio"]=0;
		$_REQUEST["fin"]=50;
	   
		?><?php */?>
	

	
		<?php /*?><center>
			<?php echo "pagina ".$_REQUEST["indice"]." de "; ?> 
			<a href="listar.php?accion=<?php echo $_REQUEST["accion"]; ?>&inicio=0&fin=50">1&nbsp;</a>
			<?php for($i=1;$i<($cantidad/50);$i++) { ?> 
			<a href="listar.php?accion=<?php echo $_REQUEST["accion"]; ?>&inicio=<?php echo $_REQUEST["inicio"]+=50;?>&fin=<?php echo $_REQUEST["fin"]=50; ?>"><?php echo ($i+1)."&nbsp;"; ?></a>
			<?php  } ?>
	
		</center><?php */?>
				

<script src="../../../js/validaciones/listar.js"></script>
<div id="div_respuesta_listado" align="center"></div>
<div id="panel_exportar"></div>


<!--<div align="right"><span class="boton imprimir">Imprimir</span></div><br/>-->

		<table cellpadding="0" cellspacing="0" border="0" class="display" id="tb_listar" width="90%">
<thead>
<tr class="tituloCelda">
	<th align="center">Solicitud</th>
	<th align="center">Trabajador</th>
	<th align="center">Tipo solicitud</th>
	<th align="center">Fecha solicitud</th>
	<th align="center">Estatu solicitud</th>
	<th align="center">Beneficiario</th>
	<th align="center">Monto aprobado</th>	
	<th align="center">Descripcion</th>
	<th align="center">Retroactivo</th>
	<th>ACCION</th>
</tr>
</thead>

	<?php $i=0; foreach ($resultados as $key => $valor) { ?>
	<?php if($valor["retroactivo"]==""){$valor["retroactivo"]="0";}?>
	<tr class="Contenido" <?php echo $Obj_tbl_solicitudes->color_fondo(); ?>>
	<td align="center"><?php echo "<b>".N°."</b>"." ".$valor["id_solicitud"]; ?></td>
	<td align="center" class="datos_trabajador"><?php echo "<b>".$valor["cedula"]."</b></br>".$valor["primer_nombre"]." ".$valor["primer_apellido"]; ?></td>
	<td align="center"><?php echo $valor["tipo_solicitud"]; ?></td>
	<td><?php echo $valor["fecha_solicitud"]; ?></td>
	<td align="center"><?php echo $valor["estatu_solicitud"]; ?></td>
	<td align="center" class="datos_trabajador">
	<?php echo $valor["nombres_beneficiarios"]; ?></td>
	<td align="center"><?php echo $valor["monto_aprobado"]." Bs"; ?></td>
	<td align="center"><?php echo $valor["descripcion"]; ?></td>
	<td align="center"><?php echo $valor["retroactivo"]." Bs"; ?></td>

		<td>
			<?php 
			switch($_REQUEST["quien"])
			{
			case "actualizar":
			$valor["accion"]="actualizar";
			$Obj_tbl_solicitudes->enviar_formulario("formulario.php",$valor,$boton="",false,"formulario_actualizar_".$i);
			break;
			
			case "eliminar":
			$valor["accion"]="eliminar";
			$Obj_tbl_solicitudes->enviar_formulario("formulario.php",$valor,$boton="",false,"formulario_eliminar_".$i);
			break;
			
			default:
			$valor["accion"]="actualizar";
			$Obj_tbl_solicitudes->enviar_formulario("formulario.php",$valor,$boton="",false,"formulario_actualizar_".$i);
			$valor["accion"]="eliminar";
			$Obj_tbl_solicitudes->enviar_formulario("formulario.php",$valor,$boton="",false,"formulario_eliminar_".$i);
			}
			?>
			
	<div class="btn_actualizar" onClick="actualizar_solicitud(<?php echo $valor["id_solicitud"].",".$valor["id_tipo_solicitud"].",".$valor["id_estatu_solicitud"].",".$valor["id_solicitud"].",".$valor["cedula"]; ?>)"></div>
	<div class="btn_eliminar" onClick="frm_envir(<?php echo "formulario_eliminar_".$i; ?>)"></div>	
		</td>
 
	</tr>

	<?php $i++; } ?></table>
		
		<!--fin viata de plantilla -->
<?php include(RUTA_SISTEMA."/vista/layouts/{$defaul_layouts}/footer.php"); ?>