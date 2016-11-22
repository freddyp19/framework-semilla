<?php
setlocale(LC_CTYPE, "es_ES");
require_once("../../modelo/config.modelo.php"); # configuracion del modelo
include('../../modelo/fpdf16/fpdf.php');
require('../../modelo/mc_table/mc_table.php');
require('../../modelo/class_reportes.php');
require_once("../../modelo/class_tbl_resultados_medicos_enfermedades.php"); # clase del modelo
	
	
$Obj_reportes = new reportes();

$resultados_medicos=$Obj_reportes->reporte_resultados_medicos($_REQUEST["id_resultado_medico"]);	

$pdf=new PDF_MC_Table('P','mm','Letter');

foreach($resultados_medicos as $index => $rm)
{
	
	$pdf->InHeader=false;
	$pdf->AddPage();
	//es para las siguientes
	//$pdf->title="RESULTADO DEL EXAMEN DE SALUD OCUPACIONAL PREVENTIVO";
	//$pdf->ln(-15);
	$pdf->SetMargins("15","5");
	$pdf->SetFont('Arial','B',10);
	$pdf->ln(25);
	$pdf->MultiCell(0,5,"RESULTADO DEL EXAMEN DE SALUD OCUPACIONAL PREVENTIVO ",0,"C");
		
	//$pdf->Cell(185,5,"CLIENTE",1,1,'C');
	
	//echo "<pre>"; print_r($resultados_medicos); exit;
		
	$x=$pdf->GetX();
	$y=$pdf->GetY();
		$pdf->Rect($x,$y,$w=185,$h=230);//38
	
	$pdf->SetWidths(array(80,30,30,40));
	$pdf->SetAligns(array('J','J','J','J'));
	$pdf->Row(array("NOMBRE: ".strtoupper(utf8_decode($rm["nombres"]." ".$rm["apellidos"])),"CI: ".$rm["cedula"],"EDAD: ".$rm["edad"],"FECHA: ".$Obj_reportes->convertir_fecha($rm["fecha"])));
		
		$pdf->ln(03);	$pdf->MultiCell(185,0.1,"","T",2,"C");
	
	$pdf->MultiCell(0,5,strtoupper("Cargo o aspirante a: ".$rm["cargo"]),0,"L");
	
		$pdf->ln(03);	$pdf->MultiCell(185,0.1,"","T",2,"C");

	//$pdf->rectangulo=true;
	$pdf->SetWidths(array(80,105));
	$pdf->SetAligns(array('J','J'));
	$pdf->Row(array(strtoupper("Tipo de examen: ".utf8_decode($rm["tipo_examen"])),utf8_decode(strtoupper("Centro de trabajo: ".$rm["centro_trabajo"]))));
	
		$pdf->ln(03);	$pdf->MultiCell(185,0.1,"","T",2,"C");
	
	$linea=(strtoupper("Peso: ").$rm["peso"]." (Kg) ".strtoupper("Talla: ").$rm["talla"]." (mts) ".strtoupper("índice de Masa Corporal: ").$rm["imc"]."\n".strtoupper("Presión arterial: ").$rm["presion_arterial"]." (mmHg) ".strtoupper("Frec. card: ").$rm["frecuencia_cardiaca"]." (lat/min)");
	$pdf->MultiCell(0,5,$linea,0,"L");	
	
	$pdf->ln(03);	$pdf->MultiCell(185,0.1,"","T",2,"C");
	
	$pdf->Row(array(strtoupper("Electrocardiograma: ".utf8_decode($rm["ekg"])),strtoupper("Observaciones: ").strtoupper(utf8_decode($rm["ekg_observaciones"]))));
	
	$pdf->ln(03);	$pdf->MultiCell(185,0.1,"","T",2,"C");
	
	$pdf->Row(array(strtoupper("Espirometría: ".utf8_decode($rm["espirometria"])),strtoupper("Observaciones: ".strtoupper(utf8_decode($rm["espirometria_observaciones"])))));
	
	$pdf->ln(03);	$pdf->MultiCell(185,0.1,"","T",2,"C");
	
	$pdf->Row(array(strtoupper("Audiometría: ".utf8_decode($rm["audiometria"])),strtoupper("Pérdida auditiva: ".utf8_decode($rm["audiometria_perdida_auditiva"]))));
	
	//$pdf->MultiCell(0,0,"Observaciones: ".utf8_decode($rm["audiometria_observaciones"]),"T",0,"C");
	
	$pdf->SetWidths(array(185));
	$pdf->SetAligns(array('J'));
	$pdf->Row(array(strtoupper("Observaciones: ".utf8_decode($rm["audiometria_observaciones"]))));
	
	 $pdf->ln(03);	$pdf->MultiCell(185,0.1,"","T",2,"C");
	 
	 $linea=strtoupper("Visión lejana \n").strtoupper("Visión sin lentes: ".$rm["vision_sin_lentes"]).strtoupper(" Visión con lentes: ".$rm["vision_con_lentes"]).strtoupper(" Visión de colores: ".$rm["vision_color"]);
	$pdf->MultiCell(0,5,$linea,0,"L");	
	
	$pdf->Row(array(strtoupper("Observaciones: ".utf8_decode($rm["vision_observaciones"]))));
	
	$pdf->ln(03);	$pdf->MultiCell(185,0.1,"","T",2,"C");
	
	 $linea=strtoupper("Rayos X de tórax: ".utf8_decode($rm["rayos_x"]))."\n".strtoupper("Rayos X AP y lateral de columna lumbo sacra: ".utf8_decode($rm["rayos_x_ap_lateral_columna"]));
	$pdf->MultiCell(0,5,$linea,0,"L");
	
	 $pdf->Row(array(strtoupper("Rayos X dinámica de columna lumbo sacra: ".utf8_decode($rm["rayos_x_dinamica_columna"]))));
	
	 $pdf->Row(array(strtoupper("Observaciones: ".utf8_decode($rm["rayox_x_observaciones"]))));
	
	 $pdf->ln(03);	$pdf->MultiCell(185,0.1,"","T",2,"C");
	 
	 
	 $pdf->SetWidths(array(80,105));
	$pdf->SetAligns(array('J','J'));
	$pdf->Row(array(strtoupper("Exámenes de laboratorio:\n".utf8_decode($rm["laboratorio"])),strtoupper(utf8_decode("Observaciones: ".$rm["laboratorio_observaciones"]))));
	
	$pdf->ln(03);	$pdf->MultiCell(185,0.1,"","T",2,"C");
	
	
	$linea=strtoupper("Sumario \n");
	$pdf->MultiCell(0,5,$linea,0,"L");
	$pdf->MultiCell(0,5,strtoupper(utf8_decode($rm["sumario_contraindicacion"])),0,"L");
	$pdf->MultiCell(0,5,strtoupper(utf8_decode($rm["sumario_enf_ocupacional"])),0,"L");

	$pdf->ln(03);	$pdf->MultiCell(185,0.1,"","T",2,"C");

	$linea=strtoupper("Observaciones \n");
	$pdf->MultiCell(0,5,$linea,0,"L");
	
	
	$Obj_tbl_resultados_medicos_enfermedades = new tbl_resultados_medicos_enfermedades();
	$Obj_tbl_resultados_medicos_enfermedades->where=" id_resultado_medico=".$rm["id_resultado_medico"];
	$recomendaciones=$Obj_tbl_resultados_medicos_enfermedades->listar(true);
	unset($Obj_tbl_resultados_medicos_enfermedades);
	
	$rm["observaciones_totales"].="\n ------- \n Recomendaciones \n";
	foreach($recomendaciones as $in => $va)
	{
		$rm["observaciones_totales"].=$va["recomendacion"]." \n";
	}
	$pdf->SetFont('Arial','',7);
	$pdf->MultiCell(0,5,strtoupper(utf8_decode($rm["observaciones_totales"])),0,"L");
	
	$pdf->ln(03);	$pdf->MultiCell(185,0.1,"","T",2,"C");
	
	
	$pdf->ln(6);
	$pdf->SetX(120);
	$pdf->MultiCell(0,5,"FIRMA DEL MÉDICO_________________________",0,"L");
	
	
	/*
		$pdf->ln(01);
	$pdf->SetFont('Arial','B',12);
	$pdf->SetWidths(array(140,30));
	$pdf->SetAligns(array('J','J'));
	$pdf->Row(array("DIRECCION: ","PAX"));
	$pdf->SetFont('Arial','',10);
	$pdf->Row(array($datos_pago[0]["direccion_habitacion"],$datos_pago[0]["pax"]));
	
		$pdf->ln(01);
	$pdf->SetFont('Arial','B',12);
	$pdf->SetWidths(array(80,30,30,40));
	$pdf->SetAligns(array('J','J','J','J'));
	$pdf->Row(array("TELEFONO: "," "," ","CELULAR: "));
	$pdf->SetFont('Arial','',10);
	$pdf->Row(array($datos_pago[0]["telefono"],"","",$datos_pago[0]["celular"]));
	
	
	//$pdf->SetFont('Arial','B',12);
	$pdf->SetWidths(array(110,70));
	$pdf->SetAligns(array('J','L'));
	$pdf->Row(array("CIRUGIAS: ".$cirugias_solicitadas,"MONTO CONTRATO: ".$monto_contrato));
	//$pdf->SetFont('Arial','',10);
	//$pdf->Row(array(,"","",$datos_pago[0]["celular"]));
	
	
		$pdf->ln(6);
	
		$pdf->rectangulo=true;
	$pdf->SetFont('Arial','B',11);
	$pdf->SetWidths(array(50,35,50,50,));
	$pdf->SetAligns(array('J','J','J','J'));
	$pdf->Row(array("FORMA DE PAGO","FECHA DE PAGO","BANCO","NUMERO DE CONTROL"));
	$pdf->SetFont('Arial','',10);
	$pdf->Row(array($datos_pago[0]["forma_pago"],$datos_pago[0]["fecha"],$datos_pago[0]["banco"],$datos_pago[0]["numero_control"])); //
	
		$pdf->rectangulo=true;
	$pdf->SetFont('Arial','B',11);
	$pdf->SetWidths(array(30,80,37,38));
	$pdf->SetAligns(array('C','J','C','C'));
	$pdf->Row(array("CANTIDAD","CONCEPTO","PRECIO UNITARIO","TOTAL"));
	$pdf->SetFont('Arial','',10);
	
	$monto_total=0;
	
	foreach($pago_detalle as $valor) {
	
	if (($valor["id_tipo_pago"]==2) || ($valor["id_tipo_pago"]==3) || ($valor["id_tipo_pago"]==7)){
		$numero_cuota="";
		$Obj_tbl_estados_cuenta->where="id_pagos_detalle IN (".$valor["id_pago_detalle"].")";
		$estados_cuenta=$Obj_tbl_estados_cuenta->listar(true);
		foreach($estados_cuenta as $cuota) { $numero_cuota.=$cuota["numero_cuota"].", ";}
		$numero_cuota.="/";
		$numero_cuota=str_replace(", /","",$numero_cuota);
		
		$numero_cuota.=" de ".$cuotas;
	}
	else
	{
	$numero_cuota="";
	}
	
	 
		$precio_u=number_format(($valor["monto"]/$valor["cantidad"]), 2, ',','.');
		$total=number_format($valor["monto"], 2, ',','.');
		$pdf->Row(array($valor["cantidad"],$valor["tipo_pago"]." ".$numero_cuota,$precio_u,$total));
		$monto_total+=$valor["monto"];
	}
	
		$pdf->ln(6);
	
		$pdf->rectangulo=false;
		$pdf->SetX(50);
		$pdf->SetWidths(array(40,20,40));
		$pdf->SetAligns(array('L','C','R'));
			
		$pdf->Row(array("TOTAL","Bsf",number_format($monto_total, 2, ',','.')));	
		
		$pdf->ln(10);
		$pdf->Cell(80,5,"POR INNOVATION BUSINESS","T",0,"C");
		$pdf->SetX(120);
		$pdf->Cell(80,5,$datos_pago[0]["nombres"]." ".$datos_pago[0]["apellidos"],"T",0,"C");
		
		$pdf->ln(7);
		$pdf->Cell(80,0,"RIF J-29795848-7".$_REQUEST["id_pago"],0,0,"C");
		$pdf->SetX(120);
		$pdf->Cell(80,0,"C.I.: ".$datos_pago[0]["cedula_cliente"],0,0,"C");
		
	
		$pdf->ln(7);
		$pdf->Cell(0,0,"La anulacion de los abonos realizados por motivos ajenos a la empresa acarreara al beneficiario una ",0,0,"C");
		$pdf->ln(7);
		$pdf->Cell(0,0,"retencion del 20% por concepto de gastos administrativos.",0,0,"C");
	*/
}	
$pdf->Output();
?>