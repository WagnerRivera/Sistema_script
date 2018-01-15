<?php
require_once("../Control_Archivo.php");
/////////////////////////////////////////////////////////////////////////
//Clase para la contruccion de la estrctura de los archivos xml, mos y mo
//Fecha de creacion: 29-05-2017
//Creador por: Wagner Rivera
//Fecha de Modificación: 01-06-2017
////////////////////////////////////////////////////////////////////////
class sitebasic extends Control_Archivos
{
    private $ruta    = "archivos/ENodoB/ENodoB_";
    private $name1 = "/01_";
    private $name2 = "_SiteBasic";
	
	public function __construct($parametros, $trama)
	{
        $this->nombre  = $parametros[1][0][2];
        $this->CREATE_AREA_($parametros, $trama);
	}
	/////////////////////////////////////////////////////////////////////////
	//Metodo para la creacion del archivo siteinstall el primero de la lista
	//Fecha de creacion: 29-05-2017
	//Creador por: Wagner Rivera
	//Fecha de Modificación: 01-06-2017
	////////////////////////////////////////////////////////////////////////	
	public function CREATE_AREA_($array, $trama)
	{
		
		$cinsert ='
<?xml version="1.0" encoding="UTF-8"?>

<hello xmlns="urn:ietf:params:xml:ns:netconf:base:1.0">

  <capabilities>

    <capability>urn:ietf:params:netconf:base:1.0</capability>

  </capabilities>

</hello>

]]>]]>

<rpc message-id="1" xmlns="urn:ietf:params:xml:ns:netconf:base:1.0">

  <edit-config>

    <target>

      <running />

    </target>

    <config xmlns:xc="urn:ietf:params:xml:ns:netconf:base:1.0">

      <ManagedElement xmlns="urn:com:ericsson:ecim:ComTop">

        <managedElementId>1</managedElementId>

        <SystemFunctions>

          <systemFunctionsId>1</systemFunctionsId>

          <Lm xmlns="urn:com:ericsson:ecim:RcsLM">

            <lmId>1</lmId>

            <fingerprint>'.$this->nombre.'</fingerprint>

          </Lm>

        </SystemFunctions>

      </ManagedElement>

    </config>

  </edit-config>

</rpc>

]]>]]>

<rpc message-id="Closing" xmlns="urn:ietf:params:xml:ns:netconf:base:1.0">

  <close-session></close-session>

</rpc>

]]>]]>

<?xml version="1.0" encoding="UTF-8"?>

<hello xmlns="urn:ietf:params:xml:ns:netconf:base:1.0">

  <capabilities>

    <capability>urn:ietf:params:netconf:base:1.0</capability>

  </capabilities>

</hello>

]]>]]>

<rpc message-id="2" xmlns="urn:ietf:params:xml:ns:netconf:base:1.0">

  <edit-config>

    <target>

      <running />

    </target>

    <config xmlns:xc="urn:ietf:params:xml:ns:netconf:base:1.0">

      <ManagedElement xmlns="urn:com:ericsson:ecim:ComTop">

        <managedElementId>1</managedElementId>

        <SystemFunctions>

          <systemFunctionsId>1</systemFunctionsId>

          <Lm xmlns="urn:com:ericsson:ecim:RcsLM">

            <lmId>1</lmId>

            <FeatureState>

              <featureStateId>CXC4011823</featureStateId>

              <featureState>ACTIVATED</featureState>

            </FeatureState>

          </Lm>

        </SystemFunctions>

      </ManagedElement>

    </config>

  </edit-config>

</rpc>

]]>]]>

<rpc message-id="Closing" xmlns="urn:ietf:params:xml:ns:netconf:base:1.0">

  <close-session></close-session>

</rpc>

]]>]]>

<?xml version="1.0" encoding="UTF-8"?>

<hello xmlns="urn:ietf:params:xml:ns:netconf:base:1.0">

  <capabilities>

    <capability>urn:ietf:params:netconf:base:1.0</capability>

  </capabilities>

</hello>

]]>]]>

