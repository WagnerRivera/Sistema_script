<?php 
include_once('../Classes/PHPExcel.php');
require_once("../Control_Archivo.php");
include_once("Script_TCU_On_Site_Incobech.php");
include_once("Script_TCU_SWITCH_Incobech.php");

class class_tcu extends Control_Archivos{
	public $excel;
	public $tcu;
	public $valor;
    public $trama;

	public function __construct($tcu, $trama)
	{
        $this->excel = PHPExcel_IOFactory::createReader('Excel2007');
        $this->tcu = $tcu;
        $this->trama = $trama;      
	}

	public function CreateEstructura()
    {  
        $objReader       = $this->excel->setReadDataOnly(true);
        $tcu             = $objReader->load($this->tcu);
        $nombre_hoja_tcu = $tcu->getSheetNames();
        $conteo = 0;
        $conteo1 = 0;
        foreach ($nombre_hoja_tcu as $nom_h_tcu) {            
        	$DefinirNombreArchivo            = $tcu->getSheet($conteo); 
        	$filas_DefinirNombreArchivo_tcu  = $DefinirNombreArchivo ->getHighestRow();
        	$Column_DefinirNombreArchivo_tcu = $DefinirNombreArchivo ->getHighestColumn();
        	$NumColumn_DefinirNombreArchivo  = PHPExcel_Cell::columnIndexFromString($Column_DefinirNombreArchivo_tcu);
            for($c=0; $c <=$NumColumn_DefinirNombreArchivo; $c++){
                for($f=0; $f <=$filas_DefinirNombreArchivo_tcu; $f++){
                   	$ValorNombre = $DefinirNombreArchivo->getCellByColumnAndRow($c,$f)->getValue();
           			$estructura[$nom_h_tcu][$c][$f] = $ValorNombre;
                }
            }
	        $conteo++;
        }

        foreach ($nombre_hoja_tcu as $nom_h_tcu) {
        	//if($nom_h_tcu == "Generales"){         
        	$DefinirNombreArchivo1            = $tcu->getSheet($conteo1); 
        	$filas_DefinirNombreArchivo_tcu  = $DefinirNombreArchivo1 ->getHighestRow();
        	$Column_DefinirNombreArchivo_tcu = $DefinirNombreArchivo1 ->getHighestColumn();
        	$NumColumn_DefinirNombreArchivo  = PHPExcel_Cell::columnIndexFromString($Column_DefinirNombreArchivo_tcu);
            for($c=0; $c <=$NumColumn_DefinirNombreArchivo; $c++){
                for($f=0; $f <=$filas_DefinirNombreArchivo_tcu; $f++){
                   	$ValorNombre = $DefinirNombreArchivo1->getCellByColumnAndRow($c,$f)->getValue();
                   	//if($ValorNombre != ""){
           				$switch[$conteo1][$c][$f]= $ValorNombre;
                   	//}
                }
            }
	        $conteo1++;
	        //}
        }
        $final1 = $this->archivo1($switch, $estructura, $this->trama);
        $final2 = $this->archivo2($switch, $this->trama);
        return true;
        	
      
    }

    protected function archivo1($array, $switch){
    	$archivo1 = new Script_TCU_On_Site_Incobech($array, $switch);
    }

    protected function archivo2($array, $trama){
    	$archivo2 = new Script_TCU_SWITCH_Incobech($array, $trama);
    }
}

?>