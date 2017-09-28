<?php

include_once('../Classes/PHPExcel.php');
include_once('CREATE_IUB.php');
include_once('CREATE_AREA.php');
include_once('CREATE_UTRANCELL.php');
include_once('DELETE_UTRANRELATION.php');
include_once('CREATE_COVERAGE_RELATION.php');
include_once('CREATE_UTRANRELATION.php');
include_once('CREATE_EUTRANFREQRELATION.php');
include_once('CREATE_EXTERNAL_GSM_CELL.php');
include_once('CREATE_UTRANCELL_IN_BSC_MSC.php');
include_once('CREATE_UTRANCELL_IN_CNAI.php');
include_once('OAM_SCRIPT.php');
include_once('SITE_EQUIPMENT_SCRIPT.php');
include_once('SITE_COMPLETE_SCRIPT.php');
include_once('PARAMETROS_SCRIPT.php');
/////////////////////////////////////////////////////////////////////////
//Clase para la contruccion de la estrctura de los archivos xml, mos y mo entre otros para los archivos tipo 3g
//Fecha de creacion: 21-06-2017
//Creador por: Wagner Rivera
//Fecha de Modificación: 21-06-2017
////////////////////////////////////////////////////////////////////////
class class_3g
{
    public $excel;
	public $b_rnd;
    public $b_ip;

