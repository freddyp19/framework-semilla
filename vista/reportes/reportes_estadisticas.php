<?php
	require_once("../../inc/config.sistema.php");
	require_once("../../modelo/config.modelo.php"); # configuracion del modelo		
	
	require_once("../../modelo/class_reportes.php"); # clase del modelo
	$Obj_reportes = new reportes;
	
	#require_once("../../modelo/phpExcelReader/Excel/oleread.inc.php"); # clase del modelo
	#require_once("../../modelo/phpExcelReader/Excel/reader.php"); # clase del modelo
	
	require_once("../../modelo/Spreadsheet_Excel_Writer/Spreadsheet/Excel/Writer.php"); # clase del modelo	



	/* Llamamos a la clase que ejecutará la exportación a Excel. Esta clase está guardada en el directorio que tenemos habilitado por defecto en nuestro php.ini para los include y require. Si no hemos modificado el php.ini no debemos cambiar nada acá */
#require_once "Spreadsheet/Excel/Writer.php";

/* Creamos un nuevo objeto de tipo Spreadsheet_Excel_Writer que refleja un nuevo libro de Excel */
$libro = new Spreadsheet_Excel_Writer();

/* Definimos mediante el método send que el archivo debe enviarse al usuario al ejecutar el código y le damos el nombre que tendrá. En este caso ejemplo.xls */
$libro->send("ejemplo.xls");

/* Definimos una variable y se la asignamos a nuestro objeto como una hoja del mismo mediante el método addWorksheet, el cual lleva como parámetro el nombre de la hoja. Tal como si crearamos una en un libro normal de Excel */
$hoja =& $libro->addWorksheet("estadisticas");

/* Escribimos los datos en la hoja mediante el método write, el cual toma como parámetros el número de fila, número de columna y el contenido. Si es texto debe ir entre comillas como una cadena. */
$hoja->write(0, 0, "Nombre");
$hoja->write(0, 1, "Apellido");
$hoja->write(1, 0, "Maria");
$hoja->write(1, 1, "Lopez");
$hoja->write(2, 0, "Eulalio");
$hoja->write(2, 1, "Ramirez");
$hoja->write(3, 0, "Lalo");
$hoja->write(3, 1, "Landas");

/* Mediante el método close cerramos y enviamos el archivo al usuario */
$libro->close();

	//require_once 'Excel/reader.php';
	/*
	$data = new Spreadsheet_Excel_Reader();
	$data->setOutputEncoding('CP1251');
	$data->read('jxlrwtest.xls');
	error_reporting(E_ALL ^ E_NOTICE);
	
	echo $data->sheets[0]['cells'][1][1];
	echo $data->sheets[0]['cells'][3][1];
	//Acá se nota que el orden de coordenadas es [fila][columna].
	foreach($data->sheets as $x => $y){
   echo "$x = $y<br>";
	}*/
	
//http://translate.google.co.ve/translate?sl=en&tl=es&js=n&prev=_t&hl=es&ie=UTF-8&layout=2&eotf=1&u=http%3A%2F%2Fcode.google.com%2Fp%2Fphp-excel-reader%2Fwiki%2FDocumentation
?>
