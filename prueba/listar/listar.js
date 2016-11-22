$(document).ready(function() {
						   
						   
	$('#tb_listar').dataTable({
					///"sDom": '<"H"Cfr>t<"F"ip>', /* oculator de columnas	*/		  						
					"bJQueryUI": true,
					"sPaginationType": "full_numbers",
					"oLanguage":{"sUrl": "../../../js/data-tables/media/language/es_VE.txt"}
					});
				var oTable_1=$('#tb_listar').dataTable();
				new FixedHeader(oTable_1);
				var oTable = $('#tb_listar').dataTable();
				var oTableTools = new TableTools(
				oTable, {"buttons": ["copy","xls","pdf","print"]
	});
				
	$('#panel_exportar').before(oTableTools.dom.container);					   
						   
						   
						   
$("#cantidad_mostrar").click(function(){
	var cantidad=$("#cantidad_mostrar").val();
	$("#fin").val(cantidad)
	window.location="listar_1.php?fin="+cantidad+""
	});
						   
	$(".imprimir").click(function(event){
		
        //guardamos en una variable la cantidad de columnas que tiene la tabla
        iTotalColumnasExistentes=$('#tb_listar th').length;
        iColumnaAEliminar=iTotalColumnasExistentes-1;

		$objTabla=$("#tb_listar").eq(0).clone();
        $objTabla.find('tr').each(function(){
            //con 'eq' especificamos el indice o la posicion del elemento
            //es como decir: eliminar el elemento TD/TH que este en el indice 4 (por ejemplo)
            $(this).find('td:eq('+iColumnaAEliminar+'),th:eq('+iColumnaAEliminar+')').remove();
        });
		porcentaje=(100/(iTotalColumnasExistentes-2));
		$objTabla.find('tr').removeAttr("style");
		$objTabla.find('td,th').css("width",porcentaje+"%");
		$("#tabla").val(	
			$("<div>").append($objTabla).html()
		);
	
		$("#frm_exportar_pdf").submit();
	
	});
	
	$('<form method="post" action="../../reportes/imprimir.php" target="_blank" id="frm_exportar_pdf"><input type="hidden" id="tabla" name="tabla" /></form>').appendTo("body");	
	
});	



function solicitud_pendiente(destino,cedula,id_solicitud,id_solicitud_pendiente){
	if(destino==1){
window.location="../tbl_solicitudes/formulario_utiles_y_uniformes.php?accion=insertar&cedula="+cedula+"&id_solicitud="+id_solicitud+"&id_solicitud_pendiente="+id_solicitud_pendiente+"";}
	if(destino==2){
window.location="../tbl_solicitudes/formulario_ayuda_escolar.php?accion=insertar&cedula="+cedula+"&id_solicitud="+id_solicitud+"&id_solicitud_pendiente="+id_solicitud_pendiente+"";}
	if(destino==3){
window.location="../tbl_solicitudes/formulario_guarderia_infantil.php?accion=insertar&cedula="+cedula+"&id_solicitud="+id_solicitud+"&id_solicitud_pendiente="+id_solicitud_pendiente+"";}
	if(destino==4){
window.location="../tbl_solicitudes/formulario_utiles_y_uniformes.php?accion=insertar&cedula="+cedula+"&id_solicitud="+id_solicitud+"&id_solicitud_pendiente="+id_solicitud_pendiente+"";}
	if(destino==5){
window.location="../tbl_solicitudes/formulario_utiles_y_uniformes.php?accion=insertar&cedula="+cedula+"&id_solicitud="+id_solicitud+"&id_solicitud_pendiente="+id_solicitud_pendiente+"";}
	if(destino==6){
window.location="../tbl_solicitudes/formulario_utiles_y_uniformes.php?accion=insertar&cedula="+cedula+"&id_solicitud="+id_solicitud+"&id_solicitud_pendiente="+id_solicitud_pendiente+"";}
	}


function actualizar_solicitud(id_solicitud,tipo_solicitud,id_estatus_solicitud,id_solicitud,cedula){
	if(tipo_solicitud==1){
		if(id_estatus_solicitud==1){window.location="../tbl_solicitudes/formulario_utiles_y_uniformes.php?accion=actualizar&id_solicitud="+id_solicitud+"&cedula="+cedula+"";}
	else{$("#div_respuesta_listado").html("La solicitud N°"+id_solicitud+" no se puede modificar")}
}
	if(tipo_solicitud==2){
window.location="../tbl_solicitudes/formulario_ayuda_escolar.php?accion=actualizar&id_solicitud="+id_solicitud+"&cedula="+cedula+"";
}

	if(tipo_solicitud==3){
window.location="../tbl_solicitudes/formulario_guarderia_infantil.php?actualizar=insertar&cedula="+cedula+"&id_solicitud="+id_solicitud+"&id_solicitud_pendiente="+id_solicitud_pendiente+"";}
	if(tipo_solicitud==4){
window.location="../tbl_solicitudes/formulario_utiles_y_uniformes.php?accion=actualizar&cedula="+cedula+"&id_solicitud="+id_solicitud+"&id_solicitud_pendiente="+id_solicitud_pendiente+"";}
	if(tipo_solicitud==5){
window.location="../tbl_solicitudes/formulario_utiles_y_uniformes.php?accion=actualizar&cedula="+cedula+"&id_solicitud="+id_solicitud+"&id_solicitud_pendiente="+id_solicitud_pendiente+"";}
	if(tipo_solicitud==6){
window.location="../tbl_solicitudes/formulario_utiles_y_uniformes.php?accion=actualizar&cedula="+cedula+"&id_solicitud="+id_solicitud+"&id_solicitud_pendiente="+id_solicitud_pendiente+"";}
	}



function eliminar()
{ 

	 var arr = $(":checkbox:checked").map(function() { 
					return $(this).val();
				}).get();
			
		if (!(confirm("¿Esta seguro que desea Eliminar "+arr.length+" registros?")))
		{
			return false;		
		}
		
		arr=arr.join(',');
		
		$.post($("#tabla_listar").attr("action"), {primari_key:arr,accion:"eliminar"}, procesar, "json");
		function procesar(data,textStatus) 
		{
			if (textStatus=="success") 
			{
				if(data.estado=="eliminado")
				{
					$("#div_respuesta").html("<div class='errorMessage'>" + data.mensaje + "</div>");
				} 
				else 
				{
					$("#div_respuesta").html("<div class='errorMessage'>" + data.mensaje + "</div>");
				}
					
			}
			else
			{
				$("#div_respuesta").html("<img src='../../imagenes/loader.white.gif' />Cargando...");
			}
		}
		$(".grid").loadGrid();
}