	public function __construct($rnd, $ip)
	{
        $this->excel = PHPExcel_IOFactory::createReader('Excel2007');
        $this->b_rnd = $rnd;
        $this->b_ip  = $ip;        
	}
    /////////////////////////////////////////////////////////////////////////
    //Metodo para la creacion del archivo siteinstall el primero de la lista
    //Fecha de creacion: 21-06-2017
    //Creador por: Wagner Rivera
    //Fecha de Modificación: 21-06-2017
    ////////////////////////////////////////////////////////////////////////    
    public function CreateEstructura()
    {  
        $objReader       = $this->excel->setReadDataOnly(true);
        $RND             = $objReader->load($this->b_rnd);
        $direciones_ip   = $objReader->load($this->b_ip);
        $nombre_hoja_rnd = $RND->getSheetNames();
        $nombre_hoja_ip  = $direciones_ip->getSheetNames();
        $conteo = 0;
        $conteo_ip = 0;
        foreach ($nombre_hoja_rnd as $nom_h_rnd) {
            $DefinirNombreArchivo            = $RND->getSheet($conteo); 
            $filas_DefinirNombreArchivo_rnd  = $DefinirNombreArchivo ->getHighestRow();
            $Column_DefinirNombreArchivo_rnd = $DefinirNombreArchivo ->getHighestColumn();
            $NumColumn_DefinirNombreArchivo  = PHPExcel_Cell::columnIndexFromString($Column_DefinirNombreArchivo_rnd);
            for($f=0; $f <=$filas_DefinirNombreArchivo_rnd; $f++){
                for($c=0; $c <=$NumColumn_DefinirNombreArchivo; $c++){ 
                   $ValorNombre = $DefinirNombreArchivo->getCellByColumnAndRow($c,$f)->getValue();
                   if($ValorNombre === "RNC"){ 
                        $ValorNombre = $DefinirNombreArchivo->getCellByColumnAndRow($c,2)->getValue();
                        if(!empty($ValorNombre)){
                            if(isset($ValorNombre)){
                               $ValorNombre_final_rnc = $ValorNombre;
                            }   
                        }
                   }

                   if($ValorNombre === "Site"){ 
                        $ValorNombre = $DefinirNombreArchivo->getCellByColumnAndRow($c,2)->getValue();
                        if(!empty($ValorNombre)){
                            if(isset($ValorNombre)){
                                $ValorNombre_final = $ValorNombre;
                            }   
                        }
                   }
                }
            }

            if($nom_h_rnd == "EUL"){
                $DefinirNombreArchivo            = $RND->getSheet($conteo); 
                $filas_DefinirNombreArchivo_rnd  = $DefinirNombreArchivo ->getHighestRow();
                $Column_DefinirNombreArchivo_rnd = $DefinirNombreArchivo ->getHighestColumn();
                $NumColumn_DefinirNombreArchivo  = PHPExcel_Cell::columnIndexFromString($Column_DefinirNombreArchivo_rnd);
                for($c=0; $c <=$NumColumn_DefinirNombreArchivo; $c++){
                    for($f=2; $f <=$filas_DefinirNombreArchivo_rnd; $f++){
                        $ValorNombre = $DefinirNombreArchivo->getCellByColumnAndRow($c,1)->getValue();
                        if(!empty($ValorNombre)){
                            $ValorNombre_EUL[$ValorNombre][$f] = $DefinirNombreArchivo->getCellByColumnAndRow($c,$f)->getValue();
                        }
                    }
                }
            }

            if($nom_h_rnd == "Iublink"){
                $DefinirNombreArchivo            = $RND->getSheet($conteo); 
                $filas_DefinirNombreArchivo_rnd  = $DefinirNombreArchivo ->getHighestRow();
                $Column_DefinirNombreArchivo_rnd = $DefinirNombreArchivo ->getHighestColumn();
                $NumColumn_DefinirNombreArchivo  = PHPExcel_Cell::columnIndexFromString($Column_DefinirNombreArchivo_rnd);
                for($f=2; $f <=$filas_DefinirNombreArchivo_rnd; $f++){
                    for($c=0; $c <=$NumColumn_DefinirNombreArchivo; $c++){
                        $ValorNombre = $DefinirNombreArchivo->getCellByColumnAndRow($c,1)->getValue();
                        if(!empty($ValorNombre)){
                            $ValorNombre_Iublink[$ValorNombre][$f] = $DefinirNombreArchivo->getCellByColumnAndRow($c,$f)->getValue();
                        }
                    }
                }
            }

            if($nom_h_rnd == "UtranCell"){
                $DefinirNombreArchivo            = $RND->getSheet($conteo); 
                $filas_DefinirNombreArchivo_rnd  = $DefinirNombreArchivo ->getHighestRow();
                $Column_DefinirNombreArchivo_rnd = $DefinirNombreArchivo ->getHighestColumn();
                $NumColumn_DefinirNombreArchivo  = PHPExcel_Cell::columnIndexFromString($Column_DefinirNombreArchivo_rnd);
                for($f=2; $f <=$filas_DefinirNombreArchivo_rnd; $f++){
                    for($c=0; $c <=$NumColumn_DefinirNombreArchivo; $c++){
                        $ValorNombre = $DefinirNombreArchivo->getCellByColumnAndRow($c,1)->getValue();
                        if(!empty($ValorNombre)){
                            $ValorNombre_UtranCell[$ValorNombre][$f] = $DefinirNombreArchivo->getCellByColumnAndRow($c,$f)->getValue();
                        }
                    }
                }
            }

            if($nom_h_rnd == "UtranRelation"){
                $DefinirNombreArchivo            = $RND->getSheet($conteo); 
                $filas_DefinirNombreArchivo_rnd  = $DefinirNombreArchivo ->getHighestRow();
                $Column_DefinirNombreArchivo_rnd = $DefinirNombreArchivo ->getHighestColumn();
                $NumColumn_DefinirNombreArchivo  = PHPExcel_Cell::columnIndexFromString($Column_DefinirNombreArchivo_rnd);
                for($f=2; $f <=$filas_DefinirNombreArchivo_rnd; $f++){
                    for($c=0; $c <=$NumColumn_DefinirNombreArchivo; $c++){
                        $ValorNombre = $DefinirNombreArchivo->getCellByColumnAndRow($c,1)->getValue();
                        $ValorFilas = $DefinirNombreArchivo->getCellByColumnAndRow(1,$f)->getValue();
                        if(!empty($ValorNombre) && !empty($ValorFilas)){
                            $ValorNombre_UtranRelation[$ValorNombre][$f] = $DefinirNombreArchivo->getCellByColumnAndRow($c,$f)->getValue();
                        }
                    }
                }
            }

            if($nom_h_rnd == "CoverageRelation"){
                $DefinirNombreArchivo            = $RND->getSheet($conteo); 
                $filas_DefinirNombreArchivo_rnd  = $DefinirNombreArchivo ->getHighestRow();
                $Column_DefinirNombreArchivo_rnd = $DefinirNombreArchivo ->getHighestColumn();
                $NumColumn_DefinirNombreArchivo  = PHPExcel_Cell::columnIndexFromString($Column_DefinirNombreArchivo_rnd);
                for($f=2; $f <=$filas_DefinirNombreArchivo_rnd; $f++){
                    for($c=0; $c <=$NumColumn_DefinirNombreArchivo; $c++){
                        $ValorNombre = $DefinirNombreArchivo->getCellByColumnAndRow($c,1)->getValue();
                        $ValorFilas = $DefinirNombreArchivo->getCellByColumnAndRow(1,$f)->getValue();
                        if(!empty($ValorNombre) && !empty($ValorFilas)){
                            $ValorNombre_CoverageRelation[$ValorNombre][$f] = $DefinirNombreArchivo->getCellByColumnAndRow($c,$f)->getValue();
                        }
                    }
                }
            }

            if($nom_h_rnd == "EutranFreqRelation"){
                $DefinirNombreArchivo            = $RND->getSheet($conteo); 
                $filas_DefinirNombreArchivo_rnd  = $DefinirNombreArchivo ->getHighestRow();
                $Column_DefinirNombreArchivo_rnd = $DefinirNombreArchivo ->getHighestColumn();
                $NumColumn_DefinirNombreArchivo  = PHPExcel_Cell::columnIndexFromString($Column_DefinirNombreArchivo_rnd);
                for($f=2; $f <=$filas_DefinirNombreArchivo_rnd; $f++){
                    for($c=0; $c <=$NumColumn_DefinirNombreArchivo; $c++){
                        $ValorNombre = $DefinirNombreArchivo->getCellByColumnAndRow($c,1)->getValue();
                        $ValorFilas = $DefinirNombreArchivo->getCellByColumnAndRow(1,$f)->getValue();
                        if(!empty($ValorNombre) && !empty($ValorFilas)){
                            $ValorNombre_EutranFreqRelation[$ValorNombre][$f] = $DefinirNombreArchivo->getCellByColumnAndRow($c,$f)->getValue();
                        }
                    }
                }
            }

            if($nom_h_rnd == "MscParameter"){
                $DefinirNombreArchivo            = $RND->getSheet($conteo); 
                $filas_DefinirNombreArchivo_rnd  = $DefinirNombreArchivo ->getHighestRow();
                $Column_DefinirNombreArchivo_rnd = $DefinirNombreArchivo ->getHighestColumn();
                $NumColumn_DefinirNombreArchivo  = PHPExcel_Cell::columnIndexFromString($Column_DefinirNombreArchivo_rnd);
                for($f=2; $f <=$filas_DefinirNombreArchivo_rnd; $f++){
                    for($c=0; $c <=$NumColumn_DefinirNombreArchivo; $c++){
                        $ValorNombre = $DefinirNombreArchivo->getCellByColumnAndRow($c,1)->getValue();
                        $ValorFilas = $DefinirNombreArchivo->getCellByColumnAndRow(1,$f)->getValue();
                        if(!empty($ValorNombre) && !empty($ValorFilas)){
                            $ValorNombre_MscParameter[$ValorNombre][$f] = $DefinirNombreArchivo->getCellByColumnAndRow($c,$f)->getValue();
                        }
                    }
                }
            }

            if($nom_h_rnd == "SiteConfiguration"){
                $DefinirNombreArchivo            = $RND->getSheet($conteo); 
                $filas_DefinirNombreArchivo_rnd  = $DefinirNombreArchivo ->getHighestRow();
                $Column_DefinirNombreArchivo_rnd = $DefinirNombreArchivo ->getHighestColumn();
                $NumColumn_DefinirNombreArchivo  = PHPExcel_Cell::columnIndexFromString($Column_DefinirNombreArchivo_rnd);
                for($f=2; $f <=$filas_DefinirNombreArchivo_rnd; $f++){
                    for($c=0; $c <=$NumColumn_DefinirNombreArchivo; $c++){
                        $ValorNombre = $DefinirNombreArchivo->getCellByColumnAndRow($c,1)->getValue();
                        $ValorFilas = $DefinirNombreArchivo->getCellByColumnAndRow(1,$f)->getValue();
                        if(!empty($ValorNombre) && !empty($ValorFilas)){
                            $ValorNombre_SiteConfiguration[$ValorNombre][$f] = $DefinirNombreArchivo->getCellByColumnAndRow($c,$f)->getValue();
                        }
                    }
                }
            }

            if($nom_h_rnd == "Sector"){
                $DefinirNombreArchivo            = $RND->getSheet($conteo); 
                $filas_DefinirNombreArchivo_rnd  = $DefinirNombreArchivo ->getHighestRow();
                $Column_DefinirNombreArchivo_rnd = $DefinirNombreArchivo ->getHighestColumn();
                $NumColumn_DefinirNombreArchivo  = PHPExcel_Cell::columnIndexFromString($Column_DefinirNombreArchivo_rnd);
                for($f=2; $f <=$filas_DefinirNombreArchivo_rnd; $f++){
                    for($c=0; $c <=$NumColumn_DefinirNombreArchivo; $c++){
                        $ValorNombre = $DefinirNombreArchivo->getCellByColumnAndRow($c,1)->getValue();
                        $ValorFilas = $DefinirNombreArchivo->getCellByColumnAndRow(1,$f)->getValue();
                        if(!empty($ValorNombre) && !empty($ValorFilas)){
                            $ValorNombre_Sector[$ValorNombre][$f] = $DefinirNombreArchivo->getCellByColumnAndRow($c,$f)->getValue();
                        }
                    }
                }
            }

            if($nom_h_rnd == "AntennaBranch"){
                $DefinirNombreArchivo            = $RND->getSheet($conteo); 
                $filas_DefinirNombreArchivo_rnd  = $DefinirNombreArchivo ->getHighestRow();
                $Column_DefinirNombreArchivo_rnd = $DefinirNombreArchivo ->getHighestColumn();
                $NumColumn_DefinirNombreArchivo  = PHPExcel_Cell::columnIndexFromString($Column_DefinirNombreArchivo_rnd);
                for($f=2; $f <=$filas_DefinirNombreArchivo_rnd; $f++){
                    for($c=0; $c <=$NumColumn_DefinirNombreArchivo; $c++){
                        $ValorNombre = $DefinirNombreArchivo->getCellByColumnAndRow($c,1)->getValue();
                        $ValorFilas = $DefinirNombreArchivo->getCellByColumnAndRow(1,$f)->getValue();
                        if(!empty($ValorNombre) && !empty($ValorFilas)){
                            $ValorNombre_AntennaBranch[$ValorNombre][$f] = $DefinirNombreArchivo->getCellByColumnAndRow($c,$f)->getValue();
                        }
                    }
                }
            }

            if($nom_h_rnd == "AntFeederCable"){
                $DefinirNombreArchivo            = $RND->getSheet($conteo); 
                $filas_DefinirNombreArchivo_rnd  = $DefinirNombreArchivo ->getHighestRow();
                $Column_DefinirNombreArchivo_rnd = $DefinirNombreArchivo ->getHighestColumn();
                $NumColumn_DefinirNombreArchivo  = PHPExcel_Cell::columnIndexFromString($Column_DefinirNombreArchivo_rnd);
                for($f=2; $f <=$filas_DefinirNombreArchivo_rnd; $f++){
                    for($c=0; $c <=$NumColumn_DefinirNombreArchivo; $c++){
                        $ValorNombre = $DefinirNombreArchivo->getCellByColumnAndRow($c,1)->getValue();
                        $ValorFilas = $DefinirNombreArchivo->getCellByColumnAndRow(1,$f)->getValue();
                        if(!empty($ValorNombre) && !empty($ValorFilas)){
                            $ValorNombre_AntFeederCable[$ValorNombre][$f] = $DefinirNombreArchivo->getCellByColumnAndRow($c,$f)->getValue();
                        }
                    }
                }
            }

            if($nom_h_rnd == "IubDataStreams"){
                $DefinirNombreArchivo            = $RND->getSheet($conteo); 
                $filas_DefinirNombreArchivo_rnd  = $DefinirNombreArchivo ->getHighestRow();
                $Column_DefinirNombreArchivo_rnd = $DefinirNombreArchivo ->getHighestColumn();
                $NumColumn_DefinirNombreArchivo  = PHPExcel_Cell::columnIndexFromString($Column_DefinirNombreArchivo_rnd);
                for($f=2; $f <=$filas_DefinirNombreArchivo_rnd; $f++){
                    for($c=0; $c <=$NumColumn_DefinirNombreArchivo; $c++){
                        $ValorNombre = $DefinirNombreArchivo->getCellByColumnAndRow($c,1)->getValue();
                        $ValorFilas = $DefinirNombreArchivo->getCellByColumnAndRow(1,$f)->getValue();
                        if(!empty($ValorNombre) && !empty($ValorFilas)){
                            $ValorNombre_IubDataStreams[$ValorNombre][$f] = $DefinirNombreArchivo->getCellByColumnAndRow($c,$f)->getValue();
                        }
                    }
                }
            }

            if($nom_h_rnd == "TxDeviceGroup"){
                $DefinirNombreArchivo            = $RND->getSheet($conteo); 
                $filas_DefinirNombreArchivo_rnd  = $DefinirNombreArchivo ->getHighestRow();
                $Column_DefinirNombreArchivo_rnd = $DefinirNombreArchivo ->getHighestColumn();
                $NumColumn_DefinirNombreArchivo  = PHPExcel_Cell::columnIndexFromString($Column_DefinirNombreArchivo_rnd);
                for($f=2; $f <=$filas_DefinirNombreArchivo_rnd; $f++){
                    for($c=0; $c <=$NumColumn_DefinirNombreArchivo; $c++){
                        $ValorNombre = $DefinirNombreArchivo->getCellByColumnAndRow($c,1)->getValue();
                        $ValorFilas = $DefinirNombreArchivo->getCellByColumnAndRow(1,$f)->getValue();
                        if(!empty($ValorNombre) && !empty($ValorFilas)){
                            $ValorNombre_TxDeviceGroup[$ValorNombre][$f] = $DefinirNombreArchivo->getCellByColumnAndRow($c,$f)->getValue();
                        }
                    }
                }
            }

            if($nom_h_rnd == "DownlinkBaseBandPool"){
                $DefinirNombreArchivo            = $RND->getSheet($conteo); 
                $filas_DefinirNombreArchivo_rnd  = $DefinirNombreArchivo ->getHighestRow();
                $Column_DefinirNombreArchivo_rnd = $DefinirNombreArchivo ->getHighestColumn();
                $NumColumn_DefinirNombreArchivo  = PHPExcel_Cell::columnIndexFromString($Column_DefinirNombreArchivo_rnd);
                for($f=2; $f <=$filas_DefinirNombreArchivo_rnd; $f++){
                    for($c=0; $c <=$NumColumn_DefinirNombreArchivo; $c++){
                        $ValorNombre = $DefinirNombreArchivo->getCellByColumnAndRow($c,1)->getValue();
                        $ValorFilas = $DefinirNombreArchivo->getCellByColumnAndRow(1,$f)->getValue();
                        if(!empty($ValorNombre) && !empty($ValorFilas)){
                            $ValorNombre_DownlinkBaseBandPool[$ValorNombre][$f] = $DefinirNombreArchivo->getCellByColumnAndRow($c,$f)->getValue();
                        }
                    }
                }
            }

            if($nom_h_rnd == "NodeBFunction"){
                $DefinirNombreArchivo            = $RND->getSheet($conteo); 
                $filas_DefinirNombreArchivo_rnd  = $DefinirNombreArchivo ->getHighestRow();
                $Column_DefinirNombreArchivo_rnd = $DefinirNombreArchivo ->getHighestColumn();
                $NumColumn_DefinirNombreArchivo  = PHPExcel_Cell::columnIndexFromString($Column_DefinirNombreArchivo_rnd);
                for($f=2; $f <=$filas_DefinirNombreArchivo_rnd; $f++){
                    for($c=0; $c <=$NumColumn_DefinirNombreArchivo; $c++){
                        $ValorNombre = $DefinirNombreArchivo->getCellByColumnAndRow($c,1)->getValue();
                        $ValorFilas = $DefinirNombreArchivo->getCellByColumnAndRow(1,$f)->getValue();
                        if(!empty($ValorNombre) && !empty($ValorFilas)){
                            $ValorNombre_NodeBFunction[$ValorNombre][$f] = $DefinirNombreArchivo->getCellByColumnAndRow($c,$f)->getValue();
                        }
                    }
                }
            }

            if($nom_h_rnd == "RBSLocalCell"){
                $DefinirNombreArchivo            = $RND->getSheet($conteo); 
                $filas_DefinirNombreArchivo_rnd  = $DefinirNombreArchivo ->getHighestRow();
                $Column_DefinirNombreArchivo_rnd = $DefinirNombreArchivo ->getHighestColumn();
                $NumColumn_DefinirNombreArchivo  = PHPExcel_Cell::columnIndexFromString($Column_DefinirNombreArchivo_rnd);
                for($f=2; $f <=$filas_DefinirNombreArchivo_rnd; $f++){
                    for($c=0; $c <=$NumColumn_DefinirNombreArchivo; $c++){
                        $ValorNombre = $DefinirNombreArchivo->getCellByColumnAndRow($c,1)->getValue();
                        $ValorFilas = $DefinirNombreArchivo->getCellByColumnAndRow(1,$f)->getValue();
                        if(!empty($ValorNombre) && !empty($ValorFilas)){
                            $ValorNombre_RBSLocalCell[$ValorNombre][$f] = $DefinirNombreArchivo->getCellByColumnAndRow($c,$f)->getValue();
                        }
                    }
                }
            }

            if($nom_h_rnd == "Carrier"){
                $DefinirNombreArchivo            = $RND->getSheet($conteo); 
                $filas_DefinirNombreArchivo_rnd  = $DefinirNombreArchivo ->getHighestRow();
                $Column_DefinirNombreArchivo_rnd = $DefinirNombreArchivo ->getHighestColumn();
                $NumColumn_DefinirNombreArchivo  = PHPExcel_Cell::columnIndexFromString($Column_DefinirNombreArchivo_rnd);
                for($f=2; $f <=$filas_DefinirNombreArchivo_rnd; $f++){
                    for($c=0; $c <=$NumColumn_DefinirNombreArchivo; $c++){
                        $ValorNombre = $DefinirNombreArchivo->getCellByColumnAndRow($c,1)->getValue();
                        $ValorFilas = $DefinirNombreArchivo->getCellByColumnAndRow(1,$f)->getValue();
                        if(!empty($ValorNombre) && !empty($ValorFilas)){
                            $ValorNombre_Carrier[$ValorNombre][$f] = $DefinirNombreArchivo->getCellByColumnAndRow($c,$f)->getValue();
                        }
                    }
                }
            }

            if($nom_h_rnd == "Rach"){
                $DefinirNombreArchivo            = $RND->getSheet($conteo); 
                $filas_DefinirNombreArchivo_rnd  = $DefinirNombreArchivo ->getHighestRow();
                $Column_DefinirNombreArchivo_rnd = $DefinirNombreArchivo ->getHighestColumn();
                $NumColumn_DefinirNombreArchivo  = PHPExcel_Cell::columnIndexFromString($Column_DefinirNombreArchivo_rnd);
                for($f=2; $f <=$filas_DefinirNombreArchivo_rnd; $f++){
                    for($c=0; $c <=$NumColumn_DefinirNombreArchivo; $c++){
                        $ValorNombre = $DefinirNombreArchivo->getCellByColumnAndRow($c,1)->getValue();
                        $ValorFilas = $DefinirNombreArchivo->getCellByColumnAndRow(1,$f)->getValue();
                        if(!empty($ValorNombre) && !empty($ValorFilas)){
                            $ValorNombre_Rach[$f][$ValorNombre] = $DefinirNombreArchivo->getCellByColumnAndRow($c,$f)->getValue();
                        }
                    }
                }
            }

            if($nom_h_rnd == "Fach"){
                $DefinirNombreArchivo            = $RND->getSheet($conteo); 
                $filas_DefinirNombreArchivo_rnd  = $DefinirNombreArchivo ->getHighestRow();
                $Column_DefinirNombreArchivo_rnd = $DefinirNombreArchivo ->getHighestColumn();
                $NumColumn_DefinirNombreArchivo  = PHPExcel_Cell::columnIndexFromString($Column_DefinirNombreArchivo_rnd);
                for($f=2; $f <=$filas_DefinirNombreArchivo_rnd; $f++){
                    for($c=0; $c <=$NumColumn_DefinirNombreArchivo; $c++){
                        $ValorNombre = $DefinirNombreArchivo->getCellByColumnAndRow($c,1)->getValue();
                        $ValorFilas = $DefinirNombreArchivo->getCellByColumnAndRow(1,$f)->getValue();
                        if(!empty($ValorNombre) && !empty($ValorFilas)){
                            $ValorNombre_Fach[$f][$ValorNombre] = $DefinirNombreArchivo->getCellByColumnAndRow($c,$f)->getValue();
                        }
                    }
                }
            }

            if($nom_h_rnd == "Hsdsch"){
                $DefinirNombreArchivo            = $RND->getSheet($conteo); 
                $filas_DefinirNombreArchivo_rnd  = $DefinirNombreArchivo ->getHighestRow();
                $Column_DefinirNombreArchivo_rnd = $DefinirNombreArchivo ->getHighestColumn();
                $NumColumn_DefinirNombreArchivo  = PHPExcel_Cell::columnIndexFromString($Column_DefinirNombreArchivo_rnd);
                for($f=2; $f <=$filas_DefinirNombreArchivo_rnd; $f++){
                    for($c=0; $c <=$NumColumn_DefinirNombreArchivo; $c++){
                        $ValorNombre = $DefinirNombreArchivo->getCellByColumnAndRow($c,1)->getValue();
                        $ValorFilas = $DefinirNombreArchivo->getCellByColumnAndRow(1,$f)->getValue();
                        if(!empty($ValorNombre) && !empty($ValorFilas)){
                            $ValorNombre_Hsdsch[$f][$ValorNombre] = $DefinirNombreArchivo->getCellByColumnAndRow($c,$f)->getValue();
                        }
                    }
                }
            }

            $conteo++;
        }


        foreach ($nombre_hoja_ip as $nom_h_ip) {
            if($nom_h_ip == "2G-3G"){
                $DefinirNombreArchivo           = $direciones_ip->getSheet($conteo_ip); 
                $filas_DefinirNombreArchivo_ip  = $DefinirNombreArchivo ->getHighestRow();
                $Column_DefinirNombreArchivo_ip = $DefinirNombreArchivo ->getHighestColumn();
                $NumColumn_DefinirNombreArchivo = PHPExcel_Cell::columnIndexFromString($Column_DefinirNombreArchivo_ip);
                for($f=2; $f <=$filas_DefinirNombreArchivo_ip; $f++){
                    for($c=0; $c <=$NumColumn_DefinirNombreArchivo; $c++){
                        $ValorNombre = $DefinirNombreArchivo->getCellByColumnAndRow($c,1)->getValue();
                        if(!empty($ValorNombre)){
                           $ValorNombre_3g[$ValorNombre][$f] = $DefinirNombreArchivo->getCellByColumnAndRow($c,$f)->getValue();
                        }
                    }
                }
            }            
            $conteo_ip++;
        }

        $archivo1 = $this->archivo_1($ValorNombre_final, $ValorNombre_final_rnc,$ValorNombre_EUL, $ValorNombre_Iublink);
        $this->archivo_2($ValorNombre_final, $ValorNombre_final_rnc,$ValorNombre_UtranCell);
        $this->archivo_3($ValorNombre_final, $ValorNombre_final_rnc,$ValorNombre_UtranCell,  $ValorNombre_Rach, $ValorNombre_Fach, $ValorNombre_Hsdsch,$ValorNombre_EUL);
        $this->archivo_4($ValorNombre_final, $ValorNombre_final_rnc);
        $this->archivo_5($ValorNombre_final, $ValorNombre_final_rnc, $ValorNombre_CoverageRelation);
        $this->archivo_6($ValorNombre_final, $ValorNombre_final_rnc, $ValorNombre_UtranRelation);
        $this->archivo_7($ValorNombre_final, $ValorNombre_final_rnc, $ValorNombre_EutranFreqRelation);
        $this->archivo_8($ValorNombre_final, $ValorNombre_final_rnc);
        $this->archivo_12($ValorNombre_final, $ValorNombre_final_rnc,$ValorNombre_UtranCell,$ValorNombre_MscParameter);
        $this->archivo_14($ValorNombre_final, $ValorNombre_final_rnc,$ValorNombre_UtranCell);
        $this->archivo_15($ValorNombre_final, $ValorNombre_final_rnc, $ValorNombre_3g);
        $this->archivo_16($ValorNombre_final, $ValorNombre_final_rnc, $ValorNombre_Sector, $ValorNombre_SiteConfiguration,$ValorNombre_AntennaBranch,$ValorNombre_AntFeederCable);
        $this->archivo_17($ValorNombre_final, $ValorNombre_final_rnc, $ValorNombre_IubDataStreams);
        $archivo18 = $this->archivo_18($ValorNombre_final, $ValorNombre_final_rnc, $ValorNombre_TxDeviceGroup, $ValorNombre_DownlinkBaseBandPool, $ValorNombre_NodeBFunction, $ValorNombre_RBSLocalCell, $ValorNombre_Carrier);
        if($archivo1){
            return true;    
        }
    }
    /////////////////////////////////////////////////////////////////////////
    //Metodo para la creacion del archivo siteinstall el primero de la lista
    //Fecha de creacion: 21-06-2017
    //Creador por: Wagner Rivera
    //Fecha de Modificación: 21-06-2017
    ////////////////////////////////////////////////////////////////////////
    protected function archivo_1($ValorNombre_final, $ValorNombre_final_rnc,$ValorNombre_EUL, $ValorNombre_Iublink){
        foreach ($ValorNombre_EUL as $key => $value) {
            if($key == 'administrativeState'){
                foreach ($value as $valor) {
                    $administrativeState = $valor;
                }
            }
        }
        $arc_uno   = new CREATE_IUB($ValorNombre_final, $ValorNombre_final_rnc);
        $archivo_1 = $arc_uno->CREATE_IUB_($administrativeState, $ValorNombre_Iublink);
        return $archivo_1;
    }//fin de la creacion de la estructura del archivo 1 de tipo 3g
    /////////////////////////////////////////////////////////////////////////
    //Metodo para la creacion del archivo siteinstall el primero de la lista
    //Fecha de creacion: 21-06-2017
    //Creador por: Wagner Rivera
    //Fecha de Modificación: 21-06-2017
    ////////////////////////////////////////////////////////////////////////
    protected function archivo_2($ValorNombre_final, $ValorNombre_final_rnc,$ValorNombre_UtranCell){       
        $arc_uno   = new CREATE_AREA($ValorNombre_final, $ValorNombre_final_rnc);
        $archivo_1 = $arc_uno->CREATE_AREA_($ValorNombre_UtranCell);
    }//fin de la creacion de la estructura del archivo 2 de tipo 3g 
    /////////////////////////////////////////////////////////////////////////
    //Metodo para la creacion del archivo siteinstall el primero de la lista
    //Fecha de creacion: 21-06-2017
    //Creador por: Wagner Rivera
    //Fecha de Modificación: 21-06-2017
    ////////////////////////////////////////////////////////////////////////
    protected function archivo_3($ValorNombre_final, $ValorNombre_final_rnc,$ValorNombre_UtranCell,$ValorNombre_Rach,$ValorNombre_E_Fach, $ValorNombre_Hsdsch,$ValorNombre_EUL){       
        $arc_uno   = new CREATE_UTRACELL($ValorNombre_final, $ValorNombre_final_rnc);
        $archivo_1 = $arc_uno->CREATE_UTRACELL_($ValorNombre_UtranCell,$ValorNombre_Rach,$ValorNombre_E_Fach, $ValorNombre_Hsdsch,$ValorNombre_EUL);        
    }//fin de la creacion de la estructura del archivo 3 de tipo 3g

