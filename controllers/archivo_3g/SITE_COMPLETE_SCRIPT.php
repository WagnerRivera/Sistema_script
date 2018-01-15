<?php
require_once("../Control_Archivo.php");
/////////////////////////////////////////////////////////////////////////
//Clase para la contruccion de la estrctura de los archivos xml, mos y mo
//Fecha de creacion: 29-05-2017
//Creador por: Wagner Rivera
//Fecha de Modificación: 01-06-2017
////////////////////////////////////////////////////////////////////////
class SITE_COMPLETE_SCRIPT extends Control_Archivos
{
    private $ruta    = "archivos/ENodoB/ENodoB_";
    private $Archivo = "/17.SITE_COMPLETE_SCRIPT_";
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
	public function SITE_COMPLETE_SCRIPT_($p_p_17_1)
	{
		
		$cinsert = '/////////////////////////////////////////////////////////////
//
// SCRIPT     : SITE COMPLETE
// NEMONICO   : '.$this->nombre.'
// RNC        : '.$this->nom_rnc.'
// GENERADOR  : INCOBECH
// HORA       : '.$this->Horas().'
// FECHA      : '.$this->Fechas().'
//
/////////////////////////////////////////////////////////////
';
		$parte_1 = $this->Crear_cuerpo_uno();
        $parte_2 = $this->Crear_cuerpo_2($p_p_17_1);
		$cinsert  .= $parte_1.$parte_2; 
    $estructura = $this->ruta.$this->nombre;
    $archivo    = $estructura.$this->Archivo.$this->nombre.".mo";
    $this->ElimarArchivo($archivo);
    $this->crear_carpeta($estructura);
		$this->CrearArchivo($archivo, $cinsert);	
		return true;	
	}

	public function Crear_cuerpo_uno(){
        $continido_1_2_1 ='
CREATE
(
    parent "ManagedElement=1,IpSystem=1"
    identity "Iub"
    moType IpAccessSctp
    exception none
    nrOfAttributes 1
        ipAccessHostEtRef1 Reference "ManagedElement=1,IpSystem=1,IpAccessHostEt=1"
)
CREATE
(
    parent "ManagedElement=1,TransportNetwork=1"
    identity 1
    moType Sctp
    exception none
    nrOfAttributes 3
        ipAccessSctpRef Reference "ManagedElement=1,IpSystem=1,IpAccessSctp=Iub"
        numberOfAssociations Integer 2
        rpuId Ref "ManagedElement=1,SwManagement=1,ReliableProgramUniter=sctp_host"
)
CREATE
(
    parent "ManagedElement=1,NodeBFunction=1"
    identity "Iub_'.$this->nombre.'"
    moType Iub
    exception none
    nrOfAttributes 5
        rbsId Integer 10745
        userLabel String "Iub_'.$this->nombre.'"
        userPlaneIpResourceRef Ref "ManagedElement=1,IpSystem=1,IpAccessHostEt=1"
        controlPlaneTransportOption Struct
        nrOfElements 2
            atm Boolean false
            ipV4 Boolean true
        userPlaneTransportOption Struct
        nrOfElements 2
            atm Boolean false
            ipV4 Boolean true
)
CREATE
(
    parent "ManagedElement=1,NodeBFunction=1,Iub=Iub_'.$this->nombre.'"
    identity 1
    moType NbapCommon
    exception none
    nrOfAttributes 0
)
CREATE
(
    parent "ManagedElement=1,NodeBFunction=1,Iub=Iub_'.$this->nombre.'"
    identity 1
    moType NbapDedicated
    exception none
    nrOfAttributes 0
)
';
		return $continido_1_2_1;
	}

