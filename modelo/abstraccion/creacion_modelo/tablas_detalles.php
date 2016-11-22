<?php


include("../../../inc/config.sistema.php");
include("../../config.modelo.php");
include("creacion_modelo.php");
$tablas = new tables;

if (substr_count($_REQUEST["tabla_madre"],"."))
{
	$schema_tabla=explode(".", $_REQUEST["tabla_madre"]);
	$tabla_madre=$schema_tabla[1];
	$schema_tabla_madre=$schema_tabla[0];
}
else
{
	$tabla_madre=$_REQUEST["tabla_madre"];
}


if (substr_count($_REQUEST["tabla_hija"],"."))
{
	$schema_tabla=explode(".", $_REQUEST["tabla_hija"]);
	$tabla_hija=$schema_tabla[1];
	$schema_tabla_hija=$schema_tabla[0];
}
else
{
	$tabla_hija=$_REQUEST["tabla_hija"];
}

$PrimaryKey=$tablas->MetaPrimaryKeys($tabla_madre);

$funcion_generica='function procesar(data,textStatus) 
	{
		if(data.estado=="insertado"){
			$("#div_respuesta").html("<div class=\'errorMessage\'>" + data.mensaje + "</div>");
			
			 $("#div_respuesta").dialog({
										modal: true,
										buttons: {
										Ok: function() {
											$(this).dialog("close");
											}
										}
			});
			 
			reset_frm();
		/*LINEA*/
		} else if ((data.estado=="encontrado") || (data.estado=="actualizado")) {
			//alert("buscar");
			$("#frm_busqueda").attr(\'action\', \'listar.php\');
				 $("#frm_formulario :input").each(function(){
						//alert(this.name+" "+this.value);					
					if (this.value){
						$(\'<input name="\'+this.name+\'" type="hidden" value="\'+this.value+\'" />\').appendTo("#frm_busqueda");
					}
				});
				 
			$("#frm_busqueda").submit();
			
		} else if(data.estado=="eliminado") {
			$("#div_respuesta").html("<div class=\'errorMessage\'>" + data.mensaje + "</div>");
			window.location="listar.php";
		} else
		{
			$("#div_respuesta").html("<div class=\'errorMessage\'>" + data.mensaje + "</div>");
		}
	}';
	
	if($schema_tabla_hija==""){
		$js='
		if (!($.isEmptyObject(data))){
		window.location="../'.$tabla_hija.'/formulario.php?accion=insertar&'.$PrimaryKey[0].'="+data.'.$PrimaryKey[0].';
		
		}';
	}
	else
	{
		$js='
		if (!($.isEmptyObject(data))){
		window.location="../'.$schema_tabla_hija."/".$tabla_hija.'/formulario.php?accion=insertar&'.$PrimaryKey[0].'="+data.'.$PrimaryKey[0].';
		}
		';
	
	}
	
	
	#$funcion_procesar=str_replace("/*LINEA*/",$js,$funcion_generica);
	
	if($schema_tabla_madre==""){
		$fsalida="../../../js/validaciones/".$tabla_madre.".js";
	}
	else
	{
		$fsalida="../../../js/validaciones/".$schema_tabla_madre."/".$tabla_madre.".js";
	}
	
	
	$nombre_archivo = $fsalida;
	$gestor = fopen($nombre_archivo,"r");
	$contenido = fread($gestor, filesize($nombre_archivo));
	fclose($gestor);
	unlink($nombre_archivo);
	
	$contenido=str_replace("/*CODIGO_OBSERVER*/",$js,$contenido);

	$punt = fopen($fsalida, "w");				
	fputs($punt,$contenido);
	
	fclose($punt);
	
	
	
	$js2='$("#div_listar").load("listar.php?accion=buscar&'.$PrimaryKey[0].'="+$("#'.$PrimaryKey[0].'").val()+" #tb_listar");';
	
	#$funcion_procesar=str_replace("/*LINEA*/",$js,$funcion_generica);
	
	if($schema_tabla_hija==""){
		$fsalida="../../../js/validaciones/".$tabla_hija.".js";
	}
	else
	{
		$fsalida="../../../js/validaciones/".$schema_tabla_hija."/".$tabla_hija.".js";
	}
	
	
	$nombre_archivo = $fsalida;
	$gestor = fopen($nombre_archivo,"r");
	$contenido = fread($gestor, filesize($nombre_archivo));
	fclose($gestor);
	
	unlink($nombre_archivo);

	#$contenido=str_replace("/*CODIGO_PROCESAR*/",$funcion_procesar,$contenido);
	$contenido=str_replace("/*CODIGO_OBSERVER*/",$js2,$contenido);

	$punt = fopen($fsalida, "w");				
	fputs($punt,$contenido);
	
	fclose($punt);
		


	$retorna["mensaje"]="Se Proceso el cambio de relacion.";
	$retorna["estado"]="true";
	echo json_encode($retorna); 


?>