<?php
/////////////////////////////////////////////////////////////////////////
//Clase para la contruccion de la estrctura de los archivos xml, mos y mo
//Fecha de creacion: 29-05-2017
//Creador por: Wagner Rivera
//Fecha de Modificación: 01-06-2017
////////////////////////////////////////////////////////////////////////
class class_4g
{
	public $mask = array ('24' =>'255.255.255.0' ,
			 '25' =>'255.255.255.128' ,
			 '26' =>'255.255.255.192' ,
			 '27' =>'255.255.255.224' ,
			 '28' =>'255.255.255.240' ,
			 '29' =>'255.255.255.248' ,
			 '30' =>'255.255.255.252' 	 
		);
	
	public function __construct()
	{  
	}
	/////////////////////////////////////////////////////////////////////////
	//Metodo para la creacion del archivo siteinstall el primero de la lista
	//Fecha de creacion: 29-05-2017
	//Creador por: Wagner Rivera
	//Fecha de Modificación: 01-06-2017
	////////////////////////////////////////////////////////////////////////	
	public function siteinstall($logicalName, $vlanId, $ipAddress_0, $subnetMask,  $defaultRouter0, $ipAddress_1, $nombre_archivo)
	{
		
		$cinsert = '<?xml version="1.0" encoding="UTF-8"?>
<RbsSiteInstallationFile xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:noNamespaceSchemaLocation="SiteInstallation.xsd">
  <Format revision="H" />
  <InstallationData logicalName="'.$logicalName.'" vlanId="'.$vlanId.'">
    <OamIpConfigurationData ipAddress="'.$ipAddress_0.'" subnetMask="'.$this->mask[$subnetMask] .'" defaultRouter0="'.$defaultRouter0.'" />
<DnsServer ipAddress="'.$ipAddress_1.'"/>
  </InstallationData>
</RbsSiteInstallationFile>
';        
        $estructura = "archivo/ENodoB/ENodoB_".$nombre_archivo;
        
        
        
        $this->eliminarDir($estructura);
        mkdir($estructura, 0777, true);        
        @unlink($estructura."/1.siteinstall_".$nombre_archivo.".xml");
		$carpeta_ruta =  $estructura."/1.siteinstall_".$nombre_archivo.".xml";
		$file=fopen($carpeta_ruta,"a") or die("Problemas");
		fputs($file,$cinsert);
		fputs($file,"\n");			
		fclose($file);	
		return true;	
	}//Fin del metodo siteinstall
	/////////////////////////////////////////////////////////////////////////
	//Metodo para la creacion del archivo sitebasic el primero de la lista
	//Fecha de creacion: 29-05-2017
	//Creador por: Wagner Rivera
	//Fecha de Modificación: 01-06-2017
	////////////////////////////////////////////////////////////////////////
	public function sitebasic($nombre_archivo, $defaultRouter0, $vid, $ipAddress)
	{
		$cinsert = '<?xml version="1.0" encoding="UTF-8"?>
<SiteBasic xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:noNamespaceSchemaLocation="sitebasic.xsd">
  <Format revision="T" />
  <ENodeBFunction upIpAccessHostRef="1">
    <RbsConfiguration ossCorbaNameServer="172.18.220.196" />
  </ENodeBFunction>
  <ManagedElementData ntpServerAddressPrimary="172.16.50.41" ntpServerAddressSecondary="172.16.50.42" ntpServiceActivePrimary="TRUE" ntpServiceActiveSecondary="TRUE" ntpServiceActiveThird="FALSE" nodeLocalTimeZone="-04:00" daylightSavingTime="TRUE" />
  <IpInterface ipInterfaceId="2" networkPrefixLength="26" defaultRouter0="'.$defaultRouter0.'" vid="'.$vid.'" ipInterfaceSlot="DU-1" />
  <tuSyncRef tuSyncRefId="1" tuSyncRefSlot="DU-1" />
  <IpSystem>
    <IpAccessHostEt ipAccessHostEtId="1" ipAddress="'.$ipAddress.'" ipInterfaceMoRef="DU-1-IP-2" />
  </IpSystem>
  <Synchronization syncPriorityRef1="DU-1-1" />
</SiteBasic>
';
        $estructura = "archivo/ENodoB/ENodoB_".$nombre_archivo;
        @unlink($estructura."/2.sitebasic_".$nombre_archivo.".xml");
		$carpeta_ruta = $estructura."/2.sitebasic_".$nombre_archivo.".xml";
		$file=fopen($carpeta_ruta,"a") or die("Problemas");
		fputs($file,$cinsert);
		fputs($file,"\n");			
		fclose($file);		
	}//Fin del metodo sitebasic
	/////////////////////////////////////////////////////////////////////////
	//Metodo para la creacion del archivo RBSequipments el primero de la lista
	//Fecha de creacion: 29-05-2017
	//Creador por: Wagner Rivera
	//Fecha de Modificación: 01-06-2017
	////////////////////////////////////////////////////////////////////////
	public function RBSequipments($nombre_archivo, $SectorEquipment, $CommonAntennaSystem)
	{
		$cinsert = '<?xml version="1.0" encoding="UTF-8"?>
<SiteEquipment xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:noNamespaceSchemaLocation="SiteEquipment.xsd">
  <Format revision="M" />
<NodeData site="'.$nombre_archivo.'" />
  <CommonSupportSystem climateSystem="STANDARD" supportSystemControl="True" cabinetType="RBS6601">
    <PowerSystem batteryType="TYPE01" />
    <HwUnit unitType="SUP-1" />
    <PlugInUnit unitId="DU-1">
      <EcPort ecPortId="1" hubPosition="A" />
    </PlugInUnit>
  </CommonSupportSystem>';
    	
    	$cinsert .= $SectorEquipment;
    	$cinsert .= $CommonAntennaSystem;
		$cinsert .= '
  </CommonAntennaSystem>
</SiteEquipment>';

        $estructura = "archivo/ENodoB/ENodoB_".$nombre_archivo;
        @unlink($estructura."/3.RBSequipment_".$nombre_archivo.".xml");       
		$carpeta_ruta =  $estructura."/3.RBSequipment_".$nombre_archivo.".xml";
		$file=fopen($carpeta_ruta,"a") or die("Problemas");
		fputs($file,$cinsert);
		fputs($file,"\n");			
		fclose($file);		
	}//Fin del metodo RBSequipments

