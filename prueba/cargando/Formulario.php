1.- Inclurir este div en el formulario

<div id="cargando">
	<div id="ciclo_1"></div>
	<div id="ciclo_2"></div>
	<div id="mensaje"></div>
</div>



2.- Incluir estos comandos en el js antes de enviar al post

$("#ciclo_1").addClass('circle');
$("#ciclo_2").addClass('circle1');
$("#mensaje").html("<h1>Por favor espere</h1>");
$.blockUI({message:$("#cargando")});	



3.- Destruir en el archivo configuracion.js

$.unblockUI();
$("#ciclo_1").removeClass('circle');
$("#ciclo_2").removeClass('circle1');
$("#mensaje").html(""); 
