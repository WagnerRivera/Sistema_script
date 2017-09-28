<?php
require_once("../Control_Archivo.php");
/////////////////////////////////////////////////////////////////////////
//Clase para la contruccion de la estrctura de los archivos xml, mos y mo
//Fecha de creacion: 29-05-2017
//Creador por: Wagner Rivera
//Fecha de Modificación: 01-06-2017
////////////////////////////////////////////////////////////////////////
class OAM_SCRIPT extends Control_Archivos
{
    private $ruta    = "archivos/ENodoB/ENodoB_";
    private $Archivo = "/15.OAM_SCRIPT_";
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
	public function OAM_SCRIPT_($p_p_15_1){
		 $cinsert = '<?xml version="1.0" encoding="ISO-8859-1"?>
<!DOCTYPE SiteBasic SYSTEM "OamAccess.dtd">

<!--OAM Access Configuration-->
<!-- Created '.$this->Fechas().' '.$this->Horas().' -->
<!-- Created by INCOBECH -->
';
    $parte_uno = $this->Crear_cuerpo_uno($p_p_15_1);
    $cinsert  .= $parte_uno; 
        $estructura = $this->ruta.$this->nombre;
        $archivo  = $estructura.$this->Archivo.$this->nombre.".xml";
        $this->ElimarArchivo($archivo);
    $this->CrearArchivo($archivo, $cinsert);  
    return true;
	}  

  public function Crear_cuerpo_uno($p_15_1){
    $continido_1_1_1 .='
<SiteBasic>
  <Format revision="E" />
  <ConfigureOAMAccess>
    <IPoverEthernet ethernetIpAddress="169.254.1.1" ethernetSubnetMask="255.255.0.0" />
        <IPoverGigabitEthernet etIPSynchSlot="1" syncIpAddress="10.31.232.146" syncSubnetMask="'.$this->mask[$p_15_1['Mask'][2]].'" defaultRouter0="10.31.232.129" syncVid="1308">
      <IpSyncRef ntpServerIpAddress="10.170.35.253" />
      <IpSyncRef ntpServerIpAddress="10.170.35.254" />
        <OamIpHost oamSubnetMask="'.$this->mask[$p_15_1['Mask'][2]].'" oamDefaultRouter0="'.$p_15_1['DGW Iub_IP_OAM'][2].'" oamIpAddress="'.$p_15_1['IP OAM'][2].'" oamVid="1309"  />
      <GigaBitEthernet gigaBitEthernetPort="TNA" />
    </IPoverGigabitEthernet>
    <Servers isDefaultDomainName="NO" dnsServerIpAddress="172.29.79.50"  primaryNtpServerIpAddress="172.16.50.41" primaryNtpServiceActive="YES" secondaryNtpServerIpAddress="172.16.50.42" secondaryNtpServiceActive="YES" localTimeZone="UTC" daylightSavingTime="YES" singleLogonServer="" />
    <StaticRouting>
      <Route routeIpAddress="0.0.0.0" routeSubnetMask="0.0.0.0" hopIpAddress="'.$p_15_1['IP Iub_IP Control'][2].'" routeMetric="100" redistribute="NO" />
      <Route routeIpAddress="0.0.0.0" routeSubnetMask="0.0.0.0" hopIpAddress="'.$p_15_1['DGW Iub_IP_OAM'][2].'" routeMetric="100" redistribute="NO" />
      <Route routeIpAddress="10.0.0.0" routeSubnetMask="255.255.0.0" hopIpAddress="169.254.1.2" routeMetric="100" redistribute="NO" />
    </StaticRouting>
    <NetworkSynch synchSlot="1" synchPort="7" synchPriority="1" />
    <NetworkSynch synchSlot="1" synchPort="8" synchPriority="2" />
  </ConfigureOAMAccess>
</SiteBasic>';
    return $continido_1_1_1;
  }

  public function __destruct()
  {
      
  }
}
	
?>