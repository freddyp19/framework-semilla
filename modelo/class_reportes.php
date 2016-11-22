<?php session_start();
	
class reportes extends general {

	private $bd;
	public $where;
	private $ObjetSQL;
	public $tabla;
	public $campos=" * ";
	public $propiedades = array();

	public function __construct() {

		$main = main::getInstance();
		$MotorSQL = $main->motor."_sql";
		include_once ("abstraccion/db/{$main->motor}-sql.lang.php");
		$this->ObjetSQL = new $MotorSQL();
		$this->bd = new db();
		/*
		$this->propiedades["id_carrera"]=$id_carrera;
		$this->propiedades["carrera"]=$carrera;
		$this->propiedades["titulo_obtener"]=$titulo_obtener;
		*/
		/*
		$this->where=" id_carrera = ".$this->bd->qstr($this->propiedades["id_carrera"]);
		$this->tabla="tbl_carreras";
		*/
		}

	public function __set($nombre, $valor) {
		$this->propiedades[$nombre] = $valor;
	}

	public function __get($nombre) {
		return $this->propiedades[$nombre];
	}

    public function __call($metodo, $args) {
       	if ($args) {
       		 $method = array(&$this->bd, $metodo);
       		 $a = call_user_func_array($method, $args);
       	} else {
       		$a = $this->bd->$metodo();
       	}
    	return $a;
	}

	public function reporte_resultados_medicos($id_resultado_medico){
	
		$ObjetSQL=&$this->ObjetSQL;
		
		$sql=sprintf($ObjetSQL->SQL_resultado_medico,$id_resultado_medico);
		
		//echo $sql; exit;
		$record=$this->Execute($sql);
		
		if ($record){
			$retorno=$record->GetRows();
			if (!(count($retorno)>0)) {$retorno=false;}
		}
		else{
			$retorno=false;
		}
	return $retorno;
	}

	public function reporte_resultados_medicos_enfermedades($id_resultado_medico){
	
		$ObjetSQL=&$this->ObjetSQL;
		
		$sql=sprintf($ObjetSQL->SQL_resultado_medico_enfermedades,$id_resultado_medico);
		
		//echo $sql; exit;
		$record=$this->Execute($sql);
		
		if ($record){
			$retorno=$record->GetRows();
			if (!(count($retorno)>0)) {$retorno=false;}
		}
		else{
			$retorno=false;
		}
	return $retorno;
	}	

	public function reporte_estadisticas($reporte,$id_centro_trabajo,$periodo,$anio){
	
		$ObjetSQL=&$this->ObjetSQL;
		$reporte="SQL_".$reporte;		
		$sql=sprintf($ObjetSQL->$reporte,$id_centro_trabajo,$periodo,$anio);
		
		//echo $sql; exit;
		$record=$this->Execute($sql);
		
		if ($record){
			$retorno=$record->GetRows();
			if (!(count($retorno)>0)) {$retorno=false;}
		}
		else{
			$retorno=false;
		}
	return $retorno;
	}
	
	/*
	
	public function certificacion_calificaciones($cedula){
	
		$ObjetSQL=&$this->ObjetSQL;
		
		$sql=sprintf($ObjetSQL->SqlCertificacion_calificaciones,$cedula);

		$record=$this->Execute($sql);
		
		if ($record){
			$retorno=$record->GetRows();
			if (!(count($retorno)>0)) {$retorno=false;}
		}
		else{
			$retorno=false;
		}
	return $retorno;
	}
	
	public function reporte_cuotas_pagadas($cedula){
	
		$ObjetSQL=&$this->ObjetSQL;
		
		$sql=sprintf($ObjetSQL->SQL_estados_cuenta,$cedula);

		$record=$this->Execute($sql);
		
		if ($record){
			$retorno=$record->GetRows();
			#if (!(count($retorno)>0)) {$retorno=false;}
		}
		else{
			$retorno=false;
		}
	return $retorno;
	}
	
	public function reporte_cuotas_pagadas_normal($cedula){
	
		$ObjetSQL=&$this->ObjetSQL;
		
		$sql=sprintf($ObjetSQL->SQL_estado_cuenta_normal,$cedula);

		$record=$this->Execute($sql);
		
		if ($record){
			$retorno=$record->GetRows();
			#if (!(count($retorno)>0)) {$retorno=false;}
		}
		else{
			$retorno=false;
		}
	return $retorno;
	}

	public function reporte_estados_cuenta_detalle($id_contrato){
	
		$ObjetSQL=&$this->ObjetSQL;
		
		$sql=sprintf($ObjetSQL->SQL_detalle_estado_cuenta,$id_contrato);

		$record=$this->Execute($sql);
		
		if ($record){
			$retorno=$record->GetRows();
			#if (!(count($retorno)>0)) {$retorno=false;}
		}
		else{
			$retorno=false;
		}
	return $retorno;
	}	
	
	public function reporte_inicial_pagado($cedula_cliente){
	
		$ObjetSQL=&$this->ObjetSQL;
		
		$sql=sprintf($ObjetSQL->SQL_inicila_pago,$cedula_cliente);

		$record=$this->Execute($sql);
		
		if ($record){
			$retorno=$record->GetRows();
			#if (!(count($retorno)>0)) {$retorno=false;}
		}
		else{
			$retorno=false;
		}
	return $retorno;
	}
	
	public function reporte_aportes_bancarios($id_banco,$fecha_inicial,$fecha_fin){
	
		$ObjetSQL=&$this->ObjetSQL;
		
		$sql=sprintf($ObjetSQL->SQL_aportes_bancarios,$id_banco,$fecha_inicial,$fecha_fin);

		$record=$this->Execute($sql);
		
		if ($record){
			$retorno=$record->GetRows();
			#if (!(count($retorno)>0)) {$retorno=false;}
		}
		else{
			$retorno=false;
		}
	return $retorno;
	}
	
	public function reporte_posibles_ingresos($mes,$anio){
	
		$ObjetSQL=&$this->ObjetSQL;
		
		$sql=sprintf($ObjetSQL->SQL_posibles_ingresos,$mes,$anio);

		$record=$this->Execute($sql);
		
		if ($record){
			$retorno=$record->GetRows();
			#if (!(count($retorno)>0)) {$retorno=false;}
		}
		else{
			$retorno=false;
		}
	return $retorno;
	}
	
	public function reporte_ingresos($mes,$anio,$id_tipo_pago){
	
		$ObjetSQL=&$this->ObjetSQL;
		
		$sql=sprintf($ObjetSQL->SQL_ingresos,$mes,$anio,$id_tipo_pago);

		$record=$this->Execute($sql);
		
		if ($record){
			$retorno=$record->GetRows();
			#if (!(count($retorno)>0)) {$retorno=false;}
		}
		else{
			$retorno=false;
		}
	return $retorno;
	}
	
	public function reporte_gastos($mes,$anio,$id_gasto_concepto){
	
		$ObjetSQL=&$this->ObjetSQL;
		
		$sql=sprintf($ObjetSQL->SQL_gastos,$mes,$anio,$id_gasto_concepto);
		
		//echo $sql;
		
		$record=$this->Execute($sql);
		
		if ($record){
			$retorno=$record->GetRows();
			#if (!(count($retorno)>0)) {$retorno=false;}
		}
		else{
			$retorno=false;
		}
	return $retorno;
	}
	*/

} //fin de la clase reportes
?>