    public function XMU_Creation_L15B_3LTE($nombre_archivo){//archivo nuemro 4.1
        $cinsert = 'confb+
gs+

bl sec|fdd|rru

del rilink';

        $cinsert .='
cr Equipment=1,InterPiuLink=1
Subrack=1,Slot=1
Subrack=1,Slot=2

cr Equipment=1,RiLink=16
Subrack=1,Slot=1,PlugInUnit=1,RiPort=A
AuxPlugInUnit=XMU03-1,RiPort=1

cr Equipment=1,RiLink=17
Subrack=1,Slot=1,PlugInUnit=1,RiPort=B
AuxPlugInUnit=XMU03-1,RiPort=2

cr Equipment=1,RiLink=19
Subrack=1,Slot=1,PlugInUnit=1,RiPort=F
Subrack=1,Slot=2,PlugInUnit=1,RiPort=F

// Configure RiPort from XMU - First XMU

cr Equipment=1,RiLink=1
AuxPlugInUnit=XMU03-1,RiPort=16
AuxPlugInUnit=RRU-1-1,RiPort=DATA_1

cr Equipment=1,RiLink=2
AuxPlugInUnit=XMU03-1,RiPort=15
AuxPlugInUnit=RRU-1-1,RiPort=DATA_2

cr Equipment=1,RiLink=3
AuxPlugInUnit=XMU03-1,RiPort=14
AuxPlugInUnit=RRU-2-1,RiPort=DATA_1

cr Equipment=1,RiLink=4
AuxPlugInUnit=XMU03-1,RiPort=13
AuxPlugInUnit=RRU-2-1,RiPort=DATA_2


cr Equipment=1,RiLink=5
AuxPlugInUnit=XMU03-1,RiPort=12
AuxPlugInUnit=RRU-3-1,RiPort=DATA_1

cr Equipment=1,RiLink=6
AuxPlugInUnit=XMU03-1,RiPort=11
AuxPlugInUnit=RRU-3-1,RiPort=DATA_2

lset SystemFunctions=1,Licensing=1,OptionalFeatures=1,RadioUnitCascading=1 featureStateRUCascading 1
gs-
confb-
';
        $estructura = "archivo/ENodoB/ENodoB_".$nombre_archivo;
        @unlink($estructura."/4_1_XMU_Creation_L15B_3LTE.mos");
        $carpeta_ruta = $estructura."/4_1_XMU_Creation_L15B_3LTE.mos";
        $file=fopen($carpeta_ruta,"a") or die("Problemas");
        fputs($file,$cinsert);
        fputs($file,"\n");          
        fclose($file);
    }

    public function LTE700_Adding_L16($nombre_archivo, $p_1_4_2){//archivo nuemro 4.2
        $cinsert = '#DoNotEditThisLine: UndoCommandFile 10.72.209.70 11.0h ERBS_NODE_MODEL_E_1_63 stopfile=/tmp/1904

gs+
if $moshell_version ~ ^([7-9]|10)
   l echo "The moshell version is too old. 11.0a or higher is required for scripts containing the crn command."
   return
fi

';
        foreach ($p_1_4_2 as $value) {
            //echo $value; 
            $cinsert .= $value;
        }

        $cinsert .= '
crn Equipment=1,RiLink=7
riPortRef1 Subrack=1,Slot=1,PlugInUnit=1,RiPort=C
riPortRef2 AuxPlugInUnit=RRU-4,RiPort=DATA_1
end


crn Equipment=1,RiLink=8
riPortRef1 Subrack=1,Slot=1,PlugInUnit=1,RiPort=D
riPortRef2 AuxPlugInUnit=RRU-5,RiPort=DATA_1
end


crn Equipment=1,RiLink=9
riPortRef1 Subrack=1,Slot=1,PlugInUnit=1,RiPort=E
riPortRef2 AuxPlugInUnit=RRU-6,RiPort=DATA_1
end';
        $estructura = "archivo/ENodoB/ENodoB_".$nombre_archivo;
        @unlink($estructura."/4_2_LTE700_Adding_L16.mos");
        $carpeta_ruta = $estructura."/4_2_LTE700_Adding_L16.mos";
        $file=fopen($carpeta_ruta,"a") or die("Problemas");
        fputs($file,$cinsert);
        fputs($file,"\n");          
        fclose($file);
    }

    public function LTE1900_Adding_L16($nombre_archivo, $p_1_4_3){//archivo nuemro 4.3
        $cinsert = '#DoNotEditThisLine: UndoCommandFile 10.72.209.70 11.0h ERBS_NODE_MODEL_E_1_63 stopfile=/tmp/1904

gs+
if $moshell_version ~ ^([7-9]|10)
   l echo "The moshell version is too old. 11.0a or higher is required for scripts containing the crn command."
   return
fi';
        foreach ($p_1_4_3 as $value) {
            //echo $value; 
            $cinsert .= $value;
        }

        $cinsert .='

gs-
';
        $estructura = "archivo/ENodoB/ENodoB_".$nombre_archivo;
        @unlink($estructura."/4_3_LTE1900_Adding_L16.mos");
        $carpeta_ruta = $estructura."/4_3_LTE1900_Adding_L16.mos";
        $file=fopen($carpeta_ruta,"a") or die("Problemas");
        fputs($file,$cinsert);
        fputs($file,"\n");          
        fclose($file);
    }


