<?php
require_once("../Control_Archivo.php");
/////////////////////////////////////////////////////////////////////////
//Clase para la contruccion de la estrctura de los archivos xml, mos y mo
//Fecha de creacion: 29-05-2017
//Creador por: Wagner Rivera
//Fecha de Modificación: 01-06-2017
////////////////////////////////////////////////////////////////////////
class CREATE_UTRACELL extends Control_Archivos
{
    private $ruta    = "archivos/ENodoB/ENodoB_";
    private $Archivo = "/03.CREATE_UTRACELL_";
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
	public function CREATE_UTRACELL_($p_p_3_1,$p_p_3_2, $p_p_3_3,$p_p_3_4,$p_p_3_5)
	{
		
		$cinsert = '/////////////////////////////////////////////////////////////
//
// SCRIPT     : CREATE UTRACELL
// NEMONICO   : '.$this->nombre.'
// RNC        : '.$this->nom_rnc.'
// GENERADOR  : INCOBECH
// HORA       : '.$this->Horas().'
// FECHA      : '.$this->Fechas().'
//
/////////////////////////////////////////////////////////////
';
		$parte_uno = $this->Crear_cuerpo_uno($p_p_3_1, $p_p_3_2, $p_p_3_3,$p_p_3_4,$p_p_3_5);
    foreach ($parte_uno as $key => $value) {
      $cinsert  .= $value; 
    }
		
        $estructura = $this->ruta.$this->nombre;
        $archivo 	= $estructura.$this->Archivo.$this->nombre.".mo";
        
        $this->ElimarArchivo($archivo);
		$this->CrearArchivo($archivo, $cinsert);	
		return true;
	}

