<?php 
include_once('../Classes/PHPExcel.php');
require_once("../Control_Archivo.php");
include_once('rbssummaryfile.php');
include_once('sitebasic.php');
include_once('siteequipment.php');
include_once('Create_SectorEquipment.php');
include_once('Create_SctpProfile.php');
include_once('Create_ENodeBFunction.php');
include_once('features.php');
include_once('Create_AntennaGroup.php');

class class_bb5216 extends Control_Archivos{
	public $excel;
	public $rnd;
    public $ip;
    public $fecha;
    public $nombre;
    public $numero;
    public $revision;
    public $serial;
    public $trama;

	public function __construct($rnd, $ip, $fecha, $nombre, $numero, $revision, $serial, $trama)
	{
        $this->excel = PHPExcel_IOFactory::createReader('Excel2007');
        $this->rnd = $rnd;
        $this->ip = $ip;
        $this->fecha = $fecha;
        $this->nombre = $nombre;
        $this->numero = $numero; 
        $this->revision = $revision;
        $this->serial = $serial;
        $this->trama = $trama;
	}

	public function CreateEstructura()
    {  
        $objReader       = $this->excel->setReadDataOnly(true);
        $rnd             = $objReader->load($this->rnd);
        $ip              = $objReader->load($this->ip);
        $nombre_hoja_rnd = $rnd->getSheetNames();
        $nombre_hoja_ip = $ip->getSheetNames();
        $conteo = 0;
        $count  = 0;
        $cotador= 0;
        foreach ($nombre_hoja_rnd as $nom_h_rnd) {        	      
        	$DefinirNombreArchivo1           = $rnd->getSheet($conteo); 
        	$filas_DefinirNombreArchivo_rnd  = $DefinirNombreArchivo1 ->getHighestRow();
        	$Column_DefinirNombreArchivo_rnd = $DefinirNombreArchivo1 ->getHighestColumn();
        	$NumColumn_DefinirNombreArchivo  = PHPExcel_Cell::columnIndexFromString($Column_DefinirNombreArchivo_rnd);
            for($c=0; $c <=$NumColumn_DefinirNombreArchivo; $c++){
                for($f=0; $f <=$filas_DefinirNombreArchivo_rnd; $f++){
                   	$ValorNombre = $DefinirNombreArchivo1->getCellByColumnAndRow($c,$f)->getValue();
                   	$archivo_rnd[$conteo][$c][$f]= $ValorNombre;                   	
                }
            }
	        $conteo++;
        }

        foreach ($nombre_hoja_rnd as $nom_h_rnd) {                
            $DefinirNombreArchivo1           = $rnd->getSheet($cotador); 
            $filas_DefinirNombreArchivo_rnd  = $DefinirNombreArchivo1 ->getHighestRow();
            $Column_DefinirNombreArchivo_rnd = $DefinirNombreArchivo1 ->getHighestColumn();
            $NumColumn_DefinirNombreArchivo  = PHPExcel_Cell::columnIndexFromString($Column_DefinirNombreArchivo_rnd);
            for($c=0; $c <= $NumColumn_DefinirNombreArchivo; $c++){
                for($f=2; $f <= $filas_DefinirNombreArchivo_rnd; $f++){
                    $ValorNombre = $DefinirNombreArchivo1->getCellByColumnAndRow($c,$f)->getValue();
                    $Infcolumna = $DefinirNombreArchivo1->getCellByColumnAndRow($c,1)->getValue();
                    $archivo_rnd2[$nom_h_rnd][$Infcolumna][$f]= $ValorNombre;                    
                }
            }
            $cotador++;
        }

        foreach ($nombre_hoja_ip as $nom_h_ip) {                
            $DefinirNombreArchivo1          = $ip->getSheet($count); 
            $filas_DefinirNombreArchivo_ip  = $DefinirNombreArchivo1 ->getHighestRow();
            $Column_DefinirNombreArchivo_ip = $DefinirNombreArchivo1 ->getHighestColumn();
            $NumColumn_DefinirNombreArchivo = PHPExcel_Cell::columnIndexFromString($Column_DefinirNombreArchivo_ip);
            for($c=0; $c <=$NumColumn_DefinirNombreArchivo; $c++){
                for($f=0; $f <=$filas_DefinirNombreArchivo_ip; $f++){
                    $ValorNombre = $DefinirNombreArchivo1->getCellByColumnAndRow($c,$f)->getValue();
                    $archivo_ip[$count][$c][$f]= $ValorNombre;                     
                }
            }
            $count++;
        }

        $final1 = $this->archivo1($archivo_ip);
        $final2 = $this->archivo2($archivo_ip, $archivo_rnd);
        $final3 = $this->archivo3($archivo_ip, $this->fecha, $this->nombre, $this->numero, $this->serial, $this->revision);
        $final4 = $this->archivo4($archivo_rnd2);
        $final5 = $this->archivo5($archivo_rnd);
        $final6 = $this->archivo6($archivo_rnd);
        $final4 = $this->archivo7($archivo_rnd2);
        //$final6 = $this->archivo8($archivo_rnd2);
        return true;
        	
      
    }

    protected function archivo1($array){
    	$archivo1 = new rbssummaryfile($array);
    }

    protected function archivo2($array1, $array2){
        $archivo1 = new sitebasic($array1, $this->trama);
    }

    protected function archivo3($array1, $p1,$p2,$p3,$p4,$p5){
        $archivo1 = new siteequipment($array1, $p1,$p2,$p3,$p4,$p5);
    }

    protected function archivo4($array1){
        $archivo1 = new Create_ENodeBFunction($array1);
    }

    protected function archivo5($array1){
        $archivo1 = new Create_SctpProfile($array1);
    }

    protected function archivo6($array1){
        $archivo1 = new Create_SectorEquipment($array1);
    }

    protected function archivo7($array1){
        $archivo1 = new features($array1);
    }

    protected function archivo8($array){
        $archivo = new Create_AntennaGroup($array);
    }

}

?>