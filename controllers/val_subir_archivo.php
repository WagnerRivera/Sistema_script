<?php
include_once("../controllers/class_subir_archivo.php");

//$db=$_POST['db'];
$frecuencia = $_POST['Frecuencia'];
$rut 	= $_FILES['archi_rnd']['tmp_name'];
$rut2 	= $_FILES['archi_ip']['tmp_name'];
$nombre = "4g";
$nom 	= "ip";
$arch 	= "../controllers/archivo/";
$b_rnd 	= $arch.$nombre.".xls";

$b_ip 	= $arch.$nom.".xls";

copy($rut, $b_rnd);
copy($rut2, $b_ip);
$spg= new apt_spg($b_rnd, $b_ip, $frecuencia);

$eje_archivo=$spg-> cargar_archivo();
//$eje_cmp=$spg-> insert_cmp_spg($eje_archivo);

if($eje_archivo){
	header("Location: modulos_principales.php?m=form_subir_archivo&men=1");
}


?>