	public function Crear_cuerpo_uno($p_3_1, $p_3_2, $p_3_3, $p_3_4, $p_3_5){
    $contar = 0;
    foreach ($p_3_1 as $key => $value) {
      if($key == 'Utrancell'){
        foreach ($value as $valor) {
           $Utrancell[] = $valor;
        }
      }

      if($key == 'lac'){
        foreach ($value as $valor) {
            $lac[] = $valor;
        }
      }

      if($key == 'tCell'){
        foreach ($value as $valor) {
            $tCell[] = $valor;
        }
      }

      if($key == 'cellBroadcastSac'){
        foreach ($value as $valor) {
            $cellBroadcastSac[] = $valor;
        }
      }

      if($key == 'cId'){
        foreach ($value as $valor) {
            $cId[] = $valor;
        }
      }

      if($key == 'absPrioCellRes_cellReselectionPriority'){
        foreach ($value as $valor) {
            $absPrioCellRes_cellReselectionPriority[] = $valor;
        }
      }

      if($key == 'absPrioCellRes_sPrioritySearch1'){
        foreach ($value as $valor) {
            $absPrioCellRes_sPrioritySearch1[] = $valor;
        }
      }

      if($key == 'absPrioCellRes_sPrioritySearch2'){
        foreach ($value as $valor) {
            $absPrioCellRes_sPrioritySearch2[] = $valor;
        }
      }

      if($key == 'absPrioCellRes_threshServingLow'){
        foreach ($value as $valor) {
            $absPrioCellRes_threshServingLow[] = $valor;
        }
      }

      if($key == 'accessClassesBarredCs'){
        foreach ($value as $valor) {
            $accessClassesBarredCs[] = $valor;
        }
      }


      if($key == 'accessClassesBarredPs'){
        foreach ($value as $valor) {
            $accessClassesBarredPs[] = $valor;
        }
      }

      if($key == 'admBlockRedirection_gsmRrc'){
        foreach ($value as $valor) {
            $admBlockRedirection_gsmRrc[] = $valor;
        }
      }

      if($key == 'admBlockRedirection_rrc'){
        foreach ($value as $valor) {
            $admBlockRedirection_rrc[] = $valor;
        }
      }

      if($key == 'admBlockRedirection_speech'){
        foreach ($value as $valor) {
            $admBlockRedirection_speech[] = $valor;
        }
      }

      if($key == 'accessClassNBarred'){
        foreach ($value as $valor) {
            $accessClassNBarred[] = $valor;
        }
      }

      if($key == 'agpsEnabled'){
        foreach ($value as $valor) {
            $agpsEnabled[] = $valor;
        }
      }

      if($key == 'amrNbSelector'){
        foreach ($value as $valor) {
            $amrNbSelector[] = $valor;
        }
      }

      if($key == 'amrWbRateDlMax'){
        foreach ($value as $valor) {
            $amrWbRateDlMax[] = $valor;
        }
      }

      if($key == 'amrWbRateUlMax'){
        foreach ($value as $valor) {
            $amrWbRateUlMax[] = $valor;
        }
      }

      if($key == 'anrIafUtranCellConfig_anrEnabled'){
        foreach ($value as $valor) {
            $anrEnabled[] = $valor;
        }
      }

      if($key == 'anrIafUtranCellConfig_relationAddEnabled'){
        foreach ($value as $valor) {
            $relationAddEnabled[] = $valor;
        }
      }

      if($key == 'antennaPosition_latitudeSign'){
        foreach ($value as $valor) {
            $latitudeSign[] = $valor;
        }
      }

      if($key == 'antennaPosition_latitude'){
        foreach ($value as $valor) {
            $latitude[] = $valor;
        }
      }

      if($key == 'antennaPosition_longitude'){
        foreach ($value as $valor) {
            $longitude[] = $valor;
        }
      }

      if($key == 'aseDlAdm'){
        foreach ($value as $valor) {
            $aseDlAdm[] = $valor;
        }
      }

      if($key == 'pwrLoadThresholdDlSpeech_amr12200'){
        foreach ($value as $valor) {
            $amr12200[] = $valor;
        }
      }

      if($key == 'pwrLoadThresholdDlSpeech_amr7950'){
        foreach ($value as $valor) {
            $amr7950[] = $valor;
        }
      }

      if($key == 'pwrLoadThresholdDlSpeech_amr5900'){
        foreach ($value as $valor) {
            $amr5900[] = $valor;
        }
      }

      if($key == 'pwrLoadThresholdDlSpeech_amrWb8850'){
        foreach ($value as $valor) {
            $amrWb8850[] = $valor;
        }
      }

      if($key == 'pwrLoadThresholdDlSpeech_amrWb12650'){
        foreach ($value as $valor) {
            $amrWb12650[] = $valor;
        }
      }

      if($key == 'aseUlAdm'){
        foreach ($value as $valor) {
            $aseUlAdm[] = $valor;
        }
      }

      if($key == 'bchPower'){
        foreach ($value as $valor) {
            $bchPower[] = $valor;
        }
      }

      if($key == 'cbsSchedulePeriodLength'){
        foreach ($value as $valor) {
            $cbsSchedulePeriodLength[] = $valor;
        }
      }

      if($key == 'cellBroadcastSac'){
        foreach ($value as $valor) {
            $cellBroadcastSac[] = $valor;
        }
      }

      if($key == 'cellReserved'){
        foreach ($value as $valor) {
            $cellReserved[] = $valor;
        }
      }

      if($key == 'cId'){
        foreach ($value as $valor) {
            $cId[] = $valor;
        }
      }

      if($key == 'codeLoadThresholdDlSf128'){
        foreach ($value as $valor) {
            $codeLoadThresholdDlSf128[] = $valor;
        }
      }

      if($key == 'compModeAdm'){
        foreach ($value as $valor) {
            $compModeAdm[] = $valor;
        }
      }

      if($key == 'cpcSupport'){
        foreach ($value as $valor) {
            $cpcSupport[] = $valor;
        }
      }

      if($key == 'ctchAdmMargin'){
        foreach ($value as $valor) {
            $ctchAdmMargin[] = $valor;
        }
      }

      if($key == 'ctchOccasionPeriod'){
        foreach ($value as $valor) {
            $ctchOccasionPeriod[] = $valor;
        }
      }

      if($key == 'cyclicAcb_acbEnabled'){
        foreach ($value as $valor) {
            $cyclicAcb_acbEnabled[] = $valor;
        }
      }

      if($key == 'cyclicAcb_rotationGroupSize'){
        foreach ($value as $valor) {
            $cyclicAcb_rotationGroupSize[] = $valor;
        }
      }

      if($key == 'cyclicAcbCs_acbEnabled'){
        foreach ($value as $valor) {
            $cyclicAcbCs_acbEnabled[] = $valor;
        }
      }

      if($key == 'cyclicAcbCs_rotationGroupSize'){
        foreach ($value as $valor) {
            $cyclicAcbCs_rotationGroupSize[] = $valor;
        }
      }

      if($key == 'cyclicAcbPs_acbEnabled'){
        foreach ($value as $valor) {
            $cyclicAcbPs_acbEnabled[] = $valor;
        }
      }

      if($key == 'cyclicAcbPs_rotationGroupSize'){
        foreach ($value as $valor) {
            $cyclicAcbPs_rotationGroupSize[] = $valor;
        }
      }

      if($key == 'dchIflsMarginCode'){
        foreach ($value as $valor) {
            $dchIflsMarginCode[] = $valor;
        }
      }

      if($key == 'dchIflsMarginPower'){
        foreach ($value as $valor) {
            $dchIflsMarginPower[] = $valor;
        }
      }

      if($key == 'dchIflsThreshCode'){
        foreach ($value as $valor) {
            $dchIflsThreshCode[] = $valor;
        }
      }


      if($key == 'dchIflsThreshPower'){
        foreach ($value as $valor) {
            $dchIflsThreshPower[] = $valor;
        }
      }

      if($key == 'dlCodeAdm'){
        foreach ($value as $valor) {
            $dlCodeAdm[] = $valor;
        }
      }

      if($key == 'dlCodeOffloadLimit'){
        foreach ($value as $valor) {
            $dlCodeOffloadLimit[] = $valor;
        }
      }

      if($key == 'dlPowerOffloadLimit'){
        foreach ($value as $valor) {
            $dlPowerOffloadLimit[] = $valor;
        }
      }

      if($key == 'dmcrEnabled'){
        foreach ($value as $valor) {
            $dmcrEnabled[] = $valor;
        }
      }

      if($key == 'dnclEnabled'){
        foreach ($value as $valor) {
            $dnclEnabled[] = $valor;
        }
      }

      if($key == 'downswitchTimer'){
        foreach ($value as $valor) {
            $downswitchTimer[] = $valor;
        }
      }

      if($key == 'eulNonServingCellUsersAdm'){
        foreach ($value as $valor) {
            $eulNonServingCellUsersAdm[] = $valor;
        }
      }

      if($key == 'eulServingCellUsersAdm'){
        foreach ($value as $valor) {
            $eulServingCellUsersAdm[] = $valor;
        }
      }

      if($key == 'eulServingCellUsersAdmTti2'){
        foreach ($value as $valor) {
            $eulServingCellUsersAdmTti2[] = $valor;
        }
      }
      
      if($key == 'fachMeasOccaCycLenCoeff'){
        foreach ($value as $valor) {
            $fachMeasOccaCycLenCoeff[] = $valor;
        }
      }

      if($key == 'fdpchSupport'){
        foreach ($value as $valor) {
            $fdpchSupport[] = $valor;
        }
      }

      if($key == 'ganHoEnabled'){
        foreach ($value as $valor) {
            $ganHoEnabled[] = $valor;
        }
      }

      if($key == 'hardIfhoCorr'){
        foreach ($value as $valor) {
            $hardIfhoCorr[] = $valor;
        }
      }

      if($key == 'hcsSib3Config_hcsPrio'){
        foreach ($value as $valor) {
            $hcsPrio[] = $valor;
        }
      }
      if($key == 'hcsSib3Config_qHcs'){
        foreach ($value as $valor) {
            $qHcs[] = $valor;
        }
      }
      if($key == 'hsdschInactivityTimer'){
        foreach ($value as $valor) {
            $hsdschInactivityTimer[] = $valor;
        }
      }      
      if($key == 'hcsSib3Config_sSearchHcs'){
        foreach ($value as $valor) {
            $sSearchHcs[] = $valor;
        }
      }
      if($key == 'hcsUsage_connectedMode'){
        foreach ($value as $valor) {
            $connectedMode[] = $valor;
        }
      }
      if($key == 'hcsUsage_idleMode'){
        foreach ($value as $valor) {
            $idleMode[] = $valor;
        }
      }
      if($key == 'hoType'){
        foreach ($value as $valor) {
            $hoType[] = $valor;
        }
      }
      if($key == 'hsdpaUsersAdm'){
        foreach ($value as $valor) {
            $hsdpaUsersAdm[] = $valor;
        }
      }
      if($key == 'hsdpaUsersOffloadLimit'){
        foreach ($value as $valor) {
            $hsdpaUsersOffloadLimit[] = $valor;
        }
      }
      if($key == 'hsIflsDownswitchTrigg_fastDormancy'){
        foreach ($value as $valor) {
            $fastDormancy[] = $valor;
        }
      }
      if($key == 'hsIflsDownswitchTrigg_toFach'){
        foreach ($value as $valor) {
            $toFach[] = $valor;
        }
      }
      if($key == 'hsIflsDownswitchTrigg_toUra'){
        foreach ($value as $valor) {
            $toUra[] = $valor;
        }
      }
      if($key == 'hsIflsHighLoadThresh'){
        foreach ($value as $valor) {
            $hsIflsHighLoadThresh[] = $valor;
        }
      }
      if($key == 'hsIflsMarginUsers'){
        foreach ($value as $valor) {
            $hsIflsMarginUsers[] = $valor;
        }
      }
      if($key == 'hsIflsPowerLoadThresh'){
        foreach ($value as $valor) {
            $hsIflsPowerLoadThresh[] = $valor;
        }
      }
      if($key == 'hsIflsRedirectLoadLimit'){
        foreach ($value as $valor) {
            $hsIflsRedirectLoadLimit[] = $valor;
        }
      }
      if($key == 'hsIflsSpeechMultiRabTrigg'){
        foreach ($value as $valor) {
            $hsIflsSpeechMultiRabTrigg[] = $valor;
        }
      }
      if($key == 'hsIflsThreshUsers'){
        foreach ($value as $valor) {
            $hsIflsThreshUsers[] = $valor;
        }
      }
      if($key == 'hsIflsTrigger_fromFach'){
        foreach ($value as $valor) {
            $fromFach[] = $valor;
        }
      }
      if($key == 'hsIflsTrigger_fromUra'){
        foreach ($value as $valor) {
            $fromUra[] = $valor;
        }
      }
      if($key == 'iFCong'){
        foreach ($value as $valor) {
            $iFCong[] = $valor;
        }
      }
      if($key == 'iFHyst'){
        foreach ($value as $valor) {
            $iFHyst[] = $valor;
        }
      }
      if($key == 'iflsCpichEcnoThresh'){
        foreach ($value as $valor) {
            $iflsCpichEcnoThresh[] = $valor;
        }
      }
      if($key == 'iflsMode'){
        foreach ($value as $valor) {
            $iflsMode[] = $valor;
        }
      }
      if($key == 'iflsRedirectUarfcn'){
        foreach ($value as $valor) {
            $iflsRedirectUarfcn[] = $valor;
        }
      }

      if($key == 'inactivityTimeMultiPsInteractive'){
        foreach ($value as $valor) {
            $inactivityTimeMultiPsInteractive[] = $valor;
        }
      }
      if($key == 'inactivityTimer'){
        foreach ($value as $valor) {
            $inactivityTimer[] = $valor;
        }
      }if($key == 'inactivityTimerEnhUeDrx'){
        foreach ($value as $valor) {
            $inactivityTimerEnhUeDrx[] = $valor;
        }
      }
      if($key == 'inactivityTimerPch'){
        foreach ($value as $valor) {
            $inactivityTimerPch[] = $valor;
        }
      }
      if($key == 'individualOffset'){
        foreach ($value as $valor) {
            $individualOffset[] = $valor;
        }
      }
      if($key == 'interFreqFddMeasIndicator'){
        foreach ($value as $valor) {
            $interFreqFddMeasIndicator[] = $valor;
        }
      }
      if($key == 'interPwrMax'){
        foreach ($value as $valor) {
            $interPwrMax[] = $valor;
        }
      }
      if($key == 'loadBasedHoSupport'){
        foreach ($value as $valor) {
            $loadBasedHoSupport[] = $valor;
        }
      }
      if($key == 'loadBasedHoType'){
        foreach ($value as $valor) {
            $loadBasedHoType[] = $valor;
        }
      }
      if($key == 'loadSharingGsmFraction'){
        foreach ($value as $valor) {
            $loadSharingGsmFraction[] = $valor;
        }
      }
       if($key == 'loadSharingGsmThreshold'){
        foreach ($value as $valor) {
            $loadSharingGsmThreshold[] = $valor;
        }
      }
       if($key == 'maximumTransmissionPower'){
        foreach ($value as $valor) {
            $maximumTransmissionPower[] = $valor;
        }
      }
       if($key == 'maxPwrMax'){
        foreach ($value as $valor) {
            $maxPwrMax[] = $valor;
        }
      }
       if($key == 'maxRate'){
        foreach ($value as $valor) {
            $maxRate[] = $valor;
        }
      }

      if($key == 'maxTxPowerUl'){
        foreach ($value as $valor) {
            $maxTxPowerUl[] = $valor;
        }
      }
      if($key == 'minimumRate'){
        foreach ($value as $valor) {
            $minimumRate[] = $valor;
        }
      }
      if($key == 'minPwrMax'){
        foreach ($value as $valor) {
            $minPwrMax[] = $valor;
        }
      }
      if($key == 'minPwrRl'){
        foreach ($value as $valor) {
            $minPwrRl[] = $valor;
        }
      }
      if($key == 'nOutSyncInd'){
        foreach ($value as $valor) {
            $nOutSyncInd[] = $valor;
        }
      }
      if($key == 'hsdschInactivityTimerCpc'){
        foreach ($value as $valor) {
            $hsdschInactivityTimerCpc[] = $valor;
        }
      }
      if($key == 'loadSharingMargin'){
        foreach ($value as $valor) {
            $loadSharingMargin[] = $valor;
        }
      }
      
       if($key == 'pagingPermAccessCtrl_locRegAcb'){
        foreach ($value as $valor) {
            $locRegAcb[] = $valor;
        }
      }
      if($key == 'pagingPermAccessCtrl_locRegRestr'){
        foreach ($value as $valor) {
            $locRegRestr[] = $valor;
        }
      }
      if($key == 'pagingPermAccessCtrl_pagingRespRestr'){
        foreach ($value as $valor) {
            $pagingRespRestr[] = $valor;
        }
      }

      if($key == 'interRate'){
        foreach ($value as $valor) {
            $interRate[] = $valor;
        }
      }

      if($key == 'uarfcnUl'){
        foreach ($value as $valor) {         
          $continido_1_3_1[] ="
////////////////////////////////////////////////////////////
//                     ".$Utrancell[$contar]."                            ///
////////////////////////////////////////////////////////////
CREATE
(
  parent ".'"ManagedElement=1,RncFunction=1"'."
  identity ".'"'.$Utrancell[$contar].'"'."
  moType UtranCell
   exception none
   nrOfAttributes 10
   localCellId Integer ".$cellBroadcastSac[$contar]."
   cId Integer ".$cId[$contar]."
   tCell Integer  ".$tCell[$contar]."
   uarfcnUl Integer ".$valor."
   uarfcnDl Integer ".$uarfcnDl[$contar]."
   primaryScramblingCode Integer ".$primaryScramblingCode[$contar]."
   sib1PlmnScopeValueTag Integer 1
   locationAreaRef Ref ".'"ManagedElement=1,RncFunction=1,LocationArea='.$lac[$contar].'"'."
   serviceAreaRef Ref ".'"ManagedElement=1,RncFunction=1,LocationArea='.$lac[$contar].',ServiceArea='.$cellBroadcastSac[$contar].'"'."
   iubLinkRef Ref ".'"ManagedElement=1,RncFunction=1,IubLink=Iub_'.$this->nombre.'"'."
)
";
          $continido_1_3_1[] .= $this->Crear_cuerpo_dos($Utrancell[$contar]);
          $continido_1_3_1[] .= $this->Crear_cuerpo_3($Utrancell[$contar], $absPrioCellRes_cellReselectionPriority[$contar], $absPrioCellRes_sPrioritySearch1[$contar], $absPrioCellRes_sPrioritySearch2[$contar], $absPrioCellRes_threshServingLow[$contar]);
          $continido_1_3_1[] .= $this->Crear_cuerpo_4($Utrancell[$contar], $accessClassesBarredCs[$contar], $accessClassesBarredPs[$contar], $accessClassNBarred[$contar]);
          $continido_1_3_1[] .= $this->Crear_cuerpo_5($Utrancell[$contar], $admBlockRedirection_gsmRrc[$contar], $admBlockRedirection_speech[$contar], $admBlockRedirection_speech[$contar]);
          $continido_1_3_1[] .= $this->Crear_cuerpo_6($Utrancell[$contar], $agpsEnabled[$contar], $amrNbSelector[$contar], $amrWbRateDlMax[$contar], $amrWbRateUlMax[$contar]);
          $continido_1_3_1[] .= $this->Crear_cuerpo_7($Utrancell[$contar], $anrEnabled[$contar], $relationAddEnabled[$contar], $latitudeSign[$contar], $latitude[$contar], $longitude[$contar], $aseDlAdm[$contar],  $amr12200[$contar], $amr7950[$contar], $amr5900[$contar], $amrWb8850[$contar], $amrWb12650[$contar]);
          $continido_1_3_1[] .= $this->Crear_cuerpo_8($Utrancell[$contar], $aseUlAdm[$contar], $bchPower[$contar], $cbsSchedulePeriodLength[$contar],$cellBroadcastSac[$contar],$cellReserved[$contar],$cId[$contar],$codeLoadThresholdDlSf128[$contar], $compModeAdm[$contar], $cpcSupport[$contar], $ctchAdmMargin[$contar], $ctchOccasionPeriod[$contar]);
          $continido_1_3_1[] .= $this->Crear_cuerpo_9($Utrancell[$contar], $cyclicAcb_acbEnabled[$contar], $cyclicAcb_rotationGroupSize[$contar], $cyclicAcbCs_acbEnabled[$contar], $cyclicAcbCs_rotationGroupSize[$contar], $cyclicAcbPs_acbEnabled[$contar], $cyclicAcbPs_rotationGroupSize[$contar]);
          $continido_1_3_1[] .= $this->Crear_cuerpo_10($Utrancell[$contar], $dchIflsMarginCode[$contar], $dchIflsMarginPower[$contar], $dchIflsThreshCode[$contar], $dchIflsThreshPower[$contar], $dlCodeAdm[$contar], $dlCodeOffloadLimit[$contar], $dlPowerOffloadLimit[$contar], $dmcrEnabled[$contar], $dnclEnabled[$contar], $downswitchTimer[$contar], $eulNonServingCellUsersAdm[$contar], $eulServingCellUsersAdm[$contar], $eulServingCellUsersAdmTti2[$contar], $fachMeasOccaCycLenCoeff[$contar], $fdpchSupport[$contar], $ganHoEnabled[$contar], $hardIfhoCorr[$contar]);
          $continido_1_3_1[] .= $this->Crear_cuerpo_11($Utrancell[$contar], $hcsPrio[$contar], $qHcs[$contar], $sSearchHcs[$contar], $connectedMode[$contar], $idleMode[$contar]);
          $continido_1_3_1[] .= $this->Crear_cuerpo_12($Utrancell[$contar], $hoType[$contar], $hsdpaUsersAdm[$contar], $hsdpaUsersOffloadLimit[$contar], $hsdpaUsersAdm[$contar]
    , $hsdschInactivityTimer[$contar], $hsdschInactivityTimerCpc[$contar]);
          $continido_1_3_1[] .= $this->Crear_cuerpo_13($Utrancell[$contar], $fastDormancy[$contar], $qHcs[$contar], $toFach[$contar], $toUra[$contar]);
          $continido_1_3_1[] .= $this->Crear_cuerpo_14($Utrancell[$contar], $hsIflsHighLoadThresh[$contar], $hsIflsMarginUsers[$contar], $hsIflsPowerLoadThresh[$contar], $hsIflsRedirectLoadLimit[$contar],$hsIflsSpeechMultiRabTrigg[$contar],$hsIflsThreshUsers[$contar]);
          $continido_1_3_1[] .= $this->Crear_cuerpo_15($Utrancell[$contar], $fromFach[$contar], $fromUra[$contar]);
          $continido_1_3_1[] .= $this->Crear_cuerpo_16($Utrancell[$contar], $iFCong[$contar], $iFHyst[$contar], $iflsCpichEcnoThresh[$contar],$iflsMode[$contar],$iflsRedirectUarfcn[$contar],$inactivityTimeMultiPsInteractive[$contar],$inactivityTimer[$contar],$inactivityTimerEnhUeDrx[$contar],$inactivityTimerPch[$contar],$individualOffset[$contar],$interFreqFddMeasIndicator[$contar],$interPwrMax[$contar],$loadBasedHoSupport[$contar],$loadBasedHoType[$contar],$loadSharingGsmFraction[$contar],$loadSharingGsmThreshold[$contar],$maximumTransmissionPower[$contar],$maxPwrMax[$contar],$maxRate[$contar],$maxTxPowerUl[$contar],$minimumRate[$contar],$minPwrMax[$contar],$minPwrRl[$contar],$nOutSyncInd[$contar], $loadSharingMargin[$contar], $interRate[$contar]);
          $continido_1_3_1[] .= $this->Crear_cuerpo_17($Utrancell[$contar], $locRegAcb[$contar], $locRegRestr[$contar], $pagingRespRestr[$contar]);
          $continido_1_3_1[] .= $this->Crear_cuerpo_18($Utrancell[$contar]);
          $continido_1_3_1[] .= $this->Crear_cuerpo_19($Utrancell[$contar]);
          $continido_1_3_1[] .= $this->Crear_cuerpo_20($Utrancell[$contar]);
          $continido_1_3_1[] .= $this->Crear_cuerpo_21($Utrancell[$contar]);
          $continido_1_3_1[] .= $this->Crear_cuerpo_22($Utrancell[$contar]);
          $continido_1_3_1[] .= $this->Crear_cuerpo_23($Utrancell[$contar]);
          $continido_1_3_1[] .= $this->Crear_cuerpo_24($Utrancell[$contar]);
          $continido_1_3_1[] .= $this->Crear_cuerpo_25($Utrancell[$contar]);
          $continido_1_3_1[] .= $this->Crear_cuerpo_26($Utrancell[$contar]);
          $continido_1_3_1[] .= $this->Crear_cuerpo_27($Utrancell[$contar]);
          $continido_1_3_1[] .= $this->Crear_cuerpo_28($Utrancell[$contar]);
          $continido_1_3_1[] .= $this->Crear_cuerpo_29($Utrancell[$contar], $p_3_2);
          $continido_1_3_1[] .= $this->Crear_cuerpo_30($Utrancell[$contar], $p_3_3);
          $continido_1_3_1[] .= $this->Crear_cuerpo_31($Utrancell[$contar], $p_3_4);
          $continido_1_3_1[] .= $this->Crear_cuerpo_32($Utrancell[$contar], $p_3_5);
          $contar++;         
        }
      }

      if($key == 'uarfcnDl'){
        foreach ($value as $valor) {        
           $uarfcnDl[] = $valor;
        }
      }

      if($key == 'primaryScramblingCode'){
        foreach ($value as $valor) {
          $primaryScramblingCode[] = $valor;
        }
      }

      if($key == 'sib1PlmnScopeValueTag'){
        foreach ($value as $valor) {
          $sib1PlmnScopeValueTag[] = $valor;
        }
      }
    }
		return $continido_1_3_1;
	}

