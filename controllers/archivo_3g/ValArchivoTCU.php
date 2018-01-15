<?php
include_once("../archivo_3g/class_tcu.php");

$rut 	= $_FILES['archi_tcu']['tmp_name'];
$nombre = "tcu";
$arch 	= "../archivo_3g/archivos/";
$tcu 	= $arch.$nombre.".xls";
$trama  = $_POST['trama'];
copy($rut, $tcu);
$archivo_3g= new class_tcu($tcu, $trama);

$eje_archivo=$archivo_3g-> CreateEstructura();


if($eje_archivo){
	header("Location: ../modulos_principales.php?m=archivo_3g/form_descar_tcu&men=1");
}

?>