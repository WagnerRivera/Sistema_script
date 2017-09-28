<?php
require_once("../Control_Archivo.php");
/////////////////////////////////////////////////////////////////////////
//Clase para la contruccion de la estrctura de los archivos xml, mos y mo
//Fecha de creacion: 29-05-2017
//Creador por: Wagner Rivera
//Fecha de Modificación: 01-06-2017
////////////////////////////////////////////////////////////////////////
class DELETE_UTRANRELATION extends Control_Archivos
{
    private $ruta    = "archivos/ENodoB/ENodoB_";
    private $Archivo = "/04.DELETE_UTRANRELATION_";
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
	public function DELETE_UTRANRELATION_()
	{
		
		$cinsert = '/////////////////////////////////////////////////////////////
//
// SCRIPT     : DELETE UTRANRELATION
// NEMONICO   : '.$this->nombre.'
// RNC        : '.$this->nom_rnc.'
// GENERADOR  : INCOBECH
// HORA       : '.$this->Horas().'
// FECHA      : '.$this->Fechas().'
//
/////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////
//DELETE UTRAN INTERNAL RELATION TOTAL: 1
////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////
//DELETE UTRAN INTERNAL RELATION:  -> 
////////////////////////////////////////////////////////////

DELETE
(
mo "ManagedElement=1,RncFunction=1,UtranCell=,UtranRelation="
exception none
)
';
		
    $estructura = $this->ruta.$this->nombre;
    $archivo 	= $estructura.$this->Archivo.$this->nombre.".mo";
    $this->ElimarArchivo($archivo);
		$this->CrearArchivo($archivo, $cinsert);	
		return true;	
	}

  public function __destruct()
  {
      
  }
}
	
?>