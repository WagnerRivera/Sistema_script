<?php
include_once("../../mode/usuario.php");
session_start();
$submit = $_POST['accion'];

$usuario = new usuario();
switch($submit){
	case "ingresar":
		$correo = $_POST['correo'];		
		$clave  = $_POST['clave'];
		$clave	= $usuario->GenerarClaves($clave);
		$consulta = $usuario->filtro("select * from usuario where correo='".$correo."' and password='".$clave."';");
		$array = $usuario->proximo($consulta);
		if(isset($array)){
			$_SESSION['autenticacion'] = 1;
			$_SESSION['id']		  = $array["idusuario"];
			$_SESSION['nombre']   = $array["nombre"]." ".$array['apellido'];
			$_SESSION['permisos'] = $array["permisos"];
			$_SESSION['ingreso']  = $array["ingreso"];
			header('location: ../modulos_principales.php');
		}else{
			header("location: ../../index.php");
		}
		$cerrar = $usuario->cerrarfiltro($consulta);		
	break;

	case "registro": // registro por el administrador
		$correo = $_POST['correo'];
		$rut	= $_POST['rut'];
		$nombre	= strtoupper($_POST['nombre']);
		$apellido = strtoupper($_POST['apellido']);
		$permiso  = $_POST['permiso'];
		$ingreso  = $_POST['ingreso'];
		$clave  = "incobech";
		$clave	= $usuario->GenerarClaves($clave);
		$query = "insert into usuario (correo, rut, nombre, apellido, permisos, password, ingreso) values ('".$correo."', '".$rut."', '".$nombre."', '".$apellido."', ".$permiso.", '".$clave."', ".$ingreso.");";
		$consulta = $usuario->filtro($query);
		if($consulta)
			header("location: ../modulos_principales.php?m=seguridad/registro_usuario&men=1");
			
	break;

	case "nuevo": //  registro por el mismo usuario
		$correo = $_POST['correo'];
		for ($i=0; $i < strlen($correo); $i++) { 
			if($correo[$i] === "@"){
				for ($j=$i; $j < strlen($correo); $j++) { 
					$dominio = @$dominio.$correo[$j];
				}				
			}
		}

		if($dominio == "@incobech.cl"){
			$rut	= $_POST['rut'];
			$nombre	= strtoupper($_POST['nombre']);
			$apellido = strtoupper($_POST['apellido']);
			$clave  = $_POST['clave'];
			$clave	= $usuario->GenerarClaves($clave);
			$query = "insert into usuario (correo, rut, nombre, apellido, permisos, password) values ('".$correo."', '".$rut."', '".$nombre."', '".$apellido."', 4, '".$clave."');";
			$consulta = $usuario->filtro($query);
			if($consulta)
				header("location: ../../index.php?e=1");
			else
				header("location: ../../index.php?e=3");
		}else{
			header("location: ../../index.php?e=2");
		}		
	break;

	case "cambio": //  cambio de clve por el usuario
		$correo = $_POST['correo'];
		$id 	= $_POST['id_usuario'];
		$clave	= $usuario->GenerarClaves($_POST['clave']);
		$query = "update usuario set password='".$clave."' where idusuario=".$id." and correo='".$correo."';";
		$consulta = $usuario->filtro($query);
		if($consulta)
			header("location: ../../index.php");
			
	break;
}

?>