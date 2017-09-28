<?php
require_once("../Control_Archivo.php");
/////////////////////////////////////////////////////////////////////////
//Clase para la contruccion de la estrctura de los archivos xml, mos y mo
//Fecha de creacion: 29-05-2017
//Creador por: Wagner Rivera
//Fecha de Modificación: 01-06-2017
////////////////////////////////////////////////////////////////////////
class Create_SectorEquipment extends Control_Archivos
{
    private $ruta    = "archivos/ENodoB/ENodoB_";
    private $name1 = "/05_";
    private $name2 = "Create_SectorEquipment";
	
	public function __construct($parametros)
	{
        $this->nombre  = $parametros[1][0][2];
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

fi
';
      $contar =0;
      foreach ($array as $key => $value) {
        foreach ($value as $key1 => $value1) {
          foreach ($value1 as $f => $valor) {          
            if($key == 72){             
              if($key1  == 1){
                  if($f > 1){
                    $SectorEquipmentFunction[] = $valor;
                  }
              }

              if($key1  == 2){
                  if($f > 1){
                    $administrativeState[] = $valor;
                  }
              }

              if($key1 == 3){
                  if($f > 1){
                    $mixedModeRadio[] = $valor;
                  }
              }

              if($key1  == 4){
                  if($f > 1){
                    $cinsert .='
crn NodeSupport=1,SectorEquipmentFunction='.$SectorEquipmentFunction[$contar].'
administrativeState '.$administrativeState[$contar].'
mixedModeRadio '.$mixedModeRadio[$contar].'
rfBranchRef 
userLabel '.$valor.'
end
';
                    $contar++;
                  }
              }

            }            
          }
        }
      }
      $cinsert .='
gs-
confb-';
      $estructura = $this->ruta.$this->nombre;
      $archivo    = $estructura.$this->name1.$this->nombre.$this->name2.".mos";
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