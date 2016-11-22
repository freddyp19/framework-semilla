
$(document).ready(function(){
$("#menu, #panel").hide();
	function procesar(data,textStatus) 
	{
		if (textStatus=="success") {
				if(data.estado=="autenticado"){
					$("#div_respuesta").html("<div class='errorMessage'>" + data.mensaje + "</div>");
					
					window.location=data.reenvio;
				} 
				 else
				{
					reset_frm();
					$("#div_respuesta").html("<div class='errorMessage'>" + data.mensaje + "</div>");
				}
		}
	}



	function reset_frm(){
		$("#frm_formulario").each(function(){
		  this.reset();
		});
	}
	
	if ($("#accion").val()!="buscar") {	
		var RULES = {
					usuario:{
						required: true	
					},
					clave:{
						required: true	
					}};
	}
	

	$("#frm_formulario").validate({
		rules: RULES,
		 submitHandler: function(form) {
	 
			 $("#div_respuesta").html("<img src='../../imagenes/loader.white.gif' />Cargando...");
			  	dataString = $("#frm_formulario").serialize();
				$.post("../../controlador/tbl_usuarios.php", dataString, procesar, "json");
			return false;   
		 }
		 });
		 
	//$("#telefono").mask("(9999) 999-9999");
	//$("#fecha_expedicion").mask("9999-99-99");
	//$("#valido_hasta").mask("9999-99-99");		 
});