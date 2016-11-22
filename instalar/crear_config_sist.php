<?php
//echo "<pre>";
//print_r($_REQUEST);
//exit;

$config_sistema = "<?php
error_reporting(E_ERROR);
date_default_timezone_set('America/Caracas');
header('Content-type: text/html; charset=utf-8');
\$servidor = \"".$_REQUEST["servidor"]."\";  		//servidor del sistema
//\$servidor = 'http://localhost';  		//servidor del sistema
\$sistema = \"".$_REQUEST["sistema"]."\";			// nombre del directorio raiz del sistema
\$nombresistema = \"".$_REQUEST["nombresistema"]."\";	// nombre del sistema

\$_SESSION[\"controlador_frontal\"]=false;
\$defaul_layouts= \"".$_REQUEST["defaul_layouts"]."\";

define('DS', DIRECTORY_SEPARATOR);
define('RUTA_SISTEMA', str_replace('inc'.DS,'',dirname(__FILE__).DS));
?>";

define('DS', DIRECTORY_SEPARATOR);
//echo "esto es ".DS; exit;

$archivo_ini=str_replace("instalar", "inc".DS, dirname(__FILE__))."config.sistema.php";

if (!$punt = fopen($archivo_ini,"w"))
		   { echo 'Error el archivo no puede abrirse'; }
		else
		{ 
			rewind($punt);
			if (fwrite($punt, $config_sistema) === FALSE) {
				echo "No se puede escribir al archivo ($archivo_ini)"; }
			// else{echo "todo bien";}
			fclose($punt);
		}
/*
$semilla=str_replace("\inc\config.sistema.php","",$archivo_ini);
$nuevo=str_replace("sistema_semilla\inc\config.sistema.php",$_REQUEST["sistema"],$archivo_ini);
mkdir($nuevo, 0755);

function full_copy( $source, $target ) {
    if ( is_dir( $source ) ) {
        @mkdir( $target );
        $d = dir( $source );
        while ( FALSE !== ( $entry = $d->read() ) ) {
            if ( $entry == '.' || $entry == '..' ) {
                continue;
            }
            $Entry = $source . '/' . $entry;
            if ( is_dir( $Entry ) ) {
                full_copy( $Entry, $target . '/' . $entry );
                continue;
            }
            copy( $Entry, $target . '/' . $entry );
        }

        $d->close();
    }else {
        copy( $source, $target );
    }
}

full_copy($semilla,$nuevo);
*/
//cambio de nombre de la carpeta!!
?>
<script language="javascript">window.location="config_bd.php";</script>