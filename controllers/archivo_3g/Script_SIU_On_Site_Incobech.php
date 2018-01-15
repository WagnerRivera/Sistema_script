<?php
require_once("../Control_Archivo.php");
/////////////////////////////////////////////////////////////////////////
//Clase para la contruccion de la estrctura de los archivos xml, mos y mo
//Fecha de creacion: 29-05-2017
//Creador por: Wagner Rivera
//Fecha de Modificación: 01-06-2017
////////////////////////////////////////////////////////////////////////
class Script_SIU_On_Site_Incobech extends Control_Archivos
{
    private $ruta    = "archivos/siu/Siu_";
    private $Archivo = "/Script_SIU_On_Site_Incobech_";
	
	public function __construct($parametros)
	{
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
		$cinsert = '--------------------------------------------------------
Fecha Creacion '.$this->Fechas().' '.$this->Horas().'
Script_SIU_'.$this->nombre.'_
Nemonico del POP '.$this->nombre.'
Name_Site LO ETCHEVERS
Generador INCOBECH
------> INCOBECH <----------
Team_Integracion
--------------------------------------------------------

resettofactorysetting
deleteaimo
ok
starttransaction 1


setmoattribute 1 stn=0 stn_name '.$array[1][5][7].'
setmoattribute 1 stn=0 wakeUpDestination '.$array[1][3][7].'
setmoattribute 1 stn=0 wakeUpEventInterval 1
setmoattribute 1 stn=0 DSCP_OperationAndMaintenance '.$array[1][2][31].'
setmoattribute 1 stn=0 systemClockTimeServer '.$array[1][4][7].'
setmoattribute 1 stn=0 systemClockTimeServerType NTP
setmoattribute 1 stn=0 STN_systemClockUDP_Port '.$array[1][2][32].'
setmoattribute 1 stn=0 DSCP_OM_filetransfer '.$array[1][2][33].'
setmoattribute 1 stn=0 promptPrefix '.$array[1][6][7].'

createmo 1 stn=0,bridge='.$array[5][22][7].'
createmo 1 stn=0,bridge='.$array[5][22][8].'
createmo 1 stn=0,bridge='.$array[5][22][9].'
createmo 1 stn=0,bridge='.$array[5][22][10].'
createmo 1 stn=0,bridge='.$array[5][22][11].'
createmo 1 stn=0,bridge='.$array[5][22][12].'
createmo 1 stn=0,bridge='.$array[5][22][13].'
createmo 1 stn=0,bridge='.$array[5][22][14].'

createmo 1 stn=0,ethernetinterface='.$array[5][5][8].'
setmoattribute 1 stn=0,ethernetinterface='.$array[5][5][8].' mode gigabit
setmoattribute 1 stn=0,ethernetinterface='.$array[5][5][8].' portnumber 1
setmoattribute 1 stn=0,ethernetinterface='.$array[5][5][8].' port SFP

createmo 1 stn=0,ethernetinterface='.$array[1][7][32].'
setmoattribute 1 stn=0,ethernetinterface='.$array[1][7][32].' mode gigabit
setmoattribute 1 stn=0,ethernetinterface='.$array[1][7][32].' portnumber 3
setmoattribute 1 stn=0,ethernetinterface='.$array[1][7][32].' port SFP

createmo 1 stn=0,ethernetinterface='.$array[5][5][10].'
setmoattribute 1 stn=0,ethernetinterface='.$array[5][5][10].' mode gigabit
setmoattribute 1 stn=0,ethernetinterface='.$array[5][5][10].' portnumber 4
setmoattribute 1 stn=0,ethernetinterface='.$array[5][5][10].' port gigabit

createmo 1 stn=0,ethernetinterface='.$array[5][13][7].'
setmoattribute 1 stn=0,ethernetinterface='.$array[5][13][7].' mode 100MBitfullduplex
setmoattribute 1 stn=0,ethernetinterface='.$array[5][13][7].' portnumber 7
setmoattribute 1 stn=0,ethernetinterface='.$array[5][13][7].' port gigabit

createmo 1 stn=0,vlangroup='.$array[3][5][12].'
setmoattribute 1 stn=0,vlangroup='.$array[3][5][12].' deplinklayer stn=0,ethernetinterface='.$array[3][4][12].'

createmo 1 stn=0,vlangroup='.$array[3][5][13].'
setmoattribute 1 stn=0,vlangroup='.$array[3][5][13].' deplinklayer stn=0,ethernetinterface='.$array[3][4][13].'

createmo 1 stn=0,vlangroup='.$array[3][5][14].'
setmoattribute 1 stn=0,vlangroup='.$array[3][5][14].' deplinklayer stn=0,ethernetinterface='.$array[3][4][14].'

createmo 1 stn=0,vlangroup=
setmoattribute 1 stn=0,vlangroup= deplinklayer stn=0,ethernetinterface=


createmo 1 stn=0,vlangroup=,vlan='.$array[3][9][7].'
setmoattribute 1 stn=0,vlangroup=,vlan='.$array[3][9][7].' tagvalue 18
setmoattribute 1 stn=0,vlangroup=,vlan='.$array[3][9][7].' tagged true
setmoattribute 1 stn=0,vlangroup=,vlan='.$array[3][9][7].' depBridge STN=0,Bridge=Enable

createmo 1 stn=0,vlangroup=,vlan='.$array[3][9][11].'
setmoattribute 1 stn=0,vlangroup=,vlan='.$array[3][9][11].' tagvalue 23
setmoattribute 1 stn=0,vlangroup=,vlan='.$array[3][9][11].' tagged true
setmoattribute 1 stn=0,vlangroup=,vlan='.$array[3][9][11].' depBridge STN=0,Bridge=B_SA869_OAM

createmo 1 stn=0,vlangroup=,vlan=
setmoattribute 1 stn=0,vlangroup=,vlan= tagvalue 1302
setmoattribute 1 stn=0,vlangroup=,vlan= tagged true

createmo 1 stn=0,vlangroup=,vlan='.$array[3][4][6].'
setmoattribute 1 stn=0,vlangroup=,vlan='.$array[3][4][6].' tagvalue '.$array[2][2][17].'
setmoattribute 1 stn=0,vlangroup=,vlan='.$array[3][4][6].' tagged true
setmoattribute 1 stn=0,vlangroup=,vlan='.$array[3][4][6].' depBridge STN=0,Bridge=Enable

createmo 1 stn=0,vlangroup=,vlan='.$array[3][5][6].'
setmoattribute 1 stn=0,vlangroup=,vlan='.$array[3][5][6].' tagvalue '.$array[2][3][17].'
setmoattribute 1 stn=0,vlangroup=,vlan='.$array[3][5][6].' tagged true
setmoattribute 1 stn=0,vlangroup=,vlan='.$array[3][5][6].' depBridge STN=0,Bridge=B_SA869_IUB_OAM

createmo 1 stn=0,vlangroup=,vlan='.$array[3][5][8].'
setmoattribute 1 stn=0,vlangroup=,vlan='.$array[3][5][8].' tagvalue '.$array[2][6][17].'
setmoattribute 1 stn=0,vlangroup=,vlan='.$array[3][5][8].' tagged true
setmoattribute 1 stn=0,vlangroup=,vlan='.$array[3][5][8].' depBridge STN=0,Bridge=Enable

createmo 1 stn=0,vlangroup=,vlan='.$array[2][7][16].'
setmoattribute 1 stn=0,vlangroup=,vlan='.$array[2][7][16].' tagvalue '.$array[2][7][17].'
setmoattribute 1 stn=0,vlangroup=,vlan='.$array[2][7][16].' tagged true
setmoattribute 1 stn=0,vlangroup=,vlan='.$array[2][7][16].' depBridge STN=0,Bridge=B_SA869_LTE_OAM

createmo 1 stn=0,vlangroup='.$array[3][6][12].',vlan='.$array[3][4][7].'
setmoattribute 1 stn=0,vlangroup='.$array[3][6][12].',vlan='.$array[3][4][7].' tagvalue '.$array[2][2][17].'
setmoattribute 1 stn=0,vlangroup='.$array[3][6][12].',vlan='.$array[3][4][7].' tagged true
setmoattribute 1 stn=0,vlangroup='.$array[3][6][12].',vlan='.$array[3][4][7].' depBridge STN=0,Bridge='.$array[3][4][7].'

createmo 1 stn=0,vlangroup='.$array[3][6][12].',vlan='.$array[3][5][7].'
setmoattribute 1 stn=0,vlangroup='.$array[3][6][12].',vlan='.$array[3][5][7].' tagvalue '.$array[2][3][17].'
setmoattribute 1 stn=0,vlangroup='.$array[3][6][12].',vlan='.$array[3][5][7].' tagged true
setmoattribute 1 stn=0,vlangroup='.$array[3][6][12].',vlan='.$array[3][5][7].' depBridge STN=0,Bridge='.$array[3][5][7].'

createmo 1 stn=0,vlangroup='.$array[3][6][13].',vlan='.$array[3][6][7].'
setmoattribute 1 stn=0,vlangroup='.$array[3][6][13].',vlan='.$array[3][6][7].' tagvalue '.$array[2][4][17].'
setmoattribute 1 stn=0,vlangroup='.$array[3][6][13].',vlan='.$array[3][6][7].' tagged true
setmoattribute 1 stn=0,vlangroup='.$array[3][6][13].',vlan='.$array[3][6][7].' depBridge STN=0,Bridge='.$array[3][6][7].'

createmo 1 stn=0,vlangroup='.$array[3][6][13].',vlan='.$array[3][7][7].'
setmoattribute 1 stn=0,vlangroup='.$array[3][6][13].',vlan='.$array[3][7][7].' tagvalue '.$array[2][5][17].'
setmoattribute 1 stn=0,vlangroup='.$array[3][6][13].',vlan='.$array[3][7][7].' tagged true
setmoattribute 1 stn=0,vlangroup='.$array[3][6][13].',vlan='.$array[3][7][7].' depBridge STN=0,Bridge='.$array[3][7][7].'

createmo 1 stn=0,vlangroup='.$array[3][6][14].',vlan='.$array[3][8][7].'
setmoattribute 1 stn=0,vlangroup='.$array[3][6][14].',vlan='.$array[3][8][7].' tagvalue '.$array[2][6][17].'
setmoattribute 1 stn=0,vlangroup='.$array[3][6][14].',vlan='.$array[3][8][7].' tagged true
setmoattribute 1 stn=0,vlangroup='.$array[3][6][14].',vlan='.$array[3][8][7].' depBridge STN=0,Bridge='.$array[3][7][7].'

createmo 1 stn=0,vlangroup='.$array[3][6][14].',vlan='.$array[3][9][7].'
setmoattribute 1 stn=0,vlangroup='.$array[3][6][14].',vlan='.$array[3][9][7].' tagvalue '.$array[2][7][17].'
setmoattribute 1 stn=0,vlangroup='.$array[3][6][14].',vlan='.$array[3][9][7].' tagged true
setmoattribute 1 stn=0,vlangroup='.$array[3][6][14].',vlan='.$array[3][9][7].' depBridge STN=0,Bridge='.$array[3][9][7].'


createmo 1 stn=0,ipinterface=
setmoattribute 1 stn=0 depip_interface stn=0,ipinterface=
setmoattribute 1 stn=0,IPInterface= primaryIP_Address '.$array[1][2][10].'
setmoattribute 1 stn=0,IPInterface= primarySubNetMask '.$array[1][3][10].'
setmoattribute 1 stn=0,IPInterface= depLinkLayer STN=0,Bridge='.$array[3][10][7].'

createmo 1 stn=0,ipinterface=
setmoattribute 1 stn=0,IPInterface= primaryIP_Address '.$array[1][2][10].'
setmoattribute 1 stn=0,IPInterface= primarySubNetMask '.$array[1][3][10].'
setmoattribute 1 stn=0,IPInterface= depLinkLayer STN=0,Bridge='.$array[3][11][7].'

!Parámetros_Servicios_2G

createmo 1 stn=0,ipinterface=ETH 7?
setmoattribute 1 stn=0,IPInterface=ETH 7? primaryIP_Address '.$array[1][3][21].'
setmoattribute 1 stn=0,IPInterface=ETH 7? primarySubNetMask '.$array[1][4][21].'
setmoattribute 1 stn=0,IPInterface=ETH 7? depLinkLayer STN=0,vlangroup=,vlan=

createmo 1 STN=0,RoutingTable=0,IpRoute=IPINT_SA869_OAM 
setmoattribute 1 STN=0,RoutingTable=0,IpRoute=IPINT_SA869_OAM  destIpSubnet '.$array[1][9][13].'
setmoattribute 1 STN=0,RoutingTable=0,IpRoute=IPINT_SA869_OAM  nextHopIpAddress '.$array[1][6][13].'
setmoattribute 1 STN=0,RoutingTable=0,IpRoute=IPINT_SA869_OAM  forwardingInterface STN=0,IPInterface=
setmoattribute 1 STN=0,RoutingTable=0,IpRoute=IPINT_SA869_OAM  disableConnectivityCheck TRUE

createmo 1 STN=0,RoutingTable=0,IpRoute=Nombre
setmoattribute 1 STN=0,RoutingTable=0,IpRoute=Nombre destIpSubnet 0.0.0.0/0
setmoattribute 1 STN=0,RoutingTable=0,IpRoute=Nombre nextHopIpAddress '.$array[1][4][10].'
setmoattribute 1 STN=0,RoutingTable=0,IpRoute=Nombre forwardingInterface STN=0,IPInterface=
setmoattribute 1 STN=0,RoutingTable=0,IpRoute=Nombre disableConnectivityCheck TRUE

createmo 1 STN=0,RoutingTable=0,IpRoute=IPINT_SA869_SYNC
setmoattribute 1 STN=0,RoutingTable=0,IpRoute=IPINT_SA869_SYNC destIpSubnet '.$array[1][6][21].'/24
setmoattribute 1 STN=0,RoutingTable=0,IpRoute=IPINT_SA869_SYNC nextHopIpAddress '.$array[1][5][21].'
setmoattribute 1 STN=0,RoutingTable=0,IpRoute=IPINT_SA869_SYNC forwardingInterface STN=0,IPInterface=ETH 7?
setmoattribute 1 STN=0,RoutingTable=0,IpRoute=IPINT_SA869_SYNC disableConnectivityCheck TRUE

setmoattribute 1 STN=0,Synchronization=0 synchType timeServer
setmoattribute 1 STN=0,Synchronization=0 depIP_Interface STN=0,IPInterface=
setmoattribute 1 STN=0,Synchronization=0 DSCP_Synchronization 46

createmo 1 STN=0,Synchronization=0,TimeServer='.$array[3][3][45].'
setmoattribute 1 STN=0,Synchronization=0,TimeServer='.$array[3][3][45].' TS_Priority '.$array[3][4][45].'
setmoattribute 1 STN=0,Synchronization=0,TimeServer='.$array[3][3][45].' TS_IP_Address '.$array[1][7][13].'
setmoattribute 1 STN=0,Synchronization=0,TimeServer='.$array[3][3][45].' timeServerType NTP
setmoattribute 1 STN=0,Synchronization=0,TimeServer='.$array[3][3][45].' STN_TS_UDP_Port '.$array[1][2][32].'

createmo 1 STN=0,Synchronization=0,TimeServer='.$array[3][3][46].'
setmoattribute 1 STN=0,Synchronization=0,TimeServer='.$array[3][3][46].' TS_Priority '.$array[3][4][46].'
setmoattribute 1 STN=0,Synchronization=0,TimeServer='.$array[3][3][46].' TS_IP_Address '.$array[1][8][13].'
setmoattribute 1 STN=0,Synchronization=0,TimeServer='.$array[3][3][46].' timeServerType NTP
setmoattribute 1 STN=0,Synchronization=0,TimeServer='.$array[3][3][46].' STN_TS_UDP_Port '.$array[1][2][32].'

checkconsistency 1
commit 1 forcedcommit
endtransaction 1
';
        $estructura = $this->ruta.$this->nombre;
        $archivo    = $estructura.$this->Archivo.$this->nombre.".txt";
        $this->ElimarArchivo($archivo);
        $this->crear_carpeta($estructura);
		$this->CrearArchivo($archivo, $cinsert);
		foreach ($array as $key => $value) {
			foreach ($value as $c => $vc) {
				foreach($vc as $f => $valor){
					//echo $key." => ".$c." => ".$f." => ".$valor."<br>";
				}
			}
		}
		return true;	
	}

    public function __destruct()
    {
        
    }
}
	
?>