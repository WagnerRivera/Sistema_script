/////////////////////////////////////////////////////////////
//
// SCRIPT     : CREATE IUB
// NEMONICO   : UAM806
// RNC        : SAER06
// GENERADOR  : INCOBECH
// HORA       : 16:11:21
// FECHA      : 24/08/2017
//
/////////////////////////////////////////////////////////////

CREATE
(
   parent "ManagedElement=1,RncFunction=1"
   identity "Iub_UAM806"
   moType IubLink
   exception none
   nrOfAttributes 4
   rbsId Integer 10745
   userPlaneTransportOption Struct
      nrOfElements 2
         atm Integer 0
         ipv4 Integer 1
   controlPlaneTransportOption Struct
     nrOfElements 2
         atm Integer 0
         ipv4 Integer 1
   userPlaneIpResourceRef Ref "ManagedElement=1,IpSystem=1,IpAccessHostPool=Iub"
)

SET
(
   mo "ManagedElement=1,RncFunction=1,IubLink=Iub_UAM806"
   exception none
   administrativeState Integer 1
)

SET
(
   mo "ManagedElement=1,RncFunction=1,IubLink=Iub_UAM806"
   exception none
   dlHwAdm Integer 90
)

SET
(
   mo "ManagedElement=1,RncFunction=1,IubLink=Iub_UAM806"
   exception none
   softCongThreshGbrBwDl Integer 100
)

SET
(
   mo "ManagedElement=1,RncFunction=1,IubLink=Iub_UAM806"
   exception none
   softCongThreshGbrBwUl Integer 100
)

SET
(
   mo "ManagedElement=1,RncFunction=1,IubLink=Iub_UAM806"
   exception none
   ulHwAdm Integer 90
)

SET
(
   mo "ManagedElement=1,RncFunction=1,IubLink=Iub_UAM806"
  exception none
   remoteCpIpAddress1 String "10.31.232.146"
)

SET
(
   mo "ManagedElement=1,RncFunction=1,IubLink=Iub_UAM806"
   exception none
   remoteCpIpAddress2 String "000.000.000.000"
)

SET
(
   mo "ManagedElement=1,RncFunction=1,IubLink=Iub_UAM806"
   exception none
   l2EstReqRetryTimeNbapC Integer 5
)

SET
(
   mo "ManagedElement=1,RncFunction=1,IubLink=Iub_UAM806"
   exception none
   l2EstReqRetryTimeNbapD Integer 5
)

SET
(
   mo "ManagedElement=1,RncFunction=1,IubLink=Iub_UAM806"
   exception none
   userLabel String "Iub_UAM806"
)

CREATE
(
   parent "ManagedElement=1,RncFunction=1,IubLink=Iub_UAM806"
   identity "1"
   moType IubEdch
   exception none
   nrOfAttributes 2
    edchDataFrameDelayThreshold Integer 60
    userLabel String "IubEdch_UAM806"
)

