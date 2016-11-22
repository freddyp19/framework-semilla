$(document).ready(function() {
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