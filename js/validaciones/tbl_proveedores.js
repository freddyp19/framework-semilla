
$(document).ready(function(){

/*CODIGO_PROCESAR*/
	
		if ($("#accion").val()!="buscar") {	
		var RULES = {
					proveedor:{
						required: true	
					},
					rif:{
						required: true	
					},
					direccion_proveedor:{
						required: true	
					},
					telefono:{
						required: true	
					},
					persona_contacto:{
						required: true	
					},
					correo_electronico:{
						required: true	
					},
					celular:{
						required: true	
					},
					observacion:{
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
				$.post("../../controlador/tbl_proveedores.php", dataString, procesar, "json");	
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