    protected function archivo_4($ValorNombre_final, $ValorNombre_final_rnc){       
        $arc_uno   = new DELETE_UTRANRELATION($ValorNombre_final, $ValorNombre_final_rnc);
        $archivo_1 = $arc_uno->DELETE_UTRANRELATION_();
    }//fin de la creacion de la estructura del archivo 4 de tipo 3g

    protected function archivo_5($ValorNombre_final, $ValorNombre_final_rnc, $ValorNombre_CoverageRelation){       
        $arc_uno   = new CREATE_COVERAGE_RELATION($ValorNombre_final, $ValorNombre_final_rnc);
        $archivo_1 = $arc_uno->CREATE_COVERAGE_RELATION_($ValorNombre_CoverageRelation);
    }//fin de la creacion de la estructura del archivo 5 de tipo 3g

    protected function archivo_6($ValorNombre_final, $ValorNombre_final_rnc, $ValorNombre_UtranRelation){       
        $arc_uno   = new CREATE_UTRANRELATION($ValorNombre_final, $ValorNombre_final_rnc);
        $archivo_1 = $arc_uno->CREATE_UTRANRELATION_($ValorNombre_UtranRelation);
    }//fin de la creacion de la estructura del archivo 6 de tipo 3g

    protected function archivo_7($ValorNombre_final, $ValorNombre_final_rnc,$ValorNombre_EutranFreqRelation){       
        $arc_uno   = new CREATE_EUTRANFREQRELATION($ValorNombre_final, $ValorNombre_final_rnc);
        $archivo_1 = $arc_uno->CREATE_EUTRANFREQRELATION_($ValorNombre_EutranFreqRelation);
    }//fin de la creacion de la estructura del archivo 7 de tipo 3g

