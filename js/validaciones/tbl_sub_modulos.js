
$(document).ready(function(){

/*CODIGO_PROCESAR*/
	
		if ($("#accion").val()!="buscar") {	
		var RULES = {
					id_modulo:{
						required: true	
					},
					id_tipo_permiso:{
						required: true	
					},
					sub_modulo:{
						required: true	
					},
					descripcion_sub_modulo:{
						required: true	
					},
					enlace:{
						required: true	
					},
					posicion_sub_modulo:{
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
				$.post("../../controlador/tbl_sub_modulos.php", dataString, procesar, "json");	
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

