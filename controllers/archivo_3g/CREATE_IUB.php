<?php
require_once("../Control_Archivo.php");
/////////////////////////////////////////////////////////////////////////
//Clase para la contruccion de la estrctura de los archivos xml, mos y mo
//Fecha de creacion: 29-05-2017
//Creador por: Wagner Rivera
//Fecha de Modificación: 01-06-2017
////////////////////////////////////////////////////////////////////////
class CREATE_IUB extends Control_Archivos
{
    private $ruta    = "archivos/ENodoB/ENodoB_";
    private $Archivo = "/01.CREATE_IUB_UGA745";
    private $nombre;
    private $nom_rnc;
	
	public function __construct($nombre_archivo, $nombre_rnc)
	{
        $this->nombre  = $nombre_archivo;
        $this->nom_rnc = $nombre_rnc;
	}
	/////////////////////////////////////////////////////////////////////////
	//Metodo para la creacion del archivo siteinstall el primero de la lista
	//Fecha de creacion: 29-05-2017
	//Creador por: Wagner Rivera
	//Fecha de Modificación: 01-06-2017
	////////////////////////////////////////////////////////////////////////	
	public function CREATE_IUB_($p_p_2_1, $p_p_3_1)
	{
		
		$cinsert = '/////////////////////////////////////////////////////////////
//
// SCRIPT     : CREATE IUB
// NEMONICO   : '.$this->nombre.'
// RNC        : '.$this->nom_rnc.'
// GENERADOR  : INCOBECH
// HORA       : '.$this->Horas().'
// FECHA      : '.$this->Fechas().'
//
/////////////////////////////////////////////////////////////
';
		$parte_1 = $this->Crear_cuerpo_uno();
		$parte_2 = $this->Crear_cuerpo_dos($p_p_2_1);
		$parte_3 = $this->Crear_cuerpo_tres($p_p_3_1);
		$parte_4 = $this->Crear_cuerpo_cuatro();

		$cinsert  .= $parte_1.$parte_2.$parte_3.$parte_4; 
        $estructura = $this->ruta.$this->nombre;
        $archivo 	= $estructura.$this->Archivo.$this->nombre.".mo";
        $this->eliminarDir($estructura);
        $this->ElimarArchivo($archivo);
        $this->crear_carpeta($estructura);
		$this->CrearArchivo($archivo, $cinsert);	
		return true;
	}

	public function Crear_cuerpo_uno(){
        $continido_1_1_1 ="
CREATE
(
   parent ".'"ManagedElement=1,RncFunction=1"'."
   identity ".'"Iub_'.$this->nombre.'"'."
   moType IubLink
   exception none
   nrOfAttributes 4
   rbsId Integer 10745
   userPlaneTransportOption Struct
      nrOfElements 2
         atm Integer 0
         ipv4 Integer 1
   controlPlaneTransportOption Struct
     nrOfElements 2
         atm Integer 0
         ipv4 Integer 1
   userPlaneIpResourceRef Ref ".'"ManagedElement=1,IpSystem=1,IpAccessHostPool=Iub"'."
)
";
		return $continido_1_1_1;
	}

	public function Crear_cuerpo_dos($p_2_1){
        $continido_1_2_1 ="
SET
(
   mo ".'"ManagedElement=1,RncFunction=1,IubLink=Iub_'.$this->nombre.'"'."
   exception none
   administrativeState Integer ".$p_2_1."
)
";
		return $continido_1_2_1;
	}

	public function Crear_cuerpo_tres($p_3_1){
        foreach ($p_3_1 as $key => $value) {
        	if($key == 'dlHwAdm'){
	        	foreach ($value as $valor) {
	        		$continido_1_3_1 ="
SET
(
   mo ".'"ManagedElement=1,RncFunction=1,IubLink=Iub_'.$this->nombre.'"'."
   exception none
   dlHwAdm Integer ".$valor."
)
";
        		}
        	}
        	if($key == 'softCongThreshGbrBwDl'){
	        	foreach ($value as $valor) {
	        		$continido_1_3_1 .="
SET
(
   mo ".'"ManagedElement=1,RncFunction=1,IubLink=Iub_'.$this->nombre.'"'."
   exception none
   softCongThreshGbrBwDl Integer ".$valor."
)
";
        		}
        	}
        	if($key == 'softCongThreshGbrBwUl'){
	        	foreach ($value as $valor) {
	        		$continido_1_3_1 .="
SET
(
   mo ".'"ManagedElement=1,RncFunction=1,IubLink=Iub_'.$this->nombre.'"'."
   exception none
   softCongThreshGbrBwUl Integer ".$valor."
)
";
        		}
        	}
        	if($key == 'ulHwAdm'){
	        	foreach ($value as $valor) {
	        		$continido_1_3_1 .="
SET
(
   mo ".'"ManagedElement=1,RncFunction=1,IubLink=Iub_'.$this->nombre.'"'."
   exception none
   ulHwAdm Integer ".$valor."
)
";
        		}
        	}
        }
        
		return $continido_1_3_1;
	}

	public function Crear_cuerpo_cuatro(){
        $continido_1_1_1 ="
SET
(
   mo ".'"ManagedElement=1,RncFunction=1,IubLink=Iub_'.$this->nombre.'"'."
  exception none
   remoteCpIpAddress1 String ".'"10.31.232.146"'."
)

SET
(
   mo ".'"ManagedElement=1,RncFunction=1,IubLink=Iub_'.$this->nombre.'"'."
   exception none
   remoteCpIpAddress2 String ".'"000.000.000.000"'."
)

SET
(
   mo ".'"ManagedElement=1,RncFunction=1,IubLink=Iub_'.$this->nombre.'"'."
   exception none
   l2EstReqRetryTimeNbapC Integer 5
)

SET
(
   mo ".'"ManagedElement=1,RncFunction=1,IubLink=Iub_'.$this->nombre.'"'."
   exception none
   l2EstReqRetryTimeNbapD Integer 5
)

SET
(
   mo ".'"ManagedElement=1,RncFunction=1,IubLink=Iub_'.$this->nombre.'"'."
   exception none
   userLabel String ".'"Iub_'.$this->nombre.'"'."
)

CREATE
(
   parent ".'"ManagedElement=1,RncFunction=1,IubLink=Iub_'.$this->nombre.'"'."
   identity ".'"1"'."
   moType IubEdch
   exception none
   nrOfAttributes 2
    edchDataFrameDelayThreshold Integer 60
    userLabel String ".'"IubEdch_'.$this->nombre.'"'."
)
";
		return $continido_1_1_1;
	}

    public function __destruct()
    {
        
    }
}
	
?>