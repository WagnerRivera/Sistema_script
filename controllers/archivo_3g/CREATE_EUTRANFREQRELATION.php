<?php
require_once("../Control_Archivo.php");
/////////////////////////////////////////////////////////////////////////
//Clase para la contruccion de la estrctura de los archivos xml, mos y mo
//Fecha de creacion: 29-05-2017
//Creador por: Wagner Rivera
//Fecha de Modificación: 01-06-2017
////////////////////////////////////////////////////////////////////////
class CREATE_EUTRANFREQRELATION extends Control_Archivos
{
    private $ruta    = "archivos/ENodoB/ENodoB_";
    private $Archivo = "/07.CREATE_EUTRANFREQRELATION_";
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
	public function CREATE_EUTRANFREQRELATION_($p_p_7_1){
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
    $parte_uno = $this->Crear_cuerpo_uno($p_p_7_1);
    $cinsert  .= $parte_uno; 
        $estructura = $this->ruta.$this->nombre;
        $archivo  = $estructura.$this->Archivo.$this->nombre.".mo";
        $this->ElimarArchivo($archivo);
    $this->CrearArchivo($archivo, $cinsert);  
    return true;
	}  

  public function Crear_cuerpo_uno($p_7_1){
    $contar = 0;
      foreach ($p_7_1 as $key => $value) {
        if($key == 'UtranCell'){
          foreach ($value as $valor) {
             $Utrancell[] = $valor;
          }
        }

        if($key == 'eutranFrequency'){
          foreach ($value as $valor) {
             $eutranFrequency[] = $valor;
          }
        }

        if($key == 'cellReselectionPriority'){
          foreach ($value as $valor) {
             $cellReselectionPriority[] = $valor;
          }
        }

        if($key == 'qRxLevMin'){
          foreach ($value as $valor) {
             $qRxLevMin[] = $valor;
          }
        }

        if($key == 'threshHigh'){
          foreach ($value as $valor) {
             $threshHigh[] = $valor;
          }
        }

        if($key == 'threshlow'){
          foreach ($value as $valor) {
             $threshlow[] = $valor;
          }
        }

        if($key == 'redirectionOrder'){
          foreach ($value as $valor) {
             $redirectionOrder[] = $valor;
          }
        }

        if($key == 'thresh2dRwr'){
          foreach ($value as $valor) {                      
        $lineas = count($Utrancell);
        if($contar == 0){
          @$continido_1_1_1 .='
////////////////////////////////////////////////////////////
//EUTRAN INTERNAL RELATION TOTAL: '.$lineas.'                       //
////////////////////////////////////////////////////////////
';
        }           
            $continido_1_1_1 .='
////////////////////////////////////////////////////////////
//EUTRAN INTERNAL RELATION: '.$Utrancell[$contar].' -> '.$eutranFrequency[$contar].'
////////////////////////////////////////////////////////////

CREATE
(
parent "ManagedElement=1,RncFunction=1,UtranCell='.$Utrancell[$contar].'"
identity "'.$eutranFrequency[$contar].'"
moType EutranFreqRelation
exception none
nrOfAttributes 1
eutranFrequencyRef Ref "ManagedElement=1,RncFunction=1,EutraNetwork=1,EutranFrequency='.$eutranFrequency[$contar].'"
)
SET
(
mo "ManagedElement=1,RncFunction=1,UtranCell='.$Utrancell[$contar].',EutranFreqRelation='.$eutranFrequency[$contar].'"
exception none
cellReselectionPriority Integer '.$cellReselectionPriority[$contar].'
)
SET
(
mo "ManagedElement=1,RncFunction=1,UtranCell='.$Utrancell[$contar].',EutranFreqRelation='.$eutranFrequency[$contar].'"
exception none
qRxLevMin Integer '.$qRxLevMin[$contar].'
)
SET
(
mo "ManagedElement=1,RncFunction=1,UtranCell='.$Utrancell[$contar].',EutranFreqRelation='.$eutranFrequency[$contar].'"
exception none
threshHigh Integer '.$threshHigh[$contar].'
)
SET
(
mo "ManagedElement=1,RncFunction=1,UtranCell='.$Utrancell[$contar].',EutranFreqRelation='.$eutranFrequency[$contar].'"
exception none
threshLow Integer '.$threshlow[$contar].'
)
SET
(
mo "ManagedElement=1,RncFunction=1,UtranCell='.$Utrancell[$contar].',EutranFreqRelation='.$eutranFrequency[$contar].'"
exception none
redirectionOrder Integer '.$redirectionOrder[$contar].'
)
SET
(
mo "ManagedElement=1,RncFunction=1,UtranCell='.$Utrancell[$contar].',EutranFreqRelation='.$eutranFrequency[$contar].'"
exception none
thresh2dRwr Integer '.$valor.'
)
//'.($contar+1).'
';
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