    public function Crear_cuerpo_2($p_17_1){
        $contar = 0;
        $continido_1_2_1 ="";
        foreach ($p_17_1 as $key => $value) {
            if($key != 'RNC' && $key != 'Site' && $key != 'Iub'){
                foreach ($value as $valor) {
                    if($key == 'hsRbrWeight' or $key == 'schHsFlowControlOnOff'){
                        $key = $key.' Array Integer 16'.'
'.str_replace(' ', '
', $valor);
                    }else{
                        $key = $key.' Integer '.$valor;
                    }

                    $continido_1_2_1 .='
SET
(
   mo "ManagedElement=1,NodeBFunction=1,Iub=Iub_UGA745,IubDataStreams=1"
   exception none
   '.$key.'
)
    ';
                    $contar++;
                }
            }          
        }
        $continido_1_2_1 .= '
/////////////////////////////////////
// Definition NodeBFeature
/////////////////////////////////////

SET
(
   mo "ManagedElement=1,NodeBFunction=1"
   exception none
   nbapDscp Integer 40
)
SET
(
   mo "ManagedElement=1,IpSystem=1,IpAccessHostEt=1"
   exception none
   ntpDscp Integer 46
)
///////////////////////
// Queue Q0 ( 0,22 )
///////////////////////
ACTION
(
  actionName setDscpPbit
  mo "ManagedElement=1,Equipment=1,Subrack=1,Slot=1,PlugInUnit=1,ExchangeTerminalIp=1,GigaBitEthernet=1"
  exception none
  nrOfParameters 2
       Integer "22" //dscp
       Integer "1"  //pbit
  returnValue none
)
/////////////////////////
// Queue Q1 ( 16,18,20,26,28 )
/////////////////////////
ACTION
(
  actionName setDscpPbit
  mo "ManagedElement=1,Equipment=1,Subrack=1,Slot=1,PlugInUnit=1,ExchangeTerminalIp=1,GigaBitEthernet=1"
  exception none
  nrOfParameters 2
       Integer "16" //dscp
       Integer "3"  //pbit
  returnValue none
)
ACTION
(
  actionName setDscpPbit
  mo "ManagedElement=1,Equipment=1,Subrack=1,Slot=1,PlugInUnit=1,ExchangeTerminalIp=1,GigaBitEthernet=1"
  exception none
  nrOfParameters 2
       Integer "18" //dscp
       Integer "3"  //pbit
  returnValue none
)
ACTION
(
  actionName setDscpPbit
  mo "ManagedElement=1,Equipment=1,Subrack=1,Slot=1,PlugInUnit=1,ExchangeTerminalIp=1,GigaBitEthernet=1"
  exception none
  nrOfParameters 2
       Integer "20" //dscp
       Integer "3"  //pbit
  returnValue none
)
ACTION
(
  actionName setDscpPbit
  mo "ManagedElement=1,Equipment=1,Subrack=1,Slot=1,PlugInUnit=1,ExchangeTerminalIp=1,GigaBitEthernet=1"
  exception none
  nrOfParameters 2
       Integer "26" //dscp
       Integer "3"  //pbit
  returnValue none
)
ACTION
(
  actionName setDscpPbit
  mo "ManagedElement=1,Equipment=1,Subrack=1,Slot=1,PlugInUnit=1,ExchangeTerminalIp=1,GigaBitEthernet=1"
  exception none
  nrOfParameters 2
       Integer "28" //dscp
       Integer "3"  //pbit
  returnValue none
)
/////////////////////////
// Queue Q2 ( 38 )
/////////////////////////
ACTION
(
  actionName setDscpPbit
  mo "ManagedElement=1,Equipment=1,Subrack=1,Slot=1,PlugInUnit=1,ExchangeTerminalIp=1,GigaBitEthernet=1"
  exception none
  nrOfParameters 2
       Integer "38" //dscp
       Integer "4"  //pbit
  returnValue none
)
/////////////////////////
// Queue Q3 ( 40,42,44,46 )
/////////////////////////
ACTION
(
  actionName setDscpPbit
  mo "ManagedElement=1,Equipment=1,Subrack=1,Slot=1,PlugInUnit=1,ExchangeTerminalIp=1,GigaBitEthernet=1"
  exception none
  nrOfParameters 2
       Integer "40" //dscp
       Integer "5"  //pbit
  returnValue none
)
ACTION
(
  actionName setDscpPbit
  mo "ManagedElement=1,Equipment=1,Subrack=1,Slot=1,PlugInUnit=1,ExchangeTerminalIp=1,GigaBitEthernet=1"
  exception none
  nrOfParameters 2
       Integer "42" //dscp
       Integer "5"  //pbit
  returnValue none
)
ACTION
(
  actionName setDscpPbit
  mo "ManagedElement=1,Equipment=1,Subrack=1,Slot=1,PlugInUnit=1,ExchangeTerminalIp=1,GigaBitEthernet=1"
  exception none
  nrOfParameters 2
       Integer "44" //dscp
       Integer "5"  //pbit
  returnValue none
)
ACTION
(
  actionName setDscpPbit
  mo "ManagedElement=1,Equipment=1,Subrack=1,Slot=1,PlugInUnit=1,ExchangeTerminalIp=1,GigaBitEthernet=1"
  exception none
  nrOfParameters 2
       Integer "46" //dscp
       Integer "5"  //pbit
  returnValue none
)

ECHO "   ACTION - ConfigurationVersion Creation"

ACTION
(
  actionName create
  mo "ManagedElement=1,SwManagement=1,ConfigurationVersion=1"
  exception none
  nrOfParameters 5
  String "Site_Complete"
  String "Site_Complete"
  Integer 5
  String "jnavav"
  String "CV Startable"
  returnValue none
)
ECHO "   ACTION - setStartable ConfigurationVersion"
ACTION
(
  actionName setStartable
  mo "ManagedElement=1,SwManagement=1,ConfigurationVersion=1"
  exception none
  nrOfParameters 1
    String "Site_Complete"
  returnValue none
)';


        return $continido_1_2_1;
    } 

    public function __destruct()
    {
        
    }
}
	
?>