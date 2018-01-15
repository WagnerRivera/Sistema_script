<?php
require("../../controllers/Template.class.php");
include_once("../../mode/usuario.php");
$tpl = new Template('../../view/html/');
session_start();
$usuario = new usuario();
$consulta = $usuario->filtro("select * from usuario where idusuario=".$_SESSION['id'].";");
	$array = $usuario->proximo($consulta);
	$correo = $array['correo'];
	switch($array['permisos']){
		case 1:
			$permiso = "Administrador";
		break;
		case 2:
			$permiso = "Supervisor";
		break;
		case 3:
			$permiso = "Tecnico";
		break;
	}
$fecha=date("d/m/Y");	
$tpl->set_filenames(array("body"=>"cambioclave.html"
				   ));

$tpl->assign_vars(array('titulo' => 'Registro de Usuario',
			'id_usuario' => $_SESSION['id'],
			'correo' => $correo,
			'nombre' => $_SESSION['nombre'],
			'tipo'=> $permiso,
			'accion' => 'seguridad/autenticar.php'
		));
 
//Aqi se imprime el detalle de las plantilla
$tpl->pparse("body");	
?>