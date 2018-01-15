<?php
require_once("../Control_Archivo.php");
/////////////////////////////////////////////////////////////////////////
//Clase para la contruccion de la estrctura de los archivos xml, mos y mo
//Fecha de creacion: 29-05-2017
//Creador por: Wagner Rivera
//Fecha de Modificación: 01-06-2017
////////////////////////////////////////////////////////////////////////
class Create_AntennaGroup extends Control_Archivos
{
    private $ruta    = "archivos/ENodoB/ENodoB_";
    private $name1 = "/11_";
    private $name2 = "_Conect_Antenna_Uniqueid_";
	
	public function __construct($parametros)
	{
    //var_dump($parametros);
        $this->nombre  = @$parametros["AdmissionControl"]["Site"]["2"];
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
      $cinsert ='confb+
gs+
';
      $contador = 0;
      foreach ($array as $key => $value) { // Nombre de la Hoja
        foreach ($value as $key1 => $value1) { // Nombre de la columna
          foreach ($value1 as $f => $valor) {  //el Numero de la filas 
            if($key == 'AntennaUnit'){
              if(isset($valor)){
                if($key1 == 'AntennaUnitGroup'){
                  $AntennaUnitGroup[] = $valor;
                }
              }
              if(isset($valor)){
                if($key1 == 'mechanicalAntennaTilt'){
                  $mechanicalAntennaTilt[] = $valor;
                }
              }   
            }

            if($key == 'AntennaSubunit'){
              if(isset($valor)){
                if($key1 == 'AntennaUnitGroup'){
                  $AntennaUnitGroup_Subunit[] = $valor;
                }
              }
              if(isset($valor)){
                if($key1 == 'AntennaSubunit'){
                  $AntennaSubunit[] = $valor;
                }
              }
              if(isset($valor)){
                if($key1 == 'azimuthHalfPowerBeamwidth'){
                  $azimuthHalfPowerBeamwidth[] = $valor;
                }
              }
              if(isset($valor)){
                if($key1 == 'commonChBeamfrmPortMap'){
                  $commonChBeamfrmPortMap[] = $valor;
                }
              }
              if(isset($valor)){
                if($key1 == 'customComChBeamfrmWtsAmplitude'){
                  $customComChBeamfrmWtsAmplitude[] = $valor;
                }
              }
              if(isset($valor)){
                if($key1 == 'customComChBeamfrmWtsPhase'){
                  $customComChBeamfrmWtsPhase[] = $valor;
                }
              }
            }
            if($key == 'RfBranch'){
              if(isset($valor)){
                if($key1 == 'AntennaUnitGroup'){
                  $AntennaUnitGroup_RfBranch[] = $valor;
                }
              }
              if(isset($valor)){
                if($key1 == 'RfBranch'){
                  $RfBranch[] = $valor;
                }
              }
              if(isset($valor)){
                if($key1 == 'dlAttenuation'){
                  $dlAttenuation[] = $valor;
                }
              }
              if(isset($valor)){
                if($key1 == 'dlTrafficDelay'){
                  $dlTrafficDelay[] = $valor;
                }
              }
              if(isset($valor)){
                if($key1 == 'ulAttenuation'){
                  $ulAttenuation[] = $valor;
                }
              }
              if(isset($valor)){
                if($key1 == 'ulTrafficDelay'){
                  $ulTrafficDelay[] = $valor;
                }
              }
              if(isset($valor)){
                if($key1 == 'auPortRef'){
                  $AuPort[] = $valor;
                }
              }
            }
          }
        }
      }
      
      for($i=0; $i <= count($AntennaUnitGroup_Subunit); $i++){
        if(!empty($AntennaUnitGroup_Subunit)){
          if(@$AntennaUnitGroup_Subunit[$i] != $AntennaUnitGroup[$contador]){
            $contador++;
          }
          $cinsert .= '
crn Equipment=1,AntennaUnitGroup='.$AntennaSubunit[$i].'
end

crn Equipment=1,AntennaUnitGroup='.$AntennaSubunit[$i].',AntennaUnit=1
mechanicalAntennaTilt '.$mechanicalAntennaTilt[$contador].'
end

crn Equipment=1,AntennaUnitGroup='.$AntennaSubunit[$i].',AntennaUnit=1,AntennaSubunit=1
azimuthHalfPowerBeamwidth '.$azimuthHalfPowerBeamwidth[$i].'
commonChBeamfrmPortMap '.$commonChBeamfrmPortMap[$i].'
customComChBeamfrmWtsAmplitude '.str_replace(" ", ",", $customComChBeamfrmWtsAmplitude[$i]).'
customComChBeamfrmWtsPhase '.str_replace(" ", ",", $customComChBeamfrmWtsPhase[$i]).'
retSubunitRef 
end
';
          //Configuración de la antena group parte 1
          if($AntennaSubunit[$i] < 4 ){
            for ($j=0; $j < count($AntennaUnitGroup_RfBranch); $j++) {
              if($AntennaUnitGroup_RfBranch[$j] < $AntennaSubunit[$i]){ 
                $cinsert .= '
crn Equipment=1,AntennaUnitGroup='.$AntennaUnitGroup_RfBranch[$j].',RfBranch='.$RfBranch[$j].'
auPortRef 
dlAttenuation '.str_replace(" ", ",", substr($dlAttenuation[$j],0,-1)).'
dlTrafficDelay '.str_replace(" ", ",", substr($dlTrafficDelay[$j], 0, -1)).'
rfPortRef 
tmaRef 
ulAttenuation '.str_replace(" ", ",", substr($ulAttenuation[$j],0,-1)).'
ulTrafficDelay '.str_replace(" ", ",", substr($ulTrafficDelay[$j],0, -1)).'
userLabel 
end
';
              }              
            }
            for ($x=0; $x < count(@$AuPort); $x++) {
                if($AntennaUnitGroup_RfBranch[$i] < $AntennaSubunit[$i]){ 
                  $cinsert .= '
crn Equipment=1,AntennaUnitGroup='.@$AntennaUnitGroup_RfBranch[$x].',AntennaUnit=1,AntennaSubunit=1,AuPort='.@$AuPort[$x].'
userLabel 
end
';
              }
            }           
          }

          //Configuración de la antena group parte 2
          if($AntennaSubunit[$i] > 3 && $AntennaSubunit[$i] < 7 ){
            for ($j=0; $j < count($AntennaUnitGroup_RfBranch); $j++) {
              if($AntennaUnitGroup_RfBranch[$j] < $AntennaSubunit[$i]){ 
                $cinsert .= '
crn Equipment=1,AntennaUnitGroup='.$AntennaUnitGroup_RfBranch[$j].',RfBranch='.$RfBranch[$j].'
auPortRef 
dlAttenuation '.str_replace(" ", ",", substr($dlAttenuation[$j],0,-1)).'
dlTrafficDelay '.str_replace(" ", ",", substr($dlTrafficDelay[$j], 0, -1)).'
rfPortRef 
tmaRef 
ulAttenuation '.str_replace(" ", ",", substr($ulAttenuation[$j],0,-1)).'
ulTrafficDelay '.str_replace(" ", ",", substr($ulTrafficDelay[$j],0, -1)).'
userLabel 
end
';
              }              
            }
            
            for ($x=0; $x < count(@$AuPort); $x++) {
                if($AntennaUnitGroup_RfBranch[$i] < $AntennaSubunit[$i]){ 
                  $cinsert .= '
crn Equipment=1,AntennaUnitGroup='.@$AntennaUnitGroup_RfBranch[$x].',AntennaUnit=1,AntennaSubunit=1,AuPort='.@$AuPort[$x].'
userLabel 
end
';
              }
            }           
          }

        }
      }

      $estructura = $this->ruta.$this->nombre;
      $archivo    = $estructura.$this->name1.$this->nombre.$this->name2.$this->nombre.".mos";
      $this->ElimarArchivo($archivo);
      $this->crear_carpeta($estructura);
		  $this->CrearArchivo($archivo, $cinsert);
      die();
      return true;	
	}

    public function __destruct()
    {
        
    }
}
	
?>