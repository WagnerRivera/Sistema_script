<?php
require_once("../Control_Archivo.php");
/////////////////////////////////////////////////////////////////////////
//Clase para la contruccion de la estrctura de los archivos xml, mos y mo
//Fecha de creacion: 29-05-2017
//Creador por: Wagner Rivera
//Fecha de Modificación: 01-06-2017
////////////////////////////////////////////////////////////////////////
class CREATE_COVERAGE_RELATION extends Control_Archivos
{
    private $ruta    = "archivos/ENodoB/ENodoB_";
    private $Archivo = "/05.CREATE_COVERAGE_RELATION_";
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
	public function CREATE_COVERAGE_RELATION_($p_p_5_1)
	{
		
		$cinsert = '/////////////////////////////////////////////////////////////
//
// SCRIPT     : CREATE IUB
// NEMONICO   : '.$this->nombre.'
// RNC        : '.$this->nom_rnc.'
// GENERADOR  : INCOBECH
// HORA       : '.$this->Horas().'
// FECHA      : '.$this->Fechas().'
//
/////////////////////////////////////////////////////////////
';
		$parte_uno = $this->Crear_cuerpo_uno($p_p_5_1);
		$cinsert  .= $parte_uno; 
        $estructura = $this->ruta.$this->nombre;
        $archivo 	= $estructura.$this->Archivo.$this->nombre.".mo";
        $this->ElimarArchivo($archivo);
		$this->CrearArchivo($archivo, $cinsert);	
		return true;	
	}

	public function Crear_cuerpo_uno($p_5_1){
        $contar = 0;
	    foreach ($p_5_1 as $key => $value) {
	      if($key == 'UtranCell'){
	        foreach ($value as $valor) {
	           $Utrancell[] = $valor;
	        }
	      }

	      if($key == 'CoverageRelationId'){
	        foreach ($value as $valor) {
	           $CoverageRelationId[] = $valor;
	        }
	      }

	      if($key == 'coverageIndicator'){
	        foreach ($value as $valor) {
	           $coverageIndicator[] = $valor;
	        }
	      }

	      if($key == 'hsIflsDownswitch'){
	        foreach ($value as $valor) {
	           $hsIflsDownswitch[] = $valor;
	        }
	      }

	      if($key == 'relationCapability_dchLoadSharing'){
	        foreach ($value as $valor) {
	           $relationCapability_dchLoadSharing[] = $valor;
	        }
	      }

	      if($key == 'hsPathlossThreshold'){
	        foreach ($value as $valor) {
	           $hsPathlossThreshold[] = $valor;
	        }
	      }


	      if($key == 'relationCapability_hsCellSelection'){
	        foreach ($value as $valor) {
	           $relationCapability_hsCellSelection[] = $valor;
	        }
	      }

	      if($key == 'relationCapability_hsLoadSharing'){
	        foreach ($value as $valor) {
	           $relationCapability_hsLoadSharing[] = $valor;
	        }
	      }


	      if($key == 'relationCapability_powerSave'){
	        foreach ($value as $valor) {	        	        	
				$lineas = count($Utrancell);
				if($contar == 0){
					@$continido_1_1_1 .='

// '.$lineas.'
';
				}        		
        		$continido_1_1_1 .='
////////////////////////////////////////////////////////////
//COVERAGE RELATIONS '.$Utrancell[$contar].' -> '.$CoverageRelationId[$contar].'
////////////////////////////////////////////////////////////

CREATE
(
parent "ManagedElement=1,RncFunction=1,UtranCell='.$Utrancell[$contar].'"
identity "'.$CoverageRelationId[$contar].'"
moType CoverageRelation
exception none
nrOfAttributes 1
utranCellRef Ref "ManagedElement=1,RncFunction=1,UtranCell='.$CoverageRelationId[$contar].'"
)

SET
(
mo "ManagedElement=1,RncFunction=1,UtranCell='.$Utrancell[$contar].',CoverageRelation='.$CoverageRelationId[$contar].'"
exception none
coverageIndicator Integer '.$coverageIndicator[$contar].'
)

SET
(
mo "ManagedElement=1,RncFunction=1,UtranCell='.$Utrancell[$contar].',CoverageRelation='.$CoverageRelationId[$contar].'"
exception none
hsIflsDownswitch Integer '.$hsIflsDownswitch[$contar].'
)

SET
(
mo "ManagedElement=1,RncFunction=1,UtranCell='.$Utrancell[$contar].',CoverageRelation='.$CoverageRelationId[$contar].'"
exception none
hsPathlossThreshold Integer '.$hsPathlossThreshold[$contar].'
)

SET
(
mo "ManagedElement=1,RncFunction=1,UtranCell='.$Utrancell[$contar].',CoverageRelation='.$CoverageRelationId[$contar].'"
exception none
relationCapability Struct
nrOfElements 4
dchLoadSharing Integer '.$relationCapability_dchLoadSharing[$contar].'
hsCellSelection Integer '.$relationCapability_hsCellSelection[$contar].'
hsLoadSharing Integer '.$relationCapability_hsLoadSharing[$contar].'
powerSave Integer '.$valor.'
)
//'.($contar+1).'
';
			$contar++;
			}
		   }
			
		}
		return $continido_1_1_1;
	}  

    public function __destruct()
    {
        
    }
}
	
?>