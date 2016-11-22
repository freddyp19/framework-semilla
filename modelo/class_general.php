<?php
class general
{
/*Variables de uso*/
private $color;
private $contar;
protected $schema="public";

  function mensaje($msn){echo "\n<script> alert('$msn'); </script>\n";}
  
  function location($direccion){echo "<script> window.location = '$direccion'; </script>";}
  
  function color_fondo() {  
	if ($this->color) 
	{ 
	$this->color=false;
	$this->contar+=1;
	return " id=\"file$this->contar\" style=\"background-color:#FFFFFF\" 
	  onmouseover=\"if(document.layers) { document.layers['file$this->contar'].bgColor='#CCFFFF' } else { if(document.all) { document.all['file$this->contar'].style.background='#CCFFFF' } else { if(this.style) { this.style.background='#CCFFFF' } } }\" 
	   onmouseout=\"if(document.layers) { document.layers['file$this->contar'].bgColor='#FFFFFF' } else { if(document.all) { document.all['file$this->contar'].style.background='#FFFFFF' } else { if(this.style) { this.style.background='#FFFFFF' } } }\""; 
	   } 
	else { 
	$this->color=true; $this->contar+=1;
	return " id=\"file$this->contar\" style=\"background-color:#F0F0F0\" 
	  onmouseover=\"if(document.layers) { document.layers['file$this->contar'].bgColor='#CCFFFF' } else { if(document.all) { document.all['file$this->contar'].style.background='#CCFFFF' } else { if(this.style) { this.style.background='#CCFFFF' } } }\" 
	   onmouseout=\"if(document.layers) { document.layers['file$this->contar'].bgColor='#F0F0F0' } else { if(document.all) { document.all['file$this->contar'].style.background='#F0F0F0' } else { if(this.style) { this.style.background='#F0F0F0' } } }\"";
	   }
	 }
	 
	function enviar_formulario($para,$valores,$boton="Cargando...",$auto_envio=true, $nombre="formulario_envio")
	{
	$frm="
	<form id=\"$nombre\" name=\"$nombre\" method=\"post\" action=\"$para\">\n";
		foreach($valores as $index => $valor)
		{
		$frm.="<input name=\"$index\" type=\"hidden\" value=\"$valor\" />\n";					
		}
	if ($auto_envio) {$frm.="<input name=\"\" type=\"submit\" value=\"$boton\"/ class=\"boton\">";}
	
	$frm.="</form>\n";
	if ($auto_envio) {$frm.="<script language=\"Javascript\"> document.{$nombre}.submit(); </script>";}
	echo $frm;
	}
	
	function ver_variable($variable)
	{
	echo "<pre>";
	print_r($variable);
	echo "</pre>";
	}	 

	function convertir_fecha($fecha)
	{	
		$separador=substr($fecha,4,1);
		if ($separador=="-")
		{
			$dia=substr($fecha,8,2);
			$mes=substr($fecha,5,2);
			$anio=substr($fecha,0,4);
			$separador="/";
			$retorno=$dia.$separador.$mes.$separador.$anio;
		}
		else
		{
			$dia=substr($fecha,0,2);
			$mes=substr($fecha,3,2);
			$anio=substr($fecha,6,4);
			$separador="-";
			$retorno=$anio.$separador.$mes.$separador.$dia;
		}
		return $retorno;		
	}
	
	public function crear_archivo($contenido,$fsalida="registros_sistema.log")
	{			
//	echo "$contenido"; 	echo "<br>"; exit;
		if (!$punt = fopen($fsalida,"w"))
		   { echo 'Error el archivo no puede abrirse'; }
		else
		{ 
			rewind($punt);
			if (fwrite($punt, $contenido) === FALSE) {
				echo "No se puede escribir al archivo ($archivo)"; }
			fclose($punt);
		}
	}	 
	
	public function peridodos($periodo)
	{
	 	switch ($periodo)
		{
			case "1": $periodo="Enero"; break;
			case "2": $periodo="Febrero"; break;
			case "3": $periodo="Marzo"; break;
			case "4": $periodo="Abril"; break;
			case "5": $periodo="Mayo"; break;
			case "6": $periodo="Junio"; break;
			case "7": $periodo="Julio"; break;
			case "8": $periodo="Agosto"; break;
			case "9": $periodo="Septiembre"; break;
			case "10": $periodo="Octubre"; break;
			case "11": $periodo="Noviembre"; break;
			case "12": $periodo="Diciembre"; break;
			
			case "1,2,3": $periodo="I Trimestre"; break;
			case "4,5,6": $periodo="II Trimestre"; break;
			case "7,8,9": $periodo="III Trimestre"; break;
			case "10,11,12": $periodo="IV Trimestre"; break;
			
			case "1,2,3,4,5,6": $periodo="I Semestre"; break;
			case "7,8,9,10,11,12": $periodo="II Semestre"; break;
			
			case "1,2,3,4,5,6,7,8,9,10,11,12": $periodo="Anual"; break;
		}
		return $periodo;
	}
	

} // fin de la case General
?>
