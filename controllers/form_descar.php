<?php
require("../controllers/Template.class.php");
$tpl = new Template('../view/html/');
$fecha=date("d/m/Y");	
$tpl->set_filenames(array("body"=>"descar.html"
				   ));	
	$tpl->assign_block_vars("tabla", array());
	$array[0]["id"] = 1;
	$array[0]["valor"] = "RND & Direccionameinto IP";
	$directorio = opendir("archivo/ENodoB/");
	$i = 1 ;
	while ($archivo = readdir($directorio)) //obtenemos un archivo y luego otro sucesivamente
	{
	    if (is_dir($archivo))//verificamos si es o no un directorio
	    {
	        //echo "[".$archivo . "]<br />"; //de ser un directorio lo envolvemos entre corchetes
	    }
	    else
	    {
	    	if($archivo != "." && $archivo != ".."){
	       		$array[$i]['id']= "archivo/ENodoB/".$archivo;
	       		$array[$i]['archivo']= $archivo;
	       	}
	    }
	    $i++;
	}
	$i = 0;
	foreach($array as $v)
	{
		if($v != " " && $i != 0)
	 		$tpl->assign_block_vars("tabla.registro", $v);
	 	$i++;
	}

	$tpl->assign_vars(array('titulo' => 'Modulos de Apertura',
				 'accion' => 'descargar.php'
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