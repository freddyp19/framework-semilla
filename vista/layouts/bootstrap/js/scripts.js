$(document).ready(function(){

/*
	$(".grupoCampos").addClass("grupoCampos");
	$(".grupoCampos").attr("width","93%");
*/

$(".tituloGrupoCampos").addClass("Titulo-Formulario").attr({bgcolor:"#e8e8e8",align:"center"});

/*
	$(".tituloCelda").addClass("parametrobusqueda").attr({align:"left",height:"30px"});
	$(".text_campos").addClass("tabla_input");
	$(".campotexto").addClass("tabla_input");

	$("#panel > a").each(function(){
		$(this).css({'color': '#FFFFFF'}).addClass("botonRojo");
	});
*/

	$(".text_campos").addClass("form-control");
	$(".campotexto").addClass("form-control");	

	$(".pieGrupoCampos").attr({bgcolor:"#e8e8e8",align:"right"});
	
	//$(".text_campos").attr("placeholder",$(this).attr("title"));
	//$(".campotexto").attr({placeholder:"Hola"});	
	
	$('form input[type="submit"]').addClass("btn btn-success");
	$('form input[type="reset"]').addClass("btn btn-danger");
	$(".tituloCelda").addClass("control-label");
	
	
	//$('.regular-text').css({width: 100%});
		
	//$(".grupoCampos").removeClass("grupoCampos");
	$(".boton").addClass("botonRojo");	
	$("#panel").addClass("btn-group");
	$("#panel > a").addClass("btn btn-default");
	
	
	//$(".tituloGrupoCampos").removeClass("tituloGrupoCampos");
	$(".tituloCelda").removeClass("tituloCelda");
	$(".text_campos").removeClass("text_campos");
	$(".campotexto").removeClass("text_campos");
	$(".boton").removeClass("boton");	
});