  protected function Crear_cuerpo_dos($UtranCell){
    $continido_1_3_1 ='
//SET
//(
//   mo "ManagedElement=1,RncFunction=1,UtranCell='.$UtranCell.'"
//   exception none
//   administrativeState Integer 1
//)
';
    return $continido_1_3_1;
  }

  protected function Crear_cuerpo_3($UtranCell, $cellReselectionPriority, $sPrioritySearch1, $sPrioritySearch2, $threshServingLow){
    $continido_1_3_1 ='
SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell='.$UtranCell.'"
   exception none
   absPrioCellRes Struct
      nrOfElements 4
         cellReselectionPriority Integer 3
         sPrioritySearch1 Integer 22
         sPrioritySearch2 Integer 4
         threshServingLow Integer 16
)
';
    return $continido_1_3_1;
  }

  protected function Crear_cuerpo_4($UtranCell, $accessClassesBarredCs, $accessClassesBarredPs, $accessClassNBarred){
    $continido_1_3_1 ='
SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell='.$UtranCell.'"
   exception none
   accessClassesBarredCs Array Integer 16
   '.str_replace(" ", "
    ", $accessClassesBarredCs).' 
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell='.$UtranCell.'"
   exception none
   accessClassesBarredPs Array Integer 16
   '.str_replace(" ", "
    ", $accessClassesBarredPs).' 
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell='.$UtranCell.'"
   exception none
   accessClassNBarred Array Integer 16
   '.str_replace(" ", "
    ", $accessClassNBarred).' 
)
';
    return $continido_1_3_1;
  }

  protected function Crear_cuerpo_5($UtranCell, $gsmRrc, $rrc, $speech){
    $continido_1_3_1 ='
SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell='.$UtranCell.'"
   exception none
   admBlockRedirection Struct
      nrOfElements 3
         gsmRrc Integer '.$gsmRrc.'
         rrc Integer '.$rrc.'
         speech Integer '.$speech.'
)
';
    return $continido_1_3_1;
  }

  protected function Crear_cuerpo_6($UtranCell, $agpsEnabled, $amrNbSelector, $amrWbRateDlMax, $amrWbRateUlMax){
    $continido_1_3_1 ='
SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell='.$UtranCell.'"
   exception none
   agpsEnabled Integer '.$agpsEnabled.'
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell='.$UtranCell.'"
   exception none
   amrNbSelector Integer '.$amrNbSelector.'
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell='.$UtranCell.'"
   exception none
   amrWbRateDlMax Integer '.$amrWbRateDlMax.'
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell='.$UtranCell.'"
   exception none
   amrWbRateUlMax Integer '.$amrWbRateUlMax.'
)

