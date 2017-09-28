<?php
/////////////////////////////////////////////////////////////////////////
//Clase para la validacion y contrucionde de la estrctura de los archivos xml desde el excel
//Fecha de creacion: 30-05-2017
//Creador por: Wagner Rivera
//Fecha de Modificación: 01-06-2017
////////////////////////////////////////////////////////////////////////
include_once('Classes/PHPExcel.php');
include_once('class_4g.php');
include_once('Control_Archivo.php');

class apt_spg extends Control_Archivos
{
	public $excel;
	public $CuartoG;
	public $b_rnd;
	public $b_ip;
	public $frecuencia;
	public $port = array ('A' =>'' ,
			 'B' =>'' ,
			 'C' =>'' 	 
		);
	 
	public function __construct($rnd, $ip, $tipo)
	{	   
		//$this->excel		 = new Spreadsheet_Excel_Reader();
		$this->b_rnd		 = $rnd;
		$this->b_ip          = $ip;
		$this->frecuencia	 = $tipo;
		$this->CuartoG 	     = new class_4g();
	}	
	
	public function cargar_archivo()
	{
		$objReader = PHPExcel_IOFactory::createReader('Excel2007');		
		$objReader->setReadDataOnly(true);
		 
		$RND = $objReader->load($this->b_rnd);

		$direciones_ip  = $objReader->load($this->b_ip);
		$nombre_hoja_ip = $direciones_ip->getSheetNames();//Nombre de las hojas del EXCEL de Direccionamiento			
		foreach ($nombre_hoja_ip as $name_ip) {		 	
			if($name_ip == 'LTE'){ // Validación correspondiente al achivo del 4G				
				/////////////////////////////////////////////////////////////////////////
				//Inicio de la carga y validacion del archivo del direccionamiento de ip
				//Fecha de creacion: 01-06-2017
				//Creador por: Wagner Rivera
				//Fecha de Modificación: 01-06-2017
				////////////////////////////////////////////////////////////////////////
				$hoja_selec   = $direciones_ip->getSheet(1); // Normalmente se encuentra en la hoja 2	
				$nombre_final = $hoja_selec->getCellByColumnAndRow(0,2)->getValue();
				$Vlan_OAM_LTE = $hoja_selec->getCellByColumnAndRow(14,2)->getValue();				
				$IP_OAM_LTE	  = $hoja_selec->getCellByColumnAndRow(15,2)->getValue();
				$DGW_OAM_LTE  = $hoja_selec->getCellByColumnAndRow(16,2)->getValue();
				$Mask  		  = $hoja_selec->getCellByColumnAndRow(17,2)->getValue();
				$arc_xml_siteinstall = $this->CuartoG->siteinstall($nombre_final, $Vlan_OAM_LTE, $IP_OAM_LTE, $Mask,  $DGW_OAM_LTE, "172.29.79.50", $nombre_final);
				$Vlan_LTE 	  = $hoja_selec->getCellByColumnAndRow(10,2)->getValue();
				$DGW_Trafico_LTE = $hoja_selec->getCellByColumnAndRow(12,2)->getValue();
				$IP_Trafico_LTE  = $hoja_selec->getCellByColumnAndRow(11,2)->getValue();
				$arc_xml_sitebasic = $this->CuartoG->sitebasic($nombre_final,$DGW_Trafico_LTE,$Vlan_LTE, $IP_Trafico_LTE);				
			}//fin de la carga y validacion del archivo del direccionamiento de ip
		}
				/////////////////////////////////////////////////////////////////////////
				//Inicio de la carga del archivo RND en EXCEL
				//Fecha de creacion: 01-06-2017
				//Creador por: Wagner Rivera
				//Fecha de Modificación: 01-06-2017
				////////////////////////////////////////////////////////////////////////
				
					
				$nombre_hoja = $RND->getSheetNames();					
				$j = 0;				
				foreach ($nombre_hoja as $name) {
					//echo $j." = ".$name."<br>";		
						if($this->frecuencia == "AIR"){
							if($name == "SectorEquipmentFunction"){								
								for($sector = 1; $sector <= 3; $sector++){
									if($sector == 1){
										$du_1 = "DU-1-A";
										$du_2 = "DU-1-D";
									}
									if($sector == 2){
										$du_1 = "DU-1-B";
										$du_2 = "DU-1-E";
									}
									if($sector == 3){
										$du_1 = "DU-1-C";
										$du_2 = "DU-1-F";
									}

									$contenidoSector = '
  <SectorEquipment sectorFunctionId="'.$sector.'" configuredOutputPower="60000">';
										$contenidoSector .= '
	<RadioEquipment>
	  <RadioUnit unitId="RRU-'.$sector.'-1" primaryPort="'.$du_1.'" />
	  <RadioUnit unitId="RRU-'.$sector.'-2" secondaryPort="'.$du_2.'" />
	</RadioEquipment>
	<AntennaEquipment>
	  <RfBranchRef rfBranchId="'.$sector.'-1" />
	  <RfBranchRef rfBranchId="'.$sector.'-2" />
	  <RfBranchRef rfBranchId="'.$sector.'-3" />
	  <RfBranchRef rfBranchId="'.$sector.'-4" />
	</AntennaEquipment>
  </SectorEquipment>';
									@$Sectores = $Sectores.$contenidoSector;
									@$SectoresFinal = $Sectores;
								}
							}//fin del if para el nombre de la hoja a buscar SectorEquipmentFunction								

							    if($name == 'RfBranch'){
									$CommonAntennaSystem = "
  <CommonAntennaSystem>";
   									$filas_rnd  = $RND->getSheet($j)->getHighestRow(); 
   									$Column_rnd = $RND->getSheet($j)->getHighestColumn();
   									$NumColumn  = PHPExcel_Cell::columnIndexFromString($Column_rnd);
   										for($r = 1; $r <= $filas_rnd; $r++){
   											for ($i=0; $i <= $NumColumn; $i++) {
   												$AntennaUnitGroup = $RND->getsheet($j)->getCellByColumnAndRow($i,$r)->getValue();								

   												if($AntennaUnitGroup == "AntennaUnitGroup"){  
   												$num = 1; 													
   													for($filas = 2; $filas <= $filas_rnd; $filas++){
   														$AntennaUnitGroup_fib = $RND->getsheet($j)->getCellByColumnAndRow($i,$filas)->getValue();		
   														
   														if($name = "AntennaUnit"){	
   															 $contar = 1;								
																for($me_v = 2; $me_v < 4; $me_v++){
																	$AntennaUnitGroup_m = $RND->getsheet(7)->getCellByColumnAndRow(1,$me_v)->getValue();
																	if($AntennaUnitGroup_m == $contar){
																		//echo $AntennaUnitGroup_m .'=='. $contar."<br>";
																		$mechanicalAntennaTilt = $RND->getsheet(7)->getCellByColumnAndRow(2,$me_v)->getValue();
																	}

																	$contar++;
																	
																}
															}

   														if($AntennaUnitGroup_fib == 1){
   															if($num != 4){
                                                               $CommonAntennaSystem .= '
   	 <AntennaUnitGroup antennaUnitGroupId="'.$num.'">
   	 	    <AntennaUnit antennaUnitId="1" mechanicalAntennaTilt="'.$mechanicalAntennaTilt.'">
   	 	    	<AntennaSubunit antennaSubunitId="1">';
   	 	    													for ($port=1; $port < 5; $port++) { 
   	 	    														$CommonAntennaSystem .= '
   					<AuPort auPortId="'.$port.'" />';
   	 	    													}
   	 	    													$CommonAntennaSystem .= '
   	 	    	</AntennaSubunit>
   	 	    	<AntennaSubunit antennaSubunitId="2">
             	</AntennaSubunit>
             	<AntennaSubunit antennaSubunitId="3">
             	</AntennaSubunit>
            </AntennaUnit>';	
   															}  															
   														} 											
   																											
   														$auPortRef = $RND->getsheet($j)->getCellByColumnAndRow(3, $filas)->getValue();
   														if($auPortRef == $num){
   															 if($num != 4){
		   														$dlAttenuation = str_replace(" ", ",", $RND->getsheet($j)->getCellByColumnAndRow(4, $filas)->getValue());
		   														
   																
   															$ulAttenuation  =  str_replace(" ", ",", $RND->getsheet($j)->getCellByColumnAndRow(8, $filas)->getValue());
   															$dlTrafficDelay =  str_replace(" ", ",", $RND->getsheet($j)->getCellByColumnAndRow(5, $filas)->getValue());
   															$ulTrafficDelay =  str_replace(" ", ",", $RND->getsheet($j)->getCellByColumnAndRow(9, $filas)->getValue());

   															$CommonAntennaSystem .= '
   	  <RfBranch rfBranchId="1" rfPortRef="RRU-'.$num.'-1-A" dlAttenuation="'.$dlAttenuation .'" ulAttenuation="'.$ulAttenuation.'" dlTrafficDelay="'.$dlTrafficDelay.'"ulTrafficDelay="'.$ulTrafficDelay.'"vswrSupervisionActive="False" vswrSupervisionSensitivity="1">
        <AuPortRef auPortId="1-1-1" />
      </RfBranch>
      <RfBranch rfBranchId="2" rfPortRef="RRU-'.$num.'-1-B" dlAttenuation="'.$dlAttenuation.'" ulAttenuation="'.$ulAttenuation.'" dlTrafficDelay="'.$dlTrafficDelay.'"ulTrafficDelay="'.$ulTrafficDelay.'"vswrSupervisionActive="False" vswrSupervisionSensitivity="1">
        <AuPortRef auPortId="1-1-2" />
      </RfBranch>
      <AntennaNearUnit rfPortRef="RRU-'.$num.'-1-R" iuantDeviceType="1" anuType="IUANT" antennaNearUnitId="1">
        <RetSubUnit electricalAntennaTilt="60" antennaSubunitRef="1-1" retSubUnitId="1"/>
      </AntennaNearUnit>
      <AntennaNearUnit rfPortRef="RRU-'.$num.'-1-R" iuantDeviceType="1" anuType="IUANT" antennaNearUnitId="2">
        <RetSubUnit electricalAntennaTilt="20" antennaSubunitRef="1-2" retSubUnitId="1"/>
      </AntennaNearUnit>
      <AntennaNearUnit rfPortRef="RRU-'.$num.'-1-R" iuantDeviceType="1" anuType="IUANT" antennaNearUnitId="3">
        <RetSubUnit electricalAntennaTilt="20" antennaSubunitRef="1-3" retSubUnitId="1"/>
      </AntennaNearUnit>
      <RfBranch rfBranchId="3" rfPortRef="RRU-'.$num.'-2-A" dlAttenuation="'.$dlAttenuation.'" ulAttenuation="'.$ulAttenuation.'" dlTrafficDelay="'.$dlTrafficDelay.'"ulTrafficDelay="'.$ulTrafficDelay.'"vswrSupervisionActive="False" vswrSupervisionSensitivity="1">
        <AuPortRef auPortId="1-1-3" />
      </RfBranch>
      <RfBranch rfBranchId="4" rfPortRef="RRU-'.$num.'-2-B" dlAttenuation="'.$dlAttenuation.'" ulAttenuation="'.$ulAttenuation.'" dlTrafficDelay="'.$dlTrafficDelay.'"ulTrafficDelay="'.$ulTrafficDelay.'"vswrSupervisionActive="False" vswrSupervisionSensitivity="1">
        <AuPortRef auPortId="1-1-4" />
      </RfBranch>
    </AntennaUnitGroup>';
      													 }
   														}

   														$num++; 
   													}
   												}



   												if($AntennaUnitGroup == "auPortRef"){
   													$col_auPortRef = $i;
   												}

   												

   											}
   										}
   								}
							

						}else{//fin del if para la validacion si cumple si es AIR
							if($name == "SectorEquipmentFunction"){								
								for($sector = 1; $sector <= 3; $sector++){
									if($sector == 1){
										$du_1 = "DU-1-A";
										$du_2 = "DU-1-D";
									}
									if($sector == 2){
										$du_1 = "DU-1-B";
										$du_2 = "DU-1-E";
									}
									if($sector == 3){
										$du_1 = "DU-1-C";
										$du_2 = "DU-1-F";
									}

									$contenidoSector = '
  <SectorEquipment sectorFunctionId="'.$sector.'" configuredOutputPower="40000">';
										$contenidoSector .= '
	<RadioEquipment>
	  <RadioUnit unitId="RRU-'.$sector.' " primaryPort="'.$du_1.'" />	  
	</RadioEquipment>
	<AntennaEquipment>
	  <RfBranchRef rfBranchId="'.$sector.'-1" />
	  <RfBranchRef rfBranchId="'.$sector.'-2" />
	</AntennaEquipment>
  </SectorEquipment>';
									@$Sectores = $Sectores.$contenidoSector;
									@$SectoresFinal = $Sectores;
								}
							}//fin del if para el nombre de la hoja a buscar SectorEquipmentFunction								

							    if($name == 'RfBranch'){
									$CommonAntennaSystem = "
  <CommonAntennaSystem>";
   									$filas_rnd  = $RND->getSheet($j)->getHighestRow(); 
   									$Column_rnd = $RND->getSheet($j)->getHighestColumn();
   									$NumColumn  = PHPExcel_Cell::columnIndexFromString($Column_rnd);
   										for($r = 1; $r <= $filas_rnd; $r++){
   											for ($i=0; $i <= $NumColumn; $i++) {
   												$AntennaUnitGroup = $RND->getsheet($j)->getCellByColumnAndRow($i,$r)->getValue();								

   												if($AntennaUnitGroup == "AntennaUnitGroup"){  
   												$num = 1; 													
   													for($filas = 2; $filas <= $filas_rnd; $filas++){
   														$AntennaUnitGroup_fib = $RND->getsheet($j)->getCellByColumnAndRow($i,$filas)->getValue();		
   														
   														if($name = "AntennaUnit"){	
   															 $contar = 1;								
																for($me_v = 2; $me_v < 4; $me_v++){
																	$AntennaUnitGroup_m = $RND->getsheet(7)->getCellByColumnAndRow(1,$me_v)->getValue();
																	if($AntennaUnitGroup_m == $contar){
																		//echo $AntennaUnitGroup_m .'=='. $contar."<br>";
																		$mechanicalAntennaTilt = $RND->getsheet(7)->getCellByColumnAndRow(2,$me_v)->getValue();
																	}

																	$contar++;
																	
																}
															}

   														if($AntennaUnitGroup_fib == 1){
   															if($num != 4){
                                                               $CommonAntennaSystem .= '
   	 <AntennaUnitGroup antennaUnitGroupId="'.$num.'">
   	 	    <AntennaUnit antennaUnitId="1" mechanicalAntennaTilt="'.$mechanicalAntennaTilt.'">
   	 	    	<AntennaSubunit antennaSubunitId="1">';
   	 	    													for ($port=1; $port <3; $port++) { 
   	 	    														$CommonAntennaSystem .= '
   					<AuPort auPortId="'.$port.'" />';
   	 	    													}
   	 	    													$CommonAntennaSystem .= '
   	 	    	</AntennaSubunit>
            </AntennaUnit>';	
   															}  															
   														} 											
   																											
   														$auPortRef = $RND->getsheet($j)->getCellByColumnAndRow(3, $filas)->getValue();
   														if($auPortRef == $num){
   															 if($num != 4){
		   														$dlAttenuation = str_replace(" ", ",", $RND->getsheet($j)->getCellByColumnAndRow(4, $filas)->getValue());
		   														
   																
   															$ulAttenuation  =  str_replace(" ", ",", $RND->getsheet($j)->getCellByColumnAndRow(8, $filas)->getValue());
   															$dlTrafficDelay =  str_replace(" ", ",", $RND->getsheet($j)->getCellByColumnAndRow(5, $filas)->getValue());
   															$ulTrafficDelay =  str_replace(" ", ",", $RND->getsheet($j)->getCellByColumnAndRow(9, $filas)->getValue());

   															$CommonAntennaSystem .= '
   	  <RfBranch rfBranchId="1" rfPortRef="RRU-'.$num.'-1-A" dlAttenuation="'.$dlAttenuation .'" ulAttenuation="'.$ulAttenuation.'" dlTrafficDelay="'.$dlTrafficDelay.'"ulTrafficDelay="'.$ulTrafficDelay.'"vswrSupervisionActive="False" vswrSupervisionSensitivity="1">
        <AuPortRef auPortId="1-1-1" />
      </RfBranch>
      <RfBranch rfBranchId="2" rfPortRef="RRU-'.$num.'-1-B" dlAttenuation="'.$dlAttenuation.'" ulAttenuation="'.$ulAttenuation.'" dlTrafficDelay="'.$dlTrafficDelay.'"ulTrafficDelay="'.$ulTrafficDelay.'"vswrSupervisionActive="False" vswrSupervisionSensitivity="1">
        <AuPortRef auPortId="1-1-2" />
      </RfBranch>
      <AntennaNearUnit rfPortRef="RRU-'.$num.'-R" iuantDeviceType="1" anuType="IUANT" antennaNearUnitId="1">
        <RetSubUnit electricalAntennaTilt="70" antennaSubunitRef="1-1" retSubUnitId="1"/>
      </AntennaNearUnit>
      <RfBranch rfBranchId="3" rfPortRef="RRU-'.$num.'-A" dlAttenuation="'.$dlAttenuation.'" ulAttenuation="'.$ulAttenuation.'" dlTrafficDelay="'.$dlTrafficDelay.'"ulTrafficDelay="'.$ulTrafficDelay.'"vswrSupervisionActive="False" vswrSupervisionSensitivity="1">
        <AuPortRef auPortId="1-1-3" />
      </RfBranch>
      <RfBranch rfBranchId="4" rfPortRef="RRU-'.$num.'-B" dlAttenuation="'.$dlAttenuation.'" ulAttenuation="'.$ulAttenuation.'" dlTrafficDelay="'.$dlTrafficDelay.'"ulTrafficDelay="'.$ulTrafficDelay.'"vswrSupervisionActive="False" vswrSupervisionSensitivity="1">
        <AuPortRef auPortId="1-1-4" />
      </RfBranch>
    </AntennaUnitGroup>';
      													 }
   														}

   														$num++; 
   													}
   												}



   												if($AntennaUnitGroup == "auPortRef"){
   													$col_auPortRef = $i;
   												}

   												

   											}
   										}
   								}
						}
						$j++;
			}//fin del for para los nombre del archivo RND
//die();
			$nombre_hoja_rnd = $RND->getSheetNames();	
			$j=0;
			foreach ($nombre_hoja_rnd as $name_h_rnd) {
				
				if($name_h_rnd == "EUtranCellFDD"){//esto es para el archivo 6 y 11 y 13
					$name_h_rnd_EUtranCellFDD = $j;
				}

				if($name_h_rnd == "EUtranFrequency"){//esto es para el archivo 7.1
					$name_h_rnd_EUtranFrequency = $j;
				}

				if($name_h_rnd == "EUtranFreqRelation"){//esto es para el archivo 7.2
					$name_h_rnd_EUtranFreqRelation = $j;
				}

				if($name_h_rnd == "EUtranCellRelation"){//esto es para el archivo 8 y 15
					$name_h_rnd_EUtranCellRelation = $j;
				}

				if($name_h_rnd == "ExternalENodeBFunction"){//esto es para el archivo 8, 14
					$name_h_rnd_ExternalENodeBFunction = $j;
				}

				if($name_h_rnd == "ExternalEUtranCellFDD"){//esto es para el archivo 8, 11, 15
					$name_h_rnd_ExternalEUtranCellFDD = $j;
				}

				if($name_h_rnd == "UtranFrequency"){//esto es para el archivo 9
					$name_h_rnd_UtranFrequency = $j;
				}

				if($name_h_rnd == "UtranFreqRelation"){//esto es para el archivo 9
					$name_h_rnd_UtranFreqRelation = $j;					
				}

				if($name_h_rnd == "Features"){//esto es para el archivo 10
					$name_h_rnd_Features = $j;					
				}

				if($name_h_rnd == "DrxProfile"){//esto es para el archivo 11
					$NombreHojaRNDDrxProfile = $name_h_rnd;
					$name_h_rnd_DrxProfile = $j;					
				}				

				if($name_h_rnd == "Paging"){//esto es para el archivo 11
					$name_h_rnd_Paging = $j;					
				}

				if($name_h_rnd == "ReportConfigA1Prim"){//esto es para el archivo 11
					$name_h_rnd_ReportConfigA1Prim = $j;					
				}

				if($name_h_rnd == "ReportConfigA5"){//esto es para el archivo 11
					$name_h_rnd_ReportConfigA5 = $j;					
				}

				if($name_h_rnd == "ReportConfigA5Anr"){//esto es para el archivo 11 y 13
					$name_h_rnd_ReportConfigA5Anr = $j;					
				}

				if($name_h_rnd == "ReportConfigB2Utra"){//esto es para el archivo 11
					$name_h_rnd_ReportConfigB2Utra = $j;					
				}

				if($name_h_rnd == "ReportConfigEUtraBadCovPrim"){//esto es para el archivo 11
					$name_h_rnd_ReportConfigEUtraBadCovPrim = $j;					
				}

				if($name_h_rnd == "ReportConfigEUtraBadCovSec"){//esto es para el archivo 11
					$name_h_rnd_ReportConfigEUtraBadCovSec = $j;					
				}

				if($name_h_rnd == "ReportConfigEUtraBestCell"){//esto es para el archivo 11
					$name_h_rnd_ReportConfigEUtraBestCell = $j;					
				}

				if($name_h_rnd == "ReportConfigEUtraBestCellAnr"){//esto es para el archivo 11
					$name_h_rnd_ReportConfigEUtraBestCellAnr = $j;					
				}

				if($name_h_rnd == "ReportConfigSearch"){//esto es para el archivo 11 y 13
					$name_h_rnd_ReportConfigSearch = $j;					
				}

				if($name_h_rnd == "ReportConfigSCellA1A2"){//esto es para el archivo 11
					$name_h_rnd_ReportConfigSCellA1A2 = $j;					
				}

				if($name_h_rnd == "RetSubUnit"){//esto es para el archivo 11
					$name_h_rnd_RetSubUnit = $j;					
				}

				if($name_h_rnd == "RfBranch"){//esto es para el archivo 4_2, 11
					$name_h_rnd_RfBranch = $j;					
				}

				if($name_h_rnd == "SectorCarrier"){//esto es para el archivo 4_2, 11 y 13
					$name_h_rnd_SectorCarrier = $j;					
				}

				if($name_h_rnd == "SectorEquipmentFunction" && $name_h_rnd == "SectorEquipmentFunction"){//esto es para el archivo 4, 11 y 13
					$NombreHojaRNDSectorEquipmentFunction = $name_h_rnd;
					$name_h_rnd_SectorEquipmentFunction = $j;					
				}

				if($name_h_rnd == "UeMeasControl"){//esto es para el archivo 11 y13
					$name_h_rnd_UeMeasControl = $j;					
				}

				if($name_h_rnd == "Features"){//esto es para el archivo 11
					$name_h_rnd_Features = $j;					
				}

				if($name_h_rnd == "Licensing"){//esto es para el archivo 11
					$name_h_rnd_Licensing = $j;					
				}

				if($name_h_rnd == "UtranFrequency"){//esto es para el archivo 11
					$name_h_rnd_UtranFrequency = $j;					
				}

				if($name_h_rnd == "QciProfilePredefined"){//esto es para el archivo 11
					$name_h_rnd_QciProfilePredefined = $j;					
				}

				if($name_h_rnd == "SecurityHandling"){//esto es para el archivo 11 y 13
					$name_h_rnd_SecurityHandling = $j;					
				}

				if($name_h_rnd == "Sctp" or $name_h_rnd == "SctpProfile"){//esto es para el archivo 11
					$NombreHojaRNDSctp = $name_h_rnd;
					$name_h_rnd_Sctp = $j;					
				}

				if($name_h_rnd == "Rrc"){//esto es para el archivo 11
					$name_h_rnd_Rrc = $j;					
				}

				if($name_h_rnd == "AutoCellCapEstFunction"){//esto es para el archivo 11
					$name_h_rnd_AutoCellCapEstFunction = $j;					
				}

				if($name_h_rnd == "AdmissionControl"){//esto es para el archivo 12
					$name_h_rnd_AdmissionControl = $j;					
				}

				if($name_h_rnd == "AnrFunction"){//esto es para el archivo 12
					$name_h_rnd_AnrFunction = $j;					
				}

				if($name_h_rnd == "AnrFunctionEUtran"){//esto es para el archivo 12
					$name_h_rnd_AnrFunctionEUtran = $j;					
				}

				if($name_h_rnd == "AnrFunctionGeran"){//esto es para el archivo 12
					$name_h_rnd_AnrFunctionGeran = $j;					
				}

				if($name_h_rnd == "AnrFunctionUtran"){//esto es para el archivo 12
					$name_h_rnd_AnrFunctionUtran = $j;					
				}

				if($name_h_rnd == "AntennaSubunit"){//esto es para el archivo 4_2, 12
					$name_h_rnd_AntennaSubunit = $j;					
				}

				if($name_h_rnd == "AntennaUnit"){//esto es para el archivo 12
					$name_h_rnd_AntennaUnit = $j;					
				}

				if($name_h_rnd == "CarrierAggregationFunction"){//esto es para el archivo 12
					$name_h_rnd_CarrierAggregationFunction = $j;					
				}

				if($name_h_rnd == "CellSleepFunction"){//esto es para el archivo 12
					$name_h_rnd_CellSleepFunction = $j;					
				}

				if($name_h_rnd == "CellSleepNodeFunction"){//esto es para el archivo 12
					$name_h_rnd_CellSleepNodeFunction = $j;					
				}

				if($name_h_rnd == "DataRadioBearer"){//esto es para el archivo 12
					$name_h_rnd_DataRadioBearer = $j;					
				}

				if($name_h_rnd == "ENodeBFunction"){//esto es para el archivo 5, 12
					$name_h_rnd_ENodeBFunction = $j;					
				}

				if($name_h_rnd == "LoadBalancingFunction"){//esto es para el archivo 13
					$name_h_rnd_LoadBalancingFunction = $j;					
				}

				if($name_h_rnd == "MACConfiguration"){//esto es para el archivo 13
					$name_h_rnd_MACConfiguration = $j;					
				}

				if($name_h_rnd == "MdtConfiguration"){//esto es para el archivo 13
					$name_h_rnd_MdtConfiguration = $j;					
				}

				if($name_h_rnd == "MimoSleepFunction"){//esto es para el archivo 13
					$name_h_rnd_MimoSleepFunction = $j;					
				}

				if($name_h_rnd == "NodeManagementFunction"){//esto es para el archivo 13
					$name_h_rnd_NodeManagementFunction = $j;					
				}

				if($name_h_rnd == "NonPlannedPciDrxProfile"){//esto es para el archivo 13
					$name_h_rnd_NonPlannedPciDrxProfile = $j;					
				}

				if($name_h_rnd == "OpProfiles"){//esto es para el archivo 13
					$name_h_rnd_OpProfiles = $j;					
				}

				if($name_h_rnd == "PmEventService"){//esto es para el archivo 13
					$name_h_rnd_PmEventService = $j;					
				}

				if($name_h_rnd == "PmService"){//esto es para el archivo 13
					$name_h_rnd_PmService = $j;					
				}

				if($name_h_rnd == "PreschedulingProfile"){//esto es para el archivo 13
					$name_h_rnd_PreschedulingProfile = $j;					
				}

				if($name_h_rnd == "QciProfilePredefined"){//esto es para el archivo 13
					$name_h_rnd_QciProfilePredefined = $j;					
				}

				if($name_h_rnd == "Rcs"){//esto es para el archivo 13
					$name_h_rnd_Rcs = $j;					
				}

				if($name_h_rnd == "ReportConfigA1Sec"){//esto es para el archivo 13
					$name_h_rnd_ReportConfigA1Sec = $j;					
				}

				if($name_h_rnd == "ReportConfigA4"){//esto es para el archivo 13
					$name_h_rnd_ReportConfigA4 = $j;					
				}

				if($name_h_rnd == "ReportConfigA5"){//esto es para el archivo 13
					$name_h_rnd_ReportConfigA5 = $j;					
				}

				if($name_h_rnd == "ReportConfigA5SoftLock"){//esto es para el archivo 13
					$name_h_rnd_ReportConfigA5SoftLock = $j;					
				}

				if($name_h_rnd == "ReportConfigA5UlTrig"){//esto es para el archivo 13
					$name_h_rnd_ReportConfigA5UlTrig = $j;					
				}

				if($name_h_rnd == "ReportConfigB1Geran"){//esto es para el archivo 13
					$name_h_rnd_ReportConfigB1Geran = $j;					
				}

				if($name_h_rnd == "ReportConfigB1Utra"){//esto es para el archivo 13
					$name_h_rnd_ReportConfigB1Utra = $j;					
				}

				if($name_h_rnd == "ReportConfigB2Geran"){//esto es para el archivo 13
					$name_h_rnd_ReportConfigB2Geran = $j;					
				}

				if($name_h_rnd == "ReportConfigB2GeranUlTrig"){//esto es para el archivo 13
					$name_h_rnd_ReportConfigB2GeranUlTrig = $j;					
				}

				if($name_h_rnd == "ReportConfigB2UtraUlTrig"){//esto es para el archivo 13
					$name_h_rnd_ReportConfigB2UtraUlTrig = $j;					
				}

				if($name_h_rnd == "ReportConfigCsfbUtra"){//esto es para el archivo 13
					$name_h_rnd_ReportConfigCsfbUtra = $j;					
				}

				if($name_h_rnd == "ReportConfigCsg"){//esto es para el archivo 13
					$name_h_rnd_ReportConfigCsg = $j;					
				}

				if($name_h_rnd == "ReportConfigEUtraIFA3UlTrig"){//esto es para el archivo 13
					$name_h_rnd_ReportConfigEUtraIFA3UlTrig = $j;					
				}

				if($name_h_rnd == "ReportConfigEUtraIFBestCell"){//esto es para el archivo 13
					$name_h_rnd_ReportConfigEUtraIFBestCell = $j;					
				}


				if($name_h_rnd == "ReportConfigEUtraInterFreqMbms"){//esto es para el archivo 13
					$name_h_rnd_ReportConfigEUtraInterFreqMbms = $j;					
				}

				if($name_h_rnd == "ReportConfigInterRatLb"){//esto es para el archivo 13
					$name_h_rnd_ReportConfigInterRatLb = $j;					
				}

				if($name_h_rnd == "ReportConfigSCellA4"){//esto es para el archivo 13
					$name_h_rnd_ReportConfigSCellA4 = $j;					
				}

				if($name_h_rnd == "ReportConfigSCellA6"){//esto es para el archivo 13
					$name_h_rnd_ReportConfigSCellA6 = $j;					
				}

				if($name_h_rnd == "ReportConfigEUtraInterFreqLb"){//esto es para el archivo 13
					$name_h_rnd_ReportConfigEUtraInterFreqLb = $j;					
				}

				if($name_h_rnd == "RfPort"){//esto es para el archivo 13
					$name_h_rnd_RfPort = $j;					
				}

				if($name_h_rnd == "RlfProfile"){//esto es para el archivo 13
					$name_h_rnd_RlfProfile = $j;					
				}

				if($name_h_rnd == "SignalingRadioBearer"){//esto es para el archivo 13
					$name_h_rnd_SignalingRadioBearer = $j;					
				}
				//echo $j." -- ".$name_h_rnd."<br>";
				$j++;
			}

			//////////////////////////////////////////////////////////////////////////
			//Contrucion del archivo 4_2
			//
			//
			/////////////////////////////////////////////////////////////////////////
			if($this->frecuencia == "AIR"){
				if(isset($name_h_rnd_SectorEquipmentFunction)){
				$SectorEquipmentFunction_4_2 = $RND->getSheet($name_h_rnd_SectorEquipmentFunction);//esto es para la 1 parte del archivo 4_2
				$filas_SectorEquipmentFunction_4_2_rnd  = $SectorEquipmentFunction_4_2 ->getHighestRow(); 
				$Column_SectorEquipmentFunction_4_2_rnd = $SectorEquipmentFunction_4_2 ->getHighestColumn();
				$NumColumn_SectorEquipmentFunction_4_2  = PHPExcel_Cell::columnIndexFromString($Column_SectorEquipmentFunction_4_2_rnd);
				for ($i=2; $i <=$filas_SectorEquipmentFunction_4_2_rnd; $i++) { 
					for ($x=0; $x <= $NumColumn_SectorEquipmentFunction_4_2; $x++) {
						$nombre_campo_SectorEquipmentFunction_4_2 = $SectorEquipmentFunction_4_2->getCellByColumnAndRow($x,1)->getValue();
						$valor_campo1 = $SectorEquipmentFunction_4_2->getCellByColumnAndRow($x,$i)->getValue();
						if($nombre_campo_SectorEquipmentFunction_4_2 == "userLabel"){
							if($valor_campo1 == "LTE700"){
								$valor_campo2 = $SectorEquipmentFunction_4_2->getCellByColumnAndRow(1,$i)->getValue();
								if($valor_campo2 == 6){
									$valor_campo3 = '
gs-';
								}
								$continido_1_4_B[] ='
crn SectorEquipmentFunction='.$valor_campo2.'
administrativeState 0
mixedModeRadio false
rfBranchRef 
userLabel 
end'.$valor_campo3.'
';
							}
						}	
					}
				}
			}

				$SectorCarrier_4_2 = $RND->getSheet($name_h_rnd_SectorCarrier);//esto es para la 1 parte del archivo 4_2
				$filas_SectorCarrier_4_2_rnd  = $SectorCarrier_4_2 ->getHighestRow(); 
				$Column_SectorCarrier_4_2_rnd = $SectorCarrier_4_2 ->getHighestColumn();
				$NumColumn_SectorCarrier_4_2  = PHPExcel_Cell::columnIndexFromString($Column_SectorCarrier_4_2_rnd);
				for ($i=2; $i <=$filas_SectorCarrier_4_2_rnd; $i++) { 
					for ($x=0; $x <= $NumColumn_SectorCarrier_4_2; $x++) {
						$nombre_campo_SectorCarrier_4_2 = $SectorCarrier_4_2->getCellByColumnAndRow($x,1)->getValue();
						$valor_campo1 = $SectorCarrier_4_2->getCellByColumnAndRow(1,$i)->getValue();
						if($nombre_campo_SectorCarrier_4_2 == "SectorCarrier"){
							if($valor_campo1 > 3){
								$valor_campo2 = $SectorCarrier_4_2->getCellByColumnAndRow(3,$i)->getValue();
								$valor_campo3 = $SectorCarrier_4_2->getCellByColumnAndRow(4,$i)->getValue();
								$continido_1_4_B[] ='
crn ENodeBFunction=1,SectorCarrier='.$valor_campo1.'
noOfRxAntennas '.$valor_campo2.'
noOfTxAntennas '.$valor_campo3.'
prsEnabled true
rfBranchRxRef 
rfBranchTxRef 
sectorFunctionRef SectorEquipmentFunction='.$valor_campo1.'
end

';
							}
						}	
					}
				}
			

				$AntennaSubunit_4_2 = $RND->getSheet($name_h_rnd_AntennaSubunit);//esto es para la 1 parte del archivo 4_2
				$filas_AntennaSubunit_4_2_rnd  = $AntennaSubunit_4_2 ->getHighestRow(); 
				$Column_AntennaSubunit_4_2_rnd = $AntennaSubunit_4_2 ->getHighestColumn();
				$NumColumn_AntennaSubunit_4_2  = PHPExcel_Cell::columnIndexFromString($Column_AntennaSubunit_4_2_rnd);
				for ($i=2; $i <=$filas_AntennaSubunit_4_2_rnd; $i++) { 
					for ($x=0; $x <= $NumColumn_AntennaSubunit_4_2; $x++) {
						$nombre_campo_AntennaSubunit_4_2 = $AntennaSubunit_4_2->getCellByColumnAndRow($x,1)->getValue();
						$valor_campo1 = $AntennaSubunit_4_2->getCellByColumnAndRow(1,$i)->getValue();
						if($nombre_campo_AntennaSubunit_4_2 == "AntennaUnitGroup"){
							if($valor_campo1 > 3){
								$valor_campo2 = $AntennaSubunit_4_2->getCellByColumnAndRow(3,$i)->getValue();
								$valor_campo3 = $AntennaSubunit_4_2->getCellByColumnAndRow(5,$i)->getValue();
								$valor_campo4 = $AntennaSubunit_4_2->getCellByColumnAndRow(6,$i)->getValue();
								$valor_campo5 = $AntennaSubunit_4_2->getCellByColumnAndRow(4,$i)->getValue();
								$valor_campo6 = $AntennaSubunit_4_2->getCellByColumnAndRow(9,$i)->getValue();
								$continido_1_4_B[] 	='
crn Equipment=1,AntennaUnitGroup='.$valor_campo1.'
end

crn Equipment=1,AntennaUnitGroup='.$valor_campo1.',AntennaUnit=1
mechanicalAntennaTilt '.$valor_campo6.'
end

crn Equipment=1,AntennaUnitGroup='.$valor_campo1.',AntennaUnit=1,AntennaSubunit=1
azimuthHalfPowerBeamwidth '.$valor_campo2.'
commonChBeamfrmPortMap '.$valor_campo5.'
customComChBeamfrmWtsAmplitude '.str_replace(" ", ",",$valor_campo3).'
customComChBeamfrmWtsPhase '.str_replace(" ", ",",$valor_campo4).'
retSubunitRef 
end

	';
							}
						}	
					}
				}

				$RfBranch_4_2 = $RND->getSheet($name_h_rnd_RfBranch);//esto es para la 1 parte del archivo 4_2
				$filas_RfBranch_4_2_rnd  = $RfBranch_4_2 ->getHighestRow(); 
				$Column_RfBranch_4_2_rnd = $RfBranch_4_2 ->getHighestColumn();
				$NumColumn_RfBranch_4_2  = PHPExcel_Cell::columnIndexFromString($Column_RfBranch_4_2_rnd);
				for ($i=2; $i <=$filas_RfBranch_4_2_rnd; $i++) { 
					for ($x=0; $x <= $NumColumn_RfBranch_4_2; $x++) {
						$nombre_campo_RfBranch_4_2 = $RfBranch_4_2->getCellByColumnAndRow($x,1)->getValue();
						$valor_campo1 = $RfBranch_4_2->getCellByColumnAndRow(1,$i)->getValue();
						if($nombre_campo_RfBranch_4_2 == "AntennaUnitGroup"){
							if($valor_campo1 > 3){
								$valor_campo2 = $RfBranch_4_2->getCellByColumnAndRow(2,$i)->getValue();
								$valor_campo3 = $RfBranch_4_2->getCellByColumnAndRow(4,$i)->getValue();
								$valor_campo4 = $RfBranch_4_2->getCellByColumnAndRow(5,$i)->getValue();
								$valor_campo5 = $RfBranch_4_2->getCellByColumnAndRow(8,$i)->getValue();
								$valor_campo6 = $RfBranch_4_2->getCellByColumnAndRow(9,$i)->getValue();
								$continido_1_4_B[] ='
crn Equipment=1,AntennaUnitGroup='.$valor_campo1.',RfBranch='.$valor_campo2.'
auPortRef 
dlAttenuation '.str_replace(" ", ",",substr($valor_campo3, 0, -1)).'
dlTrafficDelay '.str_replace(" ",",",substr($valor_campo4, 0, -1)).'
rfPortRef 
tmaRef 
ulAttenuation '.str_replace(" ", ",",substr($valor_campo5, 0, -1)).'
ulTrafficDelay '.str_replace(" ", ",", substr($valor_campo6, 0, -1)).'
userLabel 
end
';
							}
						}	
					}
				}

				$RfBranch_4_2 = $RND->getSheet($name_h_rnd_RfBranch);//esto es para la 1 parte del archivo 4_2
				$filas_RfBranch_4_2_rnd  = $RfBranch_4_2 ->getHighestRow(); 
				$Column_RfBranch_4_2_rnd = $RfBranch_4_2 ->getHighestColumn();
				$NumColumn_RfBranch_4_2  = PHPExcel_Cell::columnIndexFromString($Column_RfBranch_4_2_rnd);
				for ($i=2; $i <=$filas_RfBranch_4_2_rnd; $i++) { 
					for ($x=0; $x <= $NumColumn_RfBranch_4_2; $x++) {
						$nombre_campo_RfBranch_4_2 = $RfBranch_4_2->getCellByColumnAndRow($x,1)->getValue();
						$valor_campo1 = $RfBranch_4_2->getCellByColumnAndRow(1,$i)->getValue();
						if($nombre_campo_RfBranch_4_2 == "AntennaUnitGroup"){
							if($valor_campo1 > 3){
								$valor_campo2 = $RfBranch_4_2->getCellByColumnAndRow(2,$i)->getValue();
								$valor_campo3 = $RfBranch_4_2->getCellByColumnAndRow(3,$i)->getValue();
								$valor_campo3 = $valor_campo3 == 1 ? 2 : 1;

								$continido_1_4_B[] ='
crn Equipment=1,AntennaUnitGroup='.$valor_campo1.',AntennaUnit=1,AntennaSubunit=1,AuPort='.$valor_campo3.'
userLabel 
end
';
							}
						}	
					}
				}

				$RfBranch_4_2 = $RND->getSheet($name_h_rnd_RfBranch);//esto es para la 1 parte del archivo 4_2
				$filas_RfBranch_4_2_rnd  = $RfBranch_4_2 ->getHighestRow(); 
				$Column_RfBranch_4_2_rnd = $RfBranch_4_2 ->getHighestColumn();
				$NumColumn_RfBranch_4_2  = PHPExcel_Cell::columnIndexFromString($Column_RfBranch_4_2_rnd);
				for ($i=2; $i <=$filas_RfBranch_4_2_rnd; $i++) { 
					for ($x=0; $x <= $NumColumn_RfBranch_4_2; $x++) {
						$nombre_campo_RfBranch_4_2 = $RfBranch_4_2->getCellByColumnAndRow($x,1)->getValue();
						$valor_campo1 = $RfBranch_4_2->getCellByColumnAndRow(1,$i)->getValue();
						$valor_campo2 = $RfBranch_4_2->getCellByColumnAndRow(2,$i)->getValue();
						if($nombre_campo_RfBranch_4_2 == "AntennaUnitGroup"){
							if($valor_campo1 > 3){
								if($valor_campo2 == 1){
									$continido_1_4_B[] ='
lset SectorEquipmentFunction='.$valor_campo1.'$ rfBranchRef Equipment=1,AntennaUnitGroup='.$valor_campo1.',RfBranch=1 Equipment=1,AntennaUnitGroup='.$valor_campo1.',RfBranch=2 ';
								}
							}
						}	
					}
				}

				$RfBranch_4_2 = $RND->getSheet($name_h_rnd_RfBranch);//esto es para la 1 parte del archivo 4_2
				$filas_RfBranch_4_2_rnd  = $RfBranch_4_2 ->getHighestRow(); 
				$Column_RfBranch_4_2_rnd = $RfBranch_4_2 ->getHighestColumn();
				$NumColumn_RfBranch_4_2  = PHPExcel_Cell::columnIndexFromString($Column_RfBranch_4_2_rnd);
				for ($i=2; $i <=$filas_RfBranch_4_2_rnd; $i++) { 
					for ($x=0; $x <= $NumColumn_RfBranch_4_2; $x++) {
						$nombre_campo_RfBranch_4_2 = $RfBranch_4_2->getCellByColumnAndRow($x,1)->getValue();
						$valor_campo1 = $RfBranch_4_2->getCellByColumnAndRow(1,$i)->getValue();
						$valor_campo2 = $RfBranch_4_2->getCellByColumnAndRow(2,$i)->getValue();
						if($valor_campo2 == 2){
							$espacio ='
							';
						}

						if($nombre_campo_RfBranch_4_2 == "AntennaUnitGroup"){
							if($valor_campo1 > 3){
									$continido_1_4_B[] ='
lset Equipment=1,AntennaUnitGroup='.$valor_campo1.',RfBranch='.$valor_campo2.'$ auPortRef Equipment=1,AntennaUnitGroup='.$valor_campo1.',AntennaUnit=1,AntennaSubunit=1,AuPort='.$valor_campo2.$espacio;
							}
						}	
					}
				}

				$RfPort_4_2 = $RND->getSheet($name_h_rnd_RfPort);//esto es para la 1 parte del archivo 4_2
				$filas_RfPort_4_2_rnd  = $RfPort_4_2 ->getHighestRow(); 
				$Column_RfPort_4_2_rnd = $RfPort_4_2 ->getHighestColumn();
				$NumColumn_RfPort_4_2  = PHPExcel_Cell::columnIndexFromString($Column_RfPort_4_2_rnd);
				for ($i=2; $i <=$filas_RfPort_4_2_rnd; $i++) { 
					for ($x=0; $x <= $NumColumn_RfPort_4_2; $x++) {
						$nombre_campo_RfPort_4_2 = $RfPort_4_2->getCellByColumnAndRow($x,1)->getValue();
						$valor_campo1 = $RfPort_4_2->getCellByColumnAndRow(1,$i)->getValue();
						$valor_campo3 = $RfPort_4_2->getCellByColumnAndRow(3,$i)->getValue();
						if($nombre_campo_RfPort_4_2 == "AuxPlugInUnit"){
							if($valor_campo1 == "RRU-4" or $valor_campo1 == "RRU-5" or $valor_campo1 == "RRU-6"){
								if($valor_campo3 == "A"){
									$continido_1_4_B[] ='
crn Equipment=1,AuxPlugInUnit='.$valor_campo1.'
administrativeState 1
piuType PiuType=KRC161550/1_*
position 0
positionInformation 
positionRef 
end
	';
								}
							}
						}
					}
				}


				$RfPort_4_2 = $RND->getSheet($name_h_rnd_RfPort);//esto es para la 1 parte del archivo 4_2
				$filas_RfPort_4_2_rnd  = $RfPort_4_2 ->getHighestRow(); 
				$Column_RfPort_4_2_rnd = $RfPort_4_2 ->getHighestColumn();
				$NumColumn_RfPort_4_2  = PHPExcel_Cell::columnIndexFromString($Column_RfPort_4_2_rnd);
				for ($i=2; $i <=$filas_RfPort_4_2_rnd; $i++) { 
					for ($x=0; $x <= $NumColumn_RfPort_4_2; $x++) {
						$nombre_campo_RfPort_4_2 = $RfPort_4_2->getCellByColumnAndRow($x,1)->getValue();
						$valor_campo1 = $RfPort_4_2->getCellByColumnAndRow(1,$i)->getValue();
						$valor_campo2 = $RfPort_4_2->getCellByColumnAndRow(2,$i)->getValue();
						$valor_campo3 = $RfPort_4_2->getCellByColumnAndRow(3,$i)->getValue();
						if($valor_campo3 == "A"){
							$nuemro = 1;
						}else if($valor_campo3 == "B"){
							$nuemro = 2;
						}

						if($nombre_campo_RfPort_4_2 == "AuxPlugInUnit"){
							if($valor_campo1 == "RRU-4" or $valor_campo1 == "RRU-5" or $valor_campo1 == "RRU-6"){
								if($valor_campo3 != "R"){
									$continido_1_4_B[] ='
lset Equipment=1,AntennaUnitGroup='.substr($valor_campo1,-1).',RfBranch='.$nuemro.'$ rfPortRef AuxPlugInUnit='.$valor_campo1.',DeviceGroup=ru,RfPort='.$valor_campo3;
								}
							}
						}	
					}
				}

				///// aparir de aqui comienza el 3
				$SectorEquipmentFunction_4_2 = $RND->getSheet($name_h_rnd_SectorEquipmentFunction);//esto es para la 1 parte del archivo 4_3
				$filas_SectorEquipmentFunction_4_2_rnd  = $SectorEquipmentFunction_4_2 ->getHighestRow(); 
				$Column_SectorEquipmentFunction_4_2_rnd = $SectorEquipmentFunction_4_2 ->getHighestColumn();
				$NumColumn_SectorEquipmentFunction_4_2  = PHPExcel_Cell::columnIndexFromString($Column_SectorEquipmentFunction_4_2_rnd);
				for ($i=2; $i <=$filas_SectorEquipmentFunction_4_2_rnd; $i++) { 
					for ($x=0; $x <= $NumColumn_SectorEquipmentFunction_4_2; $x++) {
						$nombre_campo_SectorEquipmentFunction_4_2 = $SectorEquipmentFunction_4_2->getCellByColumnAndRow($x,1)->getValue();
						$valor_campo1 = $SectorEquipmentFunction_4_2->getCellByColumnAndRow($x,$i)->getValue();
						if($nombre_campo_SectorEquipmentFunction_4_2 == "userLabel"){
							if($valor_campo1 == "LTE1900"){
								$valor_campo2 = $SectorEquipmentFunction_4_2->getCellByColumnAndRow(1,$i)->getValue();
								$continido_1_4_C[] ='crn SectorEquipmentFunction='.$valor_campo2.'
administrativeState 0
mixedModeRadio false
rfBranchRef 
userLabel 
end

';
							}
						}	
					}
				}

				$SectorCarrier_4_2 = $RND->getSheet($name_h_rnd_SectorCarrier);//esto es para la 1 parte del archivo 4_3
				$filas_SectorCarrier_4_2_rnd  = $SectorCarrier_4_2 ->getHighestRow(); 
				$Column_SectorCarrier_4_2_rnd = $SectorCarrier_4_2 ->getHighestColumn();
				$NumColumn_SectorCarrier_4_2  = PHPExcel_Cell::columnIndexFromString($Column_SectorCarrier_4_2_rnd);
				for ($i=2; $i <=$filas_SectorCarrier_4_2_rnd; $i++) { 
					for ($x=0; $x <= $NumColumn_SectorCarrier_4_2; $x++) {
						$nombre_campo_SectorCarrier_4_2 = $SectorCarrier_4_2->getCellByColumnAndRow($x,1)->getValue();
						$valor_campo1 = $SectorCarrier_4_2->getCellByColumnAndRow(1,$i)->getValue();
						if($nombre_campo_SectorCarrier_4_2 == "SectorCarrier"){
							if($valor_campo1 > 6){
								$valor_campo2 = $SectorCarrier_4_2->getCellByColumnAndRow(3,$i)->getValue();
								$valor_campo3 = $SectorCarrier_4_2->getCellByColumnAndRow(4,$i)->getValue();
								$continido_1_4_C[] ='crn ENodeBFunction=1,SectorCarrier='.$valor_campo1.'
noOfRxAntennas '.$valor_campo2.'
noOfTxAntennas '.$valor_campo3.'
prsEnabled true
rfBranchRxRef 
rfBranchTxRef 
sectorFunctionRef SectorEquipmentFunction='.$valor_campo1.'
end

';
							}
						}	
					}
				}
			

				$AntennaSubunit_4_2 = $RND->getSheet($name_h_rnd_AntennaSubunit);//esto es para la 1 parte del archivo 4_3
				$filas_AntennaSubunit_4_2_rnd  = $AntennaSubunit_4_2 ->getHighestRow(); 
				$Column_AntennaSubunit_4_2_rnd = $AntennaSubunit_4_2 ->getHighestColumn();
				$NumColumn_AntennaSubunit_4_2  = PHPExcel_Cell::columnIndexFromString($Column_AntennaSubunit_4_2_rnd);
				for ($i=2; $i <=$filas_AntennaSubunit_4_2_rnd; $i++) { 
					for ($x=0; $x <= $NumColumn_AntennaSubunit_4_2; $x++) {
						$nombre_campo_AntennaSubunit_4_2 = $AntennaSubunit_4_2->getCellByColumnAndRow($x,1)->getValue();
						$valor_campo1 = $AntennaSubunit_4_2->getCellByColumnAndRow(1,$i)->getValue();
						if($nombre_campo_AntennaSubunit_4_2 == "AntennaUnitGroup"){
							if($valor_campo1 > 3){
								$valor_campo2 = $AntennaSubunit_4_2->getCellByColumnAndRow(3,$i)->getValue();
								$valor_campo3 = $AntennaSubunit_4_2->getCellByColumnAndRow(5,$i)->getValue();
								$valor_campo4 = $AntennaSubunit_4_2->getCellByColumnAndRow(6,$i)->getValue();
								$valor_campo5 = $AntennaSubunit_4_2->getCellByColumnAndRow(4,$i)->getValue();
								$valor_campo6 = $AntennaSubunit_4_2->getCellByColumnAndRow(9,$i)->getValue();
								$continido_1_4_C[] 	='
crn Equipment=1,AntennaUnitGroup='.$valor_campo1.'
end

crn Equipment=1,AntennaUnitGroup='.$valor_campo1.',AntennaUnit=1
mechanicalAntennaTilt '.$valor_campo6.'
end

crn Equipment=1,AntennaUnitGroup='.$valor_campo1.',AntennaUnit=1,AntennaSubunit=1
azimuthHalfPowerBeamwidth '.$valor_campo2.'
commonChBeamfrmPortMap '.$valor_campo5.'
customComChBeamfrmWtsAmplitude '.str_replace(" ", ",",$valor_campo3).'
customComChBeamfrmWtsPhase '.str_replace(" ", ",",$valor_campo4).'
retSubunitRef 
end

	';
							}
						}	
					}

				}
			

				$RfBranch_4_2 = $RND->getSheet($name_h_rnd_RfBranch);//esto es para la 1 parte del archivo 4_3
				$filas_RfBranch_4_2_rnd  = $RfBranch_4_2 ->getHighestRow(); 
				$Column_RfBranch_4_2_rnd = $RfBranch_4_2 ->getHighestColumn();
				$NumColumn_RfBranch_4_2  = PHPExcel_Cell::columnIndexFromString($Column_RfBranch_4_2_rnd);
				for ($i=2; $i <=$filas_RfBranch_4_2_rnd; $i++) { 
					for ($x=0; $x <= $NumColumn_RfBranch_4_2; $x++) {
						$nombre_campo_RfBranch_4_2 = $RfBranch_4_2->getCellByColumnAndRow($x,1)->getValue();
						$valor_campo1 = $RfBranch_4_2->getCellByColumnAndRow(1,$i)->getValue();
						if($nombre_campo_RfBranch_4_2 == "AntennaUnitGroup"){
							if($valor_campo1 > 6){
								$valor_campo2 = $RfBranch_4_2->getCellByColumnAndRow(2,$i)->getValue();
								$valor_campo3 = $RfBranch_4_2->getCellByColumnAndRow(4,$i)->getValue();
								$valor_campo4 = $RfBranch_4_2->getCellByColumnAndRow(5,$i)->getValue();
								$valor_campo5 = $RfBranch_4_2->getCellByColumnAndRow(8,$i)->getValue();
								$valor_campo6 = $RfBranch_4_2->getCellByColumnAndRow(9,$i)->getValue();
								$continido_1_4_C[] ='
crn Equipment=1,AntennaUnitGroup='.$valor_campo1.',RfBranch='.$valor_campo2.'
auPortRef 
dlAttenuation '.str_replace(" ", ",",substr($valor_campo3, 0, -1)).'
dlTrafficDelay '.str_replace(" ",",",substr($valor_campo4, 0, -1)).'
rfPortRef 
tmaRef 
ulAttenuation '.str_replace(" ", ",",substr($valor_campo5, 0, -1)).'
ulTrafficDelay '.str_replace(" ", ",", substr($valor_campo6, 0, -1)).'
userLabel 
end

';
							}
						}	
					}
				}

				$RfBranch_4_2 = $RND->getSheet($name_h_rnd_RfBranch);//esto es para la 1 parte del archivo 4_3
				$filas_RfBranch_4_2_rnd  = $RfBranch_4_2 ->getHighestRow(); 
				$Column_RfBranch_4_2_rnd = $RfBranch_4_2 ->getHighestColumn();
				$NumColumn_RfBranch_4_2  = PHPExcel_Cell::columnIndexFromString($Column_RfBranch_4_2_rnd);
				for ($i=2; $i <=$filas_RfBranch_4_2_rnd; $i++) { 
					for ($x=0; $x <= $NumColumn_RfBranch_4_2; $x++) {
						$nombre_campo_RfBranch_4_2 = $RfBranch_4_2->getCellByColumnAndRow($x,1)->getValue();
						$valor_campo1 = $RfBranch_4_2->getCellByColumnAndRow(1,$i)->getValue();
						if($nombre_campo_RfBranch_4_2 == "AntennaUnitGroup"){
							if($valor_campo1 > 6){
								$valor_campo2 = $RfBranch_4_2->getCellByColumnAndRow(2,$i)->getValue();
								$valor_campo3 = $RfBranch_4_2->getCellByColumnAndRow(3,$i)->getValue();
								$continido_1_4_C[] ='
crn Equipment=1,AntennaUnitGroup='.$valor_campo1.',AntennaUnit=1,AntennaSubunit=1,AuPort='.$valor_campo3.'
userLabel 
end

';
							}
						}	
					}
				}


				$RfBranch_4_2 = $RND->getSheet($name_h_rnd_RfBranch);//esto es para la 1 parte del archivo 4_3
				$filas_RfBranch_4_2_rnd  = $RfBranch_4_2 ->getHighestRow(); 
				$Column_RfBranch_4_2_rnd = $RfBranch_4_2 ->getHighestColumn();
				$NumColumn_RfBranch_4_2  = PHPExcel_Cell::columnIndexFromString($Column_RfBranch_4_2_rnd);
				for ($i=2; $i <=$filas_RfBranch_4_2_rnd; $i++) { 
					for ($x=0; $x <= $NumColumn_RfBranch_4_2; $x++) {
						$nombre_campo_RfBranch_4_2 = $RfBranch_4_2->getCellByColumnAndRow($x,1)->getValue();
						$valor_campo1 = $RfBranch_4_2->getCellByColumnAndRow(1,$i)->getValue();
						if($nombre_campo_RfBranch_4_2 == "AntennaUnitGroup"){
							if($valor_campo1 > 6){
								$continido_1_4_C[] ='
lset SectorEquipmentFunction='.$valor_campo1.'$ rfBranchRef Equipment=1,AntennaUnitGroup='.$valor_campo1.',RfBranch=1 Equipment=1,AntennaUnitGroup='.$valor_campo1.',RfBranch=2 

';
							}
						}	
					}
				}

				$RfBranch_4_2 = $RND->getSheet($name_h_rnd_RfBranch);//esto es para la 1 parte del archivo 4_3
				$filas_RfBranch_4_2_rnd  = $RfBranch_4_2 ->getHighestRow(); 
				$Column_RfBranch_4_2_rnd = $RfBranch_4_2 ->getHighestColumn();
				$NumColumn_RfBranch_4_2  = PHPExcel_Cell::columnIndexFromString($Column_RfBranch_4_2_rnd);
				for ($i=2; $i <=$filas_RfBranch_4_2_rnd; $i++) { 
					for ($x=0; $x <= $NumColumn_RfBranch_4_2; $x++) {
						$nombre_campo_RfBranch_4_2 = $RfBranch_4_2->getCellByColumnAndRow($x,1)->getValue();
						$valor_campo1 = $RfBranch_4_2->getCellByColumnAndRow(1,$i)->getValue();
						if($nombre_campo_RfBranch_4_2 == "AntennaUnitGroup"){
							if($valor_campo1 > 6){
								$valor_campo2 = $RfBranch_4_2->getCellByColumnAndRow(2,$i)->getValue();
								$valor_campo3 = $RfBranch_4_2->getCellByColumnAndRow(4,$i)->getValue();							
								$continido_1_4_C[] ='
lset Equipment=1,AntennaUnitGroup='.$valor_campo1.',RfBranch='.$valor_campo2.'$ auPortRef Equipment=1,AntennaUnitGroup='.$valor_campo1.',AntennaUnit=1,AntennaSubunit=1,AuPort='.$valor_campo2;
							}
						}	
					}
				}

				$RfPort_4_2 = $RND->getSheet($name_h_rnd_RfPort);//esto es para la 1 parte del archivo 4_3
				$filas_RfPort_4_2_rnd  = $RfPort_4_2 ->getHighestRow(); 
				$Column_RfPort_4_2_rnd = $RfPort_4_2 ->getHighestColumn();
				$NumColumn_RfPort_4_2  = PHPExcel_Cell::columnIndexFromString($Column_RfPort_4_2_rnd);
				for ($i=2; $i <=$filas_RfPort_4_2_rnd; $i++) { 
					for ($x=0; $x <= $NumColumn_RfPort_4_2; $x++) {
						$nombre_campo_RfPort_4_2 = $RfPort_4_2->getCellByColumnAndRow($x,1)->getValue();
						$valor_campo1 = $RfPort_4_2->getCellByColumnAndRow(1,$i)->getValue();
						if($nombre_campo_RfPort_4_2 == "AuxPlugInUnit"){
							if($valor_campo1 > 6){
								$valor_campo2 = $RfPort_4_2->getCellByColumnAndRow(2,$i)->getValue();
								$valor_campo3 = $RfPort_4_2->getCellByColumnAndRow(4,$i)->getValue();
								$valor_campo4 = $RfPort_4_2->getCellByColumnAndRow(5,$i)->getValue();
								$valor_campo5 = $RfPort_4_2->getCellByColumnAndRow(8,$i)->getValue();
								$valor_campo6 = $RfPort_4_2->getCellByColumnAndRow(9,$i)->getValue();
								$continido_1_4_C[] ='
crn Equipment=1,AuxPlugInUnit='.$valor_campo1.'
administrativeState 1
piuType PiuType=KRC161550/1_*
position 0
positionInformation 
positionRef 
end


';
							}
						}	
					}
				}

				///// aparir de aqui comienza el 4.4
				$SectorEquipmentFunction_4_2 = $RND->getSheet($name_h_rnd_SectorEquipmentFunction);//esto es para la 1 parte del archivo 4_4
				$filas_SectorEquipmentFunction_4_2_rnd  = $SectorEquipmentFunction_4_2 ->getHighestRow(); 
				$Column_SectorEquipmentFunction_4_2_rnd = $SectorEquipmentFunction_4_2 ->getHighestColumn();
				$NumColumn_SectorEquipmentFunction_4_2  = PHPExcel_Cell::columnIndexFromString($Column_SectorEquipmentFunction_4_2_rnd);
				for ($i=2; $i <=$filas_SectorEquipmentFunction_4_2_rnd; $i++) { 
					for ($x=0; $x <= $NumColumn_SectorEquipmentFunction_4_2; $x++) {
						$nombre_campo_SectorEquipmentFunction_4_2 = $SectorEquipmentFunction_4_2->getCellByColumnAndRow($x,1)->getValue();
						$valor_campo1 = $SectorEquipmentFunction_4_2->getCellByColumnAndRow($x,$i)->getValue();
						if($nombre_campo_SectorEquipmentFunction_4_2 == "userLabel"){
							if($valor_campo1 == "LTE2600"){
								$valor_campo2 = $SectorEquipmentFunction_4_2->getCellByColumnAndRow(1,$i)->getValue();
								$continido_1_4_D[] ='crn SectorEquipmentFunction='.$valor_campo2.'
administrativeState 0
mixedModeRadio false
rfBranchRef 
userLabel 
end

';
							}
						}	
					}
				}

				$SectorCarrier_4_2 = $RND->getSheet($name_h_rnd_SectorCarrier);//esto es para la 1 parte del archivo 4_4
				$filas_SectorCarrier_4_2_rnd  = $SectorCarrier_4_2 ->getHighestRow(); 
				$Column_SectorCarrier_4_2_rnd = $SectorCarrier_4_2 ->getHighestColumn();
				$NumColumn_SectorCarrier_4_2  = PHPExcel_Cell::columnIndexFromString($Column_SectorCarrier_4_2_rnd);
				for ($i=2; $i <=$filas_SectorCarrier_4_2_rnd; $i++) { 
					for ($x=0; $x <= $NumColumn_SectorCarrier_4_2; $x++) {
						$nombre_campo_SectorCarrier_4_2 = $SectorCarrier_4_2->getCellByColumnAndRow($x,1)->getValue();
						$valor_campo1 = $SectorCarrier_4_2->getCellByColumnAndRow(1,$i)->getValue();
						if($nombre_campo_SectorCarrier_4_2 == "SectorCarrier"){
							if($valor_campo1 < 4){
								$valor_campo2 = $SectorCarrier_4_2->getCellByColumnAndRow(3,$i)->getValue();
								$valor_campo3 = $SectorCarrier_4_2->getCellByColumnAndRow(4,$i)->getValue();
								$continido_1_4_D[] ='crn ENodeBFunction=1,SectorCarrier='.$valor_campo1.'
noOfRxAntennas '.$valor_campo2.'
noOfTxAntennas '.$valor_campo3.'
prsEnabled true
rfBranchRxRef 
rfBranchTxRef 
sectorFunctionRef SectorEquipmentFunction='.$valor_campo1.'
end

';
							}
						}	
					}
				}
			

				$AntennaSubunit_4_2 = $RND->getSheet($name_h_rnd_AntennaSubunit);//esto es para la 1 parte del archivo 4_4
				$filas_AntennaSubunit_4_2_rnd  = $AntennaSubunit_4_2 ->getHighestRow(); 
				$Column_AntennaSubunit_4_2_rnd = $AntennaSubunit_4_2 ->getHighestColumn();
				$NumColumn_AntennaSubunit_4_2  = PHPExcel_Cell::columnIndexFromString($Column_AntennaSubunit_4_2_rnd);
				for ($i=2; $i <=$filas_AntennaSubunit_4_2_rnd; $i++) { 
					for ($x=0; $x <= $NumColumn_AntennaSubunit_4_2; $x++) {
						$nombre_campo_AntennaSubunit_4_2 = $AntennaSubunit_4_2->getCellByColumnAndRow($x,1)->getValue();
						$valor_campo1 = $AntennaSubunit_4_2->getCellByColumnAndRow(1,$i)->getValue();
						if($nombre_campo_AntennaSubunit_4_2 == "AntennaUnitGroup"){
							if($valor_campo1 < 4){
								$valor_campo2 = $AntennaSubunit_4_2->getCellByColumnAndRow(3,$i)->getValue();
								$valor_campo3 = $AntennaSubunit_4_2->getCellByColumnAndRow(5,$i)->getValue();
								$valor_campo4 = $AntennaSubunit_4_2->getCellByColumnAndRow(6,$i)->getValue();
								$valor_campo5 = $AntennaSubunit_4_2->getCellByColumnAndRow(4,$i)->getValue();
								$valor_campo6 = $AntennaSubunit_4_2->getCellByColumnAndRow(9,$i)->getValue();
								$continido_1_4_D[] 	='
crn Equipment=1,AntennaUnitGroup='.$valor_campo1.'
end

crn Equipment=1,AntennaUnitGroup='.$valor_campo1.',AntennaUnit=1
mechanicalAntennaTilt '.$valor_campo6.'
end

crn Equipment=1,AntennaUnitGroup='.$valor_campo1.',AntennaUnit=1,AntennaSubunit=1
azimuthHalfPowerBeamwidth '.$valor_campo2.'
commonChBeamfrmPortMap '.$valor_campo5.'
customComChBeamfrmWtsAmplitude '.str_replace(" ", ",",$valor_campo3).'
customComChBeamfrmWtsPhase '.str_replace(" ", ",",$valor_campo4).'
retSubunitRef 
end

	';
							}
						}	
					}

				}
			

				$RfBranch_4_2 = $RND->getSheet($name_h_rnd_RfBranch);//esto es para la 1 parte del archivo 4_4
				$filas_RfBranch_4_2_rnd  = $RfBranch_4_2 ->getHighestRow(); 
				$Column_RfBranch_4_2_rnd = $RfBranch_4_2 ->getHighestColumn();
				$NumColumn_RfBranch_4_2  = PHPExcel_Cell::columnIndexFromString($Column_RfBranch_4_2_rnd);
				for ($i=2; $i <=$filas_RfBranch_4_2_rnd; $i++) { 
					for ($x=0; $x <= $NumColumn_RfBranch_4_2; $x++) {
						$nombre_campo_RfBranch_4_2 = $RfBranch_4_2->getCellByColumnAndRow($x,1)->getValue();
						$valor_campo1 = $RfBranch_4_2->getCellByColumnAndRow(1,$i)->getValue();
						if($nombre_campo_RfBranch_4_2 == "AntennaUnitGroup"){
							if($valor_campo1 < 4){
								$valor_campo2 = $RfBranch_4_2->getCellByColumnAndRow(2,$i)->getValue();
								$valor_campo3 = $RfBranch_4_2->getCellByColumnAndRow(4,$i)->getValue();
								$valor_campo4 = $RfBranch_4_2->getCellByColumnAndRow(5,$i)->getValue();
								$valor_campo5 = $RfBranch_4_2->getCellByColumnAndRow(8,$i)->getValue();
								$valor_campo6 = $RfBranch_4_2->getCellByColumnAndRow(9,$i)->getValue();
								$continido_1_4_D[] ='
crn Equipment=1,AntennaUnitGroup='.$valor_campo1.',RfBranch='.$valor_campo2.'
auPortRef 
dlAttenuation '.str_replace(" ", ",",substr($valor_campo3, 0, -1)).'
dlTrafficDelay '.str_replace(" ",",",substr($valor_campo4, 0, -1)).'
rfPortRef 
tmaRef 
ulAttenuation '.str_replace(" ", ",",substr($valor_campo5, 0, -1)).'
ulTrafficDelay '.str_replace(" ", ",", substr($valor_campo6, 0, -1)).'
userLabel 
end

';
							}
						}	
					}
				}

				$RfBranch_4_2 = $RND->getSheet($name_h_rnd_RfBranch);//esto es para la 1 parte del archivo 4_4
				$filas_RfBranch_4_2_rnd  = $RfBranch_4_2 ->getHighestRow(); 
				$Column_RfBranch_4_2_rnd = $RfBranch_4_2 ->getHighestColumn();
				$NumColumn_RfBranch_4_2  = PHPExcel_Cell::columnIndexFromString($Column_RfBranch_4_2_rnd);
				for ($i=2; $i <=$filas_RfBranch_4_2_rnd; $i++) { 
					for ($x=0; $x <= $NumColumn_RfBranch_4_2; $x++) {
						$nombre_campo_RfBranch_4_2 = $RfBranch_4_2->getCellByColumnAndRow($x,1)->getValue();
						$valor_campo1 = $RfBranch_4_2->getCellByColumnAndRow(1,$i)->getValue();
						if($nombre_campo_RfBranch_4_2 == "AntennaUnitGroup"){
							if($valor_campo1 < 4){
								$valor_campo2 = $RfBranch_4_2->getCellByColumnAndRow(2,$i)->getValue();
								$valor_campo3 = $RfBranch_4_2->getCellByColumnAndRow(3,$i)->getValue();
								$continido_1_4_D[] ='
crn Equipment=1,AntennaUnitGroup='.$valor_campo1.',AntennaUnit=1,AntennaSubunit=1,AuPort='.$valor_campo3.'
userLabel 
end

';
							}
						}	
					}
				}


				$RfBranch_4_2 = $RND->getSheet($name_h_rnd_RfBranch);//esto es para la 1 parte del archivo 4_4
				$filas_RfBranch_4_2_rnd  = $RfBranch_4_2 ->getHighestRow(); 
				$Column_RfBranch_4_2_rnd = $RfBranch_4_2 ->getHighestColumn();
				$NumColumn_RfBranch_4_2  = PHPExcel_Cell::columnIndexFromString($Column_RfBranch_4_2_rnd);
				for ($i=2; $i <=$filas_RfBranch_4_2_rnd; $i++) { 
					for ($x=0; $x <= $NumColumn_RfBranch_4_2; $x++) {
						$nombre_campo_RfBranch_4_2 = $RfBranch_4_2->getCellByColumnAndRow($x,1)->getValue();
						$valor_campo1 = $RfBranch_4_2->getCellByColumnAndRow(1,$i)->getValue();
						if($nombre_campo_RfBranch_4_2 == "AntennaUnitGroup"){
							if($valor_campo1 < 4){
								$continido_1_4_D[] ='
lset SectorEquipmentFunction='.$valor_campo1.'$ rfBranchRef Equipment=1,AntennaUnitGroup='.$valor_campo1.',RfBranch=1 Equipment=1,AntennaUnitGroup='.$valor_campo1.',RfBranch=2 

';
							}
						}	
					}
				}

				$RfBranch_4_2 = $RND->getSheet($name_h_rnd_RfBranch);//esto es para la 1 parte del archivo 4_4
				$filas_RfBranch_4_2_rnd  = $RfBranch_4_2 ->getHighestRow(); 
				$Column_RfBranch_4_2_rnd = $RfBranch_4_2 ->getHighestColumn();
				$NumColumn_RfBranch_4_2  = PHPExcel_Cell::columnIndexFromString($Column_RfBranch_4_2_rnd);
				for ($i=2; $i <=$filas_RfBranch_4_2_rnd; $i++) { 
					for ($x=0; $x <= $NumColumn_RfBranch_4_2; $x++) {
						$nombre_campo_RfBranch_4_2 = $RfBranch_4_2->getCellByColumnAndRow($x,1)->getValue();
						$valor_campo1 = $RfBranch_4_2->getCellByColumnAndRow(1,$i)->getValue();
						if($nombre_campo_RfBranch_4_2 == "AntennaUnitGroup"){
							if($valor_campo1 < 4){
								$valor_campo2 = $RfBranch_4_2->getCellByColumnAndRow(2,$i)->getValue();
								$valor_campo3 = $RfBranch_4_2->getCellByColumnAndRow(4,$i)->getValue();							
								$continido_1_4_D[] ='
lset Equipment=1,AntennaUnitGroup='.$valor_campo1.',RfBranch='.$valor_campo2.'$ auPortRef Equipment=1,AntennaUnitGroup='.$valor_campo1.',AntennaUnit=1,AntennaSubunit=1,AuPort='.$valor_campo2;
							}
						}	
					}
				}

				$RfPort_4_2 = $RND->getSheet($name_h_rnd_RfPort);//esto es para la 1 parte del archivo 4_4
				$filas_RfPort_4_2_rnd  = $RfPort_4_2 ->getHighestRow(); 
				$Column_RfPort_4_2_rnd = $RfPort_4_2 ->getHighestColumn();
				$NumColumn_RfPort_4_2  = PHPExcel_Cell::columnIndexFromString($Column_RfPort_4_2_rnd);
				for ($i=2; $i <=$filas_RfPort_4_2_rnd; $i++) { 
					for ($x=0; $x <= $NumColumn_RfPort_4_2; $x++) {
						$nombre_campo_RfPort_4_2 = $RfPort_4_2->getCellByColumnAndRow($x,1)->getValue();
						$valor_campo1 = $RfPort_4_2->getCellByColumnAndRow(1,$i)->getValue();
						if($nombre_campo_RfPort_4_2 == "AuxPlugInUnit"){
							if($valor_campo1 < 4){
								$valor_campo2 = $RfPort_4_2->getCellByColumnAndRow(2,$i)->getValue();
								$valor_campo3 = $RfPort_4_2->getCellByColumnAndRow(4,$i)->getValue();
								$valor_campo4 = $RfPort_4_2->getCellByColumnAndRow(5,$i)->getValue();
								$valor_campo5 = $RfPort_4_2->getCellByColumnAndRow(8,$i)->getValue();
								$valor_campo6 = $RfPort_4_2->getCellByColumnAndRow(9,$i)->getValue();
								$continido_1_4_D[] ='
crn Equipment=1,AuxPlugInUnit='.$valor_campo1.'
administrativeState 1
piuType PiuType=KRC161550/1_*
position 0
positionInformation 
positionRef 
end


';
							}
						}	
					}
				}
			}

			//////////////////////////////////////////////////////////////////////////
			//Contrucion del archivo 5
			//
			//
			/////////////////////////////////////////////////////////////////////////
			$ENodeBFunction_5 = $RND->getSheet($name_h_rnd_ENodeBFunction);//esto es para la 1 parte del archivo 5
			$filas_ENodeBFunction_5_rnd  = $ENodeBFunction_5 ->getHighestRow(); 
			$Column_ENodeBFunction_5_rnd = $ENodeBFunction_5 ->getHighestColumn();
			$NumColumn_ENodeBFunction_5  = PHPExcel_Cell::columnIndexFromString($Column_ENodeBFunction_5_rnd);
			for ($i=2; $i <=$filas_ENodeBFunction_5_rnd; $i++) { 
				for ($x=0; $x <= $NumColumn_ENodeBFunction_5; $x++) {
					$nombre_campo_ENodeBFunction_5 = $ENodeBFunction_5->getCellByColumnAndRow($x,1)->getValue();
					if($nombre_campo_ENodeBFunction_5 == 'eNBId'){
						$valor_campo1 = $ENodeBFunction_5->getCellByColumnAndRow($x,$i)->getValue();
						if(!empty($valor_campo1)){
							$continido_1_5 = $valor_campo1;
						}
					}
				}
			}

			//////////////////////////////////////////////////////////////////////////
			//Contrucion del archivo 6
			//
			//
			/////////////////////////////////////////////////////////////////////////
			$EUtranCellFDD = $RND->getSheet($name_h_rnd_EUtranCellFDD);//esto es para la 1 parte del archivo 6
			$filas_EUtranCellFDD_rnd  = $EUtranCellFDD ->getHighestRow(); 
			$Column_EUtranCellFDD_rnd = $EUtranCellFDD ->getHighestColumn();
			$NumColumn_EUtranCellFDD  = PHPExcel_Cell::columnIndexFromString($Column_EUtranCellFDD_rnd);
			for ($i=2; $i <=$filas_EUtranCellFDD_rnd; $i++) { 
				for ($x=0; $x <= $NumColumn_EUtranCellFDD; $x++) {
					$nombre_campo_EUtranCellFDD = $EUtranCellFDD->getCellByColumnAndRow($x,1)->getValue();
					
					if($nombre_campo_EUtranCellFDD=="EUtranCellFDD"){
						$valor_campo1 = $EUtranCellFDD->getCellByColumnAndRow($x,$i)->getValue();
				    }

				    if($nombre_campo_EUtranCellFDD=="earfcndl"){
						$valor_campo2 = $EUtranCellFDD->getCellByColumnAndRow($x,$i)->getValue();
				    }

				    if($nombre_campo_EUtranCellFDD=="earfcnul"){
						$valor_campo3 = $EUtranCellFDD->getCellByColumnAndRow($x,$i)->getValue();
				    }

				    if($nombre_campo_EUtranCellFDD=="sectorCarrierRef"){
						$valor_campo4 = $EUtranCellFDD->getCellByColumnAndRow($x,$i)->getValue();						
				    }

				    if($nombre_campo_EUtranCellFDD=="physicalLayerCellIdGroup"){
						$valor_campo5 = $EUtranCellFDD->getCellByColumnAndRow($x,$i)->getValue();
				    }

				    if($nombre_campo_EUtranCellFDD=="physicalLayerSubCellId"){
						$valor_campo6 = $EUtranCellFDD->getCellByColumnAndRow($x,$i)->getValue();
				    }

				    if($nombre_campo_EUtranCellFDD=="tac"){
						$valor_campo7 = $EUtranCellFDD->getCellByColumnAndRow($x,$i)->getValue();
				    }

				    if($nombre_campo_EUtranCellFDD=="ulChannelBandwidth"){
						$valor_campo8 = $EUtranCellFDD->getCellByColumnAndRow($x,$i)->getValue();
						if(!empty($valor_campo1)){
							$continido_1_6_1 ='							
cr ENodeBFunction=1,EUtranCellFDD='.$valor_campo1.'
'.$valor_campo2.'
'.$valor_campo3.'
'.$valor_campo4.'
'.$valor_campo5.'
'.$valor_campo6.'
'.$valor_campo7.'
ENodeBFunction=1,SectorCarrier='.$valor_campo4.'
'.$valor_campo8.'
'.$valor_campo8.'
d
'.str_replace(" ", ",",$valor_campo9).'

set '.$valor_campo1.' noOfPucchCqiUsers '.$valor_campo10.'
set '.$valor_campo1.' userlabel '.$valor_campo1.'
lset '.$valor_campo1.' altitude '.$valor_campo11.'
lset '.$valor_campo1.' latitude '.$valor_campo12.'
lset '.$valor_campo1.' longitude '.$valor_campo13.'
lset '.$valor_campo1.' pMaxServingCell '.$valor_campo14.'
lset '.$valor_campo1.' pZeroNominalPucch '.$valor_campo15.'
lset '.$valor_campo1.' qRxLevMin '.$valor_campo16.'
lset '.$valor_campo1.' qRxLevMinOffset '.$valor_campo17.'
lset '.$valor_campo1.' rachRootSequence '.$valor_campo18
;
						
							$continido_2_6[] = $continido_1_6_1;
						}
				    }

				    if($nombre_campo_EUtranCellFDD=="ssacBarringForMMTELVideo_acBarringForSpecialAC"){
						$valor_campo9 = $EUtranCellFDD->getCellByColumnAndRow($x,$i)->getValue();
				    }

				    if($nombre_campo_EUtranCellFDD=="noOfPucchCqiUsers"){
						$valor_campo10 = $EUtranCellFDD->getCellByColumnAndRow($x,$i)->getValue();
				    }

				    if($nombre_campo_EUtranCellFDD=="altitude"){
						$valor_campo11 = $EUtranCellFDD->getCellByColumnAndRow($x,$i)->getValue();
				    }

				    if($nombre_campo_EUtranCellFDD=="latitude"){
						$valor_campo12 = $EUtranCellFDD->getCellByColumnAndRow($x,$i)->getValue();
				    }

				    if($nombre_campo_EUtranCellFDD=="longitude"){
						$valor_campo13 = $EUtranCellFDD->getCellByColumnAndRow($x,$i)->getValue();
				    }

				    if($nombre_campo_EUtranCellFDD=="pMaxServingCell"){
						$valor_campo14 = $EUtranCellFDD->getCellByColumnAndRow($x,$i)->getValue();
				    }

				    if($nombre_campo_EUtranCellFDD=="pZeroNominalPucch"){
						$valor_campo15 = $EUtranCellFDD->getCellByColumnAndRow($x,$i)->getValue();
				    }

				    if($nombre_campo_EUtranCellFDD=="qRxLevMin"){
						$valor_campo16 = $EUtranCellFDD->getCellByColumnAndRow($x,$i)->getValue();
				    }

				    if($nombre_campo_EUtranCellFDD=="qRxLevMinOffset"){
						$valor_campo17 = $EUtranCellFDD->getCellByColumnAndRow($x,$i)->getValue();
				    }

				    if($nombre_campo_EUtranCellFDD=="rachRootSequence"){
						$valor_campo18 = $EUtranCellFDD->getCellByColumnAndRow($x,$i)->getValue();
				    }
				}
			}	
//die();
			//////////////////////////////////////////////////////////////////////////
			//Contrucion del archivo 7.1
			//
			//
			/////////////////////////////////////////////////////////////////////////
			$EUtranFrequency = $RND->getSheet($name_h_rnd_EUtranFrequency);//esto es para la 1 parte del archivo 7
			$filas_EUtranFrequency_rnd  = $EUtranFrequency ->getHighestRow(); 
			$Column_EUtranFrequency_rnd = $EUtranFrequency ->getHighestColumn();
			$NumColumn_EUtranFrequency  = PHPExcel_Cell::columnIndexFromString($Column_EUtranFrequency_rnd);
			for ($i=2; $i <=$filas_EUtranFrequency_rnd; $i++) { 
				for ($x=0; $x <= $NumColumn_EUtranFrequency; $x++) {
					$nombre_campo_EUtranFrequency = $EUtranFrequency->getCellByColumnAndRow($x,1)->getValue();
					if($nombre_campo_EUtranFrequency == "EUtranFrequencyId"){
						$valor_campo1 = $EUtranFrequency->getCellByColumnAndRow($x,$i)->getValue();				   
					}	

					if($nombre_campo_EUtranFrequency == "arfcnValueEUtranDl"){
						$valor_campo2 = $EUtranFrequency->getCellByColumnAndRow($x,$i)->getValue();
						if(!empty($valor_campo1)){
							$continido_1_7_1 ='
cr ENodeBFunction=1,EUtraNetwork=1,EUtranFrequency='.$valor_campo1.'
'.$valor_campo2.' #arfcnValueEUtranDl
set ENodeBFunction=1,EUtraNetwork=1,EUtranFrequency='.$valor_campo1.' userLabel EUtranFrequency
';
						$continido_2_7[] = $continido_1_7_1;
						}
					}					
				}
			}

			//////////////////////////////////////////////////////////////////////////
			//Contrucion del archivo 7.2
			//
			//
			/////////////////////////////////////////////////////////////////////////
			$EUtranFreqRelation = $RND->getSheet($name_h_rnd_EUtranFreqRelation);//esto es para la 1 parte del archivo 7
			$filas_EUtranFreqRelation_rnd  = $EUtranFreqRelation ->getHighestRow(); 
			$Column_EUtranFreqRelation_rnd = $EUtranFreqRelation ->getHighestColumn();
			$NumColumn_EUtranFreqRelation  = PHPExcel_Cell::columnIndexFromString($Column_EUtranFreqRelation_rnd);
			for ($i=2; $i <=$filas_EUtranFreqRelation_rnd; $i++) { 
				for ($x=0; $x <= $NumColumn_EUtranFreqRelation; $x++) {
					$nombre_campo_EUtranFreqRelation = $EUtranFreqRelation->getCellByColumnAndRow($x,1)->getValue();
					if($nombre_campo_EUtranFreqRelation == "EUtranCellFDD"){
						$valor_campo1 = $EUtranFreqRelation->getCellByColumnAndRow($x,$i)->getValue();				   
					}

					if($nombre_campo_EUtranFreqRelation == "EUtranFreqRelationId"){
						$valor_campo2 = $EUtranFreqRelation->getCellByColumnAndRow($x,$i)->getValue();				   
					}

					if($nombre_campo_EUtranFreqRelation == "allowedMeasBandwidth"){
						$valor_campo3 = $EUtranFreqRelation->getCellByColumnAndRow($x,$i)->getValue();				   
					}

					if($nombre_campo_EUtranFreqRelation == "anrMeasOn"){
						$valor_campo4 = $EUtranFreqRelation->getCellByColumnAndRow($x,$i)->getValue();				   
					}

					if($nombre_campo_EUtranFreqRelation == "arpPrio"){
						$valor_campo5 = $EUtranFreqRelation->getCellByColumnAndRow($x,$i)->getValue();		   
					}

					if($nombre_campo_EUtranFreqRelation == "caTriggeredRedirectionActive"){
						$valor_campo6 = $EUtranFreqRelation->getCellByColumnAndRow($x,$i)->getValue();				   
					}

					if($nombre_campo_EUtranFreqRelation == "cellReselectionPriority"){
						$valor_campo7 = $EUtranFreqRelation->getCellByColumnAndRow($x,$i)->getValue();				   
					}

					if($nombre_campo_EUtranFreqRelation == "connectedModeMobilityPrio"){
						$valor_campo8 = $EUtranFreqRelation->getCellByColumnAndRow($x,$i)->getValue();				   
					}

					if($nombre_campo_EUtranFreqRelation == "interFreqMeasType"){
						$valor_campo9 = $EUtranFreqRelation->getCellByColumnAndRow($x,$i)->getValue();				   
					}

					if($nombre_campo_EUtranFreqRelation == "lbActivationThreshold"){
						$valor_campo10 = $EUtranFreqRelation->getCellByColumnAndRow($x,$i)->getValue();				   
					}

					if($nombre_campo_EUtranFreqRelation == "lbBnrPolicy"){
						$valor_campo11 = $EUtranFreqRelation->getCellByColumnAndRow($x,$i)->getValue();				   
					}

					if($nombre_campo_EUtranFreqRelation == "mobilityAction"){
						$valor_campo12 = $EUtranFreqRelation->getCellByColumnAndRow($x,$i)->getValue();				   
					}

					if($nombre_campo_EUtranFreqRelation == "neighCellConfig"){
						$valor_campo13 = $EUtranFreqRelation->getCellByColumnAndRow($x,$i)->getValue();				   
					}

					if($nombre_campo_EUtranFreqRelation == "nonPlannedPciCIO"){
						$valor_campo14 = $EUtranFreqRelation->getCellByColumnAndRow($x,$i)->getValue();
					}

					if($nombre_campo_EUtranFreqRelation == "nonPlannedPciTargetIdType"){
						$valor_campo15 = $EUtranFreqRelation->getCellByColumnAndRow($x,$i)->getValue();
						if(isset($valor_campo1)){
							$continido_3_7_2 ='
crn ENodeBFunction=1,EUtranCellFDD='.$valor_campo1.',EUtranFreqRelation='.$valor_campo2.'
allowedMeasBandwidth '.$valor_campo3.'
allowedPlmnList 
anrMeasOn '.$valor_campo4.'
arpPrio '.$valor_campo5.'
blackListEntry 
allowedMeasBandwidth '.$valor_campo3.'
caTriggeredRedirectionActive '.$valor_campo6.'
cellReselectionPriority '.$valor_campo7.'
connectedModeMobilityPrio '.$valor_campo8.'
eutranFreqToQciProfileRelation 
eutranFrequencyRef EUtraNetwork=1,EUtranFrequency='.$valor_campo2.'
interFreqMeasType '.$valor_campo9.'
lbActivationThreshold '.$valor_campo10.'
lbBnrPolicy '.$valor_campo11.'
mobilityAction '.$valor_campo12.'
neighCellConfig '.$valor_campo13.'
nonPlannedPciCIO '.$valor_campo14.'
nonPlannedPciTargetIdType '.$valor_campo15.'
nonPlannedPhysCellId '.$valor_campo16.'
nonPlannedPhysCellIdRange '.$valor_campo17.'
pMax '.$valor_campo18.'
presenceAntennaPort1 '.$valor_campo19.'
qOffsetFreq '.$valor_campo20.'
qQualMin '.$valor_campo21.'
qRxLevMin '.$valor_campo22.'
tReselectionEutra '.$valor_campo23.'
tReselectionEutraSfHigh '.$valor_campo24.'
tReselectionEutraSfMedium '.$valor_campo25.'
threshXHigh '.$valor_campo26.'
threshXHighQ '.$valor_campo27.'
threshXLow '.$valor_campo28.'
threshXLowQ '.$valor_campo29.'
userLabel 
voicePrio '.$valor_campo30.'
end';
						$continido_3_7[] = $continido_3_7_2;
						}		   
					}

					if($nombre_campo_EUtranFreqRelation == "nonPlannedPhysCellId"){
						$valor_campo16 = $EUtranFreqRelation->getCellByColumnAndRow($x,$i)->getValue();				   
					}

					if($nombre_campo_EUtranFreqRelation == "nonPlannedPhysCellIdRange"){
						$valor_campo17 = $EUtranFreqRelation->getCellByColumnAndRow($x,$i)->getValue();				   
					}

					if($nombre_campo_EUtranFreqRelation == "pMax"){
						$valor_campo18 = $EUtranFreqRelation->getCellByColumnAndRow($x,$i)->getValue();				   
					}

					if($nombre_campo_EUtranFreqRelation == "presenceAntennaPort1"){
						$valor_campo19 = $EUtranFreqRelation->getCellByColumnAndRow($x,$i)->getValue();				   
					}

					if($nombre_campo_EUtranFreqRelation == "qOffsetFreq"){
						$valor_campo20 = $EUtranFreqRelation->getCellByColumnAndRow($x,$i)->getValue();				   
					}

					if($nombre_campo_EUtranFreqRelation == "qQualMin"){
						$valor_campo21 = $EUtranFreqRelation->getCellByColumnAndRow($x,$i)->getValue();				   
					}

					if($nombre_campo_EUtranFreqRelation == "qRxLevMin"){
						$valor_campo22 = $EUtranFreqRelation->getCellByColumnAndRow($x,$i)->getValue();				   
					}

					if($nombre_campo_EUtranFreqRelation == "tReselectionEutra"){
						$valor_campo23 = $EUtranFreqRelation->getCellByColumnAndRow($x,$i)->getValue();				   
					}

					if($nombre_campo_EUtranFreqRelation == "tReselectionEutraSfHigh"){
						$valor_campo24 = $EUtranFreqRelation->getCellByColumnAndRow($x,$i)->getValue();				   
					}

					if($nombre_campo_EUtranFreqRelation == "tReselectionEutraSfMedium"){
						$valor_campo25 = $EUtranFreqRelation->getCellByColumnAndRow($x,$i)->getValue();	   
					}

					if($nombre_campo_EUtranFreqRelation == "threshXHigh"){
						$valor_campo26 = $EUtranFreqRelation->getCellByColumnAndRow($x,$i)->getValue();				   
					}

					if($nombre_campo_EUtranFreqRelation == "threshXHighQ"){
						$valor_campo27 = $EUtranFreqRelation->getCellByColumnAndRow($x,$i)->getValue();				   
					}

					if($nombre_campo_EUtranFreqRelation == "threshXLow"){
						$valor_campo28 = $EUtranFreqRelation->getCellByColumnAndRow($x,$i)->getValue();				   
					}

					if($nombre_campo_EUtranFreqRelation == "threshXLowQ"){
						$valor_campo29 = $EUtranFreqRelation->getCellByColumnAndRow($x,$i)->getValue();				   
					}

					if($nombre_campo_EUtranFreqRelation == "voicePrio"){
						$valor_campo30 = $EUtranFreqRelation->getCellByColumnAndRow($x,$i)->getValue();
					}					
				}
			}	

			//////////////////////////////////////////////////////////////////////////
			//Contrucion del archivo 8
			//
			//
			/////////////////////////////////////////////////////////////////////////
			$EUtranCellRelation = $RND->getSheet($name_h_rnd_ExternalENodeBFunction);
			$filas_EUtranCellRelation_rnd  = $EUtranCellRelation ->getHighestRow(); 
			$Column_EUtranCellRelation_rnd = $EUtranCellRelation ->getHighestColumn();
			$NumColumn_EUtranCellRelation  = PHPExcel_Cell::columnIndexFromString($Column_EUtranCellRelation_rnd);
			for ($i=2; $i <=$filas_EUtranCellRelation_rnd; $i++) { 
				for ($x=0; $x <= $NumColumn_EUtranCellRelation; $x++) {
					$nombre_campo = $EUtranCellRelation->getCellByColumnAndRow($x,1)->getValue();
					if($nombre_campo=="ExternalENodeBFunction"){
						$valor_campo1 = $EUtranCellRelation->getCellByColumnAndRow($x,$i)->getValue();
				    }
				    if($nombre_campo=="eNBId"){
				    	if(!empty($valor_campo1)){
							$valor_campo2 = $EUtranCellRelation->getCellByColumnAndRow($x,$i)->getValue();
							$continido_2_8_1 = '

crn ENodeBFunction=1,EUtraNetwork=1,ExternalENodeBFunction='.$valor_campo1;
						$continido_2_8_2 = '
eNBId '.$valor_campo2.'
eNodeBPlmnId mcc=730,mnc=01,mncLength=2
mfbiSupport false
userLabel 
end
';
						if($continido_2_8_1 != " " && $continido_2_8_2 != " ")
							$continido_2_8[] = $continido_2_8_1.$continido_2_8_2;
						}
					}					
				}		
			} 

			$ExternalEUtranCellFDD = $RND->getSheet($name_h_rnd_ExternalEUtranCellFDD);
			$filas_ExternalEUtranCellFDD_rnd  = $ExternalEUtranCellFDD ->getHighestRow(); 
			$Column_ExternalEUtranCellFDD_rnd = $ExternalEUtranCellFDD ->getHighestColumn();
			$NumColumn_ExternalEUtranCellFDD  = PHPExcel_Cell::columnIndexFromString($Column_ExternalEUtranCellFDD_rnd);
			for ($i=2; $i <=$filas_ExternalEUtranCellFDD_rnd; $i++) { 
				for ($x=0; $x <= $NumColumn_ExternalEUtranCellFDD; $x++) {
					$nombre_campo = $ExternalEUtranCellFDD->getCellByColumnAndRow($x,1)->getValue();
					if($nombre_campo=="ExternalEUtranCellFDD"){
						$valor_campo1 = $ExternalEUtranCellFDD->getCellByColumnAndRow($x,$i)->getValue();
				    }

				    if($nombre_campo=="activePlmnList_mcc"){
						$valor_campo2 = $ExternalEUtranCellFDD->getCellByColumnAndRow($x,$i)->getValue();
				    }

				    if($nombre_campo=="activePlmnList_mnc"){
						$valor_campo3 = $ExternalEUtranCellFDD->getCellByColumnAndRow($x,$i)->getValue();
				    }

				    if($nombre_campo=="activePlmnList_mncLength"){
						$valor_campo4 = $ExternalEUtranCellFDD->getCellByColumnAndRow($x,$i)->getValue();
				    }

				    if($nombre_campo=="eutranFrequencyRef"){
						$valor_campo5 = $ExternalEUtranCellFDD->getCellByColumnAndRow($x,$i)->getValue();
				    }

				    if($nombre_campo=="lbEUtranCellOffloadCapacity"){
						$valor_campo6 = $ExternalEUtranCellFDD->getCellByColumnAndRow($x,$i)->getValue();
				    }

				    if($nombre_campo=="localCellId"){
						$valor_campo7 = $ExternalEUtranCellFDD->getCellByColumnAndRow($x,$i)->getValue();
				    }

				    if($nombre_campo=="physicalLayerCellIdGroup"){
						$valor_campo8 = $ExternalEUtranCellFDD->getCellByColumnAndRow($x,$i)->getValue();
				    }

				    if($nombre_campo=="pciConflict"){
						$valor_campo9 = $ExternalEUtranCellFDD->getCellByColumnAndRow($x,$i)->getValue();
				    }

				    if($nombre_campo=="physicalLayerSubCellId"){
						$valor_campo10 = $ExternalEUtranCellFDD->getCellByColumnAndRow($x,$i)->getValue();
						if(!empty($valor_campo1)){
							if(isset($valor_campo3)){
								$continido_3_8_1 = '
crn ENodeBFunction=1,EUtraNetwork=1,ExternalENodeBFunction='.substr($valor_campo1, 0, -2).',ExternalEUtranCellFDD='.$valor_campo1;
								$continido_3_8_2 = '
activePlmnList mcc='.$valor_campo2.',mnc='.$valor_campo3.',mncLength='.$valor_campo4.'
activeServiceAreaId 
eutranFrequencyRef EUtraNetwork=1,EUtranFrequency='.$valor_campo5.'
isRemoveAllowed false
lbEUtranCellOffloadCapacity '.$valor_campo6.'
localCellId '.$valor_campo7.'
pciConflict '.$valor_campo9.'
pciConflictCell 
pciDetectingCell 
physicalLayerCellIdGroup '.$valor_campo8.'
physicalLayerSubCellId '.$valor_campo10.'
tac 13124
userLabel  
end
';
								if($continido_3_8_1 != " " && $continido_3_8_2 != " ")
									$continido_3_8[] = $continido_3_8_1.$continido_3_8_2;
							}
						}
				    }


				    if($nombre_campo=="ExternalEUtranCellFDD"){
						$valor_campoult = $ExternalEUtranCellFDD->getCellByColumnAndRow($x,$i)->getValue();
					}
					
				}		
			}  								 
   							
			$EUtranCellRelation = $RND->getSheet($name_h_rnd_EUtranCellRelation);//esto es para la 3 parte del archivo 8
			$filas_EUtranCellRelation_rnd  = $EUtranCellRelation ->getHighestRow(); 
			$Column_EUtranCellRelation_rnd = $EUtranCellRelation ->getHighestColumn();
			$NumColumn_EUtranCellRelation  = PHPExcel_Cell::columnIndexFromString($Column_EUtranCellRelation_rnd);
			for ($i=2; $i <=$filas_EUtranCellRelation_rnd; $i++) { 
				for ($x=0; $x <= $NumColumn_EUtranCellRelation; $x++) {
					$nombre_campo = $EUtranCellRelation->getCellByColumnAndRow($x,1)->getValue();
					if($nombre_campo=="EUtranCellFDD"){
						$valor_campo1 = $EUtranCellRelation->getCellByColumnAndRow($x,$i)->getValue();
				    }

				    if($nombre_campo=="EUtranCellRelation"){
				    	$valor_campo2 = $EUtranCellRelation->getCellByColumnAndRow($x,$i)->getValue();					    
					    $valor_campo1_1 = $EUtranCellRelation->getCellByColumnAndRow(1,$i)->getValue();					    					    	
				    					    
				    }

				    if($nombre_campo=="cellIndividualOffsetEUtran"){
						$valor_campo3 = $EUtranCellRelation->getCellByColumnAndRow($x,$i)->getValue();
				    }

				    if($nombre_campo=="includeInSystemInformation"){
						$valor_campo4 = $EUtranCellRelation->getCellByColumnAndRow($x,$i)->getValue();
				    }

				    if($nombre_campo=="isHoAllowed"){
						$valor_campo5 = $EUtranCellRelation->getCellByColumnAndRow($x,$i)->getValue();
				    }

				    if($nombre_campo=="isRemoveAllowed"){
						$valor_campo6 = $EUtranCellRelation->getCellByColumnAndRow($x,$i)->getValue();
						if(!empty($valor_campo1)){									
				    		if(substr($valor_campo2,-1) < 4){
				    			$EUtranFreqRelation  = 1;
					    		$valor_campo1_1_0 = "L".substr($valor_campo1_1, 1, -1).substr($valor_campo2,-1);				    		
					    	}

				    		if(substr($valor_campo2,-1) > 3){
				    			$EUtranFreqRelation  = 2;
					    		$valor_campo1_1_0 = "M".substr($valor_campo1_1, 1, -1).substr($valor_campo2,-1);
					    	}

							$continido_4_8_1 = '
crn  ENodeBFunction=1,EUtranCellFDD='.$valor_campo1.',EUtranFreqRelation='.$EUtranFreqRelation.',EUtranCellRelation='.$valor_campo2;
						$continido_4_8_2 = '
cellIndividualOffsetEUtran '.$valor_campo3.'
coverageIndicator '.$valor_campo12.'
includeInSystemInformation '.$valor_campo4.'
isHoAllowed '.$valor_campo5.'
isRemoveAllowed '.$valor_campo6.'
lbBnrAllowed '.$valor_campo7.'
lbCovIndicated '.$valor_campo8.'
loadBalancing '.$valor_campo9.'
neighborCellRef EUtranCellFDD='.$valor_campo1_1_0.'
qOffsetCellEUtran '.$valor_campo10.'
sCellCandidate '.$valor_campo11.'
sleepModeCovcellCandidate '.$valor_campo12.'
end
';
							if($continido_4_8_1 != " " && $continido_4_8_2 != " ")
								$continido_4_8[] = $continido_4_8_1.$continido_4_8_2;
						}
				    }

				    if($nombre_campo=="lbBnrAllowed"){
						$valor_campo7 = $EUtranCellRelation->getCellByColumnAndRow($x,$i)->getValue();
				    }

				    if($nombre_campo=="lbCovIndicated"){
						$valor_campo8 = $EUtranCellRelation->getCellByColumnAndRow($x,$i)->getValue();
				    }

				    if($nombre_campo=="loadBalancing"){
						$valor_campo9 = $EUtranCellRelation->getCellByColumnAndRow($x,$i)->getValue();
				    }

				    if($nombre_campo=="qOffsetCellEUtran"){
						$valor_campo10 = $EUtranCellRelation->getCellByColumnAndRow($x,$i)->getValue();
				    }

				    if($nombre_campo=="sCellCandidate"){
						$valor_campo11 = $EUtranCellRelation->getCellByColumnAndRow($x,$i)->getValue();
				    }

				    if($nombre_campo=="coverageIndicator"){
						$valor_campo12 = $EUtranCellRelation->getCellByColumnAndRow($x,$i)->getValue();
				    }

				    if($nombre_campo=="sleepModeCovCellCandidate"){
						$valor_campo12 = $EUtranCellRelation->getCellByColumnAndRow($x,$i)->getValue();
					}
				}	
			}

			//////////////////////////////////////////////////////////////////////////
			//Contrucion del archivo 9
			//
			//
			/////////////////////////////////////////////////////////////////////////
			$UtranFrequency = $RND->getSheet($name_h_rnd_UtranFrequency);//esto es para la 1 parte del archivo 9
			$filas_UtranFrequency_rnd  = $UtranFrequency ->getHighestRow(); 
			$Column_UtranFrequency_rnd = $UtranFrequency ->getHighestColumn();
			$NumColumn_UtranFrequency  = PHPExcel_Cell::columnIndexFromString($Column_UtranFrequency_rnd);
			for ($i=2; $i <=$filas_UtranFrequency_rnd; $i++) { 
				for ($x=0; $x <= $NumColumn_UtranFrequency; $x++) {
					$nombre_campo_UtranFrequency = $UtranFrequency->getCellByColumnAndRow($x,1)->getValue();
					if($nombre_campo_UtranFrequency == "arfcnValueUtranDl"){						
						$valor_campo1 = $UtranFrequency->getCellByColumnAndRow($x,$i)->getValue();
				    }

				    if($nombre_campo_UtranFrequency == "UtranFrequencyId"){
						$valor_campo2 = $UtranFrequency->getCellByColumnAndRow($x,$i)->getValue();
				    }

				    if($nombre_campo_UtranFrequency == "userLabel"){
						$valor_campo3 = $UtranFrequency->getCellByColumnAndRow($x,$i)->getValue();				   
						if(isset($valor_campo1)){
							$continido_1_9_1 ='
crn ENodeBFunction=1,UtraNetwork=1
userLabel
end

crn ENodeBFunction=1,UtraNetwork=1,UtranFrequency='.$valor_campo2.'
arfcnValueUtranDl '.$valor_campo1.'
userLabel '.$valor_campo3.'
end';
						}	
						$continido_2_9[] = $continido_1_9_1;
					}
				}
			}
//die();
			$UtranFreqRelation = $RND->getSheet($name_h_rnd_UtranFreqRelation);//esto es para la 2 parte del archivo 9
			$filas_UtranFreqRelation_rnd  = $UtranFreqRelation ->getHighestRow(); 
			$Column_UtranFreqRelation_rnd = $UtranFreqRelation ->getHighestColumn();
			$NumColumn_UtranFreqRelation  = PHPExcel_Cell::columnIndexFromString($Column_UtranFreqRelation_rnd);
			for ($i=2; $i <=$filas_UtranFreqRelation_rnd; $i++) { 
				for ($x=0; $x <= $NumColumn_UtranFreqRelation; $x++) {
					$nombre_campo = $UtranFreqRelation->getCellByColumnAndRow($x,1)->getValue();
					if($nombre_campo=="EUtranCellFDD"){
						$valor_campo1 = $UtranFreqRelation->getCellByColumnAndRow($x,$i)->getValue();
				    }

					if($nombre_campo=="UtranFreqRelation"){
						$valor_campo2 = $UtranFreqRelation->getCellByColumnAndRow($x,$i)->getValue();
				    }

				    if($nombre_campo=="allowedPlmnList_mcc"){
						$valor_campo3 = $UtranFreqRelation->getCellByColumnAndRow($x,$i)->getValue();
				    }

				    if($nombre_campo=="allowedPlmnList_mnc"){
						$valor_campo4 = $UtranFreqRelation->getCellByColumnAndRow($x,$i)->getValue();
				    }

				    if($nombre_campo=="allowedPlmnList_mncLength"){
						$valor_campo5 = $UtranFreqRelation->getCellByColumnAndRow($x,$i)->getValue();
				    }

				    if($nombre_campo=="altCsfbTargetPrio"){
						$valor_campo6 = $UtranFreqRelation->getCellByColumnAndRow($x,$i)->getValue();
				    }

				    if($nombre_campo=="voicePrio"){
						$valor_campo25 = $UtranFreqRelation->getCellByColumnAndRow($x,$i)->getValue();
				    }

				    if($nombre_campo=="anrMeasOn"){
						$valor_campo8 = $UtranFreqRelation->getCellByColumnAndRow($x,$i)->getValue();
				    }

				    if($nombre_campo=="cellReselectionPriority"){
						$valor_campo9 = $UtranFreqRelation->getCellByColumnAndRow($x,$i)->getValue();
				    }

				    if($nombre_campo=="connectedModeMobilityPrio"){
						$valor_campo10 = $UtranFreqRelation->getCellByColumnAndRow($x,$i)->getValue();
				    }

				    if($nombre_campo=="csFallbackPrio"){
						$valor_campo11 = $UtranFreqRelation->getCellByColumnAndRow($x,$i)->getValue();
				    }

				    if($nombre_campo=="csFallbackPrioEC"){
						$valor_campo12 = $UtranFreqRelation->getCellByColumnAndRow($x,$i)->getValue();
				    }

				    if($nombre_campo=="lbBnrPolicy"){
						$valor_campo13 = $UtranFreqRelation->getCellByColumnAndRow($x,$i)->getValue();
				    }

				    if($nombre_campo=="mobilityAction"){
						$valor_campo14 = $UtranFreqRelation->getCellByColumnAndRow($x,$i)->getValue();
				    }

				    if($nombre_campo=="mobilityActionCsfb"){
						$valor_campo15 = $UtranFreqRelation->getCellByColumnAndRow($x,$i)->getValue();
				    }

				    if($nombre_campo=="pMaxUtra"){
						$valor_campo16 = $UtranFreqRelation->getCellByColumnAndRow($x,$i)->getValue();
				    }

				    if($nombre_campo=="qOffsetFreq"){
						$valor_campo17 = $UtranFreqRelation->getCellByColumnAndRow($x,$i)->getValue();
				    }

				    if($nombre_campo=="qQualMin"){
						$valor_campo18 = $UtranFreqRelation->getCellByColumnAndRow($x,$i)->getValue();
				    }

				    if($nombre_campo=="qRxLevMin"){
						$valor_campo19 = $UtranFreqRelation->getCellByColumnAndRow($x,$i)->getValue();
				    }

				    if($nombre_campo=="threshXHigh"){
						$valor_campo20 = $UtranFreqRelation->getCellByColumnAndRow($x,$i)->getValue();
				    }

				    if($nombre_campo=="threshXHighQ"){
						$valor_campo21 = $UtranFreqRelation->getCellByColumnAndRow($x,$i)->getValue();
				    }

				    if($nombre_campo=="threshXLow"){
						$valor_campo22 = $UtranFreqRelation->getCellByColumnAndRow($x,$i)->getValue();
				    }

				    if($nombre_campo=="threshXLowQ"){
						$valor_campo23 = $UtranFreqRelation->getCellByColumnAndRow($x,$i)->getValue();
				    }

				    if($nombre_campo=="threshXLowQ"){
						$valor_campo23 = $UtranFreqRelation->getCellByColumnAndRow($x,$i)->getValue();
				    }

				    if($nombre_campo=="userLabel"){
						$valor_campo24 = $UtranFreqRelation->getCellByColumnAndRow($x,$i)->getValue();						
				    }

				    if($nombre_campo=="altCsfbTargetPrioEc"){
						$valor_campo7 = $UtranFreqRelation->getCellByColumnAndRow($x,$i)->getValue();				   
						if(!empty($valor_campo1)){
							$continido_2_9_1 ='
crn ENodeBFunction=1,EUtranCellFDD='.$valor_campo1.',UtranFreqRelation=_'.$valor_campo2.'
allowedPlmnList mcc='.substr($valor_campo3, 0, 1).',mnc='.substr($valor_campo4,0,1).',mncLength='.substr($valor_campo5, 0,1).';mcc='.substr($valor_campo3, 2, 1).',mnc='.substr($valor_campo4,2,1).',mncLength='.substr($valor_campo5, 2,1).';mcc='.substr($valor_campo3, 4, 1).',mnc='.substr($valor_campo4,4,1).',mncLength='.substr($valor_campo5, 4,1).';mcc='.substr($valor_campo3, 6, 1).',mnc='.substr($valor_campo4,6,1).',mncLength='.substr($valor_campo5, 6,1).';mcc='.substr($valor_campo3, 8, 1).',mnc='.substr($valor_campo4,8,1).',mncLength='.substr($valor_campo5, 8,1).';mcc='.substr($valor_campo3, 10, 1).',mnc='.substr($valor_campo4,10,1).',mncLength='.substr($valor_campo5, 10,1).';mcc='.substr($valor_campo3, 12, 1).',mnc='.substr($valor_campo4,12,1).',mncLength='.substr($valor_campo5, 12,1).';mcc='.substr($valor_campo3, 14, 1).',mnc='.substr($valor_campo4,14,1).',mncLength='.substr($valor_campo5, 14,1).';mcc='.substr($valor_campo3, 16, 1).',mnc='.substr($valor_campo4,16,1).',mncLength='.substr($valor_campo5, 16,1).';mcc='.substr($valor_campo3, 18, 1).',mnc='.substr($valor_campo4,18,1).',mncLength='.substr($valor_campo5, 18,1).';mcc='.substr($valor_campo3, 20, 1).',mnc='.substr($valor_campo4,20,1).',mncLength='.substr($valor_campo5, 20,1).';mcc='.substr($valor_campo3, 22, 1).',mnc='.substr($valor_campo4,22,1).',mncLength='.substr($valor_campo5, 22,1).';mcc='.substr($valor_campo3, 24, 1).',mnc='.substr($valor_campo4,24,1).',mncLength='.substr($valor_campo5, 24,1).';mcc='.substr($valor_campo3, 26, 1).',mnc='.substr($valor_campo4,26,1).',mncLength='.substr($valor_campo5, 26,1).';mcc='.substr($valor_campo3,28,1).',mnc='.substr($valor_campo4,28,1).',mncLength='.substr($valor_campo5, 28,1).'
altCsfbTargetPrio '.$valor_campo6.'
altCsfbTargetPrioEc '.$valor_campo7.'
anrMeasOn '.$valor_campo8.'
cellReselectionPriority '.$valor_campo9.'
connectedModeMobilityPrio '.$valor_campo10.'
csFallbackPrio '.$valor_campo11.'
csFallbackPrioEC '.$valor_campo12.'
lbBnrPolicy '.$valor_campo13.'
mobilityAction '.$valor_campo14.'
mobilityActionCsfb '.$valor_campo15.'
pMaxUtra '.$valor_campo16.'
qOffsetFreq '.$valor_campo17.'
qQualMin '.$valor_campo18.'
qRxLevMin '.$valor_campo19.'
threshXHigh '.$valor_campo20.'
threshXHighQ '.$valor_campo21.'
threshXLow '.$valor_campo22.'
threshXLowQ '.$valor_campo23.'
userLabel '.$valor_campo24.'
utranFreqToQciProfileRelation 
utranFrequencyRef UtraNetwork=1,UtranFrequency=_'.$valor_campo2.'
voicePrio '.$valor_campo25.'
end';
							$continido_3_9[] = $continido_2_9_1;
						}	
						
					}
				}
			}
			//////////////////////////////////////////////////////////////////////////
			//Contrucion del archivo 10
			//
			//
			/////////////////////////////////////////////////////////////////////////
			$Features = $RND->getSheet($name_h_rnd_Features);//esto es para la 1 parte del archivo 10
			$filas_Features_rnd  = $Features ->getHighestRow(); 
			$Column_Features_rnd = $Features ->getHighestColumn();
			$NumColumn_Features  = PHPExcel_Cell::columnIndexFromString($Column_Features_rnd);
			for ($i=2; $i <=$filas_Features_rnd; $i++) { 
				for ($x=1; $x <= $NumColumn_Features; $x++) {
					$nombre_campo_Features = $Features->getCellByColumnAndRow($x,1)->getValue();
					$valor_campo1 = $Features->getCellByColumnAndRow(1,$i)->getValue();
					$valor_campo3 = $Features->getCellByColumnAndRow($x,$i)->getValue();				   
					if(!empty($nombre_campo_Features) && !empty($valor_campo1)){
						$continido_1_10_1 ='
set SystemFunctions=1,Licensing=1,OptionalFeatureLicense='.$nombre_campo_Features.' FeatureState '.$valor_campo3;
						$continido_2_10[] = $continido_1_10_1;
					}	
				}
			}

			//////////////////////////////////////////////////////////////////////////
			//Contrucion del archivo 11
			//
			//
			/////////////////////////////////////////////////////////////////////////
			$DrxProfile = $RND->getSheet($name_h_rnd_DrxProfile);//esto es para la 1 parte del archivo 11
			$filas_DrxProfile_rnd  = $DrxProfile ->getHighestRow(); 
			$Column_DrxProfile_rnd = $DrxProfile ->getHighestColumn();
			$NumColumn_DrxProfile  = PHPExcel_Cell::columnIndexFromString($Column_DrxProfile_rnd);
			for ($i=2; $i <=$filas_DrxProfile_rnd; $i++) { 
				for ($x=0; $x <= $NumColumn_DrxProfile; $x++) {
					$nombre_campo_DrxProfile = $DrxProfile->getCellByColumnAndRow($x,1)->getValue();

					if($nombre_campo_DrxProfile=="DrxProfile"){
						$nombre_compl = $nombre_campo_DrxProfile;
						$valor_campo1 = $DrxProfile->getCellByColumnAndRow($x,$i)->getValue();												
				    }

				    if($nombre_campo_DrxProfile == "drxInactivityTimer"){
						$valor_campo5 = $DrxProfile->getCellByColumnAndRow($x,$i)->getValue();
						$nombre_shortDrxCycle = $nombre_campo_DrxProfile ;
						if(!empty($valor_campo5)){
							$continido_1_11_1 ='
set '.$nombre_compl.'='.$valor_campo1.' '.$nombre_shortDrxCycle.' '.$valor_campo5;
							$continido_2_11[] = $continido_1_11_1;
						}						
				    }
				}

				for ($x=0; $x <= $NumColumn_DrxProfile; $x++) {
					$nombre_campo_DrxProfile = $DrxProfile->getCellByColumnAndRow($x,1)->getValue();

					if($nombre_campo_DrxProfile=="DrxProfile"){
						$nombre_compl = $nombre_campo_DrxProfile;
						$valor_campo1 = $DrxProfile->getCellByColumnAndRow($x,$i)->getValue();												
				    }

				    if($nombre_campo_DrxProfile == "drxRetransmissionTimer"){
						$valor_campo5 = $DrxProfile->getCellByColumnAndRow($x,$i)->getValue();
						$nombre_shortDrxCycle = $nombre_campo_DrxProfile ;
						if(!empty($valor_campo5)){
							$continido_1_11_1 ='
set '.$nombre_compl.'='.$valor_campo1.' '.$nombre_shortDrxCycle.' '.$valor_campo5;
							$continido_3_11[] = $continido_1_11_1;
						}						
				    }
				}

				for ($x=0; $x <= $NumColumn_DrxProfile; $x++) {
					$nombre_campo_DrxProfile = $DrxProfile->getCellByColumnAndRow($x,1)->getValue();

					if($nombre_campo_DrxProfile=="DrxProfile"){
						$nombre_compl = $nombre_campo_DrxProfile;
						$valor_campo1 = $DrxProfile->getCellByColumnAndRow($x,$i)->getValue();												
				    }

				    if($nombre_campo_DrxProfile == "longDrxCycle"){
						$valor_campo5 = $DrxProfile->getCellByColumnAndRow($x,$i)->getValue();
						$nombre_shortDrxCycle = $nombre_campo_DrxProfile ;
						if(!empty($valor_campo5)){
							$continido_1_11_1 ='
set '.$nombre_compl.'='.$valor_campo1.' '.$nombre_shortDrxCycle.' '.$valor_campo5;
							$continido_4_11[] = $continido_1_11_1;
						}						
				    }
				}

				for ($x=0; $x <= $NumColumn_DrxProfile; $x++) {
					$nombre_campo_DrxProfile = $DrxProfile->getCellByColumnAndRow($x,1)->getValue();

					if($nombre_campo_DrxProfile=="DrxProfile"){
						$nombre_compl = $nombre_campo_DrxProfile;
						$valor_campo1 = $DrxProfile->getCellByColumnAndRow($x,$i)->getValue();												
				    }

				    if($nombre_campo_DrxProfile == "shortDrxCycle"){
						$valor_campo5 = $DrxProfile->getCellByColumnAndRow($x,$i)->getValue();
						$nombre_shortDrxCycle = $nombre_campo_DrxProfile ;
						if(!empty($valor_campo5)){
							$continido_1_11_1 ='
set '.$nombre_compl.'='.$valor_campo1.' '.$nombre_shortDrxCycle.' '.$valor_campo5;
							$continido_5_11[] = $continido_1_11_1;
						}						
				    }

				    if($nombre_campo_DrxProfile !="DrxProfile"  && $nombre_campo_DrxProfile != "drxInactivityTimer" && $nombre_campo_DrxProfile != "drxRetransmissionTimer" && $nombre_campo_DrxProfile != "longDrxCycle" && $nombre_campo_DrxProfile != "shortDrxCycle"){
				    		if(!empty($nombre_campo_DrxProfile) && $i == 2){
					    		$informacion_DrxProfile .= "Columna == ".$nombre_campo_DrxProfile."\n"; //cambios 24-07-2017
					    		$RutaCArpeta = "archivo/ENodoB_excepsiones/ENodoB_".$nombre_final."/";
					    		$RutaArchivo = "archivo/ENodoB_excepsiones/ENodoB_".$nombre_final."/".$NombreHojaRNDDrxProfile."_Archivo11.txt";
					    		$this->ElimarArchivo($RutaArchivo);
					    		$this->crear_carpeta($RutaCArpeta);
								$this->CrearArchivo($RutaArchivo, $informacion_DrxProfile);
							}
				    }
				}
			}

			$EUtranCellFDD_11 = $RND->getSheet($name_h_rnd_EUtranCellFDD);//esto es para la 1 parte del archivo 11.1
			$filas_EUtranCellFDD_11_rnd  = $EUtranCellFDD_11 ->getHighestRow(); 
			$Column_EUtranCellFDD_11_rnd = $EUtranCellFDD_11 ->getHighestColumn();
			$NumColumn_EUtranCellFDD_11  = PHPExcel_Cell::columnIndexFromString($Column_EUtranCellFDD_11_rnd);
			for ($i=2; $i <=$filas_EUtranCellFDD_11_rnd; $i++) {
				for ($x=0; $x <= $NumColumn_EUtranCellFDD_11; $x++) {
					$nombre_campo_EUtranCellFDD_11 = $EUtranCellFDD_11->getCellByColumnAndRow($x,1)->getValue();

					if($nombre_campo_EUtranCellFDD_11=="EUtranCellFDD"){
						$nombre_compl = $nombre_campo_EUtranCellFDD_11;
						$valor_campo1 = $EUtranCellFDD_11->getCellByColumnAndRow($x,$i)->getValue();												
				    }

				    if($nombre_campo_EUtranCellFDD_11 == "eutranCellCoverage_posCellBearing"){
						$valor_campo2 = $EUtranCellFDD_11->getCellByColumnAndRow($x,$i)->getValue();
						if(!empty($valor_campo2)){
							$continido_1_11_1 ='
set EUtranCellFDD='.$valor_campo1.' eutranCellCoverage posCellBearing='.$valor_campo2;
							$continido_6_11[] = $continido_1_11_1;
						}						
				    }
				}

				for ($x=0; $x <= $NumColumn_EUtranCellFDD_11; $x++) {
					$nombre_campo_EUtranCellFDD_11 = $EUtranCellFDD_11->getCellByColumnAndRow($x,1)->getValue();

					if($nombre_campo_EUtranCellFDD_11=="EUtranCellFDD"){
						$nombre_compl = $nombre_campo_EUtranCellFDD_11;
						$valor_campo1 = $EUtranCellFDD_11->getCellByColumnAndRow($x,$i)->getValue();												
				    }

				    if($nombre_campo_EUtranCellFDD_11=="eutranCellPolygon_cornerLongitude"){
						$valor_campo3 = $EUtranCellFDD_11->getCellByColumnAndRow($x,$i)->getValue();
						$valor_campo3 = str_replace(" ", "", $valor_campo3);
						for ($e=0; $e <strlen($valor_campo2) ; $e++) { 
							if($e < strlen($valor_campo2)-1 && $e == $e )
								$valor_campo2_fin = $valor_campo2_fin.'cornerLatitude='.$valor_campo2[$e].",cornerLongitude=".$valor_campo3[$e].";";
							else
								$final = $valor_campo2_fin.'cornerLatitude='.$valor_campo2[$e].",cornerLongitude=".$valor_campo3[$e];
						}
						$valor_campo2_fin ="";
						//die();
						//echo $valor_campo2_fin."<br>";
						if(!empty($valor_campo1)){
							$continido_1_11_1 ='
set EUtranCellFDD='.$valor_campo1.' eutranCellPolygon '.$final;
								$continido_7_11[] = $continido_1_11_1;
						}								
				    }

				    if($nombre_campo_EUtranCellFDD_11 == "eutranCellPolygon_cornerLatitude"){
						$valor_campo2 = $EUtranCellFDD_11->getCellByColumnAndRow($x,$i)->getValue();
						$valor_campo2 = str_replace(" ", "", $valor_campo2);											
				    }				    
				}

				for ($x=0; $x <= $NumColumn_EUtranCellFDD_11; $x++) {
					$nombre_campo_EUtranCellFDD_11 = $EUtranCellFDD_11->getCellByColumnAndRow($x,1)->getValue();

					if($nombre_campo_EUtranCellFDD_11=="EUtranCellFDD"){
						$nombre_compl = $nombre_campo_EUtranCellFDD_11;
						$valor_campo1 = $EUtranCellFDD_11->getCellByColumnAndRow($x,$i)->getValue();												
				    }

				    if($nombre_campo_EUtranCellFDD_11 == "primaryPlmnReserved"){
						$valor_campo4 = $EUtranCellFDD_11->getCellByColumnAndRow($x,$i)->getValue();
						if(!empty($valor_campo1)){
							$continido_1_11_1 ='
set EUtranCellFDD='.$valor_campo1.' primaryPlmnReserved '.$valor_campo4;
							$continido_8_11[] = $continido_1_11_1;
						}						
				    }
				}
			}



			$ExternalEUtranCellFDD_11 = $RND->getSheet($name_h_rnd_ExternalEUtranCellFDD);//esto es para la 1 parte del archivo 11.2
			$filas_ExternalEUtranCellFDD_11_rnd  = $ExternalEUtranCellFDD_11 ->getHighestRow(); 
			$Column_ExternalEUtranCellFDD_11_rnd = $ExternalEUtranCellFDD_11 ->getHighestColumn();
			$NumColumn_ExternalEUtranCellFDD_11  = PHPExcel_Cell::columnIndexFromString($Column_ExternalEUtranCellFDD_11_rnd);
			for ($i=2; $i <=$filas_ExternalEUtranCellFDD_11_rnd; $i++) { 
				for ($x=0; $x <= $NumColumn_ExternalEUtranCellFDD_11; $x++) {
					$nombre_campo_ExternalEUtranCellFDD_11 = $ExternalEUtranCellFDD_11->getCellByColumnAndRow($x,1)->getValue();
					if($nombre_campo_ExternalEUtranCellFDD_11=="ExternalEUtranCellFDD"){
						$nombre_compl = $nombre_campo_ExternalEUtranCellFDD_11;
						$valor_campo1 = $ExternalEUtranCellFDD_11->getCellByColumnAndRow($x,$i)->getValue();												
				    }

				    if($nombre_campo_ExternalEUtranCellFDD_11=="pciConflict"){
						$nombre_compl = $nombre_campo_ExternalEUtranCellFDD_11;
						$valor_campo2 = $ExternalEUtranCellFDD_11->getCellByColumnAndRow($x,$i)->getValue();
						if(!empty($valor_campo1)){
							$continido_1_11_1 ='
set ExternalEUtranCellFDD='.$valor_campo1.' pciConflict '.$valor_campo2;
							$continido_9_11[] = $continido_1_11_1;
						}	
																		
				    }					
				}
			}

			$Paging = $RND->getSheet($name_h_rnd_Paging);//esto es para la 1 parte del archivo 11.2.1
			$filas_Paging_rnd  = $Paging ->getHighestRow(); 
			$Column_Paging_rnd = $Paging ->getHighestColumn();
			$NumColumn_Paging  = PHPExcel_Cell::columnIndexFromString($Column_Paging_rnd);
			for ($i=2; $i <=$filas_Paging_rnd; $i++) { 
				for ($x=0; $x <= $NumColumn_Paging; $x++) {
					$nombre_campo_Paging = $Paging->getCellByColumnAndRow($x,1)->getValue();
					if($nombre_campo_Paging=="maxNoOfPagingRecords"){						
						$valor_campo2 = $Paging->getCellByColumnAndRow($x,$i)->getValue();
						if(!empty($valor_campo2)){
							$continido_1_11_1 ='
set Paging=1 maxNoOfPagingRecords '.$valor_campo2
;
							$continido_9_11[] .= $continido_1_11_1;
						}	
																		
				    }					
				}
			}

			$ReportConfigA1Prim = $RND->getSheet($name_h_rnd_ReportConfigA1Prim);//esto es para la 1 parte del archivo 11.3
			$filas_ReportConfigA1Prim_rnd  = $ReportConfigA1Prim ->getHighestRow(); 
			$Column_ReportConfigA1Prim_rnd = $ReportConfigA1Prim ->getHighestColumn();
			$NumColumn_ReportConfigA1Prim  = PHPExcel_Cell::columnIndexFromString($Column_ReportConfigA1Prim_rnd);
			for ($i=2; $i <=$filas_ReportConfigA1Prim_rnd; $i++) { 
				for ($x=0; $x <= $NumColumn_ReportConfigA1Prim; $x++) {
					$nombre_campo_ReportConfigA1Prim = $ReportConfigA1Prim->getCellByColumnAndRow($x,1)->getValue();					
					if($nombre_campo_ReportConfigA1Prim=="EUtranCellFDD"){
						$valor_campo1 = $ReportConfigA1Prim->getCellByColumnAndRow($x,$i)->getValue();
				    }

					if($nombre_campo_ReportConfigA1Prim=="a1ThresholdRsrpPrim"){						
						$valor_campo2 = $ReportConfigA1Prim->getCellByColumnAndRow($x,$i)->getValue();
						if(!empty($valor_campo1)){
							$continido_1_11_1 ='
set EUtranCellFDD='.$valor_campo1.',UeMeasControl=1,ReportConfigA1Prim=1 a1ThresholdRsrpPrim '.$valor_campo2;
							$continido_10_11[] = $continido_1_11_1;
						}
																		
				    }					
				}
			}

			$ReportConfigA5 = $RND->getSheet($name_h_rnd_ReportConfigA5);//esto es para la 1 parte del archivo 11.3
			$filas_ReportConfigA5_rnd  = $ReportConfigA5 ->getHighestRow(); 
			$Column_ReportConfigA5_rnd = $ReportConfigA5 ->getHighestColumn();
			$NumColumn_ReportConfigA5  = PHPExcel_Cell::columnIndexFromString($Column_ReportConfigA5_rnd);
			for ($i=2; $i <=$filas_ReportConfigA5_rnd; $i++) { 
				for ($x=0; $x <= $NumColumn_ReportConfigA5; $x++) {
					$nombre_campo_ReportConfigA5 = $ReportConfigA5->getCellByColumnAndRow($x,1)->getValue();					
					if($nombre_campo_ReportConfigA5=="EUtranCellFDD"){
						$valor_campo1 = $ReportConfigA5->getCellByColumnAndRow($x,$i)->getValue();
				    }

					if($nombre_campo_ReportConfigA5=="a5Threshold1Rsrp"){						
						$valor_campo2 = $ReportConfigA5->getCellByColumnAndRow($x,$i)->getValue();
						if(!empty($valor_campo1)){
							$continido_1_11_1 ='
set EUtranCellFDD='.$valor_campo1.',UeMeasControl=1,ReportConfigA1Prim=1 a5Threshold1Rsrp '.$valor_campo2;
							$continido_11_11[] = $continido_1_11_1;
						}
																		
				    }					
				}

				for ($x=0; $x <= $NumColumn_ReportConfigA5; $x++) {
					$nombre_campo_ReportConfigA5 = $ReportConfigA5->getCellByColumnAndRow($x,1)->getValue();					
					if($nombre_campo_ReportConfigA5=="EUtranCellFDD"){
						$valor_campo1 = $ReportConfigA5->getCellByColumnAndRow($x,$i)->getValue();
				    }

					if($nombre_campo_ReportConfigA5=="a5Threshold2Rsrp"){						
						$valor_campo2 = $ReportConfigA5->getCellByColumnAndRow($x,$i)->getValue();
						if(!empty($valor_campo1)){
							$continido_1_11_2 ='
set EUtranCellFDD='.$valor_campo1.',UeMeasControl=1,ReportConfigA5=1 a5Threshold2Rsrp '.$valor_campo2;
							$continido_12_11[] = $continido_1_11_2;
						}
																		
				    }					
				}
			}
			
			$ReportConfigA5Anr = $RND->getSheet($name_h_rnd_ReportConfigA5Anr);//esto es para la 1 parte del archivo 11.4
			$filas_ReportConfigA5Anr_rnd  = $ReportConfigA5Anr ->getHighestRow(); 
			$Column_ReportConfigA5Anr_rnd = $ReportConfigA5Anr ->getHighestColumn();
			$NumColumn_ReportConfigA5Anr  = PHPExcel_Cell::columnIndexFromString($Column_ReportConfigA5Anr_rnd);
			for ($i=2; $i <=$filas_ReportConfigA5Anr_rnd; $i++) { 
				for ($x=0; $x <= $NumColumn_ReportConfigA5Anr; $x++) {
					$nombre_campo_ReportConfigA5Anr = $ReportConfigA5Anr->getCellByColumnAndRow($x,1)->getValue();					
					if($nombre_campo_ReportConfigA5Anr=="EUtranCellFDD"){
						$valor_campo1 = $ReportConfigA5Anr->getCellByColumnAndRow($x,$i)->getValue();
				    }

					if($nombre_campo_ReportConfigA5Anr=="timeToTriggerA5"){						
						$valor_campo2 = $ReportConfigA5Anr->getCellByColumnAndRow($x,$i)->getValue();
						if(!empty($valor_campo1)){
							$continido_1_11_1 ='
set EUtranCellFDD='.$valor_campo1.',UeMeasControl=1,ReportConfigA5=1,ReportConfigA5Anr=1 timeToTriggerA5 '.$valor_campo2;
							$continido_13_11[] = $continido_1_11_1;
						}
																		
				    }					
				}
			}

			$ReportConfigB2Utra = $RND->getSheet($name_h_rnd_ReportConfigB2Utra);//esto es para la 1 parte del archivo 11.5
			$filas_ReportConfigB2Utra_rnd  = $ReportConfigB2Utra ->getHighestRow(); 
			$Column_ReportConfigB2Utra_rnd = $ReportConfigB2Utra ->getHighestColumn();
			$NumColumn_ReportConfigB2Utra  = PHPExcel_Cell::columnIndexFromString($Column_ReportConfigB2Utra_rnd);
			for ($i=2; $i <=$filas_ReportConfigB2Utra_rnd; $i++) { 
				for ($x=0; $x <= $NumColumn_ReportConfigB2Utra; $x++) {
					$nombre_campo_ReportConfigB2Utra = $ReportConfigB2Utra->getCellByColumnAndRow($x,1)->getValue();					
					if($nombre_campo_ReportConfigB2Utra=="EUtranCellFDD"){
						$valor_campo1 = $ReportConfigB2Utra->getCellByColumnAndRow($x,$i)->getValue();
				    }

					if($nombre_campo_ReportConfigB2Utra=="b2Threshold1Rsrp"){						
						$valor_campo2 = $ReportConfigB2Utra->getCellByColumnAndRow($x,$i)->getValue();
						if(!empty($valor_campo1)){
							$continido_1_11_1 ='
set EUtranCellFDD='.$valor_campo1.',UeMeasControl=1,ReportConfigB2Utra=1 b2Threshold1Rsrp '.$valor_campo2;
							$continido_14_11[] = $continido_1_11_1;
						}
																		
				    }					
				}

				for ($x=0; $x <= $NumColumn_ReportConfigB2Utra; $x++) {
					$nombre_campo_ReportConfigB2Utra = $ReportConfigB2Utra->getCellByColumnAndRow($x,1)->getValue();					
					if($nombre_campo_ReportConfigB2Utra=="EUtranCellFDD"){
						$valor_campo1 = $ReportConfigB2Utra->getCellByColumnAndRow($x,$i)->getValue();
				    }

					if($nombre_campo_ReportConfigB2Utra=="b2Threshold2EcNoUtra"){						
						$valor_campo2 = $ReportConfigB2Utra->getCellByColumnAndRow($x,$i)->getValue();
						if(!empty($valor_campo1)){
							$continido_1_11_1 ='
set EUtranCellFDD='.$valor_campo1.',UeMeasControl=1,ReportConfigB2Utra=1 b2Threshold2EcNoUtra '.$valor_campo2;
							$continido_15_11[] = $continido_1_11_1;
						}
																		
				    }					
				}

				for ($x=0; $x <= $NumColumn_ReportConfigB2Utra; $x++) {
					$nombre_campo_ReportConfigB2Utra = $ReportConfigB2Utra->getCellByColumnAndRow($x,1)->getValue();					
					if($nombre_campo_ReportConfigB2Utra=="EUtranCellFDD"){
						$valor_campo1 = $ReportConfigB2Utra->getCellByColumnAndRow($x,$i)->getValue();
				    }

					if($nombre_campo_ReportConfigB2Utra=="b2Threshold2RscpUtra"){						
						$valor_campo2 = $ReportConfigB2Utra->getCellByColumnAndRow($x,$i)->getValue();
						if(!empty($valor_campo1)){
							$continido_1_11_1 ='
set EUtranCellFDD='.$valor_campo1.',UeMeasControl=1,ReportConfigB2Utra=1 b2Threshold2RscpUtra '.$valor_campo2;
							$continido_16_11[] = $continido_1_11_1;
						}
																		
				    }					
				}

				for ($x=0; $x <= $NumColumn_ReportConfigB2Utra; $x++) {
					$nombre_campo_ReportConfigB2Utra = $ReportConfigB2Utra->getCellByColumnAndRow($x,1)->getValue();					
					if($nombre_campo_ReportConfigB2Utra=="EUtranCellFDD"){
						$valor_campo1 = $ReportConfigB2Utra->getCellByColumnAndRow($x,$i)->getValue();
				    }

					if($nombre_campo_ReportConfigB2Utra=="hysteresisB2"){						
						$valor_campo2 = $ReportConfigA5Anr->getCellByColumnAndRow($x,$i)->getValue();
						if(!empty($valor_campo1)){
							$continido_1_11_1 ='
set EUtranCellFDD='.$valor_campo1.',UeMeasControl=1,ReportConfigB2Utra=1 hysteresisB2 '.$valor_campo2;
							$continido_17_11[] = $continido_1_11_1;
						}
																		
				    }					
				}
			}

			$ReportConfigEUtraBadCovPrim = $RND->getSheet($name_h_rnd_ReportConfigEUtraBadCovPrim);//esto es para la 1 parte del archivo 11.5
			$filas_ReportConfigEUtraBadCovPrim_rnd  = $ReportConfigEUtraBadCovPrim ->getHighestRow(); 
			$Column_ReportConfigEUtraBadCovPrim_rnd = $ReportConfigEUtraBadCovPrim ->getHighestColumn();
			$NumColumn_ReportConfigEUtraBadCovPrim  = PHPExcel_Cell::columnIndexFromString($Column_ReportConfigEUtraBadCovPrim_rnd);
			for ($i=2; $i <=$filas_ReportConfigEUtraBadCovPrim_rnd; $i++) { 
				for ($x=0; $x <= $NumColumn_ReportConfigEUtraBadCovPrim; $x++) {
					$nombre_campo_ReportConfigEUtraBadCovPrim = $ReportConfigEUtraBadCovPrim->getCellByColumnAndRow($x,1)->getValue();					
					if($nombre_campo_ReportConfigEUtraBadCovPrim=="EUtranCellFDD"){
						$valor_campo1 = $ReportConfigEUtraBadCovPrim->getCellByColumnAndRow($x,$i)->getValue();
				    }

					if($nombre_campo_ReportConfigEUtraBadCovPrim=="a2ThresholdRsrpPrim"){						
						$valor_campo2 = $ReportConfigEUtraBadCovPrim->getCellByColumnAndRow($x,$i)->getValue();
						if(!empty($valor_campo1)){
							$continido_1_11_1 ='
set EUtranCellFDD='.$valor_campo1.',UeMeasControl=1,ReportConfigEUtraBadCovPrim=1 a2ThresholdRsrpPrim '.$valor_campo2;
							$continido_18_11[] = $continido_1_11_1;
						}
																		
				    }					
				}

				for ($x=0; $x <= $NumColumn_ReportConfigEUtraBadCovPrim; $x++) {
					$nombre_campo_ReportConfigEUtraBadCovPrim = $ReportConfigEUtraBadCovPrim->getCellByColumnAndRow($x,1)->getValue();					
					if($nombre_campo_ReportConfigEUtraBadCovPrim=="EUtranCellFDD"){
						$valor_campo1 = $ReportConfigEUtraBadCovPrim->getCellByColumnAndRow($x,$i)->getValue();
				    }

					if($nombre_campo_ReportConfigEUtraBadCovPrim=="timeToTriggerA2Prim"){						
						$valor_campo2 = $ReportConfigEUtraBadCovPrim->getCellByColumnAndRow($x,$i)->getValue();
						if(!empty($valor_campo1)){
							$continido_1_11_1 ='
set EUtranCellFDD='.$valor_campo1.',UeMeasControl=1,ReportConfigEUtraBadCovPrim=1 timeToTriggerA2Prim '.$valor_campo2;
							$continido_19_11[] = $continido_1_11_1;
						}
																		
				    }					
				}
			}
			
			$ReportConfigEUtraBadCovSec = $RND->getSheet($name_h_rnd_ReportConfigEUtraBadCovSec);//esto es para la 1 parte del archivo 11.6
			$filas_ReportConfigEUtraBadCovSec_rnd  = $ReportConfigEUtraBadCovSec ->getHighestRow(); 
			$Column_ReportConfigEUtraBadCovSec_rnd = $ReportConfigEUtraBadCovSec ->getHighestColumn();
			$NumColumn_ReportConfigEUtraBadCovSec  = PHPExcel_Cell::columnIndexFromString($Column_ReportConfigEUtraBadCovSec_rnd);
			for ($i=2; $i <=$filas_ReportConfigEUtraBadCovSec_rnd; $i++) { 
				for ($x=0; $x <= $NumColumn_ReportConfigEUtraBadCovSec; $x++) {
					$nombre_campo_ReportConfigEUtraBadCovSec = $ReportConfigEUtraBadCovSec->getCellByColumnAndRow($x,1)->getValue();					
					if($nombre_campo_ReportConfigEUtraBadCovSec=="EUtranCellFDD"){
						$valor_campo1 = $ReportConfigEUtraBadCovSec->getCellByColumnAndRow($x,$i)->getValue();
				    }

					if($nombre_campo_ReportConfigEUtraBadCovSec=="timeToTriggerA2Sec"){						
						$valor_campo2 = $ReportConfigEUtraBadCovSec->getCellByColumnAndRow($x,$i)->getValue();
						if(!empty($valor_campo1)){
							$continido_1_11_1 ='
set EUtranCellFDD='.$valor_campo1.',UeMeasControl=1,ReportConfigEUtraBadCovSec=1 timeToTriggerA2Sec '.$valor_campo2;
							$continido_20_11[] = $continido_1_11_1;
						}
																		
				    }					
				}

				for ($x=0; $x <= $NumColumn_ReportConfigEUtraBadCovSec; $x++) {
					$nombre_campo_ReportConfigEUtraBadCovSec = $ReportConfigEUtraBadCovSec->getCellByColumnAndRow($x,1)->getValue();					
					if($nombre_campo_ReportConfigEUtraBadCovSec=="EUtranCellFDD"){
						$valor_campo1 = $ReportConfigEUtraBadCovSec->getCellByColumnAndRow($x,$i)->getValue();
				    }

					if($nombre_campo_ReportConfigEUtraBadCovSec=="triggerQuantityA2Sec"){						
						$valor_campo2 = $ReportConfigEUtraBadCovSec->getCellByColumnAndRow($x,$i)->getValue();
						if(!empty($valor_campo1)){
							$continido_1_11_1 ='
set EUtranCellFDD='.$valor_campo1.',UeMeasControl=1,ReportConfigEUtraBadCovSec=1 triggerQuantityA2Sec '.$valor_campo2;
							$continido_21_11[] = $continido_1_11_1;
						}
																		
				    }					
				}
			}

			$ReportConfigEUtraBestCell = $RND->getSheet($name_h_rnd_ReportConfigEUtraBestCell);//esto es para la 1 parte del archivo 11.6
			$filas_ReportConfigEUtraBestCell_rnd  = $ReportConfigEUtraBestCell ->getHighestRow(); 
			$Column_ReportConfigEUtraBestCell_rnd = $ReportConfigEUtraBestCell ->getHighestColumn();
			$NumColumn_ReportConfigEUtraBestCell  = PHPExcel_Cell::columnIndexFromString($Column_ReportConfigEUtraBestCell_rnd);
			for ($i=2; $i <=$filas_ReportConfigEUtraBestCell_rnd; $i++) { 
				for ($x=0; $x <= $NumColumn_ReportConfigEUtraBestCell; $x++) {
					$nombre_campo_ReportConfigEUtraBestCell = $ReportConfigEUtraBestCell->getCellByColumnAndRow($x,1)->getValue();					
					if($nombre_campo_ReportConfigEUtraBestCell=="EUtranCellFDD"){
						$valor_campo1 = $ReportConfigEUtraBestCell->getCellByColumnAndRow($x,$i)->getValue();
				    }

					if($nombre_campo_ReportConfigEUtraBestCell=="timeToTriggerA3"){						
						$valor_campo2 = $ReportConfigEUtraBestCell->getCellByColumnAndRow($x,$i)->getValue();
						if(!empty($valor_campo1)){
							$continido_1_11_1 ='
set EUtranCellFDD='.$valor_campo1.',UeMeasControl=1,ReportConfigEUtraBestCell=1 timeToTriggerA3 '.$valor_campo2;
							$continido_22_11[] = $continido_1_11_1;
						}
																		
				    }					
				}
			}

			$ReportConfigEUtraBestCellAnr = $RND->getSheet($name_h_rnd_ReportConfigEUtraBestCellAnr);//esto es para la 1 parte del archivo 11.6
			$filas_ReportConfigEUtraBestCellAnr_rnd  = $ReportConfigEUtraBestCellAnr ->getHighestRow(); 
			$Column_ReportConfigEUtraBestCellAnr_rnd = $ReportConfigEUtraBestCellAnr ->getHighestColumn();
			$NumColumn_ReportConfigEUtraBestCellAnr  = PHPExcel_Cell::columnIndexFromString($Column_ReportConfigEUtraBestCellAnr_rnd);
			for ($i=2; $i <=$filas_ReportConfigEUtraBestCellAnr_rnd; $i++) { 
				for ($x=0; $x <= $NumColumn_ReportConfigEUtraBestCellAnr; $x++) {
					$nombre_campo_ReportConfigEUtraBestCellAnr = $ReportConfigEUtraBestCellAnr->getCellByColumnAndRow($x,1)->getValue();					
					if($nombre_campo_ReportConfigEUtraBestCellAnr=="EUtranCellFDD"){
						$valor_campo1 = $ReportConfigEUtraBestCellAnr->getCellByColumnAndRow($x,$i)->getValue();
				    }

					if($nombre_campo_ReportConfigEUtraBestCellAnr=="timeToTriggerA3"){						
						$valor_campo2 = $ReportConfigEUtraBestCellAnr->getCellByColumnAndRow($x,$i)->getValue();
						if(!empty($valor_campo1)){
							$continido_1_11_1 ='
set EUtranCellFDD='.$valor_campo1.',UeMeasControl=1,ReportConfigEUtraBestCellAnr=1 timeToTriggerA3 '.$valor_campo2;
							$continido_23_11[] = $continido_1_11_1;
						}
																		
				    }					
				}
			}
			
			$ReportConfigSearch = $RND->getSheet($name_h_rnd_ReportConfigSearch);//esto es para la 1 parte del archivo 11.6
			$filas_ReportConfigSearch_rnd  = $ReportConfigSearch ->getHighestRow(); 
			$Column_ReportConfigSearch_rnd = $ReportConfigSearch ->getHighestColumn();
			$NumColumn_ReportConfigSearch  = PHPExcel_Cell::columnIndexFromString($Column_ReportConfigSearch_rnd);
			for ($i=2; $i <=$filas_ReportConfigSearch_rnd; $i++) { 
				for ($x=0; $x <= $NumColumn_ReportConfigSearch; $x++) {
					$nombre_campo_ReportConfigSearch = $ReportConfigSearch->getCellByColumnAndRow($x,1)->getValue();					
					if($nombre_campo_ReportConfigSearch=="EUtranCellFDD"){
						$valor_campo1 = $ReportConfigSearch->getCellByColumnAndRow($x,$i)->getValue();
				    }

					if($nombre_campo_ReportConfigSearch=="a1a2SearchThresholdRsrp"){						
						$valor_campo2 = $ReportConfigSearch->getCellByColumnAndRow($x,$i)->getValue();
						if(!empty($valor_campo1)){
							$continido_1_11_1 ='
set EUtranCellFDD='.$valor_campo1.',UeMeasControl=1,ReportConfigSearch=1 a1a2SearchThresholdRsrp '.$valor_campo2;
							$continido_24_11[] = $continido_1_11_1;
						}
																		
				    }					
				}

				for ($x=0; $x <= $NumColumn_ReportConfigSearch; $x++) {
					$nombre_campo_ReportConfigSearch = $ReportConfigSearch->getCellByColumnAndRow($x,1)->getValue();					
					if($nombre_campo_ReportConfigSearch=="EUtranCellFDD"){
						$valor_campo1 = $ReportConfigSearch->getCellByColumnAndRow($x,$i)->getValue();
				    }

					if($nombre_campo_ReportConfigSearch=="a1a2SearchThresholdRsrq"){						
						$valor_campo2 = $ReportConfigSearch->getCellByColumnAndRow($x,$i)->getValue();
						if(!empty($valor_campo1)){
							$continido_1_11_1 ='
set EUtranCellFDD='.$valor_campo1.',UeMeasControl=1,ReportConfigSearch=1 a1a2SearchThresholdRsrq '.$valor_campo2;
							$continido_25_11[] = $continido_1_11_1;
						}
																		
				    }					
				}

				for ($x=0; $x <= $NumColumn_ReportConfigSearch; $x++) {
					$nombre_campo_ReportConfigSearch = $ReportConfigSearch->getCellByColumnAndRow($x,1)->getValue();					
					if($nombre_campo_ReportConfigSearch=="EUtranCellFDD"){
						$valor_campo1 = $ReportConfigSearch->getCellByColumnAndRow($x,$i)->getValue();
				    }

					if($nombre_campo_ReportConfigSearch=="a2CriticalThresholdRsrp"){						
						$valor_campo2 = $ReportConfigSearch->getCellByColumnAndRow($x,$i)->getValue();
						if(!empty($valor_campo1)){
							$continido_1_11_1 ='
set EUtranCellFDD='.$valor_campo1.',UeMeasControl=1,ReportConfigSearch=1 a2CriticalThresholdRsrp '.$valor_campo2;
							$continido_26_11[] = $continido_1_11_1;
						}
																		
				    }					
				}

				for ($x=0; $x <= $NumColumn_ReportConfigSearch; $x++) {
					$nombre_campo_ReportConfigSearch = $ReportConfigSearch->getCellByColumnAndRow($x,1)->getValue();					
					if($nombre_campo_ReportConfigSearch=="EUtranCellFDD"){
						$valor_campo1 = $ReportConfigSearch->getCellByColumnAndRow($x,$i)->getValue();
				    }

					if($nombre_campo_ReportConfigSearch=="hysteresisA1A2SearchRsrp"){						
						$valor_campo2 = $ReportConfigSearch->getCellByColumnAndRow($x,$i)->getValue();
						if(!empty($valor_campo1)){
							$continido_1_11_1 ='
set EUtranCellFDD='.$valor_campo1.',UeMeasControl=1,ReportConfigSearch=1 hysteresisA1A2SearchRsrp '.$valor_campo2;
							$continido_27_11[] = $continido_1_11_1;
						}
																		
				    }					
				}

				for ($x=0; $x <= $NumColumn_ReportConfigSearch; $x++) {
					$nombre_campo_ReportConfigSearch = $ReportConfigSearch->getCellByColumnAndRow($x,1)->getValue();					
					if($nombre_campo_ReportConfigSearch=="EUtranCellFDD"){
						$valor_campo1 = $ReportConfigSearch->getCellByColumnAndRow($x,$i)->getValue();
				    }

					if($nombre_campo_ReportConfigSearch=="hysteresisA1A2SearchRsrq"){						
						$valor_campo2 = $ReportConfigSearch->getCellByColumnAndRow($x,$i)->getValue();
						if(!empty($valor_campo1)){
							$continido_1_11_1 ='
set EUtranCellFDD='.$valor_campo1.',UeMeasControl=1,ReportConfigSearch=1 hysteresisA1A2SearchRsrq '.$valor_campo2;
							$continido_28_11[] = $continido_1_11_1;
						}
																		
				    }					
				}

				for ($x=0; $x <= $NumColumn_ReportConfigSearch; $x++) {
					$nombre_campo_ReportConfigSearch = $ReportConfigSearch->getCellByColumnAndRow($x,1)->getValue();					
					if($nombre_campo_ReportConfigSearch=="EUtranCellFDD"){
						$valor_campo1 = $ReportConfigSearch->getCellByColumnAndRow($x,$i)->getValue();
				    }

					if($nombre_campo_ReportConfigSearch=="hysteresisA2CriticalRsrp"){						
						$valor_campo2 = $ReportConfigSearch->getCellByColumnAndRow($x,$i)->getValue();
						if(!empty($valor_campo1)){
							$continido_1_11_1 ='
set EUtranCellFDD='.$valor_campo1.',UeMeasControl=1,ReportConfigSearch=1 hysteresisA2CriticalRsrp '.$valor_campo2;
							$continido_29_11[] = $continido_1_11_1;
						}
																		
				    }					
				}

				for ($x=0; $x <= $NumColumn_ReportConfigSearch; $x++) {
					$nombre_campo_ReportConfigSearch = $ReportConfigSearch->getCellByColumnAndRow($x,1)->getValue();					
					if($nombre_campo_ReportConfigSearch=="EUtranCellFDD"){
						$valor_campo1 = $ReportConfigSearch->getCellByColumnAndRow($x,$i)->getValue();
				    }

					if($nombre_campo_ReportConfigSearch=="hysteresisA2CriticalRsrq"){						
						$valor_campo2 = $ReportConfigSearch->getCellByColumnAndRow($x,$i)->getValue();
						if(!empty($valor_campo1)){
							$continido_1_11_1 ='
set EUtranCellFDD='.$valor_campo1.',UeMeasControl=1,ReportConfigSearch=1 hysteresisA2CriticalRsrq '.$valor_campo2;
							$continido_30_11[] = $continido_1_11_1;
						}
																		
				    }					
				}

				for ($x=0; $x <= $NumColumn_ReportConfigSearch; $x++) {
					$nombre_campo_ReportConfigSearch = $ReportConfigSearch->getCellByColumnAndRow($x,1)->getValue();					
					if($nombre_campo_ReportConfigSearch=="EUtranCellFDD"){
						$valor_campo1 = $ReportConfigSearch->getCellByColumnAndRow($x,$i)->getValue();
				    }

					if($nombre_campo_ReportConfigSearch=="inhibitA2SearchConfig"){						
						$valor_campo2 = $ReportConfigSearch->getCellByColumnAndRow($x,$i)->getValue();
						if(!empty($valor_campo1)){
							$continido_1_11_1 ='
set EUtranCellFDD='.$valor_campo1.',UeMeasControl=1,ReportConfigSearch=1 inhibitA2SearchConfig '.$valor_campo2;
							$continido_31_11[] = $continido_1_11_1;
						}
																		
				    }					
				}
			}
			
			$ReportConfigSCellA1A2 = $RND->getSheet($name_h_rnd_ReportConfigSCellA1A2);//esto es para la 1 parte del archivo 11.6
			$filas_ReportConfigSCellA1A2_rnd  = $ReportConfigSCellA1A2 ->getHighestRow(); 
			$Column_ReportConfigSCellA1A2_rnd = $ReportConfigSCellA1A2 ->getHighestColumn();
			$NumColumn_ReportConfigSCellA1A2  = PHPExcel_Cell::columnIndexFromString($Column_ReportConfigSCellA1A2_rnd);
			for ($i=2; $i <=$filas_ReportConfigSCellA1A2_rnd; $i++) { 
				for ($x=0; $x <= $NumColumn_ReportConfigSCellA1A2; $x++) {
					$nombre_campo_ReportConfigSCellA1A2 = $ReportConfigSCellA1A2->getCellByColumnAndRow($x,1)->getValue();					
					if($nombre_campo_ReportConfigSCellA1A2=="EUtranCellFDD"){
						$valor_campo1 = $ReportConfigSCellA1A2->getCellByColumnAndRow($x,$i)->getValue();
				    }

					if($nombre_campo_ReportConfigSCellA1A2=="hysteresisA1A2Rsrp"){						
						$valor_campo2 = $ReportConfigSCellA1A2->getCellByColumnAndRow($x,$i)->getValue();
						if(!empty($valor_campo1)){
							$continido_1_11_1 ='
set EUtranCellFDD='.$valor_campo1.',UeMeasControl=1,ReportConfigSCellA1A2=1 hysteresisA1A2Rsrp '.$valor_campo2;
							$continido_32_11[] = $continido_1_11_1;
						}
																		
				    }					
				}
			}

			$RetSubUnit = $RND->getSheet($name_h_rnd_RetSubUnit);//esto es para la 1 parte del archivo 11.6
			$filas_name_h_rnd_RetSubUnit_rnd  = $RetSubUnit ->getHighestRow(); 
			$Column_name_h_rnd_RetSubUnit_rnd = $RetSubUnit ->getHighestColumn();
			$NumColumn_name_h_rnd_RetSubUnit  = PHPExcel_Cell::columnIndexFromString($Column_name_h_rnd_RetSubUnit_rnd);
			for ($i=2; $i <=$filas_name_h_rnd_RetSubUnit_rnd; $i++) {
				for ($x=0; $x <= $NumColumn_name_h_rnd_RetSubUnit; $x++) {
					$nombre_campo_ReportConfigEUtraBestCell = $ReportConfigEUtraBestCell->getCellByColumnAndRow($x,1)->getValue();
					$nombre_campo_RetSubUnit = $RetSubUnit->getCellByColumnAndRow($x,1)->getValue();					
					if($nombre_campo_ReportConfigEUtraBestCell=="EUtranCellFDD"){
						$name_EUtranCellFDD =  $nombre_campo_ReportConfigEUtraBestCell;
						$valor_campo1 = $ReportConfigEUtraBestCell->getCellByColumnAndRow($x,$i)->getValue();						
				    }

				    if($nombre_campo_RetSubUnit=="AntennaUnitGroup"){
				    	$name_iuantAntennaBearing = $nombre_campo_RetSubUnit;
						$valor_campo2 = $RetSubUnit->getCellByColumnAndRow($x,$i)->getValue();
						if(!empty($valor_campo2)){
							$AntennaUnitGroup = $valor_campo2;
						}
				    }

				    if($nombre_campo_RetSubUnit=="AntennaNearUnit"){
				    	$name_iuantAntennaBearing = $nombre_campo_RetSubUnit;
						$valor_campo2 = $RetSubUnit->getCellByColumnAndRow($x,$i)->getValue();
						if(!empty($valor_campo2)){
							$AntennaNearUnit = $valor_campo2;
						}
				    }

				    if($nombre_campo_RetSubUnit == "iuantAntennaBearing"){
				    	$name_iuantAntennaBearing = $nombre_campo_RetSubUnit;
						$valor_campo2 = $RetSubUnit->getCellByColumnAndRow($x,$i)->getValue();
						if(!empty($valor_campo2)){
								if($AntennaNearUnit == 1){											
									$continido_1_11_1 ='
set AntennaUnitGroup='.$AntennaUnitGroup.',AntennaNearUnit='.$AntennaNearUnit.',RetSubUnit=1 '.$name_iuantAntennaBearing.' '.$valor_campo2;
									$continido_33_11[] = $continido_1_11_1;
								}
						}
				    }
				}
			}

			$RetSubUnit = $RND->getSheet($name_h_rnd_RetSubUnit);//esto es para la 1 parte del archivo 11.6
			$filas_name_h_rnd_RetSubUnit_rnd  = $RetSubUnit ->getHighestRow(); 
			$Column_name_h_rnd_RetSubUnit_rnd = $RetSubUnit ->getHighestColumn();
			$NumColumn_name_h_rnd_RetSubUnit  = PHPExcel_Cell::columnIndexFromString($Column_name_h_rnd_RetSubUnit_rnd);
			for ($i=2; $i <=$filas_name_h_rnd_RetSubUnit_rnd; $i++) {
				for ($x=0; $x <= $NumColumn_name_h_rnd_RetSubUnit; $x++) {
					$nombre_campo_ReportConfigEUtraBestCell = $ReportConfigEUtraBestCell->getCellByColumnAndRow($x,1)->getValue();
					$nombre_campo_RetSubUnit = $RetSubUnit->getCellByColumnAndRow($x,1)->getValue();					
					if($nombre_campo_ReportConfigEUtraBestCell=="EUtranCellFDD"){
						$name_EUtranCellFDD =  $nombre_campo_ReportConfigEUtraBestCell;
						$valor_campo1 = $ReportConfigEUtraBestCell->getCellByColumnAndRow($x,$i)->getValue();						
				    }

				    if($nombre_campo_RetSubUnit=="AntennaUnitGroup"){
				    	$name_iuantAntennaBearing = $nombre_campo_RetSubUnit;
						$valor_campo2 = $RetSubUnit->getCellByColumnAndRow($x,$i)->getValue();
						if(!empty($valor_campo2)){
							$AntennaUnitGroup = $valor_campo2;
						}
				    }

				    if($nombre_campo_RetSubUnit=="AntennaNearUnit"){
				    	$name_iuantAntennaBearing = $nombre_campo_RetSubUnit;
						$valor_campo2 = $RetSubUnit->getCellByColumnAndRow($x,$i)->getValue();
						if(!empty($valor_campo2)){
							$AntennaNearUnit = $valor_campo2;
						}
				    }

				    if($nombre_campo_RetSubUnit == "iuantSectorId"){
				    	$name_iuantAntennaBearing = $nombre_campo_RetSubUnit;
						$valor_campo2 = $RetSubUnit->getCellByColumnAndRow($x,$i)->getValue();
						if(!empty($valor_campo2)){
								if($AntennaNearUnit == 1){											
									$continido_1_11_1 ='
set AntennaUnitGroup='.$AntennaUnitGroup.',AntennaNearUnit='.$AntennaNearUnit.',RetSubUnit=1 '.$name_iuantAntennaBearing.' '.$valor_campo2;
									$continido_33_11[] .= $continido_1_11_1;
								}
						}
				    }
				}
			}
			$RetSubUnit = $RND->getSheet($name_h_rnd_RetSubUnit);//esto es para la 1 parte del archivo 11.6
			$filas_name_h_rnd_RetSubUnit_rnd  = $RetSubUnit ->getHighestRow(); 
			$Column_name_h_rnd_RetSubUnit_rnd = $RetSubUnit ->getHighestColumn();
			$NumColumn_name_h_rnd_RetSubUnit  = PHPExcel_Cell::columnIndexFromString($Column_name_h_rnd_RetSubUnit_rnd);
			for ($i=2; $i <=$filas_name_h_rnd_RetSubUnit_rnd; $i++) {
				for ($x=0; $x <= $NumColumn_name_h_rnd_RetSubUnit; $x++) {
					$nombre_campo_ReportConfigEUtraBestCell = $ReportConfigEUtraBestCell->getCellByColumnAndRow($x,1)->getValue();
					$nombre_campo_RetSubUnit = $RetSubUnit->getCellByColumnAndRow($x,1)->getValue();					
					if($nombre_campo_ReportConfigEUtraBestCell=="EUtranCellFDD"){
						$name_EUtranCellFDD =  $nombre_campo_ReportConfigEUtraBestCell;
						$valor_campo1 = $ReportConfigEUtraBestCell->getCellByColumnAndRow($x,$i)->getValue();						
				    }

				    if($nombre_campo_RetSubUnit=="AntennaUnitGroup"){
				    	$name_iuantAntennaBearing = $nombre_campo_RetSubUnit;
						$valor_campo2 = $RetSubUnit->getCellByColumnAndRow($x,$i)->getValue();
						if(!empty($valor_campo2)){
							$AntennaUnitGroup = $valor_campo2;
						}
				    }

				    if($nombre_campo_RetSubUnit=="AntennaNearUnit"){
				    	$name_iuantAntennaBearing = $nombre_campo_RetSubUnit;
						$valor_campo2 = $RetSubUnit->getCellByColumnAndRow($x,$i)->getValue();
						if(!empty($valor_campo2)){
							$AntennaNearUnit = $valor_campo2;
						}
				    }

				    if($nombre_campo_RetSubUnit == "iuantAntennaBearing"){
				    	$name_iuantAntennaBearing = $nombre_campo_RetSubUnit;
						$valor_campo2 = $RetSubUnit->getCellByColumnAndRow($x,$i)->getValue();
						if(!empty($valor_campo2)){
								if($AntennaNearUnit == 2){											
									$continido_1_11_1 ='
set AntennaUnitGroup='.$AntennaUnitGroup.',AntennaNearUnit='.$AntennaNearUnit.',RetSubUnit=1 '.$name_iuantAntennaBearing.' '.$valor_campo2;
									$continido_33_11[] = $continido_1_11_1;
								}
						}
				    }
				}
			}

			$RetSubUnit = $RND->getSheet($name_h_rnd_RetSubUnit);//esto es para la 1 parte del archivo 11.6
			$filas_name_h_rnd_RetSubUnit_rnd  = $RetSubUnit ->getHighestRow(); 
			$Column_name_h_rnd_RetSubUnit_rnd = $RetSubUnit ->getHighestColumn();
			$NumColumn_name_h_rnd_RetSubUnit  = PHPExcel_Cell::columnIndexFromString($Column_name_h_rnd_RetSubUnit_rnd);
			for ($i=2; $i <=$filas_name_h_rnd_RetSubUnit_rnd; $i++) {
				for ($x=0; $x <= $NumColumn_name_h_rnd_RetSubUnit; $x++) {
					$nombre_campo_ReportConfigEUtraBestCell = $ReportConfigEUtraBestCell->getCellByColumnAndRow($x,1)->getValue();
					$nombre_campo_RetSubUnit = $RetSubUnit->getCellByColumnAndRow($x,1)->getValue();					
					if($nombre_campo_ReportConfigEUtraBestCell=="EUtranCellFDD"){
						$name_EUtranCellFDD =  $nombre_campo_ReportConfigEUtraBestCell;
						$valor_campo1 = $ReportConfigEUtraBestCell->getCellByColumnAndRow($x,$i)->getValue();						
				    }

				    if($nombre_campo_RetSubUnit=="AntennaUnitGroup"){
				    	$name_iuantAntennaBearing = $nombre_campo_RetSubUnit;
						$valor_campo2 = $RetSubUnit->getCellByColumnAndRow($x,$i)->getValue();
						if(!empty($valor_campo2)){
							$AntennaUnitGroup = $valor_campo2;
						}
				    }

				    if($nombre_campo_RetSubUnit=="AntennaNearUnit"){
				    	$name_iuantAntennaBearing = $nombre_campo_RetSubUnit;
						$valor_campo2 = $RetSubUnit->getCellByColumnAndRow($x,$i)->getValue();
						if(!empty($valor_campo2)){
							$AntennaNearUnit = $valor_campo2;
						}
				    }

				    if($nombre_campo_RetSubUnit == "iuantSectorId"){
				    	$name_iuantAntennaBearing = $nombre_campo_RetSubUnit;
						$valor_campo2 = $RetSubUnit->getCellByColumnAndRow($x,$i)->getValue();
						if(!empty($valor_campo2)){
								if($AntennaNearUnit == 2){											
									$continido_1_11_1 ='
set AntennaUnitGroup='.$AntennaUnitGroup.',AntennaNearUnit='.$AntennaNearUnit.',RetSubUnit=1 '.$name_iuantAntennaBearing.' '.$valor_campo2;
									$continido_33_11[] .= $continido_1_11_1;
								}
						}
				    }
				}
			}
			$RetSubUnit = $RND->getSheet($name_h_rnd_RetSubUnit);//esto es para la 1 parte del archivo 11.6
			$filas_name_h_rnd_RetSubUnit_rnd  = $RetSubUnit ->getHighestRow(); 
			$Column_name_h_rnd_RetSubUnit_rnd = $RetSubUnit ->getHighestColumn();
			$NumColumn_name_h_rnd_RetSubUnit  = PHPExcel_Cell::columnIndexFromString($Column_name_h_rnd_RetSubUnit_rnd);
			for ($i=2; $i <=$filas_name_h_rnd_RetSubUnit_rnd; $i++) {
				for ($x=0; $x <= $NumColumn_name_h_rnd_RetSubUnit; $x++) {
					$nombre_campo_ReportConfigEUtraBestCell = $ReportConfigEUtraBestCell->getCellByColumnAndRow($x,1)->getValue();
					$nombre_campo_RetSubUnit = $RetSubUnit->getCellByColumnAndRow($x,1)->getValue();					
					if($nombre_campo_ReportConfigEUtraBestCell=="EUtranCellFDD"){
						$name_EUtranCellFDD =  $nombre_campo_ReportConfigEUtraBestCell;
						$valor_campo1 = $ReportConfigEUtraBestCell->getCellByColumnAndRow($x,$i)->getValue();						
				    }

				    if($nombre_campo_RetSubUnit=="AntennaUnitGroup"){
				    	$name_iuantAntennaBearing = $nombre_campo_RetSubUnit;
						$valor_campo2 = $RetSubUnit->getCellByColumnAndRow($x,$i)->getValue();
						if(!empty($valor_campo2)){
							$AntennaUnitGroup = $valor_campo2;
						}
				    }

				    if($nombre_campo_RetSubUnit=="AntennaNearUnit"){
				    	$name_iuantAntennaBearing = $nombre_campo_RetSubUnit;
						$valor_campo2 = $RetSubUnit->getCellByColumnAndRow($x,$i)->getValue();
						if(!empty($valor_campo2)){
							$AntennaNearUnit = $valor_campo2;
						}
				    }

				    if($nombre_campo_RetSubUnit == "iuantAntennaBearing"){
				    	$name_iuantAntennaBearing = $nombre_campo_RetSubUnit;
						$valor_campo2 = $RetSubUnit->getCellByColumnAndRow($x,$i)->getValue();
						if(!empty($valor_campo2)){
								if($AntennaNearUnit == 3){											
									$continido_1_11_1 ='
set AntennaUnitGroup='.$AntennaUnitGroup.',AntennaNearUnit='.$AntennaNearUnit.',RetSubUnit=1 '.$name_iuantAntennaBearing.' '.$valor_campo2;
									$continido_33_11[] = $continido_1_11_1;
								}
						}
				    }
				}
			}

			$RetSubUnit = $RND->getSheet($name_h_rnd_RetSubUnit);//esto es para la 1 parte del archivo 11.6
			$filas_name_h_rnd_RetSubUnit_rnd  = $RetSubUnit ->getHighestRow(); 
			$Column_name_h_rnd_RetSubUnit_rnd = $RetSubUnit ->getHighestColumn();
			$NumColumn_name_h_rnd_RetSubUnit  = PHPExcel_Cell::columnIndexFromString($Column_name_h_rnd_RetSubUnit_rnd);
			for ($i=2; $i <=$filas_name_h_rnd_RetSubUnit_rnd; $i++) {
				for ($x=0; $x <= $NumColumn_name_h_rnd_RetSubUnit; $x++) {
					$nombre_campo_ReportConfigEUtraBestCell = $ReportConfigEUtraBestCell->getCellByColumnAndRow($x,1)->getValue();
					$nombre_campo_RetSubUnit = $RetSubUnit->getCellByColumnAndRow($x,1)->getValue();					
					if($nombre_campo_ReportConfigEUtraBestCell=="EUtranCellFDD"){
						$name_EUtranCellFDD =  $nombre_campo_ReportConfigEUtraBestCell;
						$valor_campo1 = $ReportConfigEUtraBestCell->getCellByColumnAndRow($x,$i)->getValue();						
				    }

				    if($nombre_campo_RetSubUnit=="AntennaUnitGroup"){
				    	$name_iuantAntennaBearing = $nombre_campo_RetSubUnit;
						$valor_campo2 = $RetSubUnit->getCellByColumnAndRow($x,$i)->getValue();
						if(!empty($valor_campo2)){
							$AntennaUnitGroup = $valor_campo2;
						}
				    }

				    if($nombre_campo_RetSubUnit=="AntennaNearUnit"){
				    	$name_iuantAntennaBearing = $nombre_campo_RetSubUnit;
						$valor_campo2 = $RetSubUnit->getCellByColumnAndRow($x,$i)->getValue();
						if(!empty($valor_campo2)){
							$AntennaNearUnit = $valor_campo2;
						}
				    }

				    if($nombre_campo_RetSubUnit == "iuantSectorId"){
				    	$name_iuantAntennaBearing = $nombre_campo_RetSubUnit;
						$valor_campo2 = $RetSubUnit->getCellByColumnAndRow($x,$i)->getValue();
						if(!empty($valor_campo2)){
								if($AntennaNearUnit == 3){											
									$continido_1_11_1 ='
set AntennaUnitGroup='.$AntennaUnitGroup.',AntennaNearUnit='.$AntennaNearUnit.',RetSubUnit=1 '.$name_iuantAntennaBearing.' '.$valor_campo2;
									$continido_33_11[] .= $continido_1_11_1;
								}
						}
				    }
				}
			}

			$RetSubUnit = $RND->getSheet($name_h_rnd_RetSubUnit);//esto es para la 1 parte del archivo 11.6
			$filas_name_h_rnd_RetSubUnit_rnd  = $RetSubUnit ->getHighestRow(); 
			$Column_name_h_rnd_RetSubUnit_rnd = $RetSubUnit ->getHighestColumn();
			$NumColumn_name_h_rnd_RetSubUnit  = PHPExcel_Cell::columnIndexFromString($Column_name_h_rnd_RetSubUnit_rnd);
			for ($i=2; $i <=$filas_name_h_rnd_RetSubUnit_rnd; $i++) {
				for ($x=0; $x <= $NumColumn_name_h_rnd_RetSubUnit; $x++) {
					$nombre_campo_ReportConfigEUtraBestCell = $ReportConfigEUtraBestCell->getCellByColumnAndRow($x,1)->getValue();
					$nombre_campo_RetSubUnit = $RetSubUnit->getCellByColumnAndRow($x,1)->getValue();					
					if($nombre_campo_ReportConfigEUtraBestCell=="EUtranCellFDD"){
						$name_EUtranCellFDD =  $nombre_campo_ReportConfigEUtraBestCell;
						$valor_campo1 = $ReportConfigEUtraBestCell->getCellByColumnAndRow($x,$i)->getValue();						
				    }

				    if($nombre_campo_RetSubUnit=="AntennaUnitGroup"){
				    	$name_iuantAntennaBearing = $nombre_campo_RetSubUnit;
						$valor_campo2 = $RetSubUnit->getCellByColumnAndRow($x,$i)->getValue();
						if(!empty($valor_campo2)){
							$AntennaUnitGroup = $valor_campo2;
						}
				    }

				    if($nombre_campo_RetSubUnit=="AntennaNearUnit"){
				    	$name_iuantAntennaBearing = $nombre_campo_RetSubUnit;
						$valor_campo2 = $RetSubUnit->getCellByColumnAndRow($x,$i)->getValue();
						if(!empty($valor_campo2)){
							$AntennaNearUnit = $valor_campo2;
						}
				    }

				    if($nombre_campo_RetSubUnit == "iuantAntennaBearing"){
				    	$name_iuantAntennaBearing = $nombre_campo_RetSubUnit;
						$valor_campo2 = $RetSubUnit->getCellByColumnAndRow($x,$i)->getValue();
						if(!empty($valor_campo2)){
								if($AntennaNearUnit == 4){											
									$continido_1_11_1 ='
set AntennaUnitGroup='.$AntennaUnitGroup.',AntennaNearUnit='.$AntennaNearUnit.',RetSubUnit=1 '.$name_iuantAntennaBearing.' '.$valor_campo2;
									$continido_33_11[] = $continido_1_11_1;
								}
						}
				    }
				}
			}

			$RetSubUnit = $RND->getSheet($name_h_rnd_RetSubUnit);//esto es para la 1 parte del archivo 11.6
			$filas_name_h_rnd_RetSubUnit_rnd  = $RetSubUnit ->getHighestRow(); 
			$Column_name_h_rnd_RetSubUnit_rnd = $RetSubUnit ->getHighestColumn();
			$NumColumn_name_h_rnd_RetSubUnit  = PHPExcel_Cell::columnIndexFromString($Column_name_h_rnd_RetSubUnit_rnd);
			for ($i=2; $i <=$filas_name_h_rnd_RetSubUnit_rnd; $i++) {
				for ($x=0; $x <= $NumColumn_name_h_rnd_RetSubUnit; $x++) {
					$nombre_campo_ReportConfigEUtraBestCell = $ReportConfigEUtraBestCell->getCellByColumnAndRow($x,1)->getValue();
					$nombre_campo_RetSubUnit = $RetSubUnit->getCellByColumnAndRow($x,1)->getValue();					
					if($nombre_campo_ReportConfigEUtraBestCell=="EUtranCellFDD"){
						$name_EUtranCellFDD =  $nombre_campo_ReportConfigEUtraBestCell;
						$valor_campo1 = $ReportConfigEUtraBestCell->getCellByColumnAndRow($x,$i)->getValue();						
				    }

				    if($nombre_campo_RetSubUnit=="AntennaUnitGroup"){
				    	$name_iuantAntennaBearing = $nombre_campo_RetSubUnit;
						$valor_campo2 = $RetSubUnit->getCellByColumnAndRow($x,$i)->getValue();
						if(!empty($valor_campo2)){
							$AntennaUnitGroup = $valor_campo2;
						}
				    }

				    if($nombre_campo_RetSubUnit=="AntennaNearUnit"){
				    	$name_iuantAntennaBearing = $nombre_campo_RetSubUnit;
						$valor_campo2 = $RetSubUnit->getCellByColumnAndRow($x,$i)->getValue();
						if(!empty($valor_campo2)){
							$AntennaNearUnit = $valor_campo2;
						}
				    }

				    if($nombre_campo_RetSubUnit == "iuantSectorId"){
				    	$name_iuantAntennaBearing = $nombre_campo_RetSubUnit;
						$valor_campo2 = $RetSubUnit->getCellByColumnAndRow($x,$i)->getValue();
						if(!empty($valor_campo2)){
								if($AntennaNearUnit == 4){											
									$continido_1_11_1 ='
set AntennaUnitGroup='.$AntennaUnitGroup.',AntennaNearUnit='.$AntennaNearUnit.',RetSubUnit=1 '.$name_iuantAntennaBearing.' '.$valor_campo2;
									$continido_33_11[] .= $continido_1_11_1;
								}
						}
				    }
				}
			}

			$RetSubUnit = $RND->getSheet($name_h_rnd_RetSubUnit);//esto es para la 1 parte del archivo 11.6
			$filas_name_h_rnd_RetSubUnit_rnd  = $RetSubUnit ->getHighestRow(); 
			$Column_name_h_rnd_RetSubUnit_rnd = $RetSubUnit ->getHighestColumn();
			$NumColumn_name_h_rnd_RetSubUnit  = PHPExcel_Cell::columnIndexFromString($Column_name_h_rnd_RetSubUnit_rnd);
			for ($i=2; $i <=$filas_name_h_rnd_RetSubUnit_rnd; $i++) {
				for ($x=0; $x <= $NumColumn_name_h_rnd_RetSubUnit; $x++) {
					$nombre_campo_ReportConfigEUtraBestCell = $ReportConfigEUtraBestCell->getCellByColumnAndRow($x,1)->getValue();
					$nombre_campo_RetSubUnit = $RetSubUnit->getCellByColumnAndRow($x,1)->getValue();					
					if($nombre_campo_ReportConfigEUtraBestCell=="EUtranCellFDD"){
						$name_EUtranCellFDD =  $nombre_campo_ReportConfigEUtraBestCell;
						$valor_campo1 = $ReportConfigEUtraBestCell->getCellByColumnAndRow($x,$i)->getValue();						
				    }

				    if($nombre_campo_RetSubUnit=="AntennaUnitGroup"){
				    	$name_iuantAntennaBearing = $nombre_campo_RetSubUnit;
						$valor_campo2 = $RetSubUnit->getCellByColumnAndRow($x,$i)->getValue();
						if(!empty($valor_campo2)){
							$AntennaUnitGroup = $valor_campo2;
						}
				    }

				    if($nombre_campo_RetSubUnit=="AntennaNearUnit"){
				    	$name_iuantAntennaBearing = $nombre_campo_RetSubUnit;
						$valor_campo2 = $RetSubUnit->getCellByColumnAndRow($x,$i)->getValue();
						if(!empty($valor_campo2)){
							$AntennaNearUnit = $valor_campo2;
						}
				    }

				    if($nombre_campo_RetSubUnit == "iuantAntennaBearing"){
				    	$name_iuantAntennaBearing = $nombre_campo_RetSubUnit;
						$valor_campo2 = $RetSubUnit->getCellByColumnAndRow($x,$i)->getValue();
						if(!empty($valor_campo2)){
								if($AntennaNearUnit == 5){											
									$continido_1_11_1 ='
set AntennaUnitGroup='.$AntennaUnitGroup.',AntennaNearUnit='.$AntennaNearUnit.',RetSubUnit=1 '.$name_iuantAntennaBearing.' '.$valor_campo2;
									$continido_33_11[] = $continido_1_11_1;
								}
						}
				    }
				}
			}

			$RetSubUnit = $RND->getSheet($name_h_rnd_RetSubUnit);//esto es para la 1 parte del archivo 11.6
			$filas_name_h_rnd_RetSubUnit_rnd  = $RetSubUnit ->getHighestRow(); 
			$Column_name_h_rnd_RetSubUnit_rnd = $RetSubUnit ->getHighestColumn();
			$NumColumn_name_h_rnd_RetSubUnit  = PHPExcel_Cell::columnIndexFromString($Column_name_h_rnd_RetSubUnit_rnd);
			for ($i=2; $i <=$filas_name_h_rnd_RetSubUnit_rnd; $i++) {
				for ($x=0; $x <= $NumColumn_name_h_rnd_RetSubUnit; $x++) {
					$nombre_campo_ReportConfigEUtraBestCell = $ReportConfigEUtraBestCell->getCellByColumnAndRow($x,1)->getValue();
					$nombre_campo_RetSubUnit = $RetSubUnit->getCellByColumnAndRow($x,1)->getValue();					
					if($nombre_campo_ReportConfigEUtraBestCell=="EUtranCellFDD"){
						$name_EUtranCellFDD =  $nombre_campo_ReportConfigEUtraBestCell;
						$valor_campo1 = $ReportConfigEUtraBestCell->getCellByColumnAndRow($x,$i)->getValue();						
				    }

				    if($nombre_campo_RetSubUnit=="AntennaUnitGroup"){
				    	$name_iuantAntennaBearing = $nombre_campo_RetSubUnit;
						$valor_campo2 = $RetSubUnit->getCellByColumnAndRow($x,$i)->getValue();
						if(!empty($valor_campo2)){
							$AntennaUnitGroup = $valor_campo2;
						}
				    }

				    if($nombre_campo_RetSubUnit=="AntennaNearUnit"){
				    	$name_iuantAntennaBearing = $nombre_campo_RetSubUnit;
						$valor_campo2 = $RetSubUnit->getCellByColumnAndRow($x,$i)->getValue();
						if(!empty($valor_campo2)){
							$AntennaNearUnit = $valor_campo2;
						}
				    }

				    if($nombre_campo_RetSubUnit == "iuantSectorId"){
				    	$name_iuantAntennaBearing = $nombre_campo_RetSubUnit;
						$valor_campo2 = $RetSubUnit->getCellByColumnAndRow($x,$i)->getValue();
						if(!empty($valor_campo2)){
								if($AntennaNearUnit == 5){											
									$continido_1_11_1 ='
set AntennaUnitGroup='.$AntennaUnitGroup.',AntennaNearUnit='.$AntennaNearUnit.',RetSubUnit=1 '.$name_iuantAntennaBearing.' '.$valor_campo2;
									$continido_33_11[] .= $continido_1_11_1;
								}
						}
				    }
				}
			}
			$RetSubUnit = $RND->getSheet($name_h_rnd_RetSubUnit);//esto es para la 1 parte del archivo 11.6
			$filas_name_h_rnd_RetSubUnit_rnd  = $RetSubUnit ->getHighestRow(); 
			$Column_name_h_rnd_RetSubUnit_rnd = $RetSubUnit ->getHighestColumn();
			$NumColumn_name_h_rnd_RetSubUnit  = PHPExcel_Cell::columnIndexFromString($Column_name_h_rnd_RetSubUnit_rnd);
			for ($i=2; $i <=$filas_name_h_rnd_RetSubUnit_rnd; $i++) {
				for ($x=0; $x <= $NumColumn_name_h_rnd_RetSubUnit; $x++) {
					$nombre_campo_ReportConfigEUtraBestCell = $ReportConfigEUtraBestCell->getCellByColumnAndRow($x,1)->getValue();
					$nombre_campo_RetSubUnit = $RetSubUnit->getCellByColumnAndRow($x,1)->getValue();					
					if($nombre_campo_ReportConfigEUtraBestCell=="EUtranCellFDD"){
						$name_EUtranCellFDD =  $nombre_campo_ReportConfigEUtraBestCell;
						$valor_campo1 = $ReportConfigEUtraBestCell->getCellByColumnAndRow($x,$i)->getValue();						
				    }

				    if($nombre_campo_RetSubUnit=="AntennaUnitGroup"){
				    	$name_iuantAntennaBearing = $nombre_campo_RetSubUnit;
						$valor_campo2 = $RetSubUnit->getCellByColumnAndRow($x,$i)->getValue();
						if(!empty($valor_campo2)){
							$AntennaUnitGroup = $valor_campo2;
						}
				    }

				    if($nombre_campo_RetSubUnit=="AntennaNearUnit"){
				    	$name_iuantAntennaBearing = $nombre_campo_RetSubUnit;
						$valor_campo2 = $RetSubUnit->getCellByColumnAndRow($x,$i)->getValue();
						if(!empty($valor_campo2)){
							$AntennaNearUnit = $valor_campo2;
						}
				    }

				    if($nombre_campo_RetSubUnit == "userLabel"){
				    	$name_iuantAntennaBearing = $nombre_campo_RetSubUnit;
						$valor_campo2 = $RetSubUnit->getCellByColumnAndRow($x,$i)->getValue();
						if(!empty($valor_campo2)){										
									$continido_1_11_1 ='
set AntennaUnitGroup='.$AntennaUnitGroup.',AntennaNearUnit='.$AntennaNearUnit.',RetSubUnit=1 '.$name_iuantAntennaBearing.' '.$valor_campo2;
									$continido_33_11[] .= $continido_1_11_1;
								
						}
				    }
				}
			}		
			
			$RfBranch = $RND->getSheet($name_h_rnd_RfBranch);//esto es para la 1 parte del archivo 11.6
			$filas_RfBranch_rnd  = $RfBranch ->getHighestRow(); 
			$Column_RfBranch_rnd = $RfBranch ->getHighestColumn();
			$NumColumn_RfBranch  = PHPExcel_Cell::columnIndexFromString($Column_RfBranch_rnd);
			for ($i=2; $i <=$filas_RfBranch_rnd; $i++) { 
				for ($x=0; $x <= $NumColumn_RfBranch; $x++) {
					$nombre_campo_RfBranch = $RfBranch->getCellByColumnAndRow($x,1)->getValue();
					if($nombre_campo_RfBranch=="AntennaUnitGroup"){
						$name_AntennaUnitGroup =  $nombre_campo_RfBranch;
						$valor_campo1 = $RfBranch->getCellByColumnAndRow($x,$i)->getValue();
				    }

				    if($nombre_campo_RfBranch=="RfBranch"){
						$valor_campo2 = $RfBranch->getCellByColumnAndRow($x,$i)->getValue();
				    }

					if($nombre_campo_RfBranch=="dlAttenuation"){						
						$valor_campo3 = $RfBranch->getCellByColumnAndRow($x,$i)->getValue();
						if(!empty($valor_campo1)){
							$continido_1_11_1 ='
set AntennaUnitGroup='.$valor_campo1.',RfBranch='.$valor_campo2.' dlAttenuation '.$valor_campo3;
							$continido_36_11[] = $continido_1_11_1;
						}
																		
				    }

				    if($nombre_campo_RfBranch=="dlTrafficDelay"){						
						$valor_campo3 = $RfBranch->getCellByColumnAndRow($x,$i)->getValue();
						if(!empty($valor_campo1)){
							$continido_1_11_1 ='
set AntennaUnitGroup='.$valor_campo1.',RfBranch='.$valor_campo2.' dlTrafficDelay '.$valor_campo3;
							$continido_37_11[] = $continido_1_11_1;
						}
																		
				    }

				    if($nombre_campo_RfBranch=="ulAttenuation"){						
						$valor_campo3 = $RfBranch->getCellByColumnAndRow($x,$i)->getValue();
						if(!empty($valor_campo1)){
							$continido_1_11_1 ='
set AntennaUnitGroup='.$valor_campo1.',RfBranch='.$valor_campo2.' ulAttenuation '.$valor_campo3;
							$continido_38_11[] = $continido_1_11_1;
						}
																		
				    }

				    if($nombre_campo_RfBranch=="ulTrafficDelay"){						
						$valor_campo3 = $RfBranch->getCellByColumnAndRow($x,$i)->getValue();
						if(!empty($valor_campo1)){
							$continido_1_11_1 ='
set AntennaUnitGroup='.$valor_campo1.',RfBranch='.$valor_campo2.' ulTrafficDelay '.$valor_campo3;
							$continido_39_11[] = $continido_1_11_1;
						}
																		
				    }

				    if($nombre_campo_RfBranch=="userLabel"){						
						$valor_campo3 = $RfBranch->getCellByColumnAndRow($x,$i)->getValue();
						if(!empty($valor_campo1)){
							$continido_1_11_1 ='
set AntennaUnitGroup='.$valor_campo1.',RfBranch='.$valor_campo2.' userLabel '.$valor_campo3;
							$continido_40_11[] = $continido_1_11_1;
						}
																		
				    }			
				}
			}
			
			$SectorCarrier = $RND->getSheet($name_h_rnd_SectorCarrier);//esto es para la 1 parte del archivo 11.6
			$filas_SectorCarrier_rnd  = $SectorCarrier ->getHighestRow(); 
			$Column_SectorCarrier_rnd = $SectorCarrier ->getHighestColumn();
			$NumColumn_SectorCarrier  = PHPExcel_Cell::columnIndexFromString($Column_SectorCarrier_rnd);
			for ($i=2; $i <=$filas_SectorCarrier_rnd; $i++) { 
				for ($x=0; $x <= $NumColumn_SectorCarrier; $x++) {
					$nombre_campo_SectorCarrier = $SectorCarrier->getCellByColumnAndRow($x,1)->getValue();

					if($nombre_campo_SectorCarrier=="SectorCarrier"){						
						$valor_campo1 = $SectorCarrier->getCellByColumnAndRow($x,$i)->getValue();
						if(!empty($valor_campo1)){
							$SectorCarrier_v = $valor_campo1;
						}
																		
				    }					
					
					if($nombre_campo_SectorCarrier=="maximumTransmissionPower"){						
						$valor_campo1 = $SectorCarrier->getCellByColumnAndRow($x,$i)->getValue();
						if(!empty($valor_campo1)){
							$continido_1_11_1 ='
set SectorCarrier='.$SectorCarrier_v.' maximumTransmissionPower '.$valor_campo1;
							$continido_41_11[] = $continido_1_11_1;
						}
																		
				    }					
				}
			}
			//Apartir de Aqui!!!!!!!
			$SectorEquipmentFunction = $RND->getSheet($name_h_rnd_SectorEquipmentFunction);//esto es para la 1 parte del archivo 11.6
			$filas_SectorEquipmentFunction_rnd  = $SectorEquipmentFunction ->getHighestRow(); 
			$Column_SectorEquipmentFunction_rnd = $SectorEquipmentFunction ->getHighestColumn();
			$NumColumn_SectorEquipmentFunction  = PHPExcel_Cell::columnIndexFromString($Column_SectorEquipmentFunction_rnd);
			for ($i=2; $i <=$filas_SectorEquipmentFunction_rnd; $i++) { 
				for ($x=0; $x <= $NumColumn_SectorEquipmentFunction; $x++) {
					$nombre_campo_SectorEquipmentFunction = $SectorEquipmentFunction->getCellByColumnAndRow($x,1)->getValue();
					if($nombre_campo_SectorEquipmentFunction=="SectorEquipmentFunction"){						
						$valor_campo1 = $SectorCarrier->getCellByColumnAndRow($x,$i)->getValue();
						if(!empty($valor_campo1)){
							$SectorEquipmentFunction_v = $valor_campo1;
						}
																		
				    }
					if($nombre_campo_SectorEquipmentFunction=="userLabel"){						
						$valor_campo1 = $SectorEquipmentFunction->getCellByColumnAndRow($x,$i)->getValue();
						if(!empty($valor_campo1)){
							$continido_1_11_1 ='
set SectorEquipmentFunction='.$SectorEquipmentFunction_v.' userLabel '.$valor_campo1;
							$continido_42_11[] = $continido_1_11_1;
						}
																		
				    }					
				}
			}

			$SecurityHandling = $RND->getSheet($name_h_rnd_SecurityHandling);//esto es para la 1 parte del archivo 11.6
			$filas_SecurityHandling_rnd  = $SecurityHandling ->getHighestRow(); 
			$Column_SecurityHandling_rnd = $SecurityHandling ->getHighestColumn();
			$NumColumn_SecurityHandling  = PHPExcel_Cell::columnIndexFromString($Column_SecurityHandling_rnd);
			for ($i=2; $i <=$filas_SecurityHandling_rnd; $i++) { 
				for ($x=0; $x <= $NumColumn_SecurityHandling; $x++) {
					$nombre_campo_SecurityHandling = $SecurityHandling->getCellByColumnAndRow($x,1)->getValue();					
					if($nombre_campo_SecurityHandling=="cipheringAlgoPrio"){						
						$valor_campo1 = $SecurityHandling->getCellByColumnAndRow($x,$i)->getValue();
						if(!empty($valor_campo1)){
							$continido_1_11_1 ='
set SecurityHandling=1 cipheringAlgoPrio '.$valor_campo1;
							$continido_43_11[] = $continido_1_11_1;
						}
																		
				    }					
				}
			}
			
			$UeMeasControl = $RND->getSheet($name_h_rnd_UeMeasControl);//esto es para la 1 parte del archivo 11.6
			$filas_UeMeasControl_rnd  = $UeMeasControl ->getHighestRow(); 
			$Column_UeMeasControl_rnd = $UeMeasControl ->getHighestColumn();
			$NumColumn_UeMeasControl  = PHPExcel_Cell::columnIndexFromString($Column_UeMeasControl_rnd);
			for ($i=2; $i <=$filas_UeMeasControl_rnd; $i++) { 
				for ($x=0; $x <= $NumColumn_UeMeasControl; $x++) {
					$nombre_campo_UeMeasControl = $UeMeasControl->getCellByColumnAndRow($x,1)->getValue();					
					if($nombre_campo_UeMeasControl=="EUtranCellFDD"){
						$name_AntennaUnitGroup =  $nombre_campo_UeMeasControl;
						$valor_campo1 = $UeMeasControl->getCellByColumnAndRow($x,$i)->getValue();
				    }

					if($nombre_campo_UeMeasControl=="maxMeasInterFreqEUtra"){						
						$valor_campo2 = $UeMeasControl->getCellByColumnAndRow($x,$i)->getValue();
						if(!empty($valor_campo1)){
							$continido_1_11_1 ='
set EUtranCellFDD='.$valor_campo1.',UeMeasControl=1 maxMeasInterFreqEUtra '.$valor_campo2;
							$continido_44_11[] = $continido_1_11_1;
						}
																		
				    }

				    if($nombre_campo_UeMeasControl=="ueMeasurementsActiveGERAN"){						
						$valor_campo2 = $UeMeasControl->getCellByColumnAndRow($x,$i)->getValue();
						if(!empty($valor_campo1)){
							$continido_1_11_1 ='
set EUtranCellFDD='.$valor_campo1.',UeMeasControl=1 ueMeasurementsActiveGERAN '.$valor_campo2;
							$continido_45_11[] = $continido_1_11_1;
						}
																		
				    }

				    if($nombre_campo_UeMeasControl=="zzzTemporary3"){						
						$valor_campo2 = $UeMeasControl->getCellByColumnAndRow($x,$i)->getValue();
						if(!empty($valor_campo1)){
							$continido_1_11_1 ='
set EUtranCellFDD='.$valor_campo1.',UeMeasControl=1 zzzTemporary3 '.$valor_campo2;
							$continido_46_11[] = $continido_1_11_1;
						}
																		
				    }				
				}
			}
			
			$Features = $RND->getSheet($name_h_rnd_Features);//esto es para la 1 parte del archivo 11.6
			$filas_Features_rnd  = $Features ->getHighestRow(); 
			$Column_Features_rnd = $Features ->getHighestColumn();
			$NumColumn_Features  = PHPExcel_Cell::columnIndexFromString($Column_Features_rnd);
			for ($i=2; $i <=$filas_Features_rnd; $i++) { 
				for ($x=0; $x <= $NumColumn_Features; $x++) {
					$nombre_campo_Features = $Features->getCellByColumnAndRow($x,1)->getValue();
					if($nombre_campo_Features=="AutoCellCapEstFunction"){						
						$valor_campo1 = $Features->getCellByColumnAndRow($x,$i)->getValue();
						if(!empty($valor_campo1)){
							$continido_1_11_1 ='
set Features=1 AutoCellCapEstFunction '.$valor_campo1;
							$continido_47_11[] = $continido_1_11_1;
						}
																		
				    }

				    if($nombre_campo_Features=="CarrierAggregation"){						
						$valor_campo1 = $Features->getCellByColumnAndRow($x,$i)->getValue();
						if(!empty($valor_campo1)){
							$continido_1_11_1 ='
set Features=1 CarrierAggregation '.$valor_campo1;
							$continido_48_11[] = $continido_1_11_1;
						}
																		
				    }

				    if($nombre_campo_Features=="DynamicLoadControl"){						
						$valor_campo1 = $Features->getCellByColumnAndRow($x,$i)->getValue();
						if(!empty($valor_campo1)){
							$continido_1_11_1 ='
set Features=1 DynamicLoadControl '.$valor_campo1;
							$continido_49_11[] = $continido_1_11_1;
						}
																		
				    }

				    if($nombre_campo_Features=="EnhancedPdcchLa"){						
						$valor_campo1 = $Features->getCellByColumnAndRow($x,$i)->getValue();
						if(!empty($valor_campo1)){
							$continido_1_11_1 ='
set Features=1 EnhancedPdcchLa '.$valor_campo1;
							$continido_50_11[] = $continido_1_11_1;
						}
																		
				    }

				    if($nombre_campo_Features=="MultiTargetRrcConnReest"){						
						$valor_campo1 = $Features->getCellByColumnAndRow($x,$i)->getValue();
						if(!empty($valor_campo1)){
							$continido_1_11_1 ='
set Features=1 MultiTargetRrcConnReest '.$valor_campo1;
							$continido_51_11[] = $continido_1_11_1;
						}
																		
				    }			
				}
			}
			
			$Licensing = $RND->getSheet($name_h_rnd_Licensing);//esto es para la 1 parte del archivo 11.6
			$filas_Licensing_rnd  = $Licensing ->getHighestRow(); 
			$Column_Licensing_rnd = $Licensing ->getHighestColumn();
			$NumColumn_Licensing  = PHPExcel_Cell::columnIndexFromString($Column_Licensing_rnd);
			for ($i=2; $i <=$filas_Licensing_rnd; $i++) { 
				for ($x=0; $x <= $NumColumn_Licensing; $x++) {
					$nombre_campo_Licensing = $Licensing->getCellByColumnAndRow($x,1)->getValue();
					if($nombre_campo_Licensing=="BnrIratOffload"){						
						$valor_campo1 = $Licensing->getCellByColumnAndRow($x,$i)->getValue();
						if(!empty($valor_campo1)){
							$continido_1_11_1 ='
set Licensing=1 BnrIratOffload '.$valor_campo1;
							$continido_52_11[] = $continido_1_11_1;
						}
																		
				    }

				    if($nombre_campo_Licensing=="CsfbTo1xRtt"){						
						$valor_campo2 = $Licensing->getCellByColumnAndRow($x,$i)->getValue();
						if(!empty($valor_campo1)){
							$continido_1_11_1 ='
set Licensing=1 CsfbTo1xRtt '.$valor_campo2;
							$continido_53_11[] = $continido_1_11_1;
						}
																		
				    }

				    if($nombre_campo_Licensing=="EnhCsfbTo1xRtt"){						
						$valor_campo2 = $Licensing->getCellByColumnAndRow($x,$i)->getValue();
						if(!empty($valor_campo1)){
							$continido_1_11_1 ='
set Licensing=1 EnhCsfbTo1xRtt '.$valor_campo2;
							$continido_54_11[] = $continido_1_11_1;
						}
																		
				    }				
				}
			}
			
			$UtranFrequency = $RND->getSheet($name_h_rnd_UtranFrequency);//esto es para la 1 parte del archivo 11.6
			$filas_UtranFrequency_rnd  = $UtranFrequency ->getHighestRow(); 
			$Column_UtranFrequency_rnd = $UtranFrequency ->getHighestColumn();
			$NumColumn_UtranFrequency  = PHPExcel_Cell::columnIndexFromString($Column_UtranFrequency_rnd);
			for ($i=2; $i <=$filas_UtranFrequency_rnd; $i++) { 
				for ($x=0; $x <= $NumColumn_UtranFrequency; $x++) {
					$nombre_campo_UtranFrequency = $UtranFrequency->getCellByColumnAndRow($x,1)->getValue();					
					if($nombre_campo_UtranFrequency=="UtranFrequencyId"){
						$name_UtranFrequency =  $nombre_campo_UtranFrequency;
						$valor_campo1 = $UtranFrequency->getCellByColumnAndRow($x,$i)->getValue();
				    }

					if($nombre_campo_UtranFrequency=="userLabel"){						
						$valor_campo2 = $UtranFrequency->getCellByColumnAndRow($x,$i)->getValue();
						if(!empty($valor_campo1)){
							$continido_1_11_1 ='
set UtraNetwork=1,UtranFrequency='.$valor_campo1.' userLabel '.$valor_campo2;
							$continido_55_11[] = $continido_1_11_1;
						}
																		
				    }					
				}
			}
			
			$QciProfilePredefined = $RND->getSheet($name_h_rnd_QciProfilePredefined);//esto es para la 1 parte del archivo 11.6
			$filas_QciProfilePredefined_rnd  = $QciProfilePredefined ->getHighestRow(); 
			$Column_QciProfilePredefined_rnd = $QciProfilePredefined ->getHighestColumn();
			$NumColumn_QciProfilePredefined  = PHPExcel_Cell::columnIndexFromString($Column_QciProfilePredefined_rnd);
			for ($i=2; $i <=$filas_QciProfilePredefined_rnd; $i++) { 
				for ($x=0; $x <= $NumColumn_QciProfilePredefined; $x++) {
					$nombre_campo_QciProfilePredefined = $QciProfilePredefined->getCellByColumnAndRow($x,1)->getValue();					
					if($nombre_campo_QciProfilePredefined=="QciProfilePredefined"){
						$name_AntennaUnitGroup =  $nombre_campo_QciProfilePredefined;
						$valor_campo1 = $QciProfilePredefined->getCellByColumnAndRow($x,$i)->getValue();
				    }

					if($nombre_campo_QciProfilePredefined=="aqmMode"){						
						$valor_campo2 = $QciProfilePredefined->getCellByColumnAndRow($x,$i)->getValue();
						if(!empty($valor_campo1)){
							$continido_1_11_1 ='
set QciTable=default,QciProfilePredefined='.$valor_campo1.' aqmMode '.$valor_campo2;
							$continido_56_11[] = $continido_1_11_1;
						}
																		
				    }

				    if($nombre_campo_QciProfilePredefined=="dscp"){						
						$valor_campo2 = $QciProfilePredefined->getCellByColumnAndRow($x,$i)->getValue();
						if(!empty($valor_campo1)){
							$continido_1_11_1 ='
set QciTable=default,QciProfilePredefined='.$valor_campo1.' dscp '.$valor_campo2;
							$continido_57_11[] = $continido_1_11_1;
						}
																		
				    }

				    if($nombre_campo_QciProfilePredefined=="pdb"){						
						$valor_campo2 = $QciProfilePredefined->getCellByColumnAndRow($x,$i)->getValue();
						if(!empty($valor_campo1)){
							$continido_1_11_1 ='
set QciTable=default,QciProfilePredefined='.$valor_campo1.' pdb '.$valor_campo2;
							$continido_58_11[] = $continido_1_11_1;
						}
																		
				    }

				    if($nombre_campo_QciProfilePredefined=="qciSubscriptionQuanta"){						
						$valor_campo2 = $QciProfilePredefined->getCellByColumnAndRow($x,$i)->getValue();
						if(!empty($valor_campo1)){
							$continido_1_11_1 ='
set QciTable=default,QciProfilePredefined='.$valor_campo1.' qciSubscriptionQuanta '.$valor_campo2;
							$continido_59_11[] = $continido_1_11_1;
						}
																		
				    }

				    if($nombre_campo_QciProfilePredefined=="rlfProfileRef"){						
						$valor_campo2 = $QciProfilePredefined->getCellByColumnAndRow($x,$i)->getValue();
						if(!empty($valor_campo1)){
							$continido_1_11_1 ='
set QciTable=default,QciProfilePredefined='.$valor_campo1.' rlfProfileRef '.$valor_campo2;
							$continido_60_11[] = $continido_1_11_1;
						}
																		
				    }

				    if($nombre_campo_QciProfilePredefined=="schedulingAlgorithm"){						
						$valor_campo2 = $QciProfilePredefined->getCellByColumnAndRow($x,$i)->getValue();
						if(!empty($valor_campo1)){
							$continido_1_11_1 ='
set QciTable=default,QciProfilePredefined='.$valor_campo1.' schedulingAlgorithm '.$valor_campo2;
							$continido_61_11[] = $continido_1_11_1;
						}
																		
				    }

				    if($nombre_campo_QciProfilePredefined=="serviceType"){						
						$valor_campo2 = $QciProfilePredefined->getCellByColumnAndRow($x,$i)->getValue();
						if(!empty($valor_campo1)){
							$continido_1_11_1 ='
set QciTable=default,QciProfilePredefined='.$valor_campo1.' serviceType '.$valor_campo2;
							$continido_62_11[] = $continido_1_11_1;
						}
																		
				    }

				    if($nombre_campo_QciProfilePredefined=="srsAllocationStrategy"){						
						$valor_campo2 = $QciProfilePredefined->getCellByColumnAndRow($x,$i)->getValue();
						if(!empty($valor_campo1)){
							$continido_1_11_1 ='
set QciTable=default,QciProfilePredefined='.$valor_campo1.' srsAllocationStrategy '.$valor_campo2;
							$continido_63_11[] = $continido_1_11_1;
						}
																		
				    }

				    if($nombre_campo_QciProfilePredefined=="pdbOffset"){						
						$valor_campo2 = $QciProfilePredefined->getCellByColumnAndRow($x,$i)->getValue();
						if(!empty($valor_campo1)){
							$continido_1_11_1 ='
set QciTable=default,QciProfilePredefined='.$valor_campo1.' pdbOffset '.$valor_campo2;
							$continido_64_11[] = $continido_1_11_1;
						}
																		
				    }				
				}
			}

			$Sctp = $RND->getSheet($name_h_rnd_Sctp);//esto es para la 1 parte del archivo 11.6
			$filas_Sctp_rnd  = $Sctp ->getHighestRow(); 
			$Column_Sctp_rnd = $Sctp ->getHighestColumn();
			$NumColumn_Sctp  = PHPExcel_Cell::columnIndexFromString($Column_Sctp_rnd);
			for ($i=2; $i <=$filas_Sctp_rnd; $i++) { 
				for ($x=0; $x <= $NumColumn_Sctp; $x++) {
					$nombre_campo_Sctp = $Sctp->getCellByColumnAndRow($x,1)->getValue();					
					if($nombre_campo_Sctp=="heartbeatMaxBurst"){						
						$valor_campo2 = $Sctp->getCellByColumnAndRow($x,$i)->getValue();
						
							$continido_1_11_1 ='
set Sctp=1 heartbeatMaxBurst '.$valor_campo2;
							$continido_65_11[] = $continido_1_11_1;						
																		
				    }

				    if($nombre_campo_Sctp=="mBuffer"){						
						$valor_campo1 = $Sctp->getCellByColumnAndRow($x,$i)->getValue();
						if(!empty($valor_campo1)){
							$continido_1_11_1 ='
set Sctp=1 mBuffer '.$valor_campo1;
							$continido_65_11[] .= $continido_1_11_1;
						}
																		
				    }

				    if($nombre_campo_Sctp=="nThreshold"){						
						$valor_campo2 = $Sctp->getCellByColumnAndRow($x,$i)->getValue();
						if(!empty($valor_campo1)){
							$continido_1_11_1 ='
set Sctp=1 nThreshold '.$valor_campo2;
							$continido_65_11[] .= $continido_1_11_1;
						}
																		
				    }
				    if($nombre_campo_Sctp !="heartbeatMaxBurst"  && $nombre_campo_Sctp != "mBuffer" && $nombre_campo_Sctp != "nThreshold"){
			    		$informacion_Sctp .= "Columna == ".$nombre_campo_Sctp."\n"; //cambios 24-07-2017
			    		$RutaCArpeta = "archivo/ENodoB_excepsiones/ENodoB_".$nombre_final."/";
			    		$RutaArchivo = "archivo/ENodoB_excepsiones/ENodoB_".$nombre_final."/".$NombreHojaRNDSctp."_Archivo11.txt";
			    		$this->ElimarArchivo($RutaArchivo);
			    		$this->crear_carpeta($RutaCArpeta);
						$this->CrearArchivo($RutaArchivo, $informacion_Sctp);
		    		}				    					
				}				
			}

			$Rrc = $RND->getSheet($name_h_rnd_Rrc);//esto es para la 1 parte del archivo 11.6
			$filas_Rrc_rnd  = $Rrc ->getHighestRow(); 
			$Column_Rrc_rnd = $Rrc ->getHighestColumn();
			$NumColumn_Rrc  = PHPExcel_Cell::columnIndexFromString($Column_Rrc_rnd);
			for ($i=2; $i <=$filas_Rrc_rnd; $i++) { 
				for ($x=0; $x <= $NumColumn_Rrc; $x++) {
					$nombre_campo_Rrc = $Rrc->getCellByColumnAndRow($x,1)->getValue();					
					if($nombre_campo_Rrc=="t301"){						
						$valor_campo2 = $Rrc->getCellByColumnAndRow($x,$i)->getValue();
						if(!empty($valor_campo2)){
							$continido_1_11_1 ='
set Rrc=1 t301 '.$valor_campo2;
							$continido_65_11[] .= $continido_1_11_1;						
						}												
				    }
				}
			}

			$AutoCellCapEstFunction = $RND->getSheet($name_h_rnd_AutoCellCapEstFunction);//esto es para la 1 parte del archivo 11.6
			$filas_AutoCellCapEstFunction_rnd  = $AutoCellCapEstFunction ->getHighestRow(); 
			$Column_AutoCellCapEstFunction_rnd = $AutoCellCapEstFunction ->getHighestColumn();
			$NumColumn_AutoCellCapEstFunction  = PHPExcel_Cell::columnIndexFromString($Column_AutoCellCapEstFunction_rnd);
			for ($i=2; $i <=$filas_AutoCellCapEstFunction_rnd; $i++) { 
				for ($x=0; $x <= $NumColumn_AutoCellCapEstFunction; $x++) {
					$nombre_campo_AutoCellCapEstFunction = $AutoCellCapEstFunction->getCellByColumnAndRow($x,1)->getValue();					
					if($nombre_campo_AutoCellCapEstFunction=="useEstimatedCellCap"){						
						$valor_campo2 = $AutoCellCapEstFunction->getCellByColumnAndRow($x,$i)->getValue();
						if(!empty($valor_campo2)){
							$continido_1_11_1 ='
set AutoCellCapEstFunction=1 useEstimatedCellCap '.$valor_campo2;
							$continido_65_11[] .= $continido_1_11_1;						
						}						
				    }
				}
			}
     		//////////////////////////////////////////////////////////////////////////
			//Contrucion del archivo 12
			//
			//
			/////////////////////////////////////////////////////////////////////////
			$AdmissionControl = $RND->getSheet($name_h_rnd_AdmissionControl);//esto es para la 1 parte del archivo 12
			$filas_AdmissionControl_rnd  = $AdmissionControl ->getHighestRow(); 
			$Column_AdmissionControl_rnd = $AdmissionControl ->getHighestColumn();
			$NumColumn_AdmissionControl  = PHPExcel_Cell::columnIndexFromString($Column_AdmissionControl_rnd);
			for ($i=2; $i <=$filas_AdmissionControl_rnd; $i++) { 
				for ($x=1; $x <= $NumColumn_AdmissionControl; $x++) {
					$nombre_campo_AdmissionControl = $AdmissionControl->getCellByColumnAndRow($x,1)->getValue();
					if($nombre_campo_AdmissionControl=="zzzTemporary26"){	
						$valor_campo1 = $AdmissionControl->getCellByColumnAndRow($x,$i)->getValue();
					}

					$valor_campo3 = $AdmissionControl->getCellByColumnAndRow($x,$i)->getValue();				   
					if(!empty($nombre_campo_AdmissionControl)){
						$continido_1_12_1 ='
set AdmissionControl=1 '.$nombre_campo_AdmissionControl.' '.$valor_campo3;
						$continido_1_12[] = $continido_1_12_1;
					}					
				}
			}

			$AnrFunction = $RND->getSheet($name_h_rnd_AnrFunction);//esto es para la 1 parte del archivo 12
			$filas_AnrFunction_rnd  = $AnrFunction ->getHighestRow(); 
			$Column_AnrFunction_rnd = $AnrFunction ->getHighestColumn();
			$NumColumn_AnrFunction  = PHPExcel_Cell::columnIndexFromString($Column_AnrFunction_rnd);
			for ($i=2; $i <=$filas_AnrFunction_rnd; $i++) { 
				for ($x=1; $x <= $NumColumn_AnrFunction; $x++) {
					$nombre_campo_AnrFunction = $AnrFunction->getCellByColumnAndRow($x,1)->getValue();
					if($nombre_campo_AnrFunction=="maxNoPciReportsEvent"){	
						$valor_campo1 = $AnrFunction->getCellByColumnAndRow($x,$i)->getValue();
					}

					$valor_campo3 = $AnrFunction->getCellByColumnAndRow($x,$i)->getValue();				   
					if(!empty($nombre_campo_AnrFunction)){
						$continido_1_12_1 ='
set AnrFunction=1 '.$nombre_campo_AnrFunction	.' '.$valor_campo3;
						$continido_1_12[] .= $continido_1_12_1;
					}					
				}
			}	

			$AnrFunctionEUtran = $RND->getSheet($name_h_rnd_AnrFunctionEUtran);//esto es para la 1 parte del archivo 12
			$filas_AnrFunctionEUtran_rnd  = $AnrFunctionEUtran ->getHighestRow(); 
			$Column_AnrFunctionEUtran_rnd = $AnrFunctionEUtran ->getHighestColumn();
			$NumColumn_AnrFunctionEUtran  = PHPExcel_Cell::columnIndexFromString($Column_AnrFunctionEUtran_rnd);
			for ($i=2; $i <=$filas_AnrFunctionEUtran_rnd; $i++) { 
				for ($x=1; $x <= $NumColumn_AnrFunctionEUtran; $x++) {
					$nombre_campo_AnrFunctionEUtran = $AnrFunctionEUtran->getCellByColumnAndRow($x,1)->getValue();
					if($nombre_campo_AnrFunctionEUtran=="maxNoPciReportsEvent"){	
						$valor_campo1 = $AnrFunctionEUtran->getCellByColumnAndRow($x,$i)->getValue();
					}

					$valor_campo3 = $AnrFunctionEUtran->getCellByColumnAndRow($x,$i)->getValue();				   
					if(!empty($nombre_campo_AnrFunctionEUtran)){
						$continido_1_12_1 ='
set AnrFunctionEUtran=1,AnrFunctionEUtran=1 '.$nombre_campo_AnrFunctionEUtran	.' '.$valor_campo3;
						$continido_1_12[] .= $continido_1_12_1;
					}					
				}
			}

			$AnrFunctionGeran = $RND->getSheet($name_h_rnd_AnrFunctionGeran);//esto es para la 1 parte del archivo 12
			$filas_AnrFunctionGeran_rnd  = $AnrFunctionGeran ->getHighestRow(); 
			$Column_AnrFunctionGeran_rnd = $AnrFunctionGeran ->getHighestColumn();
			$NumColumn_AnrFunctionGeran  = PHPExcel_Cell::columnIndexFromString($Column_AnrFunctionGeran_rnd);
			for ($i=2; $i <=$filas_AnrFunctionGeran_rnd; $i++) { 
				for ($x=1; $x <= $NumColumn_AnrFunctionGeran; $x++) {
					$nombre_campo_AnrFunctionGeran = $AnrFunctionGeran->getCellByColumnAndRow($x,1)->getValue();
					if($nombre_campo_AnrFunctionGeran=="maxNoPciReportsEvent"){	
						$valor_campo1 = $AnrFunctionGeran->getCellByColumnAndRow($x,$i)->getValue();
					}

					$valor_campo3 = $AnrFunctionGeran->getCellByColumnAndRow($x,$i)->getValue();				   
					if(!empty($nombre_campo_AnrFunctionGeran)){
						$continido_1_12_1 ='
set AnrFunctionGeran=1,AnrFunctionGeran=1 '.$nombre_campo_AnrFunctionGeran	.' '.$valor_campo3;
						$continido_1_12[] .= $continido_1_12_1;
					}					
				}
			}
			
			$AnrFunctionUtran = $RND->getSheet($name_h_rnd_AnrFunctionUtran);//esto es para la 1 parte del archivo 12
			$filas_AnrFunctionUtran_rnd  = $AnrFunctionUtran ->getHighestRow(); 
			$Column_AnrFunctionUtran_rnd = $AnrFunctionUtran ->getHighestColumn();
			$NumColumn_AnrFunctionUtran  = PHPExcel_Cell::columnIndexFromString($Column_AnrFunctionUtran_rnd);
			for ($i=2; $i <=$filas_AnrFunctionUtran_rnd; $i++) { 
				for ($x=1; $x <= $NumColumn_AnrFunctionUtran; $x++) {
					$nombre_campo_AnrFunctionUtran = $AnrFunctionUtran->getCellByColumnAndRow($x,1)->getValue();
					
					$valor_campo3 = $AnrFunctionUtran->getCellByColumnAndRow($x,$i)->getValue();				   
					if(!empty($nombre_campo_AnrFunctionUtran)){
						$continido_1_12_1 ='
set AnrFunctionUtran=1,AnrFunctionUtran=1 '.$nombre_campo_AnrFunctionUtran	.' '.$valor_campo3;
						$continido_1_12[] .= $continido_1_12_1;
					}					
				}
			}

			//Aqui correir
			$AntennaSubunit = $RND->getSheet($name_h_rnd_AntennaSubunit);//esto es para la 1 parte del archivo 12
			$AntennaUnit = $RND->getSheet($name_h_rnd_AntennaUnit);// esta linea
			$filas_AntennaSubunit_rnd  = $AntennaSubunit ->getHighestRow(); 
			$Column_AntennaSubunit_rnd = $AntennaSubunit ->getHighestColumn();
			$NumColumn_AntennaSubunit  = PHPExcel_Cell::columnIndexFromString($Column_AntennaSubunit_rnd);
			for ($i=2; $i <=$filas_AntennaSubunit_rnd; $i++) { 
				for ($x=1; $x <= $NumColumn_AntennaSubunit; $x++) {
					$nombre_campo_AntennaSubunit = $AntennaSubunit->getCellByColumnAndRow($x,1)->getValue();
					if($nombre_campo_AntennaSubunit=="AntennaUnitGroup"){
						$valor_campo1 = $AntennaSubunit->getCellByColumnAndRow($x,$i)->getValue();
					}

					if($nombre_campo_AntennaSubunit=="AntennaUnitGroup"){
						$valor_campo1 = $AntennaSubunit->getCellByColumnAndRow($x,$i)->getValue();
					}
					
					$valor_campo5 = $AntennaSubunit->getCellByColumnAndRow(2,$i)->getValue();

					if($nombre_campo_AntennaSubunit != "AntennaUnitGroup"){
						$valor_campo3 = $AntennaSubunit->getCellByColumnAndRow($x,$i)->getValue();				   
						if(!empty($nombre_campo_AntennaSubunit)){
							if($nombre_campo_AntennaSubunit == "AntennaSubunit"){
								$AntennaSubunit_v = $valor_campo3;
							}

							if($nombre_campo_AntennaSubunit != "AntennaSubunit"){
								$relleno = ",AntennaSubunit ".$AntennaSubunit_v." ";
							}
							else{
								$relleno = " ";
							}

							$continido_1_12_1 ='
set AntennaUnitGroup='.$valor_campo1.',AntennaUnit=1'.$relleno.$nombre_campo_AntennaSubunit .' '.$valor_campo3;								
							$continido_1_12[] .= $continido_1_12_1;
							$valor_campo10 = $AntennaUnit->getCellByColumnAndRow(1,$i)->getValue();
							$valor_campo11 = $AntennaUnit->getCellByColumnAndRow(2,$i)->getValue();
							 
							if($valor_campo5 == $valor_campo10){
								if($nombre_campo_AntennaSubunit == "totalTilt" && !empty($valor_campo1) ){
									if(!empty($valor_campo11)){
										$continido_1_12_1 ='
set AntennaUnitGroup='.$valor_campo10.',AntennaUnit=1 mechanicalAntennaTilt '.$valor_campo11;
										$continido_1_12[] .= $continido_1_12_1;
									}
								}
							}else{
								if($nombre_campo_AntennaSubunit == "totalTilt" && !empty($valor_campo1) ){
									if(!empty($valor_campo11)){
										$continido_1_12_1 ='
set AntennaUnitGroup='.$valor_campo10.',AntennaUnit=1 mechanicalAntennaTilt '.$valor_campo11;
										$continido_1_12[] .= $continido_1_12_1;
									}
								}
							}
						}
					}
				}
			}
			
			$AutoCellCapEstFunction_12 = $RND->getSheet($name_h_rnd_AutoCellCapEstFunction);//esto es para la 1 parte del archivo 12
			$filas_AutoCellCapEstFunction_12_rnd  = $AutoCellCapEstFunction_12 ->getHighestRow(); 
			$Column_AutoCellCapEstFunction_12_rnd = $AutoCellCapEstFunction_12 ->getHighestColumn();
			$NumColumn_AutoCellCapEstFunction_12  = PHPExcel_Cell::columnIndexFromString($Column_AutoCellCapEstFunction_12_rnd);
			for ($i=2; $i <=$filas_AutoCellCapEstFunction_12_rnd; $i++) { 
				for ($x=1; $x <= $NumColumn_AutoCellCapEstFunction_12; $x++) {
					$nombre_campo_AutoCellCapEstFunction_12 = $AutoCellCapEstFunction_12->getCellByColumnAndRow($x,1)->getValue();					
				
						$valor_campo3 = $AutoCellCapEstFunction_12->getCellByColumnAndRow($x,$i)->getValue();				   
						if(!empty($nombre_campo_AutoCellCapEstFunction_12)){
							$continido_1_12_1 ='
set AutoCellCapEstFunction=1 useEstimatedCellCap '.$valor_campo3;								
							$continido_1_12[] .= $continido_1_12_1;
						}
					
				}
			}
			//Aqui siguiente
			$CarrierAggregationFunction = $RND->getSheet($name_h_rnd_CarrierAggregationFunction);//esto es para la 1 parte del archivo 12
			$filas_CarrierAggregationFunction_rnd  = $CarrierAggregationFunction ->getHighestRow(); 
			$Column_CarrierAggregationFunction_rnd = $CarrierAggregationFunction ->getHighestColumn();
			$NumColumn_CarrierAggregationFunction  = PHPExcel_Cell::columnIndexFromString($Column_CarrierAggregationFunction_rnd);
			for ($i=2; $i <=$filas_CarrierAggregationFunction_rnd; $i++) { 
				for ($x=1; $x <= $NumColumn_CarrierAggregationFunction; $x++) {
					$nombre_campo_CarrierAggregationFunction = $CarrierAggregationFunction->getCellByColumnAndRow($x,1)->getValue();					
				
						$valor_campo3 = $CarrierAggregationFunction->getCellByColumnAndRow($x,$i)->getValue();				   
						if(!empty($nombre_campo_CarrierAggregationFunction)){
							$continido_1_12_1 ='
set CarrierAggregationFunction=1 '.$nombre_campo_CarrierAggregationFunction.' '.$valor_campo3;								
							$continido_1_12[] .= $continido_1_12_1;
						}
					
				}
			}

			$CellSleepFunction = $RND->getSheet($name_h_rnd_CellSleepFunction);//esto es para la 1 parte del archivo 12
			$filas_CellSleepFunction_rnd  = $CellSleepFunction ->getHighestRow(); 
			$Column_CellSleepFunction_rnd = $CellSleepFunction ->getHighestColumn();
			$NumColumn_CellSleepFunction  = PHPExcel_Cell::columnIndexFromString($Column_CellSleepFunction_rnd);
			for ($i=2; $i <=$filas_CellSleepFunction_rnd; $i++) { 
				for ($x=1; $x <= $NumColumn_CellSleepFunction; $x++) {
					$nombre_campo_CellSleepFunction = $CellSleepFunction->getCellByColumnAndRow($x,1)->getValue();					
						if($nombre_campo_CellSleepFunction== "EUtranCellFDD"){
							$valor_campo1 = $CellSleepFunction->getCellByColumnAndRow($x,$i)->getValue();
						}

						if($nombre_campo_CellSleepFunction== "capCellSleepMonitorDurTimer"){
							$valor_campo2 = $CellSleepFunction->getCellByColumnAndRow($x,$i)->getValue();
						}

						if($nombre_campo_CellSleepFunction != "EUtranCellFDD"){
							$valor_campo3 = $CellSleepFunction->getCellByColumnAndRow($x,$i)->getValue();				   
							if(!empty($nombre_campo_CellSleepFunction) && !empty($valor_campo2)){
								$continido_1_12_1 ='
set EUtranCellFDD='.$valor_campo1.',CellSleepFunction=1 '.$nombre_campo_CellSleepFunction.' '.$valor_campo3;								
								$continido_1_12[] .= $continido_1_12_1;
							}
						}
					
				}
			}

			$CellSleepNodeFunction = $RND->getSheet($name_h_rnd_CellSleepNodeFunction);//esto es para la 1 parte del archivo 12
			$filas_CellSleepNodeFunction_rnd  = $CellSleepNodeFunction ->getHighestRow(); 
			$Column_CellSleepNodeFunction_rnd = $CellSleepNodeFunction ->getHighestColumn();
			$NumColumn_CellSleepNodeFunction  = PHPExcel_Cell::columnIndexFromString($Column_CellSleepNodeFunction_rnd);
			for ($i=2; $i <=$filas_CellSleepNodeFunction_rnd; $i++) { 
				for ($x=1; $x <= $NumColumn_CellSleepNodeFunction; $x++) {
					$nombre_campo_CellSleepNodeFunction = $CellSleepNodeFunction->getCellByColumnAndRow($x,1)->getValue();
						if($nombre_campo_CellSleepNodeFunction != "EUtranCellFDD"){
							$valor_campo3 = $CellSleepNodeFunction->getCellByColumnAndRow($x,$i)->getValue();				   
							if(!empty($nombre_campo_CellSleepNodeFunction)){
								$continido_1_12_1 ='
set CellSleepNodeFunction=1 '.$nombre_campo_CellSleepNodeFunction.' '.$valor_campo3;								
								$continido_1_12[] .= $continido_1_12_1;
							}
						}
					
				}
			}

			$DataRadioBearer = $RND->getSheet($name_h_rnd_DataRadioBearer);//esto es para la 1 parte del archivo 12
			$filas_DataRadioBearer_rnd  = $DataRadioBearer ->getHighestRow(); 
			$Column_DataRadioBearer_rnd = $DataRadioBearer ->getHighestColumn();
			$NumColumn_DataRadioBearer  = PHPExcel_Cell::columnIndexFromString($Column_DataRadioBearer_rnd);
			for ($i=2; $i <=$filas_DataRadioBearer_rnd; $i++) { 
				for ($x=1; $x <= $NumColumn_DataRadioBearer; $x++) {
					$nombre_campo_DataRadioBearer = $DataRadioBearer->getCellByColumnAndRow($x,1)->getValue();
						if($nombre_campo_DataRadioBearer != "EUtranCellFDD"){
							$valor_campo3 = $DataRadioBearer->getCellByColumnAndRow($x,$i)->getValue();				   
							if(!empty($nombre_campo_DataRadioBearer)){
								$continido_1_12_1 ='
set DataRadioBearer=1 '.$nombre_campo_DataRadioBearer.' '.$valor_campo3;								
								$continido_1_12[] .= $continido_1_12_1;
							}
						}
					
				}
			}

			$DrxProfile_12 = $RND->getSheet($name_h_rnd_DrxProfile);//esto es para la 1 parte del archivo 12
			$filas_DrxProfile_12_rnd  = $DrxProfile_12 ->getHighestRow(); 
			$Column_DrxProfile_12_rnd = $DrxProfile_12 ->getHighestColumn();
			$NumColumn_DrxProfile_12  = PHPExcel_Cell::columnIndexFromString($Column_DrxProfile_12_rnd);
			for ($i=2; $i <=$filas_DrxProfile_12_rnd; $i++) { 
				for ($x=1; $x <= $NumColumn_DrxProfile_12; $x++) {
					$nombre_campo_DrxProfile_12 = $DrxProfile_12->getCellByColumnAndRow($x,1)->getValue();
						if($nombre_campo_DrxProfile_12== "DrxProfile"){
							$valor_campo1 = $DrxProfile_12->getCellByColumnAndRow($x,$i)->getValue();
						}

						if($nombre_campo_DrxProfile_12== "drxInactivityTimer"){
							$valor_campo2 = $DrxProfile_12->getCellByColumnAndRow($x,$i)->getValue();
						}

						if($nombre_campo_DrxProfile_12 != "DrxProfile"){
							$valor_campo3 = $DrxProfile_12->getCellByColumnAndRow($x,$i)->getValue();				   
							if(!empty($nombre_campo_DrxProfile_12) && !empty($valor_campo2)){
								$continido_1_12_1 ='
set DrxProfile='.$valor_campo1.' '.$nombre_campo_DrxProfile_12.' '.$valor_campo3;								
								$continido_1_12[] .= $continido_1_12_1;
							}
						}
					
				}
			}

			$ENodeBFunction = $RND->getSheet($name_h_rnd_ENodeBFunction);//esto es para la 1 parte del archivo 12
			$filas_ENodeBFunction_rnd  = $ENodeBFunction ->getHighestRow(); 
			$Column_ENodeBFunction_rnd = $ENodeBFunction ->getHighestColumn();
			$NumColumn_ENodeBFunction  = PHPExcel_Cell::columnIndexFromString($Column_ENodeBFunction_rnd);
			for ($i=2; $i <=$filas_ENodeBFunction_rnd; $i++) { 
				for ($x=1; $x <= $NumColumn_ENodeBFunction; $x++) {
					$nombre_campo_ENodeBFunction = $ENodeBFunction->getCellByColumnAndRow($x,1)->getValue();
					if($nombre_campo_ENodeBFunction== "dnsLookupOnTai"){
						$valor_campo2 = $ENodeBFunction->getCellByColumnAndRow($x,$i)->getValue();
					}
					$valor_campo3 = $ENodeBFunction->getCellByColumnAndRow($x,$i)->getValue();				   
					if(!empty($nombre_campo_ENodeBFunction) && !empty($valor_campo2)){
						$continido_1_12_1 ='
set ENodeBFunction=1 '.$nombre_campo_ENodeBFunction.' '.$valor_campo3;								
						$continido_1_12[] .= $continido_1_12_1;
					}
						
					
				}
			}

			$EUtranCellFDD_12 = $RND->getSheet($name_h_rnd_EUtranCellFDD);//esto es para la 1 parte del archivo 12
			$filas_EUtranCellFDD_12_rnd  = $EUtranCellFDD_12 ->getHighestRow(); 
			$Column_EUtranCellFDD_12_rnd = $EUtranCellFDD_12 ->getHighestColumn();
			$NumColumn_EUtranCellFDD_12  = PHPExcel_Cell::columnIndexFromString($Column_EUtranCellFDD_12_rnd);
			for ($i=2; $i <=$filas_EUtranCellFDD_12_rnd; $i++) {
				for ($x=1; $x <= $NumColumn_EUtranCellFDD_12; $x++) {
					$nombre_campo_EUtranCellFDD_12 = $EUtranCellFDD_12->getCellByColumnAndRow($x,1)->getValue();
					if($nombre_campo_EUtranCellFDD_12== "EUtranCellFDD"){
						$valor_campo1 = $EUtranCellFDD_12->getCellByColumnAndRow($x,$i)->getValue();
					}

					if($nombre_campo_EUtranCellFDD_12 == "additionalPlmnReservedList"){
						$valor_campo2 = $EUtranCellFDD_12->getCellByColumnAndRow($x,$i)->getValue();				   
						if(!empty($nombre_campo_EUtranCellFDD_12) && !empty($valor_campo2)){
							$continido_1_12_1 ='
set EUtranCellFDD='.$valor_campo1.' '.$nombre_campo_EUtranCellFDD_12.' '.$valor_campo2;								
						$continido_1_12[] .= $continido_1_12_1;
						}
					}

					if($nombre_campo_EUtranCellFDD_12 == "additionalSpectrumEmissionValues"){
						$valor_campo3 = $EUtranCellFDD_12->getCellByColumnAndRow($x,$i)->getValue();				   
						if(!empty($nombre_campo_EUtranCellFDD_12) && !empty($valor_campo2)){
							$continido_1_12_1 ='
set EUtranCellFDD='.$valor_campo1.' '.$nombre_campo_EUtranCellFDD_12.' '.$valor_campo3;								
						$continido_1_12[] .= $continido_1_12_1;
						}
					}

					if($nombre_campo_EUtranCellFDD_12 == "administrativeState"){
						$valor_campo3 = $EUtranCellFDD_12->getCellByColumnAndRow($x,$i)->getValue();				   
						if(!empty($nombre_campo_EUtranCellFDD_12) && !empty($valor_campo2)){
							$continido_1_12_1 ='
set EUtranCellFDD='.$valor_campo1.' '.$nombre_campo_EUtranCellFDD_12.' '.$valor_campo3;								
						$continido_1_12[] .= $continido_1_12_1;
						}
					}

					if($nombre_campo_EUtranCellFDD_12 == "advCellSupAction"){
						$valor_campo5 = $EUtranCellFDD_12->getCellByColumnAndRow($x,$i)->getValue();				   
						if(!empty($nombre_campo_EUtranCellFDD_12) && !empty($valor_campo2)){
							$continido_1_12_1 ='
set EUtranCellFDD='.$valor_campo1.' '.$nombre_campo_EUtranCellFDD_12.' '.$valor_campo5;								
						$continido_1_12[] .= $continido_1_12_1;
						}
					}

					if($nombre_campo_EUtranCellFDD_12 == "advCellSupSensitivity"){
						$valor_campo6 = $EUtranCellFDD_12->getCellByColumnAndRow($x,$i)->getValue();				   
						if(!empty($nombre_campo_EUtranCellFDD_12) && !empty($valor_campo2)){
							$continido_1_12_1 ='
set EUtranCellFDD='.$valor_campo1.' '.$nombre_campo_EUtranCellFDD_12.' '.$valor_campo6;								
						$continido_1_12[] .= $continido_1_12_1;
						}
					}

					if($nombre_campo_EUtranCellFDD_12 == "ailgActive"){
						$valor_campo7 = $EUtranCellFDD_12->getCellByColumnAndRow($x,$i)->getValue();				   
						if(!empty($nombre_campo_EUtranCellFDD_12) && !empty($valor_campo2)){
							$continido_1_12_1 ='
set EUtranCellFDD='.$valor_campo1.' '.$nombre_campo_EUtranCellFDD_12.' '.$valor_campo7;								
						$continido_1_12[] .= $continido_1_12_1;
						}
					}

					if($nombre_campo_EUtranCellFDD_12 == "ailgRef"){
						$valor_campo8 = $EUtranCellFDD_12->getCellByColumnAndRow($x,$i)->getValue();				   
						if(!empty($nombre_campo_EUtranCellFDD_12) && !empty($valor_campo2)){
							$continido_1_12_1 ='
set EUtranCellFDD='.$valor_campo1.' '.$nombre_campo_EUtranCellFDD_12.' '.$valor_campo8;								
						$continido_1_12[] .= $continido_1_12_1;
						}
					}

					if($nombre_campo_EUtranCellFDD_12 == "alpha"){
						$valor_campo9 = $EUtranCellFDD_12->getCellByColumnAndRow($x,$i)->getValue();				   
						if(!empty($nombre_campo_EUtranCellFDD_12) && !empty($valor_campo2)){
							$continido_1_12_1 ='
set EUtranCellFDD='.$valor_campo1.' '.$nombre_campo_EUtranCellFDD_12.' '.$valor_campo9;								
						$continido_1_12[] .= $continido_1_12_1;
						}
					}

					if($nombre_campo_EUtranCellFDD_12 == "altitude"){
						$valor_campo10 = $EUtranCellFDD_12->getCellByColumnAndRow($x,$i)->getValue();				   
						if(!empty($nombre_campo_EUtranCellFDD_12) && !empty($valor_campo2)){
							$continido_1_12_1 ='
set EUtranCellFDD='.$valor_campo1.' '.$nombre_campo_EUtranCellFDD_12.' '.$valor_campo10;								
						$continido_1_12[] .= $continido_1_12_1;
						}
					}

					if($nombre_campo_EUtranCellFDD_12 == "bcCdma2000SysTimeType"){
						$valor_campo11 = $EUtranCellFDD_12->getCellByColumnAndRow($x,$i)->getValue();				   
						if(!empty($nombre_campo_EUtranCellFDD_12) && !empty($valor_campo2)){
							$continido_1_12_1 ='
set EUtranCellFDD='.$valor_campo1.' '.$nombre_campo_EUtranCellFDD_12.' '.$valor_campo11;								
						$continido_1_12[] .= $continido_1_12_1;
						}
					}	

					if($nombre_campo_EUtranCellFDD_12 == "cellBarred"){
						$valor_campo18 = $EUtranCellFDD_12->getCellByColumnAndRow($x,$i)->getValue();				   
						if(!empty($nombre_campo_EUtranCellFDD_12) && !empty($valor_campo2)){
							$continido_1_12_1 ='
set EUtranCellFDD='.$valor_campo1.' '.$nombre_campo_EUtranCellFDD_12.' '.$valor_campo18;								
						$continido_1_12[] .= $continido_1_12_1;
						}
					}

					if($nombre_campo_EUtranCellFDD_12 == "cellCapMaxCellSubCap"){
						$valor_campo12 = $EUtranCellFDD_12->getCellByColumnAndRow($x,$i)->getValue();				   
						if(!empty($nombre_campo_EUtranCellFDD_12) && !empty($valor_campo2)){
							$continido_1_12_1 ='
set EUtranCellFDD='.$valor_campo1.' '.$nombre_campo_EUtranCellFDD_12.' '.$valor_campo12;								
						$continido_1_12[] .= $continido_1_12_1;
						}
					}

					if($nombre_campo_EUtranCellFDD_12 == "cellCapMinCellSubCap"){
						$valor_campo13 = $EUtranCellFDD_12->getCellByColumnAndRow($x,$i)->getValue();				   
						if(!empty($nombre_campo_EUtranCellFDD_12) && !empty($valor_campo2)){
							$continido_1_12_1 ='
set EUtranCellFDD='.$valor_campo1.' '.$nombre_campo_EUtranCellFDD_12.' '.$valor_campo13;								
						$continido_1_12[] .= $continido_1_12_1;
						}
					}

					if($nombre_campo_EUtranCellFDD_12 == "cellId"){
						$valor_campo14 = $EUtranCellFDD_12->getCellByColumnAndRow($x,$i)->getValue();				   
						if(!empty($nombre_campo_EUtranCellFDD_12) && !empty($valor_campo2)){
							$continido_1_12_1 ='
set EUtranCellFDD='.$valor_campo1.' '.$nombre_campo_EUtranCellFDD_12.' '.$valor_campo14;								
						$continido_1_12[] .= $continido_1_12_1;
						}
					}

					if($nombre_campo_EUtranCellFDD_12 == "cellRange"){
						$valor_campo15 = $EUtranCellFDD_12->getCellByColumnAndRow($x,$i)->getValue();				   
						if(!empty($nombre_campo_EUtranCellFDD_12) && !empty($valor_campo2)){
							$continido_1_12_1 ='
set EUtranCellFDD='.$valor_campo1.' '.$nombre_campo_EUtranCellFDD_12.' '.$valor_campo15;								
						$continido_1_12[] .= $continido_1_12_1;
						}
					}

					if($nombre_campo_EUtranCellFDD_12 == "cellSubscriptionCapacity"){
						$valor_campo16 = $EUtranCellFDD_12->getCellByColumnAndRow($x,$i)->getValue();				   
						if(!empty($nombre_campo_EUtranCellFDD_12) && !empty($valor_campo2)){
							$continido_1_12_1 ='
set EUtranCellFDD='.$valor_campo1.' '.$nombre_campo_EUtranCellFDD_12.' '.$valor_campo16;								
						$continido_1_12[] .= $continido_1_12_1;
						}
					}

					if($nombre_campo_EUtranCellFDD_12 == "cfraEnable"){
						$valor_campo20 = $EUtranCellFDD_12->getCellByColumnAndRow($x,$i)->getValue();				   
						if(!empty($nombre_campo_EUtranCellFDD_12) && !empty($valor_campo2)){
							$continido_1_12_1 ='
set EUtranCellFDD='.$valor_campo1.' '.$nombre_campo_EUtranCellFDD_12.' '.$valor_campo20;								
						$continido_1_12[] .= $continido_1_12_1;
						}
					}					
				}
			}

			$EUtranCellFDD_12 = $RND->getSheet($name_h_rnd_EUtranCellFDD);//esto es para la 1 parte del archivo 12
			$filas_EUtranCellFDD_12_rnd  = $EUtranCellFDD_12 ->getHighestRow(); 
			$Column_EUtranCellFDD_12_rnd = $EUtranCellFDD_12 ->getHighestColumn();
			$NumColumn_EUtranCellFDD_12  = PHPExcel_Cell::columnIndexFromString($Column_EUtranCellFDD_12_rnd);
			for ($i=2; $i <=$filas_EUtranCellFDD_12_rnd; $i++) {
				for ($x=45; $x <= $NumColumn_EUtranCellFDD_12; $x++) {
					$nombre_campo_EUtranCellFDD_12 = $EUtranCellFDD_12->getCellByColumnAndRow($x,1)->getValue();
					//if($nombre_campo_EUtranCellFDD_12== "EUtranCellFDD"){
						$valor_campo1 = $EUtranCellFDD_12->getCellByColumnAndRow(1,$i)->getValue();
					//}	

					if($nombre_campo_EUtranCellFDD_12 != "eutranCellPolygon_cornerLatitude"	&&
						$nombre_campo_EUtranCellFDD_12 != "eutranCellCoverage_posCellBearing" &&
						$nombre_campo_EUtranCellFDD_12 != "eutranCellCoverage_posCellOpeningAngle"	&&
						$nombre_campo_EUtranCellFDD_12 != "eutranCellCoverage_posCellRadius"	&&
						$nombre_campo_EUtranCellFDD_12 != "eutranCellPolygon_cornerLongitude"	&&
						$nombre_campo_EUtranCellFDD_12 != "frameStartOffset_subFrameOffset"	&&
						$nombre_campo_EUtranCellFDD_12 != "mappingInfo_mappingInfoSIB10"	&&
						$nombre_campo_EUtranCellFDD_12 != "mappingInfo_mappingInfoSIB11"	&&
						$nombre_campo_EUtranCellFDD_12 != "mappingInfo_mappingInfoSIB12"	&&
						$nombre_campo_EUtranCellFDD_12 != "mappingInfo_mappingInfoSIB3"	&&
						$nombre_campo_EUtranCellFDD_12 != "mappingInfo_mappingInfoSIB4"	&&
						$nombre_campo_EUtranCellFDD_12 != "mappingInfo_mappingInfoSIB5"	&&
						$nombre_campo_EUtranCellFDD_12 != "mappingInfo_mappingInfoSIB6"	&&
						$nombre_campo_EUtranCellFDD_12 != "mappingInfo_mappingInfoSIB7"	&&
						$nombre_campo_EUtranCellFDD_12 != "mappingInfo_mappingInfoSIB8" &&
						$nombre_campo_EUtranCellFDD_12 != "sectorCarrierRef"	&&
						$nombre_campo_EUtranCellFDD_12 != "siPeriodicity_siPeriodicitySI1"	&&
						$nombre_campo_EUtranCellFDD_12 != "siPeriodicity_siPeriodicitySI10"	&&
						$nombre_campo_EUtranCellFDD_12 != "siPeriodicity_siPeriodicitySI2"	&&
						$nombre_campo_EUtranCellFDD_12 != "siPeriodicity_siPeriodicitySI3"	&&
						$nombre_campo_EUtranCellFDD_12 != "siPeriodicity_siPeriodicitySI4"	&&
						$nombre_campo_EUtranCellFDD_12 != "siPeriodicity_siPeriodicitySI5"	&&
						$nombre_campo_EUtranCellFDD_12 != "siPeriodicity_siPeriodicitySI6"	&&
						$nombre_campo_EUtranCellFDD_12 != "siPeriodicity_siPeriodicitySI7"	&&
						$nombre_campo_EUtranCellFDD_12 != "siPeriodicity_siPeriodicitySI8"	&&
						$nombre_campo_EUtranCellFDD_12 != "siPeriodicity_siPeriodicitySI9"	&&
						$nombre_campo_EUtranCellFDD_12 != "ssacBarringForMMTELVideo_acBarringFactor"	&&
						$nombre_campo_EUtranCellFDD_12 != "ssacBarringForMMTELVideo_acBarringForSpecialAC"	&&
						$nombre_campo_EUtranCellFDD_12 != "ssacBarringForMMTELVideo_acBarringTime"	&&
						$nombre_campo_EUtranCellFDD_12 != "ssacBarringForMMTELVideoPresent"	&&
						$nombre_campo_EUtranCellFDD_12 != "ssacBarringForMMTELVoice_acBarringFactor"	&&
						$nombre_campo_EUtranCellFDD_12 != "ssacBarringForMMTELVoice_acBarringForSpecialAC"	&&
						$nombre_campo_EUtranCellFDD_12 != "ssacBarringForMMTELVoice_acBarringTime"	&&
						$nombre_campo_EUtranCellFDD_12 != "systemInformationBlock3_nCellChangeHigh"	&&
						$nombre_campo_EUtranCellFDD_12 != "systemInformationBlock3_nCellChangeMedium"	&&
						$nombre_campo_EUtranCellFDD_12 != "systemInformationBlock3_qHyst"	&&
						$nombre_campo_EUtranCellFDD_12 != "systemInformationBlock3_qHystSfHigh"	&&
						$nombre_campo_EUtranCellFDD_12 != "systemInformationBlock3_qHystSfMedium"	&&
						$nombre_campo_EUtranCellFDD_12 != "systemInformationBlock3_sIntraSearch"	&&
						$nombre_campo_EUtranCellFDD_12 != "systemInformationBlock3_sIntraSearchP"	&&
						$nombre_campo_EUtranCellFDD_12 != "systemInformationBlock3_sIntraSearchQ"	&&
						$nombre_campo_EUtranCellFDD_12 != "systemInformationBlock3_sIntraSearchv920Active"	&&
						$nombre_campo_EUtranCellFDD_12 != "systemInformationBlock3_sNonIntraSearch"	&&
						$nombre_campo_EUtranCellFDD_12 != "systemInformationBlock3_sNonIntraSearchP"	&&
						$nombre_campo_EUtranCellFDD_12 != "systemInformationBlock3_sNonIntraSearchQ"	&&
						$nombre_campo_EUtranCellFDD_12 != "systemInformationBlock3_sNonIntraSearchv920Active"	&&
						$nombre_campo_EUtranCellFDD_12 != "systemInformationBlock3_tEvaluation"	&&
						$nombre_campo_EUtranCellFDD_12 != "systemInformationBlock3_threshServingLowQ"	&&
						$nombre_campo_EUtranCellFDD_12 != "systemInformationBlock3_tHystNormal"	&&
						$nombre_campo_EUtranCellFDD_12 != "systemInformationBlock6_tReselectionUtra"	&&
						$nombre_campo_EUtranCellFDD_12 != "systemInformationBlock6_tReselectionUtraSfHigh"	&&
						$nombre_campo_EUtranCellFDD_12 != "systemInformationBlock6_tReselectionUtraSfMedium"	&&
						$nombre_campo_EUtranCellFDD_12 != "systemInformationBlock7_tReselectionGeran"	&&
						$nombre_campo_EUtranCellFDD_12 != "systemInformationBlock7_tReselectionGeranSfHigh"	&&
						$nombre_campo_EUtranCellFDD_12 != "systemInformationBlock7_tReselectionGeranSfMedium"	&&
						$nombre_campo_EUtranCellFDD_12 != "systemInformationBlock8_searchWindowSizeCdma"	&&
						$nombre_campo_EUtranCellFDD_12 != "systemInformationBlock8_tReselectionCdmaHrpd"	&&
						$nombre_campo_EUtranCellFDD_12 != "systemInformationBlock8_tReselectionCdmaHrpdSfHigh"	&&
						$nombre_campo_EUtranCellFDD_12 != "systemInformationBlock8_tReselectionCdmaHrpdSfMedium" &&
						$nombre_campo_EUtranCellFDD_12 != "acBarringPresence_acBarringForMoDataPresence"	&&
						$nombre_campo_EUtranCellFDD_12 != "acBarringPresence_acBarringForMoSignPresence"	&&
						$nombre_campo_EUtranCellFDD_12 != "acBarringPresence_acBarringForCsfbPresence"	&&
						$nombre_campo_EUtranCellFDD_12 != "acBarringPresence_acBarringForEmergPresence"
						){
						$valor_campo21 = $EUtranCellFDD_12->getCellByColumnAndRow($x,$i)->getValue();				   
						if(!empty($nombre_campo_EUtranCellFDD_12) && !empty($valor_campo1)){
							$continido_1_12_1 ='
set EUtranCellFDD='.$valor_campo1.' '.$nombre_campo_EUtranCellFDD_12.' '.$valor_campo21;		
						    $continido_1_12[] .= $continido_1_12_1;
						}
					}

				}	
			}

			$EUtranCellFDD_12 = $RND->getSheet($name_h_rnd_EUtranCellFDD);//esto es para la 1 parte del archivo 12
			$filas_EUtranCellFDD_12_rnd  = $EUtranCellFDD_12 ->getHighestRow(); 
			$Column_EUtranCellFDD_12_rnd = $EUtranCellFDD_12 ->getHighestColumn();
			$NumColumn_EUtranCellFDD_12  = PHPExcel_Cell::columnIndexFromString($Column_EUtranCellFDD_12_rnd);
			for ($i=2; $i <=$filas_EUtranCellFDD_12_rnd; $i++) {
				for ($x=2; $x <= 182; $x++) {
					$nombre_campo_EUtranCellFDD_12 	 = $EUtranCellFDD_12->getCellByColumnAndRow($x,1)->getValue();
					$nombre_campo_EUtranCellFDD_12_1 = $EUtranCellFDD_12->getCellByColumnAndRow($x,1)->getValue();
					$nombre_campo_EUtranCellFDD_12_2 = $EUtranCellFDD_12->getCellByColumnAndRow($x,1)->getValue();
					//if($nombre_campo_EUtranCellFDD_12=="EUtranCellFDD"){
						$nombre_compl = $EUtranCellFDD_12->getCellByColumnAndRow(1,1)->getValue();
						$valor_campo1 = $EUtranCellFDD_12->getCellByColumnAndRow(1,$i)->getValue();
				    //}
							if($nombre_campo_EUtranCellFDD_12 == "acBarringPresence_acBarringForMoDataPresence"){
								die($x);
							}

				    if($nombre_campo_EUtranCellFDD_12 != "acBarringInfoPresent"  &&
				    	" freqBand"  &&
$nombre_campo_EUtranCellFDD_12 !="gpsTimeSFN0DecimalSecond"  &&
$nombre_campo_EUtranCellFDD_12 !="gpsTimeSFN0Seconds"  &&
$nombre_campo_EUtranCellFDD_12 !="highSpeedUEActive"  &&
$nombre_campo_EUtranCellFDD_12 !="hoOptAdjThresholdAbs"  &&
$nombre_campo_EUtranCellFDD_12 !="hoOptAdjThresholdPerc"  &&
$nombre_campo_EUtranCellFDD_12 !="hoOptStatNum"  &&
$nombre_campo_EUtranCellFDD_12 !="hoOptStatTime"  &&
$nombre_campo_EUtranCellFDD_12 !="initCdma2000SysTimeType"  &&
$nombre_campo_EUtranCellFDD_12 !="initialBufferSizeDefault"  &&
$nombre_campo_EUtranCellFDD_12 !="isDlOnly"  &&
$nombre_campo_EUtranCellFDD_12 !="lastModification"  &&
$nombre_campo_EUtranCellFDD_12 !="latitude"  &&
$nombre_campo_EUtranCellFDD_12 !="lbEUtranAcceptOffloadThreshold"  &&
$nombre_campo_EUtranCellFDD_12 !="lbEUtranCellOffloadCapacity"  &&
$nombre_campo_EUtranCellFDD_12 !="lbEUtranTriggerOffloadThreshold"  &&
$nombre_campo_EUtranCellFDD_12 !="lbUtranOffloadThreshold"  &&
$nombre_campo_EUtranCellFDD_12 !="longitude"  &&
$nombre_campo_EUtranCellFDD_12 !="systemInformationBlock3_sNonIntraSearchP="  &&
$nombre_campo_EUtranCellFDD_12 !="systemInformationBlock3_sNonIntraSearchQ="  &&
$nombre_campo_EUtranCellFDD_12 !="systemInformationBlock3_sNonIntraSearchv920Active=fals"  &&
$nombre_campo_EUtranCellFDD_12 !="systemInformationBlock3_tEvaluation=24"  &&
$nombre_campo_EUtranCellFDD_12 !="systemInformationBlock3_threshServingLowQ=100"  &&
$nombre_campo_EUtranCellFDD_12 !="systemInformationBlock3_tHystNormal=24"  &&
$nombre_campo_EUtranCellFDD_12 !="systemInformationBlock6_tReselectionUtra="  &&
$nombre_campo_EUtranCellFDD_12 !="systemInformationBlock6_tReselectionUtraSfHigh=10"  &&
$nombre_campo_EUtranCellFDD_12 !="systemInformationBlock6_tReselectionUtraSfMedium=10"  &&
$nombre_campo_EUtranCellFDD_12 !="systemInformationBlock7_tReselectionGeran="  &&
$nombre_campo_EUtranCellFDD_12 !="systemInformationBlock7_tReselectionGeranSfHigh=10"  &&
$nombre_campo_EUtranCellFDD_12 !="systemInformationBlock7_tReselectionGeranSfMedium=10"  &&
$nombre_campo_EUtranCellFDD_12 !="systemInformationBlock8_searchWindowSizeCdma="  &&
$nombre_campo_EUtranCellFDD_12 !="systemInformationBlock8_tReselectionCdmaHrpd="  &&
$nombre_campo_EUtranCellFDD_12 !="systemInformationBlock8_tReselectionCdmaHrpdSfHigh=10"  &&
$nombre_campo_EUtranCellFDD_12 !="systemInformationBlock8_tReselectionCdmaHrpdSfMedium=10"  &&
$nombre_campo_EUtranCellFDD_12 !="acBarringPresence_acBarringForMoDataPresence="  &&
$nombre_campo_EUtranCellFDD_12 !="acBarringPresence_acBarringForMoSignPresence="  &&
$nombre_campo_EUtranCellFDD_12 !="acBarringPresence_acBarringForCsfbPresence="  &&
$nombre_campo_EUtranCellFDD_12 !="activeServiceAreaId"  && 
$nombre_campo_EUtranCellFDD_12 !="additionalFreqBandList" &&
$nombre_campo_EUtranCellFDD_12 !="minBestCellHoAttempts" &&
$nombre_campo_EUtranCellFDD_12 !="mobCtrlAtPoorCovActive" &&
$nombre_campo_EUtranCellFDD_12 !="modificationPeriodCoeff" &&	
$nombre_campo_EUtranCellFDD_12 !="networkSignallingValue" &&
$nombre_campo_EUtranCellFDD_12 !="noConsecutiveSubframes" &&
$nombre_campo_EUtranCellFDD_12 !="noOfPucchCqiUsers" &&
$nombre_campo_EUtranCellFDD_12 !="noOfPucchSrUsers" &&
$nombre_campo_EUtranCellFDD_12 !="orientMajorAxis" &&
$nombre_campo_EUtranCellFDD_12 !="otdoaSuplActive" &&
$nombre_campo_EUtranCellFDD_12 !="pciConflict" &&
$nombre_campo_EUtranCellFDD_12 !="pdcchCfiMode" &&
$nombre_campo_EUtranCellFDD_12 !="pdcchOuterLoopInitialAdj" &&
$nombre_campo_EUtranCellFDD_12 !="pdcchOuterLoopInitialAdjPCell" &&
$nombre_campo_EUtranCellFDD_12 !="pdcchOuterLoopInitialAdjVolte" &&
$nombre_campo_EUtranCellFDD_12 !="pdcchOuterLoopUpStep" &&
$nombre_campo_EUtranCellFDD_12 !="pdcchOuterLoopUpStepPCell" &&
$nombre_campo_EUtranCellFDD_12 !="pdcchOuterLoopUpStepVolte" &&
$nombre_campo_EUtranCellFDD_12 !="pdcchPowerBoostMax" &&
$nombre_campo_EUtranCellFDD_12 !="pdcchTargetBler" &&
$nombre_campo_EUtranCellFDD_12 !="pdcchTargetBlerPCell" &&
$nombre_campo_EUtranCellFDD_12 !="pdcchTargetBlerVolte" &&
$nombre_campo_EUtranCellFDD_12 !="physicalLayerCellIdGroup" &&
$nombre_campo_EUtranCellFDD_12 !="physicalLayerSubCellId" &&
$nombre_campo_EUtranCellFDD_12 !="pMaxServingCell" &&
$nombre_campo_EUtranCellFDD_12 !="primaryPlmnReserved" &&
$nombre_campo_EUtranCellFDD_12 !="prsConfigIndex" &&
$nombre_campo_EUtranCellFDD_12 !="prsConfigIndexMapped" &&
$nombre_campo_EUtranCellFDD_12 !="prsPeriod" &&
$nombre_campo_EUtranCellFDD_12 !="pucchOverdimensioning" &&
$nombre_campo_EUtranCellFDD_12 !="pZeroNominalPucch" &&
$nombre_campo_EUtranCellFDD_12 !="pZeroNominalPusch" &&
$nombre_campo_EUtranCellFDD_12 !="qciTableRef" &&
$nombre_campo_EUtranCellFDD_12 !="qQualMin" &&
$nombre_campo_EUtranCellFDD_12 !="qQualMinOffset" &&
$nombre_campo_EUtranCellFDD_12 !="qRxLevMin" &&
$nombre_campo_EUtranCellFDD_12 !="qRxLevMinOffset" &&
$nombre_campo_EUtranCellFDD_12 !="rachRootSequence" &&
$nombre_campo_EUtranCellFDD_12 !="rateShapingActive" &&
$nombre_campo_EUtranCellFDD_12 !="sdmActive" &&
$nombre_campo_EUtranCellFDD_12 !="sectorCarrierRef" &&
$nombre_campo_EUtranCellFDD_12 !="additionalPlmnReservedList" &&
$nombre_campo_EUtranCellFDD_12 !="additionalSpectrumEmissionValues" &&
$nombre_campo_EUtranCellFDD_12 !="administrativeState" &&
$nombre_campo_EUtranCellFDD_12 !="advCellSupAction" &&
$nombre_campo_EUtranCellFDD_12 !="advCellSupSensitivity" &&
$nombre_campo_EUtranCellFDD_12 !="ailgActive" &&
$nombre_campo_EUtranCellFDD_12 !="ailgRef" &&
$nombre_campo_EUtranCellFDD_12 !="alpha" &&
$nombre_campo_EUtranCellFDD_12 !="altitude" &&
$nombre_campo_EUtranCellFDD_12 !="bcCdma2000SysTimeType" &&
$nombre_campo_EUtranCellFDD_12 !="cellBarred" &&
$nombre_campo_EUtranCellFDD_12 !="cellCapMaxCellSubCap" &&
$nombre_campo_EUtranCellFDD_12 !="cellCapMinCellSubCap" &&
$nombre_campo_EUtranCellFDD_12 !="cellId" &&
$nombre_campo_EUtranCellFDD_12 !="cellRange" &&
$nombre_campo_EUtranCellFDD_12 !="cellSubscriptionCapacity" &&
$nombre_campo_EUtranCellFDD_12 !="cfraEnable" &&
$nombre_campo_EUtranCellFDD_12 !="cioLowerLimitAdjBySon" &&
$nombre_campo_EUtranCellFDD_12 !="cioUpperLimitAdjBySon" &&
$nombre_campo_EUtranCellFDD_12 !="commonSrPeriodicity" &&
$nombre_campo_EUtranCellFDD_12 !="confidence" &&
$nombre_campo_EUtranCellFDD_12 !="covTriggerdBlindHoAllowed" &&
$nombre_campo_EUtranCellFDD_12 !="crsGain" &&
$nombre_campo_EUtranCellFDD_12 !="dlChannelBandwidth" &&
$nombre_campo_EUtranCellFDD_12 !="dlConfigurableFrequencyStart" &&
$nombre_campo_EUtranCellFDD_12 !="dlFrequencyAllocationProportion" &&
$nombre_campo_EUtranCellFDD_12 !="dlInterferenceManagementActive" &&
$nombre_campo_EUtranCellFDD_12 !="drxActive" &&
$nombre_campo_EUtranCellFDD_12 !="earfcndl" &&
$nombre_campo_EUtranCellFDD_12 !="earfcnul" &&
$nombre_campo_EUtranCellFDD_12 !="emergencyAreaId" &&
$nombre_campo_EUtranCellFDD_12 !="expectedMaxNoOfUsersInCell" &&
$nombre_campo_EUtranCellFDD_12 !="freqBand" &&
$nombre_campo_EUtranCellFDD_12 !="siWindowLength" &&
$nombre_campo_EUtranCellFDD_12 !="spectrumEmissionReqMapping" &&
$nombre_campo_EUtranCellFDD_12 !="eutranCellPolygon_cornerLatitude" &&
$nombre_campo_EUtranCellFDD_12 !="ssacBarringForMMTELVideoPresent" &&
$nombre_campo_EUtranCellFDD_12 !="ssacBarringForMMTELVoicePresent" &&
$nombre_campo_EUtranCellFDD_12 !="tac" &&
$nombre_campo_EUtranCellFDD_12 !="threshServingLow" &&
$nombre_campo_EUtranCellFDD_12 !="ulChannelBandwidth" &&
$nombre_campo_EUtranCellFDD_12 !="ulConfigurableFrequencyStart" &&
$nombre_campo_EUtranCellFDD_12 !="acBarringPresence_acBarringForEmergPresence"){
							$valor_campo5 = $EUtranCellFDD_12->getCellByColumnAndRow($x,$i)->getValue();
							$valor_campo6 = $EUtranCellFDD_12->getCellByColumnAndRow(62,$i)->getValue();
							$valor_campo6 = str_replace(" ", "", $valor_campo6);
							$nombre_campo_EUtranCellFDD_12_1 = $EUtranCellFDD_12->getCellByColumnAndRow(63,1)->getValue();
							if(!empty($valor_campo1)){
								if($nombre_campo_EUtranCellFDD_12 =="eutranCellPolygon_cornerLongitude"){
										$valor_campo5 = str_replace(" ", "", $valor_campo5);
										for ($e=0; $e <strlen($valor_campo5) ; $e++) { 
											if($e < strlen($valor_campo5)-1 && $e == $e )
												$valor_campo2_fin = $valor_campo2_fin.'cornerLatitude='.$valor_campo6[$e].",cornerLongitude=".$valor_campo5[$e].";";
											else
												$final = $valor_campo2_fin.'cornerLatitude='.$valor_campo6[$e].",cornerLongitude=".$valor_campo5[$e];
										}
										$valor_campo2_fin = "";
										$continido_1_11_1 ='
lset '.$nombre_compl.'='.$valor_campo1.' eutranCellPolygon '.$final;
								$continido_1_12[] .= $continido_1_11_1;
								}else{
									$continido_1_11_1 ='
lset '.$nombre_compl.'='.$valor_campo1.' '.str_replace("_", " ",$nombre_campo_EUtranCellFDD_12).'='.$valor_campo5;
									if($nombre_campo_EUtranCellFDD_12 == "systemInformationBlock8_tReselectionCdmaHrpdSfMedium"){
										$valor_campo10 = $EUtranCellFDD_12->getCellByColumnAndRow(200,$i)->getValue();
										$nombre_campo_EUtranCellFDD_12_1_3 = $EUtranCellFDD_12->getCellByColumnAndRow(200,1)->getValue();
										$valor_campo8 = $EUtranCellFDD_12->getCellByColumnAndRow(201,$i)->getValue();
										$nombre_campo_EUtranCellFDD_12_1_2 = $EUtranCellFDD_12->getCellByColumnAndRow(201,1)->getValue();
										$valor_campo7 = $EUtranCellFDD_12->getCellByColumnAndRow(202,$i)->getValue();
										$nombre_campo_EUtranCellFDD_12_1_1 = $EUtranCellFDD_12->getCellByColumnAndRow(202,1)->getValue();
										$valor_campo11 = $EUtranCellFDD_12->getCellByColumnAndRow(203,$i)->getValue();
										$nombre_campo_EUtranCellFDD_12_1_4 = $EUtranCellFDD_12->getCellByColumnAndRow(203,1)->getValue();
										$continido_1_11_1 .='
lset '.$nombre_compl.'='.$valor_campo1.' '.str_replace("_", " ",$nombre_campo_EUtranCellFDD_12_1_3).'='.$valor_campo10;
										$continido_1_11_1 .='
lset '.$nombre_compl.'='.$valor_campo1.' '.str_replace("_", " ",$nombre_campo_EUtranCellFDD_12_1_2).'='.$valor_campo8;
										$continido_1_11_1 .='
lset '.$nombre_compl.'='.$valor_campo1.' '.str_replace("_", " ",$nombre_campo_EUtranCellFDD_12_1_1).'='.$valor_campo7;
										$continido_1_11_1 .='
lset '.$nombre_compl.'='.$valor_campo1.' '.str_replace("_", " ",$nombre_campo_EUtranCellFDD_12_1_4).'='.$valor_campo11;
										//die();
									}
									
									$continido_1_12[] .= $continido_1_11_1;
									
								}
						}						
				    }
				}
			}

			//////////////////////////////////////////////////////////////////////////
			//Contrucion del archivo 13
			//
			//
			/////////////////////////////////////////////////////////////////////////
			$LoadBalancingFunction = $RND->getSheet($name_h_rnd_LoadBalancingFunction);//esto es para la 1 parte del archivo 13
			$filas_LoadBalancingFunction_rnd  = $LoadBalancingFunction ->getHighestRow();
			$Column_LoadBalancingFunction_rnd = $LoadBalancingFunction ->getHighestColumn();
			$NumColumn_LoadBalancingFunction  = PHPExcel_Cell::columnIndexFromString($Column_LoadBalancingFunction_rnd);
			for ($i=2; $i <=$filas_LoadBalancingFunction_rnd; $i++) { 
				for ($x=1; $x <= $NumColumn_LoadBalancingFunction; $x++) {
					$nombre_campo_LoadBalancingFunction = $LoadBalancingFunction->getCellByColumnAndRow($x,1)->getValue();
					
					$valor_campo3 = $LoadBalancingFunction->getCellByColumnAndRow($x,$i)->getValue();				   
					if(!empty($nombre_campo_LoadBalancingFunction)){
						$continido_1_13_1 ='
set LoadBalancingFunction=1 '.$nombre_campo_LoadBalancingFunction.' '.$valor_campo3;
						$continido_1_13[] = $continido_1_13_1;
					}					
				}
			}

			$MACConfiguration = $RND->getSheet($name_h_rnd_MACConfiguration);//esto es para la 1 parte del archivo 13
			$filas_MACConfiguration_rnd  = $MACConfiguration ->getHighestRow();
			$Column_MACConfiguration_rnd = $MACConfiguration ->getHighestColumn();
			$NumColumn_MACConfiguration  = PHPExcel_Cell::columnIndexFromString($Column_MACConfiguration_rnd);
			for ($i=2; $i <=$filas_MACConfiguration_rnd; $i++) { 
				for ($x=1; $x <= $NumColumn_MACConfiguration; $x++) {
					$nombre_campo_MACConfiguration = $MACConfiguration->getCellByColumnAndRow($x,1)->getValue();
					
					$valor_campo3 = $MACConfiguration->getCellByColumnAndRow($x,$i)->getValue();				   
					if(!empty($nombre_campo_MACConfiguration)){
						$continido_1_13_1 ='
set MACConfiguration=default,MACConfiguration=1 ulMaxHARQTx '.$valor_campo3;
						$continido_1_13[] .= $continido_1_13_1;
					}					
				}
			}

			$MdtConfiguration = $RND->getSheet($name_h_rnd_MdtConfiguration);//esto es para la 1 parte del archivo 13
			$filas_MdtConfiguration_rnd  = $MdtConfiguration ->getHighestRow();
			$Column_MdtConfiguration_rnd = $MdtConfiguration ->getHighestColumn();
			$NumColumn_MdtConfiguration  = PHPExcel_Cell::columnIndexFromString($Column_MdtConfiguration_rnd);
			for ($i=2; $i <=$filas_MdtConfiguration_rnd; $i++) { 
				for ($x=1; $x <= $NumColumn_MdtConfiguration; $x++) {
					$nombre_campo_MdtConfiguration = $MdtConfiguration->getCellByColumnAndRow($x,1)->getValue();
					
					$valor_campo3 = $MdtConfiguration->getCellByColumnAndRow($x,$i)->getValue();				   
					if(!empty($nombre_campo_MdtConfiguration)){
						$continido_1_13_1 ='
set MdtConfiguration=1 '.$nombre_campo_MdtConfiguration.' '.$valor_campo3;
						$continido_1_13[] .= $continido_1_13_1;
					}					
				}
			}

			$MimoSleepFunction = $RND->getSheet($name_h_rnd_MimoSleepFunction);//esto es para la 1 parte del archivo 13
			$filas_MimoSleepFunction_rnd  = $MimoSleepFunction ->getHighestRow();
			$Column_MimoSleepFunction_rnd = $MimoSleepFunction ->getHighestColumn();
			$NumColumn_MimoSleepFunction  = PHPExcel_Cell::columnIndexFromString($Column_MimoSleepFunction_rnd);
			for ($i=2; $i <=$filas_MimoSleepFunction_rnd; $i++) { 
				for ($x=2; $x <= $NumColumn_MimoSleepFunction; $x++) {
					$nombre_campo_MimoSleepFunction = $MimoSleepFunction->getCellByColumnAndRow($x,1)->getValue();
					$valor_campo1 = $MimoSleepFunction->getCellByColumnAndRow(1,$i)->getValue();
					$valor_campo3 = $MimoSleepFunction->getCellByColumnAndRow($x,$i)->getValue();				   
					if(!empty($nombre_campo_MimoSleepFunction) && !empty($valor_campo1)){
						$continido_1_13_1 ='
set EUtranCellFDD='.$valor_campo1.',MimoSleepFunction=1 '.$nombre_campo_MimoSleepFunction.' '.$valor_campo3;
						$continido_1_13[] .= $continido_1_13_1;
					}					
				}
			}
			if(isset($name_h_rnd_NodeManagementFunction)){
				$NodeManagementFunction = $RND->getSheet($name_h_rnd_NodeManagementFunction);//esto es para la 1 parte del archivo 13
				$filas_NodeManagementFunction_rnd  = $NodeManagementFunction ->getHighestRow();
				$Column_NodeManagementFunction_rnd = $NodeManagementFunction ->getHighestColumn();
				$NumColumn_NodeManagementFunction  = PHPExcel_Cell::columnIndexFromString($Column_NodeManagementFunction_rnd);
				for ($i=2; $i <=$filas_NodeManagementFunction_rnd; $i++) { 
					for ($x=1; $x <= $NumColumn_NodeManagementFunction; $x++) {
						$nombre_campo_NodeManagementFunction = $NodeManagementFunction->getCellByColumnAndRow($x,1)->getValue();
						
						$valor_campo3 = $NodeManagementFunction->getCellByColumnAndRow($x,$i)->getValue();				   
						if(!empty($nombre_campo_NodeManagementFunction)){
							 $continido_1_13_1 ='
set NodeManagementFunction=1 '.$nombre_campo_NodeManagementFunction.' '.$valor_campo3;
							$continido_1_13[] .= $continido_1_13_1;
						}					
					}
				}
			}

			$NonPlannedPciDrxProfile = $RND->getSheet($name_h_rnd_NonPlannedPciDrxProfile);//esto es para la 1 parte del archivo 13
			$filas_NonPlannedPciDrxProfile_rnd  = $NonPlannedPciDrxProfile ->getHighestRow();
			$Column_NonPlannedPciDrxProfile_rnd = $NonPlannedPciDrxProfile ->getHighestColumn();
			$NumColumn_NonPlannedPciDrxProfile  = PHPExcel_Cell::columnIndexFromString($Column_NonPlannedPciDrxProfile_rnd);
			for ($i=2; $i <=$filas_NonPlannedPciDrxProfile_rnd; $i++) { 
				for ($x=1; $x <= $NumColumn_NonPlannedPciDrxProfile; $x++) {
					$nombre_campo_NonPlannedPciDrxProfile = $NonPlannedPciDrxProfile->getCellByColumnAndRow($x,1)->getValue();
					if($nombre_campo_NonPlannedPciDrxProfile == "nonPlannedPciDrxInactivityTimer"){
						$valor_campo1 = $NonPlannedPciDrxProfile->getCellByColumnAndRow($x,$i)->getValue();				   
					}

					$valor_campo3 = $NonPlannedPciDrxProfile->getCellByColumnAndRow($x,$i)->getValue();				   
					if(!empty($nombre_campo_NonPlannedPciDrxProfile) && !empty($valor_campo1)){
						 $continido_1_13_1 ='
set NonPlannedPciDrxProfile=1 '.$nombre_campo_NonPlannedPciDrxProfile.' '.$valor_campo3;
						$continido_1_13[] .= $continido_1_13_1;
					}					
				}
			}
			if(isset($name_h_rnd_OpProfiles)){
				$OpProfiles = $RND->getSheet($name_h_rnd_OpProfiles);//esto es para la 1 parte del archivo 13
				$filas_OpProfiles_rnd  = $OpProfiles ->getHighestRow();
				$Column_OpProfiles_rnd = $OpProfiles ->getHighestColumn();
				$NumColumn_OpProfiles  = PHPExcel_Cell::columnIndexFromString($Column_OpProfiles_rnd);
				for ($i=2; $i <=$filas_OpProfiles_rnd; $i++) { 
					for ($x=1; $x <= $NumColumn_OpProfiles; $x++) {
						$nombre_campo_OpProfiles = $OpProfiles->getCellByColumnAndRow($x,1)->getValue();
						if($nombre_campo_OpProfiles == "profileList_opProfileName"){
							$valor_campo3 = $OpProfiles->getCellByColumnAndRow($x,$i)->getValue();				   
							if(!empty($nombre_campo_OpProfiles)){
								$continido_1_13_1 ='
set OpProfiles=1 '.$nombre_campo_OpProfiles.' '.$valor_campo3;
								$continido_1_13[] .= $continido_1_13_1;
							}
						}
					}
				}
			}

			$Paging_13 = $RND->getSheet($name_h_rnd_Paging);//esto es para la 1 parte del archivo 13
			$filas_Paging_13_rnd  = $Paging_13 ->getHighestRow();
			$Column_Paging_13_rnd = $Paging_13 ->getHighestColumn();
			$NumColumn_Paging_13  = PHPExcel_Cell::columnIndexFromString($Column_Paging_13_rnd);
			for ($i=2; $i <=$filas_Paging_13_rnd; $i++) { 
				for ($x=1; $x <= $NumColumn_Paging_13; $x++) {
					$nombre_campo_Paging_13 = $Paging_13->getCellByColumnAndRow($x,1)->getValue();
					
					$valor_campo3 = $Paging_13->getCellByColumnAndRow($x,$i)->getValue();				   
					if(!empty($nombre_campo_Paging_13)){
						$continido_1_13_1 ='
set Paging=1 '.$nombre_campo_Paging_13.' '.$valor_campo3;
						$continido_1_13[] .= $continido_1_13_1;
					}					
				}
			}

			$PmEventService = $RND->getSheet($name_h_rnd_PmEventService);//esto es para la 1 parte del archivo 13
			$filas_PmEventService_rnd  = $PmEventService ->getHighestRow();
			$Column_PmEventService_rnd = $PmEventService ->getHighestColumn();
			$NumColumn_PmEventService  = PHPExcel_Cell::columnIndexFromString($Column_PmEventService_rnd);
			for ($i=2; $i <=$filas_PmEventService_rnd; $i++) { 
				for ($x=1; $x <= $NumColumn_PmEventService; $x++) {
					$nombre_campo_PmEventService = $PmEventService->getCellByColumnAndRow($x,1)->getValue();
					
					if($nombre_campo_PmEventService != 
						"streamStatusPmCellTrace_fileStatus" &&
 $nombre_campo_PmEventService != "streamStatusPmCellTrace_ipAddress" &&
 $nombre_campo_PmEventService != "streamStatusPmCellTrace_portNumber"  &&
 $nombre_campo_PmEventService != "streamStatusPmCellTrace_scannerId"  &&
 $nombre_campo_PmEventService != "streamStatusPmCellTrace_streamStatus"  &&
 $nombre_campo_PmEventService != "streamStatusPmCellTrace_traceReference"  &&
 $nombre_campo_PmEventService != "streamStatusPmUeTrace_fileStatus"  &&
 $nombre_campo_PmEventService != "streamStatusPmUeTrace_ipAddress"  &&
 $nombre_campo_PmEventService != "streamStatusPmUeTrace_portNumber"  &&
 $nombre_campo_PmEventService != "streamStatusPmUeTrace_scannerId"  &&
 $nombre_campo_PmEventService != "streamStatusPmUeTrace_streamStatus"  &&
 $nombre_campo_PmEventService != "streamStatusPmUeTrace_traceReference"
){
						$valor_campo3 = $PmEventService->getCellByColumnAndRow($x,$i)->getValue();				   
						if(!empty($nombre_campo_PmEventService)){
							$continido_1_13_1 ='
set PmEventService=1 '.$nombre_campo_PmEventService.' '.$valor_campo3;
							$continido_1_13[] .= $continido_1_13_1;
						}
					}					
				}
			}
			
			if(isset($name_h_rnd_PmService)){
				$PmService = $RND->getSheet($name_h_rnd_PmService);//esto es para la 1 parte del archivo 13
				$filas_PmService_rnd  = $PmService ->getHighestRow();
				$Column_PmService_rnd = $PmService ->getHighestColumn();
				$NumColumn_PmService  = PHPExcel_Cell::columnIndexFromString($Column_PmService_rnd);
				for ($i=2; $i <=$filas_PmService_rnd; $i++) { 
					for ($x=1; $x <= $NumColumn_PmService; $x++) {
						$nombre_campo_PmService = $PmService->getCellByColumnAndRow($x,1)->getValue();
						
						$valor_campo3 = $PmService->getCellByColumnAndRow($x,$i)->getValue();				   
						if(!empty($nombre_campo_PmService)){
							$continido_1_13_1 ='
set PmService=1 '.$nombre_campo_PmService.' '.$valor_campo3;
							$continido_1_13[] .= $continido_1_13_1;
						}					
					}
				}
			}

			$PreschedulingProfile = $RND->getSheet($name_h_rnd_PreschedulingProfile);//esto es para la 1 parte del archivo 13
			$filas_PreschedulingProfile_rnd  = $PreschedulingProfile ->getHighestRow();
			$Column_PreschedulingProfile_rnd = $PreschedulingProfile ->getHighestColumn();
			$NumColumn_PreschedulingProfile  = PHPExcel_Cell::columnIndexFromString($Column_PreschedulingProfile_rnd);
			for ($i=2; $i <=$filas_PreschedulingProfile_rnd; $i++) { 
				for ($x=1; $x <= $NumColumn_PreschedulingProfile; $x++) {
					$nombre_campo_PreschedulingProfile = $PreschedulingProfile->getCellByColumnAndRow($x,1)->getValue();
					
					$valor_campo3 = $PreschedulingProfile->getCellByColumnAndRow($x,$i)->getValue();				   
					if(!empty($nombre_campo_PreschedulingProfile)){
						$continido_1_13_1 ='
set PreschedulingProfile=initial '.$nombre_campo_PreschedulingProfile.' '.$valor_campo3;
						$continido_1_13[] .= $continido_1_13_1;
					}					
				}
			}

			$QciProfilePredefined = $RND->getSheet($name_h_rnd_QciProfilePredefined);//esto es para la 1 parte del archivo 13
			$filas_QciProfilePredefined_rnd  = $QciProfilePredefined ->getHighestRow();
			$Column_QciProfilePredefined_rnd = $QciProfilePredefined ->getHighestColumn();
			$NumColumn_QciProfilePredefined  = PHPExcel_Cell::columnIndexFromString($Column_QciProfilePredefined_rnd);
			for ($i=2; $i <=$filas_QciProfilePredefined_rnd; $i++) { 
				for ($x=1; $x <= $NumColumn_QciProfilePredefined; $x++) {
					$nombre_campo_QciProfilePredefined = $QciProfilePredefined->getCellByColumnAndRow($x,1)->getValue();
					$nombre_campo_QciProfilePredefined_1 = $QciProfilePredefined->getCellByColumnAndRow(1,$i)->getValue();
					$valor_campo3 = $QciProfilePredefined->getCellByColumnAndRow($x,$i)->getValue();
					if($nombre_campo_QciProfilePredefined != 
						"streamStatusPmCellTrace_fileStatus" &&
 $nombre_campo_QciProfilePredefined != "QciProfilePredefined" &&
 $nombre_campo_QciProfilePredefined != "measReportConfigParams_a1ThresholdRsrpPrimOffset"  &&
 $nombre_campo_QciProfilePredefined != "measReportConfigParams_a5Threshold1RsrqOffset"  &&
 $nombre_campo_QciProfilePredefined != "measReportConfigParams_a5Threshold2RsrpOffset"  &&
 $nombre_campo_QciProfilePredefined != "measReportConfigParams_a5Threshold2RsrqOffset"  &&
 $nombre_campo_QciProfilePredefined != "measReportConfigParams_b2Threshold1RsrpCdma2000Offset"  &&
 $nombre_campo_QciProfilePredefined != "measReportConfigParams_b2Threshold2Cdma2000Offset"  &&
 $nombre_campo_QciProfilePredefined != "measReportConfigParams_b2Threshold1RsrpGeranOffset"  &&
 $nombre_campo_QciProfilePredefined != "measReportConfigParams_b2Threshold2GeranOffset"  &&
 $nombre_campo_QciProfilePredefined != "measReportConfigParams_b2Threshold1RsrpUtraOffset"  &&
 $nombre_campo_QciProfilePredefined != "measReportConfigParams_a1ThresholdRsrpSecOffset"   &&
 $nombre_campo_QciProfilePredefined != "measReportConfigParams_b2Threshold1RsrqUtraOffset"  &&
 $nombre_campo_QciProfilePredefined != "measReportConfigParams_b2Threshold2EcNoUtraOffset"  &&
 $nombre_campo_QciProfilePredefined != "measReportConfigParams_b2Threshold2RscpUtraOffset"  &&
 $nombre_campo_QciProfilePredefined != "measReportConfigParams_a1ThresholdRsrqPrimOffset"  &&
 $nombre_campo_QciProfilePredefined != "measReportConfigParams_a1ThresholdRsrqSecOffset"  &&
 $nombre_campo_QciProfilePredefined != "measReportConfigParams_a2ThresholdRsrpPrimOffset"  &&
 $nombre_campo_QciProfilePredefined != "measReportConfigParams_a2ThresholdRsrpSecOffset"  &&
 $nombre_campo_QciProfilePredefined != "measReportConfigParams_a2ThresholdRsrqPrimOffset"  &&
 $nombre_campo_QciProfilePredefined != "measReportConfigParams_a2ThresholdRsrqSecOffset"  &&
 $nombre_campo_QciProfilePredefined != "measReportConfigParams_b2Threshold1RsrqCdma2000Offset"  &&
 $nombre_campo_QciProfilePredefined != "measReportConfigParams_b2Threshold1RsrqGeranOffset"  &&
 $nombre_campo_QciProfilePredefined != "measReportConfigParams_a5Threshold1RsrpOffset"
){				   
						if(!empty($nombre_campo_QciProfilePredefined) && !empty($nombre_campo_QciProfilePredefined_1)){
							$continido_1_13_1 ='
set QciTable=default,QciProfilePredefined='.$nombre_campo_QciProfilePredefined_1.' '.$nombre_campo_QciProfilePredefined.' '.$valor_campo3;
							$continido_1_13[] .= $continido_1_13_1;
						}
					}					
				}
			}

			$Rcs = $RND->getSheet($name_h_rnd_Rcs);//esto es para la 1 parte del archivo 13
			$filas_Rcs_rnd  = $Rcs ->getHighestRow();
			$Column_Rcs_rnd = $Rcs ->getHighestColumn();
			$NumColumn_Rcs  = PHPExcel_Cell::columnIndexFromString($Column_Rcs_rnd);
			for ($i=2; $i <=$filas_Rcs_rnd; $i++) { 
				for ($x=1; $x <= $NumColumn_Rcs; $x++) {
					$nombre_campo_Rcs = $Rcs->getCellByColumnAndRow($x,1)->getValue();
					
					$valor_campo3 = $Rcs->getCellByColumnAndRow($x,$i)->getValue();				   
					if(!empty($nombre_campo_Rcs)){
						$continido_1_13_1 ='
set Rcs=1 '.$nombre_campo_Rcs.' '.$valor_campo3;
						$continido_1_13[] = $continido_1_13_1;
					}					
				}
			}

			$ReportConfigA1Sec = $RND->getSheet($name_h_rnd_ReportConfigA1Sec);//esto es para la 1 parte del archivo 13
			$filas_ReportConfigA1Sec_rnd  = $ReportConfigA1Sec ->getHighestRow();
			$Column_ReportConfigA1Sec_rnd = $ReportConfigA1Sec ->getHighestColumn();
			$NumColumn_ReportConfigA1Sec  = PHPExcel_Cell::columnIndexFromString($Column_ReportConfigA1Sec_rnd);
			for ($i=2; $i <=$filas_ReportConfigA1Sec_rnd; $i++) { 
				for ($x=2; $x <= $NumColumn_ReportConfigA1Sec; $x++) {
					$nombre_campo_ReportConfigA1Sec = $ReportConfigA1Sec->getCellByColumnAndRow($x,1)->getValue();
					$valor_campo1 = $ReportConfigA1Sec->getCellByColumnAndRow(1,$i)->getValue();
														
				}
			}

			$ReportConfigA5 		= $RND->getSheet($name_h_rnd_ReportConfigA5);
			$ReportConfigA4 		= $RND->getSheet($name_h_rnd_ReportConfigA4);
			$ReportConfigA1Prim_13 	= $RND->getSheet($name_h_rnd_ReportConfigA1Prim);//esto es para la 1 parte del archivo 13
			$ReportConfigA5Anr_13 	= $RND->getSheet($name_h_rnd_ReportConfigA5Anr);
			$ReportConfigA5SoftLock = $RND->getSheet($name_h_rnd_ReportConfigA5SoftLock);
			$ReportConfigA5UlTrig 	= $RND->getSheet($name_h_rnd_ReportConfigA5UlTrig);
			$ReportConfigB1Geran 	= $RND->getSheet($name_h_rnd_ReportConfigB1Geran);
			$ReportConfigB1Utra 	= $RND->getSheet($name_h_rnd_ReportConfigB1Utra);
			$ReportConfigB2Geran 	= $RND->getSheet($name_h_rnd_ReportConfigB2Geran);
			$ReportConfigB2Utra_13 	= $RND->getSheet($name_h_rnd_ReportConfigB2Utra);
			$ReportConfigB2UtraUlTrig 	= $RND->getSheet($name_h_rnd_ReportConfigB2UtraUlTrig);
			$ReportConfigCsfbUtra 	= $RND->getSheet($name_h_rnd_ReportConfigCsfbUtra);
			$ReportConfigCsg 	= $RND->getSheet($name_h_rnd_ReportConfigCsg);
			$ReportConfigEUtraBadCovPrim_13 	= $RND->getSheet($name_h_rnd_ReportConfigEUtraBadCovPrim);
			$ReportConfigEUtraBadCovSec_13 	= $RND->getSheet($name_h_rnd_ReportConfigEUtraBadCovSec);
			$ReportConfigEUtraBestCell_13 	= $RND->getSheet($name_h_rnd_ReportConfigEUtraBestCell);
			$ReportConfigEUtraBestCellAnr_13 	= $RND->getSheet($name_h_rnd_ReportConfigEUtraBestCellAnr);
			$ReportConfigEUtraIFA3UlTrig 	= $RND->getSheet($name_h_rnd_ReportConfigEUtraIFA3UlTrig);
			$ReportConfigB2GeranUlTrig 	= $RND->getSheet($name_h_rnd_ReportConfigB2GeranUlTrig);
			$ReportConfigEUtraIFBestCell 	= $RND->getSheet($name_h_rnd_ReportConfigEUtraIFBestCell);
			$ReportConfigEUtraInterFreqLb	= $RND->getSheet($name_h_rnd_ReportConfigEUtraInterFreqLb);
			$ReportConfigEUtraInterFreqMbms 	= $RND->getSheet($name_h_rnd_ReportConfigEUtraInterFreqMbms);
			$ReportConfigInterRatLb 	= $RND->getSheet($name_h_rnd_ReportConfigInterRatLb);
			$ReportConfigSCellA1A2_13 	= $RND->getSheet($name_h_rnd_ReportConfigSCellA1A2);
			$ReportConfigSCellA4 	= $RND->getSheet($name_h_rnd_ReportConfigSCellA4);
			$ReportConfigSCellA6 	= $RND->getSheet($name_h_rnd_ReportConfigSCellA6);
			$ReportConfigSearch_13 	= $RND->getSheet($name_h_rnd_ReportConfigSearch);

			$filas_ReportConfigSearch_13_rnd  = $ReportConfigSearch_13 ->getHighestRow();
			$Column_ReportConfigSearch_13_rnd = $ReportConfigSearch_13 ->getHighestColumn();
			$NumColumn_ReportConfigSearch_13  = PHPExcel_Cell::columnIndexFromString($Column_ReportConfigSearch_13_rnd);
			for ($i=2; $i <=$filas_ReportConfigSearch_13_rnd; $i++) { 
				for ($x=2; $x <= $NumColumn_ReportConfigSearch_13; $x++) {
					$nombre_campo_ReportConfigA1Prim_13_1 = $ReportConfigA1Prim_13->getCellByColumnAndRow(1,1)->getValue();
					$nombre_campo_ReportConfigA1Prim_13 = $ReportConfigA1Prim_13->getCellByColumnAndRow($x,1)->getValue();
					$valor_campo1 = $ReportConfigA1Prim_13->getCellByColumnAndRow(1,$i)->getValue();
					$valor_campo3 = $ReportConfigA1Prim_13->getCellByColumnAndRow($x,$i)->getValue();
					$valor_campo1_1 = $ReportConfigA1Prim_13->getCellByColumnAndRow(1,$i)->getValue();
					$nombre_campo_ReportConfigA1Sec = $ReportConfigA1Sec->getCellByColumnAndRow($x,1)->getValue();
					$valor_campo4 = $ReportConfigA1Sec->getCellByColumnAndRow($x,$i)->getValue();				   
					if(!empty($nombre_campo_ReportConfigA1Prim_13) && !empty($valor_campo1)){
						if($valor_campo1 == $valor_campo1_1){
							//if($nombre_campo_ReportConfigA1Prim_13 == "a1ThresholdRsrpPrim"){
								$continido_1_13_1 ='
set EUtranCellFDD='.$valor_campo1.',UeMeasControl=1,ReportConfigA1Prim=1 '.$nombre_campo_ReportConfigA1Prim_13.' '.$valor_campo3;
								$continido_1_13[] = $continido_1_13_1;
							//}							
						}
					}					
				}

				for ($x=2; $x <= $NumColumn_ReportConfigSearch_13; $x++) {
					$nombre_campo_ReportConfigA1Prim_13_1 = $ReportConfigA1Prim_13->getCellByColumnAndRow(1,1)->getValue();
					$nombre_campo_ReportConfigA1Prim_13 = $ReportConfigA1Prim_13->getCellByColumnAndRow($x,1)->getValue();
					$valor_campo1 = $ReportConfigA1Prim_13->getCellByColumnAndRow(1,$i)->getValue();
					$valor_campo3 = $ReportConfigA1Prim_13->getCellByColumnAndRow($x,$i)->getValue();
					$valor_campo1_1 = $ReportConfigA1Prim_13->getCellByColumnAndRow(1,$i)->getValue();
					$nombre_campo_ReportConfigA1Sec = $ReportConfigA1Sec->getCellByColumnAndRow($x,1)->getValue();
					$valor_campo4 = $ReportConfigA1Sec->getCellByColumnAndRow($x,$i)->getValue();				   
					if(!empty($nombre_campo_ReportConfigA1Prim_13)&& !empty($valor_campo1)){
						if($valor_campo1 == $valor_campo1_1){							
							//if($nombre_campo_ReportConfigA1Sec == "a1ThresholdRsrpSec"){
								$continido_1_13_1 ='
set EUtranCellFDD='.$valor_campo1.',UeMeasControl=1,ReportConfigA1Sec=1 '.$nombre_campo_ReportConfigA1Sec.' '.$valor_campo4;
								$continido_1_13[] = $continido_1_13_1;
							//}
							
						}
					}					
				}

				for ($x=2; $x <= $NumColumn_ReportConfigSearch_13; $x++) {
					$nombre_campo_ReportConfigA1Prim_13_1 = $ReportConfigA1Prim_13->getCellByColumnAndRow(1,1)->getValue();
					$nombre_campo_ReportConfigA1Prim_13 = $ReportConfigA1Prim_13->getCellByColumnAndRow(1,$i)->getValue();
					$valor_campo1 = $ReportConfigA1Prim_13->getCellByColumnAndRow(1,$i)->getValue();					
					$valor_campo1_1 = $ReportConfigA1Prim_13->getCellByColumnAndRow(1,$i)->getValue();
					$nombre_campo_ReportConfigA4 = $ReportConfigA4->getCellByColumnAndRow($x,1)->getValue();
					$valor_campo4 = $ReportConfigA4->getCellByColumnAndRow($x,$i)->getValue();				   
					if(!empty($nombre_campo_ReportConfigA4) && !empty($valor_campo1)){
						if($valor_campo1 == $valor_campo1_1){							
							//if($nombre_campo_ReportConfigA4 == "a1ThresholdRsrpSec"){
								$continido_1_13_1 ='
set EUtranCellFDD='.$valor_campo1.',UeMeasControl=1,ReportConfigA4=1 '.$nombre_campo_ReportConfigA4.' '.$valor_campo4;
								$continido_1_13[] = $continido_1_13_1;
							//}
							
						}
					}					
				}

				for ($x=2; $x <= $NumColumn_ReportConfigSearch_13; $x++) {
					$nombre_campo_ReportConfigA1Prim_13_1 = $ReportConfigA1Prim_13->getCellByColumnAndRow(1,1)->getValue();
					$nombre_campo_ReportConfigA1Prim_13 = $ReportConfigA1Prim_13->getCellByColumnAndRow(1,$i)->getValue();
					$valor_campo1 = $ReportConfigA1Prim_13->getCellByColumnAndRow(1,$i)->getValue();					
					$valor_campo1_1 = $ReportConfigA1Prim_13->getCellByColumnAndRow(1,$i)->getValue();
					$nombre_campo_ReportConfigA5 = $ReportConfigA5->getCellByColumnAndRow($x,1)->getValue();
					$valor_campo4 = $ReportConfigA5->getCellByColumnAndRow($x,$i)->getValue();				   
					if(!empty($nombre_campo_ReportConfigA5) && !empty($valor_campo1)){
						if($valor_campo1 == $valor_campo1_1){							
							//if($nombre_campo_ReportConfigA5 == "a1ThresholdRsrpSec"){
								$continido_1_13_1 ='
set EUtranCellFDD='.$valor_campo1.',UeMeasControl=1,ReportConfigA5=1 '.$nombre_campo_ReportConfigA5.' '.$valor_campo4;
								$continido_1_13[] = $continido_1_13_1;
							//}
							
						}
					}					
				}

				for ($x=2; $x <= $NumColumn_ReportConfigSearch_13; $x++) {
					$nombre_campo_ReportConfigA1Prim_13_1 = $ReportConfigA1Prim_13->getCellByColumnAndRow(1,1)->getValue();
					$nombre_campo_ReportConfigA1Prim_13 = $ReportConfigA1Prim_13->getCellByColumnAndRow(1,$i)->getValue();
					$valor_campo1 = $ReportConfigA1Prim_13->getCellByColumnAndRow(1,$i)->getValue();					
					$valor_campo1_1 = $ReportConfigA1Prim_13->getCellByColumnAndRow(1,$i)->getValue();
					$nombre_campo_ReportConfigA5Anr_13 = $ReportConfigA5Anr_13->getCellByColumnAndRow($x,1)->getValue();
					$valor_campo4 = $ReportConfigA5Anr_13->getCellByColumnAndRow($x,$i)->getValue();				   
					if(!empty($nombre_campo_ReportConfigA5Anr_13) && !empty($valor_campo1)){
						if($valor_campo1 == $valor_campo1_1){							
							//if($nombre_campo_$ReportConfigA5Anr_13 == "a1ThresholdRsrpSec"){
								$continido_1_13_1 ='
set EUtranCellFDD='.$valor_campo1.',UeMeasControl=1,ReportConfigA5Anr=1 '.$nombre_campo_ReportConfigA5Anr_13.' '.$valor_campo4;
								$continido_1_13[] = $continido_1_13_1;
							//}
							
						}
					}					
				}

				for ($x=2; $x <= $NumColumn_ReportConfigSearch_13; $x++) {
					$nombre_campo_ReportConfigA1Prim_13_1 = $ReportConfigA1Prim_13->getCellByColumnAndRow(1,1)->getValue();
					$nombre_campo_ReportConfigA1Prim_13 = $ReportConfigA1Prim_13->getCellByColumnAndRow(1,$i)->getValue();
					$valor_campo1 = $ReportConfigA1Prim_13->getCellByColumnAndRow(1,$i)->getValue();					
					$valor_campo1_1 = $ReportConfigA1Prim_13->getCellByColumnAndRow(1,$i)->getValue();
					$nombre_campo_ReportConfigA5SoftLock = $ReportConfigA5SoftLock->getCellByColumnAndRow($x,1)->getValue();//apartir de aqui se hace lo cambio
					$valor_campo4 = $ReportConfigA5SoftLock->getCellByColumnAndRow($x,$i)->getValue();				   
					if(!empty($nombre_campo_ReportConfigA5SoftLock) && !empty($valor_campo1)){
						if($valor_campo1 == $valor_campo1_1){							
							//if($nombre_campo_$ReportConfigA5SoftLock == "a1ThresholdRsrpSec"){
								$continido_1_13_1 ='
set EUtranCellFDD='.$valor_campo1.',UeMeasControl=1,ReportConfigA5SoftLock=1 '.$nombre_campo_ReportConfigA5SoftLock.' '.$valor_campo4;
								$continido_1_13[] = $continido_1_13_1;
							//}
							
						}
					}					
				}

				for ($x=2; $x <= $NumColumn_ReportConfigSearch_13; $x++) {
					$nombre_campo_ReportConfigA1Prim_13_1 = $ReportConfigA1Prim_13->getCellByColumnAndRow(1,1)->getValue();
					$nombre_campo_ReportConfigA1Prim_13 = $ReportConfigA1Prim_13->getCellByColumnAndRow(1,$i)->getValue();
					$valor_campo1 = $ReportConfigA1Prim_13->getCellByColumnAndRow(1,$i)->getValue();					
					$valor_campo1_1 = $ReportConfigA1Prim_13->getCellByColumnAndRow(1,$i)->getValue();
					$nombre_campo_ReportConfigA5UlTrig = $ReportConfigA5UlTrig->getCellByColumnAndRow($x,1)->getValue();//apartir de aqui se hace lo cambio
					$valor_campo4 = $ReportConfigA5UlTrig->getCellByColumnAndRow($x,$i)->getValue();				   
					if(!empty($nombre_campo_ReportConfigA5UlTrig) && !empty($valor_campo1)){
						if($valor_campo1 == $valor_campo1_1){							
							//if($nombre_campo_$ReportConfigA5UlTrig == "a1ThresholdRsrpSec"){
								$continido_1_13_1 ='
set EUtranCellFDD='.$valor_campo1.',UeMeasControl=1,ReportConfigA5UlTrig=1 '.$nombre_campo_ReportConfigA5UlTrig.' '.$valor_campo4;
								$continido_1_13[] = $continido_1_13_1;
							//}
							
						}
					}					
				}

				for ($x=2; $x <= $NumColumn_ReportConfigSearch_13; $x++) {
					$nombre_campo_ReportConfigA1Prim_13_1 = $ReportConfigA1Prim_13->getCellByColumnAndRow(1,1)->getValue();
					$nombre_campo_ReportConfigA1Prim_13 = $ReportConfigA1Prim_13->getCellByColumnAndRow(1,$i)->getValue();
					$valor_campo1 = $ReportConfigA1Prim_13->getCellByColumnAndRow(1,$i)->getValue();					
					$valor_campo1_1 = $ReportConfigA1Prim_13->getCellByColumnAndRow(1,$i)->getValue();
					$nombre_campo_ReportConfigB1Geran = $ReportConfigB1Geran->getCellByColumnAndRow($x,1)->getValue();//apartir de aqui se hace lo cambio
					$valor_campo4 = $ReportConfigB1Geran->getCellByColumnAndRow($x,$i)->getValue();				   
					if(!empty($nombre_campo_ReportConfigB1Geran) && !empty($valor_campo1)){
						if($valor_campo1 == $valor_campo1_1){							
							//if($nombre_campo_$ReportConfigB1Geran == "a1ThresholdRsrpSec"){
								$continido_1_13_1 ='
set EUtranCellFDD='.$valor_campo1.',UeMeasControl=1,ReportConfigB1Geran=1 '.$nombre_campo_ReportConfigB1Geran.' '.$valor_campo4;
								$continido_1_13[] = $continido_1_13_1;
							//}
							
						}
					}					
				}

				for ($x=2; $x <= $NumColumn_ReportConfigSearch_13; $x++) {
					$nombre_campo_ReportConfigA1Prim_13_1 = $ReportConfigA1Prim_13->getCellByColumnAndRow(1,1)->getValue();
					$nombre_campo_ReportConfigA1Prim_13 = $ReportConfigA1Prim_13->getCellByColumnAndRow(1,$i)->getValue();
					$valor_campo1 = $ReportConfigA1Prim_13->getCellByColumnAndRow(1,$i)->getValue();					
					$valor_campo1_1 = $ReportConfigA1Prim_13->getCellByColumnAndRow(1,$i)->getValue();
					$nombre_campo_ReportConfigB1Utra = $ReportConfigB1Utra->getCellByColumnAndRow($x,1)->getValue();//apartir de aqui se hace lo cambio
					$valor_campo4 = $ReportConfigB1Utra->getCellByColumnAndRow($x,$i)->getValue();				   
					if(!empty($nombre_campo_ReportConfigB1Utra) && !empty($valor_campo1)){
						if($valor_campo1 == $valor_campo1_1){							
							//if($nombre_campo_$ReportConfigB1Utra == "a1ThresholdRsrpSec"){
								$continido_1_13_1 ='
set EUtranCellFDD='.$valor_campo1.',UeMeasControl=1,ReportConfigB1Utra=1 '.$nombre_campo_ReportConfigB1Utra.' '.$valor_campo4;
								$continido_1_13[] = $continido_1_13_1;
							//}
							
						}
					}					
				}

				for ($x=2; $x <= $NumColumn_ReportConfigSearch_13; $x++) {
					$nombre_campo_ReportConfigA1Prim_13_1 = $ReportConfigA1Prim_13->getCellByColumnAndRow(1,1)->getValue();
					$nombre_campo_ReportConfigA1Prim_13 = $ReportConfigA1Prim_13->getCellByColumnAndRow(1,$i)->getValue();
					$valor_campo1 = $ReportConfigA1Prim_13->getCellByColumnAndRow(1,$i)->getValue();					
					$valor_campo1_1 = $ReportConfigA1Prim_13->getCellByColumnAndRow(1,$i)->getValue();
					$nombre_campo_ReportConfigB2Geran = $ReportConfigB2Geran->getCellByColumnAndRow($x,1)->getValue();//apartir de aqui se hace lo cambio
					$valor_campo4 = $ReportConfigB2Geran->getCellByColumnAndRow($x,$i)->getValue();				   
					if(!empty($nombre_campo_ReportConfigB2Geran) && !empty($valor_campo1)){
						if($valor_campo1 == $valor_campo1_1){							
							//if($nombre_campo_$ReportConfigB2Geran == "a1ThresholdRsrpSec"){
								$continido_1_13_1 ='
set EUtranCellFDD='.$valor_campo1.',UeMeasControl=1,ReportConfigB2Geran=1 '.$nombre_campo_ReportConfigB2Geran.' '.$valor_campo4;
								$continido_1_13[] = $continido_1_13_1;
							//}
							
						}
					}					
				}

				for ($x=2; $x <= $NumColumn_ReportConfigSearch_13; $x++) {
					$nombre_campo_ReportConfigA1Prim_13_1 = $ReportConfigA1Prim_13->getCellByColumnAndRow(1,1)->getValue();
					$nombre_campo_ReportConfigA1Prim_13 = $ReportConfigA1Prim_13->getCellByColumnAndRow(1,$i)->getValue();
					$valor_campo1 = $ReportConfigA1Prim_13->getCellByColumnAndRow(1,$i)->getValue();					
					$valor_campo1_1 = $ReportConfigA1Prim_13->getCellByColumnAndRow(1,$i)->getValue();
					$nombre_campo_ReportConfigB2GeranUlTrig = $ReportConfigB2GeranUlTrig->getCellByColumnAndRow($x,1)->getValue();//apartir de aqui se hace lo cambio
					$valor_campo4 = $ReportConfigB2GeranUlTrig->getCellByColumnAndRow($x,$i)->getValue();				   
					if(!empty($nombre_campo_ReportConfigB2GeranUlTrig) && !empty($valor_campo1)){
						if($valor_campo1 == $valor_campo1_1){							
							//if($nombre_campo_$ReportConfigB2GeranUlTrig == "a1ThresholdRsrpSec"){
								$continido_1_13_1 ='
set EUtranCellFDD='.$valor_campo1.',UeMeasControl=1,ReportConfigB2GeranUlTrig=1 '.$nombre_campo_ReportConfigB2GeranUlTrig.' '.$valor_campo4;
								$continido_1_13[] = $continido_1_13_1;
							//}
							
						}
					}					
				}

				for ($x=2; $x <= $NumColumn_ReportConfigSearch_13; $x++) {
					$nombre_campo_ReportConfigA1Prim_13_1 = $ReportConfigA1Prim_13->getCellByColumnAndRow(1,1)->getValue();
					$nombre_campo_ReportConfigA1Prim_13 = $ReportConfigA1Prim_13->getCellByColumnAndRow(1,$i)->getValue();
					$valor_campo1 = $ReportConfigA1Prim_13->getCellByColumnAndRow(1,$i)->getValue();					
					$valor_campo1_1 = $ReportConfigA1Prim_13->getCellByColumnAndRow(1,$i)->getValue();
					$nombre_campo_ReportConfigB2Utra_13 = $ReportConfigB2Utra_13->getCellByColumnAndRow($x,1)->getValue();//apartir de aqui se hace lo cambio
					$valor_campo4 = $ReportConfigB2Utra_13->getCellByColumnAndRow($x,$i)->getValue();				   
					if(!empty($nombre_campo_ReportConfigB2Utra_13) && !empty($valor_campo1)){
						if($valor_campo1 == $valor_campo1_1){							
							//if($nombre_campo_$ReportConfigB2Utra_13 == "a1ThresholdRsrpSec"){
								$continido_1_13_1 ='
set EUtranCellFDD='.$valor_campo1.',UeMeasControl=1,ReportConfigB2Utra=1 '.$nombre_campo_ReportConfigB2Utra_13.' '.$valor_campo4;
								$continido_1_13[] = $continido_1_13_1;
							//}
							
						}
					}					
				}

				for ($x=2; $x <= $NumColumn_ReportConfigSearch_13; $x++) {
					$nombre_campo_ReportConfigA1Prim_13_1 = $ReportConfigA1Prim_13->getCellByColumnAndRow(1,1)->getValue();
					$nombre_campo_ReportConfigA1Prim_13 = $ReportConfigA1Prim_13->getCellByColumnAndRow(1,$i)->getValue();
					$valor_campo1 = $ReportConfigA1Prim_13->getCellByColumnAndRow(1,$i)->getValue();					
					$valor_campo1_1 = $ReportConfigA1Prim_13->getCellByColumnAndRow(1,$i)->getValue();
					$nombre_campo_ReportConfigB2UtraUlTrig = $ReportConfigB2UtraUlTrig->getCellByColumnAndRow($x,1)->getValue();//apartir de aqui se hace lo cambio
					$valor_campo4 = $ReportConfigB2UtraUlTrig->getCellByColumnAndRow($x,$i)->getValue();				   
					if(!empty($nombre_campo_ReportConfigB2UtraUlTrig) && !empty($valor_campo1)){
						if($valor_campo1 == $valor_campo1_1){							
							//if($nombre_campo_$ReportConfigB2UtraUlTrig == "a1ThresholdRsrpSec"){
								$continido_1_13_1 ='
set EUtranCellFDD='.$valor_campo1.',UeMeasControl=1,ReportConfigB2UtraUlTrig=1 '.$nombre_campo_ReportConfigB2UtraUlTrig.' '.$valor_campo4;
								$continido_1_13[] = $continido_1_13_1;
							//}
							
						}
					}					
				}

				for ($x=2; $x <= $NumColumn_ReportConfigSearch_13; $x++) {
					$nombre_campo_ReportConfigA1Prim_13_1 = $ReportConfigA1Prim_13->getCellByColumnAndRow(1,1)->getValue();
					$nombre_campo_ReportConfigA1Prim_13 = $ReportConfigA1Prim_13->getCellByColumnAndRow(1,$i)->getValue();
					$valor_campo1 = $ReportConfigA1Prim_13->getCellByColumnAndRow(1,$i)->getValue();					
					$valor_campo1_1 = $ReportConfigA1Prim_13->getCellByColumnAndRow(1,$i)->getValue();
					$nombre_campo_ReportConfigCsfbUtra = $ReportConfigCsfbUtra->getCellByColumnAndRow($x,1)->getValue();//apartir de aqui se hace lo cambio
					$valor_campo4 = $ReportConfigCsfbUtra->getCellByColumnAndRow($x,$i)->getValue();				   
					if(!empty($nombre_campo_ReportConfigCsfbUtra) && !empty($valor_campo1)){
						if($valor_campo1 == $valor_campo1_1){							
							//if($nombre_campo_$ReportConfigCsfbUtra == "a1ThresholdRsrpSec"){
								$continido_1_13_1 ='
set EUtranCellFDD='.$valor_campo1.',UeMeasControl=1,ReportConfigCsfbUtra=1 '.$nombre_campo_ReportConfigCsfbUtra.' '.$valor_campo4;
								$continido_1_13[] = $continido_1_13_1;
							//}
							
						}
					}					
				}

				for ($x=2; $x <= $NumColumn_ReportConfigSearch_13; $x++) {
					$nombre_campo_ReportConfigA1Prim_13_1 = $ReportConfigA1Prim_13->getCellByColumnAndRow(1,1)->getValue();
					$nombre_campo_ReportConfigA1Prim_13 = $ReportConfigA1Prim_13->getCellByColumnAndRow(1,$i)->getValue();
					$valor_campo1 = $ReportConfigA1Prim_13->getCellByColumnAndRow(1,$i)->getValue();					
					$valor_campo1_1 = $ReportConfigA1Prim_13->getCellByColumnAndRow(1,$i)->getValue();
					$nombre_campo_ReportConfigCsg = $ReportConfigCsg->getCellByColumnAndRow($x,1)->getValue();//apartir de aqui se hace lo cambio
					$valor_campo4 = $ReportConfigCsg->getCellByColumnAndRow($x,$i)->getValue();				   
					if(!empty($nombre_campo_ReportConfigCsg) && !empty($valor_campo1)){
						if($valor_campo1 == $valor_campo1_1){							
							//if($nombre_campo_$ReportConfigCsg == "a1ThresholdRsrpSec"){
								$continido_1_13_1 ='
set EUtranCellFDD='.$valor_campo1.',UeMeasControl=1,ReportConfigCsg=1 '.$nombre_campo_ReportConfigCsg.' '.$valor_campo4;
								$continido_1_13[] = $continido_1_13_1;
							//}
							
						}
					}					
				}

				for ($x=2; $x <= $NumColumn_ReportConfigSearch_13; $x++) {
					$nombre_campo_ReportConfigA1Prim_13_1 = $ReportConfigA1Prim_13->getCellByColumnAndRow(1,1)->getValue();
					$nombre_campo_ReportConfigA1Prim_13 = $ReportConfigA1Prim_13->getCellByColumnAndRow(1,$i)->getValue();
					$valor_campo1 = $ReportConfigA1Prim_13->getCellByColumnAndRow(1,$i)->getValue();					
					$valor_campo1_1 = $ReportConfigA1Prim_13->getCellByColumnAndRow(1,$i)->getValue();
					$nombre_campo_ReportConfigEUtraBadCovPrim_13 = $ReportConfigEUtraBadCovPrim_13->getCellByColumnAndRow($x,1)->getValue();//apartir de aqui se hace lo cambio
					$valor_campo4 = $ReportConfigEUtraBadCovPrim_13->getCellByColumnAndRow($x,$i)->getValue();				   
					if(!empty($nombre_campo_ReportConfigEUtraBadCovPrim_13) && !empty($valor_campo1)){
						if($valor_campo1 == $valor_campo1_1){							
							//if($nombre_campo_$ReportConfigEUtraBadCovPrim_13 == "a1ThresholdRsrpSec"){
								$continido_1_13_1 ='
set EUtranCellFDD='.$valor_campo1.',UeMeasControl=1,ReportConfigEUtraBadCovPrim=1 '.$nombre_campo_ReportConfigEUtraBadCovPrim_13.' '.$valor_campo4;
								$continido_1_13[] = $continido_1_13_1;
							//}
							
						}
					}					
				}

				for ($x=2; $x <= $NumColumn_ReportConfigSearch_13; $x++) {
					$nombre_campo_ReportConfigA1Prim_13_1 = $ReportConfigA1Prim_13->getCellByColumnAndRow(1,1)->getValue();
					$nombre_campo_ReportConfigA1Prim_13 = $ReportConfigA1Prim_13->getCellByColumnAndRow(1,$i)->getValue();
					$valor_campo1 = $ReportConfigA1Prim_13->getCellByColumnAndRow(1,$i)->getValue();					
					$valor_campo1_1 = $ReportConfigA1Prim_13->getCellByColumnAndRow(1,$i)->getValue();
					$nombre_campo_ReportConfigEUtraBadCovSec_13 = $ReportConfigEUtraBadCovSec_13->getCellByColumnAndRow($x,1)->getValue();//apartir de aqui se hace lo cambio
					$valor_campo4 = $ReportConfigEUtraBadCovSec_13->getCellByColumnAndRow($x,$i)->getValue();				   
					if(!empty($nombre_campo_ReportConfigEUtraBadCovSec_13) && !empty($valor_campo1)){
						if($valor_campo1 == $valor_campo1_1){							
							//if($nombre_campo_$ReportConfigEUtraBadCovSec_13 == "a1ThresholdRsrpSec"){
								$continido_1_13_1 ='
set EUtranCellFDD='.$valor_campo1.',UeMeasControl=1,ReportConfigEUtraBadCovSec=1 '.$nombre_campo_ReportConfigEUtraBadCovSec_13.' '.$valor_campo4;
								$continido_1_13[] = $continido_1_13_1;
							//}
							
						}
					}					
				}

				for ($x=2; $x <= $NumColumn_ReportConfigSearch_13; $x++) {
					$nombre_campo_ReportConfigA1Prim_13_1 = $ReportConfigA1Prim_13->getCellByColumnAndRow(1,1)->getValue();
					$nombre_campo_ReportConfigA1Prim_13 = $ReportConfigA1Prim_13->getCellByColumnAndRow(1,$i)->getValue();
					$valor_campo1 = $ReportConfigA1Prim_13->getCellByColumnAndRow(1,$i)->getValue();					
					$valor_campo1_1 = $ReportConfigA1Prim_13->getCellByColumnAndRow(1,$i)->getValue();
					$nombre_campo_ReportConfigEUtraBestCell_13 = $ReportConfigEUtraBestCell_13->getCellByColumnAndRow($x,1)->getValue();//apartir de aqui se hace lo cambio
					$valor_campo4 = $ReportConfigEUtraBestCell_13->getCellByColumnAndRow($x,$i)->getValue();				   
					if(!empty($nombre_campo_ReportConfigEUtraBestCell_13) && !empty($valor_campo1)){
						if($valor_campo1 == $valor_campo1_1){							
							//if($nombre_campo_$ReportConfigEUtraBestCell_13 == "a1ThresholdRsrpSec"){
								$continido_1_13_1 ='
set EUtranCellFDD='.$valor_campo1.',UeMeasControl=1,ReportConfigEUtraBestCell=1 '.$nombre_campo_ReportConfigEUtraBestCell_13.' '.$valor_campo4;
								$continido_1_13[] = $continido_1_13_1;
							//}
							
						}
					}					
				}

				for ($x=2; $x <= $NumColumn_ReportConfigSearch_13; $x++) {
					$nombre_campo_ReportConfigA1Prim_13_1 = $ReportConfigA1Prim_13->getCellByColumnAndRow(1,1)->getValue();
					$nombre_campo_ReportConfigA1Prim_13 = $ReportConfigA1Prim_13->getCellByColumnAndRow(1,$i)->getValue();
					$valor_campo1 = $ReportConfigA1Prim_13->getCellByColumnAndRow(1,$i)->getValue();					
					$valor_campo1_1 = $ReportConfigA1Prim_13->getCellByColumnAndRow(1,$i)->getValue();
					$nombre_campo_ReportConfigEUtraBestCellAnr_13 = $ReportConfigEUtraBestCellAnr_13->getCellByColumnAndRow($x,1)->getValue();//apartir de aqui se hace lo cambio
					$valor_campo4 = $ReportConfigEUtraBestCellAnr_13->getCellByColumnAndRow($x,$i)->getValue();				   
					if(!empty($nombre_campo_ReportConfigEUtraBestCellAnr_13) && !empty($valor_campo1)){
						if($valor_campo1 == $valor_campo1_1){							
							//if($nombre_campo_$ReportConfigEUtraBestCellAnr_13 == "a1ThresholdRsrpSec"){
								$continido_1_13_1 ='
set EUtranCellFDD='.$valor_campo1.',UeMeasControl=1,ReportConfigEUtraBestCellAnr=1 '.$nombre_campo_ReportConfigEUtraBestCellAnr_13.' '.$valor_campo4;
								$continido_1_13[] = $continido_1_13_1;
							//}
							
						}
					}					
				}

				for ($x=2; $x <= $NumColumn_ReportConfigSearch_13; $x++) {
					$nombre_campo_ReportConfigA1Prim_13_1 = $ReportConfigA1Prim_13->getCellByColumnAndRow(1,1)->getValue();
					$nombre_campo_ReportConfigA1Prim_13 = $ReportConfigA1Prim_13->getCellByColumnAndRow(1,$i)->getValue();
					$valor_campo1 = $ReportConfigA1Prim_13->getCellByColumnAndRow(1,$i)->getValue();					
					$valor_campo1_1 = $ReportConfigA1Prim_13->getCellByColumnAndRow(1,$i)->getValue();
					$nombre_campo_ReportConfigEUtraIFA3UlTrig = $ReportConfigEUtraIFA3UlTrig->getCellByColumnAndRow($x,1)->getValue();//apartir de aqui se hace lo cambio
					$valor_campo4 = $ReportConfigEUtraIFA3UlTrig->getCellByColumnAndRow($x,$i)->getValue();				   
					if(!empty($nombre_campo_ReportConfigEUtraIFA3UlTrig) && !empty($valor_campo1)){
						if($valor_campo1 == $valor_campo1_1){							
							//if($nombre_campo_$ReportConfigEUtraIFA3UlTrig == "a1ThresholdRsrpSec"){
								$continido_1_13_1 ='
set EUtranCellFDD='.$valor_campo1.',UeMeasControl=1,ReportConfigEUtraIFA3UlTrig=1 '.$nombre_campo_ReportConfigEUtraIFA3UlTrig.' '.$valor_campo4;
								$continido_1_13[] = $continido_1_13_1;
							//}
							
						}
					}					
				}

				for ($x=2; $x <= $NumColumn_ReportConfigSearch_13; $x++) {
					$nombre_campo_ReportConfigA1Prim_13_1 = $ReportConfigA1Prim_13->getCellByColumnAndRow(1,1)->getValue();
					$nombre_campo_ReportConfigA1Prim_13 = $ReportConfigA1Prim_13->getCellByColumnAndRow(1,$i)->getValue();
					$valor_campo1 = $ReportConfigA1Prim_13->getCellByColumnAndRow(1,$i)->getValue();					
					$valor_campo1_1 = $ReportConfigA1Prim_13->getCellByColumnAndRow(1,$i)->getValue();
					$nombre_campo_ReportConfigEUtraIFBestCell = $ReportConfigEUtraIFBestCell->getCellByColumnAndRow($x,1)->getValue();//apartir de aqui se hace lo cambio
					$valor_campo4 = $ReportConfigEUtraIFBestCell->getCellByColumnAndRow($x,$i)->getValue();				   
					if(!empty($nombre_campo_ReportConfigEUtraIFBestCell) && !empty($valor_campo1)){
						if($valor_campo1 == $valor_campo1_1){							
							//if($nombre_campo_$ReportConfigEUtraIFBestCell == "a1ThresholdRsrpSec"){
								$continido_1_13_1 ='
set EUtranCellFDD='.$valor_campo1.',UeMeasControl=1,ReportConfigEUtraIFBestCell=1 '.$nombre_campo_ReportConfigEUtraIFBestCell.' '.$valor_campo4;
								$continido_1_13[] = $continido_1_13_1;
							//}
							
						}
					}					
				}

				for ($x=2; $x <= $NumColumn_ReportConfigSearch_13; $x++) {
					$nombre_campo_ReportConfigA1Prim_13_1 = $ReportConfigA1Prim_13->getCellByColumnAndRow(1,1)->getValue();
					$nombre_campo_ReportConfigA1Prim_13 = $ReportConfigA1Prim_13->getCellByColumnAndRow(1,$i)->getValue();
					$valor_campo1 = $ReportConfigA1Prim_13->getCellByColumnAndRow(1,$i)->getValue();					
					$valor_campo1_1 = $ReportConfigA1Prim_13->getCellByColumnAndRow(1,$i)->getValue();
					$nombre_campo_ReportConfigEUtraInterFreqLb = $ReportConfigEUtraInterFreqLb->getCellByColumnAndRow($x,1)->getValue();//apartir de aqui se hace lo cambio
					$valor_campo4 = $ReportConfigEUtraInterFreqLb->getCellByColumnAndRow($x,$i)->getValue();				   
					if(!empty($nombre_campo_ReportConfigEUtraInterFreqLb) && !empty($valor_campo1)){
						if($valor_campo1 == $valor_campo1_1){							
							//if($nombre_campo_$ReportConfigEUtraInterFreqLb == "a1ThresholdRsrpSec"){
								$continido_1_13_1 ='
set EUtranCellFDD='.$valor_campo1.',UeMeasControl=1,ReportConfigEUtraInterFreqLb=1 '.$nombre_campo_ReportConfigEUtraInterFreqLb.' '.$valor_campo4;
								$continido_1_13[] = $continido_1_13_1;
							//}
							
						}
					}					
				}

				for ($x=2; $x <= $NumColumn_ReportConfigSearch_13; $x++) {
					$nombre_campo_ReportConfigA1Prim_13_1 = $ReportConfigA1Prim_13->getCellByColumnAndRow(1,1)->getValue();
					$nombre_campo_ReportConfigA1Prim_13 = $ReportConfigA1Prim_13->getCellByColumnAndRow(1,$i)->getValue();
					$valor_campo1 = $ReportConfigA1Prim_13->getCellByColumnAndRow(1,$i)->getValue();					
					$valor_campo1_1 = $ReportConfigA1Prim_13->getCellByColumnAndRow(1,$i)->getValue();
					$nombre_campo_ReportConfigEUtraInterFreqMbms = $ReportConfigEUtraInterFreqMbms->getCellByColumnAndRow($x,1)->getValue();//apartir de aqui se hace lo cambio
					$valor_campo4 = $ReportConfigEUtraInterFreqMbms->getCellByColumnAndRow($x,$i)->getValue();				   
					if(!empty($nombre_campo_ReportConfigEUtraInterFreqMbms) && !empty($valor_campo1)){
						if($valor_campo1 == $valor_campo1_1){							
							//if($nombre_campo_$ReportConfigEUtraInterFreqMbms == "a1ThresholdRsrpSec"){
								$continido_1_13_1 ='
set EUtranCellFDD='.$valor_campo1.',UeMeasControl=1,ReportConfigEUtraInterFreqMbms=1 '.$nombre_campo_ReportConfigEUtraInterFreqMbms.' '.$valor_campo4;
								$continido_1_13[] = $continido_1_13_1;
							//}
							
						}
					}					
				}

				for ($x=2; $x <= $NumColumn_ReportConfigSearch_13; $x++) {
					$nombre_campo_ReportConfigA1Prim_13_1 = $ReportConfigA1Prim_13->getCellByColumnAndRow(1,1)->getValue();
					$nombre_campo_ReportConfigA1Prim_13 = $ReportConfigA1Prim_13->getCellByColumnAndRow(1,$i)->getValue();
					$valor_campo1 = $ReportConfigA1Prim_13->getCellByColumnAndRow(1,$i)->getValue();					
					$valor_campo1_1 = $ReportConfigA1Prim_13->getCellByColumnAndRow(1,$i)->getValue();
					$nombre_campo_ReportConfigInterRatLb = $ReportConfigInterRatLb->getCellByColumnAndRow($x,1)->getValue();//apartir de aqui se hace lo cambio
					$valor_campo4 = $ReportConfigInterRatLb->getCellByColumnAndRow($x,$i)->getValue();				   
					if(!empty($nombre_campo_ReportConfigInterRatLb) && !empty($valor_campo1)){
						if($valor_campo1 == $valor_campo1_1){							
							//if($nombre_campo_$ReportConfigInterRatLb == "a1ThresholdRsrpSec"){
								$continido_1_13_1 ='
set EUtranCellFDD='.$valor_campo1.',UeMeasControl=1,ReportConfigInterRatLb=1 '.$nombre_campo_ReportConfigInterRatLb.' '.$valor_campo4;
								$continido_1_13[] = $continido_1_13_1;
							//}
							
						}
					}					
				}

				for ($x=2; $x <= $NumColumn_ReportConfigSearch_13; $x++) {
					$nombre_campo_ReportConfigA1Prim_13_1 = $ReportConfigA1Prim_13->getCellByColumnAndRow(1,1)->getValue();
					$nombre_campo_ReportConfigA1Prim_13 = $ReportConfigA1Prim_13->getCellByColumnAndRow(1,$i)->getValue();
					$valor_campo1 = $ReportConfigA1Prim_13->getCellByColumnAndRow(1,$i)->getValue();					
					$valor_campo1_1 = $ReportConfigA1Prim_13->getCellByColumnAndRow(1,$i)->getValue();
					$nombre_campo_ReportConfigSearch_13 = $ReportConfigSearch_13->getCellByColumnAndRow($x,1)->getValue();//apartir de aqui se hace lo cambio
					$valor_campo4 = $ReportConfigSearch_13->getCellByColumnAndRow($x,$i)->getValue();				   
					if(!empty($nombre_campo_ReportConfigSearch_13) && !empty($valor_campo1)){
						if($valor_campo1 == $valor_campo1_1){							
							//if($nombre_campo_$ReportConfigSearch_13 == "a1ThresholdRsrpSec"){
								$continido_1_13_1 ='
set EUtranCellFDD='.$valor_campo1.',UeMeasControl=1,ReportConfigSearch=1 '.$nombre_campo_ReportConfigSearch_13.' '.$valor_campo4;
								$continido_1_13[] = $continido_1_13_1;
							//}
							
						}
					}					
				}

				for ($x=2; $x <= $NumColumn_ReportConfigSearch_13; $x++) {
					$nombre_campo_ReportConfigA1Prim_13_1 = $ReportConfigA1Prim_13->getCellByColumnAndRow(1,1)->getValue();
					$nombre_campo_ReportConfigA1Prim_13 = $ReportConfigA1Prim_13->getCellByColumnAndRow(1,$i)->getValue();
					$valor_campo1 = $ReportConfigA1Prim_13->getCellByColumnAndRow(1,$i)->getValue();					
					$valor_campo1_1 = $ReportConfigA1Prim_13->getCellByColumnAndRow(1,$i)->getValue();
					$nombre_campo_ReportConfigSCellA1A2_13 = $ReportConfigSCellA1A2_13->getCellByColumnAndRow($x,1)->getValue();//apartir de aqui se hace lo cambio
					$valor_campo4 = $ReportConfigSCellA1A2_13->getCellByColumnAndRow($x,$i)->getValue();				   
					if(!empty($nombre_campo_ReportConfigSCellA1A2_13) && !empty($valor_campo1)){
						if($valor_campo1 == $valor_campo1_1){							
							//if($nombre_campo_$ReportConfigSCellA1A2_13 == "a1ThresholdRsrpSec"){
								$continido_1_13_1 ='
set EUtranCellFDD='.$valor_campo1.',UeMeasControl=1,ReportConfigSCellA1A2=1 '.$nombre_campo_ReportConfigSCellA1A2_13.' '.$valor_campo4;
								$continido_1_13[] = $continido_1_13_1;
							//}
							
						}
					}					
				}

				for ($x=2; $x <= $NumColumn_ReportConfigSearch_13; $x++) {
					$nombre_campo_ReportConfigA1Prim_13_1 = $ReportConfigA1Prim_13->getCellByColumnAndRow(1,1)->getValue();
					$nombre_campo_ReportConfigA1Prim_13 = $ReportConfigA1Prim_13->getCellByColumnAndRow(1,$i)->getValue();
					$valor_campo1 = $ReportConfigA1Prim_13->getCellByColumnAndRow(1,$i)->getValue();					
					$valor_campo1_1 = $ReportConfigA1Prim_13->getCellByColumnAndRow(1,$i)->getValue();
					$nombre_campo_ReportConfigSCellA4 = $ReportConfigSCellA4->getCellByColumnAndRow($x,1)->getValue();//apartir de aqui se hace lo cambio
					$valor_campo4 = $ReportConfigSCellA4->getCellByColumnAndRow($x,$i)->getValue();				   
					if(!empty($nombre_campo_ReportConfigSCellA4) && !empty($valor_campo1)){
						if($valor_campo1 == $valor_campo1_1){							
							//if($nombre_campo_$ReportConfigSCellA4 == "a1ThresholdRsrpSec"){
								$continido_1_13_1 ='
set EUtranCellFDD='.$valor_campo1.',UeMeasControl=1,ReportConfigSCellA4=1 '.$nombre_campo_ReportConfigSCellA4.' '.$valor_campo4;
								$continido_1_13[] = $continido_1_13_1;
							//}
							
						}
					}					
				}

				for ($x=2; $x <= $NumColumn_ReportConfigSearch_13; $x++) {
					$nombre_campo_ReportConfigA1Prim_13_1 = $ReportConfigA1Prim_13->getCellByColumnAndRow(1,1)->getValue();
					$nombre_campo_ReportConfigA1Prim_13 = $ReportConfigA1Prim_13->getCellByColumnAndRow(1,$i)->getValue();
					$valor_campo1 = $ReportConfigA1Prim_13->getCellByColumnAndRow(1,$i)->getValue();					
					$valor_campo1_1 = $ReportConfigA1Prim_13->getCellByColumnAndRow(1,$i)->getValue();
					$nombre_campo_ReportConfigSCellA6 = $ReportConfigSCellA6->getCellByColumnAndRow($x,1)->getValue();//apartir de aqui se hace lo cambio
					$valor_campo4 = $ReportConfigSCellA6->getCellByColumnAndRow($x,$i)->getValue();				   
					if(!empty($nombre_campo_ReportConfigSCellA6) && !empty($valor_campo1)){
						if($valor_campo1 == $valor_campo1_1){							
							//if($nombre_campo_$ReportConfigSCellA6 == "a1ThresholdRsrpSec"){
								$continido_1_13_1 ='
set EUtranCellFDD='.$valor_campo1.',UeMeasControl=1,ReportConfigSCellA6=1 '.$nombre_campo_ReportConfigSCellA6.' '.$valor_campo4;
								$continido_1_13[] = $continido_1_13_1;
							//}
							
						}
					}				
				}

			}

			$RetSubUnit_13 = $RND->getSheet($name_h_rnd_RetSubUnit);//esto es para la 1 parte del archivo 13
			$filas_RetSubUnit_13_rnd  = $RetSubUnit_13 ->getHighestRow();
			$Column_RetSubUnit_13_rnd = $RetSubUnit_13 ->getHighestColumn();
			$NumColumn_RetSubUnit_13  = PHPExcel_Cell::columnIndexFromString($Column_RetSubUnit_13_rnd);
			for ($i=2; $i <=$filas_RetSubUnit_13_rnd; $i++) { 
				for ($x=3; $x <= $NumColumn_RetSubUnit_13; $x++) {
					$nombre_campo_RetSubUnit_13 = $RetSubUnit_13->getCellByColumnAndRow($x,1)->getValue();
					$valor_campo1 = $RetSubUnit_13->getCellByColumnAndRow(1,$i)->getValue();
					$valor_campo2 = $RetSubUnit_13->getCellByColumnAndRow(2,$i)->getValue();
					$valor_campo3 = $RetSubUnit_13->getCellByColumnAndRow($x,$i)->getValue();				   
					if(!empty($nombre_campo_RetSubUnit_13)){
						$continido_1_13_1 ='
set AntennaUnitGroup='.$valor_campo1.',AntennaNearUnit='.$valor_campo2.',RetSubUnit=1 '.$nombre_campo_RetSubUnit_13.' '.$valor_campo3;
						$continido_1_13[] .= $continido_1_13_1;
					}					
				}
			}

			$RfBranch_13 = $RND->getSheet($name_h_rnd_RfBranch);//esto es para la 1 parte del archivo 13
			$filas_RfBranch_13_rnd  = $RfBranch_13 ->getHighestRow();
			$Column_RfBranch_13_rnd = $RfBranch_13 ->getHighestColumn();
			$NumColumn_RfBranch_13  = PHPExcel_Cell::columnIndexFromString($Column_RfBranch_13_rnd);
			for ($i=2; $i <=$filas_RfBranch_13_rnd; $i++) { 
				for ($x=4; $x <= $NumColumn_RfBranch_13; $x++) {
					$nombre_campo_RfBranch_13 = $RfBranch_13->getCellByColumnAndRow($x,1)->getValue();
					$valor_campo1 = $RfBranch_13->getCellByColumnAndRow(1,$i)->getValue();
					$valor_campo2 = $RfBranch_13->getCellByColumnAndRow(2,$i)->getValue();
					$valor_campo3 = $RfBranch_13->getCellByColumnAndRow($x,$i)->getValue();				   
					if(!empty($nombre_campo_RfBranch_13)){
						$continido_1_13_1 ='
set AntennaUnitGroup='.$valor_campo1.',RfBranch='.$valor_campo2.' '.$nombre_campo_RfBranch_13.' '.$valor_campo3;
						$continido_1_13[] .= $continido_1_13_1;
					}					
				}
			}

			$RfPort = $RND->getSheet($name_h_rnd_RfPort);//esto es para la 1 parte del archivo 13
			$filas_RfPort_rnd  = $RfPort ->getHighestRow();
			$Column_RfPort_rnd = $RfPort ->getHighestColumn();
			$NumColumn_RfPort  = PHPExcel_Cell::columnIndexFromString($Column_RfPort_rnd);
			for ($i=2; $i <=$filas_RfPort_rnd; $i++) { 
				for ($x=4; $x <= $NumColumn_RfPort; $x++) {
					$nombre_campo_RfPort = $RfPort->getCellByColumnAndRow($x,1)->getValue();
					$valor_campo1 = $RfPort->getCellByColumnAndRow(1,$i)->getValue();
					$valor_campo2 = $RfPort->getCellByColumnAndRow(2,$i)->getValue();
					$valor_campo4 = $RfPort->getCellByColumnAndRow(3,$i)->getValue();
					$valor_campo3 = $RfPort->getCellByColumnAndRow($x,$i)->getValue();				   
					if(!empty($nombre_campo_RfPort)){
						$continido_1_13_1 ='
set AuxPlugInUnit='.$valor_campo1.',DeviceGroup='.$valor_campo2.',RfPort='.$valor_campo4.' '.$nombre_campo_RfPort.' '.$valor_campo3;
						$continido_1_13[] .= $continido_1_13_1;
					}					
				}
			}

			$RlfProfile = $RND->getSheet($name_h_rnd_RlfProfile);//esto es para la 1 parte del archivo 13
			$filas_RlfProfile_rnd  = $RlfProfile ->getHighestRow();
			$Column_RlfProfile_rnd = $RlfProfile ->getHighestColumn();
			$NumColumn_RlfProfile  = PHPExcel_Cell::columnIndexFromString($Column_RlfProfile_rnd);
			for ($i=2; $i <=$filas_RlfProfile_rnd; $i++) { 
				for ($x=2; $x <= $NumColumn_RlfProfile; $x++) {
					$nombre_campo_RlfProfile = $RlfProfile->getCellByColumnAndRow($x,1)->getValue();
					$valor_campo1 = $RlfProfile->getCellByColumnAndRow(1,$i)->getValue();					
					$valor_campo3 = $RlfProfile->getCellByColumnAndRow($x,$i)->getValue();				   
					if(!empty($nombre_campo_RlfProfile)){
						$continido_1_13_1 ='
set RlfProfile='.$valor_campo1.' '.$nombre_campo_RlfProfile.' '.$valor_campo3;
						$continido_1_13[] .= $continido_1_13_1;
					}					
				}
			}

			$Rrc_13 = $RND->getSheet($name_h_rnd_Rrc);//esto es para la 1 parte del archivo 13
			$filas_Rrc_13_rnd  = $Rrc_13 ->getHighestRow();
			$Column_Rrc_13_rnd = $Rrc_13 ->getHighestColumn();
			$NumColumn_Rrc_13  = PHPExcel_Cell::columnIndexFromString($Column_Rrc_13_rnd);
			for ($i=2; $i <=$filas_Rrc_13_rnd; $i++) { 
				for ($x=1; $x <= $NumColumn_Rrc_13; $x++) {
					$nombre_campo_Rrc_13 = $Rrc_13->getCellByColumnAndRow($x,1)->getValue();
					$valor_campo1 = $Rrc_13->getCellByColumnAndRow(1,$i)->getValue();					
					$valor_campo3 = $Rrc_13->getCellByColumnAndRow($x,$i)->getValue();				   
					if(!empty($nombre_campo_Rrc_13)){
						$continido_1_13_1 ='
set Rrc=1 '.$nombre_campo_Rrc_13.' '.$valor_campo3;
						$continido_1_13[] .= $continido_1_13_1;
					}					
				}
			}

			$Sctp_13 = $RND->getSheet($name_h_rnd_Sctp);//esto es para la 1 parte del archivo 13
			$filas_Sctp_13_rnd  = $Sctp_13 ->getHighestRow();
			$Column_Sctp_13_rnd = $Sctp_13 ->getHighestColumn();
			$NumColumn_Sctp_13  = PHPExcel_Cell::columnIndexFromString($Column_Sctp_13_rnd);
			for ($i=2; $i <=$filas_Sctp_13_rnd; $i++) { 
				for ($x=1; $x <= $NumColumn_Sctp_13; $x++) {
					$nombre_campo_Sctp_13 = $Sctp_13->getCellByColumnAndRow($x,1)->getValue();
					$valor_campo1 = $Sctp_13->getCellByColumnAndRow(1,$i)->getValue();					
					$valor_campo3 = $Sctp_13->getCellByColumnAndRow($x,$i)->getValue();				   
					if(!empty($nombre_campo_Sctp_13)){
						$continido_1_13_1 ='
set Sctp=1 '.$nombre_campo_Sctp_13.' '.$valor_campo3;
						$continido_1_13[] .= $continido_1_13_1;
					}					
				}
			}


			$SectorCarrier_13 = $RND->getSheet($name_h_rnd_SectorCarrier);//esto es para la 1 parte del archivo 13
			$filas_SectorCarrier_13_rnd  = $SectorCarrier_13 ->getHighestRow();
			$Column_SectorCarrier_13_rnd = $SectorCarrier_13 ->getHighestColumn();
			$NumColumn_SectorCarrier_13  = PHPExcel_Cell::columnIndexFromString($Column_SectorCarrier_13_rnd);
			for ($i=2; $i <=$filas_SectorCarrier_13_rnd; $i++) { 
				for ($x=2; $x <= $NumColumn_SectorCarrier_13; $x++) {
					$nombre_campo_SectorCarrier_13 = $SectorCarrier_13->getCellByColumnAndRow($x,1)->getValue();
					$valor_campo1 = $SectorCarrier_13->getCellByColumnAndRow(1,$i)->getValue();					
					$valor_campo3 = $SectorCarrier_13->getCellByColumnAndRow($x,$i)->getValue();				   
					if(!empty($nombre_campo_SectorCarrier_13) && !empty($valor_campo1)){
						$continido_1_13_1 ='
set SectorCarrier='.$valor_campo1.' '.$nombre_campo_SectorCarrier_13.' '.$valor_campo3;
						$continido_1_13[] .= $continido_1_13_1;
					}					
				}
			}


			$SectorEquipmentFunction_13 = $RND->getSheet($name_h_rnd_SectorEquipmentFunction);//esto es para la 1 parte del archivo 13
			$filas_SectorEquipmentFunction_13_rnd  = $SectorEquipmentFunction_13 ->getHighestRow();
			$Column_SectorEquipmentFunction_13_rnd = $SectorEquipmentFunction_13 ->getHighestColumn();
			$NumColumn_SectorEquipmentFunction_13  = PHPExcel_Cell::columnIndexFromString($Column_SectorEquipmentFunction_13_rnd);
			for ($i=2; $i <=$filas_SectorEquipmentFunction_13_rnd; $i++) { 
				for ($x=2; $x <= $NumColumn_SectorEquipmentFunction_13; $x++) {
					$nombre_campo_SectorEquipmentFunction_13 = $SectorEquipmentFunction_13->getCellByColumnAndRow($x,1)->getValue();
					$valor_campo1 = $SectorEquipmentFunction_13->getCellByColumnAndRow(1,$i)->getValue();					
					$valor_campo3 = $SectorEquipmentFunction_13->getCellByColumnAndRow($x,$i)->getValue();				   
					if(!empty($nombre_campo_SectorEquipmentFunction_13) && !empty($valor_campo1)){
						$continido_1_13_1 ='
set SectorEquipmentFunction='.$valor_campo1.' '.$nombre_campo_SectorEquipmentFunction_13.' '.$valor_campo3;
						$continido_1_13[] .= $continido_1_13_1;
					}					
				}
			}

			$SecurityHandling = $RND->getSheet($name_h_rnd_SecurityHandling);//esto es para la 1 parte del archivo 13
			$filas_SecurityHandling_rnd  = $SecurityHandling ->getHighestRow();
			$Column_SecurityHandling_rnd = $SecurityHandling ->getHighestColumn();
			$NumColumn_SecurityHandling  = PHPExcel_Cell::columnIndexFromString($Column_SecurityHandling_rnd);
			for ($i=2; $i <=$filas_SecurityHandling_rnd; $i++) { 
				for ($x=1; $x <= $NumColumn_SecurityHandling; $x++) {
					$nombre_campo_SecurityHandling = $SecurityHandling->getCellByColumnAndRow($x,1)->getValue();
					$valor_campo1 = $SecurityHandling->getCellByColumnAndRow(1,$i)->getValue();					
					$valor_campo3 = $SecurityHandling->getCellByColumnAndRow($x,$i)->getValue();				   
					if(!empty($nombre_campo_SecurityHandling) && !empty($valor_campo1)){
						$continido_1_13_1 ='
set SecurityHandling=1 '.$nombre_campo_SecurityHandling.' '.$valor_campo3;
						$continido_1_13[] .= $continido_1_13_1;
					}					
				}
			}

			$SignalingRadioBearer = $RND->getSheet($name_h_rnd_SignalingRadioBearer);//esto es para la 1 parte del archivo 13
			$filas_SignalingRadioBearer_rnd  = $SignalingRadioBearer ->getHighestRow();
			$Column_SignalingRadioBearer_rnd = $SignalingRadioBearer ->getHighestColumn();
			$NumColumn_SignalingRadioBearer  = PHPExcel_Cell::columnIndexFromString($Column_SignalingRadioBearer_rnd);
			for ($i=2; $i <=$filas_SignalingRadioBearer_rnd; $i++) { 
				for ($x=1; $x <= $NumColumn_SignalingRadioBearer; $x++) {
					$nombre_campo_SignalingRadioBearer = $SignalingRadioBearer->getCellByColumnAndRow($x,1)->getValue();
					$valor_campo1 = $SignalingRadioBearer->getCellByColumnAndRow(1,$i)->getValue();					
					$valor_campo3 = $SignalingRadioBearer->getCellByColumnAndRow($x,$i)->getValue();				   
					if(!empty($nombre_campo_SignalingRadioBearer) && !empty($valor_campo1)){
						$continido_1_13_1 ='
set RadioBearerTable=default,SignalingRadioBearer=1 '.$nombre_campo_SignalingRadioBearer.' '.$valor_campo3;
						$continido_1_13[] .= $continido_1_13_1;
					}					
				}
			}

			$UeMeasControl_13 = $RND->getSheet($name_h_rnd_UeMeasControl);//esto es para la 1 parte del archivo 13
			$filas_UeMeasControl_13_rnd  = $UeMeasControl_13 ->getHighestRow();
			$Column_UeMeasControl_13_rnd = $UeMeasControl_13 ->getHighestColumn();
			$NumColumn_UeMeasControl_13  = PHPExcel_Cell::columnIndexFromString($Column_UeMeasControl_13_rnd);
			for ($i=2; $i <=$filas_UeMeasControl_13_rnd; $i++) { 
				for ($x=2; $x <= $NumColumn_UeMeasControl_13; $x++) {
					$nombre_campo_UeMeasControl_13 = $UeMeasControl_13->getCellByColumnAndRow($x,1)->getValue();
					$valor_campo1 = $UeMeasControl_13->getCellByColumnAndRow(1,$i)->getValue();					
					$valor_campo3 = $UeMeasControl_13->getCellByColumnAndRow($x,$i)->getValue();				   
					if(!empty($nombre_campo_UeMeasControl_13) && !empty($valor_campo1)){
						$continido_1_13_1 ='
set EUtranCellFDD='.$valor_campo1.',UeMeasControl=1 '.$nombre_campo_UeMeasControl_13.' '.$valor_campo3;
						$continido_1_13[] .= $continido_1_13_1;
						if($nombre_campo_UeMeasControl_13 == "zzzTemporary25" && !empty($valor_campo1)){
							$continido_1_13_2 ='


cvms Parametros incobech
cv rbset Parametros
';
							$continido_1_13[] .= $continido_1_13_2;
						}
					}					
				}
			}
			//////////////////////////////////////////////////////////////////////////
			//Contrucion del archivo Script Set2
			//
			//
			/////////////////////////////////////////////////////////////////////////
			$ExternalENodeBFunction_14 = $RND->getSheet($name_h_rnd_ExternalENodeBFunction);//esto es para la 1 parte del archivo 14
			$filas_ExternalENodeBFunction_14_rnd  = $ExternalENodeBFunction_14 ->getHighestRow();
			$Column_ExternalENodeBFunction_14_rnd = $ExternalENodeBFunction_14 ->getHighestColumn();
			$NumColumn_ExternalENodeBFunction_14  = PHPExcel_Cell::columnIndexFromString($Column_ExternalENodeBFunction_14_rnd);
			for ($i=2; $i <=$filas_ExternalENodeBFunction_14_rnd; $i++) {
				for ($x=1; $x <= $NumColumn_ExternalENodeBFunction_14; $x++) {
					$nombre_campo_ExternalENodeBFunction_14 = $ExternalENodeBFunction_14->getCellByColumnAndRow($x,1)->getValue();	
			        $valor_campo1 = $ExternalENodeBFunction_14->getCellByColumnAndRow(1,$i)->getValue(); 
					$valor_campo2 = $ExternalENodeBFunction_14->getCellByColumnAndRow(2,$i)->getValue();
					$valor_campo3 = $ExternalENodeBFunction_14->getCellByColumnAndRow(3,$i)->getValue();
					$valor_campo4 = $ExternalENodeBFunction_14->getCellByColumnAndRow(4,$i)->getValue();
					$valor_campo5 = $ExternalENodeBFunction_14->getCellByColumnAndRow(5,$i)->getValue();
					$valor_campo6 = $ExternalENodeBFunction_14->getCellByColumnAndRow(6,$i)->getValue();
					if($nombre_campo_ExternalENodeBFunction_14 == "userLabel"){
						if(!empty($nombre_campo_ExternalENodeBFunction_14) && !empty($valor_campo1)){
							$continido_1_14_1 ="CREATE
(
parent ".'"ManagedElement=1,ENodeBFunction=1,EUtraNetwork=1"'. "
identity ".'"'.$valor_campo1.'"'."
moType ExternalENodeBFunction
exception none
nrOfAttributes 3
eNBId Integer ".$valor_campo2."
eNodeBPlmnId Struct
 nrOfElements 3
  mcc Integer ".$valor_campo3."
  mnc Integer ".$valor_campo4."
  mncLength Integer ".$valor_campo5."
mfbiSupport Boolean ".$valor_campo6."
)
";

							$continido_1_14[] = $continido_1_14_1;
						}
					}
				}
			}

			//////////////////////////////////////////////////////////////////////////
			//Contrucion del archivo Script Set3
			//
			//
			/////////////////////////////////////////////////////////////////////////
			$ExternalEUtranCellFDD_15 = $RND->getSheet($name_h_rnd_ExternalEUtranCellFDD);//esto es para la 1 parte del archivo 15
			$filas_ExternalEUtranCellFDD_15_rnd  = $ExternalEUtranCellFDD_15 ->getHighestRow();
			$Column_ExternalEUtranCellFDD_15_rnd = $ExternalEUtranCellFDD_15 ->getHighestColumn();
			$NumColumn_ExternalEUtranCellFDD_15  = PHPExcel_Cell::columnIndexFromString($Column_ExternalEUtranCellFDD_15_rnd);
			for ($i=2; $i <=$filas_ExternalEUtranCellFDD_15_rnd; $i++) {
				for ($x=1; $x <= $NumColumn_ExternalEUtranCellFDD_15; $x++) {
					$nombre_campo_ExternalEUtranCellFDD_15 = $ExternalEUtranCellFDD_15->getCellByColumnAndRow($x,1)->getValue();	
			        $valor_campo1 = $ExternalEUtranCellFDD_15->getCellByColumnAndRow(1,$i)->getValue(); 
					$valor_campo2 = $ExternalEUtranCellFDD_15->getCellByColumnAndRow(2,$i)->getValue();
					$valor_campo3 = $ExternalEUtranCellFDD_15->getCellByColumnAndRow(3,$i)->getValue();
					$valor_campo4 = $ExternalEUtranCellFDD_15->getCellByColumnAndRow(4,$i)->getValue();
					$valor_campo5 = $ExternalEUtranCellFDD_15->getCellByColumnAndRow(5,$i)->getValue();
					$valor_campo6 = $ExternalEUtranCellFDD_15->getCellByColumnAndRow(6,$i)->getValue();
					$valor_campo8 = $ExternalEUtranCellFDD_15->getCellByColumnAndRow(8,$i)->getValue();
					$valor_campo9 = $ExternalEUtranCellFDD_15->getCellByColumnAndRow(9,$i)->getValue();
					$valor_campo11 = $ExternalEUtranCellFDD_15->getCellByColumnAndRow(11,$i)->getValue();
					if($nombre_campo_ExternalEUtranCellFDD_15 == "userLabel"){
						if(!empty($nombre_campo_ExternalEUtranCellFDD_15) && !empty($valor_campo1)){
							$continido_1_15_1 ="CREATE
(
parent ".'"ManagedElement=1,ENodeBFunction=1,EUtraNetwork=1,ExternalENodeBFunction='.substr($valor_campo1, 0, -2).'"'."
identity ".'"'.$valor_campo1.'"'."
moType ExternalEUtranCellFDD
exception none
nrOfAttributes 14
activePlmnList Array Struct 1
 nrOfElements 3
  mcc Integer ".$valor_campo2."
  mnc Integer ".$valor_campo3."
  mncLength Integer ".$valor_campo4."
eutranFrequencyRef Ref ".'"ManagedElement=1,ENodeBFunction=1,EUtraNetwork=1,EUtranFrequency=1"'."
lbEUtranCellOffloadCapacity Integer ".$valor_campo8."
localCellId Integer ".$valor_campo9."
pciConflict Array Integer 4
0
0
0
0
physicalLayerCellIdGroup Integer ".$valor_campo11."
physicalLayerSubCellId Integer ".$valor_campo12."
noOfTxAntennas Integer ".$valor_campo13."
zzzTemporaryExt1 Integer ".$valor_campo15."
zzzTemporaryExt2 Integer ".$valor_campo16."
zzzTemporaryExt3 Integer ".$valor_campo17."
zzzTemporaryExt4 Integer ".$valor_campo18."
zzzTemporaryExt5 Integer ".$valor_campo19."
tac Integer 13119
)
";

							$continido_1_15[] = $continido_1_15_1;
						}
					}
				}
			}

			$arc_xml_RBSequipments = $this->CuartoG->RBSequipments($nombre_final, $SectoresFinal, $CommonAntennaSystem);
			if($this->frecuencia == "AIR"){
				$archivo_4_1	= $this->CuartoG->XMU_Creation_L15B_3LTE($nombre_final);
				//$archivo_4_4 	= $this->CuartoG->LTE700_Adding_L16($nombre_final, $continido_1_4_B);
				$archivo_4_2 	= $this->CuartoG->LTE1900_Adding_L16($nombre_final, $continido_1_4_C);
				//$archivo_4_3	= $this->CuartoG->LTE2600_Adding_L16($nombre_final, $continido_1_4_D);				
			}

			$archivo_5 	= $this->CuartoG->CR_MME($nombre_final,$continido_1_5);
			$archivo_6 	= $this->CuartoG->CrEUtranFreqRelation($nombre_final,$continido_2_6);
			$archivo_7 	= $this->CuartoG->EUtranFreqRelation($nombre_final,$continido_2_7,$continido_3_7);
			$archivo_8 	= $this->CuartoG->EUtranCellRelation($nombre_final, $continido_2_8, $continido_3_8, $continido_4_8);	
			$archivo_9 	= $this->CuartoG->UtranFreqRelation($nombre_final, $continido_2_9, $continido_3_9);
			$archivo_10 = $this->CuartoG->Features($nombre_final, $continido_2_10);
			$archivo_11 = $this->CuartoG->Parametros_11($nombre_final, $continido_2_11, $continido_3_11, $continido_4_11, $continido_5_11, $continido_6_11,$continido_7_11, $continido_8_11,$continido_9_11,$continido_10_11,$continido_11_11,$continido_12_11,$continido_13_11,$continido_14_11,
				$continido_15_11,$continido_16_11,$continido_17_11,$continido_18_11,$continido_19_11,$continido_20_11,$continido_21_11,$continido_22_11,
				$continido_23_11,$continido_24_11,$continido_25_11,$continido_26_11,$continido_27_11,$continido_28_11,$continido_29_11,$continido_30_11,
				$continido_31_11,$continido_32_11,$continido_33_11,$continido_34_11,$continido_35_11,$continido_36_11,$continido_37_11,$continido_38_11,$continido_39_11,$continido_40_11,$continido_41_11,$continido_42_11,$continido_43_11,$continido_44_11,$continido_45_11,$continido_46_11,$continido_47_11,$continido_48_11,$continido_49_11,$continido_50_11,$continido_51_11,$continido_52_11,$continido_53_11,$continido_54_11,$continido_55_11,$continido_56_11,$continido_57_11,$continido_58_11,$continido_59_11,$continido_60_11,$continido_61_11,$continido_62_11,$continido_63_11,$continido_64_11,$continido_65_11);
			$archivo_12 = $this->CuartoG->Parametros_12($nombre_final, $continido_1_12);
			$archivo_13 = $this->CuartoG->Parametros_13($nombre_final, $continido_1_13);
			$archivo_14 = $this->CuartoG->Script_ExternalENodeBFunction_nombre_Set2($nombre_final,$continido_1_14);
			$archivo_15 = $this->CuartoG->Script_ExternalEUtranCellFDD_nombre_Set3($nombre_final,$continido_1_15);
		//die();
		if($arc_xml_siteinstall){ 
	   		return true;	
		}		
	}

	public function __destruct()
	{
		
	}
}

?>