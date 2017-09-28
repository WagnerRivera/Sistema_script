<?php
require_once("../Control_Archivo.php");
/////////////////////////////////////////////////////////////////////////
//Clase para la contruccion de la estrctura de los archivos xml, mos y mo
//Fecha de creacion: 29-05-2017
//Creador por: Wagner Rivera
//Fecha de Modificación: 01-06-2017
////////////////////////////////////////////////////////////////////////
class SITE_EQUIPMENT_SCRIPT extends Control_Archivos
{
    private $ruta    = "archivos/ENodoB/ENodoB_";
    private $Archivo = "/16.SITE_EQUIPMENT_SCRIPT_";
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
	public function SITE_EQUIPMENT_SCRIPT_($p_p_16_1, $p_p_16_2,$p_p_16_3,$p_p_16_4){
		 $cinsert = '<?xml version="1.0" encoding="ISO-8859-1"?>
<!DOCTYPE Site SYSTEM "SiteEquipment.dtd">
<!-- Generated with BEM by: cmoya -->
<!-- Created '.$this->Fechas().' '.$this->Horas().' -->
<!-- Site Equipment Configuration -->

<Site>
<Format
revision="AL1"
/>
<OptionalEquipmentConfiguration
configureSau="NO"
absoluteTimeSynchEnabled="NO"
gpsOutEnabled="FALSE"
smokeDetector="FALSE"
>
</OptionalEquipmentConfiguration>
';
    $parte_uno = $this->Crear_cuerpo_uno($p_p_16_1, $p_p_16_2);
    $parte_2   = $this->Crear_cuerpo_2($p_p_16_1);
    $parte_3   = $this->Crear_cuerpo_3($p_p_16_1);
    $parte_4   = $this->Crear_cuerpo_4($p_p_16_1,$p_p_16_3,$p_p_16_4);
    $parte_5   = $this->Crear_cuerpo_5($p_p_16_1);
    $parte_6   = $this->Crear_cuerpo_6($p_p_16_1);
    $parte_7   = $this->Crear_cuerpo_7($p_p_16_1);
    $parte_8   = $this->Crear_cuerpo_8($p_p_16_1);
    $parte_9   = $this->Crear_cuerpo_9($p_p_16_1);
    $parte_10   = $this->Crear_cuerpo_10($p_p_16_1);
    $parte_11   = $this->Crear_cuerpo_11($p_p_16_1);
    $cinsert  .= $parte_uno.$parte_2.$parte_3.$parte_4.$parte_5.$parte_6.$parte_7.$parte_8.$parte_9.$parte_10.$parte_11; 
        $estructura = $this->ruta.$this->nombre;
        $archivo  = $estructura.$this->Archivo.$this->nombre.".xml";
        $this->ElimarArchivo($archivo);
    $this->CrearArchivo($archivo, $cinsert);  
    return true;
	}  

  public function Crear_cuerpo_uno($p_16_1, $p_16_2){
    $continido_1_1_1 .= '
<SiteLocationConfiguration
siteName="'.$p_16_2["Name"][2].'"
logicalName="'.$p_16_2["Site"][2].'"
>';
    $contar = 0;
    foreach ($p_16_1 as $key => $value) {
     if($key == 'Sector'){
          foreach ($value as $valor) {
            $Sector[] = $valor;
          }
      }

      if($key == 'latitude'){
          foreach ($value as $valor) {
            $latitude[] = $valor;
          }
      }

      if($key == 'longitude'){
          foreach ($value as $valor) {
            $longitude[] = $valor;
          }
      }

      if($key == 'geoDatum'){
          foreach ($value as $valor) {
            $geoDatum[] = $valor;
          }
      }

      if($key == 'beamDirection'){
          foreach ($value as $valor) {
            $beamDirection[] = $valor;
          }
      }

      if($key == 'height'){
          foreach ($value as $valor) {
            $height[] = $valor;
          }
      }    

      if($key == 'mixedModeRadio'){
        foreach ($value as $valor) {
          $continido_1_1_1 .='
<SectorData
sectorNumber="'. $Sector[$contar].'"
latitude="'.round($latitude[$contar]).'"
latHemisphere="SOUTH"
longitude="'.round($longitude[$contar]).'"
geoDatum="'.$geoDatum[$contar].'"
beamDirection="'.$beamDirection[$contar].'"
height="'.$height[$contar].'"
sectorGroup="-1"
mixedModeRadio="'.$valor.'"
/>';
        $contar++;
        }
      }
    }
    $continido_1_1_1 .='
</SiteLocationConfiguration>';
    return $continido_1_1_1;
  }

