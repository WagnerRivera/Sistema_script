<?php
require_once("../Control_Archivo.php");
/////////////////////////////////////////////////////////////////////////
//Clase para la contruccion de la estrctura de los archivos xml, mos y mo
//Fecha de creacion: 29-05-2017
//Creador por: Wagner Rivera
//Fecha de Modificación: 01-06-2017
////////////////////////////////////////////////////////////////////////
class features extends Control_Archivos
{
    private $ruta    = "archivos/ENodoB/ENodoB_";
    private $name1 = "/06_";
    private $name2 = "_features_";
	
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
		
		$cinsert ='

lt all
confb +
gs +

set SystemFunctions=1,Lm=1,FeatureState=CXC4010319  featureState  1
set SystemFunctions=1,Lm=1,FeatureState=CXC4010320  featureState  1
set SystemFunctions=1,Lm=1,FeatureState=CXC4010609  featureState  1
set SystemFunctions=1,Lm=1,FeatureState=CXC4010613  featureState  1
set SystemFunctions=1,Lm=1,FeatureState=CXC4010616  featureState  1
set SystemFunctions=1,Lm=1,FeatureState=CXC4010618  featureState  1
set SystemFunctions=1,Lm=1,FeatureState=CXC4010620  featureState  1
set SystemFunctions=1,Lm=1,FeatureState=CXC4010723  featureState  1
set SystemFunctions=1,Lm=1,FeatureState=CXC4010770  featureState  1
set SystemFunctions=1,Lm=1,FeatureState=CXC4010912  featureState  1
set SystemFunctions=1,Lm=1,FeatureState=CXC4010955  featureState  1
set SystemFunctions=1,Lm=1,FeatureState=CXC4010956  featureState  1
set SystemFunctions=1,Lm=1,FeatureState=CXC4010959  featureState  1
set SystemFunctions=1,Lm=1,FeatureState=CXC4010967  featureState  1
set SystemFunctions=1,Lm=1,FeatureState=CXC4010974  featureState  1
set SystemFunctions=1,Lm=1,FeatureState=CXC4010980  featureState  1
set SystemFunctions=1,Lm=1,FeatureState=CXC4011011  featureState  1
set SystemFunctions=1,Lm=1,FeatureState=CXC4011033  featureState  1
set SystemFunctions=1,Lm=1,FeatureState=CXC4011050  featureState  1
set SystemFunctions=1,Lm=1,FeatureState=CXC4011055  featureState  1
set SystemFunctions=1,Lm=1,FeatureState=CXC4011056  featureState  1
set SystemFunctions=1,Lm=1,FeatureState=CXC4011074  featureState  1
set SystemFunctions=1,Lm=1,FeatureState=CXC4011157  featureState  1
set SystemFunctions=1,Lm=1,FeatureState=CXC4011183  featureState  1
set SystemFunctions=1,Lm=1,FeatureState=CXC4011252  featureState  1
set SystemFunctions=1,Lm=1,FeatureState=CXC4011317  featureState  1
set SystemFunctions=1,Lm=1,FeatureState=CXC4011319  featureState  1
set SystemFunctions=1,Lm=1,FeatureState=CXC4011345  featureState  1
set SystemFunctions=1,Lm=1,FeatureState=CXC4011356  featureState  1
set SystemFunctions=1,Lm=1,FeatureState=CXC4011366  featureState  1
set SystemFunctions=1,Lm=1,FeatureState=CXC4011370  featureState  1
set SystemFunctions=1,Lm=1,FeatureState=CXC4011373  featureState  1
set SystemFunctions=1,Lm=1,FeatureState=CXC4011376  featureState  1
set SystemFunctions=1,Lm=1,FeatureState=CXC4011476  featureState  1
set SystemFunctions=1,Lm=1,FeatureState=CXC4011482  featureState  1
set SystemFunctions=1,Lm=1,FeatureState=CXC4011515  featureState  1
set SystemFunctions=1,Lm=1,FeatureState=CXC4011559  featureState  1
set SystemFunctions=1,Lm=1,FeatureState=CXC4011666  featureState  1
set SystemFunctions=1,Lm=1,FeatureState=CXC4011700  featureState  1
set SystemFunctions=1,Lm=1,FeatureState=CXC4011715  featureState  1
set SystemFunctions=1,Lm=1,FeatureState=CXC4011939  featureState  1
set SystemFunctions=1,Lm=1,FeatureState=CXC4011941  featureState  1
set SystemFunctions=1,Lm=1,FeatureState=CXC4011955  featureState  1
set SystemFunctions=1,Lm=1,FeatureState=CXC4011958  featureState  1
set SystemFunctions=1,Lm=1,FeatureState=CXC4011969  featureState  1
set SystemFunctions=1,Lm=1,FeatureState=CXC4040011  featureState  1
set SystemFunctions=1,Lm=1,FeatureState=CXC4010717  featureState  1
set SystemFunctions=1,Lm=1,FeatureState=CXC4010841  featureState  1
set SystemFunctions=1,Lm=1,FeatureState=CXC4011034  featureState  1
set SystemFunctions=1,Lm=1,FeatureState=CXC4011245  featureState  1
set SystemFunctions=1,Lm=1,FeatureState=CXC4011258  featureState  1
set SystemFunctions=1,Lm=1,FeatureState=CXC4011937  featureState  1
set SystemFunctions=1,Lm=1,FeatureState=CXC4011938  featureState  1
set SystemFunctions=1,Lm=1,FeatureState=CXC4011946  featureState  1
';
      /*foreach ($array as $key => $value) { // Nombre de la Hoja
        foreach ($value as $key1 => $value1) { // NOmbre de la columna
          foreach ($value1 as $f => $valor) {  //el Numero de la filas 
            if($key == 'Features'){              
              if(isset($valor)){
                $cinsert .='set SystemFunctions=1,Licensing=1,OptionalFeatureLicense='.$key1.' FeatureState '.$valor.'
';
              }
              
              if(isset($valor)){
                //echo '$key1 == "'.$key1.'"<br>';
                //echo $key.' => '.$key1.' => '.$f. " => ".$valor."<br>";
              }
            }         
          }
        }
      }*/

      $cinsert .='
cvms Feature 
cv rbset Feature 

confb -
gs -';

      $estructura = $this->ruta.$this->nombre;
      $archivo    = $estructura.$this->name1.$this->nombre.$this->name2.$this->nombre.".mos";
      $this->ElimarArchivo($archivo);
      $this->crear_carpeta($estructura);
		  $this->CrearArchivo($archivo, $cinsert);
      //die();
      return true;	
	}

    public function __destruct()
    {
        
    }
}
	
?>