    public function LTE2600_Adding_L16($nombre_archivo, $p_1_4_4){//archivo nuemro 4.4
        $cinsert = '#DoNotEditThisLine: UndoCommandFile 10.72.209.70 11.0h ERBS_NODE_MODEL_E_1_63 stopfile=/tmp/1904

gs+
if $moshell_version ~ ^([7-9]|10)
   l echo "The moshell version is too old. 11.0a or higher is required for scripts containing the crn command."
   return
fi';
        foreach ($p_1_4_4 as $value) {
            //echo $value; 
            $cinsert .= $value;
        }

        $estructura = "archivo/ENodoB/ENodoB_".$nombre_archivo;
        @unlink($estructura."/4_4_LTE2600_Adding_L16.mos");
        $carpeta_ruta = $estructura."/4_4_LTE2600_Adding_L16.mos";
        $file=fopen($carpeta_ruta,"a") or die("Problemas");
        fputs($file,$cinsert);
        fputs($file,"\n");          
        fclose($file);
    }

	public function CR_MME($nombre_archivo, $p_1_5){//archivo numero 5
		$cinsert = '
////////////////////////////////////////////////////////////                                            
 //                                          
 //                                          
 //  Bulk    CM  XML file    converted   to  moscript    using   TEIT        
 //  This    script  has been    generated   absolutely  without any kind    of  support
 //  and should  only    be  executed    when    OSS-RC  is  not available   
 //                                          
 ////////////////////////////////////////////////////////////                                            
 ////////////////////////////////////////////////////////////                                            
 //FDN=ManagedElement=1,IpSystem=1,IpAccessSctp=1                                            
 //modifier=create                                           
 //nrOfAttributes=1                                          
 ////////////////////////////////////////////////////////////                                            
 CREATE                                          
 (                                           
     parent  "ManagedElement=1,IpSystem=1" 
     identity    "1"                                   
     moType  IpAccessSctp                                    
     exception   none                                    
     nrOfAttributes  1                                   
     ipAccessHostEtRef1  Ref "ManagedElement=1,IpSystem=1,IpAccessHostEt=1"                                
 )                                           
                                             
 ////////////////////////////////////////////////////////////                                            
 //FDN=ManagedElement=1,TransportNetwork=1,Sctp=1                                            
 //modifier=create                                           
 //nrOfAttributes=32                                         
 ////////////////////////////////////////////////////////////                                            
 CREATE                                          
 (                                           
     parent  "ManagedElement=1,TransportNetwork=1"                                 
     identity    "1"                                   
     moType  Sctp                                    
     exception   none                                    
     nrOfAttributes  32                                  
     maxUserDataSize Integer 1480                                
     ipAccessSctpRef Ref "ManagedElement=1,IpSystem=1,IpAccessSctp=1"                              
     numberOfAssociations    Integer 320                             
     maximumRto  Integer 40                              
     allowedIncrementCookieLife  Integer 30                              
     mBuffer Integer 256                              
     associationMaxRtx   Integer 8                               
     heartbeatPathProbingInterval    Integer 500                             
     nThreshold  Integer 192                              
     validCookieLife Integer 60                              
     intervalOobPkts Integer 3600                                
     maxIncomingStream   Integer 17                              
     maxInitialRtrAtt    Integer 8                               
     rpuId   Ref "ManagedElement=1,SwManagement=1,ReliableProgramUniter=sctp_host"                             
     maxShutDownRtrAtt   Integer 5                               
     userLabel   String  "1"                               
     bundlingTimer   Integer 10                              
     heartbeatMaxBurst   Integer 0                               
     nPercentage Integer 85                              
     bundlingActivated   Integer 1                               
     initialRto  Integer 20                              
     tSack   Integer 4                               
     maxOutgoingStream   Integer 17                              
     heartbeatStatus Boolean true                                
     minimumRto  Integer 10                              
     maxBurst    Integer 4                               
     initialAdRecWin Integer 32768                               
     pathMaxRtx  Integer 4                               
     keyChangePeriod Integer 4                               
     rtoAlphaIndex   Integer 3                               
     heartbeatInterval   Integer 30                              
     rtoBetaIndex    Integer 2                               
 )                                           
                                             
 ////////////////////////////////////////////////////////////                                            
 //FDN=ManagedElement=1,ENodeBFunction=1,TermPointToMme=SASG08                                           
 //modifier=create                                           
 //nrOfAttributes=3                                          
 ////////////////////////////////////////////////////////////                                            
 CREATE                                          
 (                                           
     parent  "ManagedElement=1,ENodeBFunction=1"                                   
     identity    "SASG08"                                  
     moType  TermPointToMme                                  
     exception   none                                    
     nrOfAttributes  3                                   
     ipAddress2  String  "172.18.231.139"                              
     ipAddress1  String  "172.18.231.138"                              
     administrativeState Integer 1                               
 )                                           
                                             
                                             
                                             
 ////////////////////////////////////////////////////////////                                            
 //FDN=ManagedElement=1,ENodeBFunction=1,TermPointToMme=SASG09                                           
 //modifier=create                                           
 //nrOfAttributes=3                                          
 ////////////////////////////////////////////////////////////                                            
 CREATE                                          
 (                                           
     parent  "ManagedElement=1,ENodeBFunction=1"                                   
     identity    "SASG09"                                  
     moType  TermPointToMme                                  
     exception   none                                    
     nrOfAttributes  3                                   
     ipAddress2  String  "172.18.231.145"                              
     ipAddress1  String  "172.18.231.144"                              
     administrativeState Integer 1                               
 )                                           
                                             
 ////////////////////////////////////////////////////////////                                            
 //FDN=ManagedElement=1,ENodeBFunction=1,TermPointToMme=SASG10                                           
 //modifier=create                                           
 //nrOfAttributes=3                                          
 ////////////////////////////////////////////////////////////                                            
 CREATE                                          
 (                                           
     parent  "ManagedElement=1,ENodeBFunction=1"                                   
     identity    "SASG10"                                  
     moType  TermPointToMme                                  
     exception   none                                    
     nrOfAttributes  3                                   
     ipAddress2  String  "172.18.231.135"                              
     ipAddress1  String  "172.18.231.134"                              
     administrativeState Integer 1                               
 )                                           
                                             
                                             
 ////////////////////////////////////////////////////////////                                            
 //FDN=ManagedElement=1,ENodeBFunction=1,TermPointToMme=SASG11                                           
 //modifier=create                                           
 //nrOfAttributes=3                                          
 ////////////////////////////////////////////////////////////                                            
 CREATE                                          
 (                                           
     parent  "ManagedElement=1,ENodeBFunction=1"                                   
     identity    "SASG11"                                  
     moType  TermPointToMme                                  
     exception   none                                    
     nrOfAttributes  3                                   
     ipAddress2  String  "172.18.180.143"                              
     ipAddress1  String  "172.18.180.142"                              
     administrativeState Integer 1                               
 )                                           
                                             
                                             
 ////////////////////////////////////////////////////////////                                            
 //FDN=ManagedElement=1,ENodeBFunction=1,TermPointToMme=SASG12                                           
 //modifier=create                                           
 //nrOfAttributes=3                                          
 ////////////////////////////////////////////////////////////                                            
 CREATE                                          
 (                                           
     parent  "ManagedElement=1,ENodeBFunction=1"                                   
     identity    "SASG12"                                  
     moType  TermPointToMme                                  
     exception   none                                    
     nrOfAttributes  3                                   
     ipAddress2  String  "172.18.180.145"                              
     ipAddress1  String  "172.18.180.144"                              
     administrativeState Integer 1                               
 )                                           
                                             
                                             
                                             
                                             
 ////////////////////////////////////////////////////////////                                            
 //FDN=ManagedElement=1,ENodeBFunction=1,SectorCarrier=1
 //modifier=create                                           
 //nrOfAttributes=1                                          
 ////////////////////////////////////////////////////////////                                            
 CREATE                                          
 (                                           
     parent  "ManagedElement=1,ENodeBFunction=1"                                   
     identity    1
     moType  SectorCarrier                                  
     exception   none                                    
     nrOfAttributes  1                                   
     sectorFunctionRef   Ref "ManagedElement=1,SectorEquipmentFunction=1"
 )                                           
                                             
                                             
                                             
                                             
 ////////////////////////////////////////////////////////////                                            
 //FDN=ManagedElement=1,ENodeBFunction=1,SectorCarrier=2
 //modifier=create                                           
 //nrOfAttributes=1                                          
 ////////////////////////////////////////////////////////////                                            
 CREATE                                          
 (                                           
     parent  "ManagedElement=1,ENodeBFunction=1"                                   
     identity    2
     moType  SectorCarrier                                  
     exception   none                                    
     nrOfAttributes  1                                   
     sectorFunctionRef   Ref "ManagedElement=1,SectorEquipmentFunction=2"
 )                                           
                                             
                                             
                                             
                                             
 ////////////////////////////////////////////////////////////                                            
 //FDN=ManagedElement=1,ENodeBFunction=1,SectorCarrier=3
 //modifier=create                                           
 //nrOfAttributes=1                                          
 ////////////////////////////////////////////////////////////                                            
 CREATE                                          
 (                                           
     parent  "ManagedElement=1,ENodeBFunction=1"                                   
     identity    3
     moType  SectorCarrier                                  
     exception   none                                    
     nrOfAttributes  1                                   
     sectorFunctionRef   Ref "ManagedElement=1,SectorEquipmentFunction=3"
 )                                           
                                             
                                             
                                             
                                             
     ////////////////////////////////////////////////////////////            
     //////////////////////////////////////////////////////////////////          
     //FDN=ManagedElement=1,ENodeBFunction=1         
     //modifier=update           
     //////////////////////////////////////////////////////////////////          
     SET         
     (           
         mo  "ManagedElement=1,ENodeBFunction=1"   
         exception   none    
         sctpRef Ref "ManagedElement=1,TransportNetwork=1,Sctp=1"
     )           
                 
     //////////////////////////////////////////////////////////////////          
     //FDN=ManagedElement=1,ENodeBFunction=1         
     //modifier=update           
     //////////////////////////////////////////////////////////////////          
     SET         
     (           
         mo  "ManagedElement=1,ENodeBFunction=1"   
         exception   none    
         eNBId   Integer '.$p_1_5.'
     )           
                 
     //////////////////////////////////////////////////////////////////          
     //FDN=ManagedElement=1,ENodeBFunction=1         
     //modifier=update           
     //////////////////////////////////////////////////////////////////          
     SET         
     (           
         mo  "ManagedElement=1,ENodeBFunction=1"   
         exception   none    
         userLabel   String  "'.$nombre_archivo.'"
     )           
                 
     //////////////////////////////////////////////////////////////////          
     //FDN=ManagedElement=1,ENodeBFunction=1         
     //modifier=update           
     //////////////////////////////////////////////////////////////////          
     SET         
     (           
         mo  "ManagedElement=1,ENodeBFunction=1"   
         exception   none    
         eNodeBPlmnId    Struct  
         nrOfElements    3   
         mcc Integer 730
         mnc Integer 1
         mncLength   Integer 2
     )           
                 
     //////////////////////////////////////////////////////////////////          
     //FDN=ManagedElement=1,ENodeBFunction=1         
     //modifier=update           
     //////////////////////////////////////////////////////////////////          
     SET         
     (           
         mo  "ManagedElement=1,ENodeBFunction=1"   
         exception   none    
         dnsLookupOnTai  Integer 1
     )           
                 
     //////////////////////////////////////////////////////////////////          
     //FDN=ManagedElement=1,ENodeBFunction=1         
     //modifier=update           
     //////////////////////////////////////////////////////////////////          
     SET         
     (           
         mo  "ManagedElement=1,ENodeBFunction=1"   
         exception   none    
         dnsLookupTimer  Integer 0
     )           
                                             
 ECHO       "ACTION - ConfigurationVersion Creation"                                       
                                             
 ACTION                                          
 (                                           
     actionName  create                                  
     mo  "ManagedElement=1,SwManagement=1,ConfigurationVersion=1"                                  
     exception   none                                    
     nrOfParameters  5                                   
     String  "cr_MME"                                   
     String  "cr_MME"                                   
     Integer 5                                   
     String  "exlfalda"                                  
     String  "CV Startable"                                    
     returnValue none                                    
 )                                           
                                             
 ECHO  "     ACTION - setStartable ConfigurationVersion"                                       
                                             
 ACTION                                          
 (                                           
     actionName  setStartable                                    
     mo  "ManagedElement=1,SwManagement=1,ConfigurationVersion=1"                                  
     exception   none                                    
     nrOfParameters  1                                   
     String  "cr_MME"                                   
     returnValue none                                    
 )
';
        $estructura = "archivo/ENodoB/ENodoB_".$nombre_archivo;
        @unlink($estructura."/5.CR_MME_".$nombre_archivo.".mo");
		$carpeta_ruta = $estructura."/5.CR_MME_".$nombre_archivo.".mo";
		$file=fopen($carpeta_ruta,"a") or die("Problemas");
		fputs($file,$cinsert);
		fputs($file,"\n");			
		fclose($file);
	}