  public function Crear_cuerpo_2($p_16_1){
    $continido_1_1_1 .= '
<SectorCapabilitySettings>';
    $contar = 0;
    foreach ($p_16_1 as $key => $value) {
     if($key == 'Sector'){
          foreach ($value as $valor) {
            $continido_1_1_1 .='
<SectorCapability
radioBuildingBlock="RBB12_1A"
cpriLineRate="Ox2"
sectorNumber="'.$valor.'"
primaryPortId="'.$this->SectorNumero[$valor].'"
sectorSequenceNumber="1"
auUnitType="RRUWRRUS"
/>';
        $contar++;
        }
      }
    }
    $continido_1_1_1 .='
</SectorCapabilitySettings>';
    return $continido_1_1_1;
  }

  public function Crear_cuerpo_3($p_16_1){
    $continido_1_1_1 .= '
<SectorEquipmentConfiguration>

<TmaConfiguration>';
    $contar = 0;
    foreach ($p_16_1 as $key => $value) {
     if($key == 'Sector'){
          foreach ($value as $valor) {
            $continido_1_1_1 .='
<TmaSector
sectorNumber="'.$valor.'"
tmaType="NONE"
tmaType2="NONE"
tmaType3="NONE"
typeOfRet="RETU"
typeOfRet2="NONE"
typeOfRet3="NONE"
riuInstalled="NO"
riuInstalled2="NO"
currentLowSupervision_A="ON"
currentLowSupervision_B="ON"
/>';
        $contar++;
        }
      }
    }
    $continido_1_1_1 .='
</TmaConfiguration>';
    return $continido_1_1_1;
  }

  public function Crear_cuerpo_4($p_16_1,$p_16_2,$p_16_3){    
    $continido_1_1_1 .= '
<AntennaConfiguration>';
    $contar = 0;
    $contardor = 2;
    foreach ($p_16_1 as $key => $value) {
     if($key == 'Sector'){
          foreach ($value as $valor) {
            $continido_1_1_1 .='
<AntennaSector
sectorNumber="'.$valor.'"
antennaType="5"
antennaType3="0"
mechanicalTilt="30"
mechanicalTilt2="0"
mechanicalTilt3="0"
electricalTilt="0"
band="2"
fqBandHighEdgeBranchA="9571"
fqBandLowEdgeBranchA="9471"
fqBandHighEdgeBranchB="9571"
fqBandLowEdgeBranchB="9471"
fqBandHighEdgeBranchC=""
fqBandLowEdgeBranchC=""
fqBandHighEdgeBranchD=""
fqBandLowEdgeBranchD=""
fqBandHighEdgeBranchE=""
fqBandLowEdgeBranchE=""
fqBandHighEdgeBranchF=""
fqBandLowEdgeBranchF=""';
        if(substr($p_16_3['AntFeederCable'][$contardor],0,1) == $valor){
          $continido_1_1_1 .='            
dlFeederAttenuationBranch'.substr($p_16_3['AntFeederCable'][$contardor],1,1).'="'.str_replace(' ', ',', $p_16_3['dlAttenuation'][$contardor]).'"
ulFeederAttenuationBranch'.substr($p_16_3['AntFeederCable'][$contardor],1,1).'="'.str_replace(' ', ',',$p_16_3['ulAttenuation'][$contardor]).'"
dlFeederDelayBranch'.substr($p_16_3['AntFeederCable'][$contardor],1,1).'="'.str_replace(' ', ',', $p_16_3['electricalDlDelay'][$contardor]).'"
ulFeederDelayBranch'.substr($p_16_3['AntFeederCable'][$contardor],1,1).'="'.str_replace(' ', ',', $p_16_3['electricalUlDelay'][$contardor]).'"';
        }
            
      
        $continido_1_1_1 .= '
dlFeederAttenuationBranchB="'.str_replace(' ', ',', $p_16_3['dlAttenuation'][$contardor]).'"
ulFeederAttenuationBranchB="'.str_replace(' ', ',', $p_16_3['ulAttenuation'][$contardor]).'"
dlFeederDelayBranchB="'.str_replace(' ', ',', $p_16_3['electricalDlDelay'][$contardor]).'"
ulFeederDelayBranchB="'.str_replace(' ', ',', $p_16_3['electricalUlDelay'][$contardor]).'"
sectorOutputPower="-1"
beamDirection="20"
beamDirection2="000"
beamDirection3="000"
/>';
        $contar++;
        $contardor++;
        }
      }
    }
    $continido_1_1_1 .='
</TmaConfiguration>';
    return $continido_1_1_1;
  }

