<?php
require_once("../Control_Archivo.php");
/////////////////////////////////////////////////////////////////////////
//Clase para la contruccion de la estrctura de los archivos xml, mos y mo
//Fecha de creacion: 29-05-2017
//Creador por: Wagner Rivera
//Fecha de Modificación: 01-06-2017
////////////////////////////////////////////////////////////////////////
class Script_TCU_SWITCH_Incobech extends Control_Archivos
{
    private $ruta    = "archivos/tcu/Tcu_";
    private $Archivo = "/Script_TCU_SWITCH_Incobech_";
    public $trama;
	
	public function __construct($parametros, $trama)
	{
		$this->trama = $trama;
        $this->nombre  = $parametros[0][2][4];
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
		$cinsert ='--------------------------------------------------------
Fecha Creacion 17/08/2017 16:15:15
Script_TCU_'.$this->nombre.'_
Nemonico del POP '.$this->nombre.'
Name_Site LO ETCHEVERS
Generador INCOBECH
Team_Integracion
--------------------------------------------------------
## +------------------------------------------------+ ##
## |       CREATION OF SERVICE 2G VOICE             | ##
## +------------------------------------------------+ ##
starttransaction 1

createmo 1 STN=0,E1T1Interface=0
setmoattribute 1 STN=0,E1T1Interface=0 type '.$this->trama.'

createmo 1 STN=0,TGTransport='.$array[3][6][15].'
setmoattribute 1 STN=0,TGTransport='.$array[3][6][15].' depIP_Interface STN=0,IPInterface=
setmoattribute 1 STN=0,TGTransport='.$array[3][6][15].'  pgw_ip_address '.$array[1][6][21].'
setmoattribute 1 STN=0,TGTransport='.$array[3][6][15].'  DSCP_L2TP_CP '.$array[1][2][42].'
createmo 1 STN=0,TGTransport='.$array[3][6][15].',SuperChannel=0
setmoattribute 1 STN=0,TGTransport='.$array[3][6][15].',SuperChannel=0 depE1T1Interface 0


createmo 1 STN=0,TrafficManager='.$array[3][3][40].'
setmoattribute 1 STN=0,TrafficManager='.$array[3][3][40].' schedulerMeanRate '.$array[1][2][46].'
setmoattribute 1 STN=0,TrafficManager='.$array[3][3][40].' schedulerMaxBurstSize '.$array[1][2][49].'
setmoattribute 1 STN=0,TrafficManager='.$array[3][3][40].' diffServAlgDropQThreshold_1 '.$array[1][2][51].'
setmoattribute 1 STN=0,TrafficManager='.$array[3][3][40].' diffServMinRateRelative_1 '.$array[1][2][50].'
setmoattribute 1 STN=0,TrafficManager='.$array[3][3][40].' diffServAlgDropQThreshold_2 '.$array[1][2][54].'
setmoattribute 1 STN=0,TrafficManager='.$array[3][3][40].' diffServMinRateRelative_2 '.$array[1][2][53].'
setmoattribute 1 STN=0,TrafficManager='.$array[3][3][40].' diffServAlgDropQThreshold_3 '.$array[1][2][57].'
setmoattribute 1 STN=0,TrafficManager='.$array[3][3][40].' diffServMinRateRelative_3 '.$array[1][2][56].'
setmoattribute 1 STN=0,TrafficManager='.$array[3][3][40].' diffServAlgDropQThreshold_4 '.$array[1][2][60].'
setmoattribute 1 STN=0,TrafficManager='.$array[3][3][40].' diffServMinRateRelative_4 '.$array[1][2][59].'
setmoattribute 1 STN=0,TrafficManager='.$array[3][3][40].' diffServAlgDropQThreshold_5 '.$array[1][2][62].'
setmoattribute 1 STN=0,TrafficManager='.$array[3][3][40].' diffServMinRateRelative_5 '.$array[1][2][61].'
setmoattribute 1 STN=0,TrafficManager='.$array[3][3][40].' diffServAlgDropQThreshold_6 '.$array[1][2][64].'
setmoattribute 1 STN=0,TrafficManager='.$array[3][3][40].' diffServMinRateRelative_6 '.$array[1][2][63].'
setmoattribute 1 STN=0,TrafficManager='.$array[3][3][40].' diffServAlgDropQThreshold_7 '.$array[1][2][66].'
setmoattribute 1 STN=0,TrafficManager='.$array[3][3][40].' diffServMinRateRelative_7 '.$array[1][2][65].'
setmoattribute 1 STN=0,TrafficManager='.$array[3][3][40].' diffServAlgDropQThreshold_8 '.$array[1][2][69].'
setmoattribute 1 STN=0,TrafficManager='.$array[3][3][40].' diffServMinRateRelative_8 '.$array[1][2][68].'
setmoattribute 1 STN=0,TrafficManager='.$array[3][3][40].' depQosPolicy STN=0,QosPolicy='.$array[3][3][41].'


createmo 1 STN=0,PingMeasurement=0
setmoattribute 1 STN=0,PingMeasurement=0 pingDestination '.$array[1][6][21].'
setmoattribute 1 STN=0,PingMeasurement=0 pingDSCP 40
setmoattribute 1 STN=0,PingMeasurement=0 depIP_Interface STN=0,IPInterface=


createmo 1 STN=0,TwampResponder=0
setmoattribute 1 STN=0,TwampResponder=0 udpPort 4001
setmoattribute 1 STN=0,TwampResponder=0 depIP_Interface STN=0,IPInterface=
createmo 1 STN=0,TwampResponder=1
setmoattribute 1 STN=0,TwampResponder=1 udpPort 4002
setmoattribute 1 STN=0,TwampResponder=1 depIP_Interface STN=0,IPInterface=
createmo 1 STN=0,TwampResponder=2
setmoattribute 1 STN=0,TwampResponder=2 udpPort 4003
setmoattribute 1 STN=0,TwampResponder=2 depIP_Interface STN=0,IPInterface=
createmo 1 STN=0,TwampResponder=3
setmoattribute 1 STN=0,TwampResponder=3 udpPort 4004
setmoattribute 1 STN=0,TwampResponder=3 depIP_Interface STN=0,IPInterface=


createmo 1 STN=0,Synchronization=0,SynchEthInterface=0
setmoattribute 1 STN=0,Synchronization=0,SynchEthInterface=0 depEthernetInterface STN=0,EthernetInterface=P4_SA869_LTE
setmoattribute 1 STN=0,Synchronization=0,SynchEthInterface=0 ssmQLminimum QL-SSU-A
createmo 1 STN=0,Synchronization=0,SynchEthInterface=1
setmoattribute 1 STN=0,Synchronization=0,SynchEthInterface=1 depEthernetInterface STN=0,EthernetInterface=P1B_SA869_1900
setmoattribute 1 STN=0,Synchronization=0,SynchEthInterface=1 ssmQLminimum QL-SSU-A
createmo 1 STN=0,Synchronization=0,SynchEthInterface=2
setmoattribute 1 STN=0,Synchronization=0,SynchEthInterface=2 depEthernetInterface STN=0,EthernetInterface=P3B_SA869_900
setmoattribute 1 STN=0,Synchronization=0,SynchEthInterface=2 ssmQLminimum QL-SSU-A


createmo 1 STN=0,FmSubscription=1
setmoattribute 1 STN=0,FmSubscription=1 managerIpAddress '.$array[1][3][7];
		@$cuerpo1.='
createmo 1 STN=0,QosPolicy='.$array[3][3][41];
		foreach ($array as $key => $value) {
			foreach ($value as $k => $v) {
				foreach ($v as $id => $valor) {
					if($key == 1 && $k == 2){
						if($id >= 71 && $id <= 134){
							$cuerpo1.='
setmoattribute 1 STN=0,QosPolicy='.$array[3][3][41].' '.$array[1][1][$id].' '.$array[1][2][$id];
						}
						if($id >= 145 && $id <= 208){
							$cuerpo1.='
setmoattribute 1 STN=0,QosPolicy='.$array[3][3][41].' '.$array[1][1][$id].' '.$array[1][2][$id];
						}
						if($id >= 208){
							@$cuerpo2.='
setmoattribute 1 STN=0,QosPolicy='.$array[3][3][41].' L2QosMappingType DSCP2Queue
setmoattribute 1 STN=0,QosPolicy='.$array[3][3][41].' defaultPcp 0';
						}
						if($id >= 136 && $id <= 143){
							@$cuerpo3.='
setmoattribute 1 STN=0,QosPolicy='.$array[3][3][41].' '.$array[1][1][$id].' '.$array[1][2][$id];
						}
					}
				}
			}
		}

		$cinsert .= $cuerpo1.$cuerpo2.$cuerpo3;
        $estructura = $this->ruta.$this->nombre;
        $archivo    = $estructura.$this->Archivo.$this->nombre.".txt";
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