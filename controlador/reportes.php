<?php
	session_start();
	require_once("../inc/config.sistema.php"); # configuracion del sistema
	require_once("../modelo/config.modelo.php"); # configuracion del modelo
	require_once("../modelo/class_reportes.php"); # clase del modelo
	require_once("../modelo/class_tbl_memorandas.php"); # clase del modelo
	require_once("../modelo/class_tbl_resultados_medicos.php"); # clase del modelo

	
	$Obj_reportes = new reportes();
		
	switch ($_REQUEST["accion"])
	{
		case "constacioa_estudios":
		/*
			if ($reporte=$Obj_reportes->memorandum($_REQUEST["id_memorandum"]))
			{ 
			$reporte=$reporte[0];
				if ($reporte["sexo"]=="femenino")
				{ 
					$cambio[0][0]="la";
					$cambio[1][0]="a";
				}
				 else 
				{
					$cambio[0][0]="el";
					$cambio[1][0]="o";
				}
				$cambio[0][1]="#el_la#";
				
				$cambio[1][1]="#a_o#";
				
				$cambio[2][0]=$reporte["nombres"].", ".$reporte["apellidos"];
				$cambio[2][1]="#nombre_estudiante#";
				
				$cambio[3][0]=$reporte["cedula"];
				$cambio[3][1]="#cedula#";
				
				$cambio[4][0]=$reporte["periodo"];
				$cambio[4][1]="#periodo#";
				
				$cambio[5][0]=$reporte["carrera"];
				$cambio[5][1]="#carrera#";
				

				$fsalida="reportes/enviar_constacia_estudios.rtf";
				$nombre_archivo = "../{$vista_sistema}/reportes/CONSTANCIA_DE_ESTUDIOS.rtf";
				$gestor = fopen($nombre_archivo,"r");
				
				$contenido = fread($gestor, filesize($nombre_archivo));
				
				fclose($gestor);

				for ($i=0; $i<=count($cambio); $i++) {$contenido=str_replace($cambio[$i][1],$cambio[$i][0],$contenido);}
				
				$punt = fopen($fsalida, "w");				
				fputs($punt,$contenido);
				
				fclose($punt);
				
				header("Content-type: application/ms-word"); 
				header("Content-Disposition: attachment; filename=$fsalida");
				readfile($fsalida);
				unlink($fsalida);
			}
			else
			{ 
			$Obj_tbl_carreras->mensaje("NO se encontró registro en la Base de Datos, según los parámetros solicitados");
			}
			$Obj_tbl_carreras->enviar_formulario("../{$vista_sistema}/reportes/constancias_estudios.php",$_REQUEST); 
		*/
		break;
		
		case "memorandum":
		$Obj_tbl_memorandas = new tbl_memorandas($_REQUEST["id_memorandum"]);
		$memorandum=$Obj_tbl_memorandas->listar(true);
			if (count($memorandum)>0)
			{ 
			$reporte=$memorandum[0];

				$cambio[1][0]=$Obj_tbl_memorandas->convertir_fecha(substr($reporte["fecha"],0,10));
				$cambio[1][1]="#*FECHA*#";
				
				$cambio[2][0]=$reporte["centro_trabajo"];
				$cambio[2][1]="#*CENTRO_TRABAJO*#";
			
				$Obj_tbl_resultados_medicos = new tbl_resultados_medicos();
				$Obj_tbl_resultados_medicos->where=" id_resultado_medico in (".$reporte["id_resultados_medicos"].")";
				$pacientes=$Obj_tbl_resultados_medicos->listar(true);
				
				#echo "<pre>"; print_r($pacientes); exit;
				
/* INICIO DE LA TABLA */

$output.= "{ ";  //<-- Inicio de la tabla

$output.= "\\trgaph70"; //<-- márgenes izquierdo y derecho de las celdas=70
$output.= "\\trleft-10"; // <-- Posición izquierda la primera celda = -10

/*  Definición de las celdas de datos. Se definen 4 columnas */
$output.= "
\\clbrdrl\\brdrw10\\brdrs
\\clbrdrt\\brdrw10\\brdrs
\\clbrdrr\\brdrw10\\brdrs
\\clbrdrb\\brdrw10\\brdrs 
\\cellx650

\\clbrdrl\\brdrw10\\brdrs
\\clbrdrt\\brdrw10\\brdrs
\\clbrdrr\\brdrw10\\brdrs
\\clbrdrb\\brdrw10\\brdrs 
\\cellx2000

\\clbrdrl\\brdrw10\\brdrs
\\clbrdrt\\brdrw10\\brdrs
\\clbrdrr\\brdrw10\\brdrs
\\clbrdrb\\brdrw10\\brdrs 
\\cellx6500

";


/*Introducción de los títulos en el primer renglón*/
$output.= "{\\fs24\\b ";  //<-- Fuente de tamaño 24 y en negrita
$output.= "
N° \\cell 
Cédula \\cell 
Nombres y Apellido \\cell}"; 
$output.= " \\row "; //<-- Fin del renglón de encabezado

/* Introducción de los datos */

		                                         
foreach($pacientes as $v)
{
	 //periodo, cod_materia, materia, creditos, nota 
	 $v_l[0]=number_format($v["cedula"],0,",",".");
	 $v_l[1]=utf8_decode($v["nombres"]." ".$v["apellidos"]);
	 $i+=1;
//$v[0]=substr($v[0],0,4);
$output.="{$i}\\cell {$v_l[0]}\\cell {$v_l[1]}\\cell \n";
$output.= "\\row "; //<-- Fin del renglón	

}

$output.= "} ";  //<-- fin de la tabla


				$cambio[3][0]=$output;				
				$cambio[3][1]="#*PACIENTES*#";
				
				$cambio[4][0]=$_REQUEST["id_memorandum"];				
				$cambio[4][1]="#*N*#";
				
				

				$fsalida="../{$vista_sistema}/reportes/enviar_entrega_capev.rtf";
				$nombre_archivo = "../{$vista_sistema}/reportes/entrega_capev.rtf";
				$gestor = fopen($nombre_archivo,"r");
				
				$contenido = fread($gestor, filesize($nombre_archivo));
				
				
				fclose($gestor);

				for ($i=0; $i<=count($cambio); $i++) {$contenido=str_replace($cambio[$i][1],$cambio[$i][0],$contenido);}
		//echo $contenido; exit;
				$punt = fopen($fsalida, "w");				
				fputs($punt,$contenido);
				
				fclose($punt);
				
				header("Content-type: application/ms-word"); 
				header("Content-Disposition: attachment; filename=$fsalida");
				readfile($fsalida);
				unlink($fsalida);
			}
			else
			{ 
			$Obj_tbl_carreras->mensaje("NO se encontró registro en la Base de Datos, según los parámetros solicitados");
			}
			//$Obj_tbl_carreras->enviar_formulario("../{$vista_sistema}/reportes/certificacion_calificacion.php",$_REQUEST); 
			
		break;
		
		case "actualizar":
			if ($Obj_tbl_carreras->actualizar())
			{  $Obj_tbl_carreras->mensaje("se actualizo el registro a la Base de Datos"); }
			else
			{ $Obj_tbl_carreras->mensaje("NO se actualizo el registro a la Base de Datos"); }
			 $Obj_tbl_carreras->enviar_formulario("../{$vista_sistema}/tbl_carreras/tbl_carreras_actualizar.php",$_REQUEST);
		break;
		
		case "eliminar":
			if ($Obj_tbl_carreras->eliminar())
			{  $Obj_tbl_carreras->mensaje("se Elimino el registro a la Base de Datos"); }
			else
			{ $Obj_tbl_carreras->mensaje("NO se Elimino el registro en la Base de Datos"); }
			 $Obj_tbl_carreras->enviar_formulario("../{$vista_sistema}/tbl_carreras/tbl_carreras_listar.php",$_REQUEST);
		break;
	}	
	
	?>
	