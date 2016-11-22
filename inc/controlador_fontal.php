<?php
/*
echo $self=$_SERVER['PHP_SELF']."<br>";
$separados=explode("/", $self);

$separados=$separados[(count($separados)-1)];
$separados=str_replace(".php","", $separados);
if (substr_count($separados, "_insertar"))
{
echo "es una insercion: ";
}

echo $separados;

exit;
*/
include("config.sistema.php");
  session_start();
  if (($_SESSION["session_usuario"]["usuario"]=="") && ($_SESSION["controlador_frontal"]))
  {
  session_destroy();
  echo "<script> alert('Usted no ha iniciado sesion o su sesion se termino') </script>";
  echo "<script> window.location='{$servidor}/{$sistema}/index.html'; </script>";
  #exit;
  }
?>