	public function CrEUtranFreqRelation($nombre_archivo, $segunda_p_6){//archivo numero 6
		
		$cinsert = 'confb +
gs +';
		foreach ($segunda_p_6 as $value) {
			//echo $value; 
			$cinsert .= $value;
		}

		$cinsert .= '

confb -
gs -
';      
        $estructura = "archivo/ENodoB/ENodoB_".$nombre_archivo;
        @unlink($estructura."/6.CrEUtranFreqRelation_".$nombre_archivo.".mos");
		$carpeta_ruta = $estructura."/6.CrEUtranFreqRelation_".$nombre_archivo.".mos";
		$file=fopen($carpeta_ruta,"a") or die("Problemas");
		fputs($file,$cinsert);
		fputs($file,"\n");			
		fclose($file);
	}


	public function EUtranFreqRelation($nombre_archivo,$segunda_p_7, $tercera_p_7){//archivo numero 7		
		$cinsert = '	
lt all
confb +
gs +';
		foreach ($segunda_p_7 as $value) {
			//echo $value; 
			$cinsert .= $value;
		}
		foreach ($tercera_p_7 as $value) {
			//echo $value; 
			$cinsert .= $value;
		}
		$cinsert .= '
cvms EUtranFreqRelation
cv rbset EUtranFreqRelation
confb -
gs -';
        $estructura = "archivo/ENodoB/ENodoB_".$nombre_archivo;
        @unlink($estructura."/7.EUtranFreqRelation_".$nombre_archivo.".mos");
		$carpeta_ruta = $estructura."/7.EUtranFreqRelation_".$nombre_archivo.".mos";
		$file=fopen($carpeta_ruta,"a") or die("Problemas");
		fputs($file,$cinsert);
		fputs($file,"\n");			
		fclose($file);
	}

