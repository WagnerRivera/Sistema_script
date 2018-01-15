<?php
include_once("../archivo_3g/class_3g.php");

//$db=$_POST['db'];
$frecuencia = $_POST['Frecuencia'];
$rut 	= $_FILES['archi_rnd']['tmp_name'];
$rut2 	= $_FILES['archi_ip']['tmp_name'];
$nombre = "3g";
$nom 	= "ip";
$arch 	= "../archivo_3g/archivos/";
$b_rnd 	= $arch.$nombre.".xls";

$b_ip 	= $arch.$nom.".xls";

copy($rut, $b_rnd);
copy($rut2, $b_ip);
$archivo_3g= new class_3g($b_rnd, $b_ip);

$eje_archivo=$archivo_3g-> CreateEstructura();


if($eje_archivo){
	header("Location: ../modulos_principales.php?m=archivo_3g/form_archivo_3g&men=1");
}

?>