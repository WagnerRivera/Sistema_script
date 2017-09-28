<?php
require_once("../Control_Archivo.php");
/////////////////////////////////////////////////////////////////////////
//Clase para la contruccion de la estrctura de los archivos xml, mos y mo
//Fecha de creacion: 29-05-2017
//Creador por: Wagner Rivera
//Fecha de Modificación: 01-06-2017
////////////////////////////////////////////////////////////////////////
class siteequipment extends Control_Archivos
{
    private $ruta    = "archivos/ENodoB/ENodoB_";
    private $name1 = "/02_";
    private $name2 = "_SiteEquipment";
    private $p1;
    private $p2;
    private $p3;
    private $p4;
    private $p5;
	
	public function __construct($parametros, $p1,$p2,$p3,$p4,$p5)
	{
        $this->nombre  = $parametros[1][0][2];
        $this->p1 = $p1;
        $this->p2 = $p2;
        $this->p3 = $p3;
        $this->p4 = $p4;
        $this->p5 = $p5;
        $this->CREATE_AREA_();        
	}
	/////////////////////////////////////////////////////////////////////////
	//Metodo para la creacion del archivo siteinstall el primero de la lista
	//Fecha de creacion: 29-05-2017
	//Creador por: Wagner Rivera
	//Fecha de Modificación: 01-06-2017
	////////////////////////////////////////////////////////////////////////	
	public function CREATE_AREA_()
	{
		
		$cinsert ='version="1.0" encoding="UTF-8"?>

<!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * 

        Description:

        This is an example file for configuration of 1 band, 3 sectors with 3 Radios.

        Support system configured with RBS6102 cabinet

        Some example data below needs to be changed in order to suit your equipment,
        for example hubPosition values.

        You should select wanted radio standard further, see the following rpc:

        <rpc message-id="Select which Radio Standard that should be added" ... >

        The substitution values that can be found in this file are:

                Substitution values for Cabinet:
                '.$this->p1.'
                '.$this->p2.'
                '.$this->p3.'
                '.$this->p5.'
                '.$this->p4.'

                Substitution values for ENodeBFunction:
                730
                1
                2

-->

<hello xmlns="urn:ietf:params:xml:ns:netconf:base:1.0">
        <capabilities>
                <capability>urn:ietf:params:netconf:base:1.0</capability>
                <capability>urn:com:ericsson:ebase:0.1.0</capability>
                <capability>urn:com:ericsson:ebase:1.1.0</capability>
        </capabilities>
</hello>
]]>]]>

<rpc message-id="Create primary FieldReplaceableUnit with       ports   in first rpc"   xmlns="urn:ietf:params:xml:ns:netconf:base:1.0">
        <edit-config>
                <config>
                        <ManagedElement>
                                <managedElementId>1</managedElementId>
                                <Equipment>
                                        <equipmentId>1</equipmentId>
                                        <FieldReplaceableUnit>
                                                <fieldReplaceableUnitId>1</fieldReplaceableUnitId>
                                                <administrativeState>UNLOCKED</administrativeState>
                                                <RiPort>
                                                        <riPortId>A</riPortId>
                                                </RiPort>
                                                <RiPort>
                                                        <riPortId>B</riPortId>
                                                </RiPort>
                                                <RiPort>
                                                        <riPortId>C</riPortId>
                                                </RiPort>
                                                <TnPort>
                                                        <tnPortId>TN_A</tnPortId>
                                                </TnPort>
                                                <EcPort>
                                                        <ecPortId>1</ecPortId>
                                                        <hubPosition>A1</hubPosition>
                                                </EcPort>
                                                <SyncPort>
                                                        <syncPortId>1</syncPortId>
                                                </SyncPort>
                                        </FieldReplaceableUnit>
                                </Equipment>
                                <NodeSupport>
                                        <nodeSupportId>1</nodeSupportId>
                                        <MpClusterHandling>
                                                <mpClusterHandlingId>1</mpClusterHandlingId>
                                                <primaryCoreRef>ManagedElement=1,Equipment=1,FieldReplaceableUnit=1</primaryCoreRef>
                                        </MpClusterHandling>
                                </NodeSupport>
                        </ManagedElement>
                </config>
        </edit-config>
</rpc>
]]>]]>

