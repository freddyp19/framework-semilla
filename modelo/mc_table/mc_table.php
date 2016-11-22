<?php

class PDF_MC_Table extends FPDF
{
var $widths;
var $aligns;
var $rectangulo=false;
var $InHeaderFP19=true;

function SetWidths($w)
{
	//Set the array of column widths
	$this->widths=$w;
}

function SetAligns($a)
{
	//Set the array of column alignments
	$this->aligns=$a;
}

function Row($data)
{
	//Calculate the height of the row
	$nb=0;
	for($i=0;$i<count($data);$i++)
		$nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
	$h=5*$nb;
	//Issue a page break first if needed
	$this->CheckPageBreak($h);
	//Draw the cells of the row
	for($i=0;$i<count($data);$i++)
	{
		$w=$this->widths[$i];
		$a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
		//Save the current position
		$x=$this->GetX();
		$y=$this->GetY();
		//Draw the border
		if ($this->rectangulo)
		$this->Rect($x,$y,$w,$h);
		//Print the text
		$this->MultiCell($w,5,$data[$i],0,$a);
		//Put the position to the right of the cell
		$this->SetXY($x+$w,$y);
	}
	//Go to the next line
	$this->Ln($h);
}

function CheckPageBreak($h)
{
	//If the height h would cause an overflow, add a new page immediately
	if($this->GetY()+$h>$this->PageBreakTrigger)
		$this->AddPage($this->CurOrientation);
}

function NbLines($w,$txt)
{
	//Computes the number of lines a MultiCell of width w will take
	$cw=&$this->CurrentFont['cw'];
	if($w==0)
		$w=$this->w-$this->rMargin-$this->x;
	$wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
	$s=str_replace("\r",'',$txt);
	$nb=strlen($s);
	if($nb>0 and $s[$nb-1]=="\n")
		$nb--;
	$sep=-1;
	$i=0;
	$j=0;
	$l=0;
	$nl=1;
	while($i<$nb)
	{
		$c=$s[$i];
		if($c=="\n")
		{
			$i++;
			$sep=-1;
			$j=$i;
			$l=0;
			$nl++;
			continue;
		}
		if($c==' ')
			$sep=$i;
		$l+=$cw[$c];
		if($l>$wmax)
		{
			if($sep==-1)
			{
				if($i==$j)
					$i++;
			}
			else
				$i=$sep+1;
			$sep=-1;
			$j=$i;
			$l=0;
			$nl++;
		}
		else
			$i++;
	}
	return $nl;
}
/*fp19*/
function Header()
{

	//$this->SetMargins("5","10");
	if ($this->InHeaderFP19)
	{
		//Logo
			switch ($_SESSION["session_usuario"]["id_estado"]) 
			{
				case "1":
					$encabezado="encabezado_caracas.png";
				break; 
				
				case "2":
					$encabezado="encabezado_valencia.png";
				break;
				
				default:
					$encabezado="logo_mlv.jpg";
				break;
			}

		$this->Image("../../imagenes/$encabezado",10,8,200,29);
		/*
		$this->SetFont('Arial','',8);
		//$this->MultiCell(0,5,"Fecha de Emisión: ".date("d-m-Y"),0,"R");
		//Arial bold 15
		$this->SetFont('Arial','B',15);
		//Move to the right
		//$this->Cell(80);
		$this->Ln(15);
		//Title
		$this->MultiCell(0,5,$this->title,0,"C");
		//$this->Cell(0,5,,0,0,'C');
		//Line break
		$this->Ln(15);
		*/
	}
}


function Footer()
{
	$this->AliasNbPages();
   //Posición: a 1,5 cm del final
    $this->SetY(-10);
    //Arial italic 8
    $this->SetFont('Arial','',8);
    //Número de página
    // $this->Cell(0,10,'Pagina '.$this->PageNo().' de {nb}',0,0,'C');
}
/*fp19*/
}
?>