	public function EUtranCellRelation($nombre_archivo, $segunda_p_8, $tercera_p_8, $cuarta_p_8){//archivo numero 8		
		$cinsert = '
lt all
confb +
gs +
';
		foreach ($segunda_p_8 as $value) {
			//echo $value; 
			$cinsert .= $value;
		}
		foreach ($tercera_p_8 as $value) {
			//echo $value; 
			$cinsert .= $value;
		}
		foreach ($cuarta_p_8 as $value) {
			//echo $value; 
			$cinsert .= $value;
		}
		
		$cinsert .= '

confb -
gs -';
        $estructura = "archivo/ENodoB/ENodoB_".$nombre_archivo;
        @unlink($estructura."/8.EUtranCellRelation_".$nombre_archivo.".mos");
		$carpeta_ruta = $estructura."/8.EUtranCellRelation_".$nombre_archivo.".mos";
		$file=fopen($carpeta_ruta,"a") or die("Problemas");
		fputs($file,$cinsert);
		fputs($file,"\n");			
		fclose($file);
	}

	public function UtranFreqRelation($nombre_archivo, $segunda_p_9, $tercera_p_9){//archivo numero 9		
		$cinsert = '
///////////////////////////////////////////////////
////////////S E T   UtranFreqRelation//////////////
///////////////////////////////////////////////////

confb +
gs +';

		foreach ($segunda_p_9 as $value) {
			//echo $value; 
			$cinsert .= $value;
		}
		foreach ($tercera_p_9 as $value) {
			//echo $value; 
			$cinsert .= $value;
		}
		$cinsert .= '
confb -
gs -
';
        $estructura = "archivo/ENodoB/ENodoB_".$nombre_archivo;
        @unlink( $estructura."/9.UtranFreqRelation_".$nombre_archivo.".mos");
		$carpeta_ruta =  $estructura."/9.UtranFreqRelation_".$nombre_archivo.".mos";
		$file=fopen($carpeta_ruta,"a") or die("Problemas"); 
		fputs($file,$cinsert);
		fputs($file,"\n");			
		fclose($file);
	}

