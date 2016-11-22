<?php
if ($_REQUEST["vincular"]){
include("../inc/config.sistema.php");
include("../modelo/config.modelo.php");

require_once("../modelo/class_reportes.php"); # clase del modelo

$main = main::getInstance();
	
$Obj_sql = new reportes();

if($main->motor=="postgres"){

	$tabla=explode(".", $_REQUEST["tablas"]); $tabla=$tabla[1];
	
	$queries[0] = " 
	SELECT a.attname AS nombrecampo
	FROM pg_class c, pg_attribute a
	WHERE a.attrelid = c.oid and a.attnum > 0
	AND c.relname='".$tabla."' and a.attname='usuario'";
	
	$record = $Obj_sql->Execute($queries[0]);
	
	if (count($record->GetRows())>0){
		#existe el campo en la tabla
		/*
		$queries[1] = " ALTER TABLE ONLY ".$_REQUEST["tablas"]." DROP COLUMN usuario;";
			$record = $Obj_sql->Execute($queries[1]);
		$queries[2] = " ALTER TABLE ONLY ".$_REQUEST["tablas"]." ADD COLUMN usuario character varying(30) NOT NULL;";
			$record = $Obj_sql->Execute($queries[2]);
		*/
			echo "Existe en la tabla";
	} else{
		#no existe el campo en la tabla
		$queries[2] = " ALTER TABLE ONLY ".$_REQUEST["tablas"]." ADD COLUMN usuario character varying(30) NOT NULL;";
			$record = $Obj_sql->Execute($queries[2]);
		echo "se ejecuto";
	}
	
	$queries[0] = " 
	select *
	from information_schema.table_constraints 
	where table_name = '".$tabla."' and constraint_name ='".$tabla."_usuario_fkey'";
	
	$record = $Obj_sql->Execute($queries[0]);
	
	if (count($record->GetRows())>0){
	/*
		$queries[3] = " ALTER TABLE ONLY ".$_REQUEST["tablas"]." DROP CONSTRAINT ".$tabla."_usuario_fkey;";
			$record = $Obj_sql->Execute($queries[3]);
		$queries[3] = " ALTER TABLE ONLY ".$_REQUEST["tablas"]." ADD CONSTRAINT ".$tabla."_usuario_fkey FOREIGN KEY (usuario) REFERENCES schema_usuarios.tbl_usuarios(usuario) ON UPDATE CASCADE ON DELETE RESTRICT;";
			$record = $Obj_sql->Execute($queries[3]);
	*/		
		echo "Existe en la tabla";
	} else{
		#no existe el index en la tabla
			$queries[3] = " ALTER TABLE ONLY ".$_REQUEST["tablas"]." ADD CONSTRAINT ".$tabla."_usuario_fkey FOREIGN KEY (usuario) REFERENCES schema_usuarios.tbl_usuarios(usuario) ON UPDATE CASCADE ON DELETE RESTRICT;";
			$record = $Obj_sql->Execute($queries[3]);
			echo "se ejecuto";
	}

}
else
{
$queries[0] = "ALTER TABLE ".$_REQUEST["tablas"]." ADD COLUMN usuario VARCHAR(50) NOT NULL";

$queries[1] = "ALTER TABLE ".$_REQUEST["tablas"]." ADD CONSTRAINT ";
$queries[1] .=$_REQUEST["tablas"]."_usuario_fkey FOREIGN KEY (usuario) REFERENCES tbl_usuarios(usuario) ON UPDATE CASCADE ON DELETE RESTRICT;";


  foreach($queries as $query)
  {
    if($query != '')
    {
	 	try {
		
		//echo $query." se ejecuto corectamente <br>";
		$record = $Obj_sql->Execute($query);

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
//echo "<pre>"; print_r($queries); exit;
	
}//fin del primer if
?>