//SET
//(
//   mo "ManagedElement=1,RncFunction=1,UtranCell='.$UtranCell.'"
//   exception none
//   anrBlackList Integer 
//)
';
    return $continido_1_3_1;
  }

  protected function Crear_cuerpo_7($UtranCell, $anrEnabled, $relationAddEnabled, $latitudeSign, $latitude, $longitude, $aseDlAdm,  $amr12200, $amr7950, $amr5900, $amrWb8850, $amrWb12650){
    $continido_1_3_1 ='
SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell='.$UtranCell.'"
   exception none
   anrIafUtranCellConfig Struct
      nrOfElements 2
         anrEnabled Integer '.$anrEnabled.'
         relationAddEnabled Integer '.$relationAddEnabled.'
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell='.$UtranCell.'"
   exception none
   antennaPosition Struct
      nrOfElements 3
         latitudeSign Integer '.$latitudeSign.'
         latitude Integer '.round($latitude,0, PHP_ROUND_HALF_DOWN).'
         longitude Integer '.round($longitude, 0, PHP_ROUND_HALF_DOWN).'
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell='.$UtranCell.'"
   exception none
   aseDlAdm Integer '.$aseDlAdm.'
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell='.$UtranCell.'"
   exception none
   aseLoadThresholdUlSpeech Struct
      nrOfElements 5
         amr12200 Integer '.$amr12200.'
         amr7950 Integer '.$amr7950.'
         amr5900 Integer '.$amr5900.'
         amrWb8850 Integer '.$amrWb8850.'
         amrWb12650 Integer '.$amrWb12650.'
)
';
    return $continido_1_3_1;
  }

    protected function Crear_cuerpo_8($UtranCell, $aseUlAdm, $bchPower, $cbsSchedulePeriodLength,$cellBroadcastSac,$cellReserved,$cId,$codeLoadThresholdDlSf128, $compModeAdm, $cpcSupport, $ctchAdmMargin, $ctchOccasionPeriod){
    $continido_1_3_1 ='
SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell='.$UtranCell.'"
   exception none
   aseUlAdm Integer '.$aseUlAdm.'
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell='.$UtranCell.'"
   exception none
   bchPower Integer '.$bchPower.'
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell='.$UtranCell.'"
   exception none
   cbsSchedulePeriodLength Integer '.$cbsSchedulePeriodLength.'
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell='.$UtranCell.'"
   exception none
   cellBroadcastSac Integer '.$cellBroadcastSac.'
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell='.$UtranCell.'"
   exception none
   cellReserved Integer '.$cellReserved.'
)