	public function Features($nombre_archivo, $segunda_p_10){//archivo nuemro 10
		$cinsert = '
///////////////////////////////////////////////////
////////////S E T   F E A T U R E S////////////////
///////////////////////////////////////////////////

lt all
confb +
gs +';
		foreach ($segunda_p_10 as $value) {
			//echo $value; 
			$cinsert .= $value;
		}

		$cinsert .= '

cvms Feature 
cv rbset Feature 

confb -
gs -';
        $estructura = "archivo/ENodoB/ENodoB_".$nombre_archivo;
        @unlink($estructura."/10.Features_".$nombre_archivo.".mos");
		$carpeta_ruta = $estructura."/10.Features_".$nombre_archivo.".mos";
		$file=fopen($carpeta_ruta,"a") or die("Problemas");
		fputs($file,$cinsert);
		fputs($file,"\n");			
		fclose($file);
	}


	public function Parametros_11($nombre_archivo, $segunda_p_11, $tercera_p_11 , $cuarta_p_11, $quinta_p_11, $sesta_p_11, $septima_p_11, $octava_p_11, $novena_p_11, $decima_p_11,$onceava_p_11,$doceavo_p_11, $terceava_p_11, $cuarteto_p_11,$quitoss_p_11, $sestos_p_11, $septiomoss_p_11,$p_18_11,$p_19_11, $p_20_11, $p_21_11, $p_22_11, $p_23_11, $p_24_11, $p_25_11, $p_26_11, $p_27_11, $p_28_11, $p_29_11, $p_30_11, $p_31_11, $p_32_11, $p_33_11, $p_34_11, $p_35_11, $p_36_11, $p_37_11, $p_38_11, $p_39_11, $p_40_11, $p_41_11, $p_42_11, $p_43_11, $p_44_11, $p_45_11, $p_46_11, $p_47_11, $p_48_11, $p_49_11, $p_50_11, $p_51_11, $p_52_11, $p_53_11, $p_54_11, $p_55_11, $p_56_11, $p_57_11, $p_58_11, $p_59_11, $p_60_11, $p_61_11, $p_62_11, $p_63_11, $p_64_11, $p_65_11){//archivo nuemro 11
		$cinsert = '

///////////////////////////////////////////////////
////////////S E T   P A R A M E T R O S////////////
///////////////////////////////////////////////////

confb +
gs +
set AdmissionControl=1 zzzTemporary1 1
set AnrFunction=1 zzzTemporary1 1
set AnrFunctionEUtran=1 anrUesEUtraIntraFMin 5
set AnrFunctionEUtran=1 anrInterFreqState 1
set AnrFunctionEUtran=1 anrUesThreshInterFMax 20
set AnrFunctionEUtran=1 anrUesThreshInterFMin 1
set AnrFunctionUtran=1 srvccPolicy 0
set CarrierAggregationFunction=1 sCellActProhibitTimer 10';
		
		$cinsert .= '

//////////////////////////////////////
///////DrxProfile
//////////////////////////////////////
';
		
		foreach ($segunda_p_11 as $value) {
			//echo $value; 
			$cinsert .= $value;
		}
		foreach ($tercera_p_11 as $value) {
			//echo $value; 
			$cinsert .= $value;
		}
		foreach ($cuarta_p_11 as $value) {
			//echo $value; 
			$cinsert .= $value;
		}
		foreach ($quinta_p_11 as $value) {
			//echo $value; 
			$cinsert .= $value;
		}


		$cinsert .= '
set ENodeBFunction=1 rrcConnReestActive true

//////////////////////////////////////
///////EUtranCellFDD
//////////////////////////////////////
';

		foreach ($sesta_p_11 as $value) {
			//echo $value; 
			$cinsert .= $value;
		}
		foreach ($septima_p_11 as $value) {
			//echo $value; 
			$cinsert .= $value;
		}
		foreach ($octava_p_11 as $value) {
			//echo $value; 
			$cinsert .= $value;
		}

		$cinsert .= '
//////////////////////////////////////
///////ExternalEUtranCellFDD
//////////////////////////////////////
';
        foreach ($novena_p_11 as $value) {
            //echo $value; 
            $cinsert .= $value;
        }
        
        $cinsert .='
//////////////////////////////////////
///////ReportConfigA1Prim
//////////////////////////////////////
';
        
        foreach ($decima_p_11 as $value) {
            //echo $value; 
            $cinsert .= $value;
        }

          $cinsert .='
//////////////////////////////////////
///////ReportConfigA5
//////////////////////////////////////
';
        foreach ($onceava_p_11 as $value) {
            //echo $value; 
            $cinsert .= $value;
        }

        foreach ($doceavo_p_11 as $value) {
            //echo $value; 
            $cinsert .= $value;
        }
        
        $cinsert .='

//////////////////////////////////////
///////ReportConfigA5Anr
//////////////////////////////////////
';

        foreach ($terceava_p_11 as $value) {
            //echo $value; 
            $cinsert .= $value;
        }

        $cinsert .='

//////////////////////////////////////
///////ReportConfigB2Utra
//////////////////////////////////////
';
        foreach ($cuarteto_p_11 as $value) {
            //echo $value; 
            $cinsert .= $value;
        }

        foreach ($quitoss_p_11 as $value) {
            //echo $value; 
            $cinsert .= $value;
        }

        foreach ($sestos_p_11 as $value) {
            //echo $value; 
            $cinsert .= $value;
        }

        foreach ($septiomoss_p_11 as $value) {
            //echo $value; 
            $cinsert .= $value;
        }


        $cinsert .= '

//////////////////////////////////////
///////ReportConfigEUtraBadCovPrim
//////////////////////////////////////
';      
        foreach ($p_18_11 as $value) {
            //echo $value; 
            $cinsert .= $value;
        }

        foreach ($p_19_11 as $value) {
            //echo $value; 
            $cinsert .= $value;
        }

        $cinsert .= '
//////////////////////////////////////
///////ReportConfigEUtraBadCovSec
//////////////////////////////////////
';
        
        foreach ($p_20_11 as $value) {
            //echo $value; 
            $cinsert .= $value;
        }

        foreach ($p_21_11 as $value) {
            //echo $value; 
            $cinsert .= $value;
        }

        $cinsert .= '
//////////////////////////////////////
///////ReportConfigEUtraBestCell
//////////////////////////////////////
';
        
        foreach ($p_22_11 as $value) {
            //echo $value; 
            $cinsert .= $value;
        }

        $cinsert .='
//////////////////////////////////////
///////ReportConfigEUtraBestCellAnr
//////////////////////////////////////
';
        foreach ($p_23_11 as $value) {
            //echo $value; 
            $cinsert .= $value;
        }

        $cinsert .='
//////////////////////////////////////
///////ReportConfigSearch
//////////////////////////////////////
';  
        foreach ($p_24_11 as $value) {
            //echo $value; 
            $cinsert .= $value;
        }

        foreach ($p_25_11 as $value) {
            //echo $value; 
            $cinsert .= $value;
        }

        foreach ($p_26_11 as $value) {
            //echo $value; 
            $cinsert .= $value;
        }

        foreach ($p_27_11 as $value) {
            //echo $value; 
            $cinsert .= $value;
        }

        foreach ($p_28_11 as $value) {
            //echo $value; 
            $cinsert .= $value;
        }

        foreach ($p_29_11 as $value) {
            //echo $value; 
            $cinsert .= $value;
        }

        foreach ($p_30_11 as $value) {
            //echo $value; 
            $cinsert .= $value;
        }

        foreach ($p_31_11 as $value) {
            //echo $value; 
            $cinsert .= $value;
        }


        $cinsert .='
//////////////////////////////////////
///////ReportConfigSCellA1A2
//////////////////////////////////////
';      
        foreach ($p_32_11 as $value) {
            //echo $value; 
            $cinsert .= $value;
        }

        $cinsert .='
//////////////////////////////////////
///////RetSubUnit
//////////////////////////////////////
';
        foreach ($p_33_11 as $value) {
            //echo $value; 
            $cinsert .= $value;
        }

        foreach ($p_34_11 as $value) {
            //echo $value; 
            $cinsert .= $value;
        }

        foreach ($p_35_11 as $value) {
            //echo $value; 
            $cinsert .= $value;
        }

        $cinsert .='
//////////////////////////////////////
///////RfBranch
//////////////////////////////////////
'; 
        foreach ($p_36_11 as $value) {
            //echo $value; 
            $cinsert .= $value;
        }

        foreach ($p_37_11 as $value) {
            //echo $value; 
            $cinsert .= $value;
        }

        foreach ($p_38_11 as $value) {
            //echo $value; 
            $cinsert .= $value;
        }

        foreach ($p_39_11 as $value) {
            //echo $value; 
            $cinsert .= $value;
        }

        foreach ($p_40_11 as $value) {
            //echo $value; 
            $cinsert .= $value;
        }

        $cinsert .= '
//////////////////////////////////////
///////SectorCarrier
//////////////////////////////////////
';
        foreach ($p_41_11 as $value) {
            //echo $value; 
            $cinsert .= $value;
        }

        $cinsert .='
//////////////////////////////////////
///////SectorEquipmentFunction
//////////////////////////////////////
';
        foreach ($p_42_11 as $value) {
            //echo $value; 
            $cinsert .= $value;
        }

        foreach ($p_43_11 as $value) {
            //echo $value; 
            $cinsert .= $value;
        }

        $cinsert .= '
//////////////////////////////////////
///////UeMeasControl
//////////////////////////////////////
';
        foreach ($p_44_11 as $value) {
            //echo $value; 
            $cinsert .= $value;
        }

        foreach ($p_45_11 as $value) {
            //echo $value; 
            $cinsert .= $value;
        }

        foreach ($p_46_11 as $value) {
            //echo $value; 
            $cinsert .= $value;
        }
        
        $cinsert .= '
//////////////////////////////////////
///////Features
//////////////////////////////////////
';
        foreach ($p_47_11 as $value) {
            //echo $value; 
            $cinsert .= $value;
        }

        foreach ($p_48_11 as $value) {
            //echo $value; 
            $cinsert .= $value;
        }

        foreach ($p_49_11 as $value) {
            //echo $value; 
            $cinsert .= $value;
        }

        foreach ($p_50_11 as $value) {
            //echo $value; 
            $cinsert .= $value;
        }

        foreach ($p_51_11 as $value) {
            //echo $value; 
            $cinsert .= $value;
        }

        $cinsert .= '
//////////////////////////////////////
///////Licensing
//////////////////////////////////////
';
        foreach ($p_52_11 as $value) {
            //echo $value; 
            $cinsert .= $value;
        }

        foreach ($p_53_11 as $value) {
            //echo $value; 
            $cinsert .= $value;
        }

        foreach ($p_54_11 as $value) {
            //echo $value; 
            $cinsert .= $value;
        }

        $cinsert .= '
//////////////////////////////////////
///////UtranFrequency
//////////////////////////////////////
';
        foreach ($p_55_11 as $value) {
            //echo $value; 
            $cinsert .= $value;
        }

        $cinsert .= '
//////////////////////////////////////
///////QciProfilePredefined
//////////////////////////////////////
';

        foreach ($p_56_11 as $value) {
            //echo $value; 
            $cinsert .= $value;
        }

        foreach ($p_57_11 as $value) {
            //echo $value; 
            $cinsert .= $value;
        }

        foreach ($p_58_11 as $value) {
            //echo $value; 
            $cinsert .= $value;
        }

        foreach ($p_59_11 as $value) {
            //echo $value; 
            $cinsert .= $value;
        }

        foreach ($p_60_11 as $value) {
            //echo $value; 
            $cinsert .= $value;
        }

        foreach ($p_61_11 as $value) {
            //echo $value; 
            $cinsert .= $value;
        }

        foreach ($p_62_11 as $value) {
            //echo $value; 
            $cinsert .= $value;
        }

        foreach ($p_63_11 as $value) {
            //echo $value; 
            $cinsert .= $value;
        }

        foreach ($p_64_11 as $value) {
            //echo $value; 
            $cinsert .= $value;
        }

        $cinsert .='
//////////////////////////////////////
///////Sctp
//////////////////////////////////////
';
        foreach ($p_65_11 as $value) {
            //echo $value; 
            $cinsert .= $value;
        }

//Aqui el fin del archivo toda la informacion a carga debe ser antes de esta linea 
		$cinsert .= '
confb -
gs -';
        $estructura = "archivo/ENodoB/ENodoB_".$nombre_archivo;
        @unlink($estructura."/11.Parametros_".$nombre_archivo.".mos");
		$carpeta_ruta = $estructura."/11.Parametros_".$nombre_archivo.".mos";
		$file=fopen($carpeta_ruta,"a") or die("Problemas");
		fputs($file,$cinsert);
		fputs($file,"\n");			
		fclose($file);
	}

