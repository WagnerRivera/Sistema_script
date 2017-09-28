<?php
include_once('Control_Archivo.php');
$directorio = opendir($_POST['descarga']);
if(@$_POST['descargar']){
    while ($archivo = readdir($directorio)) //obtenemos un archivo y luego otro sucesivamente
    {
        if (is_dir($archivo))//verificamos si es o no un directorio
        {
            //echo "[".$archivo . "]<br />"; //de ser un directorio lo envolvemos entre corchetes
        }
        else
        {
        	$array[]= $archivo;    	
        }
    }
    $zip = new ZipArchive;
    if($_POST['nombre'] != "siu" && $_POST['nombre'] != "tcu"){
       $nombre_carpeta = substr($_POST['descarga'], -13);
    }else{
       $nombre_carpeta = substr($_POST['descarga'], -9);
    }
    //sdie();
    $zipname = $nombre_carpeta.'.zip';
    $zip->open($zipname, ZipArchive::CREATE);
    foreach ($array as $file) {
    	$url = $_POST['descarga'].'/';	
        //echo $url.$file."<br>";	
    	$zip->addFile($url.$file, $file);
    }
    //die();
    $zip->close();
    if(file_exists($zipname)){ 
    	header('Content-Type: application/octet-stream');
    	header('Content-disposition: attachment; filename='.$zipname);
    	header('Content-Length: ' . filesize($zipname));
    	readfile($zipname);
    	unlink($zipname);
    }
}

if(@$_POST['eliminar']){
    $eliminar = Control_Archivos::eliminarDirFinal($_POST['descarga']);
    if($eliminar && $_POST['nombre'] == "3g"){
        header("Location: modulos_principales.php?m=../controllers/archivo_3g/form_descar_3g&men=3");
    }

    if($eliminar && $_POST['nombre'] == "4g"){
        header("Location: modulos_principales.php?m=../controllers/form_descar&men=3");
    }

    if($eliminar && $_POST['nombre'] == "bb5216"){
        header("Location: modulos_principales.php?m=../controllers/tecnologia_4g/form_descar_bb5216&men=3");
    }

    if($eliminar && $_POST['nombre'] == "siu"){
        header("Location: modulos_principales.php?m=../controllers/archivo_3g/form_archivo_3g_siu&men=3");
    }

    if($eliminar && $_POST['nombre'] == "tcu"){
        header("Location: modulos_principales.php?m=../controllers/archivo_3g/form_descar_tcu&men=3");
    }
}

?>