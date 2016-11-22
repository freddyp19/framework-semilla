<?
require("iam_xls.php");

$query = "SELECT nombre as Centro, gen_alumno.* from gen_alumno, gen_centro
          WHERE (gen_alumno.id_centro=gen_centro.id_centro) ORDER BY nombre, apellidos, nombres";
$mid_excel = new IAM_XLS('listado-alumnos');
               
$mid_excel->dump($query, 'gen_check', 'root', 'google', 'localhost');
?>