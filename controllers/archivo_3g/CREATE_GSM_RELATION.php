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
	public function CREATE_IUB_UGA745()
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
		$parte_uno = $this->Crear_cuerpo_uno();
		$cinsert  .= $parte_uno; 
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
   parent ".'ManagedElement=1,RncFunction=1'."
   identity ".'Iub_UGA745'."
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
   userPlaneIpResourceRef Ref ".'ManagedElement=1,IpSystem=1,IpAccessHostPool=Iub'."
)";
		return $continido_1_1_1;
	}  

    public function __destruct()
    {
        
    }
}
	
?>