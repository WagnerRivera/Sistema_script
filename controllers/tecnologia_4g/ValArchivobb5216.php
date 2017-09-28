<?php
include_once("../tecnologia_4g/class_bb5216.php");

$pfecha 	= str_replace("-", "", $_POST['date']);
$pname  	= $_POST['name'];
$pnumber 	= $_POST['number'];
$pserial  	= $_POST['serial'];
$prevision 	= $_POST['revision'];
$trama		= $_POST['trama'];
$rut 	= $_FILES['archi_rnd']['tmp_name'];
$rut2 	= $_FILES['archi_ip']['tmp_name'];
$nombre = "rnd";
$nom 	= "ip";
$arch 	= "../tecnologia_4g/archivos/";
$b_rnd 	= $arch.$nombre.".xls";

$b_ip 	= $arch.$nom.".xls";

copy($rut, $b_rnd);
copy($rut2, $b_ip);
$spg= new class_bb5216($b_rnd, $b_ip, $pfecha, $pname, $pnumber, $prevision, $pserial, $trama);

$eje_archivo=$spg-> CreateEstructura();

if($eje_archivo){
	header("Location: ../modulos_principales.php?m=tecnologia_4g/form_subir_archivo_bb5216&men=1");
}


?>