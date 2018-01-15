<?php
require_once("../Control_Archivo.php");
/////////////////////////////////////////////////////////////////////////
//Clase para la contruccion de la estrctura de los archivos xml, mos y mo
//Fecha de creacion: 29-05-2017
//Creador por: Wagner Rivera
//Fecha de Modificación: 01-06-2017
////////////////////////////////////////////////////////////////////////
class CREATE_EXTERNAL_GSM_CELL extends Control_Archivos
{
    private $ruta    = "archivos/ENodoB/ENodoB_";
    private $Archivo = "/08.CREATE_EXTERNAL_GSN_CELL_";
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
	public function CREATE_EXTERNAL_GSM_CELL_()
	{
		
		$cinsert = '/////////////////////////////////////////////////////////////
//
// SCRIPT     : CREATE_EXTERNAL_GSN_CELL
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
        $this->ElimarArchivo($archivo);
        $this->CrearArchivo($archivo, $cinsert);	
		return true;	
	}

	public function Crear_cuerpo_uno(){
        $continido_1_1_1 ="
CREATE
(
parent ".'ManagedElement=1,RncFunction=1,ExternalGsmNetwork=1'."
identity ".''."
moType ExternalGsmCell
    exception none
    nrOfAttributes 6
    bcc Integer 
    bcchFrequency Integer 
    cellIdentity Integer 
    lac Integer 
    ncc Integer 
    userLabel String ".' '."
)";
		return $continido_1_1_1;
	}  

    public function __destruct()
    {
        
    }
}
	
?>