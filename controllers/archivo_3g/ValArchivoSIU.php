<?php
include_once("../archivo_3g/class_siu.php");

//$db=$_POST['db'];
$frecuencia = $_POST['Frecuencia'];
$rut 	= $_FILES['archi_siu']['tmp_name'];
$nombre = "siu";
$arch 	= "../archivo_3g/archivos/";
$siu 	= $arch.$nombre.".xls";

$b_ip 	= $arch.$nom.".xls";

copy($rut, $siu);
$archivo_3g= new class_siu($siu);

$eje_archivo=$archivo_3g-> CreateEstructura();


if($eje_archivo){
	header("Location: ../modulos_principales.php?m=archivo_3g/form_descar_siu&men=1");
}

?>