    protected function archivo_8($ValorNombre_final, $ValorNombre_final_rnc){       
        $arc_uno   = new CREATE_EXTERNAL_GSM_CELL($ValorNombre_final, $ValorNombre_final_rnc);
        $archivo_1 = $arc_uno->CREATE_EXTERNAL_GSM_CELL_();
    }//fin de la creacion de la estructura del archivo 8 de tipo 3g

    protected function archivo_12($ValorNombre_final, $ValorNombre_final_rnc,$ValorNombre_UtranCell,$ValorNombre_MscParameter){       
        $arc_uno   = new CREATE_UTRANCELL_IN_BSC_MSC($ValorNombre_final, $ValorNombre_final_rnc);
        $archivo_1 = $arc_uno->CREATE_UTRANCELL_IN_BSC_MSC_($ValorNombre_UtranCell,$ValorNombre_MscParameter);
    }//fin de la creacion de la estructura del archivo 12 de tipo 3g

    protected function archivo_14($ValorNombre_final, $ValorNombre_final_rnc,$ValorNombre_UtranCell){       
        $arc_uno   = new CREATE_UTRANCELL_IN_CNAI($ValorNombre_final, $ValorNombre_final_rnc);
        $archivo_1 = $arc_uno->CREATE_UTRANCELL_IN_CNAI_($ValorNombre_UtranCell);
    }//fin de la creacion de la estructura del archivo 14 de tipo 3g