  public function Crear_cuerpo_5($p_16_1){
    $continido_1_1_1 .= '
</AntennaConfiguration>
<RetConfiguration>';
    $contar = 0;
    foreach ($p_16_1 as $key => $value) {
     if($key == 'Sector'){
          foreach ($value as $valor) {
            $continido_1_1_1 .='
<RetProfile
antennaType="99"
retType="1"
minTilt="20"
maxTilt="120"
retParam1="0"
retParam2="0"
retParam3="0"
retParam4="0"
retParam5="0"
retParam6="0"
retParam7="0"
retParam8="0"
checkSum="31040"
/>';
        $contar++;
        }
      }
    }
    $continido_1_1_1 .='
</TmaConfiguration>';
    return $continido_1_1_1;
  }

  public function Crear_cuerpo_6($p_16_1){
    $continido_1_1_1 .= '
<InitiateSectorsConfiguration>

';
    $contar = 0;
    foreach ($p_16_1 as $key => $value) {
     if($key == 'Sector'){
          foreach ($value as $valor) {
            $continido_1_1_1 .='
<InitiatedSector
sectorNumber="'.$valor.'"
antennaSupervisionBranchA="0"
antennaSupervisionBranchB="0"
/>';
        $contar++;
        }
      }
    }
    $continido_1_1_1 .='
</InitiateSectorsConfiguration>
';
    return $continido_1_1_1;
  }

  public function Crear_cuerpo_7($p_16_1){
    $continido_1_1_1 .= '
<LocalCellConfiguration
carrierAllocationMode="Basic"
>
';
    $contar = 0;
    foreach ($p_16_1 as $key => $value) {
     if($key == 'Sector'){
          foreach ($value as $valor) {
            $continido_1_1_1 .='
<Sector
sectorNumber="'.$valor.'"
>
<Cell
cellNumber="1"
cellCreated="YES"
cellIdentity="07451"
cellRange="35000"
baseBandPoolId="1"
numberOfTxBranches="1"
numberOfRxBranches="2"
/>

<Cell
cellNumber="2"
cellCreated="YES"
cellIdentity="07454"
cellRange="35000"
baseBandPoolId="2"
numberOfTxBranches="1"
numberOfRxBranches="2"
/>';
        $contar++;
        }
      }
    }
    $continido_1_1_1 .='
</Sector>';
    return $continido_1_1_1;
  }

  public function Crear_cuerpo_8($p_16_1){
    $continido_1_1_1 = '
</LocalCellConfiguration>
</SectorEquipmentConfiguration>
<HsdpaSettings
steeredHsAllocation="FALSE"
>
<HsdpaSlot
slot="1"
numHsCodeResources="3"
/>
<HsdpaSlot
slot="2"
numHsCodeResources="3"
/>
</HsdpaSettings>

';
    
    return $continido_1_1_1;
  }

  public function Crear_cuerpo_9($p_16_1){
    $continido_1_1_1 = '
<EulSettings>
<EulSlot
slot="1"
numEulResources="1"
/>
<EulSlot
slot="2"
numEulResources="1"
/>
</EulSettings>

';
    
    return $continido_1_1_1;
  }

  public function Crear_cuerpo_10($p_16_1){
    $continido_1_1_1 = '
<ExternalAlarmConfiguration>

<Alarm
externalAlarmUnit="Sup"
portId="1"
alarmSlogan=""
normallyOpen="YES"
severity="Minor"
probableCause="550"
/>

<Alarm
externalAlarmUnit="Sup"
portId="2"
alarmSlogan=""
normallyOpen="YES"
severity="Minor"
probableCause="550"
/>

<Alarm
externalAlarmUnit="Sup"
portId="3"
alarmSlogan=""
normallyOpen="YES"
severity="Minor"
probableCause="550"
/>

<Alarm
externalAlarmUnit="Sup"
portId="4"
alarmSlogan=""
normallyOpen="YES"
severity="Minor"
probableCause="550"
/>

<Alarm
externalAlarmUnit="Sup"
portId="5"
alarmSlogan=""
normallyOpen="YES"
severity="Minor"
probableCause="550"
/>

<Alarm
externalAlarmUnit="Sup"
portId="6"
alarmSlogan=""
normallyOpen="YES"
severity="Minor"
probableCause="550"
/>

<Alarm
externalAlarmUnit="Sup"
portId="7"
alarmSlogan=""
normallyOpen="YES"
severity="Minor"
probableCause="550"
/>

<Alarm
externalAlarmUnit="Sup"
portId="8"
alarmSlogan=""
normallyOpen="YES"
severity="Minor"
probableCause="550"
/>
';
    $continido_1_1_1 .='
</ExternalAlarmConfiguration>';
    return $continido_1_1_1;
  }

   public function Crear_cuerpo_11($p_16_1){
    $continido_1_1_1 = '
<EcPort
unitType="DUW"
unitNumber="1"
portNumber="1"
hubPosition="EC_A"
/>
</Site>

';
    
    return $continido_1_1_1;
  }

  public function __destruct()
  {
      
  }
}
	
?>