<rpc message-id="Select which Radio Standard that should be added" xmlns="urn:ietf:params:xml:ns:netconf:base:1.0">
        <edit-config>
                <config>
                        <ManagedElement>
                                <managedElementId>1</managedElementId>

                                <!-- Uncomment the part containing the wanted standard -->

                                <!-- LTE -->
                                
                                <ENodeBFunction>
                                        <eNodeBFunctionId>1</eNodeBFunctionId>
                                        <eNodeBPlmnId struct="PlmnIdentity">
                                                <mcc>730</mcc>
                                                <mnc>1</mnc>
                                                <mncLength>2</mncLength>
                                        </eNodeBPlmnId> 
                                </ENodeBFunction>

                                <!-- WCDMA -->
                                <!--
                                <NodeBFunction>
                                        <nodeBFunctionId>1</nodeBFunctionId>
                                </NodeBFunction>
                                -->

                                <!-- GSM -->
                                <!--
                                <BtsFunction>
                                        <btsFunctionId>1</btsFunctionId>
                                </BtsFunction>
                                -->

                        </ManagedElement>
                </config>
        </edit-config>
</rpc>
]]>]]>

<rpc message-id="Common Support System hardware configuration" xmlns="urn:ietf:params:xml:ns:netconf:base:1.0">
        <edit-config>
                <config>
                        <ManagedElement xmlns="urn:com:ericsson:ecim:ComTop">
                                <managedElementId>1</managedElementId>
                                <!-- Common support systems FRUs -->
                                <Equipment>
                                        <equipmentId>1</equipmentId>
                                        <EcBus>
                                                <ecBusId>1</ecBusId>
                                                <ecBusConnectorRef>ManagedElement=1,Equipment=1,FieldReplaceableUnit=1</ecBusConnectorRef>
                                        </EcBus>
                                        <FieldReplaceableUnit>
                                                <fieldReplaceableUnitId>1</fieldReplaceableUnitId>
                                                <positionRef>ManagedElement=1,Equipment=1,Cabinet=1</positionRef>
                                                <EcPort>
                                                        <ecPortId>1</ecPortId>
                                                        <hubPosition>A</hubPosition>
                                                        <ecBusRef>ManagedElement=1,Equipment=1,EcBus=1</ecBusRef>
                                                </EcPort>
                                        </FieldReplaceableUnit>
                                        <FieldReplaceableUnit>
                                                <fieldReplaceableUnitId>SUP</fieldReplaceableUnitId>
                                                <administrativeState>UNLOCKED</administrativeState>
                                                <positionRef>ManagedElement=1,Equipment=1,Cabinet=1</positionRef>
                                                <EcPort>
                                                        <ecPortId>1</ecPortId>
                                                        <cascadingOrder>0</cascadingOrder>
                                                        <hubPosition>NA</hubPosition>
                                                        <ecBusRef>ManagedElement=1,Equipment=1,EcBus=1</ecBusRef>
                                                </EcPort>
                                                <AlarmPort>
                                                        <alarmPortId>1</alarmPortId>
                                                        <administrativeState>UNLOCKED</administrativeState>
                                                        <alarmSlogan>ExternalAlarmSAUAlarmPort1</alarmSlogan>
                                                </AlarmPort>
                                        </FieldReplaceableUnit>
                                        <Cabinet>
                                                <cabinetId>1</cabinetId>
                                                <smokeDetector>false</smokeDetector>
                                                <productData>
                                                        <productionDate>'.$this->p1.'</productionDate>
                                                        <productName>'.$this->p2.'</productName>
                                                        <productNumber>'.$this->p3.'</productNumber>
                                                        <productRevision>'.$this->p5.'</productRevision>
                                                        <serialNumber>'.$this->p4.'</serialNumber>
                                                </productData>
                                        </Cabinet>
                                </Equipment>
                        </ManagedElement>
                </config>
        </edit-config>
</rpc>
]]>]]>

<rpc message-id="Common Support System functional configuration" xmlns="urn:ietf:params:xml:ns:netconf:base:1.0">
        <edit-config>
                <config>
                        <ManagedElement>
                                <managedElementId>1</managedElementId>
                                <EquipmentSupportFunction>
                                        <equipmentSupportFunctionId>1</equipmentSupportFunctionId>
                                        <supportSystemControl>true</supportSystemControl>
                                        <Climate>
                                                <climateId>1</climateId>
                                                <climateControlMode>NORMAL</climateControlMode>
                                                <controlDomainRef>ManagedElement=1,Equipment=1,Cabinet=1</controlDomainRef>
                                        </Climate>
                                </EquipmentSupportFunction>
                        </ManagedElement>
                </config>
        </edit-config>
</rpc>
]]>]]>


<rpc message-id="Close session" xmlns="urn:ietf:params:xml:ns:netconf:base:1.0">
	<close-session />
</rpc>
]]>]]>';
		
        $estructura = $this->ruta.$this->nombre;
        $archivo    = $estructura.$this->name1.$this->nombre.$this->name2.".xml";
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