<?php 
include_once('../Classes/PHPExcel.php');
require_once("../Control_Archivo.php");
include_once("Script_SIU_On_Site_Incobech.php");
include_once("Script_SIU_SWITCH_Incobech.php");

class class_siu extends Control_Archivos{
	public $excel;
	public $siu;

	public function __construct($siu)
	{
        $this->excel = PHPExcel_IOFactory::createReader('Excel2007');
        $this->siu = $siu;       
	}

	public function CreateEstructura()
    {  
        $objReader       = $this->excel->setReadDataOnly(true);
        $siu             = $objReader->load($this->siu);
        $nombre_hoja_siu = $siu->getSheetNames();
        $conteo = 0;
        foreach ($nombre_hoja_siu as $nom_h_siu) {
        	$DefinirNombreArchivo            = $siu->getSheet($conteo); 
        	$filas_DefinirNombreArchivo_siu  = $DefinirNombreArchivo ->getHighestRow();
        	$Column_DefinirNombreArchivo_siu = $DefinirNombreArchivo ->getHighestColumn();
        	$NumColumn_DefinirNombreArchivo  = PHPExcel_Cell::columnIndexFromString($Column_DefinirNombreArchivo_siu);
            for($c=0; $c <=$NumColumn_DefinirNombreArchivo; $c++){ 
                for($f=0; $f <=$filas_DefinirNombreArchivo_siu; $f++){
                   	$ValorNombre = $DefinirNombreArchivo->getCellByColumnAndRow($c,$f)->getValue();
                   	$excelFin[$conteo][$c][$f] = $ValorNombre;
				}
	        }
	        $conteo++;
        }
        $archivo1 = $this->archivo1($excelFin);
        $archivo2 = $this->archivo2($excelFin);
		return true;
    }

    protected function archivo1($array){
    	$archivo1 = new Script_SIU_On_Site_Incobech($array);
    }

    protected function archivo2($array){
    	$archivo2 = new Script_SIU_SWITCH_Incobech($array);
    }
}

?>