	public function Parametros_12($nombre_archivo, $p_1_12){//archivo nuemro 12
		$cinsert = 'confb +
gs +';
        foreach ($p_1_12 as $value) {
            //echo $value; 
            $cinsert .= $value;
        }

//Aqui el fin del archivo toda la informacion a carga debe ser antes de esta linea 
        $cinsert .= '
confb -
gs -';
        $estructura = "archivo/ENodoB/ENodoB_".$nombre_archivo;
        @unlink($estructura."/12.Parametros_".$nombre_archivo.".mos");
		$carpeta_ruta = $estructura."/12.Parametros_".$nombre_archivo.".mos";
		$file=fopen($carpeta_ruta,"a") or die("Problemas");
		fputs($file,$cinsert);
		fputs($file,"\n");			
		fclose($file);
	}

	public function Parametros_13($nombre_archivo,$p_1_13){//Archivo nuemero 13
		$cinsert = '
lt all
confb +
gs +';
        foreach ($p_1_13 as $value) {
            //echo $value; 
            $cinsert .= $value;
        }

//Aqui el fin del archivo toda la informacion a carga debe ser antes de esta linea 
        $cinsert .= '

confb -
gs -';
        $estructura = "archivo/ENodoB/ENodoB_".$nombre_archivo;
        @unlink($estructura."/13.Parametros_".$nombre_archivo.".mos");
		$carpeta_ruta = $estructura."/13.Parametros_".$nombre_archivo.".mos";
		$file=fopen($carpeta_ruta,"a") or die("Problemas");
		fputs($file,$cinsert);
		fputs($file,"\n");			
		fclose($file);
	}