//SET
//(
//   mo "ManagedElement=1,RncFunction=1,UtranCell='.$UtranCell.'"
//   exception none
//   cId Integer '.$cId.'
//)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell='.$UtranCell.'"
   exception none
   codeLoadThresholdDlSf128 Integer '.$codeLoadThresholdDlSf128.'
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell='.$UtranCell.'"
   exception none
   compModeAdm Integer '.$compModeAdm.'
)

//SET
//(
//   mo "ManagedElement=1,RncFunction=1,UtranCell='.$UtranCell.'"
//   exception none
//   cpcSupport Integer '.$cpcSupport.'
//)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell='.$UtranCell.'"
   exception none
   ctchAdmMargin Integer '.$ctchAdmMargin.'
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell='.$UtranCell.'"
   exception none
   ctchOccasionPeriod Integer '.$ctchOccasionPeriod.'
)
';
    return $continido_1_3_1;
  }

  protected function Crear_cuerpo_9($UtranCell, $cyclicAcb_acbEnabled, $cyclicAcb_rotationGroupSize, $cyclicAcbCs_acbEnabled, $cyclicAcbCs_rotationGroupSize, $cyclicAcbPs_acbEnabled, $cyclicAcbPs_rotationGroupSize){
    $continido_1_3_1 ='
SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell='.$UtranCell.'"
   exception none
   cyclicAcb Struct
      nrOfElements 2
         acbEnabled Integer '.$cyclicAcb_acbEnabled.'
         rotationGroupSize Integer '.$cyclicAcb_rotationGroupSize.'
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell='.$UtranCell.'"
   exception none
   cyclicAcbCs Struct
      nrOfElements 2
         acbEnabled Integer '.$cyclicAcbCs_acbEnabled.'
         rotationGroupSize Integer '.$cyclicAcbCs_rotationGroupSize.'
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell='.$UtranCell.'"
   exception none
   cyclicAcbPs Struct
      nrOfElements 2
         acbEnabled Integer '.$cyclicAcbPs_acbEnabled.'
         rotationGroupSize Integer '.$cyclicAcbPs_rotationGroupSize.'
)
';
    return $continido_1_3_1;
  }

  protected function Crear_cuerpo_10($UtranCell, $dchIflsMarginCode, $dchIflsMarginPower, $dchIflsThreshCode, $dchIflsThreshPower, $dlCodeAdm, $dlCodeOffloadLimit, $dlPowerOffloadLimit, $dmcrEnabled, $dnclEnabled, $downswitchTimer, $eulNonServingCellUsersAdm, $eulServingCellUsersAdm, $eulServingCellUsersAdmTti2, $fachMeasOccaCycLenCoeff, $fdpchSupport, $ganHoEnabled, $hardIfhoCorr){
    $continido_1_3_1 ='
SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell='.$UtranCell.'"
   exception none
   dchIflsMarginCode Integer '.$dchIflsMarginCode.'
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell='.$UtranCell.'"
   exception none
   dchIflsMarginPower Integer '.$dchIflsMarginPower.'
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell='.$UtranCell.'"
   exception none
   dchIflsThreshCode Integer '.$dchIflsThreshCode.'
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell='.$UtranCell.'"
   exception none
   dchIflsThreshPower Integer '.$dchIflsThreshPower.'
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell='.$UtranCell.'"
   exception none
   dlCodeAdm Integer '.$dlCodeAdm.'
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell='.$UtranCell.'"
   exception none
   dlCodeOffloadLimit Integer '.$dlCodeOffloadLimit.'
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell='.$UtranCell.'"
   exception none
   dlPowerOffloadLimit Integer '.$dlPowerOffloadLimit.'
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell='.$UtranCell.'"
   exception none
   dmcrEnabled Integer '.$dmcrEnabled.'
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell='.$UtranCell.'"
   exception none
   dnclEnabled Integer '.$dnclEnabled.'
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell='.$UtranCell.'"
   exception none
   downswitchTimer Integer '.$downswitchTimer.'
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell='.$UtranCell.'"
   exception none
   eulNonServingCellUsersAdm Integer '.$eulNonServingCellUsersAdm.'
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell='.$UtranCell.'"
   exception none
   eulServingCellUsersAdm Integer '.$eulServingCellUsersAdm.'
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell='.$UtranCell.'"
   exception none
   eulServingCellUsersAdmTti2 Integer '.$eulServingCellUsersAdmTti2.'
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell='.$UtranCell.'"
   exception none
   fachMeasOccaCycLenCoeff Integer '.$fachMeasOccaCycLenCoeff.'
)

