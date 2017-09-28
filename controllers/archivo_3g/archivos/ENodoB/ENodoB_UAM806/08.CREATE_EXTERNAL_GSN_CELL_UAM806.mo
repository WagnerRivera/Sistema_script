/////////////////////////////////////////////////////////////
//
// SCRIPT     : CREATE_EXTERNAL_GSN_CELL
// NEMONICO   : UAM806
// RNC        : SAER06
// GENERADOR  : INCOBECH
// HORA       : 16:11:22
// FECHA      : 24/08/2017
//
/////////////////////////////////////////////////////////////

CREATE
(
parent ManagedElement=1,RncFunction=1,ExternalGsmNetwork=1
identity 
moType ExternalGsmCell
    exception none
    nrOfAttributes 6
    bcc Integer 
    bcchFrequency Integer 
    cellIdentity Integer 
    lac Integer 
    ncc Integer 
    userLabel String  
)
