<?php
header('Content-Type: text/html; charset=ISO-8859-1');
@include_once('../../db.php');
@include_once('../db.php');
class clsdatos
{
	public $conexion;
	public $db;
		
	public function __construct()
	{
	    $host	= HOST;
	    $port	= '3306';
	    $user	= USER;
	    $pass	= PASS;
	    $dbname	= DBNAME;

	    $this->conexion = mysqli_connect($host, $user, $pass);
	    mysqli_select_db($this->conexion,$dbname);
	    if(!$this->conexion)
	      echo "error de la conexion_p";
	    else
		    return $this->conexion;		
	}
		
	public function filtro($sql)
	{
	    $result = mysqli_query($this->conexion, $sql);
	    if($result)
		    return $result;
	    else
		    return false;
	}
	
	public function cerrarfiltro($datos)
	{
	    $result = mysqli_free_result($datos);
	    return $result;
	}
	
	public function proximo($datos)
	{	
	   return mysqli_fetch_array($datos);
	}
	
	public function ejecutar($sql)
	{
	    mysqli_query($this->conexion, $sql)or die('Consulta fallida: ' . mysqli_error());;
	}
	
	public function __destruct()
	{
	    mysqli_close($this->conexion);
	}
	
	function fechabd($pcFecha)
	{
	    $lcNow="now()";
	    
	    if (strlen($pcFecha)==10)
	    {
		  $lcDia=substr($pcFecha,0,2);
		  $lcMes=substr($pcFecha,3,2);
		  $lcAno=substr($pcFecha,6,4);
		  
		  $lcNow=$lcAno."-".$lcMes."-".$lcDia;
	    }
	    return $lcNow;
	}
	
	public function procesos($ventana, $usuario, $informacion)
	{
	    $autinticar=$this->clsdatos->filtro($sql);
	    if(!$autinticar)
	    {
	      $this->errores($usuario, $ventana, $informacion);
	    }
	}
	
	public function errores($usu, $modulos, $errores)
	{
		$a = fopen ("../../modelo/error.txt","a+");
		date_default_timezone_set ("America/Caracas");
		fwrite ($a, date("d-m-Y h:i:s a \t")."Usuario: ".$usu.", Ventana del Error: ".$modulos.": \r\n  Error de sintaccis;  ".$errores."\r\n\r\n");
		fclose($a);
	}

	public function GenerarClaves($clave){
		$pass = md5($clave);
		$pass = sha1($pass);
		return $pass;
	}
}
?>
