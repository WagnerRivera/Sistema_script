<?php
require("../../controllers/Template.class.php");
$tpl = new Template('../../view/html/');
$fecha=date("d/m/Y");	
$tpl->set_filenames(array("body"=>"subir_archivo_3g.html"
				   ));	   

$array[0]["id"] = 1;
$array[0]["valor"] = "RND & Direccionameinto IP";


$tpl->assign_block_vars("tabla", array());
foreach($array as $v)
{
 	$tpl->assign_block_vars("tabla.registro", $v);
}


$tpl->assign_vars(array('titulo' => 'Modulos de Apertura',
				 'accion' => 'archivo_3g/ValArchivo3G.php'
 ));
 switch(@$_GET['e'])
 {
    case "n":
	    $mensaje="No se guardor el registro";
	    break;
    case "e":
	    $mensaje="El RIF ya existe";
	    break;
	case "p":
	    $mensaje="El proceso se ejecuto con exito";
	    break;
    default:
	   $mensaje="";
 }
 
    $tpl->assign_vars(array(
			      'mensaje' => $mensaje					
			));
 
//Aqi se imprime el detalle de las plantilla
$tpl->pparse("body");	
?>