//SET
//(
//   mo "ManagedElement=1,RncFunction=1,UtranCell='.$UtranCell.'"
//   exception none
//   fdpchSupport Integer '.$fdpchSupport.'
//)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell='.$UtranCell.'"
   exception none
   ganHoEnabled Integer '.$ganHoEnabled.'
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell='.$UtranCell.'"
   exception none
   hardIfhoCorr Integer '.$hardIfhoCorr.'
)
';
    return $continido_1_3_1;
  }

  protected function Crear_cuerpo_11($UtranCell, $hcsPrio, $qHcs, $sSearchHcs, $connectedMode
    , $idleMode){
    $continido_1_3_1 ='
SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell='.$UtranCell.'"
   exception none
   hcsSib3Config Struct
      nrOfElements 3
         hcsPrio Integer '.$hcsPrio.'
         qHcs Integer '.$qHcs.'
         sSearchHcs Integer '.$sSearchHcs.'
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell='.$UtranCell.'"
   exception none
   hcsUsage Struct
      nrOfElements 2
         connectedMode Integer '.$connectedMode.'
         idleMode Integer '.$idleMode.'
)
';
    return $continido_1_3_1;
  }

   protected function Crear_cuerpo_12($UtranCell, $hoType, $hsdpaUsersAdm, $hsdpaUsersOffloadLimit, $hsdpaUsersAdm2
    , $hsdschInactivityTimer, $hsdschInactivityTimerCpc){//revisar con dos variables que son casi iguales
    $continido_1_3_1 ='
SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell='.$UtranCell.'"
   exception none
   hoType Integer '.$hoType.'
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell='.$UtranCell.'"
   exception none
   hsdpaUsersAdm Integer '.$hsdpaUsersAdm.'
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell='.$UtranCell.'"
   exception none
   hsdpaUsersOffloadLimit Integer '.$hsdpaUsersOffloadLimit.'
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell='.$UtranCell.'"
   exception none
   hsdpaUsersAdm Integer '.$hsdpaUsersAdm2.'
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell='.$UtranCell.'"
   exception none
   hsdschInactivityTimer Integer '.$hsdschInactivityTimer.'
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell='.$UtranCell.'"
   exception none
   hsdschInactivityTimerCpc Integer '.$hsdschInactivityTimerCpc.'
)
';
    return $continido_1_3_1;
  }

  protected function Crear_cuerpo_13($UtranCell, $fastDormancy, $qHcs, $toFach, $toUra){
    $continido_1_3_1 ='
SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell='.$UtranCell.'"
   exception none
   hsIflsDownswitchTrigg Struct
      nrOfElements 3
         fastDormancy Integer '.$fastDormancy.'
         toFach Integer '.$toFach.'
         toUra Integer '.$toUra.'
)
';
    return $continido_1_3_1;
  }

    protected function Crear_cuerpo_14($UtranCell, $hsIflsHighLoadThresh, $hsIflsMarginUsers, $hsIflsPowerLoadThresh, $hsIflsRedirectLoadLimit,$hsIflsSpeechMultiRabTrigg,$hsIflsThreshUsers){
    $continido_1_3_1 ='
SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell='.$UtranCell.'"
   exception none
   hsIflsHighLoadThresh Integer '.$hsIflsHighLoadThresh.'
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell='.$UtranCell.'"
   exception none
   hsIflsMarginUsers Integer '.$hsIflsMarginUsers.'
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell='.$UtranCell.'"
   exception none
   hsIflsPowerLoadThresh Integer '.$hsIflsPowerLoadThresh.'
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell='.$UtranCell.'"
   exception none
   hsIflsRedirectLoadLimit Integer '.$hsIflsRedirectLoadLimit.'
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell='.$UtranCell.'"
   exception none
   hsIflsSpeechMultiRabTrigg Integer '.$hsIflsSpeechMultiRabTrigg.'
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell='.$UtranCell.'"
   exception none
   hsIflsThreshUsers Integer '.$hsIflsThreshUsers.'
)
';
    return $continido_1_3_1;
  }

  protected function Crear_cuerpo_15($UtranCell, $fromFach, $fromUra){
    $continido_1_3_1 ='
SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell='.$UtranCell.'"
   exception none
   hsIflsTrigger Struct
      nrOfElements 2
         fromFach Integer '.$fromFach.'
         fromUra Integer '.$fromUra.'
)
';
    return $continido_1_3_1;
  }

  protected function Crear_cuerpo_16($UtranCell, $iFCong, $iFHyst, $iflsCpichEcnoThresh,$iflsMode,$iflsRedirectUarfcn,$inactivityTimeMultiPsInteractive,$inactivityTimer,$inactivityTimerEnhUeDrx,$inactivityTimerPch,$individualOffset,$interFreqFddMeasIndicator,$interPwrMax,$loadBasedHoSupport,$loadBasedHoType,$loadSharingGsmFraction,$loadSharingGsmThreshold,$maximumTransmissionPower,$maxPwrMax,$maxRate,$maxTxPowerUl,$minimumRate,$minPwrMax,$minPwrRl,$nOutSyncInd,$loadSharingMargin, $interRate){
    $continido_1_3_1 ='
SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell='.$UtranCell.'"
   exception none
   iFCong Integer '.$iFCong.'
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell='.$UtranCell.'"
   exception none
   iFHyst Integer '.$iFHyst.'
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell='.$UtranCell.'"
   exception none
   iflsCpichEcnoThresh Integer '.$iflsCpichEcnoThresh.'
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell='.$UtranCell.'"
   exception none
   iflsMode Integer '.$iflsMode.'
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell='.$UtranCell.'"
   exception none
   iflsRedirectUarfcn Integer '.$iflsRedirectUarfcn.'
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell='.$UtranCell.'"
   exception none
   inactivityTimeMultiPsInteractive Integer '.$inactivityTimeMultiPsInteractive.'
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell='.$UtranCell.'"
   exception none
   inactivityTimer Integer '.$inactivityTimer.'
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell='.$UtranCell.'"
   exception none
   inactivityTimerEnhUeDrx Integer '.$inactivityTimerEnhUeDrx.'
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell='.$UtranCell.'"
   exception none
   inactivityTimerPch Integer '.$inactivityTimerPch.'
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell='.$UtranCell.'"
   exception none
   individualOffset Integer '.$individualOffset.'
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell='.$UtranCell.'"
   exception none
   interFreqFddMeasIndicator Integer '.$interFreqFddMeasIndicator.'
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell='.$UtranCell.'"
   exception none
   interPwrMax Integer '.$interPwrMax.'
)

