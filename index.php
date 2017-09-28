<?php
require("controllers/Template.class.php");
$tpl = new Template('view/html/');
$fecha=date("d/m/Y");	
$tpl->set_filenames(array("body"=>"ingresar.html"
				   ));
//esta variabe asigna valores predeterminados				   
$tpl->assign_vars(array(
			'accion' => 'controllers/seguridad/autenticar.php',
			'titulo' => 'Sistema de Apertura'
			));



  switch(@$_GET['e']){
  	case 1:
  		$mensaje = "El Usuario fue creado exitosamente";
  	break;
  	case 2:
  		$mensaje = "Erro en el domino del correo";
  	break;
  	case 3:
  		$mensaje = "El correo o RUT ingresados ya existen";
  	break;
  }

  if(isset($mensaje))
  {
    $tpl->assign_vars(array(
			      'mensaje' => $mensaje,					
			));
  }
//Aqi se imprime el detalle de las plantilla
$tpl->pparse("body");
?>