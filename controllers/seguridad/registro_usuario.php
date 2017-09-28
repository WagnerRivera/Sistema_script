<?php
require("../../controllers/Template.class.php");
$tpl = new Template('../../view/html/');
$fecha=date("d/m/Y");	
$tpl->set_filenames(array("body"=>"registro_usuario.html"
				   ));

$tpl->assign_vars(array('titulo' => 'Registro de Usuario',
			 'accion' => 'seguridad/autenticar.php'
		));
 
//Aqi se imprime el detalle de las plantilla
$tpl->pparse("body");	
?>