<rpc message-id="3" xmlns="urn:ietf:params:xml:ns:netconf:base:1.0">

  <edit-config>

    <target>

      <running />

    </target>

    <config xmlns:xc="urn:ietf:params:xml:ns:netconf:base:1.0">

      <ManagedElement xmlns="urn:com:ericsson:ecim:ComTop">

        <managedElementId>1</managedElementId>

        <SystemFunctions>

          <systemFunctionsId>1</systemFunctionsId>

          <SecM xmlns="urn:com:ericsson:ecim:ComSecM">

            <secMId>1</secMId>

            <UserManagement>

              <userManagementId>1</userManagementId>

              <LocalAuthorizationMethod xmlns="urn:com:ericsson:ecim:ComLocalAuthorization">

                <localAuthorizationMethodId>1</localAuthorizationMethodId>

                <administrativeState>UNLOCKED</administrativeState>

              </LocalAuthorizationMethod>

              <UserIdentity xmlns="urn:com:ericsson:ecim:RcsUser">

                <userIdentityId>1</userIdentityId>

                <MaintenanceUser>

                  <maintenanceUserId>1</maintenanceUserId>

                  <userName>rbs</userName>

                  <password>

                    <cleartext />

                    <password>rbs</password>

                  </password>

                </MaintenanceUser>

              </UserIdentity>

            </UserManagement>

          </SecM>

          <SysM xmlns="urn:com:ericsson:ecim:RcsSysM">

            <sysMId>1</sysMId>

            <CliSsh>

              <cliSshId>1</cliSshId>

              <administrativeState>UNLOCKED</administrativeState>

              <port>2023</port>

            </CliSsh>

            <NetconfSsh>

              <netconfSshId>1</netconfSshId>

              <administrativeState>UNLOCKED</administrativeState>

              <port>830</port>

            </NetconfSsh>

            <NtpServer>

              <ntpServerId>1</ntpServerId>

              <serverAddress>172.16.50.41</serverAddress>

              <administrativeState>UNLOCKED</administrativeState>

            </NtpServer>

            <NtpServer>

              <ntpServerId>2</ntpServerId>

              <serverAddress>172.16.50.42</serverAddress>

              <administrativeState>UNLOCKED</administrativeState>

            </NtpServer>

          </SysM>

        </SystemFunctions>

        <Transport>

          <transportId>1</transportId>

          <Router xmlns="urn:com:ericsson:ecim:RtnL3Router">

            <routerId>vr_OAM</routerId>

          </Router>

          <EthernetPort xmlns="urn:com:ericsson:ecim:RtnL2EthernetPort">

            <ethernetPortId>'.$trama.'</ethernetPortId>

            <administrativeState>UNLOCKED</administrativeState>

            <admOperatingMode>1G_FULL</admOperatingMode>

            <autoNegEnable>true</autoNegEnable>

            <encapsulation>ManagedElement=1,Equipment=1,FieldReplaceableUnit=1,TnPort='.$trama.'</encapsulation>

            <userLabel>'.$trama.'</userLabel>

          </EthernetPort>

          <VlanPort xmlns="urn:com:ericsson:ecim:RtnL2VlanPort">

            <vlanPortId>OAM</vlanPortId>

            <encapsulation>ManagedElement=1,Transport=1,EthernetPort='.$trama.'</encapsulation>

            <vlanId>'.$array[1][14][2].'</vlanId>

          </VlanPort>

          <Router xmlns="urn:com:ericsson:ecim:RtnL3Router">

            <routerId>vr_OAM</routerId>

            <InterfaceIPv4 xmlns="urn:com:ericsson:ecim:RtnL3InterfaceIPv4">

              <interfaceIPv4Id>1</interfaceIPv4Id>

              <encapsulation>ManagedElement=1,Transport=1,VlanPort=OAM</encapsulation>

              <userLabel>vr_OAM</userLabel>

              <AddressIPv4>

                <addressIPv4Id>1</addressIPv4Id>

                <address>'.$array[1][15][2].'/'.$array[1][17][2].'</address>

              </AddressIPv4>

            </InterfaceIPv4>

          </Router>

        </Transport>

        <SystemFunctions>

          <systemFunctionsId>1</systemFunctionsId>

          <SysM xmlns="urn:com:ericsson:ecim:RcsSysM">

            <sysMId>1</sysMId>

            <OamAccessPoint>

              <oamAccessPointId>1</oamAccessPointId>

              <accessPoint>ManagedElement=1,Transport=1,Router=vr_OAM,InterfaceIPv4=1,AddressIPv4=1</accessPoint>

            </OamAccessPoint>

          </SysM>

        </SystemFunctions>

        <Transport>

          <transportId>1</transportId>

          <Ntp xmlns="urn:com:ericsson:ecim:RsyncNtp">

            <ntpId>1</ntpId>

          </Ntp>

          <Router xmlns="urn:com:ericsson:ecim:RtnL3Router">

            <routerId>LTE</routerId>

          </Router>

          <VlanPort xmlns="urn:com:ericsson:ecim:RtnL2VlanPort">

            <vlanPortId>LTE</vlanPortId>

            <encapsulation>ManagedElement=1,Transport=1,EthernetPort='.$trama.'</encapsulation>

            <vlanId>'.$array[1][10][2].'</vlanId>

          </VlanPort>

          <Router xmlns="urn:com:ericsson:ecim:RtnL3Router">

            <routerId>LTE</routerId>

            <InterfaceIPv4 xmlns="urn:com:ericsson:ecim:RtnL3InterfaceIPv4">

              <interfaceIPv4Id>1</interfaceIPv4Id>

              <encapsulation>ManagedElement=1,Transport=1,VlanPort=LTE</encapsulation>

              <userLabel>LTE</userLabel>

              <AddressIPv4>

                <addressIPv4Id>1</addressIPv4Id>

                <address>'.$array[1][11][2].'/'.$array[1][13][2].'</address>

              </AddressIPv4>

            </InterfaceIPv4>

          </Router>

          <Router xmlns="urn:com:ericsson:ecim:RtnL3Router">

            <routerId>vr_OAM</routerId>

            <DnsClient xmlns="urn:com:ericsson:ecim:RtnDnsClient">

              <dnsClientId>1</dnsClientId>

              <configurationMode>MANUAL</configurationMode>

              <serverAddress>10.170.15.20</serverAddress>

            </DnsClient>

            <RouteTableIPv4Static xmlns="urn:com:ericsson:ecim:RtnRoutesStaticRouteIPv4">

              <routeTableIPv4StaticId>1</routeTableIPv4StaticId>

              <Dst>

                <dstId>1</dstId>

                <dst>0.0.0.0/0</dst>

                <NextHop>

                  <nextHopId>1</nextHopId>

                  <address>'.$array[1][16][2].'</address>

                  <adminDistance>1</adminDistance>

                </NextHop>

              </Dst>

            </RouteTableIPv4Static>

          </Router>

          <Router xmlns="urn:com:ericsson:ecim:RtnL3Router">

            <routerId>LTE</routerId>

            <RouteTableIPv4Static xmlns="urn:com:ericsson:ecim:RtnRoutesStaticRouteIPv4">

              <routeTableIPv4StaticId>1</routeTableIPv4StaticId>

              <Dst>

                <dstId>1</dstId>

                <dst>0.0.0.0/0</dst>

                <NextHop>

                  <nextHopId>1</nextHopId>

                  <address>'.$array[1][12][2].'</address>

                  <adminDistance>1</adminDistance>

                </NextHop>

              </Dst>

            </RouteTableIPv4Static>

          </Router>

        </Transport>

        <Equipment xmlns="urn:com:ericsson:ecim:ReqEquipment">

          <equipmentId>1</equipmentId>

          <FieldReplaceableUnit xmlns="urn:com:ericsson:ecim:ReqFieldReplaceableUnit">

            <fieldReplaceableUnitId>1</fieldReplaceableUnitId>

            <TnPort xmlns="urn:com:ericsson:ecim:ReqTnPort">

              <tnPortId>'.$trama.'</tnPortId>

            </TnPort>

          </FieldReplaceableUnit>

        </Equipment>

      </ManagedElement>

    </config>

  </edit-config>

</rpc>

]]>]]>

<rpc message-id="Closing" xmlns="urn:ietf:params:xml:ns:netconf:base:1.0">

  <close-session></close-session>

</rpc>

]]>]]>

<?xml version="1.0" encoding="UTF-8"?>

<hello xmlns="urn:ietf:params:xml:ns:netconf:base:1.0">

  <capabilities>

    <capability>urn:ietf:params:netconf:base:1.0</capability>

  </capabilities>

</hello>

]]>]]>

<rpc message-id="4" xmlns="urn:ietf:params:xml:ns:netconf:base:1.0">

  <edit-config>

    <target>

      <running />

    </target>

    <config xmlns:xc="urn:ietf:params:xml:ns:netconf:base:1.0">

      <ManagedElement xmlns="urn:com:ericsson:ecim:ComTop">

        <managedElementId>1</managedElementId>

        <networkManagedElementId>'.$this->nombre.'</networkManagedElementId>

      </ManagedElement>

    </config>

  </edit-config>

</rpc>

]]>]]>

<rpc message-id="Closing" xmlns="urn:ietf:params:xml:ns:netconf:base:1.0">

  <close-session></close-session>

</rpc>

]]>]]>

';
		
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