<?php
require_once("../Control_Archivo.php");
session_start();
/////////////////////////////////////////////////////////////////////////
//Clase para la contruccion de la estrctura de los archivos xml, mos y mo
//Fecha de creacion: 29-05-2017
//Creador por: Wagner Rivera
//Fecha de Modificación: 01-06-2017
////////////////////////////////////////////////////////////////////////
class Script_TCU_On_Site_Incobech extends Control_Archivos
{
    private $ruta    = "archivos/tcu/Tcu_";
    private $Archivo = "/Script_TCU_On_Site_Incobech_";
    private $nombre;
    private $puerta  = array('TN Fₒ' => 'TN_F',
								'TN Gₒ' => 'TN_G',
								'TN Hₒ' => 'TN_H',
								'TN Dₑ' => 'TN_D',
								'TN Eₒ' => 'TN_E',);
	
	public function __construct($parametros, $array)
	{
		$this->nombre = $parametros[0][2][4];
        $this->CREATE_AREA_($parametros, $array);
	}
	/////////////////////////////////////////////////////////////////////////
	//Metodo para la creacion del archivo siteinstall el primero de la lista
	//Fecha de creacion: 29-05-2017
	//Creador por: Wagner Rivera
	//Fecha de Modificación: 01-06-2017
	////////////////////////////////////////////////////////////////////////	
	public function CREATE_AREA_($array, $estructura)
	{
		$contar = 0;
		$contar1 = 0;
		$cinsert = '--------------------------------------------------------
Fecha Creacion '.$this->Fechas().' '.$this->Horas().'
Script_TCU_'.$array[0][2][4].'_
Nemonico del POP '.$array[0][2][4].'
Name_Site '.$array[0][2][3].'
Generador INCOBECH Usuario '.$_SESSION['nombre'].'
Team_Integracion
--------------------------------------------------------

resettofactorysetting
deleteaimo
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

createmo 1 stn=0,bridge='.$array[3][4][7].'
createmo 1 stn=0,bridge='.$array[3][5][7].'
createmo 1 stn=0,bridge='.$array[3][6][7].'
createmo 1 stn=0,bridge='.$array[3][7][7].'
createmo 1 stn=0,bridge='.$array[3][8][7].'
createmo 1 stn=0,bridge='.$array[3][9][7].'
createmo 1 stn=0,bridge='.$array[3][10][7].'
createmo 1 stn=0,bridge='.$array[3][11][7].'
'; // termina la primera parte del archivo

foreach ($estructura as $hoja => $value) {
	foreach ($value as $columna => $col) {
		foreach ($col as $fila => $valor) {
			//echo $hoja." == ".$columna." == ".$fila." => ".$valor."<br>";
			if($hoja == "Parámetros Tx SIU-TCU"){
				if($columna == 6){
					if($fila > 30 && $fila < 34){
						$portidt[] = $valor;
					}

					if($fila > 39 && $fila < 42){
						if(isset($valor)){
							$portid[] = $valor;
						}
					}
				}

				if($columna == 7){
					if($fila > 30 && $fila < 34){
						$cinsert .= "
createmo 1 stn=0,ethernetinterface=".$valor."
setmoattribute 1 stn=0,ethernetinterface=".$valor." mode gigabit
setmoattribute 1 stn=0,ethernetinterface=".$valor." portid ".$this->puerta[$portidt[$contar]]."
";
						$contar++;
					}
				}

				if($columna == 7){
					if($fila > 39 && $fila < 42){
						if(isset($valor)){
							$cinsert .= "
createmo 1 stn=0,ethernetinterface=".$valor."
setmoattribute 1 stn=0,ethernetinterface=".$valor." mode 100MBitfullduplex
setmoattribute 1 stn=0,ethernetinterface=".$valor." portid ".$this->puerta[$portid[$contar1]]."
";
							$contar1++;
						}
					}
				}
			}			
		}
	}
}
	$cinsert .= '
createmo 1 stn=0,vlangroup='.$array[3][5][12].'
setmoattribute 1 stn=0,vlangroup='.$array[3][5][12].' deplinklayer stn=0,ethernetinterface='.$array[3][4][12].'

createmo 1 stn=0,vlangroup='.$array[3][5][13].'
setmoattribute 1 stn=0,vlangroup='.$array[3][5][13].' deplinklayer stn=0,ethernetinterface='.$array[3][4][13].'

createmo 1 stn=0,vlangroup='.$array[3][5][14].'
setmoattribute 1 stn=0,vlangroup='.$array[3][5][14].' deplinklayer stn=0,ethernetinterface='.$array[3][4][14].'

createmo 1 stn=0,vlangroup='.$array[3][5][21].'
setmoattribute 1 stn=0,vlangroup='.$array[3][5][21].' deplinklayer stn=0,ethernetinterface='.$array[3][4][21].'


createmo 1 stn=0,vlangroup='.$array[3][5][21].',vlan='.$array[3][10][6].'
setmoattribute 1 stn=0,vlangroup='.$array[3][5][21].',vlan='.$array[3][10][6].' tagvalue 18
setmoattribute 1 stn=0,vlangroup='.$array[3][5][21].',vlan='.$array[3][10][6].' tagged true
setmoattribute 1 stn=0,vlangroup='.$array[3][5][21].',vlan='.$array[3][10][6].' depBridge STN=0,Bridge='.$array[3][10][7].'

createmo 1 stn=0,vlangroup='.$array[3][5][21].',vlan='.$array[3][11][6].'
setmoattribute 1 stn=0,vlangroup='.$array[3][5][21].',vlan='.$array[3][11][6].' tagvalue 23
setmoattribute 1 stn=0,vlangroup='.$array[3][5][21].',vlan='.$array[3][11][6].' tagged true
setmoattribute 1 stn=0,vlangroup='.$array[3][5][21].',vlan='.$array[3][11][6].' depBridge STN=0,Bridge='.$array[3][11][7].'

createmo 1 stn=0,vlangroup='.$array[3][5][21].',vlan='.$array[3][2][6].'
setmoattribute 1 stn=0,vlangroup='.$array[3][5][21].',vlan='.$array[3][2][6].' tagvalue '.$array[1][2][21].'
setmoattribute 1 stn=0,vlangroup='.$array[3][5][21].',vlan='.$array[3][2][6].' tagged true

createmo 1 stn=0,vlangroup='.$array[3][5][21].',vlan='.$array[3][4][6].'
setmoattribute 1 stn=0,vlangroup='.$array[3][5][21].',vlan='.$array[3][4][6].' tagvalue '.$array[1][2][17].'
setmoattribute 1 stn=0,vlangroup='.$array[3][5][21].',vlan='.$array[3][4][6].' tagged true
setmoattribute 1 stn=0,vlangroup='.$array[3][5][21].',vlan='.$array[3][4][6].' depBridge STN=0,Bridge='.$array[3][4][7].'

createmo 1 stn=0,vlangroup='.$array[3][5][21].',vlan='.$array[3][5][6].'
setmoattribute 1 stn=0,vlangroup='.$array[3][5][21].',vlan='.$array[3][5][6].' tagvalue '.$array[1][3][17].'
setmoattribute 1 stn=0,vlangroup='.$array[3][5][21].',vlan='.$array[3][5][6].' tagged true
setmoattribute 1 stn=0,vlangroup='.$array[3][5][21].',vlan='.$array[3][5][6].' depBridge STN=0,Bridge='.$array[3][5][7].' 
';
	
	if($array[1][2][17] != $array[1][4][17]){
		$cinsert2 .= '
createmo 1 stn=0,vlangroup='.$array[3][5][21].',vlan='.$array[3][6][6].'
setmoattribute 1 stn=0,vlangroup='.$array[3][5][21].',vlan='.$array[3][6][6].' tagvalue '.$array[1][4][17].'
setmoattribute 1 stn=0,vlangroup='.$array[3][5][21].',vlan='.$array[3][6][6].' tagged true
setmoattribute 1 stn=0,vlangroup='.$array[3][5][21].',vlan='.$array[3][6][6].' depBridge STN=0,Bridge='.$array[3][6][7].'

createmo 1 stn=0,vlangroup='.$array[3][5][21].',vlan='.$array[3][7][6].'
setmoattribute 1 stn=0,vlangroup='.$array[3][5][21].',vlan='.$array[3][7][6].' tagvalue '.$array[1][5][17].'
setmoattribute 1 stn=0,vlangroup='.$array[3][5][21].',vlan='.$array[3][7][6].' tagged true
setmoattribute 1 stn=0,vlangroup='.$array[3][5][21].',vlan='.$array[3][7][6].' depBridge STN=0,Bridge='.$array[3][6][7].'
';
	}

	$cinsert3 = '
createmo 1 stn=0,vlangroup='.$array[3][5][21].',vlan='.$array[3][8][6].'
setmoattribute 1 stn=0,vlangroup='.$array[3][5][21].',vlan='.$array[3][8][6].' tagvalue '.$array[1][6][17].'
setmoattribute 1 stn=0,vlangroup='.$array[3][5][21].',vlan='.$array[3][8][6].' tagged true
setmoattribute 1 stn=0,vlangroup='.$array[3][5][21].',vlan='.$array[3][8][6].' depBridge STN=0,Bridge='.$array[3][8][7].'

createmo 1 stn=0,vlangroup='.$array[3][5][21].',vlan='.$array[3][9][6].'
setmoattribute 1 stn=0,vlangroup='.$array[3][5][21].',vlan='.$array[3][9][6].' tagvalue '.$array[1][7][17].'
setmoattribute 1 stn=0,vlangroup='.$array[3][5][21].',vlan='.$array[3][9][6].' tagged true
setmoattribute 1 stn=0,vlangroup='.$array[3][5][21].',vlan='.$array[3][9][6].' depBridge STN=0,Bridge='.$array[3][9][7].'

createmo 1 stn=0,vlangroup='.$array[3][5][12].',vlan='.$array[3][4][6].'
setmoattribute 1 stn=0,vlangroup='.$array[3][5][12].',vlan='.$array[3][4][6].' tagvalue '.$array[1][2][17].'
setmoattribute 1 stn=0,vlangroup='.$array[3][5][12].',vlan='.$array[3][4][6].' tagged true
setmoattribute 1 stn=0,vlangroup='.$array[3][5][12].',vlan='.$array[3][4][6].' depBridge STN=0,Bridge='.$array[3][4][7].'

createmo 1 stn=0,vlangroup='.$array[3][5][12].',vlan='.$array[3][5][6].'
setmoattribute 1 stn=0,vlangroup='.$array[3][5][12].',vlan='.$array[3][5][6].' tagvalue '.$array[1][3][17].'
setmoattribute 1 stn=0,vlangroup='.$array[3][5][12].',vlan='.$array[3][5][6].' tagged true
setmoattribute 1 stn=0,vlangroup='.$array[3][5][12].',vlan='.$array[3][5][6].' depBridge STN=0,Bridge='.$array[3][5][7].'';

		if($array[1][2][17] != $array[1][4][17]){
			$cinsert3 .= '
createmo 1 stn=0,vlangroup='.$array[3][5][13].',vlan='.$array[3][6][6].'
setmoattribute 1 stn=0,vlangroup='.$array[3][5][13].',vlan='.$array[3][6][6].' tagvalue '.$array[1][4][17].'
setmoattribute 1 stn=0,vlangroup='.$array[3][5][13].',vlan='.$array[3][6][6].' tagged true
setmoattribute 1 stn=0,vlangroup='.$array[3][5][13].',vlan='.$array[3][6][6].' depBridge STN=0,Bridge='.$array[3][6][7].'

createmo 1 stn=0,vlangroup='.$array[3][5][13].',vlan='.$array[3][7][6].'
setmoattribute 1 stn=0,vlangroup='.$array[3][5][13].',vlan='.$array[3][7][6].' tagvalue '.$array[1][5][17].'
setmoattribute 1 stn=0,vlangroup='.$array[3][5][13].',vlan='.$array[3][7][6].' tagged true
setmoattribute 1 stn=0,vlangroup='.$array[3][5][13].',vlan='.$array[3][7][6].' depBridge STN=0,Bridge='.$array[3][7][7].'';
		}else{
			$cinsert3 .= '
createmo 1 stn=0,vlangroup='.$array[3][5][13].',vlan='.$array[3][6][6].'
setmoattribute 1 stn=0,vlangroup='.$array[3][5][13].',vlan='.$array[3][6][6].' tagvalue '.$array[1][4][17].'
setmoattribute 1 stn=0,vlangroup='.$array[3][5][13].',vlan='.$array[3][6][6].' tagged true
setmoattribute 1 stn=0,vlangroup='.$array[3][5][13].',vlan='.$array[3][6][6].' depBridge STN=0,Bridge='.$array[3][4][7].'

createmo 1 stn=0,vlangroup='.$array[3][5][13].',vlan='.$array[3][7][6].'
setmoattribute 1 stn=0,vlangroup='.$array[3][5][13].',vlan='.$array[3][7][6].' tagvalue '.$array[1][5][17].'
setmoattribute 1 stn=0,vlangroup='.$array[3][5][13].',vlan='.$array[3][7][6].' tagged true
setmoattribute 1 stn=0,vlangroup='.$array[3][5][13].',vlan='.$array[3][7][6].' depBridge STN=0,Bridge='.$array[3][5][7].'';
		}

$cinsert3 .='
createmo 1 stn=0,vlangroup='.$array[3][5][14].',vlan='.$array[1][6][16].'
setmoattribute 1 stn=0,vlangroup='.$array[3][5][14].',vlan='.$array[1][6][16].' tagvalue '.$array[1][6][17].'
setmoattribute 1 stn=0,vlangroup='.$array[3][5][14].',vlan='.$array[1][6][16].' tagged true
setmoattribute 1 stn=0,vlangroup='.$array[3][5][14].',vlan='.$array[1][6][16].' depBridge STN=0,Bridge='.$array[3][8][7].'

createmo 1 stn=0,vlangroup='.$array[3][5][14].',vlan='.$array[1][7][16].'
setmoattribute 1 stn=0,vlangroup='.$array[3][5][14].',vlan='.$array[1][7][16].' tagvalue '.$array[1][7][17].'
setmoattribute 1 stn=0,vlangroup='.$array[3][5][14].',vlan='.$array[1][7][16].' tagged true
setmoattribute 1 stn=0,vlangroup='.$array[3][5][14].',vlan='.$array[1][7][16].' depBridge STN=0,Bridge='.$array[3][9][7].'


createmo 1 stn=0,ipinterface='.$array[3][3][25].'
setmoattribute 1 stn=0 depip_interface stn=0,ipinterface='.$array[3][3][25].'
setmoattribute 1 stn=0,IPInterface='.$array[3][3][25].' primaryIP_Address '.$array[1][2][10].'
setmoattribute 1 stn=0,IPInterface='.$array[3][3][25].' primarySubNetMask '.$array[1][3][10].'
setmoattribute 1 stn=0,IPInterface='.$array[3][3][25].' depLinkLayer STN=0,Bridge='.$array[3][11][7].'

createmo 1 stn=0,ipinterface='.$array[3][3][26].'
setmoattribute 1 stn=0,IPInterface='.$array[3][3][26].' primaryIP_Address '.$array[1][3][13].'
setmoattribute 1 stn=0,IPInterface='.$array[3][3][26].' primarySubNetMask '.$array[1][4][13].'
setmoattribute 1 stn=0,IPInterface='.$array[3][3][26].' depLinkLayer STN=0,Bridge='.$array[3][10][7].'

!Parámetros_Servicios_2G

createmo 1 stn=0,ipinterface='.$array[3][3][27].'
setmoattribute 1 stn=0,IPInterface='.$array[3][3][27].' primaryIP_Address '.$array[1][3][21].'
setmoattribute 1 stn=0,IPInterface='.$array[3][3][27].' primarySubNetMask '.$array[1][4][21].'
setmoattribute 1 stn=0,IPInterface='.$array[3][3][27].' depLinkLayer STN=0,vlangroup='.$array[3][5][21].',vlan='.$array[3][2][6].'

createmo 1 STN=0,RoutingTable=0,IpRoute='.$array[3][3][31].'
setmoattribute 1 STN=0,RoutingTable=0,IpRoute='.$array[3][3][31].' destIpSubnet '.$array[1][9][13].'
setmoattribute 1 STN=0,RoutingTable=0,IpRoute='.$array[3][3][31].' nextHopIpAddress '.$array[1][6][13].'
setmoattribute 1 STN=0,RoutingTable=0,IpRoute='.$array[3][3][31].' forwardingInterface STN=0,IPInterface='.$array[3][3][26].'
setmoattribute 1 STN=0,RoutingTable=0,IpRoute='.$array[3][3][31].' disableConnectivityCheck TRUE

createmo 1 STN=0,RoutingTable=0,IpRoute='.$array[3][3][32].'
setmoattribute 1 STN=0,RoutingTable=0,IpRoute='.$array[3][3][32].' destIpSubnet '.$array[1][11][13].'
setmoattribute 1 STN=0,RoutingTable=0,IpRoute='.$array[3][3][32].' nextHopIpAddress 10.64.62.1
setmoattribute 1 STN=0,RoutingTable=0,IpRoute='.$array[3][3][32].' forwardingInterface STN=0,IPInterface='.$array[3][3][26].'
setmoattribute 1 STN=0,RoutingTable=0,IpRoute='.$array[3][3][32].' disableConnectivityCheck TRUE


createmo 1 STN=0,RoutingTable=0,IpRoute='.$array[3][3][30].'
setmoattribute 1 STN=0,RoutingTable=0,IpRoute='.$array[3][3][30].' destIpSubnet 0.0.0.0/0
setmoattribute 1 STN=0,RoutingTable=0,IpRoute='.$array[3][3][30].' nextHopIpAddress '.$array[1][4][10].'
setmoattribute 1 STN=0,RoutingTable=0,IpRoute='.$array[3][3][30].' forwardingInterface STN=0,IPInterface='.$array[3][3][25].'
setmoattribute 1 STN=0,RoutingTable=0,IpRoute='.$array[3][3][30].' disableConnectivityCheck TRUE

createmo 1 STN=0,RoutingTable=0,IpRoute='.$array[3][3][33].'
setmoattribute 1 STN=0,RoutingTable=0,IpRoute='.$array[3][3][33].' destIpSubnet '.$array[1][6][21].'/24
setmoattribute 1 STN=0,RoutingTable=0,IpRoute='.$array[3][3][33].' nextHopIpAddress '.$array[1][5][21].'
setmoattribute 1 STN=0,RoutingTable=0,IpRoute='.$array[3][3][33].' forwardingInterface STN=0,IPInterface='.$array[3][3][27].'
setmoattribute 1 STN=0,RoutingTable=0,IpRoute='.$array[3][3][33].' disableConnectivityCheck TRUE

setmoattribute 1 STN=0,Synchronization=0 synchType timeServer
setmoattribute 1 STN=0,Synchronization=0 depIP_Interface STN=0,IPInterface='.$array[3][3][26].'
setmoattribute 1 STN=0,Synchronization=0 DSCP_Synchronization '.$array[1][2][34].'

createmo 1 STN=0,Synchronization=0,TimeServer=SERVT_NTP1
setmoattribute 1 STN=0,Synchronization=0,TimeServer=SERVT_NTP1 TS_Priority '.$array[1][2][35].'
setmoattribute 1 STN=0,Synchronization=0,TimeServer=SERVT_NTP1 TS_IP_Address '.$array[1][7][13].'
setmoattribute 1 STN=0,Synchronization=0,TimeServer=SERVT_NTP1 timeServerType NTP
setmoattribute 1 STN=0,Synchronization=0,TimeServer=SERVT_NTP1 STN_TS_UDP_Port '.$array[1][2][32].'

createmo 1 STN=0,Synchronization=0,TimeServer=SERVT_NTP2
setmoattribute 1 STN=0,Synchronization=0,TimeServer=SERVT_NTP2 TS_Priority '.$array[1][2][36].'
setmoattribute 1 STN=0,Synchronization=0,TimeServer=SERVT_NTP2 TS_IP_Address '.$array[1][8][13].'
setmoattribute 1 STN=0,Synchronization=0,TimeServer=SERVT_NTP2 timeServerType NTP
setmoattribute 1 STN=0,Synchronization=0,TimeServer=SERVT_NTP2 STN_TS_UDP_Port '.$array[1][2][32].'

createmo 1 STN=0,Synchronization=0,TimeServer=SERVT_NTP3
setmoattribute 1 STN=0,Synchronization=0,TimeServer=SERVT_NTP3 TS_Priority 30
setmoattribute 1 STN=0,Synchronization=0,TimeServer=SERVT_NTP3 TS_IP_Address '.$array[1][10][13].'
setmoattribute 1 STN=0,Synchronization=0,TimeServer=SERVT_NTP3 timeServerType NTP
setmoattribute 1 STN=0,Synchronization=0,TimeServer=SERVT_NTP3 STN_TS_UDP_Port '.$array[1][2][32].'



checkconsistency 1
commit 1 forcedcommit
endtransaction 1

';
		
		$cinsert .= $cinsert2.$cinsert3;
        $estructura = $this->ruta.$this->nombre;
        $archivo    = $estructura.$this->Archivo.$this->nombre.".txt";
        
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