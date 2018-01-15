<?php
require_once("../Control_Archivo.php");
/////////////////////////////////////////////////////////////////////////
//Clase para la contruccion de la estrctura de los archivos xml, mos y mo
//Fecha de creacion: 29-05-2017
//Creador por: Wagner Rivera
//Fecha de Modificación: 01-06-2017
////////////////////////////////////////////////////////////////////////
class PARAMETROS_SCRIPT extends Control_Archivos
{
    private $ruta    = "archivos/ENodoB/ENodoB_";
    private $Archivo = "/18.PARAMETROS_SCRIPT_";
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
	public function PARAMETROS_SCRIPT_($p_p_2_1,$p_p_2_2,$p_p_2_3,$p_p_2_4,$p_p_2_5)
	{
		
		$cinsert = '/////////////////////////////////////////////////////////////
//
// SCRIPT     : PARAMETROS
// NEMONICO   : '.$this->nombre.'
// RNC        : '.$this->nom_rnc.'
// GENERADOR  : INCOBECH
// HORA       : '.$this->Horas().'
// FECHA      : '.$this->Fechas().'
//
/////////////////////////////////////////////////////////////
';
	$parte_1    = $this->Crear_cuerpo_uno($p_p_2_1);
    $parte_2    = $this->Crear_cuerpo_2($p_p_2_2);
    $parte_3    = $this->Crear_cuerpo_3($p_p_2_3);
    $parte_4    = $this->Crear_cuerpo_4($p_p_2_4);
    $parte_5    = $this->Crear_cuerpo_5($p_p_2_5);
	$cinsert   .= $parte_1.$parte_2.$parte_3.$parte_4.$parte_5; 
    $estructura = $this->ruta.$this->nombre;
    $archivo    = $estructura.$this->Archivo.$this->nombre.".mo";
    $this->ElimarArchivo($archivo);
    $this->crear_carpeta($estructura);
		$this->CrearArchivo($archivo, $cinsert);	
		return true;	
	}

	public function Crear_cuerpo_uno($p_2_1){
        $contar = 1;
        $continido_1_2_1 ="
///////////////////////////////////////////////////////////
// MO TxDeviceGroup                                      //
///////////////////////////////////////////////////////////";
        foreach ($p_2_1 as $key => $value) {
          if($key == 'Slot'){
            foreach ($value as $valor) {
              $Slot[] = $valor;
            }
          }

          if($key != 'RNC' && $key != 'Site' && $key != 'Slot'){
            foreach ($Slot as $cambiante) {
                foreach ($value as $valor) {
                 $continido_1_2_1 .='
SET
(
   mo "ManagedElement=1,Equipment=1,Subrack=1,Slot='.$cambiante.',PlugInUnit=1,PiuDevice=2,TxDeviceGroup=1"
   exception none
   '.$key.' Integer '.$valor.'
)
';
   
                }            
            }
          }                      
        }


		return $continido_1_2_1;
	}

    public function Crear_cuerpo_2($p_2_1){
        $contar = 0;
        $continido_1_2_1 ="
///////////////////////////////////////////////////////////
// MO DownlinkBaseBandPool                               //
///////////////////////////////////////////////////////////";
        foreach ($p_2_1 as $key => $value) {
            if($key == 'baseBandPoolState'){
                foreach ($value as $valor) {
                    $baseBandPoolState[] = $valor;
                }
            }

            if($key == 'maxNumADchReservation'){
                foreach ($value as $valor) {
                    $continido_1_2_1 .='
SET
(
   mo "ManagedElement=1,Equipment=1,Subrack=1,DownlinkBaseBandPool='.($contar+1).'"
   exception none
   baseBandPoolState Integer '.$baseBandPoolState[$contar].'
)

SET
(
   mo "ManagedElement=1,Equipment=1,Subrack=1,DownlinkBaseBandPool='.($contar+1).'"
   exception none
   maxNumADchReservation Integer '.$valor.'
)
';            
                $contar++;
                }
            
            }
                                
        }


        return $continido_1_2_1;
    }

    public function Crear_cuerpo_3($p_2_1){
        $contar = 1;
        $continido_1_2_1 ="
///////////////////////////////////////////////////////////
// TpaDevice_RruDeviceGroup                              //
///////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////
// MO NodeBFunction                                      //
///////////////////////////////////////////////////////////";
    foreach ($p_2_1 as $key => $value) {
        if($key != 'RNC' && $key != 'Site' && $key != 'analogUlAlignIsActive'){
            foreach ($value as $valor) {
             $continido_1_2_1 .='
SET
(
   mo "ManagedElement=1,NodeBFunction=1"
   exception none
   '.$key.' Integer '.$valor.'
)';
            }
          }
    }
        return $continido_1_2_1;
    }

    public function Crear_cuerpo_4($p_2_1){
        $contar = 1;
        $continido_1_2_1 ="
///////////////////////////////////////////////////////////
// Parametros RbsLocalCell S1C1                          //
///////////////////////////////////////////////////////////";
    foreach ($p_2_1 as $key => $value) {
        if($key != 'RNC' && $key != 'Site' && $key != 'analogUlAlignIsActive'){
            foreach ($value as $valor) {
             $continido_1_2_1 .='
SET
(
   mo "ManagedElement=1,NodeBFunction=1,RbsLocalCell=S1C1"
   exception none
   '.$key.' Integer '.$valor.'
)';
            }
          }
    }
        return $continido_1_2_1;
    }

    public function Crear_cuerpo_5($p_2_1){
        $contar = 1;
        $continido_1_2_1 ="
///////////////////////////////////////////////////////////
// Parametros Sector 1 Carrier 1                         //
///////////////////////////////////////////////////////////";
    foreach ($p_2_1 as $key => $value) {
        if($key != 'RNC' && $key != 'Site' && $key != 'Utrancell' && $key != 'Sector'){
            foreach ($value as $valor) {
             $continido_1_2_1 .='
SET
(
   mo "ManagedElement=1,NodeBFunction=1,Sector=1,Carrier=1"
   exception none
   '.$key.' Integer '.$valor.'
)';
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