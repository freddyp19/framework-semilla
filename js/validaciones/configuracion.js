// JavaScript Document
$(document).ready(function(){
	$.extend($.validator.messages, {
   	  required: "Este campo es obligatorio.",
	  remote: "Por favor, rellena este campo.",
	  email: "Por favor, escribe una direcci&oacute;n de correo v&aacute;lida",
	  url: "Por favor, escribe una URL v&aacute;lida.",
	  date: "Por favor, escribe una fecha v&aacute;lida.",
	  dateISO: "Por favor, escribe una fecha (ISO) v&aacute;lida.",
	  number: "Por favor, escribe un n&uacute;mero entero v&aacute;lida.",
	  digits: "Por favor, escribe solo digitos.",
	  creditcard: "Por favor, escribe un n&uacute;mero de tarjeta v&aacute;lido.",
	  equalTo: "Por favor, escribe el mismo valor de nuevo.",
	  accept: "Por favor, inserte imagenes con una extensi�n jpg, jpeg, gif, png aceptada.",
	  maxlength: jQuery.validator.format("Por favor, no escribas m&aacute;s de {0} caracteres."),
	  minlength: jQuery.validator.format("Por favor, no escribas menos de {0} caracteres."),
	  rangelength: jQuery.validator.format("Por favor, escribe un valor entre {0} y {1} caracteres."),
	  range: jQuery.validator.format("Por favor, escribe un valor entre {0} y {1}."),
	  max: jQuery.validator.format("Por favor, escribe un valor menor o igual a {0}."),
	  min: jQuery.validator.format("Por favor, escribe un valor mayor o igual a {0}.")
	});
	
	$(".text_campos").each(function(){
		$(this).attr("placeholder",$(this).attr("title"));
	});
	
	$('.letras').alpha({allow:"., "});
	$('.letras_numeros').alphanumeric({allow:"., "});
	$('.numeros').numeric();
	$('.fechas').numeric({allow:"/"});
	
	$("#div_respuesta").ajaxError(function(e, xhr, settings, exception){
	  $(this).html("<div class='errorMessage'> error inesperedado con el servidor</div>");
	});

	$('form input[type="reset"]').click(function(){
  	 window.location="../principal/";
	});
	
	$(".cerrar_sesion").click(function(){ salir(); });
	
	//oculta panel principal que se dibuja dentro del formulario
	if($("#accion").val()=="insertar")
	{
		$("#panel > a:first").hide(); 
	}
	if($("#accion").val()=="buscar")
	{
		$("#panel > a:first").next().hide(); 
	}

	//$('#tb_listar  tr').filter(':even').css('background-color', '#CCCCCC');
	
	$('<form id="frm_busqueda"></form>').appendTo("body");
	
	$('<div id="ciclo_1"></div><div id="ciclo_2"></div><div id="mensaje"></div>').appendTo("#cargando");

	//$.datepicker.regional['es'];
	//$.datepicker.setDefaults($.datepicker.regional["es"]);
	$.datepicker.setDefaults({buttonImage: 'calendar.png', 
							 changeMonth: true,
							 changeYear: true,
							 showAnim: 'fold',
							 showWeek: true});
	
	$('.text_campos').powerTip({ placement: 'e' });
	
	/*
	$('#tb_listar').dataTable( 
							  {
	"oLanguage": {
		"sLengthMenu": "Mostrar _MENU_ registros por pagina",
		"sZeroRecords": "Ningun Registro ...",
		"sInfo": "mostrado _START_ hasta _END_ para _TOTAL_ registros",
		"sInfoEmpty": "mostrado 0 hasta 0 para 0 registros",
		"sInfoFiltered": "(Filtrado de _MAX_ registros)",
		"sSearch": "Filtrar",
		"oPaginate": {
			"sFirst":    "Primero",
			"sPrevious": "Anterior",
			"sNext":     "Siguiente",
			"sLast":     "Ultimo"
		}
	}
	} );
	*/
	//$('#example').dataTable();
	
	
	$('#tb_listar').DataTable( {
		dom: 'T<"clear">lfrtip',
		tableTools: {
			"sSwfPath": "../../js/DataTables-1.10.2/extensions/TableTools/swf/copy_csv_xls_pdf.swf"
		},
		"oLanguage":{"sUrl": "../../js/DataTables-1.10.2/media/language/es_VE.txt"},
		"bJQueryUI": true,
		"sPaginationType": "full_numbers",
		"sScrollY": "300px"
	} );
	
		
	/*
	 var oTable = $('#tb_listar').DataTable({
					"tableTools": {
            		"sSwfPath": "../../js/data-tables/swf/copy_csv_xls_pdf.swf"
        			},			
					"sScrollY": "300px",
					//"sScrollX": "100%",
					"bJQueryUI": true,
					"sPaginationType": "full_numbers",
					"oLanguage":{"sUrl": "../../js/data-tables/media/language/es_VE.txt"}
	});
	
	
    var tt = new $.fn.dataTable.TableTools( oTable );
 
    $( tt.fnContainer() ).insertAfter('#panel_exportar');
		//var oTable_1=$('#tb_listar').dataTable();
		//new FixedHeader(oTable_1);
	
		//var oTableTools = new TableTools(oTable, {"buttons": ["copy","xls","pdf","print"]});
		//$('#panel_exportar').before(oTableTools.dom.container);	
	*/
	//alert(paginador);
});
//por fuera para que lo tomo como una funcion de javascript y despues carge el jquery
/*
	configuracion general para los archivos de tbl_tabas.js
*/
	
	function dialogo_grande(v_url, v_ancho, v_alto, v_tipo){
		//operador ternarrio 
		v_ancho = (v_ancho) ? v_ancho : 600;
		v_alto  = (v_alto)  ? v_alto  : 250;
		v_tipo  = (v_tipo)  ? v_tipo  : "dialogo";
		
		if (v_tipo=="div"){
                    $("#div_respuesta").html(v_url);
                }
		else if(v_tipo=="dialogo"){
                    $("#div_respuesta").load(v_url);
		}
		else
		{
                    $("#div_respuesta").html("");
                    $("#div_respuesta").append('<iframe height="'+v_alto+'" width="'+v_ancho+'" src="'+v_url+'"></iframe>');
		}
		
		$("#div_respuesta").dialog({
                            modal: true,
                            width: v_ancho,
                            height: v_alto,
                            buttons: {
                            Ok: function() {
                                    $(this).dialog("close");
                                    }
                            }
		});
	}
        
        function bloqueo(){
                $('#ciclo_1').addClass('circle');
                $('#ciclo_2').addClass('circle1');
                $('#mensaje').html('<h1>Por favor espere</h1>');
                $.blockUI({message:$('#cargando')});
        }
	
	function desbloqueo(){
	
		$.unblockUI();
		$("#ciclo_1").removeClass('circle');
		$("#ciclo_2").removeClass('circle1');
		$("#mensaje").html("");
	
	}
	
	function procesar(data,textStatus) 
	{
		if(data.estado=="insertado"){
			 
			desbloqueo();
			
			$("#div_respuesta").html("<div class='errorMessage'>" + data.mensaje + "</div>");
			
						
			 $("#div_respuesta").dialog({
										modal: true,
										buttons: {
										Ok: function() {
											$(this).dialog("close");
											}
										}
			});
			 
			reset_frm();
			fun_continuar_detalle(data);
		} else if ((data.estado=="encontrado") || (data.estado=="actualizado")) {
			//alert("buscar");
			$("#frm_busqueda").attr('action', 'listar.php');
				 $("#frm_formulario :input").each(function(){
						//alert(this.name+" "+this.value);					
					if (this.value){
						$('<input name="'+this.name+'" type="hidden" value="'+this.value+'" />').appendTo("#frm_busqueda");
					}
				});
				 
			$("#frm_busqueda").submit();
			
		} else if(data.estado=="eliminado") {
			$("#div_respuesta").html("<div class='errorMessage'>" + data.mensaje + "</div>");
			window.location="listar.php";
		} else
		{
			$("#div_respuesta").html("<div class='errorMessage'>" + data.mensaje + "</div>");
			desbloqueo();
		}
	}

	function reset_frm(){
		$("#frm_formulario").each(function(){
		  this.reset();
		});
	}
	
	function re_cargar_combo(combo,tabla,defecto)
	{
		$("#"+combo).empty(); 
			$.getJSON("../../controlador/"+tabla+".php", {accion:'combo'}, function(data){
				$.each(data,function(index_data,registros){
					$("#"+combo).append(new Option(registros.text, registros.value));
					$("#"+combo).val(defecto);
				});
			});
			return 1;
	}
	
	function re_cargar_combo_dependiente(combo,tabla,v_where,defecto)
	{
		$("#"+combo).empty(); 
			$.getJSON("../../controlador/"+tabla+".php", {accion:'combo_dependiente',where:v_where}, function(data){
				$.each(data,function(index_data,registros){
					$("#"+combo).append(new Option(registros.text, registros.value));
					$("#"+combo).val(defecto);
				});
			});
			return 1;
	}
	
	function salir()
	{
	 	if(confirm("DESEA SALIR DEL SISTEMA? ")){
	   	  	 window.top.location="/sistema_cursos/";
		}
		else
		{
			// window.location="../principal/principal.php";
		}
	}