    protected function archivo_15($ValorNombre_final, $ValorNombre_final_rnc,$ValorNombre_3g){       
        $arc_uno   = new OAM_SCRIPT($ValorNombre_final, $ValorNombre_final_rnc);
        $archivo_1 = $arc_uno->OAM_SCRIPT_($ValorNombre_3g);
    }//fin de la creacion de la estructura del archivo 2 de tipo 3g

    protected function archivo_16($ValorNombre_final, $ValorNombre_final_rnc, $ValorNombre_Sector, $ValorNombre_SiteConfiguration,$ValorNombre_AntennaBranch, $ValorNombre_AntFeederCable){       
        $arc_uno   = new SITE_EQUIPMENT_SCRIPT($ValorNombre_final, $ValorNombre_final_rnc);
        $archivo_1 = $arc_uno->SITE_EQUIPMENT_SCRIPT_($ValorNombre_Sector,$ValorNombre_SiteConfiguration, $ValorNombre_AntennaBranch, $ValorNombre_AntFeederCable);
    }//fin de la creacion de la estructura del archivo 2 de tipo 3g

    protected function archivo_17($ValorNombre_final, $ValorNombre_final_rnc, $ValorNombre_IubDataStreams){       
        $arc_uno   = new SITE_COMPLETE_SCRIPT($ValorNombre_final, $ValorNombre_final_rnc);
        $archivo_1 = $arc_uno->SITE_COMPLETE_SCRIPT_($ValorNombre_IubDataStreams);
    }//fin de la creacion de la estructura del archivo 2 de tipo 3g

    protected function archivo_18($ValorNombre_final, $ValorNombre_final_rnc, $ValorNombre_TxDeviceGroup, $ValorNombre_DownlinkBaseBandPool, $ValorNombre_NodeBFunction, $ValorNombre_RBSLocalCell,$ValorNombre_Carrier){       
        $arc_uno   = new PARAMETROS_SCRIPT($ValorNombre_final, $ValorNombre_final_rnc);
        $archivo_1 = $arc_uno->PARAMETROS_SCRIPT_($ValorNombre_TxDeviceGroup, $ValorNombre_DownlinkBaseBandPool, $ValorNombre_NodeBFunction, $ValorNombre_RBSLocalCell,$ValorNombre_Carrier);
        return $archivo_1;
    }//fin de la creacion de la estructura del archivo 2 de tipo 3g
    

    public function __destruct()
    {
        
    }
}
	
?>