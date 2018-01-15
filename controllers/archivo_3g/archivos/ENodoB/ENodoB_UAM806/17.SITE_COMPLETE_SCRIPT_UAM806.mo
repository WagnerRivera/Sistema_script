/////////////////////////////////////////////////////////////
//
// SCRIPT     : SITE COMPLETE
// NEMONICO   : UAM806
// RNC        : SAER06
// GENERADOR  : INCOBECH
// HORA       : 16:11:22
// FECHA      : 24/08/2017
//
/////////////////////////////////////////////////////////////

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
    identity "Iub_UAM806"
    moType Iub
    exception none
    nrOfAttributes 5
        rbsId Integer 10745
        userLabel String "Iub_UAM806"
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
    parent "ManagedElement=1,NodeBFunction=1,Iub=Iub_UAM806"
    identity 1
    moType NbapCommon
    exception none
    nrOfAttributes 0
)
CREATE
(
    parent "ManagedElement=1,NodeBFunction=1,Iub=Iub_UAM806"
    identity 1
    moType NbapDedicated
    exception none
    nrOfAttributes 0
)

SET
(
   mo "ManagedElement=1,NodeBFunction=1,Iub=Iub_UGA745,IubDataStreams=1"
   exception none
   hsDataFrameDelayThreshold Integer 60
)
    
SET
(
   mo "ManagedElement=1,NodeBFunction=1,Iub=Iub_UGA745,IubDataStreams=1"
   exception none
   hsRbrDiscardProbability Integer 0
)
    
SET
(
   mo "ManagedElement=1,NodeBFunction=1,Iub=Iub_UGA745,IubDataStreams=1"
   exception none
   hsRbrWeight Array Integer 16
100
100
50
100
200
100
100
100
100
100
100
100
100
100
100
100
)
    
SET
(
   mo "ManagedElement=1,NodeBFunction=1,Iub=Iub_UGA745,IubDataStreams=1"
   exception none
   maxHsRate Integer 396
)
    
SET
(
   mo "ManagedElement=1,NodeBFunction=1,Iub=Iub_UGA745,IubDataStreams=1"
   exception none
   schHsFlowControlOnOff Array Integer 16
0
1
1
1
1
0
0
1
0
0
0
0
0
0
0
0
)
    
SET
(
   mo "ManagedElement=1,NodeBFunction=1,Iub=Iub_UGA745,IubDataStreams=1"
   exception none
   UserLabel Integer 3G1900
)
    
SET
(
   mo "ManagedElement=1,NodeBFunction=1,Iub=Iub_UGA745,IubDataStreams=1"
   exception none
   noOfCommonStreams Integer 0
)
    
SET
(
   mo "ManagedElement=1,NodeBFunction=1,Iub=Iub_UGA745,IubDataStreams=1"
   exception none
   noOfDedicatedStreams Integer 0
)
    
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
)