//SET
//(
//   mo "ManagedElement=1,RncFunction=1,UtranCell='.$UtranCell.'"
//   exception none
//   iubLinkRef Integer IubLink=Iub_'.$UtranCell.'
//)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell='.$UtranCell.'"
   exception none
   loadBasedHoSupport Integer '.$loadBasedHoSupport.'
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell='.$UtranCell.'"
   exception none
   loadBasedHoType Integer '.$loadBasedHoType.'
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell='.$UtranCell.'"
   exception none
   loadSharingGsmFraction Integer '.$loadSharingGsmFraction.'
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell='.$UtranCell.'"
   exception none
   loadSharingGsmThreshold Integer '.$loadSharingGsmThreshold.'
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell='.$UtranCell.'"
   exception none
   loadSharingMargin Integer '.$loadSharingMargin.'
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell='.$UtranCell.'"
   exception none
   maximumTransmissionPower Integer '.$maximumTransmissionPower.'
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell='.$UtranCell.'"
   exception none
   maxPwrMax Integer '.$maxPwrMax.'
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell='.$UtranCell.'"
   exception none
   maxRate Integer '.$maxRate.'
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell='.$UtranCell.'"
   exception none
   interRate Integer '.$interRate.'
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell='.$UtranCell.'"
   exception none
   maxTxPowerUl Integer '.$maxTxPowerUl.'
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell='.$UtranCell.'"
   exception none
   minimumRate Integer '.$minimumRate.'
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell='.$UtranCell.'"
   exception none
   minPwrMax Integer '.$minPwrMax.'
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell='.$UtranCell.'"
   exception none
   minPwrRl Integer '.$minPwrRl.'
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell='.$UtranCell.'"
   exception none
   nOutSyncInd Integer '.$nOutSyncInd.'
)
';
    return $continido_1_3_1;
  }

  protected function Crear_cuerpo_17($UtranCell, $locRegAcb, $locRegRestr, $pagingRespRestr){
    $continido_1_3_1 ='
SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell='.$UtranCell.'"
   exception none
   pagingPermAccessCtrl Struct
      nrOfElements 3
         locRegAcb Array Integer 15 '.$locRegAcb.'
         locRegRestr Integer '.$locRegRestr.'
         pagingRespRestr Integer '.$pagingRespRestr.'
)
';
    return $continido_1_3_1;
  }

  protected function Crear_cuerpo_18($UtranCell){
    $continido_1_3_1 = '
SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell='.$UtranCell.'"
   exception none
   pathlossThreshold Integer 130
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell='.$UtranCell.'"
   exception none
   primaryCpichPower Integer 290
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell='.$UtranCell.'"
   exception none
   primarySchPower Integer -18
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell='.$UtranCell.'"
   exception none
   pwrAdm Integer 89
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell='.$UtranCell.'"
   exception none
   pwrHyst Integer 300
)
';
   
    return $continido_1_3_1;
  }

  protected function Crear_cuerpo_19($UtranCell){
    $continido_1_3_1 = '
SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell='.$UtranCell.'"
   exception none
   pwrLoadThresholdDlSpeech Struct
      nrOfElements 5
         amr12200 Integer 100
         amr5900 Integer 100
         amr7950 Integer 100
         amrWb12650 Integer 100
         amrWb8850 Integer 100
)
';
   
    return $continido_1_3_1;
  }

  protected function Crear_cuerpo_20($UtranCell){
    $continido_1_3_1 = '
SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell='.$UtranCell.'"
   exception none
   pwrOffset Integer 11
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell='.$UtranCell.'"
   exception none
   qHyst1 Integer 2
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell='.$UtranCell.'"
   exception none
   qHyst2 Integer 2
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell='.$UtranCell.'"
   exception none
   qQualMin Integer -18
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell='.$UtranCell.'"
   exception none
   qRxLevMin Integer -113
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell='.$UtranCell.'"
   exception none
   qualMeasQuantity Integer 2
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell='.$UtranCell.'"
   exception none
   routingAreaRef Ref "ManagedElement=1,RncFunction=1,LocationArea=31312,RoutingArea=162"
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell='.$UtranCell.'"
   exception none
   dlCodePowerCmEnabled Integer 0
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell='.$UtranCell.'"
   exception none
   eulMcServingCellUsersAdmTti2 Integer 3
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell='.$UtranCell.'"
   exception none
   primaryTpsCell Integer 0
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell='.$UtranCell.'"
   exception none
   rwrEutraCc Integer 0
)
';
   
    return $continido_1_3_1;
  }

  protected function Crear_cuerpo_21($UtranCell){
    $continido_1_3_1 = '
SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell='.$UtranCell.'"
   exception none
   tpsCellThresholds Struct
      nrOfElements 3
         tpsCellThreshEnabled Integer 0
         tpsLockThreshold Integer 5
         tpsUnlockThreshold Integer 5
)
';
   
    return $continido_1_3_1;
  }

  protected function Crear_cuerpo_22($UtranCell){
    $continido_1_3_1 = '
SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell='.$UtranCell.'"
   exception none
   rachOverloadProtect Integer 1
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell='.$UtranCell.'"
   exception none
   ifIratHoPsIntHsEnabled Integer 1
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell='.$UtranCell.'"
   exception none
   cellUpdateConfirmCsInitRepeat Integer 3
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell='.$UtranCell.'"
   exception none
   cellUpdateConfirmPsInitRepeat Integer 2
)
';
   
    return $continido_1_3_1;
  }

  protected function Crear_cuerpo_23($UtranCell){
    $continido_1_3_1 = '
SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell='.$UtranCell.'"
   exception none
   rateSelectionPsInteractive Struct
      nrOfElements 3
         channelType Integer 0
         dlPrefRate Integer 16
         ulPrefRate Integer 16
)
';
   
    return $continido_1_3_1;
  }

  protected function Crear_cuerpo_24($UtranCell){
    $continido_1_3_1 = '
SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell='.$UtranCell.'"
   exception none
   redirectUarfcn Integer 0
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell='.$UtranCell.'"
   exception none
   releaseAseDl Integer 1
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell='.$UtranCell.'"
   exception none
   releaseAseDlNg Integer 3
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell='.$UtranCell.'"
   exception none
   releaseRedirect Integer 3
)
';
   
    return $continido_1_3_1;
  }

  protected function Crear_cuerpo_25($UtranCell){
    $continido_1_3_1 = '
SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell='.$UtranCell.'"
   exception none
   releaseRedirectEutraTriggers Struct
      nrOfElements 6
         csFallbackCsRelease Integer 0
         csFallbackDchToFach Integer 0
         dchToFach Integer 0
         fachToUra Integer 0
         fastDormancy Integer 0
         normalRelease Integer 0
)
';
   
    return $continido_1_3_1;
  }

  protected function Crear_cuerpo_26($UtranCell){
    $continido_1_3_1 = '
SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell='.$UtranCell.'"
   exception none
   releaseRedirectHsIfls Integer 0
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell='.$UtranCell.'"
   exception none
   reportingRange1a Integer 6
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell='.$UtranCell.'"
   exception none
   reportingRange1b Integer 10
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell='.$UtranCell.'"
   exception none
   rlFailureT Integer 50
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell='.$UtranCell.'"
   exception none
   rrcLcEnabled Integer 1
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell='.$UtranCell.'"
   exception none
   cellBroadcastSac Integer 07451
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell='.$UtranCell.'"
   exception none
   secondaryCpichPower Integer -3
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell='.$UtranCell.'"
   exception none
   secondarySchPower Integer -35
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell='.$UtranCell.'"
   exception none
   servDiffRrcAdmHighPrioProfile Integer 2
)
';
   
    return $continido_1_3_1;
  }

  protected function Crear_cuerpo_27($UtranCell){
    $continido_1_3_1 = '
SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell='.$UtranCell.'"
   exception none
    serviceRestrictions Struct
      nrOfElements 1
         csVideoCalls Integer 0
)
';
   
    return $continido_1_3_1;
  }

  protected function Crear_cuerpo_28($UtranCell){
    $continido_1_3_1 = '
SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell='.$UtranCell.'"
   exception none
   sf128Adm Integer 10
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell='.$UtranCell.'"
   exception none
   sf16Adm Integer 0
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell='.$UtranCell.'"
   exception none
   sf16AdmUl Integer 10
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell='.$UtranCell.'"
   exception none
   sf16gAdm Integer 0
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell='.$UtranCell.'"
   exception none
   sf32Adm Integer 10
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell='.$UtranCell.'"
   exception none
   sf4AdmUl Integer 0
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell='.$UtranCell.'"
   exception none
   sf64AdmUl Integer 50
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell='.$UtranCell.'"
   exception none
   sf8Adm Integer 0
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell='.$UtranCell.'"
   exception none
   sf8AdmUl Integer 0
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell='.$UtranCell.'"
   exception none
   sf8gAdmUl Integer 0
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell='.$UtranCell.'"
   exception none
   sHcsRat Integer 3
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell='.$UtranCell.'"
   exception none
   sInterSearch Integer 19
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell='.$UtranCell.'"
   exception none
   sIntraSearch Integer 0
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell='.$UtranCell.'"
   exception none
   spare Integer 0
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell='.$UtranCell.'"
   exception none
   spareA Array Integer 10
      0
      1
      0
      0
      0
      0
      0
      0
      0
      0
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell='.$UtranCell.'"
   exception none
   sRatSearch Integer 0
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell='.$UtranCell.'"
   exception none
   srbAdmExempt Integer 0
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell='.$UtranCell.'"
   exception none
   standAloneSrbSelector Integer 1
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell='.$UtranCell.'"
   exception none
   timeToTrigger1a Integer -1
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell='.$UtranCell.'"
   exception none
   timeToTrigger1b Integer -1
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell='.$UtranCell.'"
   exception none
   tmCongAction Integer 2000
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell='.$UtranCell.'"
   exception none
   tmCongActionNg Integer 800
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell='.$UtranCell.'"
   exception none
   tmInitialG Integer 3000
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell='.$UtranCell.'"
   exception none
   transmissionScheme Integer 0
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell='.$UtranCell.'"
   exception none
   treSelection Integer 2
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell='.$UtranCell.'"
   exception none
   uraRef Array Reference 1
      "ManagedElement=1,RncFunction=1,Ura=13124"
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell='.$UtranCell.'"
   exception none
   usedFreqThresh2dEcno Integer -18
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell='.$UtranCell.'"
   exception none
   usedFreqThresh2dRscp Integer -109
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell='.$UtranCell.'"
   exception none
   userLabel String "'.$UtranCell.'"
)
';
   
    return $continido_1_3_1;
  }

  protected function Crear_cuerpo_29($UtranCell, $p_3_1){
    $continido_1_3_1 = '
/////////////////////////////////////////////////////////////
//                        RACH                             //
/////////////////////////////////////////////////////////////
CREATE
(
   parent "ManagedElement=1,RncFunction=1,UtranCell='.$UtranCell.'"
   identity "1"
   moType Rach
   exception none
   nrOfAttributes 0
)';
    $contar =0;
    foreach ($p_3_1 as $key => $value) {
      foreach ($value as $key1 => $valor) {
          if($key1 == "Utrancell"){
            @$Utrancell[] = $valor;
          }
      }

      if(@$Utrancell[$contar] == $UtranCell){
        foreach ($value as $key1 => $valor) {
          if($key1 != "RNC" && $key1 != "Site" && $key1 != "Utrancell"){
            $continido_1_3_1 .='
SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell='.$UtranCell.',Rach=1"
   exception none
   '.$key1.' Integer '.$valor.'
)
';
            $contar++;
          }
        }
      }
    }
    $continido_1_3_1 .= '
SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell='.$UtranCell.',Rach=1"
   exception none
   userLabel String "Rach 1"
)';
    return $continido_1_3_1;
  }

  protected function Crear_cuerpo_30($UtranCell, $p_3_1){
    $continido_1_3_1 = '
/////////////////////////////////////////////////////////////
//                        FACH                             //
/////////////////////////////////////////////////////////////
CREATE
(
   parent "ManagedElement=1,RncFunction=1,UtranCell=U07451"
   identity "1"
   moType Fach
   exception none
   nrOfAttributes 0
)';
    $contar =0;
    foreach ($p_3_1 as $key => $value) {
      foreach ($value as $key1 => $valor) {
          if($key1 == "Utrancell"){
            $Utrancell[] = $valor;
          }
      }

      if(@$Utrancell[$contar] == $UtranCell){
        foreach ($value as $key1 => $valor) {
          if($key1 != "RNC" && $key1 != "Site" && $key1 != "Utrancell"){
            $continido_1_3_1 .='
SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell='.$UtranCell.',Fach=1"
   exception none
   '.$key1.' Integer '.$valor.'
)
';
            $contar++;
          }
        }
      }
    }
    $continido_1_3_1 .= '
SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell='.$UtranCell.',Rach=1"
   exception none
   userLabel String "Fach 1"
)';
    return $continido_1_3_1;
  }

  protected function Crear_cuerpo_31($UtranCell, $p_3_1){
    $continido_1_3_1 = '
/////////////////////////////////////////////////////////////
//                        HSDSCH                           //
/////////////////////////////////////////////////////////////
CREATE
(
   parent "ManagedElement=1,RncFunction=1,UtranCell='.$UtranCell.'"
   identity "1"
   moType Hsdsch
   exception none
   nrOfAttributes 0
)';
    $contar =0;
    foreach ($p_3_1 as $key => $value) {
      foreach ($value as $key1 => $valor) {
          if($key1 == "Utrancell"){
            $Utrancell[] = $valor;
          }
      }

      if(@$Utrancell[$contar] == $UtranCell){
        foreach ($value as $key1 => $valor) {
          if($key1 != "RNC" && $key1 != "Site" && $key1 != "Utrancell"){
            $continido_1_3_1 .='
SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell='.$UtranCell.',Hsdsch=1"
   exception none
   '.$key1.' Integer '.$valor.'
)
';
            $contar++;
          }
        }
      }
    }
    $continido_1_3_1 .= '
SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell='.$UtranCell.',Hsdsch=1"
   exception none
   userLabel String "Hsdsch 1"
)';
    return $continido_1_3_1;
  }

  protected function Crear_cuerpo_32($UtranCell, $p_3_1){
    $continido_1_3_1 = '
/////////////////////////////////////////////////////////////
//                          EUL                            //
/////////////////////////////////////////////////////////////
CREATE
(
   parent "ManagedElement=1,RncFunction=1,UtranCell='.$UtranCell.',Hsdsch=1"
   identity "1"
   moType Eul
   exception none
   nrOfAttributes 0
)';
    $contar =0;

       
    foreach ($p_3_1 as $key => $value) {
      foreach ($value as $valor) {
          if($key == "Utrancell"){
            $Utrancell[] = $valor;
          }
      }

      foreach ($value as $valor) {
        //echo $Utrancell[$contar]." == ".$UtranCell;
        //if(@$Utrancell[$contar] == $UtranCell){
          //if($key != "RNC" && $key != "Site" && $key != "Utrancell"){
            //echo $valor;
            $continido_1_3_1 .='
SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell='.$UtranCell.',Hsdsch=1,Eul=1"
   exception none
   '.$key.' Integer '.$valor.'
)
';
            //echo "<br>";
            $contar++;
          //}
       // }
      }
    }
    $continido_1_3_1 .= '
SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell='.$UtranCell.',Hsdsch=1,Eul=1"
   exception none
   userLabel String "Eul 1"
)';
  //die();
    return $continido_1_3_1;
  }

  public function __destruct()
  {
      
  }
}
	
?>