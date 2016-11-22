<?php 
//echo "<pre>";
//print_r($_REQUEST);
//exit;

$config_bd = "<?php
/*
* config.db.inc.php
* contiene las variables de conexion
*/


\$motor = '".$_REQUEST["motor"]."';
\$host = '".$_REQUEST["host"]."';
\$usuario = '".$_REQUEST["usuario"]."';
\$password = '".$_REQUEST["password"]."';
\$database = '".$_REQUEST["database"]."';

?>";

define('DS', DIRECTORY_SEPARATOR);

$archivo_bd=str_replace("instalar", "modelo".DS."abstraccion".DS."config".DS, dirname(__FILE__))."config.db.inc.php";

if (!$punt = fopen($archivo_bd,"w"))
		   { echo 'Error el archivo no puede abrirse'; }
		else
		{ 
			rewind($punt);
			if (fwrite($punt, $config_bd) === FALSE) {
				echo "No se puede escribir al archivo ($archivo_ini)"; }
			// else{echo "todo bien";}
			fclose($punt);
		}
?>
<?php if($_REQUEST["motor"]=="postgres") {?>
<script language="javascript">window.location="extras_para_postgres.php";</script>
<?php } else { ?>
<script language="javascript">window.location="extras_para_mysql.php";</script>
<!--<script language="javascript">window.location="framework_semilla.php";</script> -->
<?php } ?>