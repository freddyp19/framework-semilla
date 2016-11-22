<?php
session_start();
require_once('../../inc/config.sistema.php');
require_once('../../modelo/html2pdf_v4.03/html2pdf.class.php');

$content = '<style type="text/css">
<!--
table
{
   	border-right: #b0c4de 3px solid; 
	border-top: #b0c4de 3px solid; 
	border-left: #b0c4de 3px solid; 
	color: #8088b7; 
	border-bottom: #b0c4de 3px solid; 
	background-color: #ffffff;
	width: 700px;
}

th
{
    text-align: center;

}

td
{
    text-align: left;
}


-->
</style>
';

ob_start();
include(RUTA_SISTEMA."/vista/layouts/{$defaul_layouts}/encabezado.php");
$content .= ob_get_clean();

$content .= "<h1>".$nombresistema."</h1>";
$content .= " <br><br><br>";

 $content .= $_REQUEST["tabla"];

    try
    {
        $html2pdf = new HTML2PDF('L', 'Letter', 'es', true, 'UTF-8', array(10,10,10,10));
		#$html2pdf = new HTML2PDF('P', 'A4', 'es');
        $html2pdf->pdf->SetDisplayMode('fullpage');
        $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
        $html2pdf->Output('exemple03.pdf');
    }
    catch(HTML2PDF_exception $e) {
        echo $e;
        exit;
    }
?>