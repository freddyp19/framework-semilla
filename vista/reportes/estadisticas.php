<?php session_start();
/*
Código necesario para la ejecución
*/
		require_once("../../inc/config.sistema.php");
		require_once("../../modelo/config.modelo.php"); # configuracion del modelo		
		
		require_once("../../modelo/class_tbl_centros_trabajos.php"); # clase del modelo
		$Obj_tbl_centros_trabajos = new tbl_centros_trabajos;
		
		$_SESSION["where"]="";	
		
?>
<?php include("../../inc/head_sistema.php"); ?>
<?php include("../encabezado/encabezado.php"); ?>
<TABLE cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
  <TBODY>
  <TR>
    <TD class=texto colSpan=2>&nbsp;</TD></TR>
  <TR>
    <TD class=texto width="40%">Bienvenido(a):  <?php echo $_SESSION["session_usuario"]["login"]; ?></TD>
    <TD class=texto align=right width="60%">Si no eres <?php echo $_SESSION["session_usuario"]["login"]; ?>, haz clic <A class=enlace  href="/<?php echo $sistema; ?>/">aqui</A></TD></TR>
  <TR>
    <TD colSpan=2>
      <HR color=#BABABA>
    </TD>
  </TR>
   <TR>
    <TD height="10" colSpan=2 class=texto><!--MENU--></TD>
  </TR>
   <TR>
     <TD class=texto colSpan=2>
	 
	 <!-- inicio contenido -->
	 <table width="100%" border="0" cellspacing="0" cellpadding="0">
	  <tr>
		<td width="<?php echo $ancho_menu; ?>" valign="top">
			<?php include("../menu/menu.php"); ?>
		</td>
		<td valign="top" align="left">
		<!--inicio viata de plantilla -->
		
		
		<!--<script type="text/javascript" src="../../js/validaciones/tbl_cargos.js"></script> -->
		<!--
		<div id="div_respuesta" align="center"></div><br>
		
		<div id="panel">
		<a href="formulario.php?accion=insertar" class="boton">Insertar</a>
		<a href="formulario.php?accion=buscar" class="boton">Buscar</a>
		<a href="listar.php" class="boton">Listar</a>
		<br><br>
		</div>
		 -->
		<form id="frm_formulario" name="frm_formulario" action="reportes_estadisticas3.php" target="_blank"> 
<!--  method="post" action="javascript:void(null);" onSubmit="return validar_tbl_cargos(this);" -->
		
		<input name="accion" id="accion" type="hidden" value="<?php echo $_REQUEST["accion"]?>" />
		<input name="quien" type="hidden" value="<?php echo $_REQUEST["quien"]?>" />
	<input name="id_cargo" type="hidden" value="<?php echo $_REQUEST["id_cargo"]?>" />
<table cellpadding="0" cellspacing="0" class="grupoCampos">
				  <tr>
					<td colspan="2" class="tituloGrupoCampos"><?php echo strtoupper($_REQUEST["accion"]); ?> - estadisticas </td>
				  </tr>
				  <tr>
					<td class="tituloCelda">centro trabajo</td>
					<td>	<select name="id_centro_trabajo" id="id_centro_trabajo" class="text_campos">
						<option value="">Seleccione...</option>
						<?php echo $Obj_tbl_centros_trabajos->ver_opciones_tbl_centros_trabajos($_REQUEST["id_centro_trabajo"]);?>
					</select>*
					<img src="../../imagenes/reload.jpg" width="15" height="15" onclick="re_cargar_combo('id_centro_trabajo','centros_trabajos')" />
					</td>
			  	</tr>
				<tr>
					<td class="tituloCelda">Periodo</td>
					<td>	
                    <select name="periodo" id="periodo" class="text_campos">
                    	<option value="1">Enero</option>
                        <option value="2">Febrero</option>
                        <option value="3">Marzo</option>
                        <option value="4">Abril</option>
                        <option value="5">Mayo</option>
                        <option value="6">Junio</option>
                        <option value="7">Julio</option>
                        <option value="8">Agosto</option>
                        <option value="9">Septiembre</option>
                        <option value="10">Octubre</option>
                        <option value="11">Noviembre</option>
                        <option value="12">Diciembre</option>
                    	<optgroup label="Timestres" title="Timestres">
                     	<option value="1,2,3">I Trimestre</option>
                        <option value="4,5,6">II Trimestre</option>
                        <option value="7,8,9">III Trimestre</option>
                        <option value="10,11,12">IV Trimestre</option>
                        </optgroup>
                        <optgroup label="Semestres" title="Semestres">
                        <option value="1,2,3,4,5,6">I Semestre</option>
                        <option value="7,8,9,10,11,12">II Semestre</option>
                        </optgroup>
                        <optgroup label="Anuel" title="Anuel">
                        <option value="1,2,3,4,5,6,7,8,9,10,11,12" selected="selected">Anual</option>
                        </optgroup>
                    </select>*
					</td>
			  	</tr>
				<tr>
					<td class="tituloCelda">Mes</td>
					<td>	
                    <select name="mes" id="mes" class="text_campos">
                    	<option value="1">Enero</option>
                        <option value="2">Febrero</option>
                        <option value="3">Marzo</option>
                        <option value="4">Abril</option>
                        <option value="5">Mayo</option>
                        <option value="6">Junio</option>
                        <option value="7">Julio</option>
                        <option value="8">Agosto</option>
                        <option value="9">Septiembre</option>
                        <option value="10">Octubre</option>
                        <option value="11">Noviembre</option>
                        <option value="12">Diciembre</option>
                    </select>*
					</td>
			  	</tr>
				<tr>
					<td class="tituloCelda">Año</td>
					<td>	
                   <input name="anio" id="anio" type="text" class="text_campos numeros" maxlength="4" value="<?php echo $_REQUEST["anio"]=date("Y"); ?>" />*
					</td>
			  	</tr>
		  <tr>
			<td colspan="2" class="pieGrupoCampos">
			<input name="" type="submit" value="<?php echo strtoupper($_REQUEST["accion"]); ?>" class="boton" />
			<input name="" type="reset" value="Cancelar" class="boton" />
			</td>
		  </tr>
		</table>
	</form>
	
		
		<!--fin viata de plantilla -->
		</td>
	  </tr>
	</table>
	 <!-- fin contenido -->
	 
	 </TD>
   </TR>
 </TBODY>
 </TABLE>

<?php include("../pie/pie.php"); ?>