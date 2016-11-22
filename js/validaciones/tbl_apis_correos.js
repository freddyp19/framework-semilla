
$(document).ready(function(){

/*CODIGO_PROCESAR*/
	
		if ($("#accion").val()!="buscar") {	
		var RULES = {
					usuario_correo:{
						required: true	
					},
					clave_correo:{
						required: true	
					},};
	}
	else
	{
		var RULES = {};
	}

	$("#frm_formulario").validate({
		rules: RULES,
		 submitHandler: function(form) {
		 
		 if (($("#accion").val()=="eliminar") && (!(confirm("confirme que quiere eliminar el registro?")))){
				return false;
				}
		 
				bloqueo();
			  	dataString = $("#frm_formulario").serialize();
				$.post("../../controlador/tbl_apis_correos.php", dataString, procesar, "json");	
			return false;   
		 }
		 });
		 
	//$("#telefono").mask("(9999) 999-9999");
	//$("#fecha_expedicion").mask("9999-99-99");
	//$("#valido_hasta").mask("9999-99-99");		 

/*CODIGO_DETALLE*/
fun_continuar_detalle({});

});

function fun_continuar_detalle(data){
		/*CODIGO_OBSERVER*/
}

