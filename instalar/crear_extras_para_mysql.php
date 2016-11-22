<?php
session_start();

	require_once("../inc/config.sistema.php"); # configuracion del sistema
	require_once("../modelo/config.modelo.php"); # configuracion del modelo
	require_once("../modelo/class_reportes.php"); # clase del modelo
	
	$Obj_sql = new reportes();
if($_REQUEST["instalar_extension_usuarios"]=="si")
{
	$queries = explode(';', file_get_contents("../documentacion/schemas/mysql/schema_usuarios_mysql.sql"));
	
  foreach($queries as $query)
  {
    if($query != '')
    {
	 	try {	
			$record = $Obj_sql->Execute($query);

			if ($record){
				// echo $query." se ejecuto corectamente <br>";
			}
			else{
				echo "Tremendo Pelon";
			}
		} catch (exception $e) {
			$retorno=$this->ErrorMsg();
		}
    }
	  
  }
  
}

#echo "<pre>"; print_r($_REQUEST);
?>

<script language="javascript">window.location="vincular_schema_usuarios.php";</script>