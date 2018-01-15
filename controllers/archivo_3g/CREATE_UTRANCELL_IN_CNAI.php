<?php
require_once("../Control_Archivo.php");
/////////////////////////////////////////////////////////////////////////
//Clase para la contruccion de la estrctura de los archivos xml, mos y mo
//Fecha de creacion: 29-05-2017
//Creador por: Wagner Rivera
//Fecha de Modificación: 01-06-2017
////////////////////////////////////////////////////////////////////////
class CREATE_UTRANCELL_IN_CNAI extends Control_Archivos
{
    private $ruta    = "archivos/ENodoB/ENodoB_";
    private $Archivo = "/14.CREATE_UTRANCELL_IN_CNAI_";
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
	public function CREATE_UTRANCELL_IN_CNAI_($p_p_14_1)
	{
		
		$cinsert = '
..cnai # by CNAI R7F07, user cmoya
..capabilities BASIC
.subnetwork UNDEFINED
.domain UTRAN_CELL
';
		$parte_uno = $this->Crear_cuerpo_uno($p_p_14_1);
		$cinsert  .= $parte_uno;
    $cinsert  .= '
..END';
        $estructura = $this->ruta.$this->nombre;
        $archivo 	= $estructura.$this->Archivo.$this->nombre.".mo";
        $this->ElimarArchivo($archivo);
		$this->CrearArchivo($archivo, $cinsert);	
		return true;	
	}

	public function Crear_cuerpo_uno($p_14_1){
     $contar = 0;
    foreach ($p_14_1 as $key => $value) {
      if($key == 'RNC'){
        foreach ($value as $valor) {
           $i_rnd[] = $valor;
        }
      }

      if($key == 'cId'){
        foreach ($value as $valor) {
           $cId[] = $valor;
        }
      }

      if($key == 'uarfcnDl'){
        foreach ($value as $valor) {
           $uarfcnDl[] = $valor;
        }
      }

      if($key == 'absPrioCellRes_sPrioritySearch1'){
        foreach ($value as $valor) {
           $absPrioCellRes_sPrioritySearch1[] = $valor;
        }
      }

      if($key == 'qQualMin'){
        foreach ($value as $valor) {
           $qQualMin[] = $valor;
        }
      }

      if($key == 'primaryScramblingCode'){
        foreach ($value as $valor) {
           $primaryScramblingCode[] = $valor;
        }
      }

      if($key == 'sRatSearch'){
        foreach ($value as $valor) {
           $sRatSearch[] = $valor;
        }
      }

      if($key == 'usedFreqThresh2dEcno'){
        foreach ($value as $valor) {
           $usedFreqThresh2dEcno[] = $valor;
        }
      }

      if($key == 'primaryCpichPower'){
        foreach ($value as $valor) {
           $primaryCpichPower[] = $valor;
        }
      }

      if($key == 'qRxLevMin'){
        foreach ($value as $valor) {
           $qRxLevMin[] = $valor;
        }
      }

      if($key == 'usedFreqThresh2dRscp'){
        foreach ($value as $valor) {
           $usedFreqThresh2dRscp[] = $valor;
        }
      }

      if($key == 'lac'){
        foreach ($value as $valor) {
           $lac[] = $valor;
        }
      }

      if($key == 'userLabel'){        
        foreach ($value as $valor) {
         $continido_1_1_1 .='
.set '.$this->I_RND[$i_rnd[$contar]].':'.$valor.'
RNCID="'.$this->I_RND[$i_rnd[$contar]].'"
CELL_NAME="'.$valor.'"
CI="'.$cId[$contar].'"
DIVERSITY="NODIV"
FDDARFCN='.$uarfcnDl[$contar].'
LAC="'.$lac[$contar].'"
MRSL='.$absPrioCellRes_sPrioritySearch1[$contar].'
MCC="730"
MNC="001"
QQUALMIN='.$qQualMin[$contar].'
SCRCODE='.$primaryScramblingCode[$contar].'
SRATSEARCH='.$sRatSearch[$contar].'
USERLABEL="'.$valor.'"
USEDFREQTHRESH2DECNO='.$usedFreqThresh2dEcno[$contar].'
SOURCENAME="UtranCell='.$valor.'"
PRIMARYCPICHPOWER='.$primaryCpichPower[$contar].'
QRXLEVMIN='.$qRxLevMin[$contar].'
USEDFREQTHRESH2DRSCP='.$usedFreqThresh2dRscp[$contar].'
.set '.$this->I_RND[$i_rnd[$contar]].':'.$valor.' PG';
           $contar++;         
        }
      }

    }
    
		return $continido_1_1_1;
	}  

    public function __destruct()
    {
        
    }
}
	
?>