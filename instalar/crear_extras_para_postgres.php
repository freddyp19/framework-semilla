<?php
session_start();

	require_once("../inc/config.sistema.php"); # configuracion del sistema
	require_once("../modelo/config.modelo.php"); # configuracion del modelo
	require_once("../modelo/class_reportes.php"); # clase del modelo
	
	$Obj_sql = new reportes();
if($_REQUEST["instalar_extension_usuarios"]=="si")
{
	$queries = explode(';', file_get_contents("../documentacion/schemas/postgres/schema_usuarios.sql"));
	
  foreach($queries as $query)
  {
  
  	if($query==""){ continue; }
  
    if( ($query != '') && ($query != '\n'))
    {
	 	try {	
			$record = $Obj_sql->Execute($query);
			//$record = 1;
			if ($record){
				 echo $query." se ejecuto corectamente <br>";
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

if($_REQUEST["instalar_extension_auditoria"]=="si")
{

$queries = explode(';', file_get_contents("../documentacion/schemas/postgres/schema_auditoria.sql"));
	
//echo "<pre>"; print_r($queries); exit;
	
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


#	echo "estoy por aqui";
	
$queries = explode('/*#FIN#*/', file_get_contents("../documentacion/schemas/postgres/schema_auditoria_trigger.sql"));

# echo "<pre>"; print_r($queries); exit;
	
  foreach($queries as $query)
  {
    if($query != '') 
    {
	 	try {	
		//echo $query."<br>";
		$record = $Obj_sql->Execute($query);

			if ($record){
				//echo $query." se ejecuto corectamente <br>";
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

?>

<script language="javascript">window.location="vincular_schema_usuarios.php";</script>