<?php
require_once("../Control_Archivo.php");
/////////////////////////////////////////////////////////////////////////
//Clase para la contruccion de la estrctura de los archivos xml, mos y mo
//Fecha de creacion: 29-05-2017
//Creador por: Wagner Rivera
//Fecha de Modificación: 01-06-2017
////////////////////////////////////////////////////////////////////////
class CREATE_AREA extends Control_Archivos
{
    private $ruta    = "archivos/ENodoB/ENodoB_";
    private $Archivo = "/02.CREATE_AREA_";
    private $nombre;
    private $nom_rnc;
	
	public function __construct($nombre_archivo, $nombre_rnc)
	{
        $this->nombre  = $nombre_archivo;
        $this->nom_rnc = $nombre_rnc;
	}
	/////////////////////////////////////////////////////////////////////////
	//Metodo para la creacion del archivo siteinstall el primero de la lista
	//Fecha de creacion: 29-05-2017
	//Creador por: Wagner Rivera
	//Fecha de Modificación: 01-06-2017
	////////////////////////////////////////////////////////////////////////	
	public function CREATE_AREA_($p_p_2_1)
	{
		
		$cinsert = '/////////////////////////////////////////////////////////////
//
// SCRIPT     : CREATE AREA
// NEMONICO   : '.$this->nombre.'
// RNC        : '.$this->nom_rnc.'
// GENERADOR  : INCOBECH
// HORA       : '.$this->Horas().'
// FECHA      : '.$this->Fechas().'
//
/////////////////////////////////////////////////////////////
';
		$parte_1 = $this->Crear_cuerpo_uno($p_p_2_1);
		$cinsert  .= $parte_1; 
    $estructura = $this->ruta.$this->nombre;
    $archivo    = $estructura.$this->Archivo.$this->nombre.".mo";
    $this->ElimarArchivo($archivo);
    $this->crear_carpeta($estructura);
		$this->CrearArchivo($archivo, $cinsert);	
		return true;	
	}

	public function Crear_cuerpo_uno($p_2_1){
        $contar = 0;
        $continido_1_2_1 ="";
        foreach ($p_2_1 as $key => $value) {
          if($key == 'lac'){
            foreach ($value as $valor) {
             $continido_1_2_1 .="
CREATE
(
    parent ".'"ManagedElement=1,RncFunction=1,LocationArea='.$valor.'"'."
    identity ".'"'.$cellBroadcastSac[$contar].'"'."
    moType ServiceArea
    exception none
    nrOfAttributes 2
        userLabel String ".'"SAC_'.$cellBroadcastSac[$contar].'"'."
        sac Integer ".$cellBroadcastSac[$contar]."
)
    ";
              $contar++;
            }
          }

          if($key == 'cellBroadcastSac'){
            foreach ($value as $valor) {
              $cellBroadcastSac[] = $valor;
            }
        }
    }


		return $continido_1_2_1;
	}  

    public function __destruct()
    {
        
    }
}
	
?>