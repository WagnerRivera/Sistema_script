<?php
require_once('../mode/menu.php');
session_start();
$menu = new menu();
$query = "select * from menu;";
$query2 = "select * from submenu order by idsubmenu, idmenu;";
require("../controllers/Template.class.php");
if($_SESSION['autenticacion']){
	$fecha=date("d/m/Y");
	$tpl = new Template('../view/html/');
	$tpl->set_filenames(array("header"=>"encabezado.html",
							 "body"=>"modulos.html"
					   ));
	$tpl->assign_block_vars("menu", array());
	$consulta = $menu->filtro($query);
	
	while ($arreglo = $menu->proximo($consulta)) {
		$consulta2 = $menu->filtro($query2);
		if($_SESSION['permisos'] == 3){
			if($arreglo['idmenu'] == 1){
				$tpl->assign_block_vars("menu.principal", $arreglo);			
				while ($arreglo2 = $menu->proximo($consulta2)) {
					if($arreglo2['idmenu'] == $arreglo['idmenu']){
						$tpl->assign_block_vars("menu.principal.submenu", $arreglo2);
					}
				}
			}
		}

		if($_SESSION['permisos'] == 2){
			if($arreglo['idmenu'] != 4){
				$tpl->assign_block_vars("menu.principal", $arreglo);			
				while ($arreglo2 = $menu->proximo($consulta2)) {
					if($arreglo2['idmenu'] == $arreglo['idmenu']){
						$tpl->assign_block_vars("menu.principal.submenu", $arreglo2);
					}
				}
			}
		}

		if($_SESSION['permisos'] == 1){
			$tpl->assign_block_vars("menu.principal", $arreglo);			
			while ($arreglo2 = $menu->proximo($consulta2)) {
				if($arreglo2['idmenu'] == $arreglo['idmenu']){
					$tpl->assign_block_vars("menu.principal.submenu", $arreglo2);
				}
			}
		}		
		
	}
	$menu->cerrarfiltro($consulta);
	//esta variabe asigna valores predeterminados				   
	$tpl->assign_vars(array( 
						 'seg' 		=> '$MenuSeguridad', 
						 'salir' 	=> 'seguridad/.salir.php'
						));
	if(@$_GET['men'] == '1'){
		$mensaje = "El proceso ha terminado correctamente";
	}
	if(@$_GET['men'] == '3'){
		$mensaje = "El Archivo fue eliminado correctamente";
	}

	$tpl->assign_vars(array(
						"Usu_login"	=> $_SESSION['nombre'],
						"Fecha_S"	=> $fecha,	
						'Nombre_Formulario' => 'Estadisticas',
						'modulo' => @$_GET['m'],
						'mensaje' => @$mensaje
						));
	//Aqi se imprime el detalle de las plantilla
	$tpl->pparse("header");
	$tpl->pparse("body");
}else{
	header("location: ../index.php");
}
?>