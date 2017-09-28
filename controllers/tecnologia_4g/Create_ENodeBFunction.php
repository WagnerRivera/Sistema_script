<?php
require_once("../Control_Archivo.php");
/////////////////////////////////////////////////////////////////////////
//Clase para la contruccion de la estrctura de los archivos xml, mos y mo
//Fecha de creacion: 29-05-2017
//Creador por: Wagner Rivera
//Fecha de Modificación: 01-06-2017
////////////////////////////////////////////////////////////////////////
class Create_ENodeBFunction extends Control_Archivos
{
    private $ruta    = "archivos/ENodoB/ENodoB_";
    private $name1 = "/03_";
    private $name2 = "_Create_ENodeBFunction_";
	
	public function __construct($parametros)
	{
    //var_dump($parametros);
        $this->nombre  = @$parametros["AdmissionControl"]["Site"]["2"];
        $this->CREATE_AREA_($parametros);
	}
	/////////////////////////////////////////////////////////////////////////
	//Metodo para la creacion del archivo siteinstall el primero de la lista
	//Fecha de creacion: 29-05-2017
	//Creador por: Wagner Rivera
	//Fecha de Modificación: 01-06-2017
	////////////////////////////////////////////////////////////////////////	
	public function CREATE_AREA_($array)
	{
		
		$cinsert ='#########################################
# - Mo shell version: 
# - File name: 04_RN_ENBF_MAM792_ENTEL_CHILE_BB_Entel_Chile_2017_04_07T18_16_26Z.mos
# - Creation date: '.$this->Fechas().'
# - User ID: INCOBECH
# - Node name: '.$this->nombre.'
#########################################

confb+
gs+

crn ENodeBFunction=1
';
      $contar =0;
      foreach ($array as $key => $value) {
        foreach ($value as $key1 => $value1) {
          foreach ($value1 as $f => $valor) {          
            if($key == 'ENodeBFunction'){
              if($key1 == 'eNodeBPlmnId_mcc'){
                if(!empty($valor))
                  $eNodeBPlmnId_mcc[] = $valor;
              }

              if($key1 == 'eNodeBPlmnId_mnc'){
                if(isset($valor))
                  $eNodeBPlmnId_mnc[] = $valor;
              }

              if($key1 == 'eNodeBPlmnId_mncLength'){
                if(!empty($valor)){
                  $cinsert .='eNodeBPlmnId mcc='.$eNodeBPlmnId_mcc[$contar].',mnc='.$eNodeBPlmnId_mnc[$contar].',mncLength='.$valor.'';
                  $contar++;
                }
              }

              if($key1 == "alignTtiBundWUlTrigSinr"){
                if(isset($valor)){
                  $cinsert0 ='
'.$key1.' '.$valor;
                }
              }

              if($key1 == "biasThpWifiMobility"){
                if(isset($valor)){
                  $cinsert1 ='
'.$key1.' '.$valor;
                }
              }

              if($key1 == "caAwareMfbiIntraCellHo"){
                if(isset($valor)){
                  $cinsert2 ='
'.$key1.' '.$valor;
                }
              }

              if($key1 == "checkEmergencySoftLock"){
                if(isset($valor)){
                  $cinsert3 ='
'.$key1.' '.$valor;
                }
              }

              if($key1 == "combCellSectorSelectThreshRx"){
                if(isset($valor)){
                  $cinsert4 ='
'.$key1.' '.$valor;
                }
              }

              if($key1 == "combCellSectorSelectThreshTx"){
                if(isset($valor)){
                  $cinsert5 ='
'.$key1.' '.$valor;
                }
              }

              if($key1 == "csfbMeasFromIdleMode"){
                if(isset($valor)){
                  $cinsert6 ='
'.$key1.' '.$valor;
                }
              }

              if($key1 == "dlMaxWaitingTimeGlobal"){
                if(isset($valor)){
                  $cinsert7 ='
'.$key1.' '.$valor;
                }
              }

              if($key1 == "dnsLookupOnTai"){
                if(isset($valor)){
                  $cinsert8 ='
'.$key1.' '.$valor;
                }
              }

              if($key1 == "dnsLookupTimer"){
                if(isset($valor)){
                  $cinsert9 ='
'.$key1.' '.$valor;
                }
              }

              if($key1 == "dscpLabel"){
                if(isset($valor)){
                  $cinsert10 ='
'.$key1.' '.$valor;
                }
              }

              if($key1 == "enabledUlTrigMeas"){
                if(isset($valor)){
                  $cinsert11 ='
'.$key1.' '.$valor;
                }
              }

              if($key1 == "eNBId"){
                if(isset($valor)){
                  $cinsert12 ='
'.$key1.' '.$valor;
                }
              }

              if($key1 == "forcedSiTunnelingActive"){
                if(isset($valor)){
                  $cinsert13 ='
'.$key1.' '.$valor;
                }
              }

              if($key1 == "gtpuErrorIndicationDscp"){
                if(isset($valor)){
                  $cinsert14 ='
'.$key1.' '.$valor;
                }
              }

              if($key1 == "initPreschedulingEnable"){
                if(isset($valor)){
                  $cinsert15 ='
'.$key1.' '.$valor;
                }
              }

              if($key1 == "licCapDistrMethod"){
                if(isset($valor)){
                  $cinsert16 ='
'.$key1.' '.$valor;
                }
              }

              if( $key1 == "licConnectedUsersPercentileConf" ||
                  $key1 == "licDlBbPercentileConf" ||
                  $key1 == "licDlPrbPercentileConf"  ||
                  $key1 == "licUlBbPercentileConf" ||
                  $key1 == "licUlPrbPercentileConf"){
                if(isset($valor)){
                  @$cinsert17 .='
'.$key1.' '.$valor;
                }
              }

              if($key1 == "maxRandc"){
                if(isset($valor)){
                  $cinsert18 ='
'.$key1.' '.$valor;
                }
              }

              if($key1 == "measuringEcgiWithAgActive"){
                if(isset($valor)){
                  $cinsert19 ='
'.$key1.' '.$valor;
                }
              }

              if($key1 == "mfbiSupportPolicy"){
                if(isset($valor)){
                  $cinsert20 ='
'.$key1.' '.$valor;
                }
              }

              if($key1 == "minRandc"){
                if(isset($valor)){
                  $cinsert21 ='
'.$key1.' '.$valor;
                }
              }

              if($key1 == "mtRreWithoutNeighborActive"){
                if(isset($valor)){
                  $cinsert021 ='
'.$key1.' '.$valor;
                }
              }

              if($key1 == "nnsfMode"){
                if(isset($valor)){
                  $cinsert22 ='
'.$key1.' '.$valor;
                }
              }

              if($key1 == "prioritizeAdditionalBands"){
                if(isset($valor)){
                  $cinsert23 ='
'.$key1.' '.$valor;
                }
              }

              if($key1 == "pwsPersistentStorage"){
                if(isset($valor)){
                  $cinsert24 ='
'.$key1.' '.$valor;
                }
              }

              if($key1 == "randUpdateInterval"){
                if(isset($valor)){
                  $cinsert023 ='
'.$key1.' '.$valor;
                }
              }

              if($key1 == "releaseInactiveUesInactTime"){
                if(isset($valor)){
                  $cinsert024 ='
'.$key1.' '.$valor;
                }
              }


              if($key1 == "rrcConnReestActive"){
                if(isset($valor)){
                  $cinsert26 ='
'.$key1.' '.$valor;
                }
              }

              if( $key1 == "releaseInactiveUesMpLoadLevel"){
                if(isset($valor)){
                  $cinsert25 ='
'.$key1.' '.$valor;
                }
              }

              if( $key1 == "s1GtpuEchoDscp" ||
                  $key1 == "s1GtpuEchoEnable" ||
                  $key1 == "s1GtpuEchoFailureAction"){
                if(isset($valor)){
                  @$cinsert27 .='
'.$key1.' '.$valor;
                }
              }

              if( $key1 == "s1HODirDataPathAvail"){
                if(isset($valor)){
                  $cinsert027 ='
'.$key1.' '.$valor;
                }
              }              

              if($key1 == "s1RetryTimer"){
                if(isset($valor)){
                  $cinsert28 ='
'.$key1.' '.$valor;
                }
              }

              if( $key1 == "s1RetryTimer"){
                if(isset($valor)){
                  $cinsert028 ='
sctpRef Transport=1,SctpEndpoint=1';
                }
              }

              if($key1 == "softLockRwRWaitTimerInternal" ||
$key1 == "softLockRwRWaitTimerOperator"){
                if(isset($valor)){
                  @$cinsert33 .='
'.$key1.' '.$valor;
                }
              }

              if($key1 == "tddVoipDrxProfileId"){
                if(isset($valor)){
                  $cinsert34 ='
'.$key1.' '.$valor;
                }
              }

              if($key1 == "timeAndPhaseSynchCritical"){
                if(isset($valor)){
                  $cinsert29 ='
'.$key1.' '.$valor;
                }
              }

              if($key1 == "timePhaseMaxDeviation"){
                if(isset($valor)){
                  $cinsert30 ='
'.$key1.' '.$valor;
                }
              }

              if( $key1 == "timeAndPhaseSynchAlignment" || $key1 == "timePhaseMaxDeviationCdma2000" || $key1 == "timePhaseMaxDeviationMbms" || $key1 == "timePhaseMaxDeviationOtdoa" || $key1 == "timePhaseMaxDeviationSib16" || $key1 == "timePhaseMaxDeviationTdd"){
                if(isset($valor)){
                  @$cinsert35 .='
'.$key1.' '.$valor;
                }
              }

              if($key1 == "tOutgoingHoExecCdma1xRtt"){
                if(isset($valor)){
                  $cinsert36 ='
'.$key1.' '.$valor;
                }
              }


              if($key1 == "tRelocOverall"){
                if(isset($valor)){
                  $cinsert37 ='
'.$key1.' '.$valor;
                }
              }

              if($key1 == "tS1HoCancelTimer"){
                if(isset($valor)){
                  $cinsert38 ='
'.$key1.' '.$valor;
                }
              }


              if($key1 == "ulMaxWaitingTimeGlobal"){
                if(isset($valor)){
                  $cinsert39 ='
'.$key1.' '.$valor;
                }
              }

              if($key1 == "ulSchedulerDynamicBWAllocationEnabled"){
                if(isset($valor)){
                  $cinsert40 ='
'.$key1.' '.$valor;
                }
              }

              if($key1 == "ulSchedulerDynamicBWAllocationEnabled"){
                if(isset($valor)){
                  $cinsert40 .='
upIpAddressRef Transport=1,Router=LTE,InterfaceIPv4=1,AddressIPv4=1';
                }
              }

              if($key1 == "useBandPrioritiesInSCellEval"){
                if(isset($valor)){
                  $cinsert41 ='
'.$key1.' '.$valor;
                }
              }

              if($key1 == "userLabel"){
                if(isset($valor)){
                  $cinsert42 ='
'.$key1.' '.$valor;
                }
              }

              if( $key1 == "x2GtpuEchoDscp" ||
                  $key1 == "x2GtpuEchoEnable" ||
                  $key1 == "x2IpAddrViaS1Active" ||
                  $key1 == "x2retryTimerMaxAuto" ||
                  $key1 == "x2retryTimerStart" ||
                  $key1 == "x2SetupTwoWayRelations"){
                if(isset($valor)){
                  @$cinsertfin0 .='
'.$key1.' '.$valor;
                }
              }

              if( $key1 == "zzzTemporary1" ||
                  $key1 == "zzzTemporary10" ||
                  $key1 == "zzzTemporary11" ||
                  $key1 == "zzzTemporary12" ||
                  $key1 == "zzzTemporary13" ||
                  $key1 == "zzzTemporary15" ||
                  $key1 == "zzzTemporary16" ||
                  $key1 == "zzzTemporary17"){
                if(isset($valor)){
                  @$cinsertfin .='
'.$key1.' '.$valor;
                }
              }

              if( $key1 == "zzzTemporary18" ||
                  $key1 == "zzzTemporary21" ||
                  $key1 == "zzzTemporary22" ||
                  $key1 == "zzzTemporary23" ||
                  $key1 == "zzzTemporary24" ||
                  $key1 == "zzzTemporary25" ||
                  $key1 == "zzzTemporary26"){
                if(isset($valor)){
                  @$cinsertfin .='
'.$key1.' '.$valor;
                }
              }

              if( $key1 == "zzzTemporary28" ||
                  $key1 == "zzzTemporary29" ||
                  $key1 == "zzzTemporary30" ||
                  $key1 == "zzzTemporary31" ||
                  $key1 == "zzzTemporary32" ||
                  $key1 == "zzzTemporary33" ||
                  $key1 == "zzzTemporary34"){
                if(isset($valor)){
                  @$cinsertfin .='
'.$key1.' '.$valor;
                }
              }

              if( $key1 == "zzzTemporary35" ||
                  $key1 == "zzzTemporary36" ||
                  $key1 == "zzzTemporary37" ||
                  $key1 == "zzzTemporary38" ||
                  $key1 == "zzzTemporary39" ||
                  $key1 == "zzzTemporary40"){
                if(isset($valor)){
                  @$cinsertfin .='
'.$key1.' '.$valor;
                }
              }

              if( $key1 == "zzzTemporary5" ||
                  $key1 == "zzzTemporary6" ||
                  $key1 == "zzzTemporary7" ||
                  $key1 == "zzzTemporary9"){
                if(isset($valor)){
                  @$cinsertfin1 .='
'.$key1.' '.$valor;
                }
              }
              if(isset($valor)){
                //echo '$key1 == "'.$key1.'"<br>';
              }
            }         
          }
        }
      }
     
      $cinsert .=$cinsert0.$cinsert1.$cinsert2.$cinsert3.$cinsert4.$cinsert5.$cinsert6.$cinsert7.$cinsert8.$cinsert9.$cinsert10.$cinsert11.$cinsert12.$cinsert13.$cinsert14.$cinsert15.$cinsert16.$cinsert17.$cinsert18.$cinsert19.$cinsert20.$cinsert21.$cinsert021.$cinsert22.$cinsert23.$cinsert24.$cinsert023.$cinsert024.$cinsert25.$cinsert26.$cinsert27.$cinsert027.$cinsert28.$cinsert028.$cinsert33.$cinsert34.$cinsert30.$cinsert29.$cinsert35.$cinsert36.$cinsert37.$cinsert38.$cinsert39.$cinsert40.$cinsert41.$cinsert42.$cinsertfin0.$cinsertfin.$cinsertfin1;

      $cinsert .='
end
#END ENodeBFunction=1 --------------------

gs-
confb-';
      $estructura = $this->ruta.$this->nombre;
      $archivo    = $estructura.$this->name1.$this->nombre.$this->name2.$this->nombre.".mos";
      $this->ElimarArchivo($archivo);
      $this->crear_carpeta($estructura);
		  $this->CrearArchivo($archivo, $cinsert);	 
      //die();
		  return true;	
	}

    public function __destruct()
    {
        
    }
}
	
?>