	public function Script_ExternalENodeBFunction_nombre_Set2($nombre_archivo,$p_1_14){
		foreach ($p_1_14 as $value) {
            //echo $value; 
            $cinsert .= $value;
        }
        $estructura = "archivo/ENodoB/ENodoB_".$nombre_archivo;
        @unlink($estructura."/Script_ExternalENodeBFunction_".$nombre_archivo.".mos");
		$carpeta_ruta = $estructura."/Script_ExternalENodeBFunction_".$nombre_archivo."_Set2.mo";
		$file=fopen($carpeta_ruta,"a") or die("Problemas");
		fputs($file,$cinsert);
		fputs($file,"\n");			
		fclose($file);
	}

	public function Script_ExternalEUtranCellFDD_nombre_Set3($nombre_archivo,$p_1_15){
		foreach ($p_1_15 as $value) {
            //echo $value; 
            $cinsert .= $value;
        }
        $estructura = "archivo/ENodoB/ENodoB_".$nombre_archivo;
        @unlink($estructura."/Script_ExternalEUtranCellFDD_".$nombre_archivo.".mos");
		$carpeta_ruta = $estructura."/Script_ExternalEUtranCellFDD_".$nombre_archivo."_Set3.mo";
		$file=fopen($carpeta_ruta,"a") or die("Problemas");
		fputs($file,$cinsert);
		fputs($file,"\n");			
		fclose($file);
	}

    private function eliminarDir($carpeta)
    {
        foreach(glob($carpeta . "/*") as $archivos_carpeta)
        {
     
            if (is_dir($archivos_carpeta))
            {
                eliminarDir($archivos_carpeta);
            }
            else
            {
                unlink($archivos_carpeta);
            }
        }
     
        rmdir($carpeta);
    }

	public function __destruct()
	{
		
	}
}

?>