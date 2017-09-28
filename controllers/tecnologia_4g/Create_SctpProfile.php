<?php
require_once("../Control_Archivo.php");
/////////////////////////////////////////////////////////////////////////
//Clase para la contruccion de la estrctura de los archivos xml, mos y mo
//Fecha de creacion: 29-05-2017
//Creador por: Wagner Rivera
//Fecha de Modificación: 01-06-2017
////////////////////////////////////////////////////////////////////////
class Create_SctpProfile extends Control_Archivos
{
    private $ruta    = "archivos/ENodoB/ENodoB_";
    private $name1 = "/04_";
    private $name2 = "_Create_SctpProfile_";
	
	public function __construct($parametros)
	{
        $this->nombre  = $parametros[1][0][2];
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
		
		$cinsert ='confb+
gs+

if $moshell_version ~ ^([7-9]|10)
   l echo "The moshell version is too old. 11.0a or higher is required for scripts containing the crn command."
   return
fi

crn Transport=1,SctpProfile=1
';
      $contar =0;
      foreach ($array as $key => $value) {
        foreach ($value as $key1 => $value1) {
          foreach ($value1 as $f => $valor) {          
            //echo $key." => ".$key1." => ".$f." => ".$valor."<br>";
            if($key == 70){ 
                  if($f == 1 && $key1 != 0)
                    $nombre = $valor;
                  if($f == 2 && $key1 != 0){
                    $cinsert .=$nombre." ".$valor.'
';
                  }
            }            
          }
        }
      }
      $cinsert .='
userLabel 1
end
#END Transport=1,SctpProfile=1 --------------------

crn Transport=1,SctpEndpoint=1
localIpAddress Transport=1,Router=LTE,InterfaceIPv4=1,AddressIPv4=1
portNumber 36422
sctpProfile Transport=1,SctpProfile=1
end
#END Transport=1,SctpEndpoint=1 --------------------

ld NodeSupport=1,TimeSettings=1 #SystemCreated
lset NodeSupport=1,TimeSettings=1$ timeOffset +00:00
lset NodeSupport=1,TimeSettings=1$ daylightSavingTimeOffset 1:00
lset NodeSupport=1,TimeSettings=1$ gpsToUtcLeapSeconds 0

crn Transport=1,QosProfiles=1,DscpPcpMap=1
defaultPcp 0
pcp0 0 1 2 3 4 5 6 7 8 9 11 13 15 16 17 19 21 23 24 25 27 29 31 32 33 35 37 39 40 41 42 43 44 45 47 48 49 50 51 52 53 54 55 56 57 58 59 60 61 62 63
pcp1 10 12 14
pcp3 18 20 22
pcp4 26 28 30
pcp5 34 36 38
pcp6 46
end
#END Transport=1,QosProfiles=1,DscpPcpMap=1 --------------------

ld Transport=1,Router=vr_OAM,InterfaceIPv4=1
lset Transport=1,Router=vr_OAM,InterfaceIPv4=1$ egressQosMarking Transport=1,QosProfiles=1,DscpPcpMap=1

ld Transport=1,Router=LTE,InterfaceIPv4=2
lset Transport=1,Router=LTE,InterfaceIPv4=2$ egressQosMarking Transport=1,QosProfiles=1,DscpPcpMap=1

ld Transport=1,Synchronization=1 #SystemCreated
lset Transport=1,Synchronization=1$ fixedPosition true
lset Transport=1,Synchronization=1$ telecomStandard 1

crn Transport=1,Synchronization=1,RadioEquipmentClock=1
minQualityLevel qualityLevelValueOptionI=2,qualityLevelValueOptionII=2,qualityLevelValueOptionIII=1
selectionProcessMode 1
end
#END Transport=1,Synchronization=1,RadioEquipmentClock=1 --------------------';

      $cinsert .='
gs-
confb-';
      $estructura = $this->ruta.$this->nombre;
      $archivo    = $estructura.$this->name1.$this->nombre.$this->name2.$this->nombre.".mos";
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