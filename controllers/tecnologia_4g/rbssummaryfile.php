<?php
require_once("../Control_Archivo.php");
/////////////////////////////////////////////////////////////////////////
//Clase para la contruccion de la estrctura de los archivos xml, mos y mo
//Fecha de creacion: 29-05-2017
//Creador por: Wagner Rivera
//Fecha de Modificación: 01-06-2017
////////////////////////////////////////////////////////////////////////
class rbssummaryfile extends Control_Archivos
{
    private $ruta    = "archivos/ENodoB/ENodoB_";
    private $name1 = "/00_";
    private $name2 = "_RbsSummaryFile";
	
	public function __construct($parametros)
	{
        $this->nombre  = $parametros[1][0][2];
        $this->CREATE_AREA_();
	}
	/////////////////////////////////////////////////////////////////////////
	//Metodo para la creacion del archivo siteinstall el primero de la lista
	//Fecha de creacion: 29-05-2017
	//Creador por: Wagner Rivera
	//Fecha de Modificación: 01-06-2017
	////////////////////////////////////////////////////////////////////////	
	public function CREATE_AREA_()
	{
		
		$cinsert ='<summary:AutoIntegrationRbsSummaryFile
    xmlns:summary="http://www.ericsson.se/RbsSummaryFileSchema"
    xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
    xsi:schemaLocation="http://www.ericsson.se/RbsSummaryFileSchemaSummaryFile.xsd">
<Format revision="F"/>
<ConfigurationFiles
    siteBasicFilePath="01_'.$this->nombre.'_SiteBasic.xml"
    siteEquipmentFilePath="02_'.$this->nombre.'_SiteEquipment.xml"
		upgradePackageFilePath="Baseband_SW_Upgrade_Package_16B_R12EB.zip"/>
</summary:AutoIntegrationRbsSummaryFile>';
		
        $estructura = $this->ruta.$this->nombre;
        $archivo    = $estructura.$this->name1.$this->nombre.$this->name2.".xml";
        $this->ElimarArchivo($archivo);
        $this->crear_carpeta($estructura);
		$this->CrearArchivo($archivo, $cinsert);	
		return true;	
	}

    public function __destruct()
    {
        
    }
}
	
?>